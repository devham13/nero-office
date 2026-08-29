<?php
/**
 * Template Name: AI-анализ P&L, ДДС и управленческой отчётности под ключ
 * Description: Внедрение AI-анализа P&L, ДДС и управленческих отчётов — отклонения, кассовый разрыв, executive summary.
 */

$page_seo_title       = 'AI-анализ P&L, ДДС и управленческой отчётности под ключ';
$page_seo_description = 'Внедрим AI-анализ P&L, ДДС и управленческих отчётов: находим отклонения, риски кассового разрыва и объясняем цифры простым языком. Разбор вашего отчёта в подарок.';

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
	['label' => 'Зачем AI',       'href' => '#zachem'],
	['label' => 'Как работает',   'href' => '#kak-rabotaet'],
	['label' => 'ДДС и риски',    'href' => '#dds'],
	['label' => 'Внедрение',      'href' => '#etapy'],
	['label' => 'Пример отчёта',  'href' => '#primer'],
	['label' => 'Стоимость',      'href' => '#ceny'],
	['label' => 'FAQ',            'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
	$nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Найти финансовые риски';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#kak-rabotaet';

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

.pnl-hero-pnl {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-analiz-pnl-dds-upravlencheskaya-otchetnost-page" role="main" tabindex="-1">

<section class="nero-ai-hero pnl-hero-pnl" id="pnl-hero" aria-labelledby="pnl-hero-title">
<style>
/* ── Hero pnl-dds: самодостаточные стили (без CSS темы) ── */
.pnl-hero-pnl {
  --pnl-gold: #f5c518;
  --pnl-green: #22c55e;
  --pnl-amber: #f59e0b;
  --pnl-red: #ef4444;
  --pnl-cyan: #79f2ff;
  --pnl-purple: #8b5cf6;
  --pnl-text: #e6edf7;
  --pnl-muted: #9aa8bd;
  --pnl-soft: #c7d2e5;
  --pnl-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.pnl-hero-pnl::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 32% 24%, #000 0%, transparent 74%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.pnl-hero-pnl::after {
  content: "";
  position: absolute;
  left: 6%;
  bottom: 8%;
  width: 560px;
  height: 560px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .09), transparent 66%);
  filter: blur(10px);
  animation: pnlHeroGlow 10s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes pnlHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.06); }
}
.pnl-hero-pnl .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.pnl-hero-pnl .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.pnl-hero-pnl .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 66px);
  line-height: .98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.pnl-hero-pnl .nero-ai-gradient-text {
  background: linear-gradient(92deg, var(--pnl-cyan) 0%, var(--pnl-purple) 48%, #fde68a 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.pnl-hero-pnl .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(139, 92, 246, 0.1);
  color: var(--pnl-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.pnl-hero-pnl .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--pnl-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.pnl-hero-pnl .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.pnl-hero-pnl .nero-ai-badge {
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
.pnl-hero-pnl .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.pnl-hero-pnl .nero-ai-btn {
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
.pnl-hero-pnl .nero-ai-btn:hover { transform: translateY(-2px); }
.pnl-hero-pnl .nero-ai-btn-primary {
  color: #050711 !important;
  background: linear-gradient(135deg, var(--pnl-cyan), var(--pnl-purple));
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.2);
}
.pnl-hero-pnl .nero-ai-btn-secondary {
  color: var(--pnl-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.pnl-hero-pnl .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--pnl-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.pnl-hero-pnl .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(5, 7, 17, .96));
}
.pnl-hero-pnl .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.pnl-hero-pnl .nero-ai-dots { display: flex; gap: 7px; }
.pnl-hero-pnl .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.pnl-hero-pnl .nero-ai-dot:nth-child(1) { background: #fb7185; }
.pnl-hero-pnl .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.pnl-hero-pnl .nero-ai-dot:nth-child(3) { background: #34d399; }
.pnl-hero-pnl .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.pnl-hero-pnl .nero-ai-window-body { padding: 16px; }
.pnl-hero-pnl .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.pnl-hero-pnl .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.pnl-hero-pnl .nero-ai-live-pill {
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
.pnl-hero-pnl .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: pnlPulse 1.6s infinite;
}
@keyframes pnlPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.pnl-hero-pnl .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.pnl-hero-pnl .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.pnl-hero-pnl .nero-ai-metric span {
  display: block;
  color: var(--pnl-muted);
  font-size: 11px;
  font-weight: 700;
}
.pnl-hero-pnl .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.pnl-hero-pnl .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.pnl-hero-pnl .nero-ai-metric--warn strong { color: var(--pnl-amber); }
.pnl-hero-pnl .nero-ai-metric--risk strong { color: var(--pnl-red); }
.pnl-hero-pnl .pnl-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.14);
  background: radial-gradient(ellipse at 55% 40%, rgba(139,92,246,.08), rgba(5,7,17,.94) 72%);
}
.pnl-hero-pnl #pnl-dds-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.pnl-hero-pnl .nero-ai-task-stream { display: grid; gap: 8px; }
.pnl-hero-pnl .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.pnl-hero-pnl .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--pnl-cyan);
  font-size: 10px;
  font-weight: 800;
}
.pnl-hero-pnl .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.pnl-hero-pnl .nero-ai-task span {
  color: var(--pnl-muted);
  font-size: 11px;
}
.pnl-hero-pnl .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.pnl-hero-pnl .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.pnl-hero-pnl .nero-ai-status--red {
  background: rgba(239,68,68,.14);
  color: #fecaca;
}
@media (max-width: 1100px) {
  .pnl-hero-pnl .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .pnl-hero-pnl .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .pnl-hero-pnl .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .pnl-hero-pnl .nero-ai-window-body { padding: 12px; }
  .pnl-hero-pnl .nero-ai-task { grid-template-columns: 28px 1fr; }
  .pnl-hero-pnl .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Финансы / управленка · внедрение под ключ</p>
      <h1 id="pnl-hero-title">AI-анализ P&amp;L, ДДС и управленческих отчётов: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Найдём отклонения, риски кассового разрыва и объясним цифры простым языком — разбор одного вашего отчёта в подарок</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">P&amp;L · ДДС · Баланс</li>
        <li class="nero-ai-badge">Прогноз кассы</li>
        <li class="nero-ai-badge">1С / Excel / BI</li>
        <li class="nero-ai-badge">Telegram-дайджест</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Найти финансовые риски</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-анализа управленческой отчётности">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-финансовый аналитик</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric nero-ai-metric--warn">
              <span>Маржа</span>
              <strong>−3,4 п.п.</strong>
              <small>к плану · август</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--risk">
              <span>Риск кассы</span>
              <strong>17.09</strong>
              <small>−420 тыс. ₽ база</small>
            </div>
            <div class="nero-ai-metric">
              <span>Отчёт за</span>
              <strong>42 сек</strong>
              <small>P&amp;L + ДДС + выводы</small>
            </div>
            <div class="nero-ai-metric">
              <span>Найдено</span>
              <strong>3 риска</strong>
              <small>маржа · касса · OPEX</small>
            </div>
          </div>

          <div class="pnl-dash-canvas-wrap" aria-hidden="false">
            <canvas id="pnl-dds-hero-canvas" role="img" aria-label="Анимация: отчёты P&amp;L и ДДС проходят AI-сканирование, выявляются аномалии и формируется executive summary для собственника"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий финансового анализа">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">P&amp;L</span>
              <div><strong>Аномалия: маркетинг +47%</strong><span>Статья OPEX · план-факт август</span></div>
              <span class="nero-ai-status nero-ai-status--amber">подсветка</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">ДДС</span>
              <div><strong>Прогноз 13 недель</strong><span>Минимум остатка 17 сентября</span></div>
              <span class="nero-ai-status nero-ai-status--red">разрыв</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Executive summary готов</strong><span>3 риска · 3 рекомендации · plain language</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * pnl-dds-hero-engine — «Treasury Lens: диспетчерская управленки»
 * Мир: дуга отчётов → сканер отклонений → волна ДДС → narrative → Telegram-дайджест
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("pnl-dds-hero-canvas");
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
    cy = ch / 2 + 6;
    scale = Math.min(cw / 440, ch / 290) * 1.08;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    sheet: "#f8fafc",
    sheetPnL: "#fef9c3",
    sheetDds: "#dbeafe",
    sheetBal: "#d1fae5",
    gold: "#f5c518",
    green: "#22c55e",
    amber: "#f59e0b",
    red: "#ef4444",
    cyan: "#79f2ff",
    purple: "#8b5cf6",
    consoleBg: "#0f172a",
    grid: "rgba(148,163,184,0.15)",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0"
  };

  function drawRR(ctx, x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) {
      ctx.lineWidth = 1.4;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  function drawSheet(ctx, x, y, w, h, color, label) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 3, color, C.outline);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    if (label) ctx.fillText(label, x, y + 2);
    for (var i = 0; i < 4; i++) {
      ctx.strokeStyle = "rgba(148,163,184,0.45)";
      ctx.lineWidth = 0.7;
      ctx.beginPath();
      ctx.moveTo(x - w / 2 + 3, y - h / 2 + 7 + i * 4);
      ctx.lineTo(x + w / 2 - 3, y - h / 2 + 7 + i * 4);
      ctx.stroke();
    }
  }

  /* Дуговой карусель отчётов — вместо Conveyor */
  function ReportCarouselArc() {
    this.sheets = [
      { phase: 0, color: C.sheetPnL, label: "P&L" },
      { phase: 70, color: C.sheetDds, label: "ДДС" },
      { phase: 140, color: C.sheetBal, label: "Баланс" }
    ];
  }
  ReportCarouselArc.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 260;
    var arcCx = 0, arcCy = -72, arcR = 118;
    ctx.strokeStyle = "rgba(121,242,255,0.2)";
    ctx.lineWidth = 1.2;
    ctx.setLineDash([4, 6]);
    ctx.beginPath();
    ctx.arc(arcCx, arcCy, arcR, Math.PI * 0.12, Math.PI * 0.88);
    ctx.stroke();
    ctx.setLineDash([]);

    this.sheets.forEach(function (sh) {
      var t = ((frame * 0.42 + sh.phase) % 200) / 200;
      var ang = Math.PI * 0.12 + t * (Math.PI * 0.76);
      var sx = arcCx + Math.cos(ang) * arcR;
      var sy = arcCy + Math.sin(ang) * arcR;
      if (t < 0.88) drawSheet(ctx, sx, sy, 18, 22, sh.color, sh.label);
    });
  };

  /* Сканер отклонений P&L */
  function VarianceHighlightScanner() {
    this.row = 0;
  }
  VarianceHighlightScanner.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 260;
    if (prg < 48 || prg >= 108) return;
    var scanT = (prg - 48) / 60;
    var beamY = -18 + scanT * 52;
    ctx.save();
    ctx.globalAlpha = 0.28 + Math.sin(frame * 0.1) * 0.12;
    ctx.fillStyle = "rgba(245,197,24,0.55)";
    ctx.fillRect(-58, beamY - 3, 116, 6);
    ctx.strokeStyle = C.gold;
    ctx.lineWidth = 1.2;
    ctx.strokeRect(-62, beamY - 8, 124, 16);
    ctx.restore();

    if (prg > 62 && prg < 100) {
      var rows = [
        { y: -8, w: 0.7, ok: true },
        { y: 4, w: 0.55, ok: true },
        { y: 16, w: 0.9, ok: false },
        { y: 28, w: 0.45, ok: true }
      ];
      rows.forEach(function (r, i) {
        var on = prg > 58 + i * 9;
        if (!on) return;
        drawRR(ctx, -52, r.y, 104 * r.w, 8, 2, r.ok ? "rgba(34,197,94,0.2)" : "rgba(239,68,68,0.35)", r.ok ? C.green : C.red);
        if (!r.ok) {
          ctx.fillStyle = C.red;
          ctx.font = "bold 6px Inter,sans-serif";
          ctx.textAlign = "right";
          ctx.fillText("+47%", 50, r.y + 7);
        }
      });
    }
  };

  /* Волна прогноза ДДС */
  function CashFlowWaveGraph() {
    this.gapX = 0;
  }
  CashFlowWaveGraph.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 260;
    if (prg < 102 || prg >= 168) return;
    var reveal = Math.min(1, (prg - 102) / 24);
    drawRR(ctx, -68, 8, 136, 48, 6, "rgba(255,255,255,0.04)", C.outline);
    ctx.save();
    ctx.globalAlpha = reveal;
    ctx.strokeStyle = C.cyan;
    ctx.lineWidth = 2;
    ctx.beginPath();
    for (var i = 0; i <= 24; i++) {
      var px = -60 + (i / 24) * 120;
      var py = 38 - Math.sin(i * 0.45 + frame * 0.04) * 10 - (i > 14 ? (i - 14) * 1.8 : 0);
      if (i === 0) ctx.moveTo(px, py);
      else ctx.lineTo(px, py);
    }
    ctx.stroke();

    if (prg > 125) {
      this.gapX = -60 + (17 / 24) * 120;
      ctx.fillStyle = "rgba(239,68,68,0.25)";
      ctx.beginPath();
      ctx.arc(this.gapX, 44, 9, 0, Math.PI * 2);
      ctx.fill();
      ctx.strokeStyle = C.red;
      ctx.lineWidth = 1.5;
      ctx.stroke();
      ctx.fillStyle = "#fecaca";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("17.09", this.gapX, 58);
    }
    ctx.restore();
  };

  /* Кольцо ликвидности */
  function LiquidityGaugeRing() {
    this.pulse = 0;
  }
  LiquidityGaugeRing.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 260;
    drawRR(ctx, -168, -42, 36, 36, 18, "rgba(15,23,42,0.7)", C.outline);
    ctx.strokeStyle = prg > 108 && prg < 175 ? C.amber : C.green;
    ctx.lineWidth = 3;
    ctx.beginPath();
    ctx.arc(-150, -24, 12, -Math.PI / 2, -Math.PI / 2 + (prg > 108 ? 0.65 : 0.85) * Math.PI * 2);
    ctx.stroke();
    ctx.fillStyle = "#cbd5e1";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("₽", -150, -22);
  };

  /* Центральная консоль executive summary — вместо WebsiteTerminal */
  function ExecutiveSummaryConsole() {
    this.tab = 0;
    this.summaryY = 0;
    this.digestFly = 0;
  }
  ExecutiveSummaryConsole.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 260;
    drawRR(ctx, -72, -52, 144, 118, 10, C.consoleBg, C.outline);
    drawRR(ctx, -66, -46, 132, 16, [6, 6, 0, 0], "rgba(139,92,246,0.35)", null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Executive · AI", -60, -36);

    var tabs = ["P&L", "ДДС", "Вывод"];
    var active = prg < 95 ? 0 : prg < 165 ? 1 : 2;
    tabs.forEach(function (t, i) {
      var tx = -58 + i * 38;
      drawRR(ctx, tx, -26, 34, 11, 3, i === active ? "rgba(121,242,255,0.2)" : "rgba(255,255,255,0.05)", C.outline);
      ctx.fillStyle = i === active ? C.cyan : "#94a3b8";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(t, tx + 17, -18);
    });

    if (prg >= 40 && prg < 100 && active === 0) {
      for (var r = 0; r < 5; r++) {
        var hl = r === 2 && prg > 68;
        drawRR(ctx, -58, -8 + r * 11, 116, 8, 2, hl ? "rgba(239,68,68,0.3)" : "rgba(255,255,255,0.06)", null);
      }
    }

    if (prg >= 100 && prg < 170 && active === 1) {
      ctx.strokeStyle = C.cyan;
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.moveTo(-52, 28);
      ctx.lineTo(-20, 12);
      ctx.lineTo(10, 22);
      ctx.lineTo(48, 6);
      ctx.stroke();
    }

    if (prg >= 168) {
      var lines = ["Маржа −3,4 п.п.", "Касса 17.09 −420к", "3 действия → TG"];
      lines.forEach(function (ln, i) {
        var show = prg > 172 + i * 8;
        if (!show) return;
        ctx.fillStyle = "#e2e8f0";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "left";
        ctx.fillText("• " + ln, -54, 2 + i * 12);
      });
    }

    /* Финал: summary летит к Telegram */
    if (prg >= 218) {
      this.digestFly = Math.min(1, (prg - 218) / 28);
      var fx = 20 + this.digestFly * 95;
      var fy = 10 - this.digestFly * 55;
      ctx.save();
      ctx.globalAlpha = 1 - this.digestFly * 0.35;
      drawRR(ctx, 20, 8, 52, 28, 5, "rgba(121,242,255,0.15)", C.cyan);
      ctx.restore();
      drawRR(ctx, fx - 14, fy - 10, 28, 20, 6, "#229ED9", C.outline);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("TG", fx, fy + 3);
      if (this.digestFly > 0.5) {
        ctx.strokeStyle = "rgba(34,197,94," + (0.5 - (this.digestFly - 0.5)) + ")";
        ctx.lineWidth = 2;
        for (var ring = 0; ring < 3; ring++) {
          ctx.beginPath();
          ctx.arc(fx, fy, 16 + ring * 8 + (prg % 12), 0, Math.PI * 2);
          ctx.stroke();
        }
      }
    }
  };

  /* Эмиттер Telegram-дайджеста */
  function TelegramDigestEmitter() {
    this.burst = 0;
  }
  TelegramDigestEmitter.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 260;
    if (prg < 228) return;
    this.burst = (prg - 228) / 32;
    ctx.fillStyle = "rgba(34,197,94,0.85)";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.globalAlpha = Math.min(1, this.burst * 2);
    ctx.fillText("Дайджест 08:00 ✓", 118, -58);
    ctx.globalAlpha = 1;
  };

  /* Флажки аномалий */
  function AnomalyFlagPins() {}
  AnomalyFlagPins.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 260;
    if (prg < 72 || prg > 115) return;
    var pins = [{ x: 42, y: 4 }, { x: -38, y: 22 }];
    pins.forEach(function (p, i) {
      if (prg < 78 + i * 12) return;
      ctx.fillStyle = C.red;
      ctx.beginPath();
      ctx.moveTo(p.x, p.y);
      ctx.lineTo(p.x + 8, p.y - 4);
      ctx.lineTo(p.x + 8, p.y + 4);
      ctx.fill();
      ctx.strokeStyle = C.outline;
      ctx.stroke();
    });
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
    var prg = (frame * 0.034) % 260;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var targets = {
      "1_architect": { x: -95, y: -8 },
      "2_seo": { x: -35, y: 38 },
      "3_coder": { x: 30, y: 38 },
      "4_designer": { x: 88, y: -8 },
      "5_deployer": { x: 0, y: 52 }
    };
    var tgt = targets[this.role] || { x: 0, y: 30 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 11);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 11);
      } else if (local < 15) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 15) / 7);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 15) / 7);
      }
    } else {
      this.x = this.baseX;
      this.y = this.baseY;
      carryType = prg >= this.stepTrig - 8 ? this.color : null;
    }

    if (!isMoving && frame % 195 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 14, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = Math.sin(this.timer * 1.4) * 1;
    ctx.save();
    ctx.translate(this.x, this.y);
    var legL = 0, legR = 0;
    if (isMoving) {
      var wp = this.timer * 6;
      legL = Math.sin(wp) * 4;
      legR = Math.sin(wp + Math.PI) * 4;
    }
    drawRR(ctx, -8, -4 + Math.max(0, legL), 7, 12, 2, C.outline, null);
    drawRR(ctx, 0, -4 + Math.max(0, legR), 7, 12, 2, C.outline, null);
    drawRR(ctx, -12, -10 - bob, 24, 16, 5, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -22 - bob, 9, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.5;
    ctx.stroke();
    if (carryType) {
      drawRR(ctx, -18 * faceDir, -16 - bob, 14, 14, 2, carryType, C.outline);
    }
    ctx.restore();
  };

  var bubbles = [];
  var entities = [
    new ReportCarouselArc(),
    new LiquidityGaugeRing(),
    new VarianceHighlightScanner(),
    new CashFlowWaveGraph(),
    new ExecutiveSummaryConsole(),
    new AnomalyFlagPins(),
    new TelegramDigestEmitter(),
    new Agent(-155, 58, C.agentYellow, "1_architect", 22, [
      "Карта статей P&L…", "Маппинг ДДС готов", "Нормализация витрины"
    ]),
    new Agent(-105, 72, C.agentGreen, "2_seo", 58, [
      "Маржа −3,4 п.п.!", "OPEX +47% к плану", "Variance explanation"
    ]),
    new Agent(-45, 68, C.agentBlue, "3_coder", 98, [
      "JSON без LLM", "math outside LLM", "Агрегаты проверены"
    ]),
    new Agent(45, 68, C.agentPink, "4_designer", 138, [
      "Executive layout", "Plain language", "Дайджест для CEO"
    ]),
    new Agent(110, 58, C.agentPurple, "5_deployer", 178, [
      "Алерт в Telegram", "ДДС 13 нед live", "Дайджест 08:00 ✓"
    ])
  ];

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife || 240, maxLife: customLife || 240 });
  }

  function engineLoop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    var prg = (frame * 0.034) % 260;
    if (prg >= 20 && prg < 20.05) createBubble(-20, -55, "1. Загрузка P&L/ДДС");
    if (prg >= 55 && prg < 55.05) createBubble(-40, 10, "2. Скан отклонений");
    if (prg >= 110 && prg < 110.05) createBubble(10, 30, "3. Прогноз кассы");
    if (prg >= 175 && prg < 175.05) createBubble(0, -20, "4. Executive summary");
    if (prg >= 230 && prg < 230.05) createBubble(115, -50, "5. Дайджест → TG");

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 28);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 18, tw, 18, 5, C.bubbleBg, C.cyan);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(b.text, b.x, b.y - 9);
      ctx.globalAlpha = 1;
    }

    ctx.restore();
    requestAnimationFrame(engineLoop);
  }

  if (document.fonts && document.fonts.ready) {
    document.fonts.ready.then(engineLoop);
  } else {
    engineLoop();
  }
});
</script>

<div class="pnl-content">

<style>
/* === PNL article body (Борис + контент лонгрида) === */
.pnl-content{
  --pnl-bg:#050711;--pnl-bg2:#080b17;--pnl-surface:rgba(255,255,255,.072);
  --pnl-text:#e6edf7;--pnl-muted:#9aa8bd;--pnl-soft:#c7d2e5;--pnl-heading:#fff;
  --pnl-border:rgba(255,255,255,.10);--pnl-gold:#f5c518;--pnl-green:#22c55e;
  --pnl-amber:#f59e0b;--pnl-red:#ef4444;--pnl-cyan:#79f2ff;--pnl-violet:#8b5cf6;
  --pnl-btn-from:#2563eb;--pnl-btn-to:#7c3aed;--pnl-r:18px;--pnl-r-lg:24px;
  --pnl-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--pnl-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.pnl-content *,.pnl-content *::before,.pnl-content *::after{box-sizing:border-box;}
.pnl-content a{color:inherit;text-decoration:none;}
.pnl-content p{color:var(--pnl-muted);line-height:1.72;margin:0 0 1em;}
.pnl-content p:last-child{margin-bottom:0;}
.pnl-content h2,.pnl-content h3,.pnl-content h4{color:var(--pnl-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.pnl-content strong{color:var(--pnl-soft);}
.pnl-content ul,.pnl-content ol{padding-left:0;list-style:none;margin:0 0 1em;}
.pnl-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--pnl-muted);font-size:14.5px;line-height:1.65;}
.pnl-content ul li::before{content:'›';position:absolute;left:0;color:var(--pnl-gold);font-weight:700;}
.pnl-content ol{counter-reset:pnl-ol;margin:0 0 1em;padding:0;}
.pnl-content ol li{counter-increment:pnl-ol;padding-left:28px;position:relative;margin-bottom:.5em;color:var(--pnl-muted);font-size:14.5px;line-height:1.65;}
.pnl-content ol li::before{content:counter(pnl-ol);position:absolute;left:0;width:20px;height:20px;border-radius:50%;background:rgba(245,197,24,.15);color:var(--pnl-gold);font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;top:2px;}
.pnl-cnt{width:min(var(--pnl-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.pnl-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.pnl-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.pnl-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.pnl-sh.pnl-left{margin-left:0;text-align:left;}
.pnl-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.pnl-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.pnl-sh.pnl-left p{margin-left:0;}
.pnl-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(245,197,24,.08);border:1px solid rgba(245,197,24,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--pnl-gold);margin-bottom:14px;}
.pnl-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.pnl-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.pnl-intro-text{position:relative;padding-left:20px;}
.pnl-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--pnl-gold),var(--pnl-violet));}
.pnl-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;}
.pnl-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.pnl-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;}
.pnl-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--pnl-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.pnl-kpi-card .kl{font-size:11px;font-weight:600;color:var(--pnl-muted);line-height:1.4;}
.pnl-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
.pnl-quote-card{background:linear-gradient(135deg,rgba(239,68,68,.12),rgba(245,197,24,.08));border:1px solid rgba(239,68,68,.25);border-radius:var(--pnl-r-lg);padding:28px 32px;margin:28px 0;}
.pnl-quote-card p{font-size:16px;color:var(--pnl-soft);font-style:italic;margin:0;}
.pnl-quote-card cite{display:block;margin-top:12px;font-size:12px;color:var(--pnl-muted);font-style:normal;}
.pnl-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.pnl-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.pnl-toc a{display:inline-block;padding:9px 18px;background:var(--pnl-surface);border:1px solid var(--pnl-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--pnl-muted);transition:border-color .2s,color .2s,background .2s;}
.pnl-toc a:hover{border-color:rgba(245,197,24,.42);color:var(--pnl-gold);background:rgba(245,197,24,.08);}
.pnl-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--pnl-border);border-radius:var(--pnl-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);}
.pnl-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.pnl-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
.pnl-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--pnl-r);padding:26px;margin-bottom:14px;}
.pnl-scenario:last-child{margin-bottom:0;}
.pnl-scenario h3{font-size:17px;margin-bottom:8px;}
.pnl-scenario p{font-size:14.5px;margin:0;}
.pnl-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.pnl-table{width:100%;border-collapse:collapse;font-size:14px;}
.pnl-table th{padding:13px 16px;text-align:left;background:rgba(245,197,24,.1);color:var(--pnl-gold);font-weight:700;border-bottom:1px solid rgba(245,197,24,.25);white-space:nowrap;}
.pnl-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--pnl-text);vertical-align:top;}
.pnl-table tr:last-child td{border-bottom:none;}
.pnl-table tr:hover td{background:rgba(255,255,255,.03);}
.pnl-pipeline{display:grid;grid-template-columns:repeat(7,1fr);gap:8px;margin:28px 0;}
.pnl-pipe-step{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:14px 10px;text-align:center;font-size:11px;color:var(--pnl-muted);position:relative;}
.pnl-pipe-step strong{display:block;font-size:13px;color:var(--pnl-heading);margin-bottom:4px;}
.pnl-pipe-step::after{content:'→';position:absolute;right:-10px;top:50%;transform:translateY(-50%);color:var(--pnl-gold);font-size:14px;}
.pnl-pipe-step:last-child::after{display:none;}
.pnl-timeline{position:relative;padding-left:40px;}
.pnl-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--pnl-gold),var(--pnl-violet));opacity:.35;border-radius:2px;}
.pnl-tl-item{position:relative;margin-bottom:32px;}
.pnl-tl-item:last-child{margin-bottom:0;}
.pnl-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--pnl-gold);box-shadow:0 0 0 4px rgba(245,197,24,.2);}
.pnl-tl-item h3{font-size:17px;margin-bottom:8px;}
.pnl-tl-item p{font-size:14.5px;margin:0;}
.pnl-dds-timeline{display:flex;gap:12px;margin:24px 0;flex-wrap:wrap;}
.pnl-dds-week{flex:1;min-width:100px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:16px;text-align:center;}
.pnl-dds-week.pnl-dds-week--alert{border-color:rgba(239,68,68,.5);background:rgba(239,68,68,.1);}
.pnl-dds-week .pnl-dds-w{font-size:11px;color:var(--pnl-muted);margin-bottom:6px;}
.pnl-dds-week .pnl-dds-v{font-size:18px;font-weight:800;color:var(--pnl-heading);}
.pnl-dds-week.pnl-dds-week--alert .pnl-dds-v{color:var(--pnl-red);}
.pnl-alert-panel{background:linear-gradient(135deg,rgba(239,68,68,.15),rgba(245,158,11,.1));border:1px solid rgba(239,68,68,.35);border-radius:16px;padding:20px 24px;margin:24px 0;display:flex;align-items:flex-start;gap:16px;}
.pnl-alert-panel .pnl-alert-icon{font-size:28px;flex-shrink:0;}
.pnl-alert-panel h4{font-size:16px;color:var(--pnl-red);margin:0 0 6px;}
.pnl-alert-panel p{font-size:14px;margin:0;}
.pnl-report-mock{background:#0a0e1c;border:1px solid rgba(255,255,255,.12);border-radius:16px;padding:24px 28px;margin:20px 0;font-family:'JetBrains Mono',ui-monospace,monospace;font-size:13px;line-height:1.7;color:#a8b8d0;}
.pnl-report-mock em{color:var(--pnl-gold);font-style:normal;}
.pnl-telegram-mock{background:linear-gradient(180deg,#1a2332,#0f172a);border:1px solid rgba(121,242,255,.2);border-radius:16px;padding:20px 24px;margin:20px 0;max-width:420px;}
.pnl-telegram-mock p{font-size:14px;margin:0 0 8px;color:#e2e8f0;}
.pnl-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
.pnl-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;}
.pnl-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--pnl-green);margin-bottom:10px;}
.pnl-case-card h3{font-size:16px;margin-bottom:14px;}
.pnl-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.pnl-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.pnl-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--pnl-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.pnl-faq-q::after{content:'▾';font-size:13px;color:var(--pnl-gold);flex-shrink:0;transition:transform .25s;}
.pnl-faq-item.open .pnl-faq-q::after{transform:rotate(180deg);}
.pnl-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--pnl-muted);line-height:1.72;}
.pnl-faq-item.open .pnl-faq-a{max-height:600px;padding:0 24px 20px;}
.pnl-content .ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(245,197,24,.12),rgba(139,92,246,.1));border:1px solid rgba(245,197,24,.3);text-align:center;}
.pnl-content .ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.pnl-content .ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(245,197,24,.08));border-color:rgba(139,92,246,.3);}
.pnl-content .ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.pnl-content .ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.pnl-content .ym-cta-block__sub{color:var(--pnl-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.pnl-content .ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.pnl-content .ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.pnl-content .ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.pnl-content .ym-btn:hover{transform:translateY(-2px);}
.pnl-content .ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--pnl-btn-from),var(--pnl-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.pnl-content .ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--pnl-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.pnl-content .ym-link--accent{color:var(--pnl-gold)!important;text-decoration:underline!important;}
.pnl-code-inline{font-family:ui-monospace,monospace;font-size:13px;background:rgba(255,255,255,.06);padding:2px 8px;border-radius:6px;color:var(--pnl-cyan);}
@media(max-width:900px){.pnl-intro-grid,.pnl-grid-2,.pnl-grid-3,.pnl-case-grid{grid-template-columns:1fr;}.pnl-pipeline{grid-template-columns:repeat(2,1fr);}.pnl-pipe-step::after{display:none;}}
@media(max-width:600px){.pnl-content .ym-cta-block{padding:28px 20px;}.pnl-intro-kpi{grid-template-columns:1fr 1fr;}}
</style>

  <section class="pnl-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="pnl-cnt">
      <div class="pnl-intro-grid nero-ai-reveal">
        <div class="pnl-intro-text">
          <p class="pnl-eyebrow">Лонгрид · ai анализ p&amp;l</p>
          <p><strong>Коротко:</strong> AI-анализ P&amp;L, ДДС и управленческой отчётности — слой интерпретации поверх ваших финансовых данных. Система ловит отклонения, прогнозирует кассовый разрыв и переводит цифры в выводы для собственника и финдира — от аудита отчётов до Telegram-дайджеста с алертами.</p>
          <p>P&amp;L и ДДС у вас уже живут в Excel, 1С, Финтабло, Adesk или Power BI. Но на вопрос «почему упала маржа» или «хватит ли денег на зарплату через две недели» ответ часто приходит с опозданием. <strong>AI-анализ P&amp;L</strong> не заменяет бухгалтера и не строит учёт с нуля — он <strong>объясняет готовые отчёты</strong>, находит аномалии и предупреждает о ликвидности заранее.</p>
        </div>
        <div class="pnl-intro-kpi" aria-label="Ключевые метрики">
          <div class="pnl-kpi-card"><div class="kv">+26%</div><div class="kl">выручка МСБ 2025</div><div class="ks">Adesk</div></div>
          <div class="pnl-kpi-card"><div class="kv">−10%</div><div class="kl">прибыль МСБ 2025</div><div class="ks">Adesk</div></div>
          <div class="pnl-kpi-card"><div class="kv">89%</div><div class="kl">используют AI</div><div class="ks">McKinsey 2026</div></div>
          <div class="pnl-kpi-card"><div class="kv">37%</div><div class="kl">рост EBIT от AI</div><div class="ks">McKinsey 2026</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="pnl-toc-outer">
    <div class="pnl-cnt">
      <nav class="pnl-toc" aria-label="Оглавление статьи">
        <a href="#zachem">Зачем AI</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#dds">ДДС и риски</a>
        <a href="#etapy">Внедрение</a>
        <a href="#primer">Пример отчёта</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
        <a href="#razbor">Разбор отчёта</a>
      </nav>
    </div>
  </div>

  <section class="pnl-section" id="zachem">
    <div class="pnl-cnt">
      <div class="pnl-sh">
        <span class="pnl-eyebrow">Боль бизнеса</span>
        <h2>Зачем бизнесу AI-анализ P&amp;L, ДДС и управленческой отчётности</h2>
        <p>Отчёты собраны, но выводы и риски никто быстро не формулирует — типичная картина у МСБ в России.</p>
      </div>

      <div class="pnl-scenario nero-ai-reveal">
        <h3>Когда отчёты есть, а выводов и оценки рисков нет</h3>
        <p>Управленка собирается, но <strong>выводы и риски формируются вручную</strong>. Финдир тратит час на сводку, собственник получает таблицу без ответа «что делать на этой неделе».</p>
      </div>

      <div class="pnl-quote-card nero-ai-reveal">
        <p>Выручка выросла на 26% за 2025 год, а прибыль упала на 10%. Во II квартале 2026: выручка +35% г/г, прибыль −36% г/г — маржа сжимается при росте оборота.</p>
        <cite>Исследование Adesk по 3000+ компаниям МСБ, январь 2026</cite>
      </div>

      <p class="nero-ai-reveal"><strong>Определение:</strong> <em>AI управленческая отчётность</em> — это не ещё один дашборд. Это автоматический аналитик, который читает P&amp;L, ДДС и баланс, сравнивает план с фактом, ищет аномалии и выдаёт текстовый executive summary на русском языке.</p>

      <div class="pnl-grid-3 nero-ai-reveal" style="margin-top:28px;">
        <div class="pnl-card">
          <h3>Что меняется для собственника</h3>
          <p>Утренний дайджест в Telegram: ключевые отклонения, риск кассового разрыва с датой, три рекомендации — без ожидания финслужбы.</p>
        </div>
        <div class="pnl-card nero-ai-delay-1">
          <h3>Что меняется для финдира</h3>
          <p>Минуты, а не часы, на комментарий к отчёту; AI готовит черновик, человек утверждает.</p>
        </div>
        <div class="pnl-card nero-ai-delay-2">
          <h3>Единая картина</h3>
          <p>P&amp;L, ДДС и баланс связаны в одном narrative, а не в трёх несогласованных файлах.</p>
        </div>
      </div>

      <div class="pnl-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="pnl-table">
          <thead><tr><th>Отчёт</th><th>Что показывает</th><th>Типичный источник</th><th>Что делает AI</th></tr></thead>
          <tbody>
            <tr><td><strong>P&amp;L (ОПиУ)</strong></td><td>Выручка, себестоимость, маржа, OPEX</td><td>Excel, 1С, Финтабло, Adesk</td><td>План-факт, MoM/YoY, объяснение просадки маржи</td></tr>
            <tr><td><strong>ДДС</strong></td><td>Приток/отток по видам деятельности</td><td>Excel, Adesk, банк</td><td>Прогноз 4/8/13 недель, алерт кассового разрыва</td></tr>
            <tr><td><strong>Баланс</strong></td><td>Активы, обязательства, капитал</td><td>Реже у МСБ</td><td>Связка с P&amp;L и ДДС, оценка ликвидности</td></tr>
            <tr><td><strong>План-факт</strong></td><td>Отклонения от бюджета</td><td>Excel, 1С</td><td>Variance explanation одним кликом</td></tr>
            <tr><td><strong>Платёжный календарь</strong></td><td>Будущие платежи</td><td>Adesk, Финтабло, Excel</td><td>Сценарии «что если» по отложенным платежам</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:16px;font-size:14px;">Интеграции по частоте у российского МСБ: <strong>1С (OData)</strong> → <strong>банки (API)</strong> → <strong>Excel/Google Sheets</strong> → <strong>CRM</strong> → <strong>Power BI / Yandex DataLens</strong>.</p>
    </div>
  </section>

  <section class="pnl-section pnl-section-alt" id="kak-rabotaet">
    <div class="pnl-cnt">
      <div class="pnl-sh pnl-left">
        <span class="pnl-eyebrow">Пайплайн</span>
        <h2>Что такое AI-анализ P&amp;L и как он работает</h2>
        <p>От загрузки отчёта до текстовых выводов для руководителя — воспроизводимый процесс, не «магия PDF».</p>
      </div>

      <p class="nero-ai-reveal"><strong>AI-анализ P&amp;L</strong> — это не «загрузил PDF — получил магию». Типовой пайплайн:</p>
      <p class="pnl-code-inline nero-ai-reveal" style="display:block;padding:14px 18px;margin:16px 0;line-height:1.6;">загрузка отчёта / <a href="/ai-1c-erp/">подключение AI к 1С и ERP</a> → нормализация статей → сравнение план-факт / период-к-периоду → поиск аномалий → прогноз ДДС (7–13 недель) → текстовый executive summary → алерт в Telegram/email</p>

      <p class="nero-ai-reveal">Принцип <strong>«math outside LLM»</strong> — расчёты в коде и учётной системе, LLM только интерпретирует. Как отмечают практики Infostart и Yandex Cloud: <em>«ИИ раскрывается не на сырых данных, а на подготовленной модели»</em>.</p>

      <div class="pnl-grid-3 nero-ai-reveal" style="margin-top:28px;">
        <div class="pnl-card">
          <h3>BI-дашборд</h3>
          <p>Показывает графики, но не отвечает на вопрос «почему» без аналитика.</p>
        </div>
        <div class="pnl-card">
          <h3>SaaS-учёт</h3>
          <p>Финтабло, Adesk ведут операции, но не всегда глубоко интегрируются с кастомной 1С и legacy Excel.</p>
        </div>
        <div class="pnl-card">
          <h3>AI-слой Nero</h3>
          <p>Работает поверх того, что уже есть, и <strong>объясняет</strong> готовые отчёты.</p>
        </div>
      </div>

      <div class="pnl-scenario nero-ai-reveal" style="margin-top:28px;">
        <h3>Поиск отклонений, аномалий и трендов в P&amp;L</h3>
        <ul>
          <li>«Маркетинг +47% к прошлому месяцу — основной драйвер: кампания X»</li>
          <li>«Маржа по направлению B упала с 28% до 19% — рост доли скидок и логистики»</li>
          <li>«Себестоимость отстаёт от выручки на 2 недели — риск искажения P&amp;L при закрытии месяца»</li>
        </ul>
      </div>

      <div class="pnl-scenario nero-ai-reveal">
        <h3>Объяснение цифр простым языком</h3>
        <p>Два языка одних данных: для собственника — «Прибыль ниже плана на 1,2 млн ₽ из-за роста закупок»; для финдира — drill-down до контрагента, статьи, документа в 1С. Microsoft Copilot for Finance показал спрос на variance explanation; Nero даёт тот же сценарий для МСБ без SAP/Dynamics 365.</p>
      </div>
    </div>
  </section>

  <!-- === БОРИС CANVAS: мостик мониторинга ликвидности === -->
  <section id="ai-analiz-pnl-dds-upravlencheskaya-otchetnost-boris-block" class="bpf-root" aria-label="Анимация: 13-недельный прогноз ДДС и алерт кассового разрыва">
<style>
#ai-analiz-pnl-dds-upravlencheskaya-otchetnost-boris-block.bpf-root{padding:56px 0 64px;background:#f8fafc;}
#ai-analiz-pnl-dds-upravlencheskaya-otchetnost-boris-block .bpf-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#ai-analiz-pnl-dds-upravlencheskaya-otchetnost-boris-block .bpf-card{display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);min-height:480px;}
@media(max-width:1023px){#ai-analiz-pnl-dds-upravlencheskaya-otchetnost-boris-block .bpf-card{grid-template-columns:1fr;min-height:auto;}}
#ai-analiz-pnl-dds-upravlencheskaya-otchetnost-boris-block .bpf-lft{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0;}
@media(max-width:1023px){#ai-analiz-pnl-dds-upravlencheskaya-otchetnost-boris-block .bpf-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}}
#ai-analiz-pnl-dds-upravlencheskaya-otchetnost-boris-block .bpf-ey{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#b45309;margin:0 0 14px;}
#ai-analiz-pnl-dds-upravlencheskaya-otchetnost-boris-block .bpf-ey::before{content:'';width:18px;height:2px;background:#f59e0b;border-radius:1px;}
#ai-analiz-pnl-dds-upravlencheskaya-otchetnost-boris-block .bpf-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;}
#ai-analiz-pnl-dds-upravlencheskaya-otchetnost-boris-block .bpf-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#ai-analiz-pnl-dds-upravlencheskaya-otchetnost-boris-block .bpf-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#ai-analiz-pnl-dds-upravlencheskaya-otchetnost-boris-block .bpf-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(245,158,11,.12);display:flex;align-items:center;justify-content:center;font-size:11px;color:#b45309;font-style:normal;}
#ai-analiz-pnl-dds-upravlencheskaya-otchetnost-boris-block .bpf-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#ai-analiz-pnl-dds-upravlencheskaya-otchetnost-boris-block .bpf-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
#ai-analiz-pnl-dds-upravlencheskaya-otchetnost-boris-block .bpf-pl-r{background:rgba(239,68,68,.08);color:#b91c1c;border:1.5px solid rgba(239,68,68,.22);}
#ai-analiz-pnl-dds-upravlencheskaya-otchetnost-boris-block .bpf-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-analiz-pnl-dds-upravlencheskaya-otchetnost-boris-block .bpf-pl-a{background:rgba(245,158,11,.08);color:#b45309;border:1.5px solid rgba(245,158,11,.22);}
#ai-analiz-pnl-dds-upravlencheskaya-otchetnost-boris-block .bpf-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#ai-analiz-pnl-dds-upravlencheskaya-otchetnost-boris-block .bpf-rgt{position:relative;background:linear-gradient(135deg,#fffbeb 0%,#fef3c7 20%,#f0fdf4 60%,#f8fafc 100%);min-height:420px;overflow:hidden;}
@media(max-width:1023px){#ai-analiz-pnl-dds-upravlencheskaya-otchetnost-boris-block .bpf-rgt{min-height:360px;}}
#pnl-cash-bridge-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="bpf-cnt">
  <div class="bpf-card">
    <div class="bpf-lft">
      <span class="bpf-ey">Прогноз ликвидности</span>
      <h3 class="bpf-h3">13-недельный мостик ДДС: видите кассовый разрыв до того, как он случится</h3>
      <ul class="bpf-ul">
        <li><span class="bpf-ic">1</span>Нормализованный денежный поток: операционная, инвестиционная, финансовая деятельность</li>
        <li><span class="bpf-ic">2</span>Повторяющиеся платежи, дебиторка, налоговые и зарплатные циклы</li>
        <li><span class="bpf-ic">3</span>Три сценария: базовый / оптимист / пессимист с датой и суммой дефицита</li>
        <li><span class="bpf-ic">!</span>Алерт в Telegram: «17 сентября не хватает 420 тыс. ₽» — не абстрактный «риск»</li>
      </ul>
      <div class="bpf-pills">
        <span class="bpf-pl bpf-pl-r">−420 тыс. ₽</span>
        <span class="bpf-pl bpf-pl-a">13 недель</span>
        <span class="bpf-pl bpf-pl-g">базовый сценарий</span>
      </div>
      <p class="bpf-foot">Дальше — AI-анализ ДДС и прогноз риска кассового разрыва →</p>
    </div>
    <div class="bpf-rgt">
      <canvas id="pnl-cash-bridge-canvas" aria-label="Анимация: линия остатка на 13 недель с зоной кассового разрыва и алертом" role="img"></canvas>
    </div>
  </div>
</div>
<script>
(function(){
  'use strict';
  var cv=document.getElementById('pnl-cash-bridge-canvas');
  if(!cv)return;
  var ctx=cv.getContext('2d'),W=0,H=0,frame=0;
  function resize(){var p=cv.parentElement;if(!p)return;cv.width=p.clientWidth||640;cv.height=p.clientHeight||420;W=cv.width;H=cv.height;}
  window.addEventListener('resize',resize);resize();
  var C={ink:'#0f172a',muted:'#64748b',grid:'rgba(148,163,184,.25)',line:'#22c55e',lineB:'#3b82f6',danger:'#ef4444',dangerBg:'rgba(239,68,68,.12)',safe:'rgba(34,197,94,.08)',gold:'#f59e0b',white:'#fff'};
  var weeks=13,balances=[2.4,2.35,2.1,1.85,1.55,1.2,0.89,1.05,1.3,1.5,1.7,1.9,2.1];
  var minBal=0.6,alertWeek=6;
  function drawGrid(pad,chartW,chartH,baseY){
    ctx.strokeStyle=C.grid;ctx.lineWidth=1;
    for(var i=0;i<=4;i++){var y=pad+chartH*i/4;ctx.beginPath();ctx.moveTo(pad,y);ctx.lineTo(pad+chartW,y);ctx.stroke();}
    for(var w=0;w<=weeks;w++){var x=pad+chartW*w/weeks;ctx.beginPath();ctx.moveTo(x,pad);ctx.lineTo(x,pad+chartH);ctx.stroke();}
    ctx.fillStyle=C.muted;ctx.font='10px Inter,sans-serif';ctx.textAlign='center';
    for(var w2=1;w2<=weeks;w2+=2){ctx.fillText('н'+w2,pad+chartW*w2/weeks,baseY+18);}
  }
  function drawAlertBox(x,y,w,h,alpha){
    ctx.globalAlpha=alpha||1;
    ctx.fillStyle=C.dangerBg;ctx.strokeStyle=C.danger;ctx.lineWidth=2;
    ctx.beginPath();if(ctx.roundRect)ctx.roundRect(x,y,w,h,10);else ctx.rect(x,y,w,h);
    ctx.fill();ctx.stroke();
    ctx.fillStyle=C.danger;ctx.font='bold 11px Inter,sans-serif';ctx.textAlign='left';
    ctx.fillText('⚠ Кассовый разрыв',x+12,y+20);
    ctx.font='10px Inter,sans-serif';ctx.fillStyle=C.ink;
    ctx.fillText('17 сент · −420 тыс. ₽',x+12,y+36);
    ctx.globalAlpha=1;
  }
  function loop(){
    frame++;
    var t=frame*0.016;
    ctx.clearRect(0,0,W,H);
    var pad=48,chartW=W-pad*2,chartH=H-pad*2-30,baseY=pad+chartH;
    var maxB=2.6,minB=minBal,range=maxB-minB;
    drawGrid(pad,chartW,chartH,baseY);
    var alertX=pad+chartW*alertWeek/weeks;
    var alertY=pad+chartH*(1-(balances[alertWeek]-minB)/range);
    var pulse=0.5+0.5*Math.sin(t*3);
    ctx.fillStyle=C.dangerBg;ctx.globalAlpha=0.3+0.2*pulse;
    ctx.beginPath();ctx.arc(alertX,alertY,28+pulse*6,0,Math.PI*2);ctx.fill();
    ctx.globalAlpha=1;
    var prog=Math.min(1,(Math.sin(t*0.8)*0.5+0.5)*0.3+t*0.05%1);
    var drawTo=Math.floor(prog*weeks);
    ctx.strokeStyle=C.line;ctx.lineWidth=3;ctx.lineJoin='round';ctx.beginPath();
    for(var i=0;i<=drawTo&&i<balances.length;i++){
      var x=pad+chartW*i/weeks,y=pad+chartH*(1-(balances[i]-minB)/range);
      if(i===0)ctx.moveTo(x,y);else ctx.lineTo(x,y);
    }
    ctx.stroke();
    if(drawTo<weeks-1){
      ctx.strokeStyle=C.lineB;ctx.setLineDash([6,4]);ctx.beginPath();
      var x0=pad+chartW*drawTo/weeks,y0=pad+chartH*(1-(balances[drawTo]-minB)/range);
      var x1=pad+chartW*(drawTo+1)/weeks,y1=pad+chartH*(1-(balances[drawTo+1]-minB)/range);
      ctx.moveTo(x0,y0);ctx.lineTo(x1,y1);ctx.stroke();ctx.setLineDash([]);
    }
    var threshY=pad+chartH*(1-(0.95-minB)/range);
    ctx.strokeStyle=C.danger;ctx.lineWidth=1.5;ctx.setLineDash([4,4]);
    ctx.beginPath();ctx.moveTo(pad,threshY);ctx.lineTo(pad+chartW,threshY);ctx.stroke();ctx.setLineDash([]);
    ctx.fillStyle=C.danger;ctx.font='9px Inter,sans-serif';ctx.textAlign='right';
    ctx.fillText('порог 950 тыс.',pad+chartW-4,threshY-6);
    if(frame>60)drawAlertBox(alertX+20,alertY-50,140,48,Math.min(1,(frame-60)/40));
    ctx.fillStyle=C.muted;ctx.font='10px Inter,sans-serif';ctx.textAlign='left';
    ctx.fillText('Остаток, млн ₽',pad,pad-12);
    ctx.textAlign='right';ctx.fillText('Горизонт: 13 недель',pad+chartW,pad-12);
    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
  </section>

  <section class="pnl-section" id="dds">
    <div class="pnl-cnt">
      <div class="pnl-sh">
        <span class="pnl-eyebrow">ДДС / касса</span>
        <h2>AI-анализ ДДС и прогноз риска кассового разрыва</h2>
        <p>Нейросеть анализирует нормализованный денежный поток и предупреждает о ликвидности заранее.</p>
      </div>

      <div class="pnl-scenario nero-ai-reveal">
        <h3>Нейросеть анализ ДДС: что смотрит модель</h3>
        <p><strong>Нейросеть анализ ДДС</strong> работает не с «сырой» банковской выпиской, а с нормализованным денежным потоком: операционная, инвестиционная, финансовая деятельность; повторяющиеся платежи; дебиторка и кредиторка; налоговые и зарплатные циклы. Cash Flow Forecaster строит прогноз на горизонтах <strong>4, 8 и 13 недель</strong>.</p>
      </div>

      <div class="pnl-dds-timeline nero-ai-reveal" aria-label="Горизонты прогноза ДДС">
        <div class="pnl-dds-week"><div class="pnl-dds-w">4 недели</div><div class="pnl-dds-v">1,55 млн</div></div>
        <div class="pnl-dds-week"><div class="pnl-dds-w">8 недель</div><div class="pnl-dds-v">1,05 млн</div></div>
        <div class="pnl-dds-week pnl-dds-week--alert"><div class="pnl-dds-w">13 недель · мин.</div><div class="pnl-dds-v">890 тыс.</div></div>
      </div>

      <div class="pnl-alert-panel nero-ai-reveal">
        <span class="pnl-alert-icon" aria-hidden="true">⚠️</span>
        <div>
          <h4>17 сентября на расчётном счёте X не хватает 420 тыс. ₽</h4>
          <p>Драйверы: НДС 1,1 млн ₽ 15 сентября, аренда 420 тыс. ₽, задержка оплаты от «Бета» на 12 дней. При пессимистичном сценарии — дефицит 380 тыс. ₽.</p>
        </div>
      </div>

      <div class="pnl-scenario nero-ai-reveal">
        <h3>Ранние сигналы и сценарии «что если»</h3>
        <ul>
          <li>Отложить платёж поставщику на 7 дней — разрыв сдвигается на 24 сентября</li>
          <li>Ускорить сбор дебиторки на 15% — дефицит исчезает</li>
          <li>Базовый / оптимист / пессимист — три ветки прогноза</li>
        </ul>
      </div>

      <div class="pnl-scenario nero-ai-reveal">
        <h3>Связка ДДС с P&amp;L для целостной картины ликвидности</h3>
        <p>Прибыль в P&amp;L и деньги в ДДС — не одно и то же. AI связывает отчёты: «маржа положительная, но кассовый разрыв через 10 дней из-за аванса поставщику и сезонного спада поступлений». Именно <strong>связка трёх отчётов</strong> в одном narrative отличает зрелое решение от разрозненных таблиц.</p>
      </div>
    </div>
  </section>

  <section class="pnl-section pnl-section-alt" id="upravlenka">
    <div class="pnl-cnt">
      <div class="pnl-sh">
        <span class="pnl-eyebrow">Управленка МСБ</span>
        <h2>AI управленческая отчётность: единый контур для МСБ</h2>
        <p>Интегратор, не SaaS — работаем с тем, что уже есть у клиента.</p>
      </div>

      <div class="pnl-grid-2 nero-ai-reveal">
        <div class="pnl-card">
          <h3>Автоматизация финансовой отчётности с AI</h3>
          <p>Ускорение цикла «закрытие → комментарий → решение». BCG AI pioneers: ~90% автоматизация reporting. Для МСБ: комментарий с часов до минут, раннее предупреждение о кассовом разрыве.</p>
        </div>
        <div class="pnl-card">
          <h3>Форматы отчётов МСБ</h3>
          <p>1С (OData/REST), Excel, Google Sheets, Power BI, Yandex DataLens, Adesk, Финтабло, <a href="/vnedrenie-ai-amocrm/">внедрение AI-агента в amoCRM</a>, Bitrix24. Сначала витрина, потом AI — как в связке Yandex Cloud 1С + DataLens + Нейроаналитик.</p>
        </div>
      </div>

      <div class="pnl-grid-2 nero-ai-reveal" style="margin-top:20px;">
        <div class="pnl-card">
          <h3>AI для финдира</h3>
          <p>План-факт, сверки, аномалии в документах, подготовка к совету директоров. Паттерн Infostart: агент ищет нетипичные цены, реализацию без договора.</p>
        </div>
        <div class="pnl-card">
          <h3>AI для собственника</h3>
          <p>Три цифры, три риска, три действия; голосовой или текстовый запрос в мессенджер — «выручка за вчера», «план-факт по менеджерам».</p>
        </div>
      </div>
    </div>
  </section>

  <section class="pnl-section" id="etapy">
    <div class="pnl-cnt">
      <div class="pnl-sh pnl-left">
        <span class="pnl-eyebrow">Под ключ</span>
        <h2>Внедрение AI-анализа P&amp;L под ключ: этапы и сроки</h2>
        <p>4–8 недель от аудита до пилота с Telegram-дайджестом. Программист на стороне клиента не обязателен.</p>
      </div>

      <div class="pnl-table-wrap nero-ai-reveal">
        <table class="pnl-table">
          <thead><tr><th>Неделя</th><th>Этап</th><th>Результат</th></tr></thead>
          <tbody>
            <tr><td>1</td><td>Аудит данных и отчётов</td><td>Карта источников, качество статей, gap-анализ</td></tr>
            <tr><td>2</td><td>Витрина + нормализация</td><td>Единый слой P&amp;L / ДДС / Баланс</td></tr>
            <tr><td>3</td><td>Правила + детерминированная аналитика</td><td>План-факт, MoM, YoY, пороги отклонений</td></tr>
            <tr><td>4</td><td>AI-слой интерпретации</td><td>Executive summary, риски, рекомендации</td></tr>
            <tr><td>5–6</td><td>Интеграции и алерты</td><td>Telegram/email, расписание</td></tr>
            <tr><td>7–8</td><td>Пилот + обучение</td><td>2–3 цикла закрытия периода с финдиром</td></tr>
          </tbody>
        </table>
      </div>

      <p class="nero-ai-reveal">На этапе аудита часто всплывают «теневые» источники: счета и заявки из почты, не попавшие в CRM. Для их нормализации до витрины P&amp;L подойдёт <a href="/vnedrenie-ai-obrabotka-email-crm/">автоматизация входящей почты в CRM</a> — так дебиторка и ДДС собираются в одном контуре.</p>

      <div class="pnl-pipeline nero-ai-reveal" aria-label="Пайплайн внедрения">
        <div class="pnl-pipe-step"><strong>1</strong>Сбор данных</div>
        <div class="pnl-pipe-step"><strong>2</strong>Нормализация</div>
        <div class="pnl-pipe-step"><strong>3</strong>Аналитика</div>
        <div class="pnl-pipe-step"><strong>4</strong>AI-интерпретатор</div>
        <div class="pnl-pipe-step"><strong>5</strong>Доставка</div>
        <div class="pnl-pipe-step"><strong>6</strong>Контроль</div>
        <div class="pnl-pipe-step"><strong>7</strong>Итерация</div>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Финдир хочет понимать AI до старта пилота?</p>
          <p class="ym-cta-block__sub">Перед пилотом полезно разобраться в промптах, human-in-the-loop и интеграции с 1С/Excel — так сценарии с собственником согласуются быстрее. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <section class="pnl-section pnl-section-alt" id="primer">
    <div class="pnl-cnt">
      <div class="pnl-sh">
        <span class="pnl-eyebrow">Демо</span>
        <h2>Пример отчёта: что увидит руководитель после AI-разбора</h2>
        <p>Обезличенный AI-summary, риски по ДДС и шаблон Telegram-дайджеста.</p>
      </div>

      <div class="pnl-scenario nero-ai-reveal">
        <h3>Демо-фрагмент: отклонения в P&amp;L</h3>
        <div class="pnl-report-mock">
          <em>За август 2026</em> выручка 14,2 млн ₽ (+8% к июлю, −3% к плану). Валовая маржа 34,1% против 37,5% в плане — основной вклад: рост закупочных цен на сырьё (+12%) и скидки ключевому клиенту «Альфа» (−2,1 п.п. маржи). OPEX в норме, кроме статьи «Логистика»: +19% к среднему за квартал.<br><br>
          <strong>Три риска:</strong> просадка маржи по «Опт» — третий месяц; 41% выручки на одном контрагенте; отставание себестоимости от отгрузок.<br><br>
          <strong>Три рекомендации:</strong> пересмотреть прайс «Опт»; диверсификация каналов; синхронизировать учёт себестоимости до 5-го числа.
        </div>
      </div>

      <div class="pnl-scenario nero-ai-reveal">
        <h3>Демо-фрагмент: риски по ДДС</h3>
        <p>Прогноз на 13 недель: минимальный остаток 890 тыс. ₽ ожидается 17 сентября при базовом сценарии. Драйверы: НДС 1,1 млн ₽ 15 сентября, аренда 420 тыс. ₽, задержка оплаты от «Бета» на 12 дней.</p>
      </div>

      <div class="pnl-scenario nero-ai-reveal">
        <h3>Шаблон еженедельного дайджеста для собственника</h3>
        <div class="pnl-telegram-mock" aria-label="Пример Telegram-дайджеста">
          <p>💰 Остаток на счетах: 1,2 млн ₽ (Δ −8% к прошлой неделе)</p>
          <p>📊 Выручка недели: 3,4 млн ₽ (план 97%)</p>
          <p>⚠️ Главный риск: 17.09 · −420 тыс. ₽ · НДС + аренда</p>
          <p>✅ Действие недели: ускорить дебиторку «Бета»</p>
          <p>🔗 Подробный отчёт: [ссылка]</p>
        </div>
      </div>

      <div class="ym-cta-block ym-cta-block--primary" id="cta-primer">
        <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Найдите финансовые риски в ваших отчётах</p>
          <p class="ym-cta-block__sub">Загрузите P&amp;L, ДДС или связку отчётов — получите бесплатный разбор: AI-summary, три риска, три рекомендации и ориентир сметы внедрения под ключ. Без обязательств.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="pnl-section" id="keisy">
    <div class="pnl-cnt">
      <div class="pnl-sh">
        <span class="pnl-eyebrow">Доказательства</span>
        <h2>Кейсы и результаты внедрения AI финансового анализа</h2>
        <p>Цифры зависят от потока и дисциплины пилота — ориентиры из открытых источников.</p>
      </div>

      <div class="pnl-case-grid nero-ai-reveal">
        <div class="pnl-case-card"><div class="pnl-case-tag">МСБ</div><h3>AI анализ P&amp;L для малого бизнеса</h3><p>Кастомный Excel/1С, несколько юрлиц, интеграция с CRM — когда SaaS не гибок. Референс COMANDOS: полный прогон месяца ~10 минут.</p></div>
        <div class="pnl-case-card"><div class="pnl-case-tag">Средний бизнес</div><h3>Производство, Челябинск</h3><p>1С + банки + Excel: закрытие месяца с 12 до ~5 дней (−60%), ошибки сверки 8–12% → 1,5%. *Маркетинговый материал интегратора.*</p></div>
        <div class="pnl-case-card"><div class="pnl-case-tag">Метрики</div><h3>Типовой эффект</h3><p>Комментарий к отчёту: часы → минуты. Точность категоризации ДДС &gt;90% (On + Palm AI). McKinsey: 37% компаний фиксируют вклад в EBIT; для сравнения с крупным корпоративным опытом — <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/">уроки масштабного внедрения AI от KPMG</a>.</p></div>
      </div>

      <div class="pnl-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="pnl-table">
          <thead><tr><th>Метрика</th><th>Ориентир</th><th>Источник</th></tr></thead>
          <tbody>
            <tr><td>Время подготовки комментария</td><td>Часы → минуты</td><td>Проектная модель Nero</td></tr>
            <tr><td>Закрытие месяца</td><td>−60%</td><td>РБК, Челябинск</td></tr>
            <tr><td>Точность категоризации ДДС</td><td>&gt;90%</td><td>On + Palm AI</td></tr>
            <tr><td>Экономия времени treasury</td><td>&gt;1000 ч/год</td><td>Flex + Atlar</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="pnl-section pnl-section-alt" id="ceny">
    <div class="pnl-cnt">
      <div class="pnl-sh">
        <span class="pnl-eyebrow">Коммерция</span>
        <h2>Сколько стоит AI-анализ P&amp;L и что входит в проект</h2>
        <p>Ориентир Nero Network — 250 тыс.–1 млн ₽ в зависимости от сложности интеграций.</p>
      </div>

      <div class="pnl-card nero-ai-reveal">
        <h3>Ориентиры чека и факторы стоимости</h3>
        <p>Количество источников (1С + банки + CRM + BI), необходимость витрины с нуля, горизонт прогноза ДДС, on-premise / 152-ФЗ, период сопровождения. Для сравнения: Noltis MVP 150–300 тыс. ₽; SaaS Финтабло — от ~4–10 тыс. ₽/мес без глубокой кастомной 1С.</p>
      </div>

      <div class="pnl-card nero-ai-reveal" style="margin-top:20px;">
        <h3>Что входит во «внедрение под ключ»</h3>
        <ul>
          <li>Аудит данных и отчётов, витрина P&amp;L / ДДС / Баланс</li>
          <li>Rules Engine: пороги, аномалии, сверки</li>
          <li>Cash Flow Forecaster (4/8/13 недель), AI Analyst, Alert Service</li>
          <li>Интеграции, Telegram/email, 2 месяца поддержки и обучение финдира</li>
        </ul>
      </div>

      <div class="pnl-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="pnl-table">
          <thead><tr><th>Критерий</th><th>Пилот (~250 тыс. ₽)</th><th>Полная интеграция (500 тыс.–1 млн ₽)</th></tr></thead>
          <tbody>
            <tr><td>Источники</td><td>Excel/Sheets + банк</td><td>1С + CRM + BI + несколько юрлиц</td></tr>
            <tr><td>Отчёты</td><td>P&amp;L + ДДС</td><td>P&amp;L + ДДС + Баланс + план-факт</td></tr>
            <tr><td>Прогноз</td><td>4–8 недель</td><td>13 недель + сценарии</td></tr>
            <tr><td>Инфраструктура</td><td>Облако Nero</td><td>On-premise у клиента</td></tr>
            <tr><td>Срок</td><td>4 недели</td><td>6–8 недель</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px;"><strong>Лид-магнит:</strong> начните с <a href="#razbor">разбора одного управленческого отчёта</a> — бесплатная диагностика качества данных и демо AI-summary.</p>
    </div>
  </section>

  <section class="pnl-section" id="bezopasnost">
    <div class="pnl-cnt">
      <div class="pnl-sh">
        <span class="pnl-eyebrow">Доверие</span>
        <h2>Ограничения, безопасность и качество исходных данных</h2>
        <p>Честность про ограничения повышает доверие сильнее, чем хайп.</p>
      </div>

      <div class="pnl-grid-3 nero-ai-reveal">
        <div class="pnl-card">
          <h3>Точность прогнозов</h3>
          <p>AI не гарантирует 100% точность. Сценарии (база/оптимист/пессимист) и human-in-the-loop: финдир утверждает выводы. LLM не считает налоги и не подписывает платежи.</p>
        </div>
        <div class="pnl-card">
          <h3>Конфиденциальность</h3>
          <p>Read-only на пилоте, NDA, опция без обучения на ваших данных, on-premise, журнал промптов, 152-ФЗ по требованию.</p>
        </div>
        <div class="pnl-card">
          <h3>Качество данных</h3>
          <p>Минимум: отчёты за 6–12 месяцев, справочник статей, план/бюджет, реестр повторяющихся платежей. Если данные «грязные» — первый этап: аудит и нормализация.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="pnl-section pnl-section-alt" id="faq">
    <div class="pnl-cnt">
      <div class="pnl-sh">
        <span class="pnl-eyebrow">FAQ</span>
        <h2>FAQ: AI-анализ P&amp;L, ДДС и управленческих отчётов</h2>
      </div>
      <div class="pnl-faq nero-ai-reveal">
        <div class="pnl-faq-item"><div class="pnl-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить AI-анализ P&amp;L?</div><div class="pnl-faq-a">Оставьте заявку или загрузите отчёт для разбора одного управленческого отчёта. Nero проводит аудит, строит витрину, подключает AI-слой и алерты. Срок — 4–8 недель. Программист на вашей стороне не обязателен.</div></div>
        <div class="pnl-faq-item"><div class="pnl-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит AI-анализ P&amp;L?</div><div class="pnl-faq-a">Ориентир: 250 тыс.–1 млн ₽ за проект под ключ. Точная смета — после аудита отчётов и карты интеграций. Пилот возможен от нижней границы диапазона.</div></div>
        <div class="pnl-faq-item"><div class="pnl-faq-q" role="button" tabindex="0" aria-expanded="false">Нужны ли программисты в компании?</div><div class="pnl-faq-a">Нет. Ai анализ p&amp;l без программиста — стандартная модель: разработку выполняет Nero Network. От вас — доступы, отчёты, участие финдира в согласовании справочников.</div></div>
        <div class="pnl-faq-item"><div class="pnl-faq-q" role="button" tabindex="0" aria-expanded="false">С какими системами интегрируется решение?</div><div class="pnl-faq-a">1С (OData/REST), банки (API), amoCRM, Bitrix24, Excel, Google Sheets, Power BI, Yandex DataLens, Adesk, Финтабло, Telegram, email.</div></div>
        <div class="pnl-faq-item"><div class="pnl-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли начать с разбора одного отчёта?</div><div class="pnl-faq-a">Да. Разбор одного управленческого отчёта — бесплатный лид-магнит: оценка качества данных, демо AI-summary, рекомендации по внедрению. Подходят P&amp;L, ДДС или связка за 1–3 месяца.</div></div>
        <div class="pnl-faq-item"><div class="pnl-faq-q" role="button" tabindex="0" aria-expanded="false">Работает ли решение без 1С?</div><div class="pnl-faq-a">Да. Достаточно Excel/Google Sheets + банковская выписка для старта. 1С ускоряет автоматизацию, но не обязательна.</div></div>
        <div class="pnl-faq-item"><div class="pnl-faq-q" role="button" tabindex="0" aria-expanded="false">Чем это отличается от Финтабло или Adesk?</div><div class="pnl-faq-a">SaaS ведёт учёт и даёт базовую аналитику. Nero — AI-слой поверх ваших систем: глубокая интеграция с кастомной 1С, CRM, legacy Excel.</div></div>
        <div class="pnl-faq-item"><div class="pnl-faq-q" role="button" tabindex="0" aria-expanded="false">AI не ошибается в цифрах?</div><div class="pnl-faq-a">Расчёты выполняются в 1С или детерминированном коде. LLM только интерпретирует проверенные агрегаты — защита от галлюцинаций. Финдир утверждает финальный текст.</div></div>
      </div>
    </div>
  </section>

  <section class="pnl-section" id="razbor">
    <div class="pnl-cnt">
      <div class="pnl-sh">
        <span class="pnl-eyebrow">Лид-магнит</span>
        <h2>Разбор одного управленческого отчёта — лид-магнит</h2>
        <p>Если отчёты есть, а выводов нет — начните с конкретики, а не с «внедрения AI ради AI».</p>
      </div>

      <div class="pnl-grid-2 nero-ai-reveal">
        <div class="pnl-card">
          <h3>Что входит в бесплатный разбор</h3>
          <ol>
            <li>Загрузка одного отчёта (P&amp;L, ДДС или связка)</li>
            <li>Проверка качества статей и сходимости цифр</li>
            <li>Демо AI-summary: 3 абзаца + 3 риска + 3 рекомендации</li>
            <li>Карта интеграций и ориентир сметы внедрения</li>
            <li>30-минутная консультация с экспертом Nero Network</li>
          </ol>
        </div>
        <div class="pnl-card">
          <h3>Какие отчёты подходят</h3>
          <ul>
            <li><strong>P&amp;L (ОПиУ)</strong> за 3–12 месяцев — оптимально для старта</li>
            <li><strong>ДДС</strong> с платёжным календарём — для оценки кассовых рисков</li>
            <li><strong>Связка P&amp;L + ДДС</strong> — максимальная ценность разбора</li>
            <li>Форматы: Excel, Google Sheets, выгрузка из 1С, PDF с табличными данными</li>
          </ul>
        </div>
      </div>

      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Отчёты есть — выводов нет? Начните с разбора</p>
          <p class="ym-cta-block__sub">Бесплатный разбор одного управленческого отчёта: проверим качество данных, покажем демо AI-summary и составим план внедрения за 4–8 недель. Ориентир проекта — 250 тыс.–1 млн ₽.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Читать FAQ</a>
          </div>
        </div>
      </div>

      <!-- AD_BANNER: not configured -->
    </div>
  </section>

</div>

<script>
document.addEventListener('DOMContentLoaded',function(){
  document.querySelectorAll('.pnl-faq-q').forEach(function(q){
    q.addEventListener('click',function(){q.parentElement.classList.toggle('open');});
    q.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();q.parentElement.classList.toggle('open');}});
  });
});
</script>
<?php
$pnl_page_url = trailingslashit( get_permalink() );
$pnl_site_url = trailingslashit( home_url( '/' ) );
$pnl_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$pnl_schema   = [
	'@context' => 'https://schema.org',
	'@graph'   => [
		[
			'@type' => 'Organization',
			'@id'   => $pnl_site_url . '#organization',
			'name'  => $pnl_brand,
			'url'   => $pnl_site_url,
		],
		[
			'@type'     => 'WebSite',
			'@id'       => $pnl_site_url . '#website',
			'url'       => $pnl_site_url,
			'name'      => $pnl_brand,
			'publisher' => [ '@id' => $pnl_site_url . '#organization' ],
		],
		[
			'@type'       => 'WebPage',
			'@id'         => $pnl_page_url . '#webpage',
			'url'         => $pnl_page_url,
			'name'        => $page_seo_title,
			'description' => $page_seo_description,
			'isPartOf'    => [ '@id' => $pnl_site_url . '#website' ],
			'about'       => [ '@id' => $pnl_site_url . '#organization' ],
		],
		[
			'@type' => 'BreadcrumbList',
			'@id'   => $pnl_page_url . '#breadcrumb',
			'itemListElement' => [
				[ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $pnl_site_url ],
				[ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $pnl_page_url ],
			],
		],
		[
			'@type'       => 'Service',
			'@id'         => $pnl_page_url . '#service',
			'name'        => $page_seo_title,
			'description' => $page_seo_description,
			'url'         => $pnl_page_url,
			'provider'    => [ '@id' => $pnl_site_url . '#organization' ],
		],
		[
			'@type' => 'FAQPage',
			'@id'   => $pnl_page_url . '#faq',
			'mainEntity' => [
				[ '@type' => 'Question', 'name' => 'Как внедрить AI-анализ P&L?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Оставьте заявку или загрузите отчёт для разбора одного управленческого отчёта. Nero проводит аудит, строит витрину, подключает AI-слой и алерты. Срок — 4–8 недель. Программист на вашей стороне не обязателен.' ] ],
				[ '@type' => 'Question', 'name' => 'Сколько стоит AI-анализ P&L?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Ориентир: 250 тыс.–1 млн ₽ за проект под ключ. Точная смета — после аудита отчётов и карты интеграций. Пилот возможен от нижней границы диапазона.' ] ],
				[ '@type' => 'Question', 'name' => 'Нужны ли программисты в компании?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет. Ai анализ p&l без программиста — стандартная модель: разработку выполняет Nero Network. От вас — доступы, отчёты, участие финдира в согласовании справочников.' ] ],
				[ '@type' => 'Question', 'name' => 'С какими системами интегрируется решение?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => '1С (OData/REST), банки (API), amoCRM, Bitrix24, Excel, Google Sheets, Power BI, Yandex DataLens, Adesk, Финтабло, Telegram, email.' ] ],
				[ '@type' => 'Question', 'name' => 'Можно ли начать с разбора одного отчёта?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да. Разбор одного управленческого отчёта — бесплатный лид-магнит: оценка качества данных, демо AI-summary, рекомендации по внедрению. Подходят P&L, ДДС или связка за 1–3 месяца.' ] ],
				[ '@type' => 'Question', 'name' => 'Работает ли решение без 1С?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да. Достаточно Excel/Google Sheets + банковская выписка для старта. 1С ускоряет автоматизацию, но не обязательна.' ] ],
				[ '@type' => 'Question', 'name' => 'Чем это отличается от Финтабло или Adesk?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'SaaS ведёт учёт и даёт базовую аналитику. Nero — AI-слой поверх ваших систем: глубокая интеграция с кастомной 1С, CRM, legacy Excel.' ] ],
				[ '@type' => 'Question', 'name' => 'AI не ошибается в цифрах?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Расчёты выполняются в 1С или детерминированном коде. LLM только интерпретирует проверенные агрегаты — защита от галлюцинаций. Финдир утверждает финальный текст.' ] ],
			],
		],
	],
];
echo '<script type="application/ld+json">' . wp_json_encode( $pnl_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</main>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.ai-analiz-pnl-dds-upravlencheskaya-otchetnost-page') || document.querySelector('.pnl-content');
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

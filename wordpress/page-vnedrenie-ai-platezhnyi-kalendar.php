<?php
/**
 * Template Name: AI-платёжный календарь: внедрение под ключ
 * Description: SEO-лендинг — внедрение AI-платёжного календаря. Прогноз платежей, кассовые разрывы, калькулятор.
 */

$page_seo_title       = 'AI-платёжный календарь: внедрение под ключ и контроль разрывов';
$page_seo_description = 'Внедрение AI-платёжного календаря: прогноз платежей, раннее обнаружение кассовых разрывов, сценарии переноса. Интеграция с 1С, CRM, банками. Калькулятор.';

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
    ['label' => 'Проблема',    'href' => '#bol-excel'],
    ['label' => 'Что это',     'href' => '#chto-eto'],
    ['label' => 'Калькулятор', 'href' => '#kalkulyator'],
    ['label' => 'Внедрение',   'href' => '#vnedrenie'],
    ['label' => 'Интеграции',  'href' => '#integracii'],
    ['label' => 'Этапы',       'href' => '#etapy'],
    ['label' => 'Цена',        'href' => '#ceny'],
    ['label' => 'FAQ',         'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить кассовые разрывы';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как внедрить AI в бизнес-процессы';
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

.vpc-hero-calendar{min-height:100vh;min-height:100dvh;position:relative;}
</style>

<main id="primary" class="site-main nero-ai-home-page vpc-page" role="main" tabindex="-1">

<section class="nero-ai-hero vpc-hero-calendar" id="vpc-hero-calendar" aria-labelledby="vpc-hero-title">
<style>
/* ── Hero vpc-calendar: самодостаточные стили (без CSS темы) ── */
.vpc-hero-calendar {
  --vpc-gold: #f5c518;
  --vpc-cyan: #38bdf8;
  --vpc-green: #22c55e;
  --vpc-red: #ef4444;
  --vpc-violet: #8b5cf6;
  --vpc-text: #e6edf7;
  --vpc-muted: #9aa8bd;
  --vpc-soft: #c7d2e5;
  --vpc-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  background: linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
}
.vpc-hero-calendar::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 62% 32%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: 0;
}
.vpc-hero-calendar::after {
  content: "";
  position: absolute;
  left: 6%;
  top: 18%;
  width: 520px;
  height: 520px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(56, 189, 248, .09), transparent 66%);
  filter: blur(8px);
  animation: vpcHeroGlow 10s ease-in-out infinite alternate;
  z-index: 0;
  pointer-events: none;
}
@keyframes vpcHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.06); }
}
.vpc-hero-calendar .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vpc-hero-calendar .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vpc-hero-calendar .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(34px, 5.2vw, 66px);
  line-height: .98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.vpc-hero-calendar .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vpc-gold) 38%, var(--vpc-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vpc-hero-calendar .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(245, 197, 24, 0.22);
  border-radius: 999px;
  background: rgba(245, 197, 24, 0.08);
  color: var(--vpc-gold) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.vpc-hero-calendar .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--vpc-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vpc-hero-calendar .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vpc-hero-calendar .nero-ai-badge {
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
.vpc-hero-calendar .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vpc-hero-calendar .nero-ai-btn {
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
.vpc-hero-calendar .nero-ai-btn:hover { transform: translateY(-2px); }
.vpc-hero-calendar .nero-ai-btn-primary {
  color: #1a1200 !important;
  background: linear-gradient(135deg, var(--vpc-gold), #fde68a);
  box-shadow: 0 18px 42px rgba(245, 197, 24, 0.22);
}
.vpc-hero-calendar .nero-ai-btn-secondary {
  color: var(--vpc-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vpc-hero-calendar .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vpc-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.vpc-hero-calendar .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vpc-hero-calendar .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vpc-hero-calendar .nero-ai-dots { display: flex; gap: 7px; }
.vpc-hero-calendar .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vpc-hero-calendar .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vpc-hero-calendar .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vpc-hero-calendar .nero-ai-dot:nth-child(3) { background: #34d399; }
.vpc-hero-calendar .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vpc-hero-calendar .nero-ai-window-body { padding: 16px; }
.vpc-hero-calendar .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vpc-hero-calendar .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vpc-hero-calendar .nero-ai-live-pill {
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
.vpc-hero-calendar .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vpcPulse 1.6s infinite;
}
@keyframes vpcPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vpc-hero-calendar .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vpc-hero-calendar .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vpc-hero-calendar .nero-ai-metric span {
  display: block;
  color: var(--vpc-muted);
  font-size: 11px;
  font-weight: 700;
}
.vpc-hero-calendar .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vpc-hero-calendar .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vpc-hero-calendar .nero-ai-metric--danger strong { color: var(--vpc-red); }
.vpc-hero-calendar .vpc-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(56, 189, 248, 0.18);
  background: radial-gradient(ellipse at 50% 42%, rgba(56,189,248,.08), rgba(6,10,24,.94) 72%);
}
.vpc-hero-calendar #vpc-calendar-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vpc-hero-calendar .nero-ai-task-stream { display: grid; gap: 8px; }
.vpc-hero-calendar .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vpc-hero-calendar .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(56,189,248,.12);
  color: var(--vpc-cyan);
  font-size: 11px;
  font-weight: 800;
}
.vpc-hero-calendar .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vpc-hero-calendar .nero-ai-task span {
  color: var(--vpc-muted);
  font-size: 11px;
}
.vpc-hero-calendar .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vpc-hero-calendar .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.vpc-hero-calendar .nero-ai-status--red {
  background: rgba(239,68,68,.14);
  color: #fecaca;
}
@media (max-width: 1100px) {
  .vpc-hero-calendar .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vpc-hero-calendar .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .vpc-hero-calendar .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vpc-hero-calendar .nero-ai-window-body { padding: 12px; }
  .vpc-hero-calendar .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vpc-hero-calendar .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Финансы / казначейство · AI-слой поверх 1С</p>
      <h1 id="vpc-hero-title">AI-платёжный календарь: внедрение под ключ и контроль <span class="nero-ai-gradient-text">кассовых разрывов</span></h1>
      <p class="nero-ai-hero-lead">AI прогнозирует платежи, подсвечивает кассовые разрывы и предлагает сценарии переноса — пока у вас ещё есть время на переговоры с кредиторами и поставщиками</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Прогноз платежей</li>
        <li class="nero-ai-badge">Кассовые разрывы</li>
        <li class="nero-ai-badge">1С / ERP</li>
        <li class="nero-ai-badge">Сценарии what-if</li>
        <li class="nero-ai-badge">Telegram-алерты</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kalkulyator">Калькулятор разрывов</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-казначейского центра">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-казначейский центр · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Остаток 30 дн.</span>
              <strong>4,2 млн ₽</strong>
              <small>прогнозный коридор</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--danger">
              <span>Ближайший разрыв</span>
              <strong>−18 дн.</strong>
              <small>алерт за 14 дней</small>
            </div>
            <div class="nero-ai-metric">
              <span>Прогноз AR</span>
              <strong>±10%</strong>
              <small>по контрагентам</small>
            </div>
            <div class="nero-ai-metric">
              <span>Сценарии</span>
              <strong>3</strong>
              <small>перенос / дебиторка / кредит</small>
            </div>
          </div>

          <div class="vpc-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vpc-calendar-hero-canvas" role="img" aria-label="Анимация: потоки платежей сходятся к календарю ликвидности, AI обнаруживает кассовый разрыв и предлагает сценарии переноса"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий казначейства">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">!</span>
              <div><strong>Алерт: разрыв 14.09</strong><span>нижняя граница коридора &lt; 0</span></div>
              <span class="nero-ai-status nero-ai-status--red">warning</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">↻</span>
              <div><strong>Сценарий: перенос поставщику А</strong><span>+12 дней · риск низкий</span></div>
              <span class="nero-ai-status nero-ai-status--amber">new</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AR</span>
              <div><strong>Прогноз: клиент Б 22.08 ±3 дн.</strong><span>медиана просрочки учтена</span></div>
              <span class="nero-ai-status">ok</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">1С</span>
              <div><strong>Синк 1С + банк</strong><span>выписки, заявки, дебиторка</span></div>
              <span class="nero-ai-status">ok</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * vpc-calendar-hero-engine — «Казначейский диспетчерский зал ликвидности»
 * Мир: потоки платежей → LiquidityRadarHub → детекция разрыва → сценарии → утверждение CFO
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vpc-calendar-hero-canvas");
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
    scale = Math.min(cw / 440, ch / 280) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    hubBg: "#0f172a",
    hubRing: "#1e293b",
    balanceLine: "#38bdf8",
    gapRed: "rgba(239,68,68,0.55)",
    gapFill: "rgba(239,68,68,0.12)",
    chipIn: "#a7f3d0",
    chipOut: "#fecaca",
    chipTax: "#fde68a",
    conduit: "#334155",
    gold: "#f5c518",
    green: "#22c55e",
    violet: "#8b5cf6",
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
      ctx.lineWidth = 1.5;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  function drawMoneyChip(ctx, x, y, color, label) {
    drawRR(ctx, x - 9, y - 6, 18, 12, 3, color, C.outline);
    if (label) {
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(label, x, y + 2);
    }
  }

  /* Кривые потоки платежей — вместо Conveyor */
  function PaymentStreamConduit() {
    this.paths = [
      { from: { x: -175, y: -55 }, ctrl: { x: -90, y: -20 }, to: { x: -35, y: 8 }, color: C.chipIn, label: "AR" },
      { from: { x: 175, y: -48 }, ctrl: { x: 95, y: -15 }, to: { x: 38, y: 10 }, color: C.chipOut, label: "AP" },
      { from: { x: -155, y: 72 }, ctrl: { x: -60, y: 45 }, to: { x: -28, y: 22 }, color: C.chipTax, label: "НДС" }
    ];
  }
  PaymentStreamConduit.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    this.paths.forEach(function (p, idx) {
      ctx.strokeStyle = "rgba(51,65,85,0.65)";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(p.from.x, p.from.y);
      ctx.quadraticCurveTo(p.ctrl.x, p.ctrl.y, p.to.x, p.to.y);
      ctx.stroke();

      var t = ((frame * 0.55 + idx * 45) % 110) / 110;
      var mt = 1 - t;
      var px = mt * mt * p.from.x + 2 * mt * t * p.ctrl.x + t * t * p.to.x;
      var py = mt * mt * p.from.y + 2 * mt * t * p.ctrl.y + t * t * p.to.y;
      if (t < 0.95) drawMoneyChip(ctx, px, py, p.color, p.label);
    });
  };

  /* Орбита синхронизации банков */
  function BankSyncOrb() {
    this.angle = 0;
  }
  BankSyncOrb.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg > 55) return;
    this.angle += 0.04;
    var r = 58;
    for (var i = 0; i < 3; i++) {
      var a = this.angle + (i * Math.PI * 2) / 3;
      var bx = Math.cos(a) * r - 95;
      var by = Math.sin(a) * r - 70;
      ctx.fillStyle = i === 0 ? C.gold : i === 1 ? C.balanceLine : C.green;
      ctx.beginPath();
      ctx.arc(bx, by, 5, 0, Math.PI * 2);
      ctx.fill();
      ctx.strokeStyle = C.outline;
      ctx.lineWidth = 1;
      ctx.stroke();
    }
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("банк-синк", -95, -118);
  };

  /* Центральный хаб — вместо WebsiteTerminal */
  function LiquidityRadarHub() {
    this.wave = 0;
  }
  LiquidityRadarHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    this.wave = Math.sin(frame * 0.06) * 2;

    /* Кольцо календаря */
    ctx.strokeStyle = C.hubRing;
    ctx.lineWidth = 3;
    ctx.beginPath();
    ctx.arc(0, 0, 52, 0, Math.PI * 2);
    ctx.stroke();

    drawRR(ctx, -38, -38, 76, 76, 38, C.hubBg, C.outline);
    ctx.fillStyle = "#64748b";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("30/60/90", 0, -4);
    ctx.fillStyle = C.gold;
    ctx.fillText("календарь", 0, 8);

    /* Rolling balance линия */
    ctx.strokeStyle = C.balanceLine;
    ctx.lineWidth = 2;
    ctx.beginPath();
    for (var d = 0; d <= 30; d++) {
      var ang = (d / 30) * Math.PI * 1.6 - Math.PI * 0.8;
      var bal = 18 + Math.sin(d * 0.35 + frame * 0.02) * 8;
      if (prg > 100 && d > 18 && d < 24) bal -= 22 + this.wave;
      var rx = Math.cos(ang) * (34 + bal * 0.15);
      var ry = Math.sin(ang) * (34 + bal * 0.15);
      if (d === 0) ctx.moveTo(rx, ry);
      else ctx.lineTo(rx, ry);
    }
    ctx.stroke();

    /* Красная зона разрыва */
    if (prg > 100) {
      var gapAlpha = prg < 140 ? (prg - 100) / 40 : 1;
      ctx.globalAlpha = gapAlpha * 0.35;
      ctx.fillStyle = C.gapFill;
      ctx.beginPath();
      ctx.moveTo(0, 0);
      ctx.arc(0, 0, 48, -0.2, 0.55);
      ctx.closePath();
      ctx.fill();
      ctx.globalAlpha = 1;
    }
  };

  /* Тикер прогноза дебиторки */
  function ARForecastTicker() {
    this.tick = 0;
  }
  ARForecastTicker.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 50 || prg > 105) return;
    var items = ["Клиент А +5д", "Клиент Б −2д", "CRM 78%"];
    items.forEach(function (txt, i) {
      var show = prg > 55 + i * 14;
      if (!show) return;
      drawRR(ctx, 72 + i * 2, -58 + i * 16, 52, 12, 3, "rgba(56,189,248,0.15)", C.balanceLine);
      ctx.fillStyle = "#bae6fd";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(txt, 76 + i * 2, -49 + i * 16);
    });
  };

  /* Маяк кассового разрыва */
  function GapAlertBeacon() {
    this.pulse = 0;
  }
  GapAlertBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 100 || prg > 200) return;
    this.pulse = Math.sin(frame * 0.18) * 0.5 + 0.5;
    ctx.save();
    ctx.globalAlpha = 0.25 + this.pulse * 0.45;
    ctx.fillStyle = C.gapRed;
    ctx.beginPath();
    ctx.arc(28, -18, 10 + this.pulse * 6, 0, Math.PI * 2);
    ctx.fill();
    ctx.restore();
    ctx.fillStyle = "#fecaca";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("РАЗРЫВ", 28, -15);
  };

  /* Вилка сценариев what-if */
  function ScenarioBranchFork() {
    this.open = 0;
  }
  ScenarioBranchFork.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 138 || prg > 210) return;
    this.open = Math.min(1, (prg - 138) / 22);
    var branches = [
      { x: -55, y: 58, label: "перенос AP" },
      { x: 0, y: 68, label: "дебиторка" },
      { x: 55, y: 58, label: "овердрафт" }
    ];
    branches.forEach(function (b, i) {
      var bx = b.x * this.open;
      var by = 30 + (b.y - 30) * this.open;
      ctx.strokeStyle = "rgba(139,92,246,0.55)";
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.moveTo(0, 32);
      ctx.lineTo(bx, by);
      ctx.stroke();
      drawRR(ctx, bx - 22, by - 6, 44, 12, 3, "rgba(139,92,246,0.22)", C.violet);
      ctx.fillStyle = "#ddd6fe";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(b.label, bx, by + 3);
    }, this);
  };

  /* Штамп утверждения CFO — финал цикла */
  function ApprovalSealGate() {
    this.stamp = 0;
  }
  ApprovalSealGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 205) return;
    this.stamp = Math.min(1, (prg - 205) / 20);
    ctx.save();
    ctx.translate(-42, 42);
    ctx.rotate(-0.22 * this.stamp);
    ctx.globalAlpha = this.stamp;
    ctx.strokeStyle = "rgba(34,197,94,0.9)";
    ctx.lineWidth = 2;
    ctx.strokeRect(-30, -10, 60, 22);
    ctx.fillStyle = "#bbf7d0";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("CFO ✓", 0, 5);
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
    var prg = (frame * 0.042) % 260;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    /* Пентагон вокруг хаба — иная геометрия, чем у ai-1c-erp */
    var hubTargets = {
      "1_architect": { x: -68, y: -42 },
      "2_seo": { x: -22, y: -58 },
      "3_coder": { x: 28, y: -52 },
      "4_designer": { x: 62, y: -28 },
      "5_deployer": { x: 0, y: 62 }
    };
    var tgt = hubTargets[this.role] || { x: 0, y: 0 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 26) {
      var local = prg - this.stepTrig;
      if (local < 13) {
        isMoving = true;
        var ease = local / 13;
        this.x = this.baseX + (tgt.x - this.baseX) * ease;
        this.y = this.baseY + (tgt.y - this.baseY) * ease;
      } else if (local < 18) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        var back = (local - 18) / 8;
        this.x = tgt.x - (tgt.x - this.baseX) * back;
        this.y = tgt.y - (tgt.y - this.baseY) * back;
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 12 ? this.color : null;
    }

    if (!isMoving && frame % 195 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 16, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = Math.sin(this.timer * 1.5) * 1.1;
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
    if (carryType) drawRR(ctx, -16 * faceDir, -16 - bob, 12, 12, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  var conduit = new PaymentStreamConduit();
  var bankOrb = new BankSyncOrb();
  var hub = new LiquidityRadarHub();
  var arTicker = new ARForecastTicker();
  var beacon = new GapAlertBeacon();
  var fork = new ScenarioBranchFork();
  var seal = new ApprovalSealGate();

  entities.push(conduit);
  entities.push(bankOrb);
  entities.push(hub);
  entities.push(arTicker);
  entities.push(beacon);
  entities.push(fork);
  entities.push(seal);

  entities.push(new Agent(-120, 78, C.agentYellow, "1_architect", 18, [
    "Карта источников 1С", "Мультибанк в витрине", "Статьи ДДС нормализованы"
  ]));
  entities.push(new Agent(-55, 88, C.agentGreen, "2_seo", 62, [
    "Просрочка контрагента +7д", "Сезонность Q3 учтена", "Коридор AR ±10%"
  ]));
  entities.push(new Agent(10, 92, C.agentBlue, "3_coder", 108, [
    "ETL выписки → хаб", "Rolling balance 30д", "Webhook Telegram"
  ]));
  entities.push(new Agent(72, 86, C.agentPink, "4_designer", 152, [
    "3 ветки what-if", "UI CFO-дашборда", "Красная зона без автопереноса"
  ]));
  entities.push(new Agent(128, 76, C.agentPurple, "5_deployer", 198, [
    "Human-in-the-loop", "Audit log решений", "Алерт за 14 дней"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 230, maxLife: life || 230 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.042) % 260;
    if (prg >= 8 && prg < 8.08) createBubble(-95, -95, "1. Синк банк + 1С", 200);
    if (prg >= 58 && prg < 58.08) createBubble(78, -70, "2. Прогноз AR по CRM", 200);
    if (prg >= 108 && prg < 108.08) createBubble(32, -28, "3. Разрыв через 18 дн.", 200);
    if (prg >= 148 && prg < 148.08) createBubble(0, 64, "4. Сценарий переноса AP", 200);
    if (prg >= 208 && prg < 208.08) createBubble(-42, 48, "5. Утверждено CFO", 200);

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 28);
      if (bub.life > bub.maxLife - 10) alpha = (bub.maxLife - bub.life) / 10;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 14;
      drawRR(ctx, bub.x - tw / 2, bub.y - 18, tw, 18, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(bub.text, bub.x, bub.y - 9);
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

<!-- ═══ VPC: глобальные стили контента статьи (НЕ hero) ═══ -->
<style>
.vpc-content{
  --vpc-bg:#050711;--vpc-bg2:#080b17;--vpc-bg3:#0a0e1c;
  --vpc-surface:rgba(255,255,255,.072);--vpc-surface2:rgba(255,255,255,.108);
  --vpc-text:#e6edf7;--vpc-muted:#9aa8bd;--vpc-soft:#c7d2e5;--vpc-heading:#fff;
  --vpc-border:rgba(255,255,255,.10);--vpc-border-s:rgba(255,255,255,.18);
  --vpc-gold:#f5c518;--vpc-cyan:#38bdf8;--vpc-green:#22c55e;
  --vpc-red:#ef4444;--vpc-violet:#8b5cf6;
  --vpc-btn-from:#2563eb;--vpc-btn-to:#7c3aed;
  --vpc-shadow:0 24px 72px rgba(0,0,0,.4);
  --vpc-r:18px;--vpc-r-lg:24px;--vpc-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vpc-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.vpc-content *,.vpc-content *::before,.vpc-content *::after{box-sizing:border-box;}
.vpc-content a{color:inherit;text-decoration:none;}
.vpc-content p{color:var(--vpc-muted);line-height:1.72;margin:0 0 1em;}
.vpc-content p:last-child{margin-bottom:0;}
.vpc-content h2,.vpc-content h3,.vpc-content h4{color:var(--vpc-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.vpc-content strong{color:var(--vpc-soft);}
.vpc-content ul,.vpc-content ol{padding-left:0;list-style:none;margin:0 0 1em;}
.vpc-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vpc-muted);font-size:14.5px;line-height:1.65;}
.vpc-content ul li::before{content:'›';position:absolute;left:0;color:var(--vpc-gold);font-weight:700;}
.vpc-cnt{width:min(var(--vpc-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.vpc-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.vpc-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.vpc-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.vpc-sh.vpc-left{margin-left:0;text-align:left;}
.vpc-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.vpc-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.vpc-sh.vpc-left p{margin-left:0;}
.vpc-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(245,197,24,.08);border:1px solid rgba(245,197,24,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vpc-gold);margin-bottom:14px;}
.vpc-gt{background:linear-gradient(92deg,#fff 0%,var(--vpc-gold) 44%,var(--vpc-cyan) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.vpc-intro-callout{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.vpc-intro-callout .vpc-intro-text{position:relative;padding-left:20px;max-width:900px;margin:0 auto;}
.vpc-intro-callout .vpc-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vpc-cyan),var(--vpc-gold));}
.vpc-intro-callout p{font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;}
.vpc-kpi-strip{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin:32px 0 0;}
@media(max-width:768px){.vpc-kpi-strip{grid-template-columns:1fr;}}
.vpc-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:22px 18px;text-align:center;}
.vpc-kpi-card .kv{font-size:clamp(28px,3.5vw,38px);font-weight:900;color:var(--vpc-heading);letter-spacing:-.04em;line-height:1;margin-bottom:6px;}
.vpc-kpi-card .kv--red{color:var(--vpc-red);}
.vpc-kpi-card .kl{font-size:13px;font-weight:600;color:var(--vpc-muted);line-height:1.4;}
.vpc-kpi-card .ks{font-size:11px;color:#64748b;margin-top:6px;}
.vpc-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vpc-border);border-radius:var(--vpc-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);}
.vpc-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.vpc-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.vpc-grid-2,.vpc-grid-3{grid-template-columns:1fr;}}
.vpc-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--vpc-r);padding:26px;margin-bottom:14px;}
.vpc-scenario h3{font-size:17px;margin-bottom:8px;}
.vpc-scenario p{font-size:14.5px;margin:0;}
.vpc-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0;}
.vpc-table{width:100%;border-collapse:collapse;font-size:14px;}
.vpc-table th{padding:13px 16px;text-align:left;background:rgba(56,189,248,.12);color:var(--vpc-cyan);font-weight:700;border-bottom:1px solid rgba(56,189,248,.25);white-space:nowrap;}
.vpc-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vpc-text);vertical-align:top;}
.vpc-table tr:last-child td{border-bottom:none;}
.vpc-table tr.vpc-table-hero td{background:rgba(245,197,24,.08);border-top:2px solid var(--vpc-gold);font-weight:600;}
.vpc-governance{display:flex;gap:20px;align-items:flex-start;background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(255,255,255,.04));border:1px solid rgba(139,92,246,.28);border-radius:20px;padding:28px;margin:28px 0;}
.vpc-governance__icon{font-size:36px;flex-shrink:0;line-height:1;}
.vpc-governance h3{color:var(--vpc-violet);font-size:18px;margin-bottom:8px;}
.vpc-governance p{font-size:14.5px;margin:0;}
.vpc-int-grid{display:flex;flex-wrap:wrap;gap:10px;margin:20px 0;}
.vpc-int-badge{padding:8px 16px;border-radius:999px;font-size:13px;font-weight:700;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);color:var(--vpc-soft);}
.vpc-price-band{text-align:center;padding:36px 28px;border-radius:22px;background:linear-gradient(135deg,rgba(245,197,24,.14),rgba(34,197,94,.08));border:1px solid rgba(245,197,24,.32);margin:24px 0;}
.vpc-price-band .vpc-price{font-size:clamp(28px,4vw,42px);font-weight:900;color:var(--vpc-gold);letter-spacing:-.03em;margin-bottom:8px;}
.vpc-lead-magnet{display:grid;grid-template-columns:1fr auto;gap:24px;align-items:center;background:rgba(56,189,248,.08);border:1px solid rgba(56,189,248,.22);border-radius:20px;padding:32px;}
@media(max-width:700px){.vpc-lead-magnet{grid-template-columns:1fr;}}
.vpc-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.vpc-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.vpc-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vpc-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.vpc-faq-q::after{content:'▾';font-size:13px;color:var(--vpc-gold);flex-shrink:0;transition:transform .25s;}
.vpc-faq-item.open .vpc-faq-q::after{transform:rotate(180deg);}
.vpc-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--vpc-muted);line-height:1.72;}
.vpc-faq-item.open .vpc-faq-a{max-height:600px;padding:0 24px 20px;}
.vpc-timeline{position:relative;padding-left:40px;}
.vpc-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vpc-gold),var(--vpc-cyan));opacity:.35;border-radius:2px;}
.vpc-tl-item{position:relative;margin-bottom:32px;}
.vpc-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vpc-gold);box-shadow:0 0 0 4px rgba(245,197,24,.2);}
.vpc-calc-shell{border-radius:24px;padding:32px;background:linear-gradient(135deg,rgba(6,10,24,.95),rgba(8,11,23,.98));border:1px solid rgba(56,189,248,.25);box-shadow:0 0 60px rgba(56,189,248,.12),0 24px 64px rgba(0,0,0,.35);}
.vpc-calc-grid{display:grid;grid-template-columns:minmax(0,38%) minmax(0,62%);gap:28px;align-items:stretch;}
@media(max-width:1023px){.vpc-calc-grid{grid-template-columns:1fr;}}
.vpc-calc-form label{display:block;font-size:12px;font-weight:700;color:var(--vpc-muted);margin-bottom:6px;letter-spacing:.04em;}
.vpc-calc-form input[type="range"]{width:100%;accent-color:var(--vpc-cyan);margin-bottom:4px;}
.vpc-calc-form .vpc-field{margin-bottom:18px;}
.vpc-calc-form .vpc-val{font-size:15px;font-weight:800;color:var(--vpc-heading);}
.vpc-calc-result{margin-top:16px;padding:16px;border-radius:14px;background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.28);}
.vpc-calc-result.ok{background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.28);}
.vpc-calc-result strong{color:var(--vpc-red);font-size:18px;}
.vpc-calc-result.ok strong{color:var(--vpc-green);}
.vpc-calc-canvas-wrap{position:relative;min-height:400px;border-radius:18px;overflow:hidden;border:1px solid rgba(56,189,248,.18);background:radial-gradient(ellipse at 40% 50%,rgba(56,189,248,.06),rgba(6,10,24,.92) 70%);}
#vpc-cash-gap-calc-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
.vpc-calc-pills{display:flex;flex-wrap:wrap;gap:8px;margin-top:12px;}

.vpc-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.vpc-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.vpc-intro-text{position:relative;padding-left:20px;}
.vpc-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vpc-cyan),var(--vpc-gold));}
.vpc-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--vpc-muted);margin-bottom:1em;}
.vpc-intro-text p:last-child{margin-bottom:0;color:var(--vpc-soft);}
.vpc-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
@media(max-width:900px){.vpc-intro-grid{grid-template-columns:1fr;gap:36px;}.vpc-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.vpc-intro-kpi{grid-template-columns:1fr 1fr;}}
.vpc-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.vpc-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.vpc-toc a{display:inline-block;padding:9px 18px;background:var(--vpc-surface);border:1px solid var(--vpc-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vpc-muted);transition:border-color .2s,color .2s,background .2s;}
.vpc-toc a:hover{border-color:rgba(245,197,24,.42);color:var(--vpc-gold);background:rgba(245,197,24,.08);}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(245,197,24,.12),rgba(139,92,246,.1));border:1px solid rgba(245,197,24,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(245,197,24,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--vpc-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--vpc-btn-from),var(--vpc-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--vpc-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--vpc-cyan)!important;text-decoration:underline;text-underline-offset:3px;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
.vpc-calc-pill{padding:5px 12px;border-radius:99px;font-size:11px;font-weight:700;background:rgba(139,92,246,.12);color:#c4b5fd;border:1px solid rgba(139,92,246,.25);}
</style>

<div class="vpc-content">

  <!-- Intro: лид + KPI-чипы -->
  <section class="vpc-intro" id="intro" aria-label="Введение">
    <div class="vpc-cnt">
      <div class="vpc-intro-grid nero-ai-reveal">
        <div class="vpc-intro-text">
          <p class="vpc-eyebrow" style="margin-bottom:12px;">Лонгрид · AI-казначейство</p>
          <p><strong>Коротко:</strong> AI-платёжный календарь — не таблица в Excel, а связка 1С, банков и CRM с прогнозом реальных дат оплаты, ранними алертами по кассовым разрывам и сценариями переноса. Nero Network внедряет такой слой под ключ поверх вашего учёта — без миграции в SaaS.</p>
          <p>Если платежи сводятся вручную, разрыв часто виден за три–пять дней до критической даты — когда переговоры с банком и поставщиками уже проиграны. AI-слой пересчитывает rolling balance при каждом обновлении выписки и предлагает сценарии, пока у вас ещё есть время на действия.</p>
        </div>
        <div class="vpc-intro-kpi" aria-label="Ключевые метрики">
          <div class="vpc-kpi-card">
            <div class="kv kv--red">53%</div>
            <div class="kl">столкнулись с нехваткой средств</div>
            <div class="ks">Актион Финансы, 2026</div>
          </div>
          <div class="vpc-kpi-card">
            <div class="kv">±10%</div>
            <div class="kl">прогноз AR на месяц</div>
            <div class="ks">ориентир AI-прогноза</div>
          </div>
          <div class="vpc-kpi-card">
            <div class="kv">14+</div>
            <div class="kl">дней до разрыва в пилоте</div>
            <div class="ks">вместо 3–5 в Excel</div>
          </div>
          <div class="vpc-kpi-card">
            <div class="kv kv--red">19%</div>
            <div class="kl">одобрение краткосрочных кредитов</div>
            <div class="ks">при 34% обращений</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Оглавление -->
  <div class="vpc-toc-outer">
    <div class="vpc-cnt">
      <nav class="vpc-toc" aria-label="Оглавление статьи">
        <a href="#bol-excel">Проблема</a>
        <a href="#chto-eto">Что это</a>
        <a href="#kalkulyator">Калькулятор</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#etapy">Этапы</a>
        <a href="#ceny">Цена</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <!-- §1 Почему Excel… -->
  <section class="vpc-section" id="bol-excel">
    <div class="vpc-cnt">
      <div class="vpc-sh vpc-left nero-ai-reveal">
        <span class="vpc-eyebrow">Боль клиента</span>
        <h2>Почему Excel и ручной платёжный календарь не спасают от кассовых разрывов</h2>
        <p>Платёжный календарь в Excel — стандарт для тысяч российских компаний. На практике <strong>платежи планируются вручную, а кассовые разрывы видны поздно</strong> — за три–пять дней до критической даты.</p>
      </div>

      <div class="vpc-grid-3 nero-ai-reveal">
        <div class="vpc-card">
          <h3>SMB и услуги</h3>
          <p>Выручка приходит волнами: аванс, остаток через 30–45 дней. Клиент задерживает оплату — Excel не пересчитывает прогноз, разрыв обнаруживается, когда не хватает на УСН и зарплату.</p>
        </div>
        <div class="vpc-card nero-ai-delay-1">
          <h3>Производство</h3>
          <p>Закупка сырья, ФОТ, аренда, отгрузка с отсрочкой. Календарь живёт отдельно от производственного графика — сбой на линии сдвигает отгрузку, а платёж поставщику уже «вписан» в план.</p>
        </div>
        <div class="vpc-card nero-ai-delay-2">
          <h3>Опт и дистрибуция</h3>
          <p>Дебиторка 30–90 дней, сезонные пики, несколько юрлиц и банков. Ручной свод занимает часы; к моменту актуализации данные устарели.</p>
        </div>
      </div>

      <div class="vpc-kpi-strip nero-ai-reveal" aria-label="Статистика кассовых разрывов в России 2026">
        <div class="vpc-kpi-card">
          <div class="kv kv--red">53%</div>
          <div class="kl">компаний столкнулись с нехваткой средств</div>
          <div class="ks">Актион Финансы, 527 компаний · <a href="https://www.bfm.ru/news/607103" target="_blank" rel="noopener noreferrer">BFM</a></div>
        </div>
        <div class="vpc-kpi-card">
          <div class="kv">27%</div>
          <div class="kl">впервые или впервые за долгое время</div>
          <div class="ks"><a href="https://e-pepper.ru/blogs/news/kazhdyy-chetvertyy-biznes-v-rossii-vpervye-stolknulsya-s-kassovymi-razryvami" target="_blank" rel="noopener noreferrer">e-pepper</a></div>
        </div>
        <div class="vpc-kpi-card">
          <div class="kv kv--red">19%</div>
          <div class="kl">одобрение краткосрочных кредитов</div>
          <div class="ks">при 34% обращений · BFM</div>
        </div>
      </div>

      <div class="vpc-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Цена «слепого» кассового разрыва</h3>
        <p>Штрафы и пени, отказ в кредите, потеря доверия контрагентов, ручные «тушения пожаров». <strong>Итог:</strong> Excel показывает, <em>что вы запланировали</em>. Он не показывает, <em>когда деньги реально придут</em> — и не предлагает, что перенести.</p>
      </div>
    </div>
  </section>

  <!-- §2 Что такое AI-платёжный календарь -->
  <section class="vpc-section vpc-section-alt" id="chto-eto">
    <div class="vpc-cnt">
      <div class="vpc-sh nero-ai-reveal">
        <span class="vpc-eyebrow">Определение</span>
        <h2>Что такое <span class="vpc-gt">AI-платёжный календарь</span> и чем он отличается от обычного</h2>
        <p>Четыре слоя: единый график, прогнозный ML/LLM-слой, детектор разрывов, сценарии действий.</p>
      </div>

      <div class="vpc-table-wrap nero-ai-reveal">
        <table class="vpc-table">
          <thead>
            <tr>
              <th>Инструмент</th>
              <th>Что показывает</th>
              <th>Прогноз контрагентов</th>
              <th>Сценарии переноса</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>Excel / Sheets</td><td>Ручной план</td><td>Нет</td><td>Вручную</td></tr>
            <tr><td>SaaS (ПланФакт, Финолог)</td><td>План + факт, красные даты</td><td>Правила, без AI</td><td>Ограниченно</td></tr>
            <tr><td>1С:ERP календарь</td><td>Заявки на расход ДС</td><td>Нет</td><td>Через заявки</td></tr>
            <tr class="vpc-table-hero"><td><strong>AI-слой Nero Network</strong></td><td>План + факт + прогноз</td><td><strong>Да (ML + история)</strong></td><td><strong>What-if за секунды</strong></td></tr>
          </tbody>
        </table>
      </div>

      <div class="vpc-grid-2 nero-ai-reveal">
        <div class="vpc-scenario">
          <h3>Прогноз на основе ERP, банков, CRM</h3>
          <p>Bottom-up от каждого счёта и контрагента. Для 13-недельного горизонта AR-native прогноз точнее top-down FP&A (<a href="https://www.tesorio.com/blog/best-cash-flow-forecasting-software-in-2026-reviewed-and-compared" target="_blank" rel="noopener noreferrer">Tesorio, 2026</a>).</p>
        </div>
        <div class="vpc-scenario">
          <h3>Ранние алерты по кассовым разрывам</h3>
          <p>Не «минус 15 июля», а «с вероятностью 80% разрыв между 10 и 18 июля». Алерты в Telegram, email или CRM — пока есть время на переговоры.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══ БОРИС: визуальный блок (контраст к hero) ═══ -->
  <section id="vnedrenie-ai-platezhnyi-kalendar-boris-block" class="bvp-root" aria-label="Анимация: карта ликвидности — rolling balance, детекция кассового разрыва и сценарии переноса">
<style>
#vnedrenie-ai-platezhnyi-kalendar-boris-block.bvp-root{
  padding:56px 0 64px;
  background:linear-gradient(180deg,rgba(255,255,255,.02),rgba(56,189,248,.04));
  border-top:1px solid rgba(56,189,248,.12);
  border-bottom:1px solid rgba(56,189,248,.12);
}
#vnedrenie-ai-platezhnyi-kalendar-boris-block .bvp-cnt{
  max-width:1160px;margin:0 auto;padding:0 24px;
}
#vnedrenie-ai-platezhnyi-kalendar-boris-block .bvp-card{
  display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;overflow:hidden;
  background:linear-gradient(180deg,rgba(255,255,255,.09),rgba(255,255,255,.04));
  border:1px solid rgba(255,255,255,.12);
  box-shadow:0 10px 48px rgba(0,0,0,.35);
  min-height:480px;
}
@media(max-width:1023px){
  #vnedrenie-ai-platezhnyi-kalendar-boris-block .bvp-card{grid-template-columns:1fr;min-height:auto;}
}
#vnedrenie-ai-platezhnyi-kalendar-boris-block .bvp-lft{
  padding:40px 36px;display:flex;flex-direction:column;justify-content:center;
  border-right:1px solid rgba(255,255,255,.08);
}
@media(max-width:1023px){
  #vnedrenie-ai-platezhnyi-kalendar-boris-block .bvp-lft{border-right:none;border-bottom:1px solid rgba(255,255,255,.08);padding:32px 24px;}
}
#vnedrenie-ai-platezhnyi-kalendar-boris-block .bvp-ey{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
  color:var(--vpc-cyan,#38bdf8);margin:0 0 14px;
}
#vnedrenie-ai-platezhnyi-kalendar-boris-block .bvp-ey::before{
  content:'';width:18px;height:2px;background:var(--vpc-cyan,#38bdf8);border-radius:1px;
}
#vnedrenie-ai-platezhnyi-kalendar-boris-block .bvp-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#fff;line-height:1.28;margin:0 0 18px;
}
#vnedrenie-ai-platezhnyi-kalendar-boris-block .bvp-ul{
  list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;
}
#vnedrenie-ai-platezhnyi-kalendar-boris-block .bvp-ul li{
  display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#9aa8bd;padding-left:0;
}
#vnedrenie-ai-platezhnyi-kalendar-boris-block .bvp-ul li::before{display:none;}
#vnedrenie-ai-platezhnyi-kalendar-boris-block .bvp-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;
  background:rgba(56,189,248,.15);display:flex;align-items:center;justify-content:center;
  font-size:11px;color:#38bdf8;margin-top:1px;font-style:normal;font-weight:800;
}
#vnedrenie-ai-platezhnyi-kalendar-boris-block .bvp-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#vnedrenie-ai-platezhnyi-kalendar-boris-block .bvp-pl{
  padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
}
#vnedrenie-ai-platezhnyi-kalendar-boris-block .bvp-pl-r{background:rgba(239,68,68,.12);color:#fca5a5;border:1.5px solid rgba(239,68,68,.28);}
#vnedrenie-ai-platezhnyi-kalendar-boris-block .bvp-pl-g{background:rgba(34,197,94,.1);color:#86efac;border:1.5px solid rgba(34,197,94,.22);}
#vnedrenie-ai-platezhnyi-kalendar-boris-block .bvp-pl-c{background:rgba(56,189,248,.1);color:#7dd3fc;border:1.5px solid rgba(56,189,248,.22);}
#vnedrenie-ai-platezhnyi-kalendar-boris-block .bvp-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#vnedrenie-ai-platezhnyi-kalendar-boris-block .bvp-rgt{
  position:relative;
  background:radial-gradient(ellipse at 30% 40%,rgba(56,189,248,.08),rgba(5,7,17,.95) 72%);
  min-height:440px;overflow:hidden;
}
@media(max-width:1023px){#vnedrenie-ai-platezhnyi-kalendar-boris-block .bvp-rgt{min-height:360px;}}
#bvp-rolling-balance-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>

<div class="bvp-cnt">
  <div class="bvp-card nero-ai-reveal">
    <div class="bvp-lft">
      <span class="bvp-ey">Карта ликвидности</span>
      <h3 class="bvp-h3">Rolling balance: разрыв виден за недели, а не за дни</h3>
      <ul class="bvp-ul">
        <li><span class="bvp-ic">↗</span>Поступления AR сдвигаются по истории просрочек контрагента</li>
        <li><span class="bvp-ic">↘</span>Выплаты AP, ФОТ и налоги на фиксированных датах</li>
        <li><span class="bvp-ic">!</span>Красная зона — нижняя граница доверительного коридора &lt; 0</li>
        <li><span class="bvp-ic">↻</span>Сценарий «перенос поставщику А» пересчитывает кривую за секунды</li>
      </ul>
      <div class="bvp-pills">
        <span class="bvp-pl bvp-pl-r">Разрыв −18 дн.</span>
        <span class="bvp-pl bvp-pl-g">Прогноз AR ±10%</span>
        <span class="bvp-pl bvp-pl-c">3 сценария what-if</span>
      </div>
      <p class="bvp-foot">Дальше — калькулятор: проверьте разрыв на своих цифрах →</p>
    </div>
    <div class="bvp-rgt">
      <canvas id="bvp-rolling-balance-canvas" role="img" aria-label="Анимация: график rolling balance с доверительным коридором, красной зоной кассового разрыва и ветками сценариев переноса"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bvp-rolling-balance-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 440;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    grid:'rgba(255,255,255,.06)', axis:'rgba(255,255,255,.25)',
    line:'#38bdf8', band:'rgba(56,189,248,.12)',
    gap:'rgba(239,68,68,.18)', gapLine:'#ef4444',
    green:'#22c55e', gold:'#f5c518', violet:'#8b5cf6',
    text:'#9aa8bd', white:'#e6edf7'
  };

  var DAYS = 30;
  function genBase(){
    var bal = 4.2, arr = [];
    for (var d = 0; d < DAYS; d++) {
      var inflow = (d % 7 === 2) ? 1.1 : (d % 5 === 0 ? 0.6 : 0.15);
      var outflow = (d === 8) ? 2.8 : (d === 15) ? 1.9 : (d === 22) ? 2.2 : (d % 4 === 1 ? 0.5 : 0.2);
      bal = bal + inflow - outflow;
      arr.push({d:d, mid:bal, lo:bal - 0.35 - Math.random()*0.15, hi:bal + 0.25});
    }
    return arr;
  }
  var data = genBase();
  var gapStart = 12, gapEnd = 17;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ctx.fillStyle=fill;ctx.fill();}
    if(stroke){ctx.strokeStyle=stroke;ctx.lineWidth=lw||1;ctx.stroke();}
  }

  function draw(){
    ctx.clearRect(0,0,W,H);
    var pad = {l:52,r:20,t:36,b:44};
    var gw = W - pad.l - pad.r, gh = H - pad.t - pad.b;
    var minY = -1.2, maxY = 5.5;
    function y(v){ return pad.t + gh - ((v - minY) / (maxY - minY)) * gh; }
    function x(i){ return pad.l + (i / (DAYS-1)) * gw; }

    for (var g = 0; g <= 5; g++) {
      var gy = pad.t + (g/5)*gh;
      ctx.strokeStyle = C.grid; ctx.lineWidth = 1;
      ctx.beginPath(); ctx.moveTo(pad.l, gy); ctx.lineTo(W-pad.r, gy); ctx.stroke();
      ctx.fillStyle = C.text; ctx.font = '10px Inter,sans-serif'; ctx.textAlign = 'right';
      ctx.fillText((maxY - g*(maxY-minY)/5).toFixed(1)+'M', pad.l-6, gy+4);
    }

    ctx.fillStyle = C.gap;
    rr(x(gapStart)-4, pad.t, x(gapEnd)-x(gapStart)+8, gh, 6, C.gap, null);

    ctx.beginPath();
    for (var i = 0; i < DAYS; i++) {
      if (i===0) ctx.moveTo(x(i), y(data[i].hi));
      else ctx.lineTo(x(i), y(data[i].hi));
    }
    for (var j = DAYS-1; j >= 0; j--) ctx.lineTo(x(j), y(data[j].lo));
    ctx.closePath(); ctx.fillStyle = C.band; ctx.fill();

    var pulse = 0.5 + 0.5*Math.sin(frame*0.04);
    ctx.strokeStyle = C.gapLine; ctx.lineWidth = 2 + pulse;
    ctx.setLineDash([6,4]);
    ctx.beginPath(); ctx.moveTo(pad.l, y(0)); ctx.lineTo(W-pad.r, y(0)); ctx.stroke();
    ctx.setLineDash([]);

    ctx.strokeStyle = C.line; ctx.lineWidth = 2.5;
    ctx.beginPath();
    for (var k = 0; k < DAYS; k++) {
      var py = y(data[k].mid);
      if (k===0) ctx.moveTo(x(k), py); else ctx.lineTo(x(k), py);
    }
    ctx.stroke();

    var scenPhase = (frame % 360) / 360;
    if (scenPhase > 0.55) {
      ctx.strokeStyle = C.green; ctx.lineWidth = 2; ctx.setLineDash([4,3]);
      ctx.beginPath();
      for (var s = gapStart; s < DAYS; s++) {
        var lift = (s >= gapStart) ? (s-gapStart)*0.18 : 0;
        var sy = y(data[s].mid + lift);
        if (s===gapStart) ctx.moveTo(x(s), sy); else ctx.lineTo(x(s), sy);
      }
      ctx.stroke(); ctx.setLineDash([]);
      ctx.fillStyle = C.green; ctx.font = 'bold 11px Inter,sans-serif'; ctx.textAlign='left';
      ctx.fillText('Сценарий: перенос AP +10 дн.', x(gapStart)+4, y(data[gapStart].mid+0.8)-8);
    }

    var dotX = x((frame*0.15) % DAYS);
    var dotI = Math.min(DAYS-1, Math.floor((frame*0.15) % DAYS));
    ctx.fillStyle = C.gold;
    ctx.beginPath(); ctx.arc(dotX, y(data[dotI].mid), 5+pulse*2, 0, Math.PI*2); ctx.fill();

    ctx.fillStyle = C.white; ctx.font = 'bold 12px Inter,sans-serif'; ctx.textAlign='left';
    ctx.fillText('Rolling balance · 30 дней', pad.l, 22);
    ctx.fillStyle = C.gapLine; ctx.font = '11px Inter,sans-serif';
    ctx.fillText('▼ кассовый разрыв', x(gapStart)+8, y(data[gapStart].mid)-14);

    ctx.fillStyle = C.text; ctx.font = '10px Inter,sans-serif'; ctx.textAlign='center';
    for (var t = 0; t < DAYS; t += 5) ctx.fillText('Д'+t, x(t), H-12);

    frame++;
    requestAnimationFrame(draw);
  }
  draw();
})();
</script>
  </section>

  <!-- §3 Калькулятор -->
  <section class="vpc-section" id="kalkulyator">
    <div class="vpc-cnt">
      <div class="vpc-sh nero-ai-reveal">
        <span class="vpc-eyebrow">Калькулятор</span>
        <h2>Калькулятор: проверьте кассовые разрывы до того, как станет поздно</h2>
        <p>Первичный скоринг: остаток, выплаты, поступления и минимальная «подушка». Полный AI-прогноз — при внедрении под ключ.</p>
      </div>

      <div class="vpc-calc-shell nero-ai-reveal">
        <div class="vpc-calc-grid">
          <div class="vpc-calc-form" id="vpc-calc-controls">
            <div class="vpc-field">
              <label for="vpc-bal">Текущий остаток, млн ₽</label>
              <input type="range" id="vpc-bal" min="0.5" max="10" step="0.1" value="3.2">
              <div class="vpc-val" id="vpc-bal-val">3,2 млн ₽</div>
            </div>
            <div class="vpc-field">
              <label for="vpc-out">Крупные выплаты за 30 дней, млн ₽</label>
              <input type="range" id="vpc-out" min="1" max="12" step="0.1" value="5.8">
              <div class="vpc-val" id="vpc-out-val">5,8 млн ₽</div>
            </div>
            <div class="vpc-field">
              <label for="vpc-in">Ожидаемые поступления, млн ₽</label>
              <input type="range" id="vpc-in" min="0.5" max="12" step="0.1" value="4.5">
              <div class="vpc-val" id="vpc-in-val">4,5 млн ₽</div>
            </div>
            <div class="vpc-field">
              <label for="vpc-cush">Минимальная «подушка», млн ₽</label>
              <input type="range" id="vpc-cush" min="0" max="3" step="0.1" value="0.8">
              <div class="vpc-val" id="vpc-cush-val">0,8 млн ₽</div>
            </div>
            <div class="vpc-calc-result" id="vpc-calc-verdict" role="status">
              <strong>⚠ Разрыв вероятен</strong>
              <p style="margin:8px 0 0;font-size:13px;">Прогнозный минимум ниже подушки на ~14-й день. Сценарий переноса AP может сдвинуть разрыв на +12 дней.</p>
            </div>
            <div class="vpc-calc-pills">
              <span class="vpc-calc-pill">Перенос поставщику B</span>
              <span class="vpc-calc-pill">Ускорить дебиторку C</span>
              <span class="vpc-calc-pill">Овердрафт</span>
            </div>
          </div>
          <div class="vpc-calc-canvas-wrap">
            <canvas id="vpc-cash-gap-calc-canvas" role="img" aria-label="График прогнозного остатка по дням с подсветкой кассового разрыва"></canvas>
          </div>
        </div>
      </div>

      <div class="vpc-grid-2 nero-ai-reveal" style="margin-top:32px;">
        <div class="vpc-scenario">
          <h3>Какие данные нужны для первичной оценки</h3>
          <p>Остатки по счетам, крупные выплаты на 30–60 дней, ожидаемые поступления, минимальная подушка. Для AI-прогноза — 6–12 месяцев выписок и дебиторка из 1С.</p>
        </div>
        <div class="vpc-scenario">
          <h3>Сценарий «перенос / рефинансирование»</h3>
          <p>Калькулятор пересчитывает rolling balance. При разрыве — дерево решений: перенос AP, ускорение AR, кредитная линия с ранжированием по «стоимости».</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA #1 после калькулятора -->
  <section class="vpc-section" style="padding-top:0;padding-bottom:clamp(48px,6vw,72px);">
    <div class="vpc-cnt">
      <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-kalkulyator">
        <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Проверьте кассовые разрывы на ваших данных</p>
          <p class="ym-cta-block__sub">За 30–60 минут разберём остатки, крупные выплаты и дебиторку — покажем, где разрыв появится раньше, чем в Excel. Без обязательств по внедрению.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

  <!-- §4 Как AI прогнозирует -->
  <section class="vpc-section vpc-section-alt" id="kak-rabotaet">
    <div class="vpc-cnt">
      <div class="vpc-sh nero-ai-reveal">
        <span class="vpc-eyebrow">Как работает</span>
        <h2>Как AI прогнозирует платежи и предлагает сценарии переноса</h2>
        <p>Шесть шагов: сбор → базовый календарь → AI-прогноз → детекция разрыва → сценарии → действие без автосписания.</p>
      </div>

      <div class="vpc-timeline nero-ai-reveal">
        <div class="vpc-tl-item"><span class="vpc-tl-dot"></span><h3>Сбор данных</h3><p>1С, банк, CRM, налоговый календарь — ночной или часовой синк.</p></div>
        <div class="vpc-tl-item"><span class="vpc-tl-dot"></span><h3>Базовый календарь</h3><p>ФОТ, аренда, налоги + плановые из заявок и договоров.</p></div>
        <div class="vpc-tl-item"><span class="vpc-tl-dot"></span><h3>AI-прогноз AR</h3><p>Дата = срок по договору + медианная задержка ± доверительный интервал.</p></div>
        <div class="vpc-tl-item"><span class="vpc-tl-dot"></span><h3>Детекция разрыва</h3><p>Rolling balance; флаг при пересечении нуля или минимального остатка.</p></div>
        <div class="vpc-tl-item"><span class="vpc-tl-dot"></span><h3>Сценарии what-if</h3><p>Перенос AP, ускорение AR, финансирование — пересчёт за секунды.</p></div>
        <div class="vpc-tl-item"><span class="vpc-tl-dot"></span><h3>Действие</h3><p>Уведомление + черновик заявки в 1С. Без автосписания без подтверждения.</p></div>
      </div>

      <div class="vpc-governance nero-ai-reveal">
        <span class="vpc-governance__icon" aria-hidden="true">🛡</span>
        <div>
          <h3>Human-in-the-loop при переносе платежей</h3>
          <p>AI <strong>предлагает</strong> — финдиректор <strong>утверждает</strong>. Налоги и зарплата — в «красной зоне» без автопереноса. Полный audit log в духе <a href="https://www.mckinsey.com/capabilities/tech-and-ai/our-insights/tech-forward/state-of-ai-trust-in-2026-shifting-to-the-agentic-era" target="_blank" rel="noopener noreferrer">McKinsey agentic AI governance 2026</a> и MAS SAFR.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- §5 Внедрение -->
  <section class="vpc-section" id="vnedrenie">
    <div class="vpc-cnt">
      <div class="vpc-sh nero-ai-reveal">
        <span class="vpc-eyebrow">Под ключ</span>
        <h2>Внедрение AI-платёжного календаря под ключ: что входит в услугу</h2>
        <p>Ориентир чека: <strong>250 тыс.–1 млн ₽</strong>. Проектная услуга для компаний, которым недостаточно SaaS-подписки.</p>
      </div>
      <div class="vpc-grid-3 nero-ai-reveal">
        <div class="vpc-card"><h3>Аудит казначейства</h3><p>Карта источников, шаблон календаря, скоринг исторических разрывов. 1–2 недели.</p></div>
        <div class="vpc-card"><h3>Прогноз и алерты</h3><p>Data Hub, Forecast Engine, Scenario Simulator, Telegram/email. 4–7 недель.</p></div>
        <div class="vpc-card"><h3>Обучение команды</h3><p>Регламент утверждения, практика на сценариях, передача audit log. 1 неделя.</p></div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px;text-align:center;font-size:14px;">Внедрение <strong>без программиста на стороне клиента</strong> — интеграции настраивает Nero Network; IT нужен только для доступов.</p>
    </div>
  </section>

      <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Финансовой команде нужен фундамент до пилота?</p>
          <p class="ym-cta-block__sub">Перед внедрением AI-календаря полезно понимать human-in-the-loop, интеграции с 1С и сценарии what-if — это ускоряет согласование с бухгалтерией и собственником. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
        </div>
      </aside>

  <!-- §6 Интеграции -->
  <section class="vpc-section vpc-section-alt" id="integracii">
    <div class="vpc-cnt">
      <div class="vpc-sh nero-ai-reveal">
        <span class="vpc-eyebrow">Интеграции</span>
        <h2>Интеграции: 1С, ERP, CRM, банки и BI</h2>
        <p>AI-слой поверх текущего стека — без миграции учёта.</p>
      </div>
      <div class="vpc-int-grid nero-ai-reveal" aria-label="Поддерживаемые системы">
        <span class="vpc-int-badge">1С:Бухгалтерия / УТ / ERP</span>
        <span class="vpc-int-badge">Клиент-банк</span>
        <span class="vpc-int-badge">amoCRM</span>
        <span class="vpc-int-badge">Битрикс24</span>
        <span class="vpc-int-badge">PlanFact / Финолог</span>
        <span class="vpc-int-badge">МойСклад</span>
        <span class="vpc-int-badge">Telegram</span>
        <span class="vpc-int-badge">Google Sheets / DataLens</span>
      </div>
      <div class="vpc-card nero-ai-reveal">
        <p>Штатный календарь 1С:ERP не прогнозирует просрочки дебиторки. <!-- INTERNAL-LINKS:INSERT --> Смежная услуга — <a href="/ai-1c-erp/">AI-агент для 1С/ERP</a> (документооборот и заявки); здесь фокус — <strong>прогноз, календарь, разрывы, сценарии</strong>.</p>
      </div>
    </div>
  </section>

  <!-- §7 AI-казначейство -->
  <section class="vpc-section" id="kaznachestvo">
    <div class="vpc-cnt">
      <div class="vpc-sh nero-ai-reveal">
        <span class="vpc-eyebrow">Сегменты</span>
        <h2>AI-казначейство для малого и среднего бизнеса</h2>
      </div>
      <div class="vpc-grid-3 nero-ai-reveal">
        <div class="vpc-scenario"><h3>Производство</h3><p>Закупка сырья + ФОТ + отгрузка. Связка графика закупок из 1С/МойСклад с календарём.</p></div>
        <div class="vpc-scenario"><h3>Опт</h3><p>Дебиторка 30–90 дней, сезонность, мультибанк. 9 юрлиц, 12 счетов — бухгалтер утверждает, а не набивает.</p></div>
        <div class="vpc-scenario"><h3>Услуги</h3><p>Проектные авансы, поступления по этапам CRM-сделок.</p></div>
      </div>
    </div>
  </section>

  <!-- §8 Этапы -->
  <section class="vpc-section vpc-section-alt" id="etapy">
    <div class="vpc-cnt">
      <div class="vpc-sh nero-ai-reveal">
        <span class="vpc-eyebrow">Дорожная карта</span>
        <h2>Этапы внедрения: от аудита до промышленной эксплуатации</h2>
      </div>
      <div class="vpc-timeline nero-ai-reveal">
        <div class="vpc-tl-item"><span class="vpc-tl-dot"></span><h3>Диагностика (1–2 нед.)</h3><p>Аудит, шаблон, ТЗ на интеграции, scope пилота.</p></div>
        <div class="vpc-tl-item"><span class="vpc-tl-dot"></span><h3>Пилот (2–4 нед.)</h3><p>1С + банк + CRM, витрина 30/60 дней, базовые алерты, один what-if в production.</p></div>
        <div class="vpc-tl-item"><span class="vpc-tl-dot"></span><h3>Масштабирование</h3><p>Остальные юрлица, AI Assistant, OCR счетов, SLA на прогноз.</p></div>
      </div>
    </div>
  </section>

  <!-- §9 Стоимость -->
  <section class="vpc-section" id="ceny">
    <div class="vpc-cnt">
      <div class="vpc-sh nero-ai-reveal">
        <span class="vpc-eyebrow">Стоимость</span>
        <h2>Стоимость внедрения AI-платёжного календаря</h2>
      </div>
      <div class="vpc-price-band nero-ai-reveal">
        <div class="vpc-price">250 тыс.–1 млн ₽</div>
        <p style="margin:0;color:var(--vpc-muted);">Зависит от числа юрлиц, интеграций и глубины прогноза. Точная смета — после аудита.</p>
      </div>
      <div class="vpc-card nero-ai-reveal">
        <p>Ориентиры ROI из верифицируемых источников: обработка документа 15 мин → 40 сек (<a href="https://www.klerk.ru/user/2683352/689955/" target="_blank" rel="noopener noreferrer">Клерк.ру</a>); прогноз cash flow ±8–12% на месяц (NEUROOFFICE, данные вендора). Качественно: разрыв виден <strong>за недели</strong>, а не за дни.</p>
      </div>
    </div>
  </section>

  <!-- CTA #3 после стоимости -->
  <section class="vpc-section" style="padding-top:0;padding-bottom:clamp(48px,6vw,72px);">
    <div class="vpc-cnt">
      <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-vnedrenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы внедрить AI-платёжный календарь под ключ?</p>
          <p class="ym-cta-block__sub">Ориентир 250 тыс.–1 млн ₽ в зависимости от интеграций и числа юрлиц. Следующий шаг — диагностика кассовых разрывов и дорожная карта пилота на 4–8 недель.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#kalkulyator" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Открыть калькулятор</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- §10 Кейсы -->
  <section class="vpc-section vpc-section-alt" id="keisy">
    <div class="vpc-cnt">
      <div class="vpc-sh nero-ai-reveal">
        <span class="vpc-eyebrow">Кейсы</span>
        <h2>Кейсы и примеры внедрения</h2>
        <p>Публичных независимо верифицированных кейсов «AI-платёжный календарь под ключ» в России мало — ниже смежные внедрения и честное сравнение.</p>
      </div>
      <div class="vpc-table-wrap nero-ai-reveal">
        <table class="vpc-table">
          <thead><tr><th>Решение</th><th>Сильные стороны</th><th>Ограничение</th><th>Nero Network</th></tr></thead>
          <tbody>
            <tr><td>ПланФакт</td><td>Быстрый старт, банки, красные даты</td><td>Нет AI-прогноза контрагентов</td><td>AI + кастом 1С</td></tr>
            <tr><td>Финолог</td><td>Управленческий учёт, ДДС</td><td>Без agentic-сценариев</td><td>Сценарии + под ключ</td></tr>
            <tr><td>NEUROOFFICE</td><td>Готовый агент прогноза</td><td>Каталог, не кастом</td><td>Проект под ваш стек</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- §11 Шаблон -->
  <section class="vpc-section" id="shablon">
    <div class="vpc-cnt">
      <div class="vpc-lead-magnet nero-ai-reveal">
        <div>
          <span class="vpc-eyebrow">Лид-магнит</span>
          <h2 style="font-size:clamp(22px,3vw,32px);margin-bottom:10px;">Шаблон платёжного календаря — бесплатно</h2>
          <p>Колонки: дата, контрагент, статья ДДС, план/факт, накопленный остаток. Формула подсветки опасных дат. Инструкция для AI-аудита Nero Network.</p>
        </div>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?> style="white-space:nowrap;">Скачать шаблон</a>
      </div>
    </div>
  </section>

  <!-- §12 FAQ -->
  <section class="vpc-section vpc-section-alt" id="faq">
    <div class="vpc-cnt">
      <div class="vpc-sh nero-ai-reveal">
        <span class="vpc-eyebrow">FAQ</span>
        <h2>FAQ: внедрение AI-платёжного календаря</h2>
      </div>
      <div class="vpc-faq nero-ai-reveal" id="vpc-faq-accordion">
        <div class="vpc-faq-item"><div class="vpc-faq-q" role="button" tabindex="0">Как внедрить AI-платёжный календарь?</div><div class="vpc-faq-a">Диагностика → пилот на одном юрлице → AI-слой и алерты → governance → масштабирование. Nero Network ведёт интеграции; от клиента — доступы и 6–12 месяцев выписок.</div></div>
        <div class="vpc-faq-item"><div class="vpc-faq-q" role="button" tabindex="0">Сколько стоит?</div><div class="vpc-faq-a">Ориентир 250 тыс.–1 млн ₽. Точная смета — после аудита. AI-слой может работать поверх PlanFact/Финолог.</div></div>
        <div class="vpc-faq-item"><div class="vpc-faq-q" role="button" tabindex="0">Можно ли без программиста?</div><div class="vpc-faq-a">Да. Интеграции выполняет Nero Network. IT нужен для доступов к 1С и банку.</div></div>
        <div class="vpc-faq-item"><div class="vpc-faq-q" role="button" tabindex="0">Как связать с CRM и 1С?</div><div class="vpc-faq-a">OData/обмен 1С, API amoCRM/Битрикс24. CRM — pipeline для прогноза; 1С — дебиторка и заявки. Подробнее — <a href="/ai-1c-erp/">AI-агент для 1С</a>.</div></div>
        <div class="vpc-faq-item"><div class="vpc-faq-q" role="button" tabindex="0">Насколько безопасно доверять AI перенос платежей?</div><div class="vpc-faq-a">AI не подписывает платёжки. Критические платежи не переносятся автоматически. Все решения — в audit log.</div></div>
        <div class="vpc-faq-item"><div class="vpc-faq-q" role="button" tabindex="0">Подходит ли для производства и опта?</div><div class="vpc-faq-a">Да: производство — закупки + ФОТ + отгрузки; опт — длинная дебиторка, сезонность, мультибанк.</div></div>
      </div>
    </div>
  </section>

</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('vpc-cash-gap-calc-canvas');
  var balEl = document.getElementById('vpc-bal');
  var outEl = document.getElementById('vpc-out');
  var inEl = document.getElementById('vpc-in');
  var cushEl = document.getElementById('vpc-cush');
  if (!cv || !balEl) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0;

  function fmt(v){ return v.toFixed(1).replace('.',',') + ' млн ₽'; }

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 500;
    cv.height = p.clientHeight || 400;
    W = cv.width; H = cv.height;
    redraw();
  }
  window.addEventListener('resize', resize);

  function sim(){
    var bal0 = parseFloat(balEl.value);
    var totalOut = parseFloat(outEl.value);
    var totalIn = parseFloat(inEl.value);
    var cush = parseFloat(cushEl.value);
    var days = 30, pts = [];
    for (var d = 0; d < days; d++) {
      var inD = totalIn * (0.03 + 0.04*Math.sin(d*0.4));
      var outD = totalOut * (0.025 + 0.05*Math.cos(d*0.35 + 1));
      if (d === 10) outD += totalOut * 0.25;
      if (d === 20) outD += totalOut * 0.2;
      bal0 = bal0 + inD - outD;
      pts.push(bal0);
    }
    var min = Math.min.apply(null, pts);
    var gapDay = pts.findIndex(function(v){ return v < cush; });
    return {pts:pts, min:min, cush:cush, gapDay:gapDay};
  }

  function redraw(){
    var s = sim();
    var pad = {l:48,r:16,t:28,b:36};
    var gw = W-pad.l-pad.r, gh = H-pad.t-pad.b;
    var maxV = Math.max.apply(null, s.pts.concat([s.cush])) + 0.5;
    var minV = Math.min.apply(null, s.pts.concat([0])) - 0.5;
    function y(v){ return pad.t + gh - ((v-minV)/(maxV-minV))*gh; }
    function x(i){ return pad.l + (i/29)*gw; }

    ctx.clearRect(0,0,W,H);
    ctx.fillStyle = '#e6edf7'; ctx.font = 'bold 12px Inter,sans-serif'; ctx.textAlign='left';
    ctx.fillText('Прогноз остатка · 30 дней', pad.l, 18);

    ctx.strokeStyle = 'rgba(255,255,255,.08)'; ctx.lineWidth = 1;
    for (var g = 0; g <= 4; g++) {
      var gy = pad.t + (g/4)*gh;
      ctx.beginPath(); ctx.moveTo(pad.l,gy); ctx.lineTo(W-pad.r,gy); ctx.stroke();
    }

    ctx.fillStyle = 'rgba(239,68,68,.15)';
    for (var i = 0; i < s.pts.length; i++) {
      if (s.pts[i] < s.cush) {
        ctx.fillRect(x(i)-gw/60, y(s.pts[i]), gw/30, y(s.cush)-y(s.pts[i]));
      }
    }

    ctx.strokeStyle = '#f5c518'; ctx.setLineDash([5,4]); ctx.lineWidth = 1.5;
    ctx.beginPath(); ctx.moveTo(pad.l, y(s.cush)); ctx.lineTo(W-pad.r, y(s.cush)); ctx.stroke();
    ctx.setLineDash([]);

    ctx.strokeStyle = '#38bdf8'; ctx.lineWidth = 2.5;
    ctx.beginPath();
    for (var j = 0; j < s.pts.length; j++) {
      if (j===0) ctx.moveTo(x(j), y(s.pts[j])); else ctx.lineTo(x(j), y(s.pts[j]));
    }
    ctx.stroke();

    if (s.gapDay >= 0) {
      ctx.fillStyle = '#ef4444';
      ctx.beginPath(); ctx.arc(x(s.gapDay), y(s.pts[s.gapDay]), 6, 0, Math.PI*2); ctx.fill();
    }

    var verdict = document.getElementById('vpc-calc-verdict');
    if (verdict) {
      if (s.gapDay >= 0) {
        verdict.className = 'vpc-calc-result';
        verdict.innerHTML = '<strong>⚠ Разрыв на день '+(s.gapDay+1)+'</strong><p style="margin:8px 0 0;font-size:13px;">Минимум '+s.min.toFixed(2)+' млн ₽ — ниже подушки '+s.cush.toFixed(1)+' млн. Сценарий переноса AP может сдвинуть разрыв.</p>';
      } else {
        verdict.className = 'vpc-calc-result ok';
        verdict.innerHTML = '<strong>✓ Подушка сохраняется</strong><p style="margin:8px 0 0;font-size:13px;">Минимум '+s.min.toFixed(2)+' млн ₽ выше порога. Для точного прогноза — аудит с историей контрагентов.</p>';
      }
    }
  }

  function bind(el, valId){
    el.addEventListener('input', function(){
      document.getElementById(valId).textContent = fmt(parseFloat(el.value));
      redraw();
    });
  }
  bind(balEl,'vpc-bal-val'); bind(outEl,'vpc-out-val'); bind(inEl,'vpc-in-val'); bind(cushEl,'vpc-cush-val');
  document.getElementById('vpc-bal-val').textContent = fmt(parseFloat(balEl.value));
  document.getElementById('vpc-out-val').textContent = fmt(parseFloat(outEl.value));
  document.getElementById('vpc-in-val').textContent = fmt(parseFloat(inEl.value));
  document.getElementById('vpc-cush-val').textContent = fmt(parseFloat(cushEl.value));
  resize();

  var faq = document.getElementById('vpc-faq-accordion');
  if (faq) {
    faq.addEventListener('click', function(e){
      var q = e.target.closest('.vpc-faq-q');
      if (!q) return;
      var item = q.parentElement;
      var open = item.classList.contains('open');
      faq.querySelectorAll('.vpc-faq-item').forEach(function(i){ i.classList.remove('open'); });
      if (!open) item.classList.add('open');
    });
  }
})();
</script>

<!-- SCHEMA-MARKUP:INSERT -->

<script>
(function(){
  'use strict';
  var root = document.querySelector('.vpc-content');
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
  var heroReveals = document.querySelectorAll('.vpc-hero-calendar .nero-ai-reveal');
  heroReveals.forEach(function(el){ el.classList.add('nero-ai-active'); });
})();
</script>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

<?php
/**
 * Template Name: AI статус заказа: внедрение уведомлений о доставке под ключ
 * Description: SEO-лендинг — AI-уведомления о статусе заказа и доставки. WISMO, интеграции CRM/СДЭК, кейсы.
 */

$page_seo_title       = 'AI статус заказа: внедрение уведомлений о доставке под ключ';
$page_seo_description = 'Внедрение AI-уведомлений о статусе заказа: SMS, push, Telegram, CRM и службы доставки. Снижаем обращения «где заказ» — настройка под ключ для e-commerce.';

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
    ['label' => 'WISMO', 'href' => '#wismo'],
    ['label' => 'Решение', 'href' => '#reshenie'],
    ['label' => 'Сценарии', 'href' => '#scenarii'],
    ['label' => 'Каналы', 'href' => '#kanaly'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Настроить статусные уведомления';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);

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
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,
.entry-header,.page-title-section { display: none !important; }
#primary,.site-main,.site-content,#content,.content-area {
  padding-top: 0 !important;
  margin-top: 0 !important;
}
.asz-hero-status-zakaza.nero-ai-hero {
  position: relative;
  min-height: 100vh;
  min-height: 100dvh;
}
.asz-toc-outer { padding: 8px 0 32px; text-align: center; }
.asz-toc.ym-toc {
  display: inline-flex;
  flex-wrap: wrap;
  gap: 8px 10px;
  justify-content: center;
  padding: 12px 16px;
  border-radius: 999px;
  background: rgba(255,255,255,.05);
  border: 1px solid rgba(255,255,255,.1);
}
.asz-toc.ym-toc a {
  padding: 8px 14px;
  border-radius: 999px;
  font-size: 13px;
  font-weight: 700;
  color: #c7d2e5;
  text-decoration: none !important;
  border: 1px solid transparent;
  transition: border-color .2s, background .2s, color .2s;
}
.asz-toc.ym-toc a:hover {
  color: #fff;
  border-color: rgba(121,242,255,.35);
  background: rgba(121,242,255,.08);
}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-status-zakaza-page" role="main" tabindex="-1">

<section class="nero-ai-hero asz-hero-status-zakaza" id="hero" aria-labelledby="asz-hero-title">
<style>
/* ── Hero ai-status-zakaza: самодостаточные стили (без CSS темы) ── */
.asz-hero-status-zakaza {
  --asz-cyan: #79f2ff;
  --asz-violet: #8b5cf6;
  --asz-green: #22c55e;
  --asz-amber: #f59e0b;
  --asz-text: #e6edf7;
  --asz-muted: #9aa8bd;
  --asz-soft: #c7d2e5;
  --asz-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.asz-hero-status-zakaza::before {
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
.asz-hero-status-zakaza::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 720px;
  height: 720px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(34, 197, 94, .10), transparent 66%);
  filter: blur(8px);
  animation: aszHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes aszHeroGlow {
  from { opacity: .38; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.06); }
}
.asz-hero-status-zakaza .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.asz-hero-status-zakaza .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.04fr) minmax(360px, .96fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.asz-hero-status-zakaza .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(36px, 5.6vw, 68px);
  line-height: .96;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.asz-hero-status-zakaza .nero-ai-gradient-text {
  display: block;
  margin-top: .12em;
  background: linear-gradient(92deg, #fff 0%, var(--asz-cyan) 42%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.asz-hero-status-zakaza .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(34, 197, 94, 0.22);
  border-radius: 999px;
  background: rgba(34, 197, 94, 0.08);
  color: #86efac !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.asz-hero-status-zakaza .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--asz-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.asz-hero-status-zakaza .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.asz-hero-status-zakaza .nero-ai-badge {
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
.asz-hero-status-zakaza .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.asz-hero-status-zakaza .nero-ai-btn {
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
.asz-hero-status-zakaza .nero-ai-btn:hover { transform: translateY(-2px); }
.asz-hero-status-zakaza .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--asz-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.asz-hero-status-zakaza .nero-ai-btn-secondary {
  color: var(--asz-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.asz-hero-status-zakaza .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--asz-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.asz-hero-status-zakaza .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.asz-hero-status-zakaza .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.asz-hero-status-zakaza .nero-ai-dots { display: flex; gap: 7px; }
.asz-hero-status-zakaza .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.asz-hero-status-zakaza .nero-ai-dot:nth-child(1) { background: #fb7185; }
.asz-hero-status-zakaza .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.asz-hero-status-zakaza .nero-ai-dot:nth-child(3) { background: #34d399; }
.asz-hero-status-zakaza .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.asz-hero-status-zakaza .nero-ai-window-body { padding: 16px; }
.asz-hero-status-zakaza .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.asz-hero-status-zakaza .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.asz-hero-status-zakaza .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(34,197,94,.10);
  color: #bbf7d0;
  font-size: 12px;
  font-weight: 800;
  white-space: nowrap;
}
.asz-hero-status-zakaza .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: aszPulse 1.6s infinite;
}
@keyframes aszPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.asz-hero-status-zakaza .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.asz-hero-status-zakaza .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.asz-hero-status-zakaza .nero-ai-metric span {
  display: block;
  color: var(--asz-muted);
  font-size: 11px;
  font-weight: 700;
}
.asz-hero-status-zakaza .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.asz-hero-status-zakaza .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.asz-hero-status-zakaza .asz-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(34, 197, 94, 0.16);
  background: radial-gradient(ellipse at 50% 42%, rgba(34,197,94,.08), rgba(6,10,24,.92) 72%);
}
.asz-hero-status-zakaza #asz-status-zakaza-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.asz-hero-status-zakaza .nero-ai-task-stream {
  display: grid;
  gap: 8px;
}
.asz-hero-status-zakaza .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.asz-hero-status-zakaza .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(34,197,94,.12);
  color: var(--asz-green);
  font-size: 11px;
  font-weight: 800;
}
.asz-hero-status-zakaza .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.asz-hero-status-zakaza .nero-ai-task span {
  color: var(--asz-muted);
  font-size: 11px;
}
.asz-hero-status-zakaza .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.asz-hero-status-zakaza .nero-ai-status--cyan {
  background: rgba(121,242,255,.11);
  color: #a5f3fc;
}
.asz-hero-status-zakaza .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .asz-hero-status-zakaza .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .asz-hero-status-zakaza .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .asz-hero-status-zakaza .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .asz-hero-status-zakaza .nero-ai-window-body { padding: 12px; }
  .asz-hero-status-zakaza .nero-ai-task { grid-template-columns: 28px 1fr; }
  .asz-hero-status-zakaza .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

<div class="nero-ai-container nero-ai-hero-grid">
  <div class="nero-ai-hero-copy">
    <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai статус заказа</p>
    <h1 id="asz-hero-title">AI-уведомления о статусе заказа и доставки: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
    <p class="nero-ai-hero-lead">AI сообщает клиентам, где заказ и когда привезут — меньше ручных ответов в поддержке</p>
    <ul class="nero-ai-badges" aria-label="Ключевые преимущества">
      <li class="nero-ai-badge">WISMO −40–70%</li>
      <li class="nero-ai-badge">CRM+СДЭК</li>
      <li class="nero-ai-badge">Telegram/SMS</li>
      <li class="nero-ai-badge">Под ключ</li>
    </ul>
    <div class="nero-ai-btn-row">
      <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Настроить статусные уведомления</a>
      <a class="nero-ai-btn nero-ai-btn-secondary" href="#scenarii">Сценарии уведомлений</a>
    </div>
  </div>

  <div class="nero-ai-dashboard" aria-label="Демонстрация AI-статусов заказа и доставки">
    <div class="nero-ai-dashboard-shell">
      <div class="nero-ai-window-top">
        <div class="nero-ai-dots" aria-hidden="true"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
        <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
      </div>
      <div class="nero-ai-window-body">
        <div class="nero-ai-dashboard-title">
          <h3>Статусы заказа · демо</h3>
          <span class="nero-ai-live-pill">онлайн</span>
        </div>
        <div class="nero-ai-metrics-grid" aria-label="Метрики демо-контура">
          <div class="nero-ai-metric">
            <span>WISMO</span>
            <strong>21%</strong>
            <small>до внедрения*</small>
          </div>
          <div class="nero-ai-metric">
            <span>Ответ AI</span>
            <strong>3 сек</strong>
            <small>«где посылка?»</small>
          </div>
          <div class="nero-ai-metric">
            <span>Touchpoints</span>
            <strong>7</strong>
            <small>этапов заказа</small>
          </div>
          <div class="nero-ai-metric">
            <span>Нагрузка</span>
            <strong>−50%</strong>
            <small>на поддержку*</small>
          </div>
        </div>

        <div class="asz-dash-canvas-wrap">
          <canvas id="asz-status-zakaza-canvas" role="img" aria-label="Анимация: webhook СДЭК синхронизирует статусы, AI отвечает на WISMO и шлёт уведомление в Telegram"></canvas>
        </div>

        <div class="nero-ai-task-stream" aria-label="Лента событий статусов">
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">WH</span>
            <div><strong>WEBHOOK СДЭК ORDER_STATUS</strong><span>CRM обновлён · Telegram клиенту</span></div>
            <span class="nero-ai-status">отправлено</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">AI</span>
            <div><strong>Ответ «где посылка?»</strong><span>Трек + ETA из CRM и API перевозчика</span></div>
            <span class="nero-ai-status nero-ai-status--cyan">3 сек</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">!</span>
            <div><strong>PUSH задержка до тикета</strong><span>Нет скана 48 ч · проактивный алерт</span></div>
            <span class="nero-ai-status nero-ai-status--amber">алерт</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<script>
/**
 * asz-status-zakaza-engine — Диспетчерская WISMO
 * Мир: маршруты доставки → башня статусов → AI-ответ → Telegram
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("asz-status-zakaza-canvas");
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
    route: "rgba(34,197,94,0.28)",
    routeGlow: "rgba(121,242,255,0.45)",
    hub: "#1e293b",
    hubLit: "#22c55e",
    hubPending: "#334155",
    parcel: "#f8fafc",
    parcelAccent: "#79f2ff",
    truck: "#8b5cf6",
    barcode: "#e2e8f0",
    tg: "#38bdf8",
    webhook: "#f59e0b",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0",
    pvz: "#a7f3d0"
  };

  var bubbles = [];
  function createBubble(text, x, y) {
    bubbles.push({ text: text, x: x, y: y, life: 90, max: 90 });
  }

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

  /* Маршрутные дуги — транспорт посылок (не конвейер, не орбиты писем) */
  function RoutePulseStream() {
    this.pulse = 0;
  }
  RoutePulseStream.prototype.draw = function (ctx) {
    this.pulse = (frame * 0.03) % (Math.PI * 2);
    var routes = [
      { x1: -140, y1: 40, cx: -40, cy: -50, x2: 30, y2: -30, col: C.routeGlow },
      { x1: 30, y1: -30, cx: 90, cy: 20, x2: 130, y2: 55, col: C.route },
      { x1: -120, y1: 60, cx: 0, cy: 70, x2: 120, y2: 50, col: C.route }
    ];
    routes.forEach(function (r, i) {
      ctx.strokeStyle = r.col;
      ctx.lineWidth = i === 0 ? 2.2 : 1.4;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * (0.35 + i * 0.1);
      ctx.beginPath();
      ctx.moveTo(r.x1, r.y1);
      ctx.quadraticCurveTo(r.cx, r.cy, r.x2, r.y2);
      ctx.stroke();
      ctx.setLineDash([]);
    });

    for (var p = 0; p < 4; p++) {
      var t = (this.pulse + p * 1.57) % (Math.PI * 2);
      var rt = t / (Math.PI * 2);
      var px, py;
      if (rt < 0.45) {
        var u = rt / 0.45;
        px = -140 + u * 170;
        py = 40 + u * (-70);
      } else if (rt < 0.75) {
        var v = (rt - 0.45) / 0.3;
        px = 30 + v * 100;
        py = -30 + v * 85;
      } else {
        var w = (rt - 0.75) / 0.25;
        px = 130 - w * 80;
        py = 55 - w * 20;
      }
      drawParcel(ctx, px, py, 11, p === 1);
    }

    /* Мини-грузовик на среднем маршруте */
    var truckT = (frame * 0.02) % 1;
    var tx = -120 + truckT * 240;
    var ty = 58 + Math.sin(truckT * Math.PI) * -12;
    drawTruck(ctx, tx, ty);
  };

  function drawParcel(ctx, x, y, s, highlight) {
    ctx.save();
    ctx.translate(x, y);
    drawRR(ctx, -s, -s * 0.7, s * 2, s * 1.4, 2, highlight ? C.parcelAccent : C.parcel, "#64748b");
    ctx.strokeStyle = highlight ? "#fff" : "#94a3b8";
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.moveTo(-s, 0);
    ctx.lineTo(s, 0);
    ctx.stroke();
    ctx.restore();
  }

  function drawTruck(ctx, x, y) {
    ctx.save();
    ctx.translate(x, y);
    drawRR(ctx, -14, -8, 28, 14, 3, C.truck, "#c4b5fd");
    drawRR(ctx, 8, -12, 10, 8, 2, C.hub, "#94a3b8");
    ctx.fillStyle = "#fff";
    ctx.beginPath();
    ctx.arc(-6, 8, 3, 0, Math.PI * 2);
    ctx.arc(8, 8, 3, 0, Math.PI * 2);
    ctx.fill();
    ctx.restore();
  }

  /* Башня статусов — вместо WebsiteTerminal / CrmDealForge */
  function OrderStatusHub() {
    this.litStage = 0;
  }
  OrderStatusHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    var stages = ["Создан", "Оплачен", "Собран", "СДЭК", "В пути", "Курьер", "Доставлен"];
    this.litStage = Math.min(stages.length - 1, Math.floor(prg / 32));

    drawRR(ctx, -38, -78, 76, 156, 10, C.hub, "#475569");

    stages.forEach(function (label, i) {
      var sy = -62 + i * 20;
      var lit = i <= this.litStage;
      var active = i === this.litStage;
      ctx.fillStyle = lit ? (active ? C.hubLit : "rgba(34,197,94,0.45)") : C.hubPending;
      ctx.beginPath();
      ctx.arc(-22, sy, active ? 5 : 4, 0, Math.PI * 2);
      ctx.fill();
      if (active) {
        ctx.strokeStyle = "rgba(34,197,94," + (0.5 + Math.sin(frame * 0.12) * 0.3) + ")";
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.arc(-22, sy, 9 + Math.sin(frame * 0.1) * 2, 0, Math.PI * 2);
        ctx.stroke();
      }
      ctx.fillStyle = lit ? "#fff" : "#64748b";
      ctx.font = (active ? "bold " : "") + "7px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(label, -10, sy + 3);
    }, this);

    /* Штрихкод трек-номера */
    if (prg > 40 && prg < 200) {
      var bx = 48 + Math.sin(frame * 0.06) * 3;
      drawRR(ctx, bx, -50, 42, 18, 3, "#0f172a", C.barcode);
      for (var b = 0; b < 7; b++) {
        ctx.fillStyle = C.barcode;
        ctx.fillRect(bx + 4 + b * 5, -46, 2 + (b % 2), 10);
      }
      ctx.fillStyle = "#94a3b8";
      ctx.font = "6px monospace";
      ctx.textAlign = "center";
      ctx.fillText("CDEK·48291", bx + 21, -32);
    }

    /* Фазы цикла */
    if (prg >= 55 && prg < 95) {
      createBubble("WEBHOOK ORDER_STATUS", 95, -55);
      ctx.fillStyle = "rgba(245,158,11," + (0.35 + Math.sin(frame * 0.15) * 0.2) + ")";
      ctx.beginPath();
      ctx.arc(95, -55, 12 + Math.sin(frame * 0.1) * 4, 0, Math.PI * 2);
      ctx.fill();
    }
    if (prg >= 100 && prg < 150) {
      drawRR(ctx, -95, 10, 52, 28, 8, "rgba(15,23,42,0.9)", C.tg);
      ctx.fillStyle = C.tg;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Где заказ?", -69, 22);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "6px Inter,sans-serif";
      ctx.fillText("ETA 14–18", -69, 32);
    }
    if (prg >= 155 && prg < 210) {
      var alertA = 0.4 + Math.sin(frame * 0.18) * 0.25;
      ctx.strokeStyle = "rgba(245,158,11," + alertA + ")";
      ctx.lineWidth = 2;
      ctx.setLineDash([3, 4]);
      ctx.beginPath();
      ctx.moveTo(0, 78);
      ctx.lineTo(0, 105);
      ctx.stroke();
      ctx.setLineDash([]);
    }
    if (prg >= 215) {
      var fin = Math.min(1, (prg - 215) / 30);
      ctx.strokeStyle = "rgba(34,197,94," + (0.9 - fin * 0.7) + ")";
      ctx.lineWidth = 3;
      ctx.beginPath();
      ctx.arc(0, 50, 25 + fin * 55, 0, Math.PI * 2);
      ctx.stroke();
      if (prg > 228 && prg < 235) createBubble("Доставлено ✓", 0, -95);
    }

    /* ПВЗ-метка */
    if (prg > 120) {
      ctx.fillStyle = C.pvz;
      ctx.beginPath();
      ctx.moveTo(118, 42);
      ctx.lineTo(126, 50);
      ctx.lineTo(118, 58);
      ctx.lineTo(110, 50);
      ctx.closePath();
      ctx.fill();
      ctx.fillStyle = "#064e3b";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("ПВЗ", 118, 53);
    }
  };

  function Agent(x, y, color, role, dialogs) {
    this.x = x; this.y = y; this.color = color; this.role = role;
    this.dialogs = dialogs;
    this.stepTrig = Math.random() * 200;
    this.bubbleTimer = 0;
    this.tx = x; this.ty = y;
  }
  Agent.prototype.draw = function (ctx) {
    this.stepTrig = (this.stepTrig + 0.6) % 200;
    var phase = (frame * 0.038) % 260;
    if (phase < 80) { this.tx = -105; this.ty = 25; }
    else if (phase < 140) { this.tx = 100; this.ty = -15; }
    else if (phase < 200) { this.tx = -90; this.ty = -40; }
    else { this.tx = 85; this.ty = 45; }
    this.x += (this.tx - this.x) * 0.04;
    this.y += (this.ty - this.y) * 0.04;
    var bob = Math.sin(frame * 0.08 + this.role.charCodeAt(0)) * 2;
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(this.x, this.y + bob, 7, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillStyle = "#fff";
    ctx.beginPath();
    ctx.arc(this.x, this.y + bob - 9, 5, 0, Math.PI * 2);
    ctx.fill();
    this.bubbleTimer++;
    if (this.bubbleTimer > 140 + Math.random() * 80) {
      this.bubbleTimer = 0;
      var msg = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
      createBubble(msg, this.x, this.y - 22);
    }
  };

  var agents = [
    new Agent(-115, 0, C.agentYellow, "1_architect", ["Карта триггеров CRM", "7 touchpoints", "Событие→канал"]),
    new Agent(115, -20, C.agentGreen, "2_seo", ["WISMO −40%", "Статус в выдаче", "Проактив > реактив"]),
    new Agent(-100, -55, C.agentBlue, "3_coder", ["ORDER_STATUS hook", "СДЭК API 2.0", "Синк трека"]),
    new Agent(105, 35, C.agentPink, "4_designer", ["SMS у курьера", "Тон бренда", "Telegram кнопки"]),
    new Agent(0, 75, C.agentPurple, "5_deployer", ["Пилот 2–3 нед.", "KPI WISMO rate", "Production QA"])
  ];

  var routeStream = new RoutePulseStream();
  var statusHub = new OrderStatusHub();

  function drawBubbles(ctx) {
    bubbles = bubbles.filter(function (b) { return b.life > 0; });
    bubbles.forEach(function (b) {
      b.life--;
      var a = b.life / b.max;
      ctx.font = "bold 8px Inter,sans-serif";
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 18, tw, 16, 6, "rgba(15,23,42," + (a * 0.92) + ")", "rgba(121,242,255," + (a * 0.5) + ")");
      ctx.fillStyle = "rgba(226,232,240," + a + ")";
      ctx.textAlign = "center";
      ctx.fillText(b.text, b.x, b.y - 6);
    });
  }

  function engineloop() {
    ctx.save();
    ctx.clearRect(0, 0, cw, ch);
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    routeStream.draw(ctx);
    statusHub.draw(ctx);
    agents.forEach(function (a) { a.draw(ctx); });
    drawBubbles(ctx);

    ctx.restore();
    frame++;
    requestAnimationFrame(engineloop);
  }
  engineloop();
});
</script>

<div class="asz-content">

<style>
/* === ASZ CONTENT ROOT — dark theme, prefix asz- === */
.asz-content{
  --asz-bg:#050711;--asz-bg2:#080b17;
  --asz-text:#e6edf7;--asz-muted:#9aa8bd;--asz-soft:#c7d2e5;--asz-heading:#fff;
  --asz-border:rgba(255,255,255,.10);
  --asz-accent:#79f2ff;--asz-violet:#8b5cf6;--asz-green:#22c55e;
  --asz-btn-from:#2563eb;--asz-btn-to:#7c3aed;
  --asz-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--asz-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.asz-content *,.asz-content *::before,.asz-content *::after{box-sizing:border-box;}
.asz-content p{color:var(--asz-muted);line-height:1.72;margin:0 0 1em;}
.asz-content p:last-child{margin-bottom:0;}
.asz-content h2,.asz-content h3,.asz-content h4{color:var(--asz-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.asz-content strong{color:var(--asz-soft);}
.asz-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.asz-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--asz-muted);font-size:14.5px;line-height:1.65;}
.asz-content ul li::before{content:'›';position:absolute;left:0;color:var(--asz-accent);font-weight:700;}
.asz-cnt{width:min(var(--asz-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.asz-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.asz-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.asz-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.asz-sh.asz-left{margin-left:0;text-align:left;}
.asz-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.asz-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.asz-sh.asz-left p{margin-left:0;}
.asz-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--asz-accent);margin-bottom:14px;}
.asz-gt{background:linear-gradient(92deg,#fff 0%,var(--asz-accent) 44%,var(--asz-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.asz-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.asz-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.asz-intro-text{position:relative;padding-left:20px;}
.asz-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--asz-accent),var(--asz-violet));}
.asz-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;}
.asz-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.asz-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px);}
.asz-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--asz-heading);line-height:1;margin-bottom:5px;}
.asz-kpi-card .kl{font-size:11px;font-weight:600;color:var(--asz-muted);line-height:1.4;}
.asz-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.asz-intro-grid{grid-template-columns:1fr;gap:36px;}.asz-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.asz-intro-kpi{grid-template-columns:1fr 1fr;}}
.asz-callout{background:rgba(121,242,255,.06);border:1px solid rgba(121,242,255,.22);border-radius:16px;padding:24px 28px;margin:28px 0;}
.asz-callout p{margin:0;font-size:15px;color:var(--asz-soft);}
.asz-callout strong{color:var(--asz-accent);}
.asz-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
.asz-grid-2{display:grid;grid-template-columns:repeat(2,1fr);gap:20px;}
@media(max-width:900px){.asz-grid-3,.asz-grid-2{grid-template-columns:1fr;}}
.asz-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:28px;transition:border-color .2s,transform .2s;}
.asz-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.asz-card h3{font-size:17px;margin-bottom:12px;}
.asz-table-wrap{overflow-x:auto;margin:24px 0;border-radius:16px;border:1px solid rgba(255,255,255,.08);}
.asz-table{width:100%;border-collapse:collapse;font-size:14px;min-width:520px;}
.asz-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--asz-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);position:sticky;top:0;}
.asz-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--asz-text);vertical-align:top;}
.asz-table tbody tr:nth-child(even) td{background:rgba(255,255,255,.02);}
.asz-table tr:last-child td{border-bottom:none;}
.asz-stat{display:inline-block;padding:2px 10px;border-radius:6px;border:1px solid rgba(121,242,255,.35);color:var(--asz-accent);font-weight:800;font-size:.95em;}
.asz-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08);}
.asz-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(121,242,255,.1);color:var(--asz-accent);border:1px solid rgba(121,242,255,.2);}
.asz-flow .arr{color:var(--asz-muted);font-size:16px;padding:0 4px;background:none;border:none;}
.asz-chips{display:flex;flex-wrap:wrap;gap:8px;margin:20px 0;}
.asz-chip{padding:6px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);color:var(--asz-soft);}
.asz-timeline{position:relative;padding-left:40px;max-width:760px;}
.asz-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--asz-accent),var(--asz-violet));opacity:.35;border-radius:2px;}
.asz-tl-item{position:relative;margin-bottom:32px;}
.asz-tl-item:last-child{margin-bottom:0;}
.asz-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--asz-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.asz-tl-item h3{font-size:17px;margin-bottom:8px;}
.asz-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.asz-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.asz-case-grid{grid-template-columns:1fr;}}
.asz-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;}
.asz-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--asz-green);margin-bottom:10px;}
.asz-case-card h3{font-size:16px;margin-bottom:14px;}
.asz-metric{display:flex;align-items:baseline;gap:8px;margin-top:8px;}
.asz-metric .num{font-size:20px;font-weight:900;color:var(--asz-accent);}
.asz-metric .lbl{font-size:13px;color:var(--asz-muted);}
.asz-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.asz-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.asz-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--asz-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.asz-faq-q::after{content:'▾';font-size:13px;color:var(--asz-accent);flex-shrink:0;transition:transform .25s;}
.asz-faq-item.open .asz-faq-q::after{transform:rotate(180deg);}
.asz-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--asz-muted);line-height:1.72;}
.asz-faq-item.open .asz-faq-a{max-height:800px;padding:0 24px 20px;}
.asz-cta-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;list-style:none;padding:0;}
.asz-cta-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--asz-muted);}
.asz-cta-checklist li::before{content:'✓';color:var(--asz-green);font-weight:800;}
.asz-cta-final{text-align:center;padding:clamp(64px,8vw,96px) 0;}
.asz-good{color:var(--asz-green);}
.asz-neutral{color:var(--asz-muted);}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--asz-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-link--accent{color:var(--asz-accent)!important;text-decoration:underline!important;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--asz-btn-from),var(--asz-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--asz-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s}.nero-ai-delay-2{transition-delay:.24s}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

  <!-- INTRO -->
  <section class="asz-intro" id="intro" aria-label="Введение">
    <div class="asz-cnt">
      <div class="asz-intro-grid nero-ai-reveal">
        <div class="asz-intro-text">
          <p class="asz-eyebrow">ai статус заказа · внедрение под ключ</p>
          <p>Клиент оформил заказ в пятницу вечером. В понедельник утром он уже пишет в чат: «Где посылка?», «Трек не обновляется», «Курьер сегодня приедет?». Менеджер лезет в CRM, сверяет статус в кабинете СДЭК, копирует трек и отвечает вручную — по кругу, десятки раз в день. По данным DigitalGenius, около <strong class="asz-stat">21%</strong> всех обращений в поддержку e-commerce — это WISMO (<em>Where Is My Order?</em>, «где мой заказ»). В пиковые периоды доля таких тикетов у отдельных ритейлеров доходит до <strong>36%</strong>.</p>
          <p><strong>AI статус заказа</strong> и <strong>внедрение AI-уведомлений о доставке под ключ</strong> решают эту боль системно: проактивные сообщения по этапам заказа плюс AI-агент, который отвечает на свободные формулировки по данным CRM и перевозчика. Такую цепочку собирают под интернет-магазины, службы доставки и производство с отгрузками — с CRM, 1С, СДЭК и мессенджерами в одном контуре.</p>
          <p><strong>Суть в двух словах:</strong> проактивные статусы при каждой смене этапа, AI на свободные вопросы «где заказ» и единая оркестрация SMS, email, push и Telegram. MVP проактивных уведомлений — от 2–3 недель, полный контур с AI — 4–6 недель; бюджет обычно в коридоре <strong>120–350 тыс. ₽</strong>.</p>
        </div>
        <div class="asz-intro-kpi" aria-label="Ключевые метрики">
          <div class="asz-kpi-card"><div class="kv">21%</div><div class="kl">WISMO в поддержке</div><div class="ks">DigitalGenius</div></div>
          <div class="asz-kpi-card"><div class="kv">120–350</div><div class="kl">тыс. ₽ под ключ</div><div class="ks">проект Nero</div></div>
          <div class="asz-kpi-card"><div class="kv">2–3</div><div class="kl">нед. MVP статусов</div><div class="ks">проактивный контур</div></div>
          <div class="asz-kpi-card"><div class="kv">гибрид</div><div class="kl">триггеры + AI</div><div class="ks">стандарт 2026</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="asz-toc-outer">
    <div class="asz-cnt">
      <nav class="asz-toc ym-toc nero-ai-reveal" aria-label="Оглавление статьи">
        <a href="#wismo">WISMO</a>
        <a href="#reshenie">Решение</a>
        <a href="#scenarii">Сценарии</a>
        <a href="#kanaly">Каналы</a>
        <a href="#integracii">Интеграции</a>
        <a href="#etapy">Внедрение</a>
        <a href="#kpi">KPI</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Заявка</a>
      </nav>
    </div>
  </div>
  <!-- INTERNAL-LINKS:INSERT -->

  <!-- WISMO -->
  <section class="asz-section" id="wismo">
    <div class="asz-cnt">
      <div class="asz-sh asz-left nero-ai-reveal">
        <span class="asz-eyebrow">Боль WISMO</span>
        <h2>Почему клиенты спрашивают «где мой заказ» и сколько это стоит бизнесу</h2>
      </div>

      <h3 class="nero-ai-reveal">Типовые обращения в e-commerce и логистике</h3>
      <p class="nero-ai-reveal"><strong>WISMO</strong> — запрос клиента о местонахождении, сроке или статусе уже оформленного заказа. По оценкам отрасли (Salesforce Commerce, ShippyPro), на WISMO приходится <strong>от 20% до 50%</strong> объёма обращений в e-commerce.</p>
      <ul class="nero-ai-reveal">
        <li>«Где мой заказ?» / «Посылка ещё не пришла»</li>
        <li>«Трек не обновляется третий день»</li>
        <li>«Курьер сегодня? Можно перенести?»</li>
        <li>«Заказ в статусе "отправлен", но в СДЭК пусто»</li>
        <li>«Почему задержка? Обещали вчера»</li>
      </ul>

      <div class="asz-callout nero-ai-reveal" role="note">
        <p><strong>WISMO rate (%)</strong> = (число обращений WISMO ÷ общее число обращений в поддержку) × 100 — по методологии DigitalGenius. Считайте по каналам и периодам; в пиковые недели WISMO растёт на <strong>+72%</strong> к базе.</p>
      </div>

      <h3 class="nero-ai-reveal">Ручные ответы vs проактивные уведомления</h3>
      <p class="nero-ai-reveal">Ручной ответ на один WISMO-тикет занимает в среднем <strong>3–5 минут</strong> оператора. Проактивные <strong>ai уведомления доставки</strong> работают по принципу Salesforce Commerce: <em>«сообщайте клиенту, что происходит, до того как он спросит»</em>. Fortnum &amp; Mason (Narvar) снизили WISMO на <span class="asz-stat">50%</span>; Crystal Classics — звонки на <span class="asz-stat">50–60%</span> за три недели; ориентир индустрии при proactive-цепочке — <strong>снижение WISMO на 40–70%</strong> за 30–90 дней.</p>

      <h3 class="nero-ai-reveal">Когда rule-based бот перестаёт справляться</h3>
      <p class="nero-ai-reveal">Классический чат-бот ломается на свободных формулировках: «посылка застряла в Туле», «курьер звонил?». В 2026 контакт-центры смещаются к <strong>agentic AI</strong> (IBM, Gartner: к 2028 ≥70% клиентов начнут путь в поддержке через conversational AI). <strong>Итог:</strong> WISMO — измеримая боль; оптимальная модель — <strong>гибрид</strong> проактивных триггеров и AI-агента.</p>
    </div>
  </section>

  <!-- RESHENIE -->
  <section class="asz-section asz-section-alt" id="reshenie">
    <div class="asz-cnt">
      <div class="asz-sh nero-ai-reveal">
        <span class="asz-eyebrow">Решение</span>
        <h2>AI-уведомления о статусе заказа: что получает компания</h2>
        <p><strong>AI-уведомления о статусе заказа</strong> — связка из трёх слоёв: проактивные статусы, реактивный AI-агент и оркестрация каналов. Проактивные статусы часто запускают на rule-based триггерах; AI добавляет персонализацию, NLU и алерты при аномалиях.</p>
      </div>

      <div class="asz-grid-3 nero-ai-reveal">
        <div class="asz-card">
          <div class="asz-eyebrow">Слой 1</div>
          <h3>Проактивные статусы</h3>
          <p>Система пишет клиенту при смене этапа: создан → оплачен → собран → в доставку → у курьера → доставлен / задержка.</p>
        </div>
        <div class="asz-card nero-ai-delay-1">
          <div class="asz-eyebrow">Слой 2</div>
          <h3>Реактивный AI-агент</h3>
          <p><strong>AI отвечает где заказ</strong> по данным CRM/OMS и API перевозчиков после верификации клиента (read-only tools: get_order, get_tracking).</p>
        </div>
        <div class="asz-card nero-ai-delay-2">
          <div class="asz-eyebrow">Слой 3</div>
          <h3>Оркестрация каналов</h3>
          <p><strong>AI клиентские уведомления</strong> в SMS, email, push, Telegram, VK — единый tone of voice бренда.</p>
        </div>
      </div>

      <div class="asz-table-wrap nero-ai-reveal" style="margin-top:36px">
        <table class="asz-table" aria-label="Метрики до и после внедрения">
          <thead><tr><th>Метрика</th><th>До внедрения</th><th>Цель после</th></tr></thead>
          <tbody>
            <tr><td>WISMO rate</td><td>15–25%+</td><td>−40…70% за 30–90 дней</td></tr>
            <tr><td>Время ответа по статусу</td><td>минуты–часы</td><td>секунды</td></tr>
            <tr><td>Repeat contact rate</td><td>высокий</td><td>снижение</td></tr>
            <tr><td>CSAT / NPS</td><td>средний</td><td>рост за счёт прозрачности</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px;font-size:14px">Кейс CaseUp (YandexGPT + RetailCRM): <span class="asz-stat">18%</span> WISMO без человека; 60% входящих на AI; оценка 3,8→4,5 (GPTmag, 2026).</p>
    </div>
  </section>

  <!-- ===== БОРИС: CANVAS БЛОК (после #reshenie) ===== -->
  <section id="ai-status-zakaza-boris-block" class="asb-root" aria-label="Анимация: цепочка доставки и проактивные уведомления клиенту">
<style>
#ai-status-zakaza-boris-block.asb-root{padding:56px 0 64px;background:#f0f4fb;}
#ai-status-zakaza-boris-block .asb-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#ai-status-zakaza-boris-block .asb-card{display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);min-height:480px;}
@media(max-width:1023px){#ai-status-zakaza-boris-block .asb-card{grid-template-columns:1fr;min-height:auto;}}
#ai-status-zakaza-boris-block .asb-lft{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0;}
@media(max-width:1023px){#ai-status-zakaza-boris-block .asb-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}}
#ai-status-zakaza-boris-block .asb-ey{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0891b2;margin:0 0 14px;}
#ai-status-zakaza-boris-block .asb-ey::before{content:'';width:18px;height:2px;background:#0891b2;border-radius:1px;}
#ai-status-zakaza-boris-block .asb-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;}
#ai-status-zakaza-boris-block .asb-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#ai-status-zakaza-boris-block .asb-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#ai-status-zakaza-boris-block .asb-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(8,145,178,.1);display:flex;align-items:center;justify-content:center;font-size:11px;color:#0e7490;font-style:normal;}
#ai-status-zakaza-boris-block .asb-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#ai-status-zakaza-boris-block .asb-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
#ai-status-zakaza-boris-block .asb-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-status-zakaza-boris-block .asb-pl-b{background:rgba(8,145,178,.08);color:#0e7490;border:1.5px solid rgba(8,145,178,.22);}
#ai-status-zakaza-boris-block .asb-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);}
#ai-status-zakaza-boris-block .asb-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#ai-status-zakaza-boris-block .asb-rgt{position:relative;background:linear-gradient(135deg,#ecfeff 0%,#e0f2fe 45%,#f8fafc 100%);min-height:420px;overflow:hidden;}
@media(max-width:1023px){#ai-status-zakaza-boris-block .asb-rgt{min-height:360px;}}
#asb-tracking-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="asb-cnt">
  <div class="asb-card">
    <div class="asb-lft">
      <span class="asb-ey">Цепочка в движении</span>
      <h3 class="asb-h3">От CRM до курьера: клиент узнаёт статус до вопроса «где посылка?»</h3>
      <ul class="asb-ul">
        <li><span class="asb-ic">⚡</span>Webhook СДЭК <code>ORDER_STATUS</code> → middleware → обновление CRM</li>
        <li><span class="asb-ic">📱</span>Проактивный push в Telegram / SMS на каждом этапе</li>
        <li><span class="asb-ic">🤖</span>AI закрывает остаточные WISMO-формулировки в чате</li>
        <li><span class="asb-ic">⚠</span>Аномалия (нет скана 48 ч) — алерт до тикета в поддержку</li>
      </ul>
      <div class="asb-pills">
        <span class="asb-pl asb-pl-g">7 touchpoints</span>
        <span class="asb-pl asb-pl-b">3 сек ответ AI</span>
        <span class="asb-pl asb-pl-v">гибрид rule + AI</span>
      </div>
      <p class="asb-foot">Дальше — матрица сценариев уведомлений по этапам →</p>
    </div>
    <div class="asb-rgt">
      <canvas id="asb-tracking-canvas" aria-label="Анимация: посылка проходит этапы CRM, склад, СДЭК, курьер; на каждом этапе отправляется уведомление клиенту" role="img"></canvas>
    </div>
  </div>
</div>
<script>
(function(){
  'use strict';
  var cv = document.getElementById('asb-tracking-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 480;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    ink:'#0f172a', muted:'#64748b', line:'rgba(8,145,178,.25)',
    crm:'#8b5cf6', wh:'#f59e0b', cdek:'#22c55e', transit:'#3b82f6', courier:'#0891b2', done:'#16a34a',
    pkg:'#ffffff', pkgB:'#cbd5e1', pulse:'rgba(34,197,94,.35)', tg:'#0ea5e9', sms:'#f97316'
  };

  var NODES = [
    {id:'crm', label:'CRM', color:C.crm, x:0},
    {id:'wh', label:'Склад', color:C.wh, x:0},
    {id:'cdek', label:'СДЭК', color:C.cdek, x:0},
    {id:'transit', label:'В пути', color:C.transit, x:0},
    {id:'courier', label:'Курьер', color:C.courier, x:0},
    {id:'done', label:'Доставлен', color:C.done, x:0}
  ];

  function layoutNodes(){
    var pad = W * 0.08, span = W - pad * 2;
    NODES.forEach(function(n, i){
      n.x = pad + (span / (NODES.length - 1)) * i;
      n.y = H * 0.52;
    });
  }

  var pkg = { t: 0, node: 0, pulse: 0 };
  var notifs = [];

  function spawnNotif(x, y, type){
    notifs.push({ x: x, y: y - 50, type: type, life: 0, max: 70 });
  }

  function rr(x,y,w,h,r,fill,stroke){
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x,y,w,h,r); else ctx.rect(x,y,w,h);
    if (fill){ ctx.fillStyle=fill; ctx.fill(); }
    if (stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=1.5; ctx.stroke(); }
  }

  function drawNode(n, active){
    var r = Math.min(W,H)*0.038;
    ctx.globalAlpha = active ? 1 : 0.55;
    ctx.fillStyle = n.color;
    ctx.beginPath();
    ctx.arc(n.x, n.y, r, 0, Math.PI*2);
    ctx.fill();
    if (active){
      ctx.strokeStyle = n.color;
      ctx.lineWidth = 2 + Math.sin(frame*0.1)*1.5;
      ctx.globalAlpha = 0.35;
      ctx.beginPath();
      ctx.arc(n.x, n.y, r+8+Math.sin(frame*0.08)*4, 0, Math.PI*2);
      ctx.stroke();
    }
    ctx.globalAlpha = 1;
    ctx.fillStyle = C.ink;
    ctx.font = 'bold ' + Math.max(9, W*0.022) + 'px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(n.label, n.x, n.y + r + 16);
  }

  function drawPackage(x, y){
    var s = Math.min(W,H)*0.045;
    rr(x-s, y-s*0.7, s*2, s*1.4, 5, C.pkg, C.pkgB);
    ctx.strokeStyle = C.muted;
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.moveTo(x-s*0.6, y-s*0.7);
    ctx.lineTo(x, y);
    ctx.lineTo(x+s*0.6, y-s*0.7);
    ctx.stroke();
  }

  function drawNotif(nf){
    var a = 1 - nf.life / nf.max;
    ctx.globalAlpha = a;
    var col = nf.type === 'tg' ? C.tg : C.sms;
    rr(nf.x-28, nf.y-12, 56, 24, 8, '#fff', col);
    ctx.fillStyle = col;
    ctx.font = 'bold 10px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(nf.type === 'tg' ? 'Telegram' : 'SMS', nf.x, nf.y+4);
    ctx.globalAlpha = 1;
  }

  function tick(){
    frame++;
    layoutNodes();

    if (frame % 3 === 0) pkg.t += 0.008;
    if (pkg.t >= 1){
      pkg.t = 0;
      spawnNotif(NODES[pkg.node].x, NODES[pkg.node].y, frame % 2 ? 'tg' : 'sms');
      pkg.node = (pkg.node + 1) % NODES.length;
      if (pkg.node === 0) pkg.t = 0;
    }

    ctx.clearRect(0,0,W,H);

    ctx.fillStyle = C.muted;
    ctx.font = '10px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Цепочка доставки · демо', W*0.06, H*0.1);

    ctx.strokeStyle = C.line;
    ctx.lineWidth = 3;
    ctx.setLineDash([8,6]);
    ctx.beginPath();
    ctx.moveTo(NODES[0].x, NODES[0].y);
    for (var i=1;i<NODES.length;i++) ctx.lineTo(NODES[i].x, NODES[i].y);
    ctx.stroke();
    ctx.setLineDash([]);

    var prog = pkg.t;
    var i0 = pkg.node;
    var i1 = Math.min(i0 + 1, NODES.length - 1);
    var px = NODES[i0].x + (NODES[i1].x - NODES[i0].x) * prog;
    var py = NODES[i0].y + Math.sin(frame*0.06)*4;

    NODES.forEach(function(n, idx){
      drawNode(n, idx === pkg.node || idx === pkg.node + 1);
    });

    drawPackage(px, py - 28);

    notifs = notifs.filter(function(nf){
      nf.life++;
      nf.y -= 0.6;
      drawNotif(nf);
      return nf.life < nf.max;
    });

    requestAnimationFrame(tick);
  }
  requestAnimationFrame(tick);
})();
</script>
  </section>
  <!-- ===== / БОРИС ===== -->

  <!-- SCENARII -->
  <section class="asz-section" id="scenarii">
    <div class="asz-cnt">
      <div class="asz-sh nero-ai-reveal">
        <span class="asz-eyebrow">Лид-магнит</span>
        <h2>Сценарии уведомлений по этапам заказа и доставки</h2>
        <p>Готовая карта touchpoints — <strong>«Сценарии уведомлений по заказу»</strong>, которую Nero Network адаптирует под вашу CRM и перевозчиков.</p>
      </div>

      <h3 class="nero-ai-reveal">Заказ создан → оплачен → собран → передан в доставку</h3>
      <div class="asz-table-wrap nero-ai-reveal">
        <table class="asz-table" aria-label="Этапы заказа до передачи в доставку">
          <thead><tr><th>Этап</th><th>Триггер</th><th>Канал (приоритет РФ)</th><th>Смысл сообщения</th></tr></thead>
          <tbody>
            <tr><td>Заказ создан</td><td><code>order.created</code></td><td>Email / Telegram</td><td>«Приняли заказ №…, ожидаем оплату»</td></tr>
            <tr><td>Оплачен</td><td><code>payment.received</code></td><td>Push / SMS</td><td>«Оплата получена, передаём на сборку»</td></tr>
            <tr><td>Собран</td><td>статус «готов к отгрузке»</td><td>Telegram / email</td><td>«Готов к отправке, ETA отгрузки …»</td></tr>
            <tr><td>Передан в доставку</td><td>создание отправления СДЭК</td><td>SMS / Telegram</td><td>«Передали в доставку, трек: …»</td></tr>
          </tbody>
        </table>
      </div>

      <h3 class="nero-ai-reveal">В пути → у курьера → доставлен / задержка / исключение</h3>
      <div class="asz-table-wrap nero-ai-reveal">
        <table class="asz-table" aria-label="Этапы доставки и исключения">
          <thead><tr><th>Этап</th><th>Триггер</th><th>Канал</th><th>Смысл</th></tr></thead>
          <tbody>
            <tr><td>В пути</td><td>статус «в пути»</td><td>Push / SMS</td><td>«Посылка в пути, ожидаемое прибытие …»</td></tr>
            <tr><td>У курьера</td><td>webhook перевозчика</td><td>SMS</td><td>«Курьер выехал, будьте на связи»</td></tr>
            <tr><td>В ПВЗ</td><td>«ожидает в ПВЗ»</td><td>Telegram / SMS</td><td>«Можно забрать до …, адрес ПВЗ …»</td></tr>
            <tr><td>Задержка</td><td><code>DELIV_PROBLEM</code> / нет скана 48 ч</td><td>Telegram + email</td><td>«Задержка, разбираемся, новый ETA …»</td></tr>
            <tr><td>Доставлен</td><td>финальный статус</td><td>Telegram / email</td><td>«Доставлено! Оцените опыт»</td></tr>
          </tbody>
        </table>
      </div>

      <h3 class="nero-ai-reveal">Шаблоны сообщений для SMS, email, push, Telegram</h3>
      <ul class="nero-ai-reveal">
        <li><strong>SMS:</strong> «[Бренд]: заказ №12345 у курьера. Трек: cdek.ru/… Ожидайте сегодня 14–18.»</li>
        <li><strong>Email:</strong> карта, трек, branded tracking, FAQ по задержкам.</li>
        <li><strong>Telegram:</strong> кнопки «Открыть трек», «Связаться с поддержкой», «Перенести доставку».</li>
        <li><strong>Push:</strong> deep link на заказ в приложении / PWA.</li>
      </ul>
      <p class="nero-ai-reveal"><strong>AI tracking заказов</strong> и <strong>проактивные уведомления о доставке</strong> закрывают основной объём WISMO ещё до обращения клиента.</p>
    </div>
  </section>

  <!-- CTA-1 после #scenarii -->
  <div class="asz-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-scenarii">
      <div class="ym-cta-block__icon" aria-hidden="true">📦</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Получить сценарии уведомлений под вашу CRM и СДЭК</p>
        <p class="ym-cta-block__sub">Адаптируем матрицу этапов × канал × триггер под RetailCRM, amoCRM, Битрикс24 и ваших перевозчиков. Бесплатный разбор WISMO и карта статусов — за 2–3 рабочих дня.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Настроить статусные уведомления</a>
      </div>
    </div>
  </div>

  <!-- KANALY -->
  <section class="asz-section asz-section-alt" id="kanaly">
    <div class="asz-cnt">
      <div class="asz-sh nero-ai-reveal">
        <span class="asz-eyebrow">Каналы</span>
        <h2>Каналы: SMS, email, push, Telegram и WhatsApp</h2>
      </div>
      <div class="asz-table-wrap nero-ai-reveal">
        <table class="asz-table" aria-label="Сравнение каналов уведомлений">
          <thead><tr><th>Канал</th><th>Сильные стороны</th><th>Когда использовать</th></tr></thead>
          <tbody>
            <tr><td><strong>Telegram</strong></td><td>Rich-кнопки, низкая стоимость</td><td>Основной канал e-commerce в РФ 2025–2026</td></tr>
            <tr><td><strong>SMS</strong></td><td>Open rate ~98%</td><td>«У курьера», срочные алерты, 45+</td></tr>
            <tr><td><strong>Email</strong></td><td>Детали, история</td><td>Подтверждение заказа, развёрнутые статусы</td></tr>
            <tr><td><strong>Push</strong></td><td>Мгновенность</td><td>Аудитория с приложением / PWA</td></tr>
            <tr><td><strong>VK / MAX</strong></td><td>Охват в соцсетях РФ</td><td>Дублирование без Telegram</td></tr>
            <tr><td><strong>WhatsApp Business API</strong></td><td>Привычный канал</td><td>Резервный; см. ограничения РФ</td></tr>
          </tbody>
        </table>
      </div>
      <h3 class="nero-ai-reveal">Требования и ограничения для РФ</h3>
      <p class="nero-ai-reveal">С 1 июня 2025 расширены ограничения на иностранные мессенджеры для ряда категорий. Для частного e-commerce Telegram и WhatsApp возможны при соблюдении <strong>152-ФЗ</strong> и уведомления РКН. С января 2026 РКН продолжает ограничения WhatsApp — планируйте статусные уведомления в первую очередь через <strong>Telegram/SMS</strong>. Рекомендация Nero: каскад <strong>Telegram → SMS → email → VK/MAX</strong>.</p>
      <h3 class="nero-ai-reveal">Единый тон и персонализация через AI</h3>
      <p class="nero-ai-reveal">Разрозненные SMS от перевозчика и email от магазина создают шум. AI унифицирует tone of voice, адаптирует длину под канал и эскалирует негатив к оператору с summary диалога. Голосовой сценарий: ASH Russia (SaluteSpeech) подтверждает окно визита курьера — меньше холостых рейсов.</p>
    </div>
  </section>

  <!-- INTEGRACII -->
  <section class="asz-section" id="integracii">
    <div class="asz-cnt">
      <div class="asz-sh nero-ai-reveal">
        <span class="asz-eyebrow">Стек</span>
        <h2>Интеграция AI статуса заказа с CRM, ERP и службами доставки</h2>
      </div>

      <h3 class="nero-ai-reveal">CRM: amoCRM, Битрикс24</h3>
      <p class="nero-ai-reveal"><strong>Интеграция ai статус заказа с crm</strong> — RetailCRM (триггеры + webhook в Telegram), amoCRM (стадии сделок, поля «трек»), Битрикс24 (сервисный бот 5 УГЛОВ). Фокус — <strong>клиентские статусы заказа</strong>, не внутренняя автоматизация CRM. <strong>AI статус заказа с crm</strong>: CRM → middleware → перевозчик → notification router → AI-агент.</p>
      <div class="asz-chips nero-ai-reveal">
        <span class="asz-chip">RetailCRM</span><span class="asz-chip">amoCRM</span><span class="asz-chip">Битрикс24</span><span class="asz-chip">1С / ERP</span><span class="asz-chip">СДЭК API 2.0</span><span class="asz-chip">Boxberry</span><span class="asz-chip">Яндекс Доставка</span><span class="asz-chip">Ozon / WB API</span>
      </div>

      <h3 class="nero-ai-reveal">1С / ERP / WMS — статусы из backend</h3>
      <p class="nero-ai-reveal">Модули информирования из 1С шлют SMS/Telegram без AI на свободный текст. Nero добавляет обмен 1С ↔ CRM ↔ перевозчик, единую карту статусов и AI-ответы на B2B-запросы «где отгрузка по счёту №…».</p>

      <h3 class="nero-ai-reveal">СДЭК, Boxberry, Почта России, маркетплейсы</h3>
      <div class="asz-table-wrap nero-ai-reveal">
        <table class="asz-table" aria-label="Интеграции с перевозчиками">
          <thead><tr><th>Перевозчик</th><th>Интеграция</th><th>События для уведомлений</th></tr></thead>
          <tbody>
            <tr><td><strong>СДЭК</strong></td><td>API 2.0, webhooks ORDER_STATUS, DELIV_PROBLEM</td><td>В пути, проблемы, согласование</td></tr>
            <tr><td><strong>Boxberry</strong></td><td>API статусов</td><td>ПВЗ, выдача</td></tr>
            <tr><td><strong>Почта России</strong></td><td>трекинг API</td><td>Отправление, вручение</td></tr>
            <tr><td><strong>Яндекс Доставка</strong></td><td>API партнёра</td><td>Курьер, ETA</td></tr>
            <tr><td><strong>Ozon / WB</strong></td><td>Seller API</td><td>Статусы FBS/FBO для продавцов</td></tr>
          </tbody>
        </table>
      </div>

      <h3 class="nero-ai-reveal">Webhook, API и синхронизация трек-номеров</h3>
      <div class="asz-flow nero-ai-reveal" aria-label="Архитектура интеграции">
        <span>Заказ в CRM</span><span class="arr">→</span>
        <span>API СДЭК + трек</span><span class="arr">→</span>
        <span>Webhook статуса</span><span class="arr">→</span>
        <span>Уведомление клиенту</span><span class="arr">→</span>
        <span>AI на WISMO</span>
      </div>
      <p class="nero-ai-reveal">Event bus (n8n, Make, FastAPI), CRM-коннектор, carrier adapter, notification router, AI orchestrator — пять модулей под ключ за <strong>4–6 недель</strong>.</p>
    </div>
  </section>

  <!-- ETAPY -->
  <section class="asz-section asz-section-alt" id="etapy">
    <div class="asz-cnt">
      <div class="asz-sh nero-ai-reveal">
        <span class="asz-eyebrow">Внедрение</span>
        <h2>Как внедрить AI-уведомления о статусе заказа под ключ</h2>
      </div>

      <div class="asz-timeline nero-ai-reveal">
        <div class="asz-tl-item"><span class="asz-tl-dot"></span><h3>Недели 1–2: аудит и карта статусов</h3><p>Доля WISMO за 3 месяца, карта статусов CRM vs перевозчик, документ «событие → канал → текст → KPI».</p></div>
        <div class="asz-tl-item"><span class="asz-tl-dot"></span><h3>Недели 2–3: проактивный контур</h3><p>Webhooks, триггеры CRM, 5–7 touchpoints. <strong>Настройка ai статус заказа</strong> на rule-based слое.</p></div>
        <div class="asz-tl-item"><span class="asz-tl-dot"></span><h3>Недели 3–4: AI-слой</h3><p>YandexGPT / GigaChat, RAG по FAQ доставки, guardrails read-only, human-in-the-loop.</p></div>
        <div class="asz-tl-item"><span class="asz-tl-dot"></span><h3>Недели 4–5: QA и метрики</h3><p>Дашборд WISMO rate, task completion, CSAT. <strong>Разработка ai статус заказа</strong> в production.</p></div>
      </div>

      <h3 class="nero-ai-reveal" style="margin-top:40px">Rule-based vs AI vs гибрид</h3>
      <div class="asz-table-wrap nero-ai-reveal">
        <table class="asz-table" aria-label="Сравнение подходов">
          <thead><tr><th>Критерий</th><th>Rule-based</th><th>AI-агент</th><th>Гибрид</th></tr></thead>
          <tbody>
            <tr><td>Проактивные статусы</td><td class="asz-good">✅ Идеально</td><td class="asz-neutral">Избыточен</td><td class="asz-good">✅ Триггеры</td></tr>
            <tr><td>«Где заказ?» в 20 формулировках</td><td class="asz-neutral">❌ Ломается</td><td class="asz-good">✅ NLU</td><td class="asz-good">✅ AI</td></tr>
            <tr><td>Задержка, нестандартный вопрос</td><td class="asz-neutral">❌</td><td class="asz-good">✅ + эскалация</td><td class="asz-good">✅ AI + human</td></tr>
            <tr><td>Стоимость / предсказуемость</td><td>Ниже</td><td>Выше</td><td>Оптимально</td></tr>
            <tr><td>Риск ошибки</td><td>Низкий</td><td>Средний</td><td>Контролируемый</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px"><strong>Внедрение ai статус заказа</strong> — ориентир <strong>120–350 тыс. ₽</strong>; MVP проактивных статусов — <strong>2–3 недели</strong>, полный контур — <strong>4–6 недель</strong>.</p>

      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите понимать webhooks, n8n и AI-оркестрацию до старта?</p>
          <p class="ym-cta-block__sub">Команда быстрее согласует пилот, если заранее разобралась в триггерах CRM, middleware и human-in-the-loop. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a> — это ускоряет этап аудита и пилота.</p>
        </div>
      </aside>
    </div>
  </section>

  <!-- KPI -->
  <section class="asz-section" id="kpi">
    <div class="asz-cnt">
      <div class="asz-sh nero-ai-reveal">
        <span class="asz-eyebrow">ROI</span>
        <h2>KPI и ROI: как измерить эффект</h2>
      </div>
      <div class="asz-grid-2 nero-ai-reveal">
        <div class="asz-card">
          <h3>Доля обращений WISMO до и после</h3>
          <p>Baseline за 4–8 недель до старта, еженедельный мониторинг. Цель — вывести WISMO из топ-3 причин обращений (как Molton Brown / Narvar).</p>
        </div>
        <div class="asz-card">
          <h3>Время ответа и task completion</h3>
          <p>Секунды (AI) vs минуты (ручной). Рост доли диалогов, решённых без оператора; снижение repeat contact rate.</p>
        </div>
      </div>
      <div class="asz-table-wrap nero-ai-reveal" style="margin-top:28px">
        <table class="asz-table" aria-label="KPI внедрения">
          <thead><tr><th>KPI</th><th>Что измеряет</th><th>Ориентир</th></tr></thead>
          <tbody>
            <tr><td>Время первого ответа</td><td>Скорость реакции на WISMO</td><td>Секунды vs минуты</td></tr>
            <tr><td>Task completion rate</td><td>Решено без оператора</td><td>Рост с пилота к production</td></tr>
            <tr><td>Repeat contact rate</td><td>Повторы по одному заказу</td><td>Снижение</td></tr>
            <tr><td>NPS post-delivery</td><td>Удержание</td><td>Рост прозрачности</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px"><strong>Автоматизация через ai статус заказа</strong> окупается экономией FTE и удержанием: <strong>43%</strong> покупателей не вернутся после плохого post-purchase CX (Salesforce).</p>
    </div>
  </section>

  <!-- KEISY -->
  <section class="asz-section asz-section-alt" id="keisy">
    <div class="asz-cnt">
      <div class="asz-sh nero-ai-reveal">
        <span class="asz-eyebrow">Кейсы</span>
        <h2>Кейсы и примеры внедрения AI статуса заказа</h2>
      </div>
      <div class="asz-case-grid nero-ai-reveal">
        <article class="asz-case-card">
          <div class="asz-case-tag">Россия · e-commerce</div>
          <h3>CaseUp + YandexGPT</h3>
          <p>RetailCRM, WhatsApp, ЛК. 60% входящих на AI; 18% WISMO без человека; поддержка 4→2 FTE.</p>
          <div class="asz-metric"><span class="num">4,5</span><span class="lbl">оценка клиентов</span></div>
        </article>
        <article class="asz-case-card">
          <div class="asz-case-tag">UK · Narvar</div>
          <h3>Fortnum &amp; Mason</h3>
          <p>Track &amp; Notify + Zendesk — WISMO-запросы снижены на 50%.</p>
          <div class="asz-metric"><span class="num">−50%</span><span class="lbl">WISMO</span></div>
        </article>
        <article class="asz-case-card">
          <div class="asz-case-tag">Россия · доставка</div>
          <h3>ASH Russia</h3>
          <p>Голосовой бот SaluteSpeech при «передано в доставку» — меньше холостых рейсов курьеров.</p>
          <div class="asz-metric"><span class="num">голос</span><span class="lbl">подтверждение визита</span></div>
        </article>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px;text-align:center">Это ориентиры для KPI — на аудите сравниваем ваш WISMO rate с похожими нишами и фиксируем реалистичную цель.</p>
    </div>
  </section>

  <!-- CTA-2 после #keisy -->
  <div class="asz-cnt">
    <div class="ym-cta-block ym-cta-block--dual" id="cta-keisy">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Снизить WISMO, как в кейсах CaseUp и Narvar?</p>
        <p class="ym-cta-block__sub">Проактивные статусы + AI на остаточные обращения — гибрид под ключ для e-commerce и логистики. Ориентир внедрения: 120–350 тыс. ₽, MVP от 2–3 недель.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Настроить статусные уведомления</a>
          <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Как проходит внедрение →</a>
        </div>
      </div>
    </div>
  </div>

  <!-- FAQ -->
  <section class="asz-section" id="faq">
    <div class="asz-cnt">
      <div class="asz-sh nero-ai-reveal">
        <span class="asz-eyebrow">FAQ</span>
        <h2>FAQ — цена, сроки, интеграции, малый бизнес</h2>
      </div>
      <div class="asz-faq nero-ai-reveal" id="asz-faq-accordion">
        <div class="asz-faq-item">
          <div class="asz-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит внедрение AI статуса заказа?</div>
          <div class="asz-faq-a"><p><strong>AI статус заказа цена</strong> зависит от стека: одна CRM + один перевозчик + Telegram — ближе к нижней границе; 1С, несколько СД, AI-слой — к верхней. Ориентир Nero Network: <strong>120–350 тыс. ₽</strong> под ключ. Точная смета — после аудита WISMO и карты интеграций.</p></div>
        </div>
        <div class="asz-faq-item">
          <div class="asz-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить ai статус заказа в малом бизнесе?</div>
          <div class="asz-faq-a"><p><strong>AI статус заказа для малого бизнеса</strong> начинают с MVP: 5 проактивных статусов из RetailCRM/amoCRM в Telegram. AI-слой добавляют, когда объём свободных вопросов превышает шаблоны. Программист на штате не обязателен — интеграция под ключ.</p></div>
        </div>
        <div class="asz-faq-item">
          <div class="asz-faq-q" role="button" tabindex="0" aria-expanded="false">Нужна ли интеграция с CRM обязательно?</div>
          <div class="asz-faq-a"><p>Источник истины по заказу почти всегда — CRM, OMS или 1С. Без <strong>интеграции ai статус заказа с crm</strong> AI не знает, чей заказ и какой статус. Исключение — узкий сценарий «только трекинг по API перевозчика».</p></div>
        </div>
        <div class="asz-faq-item">
          <div class="asz-faq-q" role="button" tabindex="0" aria-expanded="false">Чем AI-агент лучше обычного чат-бота со статусами?</div>
          <div class="asz-faq-a"><p>AI понимает вариации WISMO, собирает ответ из CRM + carrier API, проактивно алертит при аномалиях. Rule-based остаётся для проактивных статусов — <strong>гибрид</strong>, не замена триггеров.</p></div>
        </div>
        <div class="asz-faq-item">
          <div class="asz-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли автоматизировать только уведомления без чат-бота?</div>
          <div class="asz-faq-a"><p>Да. Проактивные уведомления на триггерах CRM + webhooks перевозчика уже снижают WISMO на <strong>40–70%</strong> без реактивного AI. Рекомендация: начать с проактивного контура, через 2–4 недели замерить остаточный WISMO.</p></div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA FINAL -->
  <section class="asz-section asz-cta-final" id="cta">
    <div class="asz-cnt nero-ai-reveal">
      <div class="asz-sh">
        <span class="asz-eyebrow">Следующий шаг</span>
        <h2>Настроить статусные уведомления</h2>
        <p>Под ключ вы получаете <strong>ai статус заказа для бизнеса</strong>: аудит WISMO, карта этапов, интеграция CRM/1С со СДЭК, каскад Telegram/SMS/email, AI-агент и дашборд KPI.</p>
      </div>
      <ul class="asz-cta-checklist">
        <li>Сценарии уведомлений по заказу</li>
        <li>Интеграция CRM + СДЭК / доставка</li>
        <li>Каскад Telegram / SMS / email</li>
        <li>Дашборд WISMO rate до/после</li>
      </ul>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="font-size:16px;padding:16px 36px;"<?php echo $primary_cta_attrs; ?>>Настроить статусные уведомления</a>
      <p style="margin-top:24px;font-size:14px;max-width:640px;margin-left:auto;margin-right:auto"><strong>AI статус заказа под ключ</strong> — операционная система post-purchase коммуникаций, которая окупается снижением нагрузки на поддержку и ростом лояльности. Ориентир инвестиций: 120–350 тыс. ₽.</p>
    </div>
  </section>

  <!-- FOOTER CTA -->
  <div class="asz-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Готовы убрать ручные ответы «где заказ»?</p>
        <p class="ym-cta-block__sub">Аудит WISMO, карта статусов и расчёт под вашу CRM и перевозчиков — первый шаг без обязательств.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Настроить статусные уведомления</a>
      </div>
    </div>
  </div>

  <!-- AD BANNER (если env задан) -->
  <?php if (getenv('AD_BANNER_URL') && getenv('AD_BANNER_IMAGE_URL')) : ?>
  <div class="asz-cnt asz-ad-banner" style="text-align:center;padding:24px 0 40px;">
    <a href="<?php echo esc_url(getenv('AD_BANNER_URL')); ?>" target="_blank" rel="noopener noreferrer">
      <img src="<?php echo esc_url(getenv('AD_BANNER_IMAGE_URL')); ?>" width="970" height="90" alt="<?php echo esc_attr(getenv('AD_BANNER_ALT') ?: 'Партнёрское предложение'); ?>" loading="lazy" decoding="async" style="max-width:100%;height:auto;border-radius:12px;">
    </a>
  </div>
  <?php else : ?>
  <!-- AD_BANNER: не настроен (AD_BANNER_URL / AD_BANNER_IMAGE_URL пусты) -->
  <?php endif; ?>

<script>
(function(){
  /* FAQ accordion */
  var faq = document.getElementById('asz-faq-accordion');
  if (faq) {
    faq.querySelectorAll('.asz-faq-q').forEach(function(q){
      function toggle(){
        var item = q.parentElement;
        var open = item.classList.contains('open');
        faq.querySelectorAll('.asz-faq-item').forEach(function(i){ i.classList.remove('open'); i.querySelector('.asz-faq-q').setAttribute('aria-expanded','false'); });
        if (!open) { item.classList.add('open'); q.setAttribute('aria-expanded','true'); }
      }
      q.addEventListener('click', toggle);
      q.addEventListener('keydown', function(e){ if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); toggle(); } });
    });
  }
  /* Reveal on scroll */
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function(entries){
      entries.forEach(function(en){ if (en.isIntersecting) { en.target.classList.add('nero-ai-active'); io.unobserve(en.target); } });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    document.querySelectorAll('.asz-content .nero-ai-reveal').forEach(function(el){ io.observe(el); });
  } else {
    document.querySelectorAll('.asz-content .nero-ai-reveal').forEach(function(el){ el.classList.add('nero-ai-active'); });
  }
})();
</script>

</div><!-- /.asz-content -->

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

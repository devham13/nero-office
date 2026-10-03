<?php
/**
 * Template Name: AI-квалификация лидов: внедрение и скоринг под ключ
 * Description: Внедрение AI-квалификации лидов до CRM: скоринг hot/warm/cold/reject, интеграция с amoCRM и Bitrix24.
 */

$page_seo_title       = 'AI-квалификация лидов: внедрение, скоринг и CRM под ключ';
$page_seo_description = 'Внедряем AI-квалификацию лидов до передачи в CRM: автоматический скоринг (горячий, тёплый, холодный, нецелевой), меньше нецелевых заявок у менеджеров. Узкая посадочная + кейс для B2B.';

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

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Статусы', 'href' => '#statusy-lidov'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
    ['label' => 'CRM', 'href' => '#crm-voronka'],
    ['label' => 'Метрики', 'href' => '#metriki'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Получить карту квалификации';
$primary_cta_url   = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Обучение';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#';

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

.ym-cta-block{
  border-radius:20px;padding:36px 40px;margin:32px 0;
  background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));
  border:1px solid rgba(121,242,255,.3);text-align:center;
}
.ym-cta-block--primary{background:linear-gradient(135deg,rgba(121,242,255,.14),rgba(59,130,246,.12));}
.ym-cta-block--secondary{
  background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;
}
.ym-cta-block--dual{
  background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));
  border-color:rgba(34,197,94,.3);
}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{
  font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;
}
.ym-cta-block__sub{color:#9aa8bd;font-size:15px;margin:0 auto 22px;max-width:640px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-link--accent{color:#79f2ff;text-decoration:underline;}
.ym-cta-block__btn{margin-top:4px;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-kvalifikaciya-lidov-page" role="main" tabindex="-1">

<section class="nero-ai-hero vkal-hero-kval" id="hero" aria-labelledby="vkal-hero-title">
<style>
.vkal-hero-kval {
  --vkal-cyan: #79f2ff;
  --vkal-violet: #8b5cf6;
  --vkal-green: #22c55e;
  --vkal-amber: #fbbf24;
  --vkal-rose: #fb7185;
  --vkal-text: #e6edf7;
  --vkal-muted: #9aa8bd;
  --vkal-soft: #c7d2e5;
  --vkal-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.vkal-hero-kval.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vkal-hero-kval::before {
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
.vkal-hero-kval::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 14%;
  width: 860px;
  height: 860px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .14), transparent 66%);
  filter: blur(8px);
  animation: vkalHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vkalHeroGlow {
  from { opacity: .4; transform: translateX(-50%) scale(.95); }
  to { opacity: .82; transform: translateX(-50%) scale(1.05); }
}
.vkal-hero-kval .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vkal-hero-kval .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vkal-hero-kval .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.8vw, 72px);
  line-height: .95;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.vkal-hero-kval .nero-ai-gradient-text {
  display: block;
  margin-top: .12em;
  background: linear-gradient(92deg, #fff 0%, var(--vkal-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vkal-hero-kval .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--vkal-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vkal-hero-kval .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--vkal-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vkal-hero-kval .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vkal-hero-kval .nero-ai-badge {
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
.vkal-hero-kval .nero-ai-badge--hot { border-color: rgba(251,113,133,.35); color: #fecdd3; }
.vkal-hero-kval .nero-ai-badge--warm { border-color: rgba(251,191,36,.35); color: #fde68a; }
.vkal-hero-kval .nero-ai-badge--cold { border-color: rgba(121,242,255,.3); color: #bae6fd; }
.vkal-hero-kval .nero-ai-badge--reject { border-color: rgba(148,163,184,.35); color: #cbd5e1; }
.vkal-hero-kval .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vkal-hero-kval .nero-ai-btn {
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
.vkal-hero-kval .nero-ai-btn:hover { transform: translateY(-2px); }
.vkal-hero-kval .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vkal-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.vkal-hero-kval .nero-ai-btn-secondary {
  color: var(--vkal-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vkal-hero-kval .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vkal-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.vkal-hero-kval .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vkal-hero-kval .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vkal-hero-kval .nero-ai-dots { display: flex; gap: 7px; }
.vkal-hero-kval .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vkal-hero-kval .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vkal-hero-kval .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vkal-hero-kval .nero-ai-dot:nth-child(3) { background: #34d399; }
.vkal-hero-kval .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vkal-hero-kval .nero-ai-window-body { padding: 16px; }
.vkal-hero-kval .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vkal-hero-kval .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vkal-hero-kval .nero-ai-live-pill {
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
.vkal-hero-kval .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vkalPulse 1.6s infinite;
}
@keyframes vkalPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vkal-hero-kval .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vkal-hero-kval .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vkal-hero-kval .nero-ai-metric span {
  display: block;
  color: var(--vkal-muted);
  font-size: 11px;
  font-weight: 700;
}
.vkal-hero-kval .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vkal-hero-kval .vkal-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.14);
  background: radial-gradient(ellipse at 50% 42%, rgba(121,242,255,.08), rgba(6,10,24,.92) 70%);
}
.vkal-hero-kval #vkal-kval-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vkal-hero-kval .nero-ai-task-stream { display: grid; gap: 8px; }
.vkal-hero-kval .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vkal-hero-kval .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--vkal-cyan);
  font-size: 13px;
  font-weight: 800;
}
.vkal-hero-kval .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vkal-hero-kval .nero-ai-task span {
  color: var(--vkal-muted);
  font-size: 11px;
}
.vkal-hero-kval .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vkal-hero-kval .nero-ai-status--hot {
  background: rgba(251,113,133,.14);
  color: #fecdd3;
}
.vkal-hero-kval .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .vkal-hero-kval .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vkal-hero-kval .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .vkal-hero-kval .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vkal-hero-kval .nero-ai-window-body { padding: 12px; }
  .vkal-hero-kval .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vkal-hero-kval .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

<div class="nero-ai-container nero-ai-hero-grid">
  <div class="nero-ai-hero-copy">
    <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai квалификация лидов</p>
    <h1 id="vkal-hero-title">AI-квалификация лидов: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
    <p class="nero-ai-hero-lead">AI присваивает каждому лиду статус до передачи менеджеру — горячий, тёплый, холодный или нецелевой</p>
    <ul class="nero-ai-badges" aria-label="Статусы квалификации">
      <li class="nero-ai-badge nero-ai-badge--hot">Горячий · CRM</li>
      <li class="nero-ai-badge nero-ai-badge--warm">Тёплый · follow-up</li>
      <li class="nero-ai-badge nero-ai-badge--cold">Холодный · nurture</li>
      <li class="nero-ai-badge nero-ai-badge--reject">Нецелевой · reject</li>
    </ul>
    <div class="nero-ai-btn-row">
      <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      <a class="nero-ai-btn nero-ai-btn-secondary" href="#statusy-lidov">Как присваивается статус</a>
    </div>
  </div>

  <div class="nero-ai-dashboard" aria-label="Демонстрация AI-квалификации лидов">
    <div class="nero-ai-dashboard-shell">
      <div class="nero-ai-window-top">
        <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
        <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
      </div>
      <div class="nero-ai-window-body">
        <div class="nero-ai-dashboard-title">
          <h3>Квалификация лидов · демо</h3>
          <span class="nero-ai-live-pill">онлайн</span>
        </div>
        <div class="nero-ai-metrics-grid">
          <div class="nero-ai-metric">
            <span>Ответ</span>
            <strong>40 с</strong>
          </div>
          <div class="nero-ai-metric">
            <span>Hot</span>
            <strong>12</strong>
          </div>
          <div class="nero-ai-metric">
            <span>Reject</span>
            <strong>−38%</strong>
          </div>
          <div class="nero-ai-metric">
            <span>CRM</span>
            <strong>handoff</strong>
          </div>
        </div>
        <div class="vkal-dash-canvas-wrap">
          <canvas id="vkal-kval-hero-canvas" role="img" aria-label="Анимация: лиды по ленте скоринга получают статус и уходят в CRM"></canvas>
        </div>
        <div class="nero-ai-task-stream" aria-label="Лента событий квалификации">
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">IN</span>
            <div><strong>Заявка с формы сайта</strong><span>Канал: Tilda · бюджет уточняется</span></div>
            <span class="nero-ai-status nero-ai-status--amber">вход</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">AI</span>
            <div><strong>Скоринг по матрице</strong><span>score 86 · 4/5 полей BANT</span></div>
            <span class="nero-ai-status">скоринг</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">CRM</span>
            <div><strong>Статус hot → amoCRM</strong><span>Задача менеджеру · SLA 15 мин</span></div>
            <span class="nero-ai-status nero-ai-status--hot">hot</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
/**
 * vkal-kval-hero-engine — Диспетчерская квалификации лидов
 * Мир: лента карточек → rule-layer → матрица 4 статусов → handoff в CRM
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vkal-kval-hero-canvas");
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
    outline: "#64748b",
    card: "#f1f5f9",
    hot: "#fb7185",
    warm: "#fbbf24",
    cold: "#38bdf8",
    reject: "#94a3b8",
    hub: "#1e293b",
    ribbon: "rgba(121,242,255,0.35)",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0",
    accent: "#79f2ff"
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

  function drawLeadCard(ctx, x, y, w, h, tint) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 4, tint || C.card, C.outline);
    ctx.fillStyle = "#334155";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Лид", x, y + 2);
  }

  /* Изогнутая лента — транспорт карточек */
  function ScoreRibbonFlow() {
    this.phase = 0;
  }
  ScoreRibbonFlow.prototype.draw = function (ctx) {
    this.phase = (frame * 0.022) % 1;
    ctx.strokeStyle = C.ribbon;
    ctx.lineWidth = 3;
    ctx.setLineDash([5, 7]);
    ctx.lineDashOffset = -frame * 0.35;
    ctx.beginPath();
    ctx.moveTo(-165, 72);
    ctx.bezierCurveTo(-80, 95, 80, 35, 165, 58);
    ctx.stroke();
    ctx.setLineDash([]);

    var slots = [
      { t: (this.phase + 0.05) % 1, tint: C.warm },
      { t: (this.phase + 0.38) % 1, tint: C.hot },
      { t: (this.phase + 0.62) % 1, tint: C.cold },
      { t: (this.phase + 0.85) % 1, tint: C.reject }
    ];
    slots.forEach(function (s) {
      var t = s.t;
      var x = -165 * (1 - t) * (1 - t) + 2 * (-80) * t * (1 - t) + 165 * t * t;
      var y = 72 * (1 - t) * (1 - t) + 2 * 95 * t * (1 - t) + 58 * t * t;
      drawLeadCard(ctx, x, y, 22, 14, s.tint);
    });
  };

  /* Центральная матрица статусов */
  function QualificationMatrixHub() {
    this.slotGlow = 0;
  }
  QualificationMatrixHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 280;
    drawRR(ctx, -58, -78, 116, 116, 12, C.hub, C.outline);

    var cells = [
      { label: "HOT", color: C.hot, x: -48, y: -68 },
      { label: "WARM", color: C.warm, x: 8, y: -68 },
      { label: "COLD", color: C.cold, x: -48, y: -22 },
      { label: "REJ", color: C.reject, x: 8, y: -22 }
    ];
    cells.forEach(function (c, i) {
      var active = false;
      if (prg >= 70 && prg < 130 && i === 0) active = true;
      if (prg >= 130 && prg < 175 && i === 1) active = true;
      if (prg >= 175 && prg < 210 && i === 2) active = true;
      if (prg >= 210 && prg < 245 && i === 3) active = true;
      drawRR(ctx, c.x, c.y, 44, 38, 6, active ? c.color + "55" : "rgba(255,255,255,0.06)", active ? c.color : C.outline);
      ctx.fillStyle = active ? "#fff" : "#94a3b8";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(c.label, c.x + 22, c.y + 22);
    });

    if (prg >= 60 && prg < 130) {
      var pulse = Math.sin(frame * 0.12) * 0.3 + 0.7;
      ctx.strokeStyle = "rgba(251,113,133," + pulse + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(0, -48, 52, 0, Math.PI * 2);
      ctx.stroke();
    }
  };

  function RuleLayerSieve() {
    this.shake = 0;
  }
  RuleLayerSieve.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 280;
    drawRR(ctx, -150, -15, 42, 50, 8, "rgba(148,163,184,0.12)", C.reject);
    ctx.fillStyle = C.reject;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("RULE", -129, 5);
    ctx.fillText("LAYER", -129, 14);
    if (prg > 45 && prg < 85) {
      this.shake = Math.sin(frame * 0.4) * 2;
      drawLeadCard(ctx, -129 + this.shake, 38, 18, 12, C.reject);
      if (prg > 70) {
        ctx.fillStyle = C.reject;
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.fillText("reject", -129, 58);
      }
    }
  };

  function BantDialogNode() {
    this.q = 0;
  }
  BantDialogNode.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 280;
    if (prg < 55 || prg > 125) return;
    var questions = ["Бюджет?", "Срок?", "ЛПР?"];
    this.q = Math.floor((prg - 55) / 22) % 3;
    drawRR(ctx, 108, -8, 46, 52, 8, "rgba(139,92,246,0.15)", C.agentPurple);
    ctx.fillStyle = "#e9d5ff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("BANT", 131, 8);
    ctx.fillStyle = "#fff";
    ctx.fillText(questions[this.q], 131, 24);
    ctx.fillStyle = "#c4b5fd";
    ctx.font = "6px Inter,sans-serif";
    ctx.fillText("диалог AI", 131, 34);
  };

  function ScoreGaugeArc() {
    this.score = 42;
  }
  ScoreGaugeArc.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 280;
    if (prg < 100) this.score = 35 + (prg / 100) * 25;
    else if (prg < 170) this.score = 60 + ((prg - 100) / 70) * 28;
    else this.score = 88 + Math.sin(frame * 0.05) * 4;

    ctx.strokeStyle = "rgba(255,255,255,0.08)";
    ctx.lineWidth = 6;
    ctx.beginPath();
    ctx.arc(0, 42, 36, Math.PI, 0);
    ctx.stroke();
    ctx.strokeStyle = C.accent;
    ctx.beginPath();
    ctx.arc(0, 42, 36, Math.PI, Math.PI + (this.score / 100) * Math.PI);
    ctx.stroke();
    ctx.fillStyle = "#fff";
    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(Math.round(this.score), 0, 38);
    ctx.font = "6px Inter,sans-serif";
    ctx.fillStyle = "#94a3b8";
    ctx.fillText("score", 0, 48);
  };

  function CrmHandoffLift() {
    this.liftY = 0;
  }
  CrmHandoffLift.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 280;
    if (prg < 230) return;
    var local = prg - 230;
    this.liftY = -local * 1.8;
    drawRR(ctx, -24, 55 + this.liftY, 48, 34, 6, "rgba(34,197,94,0.22)", C.agentGreen);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("handoff", 0, 68 + this.liftY);
    ctx.fillStyle = "#bbf7d0";
    ctx.font = "6px Inter,sans-serif";
    ctx.fillText("ai_status=hot", 0, 78 + this.liftY);

    if (local > 8 && local < 45) {
      ctx.strokeStyle = "rgba(34,197,94," + (1 - local / 45) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(0, 72 + this.liftY);
      ctx.lineTo(0, 108);
      ctx.stroke();
      ctx.fillStyle = C.accent;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("CRM API", 0, 118);
    }
  };

  function RejectChute() {
    this.drop = 0;
  }
  RejectChute.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 280;
    ctx.fillStyle = "rgba(251,113,133,0.08)";
    ctx.beginPath();
    ctx.moveTo(155, 20);
    ctx.lineTo(175, 20);
    ctx.lineTo(185, 95);
    ctx.lineTo(145, 95);
    ctx.closePath();
    ctx.fill();
    if (prg > 205 && prg < 250) {
      this.drop = (prg - 205) / 45;
      drawLeadCard(ctx, 165, 30 + this.drop * 55, 16, 10, C.reject);
    }
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
    var prg = (frame * 0.038) % 280;
    var isMoving = false;
    var tgtMap = {
      "1_architect": { x: -95, y: 88 },
      "2_seo": { x: -45, y: 92 },
      "3_coder": { x: 5, y: 94 },
      "4_designer": { x: 55, y: 92 },
      "5_deployer": { x: 105, y: 88 }
    };
    var tgt = tgtMap[this.role] || { x: 0, y: 90 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 24) {
      var local = prg - this.stepTrig;
      if (local < 12) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 12);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 12);
      } else if (local < 17) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 17) / 7);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 17) / 7);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
    }

    if (!isMoving && frame % 210 === 0 && Math.random() < 0.14) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 200);
    }

    var bob = Math.sin(this.timer * 1.5) * 1.2;
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
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new ScoreRibbonFlow());
  entities.push(new RuleLayerSieve());
  entities.push(new QualificationMatrixHub());
  entities.push(new BantDialogNode());
  entities.push(new ScoreGaugeArc());
  entities.push(new RejectChute());
  entities.push(new CrmHandoffLift());
  entities.push(new Agent(-135, 102, C.agentYellow, "1_architect", 12, [
    "Матрица согласована с РОПом", "Порог hot: 4 из 5 полей", "ICP зафиксирован в discovery"
  ]));
  entities.push(new Agent(-75, 108, C.agentGreen, "2_seo", 58, [
    "Скоринг лидов ai: 86", "Нецелевой — в reject", "Доля мусора −38%"
  ]));
  entities.push(new Agent(-10, 110, C.agentBlue, "3_coder", 102, [
    "Rule-layer без LLM", "Webhook < 3 с", "Очередь Redis"
  ]));
  entities.push(new Agent(55, 108, C.agentPink, "4_designer", 148, [
    "ai_status в карточке", "summary для менеджера", "Цитата клиента в CRM"
  ]));
  entities.push(new Agent(120, 102, C.agentPurple, "5_deployer", 198, [
    "Handoff в amoCRM", "Push горячему за 40 с", "HITL на пограничных"
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

    /* радарная сетка фона */
    ctx.strokeStyle = "rgba(121,242,255,0.06)";
    ctx.lineWidth = 1;
    for (var r = 40; r <= 120; r += 28) {
      ctx.beginPath();
      ctx.arc(0, -10, r, 0, Math.PI * 2);
      ctx.stroke();
    }

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.038) % 280;
    if (prg >= 14 && prg < 14.05) createBubble(-120, 50, "1. Заявка на ленте");
    if (prg >= 52 && prg < 52.05) createBubble(-140, -5, "2. Rule-layer: спам отсечён");
    if (prg >= 95 && prg < 95.05) createBubble(0, -75, "3. Диалог BANT");
    if (prg >= 155 && prg < 155.05) createBubble(0, -20, "4. Слот HOT в матрице");
    if (prg >= 238 && prg < 238.05) createBubble(0, 95, "5. Handoff в CRM");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 22);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 5, C.bubbleBg, C.accent);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(b.text, b.x, b.y - 11);
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
</section>

<style>
/* vkal-content — тело лонгрида (не hero), Kadence-safe внутри main */
.vkal-content{
  --vkal-cyan:#79f2ff;--vkal-violet:#8b5cf6;--vkal-green:#22c55e;
  --vkal-text:#e6edf7;--vkal-muted:#9aa8bd;--vkal-heading:#fff;
  --vkal-border:rgba(255,255,255,.10);--vkal-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vkal-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
}
.vkal-content *,.vkal-content *::before,.vkal-content *::after{box-sizing:border-box}
.vkal-cnt{width:min(var(--vkal-container),calc(100% - 40px));margin:0 auto}
.vkal-section{padding:clamp(56px,7vw,96px) 0;position:relative}
.vkal-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.03),rgba(255,255,255,.008));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.vkal-sh{max-width:820px;margin:0 auto 40px;text-align:left}
.vkal-sh h2{font-size:clamp(26px,3.8vw,46px);line-height:1.08;color:var(--vkal-heading);letter-spacing:-.04em;margin:0 0 14px}
.vkal-sh p{font-size:clamp(15px,1.5vw,17px);color:var(--vkal-muted);margin:0}
.vkal-eyebrow{display:inline-flex;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vkal-cyan);margin-bottom:12px}
.vkal-content p{color:var(--vkal-muted);line-height:1.72;margin:0 0 1em;font-size:15px;text-align:left!important}
.vkal-content strong{color:#c7d2e5}
.vkal-h3{font-size:clamp(18px,2.2vw,22px);color:var(--vkal-heading);margin:28px 0 12px}
.vkal-ul,.vkal-ol{padding-left:0;list-style:none;margin:0 0 1.2em}
.vkal-ul li,.vkal-ol li{padding-left:20px;position:relative;margin-bottom:.5em;color:var(--vkal-muted);font-size:14.5px;line-height:1.65}
.vkal-ul li::before{content:'›';position:absolute;left:0;color:var(--vkal-cyan);font-weight:700}
.vkal-ol{counter-reset:vkal-ol}
.vkal-ol li{counter-increment:vkal-ol}
.vkal-ol li::before{content:counter(vkal-ol) '.';position:absolute;left:0;color:var(--vkal-violet);font-weight:700}
.vkal-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0}
.vkal-table{width:100%;border-collapse:collapse;font-size:14px}
.vkal-table th{padding:12px 14px;text-align:left;background:rgba(121,242,255,.1);color:var(--vkal-cyan);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25)}
.vkal-table td{padding:11px 14px;border-bottom:1px solid rgba(255,255,255,.05);vertical-align:top}
.vkal-table tr:last-child td{border-bottom:none}
.vkal-intro{padding:clamp(36px,5vw,64px) 0;border-bottom:1px solid rgba(255,255,255,.06)}
.vkal-intro-grid{display:grid;grid-template-columns:1fr 320px;gap:48px;align-items:start}
.vkal-intro-text{position:relative;padding-left:18px}
.vkal-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vkal-cyan),var(--vkal-violet))}
.vkal-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.vkal-kpi{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:14px;text-align:center}
.vkal-kpi strong{display:block;font-size:22px;color:#fff;margin-bottom:4px}
.vkal-kpi span{font-size:11px;color:var(--vkal-muted);line-height:1.35}
@media(max-width:900px){.vkal-intro-grid{grid-template-columns:1fr}}
.vkal-toc-outer{padding:0 0 clamp(32px,4vw,48px)}
.vkal-toc,.vna-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.vkal-toc a,.vna-toc a{display:inline-block;padding:9px 16px;border-radius:999px;font-size:13px;font-weight:600;color:var(--vkal-muted);border:1px solid var(--vkal-border);background:rgba(255,255,255,.04);text-decoration:none!important}
.vkal-toc a:hover{border-color:rgba(121,242,255,.4);color:var(--vkal-cyan)}
.vkal-faq{display:flex;flex-direction:column;gap:10px;max-width:860px;margin:0 auto}
.vkal-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:0}
.vkal-faq-q{padding:18px 22px;font-size:16px;font-weight:700;color:var(--vkal-heading);cursor:pointer;list-style:none}
.vkal-faq-a{padding:0 22px 18px;font-size:14.5px;color:var(--vkal-muted)}
.vkal-prose{max-width:860px}
.nero-ai-reveal{opacity:0;transform:translateY(18px);transition:opacity .5s ease,transform .5s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
</style>
<div class="vkal-content" id="vkal-article-body">
<section class="vkal-intro vkal-section" id="intro" aria-label="Введение"><div class="vkal-cnt"><div class="vkal-intro-grid nero-ai-reveal">
<div class="vkal-intro-text"><span class="vkal-eyebrow">Лонгрид · ai квалификация лидов</span>
<p><strong>Коротко:</strong> AI-квалификация лидов — это автоматическая первичная обработка входящего обращения до передачи в отдел продаж. Система задаёт вопросы по согласованной матрице, присваивает статус (горячий, тёплый, холодный, нецелевой) и формирует handoff-пакет в CRM: поля, краткое резюме, причину отказа и рекомендуемый первый шаг менеджеру. Nero Network внедряет <strong>ai лид скоринг</strong> и <strong>скоринг лидов ai</strong> в связке с <strong>ai для crm</strong> и <strong>ai для отдела продаж</strong>, чтобы менеджеры не тратили часы на нецелевых клиентов.</p>
<p>По данным седьмого издания отчёта Salesforce <em>State of Sales</em> (анонс 3 февраля 2026, опрос 4 050 sales professionals): <strong>87%</strong> организаций уже используют AI в продажах — в том числе для lead scoring; <strong>AI и агенты названы тактикой №1 роста на 2026 год</strong>. Это не про «модный чат», а про измеримую <strong>автоматизацию квалификации клиентов</strong> на входе <strong>ai воронки продаж</strong>.</p>
</div><div class="vkal-intro-kpi" aria-label="Ориентиры">
<div class="vkal-kpi"><strong>87%</strong><span>компаний уже используют AI в продажах (Salesforce 2026)</span></div>
<div class="vkal-kpi"><strong>4</strong><span>статуса до CRM: hot / warm / cold / reject</span></div>
<div class="vkal-kpi"><strong>30–40 с</strong><span>ответ вместо часов (кейс Velmi)</span></div>
<div class="vkal-kpi"><strong>150–450 тыс. ₽</strong><span>коридор внедрения под ключ</span></div>
</div></div></div></section>
<div class="vkal-toc-outer"><div class="vkal-cnt"><nav class="vkal-toc vna-toc" aria-label="Оглавление">
<a href="#zachem-prodazhi">Зачем продажам</a>
<a href="#statusy-lidov">Статусы</a>
<a href="#etapy">Внедрение</a>
<a href="#crm-voronka">CRM</a>
<a href="#metriki">Метрики</a>
<a href="#keisy">Кейс</a>
<a href="#stoimost">Стоимость</a>
<a href="#faq">FAQ</a>
<a href="#cta-karta">Карта квалификации</a>
</nav></div></div>
<section class="vkal-section" id="zachem-prodazhi"><div class="vkal-cnt">
<header class="vkal-sh nero-ai-reveal"><h2>Зачем отделу продаж AI-квалификация лидов</h2></header>
<div class="vkal-prose nero-ai-reveal"><h3 class="vkal-h3">Почему менеджеры тратят время на нецелевых клиентов</h3>
<p>Типичная картина в B2B-услугах, агентствах и у девелоперов: маркетинг приносит поток заявок, а первая линия вручную выясняет бюджет, срок, роль ЛПР и соответствие ICP. Часть обращений — спам, дубли, «просто спросить цену» без намерения купить, неверная география или заказ ниже минимального чека. Карточки в CRM создаются пустыми; менеджер узнаёт о нецелевом лиде только после звонка.</p>
<p>Международный кейс Helium SEO + Synapsa (агентство, США): из 12 800 визитов на сайт квалифицированными оказались 8 лидов — <strong>около 90% отсечено до человека</strong>, при этом 75% qualified дошли до встречи. Смысл для РОПа: <strong>ai квалификация лидов</strong> — это не только «больше лидов», но и защита времени команды.</p>
<h3 class="vkal-h3">Что меняется, когда статус лида известен до звонка</h3>
<p>Когда <strong>внедрение ai квалификация лидов</strong> завершено, менеджер открывает CRM и видит:</p>
<ul class="vkal-ul"><li>статус: горячий / тёплый / холодный / нецелевой;</li><li>заполненные поля матрицы (бюджет, срок, сегмент);</li><li>цитаты клиента и summary от AI;</li><li>следующий шаг: перезвонить до SLA, nurture или вежливое закрытие.</li></ul>
<p>В кейсе Velmi (Habr, 2026, Bitrix24) время первого ответа сократилось с <strong>2–3 часов до 30–40 секунд</strong>; доля квалифицированных лидов выросла на <strong>35%</strong> при экономии порядка <strong>50 часов менеджеров в месяц</strong>. Архитектура там же: webhook из CRM → очередь → LLM-квалификация — важный технический паттерн для российских внедрений.</p>
<p><strong>Определение:</strong> <em>AI-квалификация лидов</em> отличается от классического Salesbot-скрипта тем, что сочетает диалог по rubric (BANT, CHAMP, MEDDIC-lite или кастомные 5–8 полей), базу знаний (RAG) для FAQ, <strong>rule-layer</strong> для жёстких дисквалификаторов и structured output в CRM — а не только «ветвление по кнопкам».</p></div>
</div></section>
<section class="vkal-section vkal-section-alt" id="statusy-lidov"><div class="vkal-cnt">
<header class="vkal-sh nero-ai-reveal"><h2>Как AI присваивает статус: горячий, тёплый, холодный, нецелевой</h2></header>
<div class="vkal-prose nero-ai-reveal"><p>Центральная модель оффера Nero Network совпадает с запросами <strong>скоринг лидов ai</strong> и <strong>ai лид скоринг</strong>: каждому лиду присваивается <strong>класс готовности</strong>, а не только числовой балл.</p>
<div class="vkal-table-wrap"><table class="vkal-table" role="table"><tr><th>Статус</th><th>Типичные признаки</th><th>Действие в CRM</th></tr><tr><td><strong>Горячий</strong></td><td>ICP совпал, бюджет/срок в рамках, ЛПР в диалоге</td><td>Задача менеджеру + push, SLA первого контакта</td></tr><tr><td><strong>Тёплый</strong></td><td>Интерес есть, не хватает 1–2 полей или срок «через квартал»</td><td>Follow-up, дозвон по расписанию</td></tr><tr><td><strong>Холодный</strong></td><td>Слабый fit или отдалённый горизонт</td><td>Nurture-цепочка, контент</td></tr><tr><td><strong>Нецелевой</strong></td><td>Спам, дубль, анти-портрет, мин. чек</td><td>Закрытие с причиной в поле <code>disqualify_reason</code></td></tr></table></div>
<p>Числовой <strong>ai лид скоринг</strong> (0–100) может идти параллельно статусу: в проекте Wildbots (n8n + Bitrix24/amoCRM) используют <strong>сверку score LLM и rule-based <code>score_lead</code></strong> — при расхождении лид уходит на ручную проверку. Так снижают риск ложных «горячих», о которых предупреждают интеграторы после пилотов.</p>
<h3 class="vkal-h3">Правила и признаки по каналам (сайт, мессенджеры, звонок)</h3>
<div class="vkal-table-wrap"><table class="vkal-table" role="table"><tr><th>Канал</th><th>Что делает AI</th><th>Что попадает в CRM</th></tr><tr><td>Форма сайта (Tilda, WordPress, Marquiz)</td><td>Уточняющие вопросы после отправки</td><td>Статус + доп. поля</td></tr><tr><td>Мессенджеры (Telegram, WhatsApp, VK)</td><td>Полный цикл 3–6 вопросов</td><td>Лид/сделка + транскрипт</td></tr><tr><td>Звонок (Mango, UIS, Sipuni + STT)</td><td>Пост-обработка записи</td><td>Задача + summary</td></tr><tr><td>Авито / маркетплейс</td><td>Жёсткие пороги + диалог</td><td>Стадия воронки по правилам</td></tr></table></div>
<p>Кейс BESTERS (workspace.ru, 2026): AI-бот на Grok + <strong>жёсткое правило</strong> (порог объёма 150 м²) + Bitrix24, 4 аккаунта Авито — <strong>6 966 сообщений</strong>, <strong>1 263 квалифицированных диалога</strong>, <strong>95%</strong> без участия человека. Это пример <strong>автоматизации квалификации клиентов</strong>, где LLM не отменяет бизнес-правила.</p>
<p>Для B2B в WhatsApp кейс металлопроката (РБК Компании): CR в квалифицированный лид <strong>22%</strong>, SLA около <strong>1 минуты</strong>, минимальный заказ от 50 тыс. ₽ — менеджер получает саммари до звонка.</p>
<h3 class="vkal-h3">Согласование скоринга с РОПом и продажами</h3>
<p>Без участия РОПа <strong>настройка ai квалификация лидов</strong> часто «обходит» реальные критерии продаж — AI формально заполняет поля, но статусы не совпадают с тем, как команда принимает решения. Nero Network на этапе Discovery фиксирует:</p>
<ol class="vkal-ol"><li>ICP и анти-портрет клиента.</li><li>Минимальный чек, география, отрасли.</li><li>Пороги hot/warm/cold/reject и исключения (тендеры, партнёры, жалобы).</li><li>Кто утверждает изменения матрицы после пилота.</li></ol>
<p><strong>Чеклист для РОПа (фрагмент):</strong> согласованы ли поля матрицы? Есть ли rule-layer для дисквалификации без LLM? Кто проверяет 10–20% диалогов в первую неделю HITL? Какие поля обязательны, чтобы лид считался «горячим»?</p></div>
</div></section>
<!-- БОРИС: вставка после секции #statusy-lidov, перед #etapy -->
<section id="ai-kvalifikaciya-lidov-boris-block" class="vkal-boris-root" aria-label="Анимация: пайплайн AI-квалификации лида от webhook до handoff в CRM">
<style>
#ai-kvalifikaciya-lidov-boris-block.vkal-boris-root{padding:clamp(48px,6vw,72px) 0;background:#f1f5f9;}
#ai-kvalifikaciya-lidov-boris-block .vkal-b-cnt{max-width:1160px;margin:0 auto;padding:0 clamp(16px,3vw,24px);}
#ai-kvalifikaciya-lidov-boris-block .vkal-b-card{display:grid;grid-template-columns:minmax(0,44%) minmax(0,56%);border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 12px 48px rgba(15,23,42,.1),0 0 0 1px rgba(148,163,184,.2);min-height:500px;}
@media(max-width:1023px){#ai-kvalifikaciya-lidov-boris-block .vkal-b-card{grid-template-columns:1fr;min-height:auto;}}
#ai-kvalifikaciya-lidov-boris-block .vkal-b-lft{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0;}
@media(max-width:1023px){#ai-kvalifikaciya-lidov-boris-block .vkal-b-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 22px;}}
#ai-kvalifikaciya-lidov-boris-block .vkal-b-ey{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#6366f1;margin:0 0 14px;}
#ai-kvalifikaciya-lidov-boris-block .vkal-b-ey::before{content:'';width:18px;height:2px;background:#6366f1;border-radius:1px;}
#ai-kvalifikaciya-lidov-boris-block .vkal-b-h3{font-size:clamp(20px,2.5vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;}
#ai-kvalifikaciya-lidov-boris-block .vkal-b-ul{list-style:none;margin:0 0 20px;padding:0;display:flex;flex-direction:column;gap:9px;}
#ai-kvalifikaciya-lidov-boris-block .vkal-b-ul li{display:flex;gap:10px;font-size:14px;line-height:1.55;color:#334155;}
#ai-kvalifikaciya-lidov-boris-block .vkal-b-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(99,102,241,.12);display:flex;align-items:center;justify-content:center;font-size:10px;color:#4f46e5;font-style:normal;}
#ai-kvalifikaciya-lidov-boris-block .vkal-b-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:16px;}
#ai-kvalifikaciya-lidov-boris-block .vkal-b-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;}
#ai-kvalifikaciya-lidov-boris-block .vkal-b-pl-h{background:rgba(239,68,68,.08);color:#b91c1c;border:1.5px solid rgba(239,68,68,.25);}
#ai-kvalifikaciya-lidov-boris-block .vkal-b-pl-w{background:rgba(245,158,11,.1);color:#b45309;border:1.5px solid rgba(245,158,11,.28);}
#ai-kvalifikaciya-lidov-boris-block .vkal-b-pl-c{background:rgba(59,130,246,.1);color:#1d4ed8;border:1.5px solid rgba(59,130,246,.25);}
#ai-kvalifikaciya-lidov-boris-block .vkal-b-pl-r{background:rgba(100,116,139,.1);color:#475569;border:1.5px solid rgba(100,116,139,.25);}
#ai-kvalifikaciya-lidov-boris-block .vkal-b-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#ai-kvalifikaciya-lidov-boris-block .vkal-b-rgt{position:relative;background:linear-gradient(145deg,#eef2ff 0%,#f8fafc 50%,#e0e7ff 100%);min-height:420px;}
#vkal-boris-pipeline-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="vkal-b-cnt"><div class="vkal-b-card">
<div class="vkal-b-lft">
<span class="vkal-b-ey">Архитектура под ключ</span>
<h3 class="vkal-b-h3">Webhook за 3 с — очередь, диалог, скоринг и handoff в CRM</h3>
<ul class="vkal-b-ul">
<li><span class="vkal-b-ic">⚡</span>Быстрый ответ webhook Bitrix24, тяжёлая LLM-обработка в воркере</li>
<li><span class="vkal-b-ic">◆</span>Rule-layer отсекает спам и нецелевых до дорогой модели</li>
<li><span class="vkal-b-ic">◎</span>Диалог 3–7 вопросов по матрице + RAG для FAQ</li>
<li><span class="vkal-b-ic">→</span>Четыре статуса и поля handoff — менеджер видит картину до звонка</li>
</ul>
<div class="vkal-b-pills">
<span class="vkal-b-pl vkal-b-pl-h">Горячий</span>
<span class="vkal-b-pl vkal-b-pl-w">Тёплый</span>
<span class="vkal-b-pl vkal-b-pl-c">Холодный</span>
<span class="vkal-b-pl vkal-b-pl-r">Нецелевой</span>
</div>
<p class="vkal-b-foot">Дальше — этапы внедрения под ключ и сроки пилота →</p>
</div>
<div class="vkal-b-rgt">
<canvas id="vkal-boris-pipeline-canvas" role="img" aria-label="Анимация: лид проходит webhook, очередь, AI-диалог, скоринг и попадает в ветку hot warm cold reject в CRM"></canvas>
</div>
</div></div>
<script>
(function(){
'use strict';
var cv=document.getElementById('vkal-boris-pipeline-canvas');
if(!cv)return;
var ctx=cv.getContext('2d'),W=0,H=0,frame=0;
function resize(){var p=cv.parentElement;if(!p)return;cv.width=p.clientWidth||640;cv.height=p.clientHeight||460;W=cv.width;H=cv.height;}
window.addEventListener('resize',resize);resize();
var C={hot:'#ef4444',warm:'#f59e0b',cold:'#3b82f6',rej:'#94a3b8',hub:'#6366f1',hubG:'rgba(99,102,241,.22)',line:'rgba(99,102,241,.35)',card:'#fff',muted:'#64748b',ink:'#0f172a'};
var LANES=[{k:'hot',l:'Горячий',c:C.hot},{k:'warm',l:'Тёплый',c:C.warm},{k:'cold',l:'Холодный',c:C.cold},{k:'rej',l:'Нецелевой',c:C.rej}];
function rr(x,y,w,h,r,fill,stroke){ctx.beginPath();if(ctx.roundRect)ctx.roundRect(x,y,w,h,r);else ctx.rect(x,y,w,h);if(fill){ctx.fillStyle=fill;ctx.fill();}if(stroke){ctx.strokeStyle=stroke;ctx.lineWidth=1.5;ctx.stroke();}}
function drawHub(cx,cy,r,p){var g=ctx.createRadialGradient(cx,cy,0,cx,cy,r*2);g.addColorStop(0,C.hubG);g.addColorStop(1,'rgba(99,102,241,0)');ctx.fillStyle=g;ctx.beginPath();ctx.arc(cx,cy,r*1.8,0,Math.PI*2);ctx.fill();rr(cx-r,cy-r,r*2,r*2,r*0.4,'#eef2ff',C.hub);ctx.fillStyle=C.hub;ctx.font='bold '+Math.max(12,r*0.24)+'px system-ui,sans-serif';ctx.textAlign='center';ctx.textBaseline='middle';ctx.fillText('AI',cx,cy-4);ctx.font=Math.max(9,r*0.15)+'px system-ui,sans-serif';ctx.fillStyle=C.muted;ctx.fillText('скоринг',cx,cy+r*0.35);}
var leads=[],packets=[],cycle=0;
function spawnLead(){leads.push({x:-30,y:H*0.18+Math.random()*H*0.08,ph:0,sp:1.1+Math.random()*0.5,type:['hot','warm','cold','rej'][Math.floor(Math.random()*4)]});}
function drawLead(x,y,s){rr(x-s*0.45,y-s*0.3,s*0.9,s*0.6,5,'#fff','#cbd5e1');ctx.fillStyle=C.ink;ctx.font='bold 9px system-ui,sans-serif';ctx.textAlign='center';ctx.fillText('LID',x,y+3);}
function drawLane(x,y,w,h,lane,count){rr(x,y,w,h,8,'rgba(255,255,255,.85)','rgba(148,163,184,.35)');ctx.fillStyle=lane.c;ctx.beginPath();ctx.arc(x+14,y+h/2,6,0,Math.PI*2);ctx.fill();ctx.fillStyle=C.ink;ctx.font='600 10px system-ui,sans-serif';ctx.textAlign='left';ctx.textBaseline='middle';ctx.fillText(lane.l,x+28,y+h/2);ctx.fillStyle=C.muted;ctx.font='9px system-ui,sans-serif';ctx.textAlign='right';ctx.fillText(String(count||0),x+w-10,y+h/2);}
var laneCounts={hot:0,warm:0,cold:0,rej:0};
function tick(){frame++;cycle++;ctx.clearRect(0,0,W,H);
var hubX=W*0.42,hubY=H*0.42;
LANES.forEach(function(l,i){l.y=H*0.62+i*(H*0.085);});
if(cycle%90===0)spawnLead();
ctx.strokeStyle=C.line;ctx.setLineDash([4,4]);ctx.beginPath();ctx.moveTo(W*0.08,hubY);ctx.lineTo(hubX-50,hubY);ctx.stroke();ctx.setLineDash([]);
rr(W*0.06,hubY-22,56,44,8,'#fff','#94a3b8');ctx.fillStyle=C.muted;ctx.font='9px system-ui,sans-serif';ctx.textAlign='center';ctx.fillText('hook',W*0.06+28,hubY-2);ctx.fillText('&lt;3с',W*0.06+28,hubY+12);
drawHub(hubX,hubY,36,0.5+0.5*Math.sin(frame*0.06));
leads=leads.filter(function(L){L.ph++;L.x+=L.sp;if(L.ph<120){drawLead(L.x,L.y,22);return true;}
if(L.ph<200){L.x+=(hubX-L.x)*0.06;L.y+=(hubY-L.y)*0.06;drawLead(L.x,L.y,22);return true;}
var lane=LANES.find(function(l){return l.k===L.type;})||LANES[0];L.tx=W*0.72;L.ty=lane.y+lane.h*0.5;if(!lane.h)lane.h=H*0.055;
if(L.ph<280){L.x+=(L.tx-L.x)*0.05;L.y+=(L.ty-L.y)*0.05;drawLead(L.x,L.y,20);return true;}
laneCounts[L.type]=(laneCounts[L.type]||0)+1;return false;});
LANES.forEach(function(l){drawLane(W*0.62,l.y,W*0.32,H*0.055,l,laneCounts[l.k]||0);});
if(cycle>600){cycle=0;leads=[];laneCounts={hot:0,warm:0,cold:0,rej:0};}
requestAnimationFrame(tick);}
requestAnimationFrame(tick);
})();
</script>
</section>
<section class="vkal-section" id="etapy"><div class="vkal-cnt">
<header class="vkal-sh nero-ai-reveal"><h2>Внедрение AI-квалификации лидов под ключ: этапы и сроки</h2></header>
<div class="vkal-prose nero-ai-reveal"><p>Услуга <strong>внедрение ai квалификация лидов под ключ</strong> и <strong>внедрение ai квалификация лидов</strong> в модели Nero Network укладывается в <strong>3–5 недель</strong> и бюджет <strong>150–450 тыс. ₽</strong> (ориентир из продуктовой таблицы; точная смета — после аудита каналов). Это сопоставимо с рынком пилотов <strong>от ~150 000 ₽</strong> (интеграторы 2025–2026) и не смешивается с абстрактным <strong>внедрением ai</strong> без привязки к воронке.</p>
<h3 class="vkal-h3">Аудит входящих лидов и CRM</h3>
<p><strong>Discovery (3–5 дней):</strong> карта источников (сайт, реклама, мессенджеры, Авито, телефония), интервью с РОПом, выбор матрицы (BANT / кастом), проверка API <strong>ai для crm</strong> (amoCRM, Bitrix24). Собираются 20–50 реальных диалогов (обезличенно), FAQ, регламент первой линии, политика ПДн.</p>
<h3 class="vkal-h3">Настройка модели и тестовая выборка</h3>
<p>Создаётся <strong>Матрица квалификации лидов</strong> — продукт-артефакт и лид-магнит Nero Network: поля → веса → пороги статусов. Подключается пилотный канал (часто форма + один мессенджер). Настраиваются: webhook gateway (ответ <strong><3 с</strong> для Bitrix24), очередь (Redis/RabbitMQ), LLM с structured JSON, RAG по базе знаний, rule engine.</p>
<p>На тестовых карточках высокий confidence модели может давать ложные hot — на пилоте закладывают <strong>антифрод тестовых заявок</strong> и минимальную полноту полей (практика Velmi/Habr).</p>
<h3 class="vkal-h3">Запуск в прод и обучение команды</h3>
<p>HITL-неделя: выборочная проверка диалогов, калибровка промптов. Обучение менеджеров: как читать <code>qualification_summary</code>, когда оспаривать статус. Расширение на второй канал, nurture для cold, уведомления РОПу в Telegram.</p>
<p><strong>Итог этапа:</strong> стабильный поток лидов с известным статусом <strong>до</strong> звонка человека.</p></div>
<aside class="ym-cta-block ym-cta-block--primary" id="cta-etapy">
  <div class="ym-cta-block__icon" aria-hidden="true">🎯</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Получить карту квалификации лидов</p>
    <p class="ym-cta-block__sub">Зафиксируем поля матрицы, пороги hot/warm/cold/нецелевой и пример handoff в CRM под ваши каналы — до старта разработки. Короткий разбор и план пилота на 2–3 недели.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</aside>
</div></section>
<section class="vkal-section vkal-section-alt" id="crm-voronka"><div class="vkal-cnt">
<header class="vkal-sh nero-ai-reveal"><h2>Интеграция с CRM и AI-воронкой продаж</h2></header>
<div class="vkal-prose nero-ai-reveal">
<p>Запросы <strong>интеграция ai квалификация лидов с crm</strong> и <strong>ai воронка продаж</strong> закрываются не «голым чатом», а сквозным pipeline — в том числе когда первый контакт приходит из почты: <a href="<?php echo esc_url( home_url( '/vnedrenie-ai-obrabotka-email-crm/' ) ); ?>">AI-обработка входящей почты в CRM</a> дополняет диалоговый скоринг единым handoff.</p>
<p><strong>Логика работы (типовой проект):</strong></p>
<ol class="vkal-ol"><li>Событие: заявка, сообщение, транскрипт звонка.</li><li>Нормализация: телефон E.164, дедуп за 72 ч, история CRM.</li><li>Rule-layer: спам, дубль, явный нецелевой → статус без дорогой модели.</li><li>Диалог: 3–7 вопросов; FAQ из RAG с возвратом к сценарию.</li><li>Скоринг: score + статус; расхождение LLM и правил → очередь проверки.</li><li>Handoff по статусу (hot → задача с дедлайном; reject → закрытие с причиной).</li><li>Аналитика: доли статусов, время ответа, MQL→SQL, причины отказов.</li></ol>
<h3 class="vkal-h3">Передача полей и статусов в CRM</h3>
<p>Рекомендуемый набор полей handoff:</p>
<ul class="vkal-ul"><li><code>ai_status</code> — hot / warm / cold / reject;</li><li><code>ai_score</code> — 0–100;</li><li><code>qualification_summary</code> — 2–4 предложения для менеджера;</li><li><code>disqualify_reason</code> — для нецелевых;</li><li>транскрипт / цитаты — в таймлайне или примечании.</li></ul>
<p>Нативный <a href="<?php echo esc_url( home_url( '/vnedrenie-ai-amocrm/' ) ); ?>"><strong>AI-агент для amoCRM под ключ</strong></a> (тарифы Профессиональный+) снижает порог входа, но <strong>внедрение ai агентов</strong> под кросс-канальность (сайт + Wazzup + Авито + очереди) обычно требует кастомной матрицы и оркестрации — это зона <strong>внедрение ai в бизнес процессы</strong> с фокусом на продажи, а не общий «вайбкодинг».</p>
<p>В Bitrix24 можно комбинировать кастомный AI-проект с приложениями вроде <strong>SiMiX Lead Scoring</strong> (правила hot/warm/cold без кода) — Nero Network проектирует связку так, чтобы скоринг и диалог не дублировали друг друга. Если после квалификации лид уходит в учётный контур, смежный сценарий — <a href="<?php echo esc_url( home_url( '/ai-1c-erp/' ) ); ?>">AI-агент для 1С и ERP</a>.</p>
<h3 class="vkal-h3">Триггеры для менеджеров и SLA первого ответа</h3>
<p>Для <strong>горячих</strong> — push и задача «перезвонить до …»; для <strong>тёплых</strong> — отложенный контакт; для <strong>холодных</strong> — вход в nurture; для <strong>нецелевых</strong> — без эскалации на менеджера. SLA первого ответа измеряется с момента обращения до первого осмысленного контакта (бот или человек) — в российских кейсах целевой коридор <strong>секунды–минуты</strong>, не часы.</p>
<p>На уровне крупных организаций те же принципы оркестрации агентов разбираются в материале <a href="<?php echo esc_url( home_url( '/kpmg-claude-vnedrenie-ai-276-tysyach/' ) ); ?>">KPMG и Claude: уроки AI для бизнеса</a>. Кейс Ultima.school (TextBack + amoCRM + ChatGPT-бот WhatsApp): <strong>в 2 раза больше обработанных лидов</strong> без роста штата при сохранении конверсии — типичный эффект для EdTech и услуг с записью на консультацию.</p></div>
</div></section>
<section class="vkal-section" id="metriki"><div class="vkal-cnt">
<header class="vkal-sh nero-ai-reveal"><h2>Метрики до и после: доля нецелевых, MQL→SQL, время ответа</h2></header>
<div class="vkal-prose nero-ai-reveal"><p><strong>Коротко:</strong> на пилоте 2 недели фиксируют baseline и те же метрики после включения AI.</p>
<div class="vkal-table-wrap"><table class="vkal-table" role="table"><tr><th>Метрика</th><th>Зачем считать</th></tr><tr><td>Доля <strong>нецелевых</strong> / reject</td><td>Показывает качество трафика и работу rule-layer</td></tr><tr><td>Медиана <strong>времени первого ответа</strong></td><td>Операционный KPI первой линии</td></tr><tr><td><strong>Completeness</strong> матрицы (% лидов с заполненными полями)</td><td>Качество handoff менеджеру</td></tr><tr><td><strong>MQL → SQL</strong> / лид → встреча</td><td>Связь с выручкой</td></tr><tr><td>Лиды на FTE, часы на первичку</td><td>Экономика отдела</td></tr></table></div>
<p>A/B на сайте медицинского центра (Habr, 2 недели): <strong>+30% лидов</strong>, <strong>+33% квалифицированных (SQL)</strong>, около <strong>300 000 ₽</strong> дополнительной выручки при том же рекламном бюджете — аргумент для пилота с контрольной группой.</p>
<p>У AutoBIT24 в маркетинговом кейсе IT B2B (данные внедренца, не независимый аудит) заявлены: конверсия лид→продажа <strong>6% → 9,5%</strong>, цикл <strong>38 → 28 дней</strong>, окупаемость <strong>~4 мес.</strong> — иллюстрация связки <strong>predictive score + rule-exceptions</strong>.</p>
<p>Международный ориентир Siemens + Salesforce Agentforce: порядка <strong>2 500 inbound лидов/мес</strong>, ответ за минуты вместо дней, <strong>6%</strong> qualification rate при BANT и Agent Script (~50 правил) — для РФ аналог: state machine + пороги, а не свободный диалог.</p></div>
</div></section>
<section class="vkal-section vkal-section-alt" id="keisy"><div class="vkal-cnt">
<header class="vkal-sh nero-ai-reveal"><h2>Кейс / пример внедрения</h2></header>
<div class="vkal-prose nero-ai-reveal"><p>Ниже — <strong>синтетическая проектная модель Nero Network</strong> (не публичный кейс одного клиента), собранная из типовых модулей research и российских референсов. Цифры из чужих внедрений приведены со ссылкой на источник; обещать «+35% всем» нельзя.</p>
<p><strong>Сценарий:</strong> B2B-агентство, 80–120 входящих лидов в месяц, amoCRM, форма на Tilda + Telegram.</p>
<ol class="vkal-ol"><li>Discovery: анти-портрет «фриланс без бюджета», мин. проект 200 тыс. ₽.</li><li>Матрица: роль, срок запуска, бюджет, тип услуги — порог hot при 4 из 5 полей и бюджете ≥200 тыс. ₽.</li><li>Пилот 14 дней: сравнить долю пустых карточек и время первого ответа.</li><li>Ожидаемый качественный результат (как в сумме российских кейсов): меньше звонков в пустоту, быстрый ответ ночью и в выходные, прозрачная доля reject для маркетинга.</li></ol>
<p><strong>Пример внедрения ai квалификация лидов</strong> с публичными цифрами: Velmi — <strong>+35%</strong> квалифицированных, ответ <strong>30–40 с</strong>; BESTERS на Авито — <strong>95%</strong> без человека при жёстких порогах; металлопрокат — <strong>22%</strong> CR в квалифицированный лид. Для <strong>ai квалификация лидов кейсы</strong> в лонгриде используются как доказательная база, а не гарантия результата.</p>
<p><strong>Уникальный угол Nero Network:</strong> продукт — не абстрактный бот, а <strong>«Матрица квалификации лидов»</strong> (заказной артефакт + внедрение), четыре статуса до CRM, архитектура «быстрый webhook + умная очередь», демо ветки <strong>нецелевого</strong> лида и <strong>hot</strong> с цитатами клиента.</p></div>
</div></section>
<section class="vkal-section vkal-section-alt" id="stoimost"><div class="vkal-cnt">
<header class="vkal-sh nero-ai-reveal"><h2>Стоимость внедрения AI-квалификации лидов</h2></header>
<div class="vkal-prose nero-ai-reveal"><p>Запрос <strong>ai квалификация лидов цена</strong> закрывается коридором <strong>150–450 тыс. ₽</strong> за проект «под ключ» (таблица Nero Network, сложность 6/10). На стоимость влияют:</p>
<ul class="vkal-ul"><li>число каналов (сайт, 2–3 мессенджера, Авито, телефония);</li><li>CRM и глубина интеграции (поля, воронки, роботы);</li><li>требования 152-ФЗ (РФ-хостинг, YandexGPT/GigaChat vs зарубежная модель по согласию);</li><li>обучение на истории сделок (второй контур ML, как в кейсах ValueAI / AutoBIT24);</li><li>объём HITL и кастомные ветки (возвраты, жалобы — по аналогии с кейсом Майя Буто, workspace.ru).</li></ul>
<p>Сравнение для финдиректора: стоимость часов менеджеров на первичку (<strong>десятки часов в месяц</strong> в кейсах вроде Velmi) vs разовое <strong>внедрение ai в бизнес</strong> с измеримым пилотом на одном канале. Пилот одного канала часто укладывается в нижнюю часть коридора; мультиканал и предиктивный скоринг — ближе к верхней.</p></div>
</div></section>
<section class="vkal-section" id="faq"><div class="vkal-cnt">
<header class="vkal-sh nero-ai-reveal"><h2>FAQ</h2></header>
<div class="vkal-prose nero-ai-reveal"><div class="vkal-faq" itemscope itemtype="https://schema.org/FAQPage"><details class="vkal-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question"><summary class="vkal-faq-q" itemprop="name">Как внедрить ai квалификация лидов самостоятельно и когда нужен подрядчик?</summary><div class="vkal-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text"><p><strong>Коротко:</strong> своими силами реалистично собрать прототип на n8n + CRM (см. разборы Wildbots, Habr). <strong>Подрядчик</strong> нужен, когда важны сроки 3–5 недель, согласованная матрица с РОПом, очереди под лимит webhook Bitrix24, RAG без галлюцинаций, ПДн и приёмка метрик на пилоте. Запрос <strong>как внедрить ai квалификация лидов</strong> на коммерческой странице ведёт к услуге <strong>ai квалификация лидов под ключ</strong>.</p></div></div></details>
<details class="vkal-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question"><summary class="vkal-faq-q" itemprop="name">Подходит ли ai квалификация лидов для малого бизнеса?</summary><div class="vkal-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text"><p>Да, если есть <strong>повторяемый поток</strong> заявок и хотя бы один менеджер, который тонет в «мусоре». При 10–20 лидах в месяц ценность — в <strong>скорости ответа</strong> и полноте полей, а не только в объёме. Нативные функции CRM могут хватить для одного канала; при кросс-канале и маркетплейсах чаще заказывают <strong>настройка ai квалификация лидов</strong> у интегратора.</p></div></div></details>
<details class="vkal-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question"><summary class="vkal-faq-q" itemprop="name">Риски: персональные данные, галлюцинации, контроль качества</summary><div class="vkal-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text"><ul class="vkal-ul"><li><strong>Галлюцинации:</strong> RAG, allowlist статусов, запрет обещать цены вне базы; гибрид LLM + правила (BESTERS, Wildbots).</li><li><strong>ПДн:</strong> хранение и обработка в РФ, договор поручения; не логировать полные телефоны в сторонние SaaS без DPA (тренд стека: GigaChat/YandexGPT + n8n на Yandex Cloud — Likesoft и аналоги).</li><li><strong>Ложные hot:</strong> rule-layer, сверка score, HITL на пилоте.</li><li><strong>Сопротивление продаж:</strong> совместная матрица с РОПом.</li></ul></div></div></details>
<details class="vkal-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question"><summary class="vkal-faq-q" itemprop="name">Чем AI-квалификация отличается от amoAI «из коробки»?</summary><div class="vkal-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text"><p>Коробочный агент закрывает сценарии внутри amoCRM. <strong>Внедрение ai агентов</strong> под ключ у Nero Network добавляет кастомные дисквалификаторы, Авито, телефонию, очереди, единую матрицу на несколько CRM и отчётность по доле <strong>нецелевых</strong> — то, что запрашивают при <strong>ai квалификация лидов для бизнеса</strong> с несколькими точками входа.</p></div></div></details>
<details class="vkal-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question"><summary class="vkal-faq-q" itemprop="name">Связь с другими внедрениями AI в продажах</summary><div class="vkal-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text"><p>Квалификация на входе дополняет (не дублирует) проекты по обработке почты в CRM и AI в amoCRM: сначала статус и поля, затем менеджер работает с подготовленной карточкой. Внутренние ссылки на смежные материалы подберёт этап internal-linker.</p></div></div></details></div></div>
<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Сначала разобраться в AI-автоматизации сами?</p>
    <p class="ym-cta-block__sub">Если команде важно понимать n8n, промпты и human-in-the-loop до заказа внедрения — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: '#'); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'Обучение'); ?></a>. Это ускоряет согласование матрицы с РОПом на пилоте.</p>
  </div>
</aside>
</div></section>
<section class="vkal-section" aria-labelledby="vkal-cta-final-title"><div class="vkal-cnt">
<section class="ym-cta-block ym-cta-block--dual vkal-cta-final" id="cta-karta" aria-labelledby="vkal-cta-final-title">
  <div class="ym-cta-block__body">
    <h2 class="ym-cta-block__headline" id="vkal-cta-final-title">Получить карту квалификации лидов</h2>
    <p class="ym-cta-block__sub">Матрица полей, пороги статусов и пример передачи в CRM — первый шаг перед внедрением AI-квалификации под ключ (150–450 тыс. ₽, 3–5 недель после аудита каналов).</p>
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" target="_blank" rel="noopener noreferrer"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      <a href="#stoimost" class="nero-ai-btn nero-ai-btn-secondary">Смотреть стоимость</a>
    </div>
  </div>
</section>
<p class="vkal-prose nero-ai-reveal" style="margin-top:24px;font-size:13px;color:#64748b"><em>Материал подготовлен офисом Nero Network. Источники цифр: Habr, workspace.ru, Salesforce 2026.</em></p>
</div></section>
</div><!-- /vkal-content -->


<?php
$vkal_page_url = trailingslashit( get_permalink() );
$vkal_site_url = trailingslashit( home_url( '/' ) );
$vkal_brand    = $brand ?: ( get_bloginfo( 'name' ) ?: 'Nero Network' );
$vkal_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $vkal_site_url . '#organization',
      'name'  => $vkal_brand,
      'url'   => $vkal_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $vkal_site_url . '#website',
      'url'       => $vkal_site_url,
      'name'      => $vkal_brand,
      'publisher' => [ '@id' => $vkal_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $vkal_page_url . '#webpage',
      'url'         => $vkal_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $vkal_site_url . '#website' ],
      'about'       => [ '@id' => $vkal_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $vkal_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $vkal_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $vkal_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $vkal_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $vkal_page_url,
      'provider'    => [ '@id' => $vkal_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $vkal_page_url . '#faq',
      'mainEntity' => [
        [
          '@type' => 'Question',
          'name'  => 'Как внедрить ai квалификация лидов самостоятельно и когда нужен подрядчик?',
          'acceptedAnswer' => [
            '@type' => 'Answer',
            'text'  => 'Коротко: своими силами реалистично собрать прототип на n8n + CRM (см. разборы Wildbots, Habr). Подрядчик нужен, когда важны сроки 3–5 недель, согласованная матрица с РОПом, очереди под лимит webhook Bitrix24, RAG без галлюцинаций, ПДн и приёмка метрик на пилоте. Запрос как внедрить ai квалификация лидов на коммерческой странице ведёт к услуге ai квалификация лидов под ключ.',
          ],
        ],
        [
          '@type' => 'Question',
          'name'  => 'Подходит ли ai квалификация лидов для малого бизнеса?',
          'acceptedAnswer' => [
            '@type' => 'Answer',
            'text'  => 'Да, если есть повторяемый поток заявок и хотя бы один менеджер, который тонет в «мусоре». При 10–20 лидах в месяц ценность — в скорости ответа и полноте полей, а не только в объёме. Нативные функции CRM могут хватить для одного канала; при кросс-канале и маркетплейсах чаще заказывают настройка ai квалификация лидов у интегратора.',
          ],
        ],
        [
          '@type' => 'Question',
          'name'  => 'Риски: персональные данные, галлюцинации, контроль качества',
          'acceptedAnswer' => [
            '@type' => 'Answer',
            'text'  => 'Галлюцинации: RAG, allowlist статусов, запрет обещать цены вне базы; гибрид LLM + правила (BESTERS, Wildbots). ПДн: хранение и обработка в РФ, договор поручения; не логировать полные телефоны в сторонние SaaS без DPA (тренд стека: GigaChat/YandexGPT + n8n на Yandex Cloud — Likesoft и аналоги). Ложные hot: rule-layer, сверка score, HITL на пилоте. Сопротивление продаж: совместная матрица с РОПом.',
          ],
        ],
        [
          '@type' => 'Question',
          'name'  => 'Чем AI-квалификация отличается от amoAI «из коробки»?',
          'acceptedAnswer' => [
            '@type' => 'Answer',
            'text'  => 'Коробочный агент закрывает сценарии внутри amoCRM. Внедрение ai агентов под ключ у Nero Network добавляет кастомные дисквалификаторы, Авито, телефонию, очереди, единую матрицу на несколько CRM и отчётность по доле нецелевых — то, что запрашивают при ai квалификация лидов для бизнеса с несколькими точками входа.',
          ],
        ],
        [
          '@type' => 'Question',
          'name'  => 'Связь с другими внедрениями AI в продажах',
          'acceptedAnswer' => [
            '@type' => 'Answer',
            'text'  => 'Квалификация на входе дополняет (не дублирует) проекты по обработке почты в CRM и AI в amoCRM: сначала статус и поля, затем менеджер работает с подготовленной карточкой. Внутренние ссылки на смежные материалы подберёт этап internal-linker.',
          ],
        ]
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $vkal_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</main>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.vkal-content');
  if (!root) return;
  var items = root.querySelectorAll('.nero-ai-reveal');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if (entry.isIntersecting) {
          entry.target.classList.add('nero-ai-active');
          observer.unobserve(entry.target);
        }
      });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });
    items.forEach(function(el){ observer.observe(el); });
  } else {
    items.forEach(function(el){ el.classList.add('nero-ai-active'); });
  }
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

<?php
/**
 * Template Name: AI интервью кандидатов под ключ — внедрение агента для HR
 * Description: SEO-лендинг — AI-агент для первичного интервью кандидатов. Скрининг, ATS, Huntflow, кейсы, цена.
 */

$page_seo_title       = 'AI интервью кандидатов под ключ — внедрение агента для HR';
$page_seo_description = 'Внедрим AI-агента для первичного интервью кандидатов: скрининг по сценарию вакансии, фиксация ответов и оценочный лист для рекрутера. Интеграция с ATS/CRM, цена, кейсы и этапы под ключ.';

add_filter(
    'document_title_parts',
    static function (array $parts) use ($page_seo_title): array {
        $parts['title'] = $page_seo_title;
        return $parts;
    },
    20
);

add_action(
    'wp_head',
    static function () use ($page_seo_title, $page_seo_description): void {
        echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
        echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
        echo '<meta property="og:type" content="article" />' . "\n";
    },
    1
);

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Этапы',       'href' => '#etapy'],
    ['label' => 'Интеграции',  'href' => '#integracii'],
    ['label' => 'Кейсы',       'href' => '#keisy'],
    ['label' => 'Стоимость',   'href' => '#ceny'],
    ['label' => 'FAQ',         'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Собрать интервью';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#kak-rabotaet';

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
/* Kadence reset + breadcrumbs hide */
body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header { display: none !important; }
body.nero-ai-landing { padding-top: 0 !important; }
.breadcrumbs, .breadcrumb, .breadcrumb-list, .breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb, .rank-math-breadcrumb, .rank-math-breadcrumbs,
.yoast-breadcrumb, .entry-header, .page-title-section { display: none !important; }
#primary, .site-main, .site-content, #content, .content-area {
  padding-top: 0 !important;
  margin-top: 0 !important;
}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-intervyu-kandidatov-page" role="main" tabindex="-1">

<!-- ========= АЛИНА: HERO BLOCK START ========= -->

<style>
/* ── Hero AI HR interview: самодостаточные стили (без CSS темы) ── */
.aihr-hero-interview {
  --aihr-cyan: #79f2ff;
  --aihr-violet: #8b5cf6;
  --aihr-green: #22c55e;
  --aihr-text: #e6edf7;
  --aihr-muted: #9aa8bd;
  --aihr-soft: #c7d2e5;
  --aihr-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.aihr-hero-interview.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.aihr-hero-interview::before {
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
.aihr-hero-interview::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 16%;
  width: 820px;
  height: 820px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .14), transparent 66%);
  filter: blur(6px);
  animation: aihrHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes aihrHeroGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.aihr-hero-interview .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aihr-hero-interview .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aihr-hero-interview .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.8vw, 72px);
  line-height: .95;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.aihr-hero-interview .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--aihr-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aihr-hero-interview .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--aihr-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.aihr-hero-interview .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--aihr-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.aihr-hero-interview .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.aihr-hero-interview .nero-ai-badge {
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
.aihr-hero-interview .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.aihr-hero-interview .nero-ai-btn {
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
.aihr-hero-interview .nero-ai-btn:hover { transform: translateY(-2px); }
.aihr-hero-interview .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--aihr-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.aihr-hero-interview .nero-ai-btn-secondary {
  color: var(--aihr-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.aihr-hero-interview .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--aihr-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.aihr-hero-interview .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.aihr-hero-interview .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.aihr-hero-interview .nero-ai-dots { display: flex; gap: 7px; }
.aihr-hero-interview .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.aihr-hero-interview .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aihr-hero-interview .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aihr-hero-interview .nero-ai-dot:nth-child(3) { background: #34d399; }
.aihr-hero-interview .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.aihr-hero-interview .nero-ai-window-body { padding: 16px; }
.aihr-hero-interview .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.aihr-hero-interview .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.aihr-hero-interview .nero-ai-live-pill {
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
.aihr-hero-interview .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: aihrPulse 1.6s infinite;
}
@keyframes aihrPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.aihr-hero-interview .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.aihr-hero-interview .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.aihr-hero-interview .nero-ai-metric span {
  display: block;
  color: var(--aihr-muted);
  font-size: 11px;
  font-weight: 700;
}
.aihr-hero-interview .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.aihr-hero-interview .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.aihr-hero-interview .aihr-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(139, 92, 246, 0.18);
  background: radial-gradient(ellipse at 50% 40%, rgba(139,92,246,.10), rgba(6,10,24,.9) 70%);
}
.aihr-hero-interview #aihr-interview-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.aihr-hero-interview .nero-ai-task-stream {
  display: grid;
  gap: 8px;
}
.aihr-hero-interview .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.aihr-hero-interview .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(139,92,246,.14);
  color: var(--aihr-cyan);
  font-size: 13px;
  font-weight: 800;
}
.aihr-hero-interview .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.aihr-hero-interview .nero-ai-task span {
  color: var(--aihr-muted);
  font-size: 11px;
}
.aihr-hero-interview .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.aihr-hero-interview .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.aihr-hero-interview .nero-ai-status--violet {
  background: rgba(139,92,246,.14);
  color: #ddd6fe;
}
@media (max-width: 1100px) {
  .aihr-hero-interview .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aihr-hero-interview .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .aihr-hero-interview .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .aihr-hero-interview .nero-ai-window-body { padding: 12px; }
  .aihr-hero-interview .nero-ai-task { grid-template-columns: 28px 1fr; }
  .aihr-hero-interview .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

<section class="nero-ai-hero aihr-hero-interview" id="aihr-hero-interview" aria-labelledby="aihr-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · HR и рекрутинг</p>
      <h1 id="aihr-hero-title">AI-агент для первичного интервью кандидатов: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Рекрутеры тратят часы на одинаковые первичные интервью — AI проводит структурированный скрининг, фиксирует ответы и передаёт оценочный лист</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">HR-скрининг</li>
        <li class="nero-ai-badge">ATS</li>
        <li class="nero-ai-badge">Huntflow</li>
        <li class="nero-ai-badge">152-ФЗ</li>
        <li class="nero-ai-badge">n8n</li>
        <li class="nero-ai-badge">Массовый найм</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Собрать интервью</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-скрининга кандидатов">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-рекрутинг · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Интервью сегодня</span>
              <strong>47</strong>
              <small>массовый найм</small>
            </div>
            <div class="nero-ai-metric">
              <span>Time-to-screen</span>
              <strong>2:18</strong>
              <small>отклик → оценка</small>
            </div>
            <div class="nero-ai-metric">
              <span>Completion rate</span>
              <strong>84%</strong>
              <small>кандидаты завершили</small>
            </div>
            <div class="nero-ai-metric">
              <span>В shortlist</span>
              <strong>12</strong>
              <small>score &gt; порога</small>
            </div>
          </div>

          <div class="aihr-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aihr-interview-canvas" role="img" aria-label="Анимация: кандидаты проходят AI-интервью, рубрика скоринга и оценочный лист уходит в Huntflow"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий рекрутинга">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">hh</span>
              <div><strong>Новый отклик hh.ru</strong><span>Вакансия: оператор колл-центра</span></div>
              <span class="nero-ai-status nero-ai-status--violet">отклик</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>AI-интервью запущено</strong><span>15 вопросов · knockout пройден</span></div>
              <span class="nero-ai-status">скрининг</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">📋</span>
              <div><strong>Оценочный лист в Huntflow</strong><span>Score 8.2 · компетенции + транскрипт</span></div>
              <span class="nero-ai-status">ATS</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">✓</span>
              <div><strong>Рекрутер: пригласить на очное</strong><span>Human-in-the-loop · финал за человеком</span></div>
              <span class="nero-ai-status nero-ai-status--amber">shortlist</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * aihr-interview-engine — Студия AI-скрининга
 * Мир: очередь кандидатов → кабина интервью → рубрика → handoff в ATS
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("aihr-interview-canvas");
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
    cardBg: "#f8fafc",
    cardAccent: "#c4b5fd",
    lane: "rgba(121,242,255,0.18)",
    boothBase: "#1e293b",
    boothGlow: "#8b5cf6",
    mic: "#79f2ff",
    green: "#22c55e",
    amber: "#f59e0b",
    red: "#fb7185",
    rubricBar: "#a7f3d0",
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

  /* Горизонтальная очередь кандидатов — не конвейер завода */
  function CandidateQueueLane() {
    this.offset = 0;
  }
  CandidateQueueLane.prototype.draw = function (ctx) {
    this.offset = (frame * 0.55) % 90;
    drawRR(ctx, -175, 58, 350, 8, 4, "rgba(255,255,255,0.06)", C.lane);
    ctx.strokeStyle = C.lane;
    ctx.lineWidth = 1.5;
    ctx.setLineDash([5, 7]);
    ctx.lineDashOffset = -frame * 0.35;
    ctx.beginPath();
    ctx.moveTo(-170, 62);
    ctx.lineTo(170, 62);
    ctx.stroke();
    ctx.setLineDash([]);

    for (var i = 0; i < 4; i++) {
      var px = -150 + i * 55 + this.offset;
      if (px > 175) px -= 220;
      var status = i === 1 ? "active" : i === 3 ? "reject" : "wait";
      drawCandidateCard(ctx, px, 38, status);
    }
  };

  function drawCandidateCard(ctx, x, y, status) {
    var col = status === "reject" ? C.red : status === "active" ? C.cardAccent : C.cardBg;
    drawRR(ctx, x - 18, y - 14, 36, 28, 5, col, C.outline);
    ctx.fillStyle = status === "reject" ? "#fff" : "#0f172a";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(status === "reject" ? "KO" : "CV", x, y + 2);
    if (status === "active") {
      ctx.strokeStyle = C.mic;
      ctx.lineWidth = 1;
      ctx.beginPath();
      ctx.arc(x, y - 20, 6 + Math.sin(frame * 0.12) * 2, 0, Math.PI * 2);
      ctx.stroke();
    }
  }

  /* Кабина интервью — вместо WebsiteTerminal */
  function ScreeningInterviewBooth() {
    this.questionIdx = 0;
  }
  ScreeningInterviewBooth.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 260;
    drawRR(ctx, -48, -78, 96, 118, 10, C.boothBase, C.outline);

    /* Экран вопросов */
    drawRR(ctx, -38, -68, 76, 52, 6, "#0b1220", C.boothGlow);
    var questions = ["Опыт 1+ год?", "График 2/2?", "Мотивация?"];
    this.questionIdx = Math.floor((prg % 90) / 30) % 3;
    ctx.fillStyle = "#e2e8f0";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(questions[this.questionIdx], 0, -48);

    /* Микрофон */
    ctx.fillStyle = C.mic;
    ctx.beginPath();
    ctx.arc(0, -8, 5, 0, Math.PI * 2);
    ctx.fill();
    drawRR(ctx, -3, -3, 6, 10, 2, C.mic, null);

    /* Фазы: INTERVIEW */
    if (prg >= 70 && prg < 140) {
      var wave = Math.sin(frame * 0.15) * 0.5 + 0.5;
      ctx.strokeStyle = "rgba(121,242,255," + (0.3 + wave * 0.4) + ")";
      ctx.lineWidth = 2;
      for (var w = 0; w < 3; w++) {
        ctx.beginPath();
        ctx.arc(0, -8, 12 + w * 8 + wave * 6, 0, Math.PI * 2);
        ctx.stroke();
      }
      /* Транскрипт */
      var lines = ["— Да, есть опыт", "— Готов к сменам"];
      lines.forEach(function (ln, i) {
        drawRR(ctx, -32, 18 + i * 14, 64, 10, 3, "rgba(255,255,255,0.08)", null);
        ctx.fillStyle = "#94a3b8";
        ctx.font = "6px Inter,sans-serif";
        ctx.textAlign = "left";
        ctx.fillText(ln, -28, 26 + i * 14);
      });
    }

    /* Фаза SCORE — рубрика внутри кабины */
    if (prg >= 140 && prg < 200) {
      var comps = ["Коммун.", "Опыт", "Мотив."];
      comps.forEach(function (c, i) {
        var barW = 50 * Math.min(1, (prg - 140 - i * 12) / 18);
        if (barW < 0) barW = 0;
        drawRR(ctx, -30, 14 + i * 16, 60, 8, 3, "rgba(255,255,255,0.06)", null);
        drawRR(ctx, -28, 16, barW, 4, 2, C.rubricBar, null);
        ctx.fillStyle = "#cbd5e1";
        ctx.font = "6px Inter,sans-serif";
        ctx.textAlign = "left";
        ctx.fillText(c, -28, 13 + i * 16);
      });
    }

    /* Фаза HANDOFF — оценочный лист */
    if (prg >= 200) {
      var fly = Math.min(1, (prg - 200) / 30);
      var sheetY = 30 - fly * 55;
      drawRR(ctx, -22, sheetY, 44, 30, 5, "rgba(34,197,94,0.22)", C.green);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Score 8.2", 0, sheetY + 12);
      ctx.font = "6px Inter,sans-serif";
      ctx.fillStyle = "#bbf7d0";
      ctx.fillText("оценочный лист", 0, sheetY + 22);
    }
  };

  /* Knockout-ворота — уникальный объект HR */
  function KnockoutGate() {
    this.flash = 0;
  }
  KnockoutGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 260;
    drawRR(ctx, -165, 20, 42, 50, 6, "rgba(251,113,133,0.12)", C.red);
    ctx.fillStyle = C.red;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("KO", -144, 38);
    ctx.font = "6px Inter,sans-serif";
    ctx.fillText("фильтр", -144, 48);

    if (prg > 25 && prg < 55) {
      this.flash = Math.sin((prg - 25) * 0.2);
      var kx = -130 + ((prg - 25) / 30) * 40;
      drawCandidateCard(ctx, kx, 38, "reject");
      if (prg > 48 && prg < 52) createBubble(-144, 5, "Knockout: нет медкнижки", 200);
    }
  };

  /* Панель рубрики — справа */
  function RubricScorer() {
    this.score = 0;
  }
  RubricScorer.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 260;
    drawRR(ctx, 108, -62, 58, 72, 8, "rgba(255,255,255,0.06)", C.outline);
    ctx.fillStyle = "#e2e8f0";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Рубрика", 137, -52);

    if (prg >= 130) this.score = Math.min(8.2, 4 + (prg - 130) / 25);
    else if (prg >= 70) this.score = 4 + (prg - 70) / 30;
    else this.score = 3.5;

    ctx.fillStyle = C.green;
    ctx.font = "bold 14px Inter,sans-serif";
    ctx.fillText(this.score.toFixed(1), 137, -30);

    ["Hard", "Soft", "Fit"].forEach(function (l, i) {
      var pct = Math.min(1, Math.max(0, (prg - 70 - i * 15) / 25));
      drawRR(ctx, 114, -18 + i * 18, 46, 6, 2, "rgba(255,255,255,0.08)", null);
      drawRR(ctx, 114, -18 + i * 18, 46 * pct, 6, 2, C.rubricBar, null);
      ctx.fillStyle = "#94a3b8";
      ctx.font = "6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(l, 114, -22 + i * 18);
    });
  };

  /* Мост в ATS — финал вместо ракеты */
  function AtsHandoffBridge() {
    this.pulse = 0;
  }
  AtsHandoffBridge.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 260;
    drawRR(ctx, -42, 72, 84, 28, 8, "rgba(121,242,255,0.08)", C.mic);
    ctx.fillStyle = C.mic;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Huntflow API", 0, 90);

    if (prg >= 210) {
      this.pulse = (prg - 210) / 35;
      ctx.strokeStyle = "rgba(34,197,94," + (0.8 - this.pulse * 0.6) + ")";
      ctx.lineWidth = 2.5;
      ctx.beginPath();
      ctx.arc(0, 86, 18 + this.pulse * 35, 0, Math.PI * 2);
      ctx.stroke();
      if (prg > 225 && prg < 230) createBubble(0, 55, "Webhook: карточка обновлена", 220);
    }
  };

  /* Значок согласия 152-ФЗ */
  function ConsentBadge() {
    this.tick = 0;
  }
  ConsentBadge.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 260;
    drawRR(ctx, -175, -55, 38, 22, 5, "rgba(34,197,94,0.12)", C.green);
    ctx.fillStyle = C.green;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("152-ФЗ ✓", -156, -42);
    if (prg > 15 && prg < 25) {
      this.tick = 1;
      ctx.fillStyle = "#fff";
      ctx.font = "bold 10px Inter,sans-serif";
      ctx.fillText("✓", -156, -48);
    }
  };

  /* Лоток shortlist */
  function ShortlistTray() {
    this.count = 0;
  }
  ShortlistTray.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 260;
    drawRR(ctx, 145, 42, 40, 24, 6, "rgba(34,197,94,0.15)", C.green);
    ctx.fillStyle = "#bbf7d0";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    if (prg > 215) this.count = Math.min(12, Math.floor((prg - 215) / 8) + 1);
    ctx.fillText("Top " + this.count, 165, 58);
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
    var prg = (frame * 0.035) % 260;
    var isMoving = false;
    var carryType = null;

    /* Полукруг вокруг кабины — другая геометрия */
    var seatTargets = {
      "1_architect": { x: -95, y: -5 },
      "2_seo": { x: -55, y: 18 },
      "3_coder": { x: 0, y: 28 },
      "4_designer": { x: 55, y: 18 },
      "5_deployer": { x: 95, y: -5 }
    };
    var tgt = seatTargets[this.role] || { x: 0, y: 20 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 24) {
      var local = prg - this.stepTrig;
      if (local < 12) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 12);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 12);
      } else if (local < 18) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 18) / 6);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 18) / 6);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 6 ? this.color : null;
    }

    if (!isMoving && frame % 200 === 0 && Math.random() < 0.14) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 210);
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
    if (carryType) drawRR(ctx, -16, -16 - bob, 12, 12, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new CandidateQueueLane());
  entities.push(new ConsentBadge());
  entities.push(new KnockoutGate());
  entities.push(new ScreeningInterviewBooth());
  entities.push(new RubricScorer());
  entities.push(new AtsHandoffBridge());
  entities.push(new ShortlistTray());
  entities.push(new Agent(-130, 88, C.agentYellow, "1_architect", 20, [
    "Сценарий вакансии утверждён", "Knockout-вопросы готовы", "Рубрика для оператора"
  ]));
  entities.push(new Agent(-75, 98, C.agentGreen, "2_seo", 68, [
    "Медкнижка обязательна?", "График 2/2 — ок?", "Опыт колл-центра 1+ год"
  ]));
  entities.push(new Agent(-10, 102, C.agentBlue, "3_coder", 115, [
    "Webhook Huntflow настроен", "n8n → YandexGPT", "JSON scorecard готов"
  ]));
  entities.push(new Agent(65, 98, C.agentPink, "4_designer", 158, [
    "UX интервью для кандидата", "Согласие 152-ФЗ в начале", "Прозрачный AI-скрининг"
  ]));
  entities.push(new Agent(130, 88, C.agentPurple, "5_deployer", 205, [
    "Оценочный лист в ATS", "Рекрутер уведомлён", "Shortlist top-12 готов"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 240, maxLife: life || 240 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.035) % 260;
    if (prg >= 18 && prg < 18.05) createBubble(-140, 10, "1. Отклик hh.ru");
    if (prg >= 72 && prg < 72.05) createBubble(-50, -30, "2. AI-интервью 15 мин");
    if (prg >= 128 && prg < 128.05) createBubble(0, -55, "3. Скоринг по рубрике");
    if (prg >= 185 && prg < 185.05) createBubble(40, 10, "4. Оценочный лист");
    if (prg >= 228 && prg < 228.05) createBubble(120, 0, "5. Рекрутер приглашает");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 5, C.bubbleBg, C.boothGlow);
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

<!-- ========= АЛИНА: HERO BLOCK END ========= -->

<style>
/* aihr-content — блок статьи (не hero), Kadence-safe */
.aihr-content{
  --aihr-bg:#050711;--aihr-bg2:#080b17;--aihr-surface:rgba(255,255,255,.072);
  --aihr-text:#e6edf7;--aihr-muted:#9aa8bd;--aihr-soft:#c7d2e5;--aihr-heading:#fff;
  --aihr-border:rgba(255,255,255,.10);--aihr-accent:#79f2ff;--aihr-violet:#8b5cf6;--aihr-green:#22c55e;
  --aihr-cyan:#79f2ff;--aihr-btn-from:#2563eb;--aihr-btn-to:#7c3aed;--aihr-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--aihr-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.aihr-content *,.aihr-content *::before,.aihr-content *::after{box-sizing:border-box}
.aihr-content a{color:var(--aihr-accent)}
.aihr-content p{color:var(--aihr-muted);line-height:1.72;margin:0 0 1em}
.aihr-content p:last-child{margin-bottom:0}
.aihr-content h2,.aihr-content h3,.aihr-content h4{color:var(--aihr-heading);letter-spacing:-.045em;margin:0 0 .7em}
.aihr-content strong{color:var(--aihr-soft)}
.aihr-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.aihr-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--aihr-muted);font-size:14.5px;line-height:1.65}
.aihr-content ul li::before{content:'›';position:absolute;left:0;color:var(--aihr-accent);font-weight:700}
.aihr-content ol.aihr-ol{padding-left:24px;margin:0 0 1.2em;color:var(--aihr-muted);line-height:1.7}
.aihr-cnt{width:min(var(--aihr-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.aihr-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.aihr-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.aihr-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.aihr-sh.aihr-left{margin-left:0;text-align:left}
.aihr-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.aihr-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.aihr-sh.aihr-left p{margin-left:0}
.aihr-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aihr-accent);margin-bottom:14px}
.aihr-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.aihr-intro-grid{display:grid;grid-template-columns:1fr;gap:24px}
.aihr-intro-text{position:relative;padding-left:20px}
.aihr-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--aihr-accent),var(--aihr-violet))}
.aihr-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8}
.aihr-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.aihr-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.aihr-toc a{display:inline-block;padding:9px 18px;background:var(--aihr-surface);border:1px solid var(--aihr-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--aihr-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important}
.aihr-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--aihr-accent);background:rgba(121,242,255,.08)}
.aihr-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--aihr-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22)}
.aihr-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
@media(max-width:768px){.aihr-grid-2{grid-template-columns:1fr}}
.aihr-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.aihr-table{width:100%;border-collapse:collapse;font-size:14px}
.aihr-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--aihr-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap}
.aihr-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--aihr-text);vertical-align:top}
.aihr-table tr:last-child td{border-bottom:none}
.aihr-table tr:hover td{background:rgba(255,255,255,.03)}
.aihr-compare-table tr:hover td{background:rgba(121,242,255,.06)}
.aihr-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.aihr-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(121,242,255,.1);color:var(--aihr-accent);border:1px solid rgba(121,242,255,.2)}
.aihr-flow .arr{color:var(--aihr-muted);font-size:16px;padding:0 4px;background:none;border:none}
.aihr-stepper{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:24px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.aihr-step{padding:10px 16px;border-radius:12px;font-size:12px;font-weight:700;background:rgba(121,242,255,.1);color:var(--aihr-accent);border:1px solid rgba(121,242,255,.2);text-align:center;min-width:100px}
.aihr-step .num{display:block;font-size:10px;opacity:.7;margin-bottom:4px}
.aihr-timeline{position:relative;padding-left:40px}
.aihr-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--aihr-accent),var(--aihr-violet));opacity:.35;border-radius:2px}
.aihr-tl-item{position:relative;margin-bottom:32px}
.aihr-tl-item:last-child{margin-bottom:0}
.aihr-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--aihr-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.aihr-tl-item h3{font-size:17px;margin-bottom:8px}
.aihr-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.aihr-case-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.aihr-case-grid{grid-template-columns:1fr}}
.aihr-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s}
.aihr-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px)}
.aihr-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aihr-green);margin-bottom:10px}
.aihr-case-card h3{font-size:16px;margin-bottom:14px}
.aihr-metric{display:flex;align-items:baseline;gap:8px;margin-top:8px;border-left:3px solid var(--aihr-cyan);padding-left:12px}
.aihr-metric .num{font-size:20px;font-weight:900;color:var(--aihr-accent);flex-shrink:0}
.aihr-metric .lbl{font-size:13px;color:var(--aihr-muted)}
.aihr-compliance{background:rgba(34,197,94,.06);border:1px solid rgba(34,197,94,.2);border-radius:20px;padding:28px;margin-top:24px}
.aihr-compliance ol{padding-left:20px;color:var(--aihr-muted);line-height:1.75}
.aihr-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.aihr-faq details{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.aihr-faq summary{padding:19px 24px;font-size:16px;font-weight:700;color:var(--aihr-heading);cursor:pointer;list-style:none;display:flex;align-items:center;justify-content:space-between;gap:16px}
.aihr-faq summary::-webkit-details-marker{display:none}
.aihr-faq summary::after{content:'▾';font-size:13px;color:var(--aihr-accent);flex-shrink:0;transition:transform .25s}
.aihr-faq details[open] summary::after{transform:rotate(180deg)}
.aihr-faq .aihr-faq-a{padding:0 24px 20px;font-size:14.5px;color:var(--aihr-muted);line-height:1.72}
.aihr-content .ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.aihr-content .ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.aihr-content .ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.aihr-content .ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.aihr-content .ym-cta-block__sub{color:var(--aihr-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.aihr-content .ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.aihr-content .ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.aihr-content .ym-link--accent{color:var(--aihr-accent)!important;text-decoration:underline!important}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
</style>

<div class="aihr-content aihr-cnt-root">
<section class="aihr-intro nero-ai-section" id="intro" aria-label="Введение">
  <div class="aihr-cnt">
    <div class="aihr-intro-grid nero-ai-reveal">
      <div class="aihr-intro-text"><p><strong>Коротко:</strong> AI-агент проводит структурированное первичное интервью по сценарию вакансии, фиксирует ответы, оценивает по рубрике и передаёт рекрутеру оценочный лист. Финальное решение о приглашении или отказе остаётся за человеком. Nero Network внедряет такие агенты под ключ — с интеграцией в Huntflow, Potok, amoCRM и другие ATS/CRM.</p>
<p>Рекрутеры в компаниях с массовым наймом — HR-отделы, рекрутинговые агентства, ритейл, логистика, колл-центры — знают одну и ту же ситуацию: десятки откликов на линейную вакансию, и каждый кандидат ждёт звонка с однотипными вопросами. Пока рекрутер обзванивает пятого, третий уже уходит к конкуренту. В 2026 году agentic AI в HR перешёл из пилотов в операционку: McKinsey называет рекрутинг одной из самых зрелых зон для гибридных команд «человек + агент» (<a href="https://www.mckinsey.com/capabilities/people-and-organizational-performance/our-insights/the-organization-blog/hrs-transformative-role-in-an-agentic-future" target="_blank" rel="noopener noreferrer">McKinsey, HR's transformative role in an agentic future</a>, ноябрь 2025). Коммерческий запрос «ai интервью кандидатов под ключ» — не про замену рекрутера, а про снятие рутинного скрининга и единый стандарт оценки.</p></div>
    </div>
  </div>
</section>
<div class="aihr-toc-outer"><div class="aihr-cnt"><nav class="aihr-toc ym-toc" aria-label="Оглавление статьи"><a href="#kak-rabotaet">Как работает</a><a href="#etapy">Этапы</a><a href="#integracii">Интеграции</a><a href="#keisy">Кейсы</a><a href="#ceny">Стоимость</a><a href="#faq">FAQ</a><a href="#zakazat">Заказать</a></nav></div></div>
<section class="aihr-section" id="bol">
  <div class="aihr-cnt">
    <div class="aihr-sh nero-ai-reveal">
      <span class="aihr-eyebrow">Боль HR</span>
      <h2>Почему рекрутеры тратят часы на одинаковые первичные интервью</h2>
    </div>
    <p><strong>Определение:</strong> первичное интервью кандидатов — короткий скрининг до очного собеседования: проверка обязательных условий (график, локация, опыт), базовые компетенции и мотивация. При массовом найме этот этап повторяется сотни раз на одну вакансию.</p>
<p>Типовая боль выглядит так: 50 откликов → 50 звонков или чатов → две недели до shortlist. Рекрутеры тратят часы на одинаковые первичные интервью, потому что:</p>
<ul><li><strong>Однотипные вопросы</strong> — «удалёнка/офис», «медкнижка», «опыт от года» — не масштабируются линейно с ростом откликов.</li><li><strong>Разный стандарт оценки</strong> — один рекрутер «слышит» soft skills, другой фокусируется только на hard skills; оценочный лист кандидата часто живёт в заметках, а не в ATS.</li><li><strong>Медленный первый контакт</strong> — глобальный медианный time-to-hire по отраслевым бенчмаркам SmartRecruiters / Lighthouse Research 2025 составляет <strong>38 дней</strong>; компании с AI-инструментами в рекрутинге нанимают <strong>на 26% быстрее</strong> (<a href="https://ta.smartrecruiters.com/rs/664-NIC-529/images/Recruitment-Benchmarks-2025-Report.pdf" target="_blank" rel="noopener noreferrer">Recruitment Benchmarks 2025 PDF</a>).</li><li><strong>Ghosting</strong> — кандидат не ждёт: медленный скрининг означает потерю сильных откликов конкурентам.</li></ul>
<p><strong>Итог блока:</strong> узкое место — не финальное собеседование, а первичный скрининг. Автоматизация первичного интервью снимает рутину, но не должна подменять человека на этапе отказа или оффера.</p>
  </div>
</section>
<section class="aihr-section" id="chto-takoe">
  <div class="aihr-cnt">
    <div class="aihr-sh nero-ai-reveal">
      <span class="aihr-eyebrow">Ядро продукта</span>
      <h2>Что такое AI-агент для интервью кандидатов и чем он отличается от чат-бота</h2>
    </div>
    <p><strong>Определение:</strong> AI-агент для первичного интервью — программный агент (чат, голос или видео), который по сценарию вакансии проводит <strong>структурированный скрининг</strong> с кандидатом 24/7, транскрибирует ответы, оценивает их по заданным критериям и формирует <strong>оценочный лист / shortlist</strong> для рекрутера.</p>
<p>Синонимы в поиске — <strong>ai собеседование</strong>, <strong>ai рекрутер интервью</strong>, <strong>нейросеть для интервью</strong>, <strong>ai скрининг кандидатов</strong> — описывают один класс решений, но уровень глубины разный.</p>
<div class="aihr-table-wrap"><table class="aihr-table aihr-compare-table"><thead><tr><th>Критерий</th><th>Чат-бот FAQ</th><th>AI-агент для интервью</th></tr></thead><tbody><tr><td>Цель</td><td>Ответить на вопросы о вакансии</td><td>Провести скрининг и оценить кандидата</td></tr><tr><td>Сценарий</td><td>Статичные ветки</td><td>Рубрика, knockout-вопросы, ветвления</td></tr><tr><td>Результат</td><td>Ссылка или контакт</td><td>Оценочный лист, score, транскрипт в ATS</td></tr><tr><td>Интеграция</td><td>Часто изолирован</td><td>Webhook/API в Huntflow, Potok, CRM</td></tr><tr><td>Роль человека</td><td>Рекрутер всё делает вручную</td><td>Human-in-the-loop на отказ/оффер</td></tr></tbody></table></div>
<h3 id="strukturirovannyj-skrining">Структурированный скрининг vs свободный диалог</h3>
<p><strong>Структурированное интервью кандидатов</strong> — фиксированный набор вопросов и критериев для всех участников. Международный вендор HireVue строит AI Interviewer на <strong>IO-validated рубриках</strong>: кандидат отвечает голосом → транскрипт анализируется LLM → рекрутер получает ранжированный shortlist. С 2021 года HireVue <strong>отключил анализ мимики и тона</strong> — оценивается только содержание ответов (<a href="https://www.hirevue.com/wp-content/uploads/2025/12/HV_2025_One-Pager_AI-in-Hirevue-1.pdf" target="_blank" rel="noopener noreferrer">HireVue AI one-pager PDF</a>).</p>
<p>Свободный диалог без рубрики даёт «разговор с нейросетью», но не даёт сравнимых метрик и повышает риск bias. Для коммерческого <strong>внедрения ai агентов</strong> в HR-процесс Nero Network рекомендует режим <strong>structured interview + explainable scorecard</strong>: каждая компетенция — балл и короткий комментарий, видимый рекрутеру.</p>
<p>Паттерн agentic AI в найме, который описывает McKinsey: агент чистит данные → скорит → выходит на связь → координирует интервью. Рекрутинг назван одной из первых функций для гибридных human+agent команд.</p>
  </div>
</section>

<section id="ai-intervyu-kandidatov-boris-block" class="bir-root" aria-label="Анимация: AI-интервью кандидата и оценочный лист в ATS">
<style>
/* === БОРИС: prefix bir-, scoped внутри #ai-intervyu-kandidatov-boris-block === */
#ai-intervyu-kandidatov-boris-block.bir-root{
  padding:clamp(40px,5vw,64px) 0;
  background:#f8fafc;
  border-top:1px solid rgba(148,163,184,.25);
  border-bottom:1px solid rgba(148,163,184,.25);
}
#ai-intervyu-kandidatov-boris-block .bir-cnt{
  max-width:1160px;margin:0 auto;padding:0 24px;
}
#ai-intervyu-kandidatov-boris-block .bir-card{
  display:grid;grid-template-columns:minmax(0,44%) minmax(0,56%);
  border-radius:22px;overflow:hidden;background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:min(520px,70vh);
}
@media(max-width:1023px){
  #ai-intervyu-kandidatov-boris-block .bir-card{grid-template-columns:1fr;min-height:auto;}
}
#ai-intervyu-kandidatov-boris-block .bir-lft{
  padding:40px 36px;display:flex;flex-direction:column;justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-intervyu-kandidatov-boris-block .bir-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}
}
#ai-intervyu-kandidatov-boris-block .bir-ey{
  display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;
  letter-spacing:.12em;text-transform:uppercase;color:#0ea5e9;margin:0 0 14px;
}
#ai-intervyu-kandidatov-boris-block .bir-ey::before{content:'';width:6px;height:6px;border-radius:50%;background:#22c55e;box-shadow:0 0 8px rgba(34,197,94,.6);}
#ai-intervyu-kandidatov-boris-block .bir-h3{font-size:clamp(20px,2.4vw,26px);line-height:1.2;color:#0f172a;margin:0 0 18px;font-weight:800;letter-spacing:-.03em;}
#ai-intervyu-kandidatov-boris-block .bir-ul{list-style:none;padding:0;margin:0 0 20px;}
#ai-intervyu-kandidatov-boris-block .bir-ul li{display:flex;gap:12px;align-items:flex-start;font-size:14px;line-height:1.55;color:#475569;margin-bottom:12px;}
#ai-intervyu-kandidatov-boris-block .bir-ic{
  flex-shrink:0;width:26px;height:26px;border-radius:8px;background:#f0f9ff;color:#0284c7;
  font-size:12px;font-weight:800;display:grid;place-items:center;border:1px solid #bae6fd;
}
#ai-intervyu-kandidatov-boris-block .bir-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:16px;}
#ai-intervyu-kandidatov-boris-block .bir-pl{
  font-size:11px;font-weight:700;padding:6px 12px;border-radius:999px;border:1px solid #e2e8f0;color:#334155;background:#f8fafc;
}
#ai-intervyu-kandidatov-boris-block .bir-pl-g{border-color:#bbf7d0;background:#f0fdf4;color:#15803d;}
#ai-intervyu-kandidatov-boris-block .bir-pl-v{border-color:#ddd6fe;background:#f5f3ff;color:#6d28d9;}
#ai-intervyu-kandidatov-boris-block .bir-foot{font-size:13px;color:#64748b;margin:0;}
#ai-intervyu-kandidatov-boris-block .bir-rgt{
  position:relative;min-height:380px;background:linear-gradient(145deg,#f1f5f9,#e2e8f0);
  display:flex;align-items:center;justify-content:center;padding:16px;
}
#ai-intervyu-kandidatov-boris-block .bir-rgt canvas{
  width:100%;height:100%;min-height:360px;display:block;border-radius:12px;
}
</style>
<div class="bir-cnt">
  <div class="bir-card">
    <div class="bir-lft">
      <span class="bir-ey">Оценочный лист · live</span>
      <h3 class="bir-h3">От отклика на hh.ru до scorecard в Huntflow — без ручного звонка</h3>
      <ul class="bir-ul">
        <li><span class="bir-ic">1</span>Кандидат проходит структурированное AI-интервью 24/7 по сценарию вакансии</li>
        <li><span class="bir-ic">2</span>LLM оценивает ответы по рубрике: компетенция → балл → комментарий</li>
        <li><span class="bir-ic">3</span>Оценочный лист и транскрипт попадают в карточку ATS автоматически</li>
        <li><span class="bir-ic">✓</span>Рекрутер видит shortlist и принимает финальное решение — human-in-the-loop</li>
      </ul>
      <div class="bir-pills">
        <span class="bir-pl bir-pl-g">23 ч → 3 ч</span>
        <span class="bir-pl">completion 84%</span>
        <span class="bir-pl bir-pl-v">explainable score</span>
      </div>
      <p class="bir-foot">Дальше разберём сценарий интервью под вакансию →</p>
    </div>
    <div class="bir-rgt">
      <canvas id="bir-hr-scorecard-canvas" aria-label="Анимация: кандидаты проходят AI-интервью, ответы оцениваются и формируют оценочный лист в ATS" role="img"></canvas>
    </div>
  </div>
</div>
<script>
(function(){
  'use strict';
  var cv = document.getElementById('bir-hr-scorecard-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0, cycleT = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = Math.max(360, p.clientHeight || 480);
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    bg:'#f1f5f9', ink:'#0f172a', muted:'#64748b', cyan:'#0ea5e9', violet:'#8b5cf6',
    green:'#22c55e', card:'#ffffff', bdr:'#cbd5e1', score:'#22c55e', warn:'#f59e0b'
  };

  function rr(x,y,w,h,r,fill,stroke){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=1.5; ctx.stroke(); }
  }

  var candidates = [];
  var scores = [];
  var atsAlpha = 0;

  function spawnCandidate(){
    candidates.push({
      x: W*0.08, y: H*0.25 + Math.random()*H*0.15,
      phase: 0, score: 0, name: ['Алексей','Мария','Иван','Ольга'][Math.floor(Math.random()*4)]
    });
  }

  function spawnScore(fromX, fromY, val){
    scores.push({x:fromX,y:fromY,tx:W*0.78,ty:H*0.32+scores.length*26,t:0,val:val,alpha:0});
  }

  function drawPerson(x,y,s,color){
    ctx.fillStyle = color;
    ctx.beginPath();
    ctx.arc(x, y-s*0.35, s*0.22, 0, Math.PI*2);
    ctx.fill();
    rr(x-s*0.28, y-s*0.05, s*0.56, s*0.55, s*0.12, color, null);
  }

  function drawAiBubble(x,y,w,h,text,pulse){
    rr(x,y,w,h,10,'#f5f3ff',C.violet);
    ctx.fillStyle = C.violet;
    ctx.font = 'bold 11px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('AI', x+w/2, y+18);
    ctx.fillStyle = C.muted;
    ctx.font = '9px system-ui,sans-serif';
    ctx.fillText(text, x+w/2, y+h-10);
    ctx.strokeStyle = C.violet;
    ctx.globalAlpha = 0.25 + pulse*0.35;
    ctx.beginPath();
    ctx.arc(x+w/2, y+h/2, w*0.55+pulse*6, 0, Math.PI*2);
    ctx.stroke();
    ctx.globalAlpha = 1;
  }

  function drawScorecard(x,y,w,h,alpha,rows){
    if(alpha<0.05) return;
    ctx.globalAlpha = alpha;
    rr(x,y,w,h,12,C.card,C.cyan);
    ctx.fillStyle = C.cyan;
    ctx.font = 'bold 12px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Оценочный лист · Huntflow', x+12, y+20);
    for(var i=0;i<rows.length;i++){
      var ry = y+32+i*24;
      rr(x+10,ry,w-20,20,5,'#f0f9ff',C.bdr);
      ctx.fillStyle = C.ink;
      ctx.font = '10px system-ui,sans-serif';
      ctx.fillText(rows[i], x+16, ry+14);
    }
  }

  function tick(){
    frame++;
    cycleT++;
    if(frame%100===0) spawnCandidate();

    var hubX = W*0.45, hubY = H*0.48, hubW = W*0.22, hubH = H*0.22;
    var pulse = 0.5+0.5*Math.sin(frame*0.07);

    ctx.fillStyle = C.bg;
    ctx.fillRect(0,0,W,H);

    ctx.fillStyle = C.muted;
    ctx.font = '10px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Отклики', W*0.06, H*0.1);
    ctx.textAlign = 'right';
    ctx.fillText('ATS', W*0.94, H*0.1);

    drawAiBubble(hubX-hubW/2, hubY-hubH/2, hubW, hubH, 'интервью + скоринг', pulse);

    candidates = candidates.filter(function(c){
      c.phase++;
      if(c.phase<80){
        c.x += 1.8;
        drawPerson(c.x, c.y, 28, C.cyan);
      } else if(c.phase<160){
        var dx = hubX-c.x, dy = hubY-c.y;
        c.x += dx*0.04; c.y += dy*0.04;
        drawPerson(c.x, c.y, 28, C.violet);
      } else if(c.phase<220){
        c.score = Math.min(10, c.score+0.15);
        if(c.phase===161) spawnScore(hubX, hubY, Math.floor(6+c.score));
        drawPerson(c.x, c.y, 24, C.muted);
      } else {
        return false;
      }
      return true;
    });

    scores = scores.filter(function(s){
      s.t += 0.03;
      s.alpha = Math.min(1, s.t*2.5);
      var ease = s.t*s.t*(3-2*s.t);
      var cx = s.x+(s.tx-s.x)*ease, cy = s.y+(s.ty-s.y)*ease;
      ctx.globalAlpha = s.alpha;
      rr(cx-28,cy-10,56,20,5,'#dcfce7',C.green);
      ctx.fillStyle = '#15803d';
      ctx.font = 'bold 10px system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText('+'+s.val, cx, cy+5);
      ctx.globalAlpha = 1;
      if(s.t>=1){ atsAlpha = Math.min(1, atsAlpha+0.02); return false; }
      return true;
    });

    var rows = ['Коммуникация: 8/10','Опыт: 7/10','Мотивация: 9/10','Итог: 82 · shortlist'];
    drawScorecard(W*0.68, H*0.22, W*0.26, H*0.38, atsAlpha, rows);

    if(cycleT>600){
      cycleT=0; candidates=[]; scores=[]; atsAlpha=0;
    }
    requestAnimationFrame(tick);
  }
  requestAnimationFrame(tick);
})();
</script>
</section>

<section class="aihr-section aihr-section-alt" id="kak-rabotaet">
  <div class="aihr-cnt">
    <div class="aihr-sh nero-ai-reveal">
      <span class="aihr-eyebrow">Сценарий</span>
      <h2>Как работает сценарий AI-интервью под вакансию</h2>
    </div>
    <div class="aihr-stepper nero-ai-reveal" aria-label="Схема: отклик → AI-интервью → оценочный лист в ATS"><div class="aihr-step"><span class="num">Шаг 1</span>Отклик в ATS</div><span class="arr" aria-hidden="true">→</span><div class="aihr-step"><span class="num">Шаг 2</span>Ссылка на интервью</div><span class="arr" aria-hidden="true">→</span><div class="aihr-step"><span class="num">Шаг 3</span>AI-скрининг</div><span class="arr" aria-hidden="true">→</span><div class="aihr-step"><span class="num">Шаг 4</span>Скоринг по рубрике</div><span class="arr" aria-hidden="true">→</span><div class="aihr-step"><span class="num">Шаг 5</span>Оценочный лист</div></div>
<p><strong>Коротко:</strong> рекрутер утверждает шаблон под вакансию → кандидат проходит интервью в удобное время → агент фиксирует ответы и считает score → в ATS появляется оценочный лист.</p>
<p>Схема «отклик → AI-интервью → оценочный лист в ATS»:</p>
<ol class="aihr-ol"><li>Кандидат откликается → ATS создаёт карточку → webhook запускает агента.</li><li>Кандидат получает ссылку или сообщение: «Пройдите 15-минутное интервью в удобное время».</li><li>Агент задаёт структурированные вопросы, уточняет knockout-критерии, отвечает на FAQ из базы знаний о компании.</li><li>Ответы транскрибируются; LLM оценивает по рубрике (компетенция → балл → комментарий).</li><li>В ATS записывается оценочный лист: итоговый score, сильные и слабые стороны, флаг «требует внимания рекрутера».</li><li>Рекрутер просматривает top-N; финальный отказ или приглашение — <strong>только человек</strong>.</li></ol>
<h3 id="shablon-voprosov">Шаблон вопросов под вакансию</h3>
<p>Лид-магнит Nero Network — <strong>шаблон AI-интервью под вакансию</strong>. В него входят:</p>
<ul><li>описание компетенций из JD;</li><li><strong>knockout-вопросы</strong> (медкнижка, права, график, локация) — жёсткий фильтр «релевантен / нет»;</li><li><strong>компетентностное интервью</strong> — открытые вопросы с рубрикой 1–5 или 0–10 (как в голосовом ИИ-интервьюере Xenia AI для РФ);</li><li>проходной балл и правила ветвления («если нет опыта — уточняющий блок»);</li><li>текст согласия на обработку ПДн и уведомление об AI-скрининге.</li></ul>
<p>Potok в своих сценариях описывает типовой поток: бот уточняет обязательные условия → фиксирует статус → рекрутер смотрит только прошедших фильтр (<a href="https://potok.io/features/avtomatizacziya-podbora-s-robotom-pomoshhnikom/" target="_blank" rel="noopener noreferrer">Potok, автоматизация с роботом-помощником</a>).</p>
<h3 id="kriterii-shortlist">Критерии оценки и shortlist для рекрутера</h3>
<p>Оценочный лист кандидата в ATS — не «решил алгоритм», а рабочий документ:</p>
<ul><li>транскрипт или ссылка на записи;</li><li>score по каждой компетенции;</li><li>итоговый ранг в вакансии;</li><li>аномалии (пустые ответы, off-topic) для ручной проверки.</li></ul>
<p>Eightfold AI на западном рынке продвигает <strong>section-level evidence</strong> в оценочном листе — каждый блок интервью с цитатами из ответов (<a href="https://eightfold.ai/products/ai-interviewer/" target="_blank" rel="noopener noreferrer">Eightfold AI Interviewer</a>). Для mid-market в России достаточно JSON-полей в Huntflow или кастомных полей в amoCRM: «AI score», «transcript URL».</p>
<p><strong>Что делает AI:</strong> генерирует и ведёт интервью, транскрибирует, скорит, ранжирует, отвечает на типовые вопросы о вакансии.</p>
<p><strong>Что остаётся за человеком:</strong> утверждение сценария и проходного балла, финальный отказ/приглашение, сложные эскалации, юридически значимые решения, контроль bias.</p>
  </div>
</section>

<aside class="ym-cta-block ym-cta-block--primary" id="cta-shablon-intervyu">
  <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Получите шаблон AI-интервью под вакансию</p>
    <p class="ym-cta-block__sub">Разберём одну типовую вакансию: knockout-вопросы, рубрика скоринга и проходной балл — до запуска пилота. Лид-магнит входит в аудит без обязательств.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Собрать интервью</a>
  </div>
</aside>

<section class="aihr-section" id="etapy">
  <div class="aihr-cnt">
    <div class="aihr-sh nero-ai-reveal">
      <span class="aihr-eyebrow">Под ключ</span>
      <h2>Внедрение AI интервью кандидатов под ключ: этапы и сроки</h2>
    </div>
    <div class="aihr-timeline nero-ai-reveal"><p>Ключевые запросы: <strong>внедрение ai интервью кандидатов</strong>, <strong>ai интервью кандидатов внедрение под ключ</strong>, <strong>внедрение ai в бизнес процессы</strong> — здесь важна прозрачная проектная модель, а не обещание «за три клика».</p>
<p>Nero Network внедряет <strong>ai интервью кандидатов для бизнеса</strong> и <strong>для компании</strong> как интеграционный проект с ориентиром чека <strong>150–450 тыс. ₽</strong> — ниша кастомной сборки под ATS/CRM клиента, а не только SaaS-подписки.</p>
<h3 id="audit-nayma">Аудит процесса найма</h3>
<p><strong>Фаза 0 (включена в лид-магнит):</strong> разбор 1–2 типовых вакансий, карта воронки от отклика до оффера, список обязательных вопросов скрининга, требования 152-ФЗ. На выходе — понимание, где теряется time-to-hire и сколько часов рекрутера уходит на первичный скрининг.</p>
<h3 id="nastroyka-scenarov">Настройка сценариев</h3>
<p><strong>Фаза 1 (1–2 недели):</strong> шаблон интервью, база знаний для ответов кандидату, рубрика скоринга, тексты согласий. Рекрутер и HR-директор утверждают knockout-вопросы и проходной балл — без этого агент не запускается в прод.</p>
<h3 id="pilot-masshtab">Пилот и масштабирование</h3>
<p><strong>Фаза 2–3 (2–5 недель):</strong> разработка агента (веб-виджет, Telegram, голос через Yandex SpeechKit + LLM), интеграции с ATS, webhook из hh.ru или формы на сайте.</p>
<p><strong>Фаза 4 (1 неделя):</strong> пилот на <strong>одной вакансии</strong>, 30–50 интервью. Метрики пилота: median time-to-screen, completion rate, % shortlist approved by recruiter. Доработка рубрики по факту.</p>
<p><strong>Итог:</strong> типовой пилот <strong>2–4 недели</strong> после аудита; масштабирование на другие вакансии — копирование шаблона с правкой компетенций.</p>
<p>Архитектура в открытую: <strong>Make/n8n + YandexGPT/GigaChat + webhooks ATS</strong> — клиент не привязан к «чёрному ящику», в отличие от части enterprise-SaaS.</p></div>
    
<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать n8n и human-in-the-loop до пилота?</p>
    <p class="ym-cta-block__sub">Перед внедрением AI-скрининга полезно разобраться в сценариях Make/n8n, промптах и контроле рекрутера над отказом — это ускоряет согласование с HR и IT. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: '#'); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI'); ?></a>.</p>
  </div>
</aside>

  </div>
</section>
<section class="aihr-section aihr-section-alt" id="integracii">
  <div class="aihr-cnt">
    <div class="aihr-sh nero-ai-reveal">
      <span class="aihr-eyebrow">Стек</span>
      <h2>Интеграция с ATS, CRM и hh.ru</h2>
    </div>
    <p>Запросы <strong>интеграция ai интервью кандидатов</strong>, <strong>ai интервью кандидатов интеграция crm</strong>, <strong>ai интервью кандидатов в CRM</strong> закрываются не «ещё одним кабинетом», а надстройкой на существующий контур найма.</p>
<h3 id="ats-scenarii">Huntflow, Potok, amoCRM — типовые сценарии передачи оценочного листа</h3>
<div class="aihr-table-wrap"><table class="aihr-table aihr-compare-table"><thead><tr><th>Система</th><th>Как подключается агент</th><th>Что попадает в карточку</th></tr></thead><tbody><tr><td><strong>Huntflow</strong></td><td>API и webhooks (<a href="https://huntflow.media/integracii-huntflow/" target="_blank" rel="noopener noreferrer">интеграции Huntflow</a>)</td><td>score, транскрипт, статус «AI-скрининг пройден»</td></tr><tr><td><strong>Potok</strong></td><td>чат-боты и ИИ-рекрутер в мессенджере/телефоне</td><td>фильтр релевантности, видеоинтервью по ссылке</td></tr><tr><td><strong>amoCRM</strong></td><td>кастомные поля, REST</td><td>AI score, ссылка на отчёт, этап воронки</td></tr><tr><td><strong>hh.ru</strong></td><td>ссылка на интервью в отклике / партнёрские интеграции (Xenia AI)</td><td>кандидат проходит скрининг до звонка рекрутера</td></tr></tbody></table></div>
<p>Xenia AI (СПб) — эталон UX для РФ: рекрутер задаёт сценарий → кандидат проходит голосовое интервью в браузере без установки ПО → рекрутер получает ранжированный список; заявлены интеграции с hh.ru, Huntflow, Potok, Talantix (<a href="https://xeniaai.com/" target="_blank" rel="noopener noreferrer">xeniaai.com</a>).</p>
<p>Huntflow AI в пилоте показывал сокращение срока закрытия: <strong>младший грейд 20 → 9 дней</strong>, <strong>средний 60 → 32 дня</strong> (данные вендора по согласившимся на эксперимент клиентам, <a href="https://huntflow.media/huntflow_ai/" target="_blank" rel="noopener noreferrer">Huntflow AI</a>).</p>
<p><strong>Позиция Nero Network:</strong> ваш ATS не заменяем — агент пишет в него оценочный лист. «У нас уже есть Huntflow/Potok» — аргумент <strong>для</strong> внедрения, а не против.</p>
<p>Дополнительные каналы: Telegram, WhatsApp Business API, VK; формы Tilda/WordPress; уведомление рекрутеру при score выше порога.</p>
  </div>
</section>
<section class="aihr-section" id="ceny">
  <div class="aihr-cnt">
    <div class="aihr-sh nero-ai-reveal">
      <span class="aihr-eyebrow">Бюджет</span>
      <h2>Сколько стоит внедрение: цена, чек и ROI</h2>
    </div>
    <p>Запросы <strong>ai интервью кандидатов цена</strong>, <strong>сколько стоит ai интервью кандидатов</strong>, <strong>ai интервью кандидатов заказать</strong> требуют честной сметы без выдуманных «3000% ROI».</p>
<h3 id="orientir-ceny">Ориентир 150–450 тыс. ₽</h3>
<p>Коммерческий чек Nero Network <strong>150–450 тыс. ₽</strong> покрывает:</p>
<ul><li>аудит и шаблон интервью;</li><li>настройку агента (чат/голос);</li><li>интеграцию с 1–2 системами (ATS/CRM);</li><li>пилот на одной вакансии и обучение HR.</li></ul>
<p>Это <strong>ниже</strong> enterprise-контуров (западные Paradox/Workday — ориентиры <strong>$25K–100K+/год</strong> по обзорам рынка) и <strong>гибче</strong> чистого SaaS, когда нужен white-label или мульти-клиент для агентства.</p>
<p>Сравнение <strong>SaaS (Xenia, Собесо) vs кастом Nero Network</strong>:</p>
<div class="aihr-table-wrap"><table class="aihr-table aihr-compare-table"><thead><tr><th></th><th>SaaS-интервьюер</th><th>Кастом Nero Network</th></tr></thead><tbody><tr><td>Стоимость</td><td>Подписка, часто без публичной цены</td><td>Проект 150–450 тыс. ₽</td></tr><tr><td>ATS</td><td>Заявленные интеграции</td><td>Сборка под <strong>ваш</strong> Huntflow/Potok/amoCRM</td></tr><tr><td>152-ФЗ</td><td>Разный уровень детализации</td><td>Compliance-by-design в ТЗ</td></tr><tr><td>Архитектура</td><td>Закрытый продукт</td><td>n8n/Make + YandexGPT/GigaChat</td></tr><tr><td>Агентство</td><td>Ограниченный white-label</td><td>Сценарии мульти-клиента</td></tr></tbody></table></div>
<h3 id="metriki-roi">Метрики — время рекрутера, качество shortlist</h3>
<p>ROI считается на пилоте, без гарантий «как у Сбера для всех»:</p>
<ul><li><strong>Время рекрутера на скрининг</strong> — Potok маркетирует ориентир «250 звонков за 2,4 мин vs 4,17 ч рекрутера» (по данным Potok — использовать как ориентир, не как обещание).</li><li><strong>Time-to-screen</strong> — Сбер «ГигаРекрутер»: от отклика до первичной оценки <strong>с 23 до 3 часов</strong> (≈8×), <strong>130+ тыс. интервью</strong> к началу 2026 (<a href="https://www.cnews.ru/news/line/2026-05-05_sberbank_uskoril_rabotu" target="_blank" rel="noopener noreferrer">CNews, май 2026</a>).</li><li><strong>Первый контакт</strong> — МегаФон + Vocamate AI: <strong>+30%</strong> назначенных собеседований, <strong>30% вакансий</strong> закрыты с помощью автоматизированного подбора за 9 месяцев (<a href="https://www.cnews.ru/news/line/2026-04-14_megafon_vnedril_robotov-rekruterov" target="_blank" rel="noopener noreferrer">CNews, апрель 2026</a>).</li><li><strong>Completion rate</strong> — пилот HireVue AdventHealth: <strong>86%</strong> completion, <strong>79% быстрее</strong> путь до ревью hiring manager, <strong>10 ч/нед</strong> возвращается рекрутеру (<a href="https://www.hirevue.com/platform/ai-interviewer" target="_blank" rel="noopener noreferrer">HireVue</a>).</li><li><strong>Качество shortlist</strong> — % кандидатов из AI-shortlist, которых рекрутер подтверждает на очном этапе (метрика пилота Nero Network).</li></ul>
<p>Медианный time-to-hire <strong>38 дней</strong> в отрасли; AI-инструменты в среднем дают <strong>+26% скорости</strong> (<a href="https://ta.smartrecruiters.com/rs/664-NIC-529/images/Recruitment-Benchmarks-2025-Report.pdf" target="_blank" rel="noopener noreferrer">SmartRecruiters 2025</a>). Ваш пилот должен сравнить «до/после» на одной вакансии.</p>
  </div>
</section>
<section class="aihr-section" id="keisy">
  <div class="aihr-cnt">
    <div class="aihr-sh nero-ai-reveal">
      <span class="aihr-eyebrow">Кейсы</span>
      <h2>Кейсы и примеры внедрения AI-рекрутера</h2>
    </div>
    <div class="aihr-case-grid">
      <div class="aihr-case-card nero-ai-reveal"><div class="aihr-case-tag">РФ · Сбер</div><h3>ГигаРекрутер</h3><p>130+ тыс. AI-интервью; time-to-screen <strong>23 ч → 3 ч</strong> (≈8×).</p><div class="aihr-metric"><span class="num">8×</span><span class="lbl">ускорение первичной оценки</span></div></div>
      <div class="aihr-case-card nero-ai-reveal nero-ai-delay-1"><div class="aihr-case-tag">РФ · МегаФон</div><h3>Vocamate AI</h3><p>30% вакансий закрыты с автоподбором; <strong>+30%</strong> назначенных собеседований.</p><div class="aihr-metric"><span class="num">+30%</span><span class="lbl">первый контакт</span></div></div>
      <div class="aihr-case-card nero-ai-reveal nero-ai-delay-2"><div class="aihr-case-tag">РФ · Huntflow</div><h3>Huntflow AI пилот</h3><p>Младший грейд <strong>20 → 9 дней</strong>, средний <strong>60 → 32 дней</strong> (данные вендора).</p><div class="aihr-metric"><span class="num">20→9</span><span class="lbl">дней закрытия</span></div></div>
    </div>
    <div class="nero-ai-reveal" style="margin-top:32px"><p>Запросы <strong>ai интервью кандидатов кейсы</strong>, <strong>ai интервью кандидатов примеры внедрения</strong> — с опорой на публичные данные, без выдуманных «наших клиентов».</p>
<h3 id="keis-agentstvo">Рекрутинговое агентство</h3>
<p>Агентству с десятками вакансий критичны: единый шаблон скрининга, передача оценочного листа в ATS клиента, скорость первого контакта. Международный кейс Paradox Olivia (ритейл, HoReCa): Chipotle — <strong>75% faster hiring</strong>; GM — <strong>$2M saved annually</strong>; 7-Eleven — <strong>40 000 hours saved weekly</strong> (данные Paradox/Index.dev). Для РФ-агентства аналог — кастомный агент с white-label и интеграцией в Huntflow/Potok, а не покупка западного enterprise.</p>
<p>Т1 «Юнион» + «Релевантер»: ИИ анализирует резюме, проводит интервью, формирует профили; заявлено <strong>−20% затрат</strong> на поиск (<a href="https://www.cnews.ru/news/line/2026-04-06_integratsiya_yunion_i_relevanter" target="_blank" rel="noopener noreferrer">CNews, апрель 2026</a>). Аргумент для страницы: AI-интервью — первый модуль в цепочке ATS → оценка → оффер.</p>
<h3 id="keis-inhouse">In-house HR при массовом найме</h3>
<p>Сбербанк «ГигаРекрутер»: пилот с сентября 2025; ИИ-агент проводит первичные интервью, анализирует резюме, генерирует индивидуальные вопросы, готовит отчёт с рекомендациями. «Внедрение ИИ-агентов меняет саму модель подбора. Рекрутер становится… управляет цифровыми инструментами» — <strong>Анна Овчинникова</strong>, Сбербанк (<a href="https://www.cnews.ru/news/line/2026-05-05_sberbank_uskoril_rabotu" target="_blank" rel="noopener noreferrer">CNews</a>).</p>
<p>МегаФон: голосовые роботы и чат-боты для массового найма в салоны связи — первичный отбор, запись на собеседование, обработка входящих откликов.</p>
<p><strong>Вывод:</strong> публичных кейсов в РФ достаточно — рынок не пустой. Для mid-market ниша Nero Network — <strong>кастомная сборка под их ATS</strong>, не коробочный enterprise.</p>
<p>Международный контекст (HireVue, Eightfold, Paradox acquired by Workday ~$1B, октябрь 2025): structured interview и explainable scoring переносятся; enterprise-цены и зарубежные SaaS без локализации ПДн — <strong>не переносятся</strong> в РФ без DPA и серверов в России.</p></div>
  </div>
</section>
<section class="aihr-section aihr-section-alt" id="compliance">
  <div class="aihr-cnt">
    <div class="aihr-sh nero-ai-reveal">
      <span class="aihr-eyebrow">Compliance</span>
      <h2>152-ФЗ, персональные данные и этика AI-скрининга</h2>
    </div>
    <div class="aihr-compliance nero-ai-reveal"><p>Блок compliance обязателен: <strong>152 фз персональные данные кандидатов</strong>, <strong>bias ai оценка кандидатов</strong>, прозрачность для кандидата.</p>
<p><strong>Коротко:</strong> специального запрета на AI-интервью в РФ нет; действуют 152-ФЗ и ТК РФ (<a href="https://kontur.ru/articles/29306-ii_pri_najme_sotrudnikov_riski" target="_blank" rel="noopener noreferrer">Контур.Эксперт</a>, <a href="https://potok.io/blog/hr-review/152-fz/" target="_blank" rel="noopener noreferrer">Potok / 152-ФЗ</a>).</p>
<p>Чек-лист для HR:</p>
<ol class="aihr-ol"><li><strong>Ст. 16 152-ФЗ</strong> — решения, затрагающие права кандидата, <strong>не принимаются исключительно автоматически</strong> без письменного согласия и возможности обжалования с участием человека (<a href="https://amulex.ru/daily/trudovoe-pravo/chto-obsuzhdayut-zapret-ii-pri-pervichnom-otbore-kandidatov-2362-n8ngt/" target="_blank" rel="noopener noreferrer">Amulex</a>).</li><li><strong>Ст. 64 ТК РФ</strong> — по запросу кандидата мотивированный отказ в течение <strong>7 рабочих дней</strong>; «решил алгоритм» не освобождает работодателя.</li><li><strong>Согласие с 01.09.2025</strong> — отдельный документ, не вшитый в договор/анкету (Potok).</li><li><strong>Локализация</strong> — хранение и обработка ПДн на серверах в РФ; с 1 июля 2025 ужесточены штрафы за трансграничную передачу (обзоры указывают до <strong>500 млн ₽</strong> — проверять актуальные редакции, <a href="https://naimee.ai/hrzavtra/ii-ili-shtraf-na-500-mln-novye-pravila-hr-s-1-iyulya-2025" target="_blank" rel="noopener noreferrer">Naimee</a>).</li><li><strong>Биометрия</strong> — анализ видео/голоса для идентификации требует отдельного согласия (Контур).</li><li><strong>Bias</strong> — фиксированные вопросы для всех; без анализа мимики (тренд HireVue с 2021); периодический аудит рубрики.</li></ol>
<p><strong>Позиция Nero Network:</strong> AI готовит оценочный лист и ранжирование; <strong>отказ и оффер — за рекрутером</strong>; в интерфейсе кандидата — прозрачное уведомление об AI-скрининге. «ИИ — инструмент, а не субъект права: вся ответственность за решения лежит на работодателе» — Контур.Эксперт.</p>
<p>ФЗ № 243-ФЗ о поддержке развития технологий ИИ (подписан 26.07.2026, вступает с 01.09.2026) — рамочный, не запрет HR-AI (<a href="https://www.garant.ru/news/2171301/" target="_blank" rel="noopener noreferrer">ГАРАНТ</a>).</p></div>
  </div>
</section>
<section class="aihr-section aihr-section-alt" id="faq">
  <div class="aihr-cnt">
    <div class="aihr-sh nero-ai-reveal">
      <span class="aihr-eyebrow">Вопрос — ответ</span>
      <h2>FAQ: внедрение без программиста и для малого бизнеса</h2>
    </div>
    <div class="aihr-faq nero-ai-reveal"><details class="aihr-faq-item"><summary>Как внедрить ai интервью кандидатов?</summary><div class="aihr-faq-a"><p>Аудит вакансии → шаблон вопросов и рубрика → настройка агента и интеграция с ATS → пилот 30–50 интервью → масштабирование. Nero Network ведёт проект под ключ; от HR нужны JD, эталонные вопросы, доступ к API ATS, политика ПДн.</p></div></details><details class="aihr-faq-item"><summary>Сколько стоит ai интервью кандидатов?</summary><div class="aihr-faq-a"><p>Ориентир <strong>150–450 тыс. ₽</strong> за внедрение с пилотом на одной вакансии. Точная смета после аудита: канал (чат/голос), число интеграций, white-label для агентства.</p></div></details><details class="aihr-faq-item"><summary>AI интервью кандидатов без программиста — реально?</summary><div class="aihr-faq-a"><p>Да, на стороне клиента: не нужен штатный разработчик, если интегратор подключает webhook и поля в ATS. Low-code (n8n/Make) снижает зависимость от «чёрного ящика».</p></div></details><details class="aihr-faq-item"><summary>AI интервью кандидатов для малого бизнеса</summary><div class="aihr-faq-a"><p>Доступно при <strong>массовом найме</strong> (5+ откликов в день на линейную вакансию). Старт с <strong>одной вакансии</strong> — минимальный риск. Для редких senior-позиций ROI скрининга ниже.</p></div></details><details class="aihr-faq-item"><summary>Можно ли начать с одной вакансии?</summary><div class="aihr-faq-a"><p>Да. Пилотная модель Nero Network: одна вакансия, 30–50 интервью, метрики до/после, затем тиражирование шаблона.</p></div></details><details class="aihr-faq-item"><summary>Что нужно от HR-команды?</summary><div class="aihr-faq-a"><p>Описание вакансии и компетенций; 5–15 эталонных вопросов (или шаблон от Nero); политика ПДн; утверждение проходного балла; ревью shortlist после пилота.</p></div></details><details class="aihr-faq-item"><summary>Заменит ли AI рекрутера?</summary><div class="aihr-faq-a"><p>Нет. Jorge Amar, McKinsey: HR не будет вручную скринить каждое резюме, но критичен change management (<a href="https://www.mckinsey.com/capabilities/people-and-organizational-performance/our-insights/the-future-of-work-is-agentic" target="_blank" rel="noopener noreferrer">The future of work is agentic</a>). Обзоры с отсылкой к McKinsey: использовать AI для тегирования и классификации, <strong>но не для финального hiring decision</strong> (<a href="https://happily.ai/blog/the-current-state-of-ai-agents-and-agentic-ai-for-hr-where-its-ready-and-where-its-not/" target="_blank" rel="noopener noreferrer">Happily.ai</a>).</p></div></details><details class="aihr-faq-item"><summary>Как кандидат узнает, что говорит с AI?</summary><div class="aihr-faq-a"><p>Уведомление перед интервью, согласие на обработку ПДн, возможность задать вопросы человеку. Прозрачность снижает негатив; быстрый feedback повышает completion (ориентир 86% в пилотах HireVue).</p></div></details><details class="aihr-faq-item"><summary>AI отсеет хороших кандидатов?</summary><div class="aihr-faq-a"><p>Structured interview + транскрипт для рекрутера + финал за человеком. Возражение «bias» закрывается фиксированными вопросами и аудитом рубрики.</p></div></details><details class="aihr-faq-item"><summary>У нас уже есть Huntflow/Potok — зачем агент?</summary><div class="aihr-faq-a"><p>Агент — надстройка: автоматизирует интервью и пишет оценочный лист в карточку, ATS остаётся центром найма.</p></div></details></div>
  </div>
</section>
<section class="aihr-section" id="zakazat">
  <div class="aihr-cnt">
    <div class="aihr-sh nero-ai-reveal">
      <span class="aihr-eyebrow">CTA</span>
      <h2>Заказать внедрение AI-агента для первичного интервью</h2>
    </div>
    <div class="nero-ai-reveal"><p><strong>Разработка ai интервью кандидатов</strong> и <strong>интеграция ai интервью кандидатов</strong> в ваш контур найма — профильная услуга Nero Network: не продажа «ещё одного кабинета», а сборка агента под вашу ATS/CRM с compliance-by-design и честным пилотом.</p>
<p><strong>Что вы получаете:</strong></p>
<ul><li>шаблон AI-интервью под вакансию (лид-магнит);</li><li>агент в чате, Telegram или голосе;</li><li>оценочный лист и score в Huntflow, Potok, amoCRM или Bitrix24;</li><li>пилот с метриками time-to-screen и качества shortlist;</li><li>документацию для HR по 152-ФЗ и human-in-the-loop.</li></ul>
<p><strong>CTA:</strong> <strong>Собрать интервью</strong> — начните с аудита одной вакансии и получите шаблон сценария до запуска пилота.</p>
<p>Уникальный угол Nero Network против конкурентов (Xenia, Собесо, Афина, enterprise Fedor24): прозрачная смета 150–450 тыс. ₽, открытая архитектура, юридический блок сильнее SaaS-лендингов, фокус на рекрутинговые агентства и mid-market с массовым наймом — не только enterprise как Сбер.</p>
<p><strong>Итог:</strong> ai интервью кандидатов под ключ в 2026 — рабочий инструмент при массовом найме, если агент структурирует скрининг, интегрируется с ATS и оставляет финальное решение рекрутеру. Nero Network внедряет такие системы с пилотом, метриками и соблюдением 152-ФЗ — от отклика до оценочного листа в вашей CRM.</p></div>
    
<div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Готовы запустить AI-скрининг на одной вакансии?</p>
    <p class="ym-cta-block__sub">Пилот 2–4 недели, ориентир 150–450 тыс. ₽, интеграция с Huntflow, Potok или amoCRM. Следующий шаг — аудит вакансии и шаблон сценария интервью.</p>
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Собрать интервью</a>
      <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения →</a>
    </div>
  </div>
</div>

  </div>
</section>

<section class="aihr-section aihr-section-alt" id="smeshnye-materialy" aria-label="Смежные материалы по внедрению AI">
  <div class="aihr-cnt">
    <div class="aihr-sh aihr-left nero-ai-reveal">
      <span class="aihr-eyebrow">Смежные сценарии</span>
      <h2>Другие проекты Nero Network по AI-агентам</h2>
      <p>HR-скрининг часто идёт в одном контуре с CRM и операционной автоматизацией — полезные смежные материалы:</p>
    </div>
    <div class="aihr-grid-2 nero-ai-reveal">
      <div class="aihr-card">
        <p>Кастомные поля и воронка в amoCRM: <a href="/vnedrenie-ai-amocrm/">внедрение AI-агента в amoCRM под ключ</a> — когда оценочный лист и score нужно писать не только в Huntflow.</p>
      </div>
      <div class="aihr-card">
        <p>Отклики и письма до карточки кандидата: <a href="/vnedrenie-ai-obrabotka-email-crm/">AI-обработка входящей почты в CRM</a> — triage входящего потока до этапа скрининга.</p>
      </div>
      <div class="aihr-card">
        <p>Корпоративный учёт и документооборот: <a href="/ai-1c-erp/">AI-агент для 1С и ERP</a> — внедрение агентов в бизнес-процессы рядом с HR.</p>
      </div>
      <div class="aihr-card">
        <p>Enterprise-масштаб: <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/">KPMG и Claude — уроки AI для бизнеса</a> — цифровые шлюзы и managed-агенты, применимые к операционке.</p>
      </div>
    </div>
  </div>
</section>
</div><!-- /.aihr-content -->

  <?php
  $schema_home     = trailingslashit(home_url('/'));
  $schema_page_url = trailingslashit(get_permalink());
  $schema_org_id   = $schema_home . '#organization';
  $schema_site_id  = $schema_home . '#website';
  $schema_brand    = get_bloginfo('name');
  $schema_title    = 'AI-агент для первичного интервью кандидатов: внедрение под ключ';
  $schema_desc     = 'Внедрим AI-агента для первичного интервью кандидатов: скрининг по сценарию вакансии, фиксация ответов и оценочный лист для рекрутера. Интеграция с ATS/CRM, цена, кейсы и этапы под ключ.';
  $schema_faq = [
    ['q' => 'Как внедрить ai интервью кандидатов?', 'a' => 'Аудит вакансии → шаблон вопросов и рубрика → настройка агента и интеграция с ATS → пилот 30–50 интервью → масштабирование. Nero Network ведёт проект под ключ; от HR нужны JD, эталонные вопросы, доступ к API ATS, политика ПДн.'],
    ['q' => 'Сколько стоит ai интервью кандидатов?', 'a' => 'Ориентир 150–450 тыс. ₽ за внедрение с пилотом на одной вакансии. Точная смета после аудита: канал (чат/голос), число интеграций, white-label для агентства.'],
    ['q' => 'AI интервью кандидатов без программиста — реально?', 'a' => 'Да, на стороне клиента: не нужен штатный разработчик, если интегратор подключает webhook и поля в ATS. Low-code (n8n/Make) снижает зависимость от «чёрного ящика».'],
    ['q' => 'AI интервью кандидатов для малого бизнеса', 'a' => 'Доступно при массовом найме (5+ откликов в день на линейную вакансию). Старт с одной вакансии — минимальный риск. Для редких senior-позиций ROI скрининга ниже.'],
    ['q' => 'Можно ли начать с одной вакансии?', 'a' => 'Да. Пилотная модель Nero Network: одна вакансия, 30–50 интервью, метрики до/после, затем тиражирование шаблона.'],
    ['q' => 'Что нужно от HR-команды?', 'a' => 'Описание вакансии и компетенций; 5–15 эталонных вопросов (или шаблон от Nero); политика ПДн; утверждение проходного балла; ревью shortlist после пилота.'],
    ['q' => 'Заменит ли AI рекрутера?', 'a' => 'Нет. Jorge Amar, McKinsey: HR не будет вручную скринить каждое резюме, но критичен change management. Обзоры с отсылкой к McKinsey: использовать AI для тегирования и классификации, но не для финального hiring decision.'],
    ['q' => 'Как кандидат узнает, что говорит с AI?', 'a' => 'Уведомление перед интервью, согласие на обработку ПДн, возможность задать вопросы человеку. Прозрачность снижает негатив; быстрый feedback повышает completion (ориентир 86% в пилотах HireVue).'],
    ['q' => 'AI отсеет хороших кандидатов?', 'a' => 'Structured interview + транскрипт для рекрутера + финал за человеком. Возражение «bias» закрывается фиксированными вопросами и аудитом рубрики.'],
    ['q' => 'У нас уже есть Huntflow/Potok — зачем агент?', 'a' => 'Агент — надстройка: автоматизирует интервью и пишет оценочный лист в карточку, ATS остаётся центром найма.'],
  ];
  $schema_graph = [
    ['@type' => 'Organization', '@id' => $schema_org_id, 'name' => $schema_brand, 'url' => $schema_home],
    ['@type' => 'WebSite', '@id' => $schema_site_id, 'url' => $schema_home, 'name' => $schema_brand, 'publisher' => ['@id' => $schema_org_id]],
    ['@type' => 'WebPage', '@id' => $schema_page_url . '#webpage', 'url' => $schema_page_url, 'name' => $schema_title, 'description' => $schema_desc, 'isPartOf' => ['@id' => $schema_site_id], 'about' => ['@id' => $schema_org_id]],
    ['@type' => 'BreadcrumbList', '@id' => $schema_page_url . '#breadcrumb', 'itemListElement' => [
      ['@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $schema_home],
      ['@type' => 'ListItem', 'position' => 2, 'name' => $schema_title, 'item' => $schema_page_url],
    ]],
    ['@type' => 'Service', '@id' => $schema_page_url . '#service', 'name' => $schema_title, 'description' => $schema_desc, 'url' => $schema_page_url, 'provider' => ['@id' => $schema_org_id]],
    ['@type' => 'FAQPage', '@id' => $schema_page_url . '#faq', 'mainEntity' => array_map(static function (array $item): array {
      return ['@type' => 'Question', 'name' => $item['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $item['a']]];
    }, $schema_faq)],
  ];
  ?>
  <script type="application/ld+json">
  <?php echo wp_json_encode(['@context' => 'https://schema.org', '@graph' => $schema_graph], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
  </script>

</main>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.ai-intervyu-kandidatov-page') || document.querySelector('.aihr-content');
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
    }, { threshold: 0.1, rootMargin: '0px 0px -6% 0px' });
    items.forEach(function(item){ observer.observe(item); });
  } else {
    items.forEach(function(item){ item.classList.add('nero-ai-active'); });
  }
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

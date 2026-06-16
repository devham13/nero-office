<?php
/**
 * Template Name: AI для юристов: внедрение и настройка под ключ
 * Description: SEO-лендинг — внедрение AI-помощника для юристов. AI-бриф, CRM, human-in-the-loop.
 */

declare(strict_types=1);

$page_seo_title       = 'AI для юристов: внедрение и настройка AI-помощника под ключ';
$page_seo_description = 'Внедрение AI-помощника для юристов под ключ: сбор первичных данных, AI-бриф для консультации, интеграция с CRM. Ускорение заявок с контролем юриста. Кейсы и аудит.';

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
    ['label' => 'Зачем AI', 'href' => '#zachem-ai'],
    ['label' => 'Решение', 'href' => '#chto-delaet'],
    ['label' => 'Внедрение', 'href' => '#kak-rabotaet'],
    ['label' => 'CRM', 'href' => '#integracii-crm'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#cena'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Получить пример брифа';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#kak-rabotaet';
if ($secondary_cta_url === '' || $secondary_cta_url === '#') {
    $secondary_cta_url = '#kak-rabotaet';
}

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
/* Kadence layout reset + hero-first landing */
body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header {
  display: none !important;
}
body.nero-ai-landing {
  padding-top: 0 !important;
}

.breadcrumbs, .breadcrumb, .breadcrumb-list, .breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb, .rank-math-breadcrumb, .rank-math-breadcrumbs,
.yoast-breadcrumb, .entry-header, .page-title-section {
  display: none !important;
}

#primary, .site-main, .site-content, #content, .content-area {
  padding-top: 0 !important;
  margin-top: 0 !important;
}

/* Hero full viewport (agent-pipeline-pitfalls) */
.ai-dlya-yuristov-page .adl-hero-legal.nero-ai-hero {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}

/* Reveal compat inside adl-content */
.ai-dlya-yuristov-page .nero-ai-reveal {
  opacity: 0;
  transform: translateY(22px);
  transition: opacity 0.55s ease, transform 0.55s ease;
}
.ai-dlya-yuristov-page .nero-ai-reveal.nero-ai-active {
  opacity: 1;
  transform: none;
}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-dlya-yuristov-page" role="main" tabindex="-1">

<section class="nero-ai-hero adl-hero-legal" id="adl-hero-legal" aria-labelledby="adl-hero-legal-title">
<style>
/* === АЛИНА: hero ai-dlya-yuristov — самодостаточные стили === */
.adl-hero-legal {
  --adl-bg: #050711;
  --adl-bg2: #080b17;
  --adl-text: #cbd5e1;
  --adl-heading: #f8fafc;
  --adl-muted: #94a3b8;
  --adl-cyan: #79f2ff;
  --adl-amber: #f59e0b;
  --adl-border: rgba(148, 163, 184, 0.14);
  --adl-shadow: 0 28px 80px rgba(0, 0, 0, 0.55);
  position: relative;
  padding: clamp(108px, 14vh, 148px) 0 clamp(64px, 8vw, 80px);
  background:
    radial-gradient(ellipse 70% 55% at 78% 18%, rgba(121, 242, 255, 0.14), transparent 58%),
    radial-gradient(ellipse 55% 45% at 12% 82%, rgba(245, 158, 11, 0.10), transparent 62%),
    linear-gradient(180deg, var(--adl-bg) 0%, var(--adl-bg2) 100%);
  color: var(--adl-text);
  font-family: Inter, system-ui, -apple-system, sans-serif;
  overflow: hidden;
}
.adl-hero-legal *,
.adl-hero-legal *::before,
.adl-hero-legal *::after { box-sizing: border-box; }
.adl-hero-legal .nero-ai-container {
  width: min(1200px, 92vw);
  margin: 0 auto;
}
.adl-hero-legal .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1fr) minmax(0, 1.08fr);
  gap: clamp(32px, 5vw, 56px);
  align-items: center;
}
.adl-hero-legal .nero-ai-eyebrow {
  display: inline-block;
  margin: 0 0 14px;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--adl-cyan);
}
.adl-hero-legal h1 {
  margin: 0 0 18px;
  font-size: clamp(34px, 5vw, 56px);
  font-weight: 800;
  line-height: 1.08;
  letter-spacing: -0.03em;
  color: var(--adl-heading);
}
.adl-hero-legal .nero-ai-gradient-text {
  display: block;
  margin-top: 6px;
  background: linear-gradient(90deg, var(--adl-cyan), #a78bfa 55%, var(--adl-amber));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.adl-hero-legal .nero-ai-hero-lead {
  margin: 0;
  max-width: 640px;
  font-size: clamp(17px, 2vw, 20px);
  line-height: 1.6;
  color: var(--adl-muted);
}
.adl-hero-legal .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 28px 0 0;
  padding: 0;
  list-style: none;
}
.adl-hero-legal .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: #d9f7ff;
  font-size: 12px;
  font-weight: 700;
}
.adl-hero-legal .nero-ai-badge:nth-child(4) {
  border-color: rgba(245, 158, 11, 0.28);
  background: rgba(245, 158, 11, 0.10);
  color: #fde68a;
}
.adl-hero-legal .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  margin-top: 34px;
}
.adl-hero-legal .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-height: 48px;
  padding: 14px 22px;
  border-radius: 999px;
  border: 1px solid transparent;
  font-size: 15px;
  font-weight: 800;
  line-height: 1;
  text-decoration: none !important;
  transition: transform 0.22s ease, box-shadow 0.22s ease, background 0.22s ease;
}
.adl-hero-legal .nero-ai-btn:hover { transform: translateY(-2px); }
.adl-hero-legal .nero-ai-btn-primary {
  color: #041018 !important;
  background: linear-gradient(135deg, var(--adl-cyan), #38bdf8 55%, #a78bfa);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.adl-hero-legal .nero-ai-btn-secondary {
  color: var(--adl-heading) !important;
  background: rgba(255, 255, 255, 0.06);
  border-color: var(--adl-border);
}
.adl-hero-legal .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--adl-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.adl-hero-legal .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255, 255, 255, 0.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, 0.95), rgba(6, 10, 24, 0.96));
}
.adl-hero-legal .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  background: rgba(255, 255, 255, 0.045);
}
.adl-hero-legal .nero-ai-dots { display: flex; gap: 7px; }
.adl-hero-legal .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.adl-hero-legal .nero-ai-dot:nth-child(1) { background: #fb7185; }
.adl-hero-legal .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.adl-hero-legal .nero-ai-dot:nth-child(3) { background: #34d399; }
.adl-hero-legal .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: 0.08em;
  text-transform: uppercase;
}
.adl-hero-legal .nero-ai-window-body { padding: 16px; }
.adl-hero-legal .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.adl-hero-legal .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.adl-hero-legal .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(34, 197, 94, 0.10);
  color: #bbf7d0;
  font-size: 12px;
  font-weight: 800;
  white-space: nowrap;
}
.adl-hero-legal .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.14);
  animation: adlPulse 1.6s infinite;
}
@keyframes adlPulse {
  0%, 100% { transform: scale(0.86); opacity: 0.65; }
  50% { transform: scale(1); opacity: 1; }
}
.adl-hero-legal .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.adl-hero-legal .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255, 255, 255, 0.09);
  border-radius: 16px;
  background: rgba(255, 255, 255, 0.055);
}
.adl-hero-legal .nero-ai-metric span {
  display: block;
  color: var(--adl-muted);
  font-size: 11px;
  font-weight: 700;
}
.adl-hero-legal .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.adl-hero-legal .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.adl-hero-legal .adl-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.18);
  background: radial-gradient(ellipse at 28% 42%, rgba(121, 242, 255, 0.08), rgba(6, 10, 24, 0.92) 72%);
}
.adl-hero-legal #adl-legal-intake-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.adl-hero-legal .nero-ai-task-stream { display: grid; gap: 8px; }
.adl-hero-legal .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 14px;
  background: rgba(255, 255, 255, 0.04);
}
.adl-hero-legal .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121, 242, 255, 0.12);
  color: var(--adl-cyan);
  font-size: 11px;
  font-weight: 800;
}
.adl-hero-legal .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.adl-hero-legal .nero-ai-task span {
  color: var(--adl-muted);
  font-size: 11px;
}
.adl-hero-legal .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34, 197, 94, 0.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.adl-hero-legal .nero-ai-status--amber {
  background: rgba(245, 158, 11, 0.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .adl-hero-legal .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .adl-hero-legal .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .adl-hero-legal .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .adl-hero-legal .nero-ai-window-body { padding: 12px; }
  .adl-hero-legal .nero-ai-task { grid-template-columns: 28px 1fr; }
  .adl-hero-legal .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Legal / AI intake · внедрение под ключ</p>
      <h1 id="adl-hero-legal-title">AI-помощник для юристов: внедрение и настройка под ключ <span class="nero-ai-gradient-text">AI-бриф для юриста</span></h1>
      <p class="nero-ai-hero-lead">Собираем первичные данные клиента, готовим AI-бриф для юриста и ускоряем обработку типовых заявок — с контролем специалиста на каждом этапе</p>
      <ul class="nero-ai-badges" aria-label="Ключевые этапы">
        <li class="nero-ai-badge">AI-бриф</li>
        <li class="nero-ai-badge">Первичная консультация</li>
        <li class="nero-ai-badge">amoCRM / Битрикс24</li>
        <li class="nero-ai-badge">Human-in-the-loop</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как работает внедрение</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-брифа для юриста">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-бриф для юриста</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Входящих сегодня</span>
              <strong>14</strong>
              <small>сайт + Telegram</small>
            </div>
            <div class="nero-ai-metric">
              <span>До черновика брифа</span>
              <strong>6 мин</strong>
              <small>среднее время</small>
            </div>
            <div class="nero-ai-metric">
              <span>Полнота A–F</span>
              <strong>92%</strong>
              <small>полей брифа</small>
            </div>
            <div class="nero-ai-metric">
              <span>Правовых выводов</span>
              <strong>0</strong>
              <small>клиенту от AI</small>
            </div>
          </div>

          <div class="adl-dash-canvas-wrap" aria-hidden="false">
            <canvas id="adl-legal-intake-canvas" role="img" aria-label="Анимация: клиентский диалог превращается в блоки брифа A–F, передаётся в CRM и ожидает проверки юристом"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий intake">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Telegram: консультация по договору</strong><span>AI уточняет стороны и сроки</span></div>
              <span class="nero-ai-status">диалог</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">B</span>
              <div><strong>Блок B сформирован</strong><span>Резюме ситуации — 4 предложения</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">C</span>
              <div><strong>Conflict check (блок C)</strong><span>Флаг «требует проверки»</span></div>
              <span class="nero-ai-status nero-ai-status--amber">review</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>amoCRM: лид + задача юристу</strong><span>Статус: ожидает проверки</span></div>
              <span class="nero-ai-status nero-ai-status--amber">ожидает</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
/**
 * adl-legal-intake-engine — «Приёмная юридического бюро»
 * Мир: карусель досье → трибуна брифа A–F → conflict check → мост в CRM → штамп юриста
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("adl-legal-intake-canvas");
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
    scale = Math.min(cw / 440, ch / 290) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    panel: "rgba(15,23,42,0.85)",
    panelEdge: "#1e293b",
    cyan: "#79f2ff",
    amber: "#f59e0b",
    green: "#22c55e",
    purple: "#a78bfa",
    dossier: "#dbeafe",
    dossier2: "#fde68a",
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
      ctx.lineWidth = 1.5;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  /* Входящие сообщения Telegram/сайт */
  function TelegramBubbleInlet() {
    this.pulses = [0, 40, 90];
  }
  TelegramBubbleInlet.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, -178, -88, 52, 34, 8, "rgba(121,242,255,0.12)", C.cyan);
    ctx.fillStyle = C.cyan;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("TG / сайт", -172, -78);

    this.pulses.forEach(function (off, i) {
      var t = ((frame * 0.5 + off) % 100) / 100;
      if (t > 0.85) return;
      var bx = -165 + t * 95;
      var by = -58 - Math.sin(t * Math.PI) * 12;
      var alpha = t < 0.15 ? t / 0.15 : 1 - (t - 0.15) / 0.7;
      ctx.globalAlpha = Math.max(0, alpha);
      drawRR(ctx, bx - 14, by - 8, 28, 16, 6, C.bubbleBg, C.cyan);
      ctx.fillStyle = C.bubbleText;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(i === 0 ? "Договор?" : i === 1 ? "Сроки" : "Доки", bx, by + 2);
      ctx.globalAlpha = 1;
    });
  };

  /* Карусель досье по дуге — вместо Conveyor */
  function CaseDocketCarousel() {
    this.items = [
      { angle: 0, color: C.dossier, label: "A" },
      { angle: 2.1, color: C.dossier2, label: "B" },
      { angle: 4.2, color: "#d1fae5", label: "C" }
    ];
  }
  CaseDocketCarousel.prototype.draw = function (ctx) {
    var orbitX = -95;
    var orbitY = 18;
    var radius = 58;
    ctx.strokeStyle = "rgba(121,242,255,0.2)";
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.ellipse(orbitX, orbitY, radius, radius * 0.55, 0, 0, Math.PI * 2);
    ctx.stroke();

    this.items.forEach(function (it) {
      var ang = it.angle + frame * 0.018;
      var dx = orbitX + Math.cos(ang) * radius;
      var dy = orbitY + Math.sin(ang) * radius * 0.55;
      drawRR(ctx, dx - 10, dy - 12, 20, 24, 3, it.color, C.outline);
      ctx.fillStyle = C.outline;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(it.label, dx, dy + 3);
    });
  };

  /* Теги направления права */
  function PracticeAreaTags() {
    this.tags = ["Корп.", "ИС", "Споры"];
  }
  PracticeAreaTags.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 45) return;
    this.tags.forEach(function (tag, i) {
      var on = prg > 50 + i * 18;
      if (!on) return;
      var tx = -42 + i * 34;
      drawRR(ctx, tx, -72, 30, 12, 4, "rgba(167,139,250,0.2)", C.purple);
      ctx.fillStyle = "#ddd6fe";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(tag, tx + 15, -63);
    });
  };

  /* Трибуна сборки брифа A–F — вместо WebsiteTerminal */
  function BriefAssemblyPodium() {
    this.blocks = ["A", "B", "C", "D", "E", "F"];
  }
  BriefAssemblyPodium.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, -8, -82, 136, 156, 12, C.panel, C.panelEdge);

    ctx.fillStyle = C.cyan;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("AI-бриф", 2, -68);

    var cols = 3;
    var rows = 2;
    for (var i = 0; i < 6; i++) {
      var col = i % cols;
      var row = Math.floor(i / cols);
      var bx = 4 + col * 44;
      var by = -58 + row * 52;
      var threshold = 55 + i * 14;
      var filled = prg >= threshold;
      var fillCol = filled ? "rgba(121,242,255,0.22)" : "rgba(255,255,255,0.05)";
      drawRR(ctx, bx, by, 40, 44, 5, fillCol, filled ? C.cyan : C.outline);
      ctx.fillStyle = filled ? "#e0f2fe" : "#64748b";
      ctx.font = "bold 9px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(this.blocks[i], bx + 20, by + 18);
      if (filled && prg > threshold + 8) {
        ctx.fillStyle = "rgba(203,213,225,0.8)";
        ctx.font = "bold 5px Inter,sans-serif";
        var labels = ["Клиент", "Суть", "Conflict", "Доки", "Коммерция", "Служеб."];
        ctx.fillText(labels[i], bx + 20, by + 32);
        for (var l = 0; l < 2; l++) {
          ctx.fillRect(bx + 6, by + 36 + l * 4, 20 + l * 8, 2);
        }
      }
    }

    /* Лента комплаенса 152-ФЗ */
    if (prg >= 120) {
      drawRR(ctx, 4, 52, 128, 14, 4, "rgba(245,158,11,0.18)", C.amber);
      ctx.fillStyle = "#fde68a";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("152-ФЗ · ПДн · адвокатская тайна", 68, 62);
    }
  };

  /* Сканер conflict check */
  function ConflictCheckScanner() {
    this.beam = 0;
  }
  ConflictCheckScanner.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 125 || prg > 195) return;
    var scan = (prg - 125) / 70;
    this.beam = -8 + scan * 52;
    ctx.save();
    ctx.globalAlpha = 0.4 + Math.sin(frame * 0.15) * 0.2;
    ctx.fillStyle = "rgba(245,158,11,0.35)";
    ctx.fillRect(this.beam, -18, 3, 70);
    ctx.strokeStyle = C.amber;
    ctx.lineWidth = 1.5;
    ctx.strokeRect(this.beam - 10, -22, 22, 78);
    ctx.restore();
    if (prg > 155 && prg < 190) {
      drawRR(ctx, 38, 8, 52, 14, 4, "rgba(245,158,11,0.25)", C.amber);
      ctx.fillStyle = "#fde68a";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("⚑ проверка", 64, 18);
    }
  };

  /* Мост в CRM */
  function CrmDealBridge() {
    this.pulse = 0;
  }
  CrmDealBridge.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, 138, -48, 58, 108, 8, "rgba(30,41,59,0.75)", C.outline);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("amoCRM", 167, -36);

    if (prg >= 175) {
      this.pulse = Math.min(1, (prg - 175) / 25);
      ctx.strokeStyle = "rgba(121,242,255," + (this.pulse * 0.8) + ")";
      ctx.lineWidth = 2;
      ctx.setLineDash([4, 3]);
      ctx.beginPath();
      ctx.moveTo(132, 10);
      ctx.lineTo(138, 10);
      ctx.stroke();
      ctx.setLineDash([]);

      drawRR(ctx, 146, -22, 42, 18, 4, "rgba(34,197,94,0.2)", C.green);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("Лид + задача", 167, -10);

      drawRR(ctx, 146, 2, 42, 22, 4, "rgba(255,255,255,0.06)", C.outline);
      for (var r = 0; r < 3; r++) {
        ctx.fillStyle = prg > 185 + r * 8 ? "#cbd5e1" : "rgba(255,255,255,0.15)";
        ctx.fillRect(152, 8 + r * 5, 28 - r * 4, 2);
      }
    }
  };

  /* Лента комплаенса */
  function ComplianceSealRibbon() {
    this.show = false;
  }
  ComplianceSealRibbon.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 200) return;
    var a = Math.min(1, (prg - 200) / 20);
    ctx.globalAlpha = a;
    drawRR(ctx, -175, 72, 350, 10, 3, "rgba(245,158,11,0.12)", null);
    ctx.fillStyle = "#fcd34d";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Human-in-the-loop · AI не консультирует клиента", 0, 79);
    ctx.globalAlpha = 1;
  };

  /* Финальный штамп юриста */
  function LawyerReviewStamp() {
    this.scale = 0;
  }
  LawyerReviewStamp.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 210) return;
    this.scale = Math.min(1, (prg - 210) / 16);
    ctx.save();
    ctx.translate(60, 38);
    ctx.rotate(-0.12 * this.scale);
    ctx.globalAlpha = this.scale;
    ctx.strokeStyle = "rgba(34,197,94,0.85)";
    ctx.lineWidth = 2;
    ctx.strokeRect(-42, -14, 84, 28);
    ctx.fillStyle = "rgba(34,197,94,0.85)";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("ОЖИДАЕТ ПРОВЕРКИ", 0, 4);
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

    var targets = {
      "1_architect": { x: -55, y: 28 },
      "2_seo": { x: -15, y: 36 },
      "3_coder": { x: 155, y: 22 },
      "4_designer": { x: 25, y: 36 },
      "5_deployer": { x: 55, y: 48 }
    };
    var tgt = targets[this.role] || { x: 0, y: 30 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 26) {
      var local = prg - this.stepTrig;
      if (local < 13) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 13);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 13);
      } else if (local < 18) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 18) / 8);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 18) / 8);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 12 ? this.color : null;
    }

    if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 16, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 240);
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
    if (carryType) drawRR(ctx, -16, -16 - bob, 12, 12, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new TelegramBubbleInlet());
  entities.push(new CaseDocketCarousel());
  entities.push(new PracticeAreaTags());
  entities.push(new BriefAssemblyPodium());
  entities.push(new ConflictCheckScanner());
  entities.push(new CrmDealBridge());
  entities.push(new ComplianceSealRibbon());
  entities.push(new LawyerReviewStamp());
  entities.push(new Agent(-140, 82, C.agentYellow, "1_architect", 22, [
    "Матрица полей брифа", "Блок A: контакты", "Согласие ПДн отдельно"
  ]));
  entities.push(new Agent(-70, 90, C.agentGreen, "2_seo", 62, [
    "Направление: корпоративное", "Резюме на 4 предложения", "Срочность: претензия"
  ]));
  entities.push(new Agent(0, 94, C.agentBlue, "3_coder", 118, [
    "Webhook → amoCRM", "Кастомные поля брифа", "Задача ответственному"
  ]));
  entities.push(new Agent(70, 90, C.agentPink, "4_designer", 168, [
    "Conflict check запущен", "Стороны конфликта сверены", "Флаг review"
  ]));
  entities.push(new Agent(130, 82, C.agentPurple, "5_deployer", 218, [
    "Юрист проверяет бриф", "Не консультируем клиента", "Human-in-the-loop"
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

    var prg = (frame * 0.042) % 260;
    if (prg >= 58 && prg < 58.05) createBubble(-120, -20, "1. Диалог intake", 220);
    if (prg >= 98 && prg < 98.05) createBubble(-40, -30, "2. Блоки A–F", 220);
    if (prg >= 148 && prg < 148.05) createBubble(30, -10, "3. Conflict check", 220);
    if (prg >= 188 && prg < 188.05) createBubble(120, 0, "4. Лид в CRM", 220);
    if (prg >= 222 && prg < 222.05) createBubble(55, 30, "5. Проверка юриста", 240);

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.lineJoin = "round";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 30);
      if (bub.life > bub.maxLife - 10) alpha = (bub.maxLife - bub.life) / 10;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 14;
      var th = 18;
      var bx = bub.x;
      var by = bub.y - (bub.maxLife - bub.life) * 0.04;
      drawRR(ctx, bx - tw / 2, by - th, tw, th, 5, C.bubbleBg, C.cyan);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(bub.text, bx, by - th / 2);
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

<!-- ====================================================
     КОНТЕНТНАЯ ЧАСТЬ (НЕ HERO) — для вставки в .adl-content
     Наташа: hero Алины — выше; этот блок — сразу после hero
     ==================================================== -->
<div class="adl-content">

<style>
/* === ADL CONTENT ROOT — dark theme, prefix adl- === */
.adl-content{
  --adl-bg:#050711;--adl-bg2:#080b17;--adl-bg3:#0a0e1c;
  --adl-surface:rgba(255,255,255,.072);--adl-surface2:rgba(255,255,255,.108);
  --adl-text:#e6edf7;--adl-muted:#9aa8bd;--adl-soft:#c7d2e5;--adl-heading:#fff;
  --adl-border:rgba(255,255,255,.10);--adl-border-s:rgba(255,255,255,.18);
  --adl-accent:#79f2ff;--adl-violet:#8b5cf6;--adl-green:#22c55e;
  --adl-amber:#f59e0b;--adl-btn-from:#2563eb;--adl-btn-to:#7c3aed;
  --adl-r:18px;--adl-r-lg:24px;--adl-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--adl-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.adl-content *,.adl-content *::before,.adl-content *::after{box-sizing:border-box;}
.adl-content a{color:inherit;text-decoration:none;}
.adl-content p{color:var(--adl-muted);line-height:1.72;margin:0 0 1em;}
.adl-content p:last-child{margin-bottom:0;}
.adl-content h2,.adl-content h3,.adl-content h4{
  color:var(--adl-heading);letter-spacing:-.045em;margin:0 0 .7em;
}
.adl-content strong{color:var(--adl-soft);}
.adl-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.adl-content ul li{
  padding-left:20px;position:relative;margin-bottom:.45em;
  color:var(--adl-muted);font-size:14.5px;line-height:1.65;
}
.adl-content ul li::before{
  content:'›';position:absolute;left:0;color:var(--adl-accent);font-weight:700;
}
.adl-cnt{
  width:min(var(--adl-container),calc(100% - 40px));
  margin:0 auto;position:relative;z-index:1;
}
.adl-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.adl-section-alt{
  background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));
  border-top:1px solid rgba(255,255,255,.06);
  border-bottom:1px solid rgba(255,255,255,.06);
}
.adl-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.adl-sh.adl-left{margin-left:0;text-align:left;}
.adl-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.adl-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.adl-sh.adl-left p{margin-left:0;}
.adl-eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  padding:6px 14px;border-radius:999px;
  background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--adl-accent);margin-bottom:14px;
}
.adl-gt{
  background:linear-gradient(92deg,#fff 0%,var(--adl-accent) 44%,var(--adl-violet) 100%);
  -webkit-background-clip:text;background-clip:text;color:transparent!important;
}
.adl-intro{
  padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);
  background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);
  border-bottom:1px solid rgba(255,255,255,.06);
}
.adl-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.adl-intro-text{position:relative;padding-left:20px;}
.adl-intro-text::before{
  content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;
  background:linear-gradient(180deg,var(--adl-accent),var(--adl-violet));
}
.adl-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;}
.adl-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.adl-kpi-card{
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;
  padding:16px 14px;text-align:center;backdrop-filter:blur(12px);
}
.adl-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--adl-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.adl-kpi-card .kl{font-size:11px;font-weight:600;color:var(--adl-muted);line-height:1.4;}
.adl-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.adl-intro-grid{grid-template-columns:1fr;gap:36px;}.adl-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.adl-intro-kpi{grid-template-columns:1fr 1fr;}}
.adl-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.adl-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.adl-toc a{
  display:inline-block;padding:9px 18px;background:var(--adl-surface);
  border:1px solid var(--adl-border);border-radius:999px;
  font-size:13px;font-weight:600;color:var(--adl-muted);
  transition:border-color .2s,color .2s,background .2s;
}
.adl-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--adl-accent);background:rgba(121,242,255,.08);}
.adl-card{
  background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));
  border:1px solid var(--adl-border);border-radius:var(--adl-r-lg);
  padding:26px;backdrop-filter:blur(16px);margin-bottom:20px;
}
.adl-card h3{font-size:17px;margin-bottom:10px;}
.adl-card p{font-size:14.5px;}
.adl-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.adl-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.adl-grid-2,.adl-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.adl-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.adl-grid-3{grid-template-columns:1fr;}}
.adl-brief-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin:28px 0;}
@media(max-width:768px){.adl-brief-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:480px){.adl-brief-grid{grid-template-columns:1fr;}}
.adl-brief-card{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:16px;padding:20px 18px;transition:border-color .2s;
}
.adl-brief-card:hover{border-color:rgba(121,242,255,.35);}
.adl-brief-card .blk{
  font-size:11px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;
  color:var(--adl-accent);margin-bottom:8px;
}
.adl-brief-card h4{font-size:14px;margin-bottom:6px;}
.adl-brief-card p{font-size:13px;margin:0;line-height:1.55;}
.adl-timeline{position:relative;padding-left:40px;}
.adl-timeline::before{
  content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;
  background:linear-gradient(180deg,var(--adl-accent),var(--adl-violet));opacity:.35;
}
.adl-tl-item{position:relative;margin-bottom:28px;}
.adl-tl-dot{
  position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;
  background:var(--adl-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2);
}
.adl-tl-item h3{font-size:16px;}
.adl-tl-item .adl-tl-meta{font-size:12px;color:var(--adl-amber);font-weight:700;margin-bottom:6px;}
.adl-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.adl-table{width:100%;border-collapse:collapse;font-size:14px;}
.adl-table th{
  padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);
  color:var(--adl-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);
}
.adl-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--adl-text);vertical-align:top;}
.adl-table tr:last-child td{border-bottom:none;}
.adl-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.adl-case-grid{grid-template-columns:1fr;}}
.adl-case-card{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);
  border-radius:20px;padding:26px;
}
.adl-case-card h3{font-size:16px;}
.adl-metric{display:flex;align-items:baseline;gap:8px;margin-top:8px;}
.adl-metric .num{font-size:22px;font-weight:900;color:var(--adl-accent);}
.adl-metric .lbl{font-size:13px;color:var(--adl-muted);}
.adl-compliance{display:flex;flex-wrap:wrap;gap:8px;margin:20px 0;}
.adl-compliance span{
  padding:6px 14px;border-radius:999px;font-size:12px;font-weight:700;
  background:rgba(245,158,11,.12);border:1px solid rgba(245,158,11,.35);color:var(--adl-amber);
}
.adl-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.adl-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.adl-faq-q{
  padding:19px 24px;font-size:16px;font-weight:700;color:var(--adl-heading);
  cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;
}
.adl-faq-q::after{content:'▾';font-size:13px;color:var(--adl-accent);transition:transform .25s;}
.adl-faq-item.open .adl-faq-q::after{transform:rotate(180deg);}
.adl-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--adl-muted);line-height:1.72;}
.adl-faq-item.open .adl-faq-a{max-height:800px;padding:0 24px 20px;}
.adl-price-list{list-style:none;padding:0;margin:0;}
.adl-price-list li{padding-left:22px;margin-bottom:.5em;font-size:14.5px;color:var(--adl-muted);}
.adl-price-list li::before{content:'✓';left:0;color:var(--adl-green);}
.ym-cta-block{
  border-radius:20px;padding:36px 40px;margin:32px 0;
  background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));
  border:1px solid rgba(121,242,255,.3);text-align:center;
}
.ym-cta-block--secondary{
  background:linear-gradient(135deg,rgba(34,197,94,.08),rgba(121,242,255,.08));
  border-color:rgba(34,197,94,.28);
}
.ym-cta-block--footer-final{
  background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));
  border-color:rgba(139,92,246,.3);margin-bottom:0;
}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--adl-muted);font-size:15px;margin:0 auto 22px;max-width:640px;line-height:1.7;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;}
.ym-btn--accent{background:linear-gradient(135deg,var(--adl-btn-from),var(--adl-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--adl-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--adl-accent)!important;text-decoration:underline;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
</style>

  <!-- INTRO: Коротко + KPI -->
  <section class="adl-intro" id="intro" aria-label="Коротко о решении">
    <div class="adl-cnt">
      <div class="adl-intro-grid nero-ai-reveal">
        <div class="adl-intro-text">
          <p class="nero-ai-eyebrow">Коротко · ai для юристов</p>
          <p><strong>AI для юристов</strong> в модели Nero Network — это не «робот-адвокат», а связка каналов приёма заявок, AI-агента первичного сбора фактов и интеграции с CRM. На выходе юрист получает структурированный <strong>AI-бриф</strong>, а не сырой диалог из мессенджера. Правовую оценку даёт только специалист — с обязательным human-in-the-loop на каждом этапе.</p>
          <p>По исследованию «Авито» × Право.ru (ноябрь 2025) <strong>88%</strong> российских юристов уже используют ИИ, но <strong>77%</strong> опасаются утечки конфиденциальных данных во внешние сервисы. В 2026 году выигрывает <strong>внедрение AI для юристов под ключ</strong> — с контролем данных, юриста и ответственности.</p>
        </div>
        <div class="adl-intro-kpi" aria-label="Ключевые показатели">
          <div class="adl-kpi-card"><div class="kv">88%</div><div class="kl">юристов используют ИИ</div><div class="ks">Авито × Право.ru</div></div>
          <div class="adl-kpi-card"><div class="kv">77%</div><div class="kl">боятся утечки данных</div><div class="ks">Авито × Право.ru</div></div>
          <div class="adl-kpi-card"><div class="kv">45%</div><div class="kl">ИИ — только помощник</div><div class="ks">опрос 2025</div></div>
          <div class="adl-kpi-card"><div class="kv">150–500</div><div class="kl">тыс. ₽ ориентир проекта</div><div class="ks">под ключ</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- TOC -->
  <div class="adl-toc-outer">
    <div class="adl-cnt">
      <nav class="adl-toc" aria-label="Оглавление">
        <a href="#zachem-ai">Зачем AI</a>
        <a href="#chto-delaet">Решение</a>
        <a href="#kak-rabotaet">Внедрение</a>
        <a href="#integracii-crm">CRM</a>
        <a href="#dlya-kogo">Для кого</a>
        <a href="#keisy">Кейсы</a>
        <a href="#bezopasnost">Безопасность</a>
        <a href="#cena">Стоимость</a>
        <a href="#faq">FAQ</a>
        <a href="#cta-brif">Пример брифа</a>
      </nav>
    </div>
  </div>

  <!-- §1 Зачем -->
  <section class="adl-section" id="zachem-ai">
    <div class="adl-cnt">
      <div class="adl-sh nero-ai-reveal">
        <span class="adl-eyebrow">Боль юрбюро</span>
        <h2>Зачем юридическому бюро AI-помощник</h2>
        <p>Типовые вопросы, долгий первичный разбор и потерянные лиды до первой консультации — узкие места, которые закрывает AI intake.</p>
      </div>

      <div class="adl-card nero-ai-reveal" id="vremya-razbor">
        <h3>Сколько времени уходит на первичный разбор заявок</h3>
        <p>Типовой путь: обращение с сайта, в Telegram или по телефону → менеджер или дежурный юрист задаёт уточняющие вопросы → данные вносятся в CRM вручную → назначается консультация. На этом этапе уходит <strong>20–40 минут</strong> на одно обращение — ещё до правовой оценки.</p>
        <p>По данным Авито × Право.ru, <strong>57%</strong> юристов используют ИИ для первичного анализа, <strong>48%</strong> — для черновиков заключений. Но первичный <strong>intake</strong> остаётся узким местом: юристы на заседаниях, нет дежурного менеджера, ответ задерживается на часы и дни.</p>
        <p><strong>Определение:</strong> первичный разбор заявки — этап сбора фактов, документов и контактов до первой платной консультации. AI-помощник автоматизирует именно его, не подменяя юридическую экспертизу.</p>
      </div>

      <div class="adl-card nero-ai-reveal">
        <h3>Почему шаблонные ответы не заменяют юриста</h3>
        <p>FAQ на сайте закрывают вопросы «как записаться» и «какие документы принести». Но они не собирают структурированный бриф: стороны конфликта, сроки, conflict check. <strong>80%</strong> юристов считают обязательной проверку каждого результата ИИ; <strong>84%</strong> опасаются недостоверности.</p>
        <p>Как отмечает Алексей Пелевин, CEO ПравоТех: «ИИ не заменит юристов, но станет их конкурентным преимуществом». <strong>45%</strong> респондентов убеждены, что ИИ будет лишь помощником; полную автоматизацию допускают лишь <strong>3%</strong>.</p>
      </div>

      <div class="adl-card nero-ai-reveal">
        <h3>Где теряются лиды до первой консультации</h3>
        <ul>
          <li><strong>Медленный ответ</strong> — клиент написал вечером, юрист ответил на следующий день; клиент уже у конкурента.</li>
          <li><strong>Неполные данные</strong> — половина переписки в Telegram, половина на почте; в CRM пустая карточка.</li>
          <li><strong>Консультация «съедается» допросом</strong> — 30–40 минут на вытягивание фактов вместо правовой оценки.</li>
        </ul>
        <p>Международный кейс ClaireAI (США): AI-ресепшн 24/7 с <strong>одностраничным брифом</strong> в Clio, Filevine, Lawmatics. Для РФ — Telegram / виджет сайта → AI-диалог → amoCRM / Битрикс24.</p>
      </div>
    </div>
  </section>

  <!-- §2 Что делает -->
  <section class="adl-section adl-section-alt" id="chto-delaet">
    <div class="adl-cnt">
      <div class="adl-sh nero-ai-reveal">
        <span class="adl-eyebrow">Продукт</span>
        <h2>Что делает AI-помощник для юристов</h2>
        <p><strong>AI юридический помощник</strong> — связка каналов приёма заявок + AI-агент сбора фактов + CRM. AI <strong>не выдаёт юридическое заключение клиенту</strong>.</p>
      </div>

      <div class="adl-card nero-ai-reveal">
        <h3>Сбор первичных данных клиента (сайт, мессенджеры, форма)</h3>
        <ul>
          <li><strong>Виджет на сайте</strong> — диалог вместо формы из 25 полей.</li>
          <li><strong>Telegram-бот</strong> — популярный канал для юрфирм и патентных бюро в РФ.</li>
          <li><strong>Форма «Получить пример брифа»</strong> — точка входа для тёплых лидов.</li>
          <li><strong>Email-parser и телефония</strong> (опционально) — speech-to-text при хранении в РФ.</li>
        </ul>
        <p>Агент определяет <strong>направление права</strong> и <strong>срочность</strong>, задаёт уточняющие вопросы по ветке сценария — принцип conversational intake 2026. Если заметная доля обращений приходит на корпоративную почту, имеет смысл сначала настроить <a href="/vnedrenie-ai-obrabotka-email-crm/">AI-обработку входящей почты в CRM</a> — письма классифицируются и попадают в карточку ещё до этапа брифа.</p>
      </div>

      <div class="adl-card nero-ai-reveal" id="ai-brif">
        <h3>AI-бриф для юриста перед консультацией</h3>
        <p>Центральный элемент — <strong>AI подготовка брифа</strong> с блоками A–F (адаптация международных intake-шаблонов под российскую практику):</p>
        <div class="adl-brief-grid" aria-label="Структура AI-брифа A–F">
          <div class="adl-brief-card"><div class="blk">Блок A</div><h4>Идентификация клиента</h4><p>ФИО, ИНН, контакты, согласие на ПДн (отдельная фиксация — 152-ФЗ с 01.09.2025).</p></div>
          <div class="adl-brief-card"><div class="blk">Блок B</div><h4>Суть обращения</h4><p>Направление права, AI-резюме на 3–5 предложений, желаемый результат, срочность.</p></div>
          <div class="adl-brief-card"><div class="blk">Блок C</div><h4>Conflict check</h4><p>Стороны конфликта, другие юристы по вопросу, номер дела в суде.</p></div>
          <div class="adl-brief-card"><div class="blk">Блок D</div><h4>Документы</h4><p>Приложенные файлы, извлечённые сущности, чеклист недостающего.</p></div>
          <div class="adl-brief-card"><div class="blk">Блок E</div><h4>Коммерция</h4><p>Источник лида, ожидания по оплате, рекомендованный следующий шаг.</p></div>
          <div class="adl-brief-card"><div class="blk">Блок F</div><h4>Служебное</h4><p>Полнота брифа (%), флаги риска, транскрипт, статус «требует проверки юристом».</p></div>
        </div>
        <p>Как отмечает Legal Intaker в контексте Harvey AI: «If the data going into Harvey is inconsistent and incomplete, the outputs will be too.» Сначала бриф — потом любой legal AI у юриста.</p>
      </div>

      <aside class="ym-cta-block ym-cta-block--primary" id="cta-primer-brifa">
        <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Получить пример AI-брифа для первичной консультации</p>
          <p class="ym-cta-block__sub">Покажем обезличенный шаблон полей A–F: conflict check, чеклист документов, статус «ожидает проверки юристом». Вы увидите артефакт, с которым юрист начинает консультацию — не абстрактный «чат-бот».</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </aside>

      <div class="adl-card nero-ai-reveal">
        <h3>Маршрутизация заявок и черновики документов</h3>
        <p>После формирования брифа система создаёт лид/сделку в CRM, ставит задачу юристу, при необходимости генерирует <strong>черновик</strong> типового документа — только для проверки юристом.</p>
        <p>Кейс ЕВРАЗ + ПравоТех: <strong>85%</strong> типовых документов автоматически, <strong>−30%</strong> времени юристов. Кейс Ростелеком: <strong>~30%</strong> обращений без юриста, договоры в <strong>12 раз быстрее</strong>.</p>
      </div>

      <div class="adl-card nero-ai-reveal">
        <h3>Сценарии для патентных бюро и ИС (товарные знаки)</h3>
        <p>IPbot автоматизирует первичку: <strong>15–30 минут</strong> вместо нескольких дней. Nero Network адаптирует AI-бриф под ИС-ветку: поля МКТУ, описание обозначения, ссылки на реестры. Кейс xyma.ru: отчёт за <strong>~3 минуты</strong> вместо 3 дней — human-in-the-loop на «нечёткой» части.</p>
      </div>
    </div>
  </section>

  <!-- БОРИС: визуальный блок (вставка Наташи — между #chto-delaet и #kak-rabotaet) -->
  <section id="ai-dlya-yuristov-boris-block" class="badl-root" aria-label="Анимация: панель юриста — проверка AI-брифа перед консультацией">
<style>
#ai-dlya-yuristov-boris-block.badl-root{padding:clamp(48px,6vw,72px) 0;background:#f0f4fb;}
#ai-dlya-yuristov-boris-block .badl-cnt{max-width:1160px;margin:0 auto;padding:0 20px;}
#ai-dlya-yuristov-boris-block .badl-card{
  display:grid;grid-template-columns:42% 58%;border-radius:24px;overflow:hidden;
  box-shadow:0 8px 48px rgba(15,23,42,.13),0 0 0 1.5px rgba(14,165,233,.18);
  min-height:480px;
}
@media(max-width:960px){#ai-dlya-yuristov-boris-block .badl-card{grid-template-columns:1fr;min-height:auto;}}
#ai-dlya-yuristov-boris-block .badl-lft{background:#fff;padding:44px 38px;display:flex;flex-direction:column;justify-content:center;}
@media(max-width:600px){#ai-dlya-yuristov-boris-block .badl-lft{padding:28px 22px;}}
#ai-dlya-yuristov-boris-block .badl-ey{
  display:inline-flex;align-items:center;gap:7px;font-size:11px;font-weight:700;
  letter-spacing:.11em;text-transform:uppercase;color:#0ea5e9;margin:0 0 14px;
}
#ai-dlya-yuristov-boris-block .badl-ey::before{content:'';width:20px;height:2px;background:#0ea5e9;border-radius:1px;}
#ai-dlya-yuristov-boris-block .badl-h3{font-size:24px;font-weight:800;color:#0f172a;line-height:1.3;margin:0 0 20px;}
#ai-dlya-yuristov-boris-block .badl-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:10px;}
#ai-dlya-yuristov-boris-block .badl-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14.5px;line-height:1.5;color:#334155;}
#ai-dlya-yuristov-boris-block .badl-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(14,165,233,.12);
  display:flex;align-items:center;justify-content:center;font-size:11px;color:#0ea5e9;font-style:normal;
}
#ai-dlya-yuristov-boris-block .badl-pills{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:18px;}
#ai-dlya-yuristov-boris-block .badl-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
#ai-dlya-yuristov-boris-block .badl-pl-a{background:rgba(245,158,11,.1);color:#b45309;border:1.5px solid rgba(245,158,11,.28);}
#ai-dlya-yuristov-boris-block .badl-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-dlya-yuristov-boris-block .badl-pl-b{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22);}
#ai-dlya-yuristov-boris-block .badl-foot{font-size:13.5px;color:#64748b;font-style:italic;margin:0;}
#ai-dlya-yuristov-boris-block .badl-rgt{
  background:linear-gradient(145deg,#07091a 0%,#0d1224 55%,#090d1f 100%);
  position:relative;overflow:hidden;min-height:400px;
}
@media(max-width:960px){#ai-dlya-yuristov-boris-block .badl-rgt{min-height:360px;}}
#badl-brief-review-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="badl-cnt">
  <div class="badl-card">
    <div class="badl-lft">
      <span class="badl-ey">Human-in-the-loop</span>
      <h3 class="badl-h3">Юрист проверяет бриф за 5–10 минут — и только потом связывается с клиентом</h3>
      <ul class="badl-ul">
        <li><span class="badl-ic">A</span>Блоки A–F заполнены AI из диалога — юрист видит структуру, не переписку</li>
        <li><span class="badl-ic">✓</span>Conflict check и флаги риска подсвечены до открытия дела</li>
        <li><span class="badl-ic">✎</span>Правки фиксируются в журнале — какая версия ушла клиенту</li>
        <li><span class="badl-ic">→</span>После утверждения — задача в CRM и приглашение на консультацию</li>
      </ul>
      <div class="badl-pills">
        <span class="badl-pl badl-pl-a">152-ФЗ · контур РФ</span>
        <span class="badl-pl badl-pl-g">0 правовых выводов от AI</span>
        <span class="badl-pl badl-pl-b">92% полнота брифа</span>
      </div>
      <p class="badl-foot">Дальше разберём этапы внедрения AI для юристов под ключ →</p>
    </div>
    <div class="badl-rgt">
      <canvas id="badl-brief-review-canvas" aria-label="Анимация: юрист проверяет AI-бриф — блоки A–F, статус проверки, утверждение в CRM" role="img"></canvas>
    </div>
  </div>
</div>
<script>
(function(){
  'use strict';
  var cv = document.getElementById('badl-brief-review-canvas');
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
    text:'#e2e8f0', muted:'rgba(226,232,240,.5)', line:'rgba(255,255,255,.08)',
    card:'rgba(255,255,255,.065)', cardBdr:'rgba(255,255,255,.12)',
    cyan:'#79f2ff', green:'#4ade80', amber:'#fbbf24', viol:'#a78bfa',
    pending:'#f59e0b', approved:'#22c55e'
  };

  var BLOCKS = [
    {id:'A', label:'Клиент', w:0},
    {id:'B', label:'Суть', w:0},
    {id:'C', label:'Conflict', w:0},
    {id:'D', label:'Документы', w:0},
    {id:'E', label:'Коммерция', w:0},
    {id:'F', label:'Служебное', w:0}
  ];

  var status = 'pending';
  var checkAlpha = 0;
  var crmPulse = 0;
  var LOOP = 600;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else { ctx.rect(x,y,w,h); }
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function draw(){
    frame++;
    var t = frame % LOOP;
    var progress = t / LOOP;

    BLOCKS.forEach(function(b,i){
      var target = Math.min(1, Math.max(0, (t - 40 - i*35) / 50));
      b.w += (target - b.w) * 0.12;
    });

    if(t > 320 && t < 420) status = 'review';
    else if(t >= 420) status = 'approved';
    else status = 'pending';

    checkAlpha = status === 'approved' ? Math.min(1, checkAlpha + 0.04) : Math.max(0, checkAlpha - 0.06);
    crmPulse = 0.5 + 0.5 * Math.sin(frame * 0.07);

    ctx.clearRect(0,0,W,H);

    /* заголовок панели */
    rr(12,10,W-24,36,8,C.card,C.cardBdr);
    ctx.fillStyle = C.text;
    ctx.font = 'bold 12px Inter,system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Панель юриста · AI-бриф #2847', 24, 32);
    ctx.fillStyle = status === 'approved' ? C.approved : (status === 'review' ? C.pending : C.muted);
    ctx.textAlign = 'right';
    ctx.fillText(status === 'approved' ? 'утверждено' : (status === 'review' ? 'проверка…' : 'ожидает проверки'), W-24, 32);

    /* блоки A–F */
    var cols = 2, gap = 10, pad = 16;
    var bw = (W - pad*2 - gap) / cols;
    var bh = 52;
    var startY = 58;
    BLOCKS.forEach(function(b,i){
      var col = i % cols, row = Math.floor(i / cols);
      var x = pad + col * (bw + gap);
      var y = startY + row * (bh + gap);
      var fillW = bw * b.w;
      rr(x,y,bw,bh,8,C.card,C.cardBdr);
      if(fillW > 4){
        rr(x,y,fillW,bh,8,'rgba(121,242,255,.12)',null);
      }
      ctx.fillStyle = C.cyan;
      ctx.font = 'bold 11px Inter,sans-serif';
      ctx.textAlign = 'left';
      ctx.fillText('Блок '+b.id, x+10, y+20);
      ctx.fillStyle = C.muted;
      ctx.font = '10px Inter,sans-serif';
      ctx.fillText(b.label, x+10, y+38);
      if(b.w > 0.95){
        ctx.fillStyle = C.green;
        ctx.textAlign = 'right';
        ctx.fillText('✓', x+bw-12, y+28);
      }
    });

    /* курсор юриста / галочка */
    if(status === 'review'){
      var cx = W*0.72, cy = H*0.55;
      ctx.strokeStyle = C.amber;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(cx - 8 + Math.sin(frame*0.1)*3, cy);
      ctx.lineTo(cx + 8 + Math.sin(frame*0.1)*3, cy + 14);
      ctx.stroke();
    }
    if(checkAlpha > 0.05){
      var ax = W*0.5, ay = H*0.78;
      ctx.globalAlpha = checkAlpha;
      rr(ax-70,ay-16,140,32,16,'rgba(34,197,94,.2)',C.green,2);
      ctx.fillStyle = C.green;
      ctx.font = 'bold 12px Inter,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText('✓ Бриф утверждён юристом', ax, ay+4);
      ctx.globalAlpha = 1;
    }

    /* CRM уведомление */
    if(status === 'approved'){
      var nx = W - pad - 150, ny = H - 56;
      rr(nx,ny,150,44,10,C.card,C.cyan);
      ctx.fillStyle = C.cyan;
      ctx.font = 'bold 10px Inter,sans-serif';
      ctx.textAlign = 'left';
      ctx.fillText('amoCRM · задача', nx+12, ny+18);
      ctx.fillStyle = C.muted;
      ctx.font = '9px Inter,sans-serif';
      ctx.fillText('консультация 30 мин', nx+12, ny+32);
      ctx.beginPath();
      ctx.arc(nx+130, ny+22, 4+crmPulse*3, 0, Math.PI*2);
      ctx.fillStyle = 'rgba(34,197,94,'+(0.4+crmPulse*0.4)+')';
      ctx.fill();
    }

    requestAnimationFrame(draw);
  }
  requestAnimationFrame(draw);
})();
</script>
  </section>

  <!-- §3 Как работает -->
  <section class="adl-section" id="kak-rabotaet">
    <div class="adl-cnt">
      <div class="adl-sh nero-ai-reveal">
        <span class="adl-eyebrow">Под ключ</span>
        <h2>Как работает внедрение AI для юристов под ключ</h2>
        <p>Проектная работа: аудит → проектирование → пилот → масштабирование. Ориентир пилота: <strong>2–4 недели</strong>.</p>
      </div>

      <div class="adl-grid-2 nero-ai-reveal">
        <div class="adl-card">
          <div class="adl-tl-meta">1–3 дня</div>
          <h3>Аудит заявок, документов и точек входа клиента</h3>
          <p>Каналы заявок, типовые вопросы по практикам, CRM-воронка, регламент приёма дел.</p>
        </div>
        <div class="adl-card">
          <div class="adl-tl-meta">3–5 дней</div>
          <h3>Проектирование сценариев и полей брифа</h3>
          <p>Матрица полей, conflict check, тексты согласия на ПДн, FAQ фирмы.</p>
        </div>
        <div class="adl-card">
          <div class="adl-tl-meta">2–3 недели</div>
          <h3>Настройка AI-агента и human-in-the-loop</h3>
          <p>Сценарии по практикам, RAG по FAQ, эскалация сложных случаев, журнал правок.</p>
        </div>
        <div class="adl-card">
          <div class="adl-tl-meta">интеграция</div>
          <h3>Интеграция с CRM и передача брифа юристу</h3>
          <p>amoCRM / Битрикс24 REST, webhooks, пользовательские поля — не CSV.</p>
        </div>
      </div>

      <div class="adl-card nero-ai-reveal" style="margin-top:24px">
        <h3>Логика работы системы (8 шагов)</h3>
        <div class="adl-timeline">
          <div class="adl-tl-item"><div class="adl-tl-dot"></div><h3>Клиент пишет в канал</h3><p>Сайт, Telegram, форма.</p></div>
          <div class="adl-tl-item"><div class="adl-tl-dot"></div><h3>AI определяет направление и срочность</h3></div>
          <div class="adl-tl-item"><div class="adl-tl-dot"></div><h3>Уточняющие вопросы по сценарию</h3></div>
          <div class="adl-tl-item"><div class="adl-tl-dot"></div><h3>Загрузка документов в хранилище РФ</h3></div>
          <div class="adl-tl-item"><div class="adl-tl-dot"></div><h3>AI формирует бриф + резюме + чеклист</h3></div>
          <div class="adl-tl-item"><div class="adl-tl-dot"></div><h3>Лид в CRM с полями и задачей юристу</h3></div>
          <div class="adl-tl-item"><div class="adl-tl-dot"></div><h3>Юрист правит бриф (5–10 мин)</h3></div>
          <div class="adl-tl-item"><div class="adl-tl-dot"></div><h3>Аналитика: SLA, воронка, темы обращений</h3></div>
        </div>
        <p>International AI Safety Report 2026: в чувствительных сценариях нужны подтверждение планов агентом человеком, логирование и override.</p>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
          <p class="ym-cta-block__sub">Перед внедрением intake-агента полезно разобраться в сценариях, human-in-the-loop и интеграции с CRM — это ускоряет согласование с юристами и IT. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent"<?php echo nero_ai_external_link_attrs($secondary_cta_url); ?>><?php echo esc_html($secondary_cta_label); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <!-- §4 CRM -->
  <section class="adl-section adl-section-alt" id="integracii-crm">
    <div class="adl-cnt">
      <div class="adl-sh nero-ai-reveal">
        <span class="adl-eyebrow">Интеграции</span>
        <h2>Интеграция AI для юристов с CRM</h2>
        <p>Без единого контура данные из чата снова копируют вручную — <strong>интеграция AI для юристов с CRM</strong> обязательна для ROI.</p>
      </div>
      <div class="adl-table-wrap nero-ai-reveal">
        <table class="adl-table" aria-label="CRM для legal intake">
          <thead><tr><th>CRM</th><th>Возможности для legal intake</th></tr></thead>
          <tbody>
            <tr><td><strong>amoCRM</strong></td><td>AI-агент: квалификация, задачи, смена стадий; кастомные поля брифа</td></tr>
            <tr><td><strong>Битрикс24</strong></td><td>Открытые линии, «Найми ИИ», создание сделок</td></tr>
            <tr><td><strong>Кастом REST</strong></td><td>Webhook из AI-агента, Make/n8n для маршрутизации</td></tr>
          </tbody>
        </table>
      </div>
      <div class="adl-card nero-ai-reveal">
        <h3>Карточка клиента, статусы и уведомления юристу</h3>
        <p>В карточке — структурированный бриф: направление права, срочность, conflict check, чеклист документов, оценка полноты (%). Статусы: «ожидает проверки юристом» → «принято» → «консультация назначена».</p>
      </div>
      <div class="adl-card nero-ai-reveal">
        <h3>Связка заявки с сайта и мессенджеров в одну воронку</h3>
        <p>AI intake объединяет каналы: один бриф, одна карточка, один ответственный. В amoCRM тот же принцип «без ручного копирования» раскрыт в материале про <a href="/vnedrenie-ai-amocrm/">внедрение AI-агента в amoCRM под ключ</a>; для юрбюро мы адаптируем поля под legal-бриф. Референс Clio: данные intake стандартизируются без ручного копирования.</p>
      </div>
    </div>
  </section>

  <!-- §5 Для кого -->
  <section class="adl-section" id="dlya-kogo">
    <div class="adl-cnt">
      <div class="adl-sh nero-ai-reveal">
        <span class="adl-eyebrow">Целевая аудитория</span>
        <h2>Для кого подходит решение</h2>
      </div>
      <div class="adl-grid-3 nero-ai-reveal">
        <div class="adl-card">
          <h3>Юридические бюро и адвокатские конторы</h3>
          <p>Корпоративные споры, договорная работа — 24/7 сбор данных, бриф к утру. <strong>13%</strong> компаний уже используют корпоративный ИИ для legal.</p>
        </div>
        <div class="adl-card">
          <h3>Патентные бюро и поверенные по ИС</h3>
          <p>МКТУ, проверка охраноспособности — кастомный контур с CRM, не отдельный SaaS.</p>
        </div>
        <div class="adl-card">
          <h3>Юридический консалтинг</h3>
          <p>B2B-поля (ИНН, отрасль, бюджет), маршрутизация по экспертизе. <strong>AI для юристов для малого бизнеса</strong> — один канал и одна практика в пилоте.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- §6 Кейсы -->
  <section class="adl-section adl-section-alt" id="keisy">
    <div class="adl-cnt">
      <div class="adl-sh nero-ai-reveal">
        <span class="adl-eyebrow">Доверие</span>
        <h2>Примеры внедрения AI для юристов</h2>
        <p>Публичных прямых кейсов «внешний клиент → AI-бриф → amoCRM» мало; ниже — релевантные примеры и проектная модель Nero Network. Смежный опыт автоматизации заявок и документов в учётном контуре — в разборе <a href="/ai-1c-erp/">AI-агента для 1С и ERP под ключ</a>.</p>
      </div>
      <div class="adl-case-grid nero-ai-reveal">
        <div class="adl-case-card">
          <h3>Ускорение первичной консультации</h3>
          <p><strong>Ростелеком + ПравоТех:</strong> клиент проходит диалог ночью → утром юрист видит полный бриф.</p>
          <div class="adl-metric"><span class="num">~30%</span><span class="lbl">обращений без юриста</span></div>
          <div class="adl-metric"><span class="num">12×</span><span class="lbl">быстрее договоры</span></div>
        </div>
        <div class="adl-case-card">
          <h3>Снижение нагрузки на дежурного юриста</h3>
          <p><strong>ЕВРАЗ + ПравоТех:</strong> типовые документы автоматически, меньше рутины на первичке.</p>
          <div class="adl-metric"><span class="num">85%</span><span class="lbl">документов авто</span></div>
          <div class="adl-metric"><span class="num">−30%</span><span class="lbl">времени юристов</span></div>
        </div>
        <div class="adl-case-card">
          <h3>Единый бриф из разных каналов</h3>
          <p><strong>Проектная модель Nero Network:</strong> Telegram + форма сайта → один шаблон в Битрикс24.</p>
          <div class="adl-metric"><span class="num">2–4</span><span class="lbl">недели пилот</span></div>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px;text-align:center;font-size:14.5px">«Нейроюрист» Яндекса ускоряет работу <strong>юриста</strong> с договорами — не приём заявок с сайта. Кастомный intake Nero Network дополняет document AI.</p>
    </div>
  </section>

  <!-- §7 Безопасность -->
  <section class="adl-section" id="bezopasnost">
    <div class="adl-cnt">
      <div class="adl-sh nero-ai-reveal">
        <span class="adl-eyebrow">Compliance</span>
        <h2>Безопасность и контроль юриста при внедрении AI</h2>
      </div>
      <div class="adl-compliance nero-ai-reveal" aria-label="Compliance-метки">
        <span>152-ФЗ</span><span>Human-in-the-loop</span><span>Conflict check</span><span>Журнал действий</span>
      </div>
      <div class="adl-grid-2 nero-ai-reveal">
        <div class="adl-card">
          <h3>Конфиденциальность и персональные данные</h3>
          <p>Локализация по 152-ФЗ, отдельные согласия с 01.09.2025. YandexGPT / GigaChat / on-prem или анонимизация перед внешними API. Адвокатская тайна — нельзя загружать материалы в публичный ChatGPT.</p>
        </div>
        <div class="adl-card">
          <h3>AI как помощник, не замена специалиста</h3>
          <p>Статус каждого брифа: «ожидает проверки юристом». International AI Safety Report 2026: human verification of system outputs remains necessary.</p>
        </div>
      </div>
      <div class="adl-card nero-ai-reveal">
        <h3>Ответственность за юридические выводы</h3>
        <p>AI не формулирует персональную правовую позицию клиенту. Галлюцинации — критический риск. Conflict check по внутренней базе — только человек.</p>
      </div>
    </div>
  </section>

  <!-- §8 Стоимость -->
  <section class="adl-section adl-section-alt" id="cena">
    <div class="adl-cnt">
      <div class="adl-sh nero-ai-reveal">
        <span class="adl-eyebrow">Коммерция</span>
        <h2>Стоимость внедрения AI для юристов</h2>
        <p>Ориентир: <strong>150–500 тыс. ₽</strong> за проект под ключ. Рынок: интеграторы — <strong>50–200 тыс. ₽</strong> + абонент.</p>
      </div>
      <div class="adl-grid-2 nero-ai-reveal">
        <div class="adl-card">
          <h3>Из чего складывается цена проекта</h3>
          <ul class="adl-price-list">
            <li>аудит каналов и CRM</li>
            <li>проектирование сценариев и полей брифа</li>
            <li>разработка и настройка AI-агента</li>
            <li>интеграция с CRM, телефонией, мессенджерами</li>
            <li>комплаенс-слой (ПДн, журнал, маскирование)</li>
            <li>обучение, пилот, запуск в прод</li>
          </ul>
        </div>
        <div class="adl-card">
          <h3>Что входит в пакет «под ключ»</h3>
          <p>Работающий контур: каналы → AI intake → бриф в CRM → панель юриста. Лид-магнит: <strong>пример AI-брифа</strong> для первичной консультации.</p>
          <h3 style="margin-top:20px">ROI на первичном разборе</h3>
          <p>Быстрее первый ответ (24/7), меньше времени на «вытягивание фактов». Осторожные ориентиры: <strong>−30%</strong> (ЕВРАЗ), <strong>30%</strong> автоматизации (Ростелеком) — не гарантия для каждого проекта.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- §9 FAQ -->
  <section class="adl-section" id="faq">
    <div class="adl-cnt">
      <div class="adl-sh nero-ai-reveal">
        <span class="adl-eyebrow">FAQ</span>
        <h2>FAQ — как внедрить AI для юристов</h2>
      </div>
      <div class="adl-faq nero-ai-reveal" id="adl-faq-accordion">
        <div class="adl-faq-item"><div class="adl-faq-q">Как внедрить AI для юристов без риска для клиентов?</div><div class="adl-faq-a"><p>Контур данных в РФ, отдельные согласия на ПДн, AI только в режиме сбора фактов, human-in-the-loop на каждом брифе. Эскалация сложных случаев — сразу юристу.</p></div></div>
        <div class="adl-faq-item"><div class="adl-faq-q">Можно ли начать с одного сценария (только бриф)?</div><div class="adl-faq-a"><p>Да. Пилот: один канал (Telegram или форма) + одна практика + CRM. Масштабирование — на 4–8 неделе.</p></div></div>
        <div class="adl-faq-item"><div class="adl-faq-q">Нужна ли доработка сайта и CRM?</div><div class="adl-faq-a"><p>Минимально: виджет или ссылка на бот, API-ключи CRM, пользовательские поля под бриф. WordPress, Tilda, кастомный лендинг — поддерживаются.</p></div></div>
        <div class="adl-faq-item"><div class="adl-faq-q">Сколько длится проект внедрения?</div><div class="adl-faq-a"><p>Аудит 1–3 дня, проектирование 3–5 дней, пилот 2–3 недели. Первый рабочий бриф в CRM — от <strong>2–4 недель</strong>.</p></div></div>
        <div class="adl-faq-item"><div class="adl-faq-q">Подходит ли решение для малого юридического бизнеса?</div><div class="adl-faq-a"><p>Да. Один юрист + менеджер, одна CRM, один канал — достаточный старт.</p></div></div>
        <div class="adl-faq-item"><div class="adl-faq-q">Заменит ли AI юриста?</div><div class="adl-faq-a"><p>Нет. <strong>3%</strong> допускают полную автоматизацию; <strong>45%</strong> — только помощник (Авито × Право.ru).</p></div></div>
        <div class="adl-faq-item"><div class="adl-faq-q">Нужен ли on-prem?</div><div class="adl-faq-a"><p>Зависит от политики ПДн; Yandex Cloud / GigaChat / self-hosted — опции Nero Network.</p></div></div>
        <div class="adl-faq-item"><div class="adl-faq-q">Чем отличается от ChatGPT?</div><div class="adl-faq-a"><p>Корпоративный контур, сценарии, CRM, журнал, запрет утечки в публичные сервисы.</p></div></div>
      </div>
    </div>
  </section>

  <!-- §10 Финальный CTA -->
  <section class="adl-section adl-section-alt" id="cta-brif">
    <div class="adl-cnt">
      <div class="adl-sh nero-ai-reveal">
        <h2>Получить пример AI-брифа для первичной консультации</h2>
        <p>Вы видите, как устроен AI-бриф: блоки A–F, conflict check, чеклист документов, статус проверки юристом. Начните с лид-магнита — посмотрите пример для вашей практики.</p>
      </div>
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы ускорить первичный разбор заявок в юрбюро?</p>
          <p class="ym-cta-block__sub">Начните с примера AI-брифа — дальше обсудим пилот на одном канале и одной практике права: Telegram или форма сайта → бриф в amoCRM / Битрикс24 → контроль юриста. Ориентир проекта: 150–500 тыс. ₽, первый рабочий бриф — от 2–4 недель.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#kak-rabotaet" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.adl-content -->

<script>
(function(){
  var faq = document.getElementById('adl-faq-accordion');
  if (!faq) return;
  faq.querySelectorAll('.adl-faq-q').forEach(function(q){
    q.addEventListener('click', function(){
      var item = q.parentElement;
      var open = item.classList.contains('open');
      faq.querySelectorAll('.adl-faq-item').forEach(function(i){ i.classList.remove('open'); });
      if (!open) item.classList.add('open');
    });
  });
})();
</script>


<?php
$adl_page_url = trailingslashit( get_permalink() );
$adl_site_url = trailingslashit( home_url( '/' ) );
$adl_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$adl_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $adl_site_url . '#organization',
      'name'  => $adl_brand,
      'url'   => $adl_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $adl_site_url . '#website',
      'url'       => $adl_site_url,
      'name'      => $adl_brand,
      'publisher' => [ '@id' => $adl_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $adl_page_url . '#webpage',
      'url'         => $adl_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $adl_site_url . '#website' ],
      'about'       => [ '@id' => $adl_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $adl_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $adl_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $adl_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $adl_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $adl_page_url,
      'provider'    => [ '@id' => $adl_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $adl_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Как внедрить AI для юристов без риска для клиентов?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Контур данных в РФ, отдельные согласия на ПДн, AI только в режиме сбора фактов, human-in-the-loop на каждом брифе. Эскалация сложных случаев — сразу юристу.' ] ],
        [ '@type' => 'Question', 'name' => 'Можно ли начать с одного сценария (только бриф)?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да. Пилот: один канал (Telegram или форма) + одна практика + CRM. Масштабирование — на 4–8 неделе.' ] ],
        [ '@type' => 'Question', 'name' => 'Нужна ли доработка сайта и CRM?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Минимально: виджет или ссылка на бот, API-ключи CRM, пользовательские поля под бриф. WordPress, Tilda, кастомный лендинг — поддерживаются.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько длится проект внедрения?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Аудит 1–3 дня, проектирование 3–5 дней, пилот 2–3 недели. Первый рабочий бриф в CRM — от 2–4 недель.' ] ],
        [ '@type' => 'Question', 'name' => 'Подходит ли решение для малого юридического бизнеса?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да. Один юрист + менеджер, одна CRM, один канал — достаточный старт.' ] ],
        [ '@type' => 'Question', 'name' => 'Заменит ли AI юриста?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет. 3% допускают полную автоматизацию; 45% — только помощник (Авито × Право.ru).' ] ],
        [ '@type' => 'Question', 'name' => 'Нужен ли on-prem?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Зависит от политики ПДн; Yandex Cloud / GigaChat / self-hosted — опции Nero Network.' ] ],
        [ '@type' => 'Question', 'name' => 'Чем отличается от ChatGPT?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Корпоративный контур, сценарии, CRM, журнал, запрет утечки в публичные сервисы.' ] ],
      ],
    ],
    [
      '@type'       => 'Article',
      '@id'         => $adl_page_url . '#article',
      'headline'    => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $adl_page_url,
      'mainEntityOfPage' => [ '@id' => $adl_page_url . '#webpage' ],
      'publisher'   => [ '@id' => $adl_site_url . '#organization' ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $adl_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

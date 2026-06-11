<?php
/**
 * Template Name: AI-поиск и первичный разбор тендеров: внедрение под ключ
 * Description: Нейросеть находит релевантные тендеры, извлекает требования из ТЗ и готовит краткое резюме для менеджера.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-тендеры под ключ: поиск закупок и разбор документации';
$page_seo_description = 'Нейросеть находит релевантные тендеры, извлекает требования из ТЗ и готовит краткое резюме для менеджера. Внедрение под ключ: площадки, CRM, фильтры ОКВЭД. Тест — 10 закупок.';

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
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Внедрение', 'href' => '#sostav'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Цена', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить тендерный спрос';
$primary_cta_url     = nero_ai_primary_cta_url();
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

.atp-hero-tendery {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}

.ai-tendery-poisk-page .ym-btn--ghost {
  background: rgba(255, 255, 255, 0.08);
  color: #e6edf7 !important;
  border: 1.5px solid rgba(255, 255, 255, 0.18);
}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-tendery-poisk-page" role="main" tabindex="-1">

<section class="nero-ai-hero atp-hero-tendery" id="hero" aria-labelledby="atp-hero-title">
<style>
/* ── Hero ai-tendery-poisk: самодостаточные стили (prefix atp-) ── */
.atp-hero-tendery {
  --atp-cyan: #79f2ff;
  --atp-violet: #8b5cf6;
  --atp-green: #22c55e;
  --atp-amber: #f59e0b;
  --atp-text: #e6edf7;
  --atp-muted: #9aa8bd;
  --atp-soft: #c7d2e5;
  --atp-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.atp-hero-tendery::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 38% 28%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.atp-hero-tendery::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 680px;
  height: 680px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .11), transparent 66%);
  filter: blur(8px);
  animation: atpHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes atpHeroGlow {
  from { opacity: .4; transform: scale(.95); }
  to { opacity: .82; transform: scale(1.05); }
}
.atp-hero-tendery .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.atp-hero-tendery .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.atp-hero-tendery .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.atp-hero-tendery .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--atp-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.atp-hero-tendery .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--atp-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.atp-hero-tendery .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--atp-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.atp-hero-tendery .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.atp-hero-tendery .nero-ai-badge {
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
.atp-hero-tendery .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.atp-hero-tendery .nero-ai-btn {
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
.atp-hero-tendery .nero-ai-btn:hover { transform: translateY(-2px); }
.atp-hero-tendery .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--atp-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.atp-hero-tendery .nero-ai-btn-secondary {
  color: var(--atp-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.atp-hero-tendery .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--atp-shadow);
  transform: perspective(1100px) rotateY(3deg) rotateX(2deg);
}
.atp-hero-tendery .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.atp-hero-tendery .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.atp-hero-tendery .nero-ai-dots { display: flex; gap: 7px; }
.atp-hero-tendery .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.atp-hero-tendery .nero-ai-dot:nth-child(1) { background: #fb7185; }
.atp-hero-tendery .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.atp-hero-tendery .nero-ai-dot:nth-child(3) { background: #34d399; }
.atp-hero-tendery .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.atp-hero-tendery .nero-ai-window-body { padding: 16px; }
.atp-hero-tendery .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.atp-hero-tendery .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.atp-hero-tendery .nero-ai-live-pill {
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
.atp-hero-tendery .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: atpPulse 1.6s infinite;
}
@keyframes atpPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.atp-hero-tendery .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.atp-hero-tendery .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.atp-hero-tendery .nero-ai-metric span {
  display: block;
  color: var(--atp-muted);
  font-size: 11px;
  font-weight: 700;
}
.atp-hero-tendery .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.atp-hero-tendery .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.atp-hero-tendery .atp-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.14);
  background: radial-gradient(ellipse at 50% 40%, rgba(15, 23, 42, .9), rgba(2, 6, 23, .98));
}
.atp-hero-tendery #atp-tender-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.atp-hero-tendery .nero-ai-task-stream { margin-top: 4px; }
.atp-hero-tendery .nero-ai-task {
  display: grid;
  grid-template-columns: 36px 1fr auto;
  gap: 10px;
  align-items: center;
  padding: 10px 0;
  border-bottom: 1px solid rgba(148, 163, 184, 0.08);
  font-size: 12px;
}
.atp-hero-tendery .nero-ai-task:last-child { border-bottom: none; }
.atp-hero-tendery .nero-ai-task-icon {
  width: 36px;
  height: 36px;
  border-radius: 10px;
  background: rgba(121, 242, 255, 0.12);
  color: var(--atp-cyan);
  font-size: 11px;
  font-weight: 800;
  display: flex;
  align-items: center;
  justify-content: center;
}
.atp-hero-tendery .nero-ai-task strong {
  display: block;
  color: #fff;
  font-size: 13px;
  margin-bottom: 2px;
}
.atp-hero-tendery .nero-ai-task span:not(.nero-ai-task-icon):not(.nero-ai-status) {
  color: var(--atp-muted);
  font-size: 11px;
}
.atp-hero-tendery .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.12);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.atp-hero-tendery .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .atp-hero-tendery .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .atp-hero-tendery .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .atp-hero-tendery .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .atp-hero-tendery .nero-ai-window-body { padding: 12px; }
  .atp-hero-tendery .nero-ai-task { grid-template-columns: 28px 1fr; }
  .atp-hero-tendery .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai тендеры</p>
      <h1 id="atp-hero-title">AI-поиск и первичный разбор тендеров: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Нейросеть находит релевантные закупки и готовит краткое резюме по документации — без ручного перебора сотен лотов</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Поиск 24/7</li>
        <li class="nero-ai-badge">Разбор ТЗ</li>
        <li class="nero-ai-badge">Цитаты из PDF</li>
        <li class="nero-ai-badge">CRM</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Проверить тендерный спрос</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-поиска и разбора тендеров">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Тендерный AI-контур</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Лотов / нед</span>
              <strong>512</strong>
              <small>ЕИС + ЭТП</small>
            </div>
            <div class="nero-ai-metric">
              <span>Релевантных</span>
              <strong>14</strong>
              <small>после фильтра ОКВЭД</small>
            </div>
            <div class="nero-ai-metric">
              <span>Резюме</span>
              <strong>8 мин</strong>
              <small>PDF 180 стр.</small>
            </div>
            <div class="nero-ai-metric">
              <span>CRM</span>
              <strong>auto</strong>
              <small>amoCRM · карточка</small>
            </div>
          </div>

          <div class="atp-dash-canvas-wrap" aria-hidden="false">
            <canvas id="atp-tender-hero-canvas" role="img" aria-label="Анимация: радар закупок сканирует лоты, AI фильтрует по ОКВЭД, разбирает PDF и формирует резюме с цитатой для CRM"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий тендерного контура">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">ЕИС</span>
              <div><strong>Извещение 44-ФЗ · НМЦК 12,4 млн</strong><span>SOAP-опрос · регион ЦФО</span></div>
              <span class="nero-ai-status">новый</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">OK</span>
              <div><strong>Фильтр ОКВЭД пройден</strong><span>семантический скор 0.91</span></div>
              <span class="nero-ai-status">релевантно</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">PDF</span>
              <div><strong>ТЗ 180 стр. → резюме</strong><span>обеспечение, сроки, риски</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Цитата: п. 5.2 ТЗ → amoCRM</strong><span>go/no-go — менеджер</span></div>
              <span class="nero-ai-status nero-ai-status--amber">review</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<script>
/**
 * atp-tender-hero-engine — Диспетчерская «Радар закупок»
 * Мир: спираль извещений → радар → фильтр ОКВЭД → RAG по PDF → карточка GO → CRM
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("atp-tender-hero-canvas");
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
    scale = Math.min(cw / 440, ch / 290) * 1.12;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    radar: "rgba(121,242,255,0.28)",
    radarSweep: "rgba(139,92,246,0.45)",
    lotBg: "#f1f5f9",
    lotAccent: "#3b82f6",
    reject: "#fb7185",
    pdf: "#fde68a",
    cite: "#a7f3d0",
    bench: "#1e293b",
    goGreen: "#22c55e",
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

  /* Спиральный поток извещений — вместо Conveyor */
  function ProcurementSweepArcs() {
    this.sweep = 0;
  }
  ProcurementSweepArcs.prototype.draw = function (ctx) {
    this.sweep = (frame * 0.035) % (Math.PI * 2);
    var rings = [125, 95, 68];
    rings.forEach(function (r, i) {
      ctx.strokeStyle = i === 0 ? C.radarSweep : C.radar;
      ctx.lineWidth = i === 0 ? 2 : 1;
      ctx.setLineDash([5, 9]);
      ctx.lineDashOffset = -frame * 0.35;
      ctx.beginPath();
      ctx.arc(0, -15, r, 0, Math.PI * 2);
      ctx.stroke();
      ctx.setLineDash([]);
    });

    ctx.save();
    ctx.strokeStyle = "rgba(121,242,255,0.55)";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(0, -15);
    ctx.lineTo(Math.cos(this.sweep) * 130, -15 + Math.sin(this.sweep) * 130);
    ctx.stroke();
    ctx.restore();

    for (var i = 0; i < 6; i++) {
      var t = (frame * 0.018 + i * 0.85) % 5.2;
      var spiralR = 130 - t * 22;
      var ang = t * 1.4 + i;
      var lx = Math.cos(ang) * spiralR;
      var ly = -15 + Math.sin(ang) * spiralR * 0.55;
      if (spiralR > 25) drawLotChip(ctx, lx, ly, 16, 11, i % 4 === 0 ? C.reject : C.lotBg);
    }
  };

  function drawLotChip(ctx, x, y, w, h, color) {
    ctx.save();
    ctx.translate(x, y);
    drawRR(ctx, -w / 2, -h / 2, w, h, 2, color, C.outline);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("лот", 0, 2);
    ctx.restore();
  }

  /* Центральная станция резюме — вместо WebsiteTerminal */
  function TenderBriefWorkbench() {
    this.stampY = 0;
  }
  TenderBriefWorkbench.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, -62, -78, 124, 156, 10, C.bench, C.outline);

    drawRR(ctx, -50, -65, 100, 18, 4, "rgba(121,242,255,0.15)", C.lotAccent);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("AI-резюме лота", 0, -53);

    if (prg >= 20 && prg < 70) {
      ctx.fillStyle = "rgba(59,130,246,0.25)";
      ctx.beginPath();
      ctx.arc(-55, -25, 14 + Math.sin(frame * 0.12) * 2, 0, Math.PI * 2);
      ctx.fill();
    }

    if (prg >= 70 && prg < 130) {
      var fields = ["НМЦК", "Срок", "Обесп."];
      fields.forEach(function (f, i) {
        drawRR(ctx, -42, -38 + i * 20, 84, 14, 3, "rgba(255,255,255,0.12)", C.outline);
        ctx.fillStyle = "#cbd5e1";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "left";
        ctx.fillText(f + ":", -38, -28 + i * 20);
      });
    }

    if (prg >= 130 && prg < 190) {
      drawRR(ctx, -48, 8, 96, 28, 5, "rgba(253,230,138,0.2)", C.pdf);
      ctx.fillStyle = "#fde68a";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("PDF 180 стр.", 0, 20);
      for (var p = 0; p < 4; p++) {
        var px = -40 + p * 22;
        var ph = 18 + Math.sin(frame * 0.1 + p) * 3;
        drawRR(ctx, px, 42 - ph, 14, ph, 2, C.pdf, C.outline);
      }
    }

    if (prg >= 190 && prg < 235) {
      drawRR(ctx, -48, 30, 96, 22, 4, "rgba(167,243,208,0.25)", C.cite);
      ctx.fillStyle = "#ecfdf5";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText('"п. 5.2 ТЗ · опыт ≥3 контракта"', 0, 44);
    }

    if (prg >= 235) {
      var stampPrg = Math.min(1, (prg - 235) / 18);
      this.stampY = (1 - stampPrg) * -30;
      ctx.save();
      ctx.globalAlpha = stampPrg;
      ctx.translate(38, 55 + this.stampY);
      ctx.rotate(-0.18);
      ctx.strokeStyle = C.goGreen;
      ctx.lineWidth = 3;
      ctx.strokeRect(-22, -12, 44, 24);
      ctx.fillStyle = C.goGreen;
      ctx.font = "bold 11px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("GO", 0, 5);
      ctx.restore();

      if (prg > 248 && prg < 258) {
        var pulse = (prg - 248) / 10;
        ctx.strokeStyle = "rgba(34,197,94," + (0.8 - pulse * 0.7) + ")";
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(0, 72);
        ctx.lineTo(0, 98);
        ctx.stroke();
        ctx.fillStyle = C.goGreen;
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("→ amoCRM", 0, 108);
      }
    }
  };

  /* Сито ОКВЭД — уникальный объект */
  function OkvedFilterSieve() {
    this.shake = 0;
  }
  OkvedFilterSieve.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    this.shake = prg > 55 && prg < 95 ? Math.sin(frame * 0.25) * 2 : 0;
    drawRR(ctx, -158 + this.shake, -8, 40, 32, 6, "rgba(59,130,246,0.12)", C.lotAccent);
    ctx.fillStyle = C.lotAccent;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("ОКВЭД", -138 + this.shake, 8);

    if (prg > 58 && prg < 92) {
      var rx = -145 + ((prg - 58) / 34) * 35;
      drawLotChip(ctx, rx, 18, 12, 9, C.reject);
    }
  };

  /* Антенна SOAP ЕИС */
  function EisSoapAntenna() {
    this.blink = 0;
  }
  EisSoapAntenna.prototype.draw = function (ctx) {
    this.blink = frame % 40 < 20 ? 1 : 0.4;
    ctx.strokeStyle = "rgba(121,242,255," + this.blink + ")";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(155, -55);
    ctx.lineTo(155, -25);
    ctx.stroke();
    ctx.beginPath();
    ctx.arc(155, -58, 8, Math.PI, 0);
    ctx.stroke();
    ctx.fillStyle = C.radar;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("SOAP", 155, -68);
  };

  /* Шкала релевантности */
  function RelevanceScoreDial() {
    this.val = 0.62;
  }
  RelevanceScoreDial.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 70) this.val = 0.35 + (prg / 70) * 0.25;
    else if (prg < 130) this.val = 0.6 + ((prg - 70) / 60) * 0.22;
    else if (prg < 190) this.val = 0.82 + ((prg - 130) / 60) * 0.1;
    else this.val = 0.91;

    drawRR(ctx, 92, -72, 54, 16, 4, "rgba(255,255,255,0.08)", C.outline);
    drawRR(ctx, 94, -70, 50 * this.val, 12, 3, C.goGreen, null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText(Math.round(this.val * 100) + "% match", 94, -59);
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
    var prg = (frame * 0.038) % 260;
    var isMoving = false;
    var faceDir = 1;

    var nodeTargets = {
      "1_architect": { x: -125, y: 48 },
      "2_seo": { x: -55, y: 72 },
      "3_coder": { x: 20, y: 78 },
      "4_designer": { x: 85, y: 62 },
      "5_deployer": { x: 0, y: 92 }
    };
    var tgt = nodeTargets[this.role] || { x: 0, y: 70 };

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
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 17) / 7);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 17) / 7);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
    }

    if (!isMoving && frame % 230 === 0 && Math.random() < 0.11) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
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
  var sweep = new ProcurementSweepArcs();
  var bench = new TenderBriefWorkbench();
  var okved = new OkvedFilterSieve();
  var antenna = new EisSoapAntenna();
  var dial = new RelevanceScoreDial();

  entities.push(sweep);
  entities.push(okved);
  entities.push(antenna);
  entities.push(bench);
  entities.push(dial);
  entities.push(new Agent(-150, 98, C.agentYellow, "1_architect", 16, [
    "Профиль ОКВЭД готов", "Критерии НМЦК", "Стоп-темы настроены"
  ]));
  entities.push(new Agent(-85, 108, C.agentGreen, "2_seo", 58, [
    "Мусор отсечён!", "Семантика 0.91", "Релевантно по номенклатуре"
  ]));
  entities.push(new Agent(-15, 112, C.agentBlue, "3_coder", 102, [
    "RAG по PDF", "chunk 512 tok", "цитата с номером пункта"
  ]));
  entities.push(new Agent(55, 108, C.agentPink, "4_designer", 148, [
    "Шаблон резюме", "жёлтая зона: обеспечение", "go/no-go поля"
  ]));
  entities.push(new Agent(130, 98, C.agentPurple, "5_deployer", 198, [
    "POST amoCRM", "Telegram менеджеру", "human-in-the-loop"
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

    var prg = (frame * 0.038) % 260;
    if (prg >= 14 && prg < 14.05) createBubble(-110, -50, "1. Скан ЕИС");
    if (prg >= 62 && prg < 62.05) createBubble(-140, 5, "2. Фильтр ОКВЭД");
    if (prg >= 108 && prg < 108.05) createBubble(-20, 10, "3. RAG по ТЗ");
    if (prg >= 156 && prg < 156.05) createBubble(30, -20, "4. Резюме + цитата");
    if (prg >= 204 && prg < 204.05) createBubble(90, 40, "5. Карточка в CRM");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 5, C.bubbleBg, C.lotAccent);
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


<style>
/* === ATP: article content root (ai-tendery-poisk) === */
.atp-content{
  --atp-bg:#050711;--atp-bg2:#080b17;--atp-surface:rgba(255,255,255,.072);
  --atp-text:#e6edf7;--atp-muted:#9aa8bd;--atp-soft:#c7d2e5;--atp-heading:#fff;
  --atp-border:rgba(255,255,255,.10);--atp-accent:#79f2ff;--atp-violet:#8b5cf6;--atp-green:#22c55e;
  --atp-amber:#f59e0b;--atp-red:#ef4444;
  --atp-btn-from:#2563eb;--atp-btn-to:#7c3aed;--atp-r:18px;--atp-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--atp-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.atp-content *,.atp-content *::before,.atp-content *::after{box-sizing:border-box}
.atp-content a{color:inherit}
.atp-content p{color:var(--atp-muted);line-height:1.72;margin:0 0 1em}
.atp-content p:last-child{margin-bottom:0}
.atp-content h2,.atp-content h3,.atp-content h4{color:var(--atp-heading);letter-spacing:-.045em;margin:0 0 .7em}
.atp-content strong{color:var(--atp-soft)}
.atp-content ul,.atp-content ol{padding-left:0;list-style:none;margin:0 0 1em}
.atp-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--atp-muted);font-size:14.5px;line-height:1.65}
.atp-content ul li::before{content:'›';position:absolute;left:0;color:var(--atp-accent);font-weight:700}
.atp-content code{font-family:ui-monospace,SFMono-Regular,Menlo,monospace;font-size:.9em;padding:2px 6px;border-radius:6px;background:rgba(255,255,255,.06);color:var(--atp-accent)}
.atp-cnt{width:min(var(--atp-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.atp-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.atp-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.atp-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.atp-sh.atp-left{margin-left:0;text-align:left}
.atp-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.atp-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.atp-sh.atp-left p{margin-left:0}
.atp-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--atp-accent);margin-bottom:14px}
.atp-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.atp-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.atp-intro-text{position:relative;padding-left:20px}
.atp-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--atp-accent),var(--atp-violet))}
.atp-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--atp-muted);margin-bottom:1em}
.atp-intro-text p:last-child{margin-bottom:0;color:var(--atp-soft)}
.atp-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.atp-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px)}
.atp-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--atp-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.atp-kpi-card .kl{font-size:11px;font-weight:600;color:var(--atp-muted);line-height:1.4}
.atp-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.atp-intro-grid{grid-template-columns:1fr;gap:36px}.atp-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.atp-intro-kpi{grid-template-columns:1fr 1fr}}
.atp-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.atp-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.atp-toc a{display:inline-block;padding:9px 18px;background:var(--atp-surface);border:1px solid var(--atp-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--atp-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important}
.atp-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--atp-accent);background:rgba(121,242,255,.08)}
.atp-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--atp-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s}
.atp-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px)}
.atp-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.atp-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.atp-grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
@media(max-width:960px){.atp-grid-3,.atp-grid-4{grid-template-columns:1fr 1fr}}
@media(max-width:768px){.atp-grid-2,.atp-grid-3,.atp-grid-4{grid-template-columns:1fr}}
.atp-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.atp-table{width:100%;border-collapse:collapse;font-size:14px}
.atp-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--atp-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap}
.atp-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--atp-text);vertical-align:top}
.atp-table tr:last-child td{border-bottom:none}
.atp-table tr:hover td{background:rgba(255,255,255,.03)}
.atp-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.atp-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(121,242,255,.1);color:var(--atp-accent);border:1px solid rgba(121,242,255,.2)}
.atp-flow .arr{color:var(--atp-muted);font-size:16px;padding:0 4px;background:none;border:none}
.atp-resume-sample{font-family:ui-monospace,SFMono-Regular,Menlo,monospace;font-size:12.5px;line-height:1.65;padding:22px 24px;border-radius:16px;background:rgba(5,7,17,.55);border:1px solid rgba(121,242,255,.22);color:var(--atp-soft);white-space:pre-wrap;margin:24px 0}
.atp-timeline{position:relative;padding-left:40px}
.atp-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--atp-accent),var(--atp-violet));opacity:.35;border-radius:2px}
.atp-tl-item{position:relative;margin-bottom:32px}
.atp-tl-item:last-child{margin-bottom:0}
.atp-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--atp-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.atp-tl-item h3{font-size:17px;margin-bottom:8px}
.atp-tl-item p{font-size:14.5px;margin:0}
.atp-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s}
.atp-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px)}
.atp-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--atp-green);margin-bottom:10px}
.atp-case-card h3{font-size:16px;margin-bottom:14px}
.atp-step-card h3{font-size:17px;margin-bottom:10px}
.atp-step-card p{font-size:14px;margin:0}
.atp-integ-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:12px;margin:24px 0}
.atp-integ-pill{padding:12px 14px;border-radius:14px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);text-align:center;font-size:13px;font-weight:700;color:var(--atp-soft)}
.atp-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.atp-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.atp-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--atp-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.atp-faq-q::after{content:'▾';font-size:13px;color:var(--atp-accent);flex-shrink:0;transition:transform .25s}
.atp-faq-item.open .atp-faq-q::after{transform:rotate(180deg)}
.atp-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--atp-muted);line-height:1.72}
.atp-faq-item.open .atp-faq-a{max-height:800px;padding:0 24px 20px}
.atp-risk-warn th{background:rgba(245,158,11,.12)!important;color:var(--atp-amber)!important}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(121,242,255,.14),rgba(139,92,246,.12));border-color:rgba(121,242,255,.35)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--atp-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--atp-accent)!important;text-decoration:underline!important}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--atp-btn-from),var(--atp-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35)}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}.nero-ai-delay-2{transition-delay:.24s}
</style>

<div class="atp-content" id="atp-article-root">

  <section class="atp-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="atp-cnt">
      <div class="atp-intro-grid nero-ai-reveal">
        <div class="atp-intro-text">
          <p class="atp-eyebrow">Лонгрид · ai тендеры</p>
          <p>Если ваш тендерный отдел каждое утро начинается с сотен извещений на ЕИС, коммерческих площадках и в почте — а к обеду в работе остаётся пара «живых» лотов, проблема не в лени команды. <strong>AI-тендеры для бизнеса</strong> закрывают узкое место до подачи заявки: нейросеть отсеивает шум и готовит <strong>первичное резюме</strong> по документации, чтобы менеджер принимал решение за минуты, а не за часы.</p>
          <!-- INTERNAL-LINKS:INSERT -->
          <p><strong>Коротко:</strong> внедрение AI в бизнес-процессы тендерного отдела — это не «робот подаёт заявки с ЭЦП», а контролируемая автоматизация поиска и разбора ТЗ с человеком в контуре. Nero Network внедряет <strong>ai тендеры под ключ</strong>: от подключения площадок до карточки в CRM с цитатами из PDF.</p>
        </div>
        <div class="atp-intro-kpi" aria-label="Ключевые метрики тендерного рынка">
          <div class="atp-kpi-card"><div class="kv">13,6 трлн ₽</div><div class="kl">44-ФЗ 2025</div><div class="ks">Минфин</div></div>
          <div class="atp-kpi-card"><div class="kv">40+ ч/нед</div><div class="kl">на скрининг лотов</div><div class="ks">отраслевые кейсы</div></div>
          <div class="atp-kpi-card"><div class="kv">15 мин</div><div class="kl">vs 4 ч разбор ТЗ</div><div class="ks">с AI-резюме</div></div>
          <div class="atp-kpi-card"><div class="kv">10</div><div class="kl">лотов пилот</div><div class="ks">лид-магнит</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="atp-toc-outer">
    <div class="atp-cnt">
      <nav class="atp-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#zachem-ai">Зачем AI</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#sostav">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#etapy">Этапы</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Цена</a>
        <a href="#riski">Риски</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="atp-section" id="zachem-ai">
    <div class="atp-cnt">
      <div class="atp-sh atp-left nero-ai-reveal">
        <span class="atp-eyebrow">Зачем AI</span>
        <h2>Зачем тендерному отделу AI в 2026 году</h2>
        <p>Рынок закупок в России продолжает расти. По данным сводного отчёта Минфина, в 2025 году объём извещений по 44-ФЗ достиг <strong>13,6 трлн ₽</strong> (+13,6% к 2024 году). Коммерческий сегмент, по аналитике B2B-РТС, оценивается в <strong>30,3 трлн ₽</strong> и более 460 тыс. процедур.</p>
      </div>

      <div class="atp-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="atp-card">
          <h3 id="vremya-bez-ai">Сколько времени уходит на перебор и разбор без автоматизации</h3>
          <ul>
            <li><strong>40+ часов в неделю</strong> — только на просмотр карточек и первичную фильтрацию</li>
            <li><strong>3–4 часа</strong> — ручной разбор одного ТЗ на 150–200 страниц</li>
            <li><strong>До 30%</strong> рабочего времени тендер-менеджера — на ручной сбор и квалификацию</li>
            <li>Из <strong>500 тендеров/неделю</strong> (кейс Epsilon Metrics) глубоко разбиралась лишь часть — остальное терялось из-за нехватки рук</li>
          </ul>
        </div>
        <div class="atp-card">
          <h3 id="roi-ai-tendery">ROI: меньше «мусорных» закупок, быстрее решение о подаче</h3>
          <div class="atp-table-wrap">
            <table class="atp-table" aria-label="Метрики до и после AI-поиска тендеров">
              <thead><tr><th>Метрика</th><th>Без AI</th><th>С AI</th></tr></thead>
              <tbody>
                <tr><td>Первичный скрининг</td><td>часы в день</td><td>минуты на пакет</td></tr>
                <tr><td>Пропуск релевантных лотов</td><td>высокий риск</td><td>мониторинг 24/7</td></tr>
                <tr><td>Ошибки по обеспечению/штрафам</td><td>регулярны</td><td>чек-лист + цитата</td></tr>
                <tr><td>Воронка</td><td>Excel, почта</td><td>CRM со статусами</td></tr>
              </tbody>
            </table>
          </div>
          <p style="margin-top:14px;font-size:14px">После внедрения ИИ-платформы до команды доходит порядка <strong>80 целевых лотов</strong> с преданализом; разбор ТЗ ~200 стр. — с 3–4 ч до <strong>15 мин</strong> на черновик резюме.</p>
        </div>
      </div>

      <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-zachem-ai">
        <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Есть ли спрос на вашу номенклатуру в закупках?</p>
          <p class="ym-cta-block__sub">Проверим профиль компании и покажем, сколько релевантных лотов проходит мимо отдела — без полного внедрения. Первый шаг — тестовый подбор на реальных данных.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Проверить тендерный спрос</a>
        </div>
      </div>
    </div>
  </section>

  <section class="atp-section atp-section-alt" id="kak-rabotaet">
    <div class="atp-cnt">
      <div class="atp-sh nero-ai-reveal">
        <span class="atp-eyebrow">Пайплайн</span>
        <h2>Как работает AI-поиск и первичный разбор тендеров</h2>
        <p><strong>Определение:</strong> <strong>AI-поиск тендеров</strong> — автоматический мониторинг источников с семантической фильтрацией. <strong>AI-разбор документации</strong> — извлечение требований из PDF/DOC и резюме с <strong>ссылками на пункты ТЗ</strong>. Вместе это первичный разбор до go/no-go.</p>
      </div>

      <div class="atp-flow nero-ai-reveal" aria-label="Схема потока AI-тендеров">
        <span>Мониторинг ЕИС/ЭТП</span><span class="arr">→</span>
        <span>Фильтр ОКВЭД</span><span class="arr">→</span>
        <span>RAG по PDF</span><span class="arr">→</span>
        <span>Резюме + цитаты</span><span class="arr">→</span>
        <span>Карточка CRM</span>
      </div>
    </div>

    <!-- === БОРИС: визуальный блок (контраст к hero) === -->
    <section id="ai-tendery-poisk-boris-block" class="bat-root" aria-label="Анимация: семантический отбор лотов, RAG по ТЗ и формирование AI-резюме с цитатами">
<style>
#ai-tendery-poisk-boris-block.bat-root{padding:48px 0 56px;background:#f8fafc}
#ai-tendery-poisk-boris-block .bat-cnt{max-width:1160px;margin:0 auto;padding:0 24px}
#ai-tendery-poisk-boris-block .bat-card{
  display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;overflow:hidden;background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-tendery-poisk-boris-block .bat-card{grid-template-columns:1fr;min-height:auto}
}
#ai-tendery-poisk-boris-block .bat-lft{
  padding:40px 36px;display:flex;flex-direction:column;justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-tendery-poisk-boris-block .bat-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px}
}
#ai-tendery-poisk-boris-block .bat-ey{
  display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;
  letter-spacing:.12em;text-transform:uppercase;color:#059669;margin:0 0 14px;
}
#ai-tendery-poisk-boris-block .bat-ey::before{content:'';width:18px;height:2px;background:#059669;border-radius:1px}
#ai-tendery-poisk-boris-block .bat-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;
}
#ai-tendery-poisk-boris-block .bat-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px}
#ai-tendery-poisk-boris-block .bat-ul li{
  display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;
}
#ai-tendery-poisk-boris-block .bat-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(5,150,105,.1);
  display:flex;align-items:center;justify-content:center;font-size:11px;color:#047857;margin-top:1px;font-style:normal;
}
#ai-tendery-poisk-boris-block .bat-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px}
#ai-tendery-poisk-boris-block .bat-pl{
  padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
}
#ai-tendery-poisk-boris-block .bat-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22)}
#ai-tendery-poisk-boris-block .bat-pl-b{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22)}
#ai-tendery-poisk-boris-block .bat-pl-a{background:rgba(245,158,11,.08);color:#b45309;border:1.5px solid rgba(245,158,11,.22)}
#ai-tendery-poisk-boris-block .bat-foot{font-size:13px;color:#64748b;font-style:italic;margin:0}
#ai-tendery-poisk-boris-block .bat-rgt{
  position:relative;background:linear-gradient(135deg,#ecfdf5 0%,#e0f2fe 45%,#f8fafc 100%);
  min-height:440px;overflow:hidden;
}
@media(max-width:1023px){#ai-tendery-poisk-boris-block .bat-rgt{min-height:380px}}
#bat-tender-pipeline-canvas{position:absolute;inset:0;width:100%;height:100%;display:block}
</style>

<div class="bat-cnt">
  <div class="bat-card">
    <div class="bat-lft">
      <span class="bat-ey">Разбор документации</span>
      <h3 class="bat-h3">От шума на площадках до резюме с цитатой из ТЗ — без ручного листания PDF</h3>
      <ul class="bat-ul">
        <li><span class="bat-ic">1</span>Семантический фильтр отсекает 80–90% нерелевантных лотов до скачивания тяжёлых файлов</li>
        <li><span class="bat-ic">2</span>RAG извлекает сроки, обеспечение, СРО, штрафы и объём работ из PDF/DOC</li>
        <li><span class="bat-ic">3</span>Каждое поле резюме сопровождается цитатой и номером пункта — защита от галлюцинаций</li>
        <li><span class="bat-ic">?</span>Go/no-go, цена и юридическая оценка — только за менеджером (human-in-the-loop)</li>
      </ul>
      <div class="bat-pills">
        <span class="bat-pl bat-pl-g">4 ч → 15 мин</span>
        <span class="bat-pl bat-pl-b">RAG + цитаты</span>
        <span class="bat-pl bat-pl-a">жёлтая зона рисков</span>
      </div>
      <p class="bat-foot">Дальше — таблица площадок и образец AI-резюме по лоту ↓</p>
    </div>
    <div class="bat-rgt">
      <canvas id="bat-tender-pipeline-canvas" role="img" aria-label="Анимация: лоты проходят семантический фильтр, документы сканируются RAG и формируют резюме с цитатами для CRM"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bat-tender-pipeline-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width  = p.clientWidth  || 640;
    cv.height = p.clientHeight || 480;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    ink:'#0f172a', muted:'#64748b', lot:'#ffffff', lotBdr:'#cbd5e1',
    eis:'#3b82f6', filter:'#8b5cf6', filterGlow:'rgba(139,92,246,.22)',
    pdf:'#f59e0b', rag:'#059669', ragGlow:'rgba(5,150,105,.18)',
    quote:'#e0f2fe', quoteBdr:'#7dd3fc', crm:'#0ea5e9',
    green:'#22c55e', red:'#ef4444', amber:'#fbbf24', line:'rgba(14,165,233,.32)'
  };

  var lots = [], quotes = [], resumeAlpha = 0, cycleT = 0;
  var PLATFORMS = ['ЕИС','РТС','B2B','Сбер'];

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function spawnLot(){
    var rel = Math.random() > 0.35;
    lots.push({
      x: -50,
      y: H*0.18 + Math.random()*H*0.14,
      rel: rel,
      plat: PLATFORMS[Math.floor(Math.random()*PLATFORMS.length)],
      phase: 0,
      speed: 1.1 + Math.random()*0.7,
      nmck: (2 + Math.random()*40).toFixed(1) + ' млн'
    });
  }

  function spawnQuote(x,y){
    var texts = ['п. 2.4 обеспечение','п. 5.2 опыт ≥3','стр. 47 акты КС-2'];
    quotes.push({x:x,y:y,tx:W*0.78,ty:H*0.52+quotes.length*22,text:texts[quotes.length%3],t:0});
  }

  function drawLotCard(x,y,w,h,plat,nmck,clr,alpha){
    ctx.globalAlpha = alpha || 1;
    rr(x,y,w,h,6,C.lot,C.lotBdr,1.2);
    ctx.fillStyle = clr || C.eis;
    ctx.font = 'bold 8px Inter,system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText(plat, x+6, y+14);
    ctx.fillStyle = C.ink;
    ctx.font = '9px Inter,sans-serif';
    ctx.fillText('НМЦК '+nmck, x+6, y+h-8);
    ctx.globalAlpha = 1;
  }

  function drawFilterHub(cx,cy,r,pulse){
    var g = ctx.createRadialGradient(cx,cy,0,cx,cy,r*2);
    g.addColorStop(0,C.filterGlow); g.addColorStop(1,'rgba(139,92,246,0)');
    ctx.fillStyle=g; ctx.beginPath(); ctx.arc(cx,cy,r*1.5,0,Math.PI*2); ctx.fill();
    rr(cx-r,cy-r*0.85,r*2,r*1.7,r*0.35,'#f5f3ff',C.filter,2);
    ctx.fillStyle=C.filter;
    ctx.font='bold '+Math.max(10,r*0.2)+'px system-ui,sans-serif';
    ctx.textAlign='center'; ctx.textBaseline='middle';
    ctx.fillText('AI-фильтр',cx,cy-4);
    ctx.font=Math.max(8,r*0.14)+'px system-ui,sans-serif';
    ctx.fillStyle=C.muted;
    ctx.fillText('ОКВЭД + семантика',cx,cy+r*0.35);
    ctx.strokeStyle=C.filter; ctx.lineWidth=2+pulse*2; ctx.globalAlpha=.35+pulse*.35;
    ctx.beginPath(); ctx.arc(cx,cy,r+8+pulse*6,0,Math.PI*2); ctx.stroke();
    ctx.globalAlpha=1;
  }

  function drawPdfScanner(x,y,w,h,t){
    rr(x,y,w,h,10,'rgba(245,158,11,.08)',C.pdf,1.5);
    ctx.fillStyle=C.pdf; ctx.font='bold 10px system-ui,sans-serif'; ctx.textAlign='center';
    ctx.fillText('RAG · PDF 180 стр.',x+w/2,y+16);
    var scanY = y+24+(t%70);
    ctx.fillStyle='rgba(245,158,11,.25)';
    ctx.fillRect(x+8,scanY,w-16,3);
    for(var i=0;i<4;i++){
      rr(x+10,y+30+i*14,w-20,10,3,'rgba(255,255,255,.7)',C.lotBdr,1);
    }
  }

  function drawResume(x,y,w,h,alpha){
    if(alpha<0.05) return;
    ctx.globalAlpha=alpha;
    rr(x,y,w,h,10,'#fff',C.crm,2);
    ctx.fillStyle=C.crm; ctx.font='bold 11px system-ui,sans-serif'; ctx.textAlign='left';
    ctx.fillText('AI-резюме лота',x+12,y+20);
    var rows=['Суть: металлоконструкции','Обеспечение: 620 000 ₽','Риск: опыт ≥3 контракта','Рекомендация: средний риск'];
    for(var i=0;i<rows.length;i++){
      rr(x+10,y+28+i*20,w-20,16,4,'#f8fafc',C.lotBdr,1);
      ctx.fillStyle=C.ink; ctx.font='9px system-ui,sans-serif';
      ctx.fillText(rows[i],x+16,y+40+i*20);
    }
    ctx.globalAlpha=1;
  }

  function tick(){
    frame++; cycleT++;
    if(frame%85===0) spawnLot();

    var hubX=W*0.38, hubY=H*0.42, hubR=Math.min(W,H)*0.085;
    var scanX=W*0.54, scanY=H*0.32, scanW=Math.min(120,W*0.2), scanH=Math.min(100,H*0.28);
    var pulse=0.5+0.5*Math.sin(frame*0.06);

    ctx.clearRect(0,0,W,H);

    ctx.fillStyle=C.muted; ctx.font='10px system-ui,sans-serif'; ctx.textAlign='left';
    ctx.fillText('Площадки',W*0.05,H*0.08);
    ctx.textAlign='right'; ctx.fillText('CRM',W*0.94,H*0.08);

    drawFilterHub(hubX,hubY,hubR,pulse);

    var rejected=0, passed=0;
    lots = lots.filter(function(l){
      l.phase += l.speed;
      if(l.phase<100){ l.x += l.speed*1.5; }
      else if(l.phase<180){
        var dx=hubX-l.x, dy=hubY-l.y;
        l.x += dx*0.045; l.y += dy*0.045;
      } else if(l.phase<260){
        if(!l.rel){ rejected++; return false; }
        l.x += (scanX-l.x)*0.04; l.y += (scanY+scanH/2-l.y)*0.04;
        if(l.phase===181) spawnQuote(hubX,hubY);
      } else if(l.phase<340){
        l.x += (W*0.72-l.x)*0.05; l.y += (H*0.35-l.y)*0.05;
        passed++;
      } else { return false; }
      var col = l.rel ? C.green : C.red;
      drawLotCard(l.x-28,l.y-18,56,36,l.plat,l.nmck,col,0.92);
      return true;
    });

    drawPdfScanner(scanX,scanY,scanW,scanH,frame);

    quotes = quotes.filter(function(q){
      q.t += 0.028;
      var ease = q.t*q.t*(3-2*q.t);
      var cx = q.x+(q.tx-q.x)*ease, cy = q.y+(q.ty-q.y)*ease;
      ctx.globalAlpha = Math.min(1,q.t*2);
      rr(cx-48,cy-9,96,18,9,C.quote,C.quoteBdr,1);
      ctx.fillStyle='#0369a1'; ctx.font='8px system-ui,sans-serif'; ctx.textAlign='center';
      ctx.fillText('«'+q.text+'»',cx,cy+3);
      ctx.globalAlpha=1;
      if(q.t>=1){ resumeAlpha=Math.min(1,resumeAlpha+0.025); return false; }
      return true;
    });

    drawResume(W*0.66,H*0.28,W*0.28,H*0.44,resumeAlpha);

    rr(W*0.66,H*0.76,W*0.28,28,8,'rgba(14,165,233,.12)',C.crm,1);
    ctx.fillStyle=C.crm; ctx.font='bold 9px system-ui,sans-serif'; ctx.textAlign='center';
    ctx.fillText('amoCRM · карточка создана',W*0.8,H*0.795);

    if(cycleT>480){ cycleT=0; lots=[]; quotes=[]; resumeAlpha=0; }

    requestAnimationFrame(tick);
  }
  requestAnimationFrame(tick);
})();
</script>
    </section>
    <!-- /БОРИС -->

    <div class="atp-cnt">
      <div class="atp-sh atp-left nero-ai-reveal" style="margin-top:48px">
        <h3 id="monitoring-ploshchadok">Мониторинг площадок (ЕИС, коммерческие площадки)</h3>
      </div>
      <div class="atp-table-wrap nero-ai-reveal">
        <table class="atp-table" aria-label="Источники закупок и способы подключения">
          <thead><tr><th>Источник</th><th>Как подключаем</th><th>Комментарий</th></tr></thead>
          <tbody>
            <tr><td><strong>ЕИС</strong> (zakupki.gov.ru)</td><td>SOAP-сервисы, токен/ЭЦП</td><td>С 01.01.2025 FTP закрыт — только API</td></tr>
            <tr><td><strong>Сбер-АСТ, РТС, B2B-Center, Фабрикант</strong></td><td>API, выгрузки, агрегаторы</td><td>Поэтапно, по приоритету клиента</td></tr>
            <tr><td><strong>tender.pro, mos.ru, региональные</strong></td><td>Договорённости / парсинг</td><td>Зависит от площадки</td></tr>
            <tr><td><strong>Агрегатор (Saby Trade API и др.)</strong></td><td>Подписка от ~15 тыс. ₽/мес</td><td>Ускоряет старт при нескольких ЭТП</td></tr>
          </tbody>
        </table>
      </div>

      <div class="atp-sh atp-left nero-ai-reveal" style="margin-top:48px">
        <h3 id="filtry-otbor">Фильтры: ОКВЭД, регион, сумма, ключевые требования</h3>
        <p><strong>AI-подбор тендеров</strong> не ограничивается ключевыми словами в заголовке: жёсткие правила (ОКВЭД, НМЦК, стоп-слова) + семантический скоринг LLM с объяснением + обратная связь на пилоте.</p>
      </div>

      <div class="atp-sh atp-left nero-ai-reveal" style="margin-top:40px">
        <h3 id="izvlechenie-pdf">Извлечение требований из PDF/DOC/XLS</h3>
        <p><strong>AI-анализ закупок</strong> на уровне документации: скачивание приложений → OCR → chunking → RAG. Извлекаются сроки, обеспечение, лицензии, штрафы, объём работ. Архитектура агентов 2026 (OpenAI Agents SDK) — цепочка «агент ищет → читает файлы → вызывает CRM».</p>
      </div>

      <div class="atp-sh atp-left nero-ai-reveal" style="margin-top:40px">
        <h3 id="rezume-menedzheru">Краткое резюме для менеджера до подачи заявки</h3>
      </div>
      <div class="atp-resume-sample nero-ai-reveal" aria-label="Образец структуры AI-резюме">Лот: поставка металлоконструкций, НМЦК 12,4 млн ₽, 44-ФЗ
Дедлайн подачи: 18.06.2026, 10:00 МСК
Суть: изготовление и монтаж по проектной документации заказчика
Обеспечение заявки: 620 000 ₽ (п. 2.4 извещения)
Риски: требование опыта ≥3 аналогичных контракта за 5 лет (п. 5.2 ТЗ)
Что проверить вручную: наличие СРО, срок поставки 45 к.д. — жёлтая зона
Цитата: «Подтверждается актами КС-2 по объектам не менее 8 млн ₽ каждый» — ТЗ, стр. 47
Рекомендация AI: релевантно, средний риск по опыту — решение за менеджером</div>
    </div>
  </section>

  <section class="atp-section" id="sostav">
    <div class="atp-cnt">
      <div class="atp-sh nero-ai-reveal">
        <span class="atp-eyebrow">Под ключ</span>
        <h2>Что входит во внедрение AI-тендеров под ключ</h2>
        <p><strong>Разработка AI-тендеров</strong> в формате Nero Network — проект под ваш регламент, а не коробка «как у всех».</p>
      </div>

      <div class="atp-grid-3 nero-ai-reveal">
        <div class="atp-card atp-step-card">
          <h3 id="audit-processa">Аудит текущего процесса и источников закупок</h3>
          <p>Карта ЭТП и регионов, воронка (Excel/CRM), 5–10 «идеальных» и «мусорных» лотов для калибровки, требования 152-ФЗ и on-prem.</p>
        </div>
        <div class="atp-card atp-step-card nero-ai-delay-1">
          <h3 id="kriterii-rezyume">Настройка критериев релевантности и шаблонов резюме</h3>
          <p>Профиль ОКВЭД/номенклатуры, шаблон полей, уровни доверия зелёный/жёлтый/красный, дашборд качества ИИ.</p>
        </div>
        <div class="atp-card atp-step-card nero-ai-delay-2">
          <h3 id="obuchenie-komandy">Обучение команды и регламент «человек в контуре»</h3>
          <p>Алерты в Telegram/CRM, go/no-go, оспаривание ошибок AI. «ИИ рекомендует — специалист решает» (Epsilon Metrics).</p>
        </div>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать AI до старта проекта?</p>
          <p class="ym-cta-block__sub">Перед пилотом полезно разобраться в агентах, RAG и human-in-the-loop — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer">обучение по внедрению AI в бизнес-процессы</a>. Это ускоряет согласование регламента с тендерным отделом.</p>
        </div>
      </aside>
    </div>
  </section>

  <section class="atp-section atp-section-alt" id="integracii">
    <div class="atp-cnt">
      <div class="atp-sh nero-ai-reveal">
        <span class="atp-eyebrow">Стек</span>
        <h2>Интеграции с CRM и площадками</h2>
        <p><strong>AI-тендеры с CRM</strong> — лот живёт в <strong>вашей</strong> системе, а не в очередной подписке с ручным переносом.</p>
      </div>

      <div class="atp-grid-2 nero-ai-reveal">
        <div class="atp-card">
          <h3 id="amocrm-bitrix">amoCRM, Битрикс24 — карточка тендера и статусы</h3>
          <ul>
            <li>Номер и ссылка на извещение, НМЦК, заказчик, дедлайн</li>
            <li>Статус: новый → на разборе → go/no-go → в работе</li>
            <li>Ссылка на AI-резюме, ответственный, задачи на проверку обеспечения</li>
          </ul>
        </div>
        <div class="atp-card">
          <h3 id="api-ogranicheniya">Выгрузки/API площадок: ограничения и актуальность</h3>
          <p>Единого REST API всех ЭТП нет — гибрид SOAP ЕИС + агрегатор + точечные коннекторы. Поле «актуально на …», повторный опрос. ML-прогноз победы и LLM-разбор ТЗ — разные технологии.</p>
        </div>
      </div>

      <div class="atp-integ-grid nero-ai-reveal" aria-label="Интеграции">
        <span class="atp-integ-pill">ЕИС SOAP</span>
        <span class="atp-integ-pill">amoCRM</span>
        <span class="atp-integ-pill">Битрикс24</span>
        <span class="atp-integ-pill">Make / n8n</span>
        <span class="atp-integ-pill">Telegram</span>
        <span class="atp-integ-pill">Saby API</span>
      </div>
    </div>
  </section>

  <section class="atp-section" id="etapy">
    <div class="atp-cnt">
      <div class="atp-sh nero-ai-reveal">
        <span class="atp-eyebrow">Этапы</span>
        <h2>Этапы внедрения</h2>
      </div>

      <div class="atp-table-wrap nero-ai-reveal">
        <table class="atp-table" aria-label="Этапы внедрения AI-тендеров">
          <thead><tr><th>Этап</th><th>Срок</th><th>Результат</th></tr></thead>
          <tbody>
            <tr><td><strong>Диагностика</strong></td><td>3–5 раб. дней</td><td>Профиль, источники, ТЗ на пилот</td></tr>
            <tr><td><strong>Пилот «10 тендеров»</strong></td><td>1–2 недели</td><td>10 карточек с резюме и цитатами</td></tr>
            <tr><td><strong>Интеграция CRM</strong></td><td>1–3 недели</td><td>Воронка в amoCRM / Битрикс24</td></tr>
            <tr><td><strong>Масштабирование</strong></td><td>по согласованию</td><td>+площадки, уведомления, 1С опционально</td></tr>
          </tbody>
        </table>
      </div>

      <div class="atp-card nero-ai-reveal" style="margin-top:24px">
        <h3 id="sroki-roli">Сроки и роли: IT, тендерный отдел, руководитель</h3>
        <p>Руководитель утверждает критерии и go/no-go; тендерный отдел размечает ошибки AI; IT согласует контур данных. Полное внедрение — порядка <strong>4–9 недель</strong> в зависимости от CRM и числа ЭТП.</p>
      </div>
    </div>

    <div class="atp-cnt">
      <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-etapy">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Тестовый подбор 10 тендеров</p>
          <p class="ym-cta-block__sub">Лид-магнит: настройка профиля, 1–3 источника, 10 карточек с AI-резюме и цитатами из документов. Измеримый результат за 1–2 недели — не демо на чужих данных.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Проверить тендерный спрос</a>
            <a href="#ceny" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Сколько стоит пилот →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="atp-section atp-section-alt" id="keisy">
    <div class="atp-cnt">
      <div class="atp-sh nero-ai-reveal">
        <span class="atp-eyebrow">Кейсы</span>
        <h2>Кейсы и примеры внедрения</h2>
        <!-- INTERNAL-LINKS:INSERT -->
        <p>Публичных кейсов с названиями компаний мало — ниже проверенные ориентиры и сценарии по отраслям ЦА.</p>
      </div>

      <div class="atp-grid-4 nero-ai-reveal">
        <div class="atp-case-card">
          <div class="atp-case-tag">Производство</div>
          <h3>Узкая номенклатура</h3>
          <p>Семантический матч + сверка с каталогом. Менеджер видит только лоты с совпадением номенклатуры.</p>
        </div>
        <div class="atp-case-card nero-ai-delay-1">
          <div class="atp-case-tag">Строительство</div>
          <h3>Epsilon Metrics</h3>
          <p>500 тендеров/нед → ~80 целевых с преданализом; доля выигрышей 15% → 20% при human-in-the-loop.</p>
        </div>
        <div class="atp-case-card nero-ai-delay-2">
          <div class="atp-case-tag">IT-услуги</div>
          <h3>Быстрая оценка ТЗ</h3>
          <p>Извлечение стека, SLA, команды; фильтр 44-ФЗ / 223-ФЗ. Время до решения — в разы быстрее.</p>
        </div>
        <div class="atp-case-card">
          <div class="atp-case-tag">Услуги</div>
          <h3>Штрафы и оплата</h3>
          <p>Акцент резюме на неустойках, авансе, требованиях к персоналу — меньше сюрпризов после подачи.</p>
        </div>
      </div>

      <div class="atp-table-wrap nero-ai-reveal" style="margin-top:32px">
        <table class="atp-table" aria-label="SaaS vs кастомное внедрение">
          <thead><tr><th>Критерий</th><th>Готовый SaaS</th><th>Внедрение Nero Network</th></tr></thead>
          <tbody>
            <tr><td>Старт</td><td>быстро, подписка</td><td>пилот 10 тендеров</td></tr>
            <tr><td>CRM</td><td>экспорт / уведомления</td><td><strong>ваша</strong> воронка и поля</td></tr>
            <tr><td>Разбор ТЗ</td><td>есть у лидеров</td><td>RAG + <strong>цитаты</strong>, настраиваемый шаблон</td></tr>
            <tr><td>Цена</td><td>0–140 тыс. ₽/мес</td><td>проект <strong>200–700 тыс. ₽</strong></td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="atp-section" id="ceny">
    <div class="atp-cnt">
      <div class="atp-sh nero-ai-reveal">
        <span class="atp-eyebrow">Бюджет</span>
        <h2>Стоимость и ориентиры проекта</h2>
      </div>

      <div class="atp-grid-2 nero-ai-reveal">
        <div class="atp-card">
          <h3 id="sostav-cheka">Из чего складывается чек 200–700 тыс. ₽</h3>
          <ul>
            <li>Число источников (ЕИС + коммерческие ЭТП)</li>
            <li>Глубина AI-разбора (извещение vs полный пакет ТЗ)</li>
            <li>Интеграция amoCRM / Битрикс24 / 1С</li>
            <li>Контур: облако / on-prem / гибрид</li>
          </ul>
          <p style="margin-top:12px;font-size:14px">Ориентиры рынка: Openii <strong>290–690 тыс. ₽</strong>; TenderScan интеграции от <strong>150 тыс. ₽</strong> + подписка.</p>
        </div>
        <div class="atp-card">
          <h3 id="pilot-10-tenderov">Что входит в пилот «тестовый подбор 10 тендеров»</h3>
          <ul>
            <li>Настройка профиля (ОКВЭД, регион, суммы)</li>
            <li>Подключение 1–3 источников</li>
            <li>10 карточек с AI-резюме и цитатами</li>
            <li>Сессия разбора ошибок и донастройка фильтров</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="atp-section atp-section-alt" id="riski">
    <div class="atp-cnt">
      <div class="atp-sh nero-ai-reveal">
        <span class="atp-eyebrow">Честно о рисках</span>
        <h2>Риски и ограничения</h2>
        <p><strong>AI-анализ закупок</strong> не отменяет экспертизу. Human-in-the-loop — стандарт для юридически значимых полей.</p>
      </div>

      <div class="atp-table-wrap nero-ai-reveal">
        <table class="atp-table atp-risk-warn" aria-label="Риски и смягчение">
          <thead><tr><th>Риск</th><th>Как смягчаем</th></tr></thead>
          <tbody>
            <tr><td>Галлюцинации LLM</td><td>RAG, обязательные цитаты, выборочная проверка</td></tr>
            <tr><td>Устаревший лот</td><td>Polling, поле «актуально на», алерты при разъяснениях</td></tr>
            <tr><td>44-ФЗ / 223-ФЗ</td><td>AI не юрист; финальная оценка — у специалиста</td></tr>
            <tr><td>152-ФЗ</td><td>Хранение в РФ, on-prem, без обучения публичных моделей на ваших ТЗ</td></tr>
          </tbody>
        </table>
      </div>

      <div class="atp-card nero-ai-reveal" style="margin-top:24px">
        <h3 id="kontrol-menedzhera">Почему нужен контроль менеджера</h3>
        <p>Остаётся за человеком: финальное go/no-go, юридическая оценка, ценообразование, подача заявки и ЭЦП, проверка полей «красной зоны» (обеспечение, штрафы, сроки).</p>
      </div>
    </div>
  </section>

  <section class="atp-section" id="faq">
    <div class="atp-cnt">
      <div class="atp-sh nero-ai-reveal">
        <span class="atp-eyebrow">Вопрос — ответ</span>
        <h2>FAQ</h2>
      </div>

      <div class="atp-faq nero-ai-reveal">
        <div class="atp-faq-item"><div class="atp-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить AI-тендеры в компании с 1–2 менеджерами?</div><div class="atp-faq-a"><p>Начните с одного источника (обычно ЕИС) и пилота на 10 лотах. Один менеджер размечает ошибки AI — этого достаточно для калибровки. CRM — на этапе 2.</p></div></div>
        <div class="atp-faq-item"><div class="atp-faq-q" tabindex="0" role="button" aria-expanded="false">Чем кастомное внедрение отличается от готового SaaS?</div><div class="atp-faq-a"><p>SaaS даёт быстрый поиск «из коробки», но редко — ваши критерии и воронку в amoCRM/Битрикс24. Кастом встраивает AI-поиск и первичный разбор в существующий процесс.</p></div></div>
        <div class="atp-faq-item"><div class="atp-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли подключить только поиск без разбора документации?</div><div class="atp-faq-a"><p>Да, как первый этап. Основная экономия — на разборе ТЗ (минуты vs часы). Типовой путь: поиск → пилот резюме на 10 лотах → полный контур.</p></div></div>
        <div class="atp-faq-item"><div class="atp-faq-q" tabindex="0" role="button" aria-expanded="false">Какие площадки поддерживаются на старте?</div><div class="atp-faq-a"><p>Приоритет: ЕИС, затем по бизнесу — Сбер-АСТ, РТС, B2B-Center, Фабрикант, tender.pro, региональные. Подключаем по ROI, не «все 440 площадок в день один».</p></div></div>
        <div class="atp-faq-item"><div class="atp-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько длится пилот на 10 тендеров?</div><div class="atp-faq-a"><p>Ориентир 1–2 недели после диагностики. Полное внедрение — порядка 4–9 недель в зависимости от CRM и числа ЭТП.</p></div></div>
        <div class="atp-faq-item"><div class="atp-faq-q" tabindex="0" role="button" aria-expanded="false">Нужен ли юрист?</div><div class="atp-faq-a"><p>Для финального решения по сложным 44-ФЗ/223-ФЗ — да. AI готовит черновик резюме, не юридическое заключение.</p></div></div>
        <div class="atp-faq-item"><div class="atp-faq-q" tabindex="0" role="button" aria-expanded="false">У нас уже есть Контур.Закупки или Тендерплан — зачем внедрение?</div><div class="atp-faq-a"><p>Агрегатор ищет закупки. Внедрение добавляет ваши правила, связку с CRM, резюме с цитатами и снижает ручной перенос.</p></div></div>
        <div class="atp-faq-item"><div class="atp-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли без 1С?</div><div class="atp-faq-a"><p>Да. Интеграция с 1С/ERP — опциональный этап 2 (сверка номенклатуры и остатков).</p></div></div>
      </div>

      <div class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы сократить перебор лотов и разбор ТЗ?</p>
          <p class="ym-cta-block__sub">AI-поиск и первичный разбор под ключ: площадки, CRM, резюме с цитатами. Начните с тестового подбора 10 тендеров на вашем профиле — без автоподачи заявок.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Проверить тендерный спрос</a>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.atp-content -->


<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
(function(){
  document.querySelectorAll('.atp-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.atp-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.atp-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.atp-faq-q');
        if (q) q.setAttribute('aria-expanded', 'false');
      });
      if (!isOpen) { item.classList.add('open'); btn.setAttribute('aria-expanded', 'true'); }
    });
    btn.addEventListener('keydown', function(e){
      if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); btn.click(); }
    });
  });
})();
</script>

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

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

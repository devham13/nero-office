<?php
/**
 * Template Name: AI-кластеризация Wordstat-запросов в темы посадочных
 * Description: AI группирует выгрузку Wordstat в темы посадочных: лендинги, статьи и коммерческие офферы. Разбор 100 ключей бесплатно.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-кластеризация Wordstat-запросов — карта посадочных под ключ';
$page_seo_description = 'AI группирует выгрузку Wordstat в темы посадочных: лендинги, статьи и коммерческие офферы. Внедрение под ключ для SEO и бизнеса. Разбор 100 ключей бесплатно.';

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

$brand               = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret
$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Собрать карту тем';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = '#etapy';

$nero_ai_header_links = [
    ['label' => 'Что получите', 'href' => '#rezultat'],
    ['label' => 'Как работает', 'href' => '#etapy'],
    ['label' => 'Стоимость',    'href' => '#ceny'],
    ['label' => 'Кейсы',        'href' => '#keisy'],
    ['label' => 'FAQ',          'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

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
body.nero-ai-landing #mobile-header {
  display: none !important;
}
body.nero-ai-landing {
  padding-top: 0 !important;
}

.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,
.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}

#primary,.site-main,.site-content,#content,.content-area{
  padding-top:0!important;margin-top:0!important;
}

.wstat-hero-cluster{
  min-height:100vh;
  min-height:100dvh;
  position:relative;
}

.ym-cta-block{
  border-radius:20px;padding:36px 40px;margin:32px 0;
  background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));
  border:1px solid rgba(121,242,255,.3);text-align:center;
}
.ym-cta-block--dual{
  background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));
  border-color:rgba(34,197,94,.3);
}
.ym-cta-block--footer-final{
  background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));
  border-color:rgba(139,92,246,.3);
}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{
  font-size:clamp(20px,2.8vw,28px);font-weight:800;
  color:#fff;margin:0 0 10px;
}
.ym-cta-block__sub{
  color:#9aa8bd;font-size:15px;
  margin:0 auto 22px;max-width:600px;line-height:1.7;
}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-cta-block__btn{margin-top:4px;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-klasternaya-klasterizaciya-wordstat-page" role="main" tabindex="-1">

<section class="nero-ai-hero wstat-hero-cluster" id="hero" aria-labelledby="hero-wstat-title">
<style>
/* ── Hero wstat-cluster: самодостаточные стили (без CSS темы) ── */
.wstat-hero-cluster {
  --wstat-cyan: #79f2ff;
  --wstat-violet: #8b5cf6;
  --wstat-green: #22c55e;
  --wstat-text: #e6edf7;
  --wstat-muted: #9aa8bd;
  --wstat-soft: #c7d2e5;
  --wstat-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.wstat-hero-cluster::before {
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
.wstat-hero-cluster::after {
  content: "";
  position: absolute;
  right: 8%;
  top: 12%;
  width: 640px;
  height: 640px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .12), transparent 66%);
  filter: blur(8px);
  animation: wstatHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes wstatHeroGlow {
  from { opacity: .4; transform: scale(.95); }
  to { opacity: .82; transform: scale(1.05); }
}
.wstat-hero-cluster .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.wstat-hero-cluster .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.wstat-hero-cluster .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.wstat-hero-cluster .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--wstat-cyan) 44%, var(--wstat-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.wstat-hero-cluster .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--wstat-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.wstat-hero-cluster .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--wstat-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.wstat-hero-cluster .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.wstat-hero-cluster .nero-ai-badge {
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
.wstat-hero-cluster .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.wstat-hero-cluster .nero-ai-btn {
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
.wstat-hero-cluster .nero-ai-btn:hover { transform: translateY(-2px); }
.wstat-hero-cluster .nero-ai-btn-primary {
  color: #fff !important;
  background: linear-gradient(135deg, #2563eb, #7c3aed);
  box-shadow: 0 18px 42px rgba(59, 130, 246, 0.35);
}
.wstat-hero-cluster .nero-ai-btn-secondary {
  color: var(--wstat-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.wstat-hero-cluster .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--wstat-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.wstat-hero-cluster .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.wstat-hero-cluster .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.wstat-hero-cluster .nero-ai-dots { display: flex; gap: 7px; }
.wstat-hero-cluster .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.wstat-hero-cluster .nero-ai-dot:nth-child(1) { background: #fb7185; }
.wstat-hero-cluster .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.wstat-hero-cluster .nero-ai-dot:nth-child(3) { background: #34d399; }
.wstat-hero-cluster .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.wstat-hero-cluster .nero-ai-window-body { padding: 16px; }
.wstat-hero-cluster .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.wstat-hero-cluster .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.wstat-hero-cluster .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(139, 92, 246, .14);
  color: #ddd6fe;
  font-size: 12px;
  font-weight: 800;
}
.wstat-hero-cluster .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--wstat-violet);
  box-shadow: 0 0 0 6px rgba(139, 92, 246, .18);
  animation: wstatPulse 1.6s infinite;
}
@keyframes wstatPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.wstat-hero-cluster .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 8px;
  margin-bottom: 12px;
}
.wstat-hero-cluster .nero-ai-metric {
  padding: 10px 8px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 14px;
  background: rgba(255,255,255,.055);
  text-align: center;
}
.wstat-hero-cluster .nero-ai-metric span {
  display: block;
  color: var(--wstat-muted);
  font-size: 10px;
  font-weight: 700;
}
.wstat-hero-cluster .nero-ai-metric strong {
  display: block;
  margin-top: 4px;
  color: var(--wstat-cyan);
  font-size: 18px;
  line-height: 1;
  font-weight: 900;
}
.wstat-hero-cluster .nero-ai-metric small {
  display: block;
  margin-top: 3px;
  color: #9fb0c9;
  font-size: 10px;
}
.wstat-hero-cluster .wstat-dash-canvas-wrap {
  position: relative;
  height: clamp(200px, 28vw, 260px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.18);
  background: radial-gradient(ellipse at 35% 40%, rgba(121,242,255,.06), rgba(6,10,24,.94) 72%);
}
.wstat-hero-cluster #wstat-cluster-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.wstat-hero-cluster .nero-ai-task-stream { display: grid; gap: 8px; }
.wstat-hero-cluster .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.wstat-hero-cluster .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--wstat-cyan);
  font-size: 10px;
  font-weight: 800;
}
.wstat-hero-cluster .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.wstat-hero-cluster .nero-ai-task span {
  color: var(--wstat-muted);
  font-size: 11px;
}
.wstat-hero-cluster .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.wstat-hero-cluster .nero-ai-status--violet {
  background: rgba(139,92,246,.14);
  color: #ddd6fe;
}
@media (max-width: 1100px) {
  .wstat-hero-cluster .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .wstat-hero-cluster .nero-ai-dashboard { transform: none; }
  .wstat-hero-cluster .nero-ai-metrics-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 520px) {
  .wstat-hero-cluster .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .wstat-hero-cluster .nero-ai-window-body { padding: 12px; }
  .wstat-hero-cluster .nero-ai-task { grid-template-columns: 28px 1fr; }
  .wstat-hero-cluster .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai wordstat</p>
      <h1 id="hero-wstat-title">AI-кластеризация Wordstat-запросов: <span class="nero-ai-gradient-text">карта посадочных и коммерческих офферов под ключ</span></h1>
      <p class="nero-ai-hero-lead">Сотни ключей из Wordstat → готовая карта лендингов, статей и офферов. Разбор 100 ключей бесплатно</p>
      <ul class="nero-ai-badges" aria-label="Ключевые этапы">
        <li class="nero-ai-badge">AI Wordstat</li>
        <li class="nero-ai-badge">Карта тем</li>
        <li class="nero-ai-badge">Excel</li>
        <li class="nero-ai-badge">Под ключ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#etapy">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: кластеризация Wordstat">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">wordstat · cluster map</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Карта кластеров</h3>
            <span class="nero-ai-live-pill">кластеризация</span>
          </div>
          <div class="nero-ai-metrics-grid" aria-label="Метрики демо-карты">
            <div class="nero-ai-metric"><span>ключей</span><strong>847</strong><small>Wordstat</small></div>
            <div class="nero-ai-metric"><span>кластеров</span><strong>23</strong><small>по интенту</small></div>
            <div class="nero-ai-metric"><span>страниц</span><strong>19</strong><small>лендинг+статья</small></div>
            <div class="nero-ai-metric"><span>P1</span><strong>6</strong><small>приоритет</small></div>
          </div>
          <div class="wstat-dash-canvas-wrap" aria-hidden="false">
            <canvas id="wstat-cluster-hero-canvas" role="img" aria-label="Анимация: хаос ключей Wordstat группируется в кластеры и экспортируется в Excel-карту тем"></canvas>
          </div>
          <div class="nero-ai-task-stream">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CSV</span>
              <div><strong>CSV Wordstat</strong><span>выгрузка 847 фраз</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>AI intent split</strong><span>23 кластера · 4 интента</span></div>
              <span class="nero-ai-status nero-ai-status--violet">в работе</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">XLS</span>
              <div><strong>Excel карта тем</strong><span>H1 · оффер · P1/P2</span></div>
              <span class="nero-ai-status">экспорт</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * wstat-cluster-hero-engine — «Диспетчерская кластеризации Wordstat»
 * Мир: облако тегов → призма интента → радиальная карта кластеров → SERP-кольцо → Excel
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("wstat-cluster-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 240;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 6;
    scale = Math.min(cw / 420, ch / 260) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    info: "#38bdf8",
    commercial: "#8b5cf6",
    transactional: "#22c55e",
    navigational: "#fbbf24",
    csvBg: "#1e293b",
    hubCore: "#0f172a",
    hubRing: "rgba(121,242,255,0.35)",
    excelRow: "rgba(255,255,255,0.08)",
    p1Green: "#22c55e",
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
      ctx.lineWidth = 1.2;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  function drawTag(ctx, x, y, w, h, color, label) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 4, color, C.outline);
    if (label) {
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 5.5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(label, x, y + 2);
    }
  }

  /* Поток тегов по орбитам — вместо Conveyor */
  function KeywordTagRiver() {
    this.tags = [
      { angle: 0.2, radius: 95, speed: 0.018, color: "rgba(56,189,248,0.55)", label: "купить" },
      { angle: 1.1, radius: 88, speed: 0.022, color: "rgba(139,92,246,0.55)", label: "цена" },
      { angle: 2.4, radius: 102, speed: 0.016, color: "rgba(34,197,94,0.5)", label: "заказать" },
      { angle: 3.8, radius: 92, speed: 0.02, color: "rgba(251,191,36,0.5)", label: "как" },
      { angle: 4.6, radius: 98, speed: 0.019, color: "rgba(56,189,248,0.45)", label: "ai" },
      { angle: 5.5, radius: 86, speed: 0.023, color: "rgba(139,92,246,0.45)", label: "wordstat" }
    ];
  }
  KeywordTagRiver.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 260;
    var pull = prg > 55 && prg < 130 ? (prg - 55) / 75 : (prg >= 130 ? 1 : 0);
    this.tags.forEach(function (t, i) {
      t.angle += t.speed;
      var r = t.radius * (1 - pull * 0.72);
      var tx = Math.cos(t.angle + i) * r;
      var ty = Math.sin(t.angle * 0.9 + i * 0.5) * r * 0.55;
      var wobble = Math.sin(frame * 0.05 + i) * (3 * (1 - pull));
      if (pull < 0.95) {
        drawTag(ctx, tx + wobble, ty, 28, 12, t.color, t.label);
      }
    });
  };

  /* Призма интента — уникальный объект */
  function IntentPrismSplitter() {
    this.glow = 0;
  }
  IntentPrismSplitter.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 260;
    if (prg < 40 || prg > 145) return;
    var local = (prg - 40) / 40;
    var alpha = Math.min(1, local) * (prg < 120 ? 1 : 1 - (prg - 120) / 25);
    ctx.save();
    ctx.globalAlpha = alpha * 0.85;
    ctx.translate(-120, -20);
    ctx.beginPath();
    ctx.moveTo(0, -18);
    ctx.lineTo(16, 14);
    ctx.lineTo(-16, 14);
    ctx.closePath();
    ctx.fillStyle = "rgba(121,242,255,0.15)";
    ctx.strokeStyle = C.hubRing;
    ctx.lineWidth = 1.5;
    ctx.fill();
    ctx.stroke();
    var intents = [
      { c: C.info, x: -8, y: -6 },
      { c: C.commercial, x: 6, y: -4 },
      { c: C.transactional, x: -4, y: 8 },
      { c: C.navigational, x: 8, y: 6 }
    ];
    intents.forEach(function (it) {
      ctx.fillStyle = it.c;
      ctx.beginPath();
      ctx.arc(it.x, it.y, 3, 0, Math.PI * 2);
      ctx.fill();
    });
    ctx.restore();
  };

  /* Радиальная карта кластеров — вместо WebsiteTerminal */
  function ClusterGalaxyHub() {
    this.nodes = [
      { a: -0.8, r: 42, color: C.transactional, label: "P1" },
      { a: 0.5, r: 48, color: C.commercial, label: "оффер" },
      { a: 1.9, r: 40, color: C.info, label: "гайд" },
      { a: 2.8, r: 46, color: C.transactional, label: "ленд" },
      { a: 4.1, r: 38, color: C.navigational, label: "FAQ" },
      { a: 5.2, r: 44, color: C.commercial, label: "P1" }
    ];
    this.snap = 0;
  }
  ClusterGalaxyHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 260;
    var grow = prg > 70 ? Math.min(1, (prg - 70) / 50) : 0;

    ctx.strokeStyle = C.hubRing;
    ctx.lineWidth = 1;
    for (var ring = 1; ring <= 3; ring++) {
      ctx.beginPath();
      ctx.arc(0, 0, 18 + ring * 14 * grow, 0, Math.PI * 2);
      ctx.globalAlpha = 0.25 + ring * 0.1;
      ctx.stroke();
    }
    ctx.globalAlpha = 1;

    drawRR(ctx, -22, -16, 44, 32, 6, C.hubCore, C.outline);
    ctx.fillStyle = C.hubRing;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("MAP", 0, 2);

    if (grow > 0.2) {
      this.nodes.forEach(function (n, i) {
        var pop = Math.min(1, grow - i * 0.08);
        if (pop <= 0) return;
        var nx = Math.cos(n.a) * n.r * pop;
        var ny = Math.sin(n.a) * n.r * 0.7 * pop;
        var pulse = 1 + Math.sin(frame * 0.08 + i) * 0.06;
        ctx.save();
        ctx.translate(nx, ny);
        ctx.scale(pulse, pulse);
        drawRR(ctx, -14, -10, 28, 20, 5, n.color + "33", n.color);
        ctx.fillStyle = "#fff";
        ctx.font = "bold 5px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(n.label, 0, 2);
        ctx.restore();
      });
    }
  };

  /* SERP-кольцо валидации */
  function SERPValidationRing() {
    this.spin = 0;
  }
  SERPValidationRing.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 260;
    if (prg < 130 || prg > 200) return;
    this.spin += 0.04;
    ctx.save();
    ctx.strokeStyle = C.p1Green;
    ctx.lineWidth = 2;
    ctx.globalAlpha = 0.35 + Math.sin(frame * 0.1) * 0.2;
    ctx.beginPath();
    ctx.arc(-28, -8, 28, this.spin, this.spin + Math.PI * 1.2);
    ctx.stroke();
    ctx.fillStyle = C.p1Green;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.globalAlpha = 0.9;
    ctx.fillText("SERP", -28, -6);
    ctx.restore();
  };

  /* Excel-терминал — финал цикла */
  function ExcelMapTerminal() {
    this.rows = ["C-014 landing", "C-021 article", "C-033 offer"];
  }
  ExcelMapTerminal.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 260;
    if (prg < 185) return;
    var bloom = Math.min(1, (prg - 185) / 30);
    ctx.save();
    ctx.globalAlpha = bloom;
    drawRR(ctx, 95, -42, 72, 78, 6, "rgba(15,23,42,0.92)", C.hubRing);
    ctx.fillStyle = "#79f2ff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Карта тем.xlsx", 102, -30);
    this.rows.forEach(function (r, i) {
      var rowOn = bloom > 0.2 + i * 0.15;
      if (!rowOn) return;
      drawRR(ctx, 100, -18 + i * 18, 64, 14, 3, C.excelRow, "rgba(255,255,255,0.12)");
      ctx.fillStyle = "#cbd5e1";
      ctx.font = "5.5px Inter,sans-serif";
      ctx.fillText(r, 104, -8 + i * 18);
      if (i < 2) {
        drawRR(ctx, 152, -16 + i * 18, 10, 10, 2, C.p1Green + "44", C.p1Green);
        ctx.fillStyle = C.p1Green;
        ctx.font = "bold 5px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("P1", 157, -9 + i * 18);
      }
    });
    ctx.restore();
  };

  /* CSV-вход */
  function WordstatCsvIngest() {}
  WordstatCsvIngest.prototype.draw = function (ctx) {
    drawRR(ctx, -155, -55, 36, 28, 4, C.csvBg, C.outline);
    ctx.fillStyle = "#79f2ff";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("CSV", -137, -44);
    for (var i = 0; i < 3; i++) {
      ctx.strokeStyle = "rgba(148,163,184,0.5)";
      ctx.beginPath();
      ctx.moveTo(-150, -36 + i * 5);
      ctx.lineTo(-122, -36 + i * 5);
      ctx.stroke();
    }
  };

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
    this.orbitAngle = Math.random() * Math.PI * 2;
  }
  Agent.prototype.draw = function (ctx) {
    this.timer += 0.03;
    var prg = (frame * 0.04) % 260;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    /* Орбитальное движение к узлам карты — не к конвейеру */
    if (prg >= this.stepTrig && prg < this.stepTrig + 28) {
      var local = prg - this.stepTrig;
      var targetA = this.orbitAngle;
      var targetR = 38;
      var tx = Math.cos(targetA) * targetR;
      var ty = Math.sin(targetA) * targetR * 0.65;
      if (local < 12) {
        isMoving = true;
        this.x = this.baseX + (tx - this.baseX) * (local / 12);
        this.y = this.baseY + (ty - this.baseY) * (local / 12);
        carryType = this.color;
        faceDir = tx > this.baseX ? 1 : -1;
      } else if (local < 18) {
        this.x = tx; this.y = ty;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tx - (tx - this.baseX) * ((local - 18) / 10);
        this.y = ty - (ty - this.baseY) * ((local - 18) / 10);
      }
    } else {
      this.x = this.baseX;
      this.y = this.baseY;
      if (prg >= this.stepTrig - 8) carryType = this.color;
    }

    if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
      var rnd = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
      createBubble(this.x, this.y - 18, rnd, 220);
    }

    var bob = isMoving ? Math.abs(Math.sin(this.timer * 4)) * 2 : Math.sin(this.timer * 1.4) * 1.2;
    ctx.save();
    ctx.translate(this.x, this.y);
    drawRR(ctx, -8, -4 + bob, 7, 12, 2, C.outline, null);
    drawRR(ctx, 1, -4 + bob, 7, 12, 2, C.outline, null);
    drawRR(ctx, -12, -10 - bob, 24, 16, 5, this.color, C.outline);
    var hx = 0, hy = -22 - bob;
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(hx, hy, 10, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.2;
    ctx.stroke();
    ctx.save();
    ctx.scale(faceDir, 1);
    ctx.fillStyle = "#fff";
    ctx.beginPath(); ctx.arc(hx + 3, hy - 2, 3, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 3, hy - 2, 3, 0, Math.PI * 2); ctx.fill();
    ctx.fillStyle = C.outline;
    ctx.beginPath(); ctx.arc(hx + 4, hy - 2, 1.5, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 2, hy - 2, 1.5, 0, Math.PI * 2); ctx.fill();
    ctx.restore();
    if (carryType) drawRR(ctx, -14 * faceDir, -16 - bob, 12, 12, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];

  entities.push(new WordstatCsvIngest());
  entities.push(new KeywordTagRiver());
  entities.push(new IntentPrismSplitter());
  entities.push(new ClusterGalaxyHub());
  entities.push(new SERPValidationRing());
  entities.push(new ExcelMapTerminal());

  entities.push(new Agent(-145, 35, C.agentYellow, "1_architect", 42, [
    "Загружаю CSV Wordstat",
    "847 seed-ключей",
    "Brief готов"
  ]));
  entities.push(new Agent(-95, 58, C.agentGreen, "2_seo", 78, [
    "Сплит по интенту",
    "Дубль «цена/купить»",
    "23 кластера ок"
  ]));
  entities.push(new Agent(-40, 22, C.agentBlue, "3_coder", 108, [
    "Батч 50–200 фраз",
    "JSON cluster_id",
    "Embedding merge"
  ]));
  entities.push(new Agent(25, 55, C.agentPink, "4_designer", 138, [
    "Черновик H1",
    "Оффер на лендинг",
    "Тип: article"
  ]));
  entities.push(new Agent(70, 18, C.agentPurple, "5_deployer", 168, [
    "Экспорт Excel",
    "6 × P1 в карте",
    "Карта тем готова"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life, maxLife: life });
  }

  function engineLoop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.04) % 260;
    if (prg >= 38 && prg < 38.05) createBubble(-120, -30, "Призма интента");
    if (prg >= 72 && prg < 72.05) createBubble(0, -10, "Стягиваю кластеры");
    if (prg >= 132 && prg < 132.05) createBubble(-28, -20, "SERP P1-check");
    if (prg >= 188 && prg < 188.05) createBubble(120, -20, "Excel · карта тем");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      if (b.life > b.maxLife - 8) alpha = (b.maxLife - b.life) / 8;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 18, tw, 16, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(b.text, b.x, b.y - 10);
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

<!-- КОНТЕНТНАЯ ЧАСТЬ (НЕ HERO) — Борис для Наташи -->
<style>
/* === WSK PAGE — scoped under .wsk-content === */
.wsk-content{
  --wsk-bg:#050711;--wsk-bg2:#080b17;
  --wsk-surface:rgba(255,255,255,.072);--wsk-border:rgba(255,255,255,.10);
  --wsk-text:#e6edf7;--wsk-muted:#9aa8bd;--wsk-soft:#c7d2e5;--wsk-heading:#fff;
  --wsk-accent:#79f2ff;--wsk-violet:#8b5cf6;--wsk-green:#22c55e;--wsk-amber:#f59e0b;
  --wsk-btn-from:#2563eb;--wsk-btn-to:#7c3aed;
  --wsk-r:18px;--wsk-r-lg:24px;--wsk-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--wsk-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.wsk-content *,.wsk-content *::before,.wsk-content *::after{box-sizing:border-box;}
.wsk-content p{color:var(--wsk-muted);line-height:1.72;margin:0 0 1em;}
.wsk-content p:last-child{margin-bottom:0;}
.wsk-content h2,.wsk-content h3,.wsk-content h4{color:var(--wsk-heading);letter-spacing:-.04em;margin:0 0 .7em;}
.wsk-content strong{color:var(--wsk-soft);}
.wsk-content a{color:inherit;}
.wsk-content ul,.wsk-content ol{padding-left:0;list-style:none;margin:0 0 1em;}
.wsk-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--wsk-muted);font-size:14.5px;line-height:1.65;}
.wsk-content ul li::before{content:'›';position:absolute;left:0;color:var(--wsk-accent);font-weight:700;}
.wsk-cnt{width:min(var(--wsk-container),calc(100% - 40px));margin:0 auto;}
.wsk-section{padding:clamp(56px,7vw,96px) 0;position:relative;}
.wsk-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-top:1px solid rgba(255,255,255,.05);border-bottom:1px solid rgba(255,255,255,.05);}
.wsk-sh{max-width:820px;margin:0 auto 40px;text-align:center;}
.wsk-sh.wsk-left{margin-left:0;text-align:left;}
.wsk-sh h2{font-size:clamp(24px,3.6vw,44px);line-height:1.08;margin-bottom:12px;}
.wsk-sh p{font-size:clamp(15px,1.55vw,17px);max-width:680px;margin:0 auto;}
.wsk-sh.wsk-left p{margin-left:0;}
.wsk-eyebrow{display:inline-block;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--wsk-accent);margin-bottom:12px;}

/* INTRO */
.wsk-intro{padding:clamp(40px,5vw,72px) 0 clamp(36px,4vw,56px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.wsk-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:48px;align-items:center;}
.wsk-intro-text{position:relative;padding-left:20px;}
.wsk-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--wsk-accent),var(--wsk-violet));}
.wsk-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.wsk-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px);}
.wsk-kpi-card .kv{font-size:clamp(18px,2.2vw,24px);font-weight:900;color:var(--wsk-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.wsk-kpi-card .kl{font-size:11px;font-weight:600;color:var(--wsk-muted);line-height:1.4;}
@media(max-width:900px){.wsk-intro-grid{grid-template-columns:1fr;gap:32px;}.wsk-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.wsk-intro-kpi{grid-template-columns:1fr 1fr;}}

/* CALLOUT / CARDS */
.wsk-callout-amber{background:rgba(245,158,11,.1);border:1px solid rgba(245,158,11,.35);border-radius:var(--wsk-r);padding:18px 22px;margin:24px 0;}
.wsk-callout-amber p{color:#fcd34d;margin:0;}
.wsk-callout-cyan{background:rgba(121,242,255,.08);border-left:3px solid var(--wsk-accent);border-radius:0 var(--wsk-r) var(--wsk-r) 0;padding:16px 20px;margin:24px 0;}
.wsk-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--wsk-border);border-radius:var(--wsk-r-lg);padding:24px;backdrop-filter:blur(16px);margin-bottom:20px;}
.wsk-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:18px;}
.wsk-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;}
@media(max-width:768px){.wsk-grid-2,.wsk-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.wsk-grid-3{grid-template-columns:1fr 1fr;}}

/* TABLES */
.wsk-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.wsk-table{width:100%;border-collapse:collapse;font-size:13.5px;}
.wsk-table th{padding:12px 14px;text-align:left;background:rgba(121,242,255,.1);color:var(--wsk-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.wsk-table td{padding:11px 14px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--wsk-text);vertical-align:top;}
.wsk-table tr:last-child td{border-bottom:none;}
.wsk-table tr:hover td{background:rgba(255,255,255,.03);}
.wsk-badge-p1{display:inline-block;padding:3px 9px;border-radius:6px;font-size:11px;font-weight:700;background:rgba(34,197,94,.15);color:var(--wsk-green);}

/* EXCEL MOCK */
.wsk-excel-mock{background:rgba(255,255,255,.055);border:1px solid rgba(121,242,255,.25);border-radius:var(--wsk-r-lg);padding:20px;margin:24px 0;box-shadow:0 0 40px rgba(121,242,255,.08);}
.wsk-excel-mock__head{display:flex;align-items:center;gap:10px;margin-bottom:14px;font-size:13px;color:var(--wsk-accent);font-weight:700;}

/* PIPELINE */
.wsk-pipeline{display:flex;flex-wrap:wrap;gap:8px;align-items:center;margin:24px 0;padding:16px;background:rgba(255,255,255,.04);border-radius:14px;border:1px solid rgba(255,255,255,.08);font-size:13px;color:var(--wsk-muted);}
.wsk-pipeline span{color:var(--wsk-accent);font-weight:600;}
.wsk-timeline{position:relative;padding-left:40px;}
.wsk-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--wsk-accent),var(--wsk-violet));opacity:.35;border-radius:2px;}
.wsk-tl-item{position:relative;margin-bottom:28px;}
.wsk-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--wsk-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2);}

/* PRICING */
.wsk-pricing-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin:28px 0;}
.wsk-price-card{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:20px;padding:24px 20px;transition:border-color .22s,transform .22s;}
.wsk-price-card:hover{border-color:rgba(121,242,255,.35);transform:translateY(-2px);}
.wsk-price-card.wsk-featured{border-color:rgba(121,242,255,.45);background:rgba(121,242,255,.07);}
.wsk-price-card .tier{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--wsk-accent);margin-bottom:8px;}
.wsk-price-card .amount{font-size:clamp(18px,2.2vw,26px);font-weight:900;color:#fff;line-height:1;margin-bottom:8px;}

/* CASES */
.wsk-case-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px;}
@media(max-width:768px){.wsk-case-grid{grid-template-columns:1fr;}}
.wsk-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:18px;padding:22px;}
.wsk-case-tag{font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--wsk-green);margin-bottom:8px;}
.wsk-case-src{font-size:12px;color:#64748b;margin-top:12px;}

/* SEGMENTS */
.wsk-seg-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:18px;padding:22px;height:100%;}

/* FAQ */
.wsk-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.wsk-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.wsk-faq-q{padding:18px 22px;font-size:15px;font-weight:700;color:var(--wsk-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:12px;user-select:none;}
.wsk-faq-q::after{content:'▾';font-size:13px;color:var(--wsk-accent);flex-shrink:0;transition:transform .25s;}
.wsk-faq-item.open .wsk-faq-q::after{transform:rotate(180deg);}
.wsk-faq-a{padding:0 22px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14px;color:var(--wsk-muted);line-height:1.72;}
.wsk-faq-item.open .wsk-faq-a{max-height:800px;padding:0 22px 18px;}

/* CTA blocks (Artur ym-*) */
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--wsk-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

.wsk-disclaimer{font-size:13px;color:#64748b;text-align:center;padding:32px 0 48px;border-top:1px solid rgba(255,255,255,.06);}
.wsk-code{display:block;background:rgba(0,0,0,.35);border:1px solid rgba(255,255,255,.08);border-radius:10px;padding:14px 16px;font-size:12px;color:var(--wsk-accent);overflow-x:auto;margin:16px 0;font-family:ui-monospace,monospace;}

/* REVEAL */
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
</style>

<div class="wsk-content">

<!-- INTRO #intro -->
<section class="wsk-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Коротко о услуге">
  <div class="wsk-cnt nero-ai-container">
    <div class="wsk-intro-grid nero-ai-intro-grid nero-ai-reveal">
      <div class="wsk-intro-text nero-ai-intro-text">
        <p class="nero-ai-eyebrow">Коротко · ai wordstat</p>
        <p><strong>Nero Network</strong> превращает сырую выгрузку Wordstat в готовую карту посадочных — с типами страниц, черновиками H1, коммерческими офферами и приоритетами внедрения. Не подписка на SaaS и не «промпт в ChatGPT», а результат под ключ: Excel-файл, который можно сразу отдать копирайтерам, разработчикам и отделу продаж.</p>
        <p>Выгрузили 500, 2&nbsp;000 или 15&nbsp;000 фраз из Wordstat — и застряли на вопросе «какие страницы вообще создавать»? AI-кластеризация ключей решает именно эту боль. Для старта — <strong>разбор 100 ключей бесплатно</strong>. Полный проект — от <strong>80 до 250 тыс.&nbsp;₽</strong>.</p>
      </div>
      <div class="wsk-intro-kpi" aria-label="Ключевые показатели">
        <div class="wsk-kpi-card"><div class="kv">500–15&nbsp;000</div><div class="kl">ключей в выгрузке Wordstat</div></div>
        <div class="wsk-kpi-card"><div class="kv">8–15</div><div class="kl">кластеров в лид-магните</div></div>
        <div class="wsk-kpi-card"><div class="kv">5–21</div><div class="kl">день до карты тем</div></div>
        <div class="wsk-kpi-card"><div class="kv">80–250&nbsp;тыс.&nbsp;₽</div><div class="kl">ориентир чека проекта</div></div>
      </div>
    </div>
  </div>
</section>

<!-- BOL #bol -->
<section class="wsk-section" id="bol">
  <div class="wsk-cnt nero-ai-container">
    <div class="wsk-sh wsk-left nero-ai-reveal">
      <span class="wsk-eyebrow">Боль ЦА</span>
      <h2>Ключей из Wordstat слишком много — непонятно, какие страницы создавать</h2>
      <p><strong>Определение проблемы:</strong> когда ключей много, а структура сайта непонятна — это не «мало опыта в SEO», а системный сбой на стыке сбора семантики и архитектуры контента.</p>
    </div>

    <div class="wsk-card nero-ai-reveal">
      <p>Типичная картина: SEO-специалист или владелец бизнеса выгружает из Wordstat сотни и тысячи фраз, открывает Excel — и видит хаос. «Купить», «цена», «как выбрать», «отзывы» и «рядом со мной» лежат в одной колонке. На одну страницу попадают информационные и транзакционные запросы.</p>
      <div class="wsk-callout-amber" role="note">
        <p>Через месяц — <strong>каннибализация</strong>: две URL борются за один интент, обе вылетают из топа.</p>
      </div>
    </div>

    <h3 style="font-size:18px;margin:28px 0 14px;color:var(--wsk-heading);">Почему ручная кластеризация запросов Wordstat не спасает</h3>
    <ul class="nero-ai-reveal">
      <li>На 300–500 ключей уходит 2–5 рабочих дней — при том что SaaS-кластеризаторы обрабатывают 5&nbsp;000 фраз примерно за 5 минут (<a href="https://www.rush-analytics.ru/land/klasterizaciya-zaprosov-semanticheskogo-yadra-po-yandex-i-google" target="_blank" rel="noopener noreferrer">Rush Analytics</a>).</li>
      <li>Excel не видит интент: «купить смеситель» и «как работает смеситель» визуально похожи, но требуют разных страниц (<a href="https://axdigital.ru/blog/seo-klasterizaciya-claude-api-500-klyuchej/" target="_blank" rel="noopener noreferrer">axdigital.ru</a>).</li>
      <li>Подписка на SEO-SaaS (от ~2&nbsp;500–3&nbsp;500&nbsp;₽/мес) окупается только при регулярной работе с семантикой; для 2–3 проектов в квартал это переплата.</li>
    </ul>

    <div class="wsk-callout-cyan nero-ai-reveal">
      <p><strong>Итог:</strong> вам нужна не ещё одна таблица ключей, а <strong>карта посадочных страниц</strong> — с понятным ответом на вопрос «что создавать, в каком порядке и с каким оффером».</p>
    </div>

    <!-- БОРИС: визуальный блок хаос → кластеры -->
    <section id="ai-klasternaya-klasterizaciya-wordstat-boris-block" class="wsk-boris-root" aria-label="Анимация: хаос Wordstat-запросов превращается в карту кластеров посадочных">
<style>
#ai-klasternaya-klasterizaciya-wordstat-boris-block.wsk-boris-root{margin:40px 0 0;padding:0;}
#ai-klasternaya-klasterizaciya-wordstat-boris-block .wsk-boris-card{
  display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;overflow:hidden;
  background:linear-gradient(135deg,rgba(255,255,255,.06),rgba(255,255,255,.03));
  border:1px solid rgba(121,242,255,.22);
  box-shadow:0 16px 48px rgba(0,0,0,.35);
  min-height:480px;
}
@media(max-width:1023px){#ai-klasternaya-klasterizaciya-wordstat-boris-block .wsk-boris-card{grid-template-columns:1fr;min-height:auto;}}
#ai-klasternaya-klasterizaciya-wordstat-boris-block .wsk-boris-lft{
  padding:36px 32px;display:flex;flex-direction:column;justify-content:center;
  border-right:1px solid rgba(255,255,255,.08);
}
@media(max-width:1023px){#ai-klasternaya-klasterizaciya-wordstat-boris-block .wsk-boris-lft{border-right:none;border-bottom:1px solid rgba(255,255,255,.08);padding:28px 22px;}}
#ai-klasternaya-klasterizaciya-wordstat-boris-block .wsk-boris-ey{
  display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;
  letter-spacing:.12em;text-transform:uppercase;color:var(--wsk-violet);margin:0 0 12px;
}
#ai-klasternaya-klasterizaciya-wordstat-boris-block .wsk-boris-ey::before{content:'';width:18px;height:2px;background:var(--wsk-violet);border-radius:1px;}
#ai-klasternaya-klasterizaciya-wordstat-boris-block .wsk-boris-h3{font-size:clamp(19px,2.2vw,24px);font-weight:800;color:var(--wsk-heading);line-height:1.28;margin:0 0 16px;}
#ai-klasternaya-klasterizaciya-wordstat-boris-block .wsk-boris-ul{list-style:none;margin:0 0 18px;padding:0;display:flex;flex-direction:column;gap:8px;}
#ai-klasternaya-klasterizaciya-wordstat-boris-block .wsk-boris-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:var(--wsk-muted);padding-left:0;}
#ai-klasternaya-klasterizaciya-wordstat-boris-block .wsk-boris-ul li::before{display:none;}
#ai-klasternaya-klasterizaciya-wordstat-boris-block .wsk-boris-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(139,92,246,.15);
  display:flex;align-items:center;justify-content:center;font-size:11px;color:var(--wsk-violet);font-style:normal;
}
#ai-klasternaya-klasterizaciya-wordstat-boris-block .wsk-boris-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:14px;}
#ai-klasternaya-klasterizaciya-wordstat-boris-block .wsk-boris-pl{
  padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
}
#ai-klasternaya-klasterizaciya-wordstat-boris-block .wsk-boris-pl-c{background:rgba(121,242,255,.12);color:var(--wsk-accent);border:1.5px solid rgba(121,242,255,.28);}
#ai-klasternaya-klasterizaciya-wordstat-boris-block .wsk-boris-pl-v{background:rgba(139,92,246,.12);color:#c4b5fd;border:1.5px solid rgba(139,92,246,.28);}
#ai-klasternaya-klasterizaciya-wordstat-boris-block .wsk-boris-pl-g{background:rgba(34,197,94,.12);color:var(--wsk-green);border:1.5px solid rgba(34,197,94,.28);}
#ai-klasternaya-klasterizaciya-wordstat-boris-block .wsk-boris-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#ai-klasternaya-klasterizaciya-wordstat-boris-block .wsk-boris-rgt{
  position:relative;background:linear-gradient(145deg,#0a0e1c 0%,#111827 50%,#0d1526 100%);
  min-height:420px;overflow:hidden;
}
@media(max-width:1023px){#ai-klasternaya-klasterizaciya-wordstat-boris-block .wsk-boris-rgt{min-height:360px;}}
#wsk-cluster-map-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
      <div class="wsk-boris-card">
        <div class="wsk-boris-lft">
          <span class="wsk-boris-ey">Wordstat → карта</span>
          <h3 class="wsk-boris-h3">847 фраз в Excel — 23 кластера с типом страницы и оффером</h3>
          <ul class="wsk-boris-ul">
            <li><span class="wsk-boris-ic">1</span>Слева — хаос: транзакционные, info и geo-запросы в одной колонке</li>
            <li><span class="wsk-boris-ic">2</span>AI группирует по интенту: landing, статья, FAQ, категория</li>
            <li><span class="wsk-boris-ic">3</span>Справа — карта: cluster_id, draft_h1, priority P1/P2/P3</li>
          </ul>
          <div class="wsk-boris-pills">
            <span class="wsk-boris-pl wsk-boris-pl-c">847 → 23</span>
            <span class="wsk-boris-pl wsk-boris-pl-v">intent split</span>
            <span class="wsk-boris-pl wsk-boris-pl-g">Excel карта</span>
          </div>
          <p class="wsk-boris-foot">Дальше — что такое AI-кластеризация и чем она отличается от Excel →</p>
        </div>
        <div class="wsk-boris-rgt">
          <canvas id="wsk-cluster-map-canvas" aria-label="Анимация: Wordstat-запросы группируются в кластеры посадочных страниц" role="img"></canvas>
        </div>
      </div>
<script>
(function(){
  'use strict';
  var cv = document.getElementById('wsk-cluster-map-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, t = 0;

  var keywords = [
    {x:0,y:0,t:'купить',c:'#f59e0b'},{x:0,y:0,t:'цена',c:'#f59e0b'},
    {x:0,y:0,t:'как выбрать',c:'#79f2ff'},{x:0,y:0,t:'отзывы',c:'#79f2ff'},
    {x:0,y:0,t:'заказать',c:'#f59e0b'},{x:0,y:0,t:'рядом',c:'#94a3b8'},
    {x:0,y:0,t:'сравнение',c:'#79f2ff'},{x:0,y:0,t:'под ключ',c:'#8b5cf6'},
    {x:0,y:0,t:'wordstat',c:'#8b5cf6'},{x:0,y:0,t:'кластер',c:'#8b5cf6'},
    {x:0,y:0,t:'лендинг',c:'#22c55e'},{x:0,y:0,t:'статья',c:'#22c55e'},
    {x:0,y:0,t:'faq',c:'#22c55e'},{x:0,y:0,t:'оффер',c:'#22c55e'},
    {x:0,y:0,t:'ai',c:'#8b5cf6'},{x:0,y:0,t:'семантика',c:'#79f2ff'},
    {x:0,y:0,t:'интент',c:'#8b5cf6'},{x:0,y:0,t:'P1',c:'#22c55e'}
  ];

  var clusters = [
    {x:0,y:0,r:52,c:'#22c55e',label:'Landing',n:4},
    {x:0,y:0,r:44,c:'#79f2ff',label:'Статья',n:5},
    {x:0,y:0,r:40,c:'#8b5cf6',label:'AI-сервис',n:4},
    {x:0,y:0,r:36,c:'#f59e0b',label:'Коммерция',n:5}
  ];

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 420;
    W = cv.width; H = cv.height;
    var i, k;
    for (i = 0; i < keywords.length; i++) {
      k = keywords[i];
      k.sx = W * 0.08 + Math.random() * W * 0.32;
      k.sy = H * 0.12 + Math.random() * H * 0.76;
      k.tx = W * 0.58 + (i % 4) * W * 0.09;
      k.ty = H * 0.22 + Math.floor(i / 4) * H * 0.16 + (Math.random() - 0.5) * 20;
    }
    clusters[0].x = W * 0.62; clusters[0].y = H * 0.28;
    clusters[1].x = W * 0.78; clusters[1].y = H * 0.32;
    clusters[2].x = W * 0.68; clusters[2].y = H * 0.58;
    clusters[3].x = W * 0.84; clusters[3].y = H * 0.62;
  }
  window.addEventListener('resize', resize);
  resize();

  function ease(p){ return p < 0.5 ? 2*p*p : 1 - Math.pow(-2*p + 2, 2) / 2; }

  function draw(){
    t += 0.012;
    var phase = (Math.sin(t * 0.7) + 1) / 2;
    var p = ease(phase);
    ctx.clearRect(0, 0, W, H);

    ctx.strokeStyle = 'rgba(121,242,255,0.12)';
    ctx.setLineDash([4, 6]);
    ctx.beginPath();
    ctx.moveTo(W * 0.46, H * 0.08);
    ctx.lineTo(W * 0.46, H * 0.92);
    ctx.stroke();
    ctx.setLineDash([]);

    ctx.fillStyle = 'rgba(154,168,189,0.7)';
    ctx.font = '600 11px Inter, sans-serif';
    ctx.fillText('хаос Wordstat', W * 0.1, H * 0.08);
    ctx.fillStyle = 'rgba(34,197,94,0.85)';
    ctx.fillText('карта кластеров', W * 0.58, H * 0.08);

    var i, k, x, y, ci, cl;
    for (i = 0; i < keywords.length; i++) {
      k = keywords[i];
      x = k.sx + (k.tx - k.sx) * p;
      y = k.sy + (k.ty - k.sy) * p;
      ctx.beginPath();
      ctx.arc(x, y, 4, 0, Math.PI * 2);
      ctx.fillStyle = k.c;
      ctx.globalAlpha = 0.85;
      ctx.fill();
      ctx.globalAlpha = 1;
      if (i % 3 === 0 && p > 0.3) {
        ctx.font = '500 9px Inter, sans-serif';
        ctx.fillStyle = 'rgba(230,237,247,0.55)';
        ctx.fillText(k.t, x + 6, y - 4);
      }
    }

    for (ci = 0; ci < clusters.length; ci++) {
      cl = clusters[ci];
      var cr = cl.r * (0.3 + p * 0.7);
      ctx.beginPath();
      ctx.arc(cl.x, cl.y, cr, 0, Math.PI * 2);
      ctx.strokeStyle = cl.c;
      ctx.globalAlpha = 0.25 + p * 0.35;
      ctx.lineWidth = 2;
      ctx.stroke();
      ctx.globalAlpha = 0.08 + p * 0.12;
      ctx.fillStyle = cl.c;
      ctx.fill();
      ctx.globalAlpha = 1;
      if (p > 0.55) {
        ctx.font = '700 11px Inter, sans-serif';
        ctx.fillStyle = cl.c;
        ctx.fillText(cl.label, cl.x - cr * 0.35, cl.y + 4);
      }
    }

    requestAnimationFrame(draw);
  }
  draw();
})();
</script>
    </section>
    <!-- /БОРИС -->
  </div>
</section>

<!-- CHTO-TAKOE #chto-takoe -->
<section class="wsk-section wsk-section-alt" id="chto-takoe">
  <div class="wsk-cnt nero-ai-container">
    <div class="wsk-sh nero-ai-reveal">
      <span class="wsk-eyebrow">Экспертиза</span>
      <h2>Что такое AI-кластеризация Wordstat-запросов</h2>
      <p><strong>Определение:</strong> AI-кластеризация Wordstat — автоматизированный пайплайн, который берёт сырой список запросов и превращает его в структурированную карту сайта: кластеры → тип страницы → интент → черновик H1 → коммерческий оффер → приоритет P1/P2/P3.</p>
    </div>

    <div class="wsk-card nero-ai-reveal">
      <p>В 2026 году Wordstat стал доступен программно через Yandex Cloud Search API и MCP-коннекторы (<a href="https://habr.com/ru/articles/1030276/" target="_blank" rel="noopener noreferrer">Habr</a>; <a href="https://github.com/marketscore/marketscore-wordstat-mcp" target="_blank" rel="noopener noreferrer">marketscore-wordstat-mcp</a>). Gartner фиксирует переход к autonomous marketing: CMO ищут управляемые AI-воркфлоу с контролем затрат.</p>
    </div>

    <h3 id="kak-grupiruet" style="font-size:20px;margin:36px 0 16px;">Как нейросеть группирует семантику в темы посадочных</h3>
    <p>Нейросеть для семантики работает в три слоя:</p>
    <ol style="padding-left:20px;margin:0 0 1.5em;color:var(--wsk-muted);">
      <li style="margin-bottom:.6em;"><strong style="color:var(--wsk-soft);">Нормализация</strong> — удаление мусора, дублей, навигационного шума, разметка брендов и гео.</li>
      <li style="margin-bottom:.6em;"><strong style="color:var(--wsk-soft);">Кластеризация по смыслу и интенту</strong> — батчи по 50–200 фраз, на выходе JSON с полями: <code>cluster_id</code>, <code>name</code>, <code>intent</code>, <code>keywords[]</code>, <code>suggested_page_type</code>, <code>draft_h1</code>, <code>draft_offer</code>, <code>priority</code>.</li>
      <li><strong style="color:var(--wsk-soft);">Объяснение логики</strong> — каждый кластер получает поле «почему сгруппировано» (anti-black-box).</li>
    </ol>
    <p>AI распознаёт четыре типа интента: информационный, коммерческий, транзакционный, навигационный (<a href="https://key-core.ru/blog/klasterizaciya-klyuchevyh-slov/" target="_blank" rel="noopener noreferrer">KeyCore</a>).</p>

    <h3 id="chem-otlichaetsya" style="font-size:20px;margin:36px 0 16px;">Чем AI-кластеризация отличается от ручной группировки в Excel</h3>
    <div class="wsk-table-wrap nero-ai-reveal">
      <table class="wsk-table">
        <thead><tr><th>Метод</th><th>Как работает</th><th>Сильные стороны</th><th>Слабые стороны</th></tr></thead>
        <tbody>
          <tr><td><strong>SERP-overlap</strong></td><td>Парсит топ выдачи, группирует запросы с общими URL</td><td>Опирается на реальное поведение Яндекса</td><td>Дорого на больших объёмах; «слеп» к синонимам</td></tr>
          <tr><td><strong>Semantic / embedding</strong></td><td>Векторизует смысл фраз</td><td>Ловит синонимы, морфологию русского</td><td>Не проверяет совпадение выдачи</td></tr>
          <tr><td><strong>LLM intent-кластеризация</strong></td><td>Модель группирует по интенту и контексту</td><td>Быстро на 300–500 ключей; объясняет логику</td><td>Требует SERP-валидации</td></tr>
        </tbody>
      </table>
    </div>
    <div class="wsk-callout-cyan nero-ai-reveal">
      <p><strong>Рабочий стандарт 2026 — гибрид:</strong> LLM/embedding → черновые кластеры → SERP-проверка спорных групп → финальная карта посадочных. Hybrid даёт до ~91% точности (<a href="https://seomytics.com/ai-keyword-clustering-tools-5-tested-seo-accuracy-2026/8824/" target="_blank" rel="noopener noreferrer">SEOMytics</a>).</p>
    </div>
    <p><strong>Коротко:</strong> Excel — ручной труд. SaaS — группы ключей без офферов. AI-кластеризация от Nero Network — <strong>готовая карта внедрения</strong> с human QA.</p>
  </div>
</section>

<!-- REZULTAT #rezultat -->
<section class="wsk-section" id="rezultat">
  <div class="wsk-cnt nero-ai-container">
    <div class="wsk-sh nero-ai-reveal">
      <span class="wsk-eyebrow">Deliverable</span>
      <h2>Что вы получаете: карта лендингов, статей и коммерческих офферов</h2>
      <p><strong>Итог проекта:</strong> content map из Wordstat — таблица, где каждая строка = одна будущая страница с понятным действием для команды.</p>
    </div>

    <h3 style="font-size:18px;margin-bottom:14px;">Типы страниц по кластерам — лендинг, статья, коммерческий оффер, FAQ</h3>
    <div class="wsk-table-wrap nero-ai-reveal">
      <table class="wsk-table">
        <thead><tr><th>Тип страницы</th><th>Когда назначается</th><th>Пример интента</th></tr></thead>
        <tbody>
          <tr><td><strong>Лендинг</strong></td><td>Транзакционный / коммерческий</td><td>«ai кластеризация ключей цена»</td></tr>
          <tr><td><strong>Статья / гайд</strong></td><td>Информационный</td><td>«как внедрить ai кластеризация ключей»</td></tr>
          <tr><td><strong>Коммерческий оффер</strong></td><td>Смешанный коммерческий</td><td>«ai кластеризация ключей для бизнеса»</td></tr>
          <tr><td><strong>FAQ / справочник</strong></td><td>Вопросные запросы</td><td>«сколько стоит»</td></tr>
          <tr><td><strong>Категория</strong></td><td>E-commerce, широкие группы</td><td>«смесители для кухни» → подкатегории</td></tr>
        </tbody>
      </table>
    </div>

    <h3 style="font-size:18px;margin:32px 0 14px;">Пример карты тем в Excel (лид-магнит)</h3>
    <div class="wsk-excel-mock nero-ai-reveal" aria-label="Пример строки карты тем">
      <div class="wsk-excel-mock__head"><span aria-hidden="true">📊</span> Карта тем · Excel</div>
      <div class="wsk-table-wrap" style="margin:0;">
        <table class="wsk-table">
          <thead><tr><th>cluster_id</th><th>cluster_name</th><th>intent</th><th>page_type</th><th>draft_h1</th><th>priority</th></tr></thead>
          <tbody>
            <tr>
              <td>C-014</td>
              <td>AI-кластеризация Wordstat под ключ</td>
              <td>transactional</td>
              <td>landing</td>
              <td>AI-кластеризация Wordstat-запросов под ключ: карта посадочных за 5–10 дней</td>
              <td><span class="wsk-badge-p1">P1</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <p>Полный deliverable: Excel «Карта тем», PDF one-pager, рекомендации по перелинковке, опционально — импорт в CRM (amoCRM, Bitrix24) или Notion.</p>
    <p><strong>Лид-магнит:</strong> пришлите 100 ключей — получите 8–15 кластеров с примером оффера на каждый. CTA: <strong>«Собрать карту тем»</strong>.</p>

    <!-- [INSERT-1] -->
    <div class="ym-cta-block ym-cta-block--primary" id="cta-lead-magnet">
      <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Разбор 100 ключей бесплатно</p>
        <p class="ym-cta-block__sub">Пришлите выгрузку Wordstat — за 2–3 рабочих дня получите демо-карту: 8–15 кластеров с типом страницы, черновиком H1 и примером оффера на каждый.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>
</section>

<!-- ETAPY #etapy -->
<section class="wsk-section wsk-section-alt" id="etapy">
  <div class="wsk-cnt nero-ai-container">
    <div class="wsk-sh nero-ai-reveal">
      <span class="wsk-eyebrow">Процесс</span>
      <h2>Как работает внедрение AI-кластеризации под ключ</h2>
      <p><strong>Определение услуги:</strong> проект из 7 этапов — AI делает черновик, SEO-эксперт валидирует, клиент получает готовый файл.</p>
    </div>

    <h3 style="font-size:18px;margin-bottom:16px;">Этапы: выгрузка Wordstat → кластеры → приоритеты → структура сайта</h3>
    <div class="wsk-table-wrap nero-ai-reveal">
      <table class="wsk-table">
        <thead><tr><th>№</th><th>Этап</th><th>Что происходит</th><th>Срок</th></tr></thead>
        <tbody>
          <tr><td>1</td><td><strong>Brief</strong></td><td>Ниша, регионы, конкуренты, KPI</td><td>1 день</td></tr>
          <tr><td>2</td><td><strong>Ingest</strong></td><td>CSV/XLSX Wordstat или сбор через API</td><td>1–2 дня</td></tr>
          <tr><td>3</td><td><strong>Clean</strong></td><td>LLM удаляет мусор, помечает бренды и гео</td><td>несколько часов</td></tr>
          <tr><td>4</td><td><strong>Draft cluster (AI)</strong></td><td>Батчи 50–200 фраз → JSON с кластерами</td><td>1–3 дня</td></tr>
          <tr><td>5</td><td><strong>SERP validate</strong></td><td>Проверка пересечения URL в топ-10 для P1</td><td>1–2 дня</td></tr>
          <tr><td>6</td><td><strong>Human QA</strong></td><td>SEO проверяет 5–10% батчей, split/merge</td><td>1 день</td></tr>
          <tr><td>7</td><td><strong>Deliverable</strong></td><td>Excel + PDF + рекомендации</td><td>1 день</td></tr>
        </tbody>
      </table>
    </div>
    <div class="wsk-pipeline nero-ai-reveal"><span>Wordstat/CSV</span> → нормализация → AI-кластеризация → маппинг типа → черновик оффера → SERP P1 → экспорт карты</div>

    <h3 style="font-size:18px;margin:32px 0 14px;">Интеграция с CRM и контент-процессом без программиста</h3>
    <ul class="nero-ai-reveal">
      <li><strong>CRM (amoCRM / Bitrix24):</strong> каждый кластер P1 → задача «создать страницу» с H1, оффером и slug.</li>
      <li><strong>Make / n8n:</strong> триггер «новый кластер → ТЗ в Trello / Notion».</li>
      <li><strong>Аналитика:</strong> привязка кластеров к URL в Метрике и Вебмастере.</li>
    </ul>
    <div class="wsk-table-wrap nero-ai-reveal" style="margin-top:24px;">
      <table class="wsk-table">
        <thead><tr><th>AI</th><th>Человек (SEO + клиент)</th></tr></thead>
        <tbody>
          <tr><td>Группирует по смыслу и интенту</td><td>Утверждает бизнес-логику</td></tr>
          <tr><td>Предлагает H1, тип страницы, оффер</td><td>SERP-проверка спорных кластеров</td></tr>
          <tr><td>Приоритизирует P1/P2/P3</td><td>Решение merge/split при каннибализации</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- CENY #ceny -->
<section class="wsk-section" id="ceny">
  <div class="wsk-cnt nero-ai-container">
    <div class="wsk-sh nero-ai-reveal">
      <span class="wsk-eyebrow">Коммерция</span>
      <h2>Стоимость и сроки AI-кластеризации ключей</h2>
      <p><strong>Ориентир чека Nero Network:</strong> 80–250 тыс.&nbsp;₽ — в зависимости от объёма семантики и глубины SERP-валидации.</p>
    </div>

    <h3 style="font-size:18px;margin-bottom:16px;">Что входит в пакет 80–250 тыс.&nbsp;₽</h3>
    <div class="wsk-pricing-grid nero-ai-reveal">
      <div class="wsk-price-card">
        <div class="tier">Старт</div>
        <div class="amount">100–500 ключей</div>
        <p class="wsk-muted" style="font-size:13px;">AI-кластеризация + карта + приоритеты + 1 раунд правок · 5–7 дней</p>
      </div>
      <div class="wsk-price-card wsk-featured">
        <div class="tier">Бизнес</div>
        <div class="amount">500–3&nbsp;000</div>
        <p class="wsk-muted" style="font-size:13px;">+ SERP P1 + перелинковка + CRM-импорт · 7–14 дней</p>
      </div>
      <div class="wsk-price-card">
        <div class="tier">Масштаб</div>
        <div class="amount">3&nbsp;000–50&nbsp;000+</div>
        <p class="wsk-muted" style="font-size:13px;">+ мультирегион + конкурентный анализ + GEO · 14–21 день</p>
      </div>
    </div>
    <div class="wsk-table-wrap nero-ai-reveal">
      <table class="wsk-table">
        <thead><tr><th>Вариант</th><th>Стоимость</th><th>Что получаете</th><th>Для кого</th></tr></thead>
        <tbody>
          <tr><td>Подписка SaaS</td><td>от ~2&nbsp;500&nbsp;₽/мес</td><td>Группы ключей, без офферов</td><td>In-house SEO</td></tr>
          <tr><td>DIY Claude API</td><td>~11&nbsp;₽ / 300 ключей</td><td>Кластеры без QA и Excel-шаблона</td><td>SEO с промптингом</td></tr>
          <tr><td><strong>Nero Network под ключ</strong></td><td><strong>80–250 тыс.&nbsp;₽</strong></td><td>Карта + офферы + приоритеты + QA</td><td>Нужен результат, не инструмент</td></tr>
        </tbody>
      </table>
    </div>

    <!-- [INSERT-2] -->
    <div class="ym-cta-block ym-cta-block--dual" id="cta-pricing">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Готовы заказать ai кластеризацию ключей под ключ?</p>
        <p class="ym-cta-block__sub">Пакет «Старт» от 80 тыс.&nbsp;₽, «Бизнес» и «Масштаб» — до 250 тыс.&nbsp;₽. Фиксированная смета после бесплатного разбора 100 ключей.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary">Вопросы и ответы</a>
        </div>
      </div>
    </div>

    <h3 style="font-size:18px;margin:36px 0 14px;">Как заказать и что нужно на старте</h3>
    <ol style="padding-left:20px;color:var(--wsk-muted);">
      <li style="margin-bottom:.5em;">Выгрузка Wordstat или seed-ключи (от 100 для лид-магнита).</li>
      <li style="margin-bottom:.5em;">Регион(ы), язык, 3–5 конкурентов.</li>
      <li style="margin-bottom:.5em;">Описание продукта и целевое действие.</li>
      <li>Оставьте заявку → демо-карта за 2–3 дня → фиксированная смета → финальный Excel за 5–21 день.</li>
    </ol>
  </div>
</section>

<!-- KEISY #keisy -->
<section class="wsk-section wsk-section-alt" id="keisy">
  <div class="wsk-cnt nero-ai-container">
    <div class="wsk-sh nero-ai-reveal">
      <span class="wsk-eyebrow">Доверие</span>
      <h2>Кейсы: от хаоса ключей к структуре посадочных</h2>
      <p><em>Отраслевые примеры, не клиенты Nero Network — показывают, что AI-кластеризация работает в реальных нишах.</em></p>
    </div>
    <div class="wsk-case-grid">
      <article class="wsk-case-card nero-ai-reveal">
        <div class="wsk-case-tag">Кейс 1 · e-commerce</div>
        <h3 style="font-size:16px;">Keys.so + LLM</h3>
        <p>450&nbsp;000 кластеров за 3 мес. vs 50&nbsp;000 классикой; 1 мин/кластер vs 10 мин; экономия ~1,765 млн&nbsp;₽.</p>
        <p class="wsk-case-src">Источник: <a href="https://blog.keys.so/keys-so-llm-kak-avtomatizirovat-seo-i-sekonomit-1-7-mln-rubley-na-semantike" target="_blank" rel="noopener noreferrer">blog.keys.so</a></p>
      </article>
      <article class="wsk-case-card nero-ai-reveal nero-ai-delay-1">
        <div class="wsk-case-tag">Кейс 2 · сантехника</div>
        <h3 style="font-size:16px;">Claude API, 300 ключей</h3>
        <p>300 запросов → 23 кластера за 6 батчей. LLM разделил «купить» и «как работает» по интенту.</p>
        <p class="wsk-case-src">Источник: <a href="https://axdigital.ru/blog/seo-klasterizaciya-claude-api-500-klyuchej/" target="_blank" rel="noopener noreferrer">axdigital.ru</a></p>
      </article>
      <article class="wsk-case-card nero-ai-reveal">
        <div class="wsk-case-tag">Кейс 3 · e-commerce</div>
        <h3 style="font-size:16px;">Claude + MCP + Wordstat</h3>
        <p>1&nbsp;254 фразы по 5 регионам за ~20 минут. Nero закрывает gap SERP-валидацией.</p>
        <p class="wsk-case-src">Источник: <a href="https://vc.ru/ai/2936082-semanticheskoe-yadro-dlya-internet-magazina-konditsionerov-po-regionam" target="_blank" rel="noopener noreferrer">vc.ru</a></p>
      </article>
      <article class="wsk-case-card nero-ai-reveal nero-ai-delay-1">
        <div class="wsk-case-tag">Кейс 4 · контент</div>
        <h3 style="font-size:16px;">Wordstat API + Claude</h3>
        <p>Yandex Cloud Search API + Claude: сбор, классификация, кластеризация, интент, минус-слова.</p>
        <p class="wsk-case-src">Источник: <a href="https://habr.com/ru/articles/1073250/" target="_blank" rel="noopener noreferrer">Habr</a></p>
      </article>
    </div>
    <div class="wsk-table-wrap nero-ai-reveal" style="margin-top:28px;">
      <table class="wsk-table">
        <thead><tr><th>Ошибка</th><th>Последствие</th><th>Как предотвращаем</th></tr></thead>
        <tbody>
          <tr><td>Info + transactional на одной странице</td><td>Низкая конверсия</td><td>Разделение по 4 типам интента</td></tr>
          <tr><td>Каннибализация</td><td>Две URL вылетают из топа</td><td>Split-rules + SERP-check P1</td></tr>
          <tr><td>Black-box AI</td><td>Невозможно объяснить клиенту</td><td>Поле «логика кластера»</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- AUDITORIYA #auditoriya -->
<section class="wsk-section" id="auditoriya">
  <div class="wsk-cnt nero-ai-container">
    <div class="wsk-sh nero-ai-reveal">
      <span class="wsk-eyebrow">Сегменты</span>
      <h2>Для кого услуга: SEO-агентства, in-house команды и малый бизнес</h2>
    </div>
    <div class="wsk-grid-3 nero-ai-reveal">
      <div class="wsk-seg-card">
        <h3 style="font-size:17px;">SEO-агентства и фрилансеры</h3>
        <p>White-label карта тем: не «Excel с ключами», а «47 страниц с офферами и приоритетами». Сокращает подготовку семантики с дней до часов.</p>
      </div>
      <div class="wsk-seg-card">
        <h3 style="font-size:17px;">In-house SEO</h3>
        <p>Пакет «Бизнес» + CRM-интеграция + GEO-разметка. Карта тем — вход для контент-плана, ТЗ копирайтерам и рекламным кампаниям.</p>
      </div>
      <div class="wsk-seg-card">
        <h3 style="font-size:17px;">Малый бизнес</h3>
        <p>100–500 ключей: лид-магнит → пакет «Старт» → 5–7 дней до карты. Фиксированный чек вместо ФОТ разработчика и подписок.</p>
      </div>
    </div>
    <?php
    $secondary_env_url = getenv('SECONDARY_CTA_URL') ?: '';
    if ($secondary_env_url && $secondary_env_url !== '#' && strpos($secondary_env_url, 'placeholder') === false) : ?>
    <p class="nero-ai-note" style="margin-top:24px;font-size:14px;color:var(--wsk-muted);">Хотите собрать пайплайн сами? Смотрите <a href="<?php echo esc_url($secondary_env_url); ?>" target="_blank" rel="noopener noreferrer">материалы по внедрению AI в маркетинг</a> — или закажите готовую карту тем под ключ.</p>
    <?php endif; ?>
  </div>
</section>

<!-- FAQ #faq -->
<section class="wsk-section wsk-section-alt" id="faq">
  <div class="wsk-cnt nero-ai-container">
    <div class="wsk-sh nero-ai-reveal">
      <span class="wsk-eyebrow">FAQ</span>
      <h2>FAQ по AI-кластеризации Wordstat</h2>
    </div>
    <div class="wsk-faq nero-ai-faq nero-ai-reveal" itemscope itemtype="https://schema.org/FAQPage">
      <div class="wsk-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <div class="wsk-faq-q" itemprop="name">Нужен ли программист и Key Collector?</div>
        <div class="wsk-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text"><p><strong>Нет.</strong> Достаточно выгрузки Wordstat в CSV/XLSX. Nero собирает семантику через Wordstat API или Keys.so — без IT-отдела.</p></div></div>
      </div>
      <div class="wsk-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <div class="wsk-faq-q" itemprop="name">Какой объём ключей оптимален для старта?</div>
        <div class="wsk-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text"><p><strong>100 ключей</strong> — лид-магнит (8–15 кластеров). <strong>300–500</strong> — первый коммерческий проект. <strong>1&nbsp;000–3&nbsp;000</strong> — типичный SMB с SERP-валидацией.</p></div></div>
      </div>
      <div class="wsk-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <div class="wsk-faq-q" itemprop="name">Как связать кластеры с CRM и контент-планом?</div>
        <div class="wsk-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text"><p>Колонка <code>priority</code> = порядок создания. P1-кластеры → задачи в CRM с H1, оффером, slug. Колонки <code>page_type</code> + <code>draft_h1</code> = ТЗ копирайтеру.</p></div></div>
      </div>
      <div class="wsk-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <div class="wsk-faq-q" itemprop="name">AI vs Rush Analytics / Keys.so — в чём разница?</div>
        <div class="wsk-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text"><p>SaaS даёт <strong>группы ключей</strong> по SERP-overlap. Nero даёт <strong>карту посадочных с офферами, приоритетами и GEO-форматами</strong> — готовый план внедрения.</p></div></div>
      </div>
      <div class="wsk-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <div class="wsk-faq-q" itemprop="name">AI ошибается — как вы это контролируете?</div>
        <div class="wsk-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text"><p>Гибрид: AI-черновик → SERP P1 → human QA 5–10% батчей. Автоматизация экономит время, но не отменяет проверку.</p></div></div>
      </div>
      <div class="wsk-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <div class="wsk-faq-q" itemprop="name">Wordstat показывает не весь спрос — это проблема?</div>
        <div class="wsk-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text"><p>Nero дополняет ядро подсказками, семантикой конкурентов и Keys.so. Честность повышает качество финальной карты.</p></div></div>
      </div>
      <div class="wsk-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <div class="wsk-faq-q" itemprop="name">Зачем кластеризация для Алисы и ChatGPT (GEO)?</div>
        <div class="wsk-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text"><p>AI-выдача цитирует topic clusters с extractable answers. Кластеризация заранее размечает FAQ, definition, comparison table.</p></div></div>
      </div>
      <div class="wsk-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <div class="wsk-faq-q" itemprop="name">AI заменяет SEO-стратега?</div>
        <div class="wsk-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text"><p><strong>Нет.</strong> AI снимает 80% рутины. Стратегия остаётся за человеком. Nero = AI + SEO-эксперт.</p></div></div>
      </div>
    </div>
  </div>
</section>

<!-- CTA #cta -->
<section class="wsk-section" id="cta">
  <div class="wsk-cnt nero-ai-container">
    <div class="wsk-sh nero-ai-reveal">
      <span class="wsk-eyebrow">Финальный оффер</span>
      <h2>Соберите карту тем — разбор 100 ключей бесплатно</h2>
      <p>Ключей много — непонятно, какие страницы создавать? Это решается за один проект: демо-карта → полный Excel → backlog для команды.</p>
    </div>
    <div class="nero-ai-reveal">
      <ol style="padding-left:20px;color:var(--wsk-muted);max-width:640px;margin:0 auto 28px;">
        <li style="margin-bottom:.5em;"><strong style="color:var(--wsk-soft);">Пришлите 100 ключей</strong> — демо-карта с 8–15 кластерами.</li>
        <li style="margin-bottom:.5em;"><strong style="color:var(--wsk-soft);">Закажите проект</strong> от 80 тыс.&nbsp;₽ — полный Excel + PDF.</li>
        <li><strong style="color:var(--wsk-soft);">Внедряйте</strong> — отдайте файл копирайтерам, разработчикам и CRM.</li>
      </ol>
    </div>
    <!-- [INSERT-3] -->
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Соберите карту тем — разбор 100 ключей бесплатно</p>
        <p class="ym-cta-block__sub">1) Пришлите 100 ключей → демо-карта с офферами. 2) Закажите проект от 80 тыс.&nbsp;₽ → полный Excel + PDF. 3) Отдайте файл копирайтерам и CRM — backlog страниц готов.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#ceny" class="nero-ai-btn nero-ai-btn-secondary">Смотреть пакеты и цены</a>
        </div>
      </div>
    </div>
    <p class="wsk-disclaimer nero-ai-reveal"><strong>Disclaimer:</strong> AI-кластеризация — мощный ускоритель, но не замена SEO-стратегии. Wordstat отражает часть спроса. Nero Network не гарантирует конкретные позиции — мы даём структуру, на которой строится рост.</p>
  </div>
</section>

</div><!-- /.wsk-content -->

<script>
(function(){
  document.querySelectorAll('.wsk-faq-q').forEach(function(q){
    q.addEventListener('click',function(){
      q.parentElement.classList.toggle('open');
    });
  });
})();
</script>


<?php
$ad_banner_url   = getenv('AD_BANNER_URL') ?: '';
$ad_banner_image = getenv('AD_BANNER_IMAGE_URL') ?: '';
$ad_banner_alt   = getenv('AD_BANNER_ALT') ?: 'Партнёрское предложение';
if ($ad_banner_url && $ad_banner_image && $ad_banner_url !== '#' && strpos($ad_banner_url, 'placeholder') === false) :
?>
<div class="wsk-cnt" style="text-align:center;padding:32px 0 48px;">
  <a href="<?php echo esc_url($ad_banner_url); ?>" target="_blank" rel="noopener noreferrer">
    <img src="<?php echo esc_url($ad_banner_image); ?>" width="970" height="90" alt="<?php echo esc_attr($ad_banner_alt); ?>" loading="lazy" decoding="async" style="max-width:100%;height:auto;border-radius:12px;box-shadow:0 8px 32px rgba(0,0,0,.25);">
  </a>
</div>
<?php endif; ?>

<!-- INTERNAL-LINKS:INSERT -->
<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
(function(){
  'use strict';
  var items = document.querySelectorAll('.nero-ai-reveal');
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

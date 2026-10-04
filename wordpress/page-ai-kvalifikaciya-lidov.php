<?php
/**
 * Template Name: AI-квалификация лидов: внедрение и настройка под ключ
 * Description: SEO-лендинг — AI-квалификация лидов, скоринг до CRM, статусы hot/warm/cold/disqualified.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-квалификация лидов: внедрение и настройка под ключ';
$page_seo_description = 'Внедрение AI-квалификации лидов: скоринг до CRM, статусы горячий, тёплый, холодный и нецелевой. Интеграция с amoCRM и Битрикс24, меньше холостых созвонов. Карта квалификации — в подарок.';

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
    ['label' => 'Скоринг', 'href' => '#skoring'],
    ['label' => 'Каналы', 'href' => '#kanaly'],
    ['label' => 'CRM', 'href' => '#crm'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
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

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if (!is_readable($nero_ai_floating)) {
    require dirname(__DIR__) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
    require $nero_ai_floating;
}

?>

<?php nero_ai_echo_theme_styles(); ?>

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
.breadcrumbs, .breadcrumb, .breadcrumb-list, .breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb, .rank-math-breadcrumb, .rank-math-breadcrumbs, .yoast-breadcrumb,
.entry-header, .page-title-section { display: none !important; }
#primary, .site-main, .site-content, #content, .content-area {
  padding-top: 0 !important;
  margin-top: 0 !important;
}
.akl-hero-kval-lidov.nero-ai-hero {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-kvalifikaciya-lidov-page" role="main" tabindex="-1">

<style>
/* Hero ai-kvalifikaciya-lidov — самодостаточные стили первого экрана (канон главной) */
.akl-hero-kval-lidov {
  --akl-bg: #050711;
  --akl-text: #e6edf7;
  --akl-muted: #9aa8bd;
  --akl-soft: #c7d2e5;
  --akl-accent: #79f2ff;
  --akl-violet: #8b5cf6;
  --akl-shadow: 0 24px 72px rgba(0, 0, 0, 0.45);
  --akl-hot: #f87171;
  --akl-warm: #fbbf24;
  --akl-cold: #38bdf8;
  --akl-disq: #94a3b8;
  position: relative;
  min-height: min(920px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 120px) 0 clamp(40px, 6vw, 72px);
  color: var(--akl-text);
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
  isolation: isolate;
}
.akl-hero-kval-lidov::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255, 255, 255, 0.035) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255, 255, 255, 0.035) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 42% 28%, #000 0%, transparent 72%);
  opacity: 0.55;
  pointer-events: none;
  z-index: -2;
}
.akl-hero-kval-lidov::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 12%;
  width: 780px;
  height: 780px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, 0.11), transparent 66%);
  filter: blur(8px);
  animation: aklHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes aklHeroGlow {
  from { opacity: 0.4; transform: translateX(-50%) scale(0.96); }
  to { opacity: 0.82; transform: translateX(-50%) scale(1.05); }
}
.akl-hero-kval-lidov .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
}
.akl-hero-kval-lidov .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(340px, 0.98fr);
  gap: clamp(28px, 4vw, 52px);
  align-items: center;
}
.akl-hero-kval-lidov .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 6px 14px;
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  border: 1px solid rgba(121, 242, 255, 0.22);
  font-size: 11.5px;
  font-weight: 700;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--akl-accent);
  margin: 0 0 14px;
}
.akl-hero-kval-lidov h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 6.2vw, 72px);
  line-height: 0.92;
  letter-spacing: -0.06em;
  color: #fff;
}
.akl-hero-kval-lidov .nero-ai-gradient-text {
  display: block;
  background: linear-gradient(92deg, #fff 0%, var(--akl-accent) 44%, var(--akl-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}
.akl-hero-kval-lidov .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 680px;
  color: var(--akl-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.akl-hero-kval-lidov .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 24px 0 0;
  padding: 0;
  list-style: none;
}
.akl-hero-kval-lidov .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  padding: 8px 12px;
  border: 1px solid rgba(255, 255, 255, 0.11);
  border-radius: 999px;
  background: rgba(255, 255, 255, 0.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
  white-space: nowrap;
}
.akl-hero-kval-lidov .nero-ai-badge--hot { border-color: rgba(248, 113, 113, 0.35); color: #fecaca; }
.akl-hero-kval-lidov .nero-ai-badge--warm { border-color: rgba(251, 191, 36, 0.35); color: #fde68a; }
.akl-hero-kval-lidov .nero-ai-badge--cold { border-color: rgba(56, 189, 248, 0.35); color: #bae6fd; }
.akl-hero-kval-lidov .nero-ai-badge--disq { border-color: rgba(148, 163, 184, 0.35); color: #cbd5e1; }
.akl-hero-kval-lidov .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  margin-top: 32px;
}
.akl-hero-kval-lidov .nero-ai-btn {
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
  transition: transform 0.22s ease, border-color 0.22s ease, background 0.22s ease;
}
.akl-hero-kval-lidov .nero-ai-btn:hover { transform: translateY(-2px); }
.akl-hero-kval-lidov .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--akl-accent), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.akl-hero-kval-lidov .nero-ai-btn-secondary {
  color: var(--akl-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.akl-hero-kval-lidov .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--akl-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.akl-hero-kval-lidov .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255, 255, 255, 0.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, 0.95), rgba(6, 10, 24, 0.96));
}
.akl-hero-kval-lidov .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  background: rgba(255, 255, 255, 0.045);
}
.akl-hero-kval-lidov .nero-ai-dots { display: flex; gap: 7px; }
.akl-hero-kval-lidov .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.akl-hero-kval-lidov .nero-ai-dot:nth-child(1) { background: #fb7185; }
.akl-hero-kval-lidov .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.akl-hero-kval-lidov .nero-ai-dot:nth-child(3) { background: #34d399; }
.akl-hero-kval-lidov .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: 0.08em;
  text-transform: uppercase;
}
.akl-hero-kval-lidov .nero-ai-window-body { padding: 16px; }
.akl-hero-kval-lidov .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 12px;
  margin-bottom: 12px;
}
.akl-hero-kval-lidov .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.akl-hero-kval-lidov .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(34, 197, 94, 0.1);
  color: #bbf7d0;
  font-size: 12px;
  font-weight: 800;
}
.akl-hero-kval-lidov .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.14);
  animation: aklLivePulse 1.6s infinite;
}
@keyframes aklLivePulse {
  0%, 100% { transform: scale(0.86); opacity: 0.65; }
  50% { transform: scale(1); opacity: 1; }
}
.akl-hero-kval-lidov .akl-status-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 10px;
}
.akl-hero-kval-lidov .akl-status-card {
  padding: 12px 12px 10px;
  border-radius: 16px;
  border: 1px solid rgba(255, 255, 255, 0.09);
  background: rgba(255, 255, 255, 0.045);
}
.akl-hero-kval-lidov .akl-status-card strong {
  display: block;
  font-size: 22px;
  line-height: 1;
  color: #fff;
  margin-top: 4px;
}
.akl-hero-kval-lidov .akl-status-card span {
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  color: var(--akl-muted);
}
.akl-hero-kval-lidov .akl-status-card small {
  display: block;
  margin-top: 5px;
  font-size: 11px;
  color: #9fb0c9;
}
.akl-hero-kval-lidov .akl-status--hot { border-color: rgba(248, 113, 113, 0.35); box-shadow: inset 0 0 0 1px rgba(248, 113, 113, 0.08); }
.akl-hero-kval-lidov .akl-status--warm { border-color: rgba(251, 191, 36, 0.32); }
.akl-hero-kval-lidov .akl-status--cold { border-color: rgba(56, 189, 248, 0.32); }
.akl-hero-kval-lidov .akl-status--disq { border-color: rgba(148, 163, 184, 0.28); }
.akl-hero-kval-lidov .akl-mini-metrics {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
  margin-bottom: 12px;
}
.akl-hero-kval-lidov .akl-mini-metric {
  padding: 10px 12px;
  border-radius: 14px;
  border: 1px solid rgba(121, 242, 255, 0.16);
  background: rgba(121, 242, 255, 0.06);
}
.akl-hero-kval-lidov .akl-mini-metric b {
  display: block;
  font-size: 18px;
  color: #fff;
  margin-top: 2px;
}
.akl-hero-kval-lidov .akl-mini-metric i {
  font-size: 11px;
  font-style: normal;
  font-weight: 700;
  color: var(--akl-muted);
  text-transform: uppercase;
  letter-spacing: 0.05em;
}
.akl-hero-kval-lidov .akl-dash-canvas-wrap {
  position: relative;
  height: clamp(200px, 28vw, 260px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(139, 92, 246, 0.2);
  background: radial-gradient(ellipse at 50% 42%, rgba(139, 92, 246, 0.12), rgba(6, 10, 24, 0.92) 72%);
}
.akl-hero-kval-lidov #akl-kval-lidov-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.akl-hero-kval-lidov .nero-ai-task-stream { display: grid; gap: 8px; }
.akl-hero-kval-lidov .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 14px;
  background: rgba(255, 255, 255, 0.04);
}
.akl-hero-kval-lidov .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121, 242, 255, 0.12);
  color: var(--akl-accent);
  font-size: 12px;
  font-weight: 800;
}
.akl-hero-kval-lidov .nero-ai-task strong { display: block; color: #f8fafc; font-size: 13px; }
.akl-hero-kval-lidov .nero-ai-task span { color: var(--akl-muted); font-size: 12px; }
.akl-hero-kval-lidov .nero-ai-status {
  padding: 5px 8px;
  border-radius: 999px;
  font-size: 11px;
  font-weight: 800;
  background: rgba(34, 197, 94, 0.12);
  color: #86efac;
}
.akl-hero-kval-lidov .nero-ai-status--hot {
  background: rgba(248, 113, 113, 0.15);
  color: #fecaca;
}
.akl-hero-kval-lidov .nero-ai-status--disq {
  background: rgba(148, 163, 184, 0.15);
  color: #cbd5e1;
}
@media (max-width: 960px) {
  .akl-hero-kval-lidov .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .akl-hero-kval-lidov .nero-ai-dashboard { transform: none; }
}
</style>

<section class="nero-ai-hero akl-hero-kval-lidov" id="hero" aria-labelledby="akl-hero-kval-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai квалификация лидов</p>
      <h1 id="akl-hero-kval-title">AI-квалификация лидов: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI присваивает каждому лиду статус до передачи менеджеру — горячий, тёплый, холодный или нецелевой</p>
      <ul class="nero-ai-badges" aria-label="Статусы квалификации">
        <li class="nero-ai-badge nero-ai-badge--hot">Горячий</li>
        <li class="nero-ai-badge nero-ai-badge--warm">Тёплый</li>
        <li class="nero-ai-badge nero-ai-badge--cold">Холодный</li>
        <li class="nero-ai-badge nero-ai-badge--disq">Нецелевой</li>
        <li class="nero-ai-badge">amoCRM / Б24</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#skoring">Как работает скоринг</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демо: матрица квалификации лидов">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">лиды · live · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Матрица квалификации</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>

          <div class="akl-status-grid" aria-label="Статусы лидов">
            <div class="akl-status-card akl-status--hot">
              <span>Горячий</span>
              <strong>6</strong>
              <small>задача 15 мин</small>
            </div>
            <div class="akl-status-card akl-status--warm">
              <span>Тёплый</span>
              <strong>11</strong>
              <small>nurture · SLA 2 ч</small>
            </div>
            <div class="akl-status-card akl-status--cold">
              <span>Холодный</span>
              <strong>9</strong>
              <small>автоворонка</small>
            </div>
            <div class="akl-status-card akl-status--disq">
              <span>Нецелевой</span>
              <strong>14</strong>
              <small>без передачи в ОП</small>
            </div>
          </div>

          <div class="akl-mini-metrics" aria-label="KPI квалификации">
            <div class="akl-mini-metric">
              <i>Speed-to-lead</i>
              <b>4 мин</b>
            </div>
            <div class="akl-mini-metric">
              <i>% disqualified</i>
              <b>31%</b>
            </div>
          </div>

          <div class="akl-dash-canvas-wrap" aria-hidden="false">
            <canvas id="akl-kval-lidov-hero-canvas" role="img" aria-label="Анимация: заявки с каналов проходят AI-скоринг и получают статус до передачи в CRM"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента квалификации">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Форма · B2B услуги</strong><span>Бюджет ок · ЛПР подтверждён · score 92</span></div>
              <span class="nero-ai-status nero-ai-status--hot">горячий</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">✉</span>
              <div><strong>Почта sales@</strong><span>Срок Q2 · не все поля BANT</span></div>
              <span class="nero-ai-status">тёплый</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">⊘</span>
              <div><strong>Тестовая заявка</strong><span>Антиспам · ниже мин. чека</span></div>
              <span class="nero-ai-status nero-ai-status--disq">нецелевой</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * akl-kval-lidov-hero-engine — Диспетчерская матрицы квалификации
 * RadialIntentStream + ScoreMatrixCore + CRM handoff (не vibecoding conveyor)
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("akl-kval-lidov-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, frame = 0, cx = 0, cy = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 220;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 6;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    line: "rgba(121,242,255,0.2)",
    violet: "rgba(139,92,246,0.45)",
    hot: "#f87171",
    warm: "#fbbf24",
    cold: "#38bdf8",
    disq: "#94a3b8",
    hub: "#1e293b",
    hubEdge: "#79f2ff",
    crm: "#22c55e",
    spark: "#e2e8f0",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0"
  };

  function rr(x, y, w, h, r, fill, stroke) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    if (fill) { ctx.fillStyle = fill; ctx.fill(); }
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = 1.4; ctx.stroke(); }
  }

  function RadialIntentStream() {
    this.phase = 0;
    this.channels = ["сайт", "чат", "почта", "TG"];
  }
  RadialIntentStream.prototype.draw = function () {
    this.phase = (frame * 0.03) % (Math.PI * 2);
    var rays = [
      { a: -2.4, len: 0.42 },
      { a: -0.9, len: 0.38 },
      { a: 0.55, len: 0.4 },
      { a: 2.05, len: 0.36 }
    ];
    rays.forEach(function (ray, i) {
      var ex = Math.cos(ray.a) * cw * ray.len;
      var ey = Math.sin(ray.a) * ch * ray.len * 0.55;
      ctx.strokeStyle = i % 2 ? C.violet : C.line;
      ctx.lineWidth = 1.2;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.35;
      ctx.beginPath();
      ctx.moveTo(cx + ex, cy + ey);
      ctx.lineTo(cx, cy);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.fillStyle = "rgba(255,255,255,0.55)";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(this.channels[i], cx + ex * 1.08, cy + ey * 1.08);

      var t = (this.phase + i * 1.4) % (Math.PI * 2);
      var px = cx + Math.cos(ray.a) * cw * ray.len * (0.25 + 0.65 * (0.5 + 0.5 * Math.sin(t)));
      var py = cy + Math.sin(ray.a) * ch * ray.len * 0.55 * (0.25 + 0.65 * (0.5 + 0.5 * Math.cos(t)));
      ctx.fillStyle = C.spark;
      ctx.beginPath();
      ctx.arc(px, py, 3.5, 0, Math.PI * 2);
      ctx.fill();
    }, this);
  };

  function ScoreMatrixCore() {
    this.score = 0;
    this.flash = 0;
  }
  ScoreMatrixCore.prototype.draw = function (prg) {
    var size = Math.min(cw, ch) * 0.22;
    ctx.save();
    ctx.translate(cx, cy);
    ctx.rotate(Math.PI / 4);
    var quads = [
      { c: C.hot, label: "HOT" },
      { c: C.warm, label: "WARM" },
      { c: C.cold, label: "COLD" },
      { c: C.disq, label: "DQ" }
    ];
    quads.forEach(function (q, i) {
      var ox = (i % 2) ? size * 0.52 : -size * 0.52;
      var oy = i < 2 ? -size * 0.52 : size * 0.52;
      rr(ox - size * 0.48, oy - size * 0.48, size * 0.96, size * 0.96, 6, "rgba(15,23,42,0.85)", q.c);
      if (prg >= 40 && prg < 160 && (Math.floor(prg / 30) % 4) === i) {
        ctx.fillStyle = q.c + "55";
        rr(ox - size * 0.48, oy - size * 0.48, size * 0.96, size * 0.96, 6, q.c + "33", null);
      }
      ctx.rotate(-Math.PI / 4);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(q.label, ox, oy + 3);
      ctx.rotate(Math.PI / 4);
    });
    ctx.rotate(-Math.PI / 4);
    this.score = 62 + Math.sin(frame * 0.05) * 18;
    ctx.fillStyle = C.hubEdge;
    ctx.font = "bold 11px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("AI " + Math.round(this.score), 0, 4);
    ctx.restore();

    if (prg >= 170 && prg < 220) {
      var hx = cx + cw * 0.32;
      var hy = cy - ch * 0.08;
      rr(hx - 28, hy - 18, 56, 36, 8, "rgba(34,197,94,0.15)", C.crm);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("CRM", hx, hy - 4);
      ctx.fillText("handoff", hx, hy + 8);
    }
    if (prg >= 220) {
      ctx.strokeStyle = C.disq;
      ctx.globalAlpha = 0.35 + 0.25 * Math.sin(frame * 0.08);
      ctx.beginPath();
      ctx.moveTo(cx - cw * 0.35, cy + ch * 0.22);
      ctx.lineTo(cx + cw * 0.35, cy + ch * 0.22);
      ctx.stroke();
      ctx.globalAlpha = 1;
    }
  };

  var bubbles = [];
  function createBubble(text, x, y) {
    bubbles.push({ text: text, x: x, y: y, life: 90 });
  }

  function Agent(x, y, color, role, dialogs) {
    this.x = x;
    this.y = y;
    this.color = color;
    this.role = role;
    this.dialogs = dialogs;
    this.stepTrig = Math.random() * 200;
    this.bubbleT = 0;
  }
  Agent.prototype.draw = function (prg) {
    var tx = cx + (this.role === "1_architect" ? -cw * 0.38 : this.role === "5_deployer" ? cw * 0.36 : 0);
    var ty = cy + (this.role === "2_seo" ? ch * 0.28 : this.role === "4_designer" ? -ch * 0.26 : ch * 0.32);
    if (this.role === "3_coder") { tx = cx - cw * 0.22; ty = cy + ch * 0.3; }
    this.x += (tx - this.x) * 0.04;
    this.y += (ty - this.y) * 0.04;
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(this.x, this.y, 7, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillStyle = "#0f172a";
    ctx.beginPath();
    ctx.arc(this.x, this.y - 9, 5, 0, Math.PI * 2);
    ctx.fill();
    this.stepTrig = (this.stepTrig + 0.6) % 200;
    if (this.stepTrig < 2 && Math.random() < 0.02) {
      this.bubbleT = 70;
      createBubble(this.dialogs[Math.floor(Math.random() * this.dialogs.length)], this.x, this.y - 22);
    }
  };

  var stream = new RadialIntentStream();
  var matrix = new ScoreMatrixCore();
  var agents = [
    new Agent(40, 40, C.agentYellow, "1_architect", ["Порог hot: 85+", "Матрица BANT", "Веса вопросов"]),
    new Agent(60, 50, C.agentGreen, "2_seo", ["ICP: B2B услуги", "UTM → intent", "Регион ок"]),
    new Agent(80, 60, C.agentBlue, "3_coder", ["JSON-schema score", "Webhook <3 с", "Очередь Redis"]),
    new Agent(100, 70, C.agentPink, "4_designer", ["4 статуса в UI", "Цитата в CRM", "Shadow mode"]),
    new Agent(120, 80, C.agentPurple, "5_deployer", ["Поле ai_status", "Задача РОПу", "Handoff hot"])
  ];

  function drawBubbles() {
    bubbles = bubbles.filter(function (b) {
      b.life--;
      if (b.life <= 0) return false;
      ctx.font = "9px Inter,sans-serif";
      var w = ctx.measureText(b.text).width + 14;
      rr(b.x - w / 2, b.y - 12, w, 18, 6, C.bubbleBg, "rgba(121,242,255,0.35)");
      ctx.fillStyle = C.bubbleText;
      ctx.textAlign = "center";
      ctx.fillText(b.text, b.x, b.y + 2);
      return true;
    });
  }

  function loop() {
    frame++;
    var prg = (frame * 0.35) % 260;
    ctx.clearRect(0, 0, cw, ch);
    stream.draw();
    matrix.draw(prg);
    agents.forEach(function (a) { a.draw(prg); });
    if (prg === 45) createBubble("Скоринг по BANT…", cx, cy - 50);
    if (prg === 95) createBubble("Статус: тёплый → nurture", cx - 40, cy + 40);
    if (prg === 145) createBubble("Горячий → CRM за 4 мин", cx + 50, cy - 30);
    if (prg === 205) createBubble("Нецелевой отсечён", cx, cy + 55);
    drawBubbles();
    requestAnimationFrame(loop);
  }
  loop();
});
</script>

<style>
/* === AKL: ai-kvalifikaciya-lidov — тело статьи (не hero) === */
.akl-content{
  --akl-bg:#050711;--akl-text:#e6edf7;--akl-muted:#9aa8bd;--akl-soft:#c7d2e5;--akl-heading:#fff;
  --akl-border:rgba(255,255,255,.10);--akl-accent:#79f2ff;--akl-violet:#8b5cf6;--akl-green:#22c55e;
  --akl-hot:#ef4444;--akl-warm:#f59e0b;--akl-cold:#3b82f6;--akl-disq:#64748b;
  --akl-btn-from:#2563eb;--akl-btn-to:#7c3aed;--akl-r:18px;--akl-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--akl-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
}
.akl-content *,.akl-content *::before,.akl-content *::after{box-sizing:border-box;}
.akl-content p{color:var(--akl-muted);line-height:1.72;margin:0 0 1em;font-size:15px;}
.akl-content h2,.akl-content h3{color:var(--akl-heading);letter-spacing:-.04em;margin:0 0 .65em;}
.akl-content h2{font-size:clamp(26px,3.8vw,44px);line-height:1.08;}
.akl-content h3{font-size:clamp(17px,2vw,21px);}
.akl-content strong{color:var(--akl-soft);}
.akl-content ul{list-style:none;margin:0 0 1em;padding:0;}
.akl-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--akl-muted);font-size:14.5px;line-height:1.65;}
.akl-content ul li::before{content:'›';position:absolute;left:0;color:var(--akl-accent);font-weight:700;}
.akl-cnt{width:min(var(--akl-container),calc(100% - 40px));margin:0 auto;}
.akl-section{padding:clamp(56px,7vw,96px) 0;}
.akl-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.akl-sh{max-width:820px;margin:0 auto 40px;text-align:center;}
.akl-sh.akl-left{margin-left:0;text-align:left;}
.akl-sh.akl-left p{margin-left:0;max-width:720px;}
.akl-eyebrow{display:inline-flex;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--akl-accent);margin-bottom:12px;}
.akl-intro{padding:clamp(36px,5vw,64px) 0;border-bottom:1px solid rgba(255,255,255,.06);}
.akl-intro-grid{display:grid;grid-template-columns:1fr 320px;gap:48px;align-items:center;}
.akl-intro-text{position:relative;padding-left:18px;text-align:left!important;}
.akl-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--akl-accent),var(--akl-violet));}
.akl-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.akl-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:14px;text-align:center;}
.akl-kpi-card .kv{font-size:clamp(18px,2.2vw,24px);font-weight:900;color:var(--akl-heading);}
.akl-kpi-card .kl{font-size:11px;color:var(--akl-muted);line-height:1.35;}
@media(max-width:900px){.akl-intro-grid{grid-template-columns:1fr;}}
.akl-toc-outer{padding:0 0 40px;}
.akl-toc{display:flex;flex-wrap:wrap;gap:8px;justify-content:center;}
.akl-toc a{padding:8px 16px;border-radius:999px;background:rgba(255,255,255,.06);border:1px solid var(--akl-border);font-size:13px;font-weight:600;color:var(--akl-muted);}
.akl-toc a:hover{border-color:rgba(121,242,255,.35);color:var(--akl-accent);}
.akl-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:18px;}
.akl-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;}
@media(max-width:768px){.akl-grid-2,.akl-grid-3{grid-template-columns:1fr;}}
.akl-card{background:rgba(255,255,255,.07);border:1px solid var(--akl-border);border-radius:var(--akl-r);padding:22px;}
.akl-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:16px 0;}
.akl-table{width:100%;border-collapse:collapse;font-size:14px;}
.akl-table th{padding:12px 14px;text-align:left;background:rgba(121,242,255,.1);color:var(--akl-accent);border-bottom:1px solid rgba(121,242,255,.2);}
.akl-table td{padding:11px 14px;border-bottom:1px solid rgba(255,255,255,.05);vertical-align:top;}
.akl-table tr:last-child td{border-bottom:none;}
.akl-timeline{position:relative;padding-left:36px;}
.akl-timeline::before{content:'';position:absolute;left:10px;top:6px;bottom:6px;width:2px;background:linear-gradient(180deg,var(--akl-accent),var(--akl-violet));opacity:.35;}
.akl-tl-item{position:relative;margin-bottom:28px;}
.akl-tl-dot{position:absolute;left:-30px;top:4px;width:14px;height:14px;border-radius:50%;background:var(--akl-accent);}
.akl-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.akl-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:18px 22px;}
.akl-faq-item h3{font-size:16px;margin-bottom:8px;}
.akl-status-hot{color:#fca5a5;}.akl-status-warm{color:#fcd34d;}.akl-status-cold{color:#93c5fd;}.akl-status-disq{color:#94a3b8;}
.akl-content .ym-cta-block{border-radius:20px;padding:32px 36px;margin:28px 0;background:linear-gradient(135deg,rgba(37,99,235,.14),rgba(124,58,237,.12));border:1px solid rgba(121,242,255,.25);}
.akl-content .ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.akl-content .ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.14),rgba(34,197,94,.08));border-color:rgba(139,92,246,.28);}
.akl-content .ym-cta-block__headline{font-size:clamp(19px,2.5vw,26px);font-weight:800;color:#fff;margin:0 0 8px;}
.akl-content .ym-cta-block__sub{color:var(--akl-muted);font-size:15px;line-height:1.65;margin:0 0 18px;}
.akl-content .ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
</style>

<div class="akl-content">

  <section class="akl-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="akl-cnt">
      <div class="akl-intro-grid nero-ai-reveal">
        <div class="akl-intro-text">
          <p class="akl-eyebrow">Лонгрид · ai квалификация лидов</p>
          <p><strong>Коротко:</strong> AI-квалификация лидов — автоматизированный слой между входящей заявкой и менеджером. Система собирает данные по матрице (BANT, CHAMP, MEDDIC), присваивает <strong>ai лид скоринг</strong> и статус <strong>горячий / тёплый / холодный / нецелевой</strong>, затем передаёт в CRM осмысленный контекст.</p>
          <p>Nero Network настраивает <strong>внедрение ai квалификация лидов под ключ</strong> для B2B: формы, чат, почта, мессенджеры — единые правила и интеграция с amoCRM или Битрикс24. CTA: <strong>«Получить карту квалификации»</strong>.</p>
        </div>
        <div class="akl-intro-kpi" aria-label="Ориентиры эффекта">
          <div class="akl-kpi-card"><div class="kv">87%</div><div class="kl">компаний уже используют AI в продажах</div></div>
          <div class="akl-kpi-card"><div class="kv">×100</div><div class="kl">падение контакта при ответе 30 мин vs 5 мин</div></div>
          <div class="akl-kpi-card"><div class="kv">4</div><div class="kl">статуса до handoff в CRM</div></div>
          <div class="akl-kpi-card"><div class="kv">3–6 нед.</div><div class="kl">типовой срок до продакшена</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="akl-toc-outer">
    <div class="akl-cnt">
      <nav class="akl-toc ym-toc" aria-label="Оглавление">
        <a href="#zachem">Зачем</a>
        <a href="#skoring">Скоринг</a>
        <a href="#kanaly">Каналы</a>
        <a href="#crm">CRM</a>
        <a href="#etapy">Этапы</a>
        <a href="#kpi">KPI</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="akl-section" id="zachem">
    <div class="akl-cnt">
      <div class="akl-sh akl-left nero-ai-reveal">
        <span class="akl-eyebrow">Зачем отделу продаж</span>
        <h2>Зачем отделу продаж AI-квалификация лидов до передачи менеджеру</h2>
        <p><strong>Определение:</strong> AI-квалификация лидов — LLM или conversational AI ведёт первичный диалог (или анализирует заявку), фиксирует ответы в CRM, считает score и решает, кому и когда звонить. Для <strong>ai для отдела продаж</strong> это фильтр <strong>до</strong> handoff, а не замена CRM.</p>
      </div>
      <div class="akl-grid-2 nero-ai-reveal" style="margin-top:24px">
        <div class="akl-card">
          <h3>Что показывают отчёты о нагрузке на продажи в 2026</h3>
          <p>Salesforce State of Sales 2026 (4&nbsp;050 респондентов, авг.–сент. 2025):</p>
          <ul>
            <li><strong>87%</strong> организаций используют AI, в т.ч. <strong>lead scoring</strong></li>
            <li><strong>54%</strong> продавцов уже работали с agents; ~<strong>9 из 10</strong> планируют к 2027</li>
            <li><strong>94%</strong> лидеров с agents: essential for growth</li>
            <li><strong>51%</strong> лидеров: tech silos мешают AI; <strong>84%</strong> планируют консолидацию стека</li>
          </ul>
        </div>
        <div class="akl-card">
          <h3>Сколько стоит холостой созвон и «мусорные» заявки</h3>
          <p>MIT / InsideSales 2007: ответ через 30&nbsp;мин vs 5&nbsp;мин — odds контакта ниже ~в <strong>100</strong> раз, квалификации — ~в <strong>21</strong> раз.</p>
          <p>HBR 2011: среднее время ответа <strong>42&nbsp;ч</strong>; <strong>23%</strong> компаний не ответили на тестовый лид.</p>
          <p><strong>Итог:</strong> <strong>автоматизация квалификации клиентов</strong> высвобождает capacity под intent, а не под «вы вообще про что?».</p>
        </div>
      </div>
    </div>
  </section>

  <!-- БОРИС: визуальный блок (вставка по якорю) -->
  <section id="ai-kvalifikaciya-lidov-boris-block" class="bkl-root" aria-label="Анимация: AI присваивает лиду статус и передаёт в CRM">
<style>
#ai-kvalifikaciya-lidov-boris-block.bkl-root{padding:56px 0 64px;background:#f0f4fb;}
#ai-kvalifikaciya-lidov-boris-block .bkl-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#ai-kvalifikaciya-lidov-boris-block .bkl-card{
  display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;overflow:hidden;background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);min-height:480px;
}
@media(max-width:1023px){#ai-kvalifikaciya-lidov-boris-block .bkl-card{grid-template-columns:1fr;min-height:auto;}}
#ai-kvalifikaciya-lidov-boris-block .bkl-lft{padding:38px 34px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0;}
@media(max-width:1023px){#ai-kvalifikaciya-lidov-boris-block .bkl-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:28px 22px;}}
#ai-kvalifikaciya-lidov-boris-block .bkl-ey{font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#6366f1;margin:0 0 12px;display:flex;align-items:center;gap:8px;}
#ai-kvalifikaciya-lidov-boris-block .bkl-ey::before{content:'';width:18px;height:2px;background:#6366f1;border-radius:1px;}
#ai-kvalifikaciya-lidov-boris-block .bkl-h3{font-size:clamp(20px,2.3vw,25px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 16px;}
#ai-kvalifikaciya-lidov-boris-block .bkl-ul{list-style:none;margin:0 0 18px;padding:0;display:flex;flex-direction:column;gap:8px;}
#ai-kvalifikaciya-lidov-boris-block .bkl-ul li{display:flex;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#ai-kvalifikaciya-lidov-boris-block .bkl-ic{width:22px;height:22px;border-radius:50%;background:rgba(99,102,241,.1);display:flex;align-items:center;justify-content:center;font-size:11px;color:#4338ca;flex-shrink:0;font-style:normal;}
#ai-kvalifikaciya-lidov-boris-block .bkl-pills{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:14px;}
#ai-kvalifikaciya-lidov-boris-block .bkl-pl{padding:5px 11px;border-radius:99px;font-size:11px;font-weight:700;border:1.5px solid transparent;}
#ai-kvalifikaciya-lidov-boris-block .bkl-pl-h{background:rgba(239,68,68,.08);color:#b91c1c;border-color:rgba(239,68,68,.22);}
#ai-kvalifikaciya-lidov-boris-block .bkl-pl-w{background:rgba(245,158,11,.08);color:#b45309;border-color:rgba(245,158,11,.22);}
#ai-kvalifikaciya-lidov-boris-block .bkl-pl-c{background:rgba(59,130,246,.08);color:#1d4ed8;border-color:rgba(59,130,246,.22);}
#ai-kvalifikaciya-lidov-boris-block .bkl-pl-d{background:rgba(100,116,139,.08);color:#475569;border-color:rgba(100,116,139,.22);}
#ai-kvalifikaciya-lidov-boris-block .bkl-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#ai-kvalifikaciya-lidov-boris-block .bkl-rgt{background:linear-gradient(145deg,#07091a,#0d1224 55%,#090d1f);position:relative;min-height:400px;}
#bkl-scoring-pipeline-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="bkl-cnt">
  <div class="bkl-card">
    <div class="bkl-lft">
      <span class="bkl-ey">Скоринг в движении</span>
      <h3 class="bkl-h3">Канал → AI → статус → CRM: одна матрица на весь поток</h3>
      <ul class="bkl-ul">
        <li><span class="bkl-ic">1</span>Заявка с формы, чата или почты попадает в очередь</li>
        <li><span class="bkl-ic">2</span>AI закрывает поля BANT/MEDDIC и считает score</li>
        <li><span class="bkl-ic">3</span>Лид сортируется: hot / warm / cold / disqualified</li>
        <li><span class="bkl-ic">→</span>Handoff менеджеру только с резюме и первым вопросом</li>
      </ul>
      <div class="bkl-pills">
        <span class="bkl-pl bkl-pl-h">Горячий</span>
        <span class="bkl-pl bkl-pl-w">Тёплый</span>
        <span class="bkl-pl bkl-pl-c">Холодный</span>
        <span class="bkl-pl bkl-pl-d">Нецелевой</span>
      </div>
      <p class="bkl-foot">Дальше — матрица порогов и критерии B2B в секции «Скоринг» ↓</p>
    </div>
    <div class="bkl-rgt">
      <canvas id="bkl-scoring-pipeline-canvas" role="img" aria-label="Анимация: лиды проходят AI-скоринг и распределяются по статусам перед CRM"></canvas>
    </div>
  </div>
</div>
<script>
(function(){
  'use strict';
  var cv = document.getElementById('bkl-scoring-pipeline-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, t = 0;
  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 420;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();
  var C = {
    hot:'#ef4444', warm:'#f59e0b', cold:'#3b82f6', disq:'#64748b',
    ai:'#8b5cf6', aiG:'rgba(139,92,246,.28)', crm:'#22c55e', line:'rgba(121,242,255,.35)',
    chip:'#1e293b', chipB:'#334155', text:'#e2e8f0', muted:'#94a3b8'
  };
  var lanes = [
    {k:'hot', label:'Hot', y:0, c:C.hot},
    {k:'warm', label:'Warm', y:0, c:C.warm},
    {k:'cold', label:'Cold', y:0, c:C.cold},
    {k:'disq', label:'Disq', y:0, c:C.disq}
  ];
  var leads = [];
  function rr(x,y,w,h,r,fill,stroke){
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x,y,w,h,r); else ctx.rect(x,y,w,h);
    if (fill){ ctx.fillStyle=fill; ctx.fill(); }
    if (stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=1.2; ctx.stroke(); }
  }
  function spawn(){
    var types = ['hot','hot','warm','warm','cold','cold','disq'];
    leads.push({
      x: -24,
      y: H*0.38 + (Math.random()-0.5)*H*0.08,
      type: types[Math.floor(Math.random()*types.length)],
      phase: 0,
      spd: 1.1 + Math.random()*0.7
    });
  }
  function drawHub(cx,cy,r,p){
    var g = ctx.createRadialGradient(cx,cy,0,cx,cy,r*2);
    g.addColorStop(0,C.aiG); g.addColorStop(1,'rgba(139,92,246,0)');
    ctx.fillStyle = g;
    ctx.beginPath(); ctx.arc(cx,cy,r*1.7,0,Math.PI*2); ctx.fill();
    rr(cx-r,cy-r,r*2,r*2,r*0.45,'rgba(15,23,42,.85)',C.ai);
    ctx.fillStyle = C.text;
    ctx.font = 'bold 11px Inter,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('AI score', cx, cy-4);
    ctx.font = '10px Inter,sans-serif';
    ctx.fillStyle = C.muted;
    ctx.fillText('BANT · RAG', cx, cy+10);
    ctx.strokeStyle = C.ai;
    ctx.lineWidth = 2;
    ctx.beginPath(); ctx.arc(cx,cy,r*0.55+p*4,0,Math.PI*2); ctx.stroke();
  }
  function drawCrm(x,y,w,h){
    rr(x,y,w,h,10,'rgba(34,197,94,.12)',C.crm);
    ctx.fillStyle = C.crm;
    ctx.font = 'bold 12px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('CRM handoff', x+12, y+22);
    for (var i=0;i<3;i++){
      rr(x+12,y+32+i*22,w-24,16,4,'rgba(15,23,42,.6)',C.chipB);
    }
  }
  function loop(){
    t += 0.016;
    ctx.clearRect(0,0,W,H);
    var hubX = W*0.46, hubY = H*0.42, hubR = Math.min(W,H)*0.09;
    for (var i=0;i<4;i++){
      lanes[i].y = H*0.14 + i*(H*0.19);
      ctx.strokeStyle = 'rgba(255,255,255,.06)';
      ctx.beginPath(); ctx.moveTo(W*0.58, lanes[i].y); ctx.lineTo(W*0.92, lanes[i].y); ctx.stroke();
      ctx.fillStyle = lanes[i].c;
      ctx.font = '10px Inter,sans-serif';
      ctx.textAlign = 'right';
      ctx.fillText(lanes[i].label, W*0.56, lanes[i].y+4);
    }
    drawHub(hubX, hubY, hubR, Math.sin(t*2)*0.5+0.5);
    drawCrm(W*0.72, H*0.68, W*0.22, H*0.22);
    if (Math.random() < 0.035) spawn();
    for (var j=leads.length-1;j>=0;j--){
      var L = leads[j];
      L.x += L.spd;
      if (L.x > W+30){ leads.splice(j,1); continue; }
      var ty = lanes[{hot:0,warm:1,cold:2,disq:3}[L.type]].y;
      if (L.x > hubX - hubR && L.phase === 0) L.phase = 1;
      if (L.phase === 1){
        L.x = hubX + hubR + 8;
        L.y += (ty - L.y) * 0.08;
        if (Math.abs(ty - L.y) < 2) L.phase = 2;
      }
      if (L.phase === 2) L.x += L.spd * 0.85;
      var col = lanes[{hot:0,warm:1,cold:2,disq:3}[L.type]].c;
      rr(L.x-10, L.y-7, 20, 14, 4, col, 'rgba(255,255,255,.25)');
    }
    ctx.strokeStyle = C.line;
    ctx.setLineDash([4,6]);
    ctx.beginPath(); ctx.moveTo(hubX+hubR+4, hubY); ctx.lineTo(W*0.72, H*0.72); ctx.stroke();
    ctx.setLineDash([]);
    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
  </section>

  <section class="akl-section akl-section-alt" id="skoring">
    <div class="akl-cnt">
      <div class="akl-sh nero-ai-reveal">
        <span class="akl-eyebrow">Скоринг лидов ai</span>
        <h2>Как работает скоринг: горячий, тёплый, холодный и нецелевой лид</h2>
        <p><strong>AI лид скоринг</strong> — score плюс категория. Пороги задаёт бизнес: ICP, минимальный чек, география, срок.</p>
      </div>
      <div class="akl-table-wrap nero-ai-reveal">
        <table class="akl-table" aria-label="Статусы квалификации">
          <thead><tr><th>Статус</th><th>Смысл</th><th>Действие в CRM</th></tr></thead>
          <tbody>
            <tr><td class="akl-status-hot"><strong>Горячий</strong></td><td>бюджет и срок, ЛПР или champion</td><td>задача «перезвонить», уведомление РОПа</td></tr>
            <tr><td class="akl-status-warm"><strong>Тёплый</strong></td><td>интерес есть, поля не закрыты</td><td>nurture, дозвон в SLA</td></tr>
            <tr><td class="akl-status-cold"><strong>Холодный</strong></td><td>срок &gt; 6 мес.</td><td>автоворонка</td></tr>
            <tr><td class="akl-status-disq"><strong>Нецелевой</strong></td><td>не ICP, спам, тест</td><td>отказ + причина, без ОП</td></tr>
          </tbody>
        </table>
      </div>
      <div class="akl-card nero-ai-reveal" style="margin-top:22px">
        <h3 id="matrica">Матрица квалификации лидов</h3>
        <p>Лид-магнит: 3–7 вопросов, веса, пороги hot / warm / cold / disqualified. Основа промпта и JSON-schema агента.</p>
        <ol style="padding-left:20px;color:var(--akl-muted);font-size:14.5px;line-height:1.65">
          <li>ICP (отрасль, размер, регион)</li>
          <li>Бюджет vs минимальный чек</li>
          <li>Срок решения</li>
          <li>Роль (ЛПР / влияет / пользователь)</li>
          <li>Intent источника</li>
        </ol>
      </div>

      <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-matrica">
        <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Получить матрицу квалификации лидов</p>
          <p class="ym-cta-block__sub">Шаблон матрицы (вопросы, веса, пороги) и чеклист полей CRM под ваш ICP — после заявки в Telegram.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Получить карту квалификации</a>
        </div>
      </div>

      <div class="akl-table-wrap nero-ai-reveal">
        <h3 style="margin-bottom:12px">Критерии B2B: бюджет, срок, ЛПР, отрасль</h3>
        <table class="akl-table" aria-label="BANT MEDDIC CHAMP">
          <thead><tr><th>Метод</th><th>Когда</th><th>Что спрашивает AI</th></tr></thead>
          <tbody>
            <tr><td><strong>BANT</strong></td><td>услуги, агентства, SMB</td><td>бюджет, срок, ЛПР, потребность</td></tr>
            <tr><td><strong>MEDDIC</strong></td><td>длинный цикл</td><td>economic buyer, criteria, process</td></tr>
            <tr><td><strong>CHAMP</strong></td><td>сильная «боль» на входе</td><td>challenges, authority, money</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="akl-section" id="kanaly">
    <div class="akl-cnt">
      <div class="akl-sh akl-left nero-ai-reveal">
        <span class="akl-eyebrow">Омниканал</span>
        <h2>Каналы входа: сайт, чат, почта и мессенджеры</h2>
        <p>Один ICP, одна матрица, одни пороги — независимо от Tilda, Telegram или Avito.</p>
      </div>
      <div class="akl-grid-2 nero-ai-reveal">
        <div class="akl-card">
          <h3>Единые правила для всех каналов</h3>
          <p>Webhook/очередь (n8n, Make, FastAPI) нормализует телефон, UTM, ИНН → LLM-оркестратор.</p>
          <ul>
            <li><strong>Диалоговая квалификация</strong> — WhatsApp, Telegram, чат</li>
            <li><strong>Batch-скоринг</strong> — форма или письмо без чата</li>
          </ul>
        </div>
        <div class="akl-card">
          <h3>Связка с обработкой почты и заявок</h3>
          <ul>
            <li>Почта в CRM — slug <code>vnedrenie-ai-obrabotka-email-crm</code></li>
            <li>AI в amoCRM — <code>vnedrenie-ai-amocrm</code></li>
            <li>1С/ERP — <code>ai-1c-erp</code></li>
          </ul>
          <p>Фокус здесь — <strong>статус и скоринг</strong>, не дубль парсинга письма.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="akl-section akl-section-alt" id="crm">
    <div class="akl-cnt">
      <div class="akl-sh nero-ai-reveal">
        <span class="akl-eyebrow">ai для crm</span>
        <h2>Интеграция AI-квалификации лидов с CRM</h2>
        <p><strong>Интеграция ai квалификация лидов с crm</strong> — поля, роботы, маршрутизация; иначе менеджер снова в Excel.</p>
      </div>
      <div class="akl-grid-2 nero-ai-reveal">
        <div class="akl-card">
          <h3>amoCRM, Битрикс24 и смежные сценарии</h3>
          <p><strong>amoCRM:</strong> webhook → worker → API (теги, примечание, статус). Кейс AX Digital: BANT ~30&nbsp;с.</p>
          <p><strong>Битрикс24:</strong> webhook ~3&nbsp;с → 200 OK → очередь → LLM (кейс Velmi на Habr). Омниканал — WhatsApp, Telegram, Avito.</p>
        </div>
        <div class="akl-card">
          <h3>Поля, теги и маршрутизация в воронке</h3>
          <ul>
            <li><code>ai_status</code>, <code>ai_score</code></li>
            <li><code>qualification_summary</code>, <code>disqualify_reason</code></li>
            <li><code>recommended_first_question</code></li>
          </ul>
          <p>SLA: hot — 15&nbsp;мин, warm — 2&nbsp;ч. Встроенный скоринг CRM vs кастомная матрица.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="akl-section" id="etapy">
    <div class="akl-cnt">
      <div class="akl-sh nero-ai-reveal">
        <span class="akl-eyebrow">Под ключ</span>
        <h2>Внедрение под ключ: этапы, сроки и состав работ</h2>
        <p><strong>Внедрение ai квалификация лидов под ключ</strong> — пилот, shadow mode, KPI; не «виджет за сутки».</p>
      </div>
      <div class="akl-timeline nero-ai-reveal">
        <div class="akl-tl-item"><span class="akl-tl-dot"></span><h3>Аудит (3–5 дней)</h3><p>Каналы, ICP, доля нецелевых, SLA, поля CRM.</p></div>
        <div class="akl-tl-item"><span class="akl-tl-dot"></span><h3>Настройка агента (1–2 нед.)</h3><p>Матрица, RAG, JSON-schema, антисpam, прогон 10–20 исторических лидов.</p></div>
        <div class="akl-tl-item"><span class="akl-tl-dot"></span><h3>Пилот на одном канале (~1 нед.)</h3><p>Форма или Telegram перед rollout.</p></div>
        <div class="akl-tl-item"><span class="akl-tl-dot"></span><h3>Обучение РОПа и менеджеров</h3><p>Shadow mode 1–2 нед.: AI пишет в CRM, человек сверяет; дашборд speed-to-lead, MQL→SQL.</p></div>
      </div>
      <p class="nero-ai-reveal" style="text-align:center;margin-top:20px;color:var(--akl-soft)">Срок до продакшена при 50–300 лидах/мес: <strong>3–6 недель</strong>.</p>

      <aside class="ym-cta-block ym-cta-block--inline ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите понимать внедрение до старта проекта?</p>
          <p class="ym-cta-block__sub">На этапе shadow mode полезно, когда команда знает основы автоматизации<?php $sec_url = getenv('SECONDARY_CTA_URL'); $sec_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI'; if ($sec_url) : ?>: <a href="<?php echo esc_url($sec_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($sec_label); ?></a><?php else : ?> (см. материалы по <?php echo esc_html($sec_label); ?> у владельца сайта)<?php endif; ?> — дополнение к услуге «под ключ».</p>
        </div>
      </aside>
    </div>
  </section>

  <section class="akl-section akl-section-alt" id="kpi">
    <div class="akl-cnt">
      <div class="akl-sh nero-ai-reveal">
        <span class="akl-eyebrow">ROI</span>
        <h2>KPI до и после: как измерить эффект</h2>
        <p>Фиксируем на пилоте — без «+27%» из чужих статей без первичного отчёта.</p>
      </div>
      <div class="akl-table-wrap nero-ai-reveal">
        <table class="akl-table" aria-label="KPI квалификации">
          <thead><tr><th>KPI</th><th>Что смотрим</th></tr></thead>
          <tbody>
            <tr><td>Speed-to-lead</td><td>медиана минут до первого контакта</td></tr>
            <tr><td>% disqualified</td><td>до/после по каналам</td></tr>
            <tr><td>MQL→SQL</td><td>когорта «прошёл AI»</td></tr>
            <tr><td>Время менеджера на лид</td><td>опрос + CRM</td></tr>
          </tbody>
        </table>
      </div>
      <div class="akl-grid-2 nero-ai-reveal" style="margin-top:22px">
        <div class="akl-card">
          <h3>Риски: ложные «горячие»</h3>
          <p>Тестовые заявки, пустые телефоны — антисpam и human-in-the-loop для пограничного score.</p>
        </div>
        <div class="akl-card">
          <h3>152-ФЗ</h3>
          <p>Согласия на формах, YandexGPT/GigaChat при ПДн, минимизация логов, согласованный контур для Claude/GPT без ПДн.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="akl-section" id="keisy">
    <div class="akl-cnt">
      <div class="akl-sh nero-ai-reveal">
        <span class="akl-eyebrow">Методика</span>
        <h2>Кейс и пример внедрения</h2>
        <p><strong>Проектная модель Nero Network</strong> для B2B (50–300 лидов/мес) — не вымышленное «ООО Ромашка».</p>
      </div>
      <div class="akl-card nero-ai-reveal">
        <h3>Сценарий для B2B-услуг / агентства / девелопера</h3>
        <p><strong>Было:</strong> форма + почта + Telegram; все заявки вручную; hot остывают.</p>
        <p><strong>Сделали:</strong> матрица BANT → webhook → batch/диалог → поля в amoCRM/Б24 → shadow 10 дней → rollout 20%→100%.</p>
        <p><strong>Опора:</strong> Velmi (webhook+очередь), AX Digital (amo+Claude), Habr/омниканал. Девелопер: тип объекта, регион, срок сдачи → disqualified без звонка аккаунта.</p>
      </div>
    </div>
  </section>

  <section class="akl-section akl-section-alt" id="ceny">
    <div class="akl-cnt">
      <div class="akl-sh nero-ai-reveal">
        <span class="akl-eyebrow">ai квалификация лидов цена</span>
        <h2>Стоимость внедрения AI-квалификации лидов</h2>
      </div>
      <div class="akl-table-wrap nero-ai-reveal">
        <table class="akl-table" aria-label="Факторы чека">
          <thead><tr><th>Фактор</th><th>Влияние</th></tr></thead>
          <tbody>
            <tr><td>Число каналов</td><td>+ интеграции и тесты</td></tr>
            <tr><td>Диалог vs batch</td><td>диалог дороже по QA</td></tr>
            <tr><td>RAG, несколько продуктов</td><td>объём базы</td></tr>
            <tr><td>CRM, shadow, дашборд</td><td>адаптер API, аналитика</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="text-align:center;margin-top:18px">Ориентир из ТЗ: <strong>150–450 тыс. ₽</strong> по scope. Конкуренты: MVP от ~69–120 тыс. ₽ за один канал.</p>
      <div class="akl-card nero-ai-reveal" style="margin-top:20px">
        <h3>AI-квалификация лидов для малого бизнеса</h3>
        <p>При &lt;30–50 лидах/мес: матрица + batch-скоринг формы + робот hot — без полного омниканала.</p>
      </div>
    </div>
  </section>

  <section class="akl-section" id="faq">
    <div class="akl-cnt">
      <div class="akl-sh nero-ai-reveal">
        <span class="akl-eyebrow">FAQ</span>
        <h2>Частые вопросы</h2>
      </div>
      <div class="akl-faq nero-ai-reveal">
        <div class="akl-faq-item"><h3>Чем отличается квалификация от простого чат-бота</h3><p>AI ведёт диалог с RAG, <strong>действует в CRM</strong>, присваивает score и disqualified с причиной; единая матрица на почту + мессенджеры.</p></div>
        <div class="akl-faq-item"><h3>Нужен ли свой разработчик</h3><p>Нет для эксплуатации: интеграция, обучение, документация «под ключ».</p></div>
        <div class="akl-faq-item"><h3>Сроки запуска в продакшен</h3><p>Аудит 3–5 дней, пилот ~1 нед., shadow 1–2 нед., rollout 3–6 нед.</p></div>
        <div class="akl-faq-item"><h3>Заменит ли AI отдел продаж</h3><p>Нет — первичная квалификация и FAQ; переговоры и КП за человеком.</p></div>
        <div class="akl-faq-item"><h3>Насколько точен AI</h3><p>Растёт в shadow mode и по feedback «AI ошибся»; human-in-the-loop для hot.</p></div>
        <div class="akl-faq-item"><h3>Чем отличается от страницы «AI для amoCRM»</h3><p>amo — контур API; здесь — <strong>квалификация до менеджера</strong> на всех каналах.</p></div>
      </div>

      <div class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы убрать холостые созвоны из воронки?</p>
          <p class="ym-cta-block__sub">Аудит потока, пилот на одном канале, матрица, amoCRM/Б24, shadow mode и KPI на пилоте.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Получить карту квалификации</a>
            <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</div><!-- .akl-content -->

  <!-- INTERNAL-LINKS:INSERT -->
  <!-- SCHEMA-MARKUP:INSERT -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

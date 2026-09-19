<?php
/**
 * Template Name: AI для рекламы под ключ: контекст и таргет
 * Description: SEO-лендинг — внедрение AI для контекстной и таргетированной рекламы. Гипотезы, креативы, отчёты. Аудит рутины.
 */

$page_seo_title       = 'AI для рекламы под ключ: контекст и таргет | Nero Network';
$page_seo_description = 'Внедрение AI для контекстной и таргетированной рекламы: гипотезы, объявления, аудитории и отчёты в Директе, VK Ads и e-commerce. Аудит рутины и настройка под ключ.';

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
    ['label' => 'Зачем AI', 'href' => '#zachem-ai-v-reklame'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie-pod-klyuch'],
    ['label' => 'Креативы', 'href' => '#generaciya-obuyavlenij'],
    ['label' => 'Аудитории', 'href' => '#ai-auditorii-gipotezy'],
    ['label' => 'Отчёты', 'href' => '#otchety-analitika'],
    ['label' => 'Стек', 'href' => '#tipovoy-stek'],
    ['label' => 'Риски', 'href' => '#riski-vnedreniya'],
    ['label' => 'Кейсы', 'href' => '#keisy-roi'],
    ['label' => 'FAQ', 'href' => '#faq'],
    ['label' => 'Заявка', 'href' => '#avtomatizirovat-reklamu'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Автоматизировать рекламу';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#tipovoy-stek';

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
/* Скрыть шапку Kadence — pill-header из темы */
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

/* Hero: min-height для первого экрана */
.adr-hero-reklamy.nero-ai-hero{
  min-height:100vh;
  min-height:100dvh;
  position:relative;
}

.nero-ai-reveal{
  opacity:0;transform:translateY(22px);
  transition:opacity .55s ease,transform .55s ease;
}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
.nero-ai-delay-3{transition-delay:.36s;}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-dlya-reklamy-page" role="main" tabindex="-1">

<section class="nero-ai-hero adr-hero-reklamy" id="hero" aria-labelledby="hero-reklamy-title">
<style>
/* ── Hero ai-dlya-reklamy: самодостаточные стили ── */
.adr-hero-reklamy {
  --adr-cyan: #79f2ff;
  --adr-violet: #8b5cf6;
  --adr-orange: #f97316;
  --adr-green: #22c55e;
  --adr-text: #e6edf7;
  --adr-muted: #9aa8bd;
  --adr-soft: #c7d2e5;
  --adr-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.adr-hero-reklamy::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 32% 24%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.adr-hero-reklamy::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 620px;
  height: 620px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .12), transparent 66%);
  filter: blur(8px);
  animation: adrHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes adrHeroGlow {
  from { opacity: .4; transform: scale(.95); }
  to { opacity: .82; transform: scale(1.05); }
}
.adr-hero-reklamy .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.adr-hero-reklamy .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.adr-hero-reklamy .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 64px);
  line-height: .98;
  letter-spacing: -0.055em;
  color: #fff;
  font-weight: 900;
}
.adr-hero-reklamy .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--adr-cyan) 42%, var(--adr-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.adr-hero-reklamy .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--adr-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.adr-hero-reklamy .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--adr-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.adr-hero-reklamy .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.adr-hero-reklamy .nero-ai-badge {
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
.adr-hero-reklamy .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.adr-hero-reklamy .nero-ai-btn {
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
.adr-hero-reklamy .nero-ai-btn:hover { transform: translateY(-2px); }
.adr-hero-reklamy .nero-ai-btn-primary {
  color: #041018 !important;
  background: linear-gradient(135deg, var(--adr-cyan), #a5f3fc);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.adr-hero-reklamy .nero-ai-btn-secondary {
  color: var(--adr-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.adr-hero-reklamy .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--adr-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.adr-hero-reklamy .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.adr-hero-reklamy .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.adr-hero-reklamy .nero-ai-dots { display: flex; gap: 6px; }
.adr-hero-reklamy .nero-ai-dot {
  width: 10px; height: 10px; border-radius: 50%;
  background: rgba(255,255,255,.18);
}
.adr-hero-reklamy .nero-ai-window-title {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: .06em;
  text-transform: uppercase;
  color: var(--adr-muted);
}
.adr-hero-reklamy .nero-ai-window-body { padding: 16px; }
.adr-hero-reklamy .nero-ai-dashboard-title {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  margin-bottom: 14px;
}
.adr-hero-reklamy .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 15px;
  font-weight: 800;
  color: #fff;
  letter-spacing: -.02em;
}
.adr-hero-reklamy .nero-ai-live-pill {
  padding: 5px 10px;
  border-radius: 999px;
  background: rgba(34, 197, 94, .14);
  border: 1px solid rgba(34, 197, 94, .35);
  color: #86efac;
  font-size: 11px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: .08em;
}
.adr-hero-reklamy .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 8px;
  margin-bottom: 12px;
}
.adr-hero-reklamy .nero-ai-metric {
  padding: 10px 8px;
  border-radius: 12px;
  background: rgba(255,255,255,.05);
  border: 1px solid rgba(255,255,255,.08);
  text-align: center;
}
.adr-hero-reklamy .nero-ai-metric span {
  display: block;
  font-size: 9px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .06em;
  color: var(--adr-muted);
  margin-bottom: 4px;
}
.adr-hero-reklamy .nero-ai-metric strong {
  display: block;
  font-size: 18px;
  font-weight: 900;
  color: #fff;
  letter-spacing: -.04em;
  line-height: 1;
}
.adr-hero-reklamy .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  font-size: 9px;
  color: #64748b;
}
.adr-hero-reklamy .adr-dash-canvas-wrap {
  position: relative;
  height: 200px;
  margin: 0 0 12px;
  border-radius: 14px;
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.08);
  background: linear-gradient(180deg, rgba(8,12,28,.9), rgba(4,8,20,.95));
}
.adr-hero-reklamy #adr-hero-canvas {
  display: block;
  width: 100%;
  height: 100%;
}
.adr-hero-reklamy .nero-ai-task-stream {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.adr-hero-reklamy .nero-ai-task {
  display: grid;
  grid-template-columns: 32px 1fr auto;
  gap: 10px;
  align-items: center;
  padding: 10px 12px;
  border-radius: 12px;
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.07);
}
.adr-hero-reklamy .nero-ai-task-icon {
  width: 32px; height: 32px;
  display: flex; align-items: center; justify-content: center;
  border-radius: 8px;
  background: rgba(121,242,255,.12);
  color: var(--adr-cyan);
  font-size: 10px;
  font-weight: 900;
  letter-spacing: -.02em;
}
.adr-hero-reklamy .nero-ai-task div strong {
  display: block;
  font-size: 12px;
  color: #fff;
  margin-bottom: 2px;
}
.adr-hero-reklamy .nero-ai-task div span {
  font-size: 10px;
  color: var(--adr-muted);
}
.adr-hero-reklamy .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  font-size: 9px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: .06em;
  background: rgba(34,197,94,.14);
  color: #86efac;
  border: 1px solid rgba(34,197,94,.28);
}
.adr-hero-reklamy .nero-ai-status--amber {
  background: rgba(249,115,22,.14);
  color: #fdba74;
  border-color: rgba(249,115,22,.28);
}
@media (max-width: 960px) {
  .adr-hero-reklamy .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .adr-hero-reklamy .nero-ai-dashboard { transform: none; }
  .adr-hero-reklamy .nero-ai-metrics-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 520px) {
  .adr-hero-reklamy .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .adr-hero-reklamy .nero-ai-window-body { padding: 12px; }
  .adr-hero-reklamy .nero-ai-task { grid-template-columns: 28px 1fr; }
  .adr-hero-reklamy .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai для рекламы</p>
      <h1 id="hero-reklamy-title">AI для контекстной и таргетированной рекламы: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Нейросети генерируют гипотезы, объявления, аудитории и отчёты — меньше ручной рутины в контексте и таргете, больше тестов и заявок</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Гипотезы</li>
        <li class="nero-ai-badge">Директ &amp; VK</li>
        <li class="nero-ai-badge">Отчёты AI</li>
        <li class="nero-ai-badge">Аудит рутины</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Автоматизировать рекламу</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#vnedrenie-pod-klyuch">Внедрение под ключ</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI для performance-рекламы">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">Директ · VK Ads · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Performance · AI-центр</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid" aria-label="Демо-метрики">
            <div class="nero-ai-metric">
              <span>Гипотезы</span>
              <strong>12</strong>
              <small>в месяц</small>
            </div>
            <div class="nero-ai-metric">
              <span>Креативы</span>
              <strong>48</strong>
              <small>вариантов</small>
            </div>
            <div class="nero-ai-metric">
              <span>CPL</span>
              <strong>−18%</strong>
              <small>vs база</small>
            </div>
            <div class="nero-ai-metric">
              <span>Отчёт</span>
              <strong>12 мин</strong>
              <small>вместо 4 ч</small>
            </div>
          </div>

          <div class="adr-dash-canvas-wrap" aria-hidden="false">
            <canvas id="adr-hero-canvas" role="img" aria-label="Анимация: гипотезы проходят радар аудиторий, черновики креативов, approval gate и AI-сводку в Директ и VK"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий performance-центра">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">HYP</span>
              <div><strong>Новая гипотеза</strong><span>сегмент e-commerce</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>6 черновиков объявлений</strong><span>ЕПК Директ</span></div>
              <span class="nero-ai-status nero-ai-status--amber">ревью</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">OK</span>
              <div><strong>Approval gate</strong><span>креатив утверждён</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">RPT</span>
              <div><strong>AI-сводка недели</strong><span>Директ + VK</span></div>
              <span class="nero-ai-status">отправлено</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * adr-hero-engine — «Диспетчерская performance-рекламы»
 * Фазы: scan → draft → gate → dispatch (не загрузка→сборка→запуск)
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("adr-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 200;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 4;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    hubBg: "#0f172a",
    hubBorder: "#334155",
    cardHyp: "#fef3c7",
    cardAd: "#dbeafe",
    cardOk: "#d1fae5",
    radar: "rgba(121,242,255,0.35)",
    gateGreen: "#22c55e",
    pulse: "rgba(139,92,246,0.55)",
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

  function createBubble(x, y, text) {
    ctx.font = "bold 8px Inter,sans-serif";
    var tw = ctx.measureText(text).width;
    var bw = tw + 14, bh = 16;
    drawRR(ctx, x - bw / 2, y - bh - 4, bw, bh, 5, C.bubbleBg, C.outline);
    ctx.fillStyle = C.bubbleText;
    ctx.textAlign = "center";
    ctx.fillText(text, x, y - bh / 2 + 1);
  }

  /* Дуговой поток гипотез — вместо Conveyor */
  function HypothesisStream() {
    this.cards = [
      { phase: 0, label: "H1" },
      { phase: 55, label: "A/B" },
      { phase: 110, label: "UTM" }
    ];
  }
  HypothesisStream.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 220;
    ctx.strokeStyle = "rgba(121,242,255,0.2)";
    ctx.lineWidth = 1.5;
    ctx.beginPath();
    ctx.arc(0, 10, 70, Math.PI * 0.15, Math.PI * 0.85);
    ctx.stroke();

    this.cards.forEach(function (c) {
      var t = ((prg + c.phase) % 220) / 220;
      var ang = Math.PI * 0.15 + t * Math.PI * 0.7;
      var rx = Math.cos(ang) * 70;
      var ry = 10 + Math.sin(ang) * 38;
      if (t < 0.88) {
        drawRR(ctx, rx - 10, ry - 7, 20, 14, 3, C.cardHyp, C.outline);
        ctx.fillStyle = "#78350f";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(c.label, rx, ry + 2);
      }
    });
  };

  /* Радар аудиторий — уникальный объект */
  function AudienceRadar() {
    this.sweep = 0;
  }
  AudienceRadar.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 220;
    if (prg > 55) return;
    this.sweep = (prg / 55) * Math.PI * 1.4 - Math.PI * 0.7;
    ctx.strokeStyle = "rgba(255,255,255,0.12)";
    ctx.lineWidth = 1;
    for (var r = 12; r <= 36; r += 12) {
      ctx.beginPath();
      ctx.arc(-95, -15, r, 0, Math.PI * 2);
      ctx.stroke();
    }
    ctx.strokeStyle = C.radar;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(-95, -15);
    ctx.lineTo(-95 + Math.cos(this.sweep) * 38, -15 + Math.sin(this.sweep) * 38);
    ctx.stroke();
    if (prg > 35 && prg < 52) {
      ctx.fillStyle = C.radar;
      ctx.beginPath();
      ctx.arc(-72, -8, 4, 0, Math.PI * 2);
      ctx.fill();
    }
  };

  /* Центральный хаб кампаний — вместо WebsiteTerminal */
  function CampaignCommandHub() {
    this.build = 0;
  }
  CampaignCommandHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 220;
    drawRR(ctx, -42, -38, 84, 76, 8, C.hubBg, C.hubBorder);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("AI-кабинет", 0, -28);

    if (prg >= 55 && prg < 135) {
      var draft = Math.min(1, (prg - 55) / 40);
      for (var i = 0; i < 3; i++) {
        var alpha = Math.max(0, draft - i * 0.2);
        ctx.globalAlpha = alpha;
        drawRR(ctx, -32 + i * 22, -12, 18, 24, 3, i % 2 ? C.cardAd : C.cardOk, C.outline);
        ctx.fillStyle = "#1e3a5f";
        ctx.font = "bold 5px Inter,sans-serif";
        ctx.fillText("AD" + (i + 1), -23 + i * 22, 2);
      }
      ctx.globalAlpha = 1;
    }

    if (prg >= 135 && prg < 175) {
      drawRR(ctx, -28, 18, 56, 14, 4, "rgba(34,197,94,0.2)", C.gateGreen);
      ctx.fillStyle = C.gateGreen;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("APPROVED", 0, 28);
    }

    if (prg >= 175) {
      var wave = (prg - 175) / 45;
      ctx.strokeStyle = C.pulse;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(0, 8, 20 + wave * 50, 0, Math.PI * 2);
      ctx.stroke();
    }
  };

  /* Лента вариантов креативов */
  function CreativeVariantStrip() {
    this.offset = 0;
  }
  CreativeVariantStrip.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 220;
    if (prg < 55 || prg > 130) return;
    drawRR(ctx, 72, -30, 58, 52, 6, "rgba(255,255,255,0.05)", C.outline);
    for (var i = 0; i < 4; i++) {
      var ox = 78 + ((frame * 0.6 + i * 14) % 48);
      drawRR(ctx, ox, -22 + (i % 2) * 18, 12, 16, 2, [C.cardAd, C.cardHyp, C.cardOk, C.cardAd][i], C.outline);
    }
  };

  /* Шлюз approval */
  function ApprovalGate() {
    this.open = 0;
  }
  ApprovalGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 220;
    if (prg < 125 || prg > 185) return;
    drawRR(ctx, 95, 8, 36, 44, 5, "rgba(15,23,42,0.8)", C.outline);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("GATE", 113, 18);
    if (prg > 140) {
      ctx.strokeStyle = C.gateGreen;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(102, 32);
      ctx.lineTo(108, 38);
      ctx.lineTo(122, 24);
      ctx.stroke();
    }
  };

  /* Пульс отчёта — финал цикла */
  function ReportPulse() {
    this.rings = [];
  }
  ReportPulse.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 220;
    if (prg < 175) return;
    var t = (prg - 175) / 45;
    ctx.fillStyle = C.pulse;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Сводка → Директ+VK", 0, -52);
    for (var i = 0; i < 3; i++) {
      var rt = Math.max(0, t - i * 0.15);
      ctx.globalAlpha = 1 - rt;
      ctx.strokeStyle = C.pulse;
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.arc(0, 8, 15 + rt * 60, 0, Math.PI * 2);
      ctx.stroke();
    }
    ctx.globalAlpha = 1;
  };

  /* Бейджи каналов */
  function ChannelBadgeRow() {
    this.blink = 0;
  }
  ChannelBadgeRow.prototype.draw = function (ctx) {
    var labels = ["Директ", "VK"];
    labels.forEach(function (lb, i) {
      drawRR(ctx, -120 + i * 52, 42, 44, 14, 4, "rgba(255,255,255,0.06)", C.outline);
      ctx.fillStyle = i === 0 ? "#fbbf24" : "#60a5fa";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(lb, -98 + i * 52, 52);
    });
  };

  function Agent(x, y, color, role, dialogs) {
    this.x = x; this.y = y; this.color = color; this.role = role;
    this.dialogs = dialogs;
    this.stepTrig = Math.random() * 200;
    this.bubbleTimer = 0;
    this.bubbleText = "";
  }
  Agent.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 220;
    var targets = {
      "1_architect": { x: -95, y: -15, active: prg < 55 },
      "2_seo": { x: -55, y: 35, active: prg >= 20 && prg < 80 },
      "3_coder": { x: 0, y: 5, active: prg >= 55 && prg < 135 },
      "4_designer": { x: 100, y: -10, active: prg >= 70 && prg < 140 },
      "5_deployer": { x: 113, y: 30, active: prg >= 130 && prg < 200 }
    };
    var t = targets[this.role] || { x: this.x, y: this.y, active: false };
    if (t.active) {
      this.x += (t.x - this.x) * 0.04;
      this.y += (t.y - this.y) * 0.04;
    }
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(this.x, this.y, 5, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillStyle = "#fff";
    ctx.beginPath();
    ctx.arc(this.x, this.y - 7, 4, 0, Math.PI * 2);
    ctx.fill();

    this.bubbleTimer--;
    if (this.bubbleTimer <= 0 && t.active && Math.random() < 0.008) {
      this.bubbleText = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
      this.bubbleTimer = 90;
    }
    if (this.bubbleTimer > 60 && this.bubbleText) {
      createBubble(this.x, this.y - 16, this.bubbleText);
    }
  };

  var agents = [
    new Agent(-130, 20, C.agentYellow, "1_architect", ["Сегмент e-com", "Look-alike?", "ARGUS окно"]),
    new Agent(-80, 50, C.agentGreen, "2_seo", ["UTM-шаблон", "Ключ в ЕПК", "A/B гипотеза"]),
    new Agent(-20, 55, C.agentBlue, "3_coder", ["API Директ v5", "VK Ads sync", "n8n цепочка"]),
    new Agent(60, 45, C.agentPink, "4_designer", ["6 черновиков", "Нейрообъявление", "Brand book"]),
    new Agent(130, 50, C.agentPurple, "5_deployer", ["Approval gate", "CPL −18%", "Сводка ушла"])
  ];

  var entities = [
    new HypothesisStream(),
    new AudienceRadar(),
    new CampaignCommandHub(),
    new CreativeVariantStrip(),
    new ApprovalGate(),
    new ReportPulse(),
    new ChannelBadgeRow()
  ];

  function engineLoop() {
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    var prg = (frame * 0.04) % 220;

    entities.forEach(function (e) { e.draw(ctx); });
    agents.forEach(function (a) { a.draw(ctx); });

    if (prg > 8 && prg < 22) createBubble(-70, -55, "Сканируем аудитории");
    if (prg > 62 && prg < 76) createBubble(0, -58, "LLM: черновики AD");
    if (prg > 128 && prg < 142) createBubble(95, -40, "Human-in-the-loop");
    if (prg > 182 && prg < 196) createBubble(0, -62, "Отчёт: 12 мин");

    ctx.restore();
    frame++;
    requestAnimationFrame(engineLoop);
  }
  engineLoop();
});
</script>

<style>

/* === ADR CONTENT ROOT (ai-dlya-reklamy) === */
.adr-content{
  --adr-bg:#050711;--adr-bg2:#080b17;
  --adr-surface:rgba(255,255,255,.072);--adr-text:#e6edf7;--adr-muted:#9aa8bd;
  --adr-soft:#c7d2e5;--adr-heading:#fff;--adr-border:rgba(255,255,255,.10);
  --adr-accent:#79f2ff;--adr-violet:#8b5cf6;--adr-green:#22c55e;
  --adr-btn-from:#2563eb;--adr-btn-to:#7c3aed;
  --adr-r:18px;--adr-r-lg:24px;--adr-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--adr-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.adr-content *,.adr-content *::before,.adr-content *::after{box-sizing:border-box;}
.adr-content p{color:var(--adr-muted);line-height:1.72;margin:0 0 1em;}
.adr-content p:last-child{margin-bottom:0;}
.adr-content h2,.adr-content h3,.adr-content h4{color:var(--adr-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.adr-content strong{color:var(--adr-soft);}
.adr-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.adr-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--adr-muted);font-size:14.5px;line-height:1.65;}
.adr-content ul li::before{content:'›';position:absolute;left:0;color:var(--adr-accent);font-weight:700;}
.adr-cnt{width:min(var(--adr-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.adr-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.adr-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.adr-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.adr-sh.adr-left{margin-left:0;text-align:left;}
.adr-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.adr-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.adr-sh.adr-left p{margin-left:0;}
.adr-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--adr-accent);margin-bottom:14px;}
.adr-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.adr-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.adr-intro-text{position:relative;padding-left:20px;}
.adr-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--adr-accent),var(--adr-violet));}
.adr-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;}
.adr-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.adr-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;}
.adr-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--adr-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.adr-kpi-card .kl{font-size:11px;font-weight:600;color:var(--adr-muted);line-height:1.4;}
.adr-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.adr-intro-grid{grid-template-columns:1fr;gap:36px;}.adr-intro-kpi{grid-template-columns:repeat(3,1fr);}}
@media(max-width:600px){.adr-intro-kpi{grid-template-columns:1fr 1fr;}}
.adr-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.adr-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.adr-toc a{display:inline-block;padding:9px 18px;background:var(--adr-surface);border:1px solid var(--adr-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--adr-muted);transition:border-color .2s,color .2s;}
.adr-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--adr-accent);}
.adr-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--adr-border);border-radius:var(--adr-r-lg);padding:26px;}
.adr-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
@media(max-width:768px){.adr-grid-2{grid-template-columns:1fr;}}
.adr-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.adr-table{width:100%;border-collapse:collapse;font-size:14px;}
.adr-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--adr-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);}
.adr-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--adr-text);vertical-align:top;}
.adr-table tr:last-child td{border-bottom:none;}
.adr-checklist{list-style:none;padding:0;margin:16px 0;}
.adr-checklist li{display:flex;align-items:flex-start;gap:10px;padding:10px 14px;margin-bottom:8px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:10px;font-size:14px;}
.adr-checklist li::before{content:'[ ]';color:var(--adr-accent);font-weight:700;font-family:monospace;flex-shrink:0;}
.adr-case{margin-bottom:18px;padding:18px 20px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);border-radius:14px;}
.adr-case h4{font-size:15px;margin:0 0 6px;color:var(--adr-heading);}
.adr-case p{font-size:14px;margin:0;}
.adr-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.adr-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.adr-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--adr-heading);cursor:pointer;display:flex;justify-content:space-between;gap:16px;}
.adr-faq-q::after{content:'▾';color:var(--adr-accent);transition:transform .25s;}
.adr-faq-item.open .adr-faq-q::after{transform:rotate(180deg);}
.adr-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--adr-muted);line-height:1.72;}
.adr-faq-item.open .adr-faq-a{max-height:800px;padding:0 24px 20px;}
.adr-def{font-size:14.5px;padding:14px 18px;background:rgba(121,242,255,.06);border-left:3px solid var(--adr-accent);border-radius:0 10px 10px 0;margin-bottom:1.2em;}
.adr-short{font-size:14px;font-weight:600;color:var(--adr-soft);margin-top:1em;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--primary{text-align:center;}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--adr-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-link--accent{color:var(--adr-accent)!important;text-decoration:underline!important;}
.ym-btn{display:inline-flex;align-items:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;}
.ym-btn--accent{background:linear-gradient(135deg,var(--adr-btn-from),var(--adr-btn-to));color:#fff!important;}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--adr-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.adr-cta-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin:24px 0 32px;list-style:none;padding:0;}
.adr-cta-checklist li{display:inline-flex;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--adr-muted);}
.adr-cta-checklist li::before{content:'✓';color:var(--adr-green);margin-right:6px;font-weight:800;}
/* === БОРИС VIZ: prefix bar-, #ai-dlya-reklamy-boris-block === */
#ai-dlya-reklamy-boris-block.bar-root{padding:48px 0 56px;background:linear-gradient(180deg,rgba(255,255,255,.04),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
#ai-dlya-reklamy-boris-block .bar-cnt{max-width:1160px;margin:0 auto;padding:0 20px;}
#ai-dlya-reklamy-boris-block .bar-card{display:grid;grid-template-columns:minmax(0,44%) minmax(0,56%);border-radius:22px;overflow:hidden;background:#f8fafc;box-shadow:0 12px 48px rgba(0,0,0,.35),0 0 0 1px rgba(121,242,255,.15);min-height:460px;}
@media(max-width:1023px){#ai-dlya-reklamy-boris-block .bar-card{grid-template-columns:1fr;min-height:auto;}}
#ai-dlya-reklamy-boris-block .bar-lft{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;background:#fff;border-right:1px solid #e2e8f0;}
@media(max-width:1023px){#ai-dlya-reklamy-boris-block .bar-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}}
#ai-dlya-reklamy-boris-block .bar-ey{font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#6366f1;margin:0 0 14px;display:flex;align-items:center;gap:8px;}
#ai-dlya-reklamy-boris-block .bar-ey::before{content:'';width:18px;height:2px;background:#6366f1;border-radius:1px;}
#ai-dlya-reklamy-boris-block .bar-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;}
#ai-dlya-reklamy-boris-block .bar-ul{list-style:none;margin:0 0 20px;padding:0;display:flex;flex-direction:column;gap:9px;}
#ai-dlya-reklamy-boris-block .bar-ul li{display:flex;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#ai-dlya-reklamy-boris-block .bar-ul li::before{content:none;}
#ai-dlya-reklamy-boris-block .bar-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(99,102,241,.1);display:flex;align-items:center;justify-content:center;font-size:11px;color:#4f46e5;font-style:normal;}
#ai-dlya-reklamy-boris-block .bar-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:16px;}
#ai-dlya-reklamy-boris-block .bar-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;}
#ai-dlya-reklamy-boris-block .bar-pl-g{background:rgba(34,197,94,.1);color:#15803d;border:1px solid rgba(34,197,94,.25);}
#ai-dlya-reklamy-boris-block .bar-pl-b{background:rgba(14,165,233,.1);color:#0369a1;border:1px solid rgba(14,165,233,.25);}
#ai-dlya-reklamy-boris-block .bar-pl-v{background:rgba(139,92,246,.1);color:#6d28d9;border:1px solid rgba(139,92,246,.25);}
#ai-dlya-reklamy-boris-block .bar-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#ai-dlya-reklamy-boris-block .bar-rgt{position:relative;background:linear-gradient(135deg,#eef2ff,#e0f2fe 50%,#f0fdf4);min-height:400px;}
#adr-reklamy-pipeline-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}

</style>

<div class="adr-content">

  <section class="adr-intro" id="intro" aria-label="Введение">
    <div class="adr-cnt">
      <div class="adr-intro-grid nero-ai-reveal">
        <div class="adr-intro-text">
          <p class="adr-eyebrow">Лонгрид · ai для рекламы</p>
          <p><strong>Коротко:</strong> AI для рекламы — это не одна нейросеть, а связка встроенных инструментов площадок (Яндекс Директ, VK Реклама, myTarget) и внешней автоматизации (LLM + Make/n8n + API + CRM), которая снимает рутину с performance-команды: гипотезы, объявления, аудитории, отчёты. Человек задаёт стратегию и утверждает публикации; AI ускоряет цикл тестов.</p>
        </div>
        <div class="adr-intro-kpi" aria-label="Ключевые показатели рынка">
          <div class="adr-kpi-card"><div class="kv">90%</div><div class="kl">маркетологов Директа используют ИИ</div><div class="ks">Яндекс REKONFA 2025</div></div>
          <div class="adr-kpi-card"><div class="kv">$9,8 млрд</div><div class="kl">рынок AI-рекламы в 2026</div><div class="ks">+133% г/г</div></div>
          <div class="adr-kpi-card"><div class="kv">150–800К</div><div class="kl">ориентир внедрения под ключ</div><div class="ks">Nero Network</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="adr-toc-outer">
    <div class="adr-cnt">
      <nav class="adr-toc" aria-label="Оглавление статьи">
        <a href="#zachem-ai-v-reklame">Зачем AI</a>
        <a href="#vnedrenie-pod-klyuch">Внедрение</a>
        <a href="#generaciya-obuyavlenij">Креативы</a>
        <a href="#ai-auditorii-gipotezy">Аудитории</a>
        <a href="#otchety-analitika">Отчёты</a>
        <a href="#tipovoy-stek">Стек</a>
        <a href="#riski-vnedreniya">Риски</a>
        <a href="#keisy-roi">Кейсы</a>
        <a href="#faq">FAQ</a>
        <a href="#avtomatizirovat-reklamu">Заявка</a>
      </nav>
    </div>
  </div>

  <p class="adr-def" style="max-width:820px;margin:0 auto 24px;text-align:center;font-size:14.5px">Performance-реклама — часть общей картины <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/">масштабного внедрения AI в бизнес</a>: те же принципы governed autonomy и human-in-the-loop работают и в CRM, и в рекламных кабинетах.</p>

  <section class="adr-section" id="zachem-ai-v-reklame">
    <div class="adr-cnt">
      <div class="adr-sh adr-left nero-ai-reveal">
        <span class="adr-eyebrow">Лонгрид · ai для рекламы</span>
        <h2>Зачем маркетологам и агентствам AI в контексте и таргете</h2>
        <p class="adr-def"><strong>Определение:</strong> AI для контекстной и таргетированной рекламы — технологии, которые автоматизируют повторяющиеся задачи performance-маркетинга: генерацию гипотез, текстов и креативов, подбор аудиторий, сводные отчёты и сквозную аналитику между рекламными кабинетами и CRM.</p>
        <p>Если вы ведёте Директ, VK Ads, myTarget или e-commerce-кампании, <strong>ai для рекламы</strong> уже не «эксперимент на полчаса в чате». По данным Яндекс Рекламы (REKONFA 2025), <strong>90%</strong> маркетологов Директа используют ИИ-инструменты, <strong>56%</strong> — ежедневно. Рынок AI-рекламы в 2026 году оценивается в <strong>$9,8 млрд</strong> (+133% г/г), а <strong>68%</strong> CMO планируют выделить на это отдельный бюджет.</p>
      </div>
      <div class="adr-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="adr-card" id="gde-teryayut-chasy">
          <h3>Где performance-команда теряет часы каждую неделю</h3>
          <ul>
            <li><strong>Креативы:</strong> десятки вариантов заголовков и баннеров под каждый сегмент</li>
            <li><strong>Гипотезы:</strong> идеи в Excel; цикл «гипотеза → запуск → вывод» растягивается на недели</li>
            <li><strong>Отчёты:</strong> ночные сводки по Директу, VK, Метрике и CRM</li>
            <li><strong>Разрозненные кабинеты:</strong> UTM, атрибуция и look-alike вручную</li>
          </ul>
          <p class="adr-short"><strong>Итог:</strong> команда тратит FTE на рутину, а не на стратегию.</p>
        </div>
        <div class="adr-card" id="chto-avtomatizirovat">
          <h3>Что можно автоматизировать без потери контроля</h3>
          <div class="adr-table-wrap">
            <table class="adr-table" aria-label="Два слоя AI">
              <thead><tr><th>Слой</th><th>Что делает</th><th>Примеры</th></tr></thead>
              <tbody>
                <tr><td><strong>Встроенный AI площадки</strong></td><td>Оптимизация в кабинете</td><td>Нейрообъявления Директа (+17%), ARGUS, Креативная студия VK</td></tr>
                <tr><td><strong>Внешняя автоматизация</strong></td><td>Процессы между системами</td><td>Гипотезы, черновики, UTM, сводки, <a href="/vnedrenie-ai-amocrm/">amoCRM</a>/Bitrix24</td></tr>
              </tbody>
            </table>
          </div>
          <p class="adr-short"><strong>Коротко:</strong> AI берёт черновую работу; стратегию и финальное одобрение оставляем специалисту.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="adr-section adr-section-alt" id="vnedrenie-pod-klyuch">
    <div class="adr-cnt">
      <div class="adr-sh adr-left nero-ai-reveal">
        <span class="adr-eyebrow">Внедрение под ключ</span>
        <h2>Внедрение AI для рекламы под ключ: этапы, сроки, результат</h2>
        <p class="adr-def"><strong>Определение:</strong> <strong>Внедрение ai для рекламы</strong> под ключ — проект от аудита рутины до связки «рекламные кабинеты → данные → LLM → approval → отчёт» с обучением команды.</p>
      </div>

      <div class="adr-card nero-ai-reveal" id="audit-reklamnoj-rutiny" style="margin-bottom:24px">
        <h3>Аудит рекламной рутины — с чего начинаем</h3>
        <p><strong>Лид-магнит:</strong> «Аудит рекламной рутины» — вход в воронку без обязательства на полный проект.</p>
        <ol style="padding-left:1.2em;color:var(--adr-muted);font-size:14.5px;line-height:1.7">
          <li>Карта задач: сколько часов уходит на креативы, отчёты, гипотезы, UTM, сверку с CRM</li>
          <li>Приоритет автоматизации: максимум скорости тестов при минимальном риске</li>
          <li>Черновая смета <strong>внедрения ai для рекламы</strong> в коридоре <strong>150–800 тыс. ₽</strong></li>
        </ol>
      </div>

      <div class="adr-card nero-ai-reveal" id="nastroyka-ai-kanaly" style="margin-bottom:24px">
        <h3>Настройка AI под Директ, VK Ads, myTarget и e-commerce</h3>
        <div class="adr-table-wrap">
          <table class="adr-table" aria-label="Этапы внедрения">
            <thead><tr><th>Этап</th><th>Срок</th><th>Содержание</th></tr></thead>
            <tbody>
              <tr><td>1. Аудит</td><td>3–5 дней</td><td>Карта рутины, доступы, brand book</td></tr>
              <tr><td>2. Проектирование стека</td><td>5–7 дней</td><td>Что в кабинете, что во внешней автоматизации</td></tr>
              <tr><td>3. Пилот на 1–2 каналах</td><td>2–4 недели</td><td>Директ или VK; измеримые KPI</td></tr>
              <tr><td>4. Масштабирование</td><td>2–4 недели</td><td>Шаблоны гипотез, библиотека промптов, дашборд</td></tr>
              <tr><td>5. Обучение + сопровождение</td><td>30 дней</td><td>Регламент модерации, передача команде</td></tr>
            </tbody>
          </table>
        </div>
        <p style="margin-top:14px;font-size:14.5px"><strong>AI для яндекс директ:</strong> нейрообъявления в ЕПК, API v5, ИИ-помощник «Простой старт». <strong>AI vk реклама:</strong> Креативная студия, ИИ-редактор текстов. Для e-commerce — product-фиды и модульные креативы.</p>
      </div>

      <div class="adr-card nero-ai-reveal" id="orientir-po-budgetu">
        <h3>Ориентир по бюджету: 150–800 тыс. ₽ и что входит в работу</h3>
        <div class="adr-table-wrap">
          <table class="adr-table" aria-label="Пакеты цен">
            <thead><tr><th>Пакет</th><th>Ориентир</th><th>Что входит</th></tr></thead>
            <tbody>
              <tr><td><strong>Старт</strong></td><td>от 150 000 ₽</td><td>Аудит + пилот на одном канале + базовые AI-сводки</td></tr>
              <tr><td><strong>Стандарт</strong></td><td>350–500 тыс. ₽</td><td>2 канала, CRM, Make/n8n, библиотека промптов</td></tr>
              <tr><td><strong>Расширенный</strong></td><td>до 800 000 ₽</td><td>Мультибренд, сквозная аналитика, кастомные дашборды</td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="adr-cnt">
<aside class="ym-cta-block ym-cta-block--primary" id="cta-audit-rutiny">
  <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Получите аудит рекламной рутины</p>
    <p class="ym-cta-block__sub">За 3–5 дней покажем, где AI снимет часы с команды и сколько стоит пилот под ваши каналы в Директе, VK Ads и e-commerce.</p>
    <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn" <?php echo $primary_cta_attrs; ?>>Автоматизировать рекламу</a>
  </div>
</aside>
</div>
    </div>
  </section>


<section id="ai-dlya-reklamy-boris-block" class="bar-root" aria-label="Анимация: performance-пайплайн AI для рекламы — от данных кабинетов до approval и запуска">
  <div class="bar-cnt">
    <div class="bar-card">
      <div class="bar-lft">
        <span class="bar-ey">Внешний слой · Make/n8n + LLM</span>
        <h3 class="bar-h3">Мост между кабинетами и командой: гипотеза → черновик → approval → запуск</h3>
        <ul class="bar-ul">
          <li><span class="bar-ic">1</span>Данные Директа, VK Ads и Метрики стекаются в единое хранилище</li>
          <li><span class="bar-ic">2</span>LLM генерирует гипотезы и черновики объявлений по brand book</li>
          <li><span class="bar-ic">3</span>Approval gate: в кабинет уходит только утверждённое маркетологом</li>
          <li><span class="bar-ic">↻</span>Еженедельная AI-сводка закрывает цикл «тест → вывод → новая гипотеза»</li>
        </ul>
        <div class="bar-pills">
          <span class="bar-pl bar-pl-g">4 ч → 12 мин отчёт</span>
          <span class="bar-pl bar-pl-b">8–12 гипотез/мес</span>
          <span class="bar-pl bar-pl-v">governed autonomy</span>
        </div>
        <p class="bar-foot">Дальше разберём генерацию объявлений и креативов нейросетями →</p>
      </div>
      <div class="bar-rgt">
        <canvas id="adr-reklamy-pipeline-canvas" role="img" aria-label="Анимация performance-пайплайна: пакеты данных из Директа и VK проходят через LLM-хаб, approval gate и запуск в рекламный кабинет"></canvas>
      </div>
    </div>
  </div>
</section>


  <section class="adr-section" id="generaciya-obuyavlenij">
    <div class="adr-cnt">
      <div class="adr-sh adr-left nero-ai-reveal">
        <span class="adr-eyebrow">Креативы</span>
        <h2>Генерация объявлений и креативов нейросетями</h2>
        <p class="adr-def"><strong>Определение:</strong> <strong>Генерация объявлений нейросеть</strong> — тексты и визуалы под правила площадки и brand guidelines с human-in-the-loop перед модерацией.</p>
      </div>
      <div class="adr-card nero-ai-reveal" id="teksty-kontekst" style="margin-bottom:20px">
        <h3>Тексты и заголовки для контекстных кампаний</h3>
        <p>Для <strong>ai контекстная реклама</strong> LLM генерирует пакеты заголовков, УТП под сегменты и A/B-гипотезы. Нейрообъявления Директа в среднем дают <strong>+17%</strong> конверсий.</p>
        <p><strong>Чеклист перед запуском нейрообъявлений:</strong></p>
        <ul class="adr-checklist">
          <li>Цели и конверсии настроены в Метрике</li>
          <li>Посадочные соответствуют офферу в объявлении</li>
          <li>Brand book и стоп-слова загружены в промпт-шаблон</li>
          <li>Человек проверил юридически значимые формулировки</li>
          <li>Запланирован A/B с «ручным» контролем</li>
        </ul>
      </div>
      <div class="adr-card nero-ai-reveal" id="kreativy-target" style="margin-bottom:20px">
        <h3>Креативы и варианты для таргета и product-фидов</h3>
        <p>Кейс <strong>Monarch + VK Реклама</strong>: ИИ-креативы по сегментам — <strong>CR в корзину ×5</strong>, <strong>CPM −22%</strong>. Портфель <strong>ipos.digital</strong>: лиды с нейрообъявлений <strong>+164%</strong>, общее число лидов <strong>×2</strong>.</p>
      </div>
      <div class="adr-card nero-ai-reveal" id="kontrol-kachestva">
        <h3>Контроль качества: модерация, тон бренда, A/B-тесты</h3>
        <ul>
          <li><strong>approval gate:</strong> AI не публикует без статуса «утверждено»</li>
          <li>ИИ-редактор VK для проверки правил площадки</li>
          <li>Чеклист brand safety и история версий креатива</li>
        </ul>
        <p class="adr-short"><strong>Итог блока:</strong> <strong>ai реклама</strong> ускоряет производство креативов; качество остаётся зоной ответственности маркетолога.</p>
      </div>
    </div>
  </section>

  <section class="adr-section adr-section-alt" id="ai-auditorii-gipotezy">
    <div class="adr-cnt">
      <div class="adr-sh adr-left nero-ai-reveal">
        <span class="adr-eyebrow">Гипотезы</span>
        <h2>AI-аудитории, гипотезы и тесты вместо ручного Excel</h2>
        <p class="adr-def"><strong>Определение:</strong> <strong>Ai аудитории реклама</strong> — сегменты, look-alike и гипотезы на основе данных кампаний, CRM и first-party data.</p>
      </div>
      <div class="adr-grid-2 nero-ai-reveal" style="margin-top:24px">
        <div class="adr-card" id="segmenty-lookalike">
          <h3>Сегменты, look-alike и гипотезы по каналам</h3>
          <p>ARGUS (апрель 2026): окно анализа до <strong>1 года</strong> и до <strong>8 000</strong> событий. Кейс <strong>Андата + ВСК</strong>: <strong>+80%</strong> заявок, <strong>−10%</strong> CPA.</p>
        </div>
        <div class="adr-card" id="cikl-gipoteza-zapusk">
          <h3>Как ускорить цикл «гипотеза → запуск → вывод»</h3>
          <ol style="padding-left:1.2em;color:var(--adr-muted);font-size:14px;line-height:1.7">
            <li>Понедельник: AI-сводка + 3 новые гипотезы</li>
            <li>Вторник–среда: утверждение, черновики объявлений</li>
            <li>Четверг: запуск после approval</li>
            <li>Следующий понедельник: автоматический вывод</li>
          </ol>
          <p class="adr-short"><strong>Коротко:</strong> <strong>внедрение нейросетей</strong> в гипотезы сокращает время между идеей и результатом.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="adr-section" id="otchety-analitika">
    <div class="adr-cnt">
      <div class="adr-sh adr-left nero-ai-reveal">
        <span class="adr-eyebrow">Аналитика</span>
        <h2>Отчёты и аналитика рекламы с AI</h2>
        <p class="adr-def"><strong>Определение:</strong> <strong>Отчёты по рекламе ai</strong> — сводки из API кабинетов, Метрики и CRM с объяснением аномалий и рекомендациями.</p>
      </div>
      <div class="adr-grid-2 nero-ai-reveal" style="margin-top:24px">
        <div class="adr-card" id="svodki-klientam">
          <h3>Сводки для клиентов, руководства и in-house-команд</h3>
          <ul>
            <li>Данные Директ + VK + Метрика + CRM в единое хранилище</li>
            <li>LLM формирует executive summary на 1 страницу</li>
            <li>Выделяет аномалии и предлагает 3 действия с приоритетом</li>
          </ul>
        </div>
        <div class="adr-card" id="utm-atribuciya">
          <h3>UTM, атрибуция и дашборды без ночных сводок</h3>
          <p>AI-модуль готовит шаблоны разметки, проверяет дубли и несоответствия с CRM. Для лидов из почты смежный сценарий — <a href="/vnedrenie-ai-obrabotka-email-crm/">AI-обработка входящей почты в CRM</a>. Схема выгрузки Директ + VK через n8n встраивается в проект Nero Network.</p>
          <p class="adr-short"><strong>Итог:</strong> время на еженедельную сводку — с часов до минут.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="adr-section adr-section-alt" id="tipovoy-stek">
    <div class="adr-cnt">
      <div class="adr-sh adr-left nero-ai-reveal">
        <span class="adr-eyebrow">Стек Nero Network</span>
        <h2>Типовой стек: LLM, Make/n8n и API рекламных кабинетов</h2>
        <p class="adr-def"><strong>Определение:</strong> <strong>Внедрение ai в бизнес</strong> для рекламы — архитектура «данные → оркестратор → LLM → approval → действие».</p>
      </div>
      <div class="adr-card nero-ai-reveal" id="svyazka-crm" style="margin:24px 0">
        <div class="adr-table-wrap">
          <table class="adr-table" aria-label="Компоненты стека">
            <thead><tr><th>Компонент</th><th>Роль</th></tr></thead>
            <tbody>
              <tr><td>Яндекс Директ API v5, VK Ads API</td><td>Выгрузка статистики, статусы кампаний</td></tr>
              <tr><td>Яндекс Метрика, AppMetrica</td><td>Конверсии, атрибуция</td></tr>
              <tr><td>amoCRM, Bitrix24</td><td>Лиды, сквозная воронка</td></tr>
              <tr><td>Make.com / n8n</td><td>Оркестрация сценариев</td></tr>
              <tr><td>YandexGPT / Claude / OpenAI</td><td>Генерация текстов, гипотез, сводок</td></tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="adr-card nero-ai-reveal" id="chelovek-vs-ai">
        <h3>Что остаётся у специалиста, а что делает агент</h3>
        <div class="adr-table-wrap">
          <table class="adr-table" aria-label="AI vs человек">
            <thead><tr><th>Делает AI</th><th>Остаётся человеку</th></tr></thead>
            <tbody>
              <tr><td>Черновики объявлений и брифов</td><td>Стратегия и позиционирование</td></tr>
              <tr><td>Предложения сегментов по данным</td><td>Бюджетные лимиты и стоп-краны</td></tr>
              <tr><td>Еженедельные сводки</td><td>Юридически значимые формулировки</td></tr>
              <tr><td>UTM-шаблоны и таблицы тестов</td><td>Финальное одобрение до модерации</td></tr>
            </tbody>
          </table>
        </div>
        <div class="adr-table-wrap" style="margin-top:20px">
          <table class="adr-table" aria-label="Встроенный AI vs Nero Network">
            <thead><tr><th>Задача</th><th>Только кабинет</th><th>+ Nero Network</th></tr></thead>
            <tbody>
              <tr><td>Нейрообъявления, автостратегии</td><td>✓</td><td>✓ + контроль и A/B</td></tr>
              <tr><td>Сквозные отчёты Директ + VK + CRM</td><td>✗</td><td>✓</td></tr>
              <tr><td>Библиотека гипотез с историей</td><td>✗</td><td>✓</td></tr>
              <tr><td>Approval и brand safety</td><td>частично</td><td>✓ полный контур</td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <p style="font-size:14.5px;margin-top:16px">Когда рекламные лиды уходят в учёт и документооборот, полезен соседний контур: <a href="/ai-1c-erp/">AI-агент для 1С и ERP под ключ</a> — заявки, счета и заказы без двойного ввода между CRM и ERP.</p>

<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Хотите разобраться в AI-автоматизации рекламы сами?</p>
    <p class="ym-cta-block__sub">Если команда хочет понимать Make/n8n, промпты и human-in-the-loop до старта проекта — посмотрите <a href="<?php echo esc_url( $secondary_cta_url ); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $secondary_cta_label ); ?></a>. Это ускоряет согласование сценариев на этапе пилота.</p>
  </div>
</aside>

    </div>
  </section>

  <section class="adr-section" id="riski-vnedreniya">
    <div class="adr-cnt">
      <div class="adr-sh adr-left nero-ai-reveal">
        <span class="adr-eyebrow">E-E-A-T</span>
        <h2>Риски внедрения AI в рекламу: модерация, галлюцинации, персональные данные</h2>
      </div>
      <div class="adr-grid-2 nero-ai-reveal" style="margin-top:24px">
        <div class="adr-card" id="snizhaem-galлюcinacii">
          <h3>Как снижаем ошибки в текстах объявлений</h3>
          <ul>
            <li>Human-in-the-loop на каждом креативе</li>
            <li>Brand book и стоп-слова в системном промпте</li>
            <li>Чеклист модерации и ИИ-редактор VK</li>
          </ul>
        </div>
        <div class="adr-card" id="zavisimost-api">
          <h3>Зависимость от API и политики площадок</h3>
          <ul>
            <li>Мониторинг OAuth-токенов и ротация ключей</li>
            <li>Резервные сценарии при недоступности API</li>
            <li>Обезличивание в промптах, YandexGPT при compliance</li>
          </ul>
          <p class="adr-short"><strong>Итог:</strong> проектируем <strong>governed autonomy</strong> — AI действует в рамках правил команды.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="adr-section adr-section-alt" id="keisy-roi">
    <div class="adr-cnt">
      <div class="adr-sh adr-left nero-ai-reveal">
        <span class="adr-eyebrow">Кейсы</span>
        <h2>Кейсы и ROI: когда AI для рекламы окупается</h2>
      </div>
      <div class="nero-ai-reveal" id="scenarii-keisy" style="margin-top:24px">
        <div class="adr-case"><h4>1. Андата + ВСК (страхование, Директ)</h4><p>Нейрооптимизация ставок: <strong>+80%</strong> заявок, <strong>−10%</strong> CPA. Источник: workspace.ru</p></div>
        <div class="adr-case"><h4>2. 1PS.RU (e-commerce)</h4><p>CPL <strong>587 ₽</strong> (−35%), <strong>222</strong> покупки за 30 дней, выручка <strong>~3 млн ₽</strong>.</p></div>
        <div class="adr-case"><h4>3. ipos.digital — ветклиника</h4><p>Лиды <strong>×2</strong>, с нейрообъявлений <strong>+164%</strong>, записи <strong>+62%</strong>.</p></div>
        <div class="adr-case"><h4>4. Monarch + VK (e-commerce)</h4><p>CR в корзину <strong>×5</strong>, CPM <strong>−22%</strong>.</p></div>
      </div>
      <div class="adr-card nero-ai-reveal" id="metriki-do-posle" style="margin-top:24px">
        <div class="adr-table-wrap">
          <table class="adr-table" aria-label="Метрики до и после">
            <thead><tr><th>Метрика</th><th>До</th><th>После (типовой пилот)</th></tr></thead>
            <tbody>
              <tr><td>Время на еженедельный отчёт</td><td>3–6 часов</td><td>15–30 минут</td></tr>
              <tr><td>Гипотез в месяц</td><td>2–4</td><td>8–12 при том же FTE</td></tr>
              <tr><td>CPL / CR</td><td>базовая линия</td><td>−10…−35% CPL в кейсах</td></tr>
            </tbody>
          </table>
        </div>
        <p style="margin-top:14px">Пилот от <strong>150 000 ₽</strong> окупается, если рутина съедает ≥0,3–0,5 FTE специалиста в месяц.</p>
      </div>
      
<aside class="ym-cta-block ym-cta-block--dual" id="cta-keisy">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Хотите такие же цифры в своей нише?</p>
    <p class="ym-cta-block__sub">Разберём ваши каналы на аудите и спроектируем пилот с KPI, которые можно измерить через 2–4 недели.</p>
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" <?php echo $primary_cta_attrs; ?>>Автоматизировать рекламу</a>
      <a href="#vnedrenie-pod-klyuch" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения</a>
    </div>
  </div>
</aside>

    </div>
  </section>

  <section class="adr-section" id="faq">
    <div class="adr-cnt">
      <div class="adr-sh nero-ai-reveal">
        <span class="adr-eyebrow">FAQ</span>
        <h2>Как внедрить, сколько стоит, что получите на выходе</h2>
      </div>
      <div class="adr-faq nero-ai-reveal">
        <div class="adr-faq-item" id="faq-kak-vnedrit">
          <div class="adr-faq-q" tabindex="0" role="button">Как внедрить AI для рекламы в существующие процессы?</div>
          <div class="adr-faq-a"><p><strong>Короткий ответ:</strong> аудит рутины → пилот на одном канале → масштабирование на CRM и отчёты. AI-контур работает параллельно с текущим агентством.</p></div>
        </div>
        <div class="adr-faq-item" id="faq-skolko-stoit">
          <div class="adr-faq-q" tabindex="0" role="button">Сколько стоит AI для рекламы?</div>
          <div class="adr-faq-a"><p><strong>Короткий ответ:</strong> <strong>150–800 тыс. ₽</strong> в зависимости от каналов, CRM и кастомных отчётов. Один FTE middle performance — <strong>120–200 тыс. ₽/мес</strong> только на зарплату.</p></div>
        </div>
        <div class="adr-faq-item" id="faq-primery-zadach">
          <div class="adr-faq-q" tabindex="0" role="button">Примеры задач, которые закрывают кейсы внедрения</div>
          <div class="adr-faq-a"><p>Агентство: единый AI-отчёт для 10+ клиентов. E-commerce: модульные креативы (модель 1PS.RU). Услуги: преодоление стагнации лидов (ветклиника ipos.digital).</p></div>
        </div>
        <div class="adr-faq-item" id="faq-chto-takoe">
          <div class="adr-faq-q" tabindex="0" role="button">Что такое AI для рекламы простыми словами?</div>
          <div class="adr-faq-a"><p>Автоматизация рутины performance-маркетинга: тексты, креативы, гипотезы, аудитории, отчёты — с человеческим контролем на публикации и бюджетах.</p></div>
        </div>
        <div class="adr-faq-item" id="faq-podryadchik">
          <div class="adr-faq-q" tabindex="0" role="button">Совместимо ли с текущим подрядчиком?</div>
          <div class="adr-faq-a"><p>Да. Мы настраиваем процессы и интеграции; медиабаинг может оставаться у агентства. AI снимает операционку.</p></div>
        </div>
        <div class="adr-faq-item" id="faq-moderaciya">
          <div class="adr-faq-q" tabindex="0" role="button">Боюсь бана и модерации — что делать?</div>
          <div class="adr-faq-a"><p>Approval gate, чеклисты, ИИ-редактор VK, ручная проверка юридических формулировок. В кабинет уходит только утверждённое.</p></div>
        </div>
      </div>
    </div>
  </section>


<section class="adr-section" id="avtomatizirovat-reklamu">
  <div class="adr-cnt" style="text-align:center;">
    <span class="adr-eyebrow">Следующий шаг</span>
    <h2 style="font-size:clamp(28px,4.2vw,48px);max-width:720px;margin:14px auto 16px;">Автоматизировать рекламу</h2>
    <p style="max-width:580px;margin:0 auto 20px;font-size:16px;"><strong>AI для рекламы под ключ</strong> — операционная система performance-команды: Директ и VK дают встроенный AI, Nero Network связывает их с CRM, отчётами и гипотезами через LLM и Make/n8n.</p>
    <ul class="adr-cta-checklist">
      <li>Аудит рекламной рутины</li>
      <li>Пилот на 1–2 каналах</li>
      <li>30 дней сопровождения</li>
    </ul>
    <aside class="ym-cta-block ym-cta-block--dual" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Автоматизировать рекламу</p>
        <p class="ym-cta-block__sub">Оставьте заявку на аудит рекламной рутины — покажем, где AI снимет рутину и сколько стоит внедрение под ваши каналы.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" <?php echo $primary_cta_attrs; ?>>Автоматизировать рекламу</a>
          <a href="#audit-reklamnoj-rutiny" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Получить аудит рутины</a>
        </div>
      </div>
    </aside>
  </div>
</section>


</div><!-- /.adr-content -->

<script>

(function(){
  'use strict';
  var cv = document.getElementById('adr-reklamy-pipeline-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d'), W = 0, H = 0, frame = 0;
  function resize(){
    var p = cv.parentElement; if (!p) return;
    cv.width = p.clientWidth || 640; cv.height = p.clientHeight || 460;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize); resize();
  var C = {muted:'#64748b',text:'#1e293b',direct:'#fc3f1d',vk:'#0077ff',ai:'#8b5cf6',aiGlow:'rgba(139,92,246,.22)',hypo:'#22c55e',draft:'#f59e0b',ok:'#0ea5e9',line:'rgba(14,165,233,.3)',card:'#fff'};
  function rr(x,y,w,h,r,fill,stroke){ctx.beginPath();if(ctx.roundRect)ctx.roundRect(x,y,w,h,r);else ctx.rect(x,y,w,h);if(fill){ctx.fillStyle=fill;ctx.fill();}if(stroke){ctx.strokeStyle=stroke;ctx.lineWidth=1.5;ctx.stroke();}}
  var packets=[], creatives=[];
  function spawnPacket(){packets.push({x:24,y:H*0.18+Math.random()*H*0.55,src:Math.random()>0.45?'vk':'direct',speed:1.4+Math.random()*0.8});}
  function spawnCreative(hx,hy){creatives.push({x:hx,y:hy,t:0,alpha:0,approved:false,launch:false});}
  function drawHub(cx,cy,r,pulse){
    var g=ctx.createRadialGradient(cx,cy,0,cx,cy,r*2);g.addColorStop(0,C.aiGlow);g.addColorStop(1,'rgba(139,92,246,0)');
    ctx.fillStyle=g;ctx.beginPath();ctx.arc(cx,cy,r*1.8,0,Math.PI*2);ctx.fill();
    rr(cx-r,cy-r,r*2,r*2,r*0.4,'#f5f3ff',C.ai);
    ctx.fillStyle=C.ai;ctx.font='bold '+Math.max(12,r*0.24)+'px system-ui,sans-serif';ctx.textAlign='center';ctx.textBaseline='middle';
    ctx.fillText('LLM',cx,cy-4);ctx.font=Math.max(9,r*0.15)+'px system-ui,sans-serif';ctx.fillStyle=C.muted;ctx.fillText('гипотезы + черновики',cx,cy+r*0.42);
    ctx.strokeStyle=C.ai;ctx.lineWidth=2+pulse*2;ctx.globalAlpha=0.25+pulse*0.35;ctx.beginPath();ctx.arc(cx,cy,r+8+pulse*6,0,Math.PI*2);ctx.stroke();ctx.globalAlpha=1;
  }
  function tick(){
    frame++; if(frame%85===0) spawnPacket();
    var hubX=W*0.46,hubY=H*0.5,hubR=Math.min(W,H)*0.085,pulse=0.5+0.5*Math.sin(frame*0.07),gateOpen=Math.sin(frame*0.03)>0.2;
    ctx.clearRect(0,0,W,H);
    ctx.fillStyle=C.muted;ctx.font='10px system-ui,sans-serif';ctx.textAlign='left';ctx.fillText('Директ / VK Ads / Метрика',16,18);
    ['Директ API','VK Ads','CRM'].forEach(function(lbl,i){var ly=H*0.16+i*H*0.24;ctx.strokeStyle=C.line;ctx.setLineDash([4,6]);ctx.beginPath();ctx.moveTo(20,ly);ctx.lineTo(W*0.3,ly);ctx.stroke();ctx.setLineDash([]);ctx.fillStyle=i===0?C.direct:(i===1?C.vk:C.muted);ctx.fillText(lbl,24,ly-6);});
    drawHub(hubX,hubY,hubR,pulse);
    packets.forEach(function(p){p.x+=p.speed;if(p.x>hubX-hubR&&p.x<hubX+hubR+20&&Math.random()<0.025)spawnCreative(hubX+hubR,hubY);var col=p.src==='vk'?C.vk:C.direct;rr(p.x-14,p.y-10,28,20,4,C.card,col);ctx.fillStyle=col;ctx.font='bold 9px system-ui,sans-serif';ctx.textAlign='center';ctx.fillText(p.src==='vk'?'VK':'YD',p.x,p.y+3);if(p.x>W+40)p.dead=true;});
    packets=packets.filter(function(p){return !p.dead;});
    creatives.forEach(function(c){if(!c.approved){if(c.t<1){c.t+=0.02;c.alpha=Math.min(1,c.t*1.3);}c.x+=(W*0.6-c.x)*0.04;c.y+=(H*0.42-c.y)*0.04;if(gateOpen&&c.t>0.7)c.approved=true;}else if(!c.launch){c.x+=1.2;c.y=H*0.55;if(c.x>W*0.78)c.launch=true;}ctx.globalAlpha=c.alpha||1;rr(c.x-24,c.y-11,48,22,5,'#fff',c.approved?C.ok:C.draft);ctx.fillStyle=C.text;ctx.font='9px system-ui,sans-serif';ctx.textAlign='center';ctx.fillText(c.approved?(c.launch?'в кабинет':'утвержд.'):'черновик',c.x,c.y+4);ctx.globalAlpha=1;});
    if(creatives.length>6)creatives.shift();
    rr(W*0.6,H*0.36,90,40,8,'rgba(255,255,255,.95)',gateOpen?C.ok:'#94a3b8');
    ctx.fillStyle=gateOpen?C.ok:C.muted;ctx.font='bold 11px system-ui,sans-serif';ctx.textAlign='center';ctx.fillText('APPROVAL',W*0.6+45,H*0.36+18);
    rr(W*0.82,H*0.5,70,34,8,C.hypo,'#16a34a');ctx.fillStyle='#fff';ctx.font='bold 11px system-ui,sans-serif';ctx.fillText('ЗАПУСК',W*0.82+35,H*0.5+21);
    [['12 гипотез','#dcfce7','#15803d'],['48 креат.','#e0f2fe','#0369a1'],['CPL -18%','#f3e8ff','#6d28d9']].forEach(function(pl,i){rr(14+i*88,H*0.84,80,20,10,pl[1],pl[2]);ctx.fillStyle=pl[2];ctx.font='bold 9px system-ui,sans-serif';ctx.textAlign='center';ctx.fillText(pl[0],54+i*88,H*0.84+13);});
    requestAnimationFrame(tick);
  }
  tick();
})();

</script>
<script>
(function(){
  document.querySelectorAll('.adr-faq-q').forEach(function(btn){
    btn.addEventListener('click',function(){
      var item=btn.closest('.adr-faq-item');
      var open=item.classList.contains('open');
      document.querySelectorAll('.adr-faq-item.open').forEach(function(el){el.classList.remove('open');});
      if(!open) item.classList.add('open');
    });
  });
})();
</script>


<?php
$adr_schema_home = untrailingslashit( home_url() );
$adr_schema_page = untrailingslashit( get_permalink() );
$adr_schema_graph = [
	'@context' => 'https://schema.org',
	'@graph'    => [
		[
			'@type' => 'Organization',
			'@id'   => $adr_schema_home . '/#organization',
			'name'  => 'Nero Network',
			'url'   => $adr_schema_home,
		],
		[
			'@type'     => 'WebSite',
			'@id'       => $adr_schema_home . '/#website',
			'url'       => $adr_schema_home,
			'name'      => 'Nero Network',
			'publisher' => [ '@id' => $adr_schema_home . '/#organization' ],
		],
		[
			'@type'       => 'WebPage',
			'@id'         => $adr_schema_page . '/#webpage',
			'url'         => trailingslashit( $adr_schema_page ),
			'name'        => 'AI для контекстной и таргетированной рекламы: внедрение под ключ',
			'description' => $page_seo_description,
			'isPartOf'    => [ '@id' => $adr_schema_home . '/#website' ],
			'about'       => [ '@id' => $adr_schema_home . '/#organization' ],
		],
		[
			'@type'           => 'BreadcrumbList',
			'@id'             => $adr_schema_page . '/#breadcrumb',
			'itemListElement' => [
				[ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $adr_schema_home ],
				[ '@type' => 'ListItem', 'position' => 2, 'name' => 'AI для контекстной и таргетированной рекламы: внедрение под ключ', 'item' => trailingslashit( $adr_schema_page ) ],
			],
		],
		[
			'@type'        => 'Service',
			'@id'          => $adr_schema_page . '/#service',
			'name'         => 'AI для контекстной и таргетированной рекламы: внедрение под ключ',
			'description'  => $page_seo_description,
			'url'          => trailingslashit( $adr_schema_page ),
			'provider'     => [ '@id' => $adr_schema_home . '/#organization' ],
		],
		[
			'@type'      => 'FAQPage',
			'@id'        => $adr_schema_page . '/#faq',
			'mainEntity' => [
				[ '@type' => 'Question', 'name' => 'Как внедрить AI для рекламы в существующие процессы?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Короткий ответ: аудит рутины → пилот на одном канале → масштабирование на CRM и отчёты. AI-контур работает параллельно с текущим агентством.' ] ],
				[ '@type' => 'Question', 'name' => 'Сколько стоит AI для рекламы?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => '150–800 тыс. ₽ в зависимости от каналов, CRM и кастомных отчётов. Один FTE middle performance — 120–200 тыс. ₽/мес только на зарплату.' ] ],
				[ '@type' => 'Question', 'name' => 'Примеры задач, которые закрывают кейсы внедрения', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Агентство: единый AI-отчёт для 10+ клиентов. E-commerce: модульные креативы (модель 1PS.RU). Услуги: преодоление стагнации лидов (ветклиника ipos.digital).' ] ],
				[ '@type' => 'Question', 'name' => 'Что такое AI для рекламы простыми словами?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Автоматизация рутины performance-маркетинга: тексты, креативы, гипотезы, аудитории, отчёты — с человеческим контролем на публикации и бюджетах.' ] ],
				[ '@type' => 'Question', 'name' => 'Совместимо ли с текущим подрядчиком?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да. Мы настраиваем процессы и интеграции; медиабаинг может оставаться у агентства. AI снимает операционку.' ] ],
				[ '@type' => 'Question', 'name' => 'Боюсь бана и модерации — что делать?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Approval gate, чеклисты, ИИ-редактор VK, ручная проверка юридических формулировок. В кабинет уходит только утверждённое.' ] ],
			],
		],
	],
];
?>
<script type="application/ld+json"><?php echo wp_json_encode( $adr_schema_graph, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?></script>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

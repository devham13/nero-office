<?php
/**
 * Template Name: MVP AI-решения для бизнеса: разработка и внедрение под ключ
 * Description: Разработка и внедрение MVP AI-решений для бизнеса за 2–4 недели: AI-агенты, автоматизация, проверка гипотезы.
 */

$page_seo_title       = 'MVP AI-решения для бизнеса: разработка и внедрение под ключ';
$page_seo_description = 'Разработка и внедрение MVP AI-решений для бизнеса за 2–4 недели: AI-агенты, автоматизация процессов, проверка гипотезы на реальных задачах. Оценка MVP — бесплатно.';

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
    ['label' => 'Зачем MVP', 'href' => '#chto-takoe'],
    ['label' => 'Задачи', 'href' => '#zadachi'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Цена', 'href' => '#ceny'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Оценить MVP';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = 'Этапы за 2–4 недели';
$secondary_cta_url = '#etapy';

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

.mvp-ai-resheniya-dlya-biznesa-page .mvpai-intro-text p{text-align:left!important;}

.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:#9aa8bd;font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.mvp-ai-resheniya-dlya-biznesa-page .ym-btn--accent{background:linear-gradient(135deg,#2563eb,#7c3aed);color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:#e6edf7!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:#79f2ff!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page mvp-ai-resheniya-dlya-biznesa-page" role="main" tabindex="-1">
<section class="nero-ai-hero mvpai-hero" id="mvpai-hero" aria-labelledby="mvpai-hero-title">
<style>
.mvpai-hero {
  --mvpai-cyan: #79f2ff;
  --mvpai-violet: #8b5cf6;
  --mvpai-text: #e6edf7;
  --mvpai-muted: #9aa8bd;
  --mvpai-soft: #c7d2e5;
  --mvpai-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.mvpai-hero::before {
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
.mvpai-hero::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 620px;
  height: 620px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .14), rgba(139, 92, 246, .08) 45%, transparent 66%);
  filter: blur(10px);
  animation: mvpaiHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes mvpaiHeroGlow {
  from { opacity: .45; transform: scale(.94); }
  to { opacity: .9; transform: scale(1.06); }
}
.mvpai-hero .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.mvpai-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.mvpai-hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 66px);
  line-height: .98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.mvpai-hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, var(--mvpai-cyan) 0%, #fff 38%, var(--mvpai-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.mvpai-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.24);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--mvpai-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.mvpai-hero .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--mvpai-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.mvpai-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.mvpai-hero .nero-ai-badge {
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
.mvpai-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.mvpai-hero .nero-ai-btn {
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
.mvpai-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.mvpai-hero .nero-ai-btn-primary {
  color: #050711 !important;
  background: linear-gradient(135deg, var(--mvpai-cyan), #a5f3fc);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.mvpai-hero .nero-ai-btn-secondary {
  color: var(--mvpai-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.mvpai-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--mvpai-shadow);
  border: 1px solid rgba(255,255,255,.08);
  transform: perspective(1200px) rotateY(-4deg);
}
.mvpai-hero .nero-ai-dashboard-shell {
  border-radius: 22px;
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.1);
  background: linear-gradient(180deg, rgba(15,23,42,.92), rgba(8,11,23,.96));
}
.mvpai-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px 14px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.04);
}
.mvpai-hero .nero-ai-dots { display: flex; gap: 6px; }
.mvpai-hero .nero-ai-dot {
  width: 10px; height: 10px; border-radius: 50%;
  background: rgba(255,255,255,.18);
}
.mvpai-hero .nero-ai-window-title {
  color: var(--mvpai-muted);
  font-size: 11px;
  font-weight: 600;
}
.mvpai-hero .nero-ai-window-body { padding: 16px; }
.mvpai-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  margin-bottom: 14px;
}
.mvpai-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 20px;
  letter-spacing: -0.03em;
  color: #f8fafc;
}
.mvpai-hero .nero-ai-live-pill {
  padding: 4px 10px;
  border-radius: 999px;
  background: rgba(34,197,94,.12);
  color: #86efac;
  font-size: 11px;
  font-weight: 800;
}
.mvpai-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.mvpai-hero .nero-ai-metric {
  padding: 10px 12px;
  border-radius: 14px;
  border: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.04);
}
.mvpai-hero .nero-ai-metric span {
  display: block;
  color: var(--mvpai-muted);
  font-size: 11px;
  font-weight: 600;
}
.mvpai-hero .nero-ai-metric strong {
  display: block;
  margin-top: 4px;
  color: #fff;
  font-size: 22px;
  letter-spacing: -0.04em;
}
.mvpai-hero .nero-ai-metric small {
  display: block;
  margin-top: 2px;
  color: #64748b;
  font-size: 10px;
}
.mvpai-hero .mvpai-dash-canvas-wrap {
  position: relative;
  height: 220px;
  margin: 8px 0 12px;
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid rgba(121,242,255,.12);
  background: linear-gradient(180deg, rgba(5,7,17,.6), rgba(8,11,23,.85));
}
.mvpai-hero #mvpai-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.mvpai-hero .nero-ai-task-stream {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.mvpai-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  gap: 10px;
  align-items: center;
  padding: 10px 12px;
  border-radius: 12px;
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.06);
}
.mvpai-hero .nero-ai-task-icon {
  width: 28px; height: 28px;
  display: grid; place-items: center;
  border-radius: 8px;
  background: rgba(139,92,246,.18);
  color: #c4b5fd;
  font-size: 11px;
  font-weight: 800;
}
.mvpai-hero .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.mvpai-hero .nero-ai-task span {
  color: var(--mvpai-muted);
  font-size: 11px;
}
.mvpai-hero .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.mvpai-hero .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.mvpai-hero .nero-ai-status--violet {
  background: rgba(139,92,246,.14);
  color: #ddd6fe;
}
@media (max-width: 1100px) {
  .mvpai-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .mvpai-hero .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .mvpai-hero .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .mvpai-hero .nero-ai-window-body { padding: 12px; }
  .mvpai-hero .nero-ai-task { grid-template-columns: 28px 1fr; }
  .mvpai-hero .nero-ai-status { grid-column: 2; width: fit-content; }
  .mvpai-hero .mvpai-dash-canvas-wrap { height: 190px; }
}
@media (prefers-reduced-motion: reduce) {
  .mvpai-hero::after { animation: none; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · MVP AI · 2–4 недели</p>
      <h1 id="mvpai-hero-title">MVP AI-решения для бизнеса: разработка и внедрение <span class="nero-ai-gradient-text">под ключ</span></h1>
      <p class="nero-ai-hero-lead">Соберём MVP AI-сервиса, агента или внутреннего помощника за 2–4 недели — чтобы проверить гипотезу на реальных задачах, а не в презентации</p>
      <ul class="nero-ai-badges" aria-label="Ключевые параметры MVP">
        <li class="nero-ai-badge">2–4 недели</li>
        <li class="nero-ai-badge">250 тыс.–1,2 млн ₽</li>
        <li class="nero-ai-badge">Карта MVP-функций</li>
        <li class="nero-ai-badge">AI-агенты и RAG</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#etapy">Этапы за 2–4 недели</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация MVP AI пилотного контура">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики MVP-пилота · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>MVP AI · пилотный контур</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Срок MVP</span>
              <strong>2–4 нед</strong>
              <small>спринт пилота</small>
            </div>
            <div class="nero-ai-metric">
              <span>Метрик пилота</span>
              <strong>3–5 KPI</strong>
              <small>время ответа, % авто</small>
            </div>
            <div class="nero-ai-metric">
              <span>Приоритет</span>
              <strong>1 сценарий</strong>
              <small>не пять сразу</small>
            </div>
            <div class="nero-ai-metric">
              <span>Буксуют*</span>
              <strong>48%</strong>
              <small>Gartner · к production</small>
            </div>
          </div>

          <div class="mvpai-dash-canvas-wrap" aria-hidden="false">
            <canvas id="mvpai-hero-canvas" role="img" aria-label="Анимация: гипотеза проходит спринт MVP — карта функций, RAG, интеграция CRM и отчёт KPI пилота"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий пилота">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">↳</span>
              <div><strong>Заявка с сайта → RAG-квалификация</strong><span>Контекст из FAQ и прайса</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Ответ агента с цитированием</strong><span>Уверенность 0.91</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Лид записан · amoCRM</strong><span>Сделка #2841 · задача менеджеру</span></div>
              <span class="nero-ai-status">сделка</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">HITL</span>
              <div><strong>Эскалация человеку</strong><span>confidence 0.62 · нестандартный кейс</span></div>
              <span class="nero-ai-status nero-ai-status--amber">review</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">📊</span>
              <div><strong>Отчёт пилота · 3 KPI</strong><span>Время ответа, % авто, конверсия</span></div>
              <span class="nero-ai-status nero-ai-status--violet">новое</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * mvpai-hero-engine — «Лаборатория валидации гипотез AI»
 * Мир: дуговой спринт-пайплайн → камера сборки MVP → bloom метрик пилота
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("mvpai-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 220;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 6;
    scale = Math.min(cw / 420, ch / 240) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    chipBg: "#1e293b",
    chipCyan: "#79f2ff",
    chipViolet: "#8b5cf6",
    chipGreen: "#22c55e",
    arcRail: "rgba(121,242,255,0.28)",
    arcGlow: "rgba(139,92,246,0.35)",
    chamberBase: "#0f172a",
    chamberEdge: "#334155",
    ragOrb: "rgba(121,242,255,0.45)",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0",
    bubbleAccent: "#79f2ff"
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

  function drawHypothesisChip(ctx, x, y, label, color) {
    drawRR(ctx, x - 14, y - 9, 28, 18, 4, color || C.chipBg, C.outline);
    ctx.fillStyle = "#e2e8f0";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(label, x, y + 3);
  }

  /* Дуговой спринт-пайплайн — транспорт чипов гипотез */
  function SprintArcPipeline() {
    this.phase = 0;
  }
  SprintArcPipeline.prototype.draw = function (ctx) {
    this.phase = (frame * 0.03) % (Math.PI * 2);
    var arcs = [
      { rx: 125, ry: 48, start: Math.PI * 0.15, end: Math.PI * 0.85 },
      { rx: 95, ry: 36, start: Math.PI * 0.2, end: Math.PI * 0.8 }
    ];
    arcs.forEach(function (a, idx) {
      ctx.save();
      ctx.strokeStyle = idx === 0 ? C.arcGlow : C.arcRail;
      ctx.lineWidth = idx === 0 ? 2.2 : 1.2;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.35;
      ctx.beginPath();
      ctx.ellipse(0, 5, a.rx, a.ry, 0, a.start, a.end);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.restore();
    });

    var chips = [
      { t0: 0, label: "Идея", col: C.chipViolet },
      { t0: 1.4, label: "RAG", col: C.chipCyan },
      { t0: 2.8, label: "CRM", col: C.chipGreen }
    ];
    chips.forEach(function (ch) {
      var t = (this.phase + ch.t0) % (Math.PI * 0.7);
      var ang = Math.PI * 0.15 + t;
      var ex = Math.cos(ang) * 125;
      var ey = 5 + Math.sin(ang) * 48;
      drawHypothesisChip(ctx, ex, ey, ch.label, ch.col);
    }, this);
  };

  /* Карта MVP-функций на whiteboard */
  function FeatureMapWhiteboard() {
    this.pulse = 0;
  }
  FeatureMapWhiteboard.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 220;
    drawRR(ctx, -168, -72, 54, 78, 6, "rgba(255,255,255,0.05)", C.outline);
    ctx.fillStyle = C.chipCyan;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Карта MVP", -160, -60);
    var items = ["1 сценарий", "3–5 KPI", "Стек"];
    items.forEach(function (it, i) {
      var on = prg > 12 + i * 18;
      drawRR(ctx, -160, -48 + i * 20, 42, 14, 3, on ? "rgba(121,242,255,0.2)" : "rgba(255,255,255,0.06)", C.outline);
      ctx.fillStyle = on ? "#e2e8f0" : "#64748b";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText(it, -156, -38 + i * 20);
    });
  };

  /* Eval-набор — пробирки тестов */
  function EvalTestBench() {
    this.count = 0;
  }
  EvalTestBench.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 220;
    drawRR(ctx, 118, -70, 46, 56, 5, "rgba(255,255,255,0.05)", C.outline);
    ctx.fillStyle = "#cbd5e1";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Eval 30–50", 141, -58);
    for (var i = 0; i < 4; i++) {
      var h = 8 + Math.min(28, Math.max(0, (prg - 50 - i * 12) * 1.2));
      drawRR(ctx, 126 + i * 9, -20 - h, 6, h, 2, i % 2 ? C.chipCyan : C.chipViolet, C.outline);
    }
    if (prg > 100) {
      ctx.fillStyle = C.chipGreen;
      ctx.fillText("92% точн.", 141, -8);
    }
  };

  /* Хаб интеграций CRM / Telegram */
  function IntegrationPortHub() {
    this.blink = 0;
  }
  IntegrationPortHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 220;
    var ports = [
      { x: -155, y: 42, label: "TG" },
      { x: 155, y: 42, label: "CRM" }
    ];
    ports.forEach(function (p, i) {
      var active = prg > 85 + i * 35;
      drawRR(ctx, p.x - 16, p.y - 12, 32, 24, 6, active ? "rgba(34,197,94,0.18)" : "rgba(255,255,255,0.06)", C.outline);
      ctx.fillStyle = active ? C.chipGreen : "#94a3b8";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(p.label, p.x, p.y + 4);
      if (active && prg < 175) {
        ctx.strokeStyle = "rgba(121,242,255,0.5)";
        ctx.lineWidth = 1.5;
        ctx.setLineDash([3, 3]);
        ctx.beginPath();
        ctx.moveTo(p.x, p.y - 12);
        ctx.quadraticCurveTo(p.x * 0.3, -10, 0, -35);
        ctx.stroke();
        ctx.setLineDash([]);
      }
    });
  };

  /* RAG-орб контекста */
  function RagContextOrb() {
    this.angle = 0;
  }
  RagContextOrb.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 220;
    if (prg < 55 || prg > 165) return;
    this.angle += 0.04;
    var r = 14 + Math.sin(frame * 0.08) * 3;
    ctx.save();
    ctx.globalAlpha = 0.55 + Math.sin(frame * 0.1) * 0.2;
    ctx.fillStyle = C.ragOrb;
    ctx.beginPath();
    ctx.arc(-55, -8, r, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.chipCyan;
    ctx.lineWidth = 1.2;
    ctx.stroke();
    ctx.fillStyle = "#fff";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("RAG", -55, -5);
    ctx.restore();
  };

  /* Камера валидации гипотезы — центральный объект */
  function HypothesisValidationChamber() {
    this.module = 0;
    this.validated = false;
  }
  HypothesisValidationChamber.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 220;
    ctx.lineJoin = "round";

    /* Шестигранник камеры */
    ctx.fillStyle = C.chamberBase;
    ctx.strokeStyle = C.chamberEdge;
    ctx.lineWidth = 2;
    ctx.beginPath();
    for (var i = 0; i < 6; i++) {
      var a = Math.PI / 6 + i * Math.PI / 3;
      var hx = Math.cos(a) * 52;
      var hy = -15 + Math.sin(a) * 38;
      if (i === 0) ctx.moveTo(hx, hy);
      else ctx.lineTo(hx, hy);
    }
    ctx.closePath();
    ctx.fill();
    ctx.stroke();

    ctx.fillStyle = "#e2e8f0";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("MVP LAB", 0, -18);

    /* Фаза ASSEMBLE: модули внутри */
    if (prg >= 55 && prg < 155) {
      var mods = ["API", "RAG", "UI"];
      mods.forEach(function (m, i) {
        var show = prg > 60 + i * 28;
        if (!show) return;
        var mx = -22 + i * 22;
        var my = 8 + Math.sin(frame * 0.06 + i) * 2;
        drawRR(ctx, mx, my, 20, 14, 3, "rgba(139,92,246,0.25)", C.chipViolet);
        ctx.fillStyle = "#ddd6fe";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.fillText(m, mx + 10, my + 10);
      });
    }

    /* Human-in-the-loop полоса */
    if (prg >= 120 && prg < 175) {
      drawRR(ctx, -38, 32, 76, 12, 3, "rgba(245,158,11,0.2)", "#f59e0b");
      ctx.fillStyle = "#fde68a";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("HITL · эскалация", 0, 41);
    }
  };

  /* Финал: bloom KPI пилота */
  function PilotMetricsBloom() {
    this.rings = 0;
  }
  PilotMetricsBloom.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 220;
    if (prg < 155) return;

    var bloom = Math.min(1, (prg - 155) / 30);
    var kpis = ["TTA", "AUTO%", "NPS"];
    kpis.forEach(function (k, i) {
      var radius = 18 + bloom * (22 + i * 14);
      ctx.strokeStyle = "rgba(121,242,255," + (0.7 - bloom * 0.4) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(0, 5, radius, 0, Math.PI * 2);
      ctx.stroke();
      var ax = Math.cos(Math.PI * 0.5 + i * 1.2) * radius;
      var ay = 5 + Math.sin(Math.PI * 0.5 + i * 1.2) * radius * 0.6;
      ctx.fillStyle = C.chipCyan;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(k, ax, ay);
    });

    if (prg > 175) {
      var stamp = Math.min(1, (prg - 175) / 15);
      ctx.save();
      ctx.globalAlpha = stamp;
      ctx.translate(0, 58);
      ctx.rotate(-0.12);
      ctx.strokeStyle = C.chipGreen;
      ctx.lineWidth = 2;
      ctx.strokeRect(-34, -10, 68, 22);
      ctx.fillStyle = C.chipGreen;
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("ГИПОТЕЗА ✓", 0, 5);
      ctx.restore();
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
    var prg = (frame * 0.042) % 220;
    var isMoving = false;
    var faceDir = 1;

    /* Пентагональные точки вокруг камеры — иная геометрия */
    var labTargets = {
      "1_architect": { x: -95, y: -55 },
      "2_seo": { x: -105, y: 35 },
      "3_coder": { x: 0, y: 62 },
      "4_designer": { x: 105, y: 35 },
      "5_deployer": { x: 95, y: -55 }
    };
    var tgt = labTargets[this.role] || { x: 0, y: 40 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 11);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 11);
      } else if (local < 16) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 16) / 6);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 16) / 6);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
    }

    if (!isMoving && frame % 200 === 0 && Math.random() < 0.12) {
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
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new FeatureMapWhiteboard());
  entities.push(new SprintArcPipeline());
  entities.push(new RagContextOrb());
  entities.push(new HypothesisValidationChamber());
  entities.push(new EvalTestBench());
  entities.push(new IntegrationPortHub());
  entities.push(new PilotMetricsBloom());
  entities.push(new Agent(-130, 82, C.agentYellow, "1_architect", 15, [
    "Один сценарий — не пять", "Карта MVP-функций", "Границы первого релиза"
  ]));
  entities.push(new Agent(-75, 92, C.agentGreen, "2_seo", 48, [
    "3–5 KPI пилота", "Eval-набор 30 примеров", "Метрика: время ответа"
  ]));
  entities.push(new Agent(0, 98, C.agentBlue, "3_coder", 88, [
    "RAG на pgvector", "Prompt templates", "FastAPI + rate limit"
  ]));
  entities.push(new Agent(75, 92, C.agentPink, "4_designer", 128, [
    "Чат-виджет MVP", "Human-in-the-loop UI", "Эскалация при 0.6"
  ]));
  entities.push(new Agent(130, 82, C.agentPurple, "5_deployer", 168, [
    "Пилот на staging", "Логи в Langfuse", "Handoff документация"
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

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.042) % 220;
    if (prg >= 8 && prg < 8.05) createBubble(-130, -40, "1. Карта MVP-функций");
    if (prg >= 58 && prg < 58.05) createBubble(-40, -50, "2. RAG на ваших данных");
    if (prg >= 98 && prg < 98.05) createBubble(30, -20, "3. Интеграция CRM");
    if (prg >= 138 && prg < 138.05) createBubble(0, 45, "4. Пилот на реальных заявках");
    if (prg >= 178 && prg < 178.05) createBubble(0, 70, "5. Отчёт KPI пилота");

    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 22);
      var tw = ctx.measureText(b.text).width + 12;
      drawRR(ctx, b.x - tw / 2, b.y - 20, tw, 16, 5, C.bubbleBg, C.bubbleAccent);
      ctx.fillStyle = C.bubbleText;
      ctx.globalAlpha = alpha;
      ctx.fillText(b.text, b.x, b.y - 10);
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

<div class="mvpai-content">

<style>
/* === MVP AI article block: prefix mvpai-, scoped === */
.mvpai-content{
  --mvpai-bg:#050711;--mvpai-bg2:#080b17;
  --mvpai-text:#e6edf7;--mvpai-muted:#9aa8bd;--mvpai-soft:#c7d2e5;--mvpai-heading:#fff;
  --mvpai-border:rgba(255,255,255,.10);--mvpai-cyan:#79f2ff;--mvpai-violet:#8b5cf6;--mvpai-green:#22c55e;
  --mvpai-r:18px;--mvpai-r-lg:24px;--mvpai-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--mvpai-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.mvpai-content *,.mvpai-content *::before,.mvpai-content *::after{box-sizing:border-box;}
.mvpai-content p{color:var(--mvpai-muted);line-height:1.72;margin:0 0 1em;}
.mvpai-content p:last-child{margin-bottom:0;}
.mvpai-content h2,.mvpai-content h3,.mvpai-content h4{color:var(--mvpai-heading);letter-spacing:-.04em;margin:0 0 .7em;}
.mvpai-content strong{color:var(--mvpai-soft);}
.mvpai-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.mvpai-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--mvpai-muted);font-size:14.5px;line-height:1.65;}
.mvpai-content ul li::before{content:'›';position:absolute;left:0;color:var(--mvpai-cyan);font-weight:700;}
.mvpai-cnt{width:min(var(--mvpai-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.mvpai-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.mvpai-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.mvpai-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.mvpai-sh.mvpai-left{margin-left:0;text-align:left;}
.mvpai-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.mvpai-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.mvpai-sh.mvpai-left p{margin-left:0;}
.mvpai-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--mvpai-cyan);margin-bottom:14px;}
.mvpai-gt{background:linear-gradient(92deg,#fff 0%,var(--mvpai-cyan) 44%,var(--mvpai-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.mvpai-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.mvpai-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.mvpai-intro-text{position:relative;padding-left:20px;}
.mvpai-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--mvpai-cyan),var(--mvpai-violet));}
.mvpai-kpi-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.mvpai-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;}
.mvpai-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--mvpai-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.mvpai-kpi-card .kl{font-size:11px;font-weight:600;color:var(--mvpai-muted);line-height:1.4;}
.mvpai-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.mvpai-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.mvpai-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.06);border:1px solid var(--mvpai-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--mvpai-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none;}
.mvpai-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--mvpai-cyan);background:rgba(121,242,255,.08);}
.mvpai-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--mvpai-border);border-radius:var(--mvpai-r-lg);padding:26px;backdrop-filter:blur(16px);}
.mvpai-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.mvpai-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
.mvpai-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--mvpai-r);padding:26px;margin-bottom:14px;}
.mvpai-scenario:last-child{margin-bottom:0;}
.mvpai-scenario h3{font-size:17px;margin-bottom:8px;}
.mvpai-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.mvpai-table{width:100%;border-collapse:collapse;font-size:14px;}
.mvpai-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--mvpai-cyan);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);}
.mvpai-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--mvpai-text);vertical-align:top;}
.mvpai-table tr:last-child td{border-bottom:none;}
.mvpai-timeline{position:relative;padding-left:40px;}
.mvpai-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--mvpai-cyan),var(--mvpai-violet));opacity:.35;}
.mvpai-tl-item{position:relative;margin-bottom:32px;}
.mvpai-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--mvpai-cyan);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.mvpai-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
.mvpai-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;}
.mvpai-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--mvpai-green);margin-bottom:10px;}
.mvpai-checklist{display:flex;flex-direction:column;gap:10px;}
.mvpai-check{display:flex;align-items:flex-start;gap:12px;padding:14px 18px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:12px;font-size:14.5px;color:var(--mvpai-muted);}
.mvpai-check::before{content:'☐';color:var(--mvpai-cyan);font-size:18px;line-height:1;flex-shrink:0;}
.mvpai-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.mvpai-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.mvpai-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--mvpai-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;}
.mvpai-faq-q::after{content:'▾';font-size:13px;color:var(--mvpai-cyan);}
.mvpai-faq-a{padding:0 24px 20px;font-size:14.5px;color:var(--mvpai-muted);line-height:1.72;}
.mvpai-short-card{background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.06));border:1px solid rgba(121,242,255,.25);border-radius:var(--mvpai-r-lg);padding:28px;margin:24px 0;}
@media(max-width:900px){.mvpai-intro-grid{grid-template-columns:1fr;}.mvpai-kpi-grid{grid-template-columns:repeat(2,1fr);}}
@media(max-width:768px){.mvpai-grid-2,.mvpai-grid-3,.mvpai-case-grid{grid-template-columns:1fr;}}
@media(max-width:600px){.mvpai-kpi-grid{grid-template-columns:1fr;}}
</style>

  <!-- INTRO (без отдельного якоря в меню) -->
  <section class="mvpai-intro" aria-label="Введение">
    <div class="mvpai-cnt">
      <div class="mvpai-intro-grid nero-ai-reveal">
        <div class="mvpai-intro-text">
          <p class="mvpai-eyebrow">Лонгрид · mvp ai решения</p>
          <p>Идея AI-сервиса есть, а работающего прототипа — нет. Пока команда готовит презентацию, конкурент уже тестирует <strong>mvp ai решения</strong> на реальных заявках.</p>
          <p><strong>Коротко:</strong> MVP AI-решение — рабочий прототип с искусственным интеллектом, который за 2–4 недели отвечает на вопрос «нужен ли рынку этот AI-продукт» и «окупается ли автоматизация в вашей компании».</p>
        </div>
        <div class="mvpai-kpi-grid" aria-label="Ключевые ориентиры">
          <div class="mvpai-kpi-card"><div class="kv">2–4</div><div class="kl">недели до пилота</div></div>
          <div class="mvpai-kpi-card"><div class="kv">48%</div><div class="kl">AI-проектов буксуют*</div></div>
          <div class="mvpai-kpi-card"><div class="kv">250K–1,2M ₽</div><div class="kl">ориентир бюджета</div></div>
          <div class="mvpai-kpi-card"><div class="kv">80%</div><div class="kl">MVP без своей модели</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="mvpai-toc-outer">
    <div class="mvpai-cnt">
      <nav class="mvpai-toc" aria-label="Оглавление статьи">
        <a href="#chto-takoe">Зачем MVP</a>
        <a href="#zadachi">Задачи</a>
        <a href="#etapy">Этапы</a>
        <a href="#integracii">Интеграции</a>
        <a href="#ceny">Цена</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
        <a href="#ocenit-mvp">Оценить MVP</a>
      </nav>
    </div>
  </div>

  <!-- #chto-takoe -->
  <section class="mvpai-section" id="chto-takoe">
    <div class="mvpai-cnt">
      <div class="mvpai-sh">
        <span class="mvpai-eyebrow">Определение</span>
        <h2>Что такое <span class="mvpai-gt">MVP AI-решение</span> для бизнеса и зачем оно нужно</h2>
        <p>Минимально жизнеспособный продукт с AI-ядром, который за ограниченный срок проверяет коммерческую гипотезу на реальных пользователях и данных компании.</p>
      </div>

      <div class="mvpai-short-card nero-ai-reveal">
        <p><strong>Коротко:</strong> MVP AI — не демо в ChatGPT, а чат-агент, RAG-помощник, workflow-агент или классификатор на ваших данных. Nero Network собирает такие MVP под ключ — с картой функций, метриками пилота и планом масштабирования.</p>
      </div>

      <div class="mvpai-card nero-ai-reveal" style="margin-top:28px;">
        <h3>От идеи к проверке гипотезы: чем MVP отличается от «презентации с нейросетью»</h3>
        <p>Презентация отвечает «как это могло бы выглядеть». <strong>MVP AI</strong> отвечает на вопросы бизнеса: сокращается ли время ответа, снижается ли нагрузка на операторов, растёт ли конверсия, достаточно ли качества на ваших документах.</p>
        <p>По данным Gartner (май 2024), только <strong>48%</strong> AI-проектов доходят до production; средний путь — <strong>8 месяцев</strong>. Структурированный MVP с метриками снижает риск «красивого демо без результата».</p>
        <ul>
          <li>Валидация спроса до полной разработки</li>
          <li>Пилот на реальных данных с измеримым KPI</li>
          <li>Архитектурный фундамент без переписывания при масштабировании</li>
        </ul>
      </div>

      <div class="mvpai-sh mvpai-left" style="margin-top:48px;">
        <span class="mvpai-eyebrow">Целевая аудитория</span>
        <h3>Кому подходит: стартапы, предприниматели, продуктовые команды</h3>
      </div>
      <div class="mvpai-table-wrap nero-ai-reveal">
        <table class="mvpai-table">
          <thead><tr><th>Сегмент</th><th>Типичная задача MVP AI</th><th>Что проверяем за 2–4 недели</th></tr></thead>
          <tbody>
            <tr><td>Стартап</td><td>AI-сервис как продукт</td><td>Retention, willingness to pay, качество сценария</td></tr>
            <tr><td>Предприниматель / SMB</td><td>Внутренний помощник, автоматизация заявок</td><td>Экономия часов, % автоматизации, NPS пилота</td></tr>
            <tr><td>Продуктовая команда</td><td>Новая AI-фича в продукте</td><td>Adoption, точность, интеграция со стеком</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- #zadachi -->
  <section class="mvpai-section mvpai-section-alt" id="zadachi">
    <div class="mvpai-cnt">
      <div class="mvpai-sh">
        <span class="mvpai-eyebrow">Сценарии</span>
        <h2>Какие задачи закрывает MVP AI: <span class="mvpai-gt">агенты, автоматизация, помощники</span></h2>
        <p>Три типовых направления <strong>ai для бизнеса</strong> в формате MVP — не «ИИ для всего», а узкий инструмент под конкретную боль.</p>
      </div>

      <div class="mvpai-grid-3 nero-ai-reveal">
        <div class="mvpai-card">
          <h3>AI-агенты</h3>
          <p>Автономные или полуавтономные сценарии: квалификация лида, маршрутизация, follow-up. Тренд 2026 — agentic apps (Microsoft Build 2026).</p>
        </div>
        <div class="mvpai-card nero-ai-delay-1">
          <h3>RAG-помощники</h3>
          <p>Ответы по базе знаний с цитированием источника. LLM API + vector DB + оркестратор (n8n, Make, FastAPI).</p>
        </div>
        <div class="mvpai-card nero-ai-delay-2">
          <h3>Автоматизация рутины</h3>
          <p>Классификация, извлечение полей, черновики документов. Заявка → CRM → назначение менеджера за минуты.</p>
        </div>
      </div>

      <div class="nero-ai-reveal" style="margin-top:28px;">
        <div class="mvpai-scenario">
          <h3>Чат-агент и RAG на ваших данных</h3>
          <p>Оркестратор маршрутизирует запрос → RAG находит фрагменты → LLM формирует ответ с источником → при низкой уверенности эскалация человеку. <strong>Кейс ГК ФСК</strong> (Habr): workflow AI-агенты, RAG &gt;1 млн токенов, снижение нагрузки 30–40%.</p>
        </div>
        <div class="mvpai-scenario">
          <h3>Автоматизация заявок, документов и рутины</h3>
          <p>Заявка с сайта → квалификация → поля в CRM. Кейс Nurax/Битрикс24 (маркетинговый): обработка за 2–3 мин, интеграция CRM за 2 дня.</p>
        </div>
        <div class="mvpai-scenario">
          <h3>Внутренний AI-помощник для команды</h3>
          <p>Онбординг, поиск по регламентам, черновики КП. Человек — сделки с высоким чеком и юридически значимые решения.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== БОРИС: визуальный блок (после #zadachi) ===== -->
  <section id="mvp-ai-resheniya-dlya-biznesa-boris-block" class="bmvp-root" aria-label="Анимация: пилот MVP AI на реальных данных — метрики, RAG-контур и эскалация">
<style>
#mvp-ai-resheniya-dlya-biznesa-boris-block.bmvp-root{padding:56px 0 64px;background:#f1f5f9;}
#mvp-ai-resheniya-dlya-biznesa-boris-block .bmvp-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#mvp-ai-resheniya-dlya-biznesa-boris-block .bmvp-card{
  display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;overflow:hidden;background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:480px;
}
@media(max-width:1023px){
  #mvp-ai-resheniya-dlya-biznesa-boris-block .bmvp-card{grid-template-columns:1fr;min-height:auto;}
}
#mvp-ai-resheniya-dlya-biznesa-boris-block .bmvp-lft{
  padding:40px 36px;display:flex;flex-direction:column;justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #mvp-ai-resheniya-dlya-biznesa-boris-block .bmvp-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}
}
#mvp-ai-resheniya-dlya-biznesa-boris-block .bmvp-ey{
  display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;
  letter-spacing:.12em;text-transform:uppercase;color:#7c3aed;margin:0 0 14px;
}
#mvp-ai-resheniya-dlya-biznesa-boris-block .bmvp-ey::before{content:'';width:18px;height:2px;background:#7c3aed;border-radius:1px;}
#mvp-ai-resheniya-dlya-biznesa-boris-block .bmvp-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;
}
#mvp-ai-resheniya-dlya-biznesa-boris-block .bmvp-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#mvp-ai-resheniya-dlya-biznesa-boris-block .bmvp-ul li{
  display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;
}
#mvp-ai-resheniya-dlya-biznesa-boris-block .bmvp-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(124,58,237,.1);
  display:flex;align-items:center;justify-content:center;font-size:11px;color:#6d28d9;font-style:normal;
}
#mvp-ai-resheniya-dlya-biznesa-boris-block .bmvp-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#mvp-ai-resheniya-dlya-biznesa-boris-block .bmvp-pl{
  padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
}
#mvp-ai-resheniya-dlya-biznesa-boris-block .bmvp-pl-c{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22);}
#mvp-ai-resheniya-dlya-biznesa-boris-block .bmvp-pl-v{background:rgba(124,58,237,.08);color:#6d28d9;border:1.5px solid rgba(124,58,237,.22);}
#mvp-ai-resheniya-dlya-biznesa-boris-block .bmvp-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#mvp-ai-resheniya-dlya-biznesa-boris-block .bmvp-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#mvp-ai-resheniya-dlya-biznesa-boris-block .bmvp-rgt{
  position:relative;background:linear-gradient(135deg,#faf5ff 0%,#ede9fe 28%,#e0f2fe 72%,#f8fafc 100%);
  min-height:420px;overflow:hidden;
}
@media(max-width:1023px){#mvp-ai-resheniya-dlya-biznesa-boris-block .bmvp-rgt{min-height:360px;}}
#bmvp-pilot-metrics-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>

    <div class="bmvp-cnt">
      <div class="bmvp-card">
        <div class="bmvp-lft">
          <span class="bmvp-ey">Пилот · недели 3–4</span>
          <h3 class="bmvp-h3">Гипотеза на реальных данных: метрики пилота вместо слайдов</h3>
          <ul class="bmvp-ul">
            <li><span class="bmvp-ic">1</span>Запрос из чата, виджета или мессенджера попадает в оркестратор</li>
            <li><span class="bmvp-ic">2</span>RAG ищет чанки в базе знаний клиента — единый контекст для агента</li>
            <li><span class="bmvp-ic">3</span>LLM отвечает с цитатой; при низкой уверенности — эскалация человеку</li>
            <li><span class="bmvp-ic">↗</span>Диалоги и KPI пилота логируются в CRM и дашборд метрик</li>
          </ul>
          <div class="bmvp-pills">
            <span class="bmvp-pl bmvp-pl-c">время ответа ↓</span>
            <span class="bmvp-pl bmvp-pl-v">3–5 KPI</span>
            <span class="bmvp-pl bmvp-pl-g">% автоматизации</span>
          </div>
          <p class="bmvp-foot">Дальше — этапы разработки MVP под ключ за 2–4 недели →</p>
        </div>
        <div class="bmvp-rgt">
          <canvas id="bmvp-pilot-metrics-canvas" role="img" aria-label="Анимация: поток данных MVP AI — запрос, RAG, ответ, CRM и дашборд метрик пилота"></canvas>
        </div>
      </div>
    </div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bmvp-pilot-metrics-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

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
    ink:'#0f172a', muted:'#64748b', card:'#ffffff', cardBdr:'#cbd5e1',
    cyan:'#06b6d4', violet:'#7c3aed', green:'#22c55e', amber:'#f59e0b',
    glowC:'rgba(6,182,212,.18)', glowV:'rgba(124,58,237,.18)'
  };

  var stages = [
    { id:'req',  label:'Запрос',  x:0.12, color:C.cyan },
    { id:'rag',  label:'RAG',     x:0.32, color:C.violet },
    { id:'llm',  label:'LLM',     x:0.52, color:C.violet },
    { id:'crm',  label:'CRM',     x:0.72, color:C.green },
    { id:'kpi',  label:'KPI',     x:0.90, color:C.amber }
  ];

  var packets = [];
  function spawnPacket(){
    packets.push({ t:0, stage:0, yOff: (Math.random() - 0.5) * 24 });
  }
  if (packets.length < 4) for (var i = 0; i < 4; i++) spawnPacket();

  function roundRect(x,y,w,h,r,fill,stroke){
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    ctx.fillStyle = fill; ctx.fill();
    if (stroke){ ctx.strokeStyle = stroke; ctx.lineWidth = 1.5; ctx.stroke(); }
  }

  function drawStage(s, y, pulse){
    var x = s.x * W - 44;
    var w = 88, h = 56;
    roundRect(x, y, w, h, 12, C.card, s.color);
    ctx.fillStyle = s.color;
    ctx.beginPath(); ctx.arc(x + w/2, y + 18, 8 + pulse * 3, 0, Math.PI * 2); ctx.fill();
    ctx.fillStyle = C.ink;
    ctx.font = 'bold 11px Inter, sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(s.label, x + w/2, y + 42);
  }

  function drawDashboard(y){
    var dx = W * 0.08, dw = W * 0.84, dh = H * 0.22;
    roundRect(dx, y, dw, dh, 14, 'rgba(255,255,255,.92)', C.cardBdr);
    var metrics = [
      { v:'1.8с', l:'ответ' },
      { v:'67%', l:'auto' },
      { v:'4.2', l:'NPS' }
    ];
    var mw = (dw - 40) / 3;
    metrics.forEach(function(m, i){
      var mx = dx + 20 + i * (mw + 10);
      roundRect(mx, y + 16, mw, dh - 32, 10, C.glowC, C.cyan);
      ctx.fillStyle = C.ink; ctx.font = 'bold 18px Inter,sans-serif'; ctx.textAlign = 'center';
      ctx.fillText(m.v, mx + mw/2, y + dh/2 + 2);
      ctx.fillStyle = C.muted; ctx.font = '10px Inter,sans-serif';
      ctx.fillText(m.l, mx + mw/2, y + dh/2 + 18);
    });
  }

  function drawEscalation(x, y){
    var pulse = 0.5 + 0.5 * Math.sin(frame * 0.06);
    ctx.strokeStyle = C.amber; ctx.lineWidth = 2; ctx.setLineDash([6, 4]);
    ctx.beginPath(); ctx.moveTo(x, y + 28); ctx.lineTo(x, y + 70); ctx.stroke();
    ctx.setLineDash([]);
    roundRect(x - 36, y + 70, 72, 28, 8, 'rgba(245,158,11,.12)', C.amber);
    ctx.fillStyle = C.amber; ctx.font = 'bold 10px Inter,sans-serif'; ctx.textAlign = 'center';
    ctx.fillText('Человек', x, y + 88);
    ctx.globalAlpha = 0.35 + pulse * 0.35;
    ctx.beginPath(); ctx.arc(x, y + 84, 6 + pulse * 4, 0, Math.PI*2);
    ctx.fillStyle = C.amber; ctx.fill();
    ctx.globalAlpha = 1;
  }

  function loop(){
    frame++;
    ctx.clearRect(0, 0, W, H);

    var pipeY = H * 0.42;
    var dashY = H * 0.68;

    ctx.strokeStyle = C.cardBdr; ctx.lineWidth = 3;
    ctx.beginPath();
    ctx.moveTo(W * 0.08, pipeY + 28);
    ctx.lineTo(W * 0.92, pipeY + 28);
    ctx.stroke();

    stages.forEach(function(s, i){
      var pulse = 0.5 + 0.5 * Math.sin(frame * 0.04 + i * 1.2);
      drawStage(s, pipeY, pulse);
    });

    if (frame % 90 === 0) spawnPacket();
    packets = packets.filter(function(p){ return p.t < 1.05; });

    packets.forEach(function(p){
      p.t += 0.008;
      var seg = Math.min(4, Math.floor(p.t * 5));
      var localT = (p.t * 5) - seg;
      var x0 = stages[seg].x * W;
      var x1 = stages[Math.min(seg + 1, 4)].x * W;
      var px = x0 + (x1 - x0) * localT;
      var py = pipeY + 28 + p.yOff;
      ctx.beginPath(); ctx.arc(px, py, 5, 0, Math.PI * 2);
      ctx.fillStyle = stages[seg].color; ctx.fill();
      if (seg === 2 && Math.random() < 0.02) drawEscalation(px, py);
    });

    drawDashboard(dashY);

    ctx.fillStyle = C.muted; ctx.font = '11px Inter,sans-serif'; ctx.textAlign = 'left';
    ctx.fillText('Пилот · реальные диалоги · лог в CRM', W * 0.08, H - 14);

    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
  </section>
  <!-- ===== /БОРИС ===== -->

  <!-- #etapy -->
  <section class="mvpai-section" id="etapy">
    <div class="mvpai-cnt">
      <div class="mvpai-sh">
        <span class="mvpai-eyebrow">Под ключ</span>
        <h2>Разработка <span class="mvpai-gt">MVP AI-решения</span> под ключ: этапы за 2–4 недели</h2>
        <p>Фиксированный маршрут с артефактами на каждом шаге — не «сделаем когда-нибудь», а календарь по неделям.</p>
      </div>

      <div class="mvpai-timeline nero-ai-reveal">
        <div class="mvpai-tl-item">
          <div class="mvpai-tl-dot"></div>
          <h3>Неделя 0 — Карта MVP-функций (лид-магнит)</h3>
          <p>1 приоритетный сценарий, 3–5 метрик успеха, стек, границы MVP, правила эскалации. Бесплатно при запросе «Оценить MVP».</p>
        </div>
        <div class="mvpai-tl-item">
          <div class="mvpai-tl-dot"></div>
          <h3>Недели 1–2 — AI-ядро и eval-набор</h3>
          <p>RAG или API wrapper, 30–50 примеров, целевая точность на тестовом наборе.</p>
        </div>
        <div class="mvpai-tl-item">
          <div class="mvpai-tl-dot"></div>
          <h3>Недели 2–3 — Backend, UI, интеграции</h3>
          <p>Чат/дашборд + 1–2 интеграции (amoCRM, Bitrix24, Telegram). Рабочий контур на staging.</p>
        </div>
        <div class="mvpai-tl-item">
          <div class="mvpai-tl-dot"></div>
          <h3>Неделя 4 — Пилот и handoff</h3>
          <p>Мониторинг на реальных данных, отчёт по метрикам, рекомендации по масштабированию.</p>
        </div>
      </div>

      <div class="mvpai-table-wrap nero-ai-reveal">
        <table class="mvpai-table">
          <thead><tr><th>Неделя</th><th>Работы</th><th>Результат</th></tr></thead>
          <tbody>
            <tr><td>1–2</td><td>AI-ядро, eval-набор</td><td>Целевая точность на тестах</td></tr>
            <tr><td>2–3</td><td>Backend + UI + интеграции</td><td>Контур на staging</td></tr>
            <tr><td>4</td><td>Пилот, мониторинг, документация</td><td>Отчёт по метрикам</td></tr>
          </tbody>
        </table>
      </div>

      <div class="mvpai-card nero-ai-reveal" style="margin-top:24px;">
        <h3>Передача и масштабирование после MVP</h3>
        <p>Три ветки: масштабирование (hardening), доработка по метрикам или стоп — гипотеза не подтвердилась, потери ограничены бюджетом MVP, а не годом разработки.</p>
      </div>
    </div>
  </section>

  <!-- CTA после #etapy (Артур) -->
  <div class="mvpai-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-etapy">
      <div class="ym-cta-block__icon" aria-hidden="true">🗺️</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Получите Карту MVP-функций и оценку сроков — бесплатно</p>
        <p class="ym-cta-block__sub">Один приоритетный сценарий, 3–5 KPI пилота, стек и границы первого релиза. Экспресс-оценка бюджета 250 тыс.–1,2 млн ₽ — без обязательств по разработке.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Оценить MVP</a>
      </div>
    </div>
  </div>

  <!-- #vnedrenie -->
  <section class="mvpai-section mvpai-section-alt" id="vnedrenie">
    <div class="mvpai-cnt">
      <div class="mvpai-sh">
        <span class="mvpai-eyebrow">Процессы</span>
        <h2>Внедрение AI в бизнес-процессы без лишней сложности</h2>
        <p>MVP — про встраивание <strong>ai решений</strong> в конкретный процесс: заявка, поддержка, документ, сделка.</p>
      </div>

      <div class="mvpai-table-wrap nero-ai-reveal">
        <table class="mvpai-table">
          <thead><tr><th>Критерий</th><th>MVP AI (2–4 недели)</th><th>Полная разработка (3–6+ мес.)</th></tr></thead>
          <tbody>
            <tr><td>Цель</td><td>Проверить гипотезу, получить метрики</td><td>Production-продукт под нагрузку</td></tr>
            <tr><td>Бюджет Nero Network</td><td>250 тыс.–1,2 млн ₽</td><td>Отдельная смета, обычно выше</td></tr>
            <tr><td>Риск</td><td>Ограниченный сценарий, осознанный техдолг</td><td>Высокий при неверной гипотезе</td></tr>
            <tr><td>Когда выбирать</td><td>Неясный ROI, новый сценарий</td><td>Гипотеза подтверждена</td></tr>
          </tbody>
        </table>
      </div>

      <div class="mvpai-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Production-процессы вместо «промпт-экспериментов» (agentic apps 2026)</h3>
        <p>Microsoft Build 2026: агенты получают общий контекст через Fabric и OneLake. Для российского SMB: единая база знаний + CRM, оркестрация Make/n8n, мониторинг качества, инженерный контроль поверх vibe-coding.</p>
        <p>Gartner (июнь 2025): <strong>&gt;40%</strong> agentic AI-проектов отменят к 2027 из-за затрат и неясного ROI. MVP с метриками — страховка до больших инвестиций.</p>
      </div>
    </div>
  </section>

  <!-- CTA secondary после #vnedrenie (Артур) -->
  <div class="mvpai-cnt">
    <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Команда хочет понимать AI до запуска пилота?</p>
        <p class="ym-cta-block__sub">Перед внедрением MVP полезно разобраться в n8n, RAG, промптах и human-in-the-loop — это ускоряет согласование сценариев с бизнесом и IT. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
      </div>
    </aside>
  </div>

  <!-- #integracii -->
  <section class="mvpai-section" id="integracii">
    <div class="mvpai-cnt">
      <div class="mvpai-sh">
        <span class="mvpai-eyebrow">Связки</span>
        <h2>Интеграции MVP AI: CRM, таблицы, мессенджеры</h2>
        <p><strong>Интеграция mvp ai решения</strong> — условие проверки гипотезы на реальных задачах. AI в вакууме не даёт бизнес-метрик.</p>
      </div>

      <div class="mvpai-table-wrap nero-ai-reveal">
        <table class="mvpai-table">
          <thead><tr><th>Связка</th><th>Сценарий</th><th>Зачем на MVP</th></tr></thead>
          <tbody>
            <tr><td>Сайт → AI → amoCRM / Bitrix24</td><td>Квалификация лидов</td><td>Время ответа, конверсия</td></tr>
            <tr><td>Telegram / WhatsApp → RAG-бот</td><td>Поддержка и FAQ</td><td>% автоматизации, эскалации</td></tr>
            <tr><td>Google Таблицы / Notion → агент</td><td>Внутренние отчёты</td><td>Экономия часов</td></tr>
            <tr><td>Email → классификатор → CRM</td><td>Маршрутизация</td><td>Точность маршрутизации</td></tr>
          </tbody>
        </table>
      </div>

      <div class="mvpai-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="mvpai-card">
          <h3>No-code / low-code</h3>
          <p>Just AI Agent Platform, Make, n8n — для типовых FAQ и простой квалификации без жёстких требований 152-ФЗ.</p>
        </div>
        <div class="mvpai-card">
          <h3>Кастомный MVP под ключ</h3>
          <p>Уникальная логика, RAG на закрытых документах, YandexGPT/GigaChat, legacy-интеграции, eval-набор и воспроизводимое качество.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- #ceny -->
  <section class="mvpai-section mvpai-section-alt" id="ceny">
    <div class="mvpai-cnt">
      <div class="mvpai-sh">
        <span class="mvpai-eyebrow">Смета</span>
        <h2>Сколько стоит MVP AI-решение и от чего зависит цена</h2>
        <p>Ответ на запрос <strong>«сколько стоит mvp ai решения»</strong> зависит от типа MVP, интеграций и глубины RAG.</p>
      </div>

      <div class="mvpai-card nero-ai-reveal">
        <p><strong>Ориентир Nero Network: 250 тыс.–1,2 млн ₽</strong> — нижняя граница для узкого сценария (API wrapper, один канал); верхняя — RAG + несколько интеграций + UI.</p>
      </div>

      <div class="mvpai-table-wrap nero-ai-reveal">
        <table class="mvpai-table">
          <thead><tr><th>Подход (рынок РФ)</th><th>Сроки</th><th>Бюджет</th></tr></thead>
          <tbody>
            <tr><td>API wrapper</td><td>2–4 недели</td><td>500–900 тыс. ₽</td></tr>
            <tr><td>RAG + база знаний</td><td>3–5 недель</td><td>700 тыс.–1,5 млн ₽</td></tr>
            <tr><td>MVP AI под ключ</td><td>3–4 недели</td><td>от 700 тыс. ₽</td></tr>
          </tbody>
        </table>
      </div>

      <div class="mvpai-table-wrap nero-ai-reveal">
        <table class="mvpai-table">
          <thead><tr><th>Тип MVP</th><th>Срок</th><th>Когда выбирать</th></tr></thead>
          <tbody>
            <tr><td>API wrapper</td><td>2–4 недели</td><td>Классификация, простой чат, маршрутизация</td></tr>
            <tr><td>RAG + база знаний</td><td>3–5 недель</td><td>Поддержка, внутренние знания, продажи по документам</td></tr>
            <tr><td>Custom model / fine-tune</td><td>2–3+ месяца</td><td>Редкий кейс; 80% MVP обходятся без этого</td></tr>
          </tbody>
        </table>
      </div>

      <div class="mvpai-grid-2 nero-ai-reveal" style="margin-top:24px;">
        <div class="mvpai-card">
          <h3>В пакет «под ключ»</h3>
          <ul>
            <li>Карта MVP-функций и AI-ядро + eval</li>
            <li>1–2 интеграции, пилот 1–2 недели</li>
            <li>Дашборд метрик, документация handoff</li>
          </ul>
        </div>
        <div class="mvpai-card">
          <h3>Отдельный этап</h3>
          <ul>
            <li>Production hardening под нагрузку</li>
            <li>Обучение собственной модели</li>
            <li>Enterprise-аудит безопасности</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- #keisy -->
  <section class="mvpai-section" id="keisy">
    <div class="mvpai-cnt">
      <div class="mvpai-sh">
        <span class="mvpai-eyebrow">Доказательства</span>
        <h2>Кейсы и примеры внедрения MVP AI</h2>
        <p><strong>Mvp ai решения кейсы</strong> — доказательство, что сценарий работает не в теории.</p>
      </div>

      <div class="mvpai-case-grid nero-ai-reveal">
        <div class="mvpai-case-card">
          <div class="mvpai-case-tag">Habr · ГК ФСК</div>
          <h3>Workflow AI-агенты на базе знаний</h3>
          <p>RAG &gt;1 млн токенов, внедрение 2 месяца, KPI — снижение нагрузки 30–40%. Для MVP Nero Network — один агент, 2–4 недели.</p>
        </div>
        <div class="mvpai-case-card">
          <div class="mvpai-case-tag">vc.ru · Термоленд</div>
          <h3>ИИ-менеджер в CRM</h3>
          <p>Пилот → production: консультации, напоминания, передача «горячих» сделок оператору. Модель «пилот → масштабирование».</p>
        </div>
        <div class="mvpai-case-card">
          <div class="mvpai-case-tag">Beesoul · США</div>
          <h3>NTRL Wellness: MVP → production</h3>
          <p>MVP за 2–3 недели, $200K seed; hardening за 6 недель. Урок: MVP доказывает спрос, production — отдельный раунд.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- #segmenty -->
  <section class="mvpai-section mvpai-section-alt" id="segmenty">
    <div class="mvpai-cnt">
      <div class="mvpai-sh">
        <span class="mvpai-eyebrow">Сегменты</span>
        <h2>MVP AI для малого и среднего бизнеса</h2>
      </div>

      <div class="mvpai-grid-2 nero-ai-reveal">
        <div class="mvpai-card">
          <h3>Mvp ai решения для малого бизнеса</h3>
          <p>Нет штата разработки, но есть процесс (заявки, FAQ). Бюджет 250–700 тыс. ₽ — узкий API wrapper или Telegram + CRM.</p>
        </div>
        <div class="mvpai-card">
          <h3>Mvp ai решения для среднего бизнеса</h3>
          <p>152-ФЗ, YandexGPT/GigaChat, Bitrix24, SSO. Чек ближе к 1–1,2 млн ₽: RAG на большом корпусе, аудит логов.</p>
        </div>
      </div>

      <div class="mvpai-sh mvpai-left" style="margin-top:40px;">
        <h3>Чек-лист: готов ли бизнес к MVP AI</h3>
      </div>
      <div class="mvpai-checklist nero-ai-reveal">
        <div class="mvpai-check">Один сценарий сформулирован в одном предложении</div>
        <div class="mvpai-check">Есть FAQ, регламенты или 20–50 реальных диалогов</div>
        <div class="mvpai-check">Назначен владелец процесса со стороны бизнеса</div>
        <div class="mvpai-check">Определены 3–5 метрик успеха пилота</div>
        <div class="mvpai-check">Понятны правила эскалации к человеку</div>
        <div class="mvpai-check">Есть доступ к CRM или экспорт заявок</div>
        <div class="mvpai-check">Согласован контур данных (облако / РФ / on-prem)</div>
      </div>
    </div>
  </section>

  <!-- #faq -->
  <section class="mvpai-section" id="faq">
    <div class="mvpai-cnt">
      <div class="mvpai-sh">
        <span class="mvpai-eyebrow">FAQ</span>
        <h2>Частые вопросы о MVP AI-решениях</h2>
      </div>

      <div class="mvpai-faq nero-ai-reveal">
        <div class="mvpai-faq-item">
          <div class="mvpai-faq-q">Как внедрить mvp ai решения в компании?</div>
          <div class="mvpai-faq-a">Бриф и Карта MVP-функций → подготовка данных → разработка 2–4 недели → пилот 1–2 недели → разбор метрик: масштабирование, доработка или остановка. Пилот идёт параллельно текущим процессам с эскалацией на сотрудников.</div>
        </div>
        <div class="mvpai-faq-item">
          <div class="mvpai-faq-q">Можно ли обойтись без программиста?</div>
          <div class="mvpai-faq-a">На стороне клиента — да: нужен владелец процесса и данные. Разработку под ключ выполняет Nero Network. No-code возможен для простых FAQ; для RAG, CRM и метрик пилота обычно нужен кастомный MVP.</div>
        </div>
        <div class="mvpai-faq-item">
          <div class="mvpai-faq-q">Под ключ или самостоятельно — что выбрать?</div>
          <div class="mvpai-faq-a">Самостоятельно — быстрый тест в чате без гарантии RAG и масштабирования. Под ключ — пилот на ваших данных, eval-набор, архитектура для следующего этапа, 152-ФЗ и российские LLM.</div>
        </div>
        <div class="mvpai-faq-item">
          <div class="mvpai-faq-q">Сколько длится разработка и когда виден результат?</div>
          <div class="mvpai-faq-a">Разработка — 2–4 недели. Первые измеримые результаты пилота — на 3–5-й неделе. Production под нагрузку — от 10–20 недель, отдельный этап после успешного MVP.</div>
        </div>
        <div class="mvpai-faq-item">
          <div class="mvpai-faq-q">Нужна ли своя нейросеть?</div>
          <div class="mvpai-faq-a">Нет в 80% случаев (Prime IT). Достаточно API + архитектура + RAG. Fine-tune — редкий следующий шаг после подтверждённой гипотезы.</div>
        </div>
        <div class="mvpai-faq-item">
          <div class="mvpai-faq-q">Какие задачи решает mvp ai решения — краткий список?</div>
          <div class="mvpai-faq-a">Проверка спроса на AI-продукт, снижение нагрузки на поддержку, ускорение обработки заявок, внутренний поиск по знаниям, классификация документов, черновики КП с контролем человека.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- #ocenit-mvp -->
  <section class="mvpai-section mvpai-section-alt" id="ocenit-mvp">
    <div class="mvpai-cnt">
      <div class="mvpai-sh">
        <span class="mvpai-eyebrow">Следующий шаг</span>
        <h2>Оценить MVP: следующий шаг</h2>
        <p>Не месяц переговоров, а конкретика: экспресс-оценка, Карта MVP-функций, пилот за 2–4 недели на реальных задачах.</p>
      </div>

      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы проверить гипотезу на реальных задачах?</p>
          <p class="ym-cta-block__sub">Оцените MVP бесплатно: сроки 2–4 недели, бюджет от 250 тыс. ₽, на выходе — Карта MVP-функций и пилот на ваших данных. Пока 48% AI-проектов буксуют на пути к production, ваш пилот может стартовать в этом месяце.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Оценить MVP</a>
            <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Вопросы и ответы →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.mvpai-content -->


  <!-- INTERNAL-LINKS:INSERT -->
  <!-- SCHEMA-MARKUP:INSERT -->
</main>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.mvp-ai-resheniya-dlya-biznesa-page');
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

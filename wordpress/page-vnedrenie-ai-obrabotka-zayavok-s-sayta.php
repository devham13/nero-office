<?php
/**
 * Template Name: AI-агент для обработки заявок с сайта — внедрение под ключ
 * Description: Внедряем AI-агента для первичной обработки заявок с сайта: ответ за 5–15 секунд, квалификация лида и передача в CRM. Аудит потерь заявок.
 */

$page_seo_title       = 'AI-агент для обработки заявок с сайта — внедрение под ключ';
$page_seo_description = 'Внедряем AI-агента для первичной обработки заявок с сайта: ответ за 5–15 секунд, квалификация лида и передача в CRM. Интеграция виджета, мессенджеров, amoCRM и Битрикс24. Аудит потерь заявок.';

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
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить, сколько заявок вы теряете';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url = '#kak-rabotaet';

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
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}

.vzay-page{
  --vzay-bg:#050711;--vzay-accent:#79f2ff;--vzay-violet:#8b5cf6;--vzay-muted:#9aa8bd;--vzay-soft:#c7d2e5;--vzay-heading:#fff;
  --vzay-border:rgba(255,255,255,.10);--vzay-surface:rgba(255,255,255,.072);--vzay-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vzay-soft);overflow-x:hidden;
}
.vzay-intro{padding:clamp(40px,5vw,72px) 0 clamp(32px,4vw,48px);border-bottom:1px solid rgba(255,255,255,.06)}
.vzay-intro-grid{display:grid;grid-template-columns:1fr 320px;gap:48px;align-items:center}
.vzay-cnt{width:min(var(--vzay-container),calc(100% - 40px));margin:0 auto}
.vzay-intro-text{position:relative;padding-left:20px;text-align:left!important}
.vzay-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vzay-accent),var(--vzay-violet))}
.vzay-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--vzay-muted);margin:0 0 1em}
.vzay-intro-text p:last-child{margin-bottom:0;color:var(--vzay-soft)}
.vzay-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.vzay-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:14px 12px;text-align:center}
.vzay-kpi-card .kv{font-size:clamp(18px,2.2vw,24px);font-weight:900;color:var(--vzay-heading);line-height:1;margin-bottom:4px}
.vzay-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vzay-muted);line-height:1.35}
@media(max-width:900px){.vzay-intro-grid{grid-template-columns:1fr;gap:28px}}
.vzay-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.vzay-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.vzay-toc a{display:inline-block;padding:9px 18px;background:var(--vzay-surface);border:1px solid var(--vzay-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vzay-muted);text-decoration:none!important;transition:border-color .2s,color .2s}
.vzay-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--vzay-accent)}
.vzay-content{background:transparent}
</style>

<main id="primary" class="site-main nero-ai-home-page vzay-page" role="main" tabindex="-1">

<section class="nero-ai-hero vzay-hero-zayavok" id="hero" aria-labelledby="vzay-hero-title">
<style>
/* ── VZAY hero: самодостаточные стили (без CSS темы) ── */
.vzay-hero-zayavok {
  --vzay-cyan: #79f2ff;
  --vzay-violet: #8b5cf6;
  --vzay-green: #22c55e;
  --vzay-text: #e6edf7;
  --vzay-muted: #9aa8bd;
  --vzay-soft: #c7d2e5;
  --vzay-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.vzay-hero-zayavok {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vzay-hero-zayavok::before {
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
.vzay-hero-zayavok::after {
  content: "";
  position: absolute;
  left: 58%;
  top: 12%;
  width: 720px;
  height: 720px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .14), transparent 66%);
  filter: blur(8px);
  animation: vzayHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vzayHeroGlow {
  from { opacity: .4; transform: translateX(-50%) scale(.94); }
  to { opacity: .82; transform: translateX(-50%) scale(1.05); }
}
.vzay-hero-zayavok .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vzay-hero-zayavok .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vzay-hero-zayavok .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.vzay-hero-zayavok .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vzay-cyan) 42%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vzay-hero-zayavok .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--vzay-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vzay-hero-zayavok .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--vzay-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vzay-hero-zayavok .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vzay-hero-zayavok .nero-ai-badge {
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
.vzay-hero-zayavok .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vzay-hero-zayavok .nero-ai-btn {
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
.vzay-hero-zayavok .nero-ai-btn:hover { transform: translateY(-2px); }
.vzay-hero-zayavok .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vzay-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.vzay-hero-zayavok .nero-ai-btn-secondary {
  color: var(--vzay-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vzay-hero-zayavok .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vzay-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.vzay-hero-zayavok .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vzay-hero-zayavok .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vzay-hero-zayavok .nero-ai-dots { display: flex; gap: 7px; }
.vzay-hero-zayavok .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vzay-hero-zayavok .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vzay-hero-zayavok .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vzay-hero-zayavok .nero-ai-dot:nth-child(3) { background: #34d399; }
.vzay-hero-zayavok .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vzay-hero-zayavok .nero-ai-window-body { padding: 16px; }
.vzay-hero-zayavok .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vzay-hero-zayavok .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vzay-hero-zayavok .nero-ai-live-pill {
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
.vzay-hero-zayavok .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vzayPulse 1.6s infinite;
}
@keyframes vzayPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vzay-hero-zayavok .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vzay-hero-zayavok .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vzay-hero-zayavok .nero-ai-metric span {
  display: block;
  color: var(--vzay-muted);
  font-size: 11px;
  font-weight: 700;
}
.vzay-hero-zayavok .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vzay-hero-zayavok .vzay-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.14);
  background: radial-gradient(ellipse at 50% 42%, rgba(121,242,255,.08), rgba(6,10,24,.92) 70%);
}
.vzay-hero-zayavok #vzay-lead-hub-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vzay-hero-zayavok .nero-ai-task-stream { display: grid; gap: 8px; }
.vzay-hero-zayavok .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vzay-hero-zayavok .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--vzay-cyan);
  font-size: 13px;
  font-weight: 800;
}
.vzay-hero-zayavok .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vzay-hero-zayavok .nero-ai-task span {
  color: var(--vzay-muted);
  font-size: 11px;
}
.vzay-hero-zayavok .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vzay-hero-zayavok .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .vzay-hero-zayavok .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vzay-hero-zayavok .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .vzay-hero-zayavok .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vzay-hero-zayavok .nero-ai-window-body { padding: 12px; }
  .vzay-hero-zayavok .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vzay-hero-zayavok .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai заявки с сайта</p>
      <h1 id="vzay-hero-title">AI-агент для первичной обработки заявок с сайта: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Отвечаем на заявки за 5–15 секунд, уточняем потребность и передаём горячий лид в CRM — без ночных потерь</p>
      <ul class="nero-ai-badges" aria-label="Ключевые параметры">
        <li class="nero-ai-badge">5–15 сек</li>
        <li class="nero-ai-badge">CRM auto</li>
        <li class="nero-ai-badge">24/7</li>
        <li class="nero-ai-badge">Human-in-the-loop</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-1" aria-label="Демонстрация AI-обработки заявок с сайта">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>сайт · lead hub</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Ответ</span>
              <strong>8 с</strong>
            </div>
            <div class="nero-ai-metric">
              <span>Каналы</span>
              <strong>3</strong>
            </div>
            <div class="nero-ai-metric">
              <span>CRM</span>
              <strong>sync</strong>
            </div>
            <div class="nero-ai-metric">
              <span>Ночь</span>
              <strong>0 потерь</strong>
            </div>
          </div>

          <div class="vzay-dash-canvas-wrap">
            <canvas id="vzay-lead-hub-canvas" role="img" aria-label="Анимация: заявки с сайта проходят квалификацию AI и синхронизируются с CRM"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">◇</span>
              <div><strong>Форма сайта</strong><span>Новая заявка · UTM сохранён</span></div>
              <span class="nero-ai-status nero-ai-status--amber">вход</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Квалификация AI</strong><span>2 вопроса · intent: горячий</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Сделка в amoCRM</strong><span>Карточка #2041 · задача менеджеру</span></div>
              <span class="nero-ai-status">sync</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
/**
 * vzay-lead-hub-engine — Диспетчерская ночного lead hub
 * Мир: пульсы заявок с сайта → радар приёма → кольца квалификации → луч в CRM-башню
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vzay-lead-hub-canvas");
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
    pulse: "#79f2ff",
    pulseHot: "#fbbf24",
    radar: "rgba(121,242,255,0.18)",
    ring: "rgba(139,92,246,0.45)",
    tower: "#1e293b",
    towerGlow: "#22c55e",
    moon: "#e2e8f0",
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

  function LeadPulseRiver() {
    this.offset = 0;
  }
  LeadPulseRiver.prototype.draw = function (ctx) {
    this.offset = (frame * 0.6) % 120;
    var baseY = 55;
    ctx.strokeStyle = "rgba(121,242,255,0.25)";
    ctx.lineWidth = 2;
    ctx.beginPath();
    for (var x = -cw; x < cw; x += 8) {
      var px = x + this.offset;
      var py = baseY + Math.sin((px + frame) * 0.04) * 6;
      if (x === -cw) ctx.moveTo(px, py);
      else ctx.lineTo(px, py);
    }
    ctx.stroke();

    for (var i = 0; i < 6; i++) {
      var t = ((frame * 1.2 + i * 22) % 200) / 200;
      var lx = -90 + t * 180;
      var ly = baseY + Math.sin((lx + frame) * 0.05) * 5;
      var hot = i % 4 === 0;
      ctx.fillStyle = hot ? C.pulseHot : C.pulse;
      ctx.beginPath();
      ctx.arc(lx, ly, hot ? 4.5 : 3, 0, Math.PI * 2);
      ctx.fill();
      if (hot && t > 0.35 && t < 0.42) {
        createBubble(ctx, lx, ly - 18, "Ночная форма", -1);
      }
    }
  };

  function SiteIntakeRadar() {
    this.sweep = 0;
  }
  SiteIntakeRadar.prototype.draw = function (ctx) {
    this.sweep = (frame * 0.03) % (Math.PI * 2);
    var prg = (frame * 0.045) % 220;

    drawRR(ctx, -48, -62, 96, 124, 12, C.tower, C.outline);

    ctx.strokeStyle = C.radar;
    ctx.lineWidth = 1;
    for (var r = 18; r <= 52; r += 17) {
      ctx.beginPath();
      ctx.arc(0, -10, r, 0, Math.PI * 2);
      ctx.stroke();
    }

    ctx.save();
    ctx.rotate(this.sweep);
    ctx.strokeStyle = "rgba(121,242,255,0.55)";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(0, -10);
    ctx.lineTo(0, -62);
    ctx.stroke();
    ctx.restore();

    if (prg >= 40 && prg < 100) {
      ctx.strokeStyle = C.ring;
      ctx.lineWidth = 3;
      ctx.beginPath();
      ctx.arc(0, -10, 28 + Math.sin(frame * 0.12) * 4, 0, Math.PI * 2);
      ctx.stroke();
      if (prg > 55 && prg < 62) createBubble(ctx, 0, -48, "Уточняем бюджет", -1);
    }

    drawRR(ctx, -22, -38, 44, 28, 4, "#f8fafc", C.outline);
    ctx.fillStyle = "#0f172a";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Заявка", 0, -24);
    ctx.fillText("с сайта", 0, -14);

    ctx.fillStyle = C.moon;
    ctx.beginPath();
    ctx.arc(62, -78, 9, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillStyle = C.tower;
    ctx.beginPath();
    ctx.arc(66, -78, 9, 0, Math.PI * 2);
    ctx.fill();
  };

  function CrmSyncTower() {
    this.beam = 0;
  }
  CrmSyncTower.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 220;
    drawRR(ctx, 72, -50, 38, 88, 8, C.tower, C.outline);
    ctx.fillStyle = "rgba(121,242,255,0.35)";
    ctx.fillRect(82, -38, 18, 8);
    ctx.fillRect(82, -22, 18, 8);
    ctx.fillRect(82, -6, 18, 8);

    if (prg >= 130) {
      var b = Math.min(1, (prg - 130) / 30);
      ctx.strokeStyle = "rgba(34,197,94," + (0.85 - b * 0.5) + ")";
      ctx.lineWidth = 3;
      ctx.beginPath();
      ctx.moveTo(35, -10);
      ctx.lineTo(72 + b * 10, -8);
      ctx.stroke();
      if (prg > 155 && prg < 162) createBubble(ctx, 88, -20, "amoCRM sync", 1);
      if (prg > 175 && prg < 185) {
        ctx.strokeStyle = "rgba(34,197,94,0.5)";
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.arc(91, -6, 8 + (prg - 175), 0, Math.PI * 2);
        ctx.stroke();
      }
    }
  };

  var bubbles = [];
  function createBubble(ctx, x, y, text, dir) {
    bubbles.push({ x: x, y: y, text: text, life: 90, dir: dir || 1 });
  }
  function drawBubbles(ctx) {
    bubbles = bubbles.filter(function (b) {
      b.life--;
      b.y -= 0.35 * b.dir;
      if (b.life <= 0) return false;
      var a = Math.min(1, b.life / 30);
      ctx.globalAlpha = a;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 10, tw, 18, 6, C.bubbleBg, C.pulse);
      ctx.fillStyle = C.bubbleText;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(b.text, b.x, b.y + 2);
      ctx.globalAlpha = 1;
      return true;
    });
  }

  function Agent(role, color, homeX, homeY) {
    this.role = role;
    this.color = color;
    this.homeX = homeX;
    this.homeY = homeY;
    this.x = homeX;
    this.y = homeY;
    this.tx = homeX;
    this.ty = homeY;
    this.bob = Math.random() * Math.PI * 2;
    this.step = 0;
  }
  Agent.prototype.setTarget = function (x, y) {
    this.tx = x;
    this.ty = y;
  };
  Agent.prototype.draw = function (ctx) {
    this.x += (this.tx - this.x) * 0.06;
    this.y += (this.ty - this.y) * 0.06;
    this.bob += 0.08;
    var by = Math.sin(this.bob) * 2;
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(this.x, this.y + by, 5, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1;
    ctx.stroke();
  };

  var dialogs = [
    "Webhook < 1 с",
    "Квалификация: горячий",
    "Поля CRM заполнены",
    "Менеджер уведомлён",
    "Ночь без потерь",
    "Human review: спорный кейс"
  ];

  var agents = [
    new Agent("1_intake", C.agentBlue, -95, 48),
    new Agent("2_qualify", C.agentPurple, -40, 58),
    new Agent("3_crm", C.agentGreen, 25, 52),
    new Agent("4_guard", C.agentPink, 55, 62),
    new Agent("5_notify", C.agentYellow, 100, 50)
  ];

  var river = new LeadPulseRiver();
  var radar = new SiteIntakeRadar();
  var tower = new CrmSyncTower();

  function updateAgents() {
    var prg = (frame * 0.045) % 220;
    if (prg < 70) {
      agents[0].setTarget(-70, 42);
      agents[1].setTarget(-35, 50);
    } else if (prg < 140) {
      agents[1].setTarget(-5, 38);
      agents[2].setTarget(20, 45);
      if (prg > 95 && prg < 102 && Math.random() < 0.02) {
        createBubble(ctx, agents[1].x, agents[1].y - 16, dialogs[1], -1);
      }
    } else {
      agents[2].setTarget(45, 40);
      agents[4].setTarget(85, 42);
      if (prg > 160 && prg < 168 && Math.random() < 0.03) {
        createBubble(ctx, agents[4].x, agents[4].y - 16, dialogs[3], -1);
      }
    }
    agents[3].setTarget(60, 55);
  }

  function loop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    river.draw(ctx);
    tower.draw(ctx);
    radar.draw(ctx);
    updateAgents();
    agents.forEach(function (a) { a.draw(ctx); });
    drawBubbles(ctx);

    ctx.restore();
    requestAnimationFrame(loop);
  }
  loop();
});
</script>
</section>


  <section class="vzay-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="vzay-cnt">
      <div class="vzay-intro-grid nero-ai-reveal">
        <div class="vzay-intro-text">
          <p><strong>AI-агент для первичной обработки заявок с сайта</strong> — программный слой между формой, виджетом или мессенджером и CRM: понимает свободный текст, квалифицирует лид и создаёт карточку в amoCRM или Битрикс24 за секунды, а не часы.</p>
          <p><strong>Коротко:</strong> Nero Network внедряет агента с ответом за 5–15 секунд, human-in-the-loop и интеграцией каналов под ключ. Ориентир бюджета пилота — 120–350 тыс. ₽; первый шаг — бесплатный аудит потерь заявок за 30 минут.</p>
        </div>
        <div class="vzay-intro-kpi" aria-label="Ключевые параметры speed-to-lead">
          <div class="vzay-kpi-card"><div class="kv">5–15 с</div><div class="kl">первый ответ агента</div></div>
          <div class="vzay-kpi-card"><div class="kv">24/7</div><div class="kl">ночные заявки без потерь</div></div>
          <div class="vzay-kpi-card"><div class="kv">3</div><div class="kl">канала: сайт · виджет · TG</div></div>
          <div class="vzay-kpi-card"><div class="kv">CRM</div><div class="kl">sync + саммари диалога</div></div>
        </div>
      </div>
    </div>
  </section>
  <div class="vzay-toc-outer vzay-cnt">
    <nav class="vzay-toc ym-toc nero-ai-reveal" aria-label="Оглавление статьи">
      <a href="#opredelenie">Определение</a>
      <a href="#bole">Почему остывают</a>
      <a href="#agent">AI vs чат</a>
      <a href="#kak-rabotaet">Сценарий</a>
      <a href="#integracii">Интеграции</a>
      <a href="#etapy">Внедрение</a>
      <a href="#keisy">Кейсы</a>
      <a href="#ceny">Стоимость</a>
      <a href="#faq">FAQ</a>
    </nav>
  </div>
  <!-- INTERNAL-LINKS:INSERT -->

<div class="vzay-content" id="vzay-article-root">
<style>
/* VZAY article root — scoped under .vzay-content (Artur: prefix vzay-) */
.vzay-content{
  --vzay-text:#e6edf7;--vzay-muted:#9aa8bd;--vzay-soft:#c7d2e5;--vzay-heading:#fff;
  --vzay-accent:#79f2ff;--vzay-violet:#8b5cf6;--vzay-green:#22c55e;--vzay-border:rgba(255,255,255,.10);
  --vzay-container:1220px;
  color:var(--vzay-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
}
.vzay-content *,.vzay-content *::before,.vzay-content *::after{box-sizing:border-box}
.vzay-content p{color:var(--vzay-muted);line-height:1.72;margin:0 0 1em}
.vzay-content h2,.vzay-content h3{color:var(--vzay-heading);letter-spacing:-.04em;margin:1.4em 0 .65em}
.vzay-content h2{font-size:clamp(24px,3.6vw,42px);line-height:1.08}
.vzay-content h3{font-size:clamp(17px,2.2vw,22px)}
.vzay-content strong{color:var(--vzay-soft)}
.vzay-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.vzay-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vzay-muted);font-size:14.5px;line-height:1.65}
.vzay-content ul li::before{content:'›';position:absolute;left:0;color:var(--vzay-accent);font-weight:700}
.vzay-content ol{margin:0 0 1.2em;padding-left:1.25em;color:var(--vzay-muted);line-height:1.7}
.vzay-content a.vzay-ext{color:var(--vzay-accent);text-decoration:underline;text-underline-offset:3px}
.vzay-cnt{width:min(var(--vzay-container),calc(100% - 40px));margin:0 auto}
.vzay-section{padding:clamp(48px,7vw,96px) 0}
.vzay-section-alt{background:rgba(255,255,255,.03);border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.vzay-lead{font-size:clamp(15px,1.6vw,18px);color:var(--vzay-soft);max-width:820px}
.vzay-stat-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px;margin:28px 0}
.vzay-stat{padding:20px 22px;border-radius:16px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);border-left:4px solid var(--vzay-accent)}
.vzay-stat strong{display:block;font-size:clamp(22px,3vw,30px);color:#fff;margin-bottom:6px}
.vzay-stat span{font-size:13px;color:var(--vzay-muted);line-height:1.5}
.vzay-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.vzay-table{width:100%;border-collapse:collapse;font-size:14px}
.vzay-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--vzay-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25)}
.vzay-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);vertical-align:top}
.vzay-table tbody tr:nth-child(even) td{background:rgba(255,255,255,.02)}
.vzay-table tr:hover td{background:rgba(255,255,255,.04)}
.vzay-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;margin:20px 0;padding:18px;background:rgba(255,255,255,.04);border-radius:14px;border:1px solid rgba(255,255,255,.08)}
.vzay-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(121,242,255,.1);color:var(--vzay-accent);border:1px solid rgba(121,242,255,.2)}
.vzay-faq{display:flex;flex-direction:column;gap:10px;max-width:860px}
.vzay-faq details{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:0}
.vzay-faq summary{padding:18px 22px;font-weight:700;color:var(--vzay-heading);cursor:pointer;list-style:none}
.vzay-faq summary::-webkit-details-marker{display:none}
.vzay-faq .vzay-faq-a{padding:0 22px 18px;font-size:14.5px;color:var(--vzay-muted)}
</style>
<section class="vzay-section" id="opredelenie">
  <div class="vzay-cnt">
    <p class="vzay-lead"><strong>Коротко:</strong> Nero Network внедряет AI-агента, который за 5–15 секунд отвечает на заявки с сайта, уточняет потребность, квалифицирует лид и передаёт подготовленную карточку в amoCRM или Битрикс24 — без потерь ночных и «медленных» ответов менеджеров.</p>
    <h2 id="opredelenie-title">Определение: что такое AI-агент для первичной обработки заявок с сайта</h2>
    <p><strong>AI-агент для первичной обработки заявок с сайта</strong> — программный слой между точкой входа (форма, виджет чата, мессенджер) и CRM. В отличие от скриптового чат-бота, агент понимает свободный текст, задаёт уточняющие вопросы по правилам бизнеса, классифицирует лид (горячий / тёплый / нецелевой), формирует структурированный результат (поля сделки, теги, резюме диалога) и <strong>выполняет действия в CRM</strong>: создаёт или обновляет карточку, двигает этап, ставит задачу менеджеру. Человек подключается на спорных кейсах, нестандартных запросах и на этапе закрытия сделки.</p>
    <p>Если вы ищете <strong>внедрение ai в бизнес</strong> с измеримым эффектом на продажи, первичная обработка заявок — один из самых быстрых сценариев: стек повторяемый (виджет + webhook + LLM + CRM API), а боль «заявка остыла, пока менеджер спал» напрямую связана с метрикой speed-to-lead.</p>
  </div>
</section>
<section class="vzay-section vzay-section-alt" id="bole">
  <div class="vzay-cnt">
    <h2 id="bole-title">Почему заявки с сайта «остывают» и что теряет бизнес</h2>
    <div class="vzay-stat-grid" aria-label="Исследования speed-to-lead">
  <div class="vzay-stat"><strong>~42 ч</strong><span>Среднее время ответа на web-lead среди ответивших (HBR, 2011)</span></div>
  <div class="vzay-stat"><strong>63,5%</strong><span>Demo-форм B2B без ответа (RevenueHero, 2024)</span></div>
  <div class="vzay-stat"><strong>7×</strong><span>Квалификация в первый час vs позже (HBR; не гарантия продажи)</span></div>
</div>
    <p>Заявка с сайта — это не «ещё одна строка в CRM». Это момент, когда клиент уже выбрал вас среди конкурентов и ждёт реакции. Когда ответ приходит через час, на следующий день или не приходит вовсе, интерес падает, а часть лидов уходит к тем, кто ответил первым.</p>
    <h3>Ночные и выходные заявки без ответа</h3>
    <p>Трафик не выключается в 18:00. Формы на лендинге, квизы, виджеты и мессенджеры принимают обращения ночью, в выходные и в праздники. Если в эти окна никто не отвечает, заявки копятся «мёртвым грузом» до понедельника — и конверсия в разговор падает.</p>
    <p>В российских кейсах интеграторы прямо связывают ночной трафик с потерями: у ChatRex для B2B-запчастей зафиксированы <strong>72 заявки</strong> за период, когда онлайн-чат с AI перестал терять ночные обращения (источник: chatrex.pro). У Wazzup в кейсе поставщика бетоноборудования — <strong>72 заявки за месяц</strong> при ответе на первое сообщение менее минуты (wazzup24.ru). Это не универсальный KPI для вашей ниши, но показывает масштаб «спящей» воронки.</p>
    <h3>Медленный первый контакт и падение конверсии</h3>
    <p>Исследования speed-to-lead давно фиксируют разрыв между ожиданием клиента и реальностью отдела продаж:</p>
    <ul><li>По данным <strong>Harvard Business Review (2011)</strong> среди компаний, ответивших на web-lead в течение 30 дней, среднее время ответа составляло <strong>около 42 часов</strong>; <strong>37%</strong> ответили в течение часа, <strong>23%</strong> не ответили вовсе. Попытка связи в первый час ассоциировалась с <strong>примерно в 7× более высокой вероятностью квалификации</strong> по сравнению с откладыванием на час (квалификация — не гарантия продажи). Обзор методологии: aicapitalfactory.com, wearemachina.com.</li><li><strong>RevenueHero (2024)</strong>: из <strong>1000</strong> B2B SaaS demo-форм ответили только <strong>365</strong> компаний — <strong>63,5%</strong> остались без ответа; среднее время среди ответивших — <strong>около 1 дня 5 часов</strong> (revenuehero.io).</li><li>Вендорские сводки по <strong>XANT / InsideSales (2021)</strong> на выборке 5,7 млн лидов указывают на <strong>более чем 8×</strong> разницу в конверсии при первом контакте в первые <strong>5 минут</strong> против 6+ минут — как ориентир направления, а не обещание для каждого МСБ.</li></ul>
    <p><strong>Итог для владельца сайта:</strong> автоматизация обработки заявок через AI — не про «модный чат», а про закрытие разрыва между мгновенным ожиданием клиента и ограниченной ёмкостью менеджеров. <strong>Ai обработка заявок</strong> на первой линии снимает пик ночного и дневного входящего потока, пока люди занимаются переговорами и сделками.</p>
  </div>
</section>
<section class="vzay-section" id="agent">
  <div class="vzay-cnt">
    <h2 id="agent-title">Что делает AI-агент на сайте вместо обычного чата</h2>
    <p>Запросы вроде <strong>ai агент для сайта</strong> и <strong>ai консультант на сайт</strong> часто смешивают три разных уровня решений: FAQ-виджет, классический чат-бот и агента с действиями в CRM. Для коммерческого B2B и МСБ с воронкой в amoCRM или Битрикс24 критичен именно третий уровень.</p>
    <h3>Ответ за 5–15 секунд и уточняющие вопросы</h3>
    <p>Коммерческий оффер Nero Network: агент отвечает за <strong>5–15 секунд</strong>, задаёт <strong>2–4 уточняющих вопроса</strong> под нишу (услуги, онлайн-школа, клиника) и собирает контакт без «допроса BANT». Скорость сопоставима с лучшими российскими внедрениями: у Novabiom на первой линии SLA <strong>менее 1 минуты</strong> на сайте, Telegram и WhatsApp (кейс на РБК Компании); у CHIGRINOV для окон первый ответ сократился с <strong>2–4 часов до 30 секунд</strong> при ~40 заявках в день (chigrinov.ru).</p>
    <h3>Квалификация лида перед передачей менеджеру</h3>
    <p><strong>Ai менеджер заявок</strong> в нашей модели не «продаёт вместо человека». Он:</p>
    <ul><li>отсекает явный спам и нецелевые запросы;</li><li>заполняет обязательные поля CRM;</li><li>присваивает статус горячий / тёплый / нецелевой;</li><li>готовит краткое резюме диалога для менеджера.</li></ul>
    <p>В B2B-кейсе металлопроката на РБК указан ориентир <strong>CR в квалифицированный лид 22%</strong> за месяц (не универсальная норма, а пример отрасли с чеком от 50 тыс. ₽). У NOVA AI в amoCRM для автозапчастей конверсия «обращение → квалифицированный лид» выросла с <strong>22% до 33%</strong>, время первого ответа — с <strong>15 минут до 1 минуты</strong> (nova-amocrm.ru).</p>
    <h3>Агент с действиями в CRM vs «просто болталка»</h3>
    <p>Тренд <strong>внедрение ai агентов</strong> в 2025–2026 — сдвиг от бота, который <strong>отвечает</strong>, к агенту, который <strong>действует</strong>: создаёт сделку, читает историю, меняет стадию, ставит задачу. Обзор Нетологии формулирует разницу наглядно: на запрос «как оформить возврат» бот выдаёт инструкцию; на задачу «оформи возврат по заказу №123» агент создаёт заявку сам (netology.ru).</p>
    <div class="vzay-table-wrap"><table class="vzay-table"><thead><tr><th>Критерий</th><th>Классический чат / FAQ</th><th>Менеджер вручную</th><th>AI-агент с CRM-actions</th></tr></thead><tbody><tr><td>Скорость первого ответа</td><td>Быстро, но шаблонно</td><td>Зависит от графика</td><td>5–15 с, 24/7</td></tr><tr><td>Понимание свободного текста</td><td>Ограничено</td><td>Высокое</td><td>Высокое (LLM + правила)</td></tr><tr><td>Запись в CRM</td><td>Часто вручную</td><td>Да, но с задержкой</td><td>Автоматически</td></tr><tr><td>Квалификация</td><td>Слабая</td><td>Сильная</td><td>По матрице бизнеса</td></tr><tr><td>Масштаб без найма</td><td>Да</td><td>Нет</td><td>Да</td></tr></tbody></table></div>
    
    <p>OpenAI для корпоративного inbound описывает тот же контур: ассистент не заменяет SDR, а расширяет — ответы из документации и playbooks, handoff к менеджеру с контекстом; цикл eval поднял точность первых ответов <strong>с ~60% до >98% за недели</strong> во внутреннем кейсе (openai.com) — как референс процесса, не как гарантия для пилота МСБ.</p>
    <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Хотите понимать агентов до старта пилота?</p>
    <p class="ym-cta-block__sub">Если команда хочет разобраться в промптах, human-in-the-loop и интеграции с CRM до заказа внедрения — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>. Это ускоряет согласование сценария квалификации с отделом продаж.</p>
  </div>
</aside>
  </div>
</section>
<section id="vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block" class="bvz-root" aria-label="Анимация: мультиканальные заявки и синхронизация с CRM">
<style>
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block.bvz-root{padding:56px 0 64px;background:#f8fafc}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-cnt{max-width:1160px;margin:0 auto;padding:0 24px}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-card{display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);min-height:460px}
@media(max-width:1023px){#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-card{grid-template-columns:1fr;min-height:auto}}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-lft{padding:36px 32px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0}
@media(max-width:1023px){#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:28px 22px}}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-ey{font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0284c7;margin:0 0 12px}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-h3{font-size:clamp(20px,2.4vw,26px);line-height:1.2;color:#0f172a;margin:0 0 16px}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-ul{list-style:none;margin:0 0 18px;padding:0}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-ul li{display:flex;gap:10px;font-size:14px;color:#475569;line-height:1.55;margin-bottom:10px}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-ic{width:22px;height:22px;border-radius:8px;background:#e0f2fe;color:#0369a1;font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:12px}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-pl{font-size:11px;font-weight:700;padding:6px 10px;border-radius:999px}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-pl-g{background:#dcfce7;color:#166534}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-pl-b{background:#e0f2fe;color:#075985}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-pl-v{background:#ede9fe;color:#5b21b6}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-foot{font-size:13px;color:#64748b;margin:0;font-style:italic}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-rgt{position:relative;background:linear-gradient(135deg,#f0f9ff 0%,#e0f2fe 50%,#f8fafc 100%);min-height:400px}
#bvz-lead-hub-canvas{position:absolute;inset:0;width:100%;height:100%;display:block}
</style>
<div class="bvz-cnt"><div class="bvz-card">
<div class="bvz-lft">
<span class="bvz-ey">Маршрут заявки · 24/7</span>
<h3 class="bvz-h3">Форма, виджет и мессенджер — один агент, одна воронка в CRM</h3>
<ul class="bvz-ul">
<li><span class="bvz-ic">🌙</span>Ночные обращения не ждут понедельника: агент отвечает за секунды</li>
<li><span class="bvz-ic">⚡</span>Квалификация и structured output до попадания в amoCRM / Битрикс24</li>
<li><span class="bvz-ic">↗</span>Эскалация human-in-the-loop на спорных кейсах без обещаний по цене</li>
</ul>
<div class="bvz-pills">
<span class="bvz-pl bvz-pl-g">5–15 с ответ</span>
<span class="bvz-pl bvz-pl-b">3 канала</span>
<span class="bvz-pl bvz-pl-v">CRM sync</span>
</div>
<p class="bvz-foot">Дальше — пошаговый сценарий от клика до карточки сделки ↓</p>
</div>
<div class="bvz-rgt"><canvas id="bvz-lead-hub-canvas" role="img" aria-label="Анимация: заявки с сайта и мессенджеров проходят AI-квалификацию и синхронизируются с CRM"></canvas></div>
</div></div>
<script>
(function(){
'use strict';
var cv=document.getElementById('bvz-lead-hub-canvas');
if(!cv)return;
var ctx=cv.getContext('2d'),W=0,H=0,f=0;
function resize(){var p=cv.parentElement;if(!p)return;cv.width=p.clientWidth||640;cv.height=p.clientHeight||420;W=cv.width;H=cv.height;}
window.addEventListener('resize',resize);resize();
var C={ink:'#0f172a',cyan:'#06b6d4',vio:'#8b5cf6',green:'#22c55e',amber:'#f59e0b',muted:'#64748b',card:'#fff',line:'rgba(6,182,212,.35)'};
var nodes=[{id:'form',label:'Форма',x:0,y:0,color:C.cyan},{id:'chat',label:'Виджет',x:0,y:0,color:C.vio},{id:'tg',label:'Telegram',x:0,y:0,color:C.amber}];
var hub={x:0,y:0,r:36},crm={x:0,y:0,w:120,h:90};
var packets=[];
function spawn(){var n=nodes[Math.floor(Math.random()*nodes.length)];packets.push({sx:n.x,sy:n.y,x:n.x,y:n.y,tx:hub.x,ty:hub.y,phase:0,speed:1.4+Math.random()*0.8,color:n.color});}
function rr(x,y,w,h,r,fill,stroke){ctx.beginPath();if(ctx.roundRect)ctx.roundRect(x,y,w,h,r);else ctx.rect(x,y,w,h);if(fill){ctx.fillStyle=fill;ctx.fill();}if(stroke){ctx.strokeStyle=stroke;ctx.lineWidth=1.5;ctx.stroke();}}
function draw(){
f++;ctx.clearRect(0,0,W,H);
var pad=24;hub.x=W*0.52;hub.y=H*0.5;crm.x=W*0.78;crm.y=H*0.42;
nodes[0].x=pad+40;nodes[0].y=H*0.28;nodes[1].x=pad+40;nodes[1].y=H*0.5;nodes[2].x=pad+40;nodes[2].y=H*0.72;
ctx.strokeStyle=C.line;ctx.lineWidth=2;ctx.setLineDash([6,6]);ctx.beginPath();ctx.moveTo(hub.x+hub.r,hub.y);ctx.lineTo(crm.x,crm.y+crm.h/2);ctx.stroke();ctx.setLineDash([]);
nodes.forEach(function(n){rr(n.x-36,n.y-18,72,36,10,'#fff',n.color);ctx.fillStyle=C.ink;ctx.font='bold 12px system-ui';ctx.textAlign='center';ctx.fillText(n.label,n.x,n.y+4);});
var pulse=0.5+0.5*Math.sin(f*0.06);
rr(hub.x-hub.r,hub.y-hub.r,hub.r*2,hub.r*2,14,'#f5f3ff',C.vio);ctx.fillStyle=C.vio;ctx.font='bold 14px system-ui';ctx.textAlign='center';ctx.fillText('AI',hub.x,hub.y-2);ctx.font='10px system-ui';ctx.fillStyle=C.muted;ctx.fillText('квалификация',hub.x,hub.y+14);
rr(crm.x,crm.y,crm.w,crm.h,12,C.card,C.cyan);ctx.fillStyle=C.ink;ctx.font='bold 11px system-ui';ctx.textAlign='left';ctx.fillText('CRM',crm.x+12,crm.y+22);ctx.fillStyle=C.muted;ctx.font='10px system-ui';ctx.fillText('лид + саммари',crm.x+12,crm.y+40);
if(f%45===0)spawn();
packets.forEach(function(p,i){
if(p.phase===0){p.x+=(hub.x-p.x)*0.04*p.speed;p.y+=(hub.y-p.y)*0.04*p.speed;if(Math.hypot(p.x-hub.x,p.y-hub.y)<hub.r+8){p.phase=1;p.tx=crm.x+20;p.ty=crm.y+crm.h/2;}}
else{p.x+=(p.tx-p.x)*0.05;p.y+=(p.ty-p.y)*0.05;ctx.fillStyle=p.color;ctx.beginPath();ctx.arc(p.x,p.y,5,0,Math.PI*2);ctx.fill();if(Math.hypot(p.x-p.tx,p.y-p.ty)<6)packets.splice(i,1);}
if(p.phase===0){ctx.fillStyle=p.color;ctx.beginPath();ctx.arc(p.x,p.y,6,0,Math.PI*2);ctx.fill();}
});
var night=f%600<300;ctx.fillStyle=night?'#1e293b':'#fef9c3';ctx.globalAlpha=0.85;rr(W-pad-88,pad,80,26,8,night?'#1e293b':'#fef9c3',night?'#334155':'#fde047');ctx.globalAlpha=1;ctx.fillStyle=night?'#e2e8f0':'#854d0e';ctx.font='10px system-ui';ctx.textAlign='center';ctx.fillText(night?'Ночь · 0 потерь':'День · SLA',W-pad-48,pad+16);
requestAnimationFrame(draw);
}
draw();
})();
</script>
</section>
<section class="vzay-section vzay-section-alt" id="kak-rabotaet">
  <div class="vzay-cnt">
    <h2 id="kak-rabotaet-title">Сценарий первичной обработки заявки от клика до CRM</h2>
    <p>Ниже — типовая логика <strong>ai обработка заявок</strong> при внедрении под ключ в Nero Network (согласована с проектной моделью и публичными кейсами рынка).</p>
    <ol><li><strong>Событие:</strong> отправка формы, первое сообщение в виджете, webhook из Tilda/WordPress.</li><li><strong>Нормализация:</strong> телефон, UTM, страница входа, метка «ночь/день».</li><li><strong>Диалог:</strong> приветствие + уточняющие вопросы под ваш скрипт.</li><li><strong>Классификация и structured output (JSON):</strong> intent, бюджетный диапазон, срочность, причина отсева.</li><li><strong>Действия (tools):</strong> <code>crm_create_lead</code>, <code>crm_update_fields</code>, <code>crm_add_note_summary</code>, <code>notify_manager</code> (Telegram или задача в CRM).</li><li><strong>Эскалация:</strong> неуверенность модели, негатив, юридически чувствительные темы → <code>human_review</code> без автодоговорённостей по цене и срокам.</li></ol>
    <h3>Сбор контакта и потребности</h3>
    <p>Агент не дублирует менеджера на этапе «вытащить телефон из переписки». Он ведёт клиента к оставлению контакта естественно: сначала ценность (ответ на вопрос, ориентир по услуге в рамках БЗ), затем поля, которые нужны CRM для следующего шага.</p>
    <h3>Правила «горячего» лида и эскалация человеку (human-in-the-loop)</h3>
    <p><strong>Human-in-the-loop</strong> — обязательная часть B2B-внедрения, особенно для клиник и юридических услуг из вашей целевой аудитории:</p>
    <ul><li>горячий лид → задача ответственному менеджеру за N минут по вашему SLA;</li><li>спорный кейс → передача диалога без обещаний, которые агент не имеет права давать;</li><li>контроль качества — выборочный разбор диалогов и правки промпта (как в цикле eval у OpenAI inbound assistant).</li></ul>
    <p>Менеджер получает не «голый телефон», а <strong>подготовленную карточку</strong>: что спросил клиент, что уже согласовано, какие поля заполнены.</p>
  </div>
</section>
<section class="vzay-section" id="integracii">
  <div class="vzay-cnt">
    <h2 id="integracii-title">Интеграции: виджет сайта, мессенджеры, amoCRM и Битрикс24</h2>
    <p>Запрос <strong>ai обработка заявок с crm</strong> и <strong>интеграция ai обработка заявок с crm</strong> закрывается единой архитектурой: один агент — несколько входов, один адаптер CRM.</p>
    <h3>Виджет и формы на сайте (ai бот для сайта)</h3>
    <p>Точки входа: встроенный виджет, формы Tilda/WordPress/Bitrix-сайт, callback-кнопки. Webhook уходит на оркестратор (n8n, Make, Python) с очередью и ретраями; ответ клиенту — за секунды, запись в CRM — параллельно.</p>
    <h3>Telegram и другие каналы</h3>
    <p>Мультиканальность подтверждают кейсы: Novabiom (сайт + Telegram + WhatsApp через Wazzup), Ultima.school (сайт → WhatsApp → amoCRM, textback.ru), ~40 заявок/день с сайта, VK и Авито в кейсе CHIGRINOV. Для МСБ это аргумент против «у нас только форма»: <strong>нейросеть для обработки лидов</strong> может вести один сценарий квалификации везде, где клиент пишет первым.</p>
    <h3>Поля сделки, задачи и уведомления в CRM</h3>
    <p><strong>Интеграция ai обработка заявок с crm</strong> включает:</p>
    <ul><li>создание и обновление лида/сделки;</li><li>теги и этапы воронки;</li><li>саммари диалога в примечании;</li><li>задача «перезвонить» с дедлайном;</li><li>опционально — callback-триггер после квалификации.</li></ul>
    <p>Поддерживаемые CRM в типовом проекте: <strong>amoCRM</strong>, <strong>Битрикс24</strong> (в т.ч. открытые линии и виджет на базе корпоративной БЗ — см. кейс сети отелей на ruward.ru, −20% времени на типовые запросы по материалу кейса).</p>
    <p>Возможные дополнения стека: Roistat/сквозная аналитика, цели в Метрике на «квалифицированный лид в CRM», RAG по Notion/Google Docs, выбор LLM (GPT-4o/mini, Claude, GigaChat, YandexGPT) по политике клиента.</p>
  </div>
</section>
<section class="vzay-section vzay-section-alt" id="etapy">
  <div class="vzay-cnt">
    <h2 id="etapy-title">Как проходит внедрение AI для обработки заявок под ключ</h2>
    <p><strong>Внедрение ai обработка заявок</strong> и <strong>настройка ai обработка заявок</strong> в Nero Network — поэтапный проект с пилотом <strong>2–4 недели</strong>, ориентир бюджета из ТЗ: <strong>120–350 тыс. ₽</strong> старт + сопровождение (точная смета — после аудита каналов и CRM).</p>
    <h3>Аудит текущего пути заявки (лид-магнит 30 минут)</h3>
    <p>Бесплатный <strong>аудит потерь заявок за 30 минут</strong> — практический вход, а не абстрактный «заказать внедрение». На созвоне фиксируем:</p>
    <ul><li>карту каналов (форма, виджет, мессенджеры);</li><li>median time-to-first-response;</li><li>долю заявок вне рабочего времени;</li><li>узкие места CRM (пустые карточки, ручной копипаст).</li></ul>
    <aside class="ym-cta-block ym-cta-block--primary" id="cta-audit">
      <div class="ym-cta-block__icon" aria-hidden="true">⏱️</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Аудит потерь заявок за 30 минут — бесплатно</p>
        <p class="ym-cta-block__sub">Соберём карту каналов (форма, виджет, мессенджеры), оценим время первого ответа и долю заявок вне рабочего времени. На выходе — понятный план пилота <strong>ai обработка заявок под ключ</strong> без обязательств.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </aside>
    <h3>Настройка сценария, базы знаний и тест на реальных диалогах</h3>
    <ul><li>матрица квалификации: обязательные поля, стоп-слова, запрет автообещаний по цене/срокам/медицинским советам;</li><li>RAG только по <strong>утверждённой</strong> базе знаний;</li><li>калибровка на <strong>10–20 обезличенных</strong> реальных переписках;</li><li>MVP обычно на <strong>одном канале</strong> (виджет + одна CRM): webhook <1 с → агент 5–15 с → create/update lead.</li></ul>
    <h3>Запуск, мониторинг и доработка по метрикам</h3>
    <p>После запуска отслеживаем без выдуманных «обещаний ROI»:</p>
    <ul><li>время первого ответа (секунды/минуты);</li><li>доля авто-квалификации vs эскалаций;</li><li>полнота карточек CRM;</li><li>качество саммари (выборочный разбор).</li></ul>
    <p>Пилот <strong>2–3 недели</strong>: разбор 20–30 диалогов в неделю, правки промпта и tools, чеклист эскалаций. Затем — подключение Telegram/WhatsApp и дублирование правил в Битрикс24 при необходимости.</p>
  </div>
</section>
<section class="vzay-section" id="bezopasnost">
  <div class="vzay-cnt">
    <h2 id="bezopasnost-title">Безопасность, качество ответов и контроль бренда</h2>
    <p>B2B-клиенты справедливо боятся галлюцинаций и «бота, который соврёт про скидку». Блок E-E-A-T для <strong>ai обработка заявок для бизнеса</strong> строится на ограничениях, а не на обещаниях «100% автономии».</p>
    <h3>Ограничения агента и запретные темы</h3>
    <ul><li>агент <strong>не</strong> фиксирует индивидуальные цены, скидки и юридические обязательства без human_review;</li><li>медицинские и юридические ниши — только сценарии записи и сбор анкеты, без диагнозов и правовых выводов;</li><li>RAG и guardrails: ответы только из разрешённых документов;</li><li>логирование диалогов для разбора инцидентов.</li></ul>
    <h3>Передача сложных кейсов менеджеру</h3>
    <p>Возражение «бот отпугнёт» закрывается эскалацией и тоном под бренд. В кейсах B2B и B2C (металлопрокат, автозапчасти, онлайн-школы) клиенты принимают быстрый первый контакт, если дальше подключается живой специалист с контекстом.</p>
    <p><strong>Что остаётся за человеком:</strong> переговоры, индивидуальное КП, эмоциональные кейсы, контроль качества. <strong>Что делает AI:</strong> парсинг текста в поля, квалификационный диалог, резюме, маршрутизация, отсев спама.</p>
  </div>
</section>
<section class="vzay-section vzay-section-alt" id="keisy">
  <div class="vzay-cnt">
    <h2 id="keisy-title">Кейсы и примеры внедрения AI для заявок с сайта</h2>
    <p>Раздел <strong>ai кейсы внедрения</strong> и <strong>примеры внедрения ai</strong> — только с именованными источниками (не выдуманные «+300% выручки»).</p>
    <div class="vzay-table-wrap"><table class="vzay-table"><thead><tr><th>Кейс</th><th>Что сделано</th><th>Цифра/эффект (по источнику)</th><th>Ссылка</th></tr></thead><tbody><tr><td>Novabiom</td><td>Сайт + мессенджеры + amoCRM</td><td>SLA <1 мин, 100% входящего на первой линии</td><td><a href="https://companies.rbc.ru" class="vzay-ext" target="_blank" rel="noopener noreferrer">companies.rbc.ru</a></td></tr><tr><td>Металлопрокат B2B</td><td>Сайт → WhatsApp → amoCRM</td><td>CR в квал. лид ~22% (месяц)</td><td><a href="https://companies.rbc.ru" class="vzay-ext" target="_blank" rel="noopener noreferrer">companies.rbc.ru</a></td></tr><tr><td>ГК «ГИДРО» / ChatRex</td><td>Онлайн-чат + amoCRM</td><td>Конверсия 13%→18%, 72 заявки за период</td><td><a href="https://chatrex.pro" class="vzay-ext" target="_blank" rel="noopener noreferrer">chatrex.pro</a></td></tr><tr><td>Автозапчасти / NOVA AI</td><td>Агент в amoCRM</td><td>15 мин→1 мин; квал. лид 22%→33%; −12,4 ч/нед рутины</td><td><a href="https://nova-amocrm.ru" class="vzay-ext" target="_blank" rel="noopener noreferrer">nova-amocrm.ru</a></td></tr><tr><td>Окна / CHIGRINOV</td><td>Сайт, VK, Авито → Telegram → amoCRM</td><td>Первый ответ 2–4 ч→30 с; 80% без менеджера; +22% в замер</td><td><a href="https://chigrinov.ru" class="vzay-ext" target="_blank" rel="noopener noreferrer">chigrinov.ru</a></td></tr><tr><td>Ultima.school</td><td>Сайт → WhatsApp → amoCRM</td><td>Рост обработки лидов (кейс TextBack)</td><td><a href="https://textback.ru" class="vzay-ext" target="_blank" rel="noopener noreferrer">textback.ru</a></td></tr><tr><td>Бетоноборудование</td><td>Форма → WhatsApp → amoCRM</td><td><1 мин на первое сообщение; 72 заявки/мес</td><td><a href="https://wazzup24.ru" class="vzay-ext" target="_blank" rel="noopener noreferrer">wazzup24.ru</a></td></tr><tr><td>Сеть отелей</td><td>VisGPT + Битрикс24</td><td>−20% времени на типовые запросы</td><td><a href="https://ruward.ru" class="vzay-ext" target="_blank" rel="noopener noreferrer">ruward.ru</a></td></tr></tbody></table></div>
    <p>Международный контекст: шаблон n8n (форма → GPT-4o скоринг → HubSpot/Slack) иллюстрирует архитектуру «форма → AI → CRM + алерт» — переносима на amoCRM и Telegram для РФ-стека.</p>
    <p><strong>Ai обработка заявок для малого бизнеса</strong> оправдана, когда есть стабильный поток с сайта и CRM уже используется: эффект — в скорости и дисциплине карточек, а не в замене всего отдела продаж.</p>
  </div>
</section>
<section class="vzay-section" id="ceny">
  <div class="vzay-cnt">
    <h2 id="ceny-title">Стоимость и форматы сопровождения</h2>
    <p>Вопрос <strong>ai обработка заявок цена</strong> зависит от числа каналов, глубины интеграции CRM, объёма базы знаний и требований к compliance.</p>
    <p><strong>Ориентир из коммерческого ТЗ:</strong> старт <strong>120–350 тыс. ₽</strong> + поддержка (обновление БЗ, мониторинг диалогов, доработка сценариев). В эту вилку обычно входят аудит, MVP на одном канале, пилот 2–4 недели и передача документации.</p>
    <p>Сравнение «в лоб» с наймом ещё одного менеджера на первую линию — качественное: один пропущенный ночной лид с высоким чеком часто дороже пилота, но точный расчёт возможен только после <strong>аудита потерь за 30 минут</strong> — мы считаем ваши каналы, а не подставляем средние по рынку.</p>
    <p>Форматы сопровождения после запуска: ежемесячный разбор метрик, пакет часов на правки промпта, подключение новых каналов (WhatsApp, Telegram), расширение RAG.</p>
  </div>
</section>
<section class="vzay-section vzay-section-alt" id="faq">
  <div class="vzay-cnt">
    <div class="vzay-faq">
    <h2 id="faq-title">FAQ: внедрение, CRM, сроки и результат</h2>
    <details class="vzay-faq-item"><summary>Как внедрить ai обработка заявок в действующий сайт?</summary><div class="vzay-faq-a"><p><strong>Короткий ответ:</strong> подключаем webhook с формы или виджета к оркестратору, настраиваем агента и CRM-адаптер, тестируем на пилотном трафике без отключения текущих процессов. Сайт на Tilda, WordPress или Bitrix не нужно «переписывать» — достаточно точки входа и доступа к API CRM. Срок типового пилота — <strong>2–4 недели</strong>.</p></div></details>
    <details class="vzay-faq-item"><summary>Какая интеграция ai обработка заявок с crm нужна?</summary><div class="vzay-faq-a"><p><strong>Короткий ответ:</strong> минимум — создание/обновление лида или сделки, заполнение полей, примечание с саммари, задача менеджеру. Для amoCRM и Битрикс24 используем официальные API; мессенджеры — через Wazzup, TextBack или Telegram Bot API. Один агент может обслуживать несколько входов с едиными правилами квалификации.</p></div></details>
    <details class="vzay-faq-item"><summary>Подходит ли решение для малого бизнеса?</summary><div class="vzay-faq-a"><p><strong>Короткий ответ:</strong> да, если у вас уже есть сайт с заявками и CRM (или готовность вести лиды в amoCRM/Битрикс24). Для микробизнеса без CRM сначала имеет смысл навести порядок в воронке; для услуг, онлайн-школ и клиник с записью — типовой профиль из ТЗ.</p></div></details>
    <details class="vzay-faq-item"><summary>Чем отличается от AI-обработки почты?</summary><div class="vzay-faq-a"><p><strong>Короткий ответ:</strong> эта страница про <strong>заявки с сайта и виджета</strong> в момент обращения, а не про разбор входящей почты. Сценарий email и интеграции с ящиком — отдельный продуктовый контур; здесь фокус на speed-to-lead с формы и чата.</p></div></details>
    <details class="vzay-faq-item"><summary>Сколько времени до первых результатов?</summary><div class="vzay-faq-a"><p>После MVP на одном канале метрика <strong>времени первого ответа</strong> обычно меняется в первую же неделю (с часов до секунд). Влияние на <strong>закрытие сделок</strong> зависит от ниши, чека и работы менеджеров после передачи лида — мы честно разделяем квалификацию и продажу, как в методологии HBR.</p></div></details>
    <details class="vzay-faq-item"><summary>Заменит ли ai менеджер заявок отдел продаж?</summary><div class="vzay-faq-a"><p>Нет. Агент закрывает <strong>первую линию</strong>: скорость, квалификация, CRM-дисциплина. Переговоры, КП и закрытие — за людьми. В кейсе CHIGRINOV <strong>80%</strong> заявок обрабатываются без менеджера на этапе первички — но замер и сделку всё равно ведут люди.</p></div></details>
    <details class="vzay-faq-item"><summary>Какие данные нужны от нас для старта?</summary><div class="vzay-faq-a"><p>Скрипт квалификации и FAQ (хотя бы черновик), поля CRM и этапы воронки, запрещённые формулировки, 10–20 реальных переписок, регламент SLA менеджера после «горячего» лида.</p></div></details>
    </div>
  </div>
</section>

<section class="vzay-section vzay-section-cta" id="cta-final" aria-labelledby="cta-final-title">
  <div class="nero-ai-container vzay-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final">
      <div class="ym-cta-block__body">
        <h2 id="cta-final-title" class="ym-cta-block__headline">Проверьте, сколько заявок вы теряете</h2>
        <p class="ym-cta-block__sub">Короткий квиз и аудит потерь за 30 минут: каналы, ночные заявки, интеграция виджета и CRM, human-in-the-loop. Внедрение пилота обычно 2–4 недели, ориентир бюджета 120–350 тыс. ₽ — точная смета после ваших цифр.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary">Сначала FAQ</a>
        </div>
      </div>
    </div>
  </div>
</section>
</div>

  <!-- SCHEMA-MARKUP:INSERT -->
</main>

<script>
(function(){
  'use strict';
  var root=document.querySelector('.vzay-page');
  if(!root)return;
  var items=root.querySelectorAll('.nero-ai-reveal');
  if('IntersectionObserver' in window){
    var observer=new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){entry.target.classList.add('nero-ai-active');observer.unobserve(entry.target);}
      });
    },{threshold:0.1,rootMargin:'0px 0px -6% 0px'});
    items.forEach(function(item){observer.observe(item);});
  }else{items.forEach(function(item){item.classList.add('nero-ai-active');});}
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

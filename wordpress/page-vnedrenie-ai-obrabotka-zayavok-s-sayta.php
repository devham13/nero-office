<?php
/**
 * Template Name: Внедрение AI-обработки заявок с сайта под ключ
 * Description: AI отвечает на заявки с сайта за 5–15 секунд, квалифицирует лид и передаёт горячий лид в CRM.
 */

declare(strict_types=1);

$page_seo_title       = 'Внедрение AI-обработки заявок с сайта под ключ — лиды в CRM';
$page_seo_description = 'AI отвечает на заявки с сайта за 5–15 секунд, задаёт уточняющие вопросы и передаёт горячий лид в CRM. Внедрение под ключ для МСБ. Проверьте, сколько заявок теряете ночью.';

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

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: '');

$nero_ai_header_links = [
    ['label' => 'Боль и SLA', 'href' => '#zayavki-ostyvayut'],
    ['label' => 'Что это', 'href' => '#chto-takoe-ai-obrabotka'],
    ['label' => 'Как работает', 'href' => '#kak-agent-5-15-sekund'],
    ['label' => 'CRM', 'href' => '#peredacha-v-crm'],
    ['label' => 'Этапы', 'href' => '#vnedrenie-pod-klyuch'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'Compliance', 'href' => '#compliance'],
    ['label' => 'FAQ', 'href' => '#faq'],
    ['label' => 'Аудит', 'href' => '#cta-proverit'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить, сколько заявок вы теряете';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы';
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
/* Kadence reset + breadcrumbs hide */
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}.nero-ai-delay-2{transition-delay:.24s}
.vnedrenie-ai-obrabotka-zayavok-s-sayta-page .vzay-hero-zayavok.nero-ai-hero{min-height:min(980px,calc(100dvh - 1px));position:relative}
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-obrabotka-zayavok-s-sayta-page" role="main" tabindex="-1">

<section class="nero-ai-hero vzay-hero-zayavok" id="hero" aria-labelledby="vzay-hero-title">
<style>
/* Hero: vnedrenie-ai-obrabotka-zayavok-s-sayta — самодостаточные стили */
.vzay-hero-zayavok {
  --vzay-cyan: #79f2ff;
  --vzay-violet: #8b5cf6;
  --vzay-green: #22c55e;
  --vzay-amber: #fbbf24;
  --vzay-text: #e6edf7;
  --vzay-muted: #9aa8bd;
  --vzay-soft: #c7d2e5;
  --vzay-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
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
  mask-image: radial-gradient(circle at 38% 28%, #000 0%, transparent 74%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.vzay-hero-zayavok::after {
  content: "";
  position: absolute;
  left: 18%;
  top: 8%;
  width: 720px;
  height: 720px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .14), transparent 68%);
  filter: blur(8px);
  animation: vzayHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vzayHeroGlow {
  from { opacity: .4; transform: scale(.94); }
  to { opacity: .82; transform: scale(1.05); }
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
.vzay-hero-zayavok .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--vzay-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vzay-hero-zayavok h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(36px, 5.6vw, 68px);
  line-height: 0.98;
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
.vzay-hero-zayavok .nero-ai-lead {
  margin: 22px 0 0;
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
.vzay-hero-zayavok .nero-ai-cta-row {
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
.vzay-hero-zayavok .nero-ai-dashboard-note {
  margin: 0;
  color: #94a3b8;
  font-size: 10px;
  font-weight: 700;
  letter-spacing: .08em;
  text-transform: uppercase;
  text-align: right;
  flex: 1;
}
.vzay-hero-zayavok .nero-ai-dash-header {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vzay-hero-zayavok .nero-ai-dash-title {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
  font-weight: 800;
}
.vzay-hero-zayavok .nero-ai-dash-status {
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
.vzay-hero-zayavok .nero-ai-dash-status::before {
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
.vzay-hero-zayavok .nero-ai-dash-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vzay-hero-zayavok .nero-ai-dash-card {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vzay-hero-zayavok .nero-ai-dash-card span {
  display: block;
  color: var(--vzay-muted);
  font-size: 11px;
  font-weight: 700;
}
.vzay-hero-zayavok .nero-ai-dash-card strong {
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
  border: 1px solid rgba(139, 92, 246, 0.18);
  background: radial-gradient(ellipse at 30% 35%, rgba(121,242,255,.07), rgba(6,10,24,.92) 72%);
}
.vzay-hero-zayavok #vzay-site-lead-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vzay-hero-zayavok .nero-ai-dash-feed {
  display: grid;
  gap: 8px;
}
.vzay-hero-zayavok .nero-ai-dash-row {
  display: grid;
  grid-template-columns: 10px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
  color: #e2e8f0;
  font-size: 12px;
  font-weight: 600;
}
.vzay-hero-zayavok .nero-ai-dash-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
}
.vzay-hero-zayavok .nero-ai-dash-dot--blue { background: #60a5fa; box-shadow: 0 0 10px rgba(96,165,250,.45); }
.vzay-hero-zayavok .nero-ai-dash-dot--green { background: #22c55e; box-shadow: 0 0 10px rgba(34,197,94,.4); }
.vzay-hero-zayavok .nero-ai-dash-dot--amber { background: #fbbf24; box-shadow: 0 0 10px rgba(251,191,36,.35); }
.vzay-hero-zayavok .nero-ai-dash-tag {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vzay-hero-zayavok .nero-ai-dash-tag--hot {
  background: rgba(251,191,36,.14);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .vzay-hero-zayavok .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vzay-hero-zayavok .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .vzay-hero-zayavok .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vzay-hero-zayavok .nero-ai-dash-row { grid-template-columns: 10px 1fr; }
  .vzay-hero-zayavok .nero-ai-dash-tag { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container">
    <div class="nero-ai-hero-grid">
      <div class="nero-ai-hero-copy">
        <p class="nero-ai-eyebrow"><?php echo esc_html(($brand ?? get_bloginfo('name')) . ' · ai обработка заявок с сайта'); ?></p>
        <h1 id="vzay-hero-title">AI-агент для первичной обработки заявок с сайта: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
        <p class="nero-ai-lead">Ответ на заявку за 5–15 секунд, квалификация лида и передача в CRM — пока менеджеры спят, AI не теряет продажи</p>
        <ul class="nero-ai-badges" aria-label="Ключевые возможности">
          <li class="nero-ai-badge">5–15 сек ответ</li>
          <li class="nero-ai-badge">Квалификация лида</li>
          <li class="nero-ai-badge">amoCRM / Битрикс24</li>
          <li class="nero-ai-badge">24/7</li>
          <li class="nero-ai-badge">Webhook + очередь</li>
          <li class="nero-ai-badge">Human review</li>
        </ul>
        <div class="nero-ai-cta-row">
          <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Проверить, сколько заявок вы теряете</a>
          <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-agent-5-15-sekund">Как работает</a>
        </div>
      </div>

      <div class="nero-ai-dashboard" aria-label="Демонстрация первичной обработки заявок с сайта">
        <div class="nero-ai-dashboard-shell">
          <div class="nero-ai-window-top">
            <div class="nero-ai-dots" aria-hidden="true"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
            <p class="nero-ai-dashboard-note">пример логики AI-системы · демонстрационные данные</p>
          </div>
          <div class="nero-ai-window-body" style="padding:16px">
            <div class="nero-ai-dash-header">
              <h2 class="nero-ai-dash-title">Первичная обработка заявок · демо</h2>
              <span class="nero-ai-dash-status">онлайн</span>
            </div>
            <div class="nero-ai-dash-grid" aria-label="Метрики демо">
              <div class="nero-ai-dash-card">
                <span>Ночные заявки</span>
                <strong>12</strong>
              </div>
              <div class="nero-ai-dash-card">
                <span>Время ответа</span>
                <strong>8 сек</strong>
              </div>
              <div class="nero-ai-dash-card">
                <span>Карточка в CRM</span>
                <strong>авто</strong>
              </div>
              <div class="nero-ai-dash-card">
                <span>Эскалаций</span>
                <strong>11%</strong>
              </div>
            </div>

            <div class="vzay-dash-canvas-wrap" aria-hidden="false">
              <canvas id="vzay-site-lead-canvas" role="img" aria-label="Анимация: заявка с формы сайта проходит webhook, квалификацию AI и попадает в CRM"></canvas>
            </div>

            <div class="nero-ai-dash-feed" aria-label="Лента событий заявок">
              <div class="nero-ai-dash-row">
                <span class="nero-ai-dash-dot nero-ai-dash-dot--blue" aria-hidden="true"></span>
                <span>Форма сайта → уточнение услуги и срока</span>
                <span class="nero-ai-dash-tag">диалог</span>
              </div>
              <div class="nero-ai-dash-row">
                <span class="nero-ai-dash-dot nero-ai-dash-dot--amber" aria-hidden="true"></span>
                <span>Тег hot · score 0.91</span>
                <span class="nero-ai-dash-tag nero-ai-dash-tag--hot">hot</span>
              </div>
              <div class="nero-ai-dash-row">
                <span class="nero-ai-dash-dot nero-ai-dash-dot--green" aria-hidden="true"></span>
                <span>Задача в CRM: позвонить до 10:00</span>
                <span class="nero-ai-dash-tag">CRM</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
/**
 * vzay-site-lead-engine — Диспетчерская ночных заявок с сайта
 * WebhookPulseStream → QualificationConsole → CrmDock (не конвейер / не почтовые орбиты)
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vzay-site-lead-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 260;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw * 0.52;
    cy = ch * 0.48;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    line: "rgba(121,242,255,0.28)",
    pulse: "#79f2ff",
    form: "#1e293b",
    formAccent: "#38bdf8",
    console: "#0f172a",
    chat: "rgba(255,255,255,0.08)",
    hot: "#fbbf24",
    crm: "#22c55e",
    moon: "#c4b5fd",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#020617",
    bubbleText: "#e2e8f0"
  };

  function rr(ctx, x, y, w, h, r, fill, stroke) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    if (fill) { ctx.fillStyle = fill; ctx.fill(); }
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = 1.2; ctx.stroke(); }
  }

  function WebhookPulseStream() {
    this.packets = [];
    for (var i = 0; i < 6; i++) {
      this.packets.push({ t: i * 0.17, lane: i % 3 });
    }
  }
  WebhookPulseStream.prototype.draw = function (ctx) {
    var lanes = [
      { yOff: -28, amp: 14 },
      { yOff: 0, amp: 10 },
      { yOff: 28, amp: 12 }
    ];
    lanes.forEach(function (lane, li) {
      ctx.strokeStyle = li === 1 ? "rgba(139,92,246,0.35)" : C.line;
      ctx.lineWidth = li === 1 ? 2 : 1;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.35;
      ctx.beginPath();
      for (var x = -cw * 0.05; x <= cw * 0.55; x += 6) {
        var nx = x / (cw * 0.55);
        var y = lane.yOff + Math.sin(nx * 4 + frame * 0.04 + li) * lane.amp;
        if (x === -cw * 0.05) ctx.moveTo(cx + x - 120, cy + y);
        else ctx.lineTo(cx + x - 120, cy + y);
      }
      ctx.stroke();
      ctx.setLineDash([]);
    });

    this.packets.forEach(function (p) {
      p.t += 0.0045 + p.lane * 0.0008;
      if (p.t > 1) p.t = 0;
      var lane = lanes[p.lane];
      var px = cx - 120 + p.t * (cw * 0.52);
      var nx = p.t;
      var py = cy + lane.yOff + Math.sin(nx * 4 + frame * 0.04 + p.lane) * lane.amp;
      ctx.fillStyle = C.pulse;
      ctx.shadowColor = C.pulse;
      ctx.shadowBlur = 10;
      ctx.beginPath();
      ctx.arc(px, py, 4, 0, Math.PI * 2);
      ctx.fill();
      ctx.shadowBlur = 0;
    });
  };

  function SiteFormBeacon() {
    this.blink = 0;
  }
  SiteFormBeacon.prototype.draw = function (ctx) {
    var x = cx - cw * 0.38;
    var y = cy - 8;
    rr(ctx, x - 34, y - 26, 68, 52, 8, C.form, "rgba(148,163,184,0.5)");
    rr(ctx, x - 28, y - 20, 56, 8, 3, C.formAccent, null);
    rr(ctx, x - 28, y - 6, 56, 28, 4, C.chat, "rgba(148,163,184,0.35)");
    this.blink = (frame % 90) < 45 ? 1 : 0.35;
    ctx.fillStyle = "rgba(56,189,248," + this.blink + ")";
    ctx.fillRect(x - 22, y + 2, 18, 3);
    ctx.fillRect(x - 22, y + 10, 32, 3);
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.fillStyle = "#94a3b8";
    ctx.textAlign = "center";
    ctx.fillText("форма", x, y + 34);
  };

  function QualificationConsole() {
    this.phase = 0;
  }
  QualificationConsole.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 220;
    this.phase = prg;
    var x = cx - 58;
    var y = cy - 62;
    rr(ctx, x, y, 116, 124, 10, C.console, "rgba(121,242,255,0.25)");

    ctx.fillStyle = "rgba(255,255,255,0.12)";
    ctx.fillRect(x + 8, y + 10, 100, 10);
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.fillStyle = "#cbd5e1";
    ctx.textAlign = "left";
    ctx.fillText("AI · квалификация", x + 12, y + 18);

    var bubbles = [
      { who: "client", text: "Нужен монтаж", at: 20 },
      { who: "ai", text: "Срок?", at: 55 },
      { who: "client", text: "На этой неделе", at: 95 },
      { who: "ai", text: "Бюджет?", at: 130 }
    ];
    bubbles.forEach(function (b) {
      if (prg < b.at) return;
      var by = y + 28 + bubbles.indexOf(b) * 18;
      var w = b.who === "ai" ? 72 : 64;
      var bx = b.who === "ai" ? x + 36 : x + 8;
      rr(ctx, bx, by, w, 14, 4, b.who === "ai" ? "rgba(139,92,246,0.35)" : C.chat, null);
    });

    if (prg >= 155 && prg < 210) {
      ctx.strokeStyle = C.hot;
      ctx.lineWidth = 2;
      rr(ctx, x + 6, y + 98, 52, 18, 6, "rgba(251,191,36,0.2)", C.hot);
      ctx.fillStyle = C.hot;
      ctx.font = "bold 9px Inter,sans-serif";
      ctx.fillText("HOT", x + 20, y + 110);
    }
  };

  function CrmDock() {
    this.eject = 0;
  }
  CrmDock.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 220;
    var x = cx + cw * 0.22;
    var y = cy - 20;
    rr(ctx, x, y, 78, 96, 8, "#14532d", "rgba(34,197,94,0.45)");
    ctx.fillStyle = "rgba(255,255,255,0.7)";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("CRM", x + 39, y + 14);

    if (prg >= 175) {
      this.eject = Math.min(1, (prg - 175) / 25);
      var cardX = x + 8 - (1 - this.eject) * 40;
      rr(ctx, cardX, y + 22, 62, 58, 6, "#ecfdf5", "rgba(34,197,94,0.6)");
      ctx.fillStyle = "#065f46";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("Лид #1842", cardX + 6, y + 38);
      ctx.fillStyle = "#047857";
      ctx.fillText("задача 10:00", cardX + 6, y + 52);
      if (prg >= 200) {
        ctx.strokeStyle = C.crm;
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.arc(x + 62, y + 8, 6 + Math.sin(frame * 0.2) * 2, 0, Math.PI * 2);
        ctx.stroke();
      }
    }
  };

  function NightBadge() {
    this.a = 0;
  }
  NightBadge.prototype.draw = function (ctx) {
    this.a = 0.55 + Math.sin(frame * 0.05) * 0.2;
    var mx = cx - cw * 0.08;
    var my = cy - ch * 0.32;
    ctx.fillStyle = "rgba(196,181,253," + this.a + ")";
    ctx.beginPath();
    ctx.arc(mx, my, 10, 0.2, Math.PI - 0.2, true);
    ctx.arc(mx + 8, my - 2, 8, Math.PI + 0.3, -0.3, true);
    ctx.closePath();
    ctx.fill();
    ctx.fillStyle = "rgba(148,163,184,0.7)";
    ctx.font = "7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("22:00–08:00", mx + 4, my + 18);
  };

  function Agent(role, color, tx, ty, dialogs) {
    this.role = role;
    this.color = color;
    this.x = tx;
    this.y = ty;
    this.tx = tx;
    this.ty = ty;
    this.stepTrig = Math.random() * 200;
    this.dialogs = dialogs;
    this.bubble = null;
    this.bubbleT = 0;
  }
  Agent.prototype.tick = function (frame, phase) {
    var targets = {
      "1_intake": { x: cx - cw * 0.42, y: cy + 42 },
      "2_qualify": { x: cx - 20, y: cy + 58 },
      "3_crm": { x: cx + cw * 0.18, y: cy + 48 },
      "4_night": { x: cx - cw * 0.12, y: cy - ch * 0.28 },
      "5_human": { x: cx + cw * 0.3, y: cy - 36 }
    };
    var t = targets[this.role] || { x: this.tx, y: this.ty };
    this.tx += (t.x - this.tx) * 0.04;
    this.ty += (t.y - this.ty) * 0.04;
    this.stepTrig = (this.stepTrig + 1) % 200;
    if (this.stepTrig === 40 && Math.random() < 0.35) {
      this.bubble = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
      this.bubbleT = 90;
    }
    if (this.bubbleT > 0) this.bubbleT--;
    else this.bubble = null;
  };
  Agent.prototype.draw = function (ctx) {
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(this.tx, this.ty, 7, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillStyle = "#0f172a";
    ctx.beginPath();
    ctx.arc(this.tx, this.ty - 9, 6, 0, Math.PI * 2);
    ctx.fill();
    if (this.bubble && this.bubbleT > 0) {
      ctx.font = "7px Inter,sans-serif";
      var tw = ctx.measureText(this.bubble).width + 10;
      rr(ctx, this.tx - tw / 2, this.ty - 32, tw, 14, 4, C.bubbleBg, "rgba(148,163,184,0.4)");
      ctx.fillStyle = C.bubbleText;
      ctx.textAlign = "center";
      ctx.fillText(this.bubble, this.tx, this.ty - 22);
    }
  };

  var stream = new WebhookPulseStream();
  var formBeacon = new SiteFormBeacon();
  var consoleHub = new QualificationConsole();
  var crmDock = new CrmDock();
  var night = new NightBadge();

  var agents = [
    new Agent("1_intake", C.agentYellow, cx - 80, cy + 70, ["Webhook <1 с", "Форма принята", "Ночной трафик"]),
    new Agent("2_qualify", C.agentGreen, cx - 10, cy + 70, ["Уточняю срок", "Скоринг hot", "2–5 вопросов"]),
    new Agent("3_crm", C.agentBlue, cx + 60, cy + 70, ["Поля в CRM", "Теги готовы", "Summary в карточке"]),
    new Agent("4_night", C.agentPink, cx - 40, cy - 50, ["Дежурный SLA", "Без мёртвых лидов", "22:00 активен"]),
    new Agent("5_human", C.agentPurple, cx + 90, cy - 20, ["human_review", "Спорный кейс", "Эскалация"])
  ];

  var bubbles = [];
  function sceneBubble(text, x, y, life) {
    bubbles.push({ text: text, x: x, y: y, life: life || 70 });
  }

  function loop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(0, 0);

    night.draw(ctx);
    formBeacon.draw(ctx);
    stream.draw(ctx);
    consoleHub.draw(ctx);
    crmDock.draw(ctx);

    var prg = (frame * 0.035) % 220;
    if (prg === 30) sceneBubble("Заявка с сайта", cx - cw * 0.25, cy - 50);
    if (prg === 72) sceneBubble("Ответ 5–15 сек", cx - 10, cy - 78);
    if (prg === 118) sceneBubble("Квалификация", cx + 10, cy - 70);
    if (prg === 168) sceneBubble("Карточка в CRM", cx + cw * 0.2, cy - 55);

    agents.forEach(function (a) {
      a.tick(frame, prg);
      a.draw(ctx);
    });

    bubbles.forEach(function (b) {
      b.life--;
      if (b.life <= 0) return;
      ctx.globalAlpha = Math.min(1, b.life / 30);
      ctx.font = "bold 8px Inter,sans-serif";
      var w = ctx.measureText(b.text).width + 12;
      rr(ctx, b.x - w / 2, b.y, w, 16, 5, "rgba(2,6,23,0.85)", "rgba(121,242,255,0.35)");
      ctx.fillStyle = "#e0f2fe";
      ctx.textAlign = "center";
      ctx.fillText(b.text, b.x, b.y + 11);
      ctx.globalAlpha = 1;
    });
    bubbles = bubbles.filter(function (b) { return b.life > 0; });

    ctx.restore();
    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
});
</script>
</section>

<style>
/* === VZAS article (NOT hero) — Boris === */
.vzas-content{
  --vzas-bg:#050711;--vzas-bg2:#080b17;--vzas-surface:rgba(255,255,255,.072);
  --vzas-text:#e6edf7;--vzas-muted:#9aa8bd;--vzas-soft:#c7d2e5;--vzas-heading:#fff;
  --vzas-border:rgba(255,255,255,.10);--vzas-accent:#79f2ff;--vzas-violet:#8b5cf6;--vzas-green:#22c55e;
  --vzas-btn-from:#2563eb;--vzas-btn-to:#7c3aed;--vzas-r:18px;--vzas-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vzas-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.vzas-content *,.vzas-content *::before,.vzas-content *::after{box-sizing:border-box}
.vzas-content a{color:inherit}
.vzas-content p{color:var(--vzas-muted);line-height:1.72;margin:0 0 1em}
.vzas-content p:last-child{margin-bottom:0}
.vzas-content h2,.vzas-content h3{color:var(--vzas-heading);letter-spacing:-.045em;margin:0 0 .7em}
.vzas-content h3{font-size:clamp(17px,2vw,21px)}
.vzas-content strong{color:var(--vzas-soft)}
.vzas-content ul,.vzas-content ol{padding-left:0;list-style:none;margin:0 0 1em}
.vzas-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vzas-muted);font-size:14.5px;line-height:1.65}
.vzas-content ul li::before{content:'›';position:absolute;left:0;color:var(--vzas-accent);font-weight:700}
.vzas-content ol{counter-reset:vzasli;margin:0 0 1em;padding:0}
.vzas-content ol li{counter-increment:vzasli;padding-left:28px;position:relative;margin-bottom:.5em;color:var(--vzas-muted);font-size:14.5px;line-height:1.65}
.vzas-content ol li::before{content:counter(vzasli);position:absolute;left:0;width:20px;height:20px;border-radius:50%;background:rgba(121,242,255,.12);color:var(--vzas-accent);font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;top:2px}
.vzas-cnt{width:min(var(--vzas-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.vzas-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.vzas-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.vzas-sh{max-width:820px;margin:0 auto 40px;text-align:center}
.vzas-sh.vzas-left{margin-left:0;text-align:left}
.vzas-sh h2{font-size:clamp(26px,4vw,46px);line-height:1.08;margin-bottom:14px}
.vzas-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.vzas-sh.vzas-left p{margin-left:0}
.vzas-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vzas-accent);margin-bottom:14px}
.vzas-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.vzas-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.vzas-intro-text{position:relative;padding-left:20px}
.vzas-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vzas-accent),var(--vzas-violet))}
.vzas-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--vzas-muted);margin-bottom:1em}
.vzas-intro-text p:last-child{margin-bottom:0;color:var(--vzas-soft)}
.vzas-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.vzas-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px)}
.vzas-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--vzas-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.vzas-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vzas-muted);line-height:1.4}
.vzas-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.vzas-intro-grid{grid-template-columns:1fr;gap:36px}.vzas-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.vzas-intro-kpi{grid-template-columns:1fr 1fr}}
.vzas-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.vzas-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.vzas-toc a{display:inline-block;padding:9px 18px;background:var(--vzas-surface);border:1px solid var(--vzas-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vzas-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important}
.vzas-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--vzas-accent);background:rgba(121,242,255,.08)}
.vzas-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vzas-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22)}
.vzas-card h3{margin-top:0}
.vzas-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
@media(max-width:768px){.vzas-grid-2{grid-template-columns:1fr}}
.vzas-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.vzas-table{width:100%;border-collapse:collapse;font-size:14px}
.vzas-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--vzas-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25)}
.vzas-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vzas-text);vertical-align:top}
.vzas-table tr:last-child td{border-bottom:none}
.vzas-callout{border-left:3px solid var(--vzas-accent);padding:14px 18px;margin:20px 0;background:rgba(121,242,255,.06);border-radius:0 14px 14px 0;font-size:14.5px;color:var(--vzas-soft)}
.vzas-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.vzas-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:19px 24px}
.vzas-faq-item h3{font-size:16px;margin-bottom:10px}
.vzas-cta-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin:24px 0 0;list-style:none;padding:0}
.vzas-cta-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--vzas-muted)}
.vzas-cta-checklist li::before{content:'✓';color:var(--vzas-green);font-weight:800}
.vzas-content .ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.vzas-content .ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.vzas-content .ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.vzas-content .ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.vzas-content .ym-cta-block__sub{color:var(--vzas-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.vzas-content .ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.vzas-content .ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.vzas-content .ym-link--accent{color:var(--vzas-accent)!important;text-decoration:underline!important}
/* Boris block — prefix bz- scoped in #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block */
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block.bz-root{padding:48px 0 56px;background:#f8fafc}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bz-cnt{max-width:1160px;margin:0 auto;padding:0 24px}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bz-card{display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);min-height:500px}
@media(max-width:1023px){#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bz-card{grid-template-columns:1fr;min-height:auto}}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bz-lft{padding:36px 32px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0}
@media(max-width:1023px){#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bz-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:28px 22px}}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bz-ey{font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0ea5e9;margin:0 0 12px}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bz-h3{font-size:clamp(19px,2.3vw,25px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 16px}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bz-ul{list-style:none;margin:0 0 18px;padding:0;display:flex;flex-direction:column;gap:8px}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bz-ul li{font-size:14px;line-height:1.5;color:#334155;padding-left:0}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bz-ul li::before{display:none}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bz-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:14px}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bz-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bz-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22)}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bz-pl-b{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22)}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bz-foot{font-size:13px;color:#64748b;font-style:italic;margin:0}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bz-rgt{position:relative;background:linear-gradient(135deg,#f0f9ff 0%,#e0f2fe 45%,#f8fafc 100%);min-height:400px;overflow:hidden}
#vzas-lead-pipeline-canvas{position:absolute;inset:0;width:100%;height:100%;display:block}
</style>

<div class="vzas-content" id="vzas-article-root">

  <section class="vzas-intro nero-ai-section" id="vzas-intro" aria-label="Введение">
    <div class="vzas-cnt">
      <div class="vzas-intro-grid nero-ai-reveal">
        <div class="vzas-intro-text">
          <p class="vzas-eyebrow">Лонгрид · ai обработка заявок с сайта</p>
          <p><strong>Коротко:</strong> Nero Network внедряет <strong>AI-обработку заявок с сайта</strong> под ключ: агент отвечает за <strong>5–15 секунд</strong>, уточняет запрос, квалифицирует лид и передаёт <strong>горячую карточку в CRM</strong> (amoCRM, Битрикс24 и др.) — без ночных «мёртвых» контактов и ручного копирования полей.</p>
        </div>
        <div class="vzas-intro-kpi" aria-label="Ключевые метрики SLA">
          <div class="vzas-kpi-card"><div class="kv">5–15 с</div><div class="kl">целевой ответ</div><div class="ks">Nero Network</div></div>
          <div class="vzas-kpi-card"><div class="kv">24/7</div><div class="kl">ночные заявки</div><div class="ks">без паузы</div></div>
          <div class="vzas-kpi-card"><div class="kv">hot</div><div class="kl">тег в CRM</div><div class="ks">+ summary</div></div>
          <div class="vzas-kpi-card"><div class="kv">7–14 д</div><div class="kl">пилот канала</div><div class="ks">типовой срок</div></div>
        </div>
      </div>
    </div>
  </section>
  <div class="vzas-toc-outer">
    <div class="vzas-cnt">
      <nav class="vzas-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#zayavki-ostyvayut">Боль и SLA</a>
        <a href="#chto-takoe-ai-obrabotka">Что это</a>
        <a href="#kak-agent-5-15-sekund">Как работает</a>
        <a href="#peredacha-v-crm">CRM</a>
        <a href="#vnedrenie-pod-klyuch">Этапы</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#compliance">Compliance</a>
        <a href="#faq">FAQ</a>
        <a href="#cta-proverit">Аудит</a>
      </nav>
    </div>
  </div>
  <section class="vzas-section" id="zayavki-ostyvayut" aria-labelledby="vzas-h2-zayavki">
    <div class="vzas-cnt">
      <header class="vzas-sh vzas-left nero-ai-reveal">
        <span class="vzas-eyebrow">Боль и SLA</span>
        <h2 id="vzas-h2-zayavki">Почему заявки с сайта «остывают» и как это бьёт по продажам</h2>
        <p><strong>Определение:</strong> «Остывший» лид — контакт, который оставил заявку на сайте, но не получил быстрый и релевантный ответ; к моменту звонка менеджера интерес снижается или уходит к конкуренту.</p>
      </header>
      <div class="vzas-card nero-ai-reveal">
        <p>Заявка с формы или чата — это <strong>начало воронки</strong>. В услугах, онлайн-школах, клиниках, B2B-продажах и недвижимости решение часто принимается в первые минуты после обращения. Если первое касание откладывается на часы, вы платите за трафик, но отдаёте конверсию тем, кто ответил быстрее.</p>
      </div>
      <div class="vzas-grid-2 nero-ai-reveal" style="margin-top:24px">
        <div class="vzas-card">
          <h3>Ночные и выходные заявки без ответа</h3>
          <p>Трафик не выключается в 19:00. Часть обращений приходит <strong>ночью и в выходные</strong>, когда отдел продаж офлайн. Без автоматизации такие заявки лежат в CRM до утра — клиент уже сравнил предложения или забыл, зачем оставлял телефон.</p>
          <p>В кейсе Domamo × Bquadro (Открытые линии Битрикс24) среднее время ответа <strong>3,1 сек</strong>; за тест — <strong>1870</strong> ночных диалогов (22:00–08:00); <strong>+21%</strong> конверсии ночных лидов (<a href="https://workspace.ru/cases/na-21-uvelichili-konversiyu-nochnyh-dialogov-v-chate-mnogokanalnyh-otkrytyh-liniy-bitriks24/" target="_blank" rel="noopener noreferrer">источник</a>).</p>
        </div>
        <div class="vzas-card">
          <h3>SLA первого касания: что считать нормой</h3>
          <p><strong>SLA первого касания</strong> — время от отправки заявки до первого осмысленного ответа (не автоответ «мы получили письмо»).</p>
          <ul>
            <li>Hennessey Digital (Q1 2025): медиана ответа — <strong>13 минут</strong>; лишь <strong>25%</strong> быстрее <strong>5 минут</strong>.</li>
            <li>B2B SaaS: close rate <strong>32%</strong> при ответе &lt;5 мин vs <strong>12%</strong> при 24+ ч (Optifai / Digital Applied).</li>
            <li><strong>77%</strong> потребителей ожидают немедленного контакта (Salesforce, 2024).</li>
          </ul>
        </div>
      </div>
      <p class="vzas-callout nero-ai-reveal"><strong>Итог блока:</strong> медленный ответ — управляемая потеря; её закрывают агент на первом касании + метрики (дневные и ночные заявки, время до ответа, доля эскалаций).</p>
      <!-- INTERNAL-LINKS:INSERT -->
    </div>
  </section>
  <section class="vzas-section vzas-section-alt" id="chto-takoe-ai-obrabotka" aria-labelledby="vzas-h2-chto">
    <div class="vzas-cnt">
      <header class="vzas-sh nero-ai-reveal">
        <span class="vzas-eyebrow">Решение</span>
        <h2 id="vzas-h2-chto">Что такое AI-обработка заявок с сайта</h2>
        <p><strong>AI-обработка заявок с сайта</strong> — слой между формой/чатом/мессенджером и CRM: свободный диалог, квалификация, карточка с полями и эскалация человеку.</p>
      </header>
      <div class="vzas-table-wrap nero-ai-reveal">
        <table class="vzas-table" aria-label="Чат-бот vs AI-агент">
          <thead><tr><th></th><th>Скриптовый чат-бот</th><th>AI-агент с CRM</th></tr></thead>
          <tbody>
            <tr><td>Диалог</td><td>Кнопки и ветки</td><td>Свободный текст, уточняющие вопросы</td></tr>
            <tr><td>CRM</td><td>Часто вручную</td><td>Поля, теги, summary, score, задача</td></tr>
            <tr><td>Скорость</td><td>Шаблон</td><td><strong>5–15 сек</strong> (SLA Nero Network)</td></tr>
            <tr><td>Ограничения</td><td>Жёсткий сценарий</td><td>Guardrails, human_review</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vzas-card nero-ai-reveal" style="margin-top:24px">
        <h3>Где агент работает: форма, чат, мессенджер</h3>
        <ol>
          <li><strong>Форма на сайте</strong> — webhook на backend агента.</li>
          <li><strong>Онлайн-чат</strong> на лендинге.</li>
          <li><strong>Мессенджеры</strong> через открытые линии Битрикс24 или WABA.</li>
          <li><strong>Коллбэк</strong> — уточнение времени и причины до звонка.</li>
        </ol>
        <p>Пилот на одном канале — <strong>7–14 дней</strong>, часто с фокусом на ночные заявки с главной формы.</p>
      </div>
    </div>
  </section>
<section id="vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block" class="bz-root" aria-label="Анимация: ночная заявка с формы сайта через очередь в CRM">
    <div class="bz-cnt">
      <div class="bz-card">
        <div class="bz-lft">
          <p class="bz-ey">Ночной контур · форма → CRM</p>
          <h3 class="bz-h3">Пока менеджеры спят, webhook и очередь не дают лиду «остыть»</h3>
          <ul class="bz-ul">
            <li>• Форма сайта шлёт событие за &lt;1 с — дальше async, если CRM ждёт ответ webhook 3 с (Bitrix24).</li>
            <li>• AI уточняет 2–5 полей и ставит тег hot/warm/cold.</li>
            <li>• В CRM — summary диалога и задача дежурному к утру.</li>
            <li>• Спорные фразы — в human_review без обещаний цены.</li>
          </ul>
          <div class="bz-pills">
            <span class="bz-pl bz-pl-b">22:00–08:00 KPI</span>
            <span class="bz-pl bz-pl-g">5–15 сек ответ</span>
            <span class="bz-pl bz-pl-b">Webhook + очередь</span>
          </div>
          <p class="bz-foot">Дальше — пошаговый сценарий обработки заявки →</p>
        </div>
        <div class="bz-rgt">
          <canvas id="vzas-lead-pipeline-canvas" role="img" aria-label="Схема: заявка с формы, очередь, AI-диалог, карточка лида в CRM"></canvas>
        </div>
      </div>
    </div>
    <script>
    (function(){
      'use strict';
      var cv=document.getElementById('vzas-lead-pipeline-canvas');
      if(!cv)return;
      var ctx=cv.getContext('2d'),W=0,H=0,t=0;
      function resize(){
        var p=cv.parentElement;if(!p)return;
        cv.width=p.clientWidth||640;cv.height=p.clientHeight||420;
        W=cv.width;H=cv.height;
      }
      window.addEventListener('resize',resize);resize();
      var C={sky:'#e0f2fe',ink:'#0f172a',muted:'#64748b',form:'#3b82f6',queue:'#8b5cf6',ai:'#0ea5e9',crm:'#22c55e',moon:'#fbbf24',line:'rgba(14,165,233,.35)'};
      function rr(x,y,w,h,r,fill,stroke){
        ctx.beginPath();
        if(ctx.roundRect)ctx.roundRect(x,y,w,h,r);else ctx.rect(x,y,w,h);
        if(fill){ctx.fillStyle=fill;ctx.fill();}
        if(stroke){ctx.strokeStyle=stroke;ctx.lineWidth=1.5;ctx.stroke();}
      }
      function draw(){
        t+=0.016;ctx.clearRect(0,0,W,H);
        var g=ctx.createLinearGradient(0,0,0,H);
        g.addColorStop(0,'#f0f9ff');g.addColorStop(1,'#f8fafc');
        ctx.fillStyle=g;ctx.fillRect(0,0,W,H);
        ctx.fillStyle='rgba(15,23,42,.06)';for(var i=0;i<12;i++){ctx.fillRect((i*W/12+t*20)%W,H*.15,2,2);}
        ctx.fillStyle=C.moon;ctx.beginPath();ctx.arc(W*.12,H*.18,14,0,Math.PI*2);ctx.fill();
        var yMid=H*.55,formX=W*.08,queueX=W*.38,aiX=W*.62,crmX=W*.86;
        rr(formX-50,yMid-36,100,72,12,'#fff','#cbd5e1');
        ctx.fillStyle=C.ink;ctx.font='bold 11px Inter,sans-serif';ctx.textAlign='center';
        ctx.fillText('Форма сайта',formX,yMid-8);ctx.font='10px Inter,sans-serif';ctx.fillStyle=C.muted;ctx.fillText('23:42',formX,yMid+10);
        rr(queueX-44,yMid-28,88,56,10,'rgba(139,92,246,.12)',C.queue);
        ctx.fillStyle=C.queue;ctx.font='bold 10px Inter,sans-serif';ctx.fillText('Очередь',queueX,yMid);
        rr(aiX-52,yMid-40,104,80,14,'rgba(14,165,233,.1)',C.ai);
        ctx.fillStyle=C.ai;ctx.font='bold 11px Inter,sans-serif';ctx.fillText('AI-агент',aiX,yMid-12);
        ctx.font='9px Inter,sans-serif';ctx.fillStyle=C.muted;ctx.fillText('уточнение…',aiX,yMid+6);
        rr(crmX-48,yMid-44,96,88,12,'rgba(34,197,94,.12)',C.crm);
        ctx.fillStyle=C.crm;ctx.font='bold 11px Inter,sans-serif';ctx.fillText('CRM',crmX,yMid-18);
        ctx.font='9px Inter,sans-serif';ctx.fillStyle=C.ink;ctx.fillText('hot + задача',crmX,yMid+2);
        var pulse=.5+.5*Math.sin(t*3);
        ctx.strokeStyle=C.line;ctx.lineWidth=2;ctx.setLineDash([6,6]);ctx.lineDashOffset=-t*40;
        [[formX+50,queueX-44],[queueX+44,aiX-52],[aiX+52,crmX-48]].forEach(function(seg){
          ctx.beginPath();ctx.moveTo(seg[0],yMid);ctx.lineTo(seg[1],yMid);ctx.stroke();
        });
        ctx.setLineDash([]);
        var dotX=formX+50+(crmX-48-formX-50)*((t*.35)%1);
        ctx.fillStyle=C.form;ctx.beginPath();ctx.arc(dotX,yMid,5+pulse*2,0,Math.PI*2);ctx.fill();
        requestAnimationFrame(draw);
      }
      draw();
    })();
    </script>
  </section>
  <section class="vzas-section" id="kak-agent-5-15-sekund" aria-labelledby="vzas-h2-kak">
    <div class="vzas-cnt">
      <header class="vzas-sh vzas-left nero-ai-reveal">
        <span class="vzas-eyebrow">Сценарий</span>
        <h2 id="vzas-h2-kak">Как AI-агент обрабатывает заявку за 5–15 секунд</h2>
        <p><strong>Коротко:</strong> событие с сайта → очередь → LLM + правила → structured output → CRM и уведомление дежурному.</p>
      </header>
      <div class="vzas-grid-2 nero-ai-reveal">
        <div class="vzas-card">
          <h3>Сценарий диалога и уточняющие вопросы</h3>
          <ol>
            <li>Отправка заявки / чат (явное согласие на ПДн).</li>
            <li>Webhook доставляет payload (&lt;1 с).</li>
            <li>AI задаёт <strong>2–5 вопросов</strong> под нишу.</li>
            <li>Спорные фразы — <strong>human_review</strong>.</li>
          </ol>
          <p>~75% хотят знать, что общаются с AI; 45% чаще используют агента при понятной эскалации (Salesforce, 2024).</p>
        </div>
        <div class="vzas-card">
          <h3>Квалификация лида и теги</h3>
          <p>Playbook: hot / warm / cold, BANT-подобные критерии, отраслевые теги. Webhook → оценка → теги в amoCRM до открытия карточки (разбор AX Digital). Velmi: очередь из-за лимита webhook Bitrix24 <strong>3 с</strong>; ответ с часов до <strong>30–40 с</strong> в материале автора.</p>
          <p><strong>Итог:</strong> настройка — связка диалог + классификатор + маршрутизация по расписанию.</p>
        </div>
      </div>
      <aside class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-posle-scenariya">
        <div class="ym-cta-block__icon" aria-hidden="true">⚡</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Проверить, сколько заявок вы теряете</p>
          <p class="ym-cta-block__sub">Разберём форму, чат и мессенджеры: где лиды остывают ночью и сколько времени уходит на первое касание. Аудит потерь заявок — 30 минут.</p>
          <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Проверить, сколько заявок вы теряете</a>
        </div>
      </aside>
    </div>
  </section>
  <section class="vzas-section vzas-section-alt" id="peredacha-v-crm" aria-labelledby="vzas-h2-crm">
    <div class="vzas-cnt">
      <header class="vzas-sh nero-ai-reveal">
        <span class="vzas-eyebrow">Интеграция</span>
        <h2 id="vzas-h2-crm">Передача горячего лида в CRM без ручного копирования</h2>
      </header>
      <div class="vzas-card nero-ai-reveal">
        <h3>Поля карточки и статусы</h3>
        <ul>
          <li>имя, телефон, email; источник и UTM;</li>
          <li>теги hot/warm/cold; <strong>summary</strong> диалога; score;</li>
          <li>задача: «позвонить до 10:00», КП, запись на диагностику.</li>
        </ul>
      </div>
      <div class="vzas-grid-2 nero-ai-reveal" style="margin-top:20px">
        <div class="vzas-card">
          <h3>amoCRM и Битрикс24: типовая интеграция</h3>
          <p><strong>amoCRM API v4</strong> и нативный <a href="https://www.amocrm.ru/ai-agent/" target="_blank" rel="noopener noreferrer">AI-агент amoCRM</a>; кастомный агент — для сайта без amo-чата и сложных полей.</p>
          <p><strong>Битрикс24 REST</strong> — мультиканал «сайт + мессенджеры», как в кейсе Domamo.</p>
        </div>
        <div class="vzas-card">
          <h3>Эскалация на менеджера</h3>
          <p>Обязательна при торге, жалобах, юридически значимых формулировках и низкой уверенности модели — через guardrails и очередь human_review.</p>
        </div>
      </div>
    </div>
  </section>
  <section class="vzas-section" id="vnedrenie-pod-klyuch" aria-labelledby="vzas-h2-etapy">
    <div class="vzas-cnt">
      <header class="vzas-sh vzas-left nero-ai-reveal">
        <span class="vzas-eyebrow">Внедрение</span>
        <h2 id="vzas-h2-etapy">Внедрение AI-обработки заявок под ключ: этапы и сроки</h2>
      </header>
      <div class="vzas-grid-2 nero-ai-reveal">
        <div class="vzas-card"><h3>Аудит каналов и CRM</h3><p>Точки входа, поля CRM, hot/warm/cold, SLA днём/ночью, ПДн. Результат — ТЗ на playbook и webhook gateway.</p></div>
        <div class="vzas-card"><h3>Настройка и пилот 7–14 дней</h3><p>Промпты, квалификатор, CRM-адаптер, пилот на одном канале с логами и ручной проверкой.</p></div>
      </div>
      <div class="vzas-card nero-ai-reveal" style="margin-top:20px"><h3>Запуск и сопровождение</h3><p>Остальные каналы, дашборд SLA, итерации playbook по ошибкам квалификации.</p></div>
      <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать логику до старта пилота?</p>
          <p class="ym-cta-block__sub">Если важно разобраться в webhook-контуре и human-in-the-loop до ТЗ — посмотрите <a href="<?php echo esc_url( $secondary_cta_url ); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $secondary_cta_label ); ?></a>. Это ускоряет согласование playbook и полей CRM.</p>
        </div>
      </aside>
    </div>
  </section>
  <section class="vzas-section vzas-section-alt" id="stoimost" aria-labelledby="vzas-h2-stoimost">
    <div class="vzas-cnt">
      <header class="vzas-sh nero-ai-reveal">
        <span class="vzas-eyebrow">Коммерция</span>
        <h2 id="vzas-h2-stoimost">Стоимость внедрения и что входит в проект</h2>
        <p>Цена зависит от каналов, глубины CRM и compliance — не только от объёма сообщений.</p>
      </header>
      <div class="vzas-grid-2 nero-ai-reveal">
        <div class="vzas-card">
          <h3>Ориентир чека 120–350 тыс. ₽</h3>
          <p>Старт <strong>внедрения ai обработка заявок под ключ</strong> (пилот + базовые интеграции) + поддержка по регламенту. Факторы: каналы, поля CRM, RAG, LLM, отчёты.</p>
        </div>
        <div class="vzas-card">
          <h3>Поддержка и доработка</h3>
          <p>Мониторинг SLA, правки playbook, обновления API CRM и политик моделей.</p>
        </div>
      </div>
      <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-stoimost">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Ориентир 120–350 тыс. ₽ под ваши каналы</p>
          <p class="ym-cta-block__sub">Оценим точки входа, amoCRM или Битрикс24 и вилку бюджета — без выдуманных ROI.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Проверить, сколько заявок вы теряете</a>
            <a href="#cta-proverit" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Квиз: потери заявок</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="vzas-section" id="compliance" aria-labelledby="vzas-h2-compliance">
    <div class="vzas-cnt">
      <header class="vzas-sh vzas-left nero-ai-reveal">
        <span class="vzas-eyebrow">Compliance</span>
        <h2 id="vzas-h2-compliance">Ограничения и compliance: персональные данные и согласие</h2>
        <p>Автоматизация первого касания — при <strong>явном согласии</strong>, прозрачности и согласованном контуре хранения (часто CRM в РФ).</p>
      </header>
      <div class="vzas-card nero-ai-reveal">
        <h3>Когда нужен человек вместо бота</h3>
        <p>Договор, медрекомендации вне регламента, претензии, нестандартные скидки — стоп-темы в playbook. Согласие на ПДн — явное, не галочка по умолчанию (<a href="https://textback.ru/kak-sobirat-personalnye-dannye-v-chat-botah-i-ne-narushat-zakon/" target="_blank" rel="noopener noreferrer">TextBack</a>). Учёт 152-ФЗ и уведомления РКН при необходимости.</p>
      </div>
    </div>
  </section>
  <section class="vzas-section vzas-section-alt" id="faq" aria-labelledby="vzas-h2-faq">
    <div class="vzas-cnt">
      <header class="vzas-sh nero-ai-reveal">
        <span class="vzas-eyebrow">FAQ</span>
        <h2 id="vzas-h2-faq">FAQ по AI-обработке заявок</h2>
      </header>
      <div class="vzas-faq nero-ai-reveal">
        <article class="vzas-faq-item"><h3>Как внедрить ai обработка заявок?</h3><p>Аудит → playbook → webhook → LLM → CRM → пилот 7–14 дней → метрики. Nero Network — цикл под ключ.</p></article>
        <article class="vzas-faq-item"><h3>Есть ли пример внедрения?</h3><p>Domamo × Bquadro, Velmi, amoCRM AI Agent; тренды Salesforce / OpenAI / Intercom. Обобщённый сценарий: ночная форма → hot в CRM → звонок к 10:00 с контекстом.</p></article>
        <article class="vzas-faq-item"><h3>Подходит ли для моего бизнеса?</h3><p>Да для услуг, школ, клиник, B2B, где заявка запускает продажи и есть повторяющиеся вопросы на первом касании.</p></article>
        <article class="vzas-faq-item"><h3>Чем отличается от AI в amoCRM?</h3><p>Встроенный агент — в каналах amo. Кастом — сайт, свои правила, ночной SLA, гибрид Salesbot + LLM.</p></article>
        <article class="vzas-faq-item"><h3>Сколько длится пилот?</h3><p>Обычно <strong>7–14 дней</strong> на одном канале.</p></article>
      </div>
    </div>
  </section>
  <section class="vzas-section" id="cta-proverit" aria-labelledby="vzas-h2-cta">
    <div class="vzas-cnt">
      <header class="vzas-sh nero-ai-reveal">
        <span class="vzas-eyebrow">Аудит</span>
        <h2 id="vzas-h2-cta">Проверить, сколько заявок вы теряете</h2>
        <p>Пройдите квиз и закажите <strong>аудит потерь заявок за 30 минут</strong> — каналы, ночной SLA, план интеграции в amoCRM или Битрикс24.</p>
      </header>
      <ul class="vzas-cta-checklist nero-ai-reveal">
        <li>карта точек входа</li>
        <li>целевой SLA ответа</li>
        <li>черновик playbook</li>
        <li>вилка 120–350 тыс. ₽</li>
      </ul>
      <p class="nero-ai-reveal" style="text-align:center;margin-top:28px;max-width:720px;margin-left:auto;margin-right:auto">Nero Network — <strong>внедрение ai в бизнес</strong> на стыке сайта и продаж: ответ за <strong>5–15 секунд</strong>, квалификация и <strong>горячий лид в CRM</strong>.</p>
      <aside class="ym-cta-block ym-cta-block--primary nero-ai-reveal" style="margin-top:36px">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Аудит потерь заявок за 30 минут</p>
          <p class="ym-cta-block__sub">Квиз «Проверить, сколько заявок вы теряете» — форма, чат, мессенджеры и ночной SLA без обязательств.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </aside>
    </div>
  </section>

</div>
<!-- SCHEMA-MARKUP:INSERT -->


</main>

<script>
(function(){
  'use strict';
  var root=document.querySelector('.vzas-content');
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
  var heroReveals=document.querySelectorAll('.vzay-hero-zayavok .nero-ai-reveal');
  heroReveals.forEach(function(el){el.classList.add('nero-ai-active');});
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

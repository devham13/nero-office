<?php
/**
 * Template Name: Локальная нейросеть для компании: внедрение под ключ
 * Description: Локальная LLM и AI-агенты в контуре компании — данные не уходят в облако.
 */

declare(strict_types=1);

$page_seo_title       = 'Локальная нейросеть для бизнеса: внедрение под ключ';
$page_seo_description = 'Развернём локальную LLM и AI-агентов в контуре компании — данные не уходят в облако. Аудит, GPU, RAG, CRM/1С. Стоимость, этапы, кейсы.';

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
    ['label' => 'Почему on-prem', 'href' => '#pochemu-ne-oblako'],
    ['label' => 'Решение',       'href' => '#chto-takoe'],
    ['label' => 'Сценарии',      'href' => '#scenarii'],
    ['label' => 'Архитектура',   'href' => '#arhitektura'],
    ['label' => 'Этапы',         'href' => '#etapy'],
    ['label' => 'Стоимость',     'href' => '#stoimost'],
    ['label' => 'FAQ',           'href' => '#faq'],
    ['label' => 'Консультация',  'href' => '#cta'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить вариант локального AI';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#intro';

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
/* Kadence layout + hero-first reset */
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

.lnnc-hero {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}

.lnnc-intro-text p {
  text-align: left !important;
}
</style>

<main id="primary" class="site-main nero-ai-home-page lnnc-page" role="main" tabindex="-1">

<section class="nero-ai-hero lnnc-hero" id="hero" aria-labelledby="lnnc-hero-title">
<style>
/* === АЛИНА: lnnc-hero — самодостаточные стили первого экрана === */
.lnnc-hero {
  --lnnc-bg: #050711;
  --lnnc-bg2: #080b17;
  --lnnc-text: #e6edf7;
  --lnnc-muted: #9aa8bd;
  --lnnc-soft: #c7d2e5;
  --lnnc-accent: #79f2ff;
  --lnnc-violet: #8b5cf6;
  --lnnc-green: #22c55e;
  --lnnc-border: rgba(255,255,255,.10);
  --lnnc-shadow: 0 24px 72px rgba(0,0,0,.45);
  position: relative;
  padding: clamp(108px, 14vh, 148px) 0 clamp(64px, 8vw, 80px);
  background:
    radial-gradient(ellipse 70% 55% at 72% 18%, rgba(121,242,255,.14), transparent 58%),
    radial-gradient(ellipse 55% 45% at 8% 82%, rgba(139,92,246,.11), transparent 62%),
    linear-gradient(180deg, var(--lnnc-bg) 0%, var(--lnnc-bg2) 100%);
  overflow: hidden;
  color: var(--lnnc-text);
  font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
}
.lnnc-hero *, .lnnc-hero *::before, .lnnc-hero *::after { box-sizing: border-box; }
.lnnc-hero .nero-ai-container {
  width: min(1200px, 92vw);
  margin: 0 auto;
}
.lnnc-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.lnnc-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121,242,255,.22);
  border-radius: 999px;
  background: rgba(121,242,255,.08);
  color: var(--lnnc-accent) !important;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .1em;
  text-transform: uppercase;
}
.lnnc-hero h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5vw, 58px);
  line-height: 1.06;
  letter-spacing: -.04em;
  color: #fff;
  font-weight: 900;
}
.lnnc-hero .nero-ai-gradient-text {
  display: block;
  background: linear-gradient(92deg, #fff 0%, var(--lnnc-accent) 38%, var(--lnnc-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.lnnc-hero .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--lnnc-muted) !important;
  font-size: clamp(17px, 1.9vw, 20px);
  line-height: 1.58;
}
.lnnc-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.lnnc-hero .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  padding: 8px 12px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
}
.lnnc-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  margin-top: 34px;
}
.lnnc-hero .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-height: 48px;
  padding: 14px 22px;
  border-radius: 999px;
  border: 1px solid transparent;
  font-size: 15px;
  font-weight: 800;
  text-decoration: none !important;
  transition: transform .22s ease, box-shadow .22s ease;
}
.lnnc-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.lnnc-hero .nero-ai-btn-primary {
  color: #fff !important;
  background: linear-gradient(135deg, #2563eb, #7c3aed);
  box-shadow: 0 12px 36px rgba(59,130,246,.32);
}
.lnnc-hero .nero-ai-btn-secondary {
  color: var(--lnnc-text) !important;
  background: rgba(255,255,255,.06);
  border-color: rgba(255,255,255,.14);
}
.lnnc-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 28px;
  background: rgba(2,6,23,.5);
  border: 1px solid var(--lnnc-border);
  box-shadow: var(--lnnc-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(1deg);
}
.lnnc-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 22px;
  background: linear-gradient(180deg, rgba(15,23,42,.95), rgba(6,10,24,.96));
}
.lnnc-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 12px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.04);
}
.lnnc-hero .nero-ai-dots { display: flex; gap: 7px; }
.lnnc-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.lnnc-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.lnnc-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.lnnc-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.lnnc-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.lnnc-hero .nero-ai-window-body { padding: 16px; }
.lnnc-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.lnnc-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 17px;
  letter-spacing: -.03em;
  color: #fff;
}
.lnnc-hero .nero-ai-live-pill {
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
.lnnc-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px; height: 7px;
  border-radius: 50%;
  background: var(--lnnc-green);
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: lnncPulse 1.6s infinite;
}
@keyframes lnncPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.lnnc-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.lnnc-hero .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 14px;
  background: rgba(255,255,255,.055);
}
.lnnc-hero .nero-ai-metric span {
  display: block;
  color: var(--lnnc-muted);
  font-size: 11px;
  font-weight: 700;
}
.lnnc-hero .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.lnnc-hero .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.lnnc-hero .lnnc-dash-canvas-wrap {
  position: relative;
  height: clamp(200px, 30vw, 280px);
  margin: 0 0 12px;
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid rgba(121,242,255,.18);
  background: radial-gradient(ellipse at 50% 42%, rgba(121,242,255,.06), rgba(5,7,17,.94) 72%);
}
.lnnc-hero #lnnc-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.lnnc-hero .nero-ai-task-stream { display: grid; gap: 8px; }
.lnnc-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.lnnc-hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px; height: 28px;
  border-radius: 10px;
  background: rgba(121,242,255,.12);
  color: var(--lnnc-accent);
  font-size: 10px;
  font-weight: 800;
}
.lnnc-hero .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.lnnc-hero .nero-ai-task span {
  color: var(--lnnc-muted);
  font-size: 11px;
}
.lnnc-hero .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.lnnc-hero .nero-ai-status--cyan {
  background: rgba(121,242,255,.12);
  color: #a5f3fc;
}
.lnnc-hero .nero-ai-status--violet {
  background: rgba(139,92,246,.14);
  color: #ddd6fe;
}
@media (max-width: 1100px) {
  .lnnc-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .lnnc-hero .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .lnnc-hero .nero-ai-dashboard { padding: 10px; border-radius: 22px; }
  .lnnc-hero .nero-ai-window-body { padding: 12px; }
  .lnnc-hero .nero-ai-task { grid-template-columns: 28px 1fr; }
  .lnnc-hero .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand ?? get_bloginfo('name')); ?> · on-prem llm</p>
      <h1 id="lnnc-hero-title">Локальная нейросеть для компании: внедрение под ключ <span class="nero-ai-gradient-text">без утечки данных</span></h1>
      <p class="nero-ai-hero-lead">Развернём локальную LLM и AI-агентов в вашем контуре — корпоративные данные не уходят в облачные API</p>
      <ul class="nero-ai-badges" aria-label="Ключевые свойства">
        <li class="nero-ai-badge">On-prem</li>
        <li class="nero-ai-badge">RAG</li>
        <li class="nero-ai-badge">152-ФЗ</li>
        <li class="nero-ai-badge">Без облака</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url ?? (function_exists('nero_ai_primary_cta_url') ? nero_ai_primary_cta_url() : '#cta')); ?>"<?php echo $primary_cta_attrs ?? ''; ?>><?php echo esc_html($primary_cta_label ?? (getenv('PRIMARY_CTA_LABEL') ?: 'Проверить вариант локального AI')); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#pochemu-ne-oblako">Почему on-prem</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация локального AI-контура">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">On-prem · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Локальный AI-контур</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Запросы</span>
              <strong>847</strong>
              <small>/ день</small>
            </div>
            <div class="nero-ai-metric">
              <span>Latency</span>
              <strong>1.2с</strong>
              <small>среднее</small>
            </div>
            <div class="nero-ai-metric">
              <span>Данные</span>
              <strong>100%</strong>
              <small>в контуре</small>
            </div>
            <div class="nero-ai-metric">
              <span>RAG</span>
              <strong>12k</strong>
              <small>документов</small>
            </div>
          </div>

          <div class="lnnc-dash-canvas-wrap" aria-hidden="false">
            <canvas id="lnnc-hero-canvas" role="img" aria-label="Анимация: пакеты данных внутри корпоративного периметра, облачные API блокируются файрволом, LLM отвечает с audit log"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий контура">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">IN</span>
              <div><strong>Запрос сотрудника</strong><span>«Регламент отпусков — пункт 4.2»</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">в контуре</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">RAG</span>
              <div><strong>RAG-поиск</strong><span>3 фрагмента из pgvector</span></div>
              <span class="nero-ai-status nero-ai-status--violet">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">LLM</span>
              <div><strong>LLM-ответ</strong><span>Qwen3 30B · с цитатами</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">LOG</span>
              <div><strong>Audit log</strong><span>запрос/ответ в SIEM</span></div>
              <span class="nero-ai-status">в контуре</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * lnnc-hero-engine — «Диспетчерская закрытого AI-периметра»
 * Центр: InferenceVault · Транспорт: DataPacketRing · Периметр: PerimeterFirewallRing
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("lnnc-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;
  var bubbles = [];

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 260;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 6;
    scale = Math.min(cw / 440, ch / 300) * 1.08;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    firewall: "rgba(121,242,255,0.35)",
    firewallGlow: "rgba(121,242,255,0.12)",
    vaultBase: "#1e293b",
    vaultGlow: "#79f2ff",
    vaultViolet: "#8b5cf6",
    packet: "#a5f3fc",
    packetInner: "#22c55e",
    cloudRed: "#f87171",
    cloudBlock: "rgba(248,113,113,0.25)",
    shard: "#c4b5fd",
    gpu: "#334155",
    gpuLed: "#22c55e",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0",
    auditGreen: "#22c55e"
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

  function createBubble(x, y, text, maxW) {
    bubbles.push({ x: x, y: y, text: text, life: 0, maxW: maxW || 200 });
  }

  /* Кольцо файрвола — вместо Conveyor */
  function PerimeterFirewallRing() {
    this.pulse = 0;
  }
  PerimeterFirewallRing.prototype.draw = function (ctx) {
    this.pulse += 0.04;
    var rOuter = 118 * scale;
    var rInner = 88 * scale;
    ctx.save();
    ctx.translate(cx, cy);
    ctx.strokeStyle = C.firewall;
    ctx.lineWidth = 3;
    ctx.beginPath();
    ctx.arc(0, 0, rOuter, 0, Math.PI * 2);
    ctx.stroke();
    ctx.strokeStyle = C.firewallGlow;
    ctx.lineWidth = 8;
    ctx.globalAlpha = 0.45 + Math.sin(this.pulse) * 0.15;
    ctx.stroke();
    ctx.globalAlpha = 1;
    for (var i = 0; i < 12; i++) {
      var ang = (i / 12) * Math.PI * 2 + frame * 0.008;
      var fx = Math.cos(ang) * rOuter;
      var fy = Math.sin(ang) * rOuter;
      drawRR(ctx, fx - 4, fy - 4, 8, 8, 2, C.firewallGlow, C.firewall);
    }
    ctx.restore();
  };

  /* Орбитальный поток пакетов — вместо ленты конвейера */
  function DataPacketRing() {
    this.packets = [
      { angle: 0, speed: 0.018, size: 10, label: "ПДн" },
      { angle: 2.1, speed: 0.022, size: 9, label: "CRM" },
      { angle: 4.2, speed: 0.016, size: 11, label: "RAG" }
    ];
  }
  DataPacketRing.prototype.draw = function (ctx) {
    var prg = (frame * 0.032) % 260;
    var orbitR = 72 * scale;
    ctx.save();
    ctx.translate(cx, cy);
    this.packets.forEach(function (p, idx) {
      p.angle += p.speed;
      var px = Math.cos(p.angle) * orbitR;
      var py = Math.sin(p.angle) * orbitR;
      var alpha = prg < 60 ? 0.35 : 1;
      ctx.globalAlpha = alpha;
      drawRR(ctx, px - p.size / 2, py - p.size / 2, p.size, p.size, 3, C.packet, C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(p.label, px, py + 2);
      ctx.globalAlpha = 1;
    });
    ctx.restore();
  };

  /* Центральное ядро LLM — вместо WebsiteTerminal */
  function InferenceVault() {
    this.glow = 0;
  }
  InferenceVault.prototype.draw = function (ctx) {
    var prg = (frame * 0.032) % 260;
    this.glow = 0.5 + Math.sin(frame * 0.06) * 0.25;
    ctx.save();
    ctx.translate(cx, cy);
    var s = 42 * scale;
    ctx.fillStyle = C.vaultBase;
    ctx.strokeStyle = C.vaultGlow;
    ctx.lineWidth = 2;
    ctx.beginPath();
    for (var i = 0; i < 6; i++) {
      var a = (i / 6) * Math.PI * 2 - Math.PI / 2;
      var hx = Math.cos(a) * s;
      var hy = Math.sin(a) * s;
      if (i === 0) ctx.moveTo(hx, hy);
      else ctx.lineTo(hx, hy);
    }
    ctx.closePath();
    ctx.fill();
    ctx.stroke();
    ctx.fillStyle = "rgba(121,242,255," + this.glow + ")";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("LLM", 0, -2);
    ctx.font = "6px Inter,sans-serif";
    ctx.fillStyle = C.vaultViolet;
    ctx.fillText("on-prem", 0, 8);

    if (prg >= 140 && prg < 200) {
      var inf = (prg - 140) / 60;
      ctx.globalAlpha = inf * 0.7;
      ctx.fillStyle = C.vaultGlow;
      ctx.beginPath();
      ctx.arc(0, 0, s * 0.6 + inf * 12, 0, Math.PI * 2);
      ctx.fill();
      ctx.globalAlpha = 1;
    }
    ctx.restore();
  };

  /* Блокировка облачных API снаружи */
  function CloudBarrierGate() {
    this.bounce = [];
    for (var i = 0; i < 3; i++) {
      this.bounce.push({ x: -140 - i * 35, y: -60 + i * 28, vx: 1.2 + i * 0.2, life: 0 });
    }
  }
  CloudBarrierGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.032) % 260;
    ctx.save();
    ctx.translate(cx, cy);
    drawRR(ctx, -155 * scale, -75 * scale, 48 * scale, 32 * scale, 6, C.cloudBlock, C.cloudRed);
    ctx.fillStyle = C.cloudRed;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("☁ API", -131 * scale, -56 * scale);
    ctx.strokeStyle = C.cloudRed;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(-107 * scale, -75 * scale);
    ctx.lineTo(-95 * scale, -43 * scale);
    ctx.stroke();
    if (prg < 65 && prg % 22 === 0 && frame % 22 === 0) {
      createBubble(-120 * scale + cx, cy - 50 * scale, "☁️ API заблокирован файрволом", 180);
    }
    this.bounce.forEach(function (b) {
      if (prg < 60) {
        b.x += b.vx;
        if (b.x > -95 * scale) { b.x = -95 * scale; b.vx = -b.vx * 0.6; }
        drawRR(ctx, b.x, b.y, 10, 8, 2, C.cloudRed, null);
      }
    });
    ctx.restore();
  };

  /* Кластер RAG-шардов */
  function RagShardCluster() {
    this.shards = [
      { ox: 95, oy: -40, rot: 0 },
      { ox: 110, oy: -10, rot: 0.4 },
      { ox: 100, oy: 25, rot: -0.3 }
    ];
  }
  RagShardCluster.prototype.draw = function (ctx) {
    var prg = (frame * 0.032) % 260;
    if (prg < 100) return;
    var merge = Math.min(1, (prg - 100) / 50);
    ctx.save();
    ctx.translate(cx, cy);
    this.shards.forEach(function (sh, i) {
      var tx = sh.ox * scale * (1 - merge * 0.75);
      var ty = sh.oy * scale * (1 - merge * 0.75);
      ctx.save();
      ctx.translate(tx, ty);
      ctx.rotate(sh.rot + frame * 0.02);
      drawRR(ctx, -8, -10, 16, 20, 2, C.shard, C.outline);
      ctx.fillStyle = "#4c1d95";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("doc", 0, 2);
      ctx.restore();
    });
    if (prg > 105 && prg < 130 && frame % 40 === 0) {
      createBubble(cx + 60 * scale, cy - 30 * scale, "📦 Пакет данных в контуре", 170);
    }
    ctx.restore();
  };

  /* GPU-стойка слева */
  function GpuRackStrip() {
    this.blink = 0;
  }
  GpuRackStrip.prototype.draw = function (ctx) {
    this.blink = frame % 30 < 15;
    ctx.save();
    ctx.translate(cx, cy);
    drawRR(ctx, -168 * scale, -50 * scale, 22 * scale, 70 * scale, 4, C.gpu, C.outline);
    for (var i = 0; i < 4; i++) {
      ctx.fillStyle = this.blink && i === 2 ? C.gpuLed : "#64748b";
      ctx.beginPath();
      ctx.arc(-157 * scale, (-38 + i * 16) * scale, 3, 0, Math.PI * 2);
      ctx.fill();
    }
    ctx.fillStyle = C.gpuLed;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("GPU", -165 * scale, -58 * scale);
    ctx.restore();
  };

  /* Печать audit log — финал цикла */
  function AuditSealBeacon() {
    this.scale = 0;
  }
  AuditSealBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.032) % 260;
    if (prg < 200) { this.scale = 0; return; }
    this.scale = Math.min(1, (prg - 200) / 25);
    ctx.save();
    ctx.translate(cx, cy + 55 * scale);
    var sc = this.scale;
    ctx.globalAlpha = sc;
    ctx.strokeStyle = C.auditGreen;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(0, 0, 22 * scale * sc, 0, Math.PI * 2);
    ctx.stroke();
    ctx.fillStyle = "rgba(34,197,94,0.15)";
    ctx.fill();
    ctx.fillStyle = C.auditGreen;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("AUDIT", 0, -2);
    ctx.fillText("✓ в контуре", 0, 8);
    if (prg > 205 && prg < 230 && frame % 35 === 0) {
      createBubble(cx, cy + 70 * scale, "🔐 LLM-ответ без утечки", 160);
      createBubble(cx + 20, cy + 85 * scale, "✓ Audit log записан", 150);
    }
    ctx.globalAlpha = 1;
    ctx.restore();
  };

  function drawBubbles(ctx) {
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life++;
      b.y -= 0.35;
      var alpha = Math.max(0, 1 - b.life / 90);
      if (alpha <= 0) { bubbles.splice(i, 1); continue; }
      ctx.font = "bold 7px Inter,sans-serif";
      var tw = Math.min(b.maxW, ctx.measureText(b.text).width + 16);
      drawRR(ctx, b.x - tw / 2, b.y - 10, tw, 16, 4, C.bubbleBg, C.firewall);
      ctx.fillStyle = C.bubbleText;
      ctx.textAlign = "center";
      ctx.globalAlpha = alpha;
      ctx.fillText(b.text, b.x, b.y + 1);
      ctx.globalAlpha = 1;
    }
  }

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y;
    this.baseX = x; this.baseY = y;
    this.color = color;
    this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
    this.hitAnimation = 0;
  }
  Agent.prototype.draw = function (ctx) {
    var prg = (frame * 0.032) % 260;
    this.timer += 0.03;
    var isMoving = false;
    var faceDir = 1;
    var ang = (this.stepTrig / 260) * Math.PI * 2 - Math.PI / 2;
    var targetX = cx + Math.cos(ang) * 95 * scale;
    var targetY = cy + Math.sin(ang) * 70 * scale;

    if (prg >= this.stepTrig && prg < this.stepTrig + 28) {
      var local = prg - this.stepTrig;
      if (local < 14) {
        isMoving = true;
        var t = local / 14;
        this.x = this.baseX + (targetX - this.baseX) * t;
        this.y = this.baseY + (targetY - this.baseY) * t;
      } else {
        isMoving = true;
        faceDir = -1;
        var t2 = (local - 14) / 14;
        this.x = targetX + (this.baseX - targetX) * t2;
        this.y = targetY + (this.baseY - targetY) * t2;
      }
    } else {
      this.x = this.baseX;
      this.y = this.baseY;
    }

    if (!isMoving && frame % 180 === Math.floor(this.timer * 10) % 180 && Math.random() < 0.12) {
      var rnd = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
      createBubble(this.x, this.y - 18, rnd, 210);
    }

    var bob = isMoving ? Math.abs(Math.sin(this.timer * 5)) * 2 : Math.sin(this.timer * 1.5);
    ctx.save();
    ctx.translate(this.x, this.y);
    ctx.scale(faceDir, 1);
    drawRR(ctx, -10, -5, 8, 14, 2, C.outline, null);
    drawRR(ctx, 2, -5, 8, 14, 2, C.outline, null);
    drawRR(ctx, -15, -12 - bob, 30, 20, 6, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -28 - bob, 12, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.5;
    ctx.stroke();
    ctx.restore();
  };

  var firewall = new PerimeterFirewallRing();
  var packetRing = new DataPacketRing();
  var vault = new InferenceVault();
  var cloudGate = new CloudBarrierGate();
  var ragShards = new RagShardCluster();
  var gpuRack = new GpuRackStrip();
  var auditSeal = new AuditSealBeacon();

  var agents = [
    new Agent(cx - 130 * scale, cy + 75 * scale, C.agentYellow, "1_architect", 70, [
      "Карта безопасности AI — сначала",
      "ПДн не уйдёт в ChatGPT",
      "Аудит контура перед пилотом"
    ]),
    new Agent(cx + 130 * scale, cy + 70 * scale, C.agentGreen, "2_ml", 110, [
      "Qwen3 или Llama — тест на VRAM",
      "GPU грузится, облако не трогаем",
      "Open-source без vendor lock-in"
    ]),
    new Agent(cx - 125 * scale, cy - 78 * scale, C.agentBlue, "3_rag", 150, [
      "RAG по регламентам — внутри контура",
      "12k документов в pgvector",
      "Цитаты источников в каждом ответе"
    ]),
    new Agent(cx + 120 * scale, cy - 72 * scale, C.agentPink, "4_governance", 185, [
      "152-ФЗ: аудит каждого запроса",
      "RBAC — роль видит только свои коллекции",
      "MCP к CRM — только whitelist"
    ]),
    new Agent(cx, cy + 95 * scale, C.agentPurple, "5_deployer", 220, [
      "vLLM в прод — latency 1.2с",
      "SIEM получает audit log",
      "100% inference в периметре"
    ])
  ];

  function loop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.fillStyle = "rgba(5,7,17,0.15)";
    ctx.fillRect(0, 0, cw, ch);

    gpuRack.draw(ctx);
    cloudGate.draw(ctx);
    firewall.draw(ctx);
    packetRing.draw(ctx);
    ragShards.draw(ctx);
    vault.draw(ctx);
    auditSeal.draw(ctx);
    agents.forEach(function (a) { a.draw(ctx); });
    drawBubbles(ctx);

    requestAnimationFrame(loop);
  }
  loop();
});
</script>


<style>
/* === LNCC CONTENT ROOT (Artur: lnnc- prefix, dark theme) === */
.lnnc-content{
  --lnnc-bg:#050711;--lnnc-bg2:#080b17;--lnnc-surface:rgba(255,255,255,.072);
  --lnnc-text:#e6edf7;--lnnc-muted:#9aa8bd;--lnnc-soft:#c7d2e5;--lnnc-heading:#fff;
  --lnnc-border:rgba(255,255,255,.10);--lnnc-accent:#79f2ff;--lnnc-violet:#8b5cf6;
  --lnnc-green:#22c55e;--lnnc-btn-from:#2563eb;--lnnc-btn-to:#7c3aed;
  --lnnc-r:18px;--lnnc-r-lg:24px;--lnnc-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--lnnc-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.lnnc-content *,.lnnc-content *::before,.lnnc-content *::after{box-sizing:border-box;}
.lnnc-content a{color:inherit;text-decoration:none;}
.lnnc-content p{color:var(--lnnc-muted);line-height:1.72;margin:0 0 1em;}
.lnnc-content p:last-child{margin-bottom:0;}
.lnnc-content h2,.lnnc-content h3,.lnnc-content h4{color:var(--lnnc-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.lnnc-content strong{color:var(--lnnc-soft);}
.lnnc-content ul,.lnnc-content ol{padding-left:0;list-style:none;margin:0 0 1em;}
.lnnc-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--lnnc-muted);font-size:14.5px;line-height:1.65;}
.lnnc-content ul li::before{content:'›';position:absolute;left:0;color:var(--lnnc-accent);font-weight:700;}
.lnnc-content code{font-size:.9em;background:rgba(121,242,255,.1);padding:2px 6px;border-radius:4px;color:var(--lnnc-accent);}
.lnnc-cnt{width:min(var(--lnnc-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.lnnc-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.lnnc-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.lnnc-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.lnnc-sh.lnnc-left{margin-left:0;text-align:left;}
.lnnc-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.lnnc-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.lnnc-sh.lnnc-left p{margin-left:0;}
.lnnc-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--lnnc-accent);margin-bottom:14px;}
.lnnc-gt{background:linear-gradient(92deg,#fff 0%,var(--lnnc-accent) 44%,var(--lnnc-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.lnnc-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.lnnc-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.lnnc-intro-text{position:relative;padding-left:20px;}
.lnnc-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--lnnc-accent),var(--lnnc-violet));}
.lnnc-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.lnnc-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px);}
.lnnc-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--lnnc-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.lnnc-kpi-card .kl{font-size:11px;font-weight:600;color:var(--lnnc-muted);line-height:1.4;}
.lnnc-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.lnnc-intro-grid{grid-template-columns:1fr;gap:36px;}.lnnc-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.lnnc-intro-kpi{grid-template-columns:1fr 1fr;}}
.lnnc-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.lnnc-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.lnnc-toc a{display:inline-block;padding:9px 18px;background:var(--lnnc-surface);border:1px solid var(--lnnc-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--lnnc-muted);transition:border-color .2s,color .2s,background .2s;}
.lnnc-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--lnnc-accent);background:rgba(121,242,255,.08);}
.lnnc-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--lnnc-border);border-radius:var(--lnnc-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);}
.lnnc-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.lnnc-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
.lnnc-grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;}
@media(max-width:768px){.lnnc-grid-2,.lnnc-grid-3,.lnnc-grid-4{grid-template-columns:1fr;}}
@media(max-width:960px){.lnnc-grid-3{grid-template-columns:1fr 1fr;}.lnnc-grid-4{grid-template-columns:1fr 1fr;}}
.lnnc-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.lnnc-table{width:100%;border-collapse:collapse;font-size:14px;}
.lnnc-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--lnnc-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.lnnc-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--lnnc-text);vertical-align:top;}
.lnnc-table tr:last-child td{border-bottom:none;}
.lnnc-table tr:hover td{background:rgba(255,255,255,.03);}
.lnnc-table .lnnc-col-highlight{background:rgba(34,197,94,.08);}
.lnnc-barrier-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin:28px 0;}
@media(max-width:900px){.lnnc-barrier-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:500px){.lnnc-barrier-grid{grid-template-columns:1fr;}}
.lnnc-barrier-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:20px;transition:border-color .2s;}
.lnnc-barrier-card.lnnc-barrier-accent{border-color:rgba(121,242,255,.45);background:rgba(121,242,255,.06);}
.lnnc-barrier-card .num{font-size:11px;font-weight:800;color:var(--lnnc-accent);letter-spacing:.08em;margin-bottom:8px;}
.lnnc-barrier-card h4{font-size:14px;margin-bottom:6px;}
.lnnc-barrier-card p{font-size:13px;margin:0;}
.lnnc-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--lnnc-r);padding:26px;margin-bottom:14px;}
.lnnc-scenario:last-child{margin-bottom:0;}
.lnnc-scenario h3{font-size:17px;margin-bottom:8px;}
.lnnc-timeline{position:relative;padding-left:40px;}
.lnnc-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--lnnc-accent),var(--lnnc-violet));opacity:.35;border-radius:2px;}
.lnnc-tl-item{position:relative;margin-bottom:32px;}
.lnnc-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--lnnc-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.lnnc-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.lnnc-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.lnnc-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--lnnc-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.lnnc-faq-q::after{content:'▾';font-size:13px;color:var(--lnnc-accent);flex-shrink:0;transition:transform .25s;}
.lnnc-faq-item.open .lnnc-faq-q::after{transform:rotate(180deg);}
.lnnc-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--lnnc-muted);line-height:1.72;}
.lnnc-faq-item.open .lnnc-faq-a{max-height:600px;padding:0 24px 20px;}
.lnnc-cta-dual{display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-top:32px;}
@media(max-width:768px){.lnnc-cta-dual{grid-template-columns:1fr;}}
.lnnc-lead-card{background:rgba(34,197,94,.08);border:1px solid rgba(34,197,94,.28);border-radius:20px;padding:32px;}
.lnnc-lead-card h3{font-size:20px;margin-bottom:16px;}
.lnnc-checklist{list-style:none;padding:0;margin:0;}
.lnnc-checklist li{padding-left:24px;position:relative;margin-bottom:8px;font-size:14px;color:var(--lnnc-muted);}
.lnnc-checklist li::before{content:'✓';position:absolute;left:0;color:var(--lnnc-green);font-weight:800;}
.lnnc-cta-card{background:linear-gradient(135deg,rgba(121,242,255,.1),rgba(139,92,246,.08));border:1px solid rgba(121,242,255,.3);border-radius:20px;padding:32px;display:flex;flex-direction:column;justify-content:center;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--secondary{background:linear-gradient(135deg,rgba(255,255,255,.04),rgba(121,242,255,.06));border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--lnnc-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;}
.ym-link--accent{color:var(--lnnc-accent);text-decoration:underline;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn--accent{background:linear-gradient(135deg,var(--lnnc-btn-from),var(--lnnc-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--accent:hover{transform:translateY(-2px);box-shadow:0 12px 36px rgba(59,130,246,.45);}
.lnnc-disclaimer{font-size:13px;color:#64748b;font-style:italic;margin-top:12px;}
.lnnc-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;}
.lnnc-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--lnnc-green);margin-bottom:10px;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
</style>

<div class="lnnc-content" id="lnnc-article-body">

<!-- INTRO -->
<section class="lnnc-intro" id="intro" aria-label="Введение">
  <div class="lnnc-cnt">
    <div class="lnnc-intro-grid nero-ai-reveal">
      <div class="lnnc-intro-text">
        <p class="lnnc-eyebrow">Лонгрид · on-prem llm</p>
        <p><strong>Коротко:</strong> локальная нейросеть для бизнеса — это LLM-инфраструктура внутри периметра компании: GPU, inference-слой, RAG по корпоративным данным, API для CRM и 1С, политики доступа и аудит. Данные не передаются в ChatGPT и облачные API. Nero Network разворачивает такой контур под ключ — от аудита до продакшн-агентов.</p>
        <p>Сотрудники уже пробуют ChatGPT и облачные API, но юридический отдел, ИБ и compliance говорят одно: <strong>нельзя отправлять чувствительные данные во внешние AI-сервисы</strong>. Параллельно бизнес хочет <strong>внедрение AI в бизнес</strong> — не демо в песочнице, а рабочие <strong>AI-агенты</strong> в CRM, 1С и документообороте.</p>
        <p>Nero Network проектирует и внедряет <strong>локальную нейросеть для бизнеса под ключ</strong> — от карты требований к безопасности до пилота и продакшна с интеграциями в CRM, 1С и мессенджеры.</p>
      </div>
      <div class="lnnc-intro-kpi" aria-label="Ключевые показатели">
        <div class="lnnc-kpi-card"><div class="kv">80%</div><div class="kl">барьер данных при масштабировании agentic AI</div><div class="ks">McKinsey, 2026</div></div>
        <div class="lnnc-kpi-card"><div class="kv">июнь 2026</div><div class="kl">HPE + NVIDIA on-prem агенты</div><div class="ks">HPE Discover</div></div>
        <div class="lnnc-kpi-card"><div class="kv">700К–5М ₽</div><div class="kl">ориентир чека внедрения</div><div class="ks">Nero Network</div></div>
        <div class="lnnc-kpi-card"><div class="kv">2–4 нед.</div><div class="kl">пилот on-prem LLM</div><div class="ks">типовой срок</div></div>
      </div>
    </div>
  </div>
</section>

<!-- TOC -->
<div class="lnnc-toc-outer">
  <div class="lnnc-cnt">
    <nav class="lnnc-toc" aria-label="Оглавление статьи">
      <a href="#pochemu-ne-oblako">Почему on-prem</a>
      <a href="#chto-takoe">Решение</a>
      <a href="#komu-podhodit">Кому</a>
      <a href="#scenarii">Сценарии</a>
      <a href="#arhitektura">Архитектура</a>
      <a href="#oblako-vs-onprem">Облако vs on-prem</a>
      <a href="#etapy">Этапы</a>
      <a href="#stoimost">Стоимость</a>
      <a href="#keisy">Кейсы</a>
      <a href="#faq">FAQ</a>
      <a href="#cta">Консультация</a>
    </nav>
  </div>
</div>

<!-- H2: Почему не облако -->
<section class="lnnc-section" id="pochemu-ne-oblako">
  <div class="lnnc-cnt">
    <div class="lnnc-sh lnnc-left nero-ai-reveal">
      <span class="lnnc-eyebrow">Барьер 2026</span>
      <h2>Почему компании в 2026 не пускают AI-агентов в облако</h2>
      <p><strong>Определение проблемы:</strong> компании экспериментируют с agentic AI, но не выводят агентов в прод из‑за конфиденциальности данных, отсутствия верификации выхода и регуляторных ограничений.</p>
    </div>

    <div class="lnnc-card nero-ai-reveal" id="hpe-nvidia">
      <h3>HPE и NVIDIA: on-prem агенты за корпоративным файрволом</h3>
      <p>16 июня 2026 года на HPE Discover в Лас-Вегасе Hewlett Packard Enterprise и NVIDIA расширили портфель <strong>Private Cloud AI</strong> — turnkey AI factory, где ворклоады работают <strong>за корпоративным файрволом</strong> (<a href="https://siliconangle.com/2026/06/16/hpe-expands-private-cloud-ai-factory-portfolio-support-next-gen-autonomous-agents/" target="_blank" rel="noopener noreferrer">SiliconANGLE</a>, <a href="https://www.hpe.com/us/en/newsroom/press-release/2026/06/hpe-brings-agentic-ai-into-production-with-nvidia-delivering-security-governance-scale-and-sovereignty.html" target="_blank" rel="noopener noreferrer">HPE</a>).</p>
      <div class="lnnc-table-wrap" style="margin:24px 0;">
        <table class="lnnc-table">
          <thead><tr><th>Компонент</th><th>Назначение</th><th>Срок</th></tr></thead>
          <tbody>
            <tr><td><strong>NVIDIA Agent Toolkit</strong></td><td>Nemotron-модели, OpenShell runtime, NemoClaw blueprints для multi-agent систем</td><td>Q4 2026</td></tr>
            <tr><td><strong>NVIDIA Confidential Computing</strong></td><td>Криптографическая цепочка доверия, изолированная обработка данных</td><td>Раскатка на Private Cloud AI</td></tr>
            <tr><td><strong>Secure local agent registration</strong></td><td>Одобрение моделей, skills и tools до запуска агента</td><td>Q4 2026</td></tr>
            <tr><td><strong>HPE Zerto Software</strong></td><td>Детект «rogue agent actions» и откат к чистому состоянию</td><td>Q4 2026</td></tr>
            <tr><td><strong>HPE ProLiant DL394 Gen12</strong></td><td>Сервер с NVIDIA Vera CPU для agentic AI</td><td>Начало 2027</td></tr>
          </tbody>
        </table>
      </div>
      <p>Antonio Neri (CEO HPE): <em>«As AI becomes more autonomous, organizations need a new architecture to run it securely, govern it responsibly, and scale it economically»</em>. Jensen Huang (CEO NVIDIA): <em>«Together with HPE, we are building AI factories for this new era of computing»</em>.</p>
      <p>Для российского среднего бизнеса покупка HPE DL394 — не единственный путь. Смысл новости в другом: <strong>мировые вендоры легитимизировали on-prem agentic AI</strong> как стандарт enterprise. Аналог — практичный стек: GPU + open-source LLM (Qwen, Llama, Mistral) + RAG + governance от интегратора. Именно это делает Nero Network.</p>
    </div>

    <div class="lnnc-card nero-ai-reveal" style="margin-top:28px;" id="arxiv-barriers">
      <h3>Исследование arXiv 2605.14675 — конфиденциальность как барьер продакшн-внедрения</h3>
      <p>Качественное исследование <a href="https://arxiv.org/abs/2605.14675" target="_blank" rel="noopener noreferrer">Agentic AI in Industry: Adoption Level and Deployment Barriers</a> (май 2026) опросило 16 практиков из 12 компаний.</p>
      <p><strong>Зрелость внедрения:</strong> Level 1 (AI Assistants) — 7 компаний; Level 2 (Task Agents) — 4; Level 3 (Multi-Agent Orchestration) — 1.</p>
      <p>Главный вывод — <strong>capability-deployment verification gap</strong>: четыре компании показали экспериментальные возможности уровня выше продакшна, но не смогли интегрировать их в рабочие процессы из‑за отсутствия механизмов верификации выхода.</p>
      <div class="lnnc-barrier-grid" aria-label="Четыре барьера arXiv">
        <div class="lnnc-barrier-card"><div class="num">БАРЬЕР 1</div><h4>Context window</h4><p>Ограничения при агрегации разнородных знаний</p></div>
        <div class="lnnc-barrier-card"><div class="num">БАРЬЕР 2</div><h4>Языки и протоколы</h4><p>Недостаточное качество на проприетарных форматах</p></div>
        <div class="lnnc-barrier-card"><div class="num">БАРЬЕР 3</div><h4>Недетерминизм</h4><p>Несовместимость со стандартами квалификации</p></div>
        <div class="lnnc-barrier-card lnnc-barrier-accent"><div class="num">БАРЬЕР 4</div><h4>Data confidentiality</h4><p>Чувствительные данные уходят в cloud-based LLM</p></div>
      </div>
      <p>По данным <a href="https://www.mckinsey.com.br/capabilities/mckinsey-technology/our-insights/building-the-foundations-for-agentic-ai-at-scale" target="_blank" rel="noopener noreferrer">McKinsey</a> (апрель 2026), <strong>8 из 10</strong> компаний называют ограничения данных главным барьером; менее <strong>10%</strong> вывели агентов в прод с измеримым эффектом.</p>
      <p><strong>Итог:</strong> конфиденциальность — не «паранойя ИБ», а <strong>архитектурный барьер</strong>. Локальный контур + RAG + логирование + human-in-the-loop — прямой ответ на барьер №4.</p>
    </div>
  </div>
</section>

<!-- H2: Что такое -->
<section class="lnnc-section lnnc-section-alt" id="chto-takoe">
  <div class="lnnc-cnt">
    <div class="lnnc-sh nero-ai-reveal">
      <span class="lnnc-eyebrow">Определение</span>
      <h2>Что такое локальная нейросеть для бизнеса</h2>
      <p><strong>Локальная нейросеть для бизнеса</strong> (on-prem LLM) — инфраструктура больших языковых моделей внутри периметра: GPU, inference-слой (Ollama, vLLM), векторная база для RAG, API-шлюз, политики доступа и аудит.</p>
    </div>

    <div class="lnnc-card nero-ai-reveal">
      <p>Типичный стек внедрения 2026: open-source LLM (Qwen 3.x, Llama 4, Mistral, DeepSeek) + vLLM/Ollama + RAG (pgvector, Qdrant) + оркестрация (n8n, LangChain/LangGraph) + интеграции CRM/1С/мессенджеры + SIEM/аудит.</p>
    </div>

    <div class="lnnc-sh lnnc-left nero-ai-reveal" style="margin-top:48px;">
      <h3>Локальная LLM vs облачный API: когда нужен закрытый контур</h3>
    </div>
    <div class="lnnc-table-wrap nero-ai-reveal">
      <table class="lnnc-table">
        <thead><tr><th>Критерий</th><th>ChatGPT / Claude API</th><th class="lnnc-col-highlight">Локальная LLM в контуре</th></tr></thead>
        <tbody>
          <tr><td>Данные</td><td>Уходят к провайдеру</td><td class="lnnc-col-highlight">Остаются в периметре</td></tr>
          <tr><td>Стоимость при росте</td><td>Растёт с токенами</td><td class="lnnc-col-highlight">CAPEX + предсказуемый OPEX</td></tr>
          <tr><td>Качество на русском</td><td>Высокое</td><td class="lnnc-col-highlight">Qwen / Llama — конкурентно</td></tr>
          <tr><td>AI-агенты + CRM</td><td>Данные наружу</td><td class="lnnc-col-highlight">MCP/API внутри периметра</td></tr>
          <tr><td>Compliance 152-ФЗ</td><td>Риски трансграничной передачи</td><td class="lnnc-col-highlight">Проще обосновать локализацию</td></tr>
          <tr><td>Time-to-value</td><td>Дни</td><td class="lnnc-col-highlight">Пилот 2–4 нед., прод 1–2 мес.</td></tr>
        </tbody>
      </table>
    </div>

    <div class="lnnc-card nero-ai-reveal" style="margin-top:28px;">
      <h3>Какие задачи решает локальная нейросеть для бизнеса</h3>
      <ul>
        <li>Поиск и ответы по внутренним регламентам с цитатами источников (RAG)</li>
        <li>Суммаризация договоров, переписки, технической документации</li>
        <li>Черновики писем, КП, служебных записок — с human review</li>
        <li>Классификация входящих заявок и тикетов</li>
        <li><strong>AI-агенты</strong> для CRM и 1С: поиск сделки, черновик ответа, эскалация</li>
        <li>Аналитика и извлечение сущностей из документов в закрытом контуре</li>
      </ul>
      <p class="lnnc-related">После пилота RAG типичный следующий шаг — <strong>AI-агенты в CRM и 1С</strong> внутри того же on-prem контура. На корпоративном уровне тренд подтверждают кейсы <a href="<?php echo esc_url(home_url('/kpmg-claude-vnedrenie-ai-276-tysyach/')); ?>" style="color:var(--lnnc-accent);text-decoration:underline;text-underline-offset:3px">масштабного внедрения AI в бизнес</a> у enterprise-компаний — с governance и контролем доступа к данным.</p>
      <p>Для корпоративных регламентов связка <strong>RAG + локальная модель</strong> часто точнее облачного API: cloud не видит ваших документов и не может сослаться на внутренний приказ.</p>
    </div>
  </div>
</section>

<!-- БОРИС: визуальный блок после #chto-takoe -->
<section id="lokalnaya-neyroset-dlya-kompanii-boris-block" class="lnnc-boris-root" aria-label="Карта RAG-контура: запрос сотрудника остаётся внутри периметра компании">
<style>
#lokalnaya-neyroset-dlya-kompanii-boris-block.lnnc-boris-root{padding:56px 0 64px;background:linear-gradient(180deg,rgba(255,255,255,.02),rgba(121,242,255,.03));}
#lokalnaya-neyroset-dlya-kompanii-boris-block .lnnc-boris-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#lokalnaya-neyroset-dlya-kompanii-boris-block .lnnc-boris-card{display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 10px 48px rgba(0,0,0,.35),0 0 0 1px rgba(121,242,255,.15);min-height:500px;}
@media(max-width:1023px){#lokalnaya-neyroset-dlya-kompanii-boris-block .lnnc-boris-card{grid-template-columns:1fr;min-height:auto;}}
#lokalnaya-neyroset-dlya-kompanii-boris-block .lnnc-boris-lft{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0;}
@media(max-width:1023px){#lokalnaya-neyroset-dlya-kompanii-boris-block .lnnc-boris-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}}
#lokalnaya-neyroset-dlya-kompanii-boris-block .lnnc-boris-ey{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0891b2;margin:0 0 14px;}
#lokalnaya-neyroset-dlya-kompanii-boris-block .lnnc-boris-ey::before{content:'';width:18px;height:2px;background:#0891b2;border-radius:1px;}
#lokalnaya-neyroset-dlya-kompanii-boris-block .lnnc-boris-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;}
#lokalnaya-neyroset-dlya-kompanii-boris-block .lnnc-boris-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#lokalnaya-neyroset-dlya-kompanii-boris-block .lnnc-boris-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#lokalnaya-neyroset-dlya-kompanii-boris-block .lnnc-boris-ul li::before{display:none;}
#lokalnaya-neyroset-dlya-kompanii-boris-block .lnnc-boris-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(8,145,178,.1);display:flex;align-items:center;justify-content:center;font-size:11px;color:#0891b2;font-style:normal;}
#lokalnaya-neyroset-dlya-kompanii-boris-block .lnnc-boris-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#lokalnaya-neyroset-dlya-kompanii-boris-block .lnnc-boris-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
#lokalnaya-neyroset-dlya-kompanii-boris-block .lnnc-boris-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#lokalnaya-neyroset-dlya-kompanii-boris-block .lnnc-boris-pl-c{background:rgba(8,145,178,.08);color:#0e7490;border:1.5px solid rgba(8,145,178,.22);}
#lokalnaya-neyroset-dlya-kompanii-boris-block .lnnc-boris-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);}
#lokalnaya-neyroset-dlya-kompanii-boris-block .lnnc-boris-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#lokalnaya-neyroset-dlya-kompanii-boris-block .lnnc-boris-rgt{position:relative;background:linear-gradient(145deg,#050711 0%,#0a1020 55%,#060a14 100%);min-height:440px;overflow:hidden;}
@media(max-width:1023px){#lokalnaya-neyroset-dlya-kompanii-boris-block .lnnc-boris-rgt{min-height:380px;}}
#lnnc-rag-pipeline-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="lnnc-boris-cnt">
  <div class="lnnc-boris-card">
    <div class="lnnc-boris-lft">
      <span class="lnnc-boris-ey">RAG в контуре</span>
      <h3 class="lnnc-boris-h3">Запрос сотрудника → векторная БД → локальная LLM → ответ с цитатой — данные не покидают периметр</h3>
      <ul class="lnnc-boris-ul">
        <li><span class="lnnc-boris-ic">1</span>Сотрудник задаёт вопрос в чате, Telegram или CRM-виджете</li>
        <li><span class="lnnc-boris-ic">2</span>RBAC проверяет доступ к коллекциям документов (роль → RAG)</li>
        <li><span class="lnnc-boris-ic">3</span>Embeddings ищут фрагменты в pgvector / Qdrant on-prem</li>
        <li><span class="lnnc-boris-ic">4</span>Qwen / Llama генерирует ответ с цитатой; запрос пишется в audit log</li>
      </ul>
      <div class="lnnc-boris-pills">
        <span class="lnnc-boris-pl lnnc-boris-pl-g">100% в контуре</span>
        <span class="lnnc-boris-pl lnnc-boris-pl-c">Latency ~1.2с</span>
        <span class="lnnc-boris-pl lnnc-boris-pl-v">12k+ документов RAG</span>
      </div>
      <p class="lnnc-boris-foot">Дальше — кому подходит внедрение и отраслевые сценарии →</p>
    </div>
    <div class="lnnc-boris-rgt">
      <canvas id="lnnc-rag-pipeline-canvas" aria-label="Анимация: поток RAG-запроса внутри корпоративного периметра — документы, векторная БД, локальная LLM, audit log" role="img"></canvas>
    </div>
  </div>
</div>
<script>
(function(){
'use strict';
var cv=document.getElementById('lnnc-rag-pipeline-canvas');
if(!cv)return;
var ctx=cv.getContext('2d'),W=0,H=0,frame=0;
function resize(){var p=cv.parentElement;if(!p)return;cv.width=p.clientWidth||640;cv.height=p.clientHeight||480;W=cv.width;H=cv.height;}
window.addEventListener('resize',resize);resize();
var C={perim:'#79f2ff',perimGlow:'rgba(121,242,255,.15)',violet:'#8b5cf6',green:'#22c55e',doc:'#e2e8f0',vec:'#22d3ee',llm:'#a78bfa',audit:'#4ade80',text:'#94a3b8',bg:'#050711'};
var NODES=[
  {id:'user',label:'Сотрудник',x:.12,y:.5,color:C.doc},
  {id:'rbac',label:'RBAC',x:.28,y:.35,color:C.perim},
  {id:'rag',label:'RAG · pgvector',x:.48,y:.5,color:C.vec},
  {id:'llm',label:'LLM on-prem',x:.68,y:.35,color:C.llm},
  {id:'out',label:'Ответ + цитата',x:.82,y:.55,color:C.green},
  {id:'log',label:'Audit log',x:.68,y:.72,color:C.audit}
];
function rr(x,y,w,h,r,fill,stroke,lw){ctx.beginPath();if(ctx.roundRect)ctx.roundRect(x,y,w,h,r);else ctx.rect(x,y,w,h);if(fill){ctx.fillStyle=fill;ctx.fill();}if(stroke){ctx.strokeStyle=stroke;ctx.lineWidth=lw||1.5;ctx.stroke();}}
function drawPerimeter(cx,cy,rx,ry,pulse){
  ctx.save();
  ctx.strokeStyle=C.perim;
  ctx.lineWidth=2;
  ctx.globalAlpha=.35+.12*Math.sin(pulse*.04);
  ctx.setLineDash([8,6]);
  ctx.beginPath();
  if(ctx.ellipse)ctx.ellipse(cx,cy,rx,ry,0,0,Math.PI*2);
  else ctx.arc(cx,cy,Math.min(rx,ry),0,Math.PI*2);
  ctx.stroke();
  ctx.setLineDash([]);
  ctx.globalAlpha=1;
  ctx.fillStyle=C.perimGlow;
  ctx.beginPath();
  if(ctx.ellipse)ctx.ellipse(cx,cy,rx-4,ry-4,0,0,Math.PI*2);
  else ctx.arc(cx,cy,Math.min(rx,ry)-4,0,Math.PI*2);
  ctx.fill();
  ctx.fillStyle=C.perim;
  ctx.font='bold 10px Inter,sans-serif';
  ctx.textAlign='center';
  ctx.fillText('КОРПОРАТИВНЫЙ ПЕРИМЕТР',cx,cy-ry+16);
  ctx.restore();
}
function drawNode(n,pulse){
  var x=n.x*W,y=n.y*H,w=88,h=36;
  var glow=n.id==='llm'?0.15+0.08*Math.sin(pulse*.06):0;
  if(glow){ctx.shadowColor=C.violet;ctx.shadowBlur=12+8*Math.sin(pulse*.06);}
  rr(x-w/2,y-h/2,w,h,8,'rgba(255,255,255,.08)',n.color,1.5);
  ctx.shadowBlur=0;
  ctx.fillStyle='#fff';
  ctx.font='bold 10px Inter,sans-serif';
  ctx.textAlign='center';
  ctx.fillText(n.label,x,y+4);
}
function drawPacket(t,from,to,color){
  var fx=from.x*W,fy=from.y*H,tx=to.x*W,ty=to.y*H;
  var px=fx+(tx-fx)*t,py=fy+(ty-fy)*t;
  ctx.beginPath();
  ctx.arc(px,py,5,0,Math.PI*2);
  ctx.fillStyle=color;
  ctx.fill();
  ctx.strokeStyle='rgba(255,255,255,.4)';
  ctx.lineWidth=1;
  ctx.stroke();
}
function drawDocs(x,y,pulse){
  for(var i=0;i<3;i++){
    var dy=Math.sin(pulse*.05+i)*3;
    rr(x+i*14,y+dy,12,16,2,C.doc,'#64748b',1);
    ctx.fillStyle='#64748b';
    ctx.font='7px sans-serif';
    ctx.textAlign='center';
    ctx.fillText('DOC',x+i*14+6,y+dy+10);
  }
}
function loop(){
  frame++;
  ctx.clearRect(0,0,W,H);
  var cx=W*.5,cy=H*.52,rx=W*.42,ry=H*.38;
  drawPerimeter(cx,cy,rx,ry,frame);
  drawDocs(W*.38,H*.62,frame);
  var edges=[[0,1],[1,2],[2,3],[3,4],[3,5]];
  edges.forEach(function(e,i){
    var a=NODES[e[0]],b=NODES[e[1]];
    ctx.strokeStyle='rgba(121,242,255,.2)';
    ctx.lineWidth=1;
    ctx.setLineDash([3,5]);
    ctx.beginPath();
    ctx.moveTo(a.x*W,a.y*H);
    ctx.lineTo(b.x*W,b.y*H);
    ctx.stroke();
    ctx.setLineDash([]);
    var t=((frame*0.012+i*0.2)%1);
    drawPacket(t,a,b,C.perim);
  });
  NODES.forEach(function(n){drawNode(n,frame);});
  requestAnimationFrame(loop);
}
loop();
})();
</script>
</section>

<!-- H2: Кому подходит -->
<section class="lnnc-section" id="komu-podhodit">
  <div class="lnnc-cnt">
    <div class="lnnc-sh nero-ai-reveal">
      <span class="lnnc-eyebrow">Целевая аудитория</span>
      <h2>Кому подходит внедрение локальной LLM</h2>
      <p><strong>Локальная нейросеть для бизнеса для компании</strong> — не только enterprise с собственным ЦОД. Это решение для любой организации, где стоимость утечки данных выше стоимости инфраструктуры.</p>
    </div>
    <div class="lnnc-grid-3">
      <div class="lnnc-card nero-ai-reveal">
        <h3>Юридические и финансовые компании</h3>
        <p>Юристы работают с договорами, претензиями, внутренними политиками. Международный кейс <a href="https://yodolabs.jp/en/case-studies/on-premise-llm-financial-services" target="_blank" rel="noopener noreferrer">Yodo Labs</a>: 100% on-prem LLM — GDPR блокировал cloud AI API. Аналогичная логика для российских юрфирм: <strong>локальная LLM</strong> + role-based access + audit logs.</p>
      </div>
      <div class="lnnc-card nero-ai-reveal nero-ai-delay-1">
        <h3>Медицина и производство</h3>
        <p>С 30 мая 2025 года в РФ ужесточены штрафы за утечки ПДн — от 3–5 млн ₽ до 15–20 млн ₽ (<a href="https://www.garant.ru/news/2026629/" target="_blank" rel="noopener noreferrer">ГАРАНТ</a>). Производство — тысячи страниц регламентов ТО и охраны труда.</p>
      </div>
      <div class="lnnc-card nero-ai-reveal nero-ai-delay-2">
        <h3>Малый и средний бизнес</h3>
        <p><strong>Локальная нейросеть для бизнеса для малого бизнеса</strong> — реальна на одной GPU-станции (RTX 4090/5090) с Qwen3 30B. <strong>Для среднего бизнеса</strong> — сервер с 1–2× A100/H100, SSO, интеграция с Bitrix24 или amoCRM.</p>
      </div>
    </div>
  </div>
</section>

<!-- H2: Сценарии -->
<section class="lnnc-section lnnc-section-alt" id="scenarii">
  <div class="lnnc-cnt">
    <div class="lnnc-sh nero-ai-reveal">
      <span class="lnnc-eyebrow">Сценарии</span>
      <h2>Сценарии: внедрение AI в бизнес-процессы без утечки данных</h2>
      <p><strong>Внедрение AI в бизнес процессы</strong> через локальный контур — измеримые сценарии с KPI: время ответа, % resolved without human, снижение нагрузки на экспертов.</p>
    </div>

    <div class="lnnc-scenario nero-ai-reveal">
      <h3>RAG по внутренним регламентам и базам знаний</h3>
      <p><strong>RAG корпоративные данные</strong> — базовый сценарий. Кейс <a href="https://habr.com/ru/companies/flowwow/articles/1032120/" target="_blank" rel="noopener noreferrer">Flowwow на Хабре</a>: 10 000+ документов на n8n + Qwen3 VL 30B; в 5,5 раз дешевле коробочных облачных LLM. Кейс <a href="https://scand.com/ru/portfolio/projects/private-rag-internal-kb-chatbot/" target="_blank" rel="noopener noreferrer">СКЭНД</a>: Ollama + pgvector + Qwen3.</p>
    </div>
    <div class="lnnc-scenario nero-ai-reveal">
      <h3>AI-агенты для CRM, 1С и ERP</h3>
      <p class="lnnc-related">Смежные материалы Nero Network: <a href="<?php echo esc_url(home_url('/vnedrenie-ai-amocrm/')); ?>" style="color:var(--lnnc-accent);text-decoration:underline;text-underline-offset:3px">внедрение AI-агента в amoCRM под ключ</a> — детализация интеграций CRM-контура с локальной LLM.</p>
      <p class="lnnc-related">Для учётного контура — <a href="<?php echo esc_url(home_url('/ai-1c-erp/')); ?>" style="color:var(--lnnc-accent);text-decoration:underline;text-underline-offset:3px">AI-агент для 1С и ERP</a>: поиск заказов, черновики документов и read-only доступ к справочникам на пилоте.</p>
      <p class="lnnc-related">Документы и почта в закрытом контуре — <a href="<?php echo esc_url(home_url('/vnedrenie-ai-obrabotka-email-crm/')); ?>" style="color:var(--lnnc-accent);text-decoration:underline;text-underline-offset:3px">AI-обработка входящей почты в CRM</a> без передачи текста в публичные API.</p>
      <p><strong>Локальная нейросеть для бизнеса с CRM</strong> — агент ищет сделку, суммаризирует переписку, готовит черновик ответа. Оркестратор вызывает инструменты только из whitelist; критичные действия — подтверждение человеком.</p>
    </div>
    <div class="lnnc-scenario nero-ai-reveal">
      <h3>Анализ документов и переписки в закрытом контуре</h3>
      <p>Суммаризация договоров, извлечение условий, сравнение версий, классификация входящей почты — без отправки текста в публичные API.</p>
    </div>
  </div>
</section>

<div class="lnnc-cnt">

<div class="ym-cta-block ym-cta-block--primary lnnc-cta-mid" id="cta-scenarii">
  <div class="ym-cta-block__icon" aria-hidden="true">🔒</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Проверить, подходит ли локальный AI вашему кейсу</p>
    <p class="ym-cta-block__sub">RAG по регламентам, агенты в CRM/1С, анализ документов — разберём 2–3 сценария под ваш контур без передачи данных в облако. Первый шаг — короткий бриф и ориентир по срокам.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</div>

</div>

<!-- H2: Архитектура -->
<section class="lnnc-section" id="arhitektura">
  <div class="lnnc-cnt">
    <div class="lnnc-sh nero-ai-reveal">
      <span class="lnnc-eyebrow">Технологии</span>
      <h2>Архитектура локальной нейросети: GPU, Ollama, vLLM, RAG, MCP</h2>
      <p><strong>Локальные LLM</strong> в 2026 году строятся на open-source стеке без vendor lock-in.</p>
    </div>

    <div class="lnnc-table-wrap nero-ai-reveal" style="margin-bottom:28px;">
      <table class="lnnc-table">
        <thead><tr><th>Модель</th><th>Сильные стороны</th><th>Типичный сценарий</th></tr></thead>
        <tbody>
          <tr><td><strong>Qwen 3.x</strong></td><td>Русский язык, RAG, агенты</td><td>Корпоративный ассистент</td></tr>
          <tr><td><strong>Llama 4 Scout/Maverick</strong></td><td>MoE, эффективность</td><td>Мультиагентные системы</td></tr>
          <tr><td><strong>Mistral Medium 3.5</strong></td><td>Европейский стек</td><td>Compliance-контуры</td></tr>
          <tr><td><strong>DeepSeek</strong></td><td>Reasoning, код</td><td>Техдокументация, ИТ</td></tr>
        </tbody>
      </table>
    </div>

    <div class="lnnc-card nero-ai-reveal">
      <h3>GPU/on-prem развёртывание и масштабирование</h3>
      <p><strong>Пилот:</strong> RTX 4090/5090 — Ollama, до 50 concurrent users. <strong>Прод:</strong> 1–2× A100/H100 — vLLM, chunked prefill. Референс <a href="https://www.cnews.ru/articles/2026-06-11_chto_neobhodimo_dlya_sozdaniya_korporativnogo" target="_blank" rel="noopener noreferrer">Мособлгаз + МегаФон</a>: GPU за 10 дней, 500 пользователей.</p>
    </div>

    <div class="lnnc-card nero-ai-reveal" style="margin-top:20px;">
      <h3>Интеграции через API и MCP-туннели</h3>
      <p>MCP — стандарт подключения инструментов: CRM API, 1С, внутренние сервисы. Альтернатива — <a href="https://resources.rework.com/news/ai-at-work/anthropic-self-hosted-sandboxes-mcp-tunnels-cto" target="_blank" rel="noopener noreferrer">Anthropic Self-Hosted Sandboxes + MCP Tunnels</a> (май 2026). Nero Network реализует аналогичную логику на open-source стеке.</p>
      <p><strong>Модули:</strong> Inference (Ollama → vLLM) · RAG (BGE-M3, pgvector) · Оркестрация (n8n/LangGraph) · Governance (RBAC, audit, PII-фильтр) · Мониторинг GPU.</p>
    </div>
  </div>
</section>

<!-- H2: Облако vs on-prem -->
<section class="lnnc-section lnnc-section-alt" id="oblako-vs-onprem">
  <div class="lnnc-cnt">
    <div class="lnnc-sh nero-ai-reveal">
      <span class="lnnc-eyebrow">Сравнение</span>
      <h2>Облако vs on-prem: сравнение для корпоративных данных</h2>
    </div>
    <div class="lnnc-card nero-ai-reveal">
      <h3>Риски передачи данных во внешние AI-сервисы</h3>
      <p>Каждый промпт в ChatGPT или Claude API — потенциальная передача данных третьей стороне. Для ПДн — обработка в смысле 152-ФЗ; для коммерческой тайны — нарушение NDA.</p>
    </div>
    <div class="lnnc-card nero-ai-reveal" style="margin-top:20px;">
      <h3>152-ФЗ, NDA и отраслевые требования (обзорно)</h3>
      <p class="lnnc-disclaimer">Материал носит информационный характер и не является юридической консультацией.</p>
      <ul>
        <li><strong>152-ФЗ:</strong> штрафы с 30.05.2025 — от 3–5 млн ₽ до 15–20 млн ₽; оборотные до 500 млн ₽ (<a href="https://www.garant.ru/news/2026629/" target="_blank" rel="noopener noreferrer">ГАРАНТ</a>)</li>
        <li><strong>Проект закона об основах регулирования ИИ</strong> (Минцифры, март 2026) — <a href="https://base.garant.ru/483411782/" target="_blank" rel="noopener noreferrer">ГАРАНТ</a></li>
        <li><strong>Локальная LLM 152-ФЗ:</strong> локализация данных снижает риск трансграничной передачи</li>
      </ul>
      <p>Владимир Толмачёв (Салют для бизнеса): <em>«Бизнес больше не хочет выбирать между скоростью внедрения ИИ-решений и безопасностью данных»</em> — <a href="https://www.kommersant.ru/doc/8560082" target="_blank" rel="noopener noreferrer">Коммерсантъ</a>.</p>
    </div>
    <div class="lnnc-card nero-ai-reveal" style="margin-top:20px;">
      <h3>Когда гибридный контур оправдан</h3>
      <p>Частное облако с выделенным GPU · гибрид (RAG on-prem, обновление моделей по защищённому каналу) · ПАК вендора (ГигаЧат Enterprise, Yandex AI Studio on-prem). Nero Network честно разделяет контуры и помогает выбрать путь.</p>
    </div>
  </div>
</section>

<!-- H2: Этапы -->
<section class="lnnc-section" id="etapy">
  <div class="lnnc-cnt">
    <div class="lnnc-sh nero-ai-reveal">
      <span class="lnnc-eyebrow">Дорожная карта</span>
      <h2>Этапы внедрения локальной нейросети под ключ в Nero Network</h2>
      <p><strong>Локальная нейросеть для бизнеса под ключ</strong> — проектная модель с измеримыми этапами.</p>
    </div>
    <div class="lnnc-timeline nero-ai-reveal">
      <div class="lnnc-tl-item"><div class="lnnc-tl-dot"></div><h3>Этап 0 — Аудит (1–2 недели)</h3><p>Инвентаризация данных и систем, выбор 2–3 пилотных сценариев. Результат — <strong>Карта требований к безопасности AI</strong> (лид-магнит).</p></div>
      <div class="lnnc-tl-item"><div class="lnnc-tl-dot"></div><h3>Этап 1 — Пилот (2–4 недели)</h3><p>GPU-стенд + Qwen3 30B или Llama 4 Scout + RAG по 500–2000 документов + веб-чат или Telegram.</p></div>
      <div class="lnnc-tl-item"><div class="lnnc-tl-dot"></div><h3>Этап 2 — Прод (4–8 недель)</h3><p>vLLM, SSO/LDAP, логирование в SIEM, role-based RAG, интеграция CRM/1С через API/n8n.</p></div>
      <div class="lnnc-tl-item"><div class="lnnc-tl-dot"></div><h3>Этап 3 — Агенты (по запросу)</h3><p>MCP-инструменты, генерация КП, эскалация тикетов; human-in-the-loop на критичных действиях.</p></div>
    </div>
    <div class="lnnc-card nero-ai-reveal" style="margin-top:32px;">
      <h3>Обучение команды и политики доступа</h3>
      <p>Без обучения даже лучшая <strong>локальная нейросеть для бизнеса</strong> не приживётся. Nero Network передаёт регламенты использования, матрицу ролей, процедуру актуализации базы знаний и feedback loop.</p>
    </div>

<aside class="ym-cta-block ym-cta-block--secondary lnnc-cta-training" id="cta-training">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет разобраться до старта проекта?</p>
    <p class="ym-cta-block__sub">Перед внедрением on-prem LLM полезно понимать RAG, human-in-the-loop и интеграции с CRM — это ускоряет согласование с ИБ и IT. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent"<?php echo nero_ai_primary_cta_link_attrs($secondary_cta_url); ?>><?php echo esc_html($secondary_cta_label); ?></a>.</p>
  </div>
</aside>

  </div>
</section>

<!-- H2: Стоимость -->
<section class="lnnc-section lnnc-section-alt" id="stoimost">
  <div class="lnnc-cnt">
    <div class="lnnc-sh nero-ai-reveal">
      <span class="lnnc-eyebrow">Бюджет</span>
      <h2>Стоимость и сроки: сколько стоит локальная нейросеть для бизнеса</h2>
      <p>Ориентир чека Nero Network: <strong>700 тыс.–5 млн ₽</strong> — с расчётом под ваш сценарий.</p>
    </div>
    <div class="lnnc-grid-4 nero-ai-reveal" style="margin-bottom:28px;">
      <div class="lnnc-kpi-card"><div class="kv">700К–5М ₽</div><div class="kl">ориентир чека</div></div>
      <div class="lnnc-kpi-card"><div class="kv">2–4 нед.</div><div class="kl">пилот</div></div>
      <div class="lnnc-kpi-card"><div class="kv">4–8 нед.</div><div class="kl">прод</div></div>
      <div class="lnnc-kpi-card"><div class="kv">5,5×</div><div class="kl">дешевле облака (Flowwow)</div></div>
    </div>
    <div class="lnnc-table-wrap nero-ai-reveal">
      <table class="lnnc-table">
        <thead><tr><th>Статья</th><th>Диапазон</th><th>Комментарий</th></tr></thead>
        <tbody>
          <tr><td>Аудит и проектирование</td><td>150–400 тыс. ₽</td><td>Карта безопасности, архитектура</td></tr>
          <tr><td>GPU-инфраструктура</td><td>250 тыс.–2+ млн ₽</td><td>RTX 4090 (SMB) — A100/H100</td></tr>
          <tr><td>RAG + интеграции</td><td>300 тыс.–1,5 млн ₽</td><td>CRM, 1С, мессенджеры</td></tr>
          <tr><td>Агенты и MCP</td><td>200 тыс.–1 млн ₽</td><td>По запросу, после пилота</td></tr>
          <tr><td>Поддержка (год)</td><td>15–20% от проекта</td><td>Обновления, мониторинг</td></tr>
        </tbody>
      </table>
    </div>
    <div class="lnnc-card nero-ai-reveal" style="margin-top:28px;">
      <h3>Под ключ или самостоятельно — что выгоднее</h3>
      <p>Самостоятельная сборка на Ollama возможна для ИТ-команды с ML Ops. Под ключ даёт пилот за 2–4 недели vs 6–9 месяцев, готовые интеграции CRM/1С, governance с первого дня.</p>
      <h3 style="margin-top:20px;">ROI: экономия на облачных API и рисках утечки</h3>
      <p>TCO: CAPEX on-prem vs растущие токены облака. <a href="https://bi-art.com.tr/en/blog/on-prem-llm-strategy-for-banks-ollama-vllm-tei" target="_blank" rel="noopener noreferrer">BIART</a> — break-even on-prem для банка ~18 мес. Flowwow — 5,5× дешевле коробочных облачных LLM.</p>
    </div>
  </div>
</section>

<!-- H2: Кейсы -->
<section class="lnnc-section" id="keisy">
  <div class="lnnc-cnt">
    <div class="lnnc-sh nero-ai-reveal">
      <span class="lnnc-eyebrow">Соцдоказательство</span>
      <h2>Кейсы и примеры внедрения локальной LLM</h2>
    </div>
    <div class="lnnc-grid-2">
      <div class="lnnc-case-card nero-ai-reveal">
        <div class="lnnc-case-tag">RAG · Flowwow</div>
        <h3>10 000+ документов, n8n + Qwen3</h3>
        <p>Мессенджер «Пачка», on-prem. В 5,5 раз дешевле коробочных LLM. <a href="https://habr.com/ru/companies/flowwow/articles/1032120/" target="_blank" rel="noopener noreferrer">Хабр</a></p>
      </div>
      <div class="lnnc-case-card nero-ai-reveal">
        <div class="lnnc-case-tag">RAG · СКЭНД</div>
        <h3>Ollama + pgvector + Qwen3</h3>
        <p>PDF, Word, Excel, Markdown. <a href="https://scand.com/ru/portfolio/projects/private-rag-internal-kb-chatbot/" target="_blank" rel="noopener noreferrer">Портфолио</a></p>
      </div>
      <div class="lnnc-case-card nero-ai-reveal">
        <div class="lnnc-case-tag">Розница · Подружка</div>
        <h3>3000+ сотрудников, Gemma + RAG</h3>
        <p>Telegram, без внешних LLM API. <a href="https://www.cnews.ru/news/line/2026-02-13_napoleon_it_vnedrila_ii-assistenta" target="_blank" rel="noopener noreferrer">CNews</a></p>
      </div>
      <div class="lnnc-case-card nero-ai-reveal">
        <div class="lnnc-case-tag">GPU · Мособлгаз</div>
        <h3>500 пользователей, GPU за 10 дней</h3>
        <p>HR, юридический блок, ИТ, закупки. <a href="https://www.cnews.ru/articles/2026-06-11_chto_neobhodimo_dlya_sozdaniya_korporativnogo" target="_blank" rel="noopener noreferrer">CNews</a></p>
      </div>
    </div>
    <div class="lnnc-card nero-ai-reveal" style="margin-top:28px;">
      <p><strong>Уникальный угол Nero Network:</strong> связка «мировой тренд HPE/NVIDIA (июнь 2026) + arXiv + российские кейсы Flowwow/СКЭНД + внедрение под ключ с CRM/1С» — не абстрактный гайд по Ollama, а коммерческая история от боли до продакшна.</p>
    </div>
  </div>
</section>

<!-- H2: FAQ -->
<section class="lnnc-section lnnc-section-alt" id="faq">
  <div class="lnnc-cnt">
    <div class="lnnc-sh nero-ai-reveal">
      <span class="lnnc-eyebrow">FAQ</span>
      <h2>FAQ — как внедрить локальную нейросеть для бизнеса</h2>
    </div>
    <div class="lnnc-faq nero-ai-reveal">
      <div class="lnnc-faq-item"><div class="lnnc-faq-q">Можно ли без программистов?</div><div class="lnnc-faq-a"><p><strong>Локальная нейросеть для бизнеса без программиста</strong> — да, на этапе эксплуатации: чат в браузере, Telegram или CRM-виджет. Разработка контура — задача интегратора Nero Network.</p></div></div>
      <div class="lnnc-faq-item"><div class="lnnc-faq-q">Какие модели разворачивать on-prem в 2026?</div><div class="lnnc-faq-a"><p>Для русскоязычного RAG — <strong>Qwen 3.x</strong> (30B). Для мультиагентных систем — <strong>Llama 4</strong>. Для compliance — <strong>Mistral</strong>. Nero тестирует 2–3 кандидата на ваших документах.</p></div></div>
      <div class="lnnc-faq-item"><div class="lnnc-faq-q">Как связать локальную LLM с CRM и 1С?</div><div class="lnnc-faq-a"><p>Через API-шлюз и оркестратор (n8n, LangGraph): чат-виджет в amoCRM/Bitrix24, read-only к 1С на пилоте, MCP на проде.</p></div></div>
      <div class="lnnc-faq-item"><div class="lnnc-faq-q">Чем отличается от ChatGPT и облачных API?</div><div class="lnnc-faq-a"><p>Данные в контуре; ответы на <strong>ваших</strong> документах через RAG; предсказуемая экономика; compliance для ПДн.</p></div></div>
      <div class="lnnc-faq-item"><div class="lnnc-faq-q">Сколько стоит локальная нейросеть для бизнеса?</div><div class="lnnc-faq-a"><p>Ориентир: <strong>700 тыс.–5 млн ₽</strong>. Точный расчёт — после аудита и выбора пилотного сценария.</p></div></div>
      <div class="lnnc-faq-item"><div class="lnnc-faq-q">Как внедрить по шагам?</div><div class="lnnc-faq-a"><p>Аудит → карта безопасности → пилот (2–4 нед.) → прод (4–8 нед.) → агенты. CTA: <strong>Проверить вариант локального AI</strong>.</p></div></div>
      <div class="lnnc-faq-item"><div class="lnnc-faq-q">Какие задачи решает в первую очередь?</div><div class="lnnc-faq-a"><p>Поиск по регламентам, суммаризация документов, черновики с human review, классификация заявок, затем AI-агенты в CRM и 1С.</p></div></div>
      <div class="lnnc-faq-item"><div class="lnnc-faq-q">Нужен ли свой ЦОД?</div><div class="lnnc-faq-a"><p>Нет. Старт на арендованном GPU в частном облаке, затем миграция к on-prem — по дорожной карте Nero Network.</p></div></div>
    </div>
  </div>
</section>

<!-- H2: CTA финальный -->
<section class="lnnc-section" id="cta">
  <div class="lnnc-cnt">
    <div class="lnnc-sh nero-ai-reveal">
      <span class="lnnc-eyebrow">Следующий шаг</span>
      <h2>Проверить вариант локального AI</h2>
      <p>Вы не обязаны выбирать между скоростью внедрения AI и безопасностью данных. <strong>Локальная нейросеть для бизнеса под ключ</strong> от Nero Network закрывает разрыв «хотим агентов — нельзя в облако».</p>
    </div>
    <div class="lnnc-cta-dual nero-ai-reveal">
      <div class="lnnc-lead-card">
        <h3>Карта требований к безопасности AI — бесплатно</h3>
        <ul class="lnnc-checklist">
          <li>Классификация данных (ПДн, КТ, отраслевые)</li>
          <li>Требования 152-ФЗ к обработке в промптах (обзорно)</li>
          <li>Политики доступа и role-based RAG</li>
          <li>Логирование, аудит, SIEM</li>
          <li>Human-in-the-loop для критичных действий</li>
          <li>Критерии верификации выхода агента</li>
          <li>Roadmap: RAG сегодня → агенты завтра</li>
        </ul>
      </div>
      <div class="lnnc-cta-card">
        <h3>Проверить вариант локального AI</h3>
        <p>Короткий бриф, оценка сценария, ориентир по срокам и <strong>локальная нейросеть для бизнеса стоимость</strong>. Без навязывания полного контракта: сначала аудит и пилот.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="ym-btn ym-btn--accent" style="margin-top:16px;align-self:flex-start;"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <p style="margin-top:16px;font-size:13px;">Заказать внедрение можно после согласования карты требований и пилотного KPI.</p>
      </div>
    </div>
    <div class="lnnc-card nero-ai-reveal" style="margin-top:32px;text-align:center;">
      <p><strong>Итог:</strong> в 2026 году <strong>внедрение нейросетей</strong> и <strong>внедрение AI решений</strong> в компании с чувствительными данными идёт через локальный контур. HPE/NVIDIA и arXiv 2605.14675 подтверждают тренд; российские кейсы показывают практику. Nero Network разворачивает <strong>локальную нейросеть для бизнеса</strong> под ключ — от карты безопасности до AI-агентов без утечки данных.</p>
    </div>
  </div>
</section>

</div><!-- /.lnnc-content -->

<script>
(function(){
  document.querySelectorAll('.lnnc-faq-q').forEach(function(q){
    q.addEventListener('click',function(){q.parentElement.classList.toggle('open');});
  });
  if(typeof IntersectionObserver!=='undefined'){
    var io=new IntersectionObserver(function(es){es.forEach(function(e){if(e.isIntersecting)e.target.classList.add('nero-ai-active');});},{threshold:.12});
    document.querySelectorAll('.nero-ai-reveal').forEach(function(el){io.observe(el);});
  } else {
    document.querySelectorAll('.nero-ai-reveal').forEach(function(el){el.classList.add('nero-ai-active');});
  }
})();
</script>



<?php
$lnnc_page_url = trailingslashit( get_permalink() );
$lnnc_site_url = trailingslashit( home_url( '/' ) );
$lnnc_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$lnnc_schema   = [
	'@context' => 'https://schema.org',
	'@graph'   => [
		[
			'@type' => 'Organization',
			'@id'   => $lnnc_site_url . '#organization',
			'name'  => $lnnc_brand,
			'url'   => $lnnc_site_url,
		],
		[
			'@type'     => 'WebSite',
			'@id'       => $lnnc_site_url . '#website',
			'url'       => $lnnc_site_url,
			'name'      => $lnnc_brand,
			'publisher' => [ '@id' => $lnnc_site_url . '#organization' ],
		],
		[
			'@type'       => 'WebPage',
			'@id'         => $lnnc_page_url . '#webpage',
			'url'         => $lnnc_page_url,
			'name'        => 'Локальная нейросеть для компании: внедрение под ключ без утечки данных',
			'description' => $page_seo_description,
			'isPartOf'    => [ '@id' => $lnnc_site_url . '#website' ],
			'about'       => [ '@id' => $lnnc_site_url . '#organization' ],
		],
		[
			'@type' => 'BreadcrumbList',
			'@id'   => $lnnc_page_url . '#breadcrumb',
			'itemListElement' => [
				[ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $lnnc_site_url ],
				[ '@type' => 'ListItem', 'position' => 2, 'name' => 'Локальная нейросеть для компании: внедрение под ключ без утечки данных', 'item' => $lnnc_page_url ],
			],
		],
		[
			'@type' => 'Article',
			'@id'   => $lnnc_page_url . '#article',
			'headline' => 'Локальная нейросеть для компании: внедрение под ключ без утечки данных',
			'description' => $page_seo_description,
			'url' => $lnnc_page_url,
			'mainEntityOfPage' => [ '@id' => $lnnc_page_url . '#webpage' ],
			'publisher' => [ '@id' => $lnnc_site_url . '#organization' ],
		],
		[
			'@type' => 'FAQPage',
			'@id'   => $lnnc_page_url . '#faq',
			'mainEntity' => [
				[ '@type' => 'Question', 'name' => 'Можно ли без программистов?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Локальная нейросеть для бизнеса без программиста — да, на этапе эксплуатации: чат в браузере, Telegram или CRM-виджет. Разработка контура — задача интегратора Nero Network.' ] ],
				[ '@type' => 'Question', 'name' => 'Какие модели разворачивать on-prem в 2026?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Для русскоязычного RAG — Qwen 3.x (30B). Для мультиагентных систем — Llama 4. Для compliance — Mistral. Nero тестирует 2–3 кандидата на ваших документах.' ] ],
				[ '@type' => 'Question', 'name' => 'Как связать локальную LLM с CRM и 1С?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Через API-шлюз и оркестратор (n8n, LangGraph): чат-виджет в amoCRM/Bitrix24, read-only к 1С на пилоте, MCP на проде.' ] ],
				[ '@type' => 'Question', 'name' => 'Чем отличается от ChatGPT и облачных API?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Данные в контуре; ответы на ваших документах через RAG; предсказуемая экономика; compliance для ПДн.' ] ],
				[ '@type' => 'Question', 'name' => 'Сколько стоит локальная нейросеть для бизнеса?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Ориентир: 700 тыс.–5 млн ₽. Точный расчёт — после аудита и выбора пилотного сценария.' ] ],
				[ '@type' => 'Question', 'name' => 'Как внедрить по шагам?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Аудит → карта безопасности → пилот (2–4 нед.) → прод (4–8 нед.) → агенты. CTA: Проверить вариант локального AI.' ] ],
				[ '@type' => 'Question', 'name' => 'Какие задачи решает в первую очередь?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Поиск по регламентам, суммаризация документов, черновики с human review, классификация заявок, затем AI-агенты в CRM и 1С.' ] ],
				[ '@type' => 'Question', 'name' => 'Нужен ли свой ЦОД?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет. Старт на арендованном GPU в частном облаке, затем миграция к on-prem — по дорожной карте Nero Network.' ] ],
			],
		],
	],
];
echo '<script type="application/ld+json">' . wp_json_encode( $lnnc_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

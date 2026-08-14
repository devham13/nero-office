<?php
/**
 * Template Name: AI-анализ ассортимента интернет-магазина — внедрение под ключ
 * Description: Внедрение AI-анализа ассортимента: доноры прибыли, неликвид, cross-sell. Аудит 100 SKU.
 */

$page_seo_title       = 'AI-анализ ассортимента интернет-магазина — внедрение под ключ';
$page_seo_description = 'Внедрение AI-анализа ассортимента для интернет-магазинов и маркетплейсов: нейросеть выявляет доноры прибыли, неликвид и связки для продаж. Аудит 100 SKU. Цена от 200 тыс. ₽.';

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

$brand = get_bloginfo( 'name' ) ?: ( getenv( 'SITE_BRAND' ) ?: '' ); // pragma: allowlist secret

$nero_ai_header_links = [
	[ 'label' => 'Что это',       'href' => '#chto-takoe' ],
	[ 'label' => 'Результаты',    'href' => '#rezultaty' ],
	[ 'label' => 'Как работает',  'href' => '#kak-rabotaet' ],
	[ 'label' => 'Пример отчёта', 'href' => '#primer-otcheta' ],
	[ 'label' => 'Кейсы',         'href' => '#keisy' ],
	[ 'label' => 'Цена',          'href' => '#ceny' ],
	[ 'label' => 'FAQ',           'href' => '#faq' ],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if ( ! is_readable( $nero_ai_bootstrap ) ) {
	$nero_ai_bootstrap = dirname( __DIR__ ) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv( 'PRIMARY_CTA_LABEL' ) ?: 'Найти прибыльные товары';
$primary_cta_url     = nero_ai_primary_cta_url( getenv( 'PRIMARY_CTA_URL' ) ?: '' );
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs( $primary_cta_url );
$secondary_cta_label = getenv( 'SECONDARY_CTA_LABEL' ) ?: 'Как это работает';
$secondary_cta_url   = getenv( 'SECONDARY_CTA_URL' ) ?: '#primer-otcheta';

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if ( ! is_readable( $nero_ai_floating ) ) {
	require dirname( __DIR__ ) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
	require $nero_ai_floating;
}

?>

<?php nero_ai_echo_theme_styles( [ 'nero-ai-longread-ui-compat.css' ] ); ?>

<style>
/* Kadence header hide — pill-шапка из темы */
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

/* Hero: full viewport как на meta-journal */
.aiaa-hero.nero-ai-hero{
  min-height:100vh;min-height:100dvh;position:relative;
}

/* Reveal */
.nero-ai-reveal{
  opacity:0;transform:translateY(22px);
  transition:opacity .55s ease,transform .55s ease;
}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
.nero-ai-delay-3{transition-delay:.36s;}
</style>

<main id="primary" class="site-main nero-ai-home-page aiaa-page" role="main" tabindex="-1">

<section class="nero-ai-hero aiaa-hero" id="hero" aria-labelledby="hero-aiaa-title">
  <style>
    /* Локальные дополнения hero aiaa — базовые .nero-ai-* из темы */
    .aiaa-hero .nero-ai-gradient-text {
      background: linear-gradient(92deg, #fff 0%, #22c55e 42%, #8b5cf6 100%);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent !important;
    }
    .aiaa-hero .nero-ai-badge--profit { border-color: rgba(34, 197, 94, 0.35); color: #86efac; }
    .aiaa-hero .nero-ai-badge--danger { border-color: rgba(251, 113, 133, 0.35); color: #fda4af; }
    .aiaa-hero .nero-ai-metric strong { color: #e6edf7; }
    .aiaa-hero .nero-ai-metric--up strong { color: #4ade80; }
    .aiaa-hero .nero-ai-metric--warn strong { color: #fbbf24; }
    .aiaa-hero .nero-ai-metric--down strong { color: #fb7185; }
    .aiaa-hero .nero-ai-task-icon--ingest { background: linear-gradient(135deg, #3b82f6, #6366f1); }
    .aiaa-hero .nero-ai-task-icon--score { background: linear-gradient(135deg, #22c55e, #14b8a6); }
    .aiaa-hero .nero-ai-task-icon--act { background: linear-gradient(135deg, #8b5cf6, #ec4899); }
    .aiaa-dash-canvas-wrap {
      position: relative;
      margin: 12px 0 14px;
      border-radius: 14px;
      overflow: hidden;
      border: 1px solid rgba(255, 255, 255, 0.08);
      background: radial-gradient(ellipse at 50% 0%, rgba(34, 197, 94, 0.12), transparent 55%),
                  linear-gradient(180deg, rgba(8, 12, 24, 0.95), rgba(5, 7, 17, 0.98));
      min-height: 148px;
    }
    #aiaa-matrix-canvas {
      display: block;
      width: 100%;
      height: 148px;
    }
    .aiaa-dash-canvas-label {
      position: absolute;
      left: 12px;
      bottom: 8px;
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: rgba(154, 168, 189, 0.85);
      pointer-events: none;
      z-index: 2;
    }
  </style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai ассортимент</p>
      <h1 id="hero-aiaa-title">AI-анализ ассортимента интернет-магазина: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Нейросеть выявляет товары-доноры прибыли, неликвид и скрытые связки для продаж — чтобы понять, что продвигать, а что убрать из витрины</p>
      <ul class="nero-ai-badges" aria-label="Ключевые результаты">
        <li class="nero-ai-badge nero-ai-badge--profit">Доноры прибыли</li>
        <li class="nero-ai-badge nero-ai-badge--danger">Неликвид</li>
        <li class="nero-ai-badge">Cross-sell</li>
        <li class="nero-ai-badge">ABC/XYZ</li>
        <li class="nero-ai-badge">WB/Ozon</li>
        <li class="nero-ai-badge">1С/CRM</li>
        <li class="nero-ai-badge">Аудит 100 SKU</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url( $primary_cta_url ); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#primer-otcheta">Пример отчёта</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-аналитика ассортимента">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">ассортимент · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-матрица SKU</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>

          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric nero-ai-metric--up">
              <span>Группа A</span>
              <strong>142</strong>
              <small>SKU доноры</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--up">
              <span>Маржа A</span>
              <strong>68%</strong>
              <small>чистая</small>
            </div>
            <div class="nero-ai-metric">
              <span>Cross-sell</span>
              <strong>+34%</strong>
              <small>lift</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--down">
              <span>Неликвид</span>
              <strong>127д</strong>
              <small>среднее CZ</small>
            </div>
          </div>

          <div class="aiaa-dash-canvas-wrap" aria-hidden="true">
            <canvas id="aiaa-matrix-canvas" width="480" height="148"></canvas>
            <span class="aiaa-dash-canvas-label">abc×xyz · live</span>
          </div>

          <div class="nero-ai-task-stream">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--ingest">CSV</span>
              <div><strong>Выгрузка SKU</strong><span>1С · WB · Ozon</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--score">AI</span>
              <div><strong>ABC/XYZ</strong><span>маржа + стабильность</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--act">→</span>
              <div><strong>Рекомендация</strong><span>усилить · вывод · бандл</span></div>
              <span class="nero-ai-status nero-ai-status--new">новое</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * aiaa-assortment-engine.js — диспетчерская матрицы ассортимента
 * Каркас: hero-engine-example.js (Agent, resize, bubbles)
 * Новый мир: AssortmentMatrixHub + SkuArcFlow (не Conveyor/WebsiteTerminal)
 */
document.addEventListener('DOMContentLoaded', () => {
  const canvas = document.getElementById('aiaa-matrix-canvas');
  if (!canvas) return;
  const ctx = canvas.getContext('2d');
  let cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    const wrap = canvas.parentElement;
    if (!wrap) return;
    const dpr = Math.min(window.devicePixelRatio || 1, 2);
    cw = wrap.clientWidth || 480;
    ch = wrap.clientHeight || 148;
    canvas.width = Math.floor(cw * dpr);
    canvas.height = Math.floor(ch * dpr);
    canvas.style.width = cw + 'px';
    canvas.style.height = ch + 'px';
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    cx = cw / 2;
    cy = ch / 2 + 8;
    scale = Math.min(cw / 420, ch / 140) * 0.95;
  }
  window.addEventListener('resize', resizeCanvas);
  resizeCanvas();

  const C = {
    outline: '#94a3b8',
    grid: 'rgba(148, 163, 184, 0.15)',
    ax: '#22c55e', by: '#fbbf24', cz: '#fb7185',
    sku: '#e2e8f0', bridge: '#8b5cf6',
    bubbleBg: 'rgba(15, 23, 42, 0.92)',
    agentYellow: '#eab308', agentGreen: '#10b981', agentBlue: '#3b82f6',
    agentPink: '#ec4899', agentPurple: '#8b5cf6'
  };

  function roundRect(x, y, w, h, r, fill, stroke) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    if (fill) { ctx.fillStyle = fill; ctx.fill(); }
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = 1.5; ctx.stroke(); }
  }

  class SkuArcFlow {
    constructor() { this.offset = 0; }
    draw(ctx) {
      this.offset = (frame * 0.4) % 360;
      for (let lane = 0; lane < 3; lane++) {
        const ang = (this.offset + lane * 120) * Math.PI / 180;
        const r = 95 + lane * 18;
        const px = -r * Math.cos(ang);
        const py = -30 + Math.sin(ang) * 22;
        roundRect(px - 7, py - 5, 14, 10, 2, C.sku, C.outline);
        ctx.fillStyle = C.outline;
        ctx.font = 'bold 6px Inter, sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText('SKU', px, py + 2);
      }
    }
  }

  class AssortmentMatrixHub {
    constructor(x, y) {
      this.x = x; this.y = y;
      this.phase = 0;
      this.pulse = 0;
    }
    draw(ctx) {
      this.phase = (frame * 0.06) % 240;
      const cell = 22, gap = 4;
      const colors = [
        [C.ax, C.ax, C.by], [C.ax, C.by, C.cz], [C.by, C.cz, C.cz],
        [C.ax, C.by, C.by], [C.by, C.by, C.cz], [C.cz, C.cz, C.cz],
        [C.by, C.cz, C.cz], [C.cz, C.cz, C.cz], [C.cz, C.cz, C.cz]
      ];
      for (let row = 0; row < 3; row++) {
        for (let col = 0; col < 3; col++) {
          const idx = row * 3 + col;
          const lit = this.phase > 30 + idx * 18;
          const alpha = lit ? 0.55 + Math.sin(frame * 0.08 + idx) * 0.15 : 0.12;
          const fill = colors[idx][0];
          ctx.globalAlpha = alpha;
          roundRect(
            this.x + col * (cell + gap),
            this.y + row * (cell + gap),
            cell, cell, 4,
            fill, lit ? '#fff' : C.grid
          );
        }
      }
      ctx.globalAlpha = 1;
      if (this.phase > 200) {
        this.pulse = Math.min(1, this.pulse + 0.04);
        ctx.strokeStyle = C.ax;
        ctx.lineWidth = 2;
        ctx.globalAlpha = this.pulse * 0.7;
        roundRect(this.x - 4, this.y - 4, 3 * cell + 2 * gap + 8, 3 * cell + 2 * gap + 8, 8, null, C.ax);
        ctx.globalAlpha = 1;
      } else {
        this.pulse = 0;
      }
    }
  }

  class CrossSellBridge {
    draw(ctx, t) {
      if (t < 120 || t > 190) return;
      const prg = (t - 120) / 70;
      ctx.strokeStyle = C.bridge;
      ctx.lineWidth = 2;
      ctx.globalAlpha = 0.5 + Math.sin(frame * 0.1) * 0.2;
      ctx.beginPath();
      ctx.moveTo(-40, 10);
      ctx.quadraticCurveTo(0, -25 - prg * 10, 50, 5);
      ctx.stroke();
      ctx.globalAlpha = 1;
    }
  }

  class LiquidationShelf {
    draw(ctx, t) {
      if (t < 160) return;
      const a = Math.min(1, (t - 160) / 40);
      ctx.globalAlpha = a * 0.85;
      roundRect(55, 28, 36, 10, 2, C.cz, C.outline);
      ctx.fillStyle = '#fff';
      ctx.font = 'bold 7px Inter, sans-serif';
      ctx.fillText('CZ', 73, 36);
      ctx.globalAlpha = 1;
    }
  }

  class Agent {
    constructor(x, y, color, role, stepTrig, dialogs) {
      this.x = x; this.y = y; this.baseX = x; this.baseY = y;
      this.color = color; this.role = role; this.timer = Math.random() * 100;
      this.stepTrig = stepTrig; this.dialogs = dialogs;
    }
    draw(ctx) {
      this.timer += 0.04;
      const prg = (frame * 0.06) % 240;
      let tx = 8, ty = -18 + this.stepTrig * 0.08;
      let isMoving = false, faceDir = 1;
      if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
        const local = prg - this.stepTrig;
        isMoving = local < 11 || local >= 16;
        faceDir = local < 11 ? 1 : -1;
        const t = local < 11 ? local / 11 : (local - 16) / 6;
        this.x = local < 11
          ? this.baseX + (tx - this.baseX) * t
          : tx - (tx - this.baseX) * t;
        this.y = local < 11
          ? this.baseY + (ty - this.baseY) * t
          : ty - (ty - this.baseY) * t;
      } else {
        this.x = this.baseX; this.y = this.baseY;
      }
      if (!isMoving && frame % 180 === 0 && Math.random() < 0.12) {
        createBubble(this.x, this.y - 14, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
      }
      const bob = Math.sin(this.timer * 2) * 1.2;
      ctx.save();
      ctx.translate(this.x, this.y - bob);
      roundRect(-8, -6, 16, 14, 3, this.color, C.outline);
      ctx.beginPath();
      ctx.arc(0, -12, 7, 0, Math.PI * 2);
      ctx.fillStyle = this.color;
      ctx.fill();
      ctx.strokeStyle = C.outline;
      ctx.lineWidth = 1.2;
      ctx.stroke();
      ctx.restore();
    }
  }

  const hub = new AssortmentMatrixHub(-34, -28);
  const arcFlow = new SkuArcFlow();
  const bridge = new CrossSellBridge();
  const shelf = new LiquidationShelf();
  const bubbles = [];
  const agents = [
    new Agent(-95, 38, C.agentYellow, '1_architect', 12, [
      'Загружаю 1 240 SKU…', 'Сверяю WB и 1С', 'Данные чистые'
    ]),
    new Agent(-72, 52, C.agentGreen, '2_seo', 48, [
      'Маржа, не выручка!', 'AX — 68% прибыли', 'CZ жрёт склад'
    ]),
    new Agent(-50, 30, C.agentBlue, '3_coder', 88, [
      'XYZ по 12 мес.', 'Lift 34% на бандл', 'Дубли SKU ×3'
    ]),
    new Agent(-28, 48, C.agentPink, '4_designer', 128, [
      'Топ витрины — AX', 'CZ в распродажу', 'Связка A→B'
    ]),
    new Agent(-8, 34, C.agentPurple, '5_deployer', 168, [
      'Усилить рекламу AX', 'Вывод 23 SKU', 'Бандл в карточку'
    ])
  ];

  function createBubble(x, y, text, life = 260) {
    bubbles.push({ x, y, text, life, maxLife: life });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    // фоновая сетка зала
    ctx.strokeStyle = C.grid;
    ctx.lineWidth = 1;
    for (let i = -120; i <= 120; i += 24) {
      ctx.beginPath(); ctx.moveTo(i, -50); ctx.lineTo(i, 55); ctx.stroke();
      ctx.beginPath(); ctx.moveTo(-120, i * 0.4 - 10); ctx.lineTo(120, i * 0.4 - 10); ctx.stroke();
    }

    arcFlow.draw(ctx);
    hub.draw(ctx);
    const prg = (frame * 0.06) % 240;
    bridge.draw(ctx, prg);
    shelf.draw(ctx, prg);

    agents.forEach(a => a.draw(ctx));

    if (prg >= 10 && prg < 10.05) createBubble(-90, 10, '1. Импорт SKU');
    if (prg >= 50 && prg < 50.05) createBubble(-68, 24, '2. ABC по марже');
    if (prg >= 90 && prg < 90.05) createBubble(-46, 8, '3. Cross-sell');
    if (prg >= 130 && prg < 130.05) createBubble(-24, 22, '4. Витрина');
    if (prg >= 170 && prg < 170.05) createBubble(-4, 12, '5. Действие!');
    if (prg >= 210 && prg < 210.05) createBubble(0, -42, 'Донор прибыли ✓');

    ctx.font = 'bold 10px Inter, sans-serif';
    ctx.textAlign = 'center';
    for (let i = bubbles.length - 1; i >= 0; i--) {
      const b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      let alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      const tw = ctx.measureText(b.text).width + 14;
      roundRect(b.x - tw / 2, b.y - 18, tw, 18, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = '#e2e8f0';
      ctx.fillText(b.text, b.x, b.y - 7);
      ctx.globalAlpha = 1;
    }
    ctx.restore();
    requestAnimationFrame(engineloop);
  }
  if (document.fonts && document.fonts.ready) document.fonts.ready.then(engineloop);
  else engineloop();
});
</script>

<style>
/* === AIAA CONTENT ROOT (scoped .aiaa-content) === */
.aiaa-content{
  --aiaa-bg:#050711;--aiaa-bg2:#080b17;
  --aiaa-surface:rgba(255,255,255,.072);--aiaa-text:#e6edf7;--aiaa-muted:#9aa8bd;
  --aiaa-soft:#c7d2e5;--aiaa-heading:#fff;--aiaa-border:rgba(255,255,255,.10);
  --aiaa-accent:#79f2ff;--aiaa-violet:#8b5cf6;--aiaa-green:#22c55e;--aiaa-danger:#fb7185;
  --aiaa-warn:#fbbf24;--aiaa-btn-from:#2563eb;--aiaa-btn-to:#7c3aed;
  --aiaa-r:18px;--aiaa-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--aiaa-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.aiaa-content *,.aiaa-content *::before,.aiaa-content *::after{box-sizing:border-box}
.aiaa-content a{color:inherit}
.aiaa-content p{color:var(--aiaa-muted);line-height:1.72;margin:0 0 1em}
.aiaa-content p:last-child{margin-bottom:0}
.aiaa-content h2,.aiaa-content h3,.aiaa-content h4{color:var(--aiaa-heading);letter-spacing:-.045em;margin:0 0 .7em}
.aiaa-content strong{color:var(--aiaa-soft)}
.aiaa-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.aiaa-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--aiaa-muted);font-size:14.5px;line-height:1.65}
.aiaa-content ul li::before{content:'›';position:absolute;left:0;color:var(--aiaa-accent);font-weight:700}
.aiaa-cnt{width:min(var(--aiaa-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.aiaa-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.aiaa-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.aiaa-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.aiaa-sh.aiaa-left{margin-left:0;text-align:left}
.aiaa-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.aiaa-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.aiaa-sh.aiaa-left p{margin-left:0}
.aiaa-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aiaa-accent);margin-bottom:14px}
.aiaa-gt{background:linear-gradient(92deg,#fff 0%,var(--aiaa-accent) 44%,var(--aiaa-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.aiaa-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.aiaa-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.aiaa-intro-text{position:relative;padding-left:20px}
.aiaa-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--aiaa-accent),var(--aiaa-violet))}
.aiaa-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8}
.aiaa-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.aiaa-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px)}
.aiaa-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--aiaa-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.aiaa-kpi-card .kl{font-size:11px;font-weight:600;color:var(--aiaa-muted);line-height:1.4}
.aiaa-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.aiaa-intro-grid{grid-template-columns:1fr;gap:36px}.aiaa-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.aiaa-intro-kpi{grid-template-columns:1fr 1fr}}
.aiaa-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.aiaa-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.aiaa-toc a{display:inline-block;padding:9px 18px;background:var(--aiaa-surface);border:1px solid var(--aiaa-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--aiaa-muted);transition:border-color .2s,color .2s;text-decoration:none!important}
.aiaa-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--aiaa-accent);background:rgba(121,242,255,.08)}
.aiaa-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--aiaa-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s}
.aiaa-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px)}
.aiaa-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.aiaa-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.aiaa-grid-2,.aiaa-grid-3{grid-template-columns:1fr}}
@media(max-width:960px){.aiaa-grid-3{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.aiaa-grid-3{grid-template-columns:1fr}}
.aiaa-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.aiaa-table{width:100%;border-collapse:collapse;font-size:14px}
.aiaa-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--aiaa-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap}
.aiaa-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--aiaa-text);vertical-align:top}
.aiaa-table tr:last-child td{border-bottom:none}
.aiaa-result-card{border-radius:20px;padding:26px;border:1px solid rgba(255,255,255,.1);background:rgba(255,255,255,.05)}
.aiaa-result-card--green{border-color:rgba(34,197,94,.35)}
.aiaa-result-card--red{border-color:rgba(251,113,133,.35)}
.aiaa-result-card--violet{border-color:rgba(139,92,246,.35)}
.aiaa-result-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;margin-bottom:10px}
.aiaa-result-card--green .aiaa-result-tag{color:var(--aiaa-green)}
.aiaa-result-card--red .aiaa-result-tag{color:var(--aiaa-danger)}
.aiaa-result-card--violet .aiaa-result-tag{color:var(--aiaa-violet)}
.aiaa-timeline{position:relative;padding-left:40px}
.aiaa-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--aiaa-accent),var(--aiaa-violet));opacity:.35;border-radius:2px}
.aiaa-tl-item{position:relative;margin-bottom:32px}
.aiaa-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--aiaa-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.aiaa-badges{display:flex;flex-wrap:wrap;gap:8px;margin:20px 0}
.aiaa-badge{padding:7px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);color:var(--aiaa-muted)}
.aiaa-callout-danger{padding:18px 22px;border-radius:14px;background:rgba(251,113,133,.08);border:1px solid rgba(251,113,133,.28);margin:24px 0}
.aiaa-callout-danger p{margin:0;color:#fecdd3;font-size:14.5px}
.aiaa-matrix-mini{display:grid;grid-template-columns:repeat(3,1fr);gap:6px;max-width:280px;margin:16px auto 0}
.aiaa-matrix-cell{padding:10px 6px;border-radius:8px;text-align:center;font-size:11px;font-weight:700;border:1px solid rgba(255,255,255,.1)}
.aiaa-matrix-cell.ax{background:rgba(34,197,94,.2);color:#86efac}
.aiaa-matrix-cell.ay{background:rgba(34,197,94,.12);color:#bbf7d0}
.aiaa-matrix-cell.az{background:rgba(34,197,94,.06);color:#dcfce7}
.aiaa-matrix-cell.bx{background:rgba(121,242,255,.15);color:#a5f3fc}
.aiaa-matrix-cell.by{background:rgba(251,191,36,.15);color:#fde68a}
.aiaa-matrix-cell.bz{background:rgba(251,191,36,.08);color:#fef3c7}
.aiaa-matrix-cell.cx{background:rgba(251,113,133,.12);color:#fda4af}
.aiaa-matrix-cell.cy{background:rgba(251,113,133,.18);color:#fb7185}
.aiaa-matrix-cell.cz{background:rgba(239,68,68,.25);color:#fca5a5}
.aiaa-report-shell{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.12);border-radius:20px;overflow:hidden}
.aiaa-report-top{padding:12px 18px;background:rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.08);display:flex;align-items:center;gap:10px;font-size:12px;color:var(--aiaa-muted)}
.aiaa-report-dots{display:flex;gap:5px}
.aiaa-report-dots span{width:9px;height:9px;border-radius:50%;background:rgba(255,255,255,.2)}
.aiaa-report-body{padding:22px}
.aiaa-report-body ol{margin:0;padding-left:20px;color:var(--aiaa-muted);font-size:14px;line-height:1.7}
.aiaa-case-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px}
@media(max-width:768px){.aiaa-case-grid{grid-template-columns:1fr}}
.aiaa-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px}
.aiaa-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aiaa-green);margin-bottom:10px}
.aiaa-metric{display:flex;align-items:baseline;gap:8px;margin-top:8px}
.aiaa-metric .num{font-size:20px;font-weight:900;color:var(--aiaa-accent)}
.aiaa-price-row--featured{background:rgba(121,242,255,.08)!important;border-left:3px solid var(--aiaa-accent)}
.aiaa-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.aiaa-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.aiaa-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--aiaa-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.aiaa-faq-q::after{content:'▾';font-size:13px;color:var(--aiaa-accent);flex-shrink:0;transition:transform .25s}
.aiaa-faq-item.open .aiaa-faq-q::after{transform:rotate(180deg)}
.aiaa-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--aiaa-muted);line-height:1.72}
.aiaa-faq-item.open .aiaa-faq-a{max-height:800px;padding:0 24px 20px}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--aiaa-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--aiaa-accent)!important;text-decoration:underline!important}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--aiaa-btn-from),var(--aiaa-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35)}
.aiaa-cta-band.nero-ai-section-tight{padding:clamp(36px,5vw,56px) 0}

/* === БОРИС: prefix aiaa-bx-, scoped #ai-analiz-assortimenta-boris-block === */
#ai-analiz-assortimenta-boris-block.aiaa-bx-root{padding:0 0 clamp(48px,6vw,72px);background:linear-gradient(180deg,rgba(255,255,255,.02),transparent)}
#ai-analiz-assortimenta-boris-block .aiaa-bx-cnt{max-width:1160px;margin:0 auto;padding:0 24px}
#ai-analiz-assortimenta-boris-block .aiaa-bx-card{display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 10px 40px rgba(15,23,42,.12),0 0 0 1px rgba(148,163,184,.2);min-height:480px}
@media(max-width:1023px){#ai-analiz-assortimenta-boris-block .aiaa-bx-card{grid-template-columns:1fr;min-height:auto}}
#ai-analiz-assortimenta-boris-block .aiaa-bx-lft{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0}
@media(max-width:1023px){#ai-analiz-assortimenta-boris-block .aiaa-bx-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px}}
#ai-analiz-assortimenta-boris-block .aiaa-bx-ey{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#16a34a;margin:0 0 14px}
#ai-analiz-assortimenta-boris-block .aiaa-bx-ey::before{content:'';width:18px;height:2px;background:#16a34a;border-radius:1px}
#ai-analiz-assortimenta-boris-block .aiaa-bx-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px}
#ai-analiz-assortimenta-boris-block .aiaa-bx-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px}
#ai-analiz-assortimenta-boris-block .aiaa-bx-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155}
#ai-analiz-assortimenta-boris-block .aiaa-bx-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(34,197,94,.1);display:flex;align-items:center;justify-content:center;font-size:11px;color:#15803d;font-style:normal}
#ai-analiz-assortimenta-boris-block .aiaa-bx-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px}
#ai-analiz-assortimenta-boris-block .aiaa-bx-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap}
#ai-analiz-assortimenta-boris-block .aiaa-bx-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22)}
#ai-analiz-assortimenta-boris-block .aiaa-bx-pl-r{background:rgba(251,113,133,.08);color:#be123c;border:1.5px solid rgba(251,113,133,.22)}
#ai-analiz-assortimenta-boris-block .aiaa-bx-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22)}
#ai-analiz-assortimenta-boris-block .aiaa-bx-foot{font-size:13px;color:#64748b;font-style:italic;margin:0}
#ai-analiz-assortimenta-boris-block .aiaa-bx-rgt{position:relative;background:linear-gradient(135deg,#f0fdf4 0%,#ecfdf5 40%,#f8fafc 100%);min-height:420px;overflow:hidden}
@media(max-width:1023px){#ai-analiz-assortimenta-boris-block .aiaa-bx-rgt{min-height:360px}}
#aiaa-assort-matrix-canvas{position:absolute;inset:0;width:100%;height:100%;display:block}
</style>

<div class="aiaa-content">

  <section class="aiaa-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="aiaa-cnt nero-ai-container">
      <div class="aiaa-intro-grid nero-ai-reveal">
        <div class="aiaa-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai ассортимент</p>
          <p><strong>Коротко:</strong> AI-анализ ассортимента — внедрение системы, которая по каждому SKU считает маржу, оборачиваемость, cross-sell и прогноз спроса, а затем выдаёт объяснимые рекомендации: что продвигать, что убрать, что объединить в бандл. Nero Network внедряет контур под ключ для интернет-магазинов и маркетплейс-продавцов — от экспресс-аудита 100 SKU до полной интеграции с 1С, CRM и Wildberries/Ozon.</p>
          <p>Рынок e-commerce в России в 2025 году достиг <strong>13,4 трлн ₽</strong> (+19%), с прогнозом <strong>15,4 трлн ₽</strong> в 2026 (Data Insight). При тысячах SKU ручной Excel перестаёт масштабироваться: товаров много, непонятно что продвигать и что убрать.</p>
          <!-- INTERNAL-LINKS:INSERT -->
        </div>
        <div class="aiaa-intro-kpi" aria-label="Ключевые метрики e-commerce">
          <div class="aiaa-kpi-card"><div class="kv">13,4 трлн ₽</div><div class="kl">рынок e-commerce 2025</div><div class="ks">Data Insight</div></div>
          <div class="aiaa-kpi-card"><div class="kv">81%</div><div class="kl">заказов через маркетплейсы</div><div class="ks">AdIndex, 2026</div></div>
          <div class="aiaa-kpi-card"><div class="kv">71%</div><div class="kl">AI-инструменты — limited effect</div><div class="ks">McKinsey, 2026</div></div>
          <div class="aiaa-kpi-card"><div class="kv">100 SKU</div><div class="kl">вход через аудит</div><div class="ks">лид-магнит</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="aiaa-toc-outer">
    <div class="aiaa-cnt">
      <nav class="aiaa-toc" aria-label="Оглавление статьи">
        <a href="#chto-takoe">Что это</a>
        <a href="#rezultaty">Результаты</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#primer-otcheta">Пример отчёта</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Цена</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="aiaa-section" id="chto-takoe">
    <div class="aiaa-cnt">
      <div class="aiaa-sh aiaa-left nero-ai-reveal">
        <span class="aiaa-eyebrow">Определение</span>
        <h2>Что такое AI-анализ ассортимента интернет-магазина</h2>
        <p>Автоматизированная обработка продаж, маржи, остатков, возвратов и поведения покупателей по каждому SKU с выдачей <strong>объяснимых рекомендаций</strong> по матрице товаров.</p>
      </div>
      <div class="aiaa-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="aiaa-card">
          <h3>Чем отличается от ручного ABC/XYZ</h3>
          <p>Ручной ABC/XYZ в Excel — разовая сводка по <strong>выручке</strong>, без комиссий маркетплейса, логистики FBO и ДРР. AI-аналитика считает по <strong>чистой марже</strong>, находит cross-sell связки, прогнозирует спрос и отвечает на вопрос «почему этот SKU в CZ?».</p>
          <ul>
            <li>Нейросеть анализ продаж товаров в динамике (кейс Epsilon Metrics: MAPE 38% → 9%)</li>
            <li>Кластеризация дублей и избыточных SKU</li>
            <li>LLM-слой для отчётов на русском</li>
          </ul>
        </div>
        <div class="aiaa-card">
          <h3>Для кого: интернет-магазины, маркетплейсы, розница</h3>
          <div class="aiaa-table-wrap">
            <table class="aiaa-table" aria-label="Сегменты ЦА">
              <thead><tr><th>Сегмент</th><th>SKU</th><th>Что даёт AI</th></tr></thead>
              <tbody>
                <tr><td>Собственный ИМ</td><td>500–5 000+</td><td>Доноры прибыли, cross-sell на сайте</td></tr>
                <tr><td>WB / Ozon</td><td>100–30 000</td><td>ABC по марже, прогноз, неликвид</td></tr>
                <tr><td>Розница + ERP</td><td>1 000–50 000</td><td>Единый контур 1С + CRM + каналы</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="aiaa-section aiaa-section-alt" id="bol">
    <div class="aiaa-cnt">
      <div class="aiaa-sh aiaa-left nero-ai-reveal">
        <span class="aiaa-eyebrow">Боль ЦА</span>
        <h2>Когда нужен: товаров много, непонятно что продвигать и что убрать</h2>
        <p>Категорийный менеджер тратит <strong>40%</strong> времени на ручные таблицы (McKinsey «Merchants Unleashed», 2026). <strong>71%</strong> мерчандайзеров говорят, что AI-инструменты дали limited/no effect — из‑за фрагментированных данных и отсутствия workflow.</p>
      </div>
      <div class="aiaa-grid-2 nero-ai-reveal" style="margin-top:28px">
        <div class="aiaa-card">
          <h3>Симптомы «слепого» ассортимента</h3>
          <ul>
            <li>Реклама на «звёзды» по выручке, но маржа отрицательная после комиссий</li>
            <li>FBO-склад забит позициями с оборачиваемостью 120+ дней</li>
            <li>Десятки вкладок Excel и разрыв MPStats ↔ личный кабинет</li>
            <li>Дубли SKU каннибализируют выручку (кейс ВИ.ру + МФТИ)</li>
            <li>Средний чек не растёт — cross-sell не системен</li>
          </ul>
        </div>
        <div class="aiaa-card">
          <h3>Сколько SKU нужно, чтобы AI-аналитика окупилась</h3>
          <ul>
            <li><strong>От 100 SKU</strong> — экспресс-аудит; достаточно CSV из 1С или ЛК МП</li>
            <li><strong>300–1 000 SKU</strong> — типичный коридор пилота</li>
            <li><strong>1 000+ SKU</strong> — ручной ABC раз в квартал не покрывает динамику</li>
          </ul>
          <p style="margin-top:14px;font-size:14px">Грамотная сегментация матрицы может увеличить оборачиваемость на <strong>20–25%</strong> (Kokoc.com) — как ориентир, не гарантия.</p>
        </div>
      </div>
      <div class="aiaa-callout-danger nero-ai-reveal">
        <p><strong>Убыточные «звёзды» по выручке</strong> — устойчивый тренд 2026: товар с высоким оборотом часто убыточен из‑за логистики и комиссий маркетплейса. AI считает маржу, а не только выручку.</p>
      </div>
    </div>
  </section>

  <!-- === БОРИС: визуальный блок (после 2-го H2) === -->
  <section id="ai-analiz-assortimenta-boris-block" class="aiaa-bx-root" aria-label="Анимация: AI раскладывает SKU по матрице ABC×XYZ">
    <div class="aiaa-bx-cnt">
      <div class="aiaa-bx-card">
        <div class="aiaa-bx-lft">
          <span class="aiaa-bx-ey">Матрица в действии</span>
          <h3 class="aiaa-bx-h3">Поток SKU → AI-скоринг → ячейка ABC×XYZ с рекомендацией</h3>
          <ul class="aiaa-bx-ul">
            <li><span class="aiaa-bx-ic">A</span>Доноры прибыли (AX/AY) — усилить рекламу и защитить от OOS</li>
            <li><span class="aiaa-bx-ic">C</span>Неликвид (CZ) — распродажа, вывод, пересмотр закупки</li>
            <li><span class="aiaa-bx-ic">↔</span>Cross-sell связки — бандл «товар A → товар B» с lift/confidence</li>
            <li><span class="aiaa-bx-ic">?</span>Human-in-the-loop: AI ранжирует — менеджер утверждает</li>
          </ul>
          <div class="aiaa-bx-pills">
            <span class="aiaa-bx-pl aiaa-bx-pl-g">ABC по марже</span>
            <span class="aiaa-bx-pl aiaa-bx-pl-r">CZ → вывод</span>
            <span class="aiaa-bx-pl aiaa-bx-pl-v">5 связок</span>
          </div>
          <p class="aiaa-bx-foot">Дальше — три слоя ценности: доноры, неликвид и скрытые бандлы →</p>
        </div>
        <div class="aiaa-bx-rgt">
          <canvas id="aiaa-assort-matrix-canvas" role="img" aria-label="Анимация: SKU проходят AI-сканер и распределяются по матрице ABC×XYZ"></canvas>
        </div>
      </div>
    </div>
    <script>
    (function(){
      'use strict';
      var cv = document.getElementById('aiaa-assort-matrix-canvas');
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
        ink:'#0f172a', muted:'#64748b', paper:'#ffffff', paperBdr:'#cbd5e1',
        ai:'#8b5cf6', aiGlow:'rgba(139,92,246,.22)',
        green:'#22c55e', red:'#fb7185', violet:'#8b5cf6', blue:'#0ea5e9',
        warn:'#fbbf24', line:'rgba(34,197,94,.35)'
      };

      var CELLS = [
        {id:'AX',lbl:'AX',x:0,y:0,col:C.green},{id:'AY',lbl:'AY',x:1,y:0,col:C.green},
        {id:'AZ',lbl:'AZ',x:2,y:0,col:'#86efac'},
        {id:'BX',lbl:'BX',x:0,y:1,col:C.blue},{id:'BY',lbl:'BY',x:1,y:1,col:C.warn},
        {id:'BZ',lbl:'BZ',x:2,y:1,col:'#fde68a'},
        {id:'CX',lbl:'CX',x:0,y:2,col:C.red},{id:'CY',lbl:'CY',x:1,y:2,col:C.red},
        {id:'CZ',lbl:'CZ',x:2,y:2,col:'#ef4444'}
      ];

      var SKUS = [
        {name:'SKU-1842',cell:'AX',color:C.green,delay:0},
        {name:'SKU-0091',cell:'CZ',color:C.red,delay:90},
        {name:'SKU-3307',cell:'AY',color:C.green,delay:180},
        {name:'SKU-7712',cell:'BY',color:C.warn,delay:270},
        {name:'SKU-5520',cell:'CX',color:C.red,delay:360},
        {name:'SKU-2288',cell:'AX',color:C.green,delay:450}
      ];
      var LOOP = 540;
      var BUNDLE = {from:'AX',to:'BY',t:0};

      function rr(x,y,w,h,r,fill,stroke,lw){
        ctx.beginPath();
        if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
        else ctx.rect(x,y,w,h);
        if(fill){ ctx.fillStyle=fill; ctx.fill(); }
        if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
      }

      function drawSkuBox(x,y,s,label,col,alpha){
        ctx.globalAlpha = alpha || 1;
        rr(x,y,s,s*0.85,5,C.paper,C.paperBdr,1.5);
        rr(x+4,y+4,s-8,14,3,col,null,0);
        ctx.fillStyle=C.ink;
        ctx.font='bold 8px Inter,system-ui,sans-serif';
        ctx.textAlign='center';
        ctx.fillText(label,x+s/2,y+s*0.72);
        ctx.globalAlpha=1;
      }

      function drawScanner(cx,cy,w,h,pulse){
        rr(cx,cy,w,h,12,'rgba(139,92,246,.08)',C.ai,2);
        ctx.fillStyle=C.ai;
        ctx.font='bold 11px Inter,sans-serif';
        ctx.textAlign='center';
        ctx.fillText('AI · SKU Scorer',cx+w/2,cy+18);
        var scanY = cy + 28 + (pulse % 70);
        ctx.fillStyle=C.aiGlow;
        ctx.fillRect(cx+8,scanY-2,w-16,4);
        ctx.strokeStyle=C.ai;
        ctx.lineWidth=2;
        ctx.beginPath();
        ctx.moveTo(cx+8,scanY);ctx.lineTo(cx+w-8,scanY);
        ctx.stroke();
      }

      function drawMatrix(mx,my,mw,mh,highlights){
        var cols=3, rows=3, cw=mw/cols, ch=mh/rows, pad=4;
        CELLS.forEach(function(cell){
          var cx=mx+cell.x*cw+pad, cy=my+cell.y*ch+pad;
          var cw2=cw-pad*2, ch2=ch-pad*2;
          var hi = highlights && highlights[cell.id];
          var fill = hi ? cell.col+'33' : 'rgba(255,255,255,.7)';
          var stroke = hi ? cell.col : '#e2e8f0';
          rr(cx,cy,cw2,ch2,6,fill,stroke,hi?2:1);
          ctx.fillStyle=hi?cell.col:C.muted;
          ctx.font=(hi?'bold ':'')+'10px Inter,sans-serif';
          ctx.textAlign='center';
          ctx.fillText(cell.lbl,cx+cw2/2,cy+ch2/2+4);
          if(hi){
            ctx.font='8px Inter,sans-serif';
            ctx.fillText(hi,cx+cw2/2,cy+ch2/2+16);
          }
        });
      }

      function drawBundleArc(mx,my,mw,mh,t){
        if(t<LOOP*0.55 || t>LOOP*0.85) return;
        var cols=3, rows=3, cw=mw/cols, ch=mh/rows;
        var ax=mx+cw*0.5, ay=my+ch*0.5;
        var bx=mx+cw*1.5, by=my+ch*1.5+ch;
        var prog=(t-LOOP*0.55)/(LOOP*0.3);
        ctx.strokeStyle=C.violet;
        ctx.lineWidth=2;
        ctx.setLineDash([5,4]);
        ctx.beginPath();
        ctx.moveTo(ax,ay);
        ctx.quadraticCurveTo(mx+mw*0.5,my+mh*0.3,bx,by);
        ctx.stroke();
        ctx.setLineDash([]);
        ctx.fillStyle=C.violet;
        ctx.font='bold 9px Inter,sans-serif';
        ctx.textAlign='center';
        ctx.fillText('бандл A→B',mx+mw*0.5,my+mh*0.22);
        var dotX=ax+(bx-ax)*prog, dotY=ay+(by-ay)*prog;
        ctx.beginPath();
        ctx.arc(dotX,dotY,4,0,Math.PI*2);
        ctx.fill();
      }

      function loop(){
        frame++;
        var t=frame%LOOP;
        ctx.clearRect(0,0,W,H);

        var pad=16;
        var scanW=Math.min(120,W*0.2);
        var scanH=Math.min(95,H*0.26);
        var scanX=W*0.34-scanW/2;
        var scanY=H*0.42-scanH/2;
        var matW=Math.min(200,W*0.32);
        var matH=Math.min(180,H*0.42);
        var matX=W-matW-pad;
        var matY=H*0.5-matH/2;

        drawScanner(scanX,scanY,scanW,scanH,frame);
        var highlights={};
        SKUS.forEach(function(sku){
          var lt=(t-sku.delay+LOOP)%LOOP;
          if(lt>LOOP-40) return;
          var prog=Math.min(1,lt/160);
          var startX=pad+20;
          var endX=scanX-16;
          var skuX=startX+(endX-startX)*Math.min(prog,0.5)*2;
          if(prog>0.5){
            skuX=scanX+scanW+8+(matX-skuX)*((prog-0.5)*2);
          }
          var skuY=scanY+scanH/2-18;
          var alpha=prog<0.95?1:Math.max(0,1-(lt-150)/10);
          if(prog<0.48){
            drawSkuBox(skuX,skuY,40,sku.name,sku.color,alpha);
          } else if(prog<0.72){
            drawSkuBox(scanX+scanW/2-20,skuY,40,sku.name,sku.color,1);
          } else {
            var cell=CELLS.find(function(c){return c.id===sku.cell;});
            if(cell){
              var cols=3,rows=3,cw=matW/cols,ch=matH/rows;
              var tx=matX+cell.x*cw+cw/2-20;
              var ty=matY+cell.y*ch+ch/2-18;
              var fp=(prog-0.72)/0.28;
              drawSkuBox(scanX+scanW/2-20+(tx-scanX-scanW/2+20)*fp,skuY+(ty-skuY)*fp,40,sku.name,sku.color,alpha);
              if(fp>0.8) highlights[sku.cell]=sku.cell==='CZ'?'вывод':'усилить';
            }
          }
        });

        drawMatrix(matX,matY,matW,matH,highlights);
        drawBundleArc(matX,matY,matW,matH,t);

        ctx.fillStyle=C.muted;
        ctx.font='10px Inter,sans-serif';
        ctx.textAlign='left';
        ctx.fillText('Поток SKU',pad,H-12);
        ctx.textAlign='center';
        ctx.fillText('AI-скоринг',scanX+scanW/2,H-12);
        ctx.textAlign='right';
        ctx.fillText('ABC×XYZ',matX+matW,H-12);

        requestAnimationFrame(loop);
      }
      loop();
    })();
    </script>
  </section>

  <section class="aiaa-section" id="rezultaty">
    <div class="aiaa-cnt">
      <div class="aiaa-sh nero-ai-reveal">
        <span class="aiaa-eyebrow">Три слоя ценности</span>
        <h2>Что показывает AI-аналитика товаров</h2>
        <p><strong>Товары доноры прибыли</strong>, неликвид и <strong>скрытые связки для продаж</strong> — ядро коммерческого оффера Nero Network.</p>
      </div>
      <div class="aiaa-grid-3 nero-ai-reveal">
        <div class="aiaa-result-card aiaa-result-card--green">
          <div class="aiaa-result-tag">Доноры прибыли</div>
          <h3>Товары-доноры прибыли</h3>
          <p>SKU в группах AX/AY по <strong>чистой марже</strong>: стабильный спрос, положительная маржа после удержаний, высокий GMROI. Рекомендации: усилить рекламу, OOS-защита, поднять в витрине.</p>
          <div class="aiaa-metric"><span class="num">~3%</span><span class="lbl">like-for-like growth (McKinsey Assortment.AI)</span></div>
        </div>
        <div class="aiaa-result-card aiaa-result-card--red">
          <div class="aiaa-result-tag">Неликвид</div>
          <h3>Кандидаты на вывод из витрины</h3>
          <p>CZ/убыточные: отрицательная маржа, оборачиваемость 90–180+ дней. <strong>Human-in-the-loop:</strong> AI ранжирует — менеджер утверждает с учётом контрактов и MOQ.</p>
          <div class="aiaa-metric"><span class="num">30–50%</span><span class="lbl">сокращение SKU (ВИ.ру + МФТИ)</span></div>
        </div>
        <div class="aiaa-result-card aiaa-result-card--violet">
          <div class="aiaa-result-tag">Cross-sell</div>
          <h3>Скрытые связки для допродаж</h3>
          <p>Association rules находят пары с высоким lift/confidence. Действие: бандл в карточке, промо «купи вместе», email-подбор.</p>
          <div class="aiaa-metric"><span class="num">+5,5%</span><span class="lbl">выручки (кейс Incanto)</span></div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA #1 после rezultaty -->
  <section class="aiaa-cta-band nero-ai-section nero-ai-section-tight" aria-label="Призыв к действию">
    <div class="aiaa-cnt">
      <div class="ym-cta-block aiaa-cta-band-inner nero-ai-reveal">
        <h3 class="ym-cta-block__headline">Доноры, неликвид и связки — в одном отчёте</h3>
        <p class="ym-cta-block__sub">Нейросеть покажет, какие SKU тянут маржу, что выводить из витрины и какие бандлы собрать. Первый шаг — бесплатный аудит 100 SKU.</p>
        <div class="ym-cta-block__actions">
          <a class="ym-btn ym-btn--accent nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Найти прибыльные товары'); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="aiaa-section aiaa-section-alt" id="kak-rabotaet">
    <div class="aiaa-cnt">
      <div class="aiaa-sh nero-ai-reveal">
        <span class="aiaa-eyebrow">Процесс</span>
        <h2>Как работает внедрение AI-анализа ассортимента</h2>
        <p>Проектная модель Nero Network: аудит → пилот → production. Тренд 2026 — от дашбордов к <strong>агентным</strong> системам с human-in-the-loop.</p>
      </div>
      <div class="aiaa-card nero-ai-reveal" id="etapy">
        <h3>Этапы: аудит данных → модель → отчёт → рекомендации</h3>
        <div class="aiaa-timeline">
          <div class="aiaa-tl-item"><div class="aiaa-tl-dot"></div><h3>1. Сбор данных</h3><p>Продажи, себестоимость, комиссии, логистика, возвраты, остатки, реклама по SKU, корзины/заказы.</p></div>
          <div class="aiaa-tl-item"><div class="aiaa-tl-dot"></div><h3>2. Расчётный слой</h3><p>ABC/XYZ по чистой марже; оборачиваемость; GMROI; кластер дублей.</p></div>
          <div class="aiaa-tl-item"><div class="aiaa-tl-dot"></div><h3>3. AI-слой</h3><p>Market basket, прогноз спроса, генерация текстовых рекомендаций (YandexGPT / GigaChat / Claude).</p></div>
          <div class="aiaa-tl-item"><div class="aiaa-tl-dot"></div><h3>4. Действия</h3><p>Список «продвигать / сократить закуп / распродажа / бандл / проверить цену» с приоритетом по марже.</p></div>
          <div class="aiaa-tl-item"><div class="aiaa-tl-dot"></div><h3>5. Контроль</h3><p>Менеджер утверждает; система через 30 дней сравнивает факт с прогнозом.</p></div>
        </div>
      </div>
      <div class="aiaa-table-wrap nero-ai-reveal" style="margin-top:28px">
        <table class="aiaa-table" aria-label="Сроки внедрения">
          <thead><tr><th>Этап</th><th>Срок</th><th>Результат</th></tr></thead>
          <tbody>
            <tr><td>Экспресс-аудит 100 SKU</td><td>3–5 раб. дней</td><td>PDF/Notion-отчёт, quick wins</td></tr>
            <tr><td>Пилот</td><td>3–4 недели</td><td>Еженедельный автоотчёт, дашборд</td></tr>
            <tr><td>Внедрение под ключ</td><td>6–10 недель</td><td>LLM-ассистент, алерты, интеграции</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="aiaa-section" id="integracii">
    <div class="aiaa-cnt">
      <div class="aiaa-sh aiaa-left nero-ai-reveal">
        <span class="aiaa-eyebrow">Интеграции</span>
        <h2>Интеграция с CRM, ERP, 1С и маркетплейсами</h2>
        <p>Ключевое отличие от SaaS «ABC за 5 минут». Без связки с учётом и закупками <strong>71%</strong> AI-инструментов не дают эффекта (McKinsey, 2026).</p>
      </div>
      <div class="aiaa-badges nero-ai-reveal">
        <span class="aiaa-badge">1С:УТ / ERP</span>
        <span class="aiaa-badge">МойСклад</span>
        <span class="aiaa-badge">Wildberries API</span>
        <span class="aiaa-badge">Ozon Seller API</span>
        <span class="aiaa-badge">RetailCRM</span>
        <span class="aiaa-badge">amoCRM</span>
        <span class="aiaa-badge">MPStats</span>
        <span class="aiaa-badge">Power BI / Metabase</span>
        <span class="aiaa-badge">n8n / Make</span>
      </div>
      <div class="aiaa-grid-2 nero-ai-reveal" style="margin-top:24px">
        <div class="aiaa-card">
          <h3>Выгрузки из Wildberries, Ozon, собственного магазина</h3>
          <p>Seller API — продажи, остатки, реализация, реклама. Внешняя аналитика MPStats/MarketGuru — кросс-анализ «рынок vs свой кабинет».</p>
        </div>
        <div class="aiaa-card">
          <h3>Связка с CRM и складским учётом</h3>
          <p>ERP — себестоимость, остатки, закупки. CRM — заказы, сегменты, RFM. Автоматизация — рассылка отчётов и алерты в Telegram.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="aiaa-section aiaa-section-alt" id="primer-otcheta">
    <div class="aiaa-cnt">
      <div class="aiaa-sh nero-ai-reveal">
        <span class="aiaa-eyebrow">Лид-магнит</span>
        <h2>Пример отчёта: аудит 100 SKU</h2>
        <p>Конкретный документ, а не абстрактное «демо». Клиент передаёт выгрузку за 6–12 месяцев — достаточно CSV из 1С, CRM или ЛК маркетплейса.</p>
      </div>
      <div class="aiaa-grid-2 nero-ai-reveal" style="align-items:start">
        <div class="aiaa-report-shell">
          <div class="aiaa-report-top">
            <div class="aiaa-report-dots"><span></span><span></span><span></span></div>
            <span>аудит 100 SKU · пример отчёта</span>
          </div>
          <div class="aiaa-report-body">
            <ol>
              <li><strong>Сводка:</strong> X SKU в A / Y в C; Z% маржи в группе A; N кандидатов на вывод</li>
              <li><strong>Топ-10 доноров прибыли</strong> — SKU, маржа, доля, «усилить»</li>
              <li><strong>Топ-10 неликвида</strong> — маржа, дни на складе, действие</li>
              <li><strong>5 cross-sell связок</strong> — товар A → B, lift/confidence</li>
              <li><strong>Матрица ABC×XYZ</strong> — 9 ячеек с долей маржи</li>
              <li><strong>3 quick wins на 7 дней</strong></li>
              <li><strong>Что даст полное внедрение</strong> — автоотчёты, алерты, прогноз</li>
            </ol>
          </div>
        </div>
        <div>
          <h3>Как читать отчёт</h3>
          <ul>
            <li><strong>AX</strong> — защита от OOS, приоритет рекламы</li>
            <li><strong>CZ</strong> — распродажа, вывод; AI объясняет причину</li>
            <li><strong>Cross-sell</strong> — бандлы и блоки «с этим покупают»</li>
            <li><strong>Quick wins</strong> — 3 шага с макс. влиянием на маржу за 7 дней</li>
          </ul>
          <div class="aiaa-matrix-mini" aria-hidden="true">
            <div class="aiaa-matrix-cell ax">AX</div><div class="aiaa-matrix-cell ay">AY</div><div class="aiaa-matrix-cell az">AZ</div>
            <div class="aiaa-matrix-cell bx">BX</div><div class="aiaa-matrix-cell by">BY</div><div class="aiaa-matrix-cell bz">BZ</div>
            <div class="aiaa-matrix-cell cx">CX</div><div class="aiaa-matrix-cell cy">CY</div><div class="aiaa-matrix-cell cz">CZ</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA #2 лид-магнит после primer-otcheta -->
  <section class="aiaa-cta-band nero-ai-section nero-ai-section-tight" aria-label="Лид-магнит аудит 100 SKU">
    <div class="aiaa-cnt">
      <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal">
        <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
        <h3 class="ym-cta-block__headline">Бесплатный аудит 100 SKU</h3>
        <p class="ym-cta-block__sub">7 блоков отчёта: доноры прибыли, неликвид, 5 cross-sell связок, матрица ABC×XYZ и 3 quick wins на неделю. Передайте CSV — получите план действий за 3–5 рабочих дней.</p>
        <div class="ym-cta-block__actions">
          <a class="ym-btn ym-btn--accent nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Найти прибыльные товары'); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="aiaa-section" id="keisy">
    <div class="aiaa-cnt">
      <div class="aiaa-sh nero-ai-reveal">
        <span class="aiaa-eyebrow">Проверяемые источники</span>
        <h2>Кейсы внедрения AI-анализа ассортимента</h2>
        <p>Смежные внедрения в России и международные ориентиры — без выдачи чужих кейсов за свои.</p>
      </div>
      <div class="aiaa-case-grid nero-ai-reveal">
        <div class="aiaa-case-card">
          <div class="aiaa-case-tag">Собственный ИМ</div>
          <h3>ВсеИнструменты.ру + Институт ИИ МФТИ</h3>
          <p>ИИ-модуль прогнозирования спроса и оптимизации матрицы; кластеризация SKU, выявление дублей.</p>
          <div class="aiaa-metric"><span class="num">−30–50%</span><span class="lbl">позиций при сохранении выручки</span></div>
          <p style="margin-top:12px;font-size:13px;font-style:italic">«Получили работающий инструмент управления» — А. Наумова, ВИ.ру</p>
        </div>
        <div class="aiaa-case-card">
          <div class="aiaa-case-tag">Маркетплейсы</div>
          <h3>Epsilon Metrics — ~30 000 SKU на Wildberries</h3>
          <p>AI-прогноз спроса с опережающими индикаторами; замена Excel-планирования.</p>
          <div class="aiaa-metric"><span class="num">MAPE 9%</span><span class="lbl">vs 38% скользящее среднее</span></div>
        </div>
      </div>
    </div>
  </section>

  <section class="aiaa-section aiaa-section-alt" id="ceny">
    <div class="aiaa-cnt">
      <div class="aiaa-sh nero-ai-reveal">
        <span class="aiaa-eyebrow">Пакеты</span>
        <h2>Сколько стоит и что входит в чек 200–700 тыс. ₽</h2>
        <p>Прозрачные пакеты: вход через аудит, масштабирование по объёму SKU и глубине интеграций.</p>
      </div>
      <div class="aiaa-table-wrap nero-ai-reveal">
        <table class="aiaa-table" aria-label="Пакеты и цены">
          <thead><tr><th>Пакет</th><th>Ориентир чека</th><th>Что входит</th></tr></thead>
          <tbody>
            <tr><td>Аудит 100 SKU</td><td>Вход / лид-магнит</td><td>ABC/XYZ по марже, доноры, неликвид, 5 связок, quick wins</td></tr>
            <tr class="aiaa-price-row--featured"><td><strong>Пилот</strong></td><td>~200–350 тыс. ₽</td><td>1–2 источника данных, еженедельный отчёт, дашборд Metabase/Retool/Power BI</td></tr>
            <tr><td>Под ключ</td><td>200–700 тыс. ₽</td><td>LLM-ассистент, алерты, интеграция в закупки/рекламу</td></tr>
          </tbody>
        </table>
      </div>
      <div class="aiaa-card nero-ai-reveal" style="margin-top:24px">
        <h3>ROI: что считать до старта</h3>
        <ul>
          <li>Замороженный капитал в CZ — остатки × себестоимость</li>
          <li>Убыточные SKU по марже — сумма отрицательной маржи за квартал</li>
          <li>FBO-хранение — позиции с оборачиваемостью &gt;90 дней</li>
          <li>Потенциал cross-sell — средний чек × lift от бандлов</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- CTA #3 после ceny -->
  <section class="aiaa-cta-band nero-ai-section nero-ai-section-tight" aria-label="Заказать пилот">
    <div class="aiaa-cnt">
      <div class="ym-cta-block nero-ai-reveal">
        <h3 class="ym-cta-block__headline">Заказать пилот или внедрение под ключ</h3>
        <p class="ym-cta-block__sub">От аудита 100 SKU до полного контура с LLM-ассистентом и интеграцией 1С + CRM + WB/Ozon. Ориентир: 200–700 тыс. ₽ в зависимости от объёма SKU.</p>
        <div class="ym-cta-block__actions">
          <a class="ym-btn ym-btn--accent nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Найти прибыльные товары'); ?></a>
          <a class="ym-link--accent" href="#faq">Сначала FAQ</a>
        </div>
      </div>
    </div>
  </section>

  <section class="aiaa-section" id="bez-programmistov">
    <div class="aiaa-cnt">
      <div class="aiaa-sh aiaa-left nero-ai-reveal">
        <span class="aiaa-eyebrow">Без IT-отдела</span>
        <h2>Внедрение без программиста</h2>
        <p>Реальность для малого и среднего e-commerce без ML-отдела. Nero Network подключает коннекторы, настраивает ETL и дашборд — категорийный менеджер работает с отчётами и чат-ассистентом.</p>
      </div>
      <div class="aiaa-card nero-ai-reveal">
        <h3>Какие данные подготовить самостоятельно</h3>
        <ul>
          <li>Выгрузка продаж по SKU за 6–12 месяцев (кол-во, выручка, себестоимость)</li>
          <li>Комиссии, логистика, реклама по SKU (для МП — отчёт о реализации)</li>
          <li>Остатки и оборачиваемость; корзины/заказы для cross-sell</li>
          <li>Справочник номенклатуры (категория, бренд, атрибуты)</li>
        </ul>
        <p style="margin-top:16px">После запуска — еженедельные автоотчёты, алерты (падение маржи, OOS на AX, рост CZ-хранения), дообучение модели. Если хотите глубже разобраться в agentic-автоматизации до старта проекта — <a href="<?php echo esc_url($secondary_cta_url); ?>" target="_blank" rel="noopener noreferrer" class="ym-link--accent"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
      </div>
    </div>
  </section>

  <section class="aiaa-section aiaa-section-alt" id="faq">
    <div class="aiaa-cnt">
      <div class="aiaa-sh nero-ai-reveal">
        <span class="aiaa-eyebrow">FAQ</span>
        <h2>FAQ по AI-анализу ассортимента</h2>
      </div>
      <div class="aiaa-faq nero-ai-reveal">
        <div class="aiaa-faq-item">
          <div class="aiaa-faq-q" tabindex="0" role="button" aria-expanded="false">Нужны ли программисты?</div>
          <div class="aiaa-faq-a"><p>Нет для заказчика на этапе внедрения под ключ. Nero Network выполняет разработку, интеграции и автоматизацию (n8n/Make). Внутри компании нужен контакт: закупщик или владелец для выгрузок и утверждения рекомендаций.</p></div>
        </div>
        <div class="aiaa-faq-item">
          <div class="aiaa-faq-q" tabindex="0" role="button" aria-expanded="false">Как быстро первые результаты?</div>
          <div class="aiaa-faq-a"><p>Аудит 100 SKU: 3–5 рабочих дней — первые quick wins. Пилот: 3–4 недели — регулярные отчёты. Эффект в деньгах: через 30–60 дней после действий по неликвиду и рекламе.</p></div>
        </div>
        <div class="aiaa-faq-item">
          <div class="aiaa-faq-q" tabindex="0" role="button" aria-expanded="false">Подходит ли для малого бизнеса?</div>
          <div class="aiaa-faq-a"><p>Да, от ~100 SKU и 6 месяцев истории. При меньшем объёме может хватить ручного ABC; при росте матрицы AI окупается быстрее Excel.</p></div>
        </div>
        <div class="aiaa-faq-item">
          <div class="aiaa-faq-q" tabindex="0" role="button" aria-expanded="false">У нас и так MPStats/SelSup — зачем внедрение?</div>
          <div class="aiaa-faq-a"><p>SaaS показывает цифры, но не внедряет решения в 1С и закупки. AI-слой даёт <strong>действия</strong>, не дашборд.</p></div>
        </div>
        <div class="aiaa-faq-item">
          <div class="aiaa-faq-q" tabindex="0" role="button" aria-expanded="false">71% AI-инструментов не работают — почему у вас иначе?</div>
          <div class="aiaa-faq-a"><p>Проблема в интеграции и данных (McKinsey, 2026). Наш процесс начинается с <strong>аудита данных</strong>, не с «поставили модель».</p></div>
        </div>
      </div>
    </div>
  </section>

  <?php /* AD_BANNER: вставить нижний баннер при настройке AD_BANNER_URL / AD_BANNER_IMAGE_URL в env */ ?>

</div>

<script>
(function(){
  document.querySelectorAll('.aiaa-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.aiaa-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.aiaa-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.aiaa-faq-q');
        if(q) q.setAttribute('aria-expanded','false');
      });
      if(!isOpen){
        item.classList.add('open');
        btn.setAttribute('aria-expanded','true');
      }
    });
    btn.addEventListener('keydown', function(e){
      if(e.key==='Enter'||e.key===' '){ e.preventDefault(); btn.click(); }
    });
  });
})();
</script>


<!-- INTERNAL-LINKS:INSERT -->

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

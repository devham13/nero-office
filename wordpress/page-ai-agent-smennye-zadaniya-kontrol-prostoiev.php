<?php
/**
 * Template Name: AI-агент для сменных заданий и контроля простоев
 * Description: SEO-лендинг — AI-агент для сменных заданий, контроль простоев, OEE-lite, Telegram. Под ключ для малого производства.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-агент для производства: сменные задания и контроль простоев';
$page_seo_description = 'Внедрение AI-агента для сменных заданий и контроля простоев на производстве. Фиксация отклонений в реальном времени и отчёт руководителю. Под ключ для цеха и малого производства.';

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
$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Написать в Telegram';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#etapy';

$nero_ai_header_links = [
    ['label' => 'Проблема',   'href' => '#problema'],
    ['label' => 'Решение',    'href' => '#reshenie'],
    ['label' => 'Внедрение',  'href' => '#etapy'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'KPI',        'href' => '#kpi'],
    ['label' => 'Цена',       'href' => '#ceny'],
    ['label' => 'FAQ',        'href' => '#faq'],
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
body.nero-ai-landing #mobile-header { display: none !important; }
body.nero-ai-landing { padding-top: 0 !important; }

.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,
.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}

#primary,.site-main,.site-content,#content,.content-area{
  padding-top:0!important;margin-top:0!important;
}

.smz-hero{min-height:100vh;min-height:100dvh;position:relative;}

.smz-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.smz-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.smz-toc a{
  display:inline-block;padding:9px 18px;
  background:rgba(255,255,255,.072);border:1px solid rgba(255,255,255,.10);
  border-radius:999px;font-size:13px;font-weight:600;color:#9aa8bd;
  transition:border-color .2s,color .2s,background .2s;
}
.smz-toc a:hover{border-color:rgba(245,197,24,.42);color:#f5c518;background:rgba(245,197,24,.08);}

#smz-longread .smz-intro-text p{text-align:left!important;}

.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,#2563eb,#7c3aed);color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:#e6edf7!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:#f5c518!important;text-decoration:underline!important;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-agent-smennye-zadaniya-kontrol-prostoiev-page" role="main" tabindex="-1">

<section class="nero-ai-hero smz-hero" id="hero" aria-labelledby="smz-hero-title">
<style>
/* ── Hero smz: самодостаточные стили (без CSS темы) ── */
.smz-hero {
  --smz-bg: #050711;
  --smz-accent: #f5c518;
  --smz-cyan: #79f2ff;
  --smz-green: #22c55e;
  --smz-red: #ef4444;
  --smz-violet: #8b5cf6;
  --smz-btn-from: #2563eb;
  --smz-btn-to: #7c3aed;
  --smz-text: #e6edf7;
  --smz-muted: #9aa8bd;
  --smz-soft: #c7d2e5;
  --smz-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.smz-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 32% 24%, #000 0%, transparent 70%);
  opacity: .5;
  pointer-events: none;
  z-index: -2;
}
.smz-hero::after {
  content: "";
  position: absolute;
  left: 6%;
  bottom: 8%;
  width: 520px;
  height: 520px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(239, 68, 68, .09), transparent 66%);
  filter: blur(10px);
  animation: smzHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes smzHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .75; transform: scale(1.04); }
}
.smz-hero .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.smz-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(380px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.smz-hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 66px);
  line-height: .97;
  letter-spacing: -0.055em;
  color: #fff;
  font-weight: 900;
}
.smz-hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--smz-accent) 38%, var(--smz-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.smz-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(245, 197, 24, 0.24);
  border-radius: 999px;
  background: rgba(245, 197, 24, 0.08);
  color: var(--smz-accent) !important;
  font-size: 12px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.smz-hero .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--smz-soft) !important;
  font-size: clamp(16px, 1.85vw, 20px);
  line-height: 1.6;
}
.smz-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.smz-hero .nero-ai-badge {
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
.smz-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.smz-hero .nero-ai-btn {
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
.smz-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.smz-hero .nero-ai-btn-primary {
  color: #1a1200 !important;
  background: linear-gradient(135deg, var(--smz-accent), #fde68a);
  box-shadow: 0 18px 42px rgba(245, 197, 24, 0.22);
}
.smz-hero .nero-ai-btn-secondary {
  color: var(--smz-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.smz-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--smz-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.smz-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.smz-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.smz-hero .nero-ai-dots { display: flex; gap: 7px; }
.smz-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.smz-hero .nero-ai-dot:nth-child(1) { background: #ef4444; }
.smz-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.smz-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.smz-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.smz-hero .nero-ai-window-body { padding: 16px; }
.smz-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.smz-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.smz-hero .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(239, 68, 68, .12);
  color: #fecaca;
  font-size: 12px;
  font-weight: 800;
}
.smz-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--smz-red);
  box-shadow: 0 0 0 6px rgba(239, 68, 68, .14);
  animation: smzPulse 1.4s infinite;
}
@keyframes smzPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.smz-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.smz-hero .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.smz-hero .nero-ai-metric span {
  display: block;
  color: var(--smz-muted);
  font-size: 11px;
  font-weight: 700;
}
.smz-hero .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.smz-hero .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.smz-hero .nero-ai-metric--warn strong { color: var(--smz-accent); }
.smz-hero .nero-ai-metric--ok strong { color: var(--smz-green); }
.smz-hero .smz-dash-canvas-wrap {
  position: relative;
  height: clamp(210px, 30vw, 280px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(239, 68, 68, 0.18);
  background: radial-gradient(ellipse at 50% 40%, rgba(245,197,24,.06), rgba(6,10,24,.94) 72%);
}
.smz-hero #smz-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.smz-hero .nero-ai-task-stream { display: grid; gap: 8px; }
.smz-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.smz-hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(245,197,24,.12);
  color: var(--smz-accent);
  font-size: 10px;
  font-weight: 800;
}
.smz-hero .nero-ai-task-icon--red {
  background: rgba(239,68,68,.14);
  color: #fca5a5;
}
.smz-hero .nero-ai-task-icon--cyan {
  background: rgba(121,242,255,.12);
  color: var(--smz-cyan);
}
.smz-hero .nero-ai-task-icon--green {
  background: rgba(34,197,94,.12);
  color: #86efac;
}
.smz-hero .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.smz-hero .nero-ai-task span {
  color: var(--smz-muted);
  font-size: 11px;
}
.smz-hero .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.smz-hero .nero-ai-status--red {
  background: rgba(239,68,68,.14);
  color: #fecaca;
}
.smz-hero .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.smz-hero .nero-ai-status--cyan {
  background: rgba(121,242,255,.1);
  color: #a5f3fc;
}
@media (max-width: 1100px) {
  .smz-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .smz-hero .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .smz-hero .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .smz-hero .nero-ai-window-body { padding: 12px; }
  .smz-hero .nero-ai-task { grid-template-columns: 28px 1fr; }
  .smz-hero .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Производство / смены · ai производство контроль</p>
      <h1 id="smz-hero-title">AI-агент для сменных заданий и контроля простоев: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Нейросеть выдаёт сменные задания, фиксирует простои в реальном времени и формирует отчёт руководителю — без ручного Excel и «узнаём о простое на следующий день»</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Сменные задания</li>
        <li class="nero-ai-badge">Контроль простоев</li>
        <li class="nero-ai-badge">Telegram</li>
        <li class="nero-ai-badge">OEE-lite</li>
        <li class="nero-ai-badge">Human-in-the-loop</li>
        <li class="nero-ai-badge">Под ключ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#etapy">Как внедряем</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация дашборда смены и контроля простоев">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Дашборд смены · демо</h3>
            <span class="nero-ai-live-pill">live</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric nero-ai-metric--ok">
              <span>OEE смены</span>
              <strong>78%</strong>
              <small>цель 80%+</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--warn">
              <span>Простои</span>
              <strong>12/12</strong>
              <small>с кодом причины</small>
            </div>
            <div class="nero-ai-metric">
              <span>Сводка</span>
              <strong>4 мин</strong>
              <small>вместо 60–90 мин</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--ok">
              <span>Plan vs Fact</span>
              <strong>94%</strong>
              <small>выполнение плана</small>
            </div>
          </div>

          <div class="smz-dash-canvas-wrap" aria-hidden="false">
            <canvas id="smz-hero-canvas" role="img" aria-label="Анимация: сменные задания по рельсу, Andon фиксирует простой, AI пересобирает очередь и отправляет SBAR-отчёт"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий смены">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--red">P02</span>
              <div><strong>10:12 Простой P02 · ЧПУ</strong><span>Поломка · таймер запущен</span></div>
              <span class="nero-ai-status nero-ai-status--red">live</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--amber">!</span>
              <div><strong>10:27 Эскалация мастеру</strong><span>Простой &gt; 15 мин · Telegram</span></div>
              <span class="nero-ai-status nero-ai-status--amber">эскалация</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>14:30 Задание пересобрано</strong><span>Срочный заказ · новая очередь</span></div>
              <span class="nero-ai-status">пересчёт</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--cyan">SB</span>
              <div><strong>19:55 SBAR-отчёт директору</strong><span>Выполнено 94% · топ-3 простоя</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">handoff</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══ БОРИС: глобальные стили лонгрида smz- (НЕ hero) ═══ -->
<style>
/* Scoped: только внутри #smz-longread */
#smz-longread.smz-content{
  --smz-bg:#050711;--smz-bg2:#080b17;--smz-bg3:#0a0e1c;
  --smz-surface:rgba(255,255,255,.072);--smz-surface2:rgba(255,255,255,.108);
  --smz-text:#e6edf7;--smz-muted:#9aa8bd;--smz-soft:#c7d2e5;--smz-heading:#fff;
  --smz-border:rgba(255,255,255,.10);--smz-border-s:rgba(255,255,255,.18);
  --smz-accent:#f5c518;--smz-cyan:#79f2ff;--smz-green:#22c55e;--smz-red:#ef4444;
  --smz-violet:#8b5cf6;--smz-btn-from:#2563eb;--smz-btn-to:#7c3aed;
  --smz-r:18px;--smz-r-lg:24px;--smz-container:1220px;
  background:linear-gradient(180deg,var(--smz-bg) 0%,var(--smz-bg2) 52%,var(--smz-bg) 100%);
  color:var(--smz-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
#smz-longread *,#smz-longread *::before,#smz-longread *::after{box-sizing:border-box;}
#smz-longread a{color:inherit;text-decoration:none;}
#smz-longread p{color:var(--smz-muted);line-height:1.72;margin:0 0 1em;}
#smz-longread p:last-child{margin-bottom:0;}
#smz-longread h2,#smz-longread h3,#smz-longread h4{color:var(--smz-heading);letter-spacing:-.045em;margin:0 0 .7em;}
#smz-longread strong{color:var(--smz-soft);}
#smz-longread ul{padding-left:0;list-style:none;margin:0 0 1em;}
#smz-longread ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--smz-muted);font-size:14.5px;line-height:1.65;}
#smz-longread ul li::before{content:'›';position:absolute;left:0;color:var(--smz-accent);font-weight:700;}
#smz-longread .smz-cnt{width:min(var(--smz-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
#smz-longread .smz-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
#smz-longread .smz-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
#smz-longread .smz-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
#smz-longread .smz-sh.smz-left{margin-left:0;text-align:left;}
#smz-longread .smz-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
#smz-longread .smz-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
#smz-longread .smz-sh.smz-left p{margin-left:0;}
#smz-longread .smz-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(245,197,24,.08);border:1px solid rgba(245,197,24,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--smz-accent);margin-bottom:14px;}
#smz-longread .smz-gt{background:linear-gradient(92deg,#fff 0%,var(--smz-accent) 44%,var(--smz-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
#smz-longread .smz-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
#smz-longread .smz-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
#smz-longread .smz-intro-text{position:relative;padding-left:20px;}
#smz-longread .smz-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--smz-accent),var(--smz-violet));}
#smz-longread .smz-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
#smz-longread .smz-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px);}
#smz-longread .smz-kpi-card .smz-kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--smz-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
#smz-longread .smz-kpi-card .smz-kl{font-size:11px;font-weight:600;color:var(--smz-muted);line-height:1.4;}
#smz-longread .smz-kpi-card .smz-ks{font-size:10px;color:#64748b;margin-top:4px;}
#smz-longread .smz-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--smz-border);border-radius:var(--smz-r-lg);padding:26px;backdrop-filter:blur(16px);transition:border-color .22s,transform .22s;}
#smz-longread .smz-card:hover{border-color:rgba(245,197,24,.28);transform:translateY(-2px);}
#smz-longread .smz-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
#smz-longread .smz-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
#smz-longread .smz-pain-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--smz-r);padding:26px;}
#smz-longread .smz-pain-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--smz-red);margin-bottom:10px;}
#smz-longread .smz-quote{border-left:3px solid var(--smz-accent);padding:16px 20px;margin:24px 0;background:rgba(245,197,24,.06);border-radius:0 12px 12px 0;font-style:italic;color:var(--smz-soft);}
#smz-longread .smz-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
#smz-longread .smz-table{width:100%;border-collapse:collapse;font-size:14px;}
#smz-longread .smz-table th{padding:13px 16px;text-align:left;background:rgba(245,197,24,.1);color:var(--smz-accent);font-weight:700;border-bottom:1px solid rgba(245,197,24,.25);white-space:nowrap;}
#smz-longread .smz-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--smz-text);vertical-align:top;}
#smz-longread .smz-table tr:last-child td{border-bottom:none;}
#smz-longread .smz-timeline{position:relative;padding-left:40px;}
#smz-longread .smz-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--smz-accent),var(--smz-violet));opacity:.35;border-radius:2px;}
#smz-longread .smz-tl-item{position:relative;margin-bottom:32px;}
#smz-longread .smz-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--smz-accent);box-shadow:0 0 0 4px rgba(245,197,24,.2);}
#smz-longread .smz-agent-row{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin:28px 0;}
#smz-longread .smz-agent{background:rgba(139,92,246,.08);border:1px solid rgba(139,92,246,.25);border-radius:16px;padding:20px;text-align:center;}
#smz-longread .smz-agent-num{font-size:28px;font-weight:900;color:var(--smz-violet);margin-bottom:8px;}
#smz-longread .smz-int-grid{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;margin:24px 0;}
#smz-longread .smz-int-pill{padding:10px 18px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:13px;font-weight:600;color:var(--smz-cyan);}
#smz-longread .smz-checklist{list-style:none;padding:0;margin:16px 0;}
#smz-longread .smz-checklist li{padding:8px 0 8px 28px;position:relative;color:var(--smz-muted);font-size:14.5px;}
#smz-longread .smz-checklist li::before{content:'☐';position:absolute;left:0;color:var(--smz-accent);}
#smz-longread .smz-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
#smz-longread .smz-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
#smz-longread .smz-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--smz-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
#smz-longread .smz-faq-q::after{content:'▾';font-size:13px;color:var(--smz-accent);flex-shrink:0;transition:transform .25s;}
#smz-longread .smz-faq-item.open .smz-faq-q::after{transform:rotate(180deg);}
#smz-longread .smz-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--smz-muted);line-height:1.72;}
#smz-longread .smz-faq-item.open .smz-faq-a{max-height:800px;padding:0 24px 20px;}
#smz-longread .smz-day-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px;margin:24px 0;}
#smz-longread .smz-day-before{border-color:rgba(239,68,68,.3)!important;}
#smz-longread .smz-day-after{border-color:rgba(34,197,94,.3)!important;}
#smz-longread .smz-day-label{font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.1em;margin-bottom:10px;}
#smz-longread .smz-day-before .smz-day-label{color:var(--smz-red);}
#smz-longread .smz-day-after .smz-day-label{color:var(--smz-green);}
#smz-longread .smz-zakaz-list{counter-reset:smz-z;list-style:none;padding:0;margin:0;}
#smz-longread .smz-zakaz-list li{counter-increment:smz-z;padding:12px 0 12px 36px;position:relative;border-bottom:1px solid rgba(255,255,255,.06);color:var(--smz-muted);}
#smz-longread .smz-zakaz-list li::before{content:counter(smz-z);position:absolute;left:0;width:26px;height:26px;border-radius:50%;background:rgba(245,197,24,.15);color:var(--smz-accent);font-size:12px;font-weight:800;display:flex;align-items:center;justify-content:center;}
#smz-longread .ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(245,197,24,.12),rgba(139,92,246,.1));border:1px solid rgba(245,197,24,.3);text-align:center;}
#smz-longread .ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
#smz-longread .ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(245,197,24,.1));border-color:rgba(34,197,94,.3);}
#smz-longread .ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
#smz-longread .ym-cta-block__sub{color:var(--smz-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
#smz-longread .ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
#smz-longread .nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
#smz-longread .nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
@media(max-width:900px){#smz-longread .smz-intro-grid{grid-template-columns:1fr;gap:36px;}#smz-longread .smz-intro-kpi{grid-template-columns:repeat(2,1fr);}}
@media(max-width:768px){#smz-longread .smz-grid-2,#smz-longread .smz-grid-3,#smz-longread .smz-agent-row,#smz-longread .smz-day-grid{grid-template-columns:1fr;}}
@media(max-width:600px){#smz-longread .ym-cta-block{padding:28px 20px;}}
</style>

<div class="smz-content" id="smz-longread">

  <!-- ═══ INTRO ═══ -->
  <section class="smz-intro smz-section" id="intro" aria-label="Введение">
    <div class="smz-cnt">
      <div class="smz-intro-grid nero-ai-reveal">
        <div class="smz-intro-text">
          <p class="smz-eyebrow">Лонгрид · ai производство контроль</p>
          <p><strong>Коротко:</strong> AI-агент для производства — интеллектуальный слой поверх Excel, бумажных нарядов, 1С и Telegram-чатов цеха. Он выдаёт сменные задания, фиксирует простои в момент события и формирует отчёт руководителю — без полной замены MES и без «узнаём о простое на следующий день».</p>
          <p>На малом производстве — мебельном, пищевом, сборочном цехе на 5–20 человек в смене — <strong>ai производство контроль</strong> начинается с трёх разрозненных процессов: план смены, фиксация остановок и передача контекста следующей смене.</p>
        </div>
        <div class="smz-intro-kpi" aria-label="Ключевые метрики цеха">
          <div class="smz-kpi-card"><div class="smz-kv">65–75%</div><div class="smz-kl">средний OEE в РФ</div><div class="smz-ks">inner.su</div></div>
          <div class="smz-kpi-card"><div class="smz-kv">8–15%</div><div class="smz-kl">внеплановые простои</div><div class="smz-ks">рабочего времени</div></div>
          <div class="smz-kpi-card"><div class="smz-kv">60–90 мин</div><div class="smz-kl">сборка сменной сводки</div><div class="smz-ks">до цифры</div></div>
          <div class="smz-kpi-card"><div class="smz-kv">500 тыс.–2 млн ₽</div><div class="smz-kl">ориентир внедрения</div><div class="smz-ks">MVP под ключ</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="smz-toc-outer">
    <div class="smz-cnt">
      <nav class="smz-toc" aria-label="Оглавление статьи">
        <a href="#problema">Проблема</a>
        <a href="#reshenie">Решение</a>
        <a href="#etapy">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#kpi">KPI</a>
        <a href="#ceny">Цена</a>
        <a href="#keisy">Кейсы</a>
        <a href="#zakazat">Под ключ</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <!-- ═══ PROBLEMA ═══ -->
  <section class="smz-section" id="problema">
    <div class="smz-cnt">
      <div class="smz-sh">
        <span class="smz-eyebrow">Боль цеха</span>
        <h2>Почему на производстве задачи меняются вручную, а <span class="smz-gt">простои видны слишком поздно</span></h2>
        <p><strong>Контроль простоев на производстве</strong> — фиксация причины и длительности <em>в момент события</em>. Пока оператор не отметил код, простой для руководства не существует.</p>
      </div>

      <div class="smz-grid-3 nero-ai-reveal">
        <div class="smz-pain-card">
          <div class="smz-pain-tag">Мебель</div>
          <h3>Срочный заказ ломает очередь</h3>
          <p>Утром план из 1С: 12 комплектов. В 10:30 клиент меняет декор — мастер бежит по участкам, ЧПУ простаивает 25 минут. В Excel вечером — «переналадка 20 мин» без связи с потерянным выпуском.</p>
        </div>
        <div class="smz-pain-card nero-ai-delay-1">
          <div class="smz-pain-tag">Пищевка</div>
          <h3>Контекст теряется между сменами</h3>
          <p>Смена A передала устно про сбой дозатора — в системе только «технический простой». Партия без трассировки; руководитель узнаёт о риске на планёрке следующего дня.</p>
        </div>
        <div class="smz-pain-card nero-ai-delay-2">
          <div class="smz-pain-tag">Сборка</div>
          <h3>Мастер один на весь цех</h3>
          <p>Станок №3 встал — оператор ждёт мастера. Простой 47 минут попадёт в отчёт как «15 минут», потому что мастер вспомнил позже.</p>
        </div>
      </div>

      <blockquote class="smz-quote nero-ai-reveal">
        «Literally, minutes matter» — Bill Good, VP Manufacturing, GE Appliances. Остановка сборочной линии — $300–500 в минуту (NPR, 2026). Для российского цеха масштаб другой, принцип универсален: <strong>поздняя фиксация простоя = позднее решение</strong>.
      </blockquote>

      <div class="smz-card nero-ai-reveal">
        <h3>Скрытые потери: Excel, бумажные наряды и «узнаём на следующий день»</h3>
        <ul>
          <li><strong>План есть, факта нет.</strong> 1С планирует заказы, оператор не отмечает выполнение в реальном времени.</li>
          <li><strong>Простои без кодов.</strong> «Стояли» — не причина. Без справочника lean loss codes невозможен Pareto.</li>
          <li><strong>Сводка 60–90 минут.</strong> Кейс MES (BPA Develop): после цифровизации — 15 минут. На малом производстве сводку часто не делают.</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- ═══ RESHENIE (+ canvas Бориса) ═══ -->
  <section class="smz-section smz-section-alt" id="reshenie">
    <div class="smz-cnt">
      <div class="smz-sh">
        <span class="smz-eyebrow">Продукт</span>
        <h2>Что такое <span class="smz-gt">AI-агент для сменных заданий</span> и контроля простоев</h2>
        <p>Не робот на линии и не замена MES — <strong>оркестратор из трёх узких агентов</strong> против «agent washing» (Gartner, 2025).</p>
      </div>

      <!-- ═══ БОРИС: визуальный блок «5 шагов смены» ═══ -->
      <section id="smz-boris-shift-cycle" class="smz-boris-root" aria-label="Анимация: пять шагов цикла смены — от плана до SBAR-отчёта">
        <style>
        #smz-boris-shift-cycle.smz-boris-root{margin:0 0 40px;}
        #smz-boris-shift-cycle .smz-boris-card{
          display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);
          border-radius:22px;overflow:hidden;
          background:linear-gradient(135deg,rgba(255,255,255,.09),rgba(255,255,255,.04));
          border:1px solid rgba(255,255,255,.12);
          box-shadow:0 24px 64px rgba(0,0,0,.35);
          min-height:480px;
        }
        @media(max-width:1023px){
          #smz-boris-shift-cycle .smz-boris-card{grid-template-columns:1fr;min-height:auto;}
        }
        #smz-boris-shift-cycle .smz-boris-lft{
          padding:36px 32px;display:flex;flex-direction:column;justify-content:center;
          border-right:1px solid rgba(255,255,255,.08);
        }
        @media(max-width:1023px){
          #smz-boris-shift-cycle .smz-boris-lft{border-right:none;border-bottom:1px solid rgba(255,255,255,.08);padding:28px 22px;}
        }
        #smz-boris-shift-cycle .smz-boris-ey{
          font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
          color:var(--smz-cyan);margin:0 0 12px;display:flex;align-items:center;gap:8px;
        }
        #smz-boris-shift-cycle .smz-boris-ey::before{content:'';width:18px;height:2px;background:var(--smz-cyan);border-radius:1px;}
        #smz-boris-shift-cycle .smz-boris-h3{font-size:clamp(19px,2.2vw,24px);font-weight:800;color:#fff;line-height:1.3;margin:0 0 16px;}
        #smz-boris-shift-cycle .smz-boris-steps{list-style:none;margin:0 0 18px;padding:0;display:flex;flex-direction:column;gap:8px;}
        #smz-boris-shift-cycle .smz-boris-steps li{
          display:flex;align-items:flex-start;gap:10px;font-size:13.5px;line-height:1.5;color:var(--smz-muted);
        }
        #smz-boris-shift-cycle .smz-boris-step-n{
          flex-shrink:0;width:22px;height:22px;border-radius:50%;
          background:rgba(121,242,255,.12);border:1.5px solid rgba(121,242,255,.35);
          font-size:10px;font-weight:800;color:var(--smz-cyan);
          display:flex;align-items:center;justify-content:center;margin-top:1px;
        }
        #smz-boris-shift-cycle .smz-boris-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:14px;}
        #smz-boris-shift-cycle .smz-boris-pl{
          padding:5px 12px;border-radius:99px;font-size:11px;font-weight:700;white-space:nowrap;
        }
        #smz-boris-shift-cycle .smz-pl-g{background:rgba(34,197,94,.1);color:var(--smz-green);border:1px solid rgba(34,197,94,.28);}
        #smz-boris-shift-cycle .smz-pl-y{background:rgba(245,197,24,.1);color:var(--smz-accent);border:1px solid rgba(245,197,24,.28);}
        #smz-boris-shift-cycle .smz-pl-c{background:rgba(121,242,255,.1);color:var(--smz-cyan);border:1px solid rgba(121,242,255,.28);}
        #smz-boris-shift-cycle .smz-boris-foot{font-size:12.5px;color:#64748b;font-style:italic;margin:0;}
        #smz-boris-shift-cycle .smz-boris-rgt{
          position:relative;min-height:420px;
          background:linear-gradient(160deg,#0a0e1c 0%,#0f172a 40%,#111827 100%);
          overflow:hidden;
        }
        @media(max-width:1023px){#smz-boris-shift-cycle .smz-boris-rgt{min-height:360px;}}
        #smz-steps-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
        </style>

        <div class="smz-boris-card nero-ai-reveal">
          <div class="smz-boris-lft">
            <span class="smz-boris-ey">Цикл смены · 5 шагов</span>
            <h3 class="smz-boris-h3">От плана 1С до SBAR-отчёта директору — без Excel на следующее утро</h3>
            <ol class="smz-boris-steps">
              <li><span class="smz-boris-step-n">1</span><span><strong>План</strong> — AI читает заказы из 1С/Excel, формирует очередь по рабочим центрам</span></li>
              <li><span class="smz-boris-step-n">2</span><span><strong>Выдача</strong> — оператор видит задания в Telegram: «Выполнил» / «Простой»</span></li>
              <li><span class="smz-boris-step-n">3</span><span><strong>Событие</strong> — «СТОП» + причина из справочника; эскалация при &gt;15 мин</span></li>
              <li><span class="smz-boris-step-n">4</span><span><strong>Пересборка</strong> — мастер меняет приоритет → AI уведомляет затронутых</span></li>
              <li><span class="smz-boris-step-n">5</span><span><strong>Handoff</strong> — SBAR-сводка руководителю за 5–10 мин до конца смены</span></li>
            </ol>
            <div class="smz-boris-pills">
              <span class="smz-boris-pl smz-pl-g">Plan vs Fact 94%</span>
              <span class="smz-boris-pl smz-pl-y">12/12 простоев с кодом</span>
              <span class="smz-boris-pl smz-pl-c">Telegram · 1С</span>
            </div>
            <p class="smz-boris-foot">Дальше — архитектура слоёв и сравнение с MES →</p>
          </div>
          <div class="smz-boris-rgt">
            <canvas id="smz-steps-canvas" aria-label="Анимация пяти шагов смены: план, Telegram, простой, пересборка, отчёт" role="img"></canvas>
          </div>
        </div>

        <script>
        (function(){
          'use strict';
          var cv = document.getElementById('smz-steps-canvas');
          if (!cv) return;
          var ctx = cv.getContext('2d');
          var W = 0, H = 0, frame = 0;
          var LOOP = 900;

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
            ink:'#e6edf7', muted:'#64748b', panel:'#1a2234', panelBdr:'#334155',
            accent:'#f5c518', cyan:'#79f2ff', green:'#22c55e', red:'#ef4444', violet:'#8b5cf6',
            line:'rgba(121,242,255,.25)', tg:'#229ED9'
          };

          var STEPS = [
            {id:1, label:'1С · План', sub:'Очередь смены', color:C.accent},
            {id:2, label:'Telegram', sub:'Задания', color:C.cyan},
            {id:3, label:'Простой', sub:'P02 · ЧПУ', color:C.red},
            {id:4, label:'Мастер', sub:'Пересборка', color:C.violet},
            {id:5, label:'SBAR', sub:'Директору', color:C.green}
          ];

          function rr(x,y,w,h,r,fill,stroke,lw){
            ctx.beginPath();
            if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
            else ctx.rect(x,y,w,h);
            if(fill){ ctx.fillStyle=fill; ctx.fill(); }
            if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
          }

          function drawNode(cx,cy,r,step,active,pulse){
            var glow = active ? 0.35 + 0.15*Math.sin(pulse*0.08) : 0.08;
            ctx.beginPath();
            ctx.arc(cx,cy,r+8,0,Math.PI*2);
            ctx.fillStyle = step.color.replace(')',','+glow+')').replace('rgb','rgba').replace('#', '');
            if(step.color.indexOf('#')===0){
              ctx.fillStyle = active ? step.color+'33' : 'rgba(255,255,255,.04)';
            }
            ctx.fill();

            rr(cx-r,cy-r,r*2,r*2,r*0.35, active ? 'rgba(255,255,255,.12)' : C.panel, active ? step.color : C.panelBdr, active?2:1);
            ctx.fillStyle = active ? '#fff' : C.muted;
            ctx.font = (active?'bold ':'')+'11px Inter,system-ui,sans-serif';
            ctx.textAlign = 'center';
            ctx.fillText(step.label, cx, cy-2);
            ctx.fillStyle = active ? step.color : C.muted;
            ctx.font = '9px Inter,sans-serif';
            ctx.fillText(step.sub, cx, cy+12);

            ctx.fillStyle = step.color;
            ctx.font = 'bold 10px Inter,sans-serif';
            ctx.fillText(String(step.id), cx, cy-r+14);
          }

          function drawTgBubble(x,y,w,h,alpha,text){
            ctx.globalAlpha = alpha||1;
            rr(x,y,w,h,10,'rgba(34,158,217,.15)',C.tg,1);
            ctx.fillStyle = C.cyan;
            ctx.font = '9px Inter,sans-serif';
            ctx.textAlign = 'left';
            ctx.fillText(text, x+10, y+h/2+3);
            ctx.globalAlpha = 1;
          }

          function drawAndon(x,y,s,pulse){
            var blink = 0.5+0.5*Math.sin(pulse*0.15);
            ctx.globalAlpha = blink;
            rr(x,y,s,s*0.6,6,'rgba(239,68,68,.2)',C.red,2);
            ctx.fillStyle = C.red;
            ctx.font = 'bold 9px Inter,sans-serif';
            ctx.textAlign = 'center';
            ctx.fillText('СТОП', x+s/2, y+s*0.38);
            ctx.globalAlpha = 1;
          }

          function loop(){
            frame++;
            var t = frame % LOOP;
            var phase = Math.floor(t / (LOOP/5));
            ctx.clearRect(0,0,W,H);

            var pad = 24;
            var nodeR = Math.min(28, W*0.04);
            var nodes = STEPS.map(function(s,i){
              var frac = (i+0.5)/5;
              return { step:s, x: pad + (W-pad*2)*frac, y: H*0.42 };
            });

            for(var i=0;i<nodes.length-1;i++){
              var a=nodes[i], b=nodes[i+1];
              var prog = i < phase ? 1 : (i===phase ? ((t%(LOOP/5))/(LOOP/5)) : 0);
              ctx.strokeStyle = C.line;
              ctx.lineWidth = 2;
              ctx.setLineDash([5,5]);
              ctx.beginPath();
              ctx.moveTo(a.x+nodeR, a.y);
              ctx.lineTo(b.x-nodeR, b.y);
              ctx.stroke();
              ctx.setLineDash([]);
              if(prog>0){
                var mx = a.x + (b.x-a.x)*prog;
                ctx.beginPath();
                ctx.arc(mx, a.y, 4, 0, Math.PI*2);
                ctx.fillStyle = C.cyan;
                ctx.fill();
              }
            }

            nodes.forEach(function(n,i){
              drawNode(n.x, n.y, nodeR, n.step, i<=phase, frame);
            });

            if(phase>=1){
              drawTgBubble(W*0.28, H*0.62, Math.min(120,W*0.22), 28, 0.7+0.3*(phase>=1?1:0), '✓ Задание №7');
            }
            if(phase>=2){
              drawAndon(W*0.48, H*0.58, 44, frame);
            }
            if(phase>=4){
              rr(W*0.72, H*0.6, Math.min(130,W*0.24), 52, 8, 'rgba(34,197,94,.1)', C.green, 1.5);
              ctx.fillStyle = C.green;
              ctx.font = 'bold 9px Inter,sans-serif';
              ctx.textAlign = 'left';
              ctx.fillText('SBAR · 19:55', W*0.72+10, H*0.6+18);
              ctx.fillStyle = C.muted;
              ctx.font = '8px Inter,sans-serif';
              ctx.fillText('94% плана · топ-3 простоя', W*0.72+10, H*0.6+34);
            }

            ctx.fillStyle = C.muted;
            ctx.font = '10px Inter,sans-serif';
            ctx.textAlign = 'center';
            ctx.fillText('Шаг '+(phase+1)+' / 5 · '+STEPS[phase].label, W/2, H-14);

            requestAnimationFrame(loop);
          }
          requestAnimationFrame(loop);
        })();
        </script>
      </section>
      <!-- /БОРИС canvas -->

      <!-- INTERNAL-LINKS:INSERT -->
      <div class="smz-agent-row nero-ai-reveal">
        <div class="smz-agent"><div class="smz-agent-num">①</div><h4>Диспетчер заданий</h4><p>Пересборка очереди при срочном заказе</p></div>
        <div class="smz-agent"><div class="smz-agent-num">②</div><h4>Регистратор простоев</h4><p>Код причины, таймер, эскалация</p></div>
        <div class="smz-agent"><div class="smz-agent-num">③</div><h4>Автор отчёта</h4><p>SBAR handoff для руководителя</p></div>
      </div>

      <div class="smz-table-wrap nero-ai-reveal">
        <table class="smz-table">
          <thead><tr><th>Компонент</th><th>Роль</th></tr></thead>
          <tbody>
            <tr><td>1С / Excel</td><td>План, номенклатура, заказы</td></tr>
            <tr><td>Операционная БД смены</td><td>Google Sheets или PostgreSQL</td></tr>
            <tr><td>Telegram</td><td>Интерфейс оператора и мастера</td></tr>
            <tr><td>AI-оркестратор</td><td>LLM + RAG + tool-calling</td></tr>
            <tr><td>Дашборд</td><td>OEE-lite, Pareto простоев</td></tr>
          </tbody>
        </table>
      </div>

      <div class="smz-card nero-ai-reveal" style="margin-top:24px;">
        <h3>Фиксация отклонений без полной замены MES</h3>
        <p>Полноценное MES — <strong>6–12 месяцев</strong> и от нескольких миллионов ₽. <strong>Ai агент для производства</strong> как надстройка — <strong>4–12 недель</strong> и ориентир <strong>500 тыс.–2 млн ₽</strong>. Три узких агента вместо «универсального бота» — принцип ВГК/OES.MAS (30+ агентов) в масштабе малого цеха.</p>
      </div>
    </div>
  </section>

  <!-- ═══ ETAPY ═══ -->
  <section class="smz-section" id="etapy">
    <div class="smz-cnt">
      <div class="smz-sh smz-left">
        <span class="smz-eyebrow">Внедрение</span>
        <h2>Внедрение AI в производство: <span class="smz-gt">этапы от аудита до запуска</span></h2>
        <p>Проект с измеримыми KPI: время фиксации простоя, длительность сменной сводки, доля простоев с кодом.</p>
      </div>

      <div class="smz-card nero-ai-reveal">
        <div class="smz-timeline">
          <div class="smz-tl-item"><div class="smz-tl-dot"></div><h3>Фаза 0 (3–5 дней): аудит «Карта потерь»</h3><p>Обход цеха (gemba), 8 видов muda, baseline OEE. CTA «Найти простои» — лайт-аудит ~90 минут.</p></div>
          <div class="smz-tl-item"><div class="smz-tl-dot"></div><h3>Фаза 1 (2–3 нед.): MVP</h3><p>Telegram-бот, таблица-слой, read/write с 1С. Две кнопки: «Выполнил» / «Простой».</p></div>
          <div class="smz-tl-item"><div class="smz-tl-dot"></div><h3>Фаза 2 (2–4 нед.): AI-агент</h3><p>Пакет заданий, диалог при простое, автосводка SBAR, RAG по регламентам.</p></div>
          <div class="smz-tl-item"><div class="smz-tl-dot"></div><h3>Фаза 3: human-in-the-loop</h3><p>Критичные решения — подтверждение мастером. Дашборд Pareto, пороги эскалации. Gartner: &gt;40% agentic-проектов отменены к 2027 без KPI.</p></div>
        </div>
      </div>

      <div class="smz-day-grid nero-ai-reveal">
        <div class="smz-card smz-day-before">
          <div class="smz-day-label">До</div>
          <p>Бумажный наряд → срочный звонок → мастер бегает → простой не записан → Excel «на глаз» → директор узнаёт утром.</p>
        </div>
        <div class="smz-card smz-day-after">
          <div class="smz-day-label">После</div>
          <p>План из 1С в 7:55 → очередь в Telegram → «Простой P05» в 10:12 → эскалация в 10:27 → SBAR в 19:55: 94% плана, топ-3 простоя.</p>
        </div>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понять agentic AI до пилота в цехе?</p>
          <p class="ym-cta-block__sub">Перед внедрением AI-агента полезно разобраться в human-in-the-loop, промптах и интеграции Telegram + 1С — это ускоряет согласование с мастером и директором. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <!-- ═══ INTEGRACII ═══ -->
  <section class="smz-section smz-section-alt" id="integracii">
    <div class="smz-cnt">
      <div class="smz-sh">
        <span class="smz-eyebrow">Стек</span>
        <h2>Интеграции: CRM, 1С, Telegram и датчики — <span class="smz-gt">минимальный стек</span></h2>
        <p><strong>Интеграция ai производство контроль</strong> без «зоопарка» систем. Датчики — фаза 2+, не блокер MVP.</p>
      </div>

      <div class="smz-int-grid nero-ai-reveal">
        <span class="smz-int-pill">1С:ERP / УНФ</span>
        <span class="smz-int-pill">Telegram</span>
        <span class="smz-int-pill">n8n / Make</span>
        <span class="smz-int-pill">amoCRM / Bitrix24</span>
        <span class="smz-int-pill">YandexGPT / GigaChat</span>
        <span class="smz-int-pill">Metabase / Grafana</span>
      </div>

      <div class="smz-grid-2 nero-ai-reveal">
        <div class="smz-card">
          <h3>Связка со сменой через мессенджер</h3>
          <p>SystemeMES: Andon + Telegram на пищевых производствах. Оператор уже в Telegram — не нужен терминал на каждом станке.</p>
        </div>
        <div class="smz-card">
          <h3>Отчёт в CRM/BI</h3>
          <p><strong>Ai производство контроль в CRM</strong> — трекинг заявки «Найти простои» от лендинга до пилота. 152-ФЗ: on-prem или российское облако по выбору.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══ KPI ═══ -->
  <section class="smz-section" id="kpi">
    <div class="smz-cnt">
      <div class="smz-sh">
        <span class="smz-eyebrow">Метрики</span>
        <h2>KPI цеха: <span class="smz-gt">OEE, время простоя, причины остановок</span></h2>
        <p><strong>OEE = Доступность × Производительность × Качество.</strong> Без учёта простоев в момент события Excel систематически занижает потери.</p>
      </div>

      <div class="smz-table-wrap nero-ai-reveal">
        <table class="smz-table">
          <thead><tr><th>Метрика</th><th>Зачем руководителю</th></tr></thead>
          <tbody>
            <tr><td>Plan vs Fact</td><td>Срыв заказов виден сразу</td></tr>
            <tr><td>Топ-3 причины простоя</td><td>Pareto для lean-улучшений</td></tr>
            <tr><td>% простоев с кодом</td><td>Дисциплина данных</td></tr>
            <tr><td>Время сменной сводки</td><td>Минуты вместо 60–90 (GE/Tulip/BPA)</td></tr>
          </tbody>
        </table>
      </div>

      <div class="smz-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Лид-магнит «Карта потерь производства»</h3>
        <ul class="smz-checklist">
          <li>Карта потока создания ценности</li>
          <li>Точки ожидания &gt;5 мин без записи</li>
          <li>Как передаются сменные задания при срочном изменении</li>
          <li>Справочник причин простоя (есть / нет / «в голове у мастера»)</li>
          <li>Где 1С расходится с фактом цеха</li>
          <li>8 muda — отметить 3 главные потери недели</li>
        </ul>
      </div>

      <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-karta-poter">
        <div class="ym-cta-block__icon" aria-hidden="true">🔍</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Найти простои на вашем производстве — бесплатный аудит</p>
          <p class="ym-cta-block__sub">За 90 минут (удалённо или на площадке) пройдём чек-лист «Карта потерь»: 8 видов muda, точки ожидания без записи, разрыв между 1С и цехом. На выходе — топ-3 скрытых простоя и ориентир по срокам MVP без обязательств.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>

      <div class="smz-table-wrap nero-ai-reveal">
        <table class="smz-table">
          <caption style="caption-side:top;text-align:left;padding:12px 0;color:var(--smz-accent);font-weight:700;">Справочник кодов простоя P01–P12</caption>
          <thead><tr><th>Код</th><th>Причина</th><th>Мебель</th><th>Пищевка</th></tr></thead>
          <tbody>
            <tr><td>P01</td><td>Нет материала</td><td>Нет ЛДСП декора</td><td>Нет упаковки</td></tr>
            <tr><td>P02</td><td>Поломка</td><td>ЧПУ</td><td>Дозатор</td></tr>
            <tr><td>P03</td><td>Переналадка</td><td>Смена программы</td><td>Смена SKU</td></tr>
            <tr><td>P05</td><td>Ожидание мастера</td><td>Согласование брака</td><td>Проверка веса</td></tr>
            <tr><td>P09</td><td>Плановый простой</td><td>ТО станка</td><td>CIP-мойка</td></tr>
            <tr><td>P12</td><td>Прочее</td><td colspan="2">С комментарием оператора</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- ═══ CENY ═══ -->
  <section class="smz-section smz-section-alt" id="ceny">
    <div class="smz-cnt">
      <div class="smz-sh">
        <span class="smz-eyebrow">Коммерция</span>
        <h2>Сколько стоит <span class="smz-gt">внедрение AI для контроля производства</span></h2>
        <p>Ориентир <strong>500 тыс.–2 млн ₽</strong> — ниже полного MES (3–5+ млн ₽, 6–12 мес.).</p>
      </div>

      <div class="smz-table-wrap nero-ai-reveal">
        <table class="smz-table">
          <thead><tr><th>Статья</th><th>Доля</th><th>Комментарий</th></tr></thead>
          <tbody>
            <tr><td>Аудит «Карта потерь»</td><td>Включён</td><td>Вход в проект</td></tr>
            <tr><td>MVP Telegram + 1С + AI</td><td>500–900 тыс. ₽</td><td>1 участок, 1 смена</td></tr>
            <tr><td>Расширение на цех</td><td>+300–600 тыс. ₽</td><td>Доп. линии, RAG</td></tr>
            <tr><td>Датчики / OPC</td><td>+200–800 тыс. ₽</td><td>Опционально</td></tr>
          </tbody>
        </table>
      </div>

      <div class="smz-card nero-ai-reveal" style="margin-top:24px;">
        <h3>ROI через видимость простоев</h3>
        <p>2 часа/смену незамеченного простоя × 3 000 ₽/час × 220 смен ≈ <strong>1,32 млн ₽/год</strong>. Кейс KRONPRINZ: −75% простоев (масштаб крупного завода — применяем логику, не обещаем те же цифры). Окупаемость <strong>6–18 месяцев</strong> при дисциплине фиксации.</p>
      </div>
    </div>
  </section>

  <!-- ═══ KEISY ═══ -->
  <section class="smz-section" id="keisy">
    <div class="smz-cnt">
      <div class="smz-sh">
        <span class="smz-eyebrow">Доказательства</span>
        <h2>Кейсы: <span class="smz-gt">ai производство контроль на малом производстве</span></h2>
        <p>Прямых публичных кейсов «AI-агент сменных заданий для мебельного цеха» не найдено — ниже смежные внедрения с оговоркой масштаба.</p>
      </div>

      <div class="smz-table-wrap nero-ai-reveal">
        <table class="smz-table">
          <thead><tr><th>Показатель</th><th>До</th><th>После (ориентиры)</th></tr></thead>
          <tbody>
            <tr><td>Фиксация простоев</td><td>&lt;10% (ВГК/MAS)</td><td>Стремление к 100% на пилоте</td></tr>
            <tr><td>Сменная сводка</td><td>60–90 мин (BPA)</td><td>15 мин / минуты (GE)</td></tr>
            <tr><td>Реакция на отклонение</td><td>Часы</td><td>~1 мин (Апатит/ФосАгро)</td></tr>
          </tbody>
        </table>
      </div>

      <div class="smz-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="smz-table">
          <thead><tr><th>Критерий</th><th>Excel</th><th>MES / Andon</th><th>AI-агент Nero</th></tr></thead>
          <tbody>
            <tr><td>Срок</td><td>0</td><td>6–12 мес.</td><td>4–8 нед. MVP</td></tr>
            <tr><td>Бюджет</td><td>«Бесплатно»</td><td>3–10+ млн ₽</td><td>500 тыс.–2 млн ₽</td></tr>
            <tr><td>AI-сводка</td><td>Нет</td><td>Редко</td><td>Да (LLM + RAG)</td></tr>
            <tr><td>Telegram</td><td>Нет</td><td>Иногда</td><td>Ядро MVP</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- ═══ ZAKAZAT ═══ -->
  <section class="smz-section smz-section-alt" id="zakazat">
    <div class="smz-cnt">
      <div class="smz-sh">
        <span class="smz-eyebrow">Под ключ</span>
        <h2>Заказать внедрение <span class="smz-gt">ai производство контроль под ключ</span></h2>
        <p>Аудит → MVP → метрики → масштабирование. <strong>Ai производство контроль без программиста</strong> на заводе.</p>
      </div>

      <div class="smz-card nero-ai-reveal">
        <h3>Что входит в услугу Nero Network</h3>
        <ol class="smz-zakaz-list">
          <li>Аудит «Карта потерь» — gemba, baseline, точки интеграции</li>
          <li>Проектирование — три агента, справочник простоев, RAG</li>
          <li>Разработка — Telegram, слой данных, 1С/CRM</li>
          <li>AI-оркестратор — классификация, сменный отчёт SBAR</li>
          <li>Дашборд — OEE-lite, Pareto, plan vs fact</li>
          <li>Обучение смены — 1–2 сессии</li>
          <li>Сопровождение — пороги, доработка после первых смен</li>
        </ol>
      </div>

      <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-zakazat">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы заказать ai производство контроль под ключ?</p>
          <p class="ym-cta-block__sub">Пилот с одной линии или ночной смены — 4–8 недель. Ориентир 500 тыс.–2 млн ₽. Начните с аудита «Найти простои» или посмотрите ориентиры в блоке цены.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#ceny" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Сколько стоит</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══ FAQ ═══ -->
  <section class="smz-section" id="faq">
    <div class="smz-cnt">
      <div class="smz-sh">
        <span class="smz-eyebrow">FAQ</span>
        <h2>Внедрение AI на производстве <span class="smz-gt">без программистов и остановки цеха</span></h2>
      </div>

      <div class="smz-faq nero-ai-reveal" id="smz-faq-accordion">
        <div class="smz-faq-item"><div class="smz-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить ai производство контроль без остановки цеха?</div><div class="smz-faq-a">Пилот на одном участке в параллель с текущими нарядами. Первая неделя — «двойная запись»: бумага + Telegram. Остановка линии не требуется.</div></div>
        <div class="smz-faq-item"><div class="smz-faq-q" role="button" tabindex="0" aria-expanded="false">Нужен ли свой IT-отдел?</div><div class="smz-faq-a">Нет для эксплуатации. Нужен мастер/технолог и доступ к 1С. Интеграцию делает Nero.</div></div>
        <div class="smz-faq-item"><div class="smz-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли начать с одной линии?</div><div class="smz-faq-a">Да — рекомендуемый сценарий: 5–15 операторов, 1 мастер, одна смена.</div></div>
        <div class="smz-faq-item"><div class="smz-faq-q" role="button" tabindex="0" aria-expanded="false">Нужен ли MES?</div><div class="smz-faq-a">Нет для MVP. Telegram + 1С/Excel достаточно. Если MES есть — агент как надстройка.</div></div>
        <div class="smz-faq-item"><div class="smz-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит ai производство контроль?</div><div class="smz-faq-a">Ориентир 500 тыс.–2 млн ₽. Точная смета — после аудита «Карта потерь».</div></div>
        <div class="smz-faq-item"><div class="smz-faq-q" role="button" tabindex="0" aria-expanded="false">Как не попасть в 40% отменённых agentic AI-проектов (Gartner)?</div><div class="smz-faq-a">Пилот с KPI, human-in-the-loop, узкие сценарии вместо «универсального агента».</div></div>
        <div class="smz-faq-item"><div class="smz-faq-q" role="button" tabindex="0" aria-expanded="false">Если у нас только Excel?</div><div class="smz-faq-a">Типичный старт: Sheets как операционная БД + Telegram + AI-сводка.</div></div>
        <div class="smz-faq-item"><div class="smz-faq-q" role="button" tabindex="0" aria-expanded="false">Операторы не будут пользоваться?</div><div class="smz-faq-a">Две кнопки, привычный Telegram, обучение 30 минут.</div></div>
        <div class="smz-faq-item"><div class="smz-faq-q" role="button" tabindex="0" aria-expanded="false">Данные и 152-ФЗ?</div><div class="smz-faq-a">Российское облако или on-prem. RAG локально. Персональные данные — политика заказчика.</div></div>
        <div class="smz-faq-item"><div class="smz-faq-q" role="button" tabindex="0" aria-expanded="false">Заменят ли AI мастера?</div><div class="smz-faq-a">Нет. AI снимает отчётность; мастер утверждает критичные решения.</div></div>
        <div class="smz-faq-item"><div class="smz-faq-q" role="button" tabindex="0" aria-expanded="false">Нужны ли датчики на каждый станок?</div><div class="smz-faq-a">Нет для старта. Ручной ввод + QR; датчики — когда ROI пилота подтверждён.</div></div>
        <div class="smz-faq-item"><div class="smz-faq-q" role="button" tabindex="0" aria-expanded="false">Ai производство контроль без программиста — правда?</div><div class="smz-faq-a">На стороне завода программист не нужен. Админка порогов — у мастера.</div></div>
      </div>
    </div>
  </section>

</div><!-- /#smz-longread -->

<script>
(function(){
  'use strict';
  document.querySelectorAll('#smz-faq-accordion .smz-faq-q').forEach(function(q){
    function toggle(){
      var item = q.parentElement;
      var open = item.classList.contains('open');
      document.querySelectorAll('#smz-faq-accordion .smz-faq-item').forEach(function(i){ i.classList.remove('open'); i.querySelector('.smz-faq-q').setAttribute('aria-expanded','false'); });
      if(!open){ item.classList.add('open'); q.setAttribute('aria-expanded','true'); }
    }
    q.addEventListener('click', toggle);
    q.addEventListener('keydown', function(e){ if(e.key==='Enter'||e.key===' '){ e.preventDefault(); toggle(); }});
  });
})();
</script>
<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
/**
 * smz-hero-engine — «Диспетчерская смены Shift Control»
 * Мир: TaskFlowRail → AndonShiftBoard → DowntimeBeacon → SBAR Telegram handoff
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("smz-hero-canvas");
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
    outline: "#64748b",
    rail: "#334155",
    railGlow: "rgba(121,242,255,0.25)",
    boardBg: "#0f172a",
    boardScreen: "#1e293b",
    accent: "#f5c518",
    cyan: "#79f2ff",
    green: "#22c55e",
    red: "#ef4444",
    violet: "#8b5cf6",
    cardTask: "#dbeafe",
    cardUrgent: "#fef3c7",
    cardDone: "#d1fae5",
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

  function drawTaskCard(ctx, x, y, w, h, color, label) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 3, color, C.outline);
    ctx.fillStyle = "#0f172a";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    if (label) ctx.fillText(label, x, y + 2);
  }

  /* Горизонтальный рельс сменных карточек — вместо Conveyor */
  function TaskFlowRail() {
    this.cards = [
      { offset: 0, color: C.cardTask, label: "№12" },
      { offset: 70, color: C.cardUrgent, label: "СР" },
      { offset: 140, color: C.cardTask, label: "№14" }
    ];
  }
  TaskFlowRail.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    var yRail = -72;
    drawRR(ctx, -175, yRail - 6, 350, 12, 4, C.rail, C.outline);
    ctx.strokeStyle = C.railGlow;
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.moveTo(-170, yRail);
    ctx.lineTo(170, yRail);
    ctx.stroke();

    var stations = [-120, -40, 40, 120];
    stations.forEach(function (sx) {
      drawRR(ctx, sx - 8, yRail + 8, 16, 22, 3, "rgba(30,41,59,0.7)", C.outline);
      ctx.fillStyle = C.cyan;
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("РЦ", sx, yRail + 20);
    });

    if (prg < 200) {
      this.cards.forEach(function (card) {
        var t = ((frame * 0.5 + card.offset) % 200) / 200;
        var dx = -160 + t * 320;
        if (t < 0.95) drawTaskCard(ctx, dx, yRail - 18, 18, 14, card.color, card.label);
      });
    }
  };

  /* Центральная Andon-панель — вместо WebsiteTerminal */
  function AndonShiftBoard() {
    this.queueFlash = 0;
    this.downtimeActive = false;
  }
  AndonShiftBoard.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, -55, -38, 110, 78, 6, C.boardBg, C.outline);
    drawRR(ctx, -48, -32, 96, 52, 4, C.boardScreen, C.outline);

    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("СМЕНА A", 0, -24);

    var rows = ["Корпус ×4", "Фасад ×2", "Кромка ×6"];
    rows.forEach(function (r, i) {
      var done = prg > 180 && i < 2;
      var paused = prg >= 55 && prg < 130 && i === 1;
      ctx.fillStyle = done ? C.green : paused ? C.red : "#94a3b8";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText((done ? "✓ " : paused ? "■ " : "○ ") + r, -42, -10 + i * 14);
    });

    if (prg >= 55 && prg < 130) {
      this.downtimeActive = true;
      ctx.fillStyle = C.red;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("ПРОСТОЙ P02", 0, 28);
    } else if (prg >= 130 && prg < 200) {
      ctx.fillStyle = C.violet;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("AI пересборка", 0, 28);
    } else if (prg >= 200) {
      ctx.fillStyle = C.cyan;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("SBAR готов", 0, 28);
    }
  };

  /* Мигающая колонна простоя */
  function DowntimeBeacon() {
    this.pulse = 0;
  }
  DowntimeBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 55 || prg >= 130) return;
    this.pulse = Math.sin(frame * 0.25) * 0.5 + 0.5;
    var alpha = 0.4 + this.pulse * 0.6;
    ctx.save();
    ctx.globalAlpha = alpha;
    drawRR(ctx, 128, -20, 14, 50, 3, C.red, C.outline);
    ctx.fillStyle = frame % 8 < 4 ? "#fca5a5" : C.red;
    ctx.beginPath();
    ctx.arc(135, -28, 8, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.2;
    ctx.stroke();
    ctx.restore();

    var mins = Math.floor((prg - 55) * 0.8);
    ctx.fillStyle = C.accent;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(mins + " мин", 135, 42);
  };

  /* Дуга OEE */
  function OeeArcGauge() {
    this.value = 0.78;
  }
  OeeArcGauge.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    var v = prg >= 200 ? 0.78 : prg >= 130 ? 0.65 + (prg - 130) * 0.002 : 0.72;
    ctx.strokeStyle = "rgba(255,255,255,0.12)";
    ctx.lineWidth = 6;
    ctx.beginPath();
    ctx.arc(-145, 42, 22, Math.PI, Math.PI * 2);
    ctx.stroke();
    ctx.strokeStyle = C.green;
    ctx.beginPath();
    ctx.arc(-145, 42, 22, Math.PI, Math.PI + Math.PI * v);
    ctx.stroke();
    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(Math.round(v * 100) + "%", -145, 46);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 5px Inter,sans-serif";
    ctx.fillText("OEE", -145, 56);
  };

  /* Telegram handoff в финале */
  function TelegramHandoff() {
    this.yOff = 0;
  }
  TelegramHandoff.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 200) return;
    var rise = Math.min(1, (prg - 200) / 35);
    this.yOff = -rise * 30;
    var tx = 0, ty = 58 + this.yOff;
    drawRR(ctx, tx - 22, ty - 14, 44, 28, 8, "rgba(121,242,255,0.15)", C.cyan);
    ctx.fillStyle = C.cyan;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("TG", tx, ty + 2);
    if (rise > 0.5) {
      drawRR(ctx, tx - 38, ty - 38, 76, 18, 4, "rgba(15,23,42,0.9)", C.outline);
      ctx.fillStyle = "#e2e8f0";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("SBAR → директору", tx, ty - 27);
    }
  };

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
    this.hitAnimation = 0;
  }
  Agent.prototype.draw = function (ctx) {
    this.timer += 0.035;
    var isMoving = false;
    var carryType = null;
    var faceDir = 1;
    var prg = (frame * 0.042) % 260;

    var targetX = 0, targetY = -50;
    if (this.role === "3_coder" && prg >= 55 && prg < 95) {
      targetX = 120; targetY = 10;
    } else if (this.role === "1_architect" && prg >= 130 && prg < 165) {
      targetX = -30; targetY = -55;
    } else if (this.role === "5_deployer" && prg >= 200 && prg < 235) {
      targetX = 0; targetY = 45;
    } else if (this.role === "2_seo" && prg >= 15 && prg < 45) {
      targetX = -100; targetY = -55;
    } else if (this.role === "4_designer" && prg >= 165 && prg < 200) {
      targetX = 20; targetY = -20;
    }

    var active = (this.role === "3_coder" && prg >= 55 && prg < 95) ||
      (this.role === "1_architect" && prg >= 130 && prg < 165) ||
      (this.role === "5_deployer" && prg >= 200 && prg < 235) ||
      (this.role === "2_seo" && prg >= 15 && prg < 45) ||
      (this.role === "4_designer" && prg >= 165 && prg < 200);

    if (active) {
      var local = prg - this.stepTrig;
      if (local < 0) local += 260;
      var t = Math.min(1, (local % 30) / 15);
      if (t < 0.5) {
        isMoving = true;
        this.x = this.baseX + (targetX - this.baseX) * (t * 2);
        this.y = this.baseY + (targetY - this.baseY) * (t * 2);
        carryType = this.role === "2_seo" ? C.cardTask : null;
      } else {
        isMoving = true; faceDir = -1;
        var t2 = (t - 0.5) * 2;
        this.x = targetX - (targetX - this.baseX) * t2;
        this.y = targetY - (targetY - this.baseY) * t2;
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
    }

    if (!isMoving && frame % 180 === 0 && Math.random() < 0.12) {
      var rnd = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
      createBubble(this.x, this.y - 18, rnd, 220);
    }

    var bob = isMoving ? Math.abs(Math.sin(this.timer * 5)) * 2 : Math.sin(this.timer * 1.4) * 1;
    ctx.save();
    ctx.translate(this.x, this.y);
    ctx.lineJoin = "round";
    var legL = isMoving ? Math.sin(this.timer * 6) * 4 : 0;
    var legR = isMoving ? Math.sin(this.timer * 6 + Math.PI) * 4 : 0;
    drawRR(ctx, -10, -5 + Math.max(0, legL), 8, 12, 2, C.outline, null);
    drawRR(ctx, 2, -5 + Math.max(0, legR), 8, 12, 2, C.outline, null);
    drawRR(ctx, -14, -12 - bob, 28, 18, 5, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath(); ctx.arc(0, -26 - bob, 10, 0, Math.PI * 2); ctx.fill();
    ctx.lineWidth = 1.5; ctx.strokeStyle = C.outline; ctx.stroke();
    ctx.save();
    ctx.scale(faceDir, 1);
    ctx.fillStyle = "#fff";
    ctx.beginPath(); ctx.arc(3, -28 - bob, 3, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(-3, -28 - bob, 3, 0, Math.PI * 2); ctx.fill();
    ctx.fillStyle = C.outline;
    ctx.beginPath(); ctx.arc(4, -28 - bob, 1.5, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(-2, -28 - bob, 1.5, 0, Math.PI * 2); ctx.fill();
    ctx.restore();
    if (carryType) drawRR(ctx, -16 * faceDir, -20 - bob, 12, 12, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  var rail = new TaskFlowRail();
  var board = new AndonShiftBoard();
  var beacon = new DowntimeBeacon();
  var oee = new OeeArcGauge();
  var tg = new TelegramHandoff();

  entities.push(rail);
  entities.push(oee);
  entities.push(board);
  entities.push(beacon);
  entities.push(tg);
  entities.push(new Agent(-155, 55, C.agentYellow, "1_architect", 130, ["Срочный заказ!", "Пересобираю очередь", "Мастер подтвердил"]));
  entities.push(new Agent(-95, 70, C.agentGreen, "2_seo", 15, ["Задание №12", "Выполнил операцию", "Жду следующее"]));
  entities.push(new Agent(-35, 58, C.agentBlue, "3_coder", 55, ["Простой 47 мин!", "Код P02 — ЧПУ", "Не в Excel завтра"]));
  entities.push(new Agent(45, 68, C.agentPink, "4_designer", 165, ["Сводка 4 мин", "Топ-3 простоя", "SBAR для смены B"]));
  entities.push(new Agent(110, 52, C.agentPurple, "5_deployer", 200, ["Отчёт в Telegram", "Plan 94%", "Риск на ночь"]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife, maxLife: customLife });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (ent) { ent.draw(ctx); });

    var prg = (frame * 0.042) % 260;
    if (prg >= 8 && prg < 8.08) createBubble(-155, 30, "1. План смены из 1С");
    if (prg >= 58 && prg < 58.08) createBubble(-35, 20, "2. СТОП · P02 ЧПУ");
    if (prg >= 108 && prg < 108.08) createBubble(0, -55, "3. Эскалация мастеру");
    if (prg >= 138 && prg < 138.08) createBubble(-30, -40, "4. AI пересборка");
    if (prg >= 205 && prg < 205.08) createBubble(0, 35, "5. SBAR → директору");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 25);
      if (bub.life > bub.maxLife - 8) alpha = (bub.maxLife - bub.life) / 8;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 14;
      var th = 18;
      var bx = bub.x, by = bub.y - (bub.maxLife - bub.life) * 0.04;
      drawRR(ctx, bx - tw / 2, by - th, tw, th, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(bub.text, bx, by - th / 2 + 1);
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

<script>
(function(){
  'use strict';
  var root = document.querySelector('.ai-agent-smennye-zadaniya-kontrol-prostoiev-page') || document.querySelector('.nero-ai-home-page');
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

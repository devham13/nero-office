<?php
/**
 * Template Name: AI-агент для сменных заданий и контроля простоев
 * Description: SEO-лендинг — AI-агент для сменных заданий и контроля простоев на малом производстве.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-агент для сменных заданий и контроля простоев под ключ';
$page_seo_description = 'Внедрение AI-агента для сменных заданий и контроля простоев на малом производстве. Сбор данных по смене, раннее выявление остановок, отчёт руководителю. Карта потерь — бесплатно.';

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

$brand               = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: '');
$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Найти простои';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'материалы по автоматизации';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#';

$nero_ai_header_links = [
    ['label' => 'Зачем AI',   'href' => '#kak-rabotaet'],
    ['label' => 'Смены',      'href' => '#smennye-zadaniya'],
    ['label' => 'Простои',    'href' => '#prostoi'],
    ['label' => 'Внедрение',  'href' => '#etapy'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Кейсы',      'href' => '#keisy'],
    ['label' => 'Стоимость',  'href' => '#ceny'],
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

<?php nero_ai_echo_theme_styles(); ?>

<style>
/* Kadence layout reset + landing shell */
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

.smz-prostoi-hero {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}

/* Reveal */
.nero-ai-reveal { opacity: 0; transform: translateY(22px); transition: opacity .55s ease, transform .55s ease; }
.nero-ai-reveal.nero-ai-active { opacity: 1; transform: none; }
.nero-ai-delay-1 { transition-delay: .12s; }
.nero-ai-delay-2 { transition-delay: .24s; }

/* CTA buttons in content (hero has own styles) */
.smz-prostoi-content .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-height: 48px;
  padding: 14px 24px;
  border-radius: 999px;
  border: 1px solid transparent;
  font-size: 15px;
  font-weight: 800;
  line-height: 1;
  text-decoration: none !important;
  transition: transform .22s ease, border-color .22s ease, background .22s ease;
}
.smz-prostoi-content .nero-ai-btn:hover { transform: translateY(-2px); }
.smz-prostoi-content .nero-ai-btn-primary {
  color: #061018 !important;
  background: linear-gradient(135deg, #79f2ff, #38bdf8);
  box-shadow: 0 12px 32px rgba(56, 189, 248, 0.22);
}
.smz-prostoi-content .nero-ai-btn-secondary {
  color: #e6edf7 !important;
  background: rgba(255, 255, 255, 0.08);
  border-color: rgba(255, 255, 255, 0.16);
}
.smz-prostoi-content .ym-link--accent { color: #79f2ff !important; text-decoration: underline !important; }
</style>

<main id="primary" class="site-main nero-ai-home-page ai-agent-smennye-zadaniya-prostoi-page smz-prostoi-page" role="main" tabindex="-1">

<section class="nero-ai-hero smz-prostoi-hero" id="hero" aria-labelledby="smz-prostoi-hero-title">
<style>
/* ── Hero smz-prostoi: самодостаточные стили (без CSS темы) ── */
.smz-prostoi-hero {
  --smz-amber: #f59e0b;
  --smz-green: #22c55e;
  --smz-cyan: #79f2ff;
  --smz-violet: #8b5cf6;
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
  background:
    radial-gradient(ellipse 80% 50% at 72% 18%, rgba(121, 242, 255, 0.14), transparent),
    radial-gradient(ellipse 55% 42% at 8% 82%, rgba(139, 92, 246, 0.11), transparent),
    linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
}
.smz-prostoi-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.028) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.028) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 36% 26%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.smz-prostoi-hero::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 620px;
  height: 620px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(245, 158, 11, .10), transparent 66%);
  filter: blur(8px);
  animation: smzHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes smzHeroGlow {
  from { opacity: .38; transform: scale(.95); }
  to { opacity: .78; transform: scale(1.05); }
}
.smz-prostoi-hero .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.smz-prostoi-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.smz-prostoi-hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 64px);
  line-height: 1.02;
  letter-spacing: -0.05em;
  color: #fff;
  font-weight: 900;
}
.smz-prostoi-hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--smz-cyan) 38%, var(--smz-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.smz-prostoi-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--smz-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.smz-prostoi-hero .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--smz-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.smz-prostoi-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.smz-prostoi-hero .nero-ai-badge {
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
.smz-prostoi-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.smz-prostoi-hero .nero-ai-btn {
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
.smz-prostoi-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.smz-prostoi-hero .nero-ai-btn-primary {
  color: #061018 !important;
  background: linear-gradient(135deg, var(--smz-cyan), #38bdf8);
  box-shadow: 0 18px 42px rgba(56, 189, 248, 0.22);
}
.smz-prostoi-hero .nero-ai-btn-secondary {
  color: var(--smz-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.smz-prostoi-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--smz-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.smz-prostoi-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.smz-prostoi-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.smz-prostoi-hero .nero-ai-dots { display: flex; gap: 7px; }
.smz-prostoi-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.smz-prostoi-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.smz-prostoi-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.smz-prostoi-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.smz-prostoi-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.smz-prostoi-hero .nero-ai-window-body { padding: 16px; }
.smz-prostoi-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.smz-prostoi-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.smz-prostoi-hero .nero-ai-live-pill {
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
.smz-prostoi-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: smzPulse 1.6s infinite;
}
@keyframes smzPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.smz-prostoi-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.smz-prostoi-hero .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.smz-prostoi-hero .nero-ai-metric span {
  display: block;
  color: var(--smz-muted);
  font-size: 11px;
  font-weight: 700;
}
.smz-prostoi-hero .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.smz-prostoi-hero .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.smz-prostoi-hero .nero-ai-metric--warn strong { color: var(--smz-amber); }
.smz-prostoi-hero .nero-ai-metric--ok strong { color: var(--smz-green); }
.smz-prostoi-hero .smz-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(245, 158, 11, 0.18);
  background: radial-gradient(ellipse at 42% 40%, rgba(121,242,255,.06), rgba(6,10,24,.92) 72%);
}
.smz-prostoi-hero #smz-prostoi-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.smz-prostoi-hero .nero-ai-task-stream { display: grid; gap: 8px; }
.smz-prostoi-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.smz-prostoi-hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--smz-cyan);
  font-size: 11px;
  font-weight: 800;
}
.smz-prostoi-hero .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.smz-prostoi-hero .nero-ai-task span {
  color: var(--smz-muted);
  font-size: 11px;
}
.smz-prostoi-hero .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.smz-prostoi-hero .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.smz-prostoi-hero .nero-ai-status--violet {
  background: rgba(139,92,246,.14);
  color: #ddd6fe;
}
@media (max-width: 1100px) {
  .smz-prostoi-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .smz-prostoi-hero .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .smz-prostoi-hero .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .smz-prostoi-hero .nero-ai-window-body { padding: 12px; }
  .smz-prostoi-hero .nero-ai-task { grid-template-columns: 28px 1fr; }
  .smz-prostoi-hero .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai производство</p>
      <h1 id="smz-prostoi-hero-title">AI-агент для сменных заданий и контроля простоев: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI собирает данные по смене, фиксирует отклонения и формирует отчёт руководителю — без ручного переписывания заданий на смене</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Сменные задания</li>
        <li class="nero-ai-badge">Контроль простоев</li>
        <li class="nero-ai-badge">Отчёт руководителю</li>
        <li class="nero-ai-badge">Human-in-the-loop</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Найти простои</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-агента смены и контроля простоев">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Смена · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric nero-ai-metric--warn">
              <span>Простои</span>
              <strong>−18%</strong>
              <small>за 4 нед. пилота</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--ok">
              <span>OEE</span>
              <strong>64%</strong>
              <small>было ~52%</small>
            </div>
            <div class="nero-ai-metric">
              <span>Реакция</span>
              <strong>7 мин</strong>
              <small>было часы</small>
            </div>
            <div class="nero-ai-metric">
              <span>План</span>
              <strong>92%</strong>
              <small>выполнение смены</small>
            </div>
          </div>

          <div class="smz-dash-canvas-wrap" aria-hidden="false">
            <canvas id="smz-prostoi-hero-canvas" role="img" aria-label="Анимация: сменные задания по ленте, фиксация простоя, классификация причины и отчёт руководителю"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий смены">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">01</span>
              <div><strong>Задание · линия 1</strong><span>План из Excel → оператору в Telegram</span></div>
              <span class="nero-ai-status">активно</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">02</span>
              <div><strong>Стоп · линия 2</strong><span>8 мин без факта — эскалация мастеру</span></div>
              <span class="nero-ai-status nero-ai-status--amber">простой</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">03</span>
              <div><strong>Причина · переналадка</strong><span>код из справочника, мастер подтвердил</span></div>
              <span class="nero-ai-status nero-ai-status--amber">классиф.</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">04</span>
              <div><strong>Отчёт руководителю</strong><span>топ-3 потери, OEE, рекомендации на завтра</span></div>
              <span class="nero-ai-status nero-ai-status--violet">отправлен</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- БОРИС: контентная часть лонгрида (НЕ hero). Вставить в <main> после hero Алины. -->
<div class="smz-prostoi-content">

<style>
/* === SMZ-PROSTOI: контент лонгрида (Борис + секции) === */
.smz-prostoi-content{
  --smz-bg:#050711;--smz-bg2:#080b17;
  --smz-surface:rgba(255,255,255,.072);--smz-surface2:rgba(255,255,255,.108);
  --smz-text:#e6edf7;--smz-muted:#9aa8bd;--smz-soft:#c7d2e5;--smz-heading:#fff;
  --smz-border:rgba(255,255,255,.10);
  --smz-cyan:#79f2ff;--smz-violet:#8b5cf6;--smz-green:#22c55e;--smz-amber:#f59e0b;
  --smz-btn-from:#2563eb;--smz-btn-to:#7c3aed;
  --smz-r:18px;--smz-r-lg:24px;--smz-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--smz-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.smz-prostoi-content *,.smz-prostoi-content *::before,.smz-prostoi-content *::after{box-sizing:border-box;}
.smz-prostoi-content a{color:inherit;}
.smz-prostoi-content p{color:var(--smz-muted);line-height:1.72;margin:0 0 1em;font-size:15px;}
.smz-prostoi-content p:last-child{margin-bottom:0;}
.smz-prostoi-content h2,.smz-prostoi-content h3{color:var(--smz-heading);letter-spacing:-.04em;margin:0 0 .65em;}
.smz-prostoi-content h2{font-size:clamp(26px,3.8vw,44px);line-height:1.08;}
.smz-prostoi-content h3{font-size:clamp(18px,2.2vw,22px);line-height:1.25;}
.smz-prostoi-content strong{color:var(--smz-soft);}
.smz-prostoi-content ul,.smz-prostoi-content ol{padding-left:0;list-style:none;margin:0 0 1em;}
.smz-prostoi-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--smz-muted);font-size:14.5px;line-height:1.65;}
.smz-prostoi-content ul li::before{content:'›';position:absolute;left:0;color:var(--smz-amber);font-weight:700;}
.smz-prostoi-content ol{counter-reset:smz-ol;margin:0 0 1.2em;}
.smz-prostoi-content ol li{counter-increment:smz-ol;padding-left:28px;position:relative;margin-bottom:.5em;color:var(--smz-muted);font-size:14.5px;line-height:1.65;}
.smz-prostoi-content ol li::before{content:counter(smz-ol);position:absolute;left:0;top:0;width:20px;height:20px;border-radius:50%;background:rgba(245,158,11,.15);color:var(--smz-amber);font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;}
.smz-prostoi-cnt{width:min(var(--smz-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.smz-prostoi-section{padding:clamp(56px,7vw,96px) 0;position:relative;}
.smz-prostoi-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.smz-prostoi-sh{max-width:820px;margin:0 auto 40px;text-align:center;}
.smz-prostoi-sh p{font-size:clamp(15px,1.5vw,17px);max-width:680px;margin:0 auto;}
.smz-prostoi-sh--left{margin-left:0;text-align:left;}
.smz-prostoi-sh--left p{margin-left:0;}
.smz-prostoi-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(245,158,11,.08);border:1px solid rgba(245,158,11,.22);font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--smz-amber);margin-bottom:14px;}
.smz-prostoi-intro{padding:clamp(36px,5vw,64px) 0;border-bottom:1px solid rgba(255,255,255,.06);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);}
.smz-prostoi-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:48px;align-items:center;}
.smz-prostoi-intro-text{position:relative;padding-left:20px;text-align:left!important;}
.smz-prostoi-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--smz-amber),var(--smz-violet));}
.smz-prostoi-intro-text p{text-align:left!important;}
.smz-prostoi-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.smz-prostoi-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;}
.smz-prostoi-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--smz-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.smz-prostoi-kpi-card .kl{font-size:12px;color:var(--smz-muted);line-height:1.35;}
.smz-prostoi-kpi-card .ks{font-size:10px;color:rgba(154,168,189,.7);margin-top:4px;}
.smz-prostoi-toc-outer{padding:20px 0 8px;}
.smz-prostoi-toc{display:flex;flex-wrap:wrap;gap:8px;justify-content:center;}
.smz-prostoi-toc a{display:inline-flex;padding:8px 16px;border-radius:999px;font-size:13px;font-weight:600;color:var(--smz-muted);background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);text-decoration:none!important;transition:background .2s,border-color .2s,color .2s;}
.smz-prostoi-toc a:hover{color:var(--smz-cyan);border-color:rgba(121,242,255,.35);background:rgba(121,242,255,.08);}
.smz-prostoi-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;}
.smz-prostoi-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--smz-r);padding:24px 22px;}
.smz-prostoi-card h3{font-size:17px;margin-bottom:10px;}
.smz-prostoi-card p{font-size:14px;margin:0;}
.smz-prostoi-steps{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-top:28px;}
.smz-prostoi-step{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);border-radius:16px;padding:22px 18px;text-align:center;}
.smz-prostoi-step-num{display:inline-flex;width:32px;height:32px;border-radius:50%;background:rgba(121,242,255,.12);color:var(--smz-cyan);font-weight:800;font-size:14px;align-items:center;justify-content:center;margin-bottom:10px;}
.smz-prostoi-step h3{font-size:16px;margin-bottom:8px;}
.smz-prostoi-step p{font-size:13.5px;margin:0;}
.smz-prostoi-traffic{display:flex;flex-wrap:wrap;gap:12px;margin:24px 0;}
.smz-prostoi-light{display:flex;align-items:center;gap:10px;padding:12px 18px;border-radius:12px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);font-size:13px;font-weight:600;}
.smz-prostoi-dot{width:12px;height:12px;border-radius:50%;flex-shrink:0;}
.smz-prostoi-dot--g{background:var(--smz-green);box-shadow:0 0 10px rgba(34,197,94,.5);}
.smz-prostoi-dot--a{background:var(--smz-amber);box-shadow:0 0 10px rgba(245,158,11,.5);}
.smz-prostoi-dot--r{background:#ef4444;box-shadow:0 0 10px rgba(239,68,68,.5);}
.smz-prostoi-table-wrap{overflow-x:auto;border-radius:var(--smz-r);border:1px solid rgba(255,255,255,.1);margin:24px 0;}
.smz-prostoi-table{width:100%;border-collapse:collapse;font-size:14px;}
.smz-prostoi-table th{padding:13px 16px;text-align:left;font-weight:700;color:var(--smz-soft);background:rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.1);}
.smz-prostoi-table td{padding:13px 16px;color:var(--smz-muted);border-bottom:1px solid rgba(255,255,255,.05);vertical-align:top;}
.smz-prostoi-table tr:last-child td{border-bottom:none;}
.smz-prostoi-segments{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
.smz-prostoi-segment{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--smz-r);padding:26px 22px;}
.smz-prostoi-segment h3{font-size:18px;margin-bottom:12px;}
.smz-prostoi-callout{border-radius:var(--smz-r);padding:24px 28px;margin:28px 0;background:linear-gradient(135deg,rgba(245,158,11,.1),rgba(139,92,246,.08));border:1px solid rgba(245,158,11,.25);}
.smz-prostoi-callout strong{color:var(--smz-amber);}
.smz-prostoi-case{display:grid;gap:14px;margin-top:20px;}
.smz-prostoi-case-item{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);border-radius:14px;padding:20px 22px;}
.smz-prostoi-case-item h3{font-size:16px;margin-bottom:8px;}
.smz-prostoi-case-tag{display:inline-block;font-size:11px;font-weight:700;padding:3px 10px;border-radius:99px;background:rgba(121,242,255,.1);color:var(--smz-cyan);margin-bottom:8px;}
.smz-prostoi-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.smz-prostoi-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.smz-prostoi-faq-q{padding:18px 22px;font-size:15px;font-weight:700;color:var(--smz-heading);cursor:pointer;display:flex;justify-content:space-between;gap:12px;user-select:none;}
.smz-prostoi-faq-q::after{content:'▾';color:var(--smz-cyan);transition:transform .25s;}
.smz-prostoi-faq-item.open .smz-prostoi-faq-q::after{transform:rotate(180deg);}
.smz-prostoi-faq-a{padding:0 22px;max-height:0;overflow:hidden;transition:max-height .35s ease,padding .25s;font-size:14px;color:var(--smz-muted);}
.smz-prostoi-faq-item.open .smz-prostoi-faq-a{max-height:800px;padding:0 22px 18px;}
.smz-prostoi-cta-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:28px;list-style:none;padding:0;}
.smz-prostoi-cta-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--smz-muted);}
.smz-prostoi-cta-checklist li::before{content:'✓';color:var(--smz-green);font-weight:800;}
.smz-prostoi-content .ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(245,158,11,.08));border:1px solid rgba(121,242,255,.28);text-align:center;}
.smz-prostoi-content .ym-cta-block--secondary{background:linear-gradient(135deg,rgba(139,92,246,.1),rgba(121,242,255,.08));border-color:rgba(139,92,246,.28);}
.smz-prostoi-content .ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.14),rgba(121,242,255,.08));border-color:rgba(139,92,246,.32);}
.smz-prostoi-content .ym-cta-block__headline{font-size:clamp(20px,2.6vw,26px);font-weight:800;color:#fff;margin:0 0 10px;}
.smz-prostoi-content .ym-cta-block__sub{color:var(--smz-muted);font-size:15px;margin:0 auto 20px;max-width:620px;line-height:1.7;}
.smz-prostoi-content .ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
@media(max-width:1023px){
  .smz-prostoi-intro-grid,.smz-prostoi-grid-3,.smz-prostoi-steps,.smz-prostoi-segments{grid-template-columns:1fr;}
  .smz-prostoi-intro-kpi{grid-template-columns:1fr 1fr;}
}
@media(max-width:600px){
  .smz-prostoi-intro-kpi{grid-template-columns:1fr;}
  .smz-prostoi-content .ym-cta-block{padding:28px 20px;}
}
</style>

<!-- INTRO: второй экран после hero -->
<section class="smz-prostoi-intro" id="intro" aria-label="Введение">
  <div class="smz-prostoi-cnt">
    <div class="smz-prostoi-intro-grid nero-ai-reveal">
      <div class="smz-prostoi-intro-text">
        <p class="smz-prostoi-eyebrow">Лонгрид · ai производство контроль</p>
        <p><strong>Коротко:</strong> AI-агент для производства — прикладной слой над учётом смены (1С, Excel, Telegram, MES), который собирает факты смены, сравнивает план с фактом, фиксирует простои и формирует отчёт руководителю. Это не замена MES, а «умный диспетчер смены» для цехов, где задания переписывают вручную, а остановки узнают постфактум.</p>
        <p>На малом производстве — мебельном цехе, пищевой линии, участке из 5–30 человек — <strong>ai производство контроль</strong> начинается с одной боли: <strong>задачи меняются вручную, простои фиксируются поздно</strong>. AI-агент закрывает разрыв без бесконечного переписывания заданий на доске, в WhatsApp и в Excel.</p>
      </div>
      <div class="smz-prostoi-intro-kpi" aria-label="Ключевые метрики производства">
        <div class="smz-prostoi-kpi-card"><div class="kv">30–70%</div><div class="kl">типичный OEE в РФ</div><div class="ks">РБК Компании</div></div>
        <div class="smz-prostoi-kpi-card"><div class="kv">25–30%</div><div class="kl">простои от фонда времени</div><div class="ks">отраслевой обзор</div></div>
        <div class="smz-prostoi-kpi-card"><div class="kv">10–15 с</div><div class="kl">ввод факта оператором</div><div class="ks">пилот Nero</div></div>
        <div class="smz-prostoi-kpi-card"><div class="kv">4–8 нед.</div><div class="kl">срок внедрения под ключ</div><div class="ks">проектная модель</div></div>
      </div>
    </div>
  </div>
</section>

<!-- INTERNAL-LINKS:INSERT -->

<!-- TOC -->
<div class="smz-prostoi-toc-outer">
  <div class="smz-prostoi-cnt">
    <nav class="smz-prostoi-toc ym-toc" aria-label="Оглавление статьи">
      <a href="#kak-rabotaet">Зачем AI</a>
      <a href="#smennye-zadaniya">Смены</a>
      <a href="#prostoi">Простои</a>
      <a href="#dlya-kogo">Для кого</a>
      <a href="#etapy">Внедрение</a>
      <a href="#integracii">Интеграции</a>
      <a href="#roi">ROI</a>
      <a href="#keisy">Кейсы</a>
      <a href="#ceny">Стоимость</a>
      <a href="#faq">FAQ</a>
      <a href="#cta">Найти простои</a>
    </nav>
  </div>
</div>

<!-- H2 1: Зачем -->
<section class="smz-prostoi-section" id="kak-rabotaet" aria-labelledby="smz-h2-zachem">
  <div class="smz-prostoi-cnt">
    <header class="smz-prostoi-sh nero-ai-reveal">
      <span class="smz-prostoi-eyebrow">ai для производства</span>
      <h2 id="smz-h2-zachem">Зачем производству AI-агент для смен и простоев</h2>
      <p><strong>Определение:</strong> программный слой с ИИ, который ведёт учёт смены, классифицирует остановки, сопоставляет план с фактом и готовит отчёт. Не управляет станками автономно и не заменяет ERP.</p>
    </header>
    <div class="smz-prostoi-grid-3 nero-ai-reveal">
      <div class="smz-prostoi-card">
        <h3>Почему задачи на смене меняются вручную</h3>
        <p>Утром — план из 1С или Excel. К обеду — срочный заказ, мастер переписывает задания в чат. К вечеру половина смены работала по устаревшему плану, факт нигде не сведён.</p>
      </div>
      <div class="smz-prostoi-card nero-ai-delay-1">
        <h3>Сколько стоит поздняя фиксация простоя</h3>
        <p>Простои 25–30% фонда времени воспринимаются как норма. Поздняя фиксация = потеря реакции, «забытые» причины, невозможность посчитать ROI улучшений.</p>
      </div>
      <div class="smz-prostoi-card nero-ai-delay-2">
        <h3>AI как цифровой диспетчер</h3>
        <p>Агент подтягивает план, раздаёт задания по центрам, при смене приоритета <strong>предлагает</strong> новую очередь — с подтверждением мастера, не приказом алгоритма.</p>
      </div>
    </div>
    <p class="nero-ai-reveal" style="margin-top:28px;text-align:center;max-width:720px;margin-left:auto;margin-right:auto;"><strong>Итог:</strong> ai производство контроль окупается скоростью обнаружения потерь и прозрачностью сменного плана — не «магией нейросетей».</p>
  </div>
</section>

<!-- H2 2: Сменные задания -->
<section class="smz-prostoi-section smz-prostoi-section-alt" id="smennye-zadaniya" aria-labelledby="smz-h2-smeny">
  <div class="smz-prostoi-cnt">
    <header class="smz-prostoi-sh smz-prostoi-sh--left nero-ai-reveal">
      <span class="smz-prostoi-eyebrow">ai сменные задания</span>
      <h2 id="smz-h2-smeny">Как AI-агент ведёт сменные задания без ручного переписывания</h2>
      <p>Агент подтягивает план из ERP или таблицы, формирует задания по рабочим центрам, принимает статусы и при отклонении предлагает корректировку — мастер подтверждает одним кликом.</p>
    </header>
    <div class="smz-prostoi-steps nero-ai-reveal">
      <div class="smz-prostoi-step">
        <div class="smz-prostoi-step-num">1</div>
        <h3>Сбор данных по смене</h3>
        <p>Загрузка плана из 1С, Excel, CRM. Задания в Telegram-бот или терминал — ввод 10–15 секунд.</p>
      </div>
      <div class="smz-prostoi-step">
        <div class="smz-prostoi-step-num">2</div>
        <h3>Фиксация отклонений</h3>
        <p>Сравнение план/факт: затянувшаяся операция, простой &gt; N минут, срыв заказа — с объяснением «почему».</p>
      </div>
      <div class="smz-prostoi-step">
        <div class="smz-prostoi-step-num">3</div>
        <h3>Human-in-the-loop</h3>
        <p>Нейросеть нормализует причины из текста и голоса; мастер утверждает спорные случаи и перепланирование.</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== БОРИС: визуальный блок (canvas) — после 2-го H2 ===== -->
<section id="ai-agent-smennye-zadaniya-prostoi-boris-block" class="smz-boris-root" aria-label="Анимация: мониторинг простоев на трёх линиях цеха — стоп, причина, эскалация, отчёт">
<style>
#ai-agent-smennye-zadaniya-prostoi-boris-block.smz-boris-root{padding:48px 0 56px;background:#f8fafc;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .smz-boris-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .smz-boris-card{display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);min-height:480px;}
@media(max-width:1023px){#ai-agent-smennye-zadaniya-prostoi-boris-block .smz-boris-card{grid-template-columns:1fr;min-height:auto;}}
#ai-agent-smennye-zadaniya-prostoi-boris-block .smz-boris-lft{padding:36px 32px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0;}
@media(max-width:1023px){#ai-agent-smennye-zadaniya-prostoi-boris-block .smz-boris-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:28px 22px;}}
#ai-agent-smennye-zadaniya-prostoi-boris-block .smz-boris-ey{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#d97706;margin:0 0 12px;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .smz-boris-ey::before{content:'';width:18px;height:2px;background:#d97706;border-radius:1px;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .smz-boris-h3{font-size:clamp(19px,2.2vw,24px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 16px;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .smz-boris-ul{list-style:none;margin:0 0 18px;padding:0;display:flex;flex-direction:column;gap:8px;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .smz-boris-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .smz-boris-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(245,158,11,.12);display:flex;align-items:center;justify-content:center;font-size:11px;color:#b45309;font-style:normal;font-weight:700;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .smz-boris-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:14px;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .smz-boris-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .smz-boris-pl-a{background:rgba(245,158,11,.08);color:#b45309;border:1.5px solid rgba(245,158,11,.22);}
#ai-agent-smennye-zadaniya-prostoi-boris-block .smz-boris-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-agent-smennye-zadaniya-prostoi-boris-block .smz-boris-pl-c{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22);}
#ai-agent-smennye-zadaniya-prostoi-boris-block .smz-boris-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .smz-boris-rgt{position:relative;background:linear-gradient(135deg,#fffbeb 0%,#fef3c7 22%,#f0f9ff 68%,#f8fafc 100%);min-height:420px;overflow:hidden;}
@media(max-width:1023px){#ai-agent-smennye-zadaniya-prostoi-boris-block .smz-boris-rgt{min-height:360px;}}
#smz-prostoi-shift-monitor-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="smz-boris-cnt">
  <div class="smz-boris-card nero-ai-reveal">
    <div class="smz-boris-lft">
      <span class="smz-boris-ey">Мониторинг простоев</span>
      <h3 class="smz-boris-h3">Три линии цеха — стоп фиксируется за минуты, не на следующий день</h3>
      <ul class="smz-boris-ul">
        <li><span class="smz-boris-ic">●</span>Светофор статусов: работа / переналадка / простой с причиной</li>
        <li><span class="smz-boris-ic">!</span>Порог 5–10 мин — запрос причины у оператора в Telegram</li>
        <li><span class="smz-boris-ic">↑</span>Эскалация мастеру, если реакции нет 3–5 минут</li>
        <li><span class="smz-boris-ic">→</span>Автоотчёт руководителю: топ-3 потери и OEE за смену</li>
      </ul>
      <div class="smz-boris-pills">
        <span class="smz-boris-pl smz-boris-pl-a">5–15 мин реакция</span>
        <span class="smz-boris-pl smz-boris-pl-g">&gt;85% журнал</span>
        <span class="smz-boris-pl smz-boris-pl-c">без SCADA на старте</span>
      </div>
      <p class="smz-boris-foot">Дальше — контроль простоев от обнаружения до отчёта руководителю ↓</p>
    </div>
    <div class="smz-boris-rgt">
      <canvas id="smz-prostoi-shift-monitor-canvas" role="img" aria-label="Анимация: три производственные линии со светофором простоев, эскалацией и формированием сменного отчёта"></canvas>
    </div>
  </div>
</div>
<script>
(function(){
  'use strict';
  var cv = document.getElementById('smz-prostoi-shift-monitor-canvas');
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
    ink:'#0f172a', muted:'#64748b', line:'#cbd5e1',
    green:'#22c55e', amber:'#f59e0b', red:'#ef4444',
    cyan:'#0ea5e9', violet:'#8b5cf6', paper:'#ffffff'
  };

  var lines = [
    { y:0.22, label:'Линия 1 · сборка', phase:0, status:'run' },
    { y:0.50, label:'Линия 2 · кромление', phase:2.1, status:'idle' },
    { y:0.78, label:'Линия 3 · упаковка', phase:4.3, status:'stop' }
  ];

  function statusColor(s, pulse){
    if (s === 'run') return C.green;
    if (s === 'idle') return C.amber;
    return C.red;
  }

  function drawRoundedRect(x,y,w,h,r,fill,stroke){
    ctx.beginPath();
    ctx.moveTo(x+r,y); ctx.lineTo(x+w-r,y); ctx.quadraticCurveTo(x+w,y,x+w,y+r);
    ctx.lineTo(x+w,y+h-r); ctx.quadraticCurveTo(x+w,y+h,x+w-r,y+h);
    ctx.lineTo(x+r,y+h); ctx.quadraticCurveTo(x,y+h,x,y+h-r);
    ctx.lineTo(x,y+r); ctx.quadraticCurveTo(x,y,x+r,y);
    ctx.closePath();
    if (fill){ ctx.fillStyle=fill; ctx.fill(); }
    if (stroke){ ctx.strokeStyle=stroke; ctx.stroke(); }
  }

  function draw(){
    ctx.clearRect(0,0,W,H);
    var pad = Math.max(24, W*0.04);
    var laneW = W - pad*2;
    var laneH = Math.min(72, H*0.14);

    /* header badge */
    drawRoundedRect(pad, pad*0.6, 168, 28, 8, 'rgba(15,23,42,.06)', C.line);
    ctx.fillStyle = C.muted; ctx.font = '600 11px Inter,system-ui,sans-serif';
    ctx.fillText('Смена · мониторинг', pad+12, pad*0.6+18);

    lines.forEach(function(ln, idx){
      var cy = H * ln.y;
      var cycle = (t*0.018 + ln.phase) % 12;
      var st = ln.status;
      if (cycle > 8 && idx === 1) st = 'stop';
      else if (cycle > 5 && idx === 1) st = 'idle';
      else if (idx === 0) st = 'run';
      else if (idx === 2) st = (cycle > 9) ? 'run' : 'stop';

      var col = statusColor(st);
      var pulse = 0.5 + 0.5*Math.sin(t*0.08 + idx);

      /* lane track */
      drawRoundedRect(pad, cy - laneH/2, laneW, laneH, 12, '#fff', C.line);

      /* belt motion */
      ctx.save();
      ctx.beginPath();
      ctx.rect(pad+4, cy-laneH/2+4, laneW-8, laneH-8);
      ctx.clip();
      ctx.strokeStyle = 'rgba(148,163,184,.35)';
      ctx.lineWidth = 2;
      for (var bx = -20 + (t*1.8 % 40); bx < laneW; bx += 40){
        ctx.beginPath();
        ctx.moveTo(pad+bx, cy); ctx.lineTo(pad+bx+18, cy);
        ctx.stroke();
      }
      ctx.restore();

      /* status lamp */
      ctx.beginPath();
      ctx.arc(pad+22, cy, 7 + pulse*2, 0, Math.PI*2);
      ctx.fillStyle = col;
      ctx.globalAlpha = 0.25 + pulse*0.35;
      ctx.fill();
      ctx.globalAlpha = 1;
      ctx.beginPath();
      ctx.arc(pad+22, cy, 5, 0, Math.PI*2);
      ctx.fillStyle = col;
      ctx.fill();

      /* label */
      ctx.fillStyle = C.ink;
      ctx.font = '700 12px Inter,system-ui,sans-serif';
      ctx.fillText(ln.label, pad+40, cy+4);

      /* moving work unit */
      var ux = pad + 60 + ((t*2.2 + idx*90) % (laneW-120));
      drawRoundedRect(ux, cy-10, 36, 20, 5, col, null);
      ctx.fillStyle = '#fff';
      ctx.font = '700 9px Inter,system-ui,sans-serif';
      ctx.fillText('SKU', ux+8, cy+4);

      /* event bubble on stop */
      if (st === 'stop' && pulse > 0.6){
        var bx = pad + laneW - 140;
        drawRoundedRect(bx, cy-28, 128, 22, 6, 'rgba(239,68,68,.12)', C.red);
        ctx.fillStyle = C.red;
        ctx.font = '600 10px Inter,system-ui,sans-serif';
        ctx.fillText('Стоп · причина?', bx+10, cy-13);
      }
      if (st === 'idle'){
        var bx2 = pad + laneW - 120;
        drawRoundedRect(bx2, cy-28, 108, 22, 6, 'rgba(245,158,11,.12)', C.amber);
        ctx.fillStyle = '#b45309';
        ctx.font = '600 10px Inter,system-ui,sans-serif';
        ctx.fillText('Переналадка', bx2+10, cy-13);
      }
    });

    /* escalation arrow + report */
    var rx = W - pad - 150;
    var ry = H - pad - 52;
    drawRoundedRect(rx, ry, 150, 40, 10, 'rgba(14,165,233,.1)', C.cyan);
    ctx.fillStyle = C.ink;
    ctx.font = '700 11px Inter,system-ui,sans-serif';
    ctx.fillText('Отчёт руководителю', rx+12, ry+16);
    ctx.fillStyle = C.muted;
    ctx.font = '600 10px Inter,system-ui,sans-serif';
    ctx.fillText('OEE · топ-3 потери', rx+12, ry+30);

    /* floating ping */
    var pingX = pad + laneW*0.55 + Math.sin(t*0.05)*12;
    var pingY = H*0.36 + Math.cos(t*0.04)*8;
    ctx.beginPath();
    ctx.arc(pingX, pingY, 4 + pulse*3, 0, Math.PI*2);
    ctx.fillStyle = C.violet;
    ctx.globalAlpha = 0.35;
    ctx.fill();
    ctx.globalAlpha = 1;

    t++;
    requestAnimationFrame(draw);
  }
  var pulse = 0;
  draw();
})();
</script>
</section>
<!-- ===== конец блока Бориса ===== -->

<!-- H2 3: Простои -->
<section class="smz-prostoi-section" id="prostoi" aria-labelledby="smz-h2-prostoi">
  <div class="smz-prostoi-cnt">
    <header class="smz-prostoi-sh nero-ai-reveal">
      <span class="smz-prostoi-eyebrow">ai контроль простоев</span>
      <h2 id="smz-h2-prostoi">Контроль простоев: от обнаружения до отчёта руководителю</h2>
      <p>Непрерывный или по-сменный мониторинг остановок с классификацией причин, SLA реакции и эскалацией критичных событий.</p>
    </header>
    <div class="smz-prostoi-traffic nero-ai-reveal" aria-label="Светофор статусов линии">
      <div class="smz-prostoi-light"><span class="smz-prostoi-dot smz-prostoi-dot--g"></span>Работа — план в норме</div>
      <div class="smz-prostoi-light"><span class="smz-prostoi-dot smz-prostoi-dot--a"></span>Переналадка / ожидание</div>
      <div class="smz-prostoi-light"><span class="smz-prostoi-dot smz-prostoi-dot--r"></span>Простой — запрос причины</div>
    </div>
    <div class="smz-prostoi-grid-3 nero-ai-reveal">
      <div class="smz-prostoi-card">
        <h3>Раннее выявление остановок</h3>
        <p>Ручной ввод → терминалы → датчики OPC-UA/MQTT. При простое &gt; порога — уведомление мастеру, фиксация времени, эскалация без реакции 3–5 мин.</p>
      </div>
      <div class="smz-prostoi-card">
        <h3>Источники данных</h3>
        <p>Старт без SCADA: оператор жмёт «стоп» + причина в Telegram. Модель KRONPRINZ — цветовая индикация в 1С:ERP на терминалах.</p>
      </div>
      <div class="smz-prostoi-card">
        <h3>Автоотчёт по смене</h3>
        <p>Список простоев, OEE за смену, топ-3 потери, рекомендации текстом — в web, email или Telegram-digest за секунды.</p>
      </div>
    </div>
  </div>
</section>

<!-- H2 4: Для кого -->
<section class="smz-prostoi-section smz-prostoi-section-alt" id="dlya-kogo" aria-labelledby="smz-h2-dlya-kogo">
  <div class="smz-prostoi-cnt">
    <header class="smz-prostoi-sh nero-ai-reveal">
      <span class="smz-prostoi-eyebrow">ai производство контроль для малого бизнеса</span>
      <h2 id="smz-h2-dlya-kogo">Для кого подходит решение</h2>
      <p>Не про заводы уровня ФосАгро — про цеха 5–30 человек, где цифровизация впереди, а боль от ручного управления уже ощутима.</p>
    </header>
    <div class="smz-prostoi-segments nero-ai-reveal">
      <div class="smz-prostoi-segment">
        <h3>Малые цеха и мебельное производство</h3>
        <p>Распил, кромление, сборка, упаковка. План в Excel или 1С, срочные заказы 2–3 раза за смену. Мобильный ввод, перепланирование с approval, отчёт без отдельного диспетчера.</p>
      </div>
      <div class="smz-prostoi-segment">
        <h3>Пищевое производство и переналадки</h3>
        <p>CIP-мойка, частые переналадки под SKU, жёсткие сроки отгрузки. Агент фиксирует каждую переналадку и показывает, какие SKU «съедают» смену.</p>
      </div>
    </div>
  </div>
</section>

<!-- H2 5: Внедрение -->
<section class="smz-prostoi-section" id="etapy" aria-labelledby="smz-h2-etapy">
  <div class="smz-prostoi-cnt">
    <header class="smz-prostoi-sh nero-ai-reveal">
      <span class="smz-prostoi-eyebrow">внедрение ai агентов</span>
      <h2 id="smz-h2-etapy">Внедрение AI-агента под ключ: этапы и сроки</h2>
      <p>Поэтапный проект, не «big bang». Общий срок производственного контура — 4–8 недель.</p>
    </header>
    <div class="smz-prostoi-table-wrap nero-ai-reveal">
      <table class="smz-prostoi-table">
        <thead><tr><th>Этап</th><th>Срок</th><th>Результат</th></tr></thead>
        <tbody>
          <tr><td><strong>Аудит и карта потерь</strong></td><td>1–2 нед.</td><td>Как выдаются задания, где теряются простои, 3–5 типовых причин остановок</td></tr>
          <tr><td><strong>Пилот на одной смене</strong></td><td>3–4 нед.</td><td>Telegram-бот + Sheets/1С, агент собирает и отчитывает, мастер подтверждает план</td></tr>
          <tr><td><strong>Масштабирование на цех</strong></td><td>2–4 нед.</td><td>Вторая смена, CRM/ERP, дашборд, датчики по необходимости</td></tr>
        </tbody>
      </table>
    </div>

    <div class="ym-cta-block ym-cta-block--primary" id="cta-karta-potery">
      <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Получите «Карту потерь производства» — бесплатно</p>
        <p class="ym-cta-block__sub">За 1–2 недели аудита зафиксируем, где теряются простои, как меняются задания на смене и какие 3–5 причин остановок повторяются чаще всего. На выходе — визуальный разбор до договора на внедрение, без обязательств.</p>
        <a href="<?php echo esc_url( nero_ai_primary_cta_url() ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn" target="_blank" rel="noopener noreferrer">Найти простои</a>
      </div>
    </div>
  </div>
</section>

<!-- H2 6: Интеграции -->
<section class="smz-prostoi-section smz-prostoi-section-alt" id="integracii" aria-labelledby="smz-h2-integracii">
  <div class="smz-prostoi-cnt">
    <header class="smz-prostoi-sh nero-ai-reveal">
      <span class="smz-prostoi-eyebrow">интеграция ai производство контроль</span>
      <h2 id="smz-h2-integracii">Интеграции: MES, 1С, Excel, датчики и CRM</h2>
      <p>Агент работает поверх существующих систем — без замены ERP.</p>
    </header>
    <div class="smz-prostoi-table-wrap nero-ai-reveal">
      <table class="smz-prostoi-table">
        <thead><tr><th>Система</th><th>Роль</th><th>Обязательность</th></tr></thead>
        <tbody>
          <tr><td>Excel / Google Sheets</td><td>План смены, история простоев</td><td>Старт без ERP</td></tr>
          <tr><td>1С / МойСклад</td><td>Заказы, выпуск, справочники</td><td>Рекомендуется</td></tr>
          <tr><td>Telegram / WhatsApp</td><td>Ввод факта операторами</td><td>Основной канал для цеха</td></tr>
          <tr><td>amoCRM / Bitrix24</td><td>Приоритет заказов → смена</td><td>Опционально</td></tr>
          <tr><td>SCADA / OPC-UA / MQTT</td><td>Автофиксация остановок</td><td>Этап 2</td></tr>
        </tbody>
      </table>
    </div>
    <p class="nero-ai-reveal" style="text-align:center;max-width:700px;margin:20px auto 0;">Типовой сценарий: 1С остаётся учётом, AI-агент — оперативным слоем. Выгрузка плана → агент → факт смены → обратная загрузка итогов.</p>
  </div>
</section>

<!-- H2 7: Тренды -->
<section class="smz-prostoi-section" id="trendy" aria-labelledby="smz-h2-trendy">
  <div class="smz-prostoi-cnt">
    <header class="smz-prostoi-sh nero-ai-reveal">
      <span class="smz-prostoi-eyebrow">agentic ai производство</span>
      <h2 id="smz-h2-trendy">Agentic AI на производстве в 2026: тренды и риски</h2>
      <p>ИИ, который выполняет цепочки действий: собирает данные, анализирует, предлагает решения, формирует отчёты.</p>
    </header>
    <div class="smz-prostoi-callout nero-ai-reveal">
      <p><strong>Gartner (июнь 2025):</strong> более 40% agentic AI-проектов будут отменены к концу 2027 — из-за стоимости, неясного ROI и слабого risk control. Ответ Nero: пилот на одной смене, human-in-the-loop, работа поверх Excel/Telegram, честные метрики.</p>
    </div>
    <ul class="nero-ai-reveal">
      <li>Пилот на одной смене — измеримый ROI за 3–4 недели</li>
      <li>Агент предлагает — человек утверждает; без автономного управления станками</li>
      <li>Карта потерь — аудит данных до масштабирования</li>
    </ul>

    <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Команда хочет понять AI до пилота на смене?</p>
        <p class="ym-cta-block__sub">Перед внедрением agentic AI на производстве полезно разобраться в n8n, human-in-the-loop и связке Excel/1С/Telegram — это ускоряет согласование сценариев с мастером и директором. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
      </div>
    </aside>
  </div>
</section>

<!-- H2 8: ROI -->
<section class="smz-prostoi-section smz-prostoi-section-alt" id="roi" aria-labelledby="smz-h2-roi">
  <div class="smz-prostoi-cnt">
    <header class="smz-prostoi-sh nero-ai-reveal">
      <span class="smz-prostoi-eyebrow">ai производство контроль кейсы</span>
      <h2 id="smz-h2-roi">ROI: метрики эффекта от контроля простоев</h2>
      <p>Окупаемость — от сокращения времени реакции, роста доли задокументированных остановок и часов мастера.</p>
    </header>
    <div class="smz-prostoi-table-wrap nero-ai-reveal">
      <table class="smz-prostoi-table">
        <thead><tr><th>Показатель</th><th>До AI-агента</th><th>После пилота (цель)</th></tr></thead>
        <tbody>
          <tr><td>Время обнаружения простоя</td><td>Часы — сутки</td><td>5–15 минут</td></tr>
          <tr><td>Фиксация причины</td><td>На следующий день</td><td>В момент остановки</td></tr>
          <tr><td>Отчёт руководителю</td><td>30–60 мин мастера</td><td>Автоматически, &lt;1 мин</td></tr>
          <tr><td>Задокументированные простои</td><td>30–50%</td><td>&gt;85%</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- H2 9: Кейсы -->
<!-- INTERNAL-LINKS:INSERT -->

<section class="smz-prostoi-section" id="keisy" aria-labelledby="smz-h2-keisy">
  <div class="smz-prostoi-cnt">
    <header class="smz-prostoi-sh nero-ai-reveal">
      <span class="smz-prostoi-eyebrow">ai производство контроль примеры внедрения</span>
      <h2 id="smz-h2-keisy">Кейсы и примеры внедрения</h2>
      <p>Смежные внедрения в России — с пометкой масштаба. Прямых кейсов AI-агента для малого цеха пока мало.</p>
    </header>
    <div class="smz-prostoi-case nero-ai-reveal">
      <div class="smz-prostoi-case-item">
        <span class="smz-prostoi-case-tag">KOBLiK GROUP</span>
        <h3>Сменные задания без переписывания</h3>
        <p>1С:ERP + мобильное приложение: организационные простои ≤5%, производительность +40%. Сценарий «смена без мастера-диспетчера» — прямой аналог для цеха.</p>
      </div>
      <div class="smz-prostoi-case-item">
        <span class="smz-prostoi-case-tag">KRONPRINZ</span>
        <h3>Светофор простоя в 1С:ERP</h3>
        <p>Терминалы, индикация работа/простой/нет задания. Модель «задание → факт → простой с причиной».</p>
      </div>
      <div class="smz-prostoi-case-item">
        <span class="smz-prostoi-case-tag">Апатит / ФосАгро</span>
        <h3>AIХимик — доверительный якорь</h3>
        <p>Реакция на отклонение до 1 мин. Крупное производство — не типовой кейс мебельного цеха, но proof agentic AI в РФ.</p>
      </div>
      <div class="smz-prostoi-case-item">
        <span class="smz-prostoi-case-tag">Nero Network</span>
        <h3>Проектная модель (предложение)</h3>
        <p>Аудит → пилот на одной линии → интеграция → масштабирование. Чек 500 тыс.–2 млн ₽.</p>
      </div>
    </div>
  </div>
</section>

<!-- H2 10: Стоимость -->
<section class="smz-prostoi-section smz-prostoi-section-alt" id="ceny" aria-labelledby="smz-h2-ceny">
  <div class="smz-prostoi-cnt">
    <header class="smz-prostoi-sh nero-ai-reveal">
      <span class="smz-prostoi-eyebrow">ai производство контроль цена</span>
      <h2 id="smz-h2-ceny">Стоимость внедрения AI для производства</h2>
      <p>Узкий scope дешевле полной MES: ориентир 500 тыс.–2 млн ₽ vs от ~400 тыс. ₽ только разработка MES.</p>
    </header>
    <div class="smz-prostoi-table-wrap nero-ai-reveal">
      <table class="smz-prostoi-table">
        <thead><tr><th>Компонент</th><th>Базовый пилот (~500–800 тыс. ₽)</th><th>Полное внедрение (~1–2 млн ₽)</th></tr></thead>
        <tbody>
          <tr><td>Аудит и карта потерь</td><td>✓</td><td>✓</td></tr>
          <tr><td>Telegram-бот / мини-приложение</td><td>✓</td><td>✓</td></tr>
          <tr><td>AI-агент (классификация, отчёты)</td><td>✓</td><td>✓</td></tr>
          <tr><td>Интеграция 1С / CRM</td><td>Выгрузка</td><td>Двусторонняя</td></tr>
          <tr><td>SCADA / датчики</td><td>—</td><td>Опционально</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- H2 11: Сравнение -->
<section class="smz-prostoi-section" id="sravnenie" aria-labelledby="smz-h2-sravnenie">
  <div class="smz-prostoi-cnt">
    <header class="smz-prostoi-sh nero-ai-reveal">
      <span class="smz-prostoi-eyebrow">сравнение решений</span>
      <h2 id="smz-h2-sravnenie">Сравнение: MES под ключ vs AI-агент vs DIY</h2>
    </header>
    <div class="smz-prostoi-table-wrap nero-ai-reveal">
      <table class="smz-prostoi-table">
        <thead><tr><th>Критерий</th><th>MES под ключ</th><th>AI-агент Nero</th><th>DIY (n8n + Sheets)</th></tr></thead>
        <tbody>
          <tr><td>Срок внедрения</td><td>3–12 мес.</td><td>4–8 нед.</td><td>2–4 нед.</td></tr>
          <tr><td>Бюджет</td><td>400 тыс.–3+ млн ₽</td><td>500 тыс.–2 млн ₽</td><td>Минимальный</td></tr>
          <tr><td>AI-классификация простоев</td><td>Редко</td><td>✓</td><td>Нет</td></tr>
          <tr><td>Human-in-the-loop</td><td>Зависит</td><td>✓</td><td>Нет</td></tr>
          <tr><td>Ответственность интегратора</td><td>✓</td><td>✓</td><td>Нет</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- H2 12: FAQ -->
<section class="smz-prostoi-section smz-prostoi-section-alt" id="faq" aria-labelledby="smz-h2-faq">
  <div class="smz-prostoi-cnt">
    <header class="smz-prostoi-sh nero-ai-reveal">
      <span class="smz-prostoi-eyebrow">как внедрить ai производство контроль</span>
      <h2 id="smz-h2-faq">FAQ</h2>
    </header>
    <div class="smz-prostoi-faq nero-ai-reveal" data-smz-faq>
      <div class="smz-prostoi-faq-item">
        <div class="smz-prostoi-faq-q" role="button" tabindex="0">Нужны ли программисты на стороне заказчика?</div>
        <div class="smz-prostoi-faq-a"><p>Нет. Интегратор настраивает бота, связки и дашборд; на стороне цеха — мастер (подтверждение плана) и операторы (ввод за 10 секунд в Telegram).</p></div>
      </div>
      <div class="smz-prostoi-faq-item">
        <div class="smz-prostoi-faq-q" role="button" tabindex="0">Сколько длится пилот?</div>
        <div class="smz-prostoi-faq-a"><p>3–4 недели на одной линии или смене. Фиксируются время реакции, полнота журнала, часы мастера.</p></div>
      </div>
      <div class="smz-prostoi-faq-item">
        <div class="smz-prostoi-faq-q" role="button" tabindex="0">Чем отличается от MES и OEE-систем?</div>
        <div class="smz-prostoi-faq-a"><p>MES — полное оперативное управление, долго и дорого. OEE-датчик фиксирует остановку, но не ведёт сменные задания. AI-агент — связка: план → факт → простои → отчёт → корректировка с approval.</p></div>
      </div>
      <div class="smz-prostoi-faq-item">
        <div class="smz-prostoi-faq-q" role="button" tabindex="0">Как внедрить, если всё в Excel?</div>
        <div class="smz-prostoi-faq-a"><p>Типовой старт: агент читает план из таблицы, принимает факт из Telegram, пишет отчёт в Sheets. По мере роста — 1С и датчики.</p></div>
      </div>
      <div class="smz-prostoi-faq-item">
        <div class="smz-prostoi-faq-q" role="button" tabindex="0">Сколько стоит ai производство контроль?</div>
        <div class="smz-prostoi-faq-a"><p>Ориентир 500 тыс.–2 млн ₽ в зависимости от линий, интеграций и SCADA. Точная смета — после аудита и «Карты потерь».</p></div>
      </div>
      <div class="smz-prostoi-faq-item">
        <div class="smz-prostoi-faq-q" role="button" tabindex="0">Работает без SCADA и датчиков?</div>
        <div class="smz-prostoi-faq-a"><p>Да. Ручной ввод — основной канал на старте; датчики подключаются на этапе 2, когда пилот доказал ценность.</p></div>
      </div>
      <div class="smz-prostoi-faq-item">
        <div class="smz-prostoi-faq-q" role="button" tabindex="0">Безопасно ли это для производства?</div>
        <div class="smz-prostoi-faq-a"><p>Агент не управляет оборудованием. Критичные действия — только с подтверждением мастера.</p></div>
      </div>
    </div>
  </div>
</section>

<!-- H2 13: CTA -->
<section class="smz-prostoi-section" id="cta" aria-labelledby="smz-h2-cta">
  <div class="smz-prostoi-cnt">
    <header class="smz-prostoi-sh nero-ai-reveal">
      <h2 id="smz-h2-cta">Найти простои на вашем производстве</h2>
      <p>Если задачи меняются вручную, а простои фиксируются поздно — вы теряете деньги каждую смену. Не обязательно начинать с миллионного MES-проекта.</p>
    </header>
    <ul class="smz-prostoi-cta-checklist nero-ai-reveal">
      <li>Пилот на одной смене за 3–4 недели</li>
      <li>Human-in-the-loop — без автономного управления станками</li>
      <li>Интеграция 1С / Excel / Telegram</li>
      <li>Карта потерь производства — бесплатно</li>
    </ul>
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Готовы увидеть простои, пока смена ещё идёт?</p>
        <p class="ym-cta-block__sub">Следующий шаг — аудит сменных процессов и бесплатная «Карта потерь производства». Пилот на одной линии за 3–4 недели, без миллионного MES-проекта.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url( nero_ai_primary_cta_url() ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" target="_blank" rel="noopener noreferrer">Найти простои</a>
          <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения →</a>
        </div>
      </div>
    </div>
    <p class="nero-ai-reveal" style="text-align:center;margin-top:24px;"><strong>Итог:</strong> ai производство контроль в 2026 — способ увидеть простои, пока смена идёт, и перестать переписывать задания вручную.</p>
  </div>
</section>

<script>
(function(){
  document.querySelectorAll('[data-smz-faq] .smz-prostoi-faq-q').forEach(function(q){
    q.addEventListener('click', function(){ q.parentElement.classList.toggle('open'); });
    q.addEventListener('keydown', function(e){ if(e.key==='Enter'||e.key===' '){ e.preventDefault(); q.parentElement.classList.toggle('open'); }});
  });
})();
</script>

</div>
<!-- /smz-prostoi-content -->

<script id="smz-prostoi-hero-engine">
/**
 * smz-prostoi-hero-engine — «Диспетчерская смены Shift Bridge»
 * Мир: лента сменных карточек → OEE-панель → маяк простоя → отчёт руководителю
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("smz-prostoi-hero-canvas");
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
    scale = Math.min(cw / 440, ch / 280) * 1.08;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    panelBg: "#0f172a",
    panelEdge: "#1e293b",
    ribbon: "#334155",
    taskCard: "#dbeafe",
    taskAmber: "#fef3c7",
    taskGreen: "#d1fae5",
    lineRun: "#22c55e",
    lineStop: "#f59e0b",
    lineIdle: "#64748b",
    beacon: "#f59e0b",
    report: "#79f2ff",
    heatLoss: "#8b5cf6",
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
      ctx.lineWidth = 1.4;
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

  /* Горизонтальная лента сменных карточек — вместо Conveyor */
  function TaskTickerRibbon() {
    this.cards = [
      { offset: 0, color: C.taskGreen, label: "L1" },
      { offset: 55, color: C.taskCard, label: "L2" },
      { offset: 110, color: C.taskAmber, label: "L3" },
      { offset: 165, color: C.taskCard, label: "L1" }
    ];
  }
  TaskTickerRibbon.prototype.draw = function (ctx) {
    drawRR(ctx, -175, 78, 350, 22, 6, "rgba(51,65,85,0.55)", C.outline);
    ctx.fillStyle = C.ribbon;
    for (var i = -175; i < 180; i += 18) {
      var dash = (frame * 0.55 + i) % 36;
      ctx.fillRect(i - dash, 83, 8, 12);
    }
    this.cards.forEach(function (c) {
      var t = ((frame * 0.42 + c.offset) % 140) / 140;
      var x = -165 + t * 330;
      if (t < 0.88) drawTaskCard(ctx, x, 89, 22, 14, c.color, c.label);
    });
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Сменные задания", -172, 72);
  };

  /* Три линии со светофорами */
  function ProductionLineStrip() {
    this.states = [0, 1, 0];
  }
  ProductionLineStrip.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 260;
    if (prg >= 58 && prg < 145) this.states[1] = 2;
    else if (prg >= 145) this.states[1] = 0;
    else this.states[1] = 1;

    for (var i = 0; i < 3; i++) {
      var lx = -150 + i * 48;
      drawRR(ctx, lx, -82, 36, 52, 4, "rgba(30,41,59,0.65)", C.outline);
      var st = this.states[i];
      var lamp = st === 1 ? C.lineRun : st === 2 ? C.lineStop : C.lineIdle;
      ctx.fillStyle = lamp;
      ctx.beginPath();
      ctx.arc(lx + 18, -68, 5, 0, Math.PI * 2);
      ctx.fill();
      drawRR(ctx, lx + 6, -52, 24, 18, 3, "rgba(255,255,255,0.06)", null);
      ctx.fillStyle = "#cbd5e1";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("L" + (i + 1), lx + 18, -40);
    }
  };

  /* Центральная OEE-панель — вместо WebsiteTerminal */
  function ShiftOeeCommandPanel() {
    this.oee = 52;
    this.plan = 78;
  }
  ShiftOeeCommandPanel.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 260;
    drawRR(ctx, -55, -88, 150, 118, 10, C.panelBg, C.outline);
    drawRR(ctx, -48, -80, 136, 16, [6, 6, 0, 0], "rgba(121,242,255,0.18)", null);
    ctx.fillStyle = C.report;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("OEE · смена", -42, -70);

    var bars = [
      { label: "Доступн.", val: prg < 145 ? 0.62 : 0.71, color: C.lineRun },
      { label: "План", val: Math.min(0.92, 0.78 + (prg > 170 ? 0.14 : 0)), color: C.report },
      { label: "Простой", val: prg >= 58 && prg < 145 ? 0.28 : 0.12, color: C.lineStop }
    ];
    bars.forEach(function (b, i) {
      var by = -52 + i * 22;
      ctx.fillStyle = "#94a3b8";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(b.label, -42, by);
      drawRR(ctx, 8, by - 8, 72, 8, 2, "rgba(255,255,255,0.08)", null);
      drawRR(ctx, 8, by - 8, 72 * b.val, 8, 2, b.color, null);
    });

    if (prg >= 170) {
      this.oee = 52 + Math.min(12, (prg - 170) / 4);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 9px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("OEE " + Math.round(this.oee) + "%", 20, 18);
    }
  };

  /* Маяк простоя */
  function DowntimeBeaconTower() {
    this.flash = 0;
  }
  DowntimeBeaconTower.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 260;
    if (prg < 58 || prg >= 145) return;
    this.flash = Math.sin(frame * 0.22) * 0.35 + 0.65;
    drawRR(ctx, 118, -72, 14, 36, 4, "#1e293b", C.outline);
    ctx.fillStyle = "rgba(245,158,11," + this.flash + ")";
    ctx.beginPath();
    ctx.arc(125, -78, 7, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.beacon;
    ctx.lineWidth = 1.2;
    ctx.beginPath();
    ctx.arc(125, -78, 12 + this.flash * 4, 0, Math.PI * 2);
    ctx.stroke();
  };

  /* Терминал выбора причины */
  function StopCauseTerminal() {
    this.pick = -1;
  }
  StopCauseTerminal.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 260;
    if (prg < 95 || prg >= 165) return;
    drawRR(ctx, 102, 8, 58, 54, 6, "rgba(15,23,42,0.92)", C.outline);
    ctx.fillStyle = "#e2e8f0";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Причина", 131, 20);
    var causes = ["Перенал.", "Материал", "Настрой"];
    causes.forEach(function (c, i) {
      var on = prg > 108 + i * 14;
      drawRR(ctx, 108, 26 + i * 12, 46, 10, 2, on ? "rgba(245,158,11,0.35)" : "rgba(255,255,255,0.06)", C.outline);
      ctx.fillStyle = on ? "#fde68a" : "#94a3b8";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(c, 131, 34 + i * 12);
    });
  };

  /* Плитка карты потерь */
  function LossHeatTile() {
    this.glow = 0;
  }
  LossHeatTile.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 260;
    if (prg < 125 || prg >= 195) return;
    this.glow = (prg - 125) / 70;
    drawRR(ctx, -168, 18, 42, 34, 5, "rgba(139,92,246," + (0.15 + this.glow * 0.25) + ")", C.heatLoss);
    ctx.fillStyle = "#ddd6fe";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Карта", -147, 32);
    ctx.fillText("потерь", -147, 42);
  };

  /* Курьер отчёта руководителю — финал цикла */
  function ShiftReportCourier() {
    this.x = 0;
    this.y = 0;
    this.alpha = 0;
  }
  ShiftReportCourier.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 260;
    if (prg < 178) return;
    var t = Math.min(1, (prg - 178) / 55);
    this.x = 35 + t * 95;
    this.y = -20 - t * 55;
    this.alpha = t < 0.85 ? 1 : 1 - (t - 0.85) / 0.15;

    ctx.save();
    ctx.globalAlpha = this.alpha;
    drawRR(ctx, this.x - 14, this.y - 10, 28, 20, 3, "#fff", C.report);
    ctx.fillStyle = C.report;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Отчёт", this.x, this.y + 2);
    ctx.strokeStyle = "rgba(121,242,255,0.5)";
    ctx.setLineDash([4, 3]);
    ctx.beginPath();
    ctx.moveTo(35, -18);
    ctx.lineTo(this.x, this.y);
    ctx.stroke();
    ctx.setLineDash([]);
    drawRR(ctx, 145, -78, 34, 26, 5, "rgba(121,242,255,0.12)", C.report);
    ctx.fillStyle = "#bae6fd";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Директор", 162, -64);
    ctx.restore();
  };

  /* Пульс Telegram-уведомления */
  function TelegramPulseDot() {
    this.on = false;
  }
  TelegramPulseDot.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 260;
    this.on = prg >= 62 && prg < 90;
    if (!this.on) return;
    var pulse = 0.5 + Math.sin(frame * 0.3) * 0.5;
    ctx.fillStyle = "rgba(56,189,248," + pulse + ")";
    ctx.beginPath();
    ctx.arc(-130, -18, 4 + pulse * 2, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillStyle = "#7dd3fc";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("TG → мастер", -122, -16);
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
    var prg = (frame * 0.034) % 260;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var targets = {
      "1_architect": { x: -20, y: 55 },
      "2_seo": { x: 15, y: -35 },
      "3_coder": { x: 125, y: 35 },
      "4_designer": { x: -145, y: 35 },
      "5_deployer": { x: 55, y: -5 }
    };
    var tgt = targets[this.role] || { x: 0, y: 0 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 26) {
      var local = prg - this.stepTrig;
      if (local < 13) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 13);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 13);
      } else if (local < 18) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 18) / 8);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 18) / 8);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 8 ? this.color : null;
    }

    if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 14, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 240);
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
    ctx.save();
    ctx.scale(faceDir, 1);
    ctx.fillStyle = "#fff";
    ctx.beginPath(); ctx.arc(3, -24 - bob, 3, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(-3, -24 - bob, 3, 0, Math.PI * 2); ctx.fill();
    ctx.restore();
    if (carryType) drawRR(ctx, -16 * faceDir, -18 - bob, 12, 12, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];

  entities.push(new TaskTickerRibbon());
  entities.push(new ProductionLineStrip());
  entities.push(new ShiftOeeCommandPanel());
  entities.push(new DowntimeBeaconTower());
  entities.push(new StopCauseTerminal());
  entities.push(new LossHeatTile());
  entities.push(new ShiftReportCourier());
  entities.push(new TelegramPulseDot());

  entities.push(new Agent(-155, 58, C.agentYellow, "1_architect", 18, [
    "План смены из Excel",
    "Задания разданы по L1–L3",
    "Приоритеты без переписывания"
  ]));
  entities.push(new Agent(-95, -8, C.agentGreen, "2_seo", 62, [
    "Линия 2 простаивает 8 мин",
    "Отклонение от плана +12%",
    "Эскалация мастеру"
  ]));
  entities.push(new Agent(-35, 62, C.agentBlue, "3_coder", 102, [
    "Причина: переналадка",
    "Код из справочника",
    "Мастер подтвердил"
  ]));
  entities.push(new Agent(35, 58, C.agentPink, "4_designer", 132, [
    "Топ-3 потери смены",
    "Карта потерь обновлена",
    "OEE baseline зафиксирован"
  ]));
  entities.push(new Agent(95, -12, C.agentPurple, "5_deployer", 182, [
    "Отчёт руководителю готов",
    "Digest в Telegram директору",
    "Human-in-the-loop ✓"
  ]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife || 240, maxLife: customLife || 240 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (ent) { ent.draw(ctx); });

    var prg = (frame * 0.034) % 260;
    if (prg >= 16 && prg < 16.04) createBubble(-155, 42, "1. План смены");
    if (prg >= 64 && prg < 64.04) createBubble(-95, -22, "2. Простой зафиксирован");
    if (prg >= 108 && prg < 108.04) createBubble(125, 22, "3. Причина выбрана");
    if (prg >= 186 && prg < 186.04) createBubble(55, -18, "4. Отчёт директору");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 28);
      if (bub.life > bub.maxLife - 12) alpha = (bub.maxLife - bub.life) / 12;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 14;
      var th = 18;
      var bx = bub.x;
      var by = bub.y - (bub.maxLife - bub.life) * 0.04;
      drawRR(ctx, bx - tw / 2, by - th, tw, th, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(bub.text, bx, by - th / 2);
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

<!-- SCHEMA-MARKUP:INSERT -->
<!-- INTERNAL-LINKS: вставки в теле лонгрида выше (internal-linker → Юра) -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

<?php
/**
 * Template Name: AI-анализ лидов из рекламы — качество заявок и отчёт
 * Description: AI-агент анализа лидов из рекламы — внедрение под ключ.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-анализ лидов из рекламы — качество заявок и отчёт';
$page_seo_description = 'Внедряем AI-агента: связываем источник заявки, диалог, квалификацию и сделку в одном отчёте. Узнайте, какая реклама реально приносит покупателей. Аудит под ключ.';

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
$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить рекламу';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = '#chto-takoe-ai-analiz-lidov';

$nero_ai_header_links = [
    ['label' => 'Почему заявки ≠ покупатели', 'href' => '#pochemu-reklama-ne-pokazyvaet-pokupateley'],
    ['label' => 'Что такое AI-анализ', 'href' => '#chto-takoe-ai-analiz-lidov'],
    ['label' => 'Как работает агент', 'href' => '#kak-ai-agent-svyazyvaet-cepochku'],
    ['label' => 'Отчёт по лидам', 'href' => '#otchet-po-kachestvu-lidov'],
    ['label' => 'Метрики', 'href' => '#analiz-zayavok-metriki'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Кому подходит', 'href' => '#komu-podhodit'],
    ['label' => 'Этапы', 'href' => '#etapy-vnedreniya'],
    ['label' => 'Стоимость', 'href' => '#skolko-stoit'],
    ['label' => 'FAQ', 'href' => '#faq'],
    ['label' => 'Проверить рекламу', 'href' => '#proverit-reklamu'],
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

$ad_banner_url   = getenv('AD_BANNER_URL') ?: '';
$ad_banner_image = getenv('AD_BANNER_IMAGE_URL') ?: '';
$ad_banner_alt   = getenv('AD_BANNER_ALT') ?: 'Партнёрский баннер';

?>

<?php nero_ai_echo_theme_styles(['nero-ai-longread-ui-compat.css']); ?>

<style>
/* Kadence reset + breadcrumbs hide */
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}
.aalr-page .nero-ai-reveal{opacity:0;transform:translateY(18px);transition:opacity .6s ease,transform .6s ease}
.aalr-page .nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
</style>

<main id="primary" class="site-main nero-ai-home-page aalr-page" role="main" tabindex="-1">

<section class="nero-ai-hero aalr-hero-lidov" id="hero" aria-labelledby="aalr-hero-title">
<style>
/* ── Hero AI-анализ лидов: самодостаточные стили (тёмная система .nero-ai-home-page) ── */
.aalr-hero-lidov {
  --aalr-cyan: #79f2ff;
  --aalr-violet: #8b5cf6;
  --aalr-green: #22c55e;
  --aalr-text: #e6edf7;
  --aalr-muted: #9aa8bd;
  --aalr-soft: #c7d2e5;
  --aalr-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.aalr-hero-lidov.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.aalr-hero-lidov::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 55% 28%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.aalr-hero-lidov::after {
  content: "";
  position: absolute;
  right: 8%;
  top: 12%;
  width: 720px;
  height: 720px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .14), transparent 66%);
  filter: blur(8px);
  animation: aalrHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes aalrHeroGlow {
  from { opacity: .4; transform: scale(.94); }
  to { opacity: .82; transform: scale(1.05); }
}
.aalr-hero-lidov .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aalr-hero-lidov .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aalr-hero-lidov .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.8vw, 72px);
  line-height: .95;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.aalr-hero-lidov .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--aalr-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aalr-hero-lidov .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--aalr-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.aalr-hero-lidov .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--aalr-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.aalr-hero-lidov .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.aalr-hero-lidov .nero-ai-badge {
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
.aalr-hero-lidov .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.aalr-hero-lidov .nero-ai-btn {
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
.aalr-hero-lidov .nero-ai-btn:hover { transform: translateY(-2px); }
.aalr-hero-lidov .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--aalr-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.aalr-hero-lidov .nero-ai-btn-secondary {
  color: var(--aalr-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.aalr-hero-lidov .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--aalr-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.aalr-hero-lidov .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.aalr-hero-lidov .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.aalr-hero-lidov .nero-ai-dots { display: flex; gap: 7px; }
.aalr-hero-lidov .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.aalr-hero-lidov .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aalr-hero-lidov .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aalr-hero-lidov .nero-ai-dot:nth-child(3) { background: #34d399; }
.aalr-hero-lidov .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.aalr-hero-lidov .nero-ai-window-body { padding: 16px; }
.aalr-hero-lidov .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.aalr-hero-lidov .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.aalr-hero-lidov .nero-ai-live-pill {
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
.aalr-hero-lidov .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: aalrPulse 1.6s infinite;
}
@keyframes aalrPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.aalr-hero-lidov .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.aalr-hero-lidov .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.aalr-hero-lidov .nero-ai-metric span {
  display: block;
  color: var(--aalr-muted);
  font-size: 11px;
  font-weight: 700;
}
.aalr-hero-lidov .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.aalr-hero-lidov .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.aalr-hero-lidov .aalr-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.14);
  background: radial-gradient(ellipse at 50% 35%, rgba(121,242,255,.09), rgba(6,10,24,.92) 72%);
}
.aalr-hero-lidov #aalr-hero-lead-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.aalr-hero-lidov .nero-ai-task-stream { display: grid; gap: 8px; }
.aalr-hero-lidov .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.aalr-hero-lidov .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--aalr-cyan);
  font-size: 13px;
  font-weight: 800;
}
.aalr-hero-lidov .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.aalr-hero-lidov .nero-ai-task span {
  color: var(--aalr-muted);
  font-size: 11px;
}
.aalr-hero-lidov .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.aalr-hero-lidov .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.aalr-hero-lidov .nero-ai-status--cyan {
  background: rgba(121,242,255,.12);
  color: #a5f3fc;
}
@media (max-width: 1100px) {
  .aalr-hero-lidov .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aalr-hero-lidov .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .aalr-hero-lidov .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .aalr-hero-lidov .nero-ai-window-body { padding: 12px; }
  .aalr-hero-lidov .nero-ai-task { grid-template-columns: 28px 1fr; }
  .aalr-hero-lidov .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Nero Network · AI-анализ лидов из рекламы</p>
      <h1 id="aalr-hero-title">AI-агент анализа лидов из рекламы: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Связываем источник заявки, диалог, квалификацию и итог сделки в одном отчёте — чтобы видеть, какая реклама реально приносит покупателей, а не дешёвые формы.</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Сквозная аналитика</li>
        <li class="nero-ai-badge">AI-скоринг лидов</li>
        <li class="nero-ai-badge">Директ · VK Ads</li>
        <li class="nero-ai-badge">Отчёт ROI</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Проверить рекламу</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#chto-takoe-ai-analiz-lidov">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-анализа лидов из рекламы">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">демо · ai-скоринг · показательные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-центр анализа лидов</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>SQL-конверсия</span>
              <strong>68%</strong>
              <small>целевые лиды</small>
            </div>
            <div class="nero-ai-metric">
              <span>CPL qualified</span>
              <strong>−62%</strong>
              <small>vs CPL form</small>
            </div>
            <div class="nero-ai-metric">
              <span>Каналов</span>
              <strong>4</strong>
              <small>в едином отчёте</small>
            </div>
            <div class="nero-ai-metric">
              <span>Мониторинг</span>
              <strong>24/7</strong>
              <small>заявки и диалоги</small>
            </div>
          </div>

          <div class="aalr-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aalr-hero-lead-canvas" role="img" aria-label="Анимация: заявки из рекламных каналов проходят AI-скоринг и связываются со сделкой в отчёте ROI"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий анализа лидов">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">VK</span>
              <div><strong>VK Ads → score 87</strong><span>Квалификация: SQL · UTM сохранён</span></div>
              <span class="nero-ai-status">SQL</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">Я</span>
              <div><strong>Директ → warm</strong><span>Диалог: бюджет уточняется</span></div>
              <span class="nero-ai-status nero-ai-status--amber">warm</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">₽</span>
              <div><strong>amoCRM → сделка</strong><span>142 000 ₽ · источник VK Ads</span></div>
              <span class="nero-ai-status">won</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">↻</span>
              <div><strong>Отчёт ROI обновлён</strong><span>CPL qualified −62% по кампании</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">live</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ====================================================
     БОРИС: КОНТЕНТНАЯ ЧАСТЬ (НЕ HERO) — вставить после hero Алины
     ==================================================== -->
<style>
/* === AALR CONTENT ROOT — dark theme, prefix aalr- === */
.aalr-content{
  --aalr-bg:#050711;--aalr-bg2:#080b17;
  --aalr-text:#e6edf7;--aalr-muted:#9aa8bd;--aalr-soft:#c7d2e5;--aalr-heading:#fff;
  --aalr-border:rgba(255,255,255,.10);
  --aalr-accent:#79f2ff;--aalr-violet:#8b5cf6;--aalr-green:#22c55e;
  --aalr-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--aalr-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.aalr-content *,.aalr-content *::before,.aalr-content *::after{box-sizing:border-box;}
.aalr-content a{color:var(--aalr-accent);}
.aalr-content p{color:var(--aalr-muted);line-height:1.72;margin:0 0 1em;}
.aalr-content p:last-child{margin-bottom:0;}
.aalr-content h2,.aalr-content h3{color:var(--aalr-heading);letter-spacing:-.04em;margin:0 0 .7em;}
.aalr-content strong{color:var(--aalr-soft);}
.aalr-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.aalr-content ul li{
  padding-left:20px;position:relative;margin-bottom:.45em;
  color:var(--aalr-muted);font-size:14.5px;line-height:1.65;
}
.aalr-content ul li::before{
  content:'›';position:absolute;left:0;color:var(--aalr-accent);font-weight:700;
}
.aalr-cnt{width:min(var(--aalr-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.aalr-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.aalr-section-alt{
  background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));
  border-top:1px solid rgba(255,255,255,.06);
  border-bottom:1px solid rgba(255,255,255,.06);
}
.aalr-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.aalr-sh.aalr-left{margin-left:0;text-align:left;}
.aalr-sh h2{font-size:clamp(26px,4vw,46px);line-height:1.08;margin-bottom:14px;}
.aalr-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.aalr-sh.aalr-left p{margin-left:0;}
.aalr-eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  padding:6px 14px;border-radius:999px;
  background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--aalr-accent);margin-bottom:14px;
}
.aalr-card{
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);
  border-radius:18px;padding:28px 26px;
  box-shadow:0 8px 32px rgba(0,0,0,.25);
}
.aalr-card h3{font-size:19px;margin-bottom:10px;}
.aalr-quote{
  border-left:3px solid var(--aalr-accent);
  padding:16px 20px;margin:24px 0;
  background:rgba(121,242,255,.04);border-radius:0 12px 12px 0;
  font-style:italic;color:var(--aalr-soft);font-size:15px;line-height:1.65;
}
.aalr-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0;}
.aalr-table{width:100%;border-collapse:collapse;font-size:14px;}
.aalr-table th{
  background:rgba(121,242,255,.08);color:var(--aalr-heading);
  padding:12px 16px;text-align:left;font-weight:700;border-bottom:1px solid rgba(255,255,255,.1);
}
.aalr-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.06);color:var(--aalr-muted);}
.aalr-table tr:hover td{background:rgba(255,255,255,.03);}
.aalr-checklist{list-style:none;padding:0;margin:20px 0;}
.aalr-checklist li{
  padding:8px 0 8px 28px;position:relative;color:var(--aalr-muted);
}
.aalr-checklist li::before{
  content:'✓';position:absolute;left:0;color:var(--aalr-green);font-weight:700;
}
.aalr-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.aalr-faq-item{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);
  border-radius:14px;overflow:hidden;
}
.aalr-faq-q{
  padding:18px 24px;cursor:pointer;font-weight:600;color:var(--aalr-heading);
  display:flex;justify-content:space-between;align-items:center;
}
.aalr-faq-q::after{content:'▼';font-size:10px;opacity:.5;transition:transform .2s;}
.aalr-faq-item.open .aalr-faq-q::after{transform:rotate(180deg);}
.aalr-faq-a{max-height:0;overflow:hidden;padding:0 24px;transition:max-height .3s,padding .3s;}
.aalr-faq-item.open .aalr-faq-a{max-height:600px;padding:0 24px 20px;}
.aalr-secondary-offer{font-size:14px;color:var(--aalr-muted);margin-top:1.2em;}
.aalr-secondary-offer a{color:var(--aalr-accent);text-decoration:underline;}
/* Intro */
.aalr-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);border-bottom:1px solid rgba(255,255,255,.06);}
.aalr-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.aalr-intro-text{position:relative;padding-left:20px;text-align:left!important;}
.aalr-intro-text::before{
  content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;
  background:linear-gradient(180deg,var(--aalr-accent),var(--aalr-violet));
}
.aalr-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.aalr-kpi-card{
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;
  padding:16px 14px;text-align:center;
}
.aalr-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--aalr-heading);margin-bottom:5px;}
.aalr-kpi-card .kl{font-size:11px;font-weight:600;color:var(--aalr-muted);line-height:1.4;}
.aalr-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
/* TOC */
.aalr-toc-outer{padding:20px 0 8px;}
.aalr-toc{
  display:flex;flex-wrap:wrap;gap:8px;justify-content:center;
}
.aalr-toc a{
  padding:8px 16px;border-radius:999px;font-size:13px;font-weight:600;
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);
  color:var(--aalr-soft);transition:background .2s;
}
.aalr-toc a:hover{background:rgba(121,242,255,.12);color:var(--aalr-accent);}
/* Timeline */
.aalr-timeline{display:flex;flex-direction:column;gap:0;}
.aalr-tl-item{position:relative;padding:0 0 28px 32px;border-left:2px solid rgba(121,242,255,.25);}
.aalr-tl-item:last-child{border-left-color:transparent;padding-bottom:0;}
.aalr-tl-dot{
  position:absolute;left:-7px;top:4px;width:12px;height:12px;border-radius:50%;
  background:var(--aalr-accent);box-shadow:0 0 12px rgba(121,242,255,.4);
}
.aalr-tl-item h3{font-size:17px;margin-bottom:6px;}
/* CTA blocks — reuse ym-cta-block from theme */
@media(max-width:900px){.aalr-intro-grid{grid-template-columns:1fr;gap:36px;}}
@media(max-width:600px){.aalr-intro-kpi{grid-template-columns:1fr 1fr;}}
</style>

<div class="aalr-content">

  <!-- INTRO -->
  <section class="aalr-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="aalr-cnt">
      <div class="aalr-intro-grid nero-ai-reveal">
        <div class="aalr-intro-text">
          <p class="aalr-eyebrow">Лонгрид · ai анализ лидов рекламы</p>
          <p><strong>Коротко:</strong> Nero Network внедряет AI-агента, который связывает рекламный источник, диалог с лидом, квалификацию и итог сделки в одном отчёте — чтобы вы видели, какая реклама приносит покупателей, а не просто формы.</p>
          <p>Performance-маркетолог показывает CPL, РОП говорит «половина лидов — мусор», владелец смотрит на выручку и не понимает, какие кампании окупаются. AI-анализ лидов закрывает разрыв между рекламным кабинетом и CRM.</p>
        </div>
        <div class="aalr-intro-kpi" aria-label="Ключевые метрики">
          <div class="aalr-kpi-card"><div class="kv">79%</div><div class="kl">лидов не доходят до продажи</div><div class="ks">MarketingSherpa</div></div>
          <div class="aalr-kpi-card"><div class="kv">87%</div><div class="kl">компаний используют AI в sales</div><div class="ks">Salesforce 2026</div></div>
          <div class="aalr-kpi-card"><div class="kv">7×</div><div class="kl">шанс квалификации при ответе за час</div><div class="ks">HBR</div></div>
          <div class="aalr-kpi-card"><div class="kv">3,7×</div><div class="kl">ниже CPL qualified vs form</div><div class="ks">кейс i-Media</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- TOC -->
  <div class="aalr-toc-outer">
    <div class="aalr-cnt">
      <nav class="aalr-toc" aria-label="Оглавление статьи">
        <a href="#pochemu-reklama-ne-pokazyvaet-pokupateley">Почему заявки ≠ покупатели</a>
        <a href="#chto-takoe-ai-analiz-lidov">Что такое AI-анализ</a>
        <a href="#kak-ai-agent-svyazyvaet-cepochku">Как работает агент</a>
        <a href="#otchet-po-kachestvu-lidov">Отчёт по лидам</a>
        <a href="#analiz-zayavok-metriki">Метрики</a>
        <a href="#integracii">Интеграции</a>
        <a href="#komu-podhodit">Кому подходит</a>
        <a href="#etapy-vnedreniya">Этапы</a>
        <a href="#skolko-stoit">Стоимость</a>
        <a href="#faq">FAQ</a>
        <a href="#proverit-reklamu">Проверить рекламу</a>
      </nav>
    </div>
  </div>

  <!-- INTERNAL-LINKS:INSERT -->

  <!-- СЕКЦИЯ 1 -->
  <section class="aalr-section" id="pochemu-reklama-ne-pokazyvaet-pokupateley">
    <div class="aalr-cnt">
      <div class="aalr-sh aalr-left">
        <span class="aalr-eyebrow">Боль бизнеса</span>
        <h2>Почему реклама даёт заявки, но не показывает, кто покупает</h2>
        <p>Рекламный бюджет растёт, заявки приходят — а отдел продаж и маркетинг спорят, кто виноват.</p>
      </div>

      <div class="aalr-card nero-ai-reveal">
        <h3>Типичная боль performance-маркетинга и отдела продаж</h3>
        <p>Классическое исследование MarketingSherpa (цит. <a href="https://rechka.ai/blog/kachestvo-lidov/" target="_blank" rel="noopener noreferrer">Rechka</a>) фиксирует: <strong>79% лидов, которые привлекает маркетинг, никогда не конвертируются в продажи</strong> — четыре из пяти заявок не доходят до сделки.</p>
        <ul>
          <li>Яндекс.Директ и VK Ads приносят заявки с разной стоимостью.</li>
          <li>Менеджеры квалифицируют «на глаз» — без единых критериев MQL/SQL.</li>
          <li>CRM фиксирует сделки, но <strong>источник рекламы теряется</strong> на этапе звонка или переписки.</li>
          <li>Маркетинг оптимизирует по дешёвой заявке, продажи жалуются на качество трафика.</li>
        </ul>
      </div>

      <div class="aalr-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Почему отчёты рекламных кабинетов не равны выручке</h3>
        <p>Рекламный кабинет видит клик, показ и конверсию «отправка формы». Он <strong>не видит</strong>: был ли лид целевым по BANT/CHAMP/MEDDIC; сколько времени менеджер тратил на «мусор»; дошёл ли контакт до SQL и оплаты; проблема в <strong>трафике</strong> или в <strong>обработке</strong>.</p>
        <p>Бенчмарк <a href="https://hbr.org/2011/03/the-short-life-of-online-sales-leads" target="_blank" rel="noopener noreferrer">Harvard Business Review</a> (2011): среднее время ответа на web-lead — <strong>42 часа</strong>, <strong>23%</strong> компаний не ответили вовсе. Контакт в первый час даёт <strong>≈7×</strong> выше шанс квалификации.</p>
        <p><strong>Итог:</strong> реклама не приносит продажи при заявках не потому, что «реклама не работает», а потому что <strong>нет связки «кампания → диалог → квалификация → сделка»</strong>.</p>
      </div>
    </div>
  </section>

  <!-- CTA-1: после «боли» -->
  <div class="aalr-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-bol">
      <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Реклама даёт заявки — но кто из них покупает?</p>
        <p class="ym-cta-block__sub">Получите <strong>Отчёт по качеству лидов</strong> — разберём 50–100 заявок и покажем, какие каналы дают покупателей, а где теряется бюджет.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Проверить рекламу</a>
      </div>
    </div>
  </div>

  <!-- СЕКЦИЯ 2 -->
  <section class="aalr-section aalr-section-alt" id="chto-takoe-ai-analiz-lidov">
    <div class="aalr-cnt">
      <div class="aalr-sh">
        <span class="aalr-eyebrow">Определение</span>
        <h2>Что такое AI-анализ лидов из рекламы</h2>
        <p><strong>AI-анализ лидов из рекламы</strong> — автоматизированный слой между рекламой, CRM и продажами, который собирает заявку с UTM/источником, анализирует диалог или звонок, квалифицирует лид и связывает результат с этапами сделки в едином отчёте.</p>
      </div>

      <div class="aalr-card nero-ai-reveal">
        <h3>Чем отличается от обычной сквозной аналитики</h3>
        <p>Классическая сквозная аналитика (Roistat, Calltouch, BI-дашборды) связывает <strong>клик → заявка → сделка</strong> по UTM и CRM. AI-анализ добавляет <strong>conversational intelligence</strong>: NLP по переписке и транскриптам, <strong>explainable score</strong>, автоматическую квалификацию по вашим критериям.</p>
        <blockquote class="aalr-quote">«The secret sauce for sales AI agents is unified data… Stand-alone agents without comprehensive customer context tend to fail.» — Adam Alfano, EVP Sales, Salesforce (<a href="https://www.salesforce.com/news/stories/state-of-sales-report-announcement-2026/" target="_blank" rel="noopener noreferrer">State of Sales 2026</a>)</blockquote>
      </div>

      <div class="aalr-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Какие данные собирает AI-агент</h3>
        <ol style="padding-left:20px;color:var(--aalr-muted);line-height:1.7;">
          <li><strong>Рекламный источник</strong> — UTM, ClientID, кампания, креатив (Яндекс.Директ, VK Ads, Google Ads).</li>
          <li><strong>Заявка и диалог</strong> — текст формы, чат, WhatsApp/Telegram, транскрипт звонка.</li>
          <li><strong>Квалификация</strong> — score, статус hot/warm/cold/spam, цитаты клиента, BANT/CHAMP/MEDDIC.</li>
          <li><strong>CRM и сделка</strong> — этапы MQL → SQL → оплата, сумма, причина отказа.</li>
        </ol>
        <p>В 2026 году Salesforce фиксирует: AI и AI-агенты — <strong>тактика №1 роста</strong> для sales-команд; <strong>87%</strong> организаций уже используют AI; <strong>94%</strong> лидеров с агентами считают их критичными для бизнеса.</p>
      </div>
    </div>
  </section>

  <!-- СЕКЦИЯ 3 -->
  <section class="aalr-section" id="kak-ai-agent-svyazyvaet-cepochku">
    <div class="aalr-cnt">
      <div class="aalr-sh aalr-left">
        <span class="aalr-eyebrow">Как работает</span>
        <h2>Как AI-агент связывает источник, диалог, квалификацию и сделку</h2>
        <p><strong>Реклама → AI-агент → CRM → сделка → отчёт → оптимизация рекламы</strong></p>
      </div>

      <div class="aalr-card nero-ai-reveal">
        <h3>Цепочка «кампания → заявка → разговор → CRM → оплата»</h3>
        <div class="aalr-timeline">
          <div class="aalr-tl-item"><div class="aalr-tl-dot"></div><h3>1. Лид с UTM/ClientID</h3><p>CRM создаёт карточку с источником.</p></div>
          <div class="aalr-tl-item"><div class="aalr-tl-dot"></div><h3>2. Webhook → AI-агент</h3><p>Анализ текста заявки, чата или транскрипта звонка.</p></div>
          <div class="aalr-tl-item"><div class="aalr-tl-dot"></div><h3>3. Score и статус</h3><p>Резюме и рекомендация пишутся в CRM.</p></div>
          <div class="aalr-tl-item"><div class="aalr-tl-dot"></div><h3>4. Handoff менеджеру</h3><p>Переговоры, КП, закрытие — за человеком.</p></div>
          <div class="aalr-tl-item"><div class="aalr-tl-dot"></div><h3>5. Статус в аналитику</h3><p>Qualified/won/lost уходит в сквозную аналитику и рекламный кабинет.</p></div>
          <div class="aalr-tl-item"><div class="aalr-tl-dot"></div><h3>6. Еженедельный отчёт</h3><p>Какие кампании дают SQL и выручку.</p></div>
        </div>
        <p style="margin-top:20px;">Кейс i-Media (<a href="https://workspace.ru/cases/kak-data-driven-podhod-i-skvoznaya-analitika-pomogli-sokratit-cpl-pochti-v-4-raza/" target="_blank" rel="noopener noreferrer">workspace.ru</a>): CPL квалифицированного лида <strong>5 165 ₽ vs 19 166 ₽</strong> (≈3,7× ниже).</p>
      </div>

      <div class="aalr-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Автоматическая квалификация и AI-скоринг лидов</h3>
        <ul>
          <li><strong>Классификация:</strong> целевой / нецелевой / спам.</li>
          <li><strong>Скоринг 0–100</strong> с тремя строками «почему такой score».</li>
          <li><strong>Human-in-the-loop:</strong> лиды с confidence &lt; 0,5 — на ручную проверку (кейс Velmi: время ответа <strong>2–3 ч → 30–40 сек</strong>, доля QUALIFIED <strong>+35%</strong>).</li>
        </ul>
        <p>Bewise (<a href="https://bewise.ai/" target="_blank" rel="noopener noreferrer">bewise.ai</a>) отделяет <strong>«слабый лид» от «слабой отработки»</strong> — снимает спор маркетинг vs продажи.</p>
      </div>
    </div>
  </section>

  <!-- ================================================
       БОРИС: CANVAS — после #kak-ai-agent-svyazyvaet-cepochku
       ================================================ -->
  <section id="aalr-boris-lead-dashboard" class="blr-root" aria-label="Схема: реклама → AI-скоринг → CRM → сделка → отчёт → оптимизация">
<style>
#aalr-boris-lead-dashboard.blr-root{padding:56px 0 64px;background:#f0f4f8;}
#aalr-boris-lead-dashboard .blr-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#aalr-boris-lead-dashboard .blr-card{
  display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;overflow:hidden;
  background:#fff;box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #aalr-boris-lead-dashboard .blr-card{grid-template-columns:1fr;min-height:auto;}
}
#aalr-boris-lead-dashboard .blr-lft{
  padding:40px 36px;display:flex;flex-direction:column;justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #aalr-boris-lead-dashboard .blr-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}
}
#aalr-boris-lead-dashboard .blr-ey{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
  color:#0891b2;margin:0 0 14px;
}
#aalr-boris-lead-dashboard .blr-ey::before{content:'';width:18px;height:2px;background:#0891b2;border-radius:1px;}
#aalr-boris-lead-dashboard .blr-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;
}
#aalr-boris-lead-dashboard .blr-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#aalr-boris-lead-dashboard .blr-ul li{
  display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;
}
#aalr-boris-lead-dashboard .blr-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;
  background:rgba(8,145,178,.1);display:flex;align-items:center;justify-content:center;
  font-size:11px;color:#0e7490;margin-top:1px;font-style:normal;
}
#aalr-boris-lead-dashboard .blr-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#aalr-boris-lead-dashboard .blr-pl{
  padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
}
#aalr-boris-lead-dashboard .blr-pl-c{background:rgba(8,145,178,.08);color:#0e7490;border:1.5px solid rgba(8,145,178,.22);}
#aalr-boris-lead-dashboard .blr-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);}
#aalr-boris-lead-dashboard .blr-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#aalr-boris-lead-dashboard .blr-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#aalr-boris-lead-dashboard .blr-rgt{
  position:relative;
  background:linear-gradient(135deg,#ecfeff 0%,#f0f9ff 28%,#ede9fe 72%,#f8fafc 100%);
  min-height:440px;overflow:hidden;
}
@media(max-width:1023px){#aalr-boris-lead-dashboard .blr-rgt{min-height:380px;}}
#blr-lead-pipeline-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>

<div class="blr-cnt">
  <div class="blr-card">
    <div class="blr-lft">
      <span class="blr-ey">Сквозная цепочка</span>
      <h3 class="blr-h3">От клика в Директе до ROI по сделке — в одном дашборде</h3>
      <ul class="blr-ul">
        <li><span class="blr-ic">1</span>Заявка с UTM попадает в CRM с привязкой к кампании</li>
        <li><span class="blr-ic">2</span>AI анализирует диалог и присваивает score 0–100 с объяснением</li>
        <li><span class="blr-ic">3</span>SQL и won/lost возвращаются в VK Ads / Директ для оптимизации</li>
        <li><span class="blr-ic">?</span>Отчёт показывает CPL form vs CPL qualified — не оптимизируйте «вслепую»</li>
      </ul>
      <div class="blr-pills">
        <span class="blr-pl blr-pl-c">CPL qualified −62%</span>
        <span class="blr-pl blr-pl-v">4 канала в отчёте</span>
        <span class="blr-pl blr-pl-g">score + объяснение</span>
      </div>
      <p class="blr-foot">Дальше — что вы увидите в отчёте по качеству лидов →</p>
    </div>
    <div class="blr-rgt">
      <canvas id="blr-lead-pipeline-canvas" aria-label="Анимация: лиды из рекламных каналов проходят AI-скоринг, попадают в CRM и формируют ROI-отчёт" role="img"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('blr-lead-pipeline-canvas');
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
    cyan:'#0891b2', cyanL:'rgba(8,145,178,.15)',
    viol:'#8b5cf6', violL:'rgba(139,92,246,.15)',
    green:'#22c55e', greenL:'rgba(34,197,94,.15)',
    orange:'#f59e0b', orangeL:'rgba(245,158,11,.15)',
    ink:'#0f172a', muted:'#64748b', line:'rgba(8,145,178,.25)',
    card:'#ffffff', cardBdr:'#cbd5e1'
  };

  var STAGES = [
    {label:'Реклама', sub:'Директ · VK', x:.12, color:C.orange},
    {label:'AI Score', sub:'0–100', x:.35, color:C.viol},
    {label:'CRM', sub:'amoCRM', x:.58, color:C.cyan},
    {label:'Отчёт ROI', sub:'дашборд', x:.82, color:C.green}
  ];

  var LEADS = [
    {ch:'VK Ads', score:87, status:'SQL', amt:'142K', delay:0, hot:true},
    {ch:'Директ', score:62, status:'warm', amt:'—', delay:90, hot:false},
    {ch:'VK Ads', score:91, status:'SQL', amt:'89K', delay:180, hot:true},
    {ch:'Директ', score:34, status:'spam', amt:'—', delay:270, hot:false},
    {ch:'Директ', score:78, status:'SQL', amt:'210K', delay:360, hot:true}
  ];
  var LOOP = 480;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawStage(s, i){
    var cx = s.x * W;
    var cy = H * 0.22;
    var bw = Math.min(90, W * 0.16);
    var bh = 52;
    rr(cx - bw/2, cy - bh/2, bw, bh, 10, C.card, s.color, 2);
    ctx.fillStyle = C.ink;
    ctx.font = 'bold 11px Inter,system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(s.label, cx, cy - 4);
    ctx.fillStyle = C.muted;
    ctx.font = '9px Inter,sans-serif';
    ctx.fillText(s.sub, cx, cy + 12);
    if(i < STAGES.length - 1){
      var nx = STAGES[i+1].x * W;
      ctx.strokeStyle = C.line;
      ctx.lineWidth = 2;
      ctx.setLineDash([4,4]);
      ctx.beginPath();
      ctx.moveTo(cx + bw/2 + 4, cy);
      ctx.lineTo(nx - bw/2 - 4, cy);
      ctx.stroke();
      ctx.setLineDash([]);
    }
  }

  function drawLead(ld, t){
    var prog = ((t - ld.delay + LOOP) % LOOP) / LOOP;
    if(prog < 0 || prog > 1) return;
    var startX = STAGES[0].x * W;
    var endX = STAGES[3].x * W;
    var x = startX + (endX - startX) * prog;
    var y = H * 0.55 + (ld.delay % 3) * 28;
    var alpha = prog < 0.05 ? prog/0.05 : prog > 0.95 ? (1-prog)/0.05 : 1;
    ctx.globalAlpha = alpha;
    var w = 100, h = 36;
    var bg = ld.hot ? C.greenL : ld.status === 'spam' ? 'rgba(239,68,68,.12)' : C.cyanL;
    var bdr = ld.hot ? C.green : ld.status === 'spam' ? '#ef4444' : C.cyan;
    rr(x - w/2, y - h/2, w, h, 8, bg, bdr, 1.5);
    ctx.fillStyle = C.ink;
    ctx.font = 'bold 9px Inter,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(ld.ch + ' · ' + ld.score, x, y - 2);
    ctx.fillStyle = C.muted;
    ctx.font = '8px Inter,sans-serif';
    ctx.fillText(ld.status + (ld.amt !== '—' ? ' · ' + ld.amt + ' ₽' : ''), x, y + 12);
    ctx.globalAlpha = 1;
  }

  function drawMetrics(t){
    var mx = W * 0.5, my = H * 0.88;
    var pulse = 0.5 + 0.5 * Math.sin(t * 0.04);
    rr(mx - 140, my - 22, 280, 44, 12, 'rgba(255,255,255,.9)', C.cyan, 1);
    ctx.fillStyle = C.ink;
    ctx.font = 'bold 11px Inter,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('CPL form 4 200 ₽  →  CPL qualified 1 580 ₽  ·  ROI +34%', mx, my + 4);
    ctx.fillStyle = 'rgba(8,145,178,' + (0.3 + pulse * 0.4) + ')';
    ctx.beginPath();
    ctx.arc(mx + 128, my, 5, 0, Math.PI * 2);
    ctx.fill();
  }

  function loop(){
    frame++;
    ctx.clearRect(0, 0, W, H);
    STAGES.forEach(drawStage);
    LEADS.forEach(function(ld){ drawLead(ld, frame); });
    drawMetrics(frame);
    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
  </section>

  <!-- СЕКЦИЯ 4 -->
  <section class="aalr-section aalr-section-alt" id="otchet-po-kachestvu-lidov">
    <div class="aalr-cnt">
      <div class="aalr-sh">
        <span class="aalr-eyebrow">Дашборд</span>
        <h2>Отчёт по качеству лидов: что вы увидите в одном дашборде</h2>
        <p>Единая картина для руководства: источник → диалог → квалификация → сделка → выручка.</p>
      </div>

      <div class="aalr-card nero-ai-reveal">
        <h3>Каналы и кампании, которые дают покупателей</h3>
        <ul>
          <li>Топ кампаний по <strong>SQL и выручке</strong>, а не по количеству форм.</li>
          <li>Сравнение каналов: Яндекс.Директ vs VK Ads — с учётом качества.</li>
          <li>AI-summary: «Кампания «Бренд-запрос» даёт 40% SQL при 15% бюджета».</li>
        </ul>
        <p>Кейс IT-Agency (<a href="https://www.it-agency.ru/projects/cases/case-wagner/" target="_blank" rel="noopener noreferrer">автодилер Wagner</a>): звонки <strong>+50%</strong>, стоимость целевого лида <strong>−50%</strong>.</p>
      </div>

      <div class="aalr-card nero-ai-reveal" style="margin-top:28px;">
        <h3>«Мусорные» заявки, стоимость квалифицированного лида, ROI по сделкам</h3>
        <div class="aalr-table-wrap">
          <table class="aalr-table">
            <thead><tr><th>Метрика</th><th>Что показывает</th><th>Зачем бизнесу</th></tr></thead>
            <tbody>
              <tr><td><strong>CPL form</strong></td><td>Стоимость заявки</td><td>Оптимизация «вслепую» — ловушка</td></tr>
              <tr><td><strong>CPL qualified</strong></td><td>Стоимость квалифицированного лида</td><td>Реальная цена контакта с потенциалом</td></tr>
              <tr><td><strong>CAC / ROMI</strong></td><td>Стоимость клиента и возврат на рекламу</td><td>Решение о бюджете</td></tr>
              <tr><td><strong>Доля мусорных лидов</strong></td><td>% спама и нецелевых</td><td>Корректировка таргетинга</td></tr>
              <tr><td><strong>Время до квалификации</strong></td><td>SLA ответа</td><td>Скорость = деньги</td></tr>
              <tr><td><strong>Конверсия лид → сделка</strong></td><td>Качество воронки end-to-end</td><td>Где теряются деньги</td></tr>
            </tbody>
          </table>
        </div>
        <p><strong>Коротко:</strong> оптимизировать рекламу по CPL form — значит покупать дешёвый мусор. AI-отчёт переводит фокус на <strong>CPL qualified и ROI по сделкам</strong>.</p>
      </div>
    </div>
  </section>

  <!-- CTA-2: после «отчёта» -->
  <div class="aalr-cnt">
    <div class="ym-cta-block ym-cta-block--dual" id="cta-otchet">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Хотите увидеть такой дашборд на своих данных?</p>
        <p class="ym-cta-block__sub">Покажем пример отчёта: канал → квалификация → сделка → выручка. Без ручных сводок в Excel.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Получить демо-отчёт</a>
          <a href="#etapy-vnedreniya" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения</a>
        </div>
      </div>
    </div>
  </div>

  <!-- СЕКЦИЯ 5 -->
  <section class="aalr-section" id="analiz-zayavok-metriki">
    <div class="aalr-cnt">
      <div class="aalr-sh aalr-left">
        <span class="aalr-eyebrow">KPI</span>
        <h2>Анализ заявок из рекламы: какие метрики считать важными</h2>
      </div>
      <div class="aalr-card nero-ai-reveal">
        <h3>Доля целевых лидов, время до квалификации, конверсия в сделку</h3>
        <ol style="padding-left:20px;color:var(--aalr-muted);line-height:1.7;">
          <li><strong>Доля целевых лидов (%)</strong> — если ниже 30%, проблема в таргетинге или лендинге.</li>
          <li><strong>Время до квалификации</strong> — от заявки до первого осмысленного контакта.</li>
          <li><strong>Конверсия лид → сделка</strong> — итоговая проверка: реклама работает только если заявки становятся выручкой.</li>
        </ol>
        <blockquote class="aalr-quote">«We used to let these leads fall to the floor like sawdust. Now, agents sweep them up and sift for gold.» — Adam Alfano, Salesforce 2026</blockquote>
      </div>
      <div class="aalr-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Сравнение каналов без ручных сводок в Excel</h3>
        <p>AI-агент сегментирует лиды по каналам: где много форм и мало сделок — пересмотр креативов; где мало форм, но высокий SQL% — масштабирование бюджета.</p>
        <p><strong>Итог:</strong> ROI рекламы по сделкам — единственная метрика, которой доверяет собственник.</p>
      </div>
    </div>
  </section>

  <!-- СЕКЦИЯ 6 -->
  <section class="aalr-section aalr-section-alt" id="integracii">
    <div class="aalr-cnt">
      <div class="aalr-sh">
        <span class="aalr-eyebrow">Стек</span>
        <h2>Интеграции: Директ, VK Ads, CRM, коллтрекинг и UTM</h2>
      </div>
      <div class="aalr-card nero-ai-reveal">
        <h3>Яндекс.Директ и VK Ads → заявки в CRM</h3>
        <ul>
          <li><strong>Яндекс.Директ:</strong> UTM, цели в Метрике, офлайн-конверсии в кабинет.</li>
          <li><strong>VK Ads:</strong> передача статусов квалификации из CRM (кейс i-Media).</li>
          <li><strong>Google Ads:</strong> аналогичная атрибуция при международных кампаниях.</li>
        </ul>
      </div>
      <div class="aalr-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="aalr-table">
          <thead><tr><th>Система</th><th>Роль в контуре</th></tr></thead>
          <tbody>
            <tr><td><strong>amoCRM / Битрикс24</strong></td><td>Хранение лида, этапы воронки, write-back score</td></tr>
            <tr><td><strong>Calltouch / CoMagic / Roistat</strong></td><td>Коллтрекинг, привязка звонка к источнику</td></tr>
            <tr><td><strong>Яндекс.Метрика</strong></td><td>ClientID, цели, сквозные сессии</td></tr>
            <tr><td><strong>Make / n8n / FastAPI</strong></td><td>Автоматизация webhook → AI → CRM</td></tr>
            <tr><td><strong>DataLens / Looker Studio</strong></td><td>BI-дашборд для руководства</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px;color:var(--aalr-muted);">Возражение «у нас уже есть Roistat»: сквозная аналитика даёт атрибуцию, AI-агент добавляет <strong>квалификацию по диалогу</strong> и <strong>explainable score</strong>.</p>
    </div>
  </section>

  <!-- INTERNAL-LINKS:INSERT -->

  <!-- СЕКЦИЯ 7 -->
  <section class="aalr-section" id="komu-podhodit">
    <div class="aalr-cnt">
      <div class="aalr-sh aalr-left">
        <span class="aalr-eyebrow">Целевая аудитория</span>
        <h2>Кому подходит внедрение AI-агента для анализа лидов</h2>
      </div>
      <div class="aalr-card nero-ai-reveal">
        <h3>B2B, услуги, отделы с платным трафиком от 30+ лидов в месяц</h3>
        <ul>
          <li>Платный трафик от 30+ заявок в месяц (Директ, VK Ads, таргет).</li>
          <li>Воронка включает квалификацию — не импульсную покупку.</li>
          <li>Маркетинг и продажи спорят о качестве лидов.</li>
          <li>CRM используется, но отчёты не связаны с рекламой.</li>
        </ul>
        <p>Отрасли: B2B-услуги, IT, недвижимость, MedTech, образование, производство с длинным циклом.</p>
      </div>
      <div class="aalr-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Когда без сквозной картины теряется бюджет на рекламу</h3>
        <ul>
          <li>CPL растёт, а выручка — нет.</li>
          <li>Менеджеры тратят часы на разбор нецелевых заявок.</li>
          <li>Бюджет перераспределяется «на ощущениях».</li>
          <li>Нет единого отчёта по качеству лидов для совета директоров.</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- СЕКЦИЯ 8 -->
  <section class="aalr-section aalr-section-alt" id="etapy-vnedreniya">
    <div class="aalr-cnt">
      <div class="aalr-sh">
        <span class="aalr-eyebrow">Внедрение</span>
        <h2>Этапы внедрения под ключ</h2>
      </div>
      <div class="aalr-card nero-ai-reveal">
        <h3>Аудит текущей воронки и источников данных (неделя 1–2)</h3>
        <p>Карта каналов, проверка UTM/ClientID/коллтрекинга, критерии MQL/SQL, выгрузка 3–6 месяцев истории.</p>
      </div>
      <div class="aalr-card nero-ai-reveal" style="margin-top:20px;">
        <h3>Настройка AI-агента, отчётов и правил квалификации (неделя 2–4)</h3>
        <p>Webhook → AI-анализ → write-back в CRM; score, пороги confidence, human-in-the-loop; дашборд «источник → квалификация → сделка → выручка».</p>
      </div>
      <div class="aalr-card nero-ai-reveal" style="margin-top:20px;">
        <h3>Запуск, обучение команды, контроль ROI (неделя 4–6)</h3>
        <p>Обучение маркетинга и РОПа, еженедельный AI-summary, сравнение CPL form vs CPL qualified, масштабирование на все каналы.</p>
        <p class="aalr-secondary-offer">На этапе запуска проводим обучение маркетинга и РОПа работе с дашбордом. Если команда хочет разобраться в автоматизации заранее — <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: $primary_cta_url); ?>" class="ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'наш Telegram-канал'); ?></a>.</p>
      </div>
      <ul class="aalr-checklist nero-ai-reveal" style="margin-top:28px;">
        <li>ICP и критерии MQL/SQL согласованы</li>
        <li>UTM-convention единая на всех формах</li>
        <li>CRM с этапами воронки и полем «источник»</li>
        <li>Коллтрекинг подключён (если есть звонки)</li>
        <li>SLA ответа зафиксирован</li>
        <li>3–6 месяцев истории лидов доступны</li>
      </ul>
    </div>
  </section>

  <!-- СЕКЦИЯ 9 -->
  <section class="aalr-section" id="skolko-stoit">
    <div class="aalr-cnt">
      <div class="aalr-sh aalr-left">
        <span class="aalr-eyebrow">ROI</span>
        <h2>Сколько стоит и когда окупается AI-анализ лидов</h2>
      </div>
      <div class="aalr-card nero-ai-reveal">
        <h3>От чего зависит бюджет внедрения</h3>
        <p>Количество каналов и интеграций, объём лидов, глубина AI (скоринг vs анализ звонков), требования 152-ФЗ. Пилот на 1–2 каналах — минимальный вход.</p>
      </div>
      <div class="aalr-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="aalr-table">
          <thead><tr><th>Кейс</th><th>Метрика</th><th>Результат</th></tr></thead>
          <tbody>
            <tr><td>i-Media + VK Ads</td><td>CPL qualified</td><td><strong>5 165 ₽ vs 19 166 ₽</strong> (≈3,7×)</td></tr>
            <tr><td>Velmi + Bitrix24</td><td>Время ответа</td><td><strong>2–3 ч → 30–40 сек</strong></td></tr>
            <tr><td>Velmi</td><td>Доля QUALIFIED</td><td><strong>+35%</strong></td></tr>
            <tr><td>IT-Agency Wagner</td><td>Стоимость целевого лида</td><td><strong>−50%</strong></td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px;">Окупаемость: если AI снижает долю мусорных лидов на 20% при бюджете 300 000 ₽/мес — это 60 000 ₽ экономии плюс ускорение горячих контактов.</p>
    </div>
  </section>

  <!-- СЕКЦИЯ 10: FAQ -->
  <section class="aalr-section aalr-section-alt" id="faq">
    <div class="aalr-cnt">
      <div class="aalr-sh">
        <span class="aalr-eyebrow">FAQ</span>
        <h2>FAQ: AI-анализ лидов и качество заявок из рекламы</h2>
      </div>
      <div class="aalr-faq nero-ai-reveal" id="aalr-faq-accordion">
        <div class="aalr-faq-item">
          <div class="aalr-faq-q" tabindex="0" role="button" aria-expanded="false">Чем AI-отчёт отличается от отчёта в рекламном кабинете?</div>
          <div class="aalr-faq-a"><p>Рекламный кабинет считает клики и конверсии формы. AI-отчёт связывает источник → диалог → квалификацию → сделку → выручку с conversational intelligence.</p></div>
        </div>
        <div class="aalr-faq-item">
          <div class="aalr-faq-q" tabindex="0" role="button" aria-expanded="false">Нужна ли CRM для запуска?</div>
          <div class="aalr-faq-a"><p>Да, amoCRM или Битрикс24 — обязательный элемент. Без CRM невозможна сквозная аналитика от заявки до оплаты.</p></div>
        </div>
        <div class="aalr-faq-item">
          <div class="aalr-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли начать с бесплатного отчёта по качеству лидов?</div>
          <div class="aalr-faq-a"><p>Да. Лид-магнит — аудит 50–100 заявок с AI-скорингом, разбивкой по каналам и рекомендациями. Пилот без обязательств.</p></div>
        </div>
        <div class="aalr-faq-item">
          <div class="aalr-faq-q" tabindex="0" role="button" aria-expanded="false">Это заменит менеджеров по продажам?</div>
          <div class="aalr-faq-a"><p>Нет. AI берёт квалификацию, скоринг и отчётность. Переговоры и закрытие сделки — за человеком.</p></div>
        </div>
        <div class="aalr-faq-item">
          <div class="aalr-faq-q" tabindex="0" role="button" aria-expanded="false">Как AI-агент соответствует 152-ФЗ?</div>
          <div class="aalr-faq-a"><p>Российские LLM (YandexGPT), on-premise или облако с договором поручения. Персональные данные — по политике клиента.</p></div>
        </div>
        <div class="aalr-faq-item">
          <div class="aalr-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько длится пилот?</div>
          <div class="aalr-faq-a"><p>4–6 недель на 1–2 канала: аудит → настройка → запуск → первый отчёт с рекомендациями.</p></div>
        </div>
        <div class="aalr-faq-item">
          <div class="aalr-faq-q" tabindex="0" role="button" aria-expanded="false">Почему реклама не приносит продажи при заявках?</div>
          <div class="aalr-faq-a"><p>Три причины: нецелевой трафик (AI покажет по score), медленная обработка (time-to-qualify), потеря атрибуции (UTM не доходит до CRM).</p></div>
        </div>
      </div>
    </div>
  </section>

  <!-- СЕКЦИЯ 11: финальный CTA -->
  <section class="aalr-section" id="proverit-reklamu">
    <div class="aalr-cnt">
      <div class="aalr-sh">
        <span class="aalr-eyebrow">Старт</span>
        <h2>Проверить рекламу — получить отчёт по качеству лидов</h2>
        <p>Реклама даёт заявки. Вопрос — <strong>какие из них покупают</strong>. Nero Network внедряет AI-агента под ключ: от аудита воронки до дашборда с ROI по сделкам.</p>
      </div>
      <div class="aalr-card nero-ai-reveal">
        <h3>Что входит в стартовый аудит</h3>
        <ul>
          <li>Диагностика UTM, CRM, коллтрекинга и SLA ответа.</li>
          <li>AI-скоринг 50–100 заявок из ваших каналов.</li>
          <li>Отчёт по качеству лидов: источник → квалификация → рекомендации.</li>
          <li>План внедрения AI-агента с оценкой ROI.</li>
        </ul>
      </div>
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final" style="margin-top:36px;">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Проверить рекламу — получить отчёт по качеству лидов</p>
          <p class="ym-cta-block__sub">AI-скоринг 50–100 заявок · разбивка по каналам · план внедрения с ROI. Лид-магнит: <strong>Отчёт по качеству лидов</strong>.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Проверить рекламу</a>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.aalr-content -->

<script>
(function(){
  var faq = document.getElementById('aalr-faq-accordion');
  if (!faq) return;
  faq.querySelectorAll('.aalr-faq-q').forEach(function(q){
    function toggle(){
      var item = q.parentElement;
      var open = item.classList.contains('open');
      faq.querySelectorAll('.aalr-faq-item').forEach(function(i){ i.classList.remove('open'); });
      if (!open) item.classList.add('open');
      q.setAttribute('aria-expanded', !open ? 'true' : 'false');
    }
    q.addEventListener('click', toggle);
    q.addEventListener('keydown', function(e){ if(e.key==='Enter'||e.key===' '){ e.preventDefault(); toggle(); }});
  });
})();
</script>

<?php if ($ad_banner_url && $ad_banner_image) : ?>
<div class="aalr-partner-banner" style="text-align:center;padding:32px 20px 48px;">
  <a href="<?php echo esc_url($ad_banner_url); ?>" target="_blank" rel="noopener noreferrer">
    <img src="<?php echo esc_url($ad_banner_image); ?>" width="970" height="90" alt="<?php echo esc_attr($ad_banner_alt); ?>" loading="lazy" decoding="async" style="max-width:100%;height:auto;border-radius:12px;box-shadow:var(--ym-shadow-sm,0 4px 24px rgba(0,0,0,.12));">
  </a>
</div>
<?php endif; ?>

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
/**
 * aalr-hero-lead-engine — Диспетчерская атрибуции лидов
 * Мир: лучи рекламных каналов → AI-скоринг → CRM → импульс ROI
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("aalr-hero-lead-canvas");
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
    outline: "#94a3b8",
    hubBase: "#1e293b",
    cyan: "#79f2ff",
    violet: "#8b5cf6",
    green: "#22c55e",
    amber: "#fbbf24",
    spam: "#fb7185",
    chipBg: "#f8fafc",
    directBlue: "#3b82f6",
    vkPurple: "#a78bfa",
    googleRed: "#f87171",
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

  function drawLeadChip(ctx, x, y, label, color) {
    ctx.save();
    ctx.translate(x, y);
    drawRR(ctx, -16, -8, 32, 16, 4, color || C.chipBg, C.outline);
    ctx.fillStyle = "#0f172a";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(label, 0, 2);
    ctx.restore();
  }

  /* Транспорт: лучи из рекламных каналов (не конвейер, не орбиты) */
  function AdChannelBeamStream() {
    this.phase = 0;
  }
  AdChannelBeamStream.prototype.draw = function (ctx) {
    this.phase = (frame * 0.03) % 1;
    var channels = [
      { sx: -175, sy: -85, color: C.directBlue, label: "Директ" },
      { sx: -165, sy: 25, color: C.vkPurple, label: "VK" },
      { sx: 175, sy: -70, color: C.googleRed, label: "GAds" }
    ];
    channels.forEach(function (ch, idx) {
      ctx.strokeStyle = ch.color.replace(")", ",0.35)").replace("rgb", "rgba").replace("#", "rgba(") || ch.color;
      if (ch.color[0] === "#") {
        ctx.strokeStyle = ch.color + "55";
      }
      ctx.lineWidth = 2;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.5;
      ctx.beginPath();
      ctx.moveTo(ch.sx, ch.sy);
      ctx.quadraticCurveTo(ch.sx * 0.35, ch.sy * 0.2, 0, -15);
      ctx.stroke();
      ctx.setLineDash([]);

      var t = (this.phase + idx * 0.28) % 1;
      var bx = ch.sx + (0 - ch.sx) * t;
      var by = ch.sy + (-15 - ch.sy) * t + Math.sin(t * Math.PI) * -12;
      drawLeadChip(ctx, bx, by, ch.label.slice(0, 3).toUpperCase(), C.chipBg);
    }, this);
  };

  /* Центральная башня ROI — вместо WebsiteTerminal */
  function RoiAttributionHub() {
    this.roiPulse = 0;
  }
  RoiAttributionHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, -48, -72, 96, 128, 10, C.hubBase, C.outline);

    /* Кольца MQL / SQL */
    [38, 28, 18].forEach(function (r, i) {
      ctx.strokeStyle = i === 0 ? "rgba(121,242,255,0.35)" : "rgba(139,92,246,0.25)";
      ctx.lineWidth = i === 0 ? 2 : 1;
      ctx.beginPath();
      ctx.arc(0, -18, r, 0, Math.PI * 2);
      ctx.stroke();
    });

    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("ROI", 0, -20);
    ctx.font = "7px Inter,sans-serif";
    ctx.fillStyle = C.cyan;
    ctx.fillText("HUB", 0, -10);

    /* Фаза INGEST */
    if (prg >= 20 && prg < 70) {
      var ingest = (prg - 20) / 50;
      ctx.fillStyle = "rgba(121,242,255," + (0.15 + ingest * 0.25) + ")";
      ctx.beginPath();
      ctx.arc(0, -18, 12 + ingest * 8, 0, Math.PI * 2);
      ctx.fill();
    }

    /* Фаза SCORE — кольцо диалога */
    if (prg >= 70 && prg < 130) {
      var scoreVal = 0.55 + ((prg - 70) / 60) * 0.35;
      drawRR(ctx, -30, 8, 60, 14, 4, "rgba(255,255,255,0.08)", C.outline);
      drawRR(ctx, -28, 10, 56 * scoreVal, 10, 3, C.green, null);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("score " + Math.round(scoreVal * 100), 0, 19);
    }

    /* Фаза ATTRIBUTE — UTM-чипы */
    if (prg >= 130 && prg < 185) {
      var tags = ["utm_source", "camp", "crm"];
      tags.forEach(function (tag, i) {
        var tx = -35 + i * 28 + Math.sin(frame * 0.06 + i) * 2;
        var ty = 35 + i * 2;
        drawRR(ctx, tx, ty, 30, 12, 3, "rgba(167,243,208,0.35)", C.outline);
        ctx.fillStyle = "#0f172a";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(tag.slice(0, 4), tx + 15, ty + 8);
      });
    }

    /* Фаза SYNC — импульс в CRM и ROI (не ракета) */
    if (prg >= 185) {
      var sync = Math.min(1, (prg - 185) / 30);
      this.roiPulse = sync;
      drawRR(ctx, -22, 52, 44, 22, 5, "rgba(34,197,94,0.28)", C.green);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("SQL ✓", 0, 64);
      ctx.font = "6px Inter,sans-serif";
      ctx.fillStyle = "#bbf7d0";
      ctx.fillText("142k ₽", 0, 72);

      ctx.strokeStyle = "rgba(34,197,94," + (0.9 - sync * 0.6) + ")";
      ctx.lineWidth = 2.5;
      ctx.beginPath();
      ctx.arc(0, 58, 18 + sync * 42, 0, Math.PI * 2);
      ctx.stroke();

      if (prg > 210 && prg < 215) {
        ctx.fillStyle = C.cyan;
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.fillText("ROI ↻", 0, -58);
      }
    }
  };

  /* Отсев мусорных лидов */
  function SpamDivertGate() {
    this.glow = 0;
  }
  SpamDivertGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, 120, 35, 34, 22, 5, "rgba(251,113,133,0.12)", C.spam);
    ctx.fillStyle = C.spam;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("SPAM", 137, 49);
    if (prg > 45 && prg < 85) {
      var sx = 90 + ((prg - 45) / 40) * 45;
      drawLeadChip(ctx, sx, 42, "junk", "rgba(251,113,133,0.35)");
    }
  };

  /* Сравнение CPL form vs qualified */
  function CplCompareGauge() {
    this.ratio = 0.38;
  }
  CplCompareGauge.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 70) this.ratio = 0.38;
    else if (prg < 185) this.ratio = 0.38 + ((prg - 70) / 115) * 0.42;
    else this.ratio = 0.8;
    drawRR(ctx, -155, -55, 52, 28, 5, "rgba(255,255,255,0.06)", C.outline);
    drawRR(ctx, -153, -35, 48, 8, 2, "rgba(251,113,133,0.5)", null);
    drawRR(ctx, -153, -45, 48 * this.ratio, 8, 2, C.green, null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("CPL Q", -153, -58);
  };

  /* Дуга обратной связи в Ads */
  function ChannelFeedbackArc() {
    this.alpha = 0;
  }
  ChannelFeedbackArc.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 200) { this.alpha = 0; return; }
    this.alpha = Math.min(1, (prg - 200) / 25);
    ctx.strokeStyle = "rgba(139,92,246," + this.alpha * 0.7 + ")";
    ctx.lineWidth = 2;
    ctx.setLineDash([3, 5]);
    ctx.beginPath();
    ctx.arc(40, -55, 55, Math.PI * 0.15, Math.PI * 1.1, false);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.fillStyle = C.violet;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("→ Ads", 95, -78);
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
    var prg = (frame * 0.038) % 260;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var targets = {
      "1_architect": { x: -95, y: 58 },
      "2_seo": { x: -35, y: 72 },
      "3_coder": { x: 35, y: 72 },
      "4_designer": { x: 95, y: 58 },
      "5_deployer": { x: 0, y: 88 }
    };
    var tgt = targets[this.role] || { x: 0, y: 70 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 24) {
      var local = prg - this.stepTrig;
      if (local < 12) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 12);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 12);
      } else if (local < 17) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 17) / 7);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 17) / 7);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 10 ? this.color : null;
    }

    if (!isMoving && frame % 230 === 0 && Math.random() < 0.14) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = Math.sin(this.timer * 1.4) * 1.1;
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
    if (carryType) drawRR(ctx, -16, -16 - bob, 12, 12, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new AdChannelBeamStream());
  entities.push(new SpamDivertGate());
  entities.push(new CplCompareGauge());
  entities.push(new RoiAttributionHub());
  entities.push(new ChannelFeedbackArc());
  entities.push(new Agent(-145, 98, C.agentYellow, "1_architect", 22, [
    "UTM-конвенция согласована", "Директ + VK в одном отчёте", "Связка реклама→CRM"
  ]));
  entities.push(new Agent(-72, 108, C.agentGreen, "2_seo", 68, [
    "Источник: VK Ads", "Кампания brand_leads", "CPL form ≠ CPL SQL"
  ]));
  entities.push(new Agent(0, 112, C.agentBlue, "3_coder", 118, [
    "webhook → score API", "BANT в structured output", "confidence 0.87"
  ]));
  entities.push(new Agent(72, 108, C.agentPink, "4_designer", 158, [
    "Дашборд ROI готов", "Канал → сделка → ₽", "Мусор vs обработка"
  ]));
  entities.push(new Agent(145, 98, C.agentPurple, "5_deployer", 198, [
    "SQL → VK Ads offline", "Статус в Директ", "Отчёт обновлён"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 240, maxLife: life || 240 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.038) % 260;
    if (prg >= 18 && prg < 18.05) createBubble(-120, -30, "1. Заявка с UTM");
    if (prg >= 72 && prg < 72.05) createBubble(-50, 5, "2. AI-скоринг диалога");
    if (prg >= 138 && prg < 138.05) createBubble(20, -5, "3. Атрибуция кампании");
    if (prg >= 192 && prg < 192.05) createBubble(55, 40, "4. SQL в CRM");
    if (prg >= 218 && prg < 218.05) createBubble(110, -25, "5. ROI в Ads");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 5, C.bubbleBg, C.cyan);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(b.text, b.x, b.y - 11);
      ctx.globalAlpha = 1;
    }

    ctx.restore();
    requestAnimationFrame(engineloop);
  }
  engineloop();
});
</script>


<script>
(function(){
  'use strict';
  var root=document.querySelector('.aalr-page');
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

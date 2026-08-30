<?php
/**
 * Template Name: AI-прогноз остатков и закупок: внедрение под ключ
 * Description: SEO-лендинг — внедрение AI-прогноза остатков, прогноз закупок и склада. Аудит 50 SKU, интеграции ERP/CRM.
 */

$page_seo_title       = 'AI-прогноз остатков под ключ — прогноз закупок и склада';
$page_seo_description = 'Внедряем AI-прогноз остатков и заявок на закупку: прогноз спроса с учётом сезонности, интеграция ERP и CRM. Бесплатный аудит 50 SKU. Снижаем дефицит и залеживание.';

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
	['label' => 'Боль',         'href' => '#bol'],
	['label' => 'Как работает', 'href' => '#chto-takoe'],
	['label' => 'Внедрение',    'href' => '#etapy'],
	['label' => 'Аудит 50 SKU', 'href' => '#audit-sku'],
	['label' => 'Цена',         'href' => '#ceny'],
	['label' => 'Кейсы',        'href' => '#keisy'],
	['label' => 'FAQ',          'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
	$nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Снизить складские потери';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);

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

.apo-hero {
  position: relative;
  min-height: 100vh;
  min-height: 100dvh;
}

.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(34,197,94,.12),rgba(139,92,246,.1));border:1px solid rgba(34,197,94,.3);text-align:center;}
.ym-cta-block--primary{background:linear-gradient(135deg,rgba(34,197,94,.14),rgba(121,242,255,.08));border-color:rgba(34,197,94,.35);}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(139,92,246,.1));border-color:rgba(34,197,94,.3);text-align:left;}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(34,197,94,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:#9aa8bd;font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--dual .ym-cta-block__sub{margin-left:0;max-width:none;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-cta-block--dual .ym-cta-block__actions{justify-content:flex-start;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,#2563eb,#7c3aed);color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:#e6edf7!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:#79f2ff!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page apo-page" role="main" tabindex="-1">

<section class="nero-ai-hero apo-hero" id="hero" aria-labelledby="apo-hero-title">
<style>
/* ── Hero ai-prognoz-ostatkov: самодостаточные стили ── */
.apo-hero {
  --apo-cyan: #79f2ff;
  --apo-green: #22c55e;
  --apo-amber: #f59e0b;
  --apo-danger: #fb7185;
  --apo-violet: #8b5cf6;
  --apo-text: #e6edf7;
  --apo-muted: #9aa8bd;
  --apo-soft: #c7d2e5;
  --apo-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.apo-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.028) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.028) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 42% 24%, #000 0%, transparent 74%);
  opacity: .58;
  pointer-events: none;
  z-index: -2;
}
.apo-hero::after {
  content: "";
  position: absolute;
  left: 6%;
  bottom: 8%;
  width: 520px;
  height: 520px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(34,197,94,.09), transparent 68%);
  filter: blur(10px);
  animation: apoHeroGlow 10s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes apoHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.06); }
}
.apo-hero .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.apo-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.apo-hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.apo-hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--apo-cyan) 40%, var(--apo-green) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.apo-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121,242,255,.22);
  border-radius: 999px;
  background: rgba(121,242,255,.08);
  color: var(--apo-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.apo-hero .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--apo-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.apo-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.apo-hero .nero-ai-badge {
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
.apo-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.apo-hero .nero-ai-btn {
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
.apo-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.apo-hero .nero-ai-btn-primary {
  color: #fff !important;
  background: linear-gradient(135deg, #2563eb, #7c3aed);
  box-shadow: 0 18px 42px rgba(59, 130, 246, 0.28);
}
.apo-hero .nero-ai-btn-secondary {
  color: var(--apo-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.apo-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--apo-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.apo-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.apo-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.apo-hero .nero-ai-dots { display: flex; gap: 7px; }
.apo-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.apo-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.apo-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.apo-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.apo-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.apo-hero .nero-ai-window-body { padding: 16px; }
.apo-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.apo-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.apo-hero .nero-ai-live-pill {
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
.apo-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: apoPulse 1.6s infinite;
}
@keyframes apoPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.apo-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.apo-hero .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.apo-hero .nero-ai-metric span {
  display: block;
  color: var(--apo-muted);
  font-size: 11px;
  font-weight: 700;
}
.apo-hero .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.apo-hero .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.apo-hero .apo-dash-canvas-wrap {
  position: relative;
  height: clamp(200px, 30vw, 280px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121,242,255,.16);
  background: radial-gradient(ellipse at 50% 40%, rgba(34,197,94,.08), rgba(6,10,24,.94) 72%);
}
.apo-hero #apo-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.apo-hero .nero-ai-task-stream { display: grid; gap: 8px; }
.apo-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.apo-hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--apo-cyan);
  font-size: 11px;
  font-weight: 800;
}
.apo-hero .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.apo-hero .nero-ai-task span {
  color: var(--apo-muted);
  font-size: 11px;
}
.apo-hero .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.apo-hero .nero-ai-status--new {
  background: rgba(121,242,255,.12);
  color: #bae6fd;
}
@media (max-width: 1100px) {
  .apo-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .apo-hero .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .apo-hero .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .apo-hero .nero-ai-window-body { padding: 12px; }
  .apo-hero .nero-ai-task { grid-template-columns: 28px 1fr; }
  .apo-hero .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai прогноз остатков</p>
      <h1 id="apo-hero-title">AI-прогноз остатков и закупок: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Прогнозируем остатки и спрос, рекомендуем закупки с учётом сезонности — снизим складские потери на ваших SKU</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Прогноз спроса</li>
        <li class="nero-ai-badge">Заявка в 1С</li>
        <li class="nero-ai-badge">Сезонность</li>
        <li class="nero-ai-badge">Аудит 50 SKU</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#audit-sku">Смотреть пример таблицы</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-прогноз остатков и закупок">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">Склад · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-прогноз остатков</h3>
            <span class="nero-ai-live-pill">обновлено сегодня</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>SKU под риском</span>
              <strong>12</strong>
              <small>дефицит / излишек</small>
            </div>
            <div class="nero-ai-metric">
              <span>Дней запаса (ср.)</span>
              <strong>18</strong>
              <small>по матрице</small>
            </div>
            <div class="nero-ai-metric">
              <span>Автозаказы</span>
              <strong>87%</strong>
              <small>без правок</small>
            </div>
            <div class="nero-ai-metric">
              <span>Прогноз 4 нед.</span>
              <strong>+14%</strong>
              <small>к базе</small>
            </div>
          </div>

          <div class="apo-dash-canvas-wrap" aria-hidden="false">
            <canvas id="apo-hero-canvas" role="img" aria-label="Анимация: SKU движутся по орбите, ML строит прогноз спроса и формирует черновик заказа в 1С"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий прогноза">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">ERP</span>
              <div><strong>Продажи / остатки</strong><span>ночной ETL из 1С</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">ML</span>
              <div><strong>Прогноз спроса</strong><span>сезонность + lead time</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">1С</span>
              <div><strong>Черновик заказа</strong><span>140 шт. · поставщик А</span></div>
              <span class="nero-ai-status nero-ai-status--new">новое</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="apo-content">

<style>
/* === APO CONTENT ROOT (не hero) === */
.apo-content{
  --apo-bg:#050711;--apo-bg2:#080b17;
  --apo-surface:rgba(255,255,255,.072);--apo-surface2:rgba(255,255,255,.108);
  --apo-text:#e6edf7;--apo-muted:#9aa8bd;--apo-soft:#c7d2e5;--apo-heading:#fff;
  --apo-border:rgba(255,255,255,.10);--apo-border-s:rgba(255,255,255,.18);
  --apo-accent:#22c55e;--apo-warn:#f59e0b;--apo-danger:#fb7185;
  --apo-violet:#8b5cf6;--apo-cyan:#79f2ff;
  --apo-r:18px;--apo-r-lg:24px;--apo-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--apo-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.apo-content *,.apo-content *::before,.apo-content *::after{box-sizing:border-box;}
.apo-content a{color:inherit;text-decoration:none;}
.apo-content a.apo-link{color:var(--apo-cyan);text-decoration:underline;text-underline-offset:3px;}
.apo-content a.apo-link:hover{color:#fff;}
.apo-content p{color:var(--apo-muted);line-height:1.72;margin:0 0 1em;}
.apo-content p:last-child{margin-bottom:0;}
.apo-content h2,.apo-content h3,.apo-content h4{color:var(--apo-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.apo-content strong{color:var(--apo-soft);}
.apo-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.apo-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--apo-muted);font-size:14.5px;line-height:1.65;}
.apo-content ul li::before{content:'›';position:absolute;left:0;color:var(--apo-accent);font-weight:700;}
.apo-cnt{width:min(var(--apo-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.apo-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.apo-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.apo-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.apo-sh.apo-left{margin-left:0;text-align:left;}
.apo-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.apo-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.apo-sh.apo-left p{margin-left:0;}
.apo-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(34,197,94,.08);border:1px solid rgba(34,197,94,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--apo-accent);margin-bottom:14px;}
.apo-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.apo-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.apo-intro-text{position:relative;padding-left:20px;}
.apo-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--apo-accent),var(--apo-violet));}
.apo-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;}
.apo-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.apo-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px);}
.apo-kpi-card .kv{font-size:clamp(18px,2.5vw,24px);font-weight:900;color:var(--apo-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.apo-kpi-card .kl{font-size:11px;font-weight:600;color:var(--apo-muted);line-height:1.4;}
.apo-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.apo-intro-grid{grid-template-columns:1fr;gap:36px;}.apo-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.apo-intro-kpi{grid-template-columns:1fr 1fr;}}
.apo-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.apo-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.apo-toc a{display:inline-block;padding:9px 18px;background:var(--apo-surface);border:1px solid var(--apo-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--apo-muted);transition:border-color .2s,color .2s,background .2s;}
.apo-toc a:hover{border-color:rgba(34,197,94,.42);color:var(--apo-accent);background:rgba(34,197,94,.08);}
.apo-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--apo-border);border-radius:var(--apo-r-lg);padding:26px;backdrop-filter:blur(16px);}
.apo-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.apo-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.apo-grid-2,.apo-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.apo-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.apo-grid-3{grid-template-columns:1fr;}}
.apo-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--apo-r);padding:26px;margin-bottom:14px;}
.apo-scenario:last-child{margin-bottom:0;}
.apo-scenario h3{font-size:17px;margin-bottom:8px;}
.apo-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.apo-table{width:100%;border-collapse:collapse;font-size:14px;}
.apo-table th{padding:13px 16px;text-align:left;background:rgba(34,197,94,.1);color:var(--apo-accent);font-weight:700;border-bottom:1px solid rgba(34,197,94,.25);white-space:nowrap;}
.apo-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--apo-text);vertical-align:top;}
.apo-table tr:last-child td{border-bottom:none;}
.apo-table tr:hover td{background:rgba(255,255,255,.03);}
.apo-defbox{border-left:3px solid var(--apo-accent);padding:18px 22px;background:rgba(34,197,94,.06);border-radius:0 14px 14px 0;margin:24px 0;}
.apo-defbox p{margin:0;color:var(--apo-soft);}
.apo-pain-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:28px;}
@media(max-width:768px){.apo-pain-grid{grid-template-columns:1fr;}}
.apo-pain-card{padding:24px;border-radius:var(--apo-r);border:1px solid var(--apo-border);}
.apo-pain-card--deficit{border-color:rgba(251,113,133,.35);background:rgba(251,113,133,.06);}
.apo-pain-card--over{border-color:rgba(245,158,11,.35);background:rgba(245,158,11,.06);}
.apo-pain-card h3{font-size:18px;margin-bottom:10px;}
.apo-layer{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:28px;}
@media(max-width:768px){.apo-layer{grid-template-columns:1fr;}}
.apo-layer-item{padding:22px;border-radius:var(--apo-r);background:rgba(255,255,255,.05);border:1px solid var(--apo-border);text-align:center;}
.apo-layer-num{display:inline-flex;width:32px;height:32px;border-radius:50%;background:rgba(34,197,94,.15);color:var(--apo-accent);font-weight:800;font-size:14px;align-items:center;justify-content:center;margin-bottom:12px;}
.apo-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;}
@media(max-width:900px){.apo-case-grid{grid-template-columns:1fr;}}
.apo-case-card{padding:22px;border-radius:var(--apo-r);background:rgba(255,255,255,.055);border:1px solid var(--apo-border);}
.apo-case-tag{display:inline-block;padding:4px 10px;border-radius:99px;font-size:11px;font-weight:700;background:rgba(34,197,94,.12);color:var(--apo-accent);margin-bottom:10px;}
.apo-faq{display:grid;gap:10px;}
.apo-faq-item{border:1px solid var(--apo-border);border-radius:14px;overflow:hidden;background:rgba(255,255,255,.04);}
.apo-faq-q{padding:18px 22px;font-weight:700;color:var(--apo-heading);cursor:pointer;}
.apo-faq-a{padding:0 22px 18px;color:var(--apo-muted);font-size:14.5px;line-height:1.65;}
.apo-status-g{color:var(--apo-accent);}
.apo-status-y{color:var(--apo-warn);}
.apo-status-r{color:var(--apo-danger);}
.apo-checklist{counter-reset:apo-li;}
.apo-checklist li{counter-increment:apo-li;}
.apo-checklist li::before{content:counter(apo-li) '.';color:var(--apo-accent);font-weight:800;}
</style>

  <!-- INTRO -->
  <section class="apo-intro apo-section" id="intro" aria-label="Введение">
    <div class="apo-cnt">
      <div class="apo-intro-grid nero-ai-reveal">
        <div class="apo-intro-text">
          <p class="apo-eyebrow">Лонгрид · ai прогноз остатков</p>
          <p>Товар заканчивается внезапно — и вы теряете выручку. Или залеживается на складе — и замораживаете оборотный капитал. <strong>AI-прогноз остатков</strong> закрывает обе боли: система прогнозирует спрос, рассчитывает потребность и формирует <strong>заявку на закупку</strong> с учётом сезонности, lead time и бизнес-ограничений.</p>
          <p><strong>Коротко:</strong> AI-прогноз остатков — замкнутый контур: данные → прогноз спроса → расчёт закупки → черновик заявки в ERP/CRM. Прогноз без заявки — дорогая аналитика, которая не снижает складские потери.</p>
        </div>
        <div class="apo-intro-kpi" aria-label="Ключевые метрики">
          <div class="apo-kpi-card"><div class="kv">$1,73 трлн</div><div class="kl">инвентарная дисторсия 2025</div><div class="ks">IHL Group</div></div>
          <div class="apo-kpi-card"><div class="kv">66%</div><div class="kl">уйдут при out-of-stock</div><div class="ks">AlixPartners</div></div>
          <div class="apo-kpi-card"><div class="kv">88% / 19%</div><div class="kl">AI в компаниях / в supply chain в масштабе</div><div class="ks">McKinsey 2025</div></div>
          <div class="apo-kpi-card"><div class="kv">50 SKU</div><div class="kl">бесплатный аудит — вход в воронку</div><div class="ks">лид-магнит</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- TOC -->
  <div class="apo-toc-outer">
    <div class="apo-cnt">
      <nav class="apo-toc" aria-label="Оглавление статьи">
        <a href="#bol">Боль</a>
        <a href="#chto-takoe">Как работает</a>
        <a href="#dannye">Данные</a>
        <a href="#etapy">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#audit-sku">Аудит 50 SKU</a>
        <a href="#ceny">Цена</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Заказать</a>
      </nav>
    </div>
  </div>

  <!-- INTERNAL-LINKS:INSERT -->

  <!-- H2-1 -->
  <section class="apo-section" id="bol">
    <div class="apo-cnt">
      <div class="apo-sh apo-left">
        <span class="apo-eyebrow">Боль клиента</span>
        <h2>Дефицит и залеживание: почему склад «не сходится» без прогноза</h2>
        <p>Склад «не сходится», когда решения о закупке принимаются по интуиции, прошлому месяцу или среднему за квартал — без учёта сезонности, промо и сроков поставки. По оценке IHL Group, глобальная инвентарная дисторсия в 2025 году достигла <strong>$1,73 трлн</strong>: out-of-stock — около <strong>$1,16 трлн</strong> (67%), overstocks — <strong>$572 млрд</strong> (33%).</p>
      </div>

      <div class="apo-pain-grid nero-ai-reveal">
        <div class="apo-pain-card apo-pain-card--deficit">
          <h3>Скрытые потери от out-of-stock</h3>
          <p><strong>66%</strong> потребителей уйдут к другому ритейлеру, если нужного товара нет на полке (AlixPartners). На маркетплейсах обнуление остатков снижает рейтинг карточки и увеличивает ДРР.</p>
        </div>
        <div class="apo-pain-card apo-pain-card--over">
          <h3>Переизбыток и залеживание</h3>
          <p>~<strong>38%</strong> запасов у SMB связаны с плохим планированием (Netstock 2024). Списания, уценки, аренда склада, замороженный капитал — накапливаются квартал за кварталом.</p>
        </div>
      </div>

      <div class="apo-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Когда Excel и «на глаз» перестают работать (50+ SKU)</h3>
        <p>До 30–50 SKU закупщик может держать ассортимент в голове. При <strong>50+ позициях</strong>, нескольких складах или каналах ручной расчёт даёт систематические ошибки. <strong>72%</strong> SMB называют вариативность lead time главным вызовом планирования. Без <strong>прогноза остатков на складе</strong> команда тратит часы на рутину вместо переговоров с поставщиками.</p>
      </div>
    </div>
  </section>

  <!-- H2-2 -->
  <section class="apo-section apo-section-alt" id="chto-takoe">
    <div class="apo-cnt">
      <div class="apo-sh">
        <span class="apo-eyebrow">Определение</span>
        <h2>Что такое AI-прогноз остатков и заявок на закупку</h2>
      </div>

      <div class="apo-defbox nero-ai-reveal">
        <p><strong>AI-прогноз остатков</strong> — система на базе ML и time-series, которая по истории продаж, остатков и поставок прогнозирует спрос и формирует рекомендации по закупкам с учётом сезонности, промо и lead time.</p>
      </div>

      <div class="apo-layer nero-ai-reveal">
        <div class="apo-layer-item">
          <div class="apo-layer-num">1</div>
          <h3>Прогноз спроса</h3>
          <p><strong>Нейросеть прогноз спроса</strong> / ML по SKU, складу, каналу; горизонт 14–42 дня.</p>
        </div>
        <div class="apo-layer-item">
          <div class="apo-layer-num">2</div>
          <h3>Расчёт потребности</h3>
          <p>Остатки, товары в пути, safety stock, reorder point, MOQ, кратность упаковки.</p>
        </div>
        <div class="apo-layer-item">
          <div class="apo-layer-num">3</div>
          <h3>Заявка на закупку</h3>
          <p>Проект заказа поставщику в 1С/ERP/CRM — менеджер утверждает, а не собирает с нуля.</p>
        </div>
      </div>

      <div class="apo-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="apo-card">
          <h3>От прогноза спроса к рекомендации закупки</h3>
          <p>Классический прогноз считает, сколько единиц продадите за N дней. Следующий шаг — перевести прогноз в заказ: вычесть остаток, добавить страховой запас, учесть срок поставки и MOQ. Именно этот мост отделяет «красивый график» от снижения складских потерь.</p>
        </div>
        <div class="apo-card">
          <h3>Чем AI-прогноз отличается от правил в ERP</h3>
          <p>Кейс «Хорошее дело»: базовый автозаказ 1С <strong>не учитывал</strong> сезонность — до <strong>5 часов в день</strong> на ручные правки. После ML-прогноза <strong>95%</strong> заказов автоматизированы, представленность — <strong>97–98%</strong>.</p>
          <p style="margin-top:12px;font-size:13px;"><strong>Важно:</strong> числовой прогноз считает <strong>ML</strong>, а не LLM. GPT/YandexGPT — для объяснений и алертов.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== БОРИС: визуальный блок (после #chto-takoe) ===== -->
  <section id="ai-prognoz-ostatkov-boris-block" class="bapo-root" aria-label="Анимация: ночной регламент AI-прогноза — от остатков на складе к заявке поставщику">
<style>
/* === БОРИС: prefix bapo-, scoped внутри #ai-prognoz-ostatkov-boris-block === */
#ai-prognoz-ostatkov-boris-block.bapo-root{padding:56px 0 64px;background:#f8fafc;}
#ai-prognoz-ostatkov-boris-block .bapo-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#ai-prognoz-ostatkov-boris-block .bapo-card{
  display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;overflow:hidden;background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-prognoz-ostatkov-boris-block .bapo-card{grid-template-columns:1fr;min-height:auto;}
}
#ai-prognoz-ostatkov-boris-block .bapo-lft{
  padding:40px 36px;display:flex;flex-direction:column;justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-prognoz-ostatkov-boris-block .bapo-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}
}
#ai-prognoz-ostatkov-boris-block .bapo-ey{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
  color:#059669;margin:0 0 14px;
}
#ai-prognoz-ostatkov-boris-block .bapo-ey::before{content:'';width:18px;height:2px;background:#059669;border-radius:1px;}
#ai-prognoz-ostatkov-boris-block .bapo-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;
}
#ai-prognoz-ostatkov-boris-block .bapo-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#ai-prognoz-ostatkov-boris-block .bapo-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#ai-prognoz-ostatkov-boris-block .bapo-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;
  background:rgba(5,150,105,.1);display:flex;align-items:center;justify-content:center;
  font-size:11px;color:#047857;margin-top:1px;font-style:normal;
}
#ai-prognoz-ostatkov-boris-block .bapo-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#ai-prognoz-ostatkov-boris-block .bapo-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
#ai-prognoz-ostatkov-boris-block .bapo-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-prognoz-ostatkov-boris-block .bapo-pl-y{background:rgba(245,158,11,.08);color:#b45309;border:1.5px solid rgba(245,158,11,.22);}
#ai-prognoz-ostatkov-boris-block .bapo-pl-b{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22);}
#ai-prognoz-ostatkov-boris-block .bapo-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#ai-prognoz-ostatkov-boris-block .bapo-rgt{
  position:relative;
  background:linear-gradient(135deg,#ecfdf5 0%,#f0fdf4 28%,#f0f9ff 72%,#f8fafc 100%);
  min-height:440px;overflow:hidden;
}
@media(max-width:1023px){#ai-prognoz-ostatkov-boris-block .bapo-rgt{min-height:380px;}}
#bapo-forecast-pipeline-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>

<div class="bapo-cnt">
  <div class="bapo-card">
    <div class="bapo-lft">
      <span class="bapo-ey">Ночной регламент · 07:20</span>
      <h3 class="bapo-h3">Остатки → ML-прогноз → черновик «Заказ поставщику» до открытия РЦ</h3>
      <ul class="bapo-ul">
        <li><span class="bapo-ic">1</span>ERP отдаёт продажи, остатки и товары в пути по каждому SKU×склад</li>
        <li><span class="bapo-ic">2</span>ML пересчитывает спрос на 14–42 дня с учётом сезонности и промо</li>
        <li><span class="bapo-ic">3</span>Движок закупок применяет safety stock, lead time, MOQ и график поставщика</li>
        <li><span class="bapo-ic">✓</span>Менеджер утверждает черновик в 1С — не считает заказ в Excel</li>
      </ul>
      <div class="bapo-pills">
        <span class="bapo-pl bapo-pl-g">95% автозаказов</span>
        <span class="bapo-pl bapo-pl-y">12 SKU под риском</span>
        <span class="bapo-pl bapo-pl-b">прогноз +14%</span>
      </div>
      <p class="bapo-foot">Дальше — минимальный набор данных для аудита 50 SKU →</p>
    </div>
    <div class="bapo-rgt">
      <canvas id="bapo-forecast-pipeline-canvas" role="img" aria-label="Анимация: полки склада, график ML-прогноза спроса и формирование заявки на закупку"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bapo-forecast-pipeline-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, t = 0;
  var LOOP = 480;

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
    ink:'#0f172a', muted:'#64748b', line:'#cbd5e1',
    shelf:'#e2e8f0', shelfBdr:'#94a3b8',
    ok:'#22c55e', warn:'#f59e0b', bad:'#fb7185',
    ml:'#8b5cf6', mlGlow:'rgba(139,92,246,.18)',
    po:'#0ea5e9', poBg:'rgba(14,165,233,.08)',
    grid:'rgba(148,163,184,.25)'
  };

  var SKUS = [
    {label:'A-1042',h:.72,col:C.warn},
    {label:'B-3301',h:.35,col:C.bad},
    {label:'C-0087',h:.58,col:C.ok},
    {label:'D-2210',h:.88,col:C.ok},
    {label:'E-5501',h:.22,col:C.bad}
  ];

  function drawShelf(x,y,w,h,sku,prog){
    ctx.fillStyle='#fff';
    ctx.strokeStyle=C.shelfBdr;
    ctx.lineWidth=1;
    roundRect(x,y,w,h,8,true,true);
    var barH = (h-36)*sku.h*prog;
    var barY = y+h-18-barH;
    ctx.fillStyle=sku.col;
    roundRect(x+10,barY,w-20,barH,4,true,false);
    ctx.fillStyle=C.ink;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(sku.label,x+w/2,y+14);
    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,sans-serif';
    ctx.fillText(Math.round(sku.h*100)+'%',x+w/2,y+h-6);
  }

  function drawForecast(cx,cy,cw,ch,phase){
    ctx.fillStyle='rgba(255,255,255,.85)';
    ctx.strokeStyle=C.line;
    ctx.lineWidth=1;
    roundRect(cx,cy,cw,ch,10,true,true);
    ctx.fillStyle=C.muted;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('ML · прогноз 4 нед.',cx+10,cy+16);
    var gx=cx+12, gy=cy+ch-18, gw=cw-24, gh=ch-36;
    ctx.strokeStyle=C.grid;
    ctx.lineWidth=.5;
    for(var i=0;i<4;i++){
      var lx=gx+gw*i/3;
      ctx.beginPath();ctx.moveTo(lx,gy-gh);ctx.lineTo(lx,gy);ctx.stroke();
    }
    ctx.beginPath();
    ctx.strokeStyle=C.ml;
    ctx.lineWidth=2.5;
    for(var j=0;j<=40;j++){
      var px=gx+gw*j/40;
      var wave=Math.sin(j*.35+phase*.08)*.12+.55+j*.008;
      var py=gy-gh*Math.min(1,wave);
      j===0?ctx.moveTo(px,py):ctx.lineTo(px,py);
    }
    ctx.stroke();
    ctx.fillStyle=C.mlGlow;
    ctx.beginPath();
    for(var k=0;k<=40;k++){
      var px2=gx+gw*k/40;
      var w2=Math.sin(k*.35+phase*.08)*.12+.55+k*.008;
      var py2=gy-gh*Math.min(1,w2);
      k===0?ctx.moveTo(px2,py2):ctx.lineTo(px2,py2);
    }
    ctx.lineTo(gx+gw,gy);ctx.lineTo(gx,gy);ctx.closePath();ctx.fill();
  }

  function drawPO(x,y,w,h,alpha){
    ctx.globalAlpha=alpha;
    ctx.fillStyle='#fff';
    ctx.strokeStyle=C.po;
    ctx.lineWidth=1.5;
    roundRect(x,y,w,h,8,true,true);
    ctx.fillStyle=C.po;
    ctx.font='bold 11px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Заказ поставщику',x+12,y+22);
    ctx.fillStyle=C.ink;
    ctx.font='9px Inter,sans-serif';
    ['SKU A-1042 · 140 шт.','SKU C-0087 · 160 шт.','Lead time 10 дн.'].forEach(function(ln,i){
      ctx.fillText(ln,x+12,y+38+i*14);
    });
    ctx.fillStyle=C.ok;
    ctx.font='bold 9px Inter,sans-serif';
    ctx.fillText('черновик в 1С',x+12,y+h-10);
    ctx.globalAlpha=1;
  }

  function roundRect(x,y,w,h,r,fill,stroke){
    ctx.beginPath();
    ctx.moveTo(x+r,y);
    ctx.arcTo(x+w,y,x+w,y+h,r);
    ctx.arcTo(x+w,y+h,x,y+h,r);
    ctx.arcTo(x,y+h,x,y,r);
    ctx.arcTo(x,y,x+w,y,r);
    ctx.closePath();
    if(fill)ctx.fill();
    if(stroke)ctx.stroke();
  }

  function drawArrow(x1,y1,x2,y2,alpha){
    ctx.globalAlpha=alpha;
    ctx.strokeStyle=C.ml;
    ctx.lineWidth=2;
    ctx.setLineDash([5,4]);
    ctx.beginPath();ctx.moveTo(x1,y1);ctx.lineTo(x2,y2);ctx.stroke();
    ctx.setLineDash([]);
  ctx.beginPath();
    var ang=Math.atan2(y2-y1,x2-x1);
    ctx.moveTo(x2,y2);
    ctx.lineTo(x2-8*Math.cos(ang-.4),y2-8*Math.sin(ang-.4));
    ctx.lineTo(x2-8*Math.cos(ang+.4),y2-8*Math.sin(ang+.4));
    ctx.closePath();ctx.fillStyle=C.ml;ctx.fill();
    ctx.globalAlpha=1;
  }

  function loop(){
    t++;
    var phase=(t%LOOP);
    ctx.clearRect(0,0,W,H);

    var pad=16;
    var shelfW=(W-pad*2)*.28;
    var shelfH=H-pad*2-20;
    var shelfX=pad;
    var shelfY=pad+10;
    var slotW=(shelfW-24)/SKUS.length;

    ctx.fillStyle=C.muted;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Склад · остатки',shelfX,shelfY-4);

    SKUS.forEach(function(sku,i){
      var prog=.6+.4*Math.sin(phase*.04+i);
      drawShelf(shelfX+8+i*(slotW+2),shelfY+8,slotW-2,shelfH-16,sku,prog);
    });

    var fx=shelfX+shelfW+pad;
    var fw=(W-fx-pad)*.52;
    var fh=shelfH;
    drawForecast(fx,shelfY,fw,fh,phase);

    var px=fx+fw+pad;
    var pw=W-px-pad;
    var poAlpha=Math.min(1,Math.max(0,(phase-120)/80));
    if(poAlpha>0) drawPO(px,shelfY+fh*.25,pw,fh*.5,poAlpha);

    var arrA=Math.min(1,Math.max(0,(phase-40)/60));
    drawArrow(shelfX+shelfW,shelfY+shelfH/2,fx,shelfY+shelfH/2,arrA);
    var arrB=Math.min(1,Math.max(0,(phase-100)/60));
    drawArrow(fx+fw,shelfY+shelfH/2,px,shelfY+shelfH/2,arrB);

    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('ERP',shelfX+shelfW/2,H-6);
    ctx.fillText('ML-прогноз',fx+fw/2,H-6);
    ctx.fillText('1С · заявка',px+pw/2,H-6);

    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
  </section>
  <!-- ===== /БОРИС ===== -->

  <!-- H2-3 -->
  <section class="apo-section" id="dannye">
    <div class="apo-cnt">
      <div class="apo-sh apo-left">
        <span class="apo-eyebrow">Данные</span>
        <h2>Какие данные нужны для точного прогноза</h2>
        <p>Качество прогноза определяется данными, а не только алгоритмом. Главный блокер масштабирования AI в supply chain — <strong>связность и чистота данных</strong>.</p>
      </div>

      <div class="apo-card nero-ai-reveal">
        <h3>Продажи, остатки, поставки, промо и календарь</h3>
        <ul>
          <li>история продаж <strong>минимум 6–12 месяцев</strong> (лучше 24) по SKU × склад/канал;</li>
          <li>текущие остатки, резервы, товары в пути;</li>
          <li>lead time по каждому поставщику;</li>
          <li>справочник номенклатуры: категория, MOQ, кратность, сезонность;</li>
          <li>календарь промо, акций, праздников;</li>
          <li>(желательно) возвраты, списания, цены.</li>
        </ul>
      </div>

      <div class="apo-card nero-ai-reveal" style="margin-top:20px;">
        <h3>Минимальный набор для старта (аудит 50 SKU)</h3>
        <p>Лид-магнит Nero Network — <strong>аудит 50 SKU</strong>: выгрузка из 1С, МойСклад или RetailCRM за 12 месяцев плюс 3–5 позиций с хроническим дефицитом и 3–5 с залежами. Результат — таблица с прогнозом, рекомендуемым заказом и флагом риска. Пилот без обязательства на полное внедрение.</p>
      </div>
    </div>
  </section>

  <!-- H2-4 + CTA-1 -->
  <section class="apo-section apo-section-alt" id="etapy">
    <div class="apo-cnt">
      <div class="apo-sh apo-left">
        <span class="apo-eyebrow">Под ключ</span>
        <h2>Внедрение AI-прогноза остатков под ключ</h2>
        <p><strong>AI прогноз остатков под ключ</strong> — проектная модель с понятными этапами. Начинаем с одного склада или категории.</p>
      </div>

      <div class="apo-table-wrap nero-ai-reveal">
        <table class="apo-table">
          <thead><tr><th>Этап</th><th>Срок</th><th>Результат</th></tr></thead>
          <tbody>
            <tr><td>0. Аудит 50 SKU</td><td>7–10 дней</td><td>Таблица рисков, оценка качества данных</td></tr>
            <tr><td>1. Data pipeline</td><td>2–3 недели</td><td>ETL: продажи, остатки, промо, lead time</td></tr>
            <tr><td>2. ML-прогноз</td><td>2–4 недели</td><td>Модели по кластерам SKU, метрики WAPE/bias</td></tr>
            <tr><td>3. Модуль заявок</td><td>2–3 недели</td><td>Черновик заказа в 1С/CRM с 10 ограничениями</td></tr>
            <tr><td>4. Оповещения</td><td>1–2 недели</td><td>Telegram/email при риске дефицита</td></tr>
            <tr><td>5. MLOps</td><td>ongoing</td><td>Переобучение, мониторинг деградации</td></tr>
          </tbody>
        </table>
      </div>

      <div class="apo-card nero-ai-reveal" style="margin-top:24px;">
        <h3>Сроки и роли команды заказчика</h3>
        <p><strong>AI прогноз остатков без программиста</strong> на стороне клиента — реалистичный сценарий: интегратор настраивает обмен, обучает модель и передаёт дашборд. От заказчика: владелец процесса закупок, доступ к выгрузкам ERP, 2–4 часа на согласование правил (MOQ, поставщики, сезонность).</p>
      </div>

      <div class="ym-cta-block ym-cta-block--primary" id="cta-etapy">
        <div class="ym-cta-block__icon" aria-hidden="true">📦</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Начните с аудита 50 SKU — без обязательств</p>
          <p class="ym-cta-block__sub">Проверим качество ваших данных, покажем риски дефицита и излишков по ассортименту и дадим прогноз закупок на 4 недели. Первые рекомендации — через 7–10 рабочих дней.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

  <!-- H2-5 -->
  <section class="apo-section" id="integracii">
    <div class="apo-cnt">
      <div class="apo-sh">
        <span class="apo-eyebrow">Интеграции</span>
        <h2>Интеграции: ERP, WMS, CRM и маркетплейсы</h2>
        <p><strong>Интеграция AI прогноз остатков</strong> — ключевой фактор ROI: прогноз должен возвращаться туда, где живут закупки.</p>
      </div>

      <!-- INTERNAL-LINKS:INSERT -->

      <div class="apo-grid-2 nero-ai-reveal">
        <div class="apo-card">
          <h3>1С, SAP и WMS — факт продаж и остатков</h3>
          <p>Кейс «Спар Миддл Волга»: ML в 1С:ERP, горизонт <strong>42 дня</strong>, ежедневное обновление. Результат: <strong>+13% выручки</strong>, <strong>+9% товарооборота</strong>, списания снижены <strong>до 1%</strong>. Подробнее — <a href="/ai-1c-erp/" class="apo-link">AI для 1С и ERP</a>.</p>
          <p>Официальный путь — <strong>«1С:Прогнозирование продаж»</strong>. Кейс «Фаско+»: точность <strong>с 58,9% до 84,4%</strong>, невыполненные заказы — <strong>с 10% до 3%</strong>.</p>
        </div>
        <div class="apo-card">
          <h3>E-commerce и маркетплейсы</h3>
          <p>Единый прогноз по WB, Ozon, Яндекс Маркету и собственному складу. Кастомное внедрение связывает API маркетплейсов с 1С — без двойного учёта остатков.</p>
          <p><strong>AI прогноз остатков в CRM</strong> (amoCRM, Bitrix24): задачи закупщику, согласование отклонений, история решений.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- H2-6 -->
  <section class="apo-section apo-section-alt" id="zakupki">
    <div class="apo-cnt">
      <div class="apo-sh apo-left">
        <span class="apo-eyebrow">Закупки</span>
        <h2>AI в закупках и supply chain: от прогноза к заявке</h2>
        <p><strong>AI закупки</strong> — логическое продолжение прогноза. <strong>Автоматизация заявок на закупку</strong> превращает цифру «продадим 120 шт.» в проект «Заказ поставщику».</p>
      </div>

      <div class="apo-grid-2 nero-ai-reveal">
        <div class="apo-card">
          <h3>Автоматические заявки с учётом сезонности</h3>
          <p>Ночной регламент: расчёт к <strong>07:20</strong> → черновики заказов → менеджер работает с отклонениями. Epsilon Metrics (30 000 позиций): MAPE <strong>11%</strong> + автозаказ с <strong>10 бизнес-ограничениями</strong>.</p>
        </div>
        <div class="apo-card">
          <h3>Safety stock и reorder point на базе ML</h3>
          <p><strong>Reorder point AI</strong> рассчитывается поверх прогноза — динамический запас с учётом волатильности спроса и lead time. Кейс Ixora: запасы <strong>−20%</strong>, излишки <strong>−33%</strong> на 35 000 SKU.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- H2-7 -->
  <section class="apo-section" id="dlya-kogo">
    <div class="apo-cnt">
      <div class="apo-sh">
        <span class="apo-eyebrow">Целевая аудитория</span>
        <h2>Для кого подходит: розница, e-commerce, опт, производство</h2>
      </div>
      <div class="apo-grid-3 nero-ai-reveal">
        <div class="apo-card">
          <h3>Розница и сеть магазинов</h3>
          <p>Отдельные модели под магазин/SKU, учёт списаний. Референсы: Spar, «Хорошее дело», «Реми» (6 менеджеров вместо 150; упущенные продажи <strong>−59%</strong>).</p>
        </div>
        <div class="apo-card">
          <h3>E-commerce и маркетплейсы</h3>
          <p>Прогноз обнуления по скорости продаж (7/14/30 дней), распределение по складам FBO, синхронизация закупок с рекламой. Горизонт 14–30 дней.</p>
        </div>
        <div class="apo-card">
          <h3>Опт и производство</h3>
          <p>Редкий и «lumpy» спрос, несколько РЦ. Ixora, СКЛ Групп (расчёт <strong>в 16 раз</strong> быстрее). Производители: прогноз сырья + готовой продукции.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- H2-8 + CTA-2 -->
  <section class="apo-section apo-section-alt" id="audit-sku">
    <div class="apo-cnt">
      <div class="apo-sh">
        <span class="apo-eyebrow">Лид-магнит</span>
        <h2>Пример на 50 SKU: таблица прогноза на странице</h2>
        <p><strong>Аудит SKU прогноз остатков</strong> — формат, который редко показывают конкуренты.</p>
      </div>

      <div class="apo-table-wrap nero-ai-reveal">
        <table class="apo-table">
          <thead>
            <tr><th>SKU</th><th>Категория</th><th>Дней запаса</th><th>Продажи/нед.</th><th>Прогноз 4 нед.</th><th>Реком. заказ</th><th>Статус</th><th>Комментарий</th></tr>
          </thead>
          <tbody>
            <tr><td>A-1042</td><td>B / XYZ</td><td>4</td><td>28 шт.</td><td>118 шт.</td><td>140 шт.</td><td class="apo-status-y">🟡</td><td>Сезонный пик через 2 нед.</td></tr>
            <tr><td>B-3301</td><td>A / stable</td><td>62</td><td>12 шт.</td><td>48 шт.</td><td>0 шт.</td><td class="apo-status-r">🔴</td><td>Излишек, заморозка ~180 тыс. ₽</td></tr>
            <tr><td>C-0087</td><td>A / seasonal</td><td>18</td><td>45 шт.</td><td>195 шт.</td><td>160 шт.</td><td class="apo-status-g">🟢</td><td>Lead time 10 дн., норма</td></tr>
          </tbody>
        </table>
      </div>

      <p class="nero-ai-reveal" style="text-align:center;max-width:720px;margin:20px auto 0;">Полный <strong>аудит 50 SKU</strong> включает ABC/XYZ-сегментацию, сравнение ML-прогноза с тем, «как закупали раньше», и оценку потенциала экономии.</p>

      <div class="ym-cta-block ym-cta-block--dual" id="cta-audit-sku">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Получите такую же таблицу по вашим SKU</p>
          <p class="ym-cta-block__sub">Выгрузите продажи и остатки из 1С или МойСклад — через 7–10 дней покажем прогноз, рекомендуемый заказ и флаги риска по 50 позициям. Команда хочет разобраться в AI до старта проекта? Смотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI'); ?></a>.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Как проходит внедрение →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- H2-9 -->
  <section class="apo-section" id="ceny">
    <div class="apo-cnt">
      <div class="apo-sh">
        <span class="apo-eyebrow">Коммерция</span>
        <h2>Сколько стоит внедрение и какой ROI ждать</h2>
      </div>

      <div class="apo-card nero-ai-reveal">
        <h3>Ориентир чека 300 тыс.–1,5 млн ₽</h3>
        <p><strong>AI прогноз остатков цена</strong> зависит от числа SKU, контуров учёта и глубины интеграции. Ориентир Nero Network: <strong>300 тыс.–1,5 млн ₽</strong> под ключ. Для сравнения: интеграторы на 1С УТ заявляют <strong>280–450 тыс. ₽</strong> (Noltis — ориентир рынка).</p>
        <p><strong>Сколько стоит AI прогноз остатков</strong> в пересчёте на ROI: «Реми» — экономия ФОТ в <strong>25 раз</strong>; Ixora — <strong>−20%</strong> запасов; Spar — <strong>+13%</strong> выручки. Cost of stockout — <strong>$1,16 трлн</strong> (IHL 2025).</p>
      </div>

      <div class="apo-card nero-ai-reveal" style="margin-top:20px;">
        <h3>Метрики контроля</h3>
        <ul>
          <li><strong>WAPE / MAPE</strong> — точность прогноза (цель: лучше «среднее за 4 недели» на 20–50%);</li>
          <li><strong>fill rate</strong> и <strong>% out-of-stock</strong> — доступность для клиента;</li>
          <li><strong>дни запаса</strong> и <strong>оборачиваемость склада</strong>;</li>
          <li><strong>% автозаказов</strong> без ручной правки (референс: 85–95%);</li>
          <li><strong>время цикла</strong> «прогноз → заявка» (СКЛ Групп: 6 складов за 30 мин).</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- H2-10 -->
  <section class="apo-section apo-section-alt" id="keisy">
    <div class="apo-cnt">
      <div class="apo-sh">
        <span class="apo-eyebrow">Доказательства</span>
        <h2>Кейсы и типовые сценарии внедрения</h2>
      </div>

      <div class="apo-case-grid nero-ai-reveal">
        <div class="apo-case-card"><div class="apo-case-tag">Ритейл</div><h3>Spar + 1С:ERP</h3><p>ML-модуль, fresh-категории. <strong>+13%</strong> выручки, <strong>+9%</strong> товарооборота, списания <strong>до 1%</strong>.</p></div>
        <div class="apo-case-card"><div class="apo-case-tag">Агроритейл</div><h3>«Хорошее дело»</h3><p>161 магазин, Datanomics. <strong>95%</strong> автозаказов, представленность <strong>97–98%</strong>.</p></div>
        <div class="apo-case-card"><div class="apo-case-tag">Опт</div><h3>Ixora + Forecast NOW!</h3><p>35 000 SKU. Запасы <strong>−20%</strong>, излишки <strong>−33%</strong> без потери продаж.</p></div>
      </div>

      <div class="apo-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="apo-table">
          <thead><tr><th>Критерий</th><th>Excel</th><th>Правила ERP</th><th>AI-прогноз</th></tr></thead>
          <tbody>
            <tr><td>Сезонность</td><td>Ручные коэффициенты</td><td>Часто нет</td><td>Автоматически</td></tr>
            <tr><td>Масштаб SKU</td><td>До ~50</td><td>Средний</td><td>Тысячи</td></tr>
            <tr><td>Заявка поставщику</td><td>Вручную</td><td>Базовый автозаказ</td><td>ML + ограничения</td></tr>
            <tr><td>Точность при промо</td><td>Низкая</td><td>Средняя</td><td>Выше на 20–50%</td></tr>
            <tr><td>Срок внедрения</td><td>—</td><td>Уже есть</td><td>4–10 нед. пилот</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- H2-11 FAQ -->
  <section class="apo-section" id="faq">
    <div class="apo-cnt">
      <div class="apo-sh">
        <span class="apo-eyebrow">FAQ</span>
        <h2>FAQ: частые вопросы перед заказом</h2>
      </div>
      <div class="apo-faq nero-ai-reveal">
        <div class="apo-faq-item"><div class="apo-faq-q">Нужны ли программисты на стороне клиента?</div><div class="apo-faq-a">Нет, в типовом сценарии. Nero Network настраивает интеграцию и передаёт дашборд. Программист нужен только при нестандартной конфигурации 1С без обмена.</div></div>
        <div class="apo-faq-item"><div class="apo-faq-q">Сколько истории продаж нужно для старта?</div><div class="apo-faq-a">Минимум <strong>6 месяцев</strong>, оптимально <strong>12–24 месяца</strong> по SKU × склад. Для новинок — правила cold start.</div></div>
        <div class="apo-faq-item"><div class="apo-faq-q">Можно ли начать с одного склада или категории?</div><div class="apo-faq-a">Да, рекомендуемый пилот — <strong>50–500 SKU</strong>, один склад или категория. Масштабирование после проверки метрик.</div></div>
        <div class="apo-faq-item"><div class="apo-faq-q">Как внедрить AI прогноз остатков в CRM?</div><div class="apo-faq-a">Прогноз и черновики идут в 1С/МойСклад; CRM получает задачи закупщику и алерты. amoCRM, Bitrix24 через API или Make/n8n.</div></div>
        <div class="apo-faq-item"><div class="apo-faq-q">Чем кастом «под ключ» отличается от SaaS?</div><div class="apo-faq-a">SaaS ограничен в кастомных ограничениях и нестандартных контурах. Кастом окупается, когда стоимость ошибки закупки выше стоимости проекта (300 тыс.–1,5 млн ₽).</div></div>
        <div class="apo-faq-item"><div class="apo-faq-q">SaaS дешевле — зачем кастом?</div><div class="apo-faq-a">SaaS не закроет нестандартные договоры, два контура учёта, связку маркетплейсы + производство.</div></div>
      </div>
    </div>
  </section>

  <!-- H2-12 -->
  <section class="apo-section apo-section-alt" id="cta">
    <div class="apo-cnt">
      <div class="apo-sh apo-left">
        <span class="apo-eyebrow">Следующий шаг</span>
        <h2>Заказать внедрение AI-прогноза остатков</h2>
        <p><strong>AI прогноз остатков заказать</strong> в Nero Network — <strong>внедрение AI в бизнес процессы</strong> закупок с измеримым результатом.</p>
      </div>

      <div class="apo-card nero-ai-reveal">
        <h3>Что входит в услугу под ключ</h3>
        <p>Аудит данных → интеграция с ERP/WMS/CRM → обучение ML-моделей → дашборд и таблица прогноза → модуль заявок на закупку → обучение команды → поддержка пилота.</p>
        <p><strong>CTA:</strong> <strong>Снизить складские потери</strong> — бесплатный <strong>аудит 50 SKU</strong>.</p>
      </div>

      <div class="apo-card nero-ai-reveal" style="margin-top:20px;">
        <h3>Что подготовить к первому созвону</h3>
        <ol class="apo-checklist" style="list-style:none;padding:0;">
          <li>Выгрузка продаж и остатков за 12 месяцев (50–100 SKU для оценки).</li>
          <li>Список систем: 1С/МойСклад/WMS, маркетплейсы, CRM.</li>
          <li>Горизонт прогноза (14, 30 или 42 дня) и приоритетные категории.</li>
          <li>Контакт ответственного за закупки.</li>
        </ol>
      </div>

      <p class="nero-ai-reveal" style="margin-top:28px;text-align:center;max-width:800px;margin-left:auto;margin-right:auto;">McKinsey: <strong>88%</strong> организаций уже используют AI, но только <strong>19%</strong> разворачивают его в supply chain в масштабе. Начните с аудита: увидите риски по своим SKU до подписания договора.</p>
    </div>
  </section>

  <!-- Финальный CTA (Артур) -->
  <section class="apo-section" style="padding-top:0;">
    <div class="apo-cnt">
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы снизить складские потери?</p>
          <p class="ym-cta-block__sub">Бесплатный аудит 50 SKU — первый шаг. Покажем риски по остаткам и спрогнозируем закупки до подписания договора на полное внедрение.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.apo-content -->


<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
/**
 * apo-hero-engine — «Диспетчерская прогноза запасов»
 * Мир: орбита SKU → башня прогноза → beacon перезаказа → черновик в 1С
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("apo-hero-canvas");
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
    scale = Math.min(cw / 420, ch / 280) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    pallet: "#cbd5e1",
    palletWarn: "#fde68a",
    palletDanger: "#fecaca",
    palletOk: "#bbf7d0",
    towerBase: "#1e293b",
    towerGlow: "#22c55e",
    curveLine: "#79f2ff",
    seasonRing: "#8b5cf6",
    heatLow: "rgba(34,197,94,0.35)",
    heatMid: "rgba(245,158,11,0.45)",
    heatHigh: "rgba(251,113,133,0.5)",
    beacon: "#f59e0b",
    erpGreen: "#22c55e",
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

  function drawPallet(ctx, x, y, color, label) {
    drawRR(ctx, x - 14, y - 10, 28, 20, 3, color, C.outline);
    drawRR(ctx, x - 10, y - 6, 20, 4, 1, "rgba(255,255,255,0.25)", null);
    if (label) {
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(label, x, y + 2);
    }
  }

  /* Тепловая сетка ячеек склада */
  function WarehouseHeatGrid() {
    this.cells = [
      [0, 1, 2, 1, 0],
      [1, 2, 3, 2, 1],
      [0, 1, 2, 3, 2],
      [1, 0, 1, 2, 1]
    ];
  }
  WarehouseHeatGrid.prototype.draw = function (ctx) {
    var startX = -88, startY = -72, cell = 18;
    for (var r = 0; r < this.cells.length; r++) {
      for (var c = 0; c < this.cells[r].length; c++) {
        var lvl = this.cells[r][c];
        var pulse = 0.85 + Math.sin(frame * 0.05 + r + c) * 0.15;
        ctx.globalAlpha = pulse;
        ctx.fillStyle = lvl === 0 ? C.heatLow : lvl === 1 ? C.heatLow : lvl === 2 ? C.heatMid : C.heatHigh;
        drawRR(ctx, startX + c * cell, startY + r * cell, cell - 3, cell - 3, 2, ctx.fillStyle, null);
      }
    }
    ctx.globalAlpha = 1;
    ctx.fillStyle = C.outline;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("остатки", startX, startY - 6);
  };

  /* Орбитальный поток SKU — вместо Conveyor */
  function SkuOrbitalTrack() {
    this.pallets = [
      { angle: 0, color: C.palletOk, label: "A12" },
      { angle: 2.1, color: C.palletWarn, label: "B33" },
      { angle: 4.2, color: C.palletDanger, label: "C87" }
    ];
  }
  SkuOrbitalTrack.prototype.draw = function (ctx) {
    var rx = 95, ry = 42;
    ctx.strokeStyle = "rgba(121,242,255,0.18)";
    ctx.lineWidth = 1.2;
    ctx.setLineDash([4, 6]);
    ctx.beginPath();
    ctx.ellipse(0, 8, rx, ry, 0, 0, Math.PI * 2);
    ctx.stroke();
    ctx.setLineDash([]);

    this.pallets.forEach(function (p) {
      var a = p.angle + frame * 0.018;
      var px = Math.cos(a) * rx;
      var py = 8 + Math.sin(a) * ry;
      drawPallet(ctx, px, py, p.color, p.label);
    });
  };

  /* Сезонное кольцо вокруг башни */
  function SeasonalityRing() {
    this.rot = 0;
  }
  SeasonalityRing.prototype.draw = function (ctx) {
    this.rot += 0.008;
    ctx.save();
    ctx.translate(0, -18);
    ctx.rotate(this.rot);
    ctx.strokeStyle = "rgba(139,92,246,0.55)";
    ctx.lineWidth = 2;
    ctx.setLineDash([6, 8]);
    ctx.beginPath();
    ctx.arc(0, 0, 52, 0, Math.PI * 2);
    ctx.stroke();
    ctx.setLineDash([]);
    for (var i = 0; i < 4; i++) {
      var a = (Math.PI / 2) * i;
      ctx.fillStyle = C.seasonRing;
      ctx.beginPath();
      ctx.arc(Math.cos(a) * 52, Math.sin(a) * 52, 3, 0, Math.PI * 2);
      ctx.fill();
    }
    ctx.restore();
  };

  /* Индикатор страхового запаса */
  function SafetyStockGauge() {
    this.level = 0.62;
  }
  SafetyStockGauge.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 220;
    if (prg > 40 && prg < 120) {
      this.level = 0.45 + Math.sin(frame * 0.04) * 0.12;
    }
    drawRR(ctx, 118, -18, 10, 56, 4, "rgba(30,41,59,0.7)", C.outline);
    var h = 48 * this.level;
    drawRR(ctx, 120, 34 - h, 6, h, 2, C.towerGlow, null);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("SS", 114, -24);
  };

  /* Маяк точки перезаказа */
  function ReorderBeacon() {
    this.blink = 0;
  }
  ReorderBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 220;
    if (prg < 130 || prg > 185) return;
    this.blink = 0.5 + Math.sin(frame * 0.2) * 0.5;
    ctx.save();
    ctx.globalAlpha = this.blink;
    ctx.fillStyle = C.beacon;
    ctx.beginPath();
    ctx.moveTo(-108, 42);
    ctx.lineTo(-98, 28);
    ctx.lineTo(-88, 42);
    ctx.closePath();
    ctx.fill();
    ctx.globalAlpha = 1;
    ctx.fillStyle = "#fde68a";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("ROP", -98, 52);
    ctx.restore();
  };

  /* Башня прогноза — вместо WebsiteTerminal */
  function ForecastCommandTower() {
    this.curvePhase = 0;
    this.poPulse = 0;
  }
  ForecastCommandTower.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 220;
    drawRR(ctx, -38, -62, 76, 108, 10, C.towerBase, C.outline);

    ctx.fillStyle = C.curveLine;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("ML прогноз", 0, -52);

    /* Кривая спроса */
    ctx.strokeStyle = C.curveLine;
    ctx.lineWidth = 2;
    ctx.beginPath();
    for (var i = 0; i <= 40; i++) {
      var t = i / 40;
      var x = -28 + t * 56;
      var y = 10 - Math.sin(t * Math.PI * 1.4 + frame * 0.03) * 22 - t * 8;
      if (i === 0) ctx.moveTo(x, y);
      else ctx.lineTo(x, y);
    }
    ctx.stroke();

    /* Фаза 1: ingest */
    if (prg < 55) {
      ctx.fillStyle = "rgba(121,242,255,0.75)";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("данные ERP", 0, 28);
    }
    /* Фаза 2: forecast */
    if (prg >= 55 && prg < 130) {
      ctx.fillStyle = "#c4b5fd";
      ctx.fillText("сезонность", 0, 28);
    }
    /* Фаза 3: PO draft */
    if (prg >= 130) {
      var pop = Math.min(1, (prg - 130) / 20);
      ctx.globalAlpha = pop;
      drawRR(ctx, -30, 36, 60, 22, 5, "rgba(34,197,94,0.2)", C.erpGreen);
      ctx.fillStyle = C.erpGreen;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("Заказ 140 шт.", 0, 50);
      ctx.globalAlpha = 1;
    }
    /* Финал: импульс в 1С */
    if (prg >= 185) {
      var burst = (prg - 185) / 25;
      ctx.strokeStyle = "rgba(34,197,94," + (1 - burst) + ")";
      ctx.lineWidth = 3;
      ctx.beginPath();
      ctx.arc(0, 46, 8 + burst * 40, 0, Math.PI * 2);
      ctx.stroke();
    }
  };

  var bubbles = [];
  function createBubble(x, y, text) {
    bubbles.push({ x: x, y: y, text: text, life: 0, max: 95 });
  }

  function Agent(role, color, dialogs) {
    this.role = role;
    this.color = color;
    this.dialogs = dialogs;
    this.x = -120 + Math.random() * 40;
    this.y = 55;
    this.targetX = this.x;
    this.targetY = this.y;
    this.dir = 1;
    this.bubble = "";
    this.bubbleTimer = Math.random() * 180;
    this.step = 0;
  }
  Agent.prototype.setTarget = function (tx, ty) {
    this.targetX = tx;
    this.targetY = ty;
  };
  Agent.prototype.update = function () {
    var dx = this.targetX - this.x;
    var dy = this.targetY - this.y;
    var dist = Math.sqrt(dx * dx + dy * dy);
    if (dist > 2) {
      this.x += (dx / dist) * 0.55;
      this.y += (dy / dist) * 0.55;
      this.dir = dx >= 0 ? 1 : -1;
    }
    this.bubbleTimer--;
    if (this.bubbleTimer <= 0) {
      this.bubble = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
      this.bubbleTimer = 140 + Math.random() * 100;
    }
  };
  Agent.prototype.draw = function (ctx) {
    ctx.save();
    ctx.translate(this.x, this.y);
    ctx.scale(this.dir, 1);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -8, 5, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillRect(-3, -3, 6, 10);
    ctx.fillRect(-4, 7, 3, 5);
    ctx.fillRect(1, 7, 3, 5);
    ctx.restore();
    if (this.bubble) {
      ctx.fillStyle = C.bubbleBg;
      ctx.strokeStyle = C.outline;
      ctx.font = "bold 6px Inter,sans-serif";
      var tw = ctx.measureText(this.bubble).width;
      drawRR(ctx, this.x - tw / 2 - 4, this.y - 28, tw + 8, 12, 3, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.textAlign = "center";
      ctx.fillText(this.bubble, this.x, this.y - 19);
    }
  };

  var agents = [
    new Agent("1_architect", C.agentYellow, [
      "ABC по обороту",
      "чистим справочник SKU",
      "lead time в норме?"
    ]),
    new Agent("2_analyst", C.agentGreen, [
      "12 SKU в зоне риска",
      "излишек B-3301",
      "дни запаса < 7"
    ]),
    new Agent("3_forecaster", C.agentBlue, [
      "пик через 2 недели",
      "WAPE лучше Excel",
      "сезонность учтена"
    ]),
    new Agent("4_buyer", C.agentPink, [
      "MOQ 120 — ок",
      "заказ поставщику А",
      "страховой запас +8%"
    ]),
    new Agent("5_deployer", C.agentPurple, [
      "черновик в 1С",
      "human-in-the-loop",
      "утвердить заказ?"
    ])
  ];

  var heat = new WarehouseHeatGrid();
  var orbit = new SkuOrbitalTrack();
  var season = new SeasonalityRing();
  var gauge = new SafetyStockGauge();
  var beacon = new ReorderBeacon();
  var tower = new ForecastCommandTower();
  var stepTrig = 0;

  function engineLoop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    heat.draw(ctx);
    orbit.draw(ctx);
    season.draw(ctx);
    gauge.draw(ctx);
    tower.draw(ctx);
    beacon.draw(ctx);

    var prg = (frame * 0.035) % 220;
    if (prg > 20 && stepTrig !== 1) {
      createBubble(-70, -40, "ETL: продажи загружены");
      stepTrig = 1;
    }
    if (prg > 70 && stepTrig !== 2) {
      createBubble(10, -70, "ML: +14% к базе");
      stepTrig = 2;
    }
    if (prg > 140 && stepTrig !== 3) {
      createBubble(-95, 30, "ROP: заказ 140 шт.");
      stepTrig = 3;
    }
    if (prg > 190 && stepTrig !== 4) {
      createBubble(0, 60, "1С: черновик готов");
      stepTrig = 4;
    }
    if (prg < 5) stepTrig = 0;

    var targets = [
      [-75, 45],
      [-55, -50],
      [5, -55],
      [-100, 38],
      [45, 50]
    ];
    if (prg < 60) {
      agents[0].setTarget(targets[0][0], targets[0][1]);
      agents[1].setTarget(targets[1][0], targets[1][1]);
    } else if (prg < 130) {
      agents[2].setTarget(targets[2][0], targets[2][1]);
      agents[3].setTarget(targets[3][0], targets[3][1]);
    } else {
      agents[4].setTarget(targets[4][0], targets[4][1]);
      agents[0].setTarget(-120, 60);
      agents[1].setTarget(-60, -58);
    }

    agents.forEach(function (a) { a.update(); a.draw(ctx); });

    bubbles = bubbles.filter(function (b) {
      b.life++;
      b.y -= 0.25;
      var alpha = 1 - b.life / b.max;
      if (alpha <= 0) return false;
      ctx.globalAlpha = alpha;
      ctx.fillStyle = C.bubbleBg;
      ctx.strokeStyle = C.curveLine;
      ctx.font = "bold 6px Inter,sans-serif";
      var tw = ctx.measureText(b.text).width;
      drawRR(ctx, b.x - tw / 2 - 4, b.y - 8, tw + 8, 12, 3, C.bubbleBg, C.curveLine);
      ctx.fillStyle = C.bubbleText;
      ctx.textAlign = "center";
      ctx.fillText(b.text, b.x, b.y);
      ctx.globalAlpha = 1;
      return true;
    });

    ctx.restore();
    requestAnimationFrame(engineLoop);
  }
  engineLoop();
});
</script>


<script>
(function(){
  'use strict';
  var root = document.querySelector('.apo-page') || document.querySelector('.apo-content');
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

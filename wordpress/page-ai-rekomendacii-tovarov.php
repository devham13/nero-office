<?php
/**
 * Template Name: AI-рекомендации товаров: внедрение под ключ
 * Description: SEO-лендинг — внедрение AI-рекомендаций для e-commerce. Персонализация, похожие товары, умная выдача. Аудит выдачи бесплатно.
 */

$page_seo_title       = 'AI-рекомендации товаров для сайта — внедрение под ключ';
$page_seo_description = 'Внедрим AI-рекомендации товаров на сайт интернет-магазина: персональные блоки, похожие товары и умная выдача каталога. Аудит выдачи, интеграция с CMS и CRM, рост конверсии.';

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
    ['label' => 'Проблема', 'href' => '#nerellevantnaya-vydacha'],
    ['label' => 'Решение', 'href' => '#chto-takoe-ai-rekomendacii'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie-pod-klyuch'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Повысить конверсию';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Консультация по архитектуре';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#vnedrenie-pod-klyuch';

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

.aireco-hero-reco{
  min-height:100vh;min-height:100dvh;position:relative;
}

.art-toc-outer{padding:0 0 clamp(24px,4vw,40px);}
.art-toc,.ym-toc.art-toc{
  display:flex;flex-wrap:wrap;gap:10px;justify-content:center;
  max-width:960px;margin:0 auto;
}
.art-toc a,.ym-toc.art-toc a{
  display:inline-flex;align-items:center;padding:10px 16px;
  border-radius:999px;font-size:13px;font-weight:700;
  color:#c7d2e5!important;text-decoration:none!important;
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);
  transition:background .2s,border-color .2s,transform .2s;
}
.art-toc a:hover,.ym-toc.art-toc a:hover{
  background:rgba(121,242,255,.12);border-color:rgba(121,242,255,.35);
  transform:translateY(-1px);
}

.ym-cta-block{
  border-radius:20px;padding:36px 40px;margin:32px 0;
  background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));
  border:1px solid rgba(121,242,255,.3);text-align:center;
}
.ym-cta-block--dual{
  background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));
  border-color:rgba(34,197,94,.3);
}
.ym-cta-block--footer-final{
  background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));
  border-color:rgba(139,92,246,.3);
}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{
  font-size:clamp(20px,2.8vw,28px);font-weight:800;
  color:#fff;margin:0 0 10px;
}
.ym-cta-block__sub{
  color:#9aa8bd;font-size:15px;
  margin:0 auto 22px;max-width:600px;line-height:1.7;
}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{
  display:inline-flex;align-items:center;justify-content:center;
  padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;
  text-decoration:none!important;transition:transform .2s,box-shadow .2s;
}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{
  background:linear-gradient(135deg,#2563eb,#7c3aed);color:#fff!important;
  box-shadow:0 8px 32px rgba(59,130,246,.35);
}
.art-content .ym-link--accent{color:#79f2ff!important;font-weight:700;}

.nero-ai-reveal{
  opacity:0;transform:translateY(22px);
  transition:opacity .55s ease,transform .55s ease;
}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
.nero-ai-delay-3{transition-delay:.36s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-rekomendacii-tovarov-page" role="main" tabindex="-1">

<section class="nero-ai-hero aireco-hero-reco" id="aireco-hero-reco" aria-labelledby="aireco-hero-title">
<style>
/* ── Hero ai-rekomendacii-tovarov: самодостаточные стили ── */
.aireco-hero-reco {
  --reco-orange: #f97316;
  --reco-violet: #8b5cf6;
  --reco-cyan: #38bdf8;
  --reco-green: #22c55e;
  --reco-text: #e6edf7;
  --reco-muted: #9aa8bd;
  --reco-soft: #c7d2e5;
  --reco-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.aireco-hero-reco::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 32% 24%, #000 0%, transparent 74%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.aireco-hero-reco::after {
  content: "";
  position: absolute;
  left: 6%;
  bottom: 8%;
  width: 560px;
  height: 560px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .14), transparent 66%);
  filter: blur(10px);
  animation: airecoHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes airecoHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.06); }
}
.aireco-hero-reco .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aireco-hero-reco .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aireco-hero-reco .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.aireco-hero-reco .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--reco-orange) 38%, var(--reco-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aireco-hero-reco .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(249, 115, 22, 0.24);
  border-radius: 999px;
  background: rgba(249, 115, 22, 0.08);
  color: #fdba74 !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.aireco-hero-reco .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--reco-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.aireco-hero-reco .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.aireco-hero-reco .nero-ai-badge {
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
.aireco-hero-reco .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.aireco-hero-reco .nero-ai-btn {
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
.aireco-hero-reco .nero-ai-btn:hover { transform: translateY(-2px); }
.aireco-hero-reco .nero-ai-btn-primary {
  color: #1a0a00 !important;
  background: linear-gradient(135deg, var(--reco-orange), #fde68a);
  box-shadow: 0 18px 42px rgba(249, 115, 22, 0.24);
}
.aireco-hero-reco .nero-ai-btn-secondary {
  color: var(--reco-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.aireco-hero-reco .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--reco-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.aireco-hero-reco .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.aireco-hero-reco .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.aireco-hero-reco .nero-ai-dots { display: flex; gap: 7px; }
.aireco-hero-reco .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.aireco-hero-reco .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aireco-hero-reco .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aireco-hero-reco .nero-ai-dot:nth-child(3) { background: #34d399; }
.aireco-hero-reco .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.aireco-hero-reco .nero-ai-window-body { padding: 16px; }
.aireco-hero-reco .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.aireco-hero-reco .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.aireco-hero-reco .nero-ai-live-pill {
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
.aireco-hero-reco .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: airecoPulse 1.6s infinite;
}
@keyframes airecoPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.aireco-hero-reco .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.aireco-hero-reco .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.aireco-hero-reco .nero-ai-metric span {
  display: block;
  color: var(--reco-muted);
  font-size: 11px;
  font-weight: 700;
}
.aireco-hero-reco .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.aireco-hero-reco .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.aireco-hero-reco .aireco-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(139, 92, 246, 0.22);
  background: radial-gradient(ellipse at 55% 40%, rgba(249,115,22,.08), rgba(6,10,24,.94) 72%);
}
.aireco-hero-reco #aireco-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.aireco-hero-reco .nero-ai-task-stream { display: grid; gap: 8px; }
.aireco-hero-reco .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.aireco-hero-reco .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(249,115,22,.14);
  color: #fdba74;
  font-size: 11px;
  font-weight: 800;
}
.aireco-hero-reco .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.aireco-hero-reco .nero-ai-task span {
  color: var(--reco-muted);
  font-size: 11px;
}
.aireco-hero-reco .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.aireco-hero-reco .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.aireco-hero-reco .nero-ai-status--violet {
  background: rgba(139,92,246,.14);
  color: #ddd6fe;
}
@media (max-width: 1100px) {
  .aireco-hero-reco .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aireco-hero-reco .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .aireco-hero-reco .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .aireco-hero-reco .nero-ai-window-body { padding: 12px; }
  .aireco-hero-reco .nero-ai-task { grid-template-columns: 28px 1fr; }
  .aireco-hero-reco .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Nero Network · ai рекомендации e-commerce</p>
      <h1 id="aireco-hero-title">AI-рекомендации товаров: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Персональные блоки «Рекомендуем», похожие товары и умная выдача каталога — чтобы посетитель не уходил из‑за нерелевантных позиций</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Персонализация</li>
        <li class="nero-ai-badge">Похожие товары</li>
        <li class="nero-ai-badge">Умная выдача</li>
        <li class="nero-ai-badge">A/B-тесты</li>
        <li class="nero-ai-badge">CMS+CRM</li>
        <li class="nero-ai-badge">Корзина и поиск</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#audit-vydachi">Бесплатный аудит выдачи</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация рекомендательного центра e-commerce">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Рекомендательный центр e-commerce</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>CTR блока</span>
              <strong>12,4%</strong>
              <small>«Похожие» на PDP</small>
            </div>
            <div class="nero-ai-metric">
              <span>Конверсия корзины</span>
              <strong>+18%</strong>
              <small>после допродажи</small>
            </div>
            <div class="nero-ai-metric">
              <span>Средний чек</span>
              <strong>+8%</strong>
              <small>cross-sell</small>
            </div>
            <div class="nero-ai-metric">
              <span>Доля выручки</span>
              <strong>19,6%</strong>
              <small>через рекомендации</small>
            </div>
          </div>

          <div class="aireco-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aireco-hero-canvas" role="img" aria-label="Анимация: поведенческие сигналы проходят скоринг, витрина пересортировывает товары и выдаёт персональный виджет"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий рекомендаций">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">👁</span>
              <div><strong>Просмотр SKU #4821</strong><span>кроссовки 42 → intent-сигнал в поток</span></div>
              <span class="nero-ai-status">собрано</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">⚡</span>
              <div><strong>Гибридный скоринг</strong><span>CF + content-based → rerank 0.94</span></div>
              <span class="nero-ai-status nero-ai-status--violet">скоринг</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">📦</span>
              <div><strong>Виджет «Похожие»</strong><span>4 SKU на карточке · API 142 мс</span></div>
              <span class="nero-ai-status">отдано</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">A/B</span>
              <div><strong>Тест блока в корзине</strong><span>вариант B +22% CTR vs контроль</span></div>
              <span class="nero-ai-status nero-ai-status--amber">раскатка</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ОБЁРТКА ТЕЛА СТАТЬИ (после hero Алины, внутри main) -->
<div class="art-content" id="art-longread">

<style>
/* === ART: тело лонгрида ai-rekomendacii-tovarov === */
.art-content{
  --art-bg:#050711;--art-bg2:#080b17;--art-text:#e6edf7;--art-muted:#9aa8bd;
  --art-soft:#c7d2e5;--art-heading:#fff;--art-accent:#79f2ff;--art-violet:#8b5cf6;
  --art-green:#22c55e;--art-border:rgba(255,255,255,.10);--art-r:18px;
  --art-container:1160px;
  background:linear-gradient(180deg,#050711 0%,#080b17 50%,#050711 100%);
  color:var(--art-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.art-content *,.art-content *::before,.art-content *::after{box-sizing:border-box;}
.art-content a{color:var(--art-accent);text-decoration:none;}
.art-content a:hover{text-decoration:underline;}
.art-content p{color:var(--art-muted);line-height:1.72;margin:0 0 1em;font-size:15px;}
.art-content p:last-child{margin-bottom:0;}
.art-content h2,.art-content h3,.art-content h4{color:var(--art-heading);letter-spacing:-.04em;margin:0 0 .65em;}
.art-content h2{font-size:clamp(24px,3.6vw,42px);line-height:1.08;}
.art-content h3{font-size:clamp(17px,2vw,22px);}
.art-content strong{color:var(--art-soft);}
.art-content ul,.art-content ol{padding-left:0;list-style:none;margin:0 0 1em;}
.art-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--art-muted);font-size:14.5px;line-height:1.65;}
.art-content ul li::before{content:'›';position:absolute;left:0;color:var(--art-accent);font-weight:700;}
.art-cnt{width:min(var(--art-container),calc(100% - 40px));margin:0 auto;}
.art-section{padding:clamp(56px,7vw,96px) 0;}
.art-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.art-sh{max-width:820px;margin:0 auto 40px;}
.art-sh.art-left{margin-left:0;}
.art-sh p{font-size:clamp(15px,1.5vw,17px);}
.art-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--art-accent);margin-bottom:14px;}
.art-intro{padding:clamp(36px,5vw,64px) 0;border-bottom:1px solid rgba(255,255,255,.06);}
.art-intro-grid{display:grid;grid-template-columns:1fr 300px;gap:48px;align-items:start;}
.art-intro-text{padding-left:18px;border-left:3px solid var(--art-accent);}
.art-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.art-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:14px;text-align:center;}
.art-kpi-card .kv{font-size:clamp(18px,2.2vw,24px);font-weight:900;color:var(--art-heading);}
.art-kpi-card .kl{font-size:11px;color:var(--art-muted);line-height:1.4;}
@media(max-width:900px){.art-intro-grid{grid-template-columns:1fr;}}
.art-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:var(--art-r);padding:24px;margin-bottom:20px;}
.art-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.art-table{width:100%;border-collapse:collapse;font-size:13.5px;}
.art-table th{padding:12px 14px;text-align:left;background:rgba(121,242,255,.1);color:var(--art-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.art-table td{padding:11px 14px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--art-text);vertical-align:top;}
.art-table tr:last-child td{border-bottom:none;}
.art-table tr:hover td{background:rgba(255,255,255,.03);}
.art-checklist li::before{content:'☐';color:var(--art-accent);}
.art-compliance{border-left:4px solid var(--art-violet);background:rgba(139,92,246,.06);padding:28px;border-radius:0 var(--art-r) var(--art-r) 0;}
.art-compliance-icon{font-size:28px;margin-bottom:12px;}
.art-faq details{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:14px;margin-bottom:10px;padding:0;}
.art-faq summary{cursor:pointer;padding:18px 20px;font-weight:700;color:var(--art-heading);list-style:none;}
.art-faq summary::-webkit-details-marker{display:none;}
.art-faq details[open] summary{border-bottom:1px solid rgba(255,255,255,.08);}
.art-faq .art-faq-body{padding:0 20px 18px;}
</style>

  <!-- INTRO -->
  <section class="art-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="art-cnt">
      <div class="art-intro-grid nero-ai-reveal">
        <div class="art-intro-text">
          <p class="art-eyebrow">Лонгрид · ai рекомендации товаров</p>
          <p><strong>Коротко:</strong> AI-рекомендации товаров — это алгоритмы и виджеты, которые подбирают позиции под конкретного посетителя или контекст страницы: «Похожие», «С этим покупают», персональная лента, умная сортировка каталога. Nero Network внедряет рекомендательную систему для сайта под ключ: от аудита товарной выдачи до A/B-тестов и интеграции с CMS, CRM и аналитикой.</p>
        </div>
        <div class="art-intro-kpi" aria-label="Ключевые метрики персонализации">
          <div class="art-kpi-card"><div class="kv">71%</div><div class="kl">ожидают персонализацию</div></div>
          <div class="art-kpi-card"><div class="kv">5–15%</div><div class="kl">прирост выручки</div></div>
          <div class="art-kpi-card"><div class="kv">30%</div><div class="kl">выручки через reco</div></div>
          <div class="art-kpi-card"><div class="kv">&lt;200 мс</div><div class="kl">отдача виджета</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- TOC -->
  <div class="art-toc-outer">
    <div class="art-cnt">
      <nav class="ym-toc art-toc" aria-label="Оглавление статьи">
        <a href="#nerellevantnaya-vydacha">Проблема</a>
        <a href="#chto-takoe-ai-rekomendacii">Решение</a>
        <a href="#vnedrenie-pod-klyuch">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <!-- H2-1: Почему теряет выручку -->
  <section class="art-section" id="nerellevantnaya-vydacha">
    <div class="art-cnt">
      <div class="art-sh art-left">
        <span class="art-eyebrow">Проблема e-commerce</span>
        <h2>Почему интернет-магазин теряет выручку из‑за нерелевантной выдачи</h2>
        <p><strong>Определение:</strong> нерелевантная выдача товаров — ситуация, когда посетитель видит позиции, не связанные с его запросом, историей просмотров или содержимым корзины.</p>
      </div>
      <div class="nero-ai-reveal">
        
        <p>Рекомендательная выдача слабеет, когда данные о клиенте размазаны по CRM, почте и учётной системе без единого профиля. Соседний сценарий — <a href="/vnedrenie-ai-amocrm/">внедрение AI-агента в amoCRM под ключ</a>: автоматизация сделок и задач даёт сигналы для персонализации витрины.</p>
        <p>По данным McKinsey, <strong>71%</strong> потребителей ожидают персонализацию, а <strong>76%</strong> разочарованы, когда её нет. Персонализация в топ-квартиле компаний даёт прирост выручки <strong>5–15%</strong>, в отдельных кейсах — до <strong>25%</strong>. В 2025–2026 крупные маркетплейсы России живут в режиме персонализированных витрин: <strong>69%</strong> онлайн-покупок приходится на e-commerce (Sostav), к 2026 прогноз — <strong>73%</strong>. При этом <strong>99%</strong> маркетплейсов внедрили AI-рекомендации, тогда как у малых селлеров продвинутая аналитика есть лишь у <strong>~20%</strong> (Sber Developers).</p>

        <div class="art-card" id="mertvyj-katalog">
          <h3>Как «мёртвый» каталог убивает конверсию и средний чек</h3>
          <p>Типичные симптомы «мёртвого» каталога:</p>
          <ul>
            <li>на главной — одни и те же позиции для всех посетителей;</li>
            <li>в карточке блок «Похожие» показывает товары из другой категории;</li>
            <li>в поиске выдача не учитывает поведение в сессии;</li>
            <li>в корзине нет допродажи — клиент уходит с одной позицией;</li>
            <li>пустая корзина не предлагает альтернатив.</li>
          </ul>
          <p>Кросс-селл в момент покупки способен поднять средний чек на <strong>20–30%</strong> (Sber Developers). Без персонализации интернет-магазина эти деньги остаются на столе.</p>
        </div>

        <div class="art-card" id="chto-vidit-pokupatel">
          <h3>Что видит покупатель вместо персональных рекомендаций</h3>
          <p>Покупатель приходит с конкретным намерением, но часто видит сортировку «по популярности», ручные подборки раз в квартал, «похожие по категории» вместо смысла и пустой поиск без альтернатив.</p>
          <p>У Ozon <strong>9 из 10</strong> пользователей ежедневно смотрят разделы с персональными рекомендациями; <strong>~половина покупателей</strong> переходит на карточки из рекомендаций (пресс-служба Ozon, 2025). Wildberries использует WildBERT для сессионной персонализации в реальном времени (Habr). Ваш сайт конкурирует с этим ожиданием.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA-1 Артура -->
  <div class="art-cnt">
    <aside class="ym-cta-block ym-cta-block--primary" id="cta-audit-vydachi">
      <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Аудит товарной выдачи — бесплатно</p>
        <p class="ym-cta-block__sub">Покажем, где каталог теряет конверсию: какие блоки рекомендаций не работают, какой CTR у виджетов и что мешает персонализации. Карта потерь и план пилота — без обязательств.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </aside>
  </div>

  <!-- H2-2: Что такое AI-рекомендации -->
  <section class="art-section art-section-alt" id="chto-takoe-ai-rekomendacii">
    <div class="art-cnt">
      <div class="art-sh art-left">
        <span class="art-eyebrow">Решение</span>
        <h2>Что такое AI-рекомендательная система для сайта</h2>
        <p><strong>Определение:</strong> рекомендательная система для сайта — набор алгоритмов, данных и виджетов, которые автоматически подбирают товары под посетителя или контекст страницы. AI добавляет ML, нейросети и LLM-эмбеддинги для семантики, холодного старта и ранжирования.</p>
      </div>

      <div class="art-card nero-ai-reveal" id="bloki-i-vydacha">
        <h3>Персональные блоки, похожие товары и умная сортировка каталога</h3>
        <div class="art-table-wrap">
          <table class="art-table ym-table">
            <thead><tr><th>Зона сайта</th><th>Блок</th><th>Задача</th></tr></thead>
            <tbody>
              <tr><td>Главная</td><td>«Рекомендуем вам», «Недавно смотрели»</td><td>Вернуть в сессию, показать релевантное</td></tr>
              <tr><td>Категория</td><td>Умная сортировка каталога</td><td>Поднять конверсионные SKU вверх</td></tr>
              <tr><td>Карточка (PDP)</td><td>«Похожие», «С этим покупают»</td><td>Cross-sell, удержание</td></tr>
              <tr><td>Корзина</td><td>Допродажа, «Не забудьте»</td><td>Рост среднего чека</td></tr>
              <tr><td>Пустая корзина</td><td>Альтернативы, хиты сегмента</td><td>Снизить отказ</td></tr>
              <tr><td>Поиск</td><td>«Специально для вас»</td><td>CTR в поиске</td></tr>
              <tr><td>404 / пустой поиск</td><td>«Вам может подойти»</td><td>Удержать трафик</td></tr>
              <tr><td>Email / мессенджер</td><td>Триггерные подборки</td><td>Омниканал</td></tr>
            </tbody>
          </table>
        </div>
        <p>По Online Store News (2026), лучшее размещение рекомендаций смещается в <strong>корзину и drawer</strong>: CTR на <strong>22–34%</strong> выше, чем у карусели только на карточке.</p>
        <p>Омниканальные триггерные подборки в email и мессенджерах опираются на тот же профиль покупателя. Параллельно можно настроить <a href="/vnedrenie-ai-obrabotka-email-crm/">AI-обработку входящей почты в CRM</a>, чтобы входящие обращения не терялись до попадания в рекомендательный контур.</p>
      </div>

      <div class="art-card nero-ai-reveal nero-ai-delay-1" id="algoritmy">
        <h3>Collaborative filtering, content-based и гибридные модели — простым языком</h3>
        <div class="art-table-wrap">
          <table class="art-table ym-table">
            <thead><tr><th>Подход</th><th>Как работает</th><th>Плюсы</th><th>Минусы</th><th>Когда выбирать</th></tr></thead>
            <tbody>
              <tr><td><strong>Collaborative filtering</strong></td><td>«Покупатели, похожие на вас, брали вот это»</td><td>Сильная персонализация при данных</td><td>Нужны заказы; холодный старт</td><td>От ~500–1000 заказов</td></tr>
              <tr><td><strong>Content-based</strong></td><td>По атрибутам: бренд, категория, эмбеддинги</td><td>Работает без истории покупок</td><td>Слабее персонализация</td><td>Новый магазин, длинный хвост</td></tr>
              <tr><td><strong>Гибрид + reranking</strong></td><td>Кандидаты из моделей → ML-ранжирование</td><td>Баланс точности и охвата</td><td>Сложнее внедрение</td><td>Fashion, electronics</td></tr>
              <tr><td><strong>LLM / эмбеддинги</strong></td><td>Семантика описаний, intent из текста</td><td>Холодный старт, «похожие по смыслу»</td><td>Стоимость инференса</td><td>Бедные атрибуты</td></tr>
            </tbody>
          </table>
        </div>
        <p><strong>Lamoda</strong> (Habr): реранкер для «похожих» дал <strong>+1,5%</strong> к покупкам. <strong>Shopee TreeBridge</strong> (AAAI 2026): <strong>+1,55% GMV</strong>. Для большинства магазинов оптимален <strong>гибрид</strong> — поведение + атрибуты + reranking.</p>
      </div>
    </div>
  </section>

  <!-- ===== БОРИС: визуальный блок (вставка после H2-2) ===== -->
  <section id="ai-rekomendacii-tovarov-boris-block" class="bar-root" aria-label="Анимация: события покупателя проходят скоринг и превращаются в персональные рекомендации на витрине">
<style>
/* === БОРИС: prefix bar-, scoped внутри #ai-rekomendacii-tovarov-boris-block === */
#ai-rekomendacii-tovarov-boris-block.bar-root{padding:56px 0 64px;background:#f0f4fb;}
#ai-rekomendacii-tovarov-boris-block .bar-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#ai-rekomendacii-tovarov-boris-block .bar-card{
  display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;overflow:hidden;background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.1),0 0 0 1px rgba(99,102,241,.12);
  min-height:480px;
}
@media(max-width:1023px){#ai-rekomendacii-tovarov-boris-block .bar-card{grid-template-columns:1fr;min-height:auto;}}
#ai-rekomendacii-tovarov-boris-block .bar-lft{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0;}
@media(max-width:1023px){#ai-rekomendacii-tovarov-boris-block .bar-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}}
#ai-rekomendacii-tovarov-boris-block .bar-ey{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#6366f1;margin:0 0 14px;}
#ai-rekomendacii-tovarov-boris-block .bar-ey::before{content:'';width:18px;height:2px;background:#6366f1;border-radius:1px;}
#ai-rekomendacii-tovarov-boris-block .bar-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;}
#ai-rekomendacii-tovarov-boris-block .bar-ul{list-style:none;margin:0 0 20px;padding:0;display:flex;flex-direction:column;gap:9px;}
#ai-rekomendacii-tovarov-boris-block .bar-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#ai-rekomendacii-tovarov-boris-block .bar-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(99,102,241,.1);display:flex;align-items:center;justify-content:center;font-size:11px;color:#6366f1;font-style:normal;}
#ai-rekomendacii-tovarov-boris-block .bar-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:16px;}
#ai-rekomendacii-tovarov-boris-block .bar-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;}
#ai-rekomendacii-tovarov-boris-block .bar-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-rekomendacii-tovarov-boris-block .bar-pl-b{background:rgba(99,102,241,.08);color:#4338ca;border:1.5px solid rgba(99,102,241,.22);}
#ai-rekomendacii-tovarov-boris-block .bar-pl-c{background:rgba(6,182,212,.08);color:#0e7490;border:1.5px solid rgba(6,182,212,.22);}
#ai-rekomendacii-tovarov-boris-block .bar-foot{font-size:13.5px;color:#64748b;font-style:italic;margin:0;}
#ai-rekomendacii-tovarov-boris-block .bar-rgt{background:linear-gradient(145deg,#07091a 0%,#0d1224 55%,#090d1f 100%);position:relative;overflow:hidden;min-height:400px;}
@media(max-width:1023px){#ai-rekomendacii-tovarov-boris-block .bar-rgt{min-height:360px;}}
#art-reco-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="bar-cnt">
  <div class="bar-card">
    <div class="bar-lft">
      <span class="bar-ey">Как работает ранжирование</span>
      <h3 class="bar-h3">От клика до виджета «Рекомендуем» — за 200 миллисекунд</h3>
      <ul class="bar-ul">
        <li><span class="bar-ic">1</span>События сессии: просмотр, корзина, поиск → профиль покупателя</li>
        <li><span class="bar-ic">2</span>Кандидатогенерация: похожие + co-purchase + атрибуты</li>
        <li><span class="bar-ic">3</span>ML-скоринг 0–1: reranking с учётом остатков и маржи</li>
        <li><span class="bar-ic">4</span>Виджет на витрине: «Похожие», корзина, персональная лента</li>
      </ul>
      <div class="bar-pills">
        <span class="bar-pl bar-pl-g">CTR +22–34% в корзине</span>
        <span class="bar-pl bar-pl-c">&lt;200 мс API</span>
        <span class="bar-pl bar-pl-b">гибрид CF + content</span>
      </div>
      <p class="bar-foot">Дальше — что входит во внедрение AI-рекомендаций под ключ →</p>
    </div>
    <div class="bar-rgt">
      <canvas id="art-reco-canvas" role="img" aria-label="Анимация пайплайна рекомендаций: события покупателя, скоринг кандидатов и появление виджетов на витрине магазина"></canvas>
    </div>
  </div>
</div>
<script>
(function(){
  var cv=document.getElementById('art-reco-canvas');
  if(!cv)return;
  var ctx=cv.getContext('2d'),W=0,H=0,fr=0;
  function resize(){
    var p=cv.parentElement;if(!p)return;
    cv.width=p.clientWidth||640;cv.height=p.clientHeight||480;
    W=cv.width;H=cv.height;
  }
  window.addEventListener('resize',resize);resize();
  var C={ink:'#e2e8f0',muted:'rgba(226,232,240,.45)',green:'#4ade80',blue:'#60a5fa',viol:'#a78bfa',orange:'#fb923c',card:'rgba(255,255,255,.07)',bdr:'rgba(255,255,255,.12)',scan:'#22d3ee'};
  var EVENTS=[{lbl:'view',clr:C.blue,delay:0},{lbl:'cart',clr:C.orange,delay:90},{lbl:'search',clr:C.viol,delay:180},{lbl:'view',clr:C.blue,delay:270}];
  var PRODUCTS=['SKU-A','SKU-B','SKU-C','SKU-D','SKU-E'];
  var LOOP=560;
  function rr(x,y,w,h,r,f,s,lw){ctx.beginPath();if(ctx.roundRect)ctx.roundRect(x,y,w,h,r);else ctx.rect(x,y,w,h);if(f){ctx.fillStyle=f;ctx.fill();}if(s){ctx.strokeStyle=s;ctx.lineWidth=lw||1.5;ctx.stroke();}}
  function drawEvents(t){
    var ex=16,ey=H*0.22;
    ctx.fillStyle=C.ink;ctx.font='bold 11px Inter,sans-serif';ctx.textAlign='left';
    ctx.fillText('События сессии',ex,ey-10);
    EVENTS.forEach(function(ev,i){
      var lt=(t-ev.delay+LOOP)%LOOP;
      if(lt>LOOP-60)return;
      var prog=Math.min(1,lt/120);
      var y=ey+28+i*36;
      var x=ex+prog*(W*0.28);
      ctx.globalAlpha=prog<0.9?prog:1-(lt-100)/20;
      rr(x,y,52,26,8,ev.clr+'22',ev.clr+'66',1.5);
      ctx.fillStyle=ev.clr;ctx.font='bold 10px Inter,sans-serif';ctx.textAlign='center';
      ctx.fillText(ev.lbl,x+26,y+17);
      ctx.globalAlpha=1;
    });
  }
  function drawScorer(t,pulse){
    var sx=W*0.38,sy=H*0.18,sw=W*0.24,sh=H*0.52;
    rr(sx,sy,sw,sh,12,C.card,C.bdr,1.5);
    ctx.fillStyle=C.scan;ctx.font='bold 11px Inter,sans-serif';ctx.textAlign='center';
    ctx.fillText('AI Scoring',sx+sw/2,sy+20);
    PRODUCTS.forEach(function(p,i){
      var barW=(sw-24)/PRODUCTS.length-4;
      var bx=sx+12+i*(barW+4);
      var phase=(t*0.04+i*0.7)%1;
      var bh=(sh-50)*phase;
      rr(bx,sy+sh-18-bh,barW,bh,4,C.viol+'cc',null,0);
      ctx.fillStyle=C.muted;ctx.font='8px Inter,sans-serif';ctx.textAlign='center';
      ctx.fillText(p,bx+barW/2,sy+sh-6);
    });
    var ring=8+Math.sin(pulse*0.08)*3;
    ctx.beginPath();ctx.arc(sx+sw/2,sy+sh/2,ring,0,Math.PI*2);
    ctx.strokeStyle='rgba(34,211,238,.5)';ctx.lineWidth=2;ctx.stroke();
  }
  function drawStorefront(t){
    var fx=W*0.68,fy=H*0.14,fw=W-fx-14,fh=H*0.72;
    rr(fx,fy,fw,fh,10,C.card,C.bdr,1.5);
    ctx.fillStyle=C.ink;ctx.font='bold 11px Inter,sans-serif';ctx.textAlign='left';
    ctx.fillText('Витрина · виджеты',fx+12,fy+22);
    var cols=2,cellW=(fw-28)/cols,cellH=52;
    for(var r=0;r<3;r++)for(var c=0;c<cols;c++){
      var cx=fx+12+c*(cellW+4),cy=fy+32+r*(cellH+6);
      var idx=r*cols+c;
      var lit=(t*0.03+idx*0.4)%1>0.35;
      rr(cx,cy,cellW,cellH,6,lit?'rgba(74,222,128,.15)':'rgba(255,255,255,.04)',lit?C.green+'55':C.bdr,1);
      if(lit&&idx<3){
        ctx.fillStyle=C.green;ctx.font='bold 9px Inter,sans-serif';ctx.textAlign='center';
        ctx.fillText('★ reco',cx+cellW/2,cy+cellH/2+3);
      }
    }
    var wy=fy+fh-44;
    rr(fx+10,wy,fw-20,32,8,'rgba(251,146,60,.12)',C.orange+'44',1);
    ctx.fillStyle=C.orange;ctx.font='bold 10px Inter,sans-serif';ctx.textAlign='center';
    ctx.fillText('С этим покупают → +AOV',fx+fw/2,wy+20);
  }
  function drawFlows(t){
    ctx.setLineDash([5,5]);ctx.strokeStyle='rgba(96,165,250,.35)';ctx.lineWidth=1.5;
    ctx.beginPath();ctx.moveTo(W*0.22,H*0.35);ctx.lineTo(W*0.38,H*0.4);ctx.stroke();
    ctx.strokeStyle='rgba(167,139,250,.35)';
    ctx.beginPath();ctx.moveTo(W*0.62,H*0.45);ctx.lineTo(W*0.68,H*0.45);ctx.stroke();
    ctx.setLineDash([]);
  }
  function loop(){fr++;var t=fr%LOOP;ctx.clearRect(0,0,W,H);drawEvents(t);drawScorer(t,fr);drawStorefront(t);drawFlows(t);
    ctx.fillStyle=C.muted;ctx.font='10px Inter,sans-serif';ctx.textAlign='left';ctx.fillText('события',14,H-10);
    ctx.textAlign='center';ctx.fillText('скоринг',W*0.5,H-10);ctx.textAlign='right';ctx.fillText('виджеты',W-14,H-10);
    requestAnimationFrame(loop);}
  loop();
})();
</script>
  </section>

  <!-- H2-3: Внедрение под ключ -->
  <section class="art-section" id="vnedrenie-pod-klyuch">
    <div class="art-cnt">
      <div class="art-sh art-left">
        <span class="art-eyebrow">Услуга Nero Network</span>
        <h2>Что входит во внедрение AI-рекомендаций товаров под ключ</h2>
        <p><strong>Определение:</strong> проект от аудита текущей выдачи до запущенных виджетов, интеграций и измеримого результата в Метрике/GA4.</p>
      </div>

      <div class="art-card nero-ai-reveal" id="audit-vydachi">
        <h3>Аудит товарной выдачи и данных каталога</h3>
        <p>Первый этап — <strong>аудит товарной выдачи</strong> (лид-магнит). Проверяем карту страниц, метрики CTR/CR, качество фида, события аналитики, объём данных (минимум <strong>500–1000 заказов</strong> для collaborative filtering).</p>
        <p><strong>Чек-лист фида перед запуском:</strong></p>
        <ul class="art-checklist">
          <li>YML/CSV фид обновляется 1–4 раза в сутки</li>
          <li>Остатки в realtime или не чаще 15 минут</li>
          <li>Нет «битых» категорий и пустых описаний</li>
          <li>События ecommerce настроены и проверены</li>
          <li>Правила: что не рекомендовать (нет в наличии, 18+)</li>
        </ul>
      </div>

      <div class="art-card nero-ai-reveal nero-ai-delay-1" id="scenarii">
        <h3>Проектирование сценариев: главная, карточка, корзина, пустой поиск</h3>
        <p>Фиксируем сценарии: главная (персональная лента), PDP («Похожие» + co-purchase), корзина (допродажа), пустая корзина (альтернативы), поиск, post-purchase email.</p>
        <p><strong>Логика системы:</strong> сбор событий → обогащение профиля → генерация кандидатов → ранжирование → отдача виджета &lt;200 мс → логирование для A/B.</p>
      </div>

      <div class="art-card nero-ai-reveal nero-ai-delay-2" id="ab-testy">
        <h3>Настройка, интеграция и запуск A/B-тестов</h3>
        <div class="art-table-wrap">
          <table class="art-table ym-table">
            <thead><tr><th>Этап</th><th>Срок</th><th>Результат</th></tr></thead>
            <tbody>
              <tr><td>Аудит выдачи и фида</td><td>1–2 недели</td><td>Карта потерь, ТЗ на блоки</td></tr>
              <tr><td>Пилот (SaaS или кастом)</td><td>2–4 недели</td><td>3–5 блоков на ключевых страницах</td></tr>
              <tr><td>A/B-тест</td><td>3–4 недели</td><td>Прирост CTR/CR</td></tr>
              <tr><td>Масштабирование</td><td>2–6 недель</td><td>Все сценарии + омниканал</td></tr>
              <tr><td>Compliance</td><td>параллельно</td><td>152-ФЗ, 149-ФЗ ст. 10.2-2</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA-2 Артура -->
  <div class="art-cnt">
    <aside class="ym-cta-block ym-cta-block--dual" id="cta-vnedrenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Заказать внедрение AI-рекомендаций под ключ</p>
        <p class="ym-cta-block__sub">От пилота на SaaS до кастомного движка с LLM-слоем: аудит → 3–5 блоков → A/B → масштаб. Ориентир чека <strong>500 тыс.–3 млн ₽</strong>, срок пилота от 2 недель.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#stoimost" class="nero-ai-btn nero-ai-btn-secondary ym-btn">Смотреть стоимость</a>
        </div>
      </div>
    </aside>
  </div>

  <!-- H2-4: Интеграции -->
  <section class="art-section art-section-alt" id="integracii">
    <div class="art-cnt">
      <div class="art-sh art-left">
        <span class="art-eyebrow">Интеграции</span>
        <h2>Интеграция с CMS, CRM и аналитикой</h2>
      </div>
      <div class="art-card nero-ai-reveal" id="cms-i-fidy">
        <h3>Bitrix, WooCommerce, Tilda и фиды товаров</h3>
        <p>Поддерживаем <strong>1С-Битрикс</strong>, <strong>WooCommerce</strong>, InSales, Tilda (zero-block/GTM), Shopify, кастом REST API. Модули: каталог-коннектор, event collector, recommendation engine, widget layer.</p>
        <p>Для синхронизации каталога, остатков и заказов с рекомендательным движком полезен и <a href="/ai-1c-erp/">AI-агент для 1С и ERP под ключ</a> — единый контур данных снижает риск рекомендовать позиции «не в наличии».</p>
        <p>Кейс REES46 / TechnoDom: <strong>725 блоков</strong>, учёт складов по городам, визуальный редактор без IT — <strong>6%</strong> выручки онлайн-канала.</p>
      </div>
      <div class="art-card nero-ai-reveal nero-ai-delay-1" id="metriki">
        <h3>Метрика, GA4 и метрики до/после</h3>
        <div class="art-table-wrap">
          <table class="art-table ym-table">
            <thead><tr><th>Метрика</th><th>Что измеряет</th><th>Ориентир рынка</th></tr></thead>
            <tbody>
              <tr><td>CTR блока рекомендаций</td><td>Клики / показы</td><td>3–15%</td></tr>
              <tr><td>CR карточки / корзины</td><td>Конверсия страницы</td><td>+5–15%</td></tr>
              <tr><td>AOV (средний чек)</td><td>Выручка / заказы</td><td>+8–20%</td></tr>
              <tr><td>Revenue attribution</td><td>Доля выручки от reco</td><td>6–30%</td></tr>
              <tr><td>Отказ корзины</td><td>Bounce из корзины</td><td>Снижение 10–25%</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <!-- H2-5: Стоимость -->
  <section class="art-section" id="stoimost">
    <div class="art-cnt">
      <div class="art-sh art-left">
        <span class="art-eyebrow">Бюджет</span>
        <h2>Стоимость и сроки: сколько стоит внедрение AI-рекомендаций</h2>
        <p>Ориентир чека Nero Network: <strong>500 тыс.–3 млн ₽</strong>.</p>
      </div>
      <div class="art-card nero-ai-reveal" id="cena-faktory">
        <h3>Ориентир чека 500 тыс.–3 млн ₽: от чего зависит</h3>
        <div class="art-table-wrap">
          <table class="art-table ym-table">
            <thead><tr><th>Уровень</th><th>Срок</th><th>Чек</th><th>Для кого</th></tr></thead>
            <tbody>
              <tr><td><strong>Быстрый старт</strong></td><td>2–4 недели</td><td>500–800 тыс. ₽</td><td>SaaS + JS-виджеты, до 50 тыс. SKU</td></tr>
              <tr><td><strong>Гибрид</strong></td><td>4–8 недель</td><td>800 тыс.–1,5 млн ₽</td><td>SaaS + LLM-слой, CRM, A/B</td></tr>
              <tr><td><strong>Кастом</strong></td><td>8–16 недель</td><td>1,5–3 млн ₽</td><td>CF + vector search, омниканал</td></tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="art-card nero-ai-reveal nero-ai-delay-1" id="pod-klyuch-ili-sam">
        <h3>Под ключ или поэтапно: ai рекомендации товаров под ключ или самостоятельно</h3>
        <p><strong>Под ключ</strong> (рекомендуем): аудит → пилот → A/B → масштаб → compliance. <strong>Самостоятельно</strong> — SaaS за 1–10 дней, но без A/B и аудита фида риск «виджет ради виджета».</p>
        <p>Нужна консультация по архитектуре? <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent"<?php echo (strpos($secondary_cta_url,'http')===0)?' target="_blank" rel="noopener noreferrer"':''; ?>><?php echo esc_html($secondary_cta_label); ?></a></p>
      </div>
    </div>
  </section>

  <!-- H2-6: Кейсы -->
  <section class="art-section art-section-alt" id="keisy">
    <div class="art-cnt">
      <div class="art-sh art-left">
        <span class="art-eyebrow">Доказательства</span>
        <h2>Кейсы и метрики: AI-рекомендации товаров для бизнеса</h2>
      </div>
      <div class="nero-ai-reveal" id="keisy-rossiya">
        <h3>Интернет-магазины и маркетплейсы: что внедряют в 2025–2026</h3>
        <div class="art-table-wrap">
          <table class="art-table ym-table">
            <thead><tr><th>Компания</th><th>Что внедрили</th><th>Результат</th><th>Источник</th></tr></thead>
            <tbody>
              <tr><td>Lamoda</td><td>Similar-reco, реранкер, A/B</td><td><strong>+1,5%</strong> покупок</td><td>Habr</td></tr>
              <tr><td>Wildberries</td><td>WildBERT, сессионная персонализация</td><td>Enterprise-лента</td><td>Habr</td></tr>
              <tr><td>Ozon</td><td>CF + контент + скоринг 0–1</td><td><strong>9/10</strong> юзеров смотрят reco</td><td>Коммерсантъ</td></tr>
              <tr><td>ANGELSKAYA925</td><td>11 блоков на 5 страницах</td><td><strong>30,4%</strong> выручки, ROMI 1074%</td><td>Retail Rocket</td></tr>
              <tr><td>АШАН</td><td>Reco в корзине, ЛК, app</td><td>Доля выручки <strong>2%→10%</strong> (×5)</td><td>Retail Rocket</td></tr>
              <tr><td>TechnoDom</td><td>725 блоков, учёт складов</td><td><strong>6%</strong> выручки онлайн</td><td>REES46</td></tr>
              <tr><td>МИР ИНСТРУМЕНТА</td><td>B2B персонализация + поиск</td><td><strong>19,6%</strong> выручки, +8% AOV</td><td>Retail Rocket</td></tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="art-card nero-ai-reveal nero-ai-delay-1" id="saas-vs-kastom">
        <h3>Готовые платформы vs кастом на LLM и эмбеддингах</h3>
        <div class="art-table-wrap">
          <table class="art-table ym-table">
            <thead><tr><th>Критерий</th><th>Retail Rocket</th><th>REES46</th><th>Mindbox</th><th>anyRecs</th><th>Кастом Nero Network</th></tr></thead>
            <tbody>
              <tr><td>Срок запуска</td><td>1–2 недели</td><td>1–2 недели</td><td>2–4 недели</td><td>1–10 дней</td><td>8–16 недель</td></tr>
              <tr><td>Без программиста</td><td>Частично</td><td>Да</td><td>Частично</td><td>Да</td><td>Нет (на старте)</td></tr>
              <tr><td>LLM / семантика</td><td>Ограниченно</td><td>Базово</td><td>Есть</td><td>Да</td><td>Полный контроль</td></tr>
              <tr><td>Compliance РФ</td><td>Нужна настройка</td><td>Нужна настройка</td><td>Нужна настройка</td><td>Нужна настройка</td><td><strong>152-ФЗ + 10.2-2 из коробки</strong></td></tr>
              <tr><td>Аудит фида + A/B</td><td>Клиент/партнёр</td><td>Клиент/партнёр</td><td>Клиент/партнёр</td><td>Клиент/партнёр</td><td><strong>Включено в проект</strong></td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <!-- H2-7: Малый и средний бизнес -->
  <section class="art-section" id="malyj-srednij-biznes">
    <div class="art-cnt">
      <div class="art-sh art-left">
        <span class="art-eyebrow">Сегменты</span>
        <h2>AI-рекомендации для малого и среднего e-commerce</h2>
      </div>
      <div class="nero-ai-reveal">
        <p><strong>Малый e-commerce</strong> (до 10 тыс. SKU): SaaS, content-based + LLM, 3–5 блоков, чек <strong>500–800 тыс. ₽</strong>.</p>
        <p><strong>Средний бизнес</strong> (5–500 тыс. SKU): гибрид SaaS + кастом, персонализация поиска и корзины, CRM, A/B — чек <strong>800 тыс.–1,5 млн ₽</strong>.</p>
        <p><strong>Холодный старт:</strong> порог ~500 заказов для CF; до этого — content-based, LLM-эмбеддинги, правила.</p>
      </div>
    </div>
  </section>

  <!-- H2-8: Тренд 2026 -->
  <section class="art-section art-section-alt" id="trend-2026-ai-agenty">
    <div class="art-cnt">
      <div class="art-sh art-left">
        <span class="art-eyebrow">Тренд 2026</span>
        <h2>Тренд 2026: AI-агенты и персонализация в клиентских сценариях</h2>
      </div>
      <div class="nero-ai-reveal">
        <ul>
          <li><strong>Meta Business Agent</strong> (июнь 2026): рекомендации в мессенджерах, &gt;1 млрд диалогов/день.</li>
          <li><strong>Яндекс Маркет AI</strong> (декабрь 2025): YandexGPT 5 Pro — подбор, голос, фото.</li>
          <li><strong>Ozon:</strong> LLM-ассистент для поиска, потенциал <strong>+3–5% GMV</strong> (Forbes/Совкомбанк).</li>
          <li>Для среднего магазина: чат-виджет RAG, Telegram/VK с единым user_id, динамические заголовки блоков.</li>
        </ul>
        <p>На enterprise-масштабе похожую логику цифровых агентов разбираем в материале про <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/">KPMG и Claude: уроки AI для бизнеса</a> — managed-агенты и корпоративные шлюзы задают планку зрелости персонализации.</p>
      </div>
    </div>
  </section>

  <!-- Compliance -->
  <section class="art-section" id="compliance">
    <div class="art-cnt">
      <div class="art-compliance nero-ai-reveal">
        <div class="art-compliance-icon" aria-hidden="true">⚖️</div>
        <h2>Юридические требования: 152-ФЗ и рекомендательные технологии</h2>
        <p><strong>149-ФЗ, ст. 10.2-2:</strong> обязательны правила применения рекомендательных технологий — публичный документ о принципах подбора.</p>
        <p><strong>152-ФЗ:</strong> согласия на cookies, политика ПДн, возможность отказа от персонализации, хранение данных в РФ. Nero Network включает compliance-пакет в проект.</p>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="art-section art-section-alt" id="faq">
    <div class="art-cnt">
      <div class="art-sh">
        <span class="art-eyebrow">FAQ</span>
        <h2>FAQ: как внедрить AI-рекомендации товаров</h2>
      </div>
      <div class="art-faq nero-ai-reveal">
        <details><summary>Как внедрить AI-рекомендации товаров на сайт?</summary><div class="art-faq-body"><p>Аудит → архитектура (SaaS/гибрид/кастом) → фид и события → блоки на ключевых страницах → A/B 3–4 недели → масштаб и compliance. Nero Network выполняет цикл под ключ.</p></div></details>
        <details><summary>Какие задачи решает AI-рекомендации товаров?</summary><div class="art-faq-body"><p>Рост CR и AOV, снижение отказов, персонализация поиска, омниканал (email, Telegram, VK), прозрачная доля выручки от блоков.</p></div></details>
        <details><summary>Сколько стоит AI-рекомендации товаров?</summary><div class="art-faq-body"><p>Ориентир <strong>500 тыс.–3 млн ₽</strong>: SaaS от 500 тыс. ₽, гибрид 800 тыс.–1,5 млн ₽, кастом до 3 млн ₽. Точная стоимость — после аудита.</p></div></details>
        <details><summary>Как заказать внедрение AI-рекомендации товаров?</summary><div class="art-faq-body"><p>Оставьте заявку на аудит товарной выдачи или консультацию. Nero Network оценит фид, метрики, CMS и предложит план: SaaS, гибрид или кастом с фиксированными сроками и чеком.</p></div></details>
        <details><summary>AI-рекомендации товаров под ключ или самостоятельно — что выбрать?</summary><div class="art-faq-body"><p>Самостоятельно — если есть аналитик и разработчик, готовы к A/B и аудиту фида. Под ключ — если нужен результат с фиксированными сроками, интеграцией CRM, compliance и сопровождением A/B.</p></div></details>
        <details><summary>Что делать при холодном старте — мало заказов?</summary><div class="art-faq-body"><p>Content-based и LLM-эмбеддинги. Collaborative filtering — от ~500–1000 заказов.</p></div></details>
        <details><summary>У нас уже есть «Похожие товары» — зачем AI?</summary><div class="art-faq-body"><p>Статика ≠ персонализация. AI учитывает сессию, co-purchase, ранжирует по вероятности покупки. Lamoda: <strong>+1,5%</strong> после переработки similar-блока.</p></div></details>
        <details><summary>Нарушает ли персонализация закон о данных?</summary><div class="art-faq-body"><p>Нет при корректной настройке: 152-ФЗ, правила по 10.2-2, opt-out. Compliance входит в проект Nero Network.</p></div></details>
        <details><summary>AI-рекомендации товаров с CRM — как это работает?</summary><div class="art-faq-body"><p>События с сайта (просмотр, корзина) → сегмент в amoCRM/Bitrix24 → триггер: email, web-push, задача менеджеру. Единый профиль для сайта и мессенджера по user_id.</p></div></details>
      </div>
    </div>
  </section>

  <!-- Итог -->
  <section class="art-section" id="itog">
    <div class="art-cnt">
      <div class="art-sh art-left nero-ai-reveal">
        <span class="art-eyebrow">Итог</span>
        <h2>AI-рекомендации товаров как решение для бизнеса</h2>
        <p>Нерелевантная выдача — главная причина потери конверсии. Внедрение под ключ: аудит → пилот → A/B → масштаб → compliance. Ориентир чека <strong>500 тыс.–3 млн ₽</strong>; ROI в кейсах — от 6% до 30% выручки через рекомендации.</p>
        <p>Nero Network внедряет AI-рекомендации для интернет-магазинов, маркетплейсов и каталогов. Начните с <strong>аудита товарной выдачи</strong>.</p>
      </div>
    </div>
  </section>

  <!-- CTA-3 финальный Артура -->
  <div class="art-cnt">
    <aside class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Повысьте конверсию каталога с AI-рекомендациями</p>
        <p class="ym-cta-block__sub">Начните с бесплатного аудита товарной выдачи или заявки на внедрение под ключ. Интеграции: Bitrix, WooCommerce, Tilda, amoCRM, Метрика, GA4, Telegram, VK.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#audit-vydachi" class="nero-ai-btn nero-ai-btn-secondary ym-btn">Бесплатный аудит выдачи</a>
        </div>
      </div>
    </aside>
  </div>

</div><!-- /.art-content -->



<?php
$reco_page_url = trailingslashit( get_permalink() );
$reco_site_url = trailingslashit( home_url( '/' ) );
$reco_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$reco_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $reco_site_url . '#organization',
      'name'  => $reco_brand,
      'url'   => $reco_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $reco_site_url . '#website',
      'url'       => $reco_site_url,
      'name'      => $reco_brand,
      'publisher' => [ '@id' => $reco_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $reco_page_url . '#webpage',
      'url'         => $reco_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $reco_site_url . '#website' ],
      'about'       => [ '@id' => $reco_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $reco_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $reco_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $reco_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $reco_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $reco_page_url,
      'provider'    => [ '@id' => $reco_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $reco_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Как внедрить AI-рекомендации товаров на сайт?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Пошагово: (1) аудит товарной выдачи и фида; (2) выбор архитектуры — SaaS, гибрид или кастом; (3) настройка фида и событий в Метрике/GA4; (4) размещение блоков на главной, карточке, корзине, поиске; (5) A/B-тест 3–4 недели; (6) масштабирование и compliance. Nero Network выполняет весь цикл под ключ.' ] ],
        [ '@type' => 'Question', 'name' => 'Какие задачи решает AI-рекомендации товаров?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Рост конверсии карточки и корзины; рост среднего чека через cross-sell и up-sell; снижение отказов на каталоге и пустой корзине; персонализация поиска и главной; омниканальные рекомендации (email, Telegram, VK); прозрачная доля выручки от рекомендательных блоков.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько стоит AI-рекомендации товаров?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Ориентир: 500 тыс.–3 млн ₽ в зависимости от архитектуры. Быстрый старт на SaaS — от 500 тыс. ₽; гибрид с LLM — 800 тыс.–1,5 млн ₽; полный кастом — до 3 млн ₽. Точная стоимость — после аудита каталога и ТЗ.' ] ],
        [ '@type' => 'Question', 'name' => 'Как заказать внедрение AI-рекомендации товаров?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Оставьте заявку на аудит товарной выдачи или консультацию. Nero Network оценит фид, метрики, CMS и предложит план: SaaS, гибрид или кастом с фиксированными сроками и чеком.' ] ],
        [ '@type' => 'Question', 'name' => 'AI-рекомендации товаров под ключ или самостоятельно — что выбрать?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Самостоятельно — если есть аналитик и разработчик, готовы к A/B и аудиту фида. Под ключ — если нужен результат с фиксированными сроками, интеграцией CRM, compliance и сопровождением A/B. Для большинства среднего e-commerce выгоднее под ключ: меньше риска «виджет без эффекта».' ] ],
        [ '@type' => 'Question', 'name' => 'Что делать при холодном старте — мало заказов?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Используйте content-based рекомендации и LLM-эмбеддинги описаний. Collaborative filtering подключают от ~500–1000 заказов. До этого работают правила, атрибуты, «похожие по смыслу» через эмбеддинги.' ] ],
        [ '@type' => 'Question', 'name' => 'Нарушает ли персонализация закон о данных?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет, при корректной настройке: согласия 152-ФЗ, правила рекомендательных технологий по 149-ФЗ ст. 10.2-2, возможность отказа. Nero Network оформляет compliance в рамках проекта.' ] ],
        [ '@type' => 'Question', 'name' => 'У нас уже есть блок «Похожие товары» — зачем AI?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Статичный блок «похожие по категории» ≠ персонализация. AI учитывает поведение в сессии, co-purchase, атрибуты, ранжирует по вероятности покупки. A/B обычно показывает разницу в CTR и CR. Lamoda получила +1,5% покупок именно после переработки similar-блока с реранкером.' ] ],
        [ '@type' => 'Question', 'name' => 'AI-рекомендации товаров с CRM — как это работает?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'События с сайта (просмотр, корзина) → сегмент в amoCRM/Bitrix24 → триггер: email, web-push, задача менеджеру. Единый профиль для сайта и мессенджера по user_id.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $reco_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>




</main>

<script>
/**
 * aireco-hero-engine — «Диспетчерская витринной персонализации»
 * Фазы: сигналы → скоринг → виджет → конверсионный импульс
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("aireco-hero-canvas");
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
    scale = Math.min(cw / 420, ch / 280) * 1.14;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    cardA: "#fed7aa",
    cardB: "#ddd6fe",
    cardC: "#bfdbfe",
    cardD: "#bbf7d0",
    cardE: "#fecdd3",
    streamCyan: "#38bdf8",
    streamOrange: "#fb923c",
    streamViolet: "#a78bfa",
    hubBase: "#1e293b",
    hubRing: "#8b5cf6",
    scoreGreen: "#22c55e",
    dockBg: "rgba(30,41,59,0.75)",
    coldBloom: "rgba(249,115,22,0.18)",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#fde68a"
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

  function drawMiniCard(ctx, x, y, w, h, color, label, score) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 4, color, C.outline);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    if (label) ctx.fillText(label, x, y + 1);
    if (score !== undefined) {
      ctx.fillStyle = C.scoreGreen;
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.fillText(score, x, y + h / 2 - 3);
    }
  }

  /* Дугообразные орбиты intent-сигналов — вместо Conveyor */
  function CustomerIntentStream() {
    this.particles = [
      { arc: 0, t: 0, color: C.streamCyan, kind: "view" },
      { arc: 1, t: 40, color: C.streamOrange, kind: "search" },
      { arc: 2, t: 90, color: C.streamViolet, kind: "cart" },
      { arc: 0, t: 130, color: C.streamCyan, kind: "view" },
      { arc: 1, t: 175, color: C.streamOrange, kind: "search" }
    ];
    this.arcs = [
      { x0: -175, y0: 55, cx: -95, cy: -35, x1: -25, y1: -15 },
      { x0: -165, y0: 70, cx: -70, cy: 10, x1: 5, y1: -8 },
      { x0: -155, y0: 82, cx: -45, cy: 45, x1: 35, y1: 18 }
    ];
  }
  CustomerIntentStream.prototype.bezier = function (a, t) {
    var u = 1 - t;
    return {
      x: u * u * a.x0 + 2 * u * t * a.cx + t * t * a.x1,
      y: u * u * a.y0 + 2 * u * t * a.cy + t * t * a.y1
    };
  };
  CustomerIntentStream.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    this.arcs.forEach(function (a, i) {
      ctx.strokeStyle = i === 1 ? "rgba(249,115,22,0.22)" : "rgba(56,189,248,0.16)";
      ctx.lineWidth = 1.2;
      ctx.setLineDash([4, 5]);
      ctx.beginPath();
      ctx.moveTo(a.x0, a.y0);
      ctx.quadraticCurveTo(a.cx, a.cy, a.x1, a.y1);
      ctx.stroke();
      ctx.setLineDash([]);
    });
    this.particles.forEach(function (p) {
      var t = ((frame * 0.55 + p.t) % 140) / 140;
      if (prg > 200 && p.kind === "cart") t = Math.min(t, 0.35);
      var pos = this.bezier(this.arcs[p.arc], t);
      ctx.fillStyle = p.color;
      ctx.beginPath();
      ctx.arc(pos.x, pos.y, 3.5, 0, Math.PI * 2);
      ctx.fill();
      ctx.strokeStyle = C.outline;
      ctx.lineWidth = 0.8;
      ctx.stroke();
    }, this);
  };

  /* Круговая витрина с пересортировкой SKU — вместо WebsiteTerminal */
  function RecommendationShowcaseHub() {
    this.slots = [
      { angle: 0, color: C.cardA, label: "SKU-A", score: 0.42 },
      { angle: 72, color: C.cardB, label: "SKU-B", score: 0.58 },
      { angle: 144, color: C.cardC, label: "SKU-C", score: 0.71 },
      { angle: 216, color: C.cardD, label: "SKU-D", score: 0.83 },
      { angle: 288, color: C.cardE, label: "SKU-E", score: 0.94 }
    ];
    this.spin = 0;
  }
  RecommendationShowcaseHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    var radius = 52;
    drawRR(ctx, -8, -8, 16, 16, 8, C.hubBase, C.outline);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("AI", 0, 3);

    if (prg >= 70 && prg < 200) {
      this.spin += prg < 150 ? 0.018 : 0.006;
    } else if (prg >= 200) {
      this.spin *= 0.96;
    }

    var sorted = this.slots.slice().sort(function (a, b) {
      return prg >= 90 ? b.score - a.score : a.angle - b.angle;
    });

    sorted.forEach(function (s, i) {
      var ang = (s.angle * Math.PI / 180) + this.spin + i * 0.05;
      var dist = radius + (prg >= 90 && prg < 200 ? Math.sin(frame * 0.08 + i) * 4 : 0);
      var px = Math.cos(ang) * dist;
      var py = Math.sin(ang) * dist;
      var sc = prg >= 90 ? s.score.toFixed(2) : "";
      drawMiniCard(ctx, px, py, 22, 26, s.color, s.label, prg >= 90 ? sc : undefined);
    }, this);

    ctx.strokeStyle = C.hubRing;
    ctx.lineWidth = 1.5;
    ctx.globalAlpha = 0.35 + Math.sin(frame * 0.06) * 0.15;
    ctx.beginPath();
    ctx.arc(0, 0, radius + 18, 0, Math.PI * 2);
    ctx.stroke();
    ctx.globalAlpha = 1;
  };

  /* Орбитальный скорер rerank */
  function RerankerScoringRing() {
    this.value = 0;
  }
  RerankerScoringRing.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    if (prg < 65 || prg > 215) return;
    var t = Math.min(1, (prg - 65) / 85);
    this.value = 0.12 + t * 0.82;
    var sweep = t * Math.PI * 1.6;
    ctx.strokeStyle = "rgba(255,255,255,0.08)";
    ctx.lineWidth = 5;
    ctx.beginPath();
    ctx.arc(0, 0, 78, 0, Math.PI * 2);
    ctx.stroke();
    ctx.strokeStyle = C.hubRing;
    ctx.beginPath();
    ctx.arc(0, 0, 78, -Math.PI / 2, -Math.PI / 2 + sweep);
    ctx.stroke();
    ctx.fillStyle = "#e9d5ff";
    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(this.value.toFixed(2), 0, -86);
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.fillStyle = "#94a3b8";
    ctx.fillText("rerank", 0, -76);
  };

  /* Кластер «Похожие» справа */
  function SimilarProductsCluster() {
    this.pop = 0;
  }
  SimilarProductsCluster.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    drawRR(ctx, 108, -42, 54, 72, 6, "rgba(255,255,255,0.05)", C.outline);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Похожие", 135, -30);
    if (prg >= 150) {
      this.pop = Math.min(1, (prg - 150) / 35);
      var items = [C.cardB, C.cardC, C.cardD];
      items.forEach(function (col, i) {
        var py = -18 + i * 22;
        var w = 14 + this.pop * 6;
        ctx.globalAlpha = this.pop;
        drawMiniCard(ctx, 135, py, w, 16, col, "", undefined);
        ctx.globalAlpha = 1;
      }, this);
    }
  };

  /* Док допродажи в корзине */
  function CartCrossSellDock() {
    this.lift = 0;
  }
  CartCrossSellDock.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    drawRR(ctx, -95, 72, 190, 28, 6, C.dockBg, C.outline);
    ctx.fillStyle = "#cbd5e1";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Корзина · cross-sell", -86, 80);
    if (prg >= 165 && prg < 250) {
      this.lift = Math.min(1, (prg - 165) / 30);
      drawMiniCard(ctx, 55, 86 - this.lift * 10, 20, 18, C.cardA, "+1", undefined);
    }
  };

  /* Облако холодного старта для новых посетителей */
  function ColdStartSeedBloom() {
    this.seeds = 6;
  }
  ColdStartSeedBloom.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    if (prg > 120) return;
    for (var i = 0; i < this.seeds; i++) {
      var ang = (i / this.seeds) * Math.PI * 2 + frame * 0.02;
      var r = 28 + Math.sin(frame * 0.05 + i) * 6;
      var sx = -130 + Math.cos(ang) * r;
      var sy = -20 + Math.sin(ang) * r * 0.5;
      ctx.fillStyle = C.coldBloom;
      ctx.beginPath();
      ctx.arc(sx, sy, 4, 0, Math.PI * 2);
      ctx.fill();
    }
    ctx.fillStyle = "#fdba74";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("cold start", -148, -38);
  };

  /* Развилка A/B */
  function AbTestForkGate() {
    this.winner = "B";
  }
  AbTestForkGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    if (prg < 210) return;
    drawRR(ctx, -148, 38, 36, 40, 5, "rgba(255,255,255,0.04)", C.outline);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("A", -130, 52);
    drawRR(ctx, -148, 38, 36, 40, 5, "rgba(139,92,246,0.22)", C.hubRing);
    ctx.fillStyle = "#ddd6fe";
    ctx.fillText("B✓", -130, 52);
    ctx.strokeStyle = "rgba(249,115,22,0.5)";
    ctx.lineWidth = 1.2;
    ctx.beginPath();
    ctx.moveTo(-112, 58);
    ctx.lineTo(-25, 30);
    ctx.stroke();
  };

  /* Конверсионный импульс — финал цикла */
  function ConversionPulseBurst() {
    this.rings = [];
  }
  ConversionPulseBurst.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    if (prg < 230) return;
    var local = (prg - 230) / 50;
    var radius = 20 + local * 55;
    ctx.strokeStyle = "rgba(34,197,94," + (1 - local) * 0.65 + ")";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(0, 0, radius, 0, Math.PI * 2);
    ctx.stroke();
    if (local > 0.35) {
      ctx.fillStyle = C.scoreGreen;
      ctx.font = "bold 10px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.globalAlpha = Math.min(1, (local - 0.35) * 2.5);
      ctx.fillText("+CTR 22%", 0, 58);
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillStyle = "#bbf7d0";
      ctx.fillText("выручка от реко", 0, 70);
      ctx.globalAlpha = 1;
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
    var prg = (frame * 0.042) % 280;
    var isMoving = false;
    var faceDir = 1;

    var hubTargets = {
      "1_architect": { x: -55, y: -55 },
      "2_data": { x: -18, y: -62 },
      "3_integrator": { x: 22, y: -58 },
      "4_designer": { x: 58, y: -48 },
      "5_deployer": { x: -30, y: 42 }
    };
    var tgt = hubTargets[this.role] || { x: 0, y: -40 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 26) {
      var local = prg - this.stepTrig;
      if (local < 14) {
        isMoving = true;
        var ease = local / 14;
        this.x = this.baseX + (tgt.x - this.baseX) * ease;
        this.y = this.baseY + (tgt.y - this.baseY) * ease;
      } else if (local < 19) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        var back = (local - 19) / 7;
        this.x = tgt.x - (tgt.x - this.baseX) * back;
        this.y = tgt.y - (tgt.y - this.baseY) * back;
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
  var intentStream = new CustomerIntentStream();
  var showcase = new RecommendationShowcaseHub();
  var reranker = new RerankerScoringRing();
  var similar = new SimilarProductsCluster();
  var cartDock = new CartCrossSellDock();
  var coldBloom = new ColdStartSeedBloom();
  var abFork = new AbTestForkGate();
  var pulse = new ConversionPulseBurst();

  entities.push(coldBloom);
  entities.push(intentStream);
  entities.push(cartDock);
  entities.push(showcase);
  entities.push(reranker);
  entities.push(similar);
  entities.push(abFork);
  entities.push(pulse);
  entities.push(new Agent(-138, 92, C.agentYellow, "1_architect", 22, [
    "Аудит фида YML", "Дубли SKU убрать", "Атрибуты для CF"
  ]));
  entities.push(new Agent(-72, 98, C.agentGreen, "2_data", 78, [
    "Co-purchase граф", "Сессия 3 клика", "Rerank 0.94"
  ]));
  entities.push(new Agent(-8, 100, C.agentBlue, "3_integrator", 128, [
    "Bitrix + Метрика", "Webhook в amoCRM", "API <200 мс"
  ]));
  entities.push(new Agent(58, 98, C.agentPink, "4_designer", 178, [
    "Блок «Похожие»", "Заголовок под intent", "Корзина drawer"
  ]));
  entities.push(new Agent(122, 92, C.agentPurple, "5_deployer", 228, [
    "A/B 4 недели", "149-ФЗ 10.2-2", "Раскатка на прод"
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

    var prg = (frame * 0.042) % 280;
    if (prg >= 12 && prg < 12.05) createBubble(-120, 10, "1. Сигнал просмотра в поток");
    if (prg >= 82 && prg < 82.05) createBubble(-20, -70, "2. Гибридный скоринг SKU");
    if (prg >= 158 && prg < 158.05) createBubble(120, -25, "3. Виджет «Похожие» на PDP");
    if (prg >= 218 && prg < 218.05) createBubble(-100, 55, "4. A/B: вариант B лидирует");
    if (prg >= 248 && prg < 248.05) createBubble(0, 45, "5. +CTR — конверсия растёт");

    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 22);
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 20, tw, 16, 5, C.bubbleBg, C.streamOrange);
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

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

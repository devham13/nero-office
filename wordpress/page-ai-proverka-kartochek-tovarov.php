<?php
/**
 * Template Name: AI проверка карточек товаров: внедрение под ключ
 * Description: SEO-лонгрид — AI-модератор карточек WB/Ozon. Проверка до публикации, кейсы, цены.
 */

declare(strict_types=1);

$page_seo_title       = 'AI проверка карточек товаров для WB и Ozon под ключ';
$page_seo_description = 'Нейросеть проверяет карточки по правилам площадки, SEO и конверсии до публикации. Меньше отклонений, сильнее тексты. Внедрение AI-модератора для селлеров и агентств.';

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
    ['label' => 'Зачем',         'href' => '#zachem-ai-proverka'],
    ['label' => 'Что проверяет', 'href' => '#chto-proveryaet'],
    ['label' => 'Как работает',  'href' => '#kak-rabotaet'],
    ['label' => 'Внедрение',     'href' => '#vnedrenie-pod-klyuch'],
    ['label' => 'Стоимость',     'href' => '#stoimost'],
    ['label' => 'Кейсы',         'href' => '#keisy'],
    ['label' => 'FAQ',           'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить карточки';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение Nero Network';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '';
$secondary_cta_attrs = '';
if ($secondary_cta_url !== '' && preg_match('#^https?://#i', $secondary_cta_url)) {
    $secondary_cta_attrs = ' target="_blank" rel="noopener noreferrer"';
}

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
body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header {
  display: none !important;
}
body.nero-ai-landing { padding-top: 0 !important; }

.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,
.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}

#primary,.site-main,.site-content,#content,.content-area{
  padding-top:0!important;margin-top:0!important;
}

/* Hero viewport */
.nero-ai-hero.vpkt-hero-cards{
  min-height:100vh;min-height:100dvh;position:relative;
}

/* Hero (Alina) */
/* vpkt hero — самодостаточный блок в стиле nero-ai-home-page */
.vpkt-hero-cards {
  --vpkt-primary: #79f2ff;
  --vpkt-violet: #8b5cf6;
  --vpkt-green: #22c55e;
  --vpkt-warn: #f59e0b;
  --vpkt-danger: #fb7185;
  --vpkt-muted: #9aa8bd;
  --vpkt-text: #e6edf7;
  position: relative;
  padding: clamp(72px, 9vw, 120px) 0 clamp(48px, 6vw, 80px);
  background:
    radial-gradient(ellipse 80% 60% at 18% 12%, rgba(121, 242, 255, 0.09), transparent 58%),
    radial-gradient(ellipse 55% 45% at 88% 22%, rgba(139, 92, 246, 0.11), transparent 62%),
    linear-gradient(180deg, #060812 0%, #0b1020 52%, #060812 100%);
  color: var(--vpkt-text);
  overflow: hidden;
}
.vpkt-hero-cards .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
}
.vpkt-hero-cards .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(320px, 0.98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vpkt-hero-cards .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 6px 14px;
  margin-bottom: 16px;
  border-radius: 999px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  background: rgba(121, 242, 255, 0.08);
  font-size: 11.5px;
  font-weight: 700;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--vpkt-primary);
}
.vpkt-hero-cards h1 {
  margin: 0;
  font-size: clamp(34px, 4.8vw, 58px);
  font-weight: 900;
  line-height: 1.06;
  letter-spacing: -0.045em;
  color: #fff;
}
.vpkt-hero-cards .nero-ai-gradient-text {
  display: block;
  background: linear-gradient(92deg, #fff 0%, var(--vpkt-primary) 42%, var(--vpkt-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vpkt-hero-cards .nero-ai-hero-lead {
  margin: 18px 0 0;
  max-width: 640px;
  font-size: clamp(16px, 1.7vw, 19px);
  line-height: 1.62;
  color: var(--vpkt-muted);
}
.vpkt-hero-cards .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 22px 0 0;
  padding: 0;
  list-style: none;
}
.vpkt-hero-cards .nero-ai-badge {
  padding: 7px 14px;
  border-radius: 999px;
  border: 1px solid rgba(255, 255, 255, 0.12);
  background: rgba(255, 255, 255, 0.06);
  font-size: 12px;
  font-weight: 700;
  color: #cfe3f9;
}
.vpkt-hero-cards .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  margin-top: 28px;
}
.vpkt-hero-cards .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 14px 22px;
  border-radius: 999px;
  font-size: 14px;
  font-weight: 800;
  text-decoration: none;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.vpkt-hero-cards .nero-ai-btn-primary {
  color: #041018 !important;
  background: linear-gradient(135deg, var(--vpkt-primary), #38bdf8 55%, var(--vpkt-violet));
  box-shadow: 0 14px 40px rgba(121, 242, 255, 0.22);
}
.vpkt-hero-cards .nero-ai-btn-secondary {
  color: var(--vpkt-text) !important;
  border: 1px solid rgba(255, 255, 255, 0.16);
  background: rgba(255, 255, 255, 0.05);
}
.vpkt-hero-cards .nero-ai-btn:hover { transform: translateY(-2px); }
.vpkt-hero-cards .nero-ai-dashboard {
  position: relative;
  padding: 14px;
  border-radius: 28px;
  border: 1px solid rgba(121, 242, 255, 0.14);
  background: linear-gradient(145deg, rgba(255, 255, 255, 0.06), rgba(6, 10, 24, 0.55));
  box-shadow: 0 28px 80px rgba(0, 0, 0, 0.45);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.vpkt-hero-cards .nero-ai-dashboard-shell {
  overflow: hidden;
  border-radius: 22px;
  border: 1px solid rgba(255, 255, 255, 0.12);
  background: linear-gradient(180deg, rgba(15, 23, 42, 0.95), rgba(6, 10, 24, 0.96));
}
.vpkt-hero-cards .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  background: rgba(255, 255, 255, 0.045);
}
.vpkt-hero-cards .nero-ai-dots { display: flex; gap: 7px; }
.vpkt-hero-cards .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vpkt-hero-cards .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vpkt-hero-cards .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vpkt-hero-cards .nero-ai-dot:nth-child(3) { background: #34d399; }
.vpkt-hero-cards .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: 0.08em;
  text-transform: uppercase;
}
.vpkt-hero-cards .nero-ai-window-body { padding: 16px; }
.vpkt-hero-cards .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vpkt-hero-cards .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vpkt-hero-cards .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(34, 197, 94, 0.1);
  color: #bbf7d0;
  font-size: 12px;
  font-weight: 800;
}
.vpkt-hero-cards .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--vpkt-green);
  box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.14);
  animation: vpktPulse 1.6s infinite;
}
@keyframes vpktPulse {
  0%, 100% { transform: scale(0.86); opacity: 0.65; }
  50% { transform: scale(1); opacity: 1; }
}
.vpkt-hero-cards .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vpkt-hero-cards .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255, 255, 255, 0.09);
  border-radius: 16px;
  background: rgba(255, 255, 255, 0.055);
}
.vpkt-hero-cards .nero-ai-metric span {
  display: block;
  color: var(--vpkt-muted);
  font-size: 11px;
  font-weight: 700;
}
.vpkt-hero-cards .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vpkt-hero-cards .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vpkt-hero-cards .vpkt-dash-canvas-wrap {
  position: relative;
  height: clamp(200px, 30vw, 280px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.16);
  background: radial-gradient(ellipse at 30% 45%, rgba(121, 242, 255, 0.07), rgba(6, 10, 24, 0.92) 72%);
}
.vpkt-hero-cards #vpkt-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vpkt-hero-cards .nero-ai-task-stream { display: grid; gap: 8px; }
.vpkt-hero-cards .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 14px;
  background: rgba(255, 255, 255, 0.04);
}
.vpkt-hero-cards .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121, 242, 255, 0.12);
  color: var(--vpkt-primary);
  font-size: 11px;
  font-weight: 800;
}
.vpkt-hero-cards .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vpkt-hero-cards .nero-ai-task span {
  color: var(--vpkt-muted);
  font-size: 11px;
}
.vpkt-hero-cards .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vpkt-hero-cards .nero-ai-status--green {
  background: rgba(34, 197, 94, 0.11);
  color: #bbf7d0;
}
.vpkt-hero-cards .nero-ai-status--red {
  background: rgba(251, 113, 133, 0.12);
  color: #fecdd3;
}
.vpkt-hero-cards .nero-ai-status--amber {
  background: rgba(245, 158, 11, 0.12);
  color: #fde68a;
}
.vpkt-hero-cards .nero-ai-reveal {
  opacity: 0;
  transform: translateY(22px);
  transition: opacity 0.55s ease, transform 0.55s ease;
}
.vpkt-hero-cards .nero-ai-reveal.nero-ai-active { opacity: 1; transform: none; }
.vpkt-hero-cards .nero-ai-delay-2 { transition-delay: 0.24s; }
@media (max-width: 1100px) {
  .vpkt-hero-cards .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vpkt-hero-cards .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .vpkt-hero-cards .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vpkt-hero-cards .nero-ai-window-body { padding: 12px; }
  .vpkt-hero-cards .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vpkt-hero-cards .nero-ai-status { grid-column: 2; width: fit-content; }
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

<main id="primary" class="site-main nero-ai-home-page vpkt-page" role="main" tabindex="-1">

<section class="nero-ai-hero vpkt-hero-cards" id="hero" aria-labelledby="vpkt-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal nero-ai-active">
      <p class="nero-ai-eyebrow">Nero Network · ai карточки маркетплейс</p>
      <h1 id="vpkt-hero-title">AI проверка карточек товаров: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Нейросеть проверяет карточку WB и Ozon по правилам площадки, SEO и конверсии — до публикации, без отклонений и ручной правки</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">WB + Ozon</li>
        <li class="nero-ai-badge">CV-фото</li>
        <li class="nero-ai-badge">SEO-скоринг</li>
        <li class="nero-ai-badge">Human-in-loop</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet"><?php echo esc_html('Как это работает'); ?></a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2 nero-ai-active" aria-label="Демо: AI-модератор карточек WB/Ozon">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots" aria-hidden="true"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">WB/Ozon · AI-модератор</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>WB/Ozon · AI-модератор</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid" aria-label="Метрики скоринга">
            <div class="nero-ai-metric">
              <span>Проходимость</span>
              <strong>87%</strong>
              <small>с 1-й попытки</small>
            </div>
            <div class="nero-ai-metric">
              <span>Скоринг</span>
              <strong>3 мин</strong>
              <small>на карточку</small>
            </div>
            <div class="nero-ai-metric">
              <span>Чек-лист</span>
              <strong>25</strong>
              <small>пунктов</small>
            </div>
            <div class="nero-ai-metric">
              <span>Циклы</span>
              <strong>−72%</strong>
              <small>отклонено → правка</small>
            </div>
          </div>

          <div class="vpkt-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vpkt-hero-canvas" role="img" aria-label="Анимация: черновики карточек проходят CV-скан, трёхслойный скоринг и шлюз публикации до WB/Ozon API"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий модерации">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">IN</span>
              <div><strong>Черновик загружен</strong><span>SKU · категория «Куртки»</span></div>
              <span class="nero-ai-status nero-ai-status--green">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CV</span>
              <div><strong>Плашка на фото</strong><span>«−30%» на главном слайде</span></div>
              <span class="nero-ai-status nero-ai-status--red">блокер</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">SEO</span>
              <div><strong>SEO-полнота OK</strong><span>заголовок, ключи, фильтры</span></div>
              <span class="nero-ai-status nero-ai-status--green">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">OK</span>
              <div><strong>Human approval</strong><span>→ WB Content API</span></div>
              <span class="nero-ai-status nero-ai-status--amber">approval</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
/* === VPKT CONTENT ROOT (scoped) === */
.vpkt-content{
  --vpkt-bg:#050711;--vpkt-bg2:#080b17;--vpkt-bg3:#0a0e1c;
  --vpkt-surface:rgba(255,255,255,.072);--vpkt-surface2:rgba(255,255,255,.108);
  --vpkt-text:#e6edf7;--vpkt-muted:#9aa8bd;--vpkt-soft:#c7d2e5;--vpkt-heading:#fff;
  --vpkt-border:rgba(255,255,255,.10);--vpkt-border-s:rgba(255,255,255,.18);
  --vpkt-accent:#79f2ff;--vpkt-violet:#8b5cf6;--vpkt-green:#22c55e;
  --vpkt-warn:#f59e0b;--vpkt-danger:#fb7185;
  --vpkt-r:18px;--vpkt-r-lg:24px;--vpkt-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vpkt-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.vpkt-content *,.vpkt-content *::before,.vpkt-content *::after{box-sizing:border-box;}
.vpkt-content a{color:inherit;text-decoration:none;}
.vpkt-content p{color:var(--vpkt-muted);line-height:1.72;margin:0 0 1em;}
.vpkt-content p:last-child{margin-bottom:0;}
.vpkt-content h2,.vpkt-content h3,.vpkt-content h4{color:var(--vpkt-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.vpkt-content strong{color:var(--vpkt-soft);}
.vpkt-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.vpkt-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vpkt-muted);font-size:14.5px;line-height:1.65;}
.vpkt-content ul li::before{content:'›';position:absolute;left:0;color:var(--vpkt-accent);font-weight:700;}
.vpkt-cnt{width:min(var(--vpkt-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.vpkt-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.vpkt-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.vpkt-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.vpkt-sh.vpkt-left{margin-left:0;text-align:left;}
.vpkt-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.vpkt-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.vpkt-sh.vpkt-left p{margin-left:0;}
.vpkt-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vpkt-accent);margin-bottom:14px;}
.vpkt-gt{background:linear-gradient(92deg,#fff 0%,var(--vpkt-accent) 44%,var(--vpkt-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.vpkt-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.vpkt-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.vpkt-intro-text{position:relative;padding-left:20px;}
.vpkt-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vpkt-accent),var(--vpkt-violet));}
.vpkt-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--vpkt-muted);margin-bottom:1em;}
.vpkt-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.vpkt-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.vpkt-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--vpkt-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.vpkt-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vpkt-muted);line-height:1.4;}
.vpkt-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.vpkt-intro-grid{grid-template-columns:1fr;gap:36px;}.vpkt-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.vpkt-intro-kpi{grid-template-columns:1fr 1fr;}}
.vpkt-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.vpkt-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.vpkt-toc a{display:inline-block;padding:9px 18px;background:var(--vpkt-surface);border:1px solid var(--vpkt-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vpkt-muted);transition:border-color .2s,color .2s,background .2s;}
.vpkt-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--vpkt-accent);background:rgba(121,242,255,.08);}
.vpkt-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vpkt-border);border-radius:var(--vpkt-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.vpkt-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.vpkt-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.vpkt-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.vpkt-grid-2{grid-template-columns:1fr;}.vpkt-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.vpkt-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.vpkt-grid-3{grid-template-columns:1fr;}}
.vpkt-sub{margin-top:40px;}
.vpkt-sub h3{font-size:20px;margin-bottom:14px;}
.vpkt-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(121,242,255,.22);margin:20px 0;}
.vpkt-table{width:100%;border-collapse:collapse;font-size:14px;}
.vpkt-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--vpkt-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.vpkt-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vpkt-text);vertical-align:top;}
.vpkt-table tr:last-child td{border-bottom:none;}
.vpkt-table tr:hover td{background:rgba(255,255,255,.03);}
.vpkt-pill{display:inline-block;padding:3px 10px;border-radius:99px;font-size:11px;font-weight:700;}
.vpkt-pill--red{background:rgba(251,113,133,.15);color:var(--vpkt-danger);border:1px solid rgba(251,113,133,.35);}
.vpkt-pill--yellow{background:rgba(245,158,11,.15);color:var(--vpkt-warn);border:1px solid rgba(245,158,11,.35);}
.vpkt-pill--green{background:rgba(34,197,94,.15);color:var(--vpkt-green);border:1px solid rgba(34,197,94,.35);}
.vpkt-quote{border-left:3px solid var(--vpkt-accent);background:rgba(121,242,255,.06);border-radius:0 14px 14px 0;padding:18px 22px;margin:24px 0;}
.vpkt-quote p{margin:0;color:var(--vpkt-soft);font-size:15px;}
.vpkt-timeline{position:relative;padding-left:40px;}
.vpkt-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vpkt-accent),var(--vpkt-violet));opacity:.35;border-radius:2px;}
.vpkt-tl-item{position:relative;margin-bottom:28px;}
.vpkt-tl-item:last-child{margin-bottom:0;}
.vpkt-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vpkt-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.vpkt-tl-item h3{font-size:17px;margin-bottom:8px;}
.vpkt-tl-item p{font-size:14.5px;margin:0;}
.vpkt-case-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:20px;}
@media(max-width:768px){.vpkt-case-grid{grid-template-columns:1fr;}}
.vpkt-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;}
.vpkt-case-card h3{font-size:16px;margin-bottom:12px;}
.vpkt-metrics{display:flex;flex-direction:column;gap:8px;margin-top:14px;}
.vpkt-metric{display:flex;align-items:baseline;gap:8px;}
.vpkt-metric .num{font-size:22px;font-weight:900;color:var(--vpkt-accent);flex-shrink:0;}
.vpkt-metric .lbl{font-size:13px;color:var(--vpkt-muted);}
.vpkt-price-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;}
@media(max-width:768px){.vpkt-price-grid{grid-template-columns:1fr;}}
.vpkt-price-card{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:20px;padding:26px 22px;}
.vpkt-price-card.featured{border-color:rgba(121,242,255,.45);background:rgba(121,242,255,.07);}
.vpkt-price-card .tier{font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vpkt-accent);margin-bottom:10px;}
.vpkt-price-card .amount{font-size:clamp(20px,2.5vw,28px);font-weight:900;color:#fff;line-height:1;margin-bottom:8px;}
.vpkt-price-card .inc{font-size:13px;color:var(--vpkt-muted);line-height:1.6;}
.vpkt-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.vpkt-faq-item{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.09);border-radius:14px;overflow:hidden;}
.vpkt-faq-q{padding:18px 24px;font-size:15px;font-weight:700;color:var(--vpkt-heading);cursor:pointer;display:flex;justify-content:space-between;align-items:center;gap:12px;}
.vpkt-faq-q::after{content:'▼';font-size:10px;color:var(--vpkt-accent);transition:transform .2s;}
.vpkt-faq-item.open .vpkt-faq-q::after{transform:rotate(180deg);}
.vpkt-faq-a{max-height:0;overflow:hidden;transition:max-height .3s ease;padding:0 24px;}
.vpkt-faq-item.open .vpkt-faq-a{max-height:800px;padding:0 24px 20px;}
.vpkt-cta-checklist{display:flex;flex-wrap:wrap;gap:10px;justify-content:center;margin:0 0 24px;padding:0;list-style:none;}
.vpkt-cta-checklist li{padding:8px 16px;border-radius:99px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);font-size:13px;color:var(--vpkt-muted);}
.vpkt-cta-checklist li::before{display:none;}
.ym-cta-block{margin:32px 0;padding:32px 28px;border-radius:20px;background:linear-gradient(135deg,rgba(121,242,255,.1),rgba(139,92,246,.08));border:1px solid rgba(121,242,255,.22);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.1);}
.ym-cta-block--footer-final{margin-top:0;margin-bottom:48px;}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(18px,2.5vw,24px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{font-size:15px;color:var(--vpkt-muted);margin:0 0 16px;max-width:640px;margin-left:auto;margin-right:auto;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-link--accent{color:var(--vpkt-accent);text-decoration:underline;}
</style>

<div class="vpkt-content">

<section class="vpkt-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
<div class="vpkt-cnt nero-ai-container">
<div class="vpkt-intro-grid nero-ai-intro-grid nero-ai-reveal">
<div class="vpkt-intro-text nero-ai-intro-text">
<p class="nero-ai-eyebrow">Лонгрид · ai карточки маркетплейс</p>
<p><strong>Коротко:</strong> AI-модератор карточек — предпубликационный контроль качества для Wildberries и Ozon. Нейросеть сверяет черновик с правилами площадки, SEO-полнотой и конверсионной структурой <strong>до</strong> отправки в личный кабинет. Nero Network внедряет пайплайн под ключ: аудит → чек-лист → интеграция с API и CRM → пилот → масштабирование.</p>
</div>
<div class="vpkt-intro-kpi" aria-label="Ключевые показатели">
<div class="vpkt-kpi-card"><div class="kv">15 млн</div><div class="kl">карточек/сутки WB CV</div><div class="ks">Habr / WB, 2026</div></div>
<div class="vpkt-kpi-card"><div class="kv">3 мин</div><div class="kl">ML-модерация Ozon</div><div class="ks">CNews, 2023</div></div>
<div class="vpkt-kpi-card"><div class="kv">40%</div><div class="kl">agentic AI отменят к 2027</div><div class="ks">Gartner, 2025</div></div>
<div class="vpkt-kpi-card"><div class="kv">80–250К ₽</div><div class="kl">ориентир внедрения</div><div class="ks">Nero Network</div></div>
</div>
</div>
</div>
</section>

<div class="vpkt-toc-outer">
<div class="vpkt-cnt">
<nav class="vpkt-toc" aria-label="Оглавление статьи">
<a href="#zachem-ai-proverka">Зачем</a>
<a href="#chto-proveryaet">Что проверяет</a>
<a href="#kak-rabotaet">Как работает</a>
<a href="#vnedrenie-pod-klyuch">Внедрение</a>
<a href="#stoimost">Стоимость</a>
<a href="#keisy">Кейсы</a>
<a href="#faq">FAQ</a>
<a href="#cta-proverit">Проверить</a>
</nav>
</div>
</div>

<section class="vpkt-section" id="zachem-ai-proverka">
<div class="vpkt-cnt">
<div class="vpkt-sh">
<span class="vpkt-eyebrow">Боль селлера</span>
<h2>Зачем селлерам <span class="vpkt-gt">AI-проверку</span> карточек товаров</h2>
<p>Карточка на маркетплейсе — точка контакта с покупателем, фильтр поиска и объект модерации площадки. Ошибка в заголовке, плашка на фото или пустой атрибут стоят позиции в выдаче и дней простоя SKU.</p>
</div>
<div class="vpkt-card nero-ai-reveal">
<p><strong>Определение:</strong> <em>AI проверка карточек товаров</em> — автоматизированная предмодерация черновика по трём слоям: регламенты WB/Ozon, SEO-полнота, конверсионная структура. Результат — отчёт с правками до публикации, а не «отклонено» после выгрузки.</p>
<p>Маркетплейсы уже проверяют карточки нейросетями, но <strong>после</strong> вашей отправки. Wildberries обрабатывает порядка <strong>15 млн карточек в сутки</strong> через computer vision (данные WB, <a href="https://habr.com/ru/companies/wildberries/articles/992716/" target="_blank" rel="noopener noreferrer">Habr</a>). Ozon проводит ML-модерацию примерно за <strong>3 минуты</strong> (<a href="https://www.cnews.ru/news/line/2023-03-20_ozon_uskoril_moderatsiyu_tovarov" target="_blank" rel="noopener noreferrer">CNews</a>). Nero Network закрывает разрыв: <strong>симулятор модератора WB/Ozon</strong> в контуре вашего бизнеса.</p>
</div>

<div class="vpkt-sub" id="stoit-otklonenie">
<div class="vpkt-sh vpkt-left">
<span class="vpkt-eyebrow">Цена отклонения</span>
<h3>Карточки отклоняют — сколько это стоит бизнесу</h3>
</div>
<div class="vpkt-table-wrap nero-ai-reveal">
<table class="vpkt-table">
<thead><tr><th>Параметр</th><th>Wildberries</th><th>Ozon</th></tr></thead>
<tbody>
<tr><td>Повторная модерация после правок</td><td>до 24–72 ч</td><td>до 24 ч</td></tr>
<tr><td>Типовой риск</td><td>плашки, CV-нарушения на фото</td><td>контакты в карточке, штрафы</td></tr>
<tr><td>Штраф за контакты / нарушения</td><td>плашка «WB рекомендует» — до 1 млн ₽</td><td>1000 ₽/карточка при неустранении (<a href="https://sellplus.ru/blog/klientam/shtrafy-ozon-dlya-prodavtsov-polnyy-gayd-po-sisteme-sanktsiy/" target="_blank" rel="noopener noreferrer">SellPlus</a>)</td></tr>
<tr><td>Масштаб автомодерации</td><td>~15 млн карточек/сутки, precision ≥90%</td><td>ML ~3 мин на карточку</td></tr>
</tbody>
</table>
</div>
<p><strong>Итог:</strong> одна отклонённая карточка — задержка продаж, повторная работа контент-менеджера, риск штрафа. При десятках SKU в неделю ручной контроль перестаёт справляться.</p>
<div class="vpkt-quote">
<p><strong>CTA (мягкий):</strong> Скачайте <strong>чек-лист карточки товара</strong> — 25 пунктов предпубликационной проверки для WB и Ozon.</p>
</div>
</div>

<div class="vpkt-sub" id="ruchnaya-ne-masshtabiruetsya">
<div class="vpkt-sh vpkt-left">
<span class="vpkt-eyebrow">Масштаб</span>
<h3>Ручная модерация не масштабируется на сотни SKU</h3>
</div>
<div class="vpkt-card nero-ai-reveal">
<p>Контент-менеджер вычитывает 5–10 карточек в день. Агентство с 15 клиентами и 200+ SKU на каждого — сотни черновиков в месяц. Рынок переполнен <strong>генераторами</strong> (MPStats, SellerDen, ESEO, Fabula), но они редко встраиваются в ваш CRM/PIM и не считают <strong>% проходимости с первой попытки</strong>. Если черновики карточек приходят из почты менеджеров, на предыдущем этапе воронки помогает <a href="/vnedrenie-ai-obrabotka-email-crm/">AI-обработка входящей почты в CRM</a> — классификация писем и постановка задач контент-команде до выгрузки на маркетплейс.</p>
<p>По прогнозу <strong>Gartner</strong>, более <strong>40% agentic AI-проектов будут отменены к концу 2027</strong> — из-за неясного ROI и слабого risk control (<a href="https://www.gartner.com/en/newsroom/press-releases/2025-06-25-gartner-predicts-over-40-percent-of-agentic-ai-projects-will-be-canceled-by-end-of-2027" target="_blank" rel="noopener noreferrer">пресс-релиз</a>). Выигрывает <strong>измеримый workflow</strong>: черновик → AI-скоринг → человек → API — как Amazon Enhance My Listing.</p>
</div>
</div>
</div>
</section>

<section id="vpkt-boris-viz" class="vpkt-b-root" aria-label="Анимация: карточка товара проходит три слоя AI-скоринга перед публикацией на WB/Ozon">
<style>
/* === БОРИС: prefix vpkt-b-, scoped #vpkt-boris-viz === */
#vpkt-boris-viz.vpkt-b-root{padding:56px 0 64px;background:#f0f4fb;}
#vpkt-boris-viz .vpkt-b-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#vpkt-boris-viz .vpkt-b-card{display:grid;grid-template-columns:minmax(0,44%) minmax(0,56%);border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);min-height:500px;}
@media(max-width:1023px){#vpkt-boris-viz .vpkt-b-card{grid-template-columns:1fr;min-height:auto;}}
#vpkt-boris-viz .vpkt-b-lft{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0;}
@media(max-width:1023px){#vpkt-boris-viz .vpkt-b-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}}
#vpkt-boris-viz .vpkt-b-ey{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0ea5e9;margin:0 0 14px;}
#vpkt-boris-viz .vpkt-b-ey::before{content:'';width:18px;height:2px;background:#0ea5e9;border-radius:1px;}
#vpkt-boris-viz .vpkt-b-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;}
#vpkt-boris-viz .vpkt-b-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#vpkt-boris-viz .vpkt-b-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#vpkt-boris-viz .vpkt-b-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(14,165,233,.1);display:flex;align-items:center;justify-content:center;font-size:11px;color:#0369a1;margin-top:1px;font-style:normal;}
#vpkt-boris-viz .vpkt-b-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#vpkt-boris-viz .vpkt-b-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
#vpkt-boris-viz .vpkt-b-pl-r{background:rgba(251,113,133,.1);color:#be123c;border:1.5px solid rgba(251,113,133,.3);}
#vpkt-boris-viz .vpkt-b-pl-y{background:rgba(245,158,11,.1);color:#b45309;border:1.5px solid rgba(245,158,11,.3);}
#vpkt-boris-viz .vpkt-b-pl-g{background:rgba(34,197,94,.1);color:#15803d;border:1.5px solid rgba(34,197,94,.3);}
#vpkt-boris-viz .vpkt-b-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#vpkt-boris-viz .vpkt-b-rgt{position:relative;background:linear-gradient(145deg,#07091a 0%,#0d1224 55%,#090d1f 100%);min-height:440px;overflow:hidden;}
@media(max-width:1023px){#vpkt-boris-viz .vpkt-b-rgt{min-height:380px;}}
#vpkt-card-pipeline-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="vpkt-b-cnt">
<div class="vpkt-b-card">
<div class="vpkt-b-lft">
<span class="vpkt-b-ey">Пайплайн модерации</span>
<h3 class="vpkt-b-h3">Черновик карточки проходит три слоя скоринга — до клика «опубликовать»</h3>
<ul class="vpkt-b-ul">
<li><span class="vpkt-b-ic">1</span><strong>Модерация WB/Ozon</strong> — плашки на фото, контакты, категория, обязательные поля</li>
<li><span class="vpkt-b-ic">2</span><strong>SEO-слой</strong> — заголовок, ключи, фильтры, уникальность описания</li>
<li><span class="vpkt-b-ic">3</span><strong>Конверсия</strong> — УТП, характеристики, rich-контент, согласованность визуала</li>
<li><span class="vpkt-b-ic">✓</span>Human approval → автопубликация через WB Content API / Ozon Seller API</li>
</ul>
<div class="vpkt-b-pills">
<span class="vpkt-b-pl vpkt-b-pl-r">Красный — блокер</span>
<span class="vpkt-b-pl vpkt-b-pl-y">Жёлтый — рекомендация</span>
<span class="vpkt-b-pl vpkt-b-pl-g">Зелёный — готово</span>
</div>
<p class="vpkt-b-foot">Дальше — что именно проверяет каждый слой AI-модератора →</p>
</div>
<div class="vpkt-b-rgt">
<canvas id="vpkt-card-pipeline-canvas" aria-label="Анимация: карточка товара движется через станции модерации, SEO и конверсии с цветовым скорингом" role="img"></canvas>
</div>
</div>
</div>
<script>
(function(){
'use strict';
var cv=document.getElementById('vpkt-card-pipeline-canvas');
if(!cv)return;
var ctx=cv.getContext('2d'),W=0,H=0,fr=0;
function resize(){var p=cv.parentElement;if(!p)return;cv.width=p.clientWidth||640;cv.height=p.clientHeight||480;W=cv.width;H=cv.height;}
window.addEventListener('resize',resize);resize();
var C={red:'#fb7185',yellow:'#fbbf24',green:'#4ade80',cyan:'#79f2ff',viol:'#a78bfa',text:'#e2e8f0',muted:'rgba(226,232,240,.45)',line:'rgba(255,255,255,.08)',card:'rgba(255,255,255,.07)',bdr:'rgba(255,255,255,.14)'};
var STATIONS=[
{label:'Черновик',sub:'фото + поля',clr:C.cyan,x:0.12},
{label:'Модерация',sub:'CV + правила',clr:C.red,x:0.32},
{label:'SEO',sub:'ключи + фильтры',clr:C.yellow,x:0.52},
{label:'Конверсия',sub:'УТП + визуал',clr:C.green,x:0.72},
{label:'Approval',sub:'человек → API',clr:C.viol,x:0.90}
];
var card={t:0,stage:0,alpha:0,issues:['плашка -30%','SEO OK','УТП ✓']};
function rr(x,y,w,h,r,f,s,lw){ctx.beginPath();if(ctx.roundRect)ctx.roundRect(x,y,w,h,r);else ctx.rect(x,y,w,h);if(f){ctx.fillStyle=f;ctx.fill();}if(s){ctx.strokeStyle=s;ctx.lineWidth=lw||1.5;ctx.stroke();}}
function drawStation(s,idx,pulse){
var cx=s.x*W,cy=H*0.38,r=34;
ctx.strokeStyle=C.line;ctx.lineWidth=2;ctx.setLineDash([4,6]);ctx.beginPath();ctx.moveTo(cx,cy+r+8);ctx.lineTo(cx,H*0.78);ctx.stroke();ctx.setLineDash([]);
rr(cx-r,cy-r,r*2,r*2,r,C.card,C.bdr,1.5);
ctx.fillStyle=s.clr;ctx.font='bold 11px Inter,sans-serif';ctx.textAlign='center';ctx.fillText(s.label,cx,cy-4);
ctx.fillStyle=C.muted;ctx.font='10px Inter,sans-serif';ctx.fillText(s.sub,cx,cy+12);
if(idx===card.stage){ctx.strokeStyle=s.clr;ctx.lineWidth=2;ctx.beginPath();ctx.arc(cx,cy,r+6+pulse*4,0,Math.PI*2);ctx.stroke();}
}
function drawProductCard(x,y,sc,alpha){
ctx.globalAlpha=alpha||1;
var w=72*sc,h=96*sc;
rr(x-w/2,y-h/2,w,h,8,'rgba(255,255,255,.12)',C.cyan,1.5);
rr(x-w/2+8,y-h/2+10,w-16,h*0.45,4,'rgba(121,242,255,.15)',null,0);
ctx.fillStyle=C.text;ctx.font='bold 9px Inter,sans-serif';ctx.textAlign='center';ctx.fillText('SKU',x,y-h/2+h*0.35);
ctx.fillStyle=C.muted;ctx.font='8px Inter,sans-serif';ctx.fillText('кардочка',x,y+h/2-14);
ctx.globalAlpha=1;
}
function drawScoreBadge(x,y,txt,clr){
rr(x-28,y-10,56,20,10,clr+'22',clr,1);
ctx.fillStyle=clr;ctx.font='bold 9px Inter,sans-serif';ctx.textAlign='center';ctx.fillText(txt,x,y+4);
}
function loop(){
fr++;var pulse=Math.sin(fr/30)*0.5+0.5;
ctx.clearRect(0,0,W,H);
ctx.strokeStyle=C.line;ctx.lineWidth=2;ctx.beginPath();ctx.moveTo(W*0.08,H*0.38);ctx.lineTo(W*0.94,H*0.38);ctx.stroke();
STATIONS.forEach(function(s,i){drawStation(s,i,pulse);});
card.t=(card.t+0.004)%1;
var prog=card.t;
var seg=1/(STATIONS.length-1);
var idx=Math.min(Math.floor(prog/seg),STATIONS.length-2);
var local=(prog-idx*seg)/seg;
var x0=STATIONS[idx].x*W,x1=STATIONS[idx+1].x*W;
var cx=x0+(x1-x0)*local;
var cy=H*0.38-50+Math.sin(fr/25)*6;
drawProductCard(cx,cy,1,0.95);
if(prog>0.15)drawScoreBadge(cx-40,cy-55,'CV ✗',C.red);
if(prog>0.35)drawScoreBadge(cx,cy-55,'SEO ✓',C.yellow);
if(prog>0.55)drawScoreBadge(cx+40,cy-55,'CTR ↑',C.green);
ctx.fillStyle=C.muted;ctx.font='11px Inter,sans-serif';ctx.textAlign='left';ctx.fillText('WB/Ozon · AI-модератор · human-in-the-loop',18,H-22);
requestAnimationFrame(loop);
}
loop();
})();
</script>
</section>

<section class="vpkt-section vpkt-section-alt" id="chto-proveryaet">
<div class="vpkt-cnt">
<div class="vpkt-sh">
<span class="vpkt-eyebrow">Три слоя скоринга</span>
<h2>Что проверяет <span class="vpkt-gt">AI-модератор</span> карточки</h2>
<p>Не «ещё одна нейросеть для карточек маркетплейс», а три независимые слои в одном отчёте: <span class="vpkt-pill vpkt-pill--red">красный</span> блокирует, <span class="vpkt-pill vpkt-pill--yellow">жёлтый</span> рекомендует, <span class="vpkt-pill vpkt-pill--green">зелёный</span> готово.</p>
</div>

<div class="vpkt-sub" id="pravila-wb-ozon">
<div class="vpkt-card nero-ai-reveal">
<h3>Слой 1 — правила WB и Ozon: обязательные поля и запреты</h3>
<p>Rule-engine сверяет черновик с регламентом категории: обязательные атрибуты, запрет контактов и QR в тексте и инфографике, соответствие категории и бренда, флаг документов для ручной проверки.</p>
<p><strong>AI-vision</strong> анализирует фото: плашки «-50%», водяные знаки, несовпадение цвета на фото и в атрибуте, контакты на изображении. WB использует ансамбль <strong>70+ моделей</strong> в production (<a href="https://habr.com/ru/companies/rwb/articles/1059776/" target="_blank" rel="noopener noreferrer">Habr/RWB</a>). Nero даёт селлеру <strong>зеркальный чек-лист</strong> — что ищет CV площадки — <strong>до</strong> отправки.</p>
</div>
</div>

<div class="vpkt-sub" id="seo-kartochki">
<div class="vpkt-card nero-ai-reveal nero-ai-delay-1">
<h3>Слой 2 — SEO карточки: заголовок, описание, ключи</h3>
<ul>
<li>длина и структура заголовка (WB ~40–60 символов, Ozon до 200);</li>
<li>вхождение ключевых запросов без переспама;</li>
<li>уникальность описания и заполненность фильтров;</li>
<li>семантическое ядро по SKU — сравнение с топ-10 в нише.</li>
</ul>
<p>Отличие Nero: скоринг расширен на <strong>модерационные риски</strong>, а не только SEO-балл.</p>
</div>
</div>

<div class="vpkt-sub" id="konversiya">
<div class="vpkt-card nero-ai-reveal nero-ai-delay-2">
<h3>Слой 3 — конверсия: УТП, характеристики, визуал</h3>
<ul>
<li>УТП на первом слайде и в первых строках описания;</li>
<li>логика характеристик — иерархия выгод, не «хаотичная простыня»;</li>
<li>полнота размерной сетки, комплектации, rich-контента;</li>
<li>согласованность цены, остатков и визуала.</li>
</ul>
<p>Кейс FOKINA.AI: до <strong>1000 карточек в час</strong>, ускорение вывода <strong>44%</strong> (<a href="https://companies.rbc.ru/news/hk6QRVG3WE/1000-kartochek-tovarov-v-chas-kejs-vnedreniya-ii-v-fmcg/" target="_blank" rel="noopener noreferrer">РБК</a>). Nero добавляет <strong>слой проверки до выгрузки</strong>.</p>
</div>
<div class="vpkt-table-wrap nero-ai-reveal" style="margin-top:24px;">
<table class="vpkt-table">
<thead><tr><th>SaaS-генератор (MPStats, ESEO)</th><th>AI-модератор Nero Network</th></tr></thead>
<tbody>
<tr><td>Генерация и аудит внутри подписки</td><td>Внедрение в контур клиента (CRM, PIM, API)</td></tr>
<tr><td>Общий чек-лист площадки</td><td>Кастомные правила бренда + категории</td></tr>
<tr><td>Нет метрики % проходимости с 1-й попытки</td><td>Дашборд проходимости и журнал ошибок</td></tr>
<tr><td>Human-in-the-loop опционален</td><td>Обязательный approval gate перед API</td></tr>
</tbody>
</table>
</div>
</div>
</div>
</section>

<section class="vpkt-section" id="kak-rabotaet">
<div class="vpkt-cnt">
<div class="vpkt-sh">
<span class="vpkt-eyebrow">Пайплайн</span>
<h2>Как работает <span class="vpkt-gt">AI-проверка</span> карточек до публикации</h2>
</div>

<div class="vpkt-card nero-ai-reveal" id="pipeline-publikaciya">
<h3>Черновик → нейросеть → отчёт → правки → публикация</h3>
<div class="vpkt-timeline">
<div class="vpkt-tl-item"><div class="vpkt-tl-dot"></div><h3>1. Загрузка черновика</h3><p>Менеджер загружает фото + JSON полей в форму или выгружает из CRM/PIM.</p></div>
<div class="vpkt-tl-item"><div class="vpkt-tl-dot"></div><h3>2. Rule-engine</h3><p>Проверка обязательных полей категории и регламента площадки.</p></div>
<div class="vpkt-tl-item"><div class="vpkt-tl-dot"></div><h3>3. NLP + AI-vision</h3><p>Текст: запретные формулировки, спам ключей. Фото: плашки, водяные знаки, контакты.</p></div>
<div class="vpkt-tl-item"><div class="vpkt-tl-dot"></div><h3>4. SEO + конверсия</h3><p>Скоринг и сравнение с конкурентами. Отчёт: красный / жёлтый / зелёный + конкретная правка.</p></div>
<div class="vpkt-tl-item"><div class="vpkt-tl-dot"></div><h3>5. Human approval → API</h3><p>Человек утверждает → автопубликация через WB Content API / Ozon Seller API.</p></div>
</div>
<p style="margin-top:20px;"><strong>Что делает AI:</strong> сверяет с регламентами, находит риски, предлагает правки, ведёт скоринг очереди. <strong>Что остаётся за человеком:</strong> финальное утверждение, юридически значимые документы, стратегия позиционирования.</p>
</div>

<div class="vpkt-sub" id="integracii">
<div class="vpkt-sh vpkt-left"><h3>Интеграция с API WB/Ozon, CRM и Google Sheets</h3></div>
<div class="vpkt-table-wrap nero-ai-reveal">
<table class="vpkt-table">
<thead><tr><th>Система</th><th>Роль в пайплайне</th></tr></thead>
<tbody>
<tr><td><strong>WB Content API / Ozon Seller API</strong></td><td>Публикация после approval</td></tr>
<tr><td><strong>amoCRM / Bitrix24</strong></td><td>Статусы карточек, задачи контент-менеджеру</td></tr>
<tr><td><strong>Google Sheets</strong></td><td>Staging-зона для черновиков и отчётов</td></tr>
<tr><td><strong>Make / n8n</strong></td><td>Оркестрация: черновик → AI → уведомление → API</td></tr>
<tr><td><strong>1С / МойСклад</strong></td><td>Выгрузка номенклатуры и остатков</td></tr>
<tr><td><strong>YandexGPT / GigaChat / Claude / OpenAI</strong></td><td>NLP-слой — по политике клиента</td></tr>
</tbody>
</table>
</div>
<p class="vpkt-related nero-ai-reveal" style="margin-top:20px;font-size:15px">Для синхронизации статусов карточек с <strong>amoCRM</strong> сопоставьте сценарий с <a href="/vnedrenie-ai-amocrm/" style="color:var(--vpkt-accent,#79f2ff);text-decoration:underline;text-underline-offset:3px">внедрением AI-агента в amoCRM под ключ</a> — автоматизация сделок и задач контент-команды без ручного переноса данных между системами.</p>
</div>
</div>
</section>

<div class="vpkt-cnt">
<aside class="ym-cta-block ym-cta-block--primary" id="cta-ekspress-audit">
<div class="ym-cta-block__icon" aria-hidden="true">🛒</div>
<div class="ym-cta-block__body">
<p class="ym-cta-block__headline">Проверить карточки бесплатно</p>
<p class="ym-cta-block__sub">Экспресс-аудит 1 SKU: AI-скоринг по правилам WB/Ozon, SEO и конверсии — отчёт с приоритетами правок за 1–2 рабочих дня.</p>
<a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Проверить карточки</a>
</div>
</aside>
</div>

<section class="vpkt-section" id="vnedrenie-pod-klyuch">
<div class="vpkt-cnt">
<div class="vpkt-sh">
<span class="vpkt-eyebrow">Под ключ</span>
<h2>Внедрение <span class="vpkt-gt">AI проверки карточек</span> под ключ</h2>
<p>Управляемый проект с метриками — не разовая настройка ChatGPT.</p>
</div>

<div class="vpkt-sub" id="etapy-vnedreniya">
<div class="vpkt-timeline nero-ai-reveal">
<div class="vpkt-tl-item"><div class="vpkt-tl-dot"></div><h3>Этап 1. Аудит (1–2 недели)</h3><p>Карта процесса, 20–50 примеров отклонённых карточек, бенчмарк времени и % проходимости.</p></div>
<div class="vpkt-tl-item"><div class="vpkt-tl-dot"></div><h3>Этап 2. Чек-лист и AI-модули (2–3 недели)</h3><p>Регламенты WB/Ozon, NLP, CV, SEO-скорер, бренд-гайд.</p></div>
<div class="vpkt-tl-item"><div class="vpkt-tl-dot"></div><h3>Этап 3. Интеграция (1–2 недели)</h3><p>Make/n8n → CRM → API, дашборд, обучение команды.</p></div>
<div class="vpkt-tl-item"><div class="vpkt-tl-dot"></div><h3>Этап 4. Пилот 50–100 SKU (2–4 недели)</h3><p>Метрики проходимости, время на карточку, корректировка чек-листа.</p></div>
<div class="vpkt-tl-item"><div class="vpkt-tl-dot"></div><h3>Этап 5. Масштабирование</h3><p>Новые категории, клиенты (для агентств), автопубликация через API.</p></div>
</div>
</div>

<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
<div class="ym-cta-block__body">
<p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
<p class="ym-cta-block__sub">Перед внедрением AI-модератора полезно разобраться в n8n, промптах и human-in-the-loop — это ускоряет согласование чек-листа. Посмотрите <a href="<?php echo esc_url($secondary_cta_url ?: nero_ai_primary_cta_url('')); ?>" class="ym-link ym-link--accent"<?php echo $secondary_cta_attrs; ?>><?php echo esc_html($secondary_cta_label); ?></a>.</p>
</div>
</aside>

<div class="vpkt-sub" id="komanda-sroki">
<div class="vpkt-card nero-ai-reveal">
<h3>Сроки и состав команды Nero Network</h3>
<p>Типовой проект <strong>ai проверка карточек товаров под ключ</strong> — <strong>6–10 недель</strong> от аудита до пилота.</p>
<ul>
<li><strong>Аналитик маркетплейсов</strong> — чек-лист площадки, категории, причины отклонений;</li>
<li><strong>AI-инженер</strong> — NLP, CV, скоринг, выбор модели;</li>
<li><strong>Интегратор</strong> — API WB/Ozon, Make/n8n, CRM;</li>
<li><strong>Менеджер проекта</strong> — метрики, обучение, приёмка.</li>
</ul>
</div>
</div>
</div>
</section>

<section class="vpkt-section" id="stoimost">
<div class="vpkt-cnt">
<div class="vpkt-sh">
<span class="vpkt-eyebrow">Коммерция</span>
<h2>Сколько стоит и что входит <span class="vpkt-gt">в проект</span></h2>
</div>

<div class="vpkt-sub" id="orientir-cheka">
<div class="vpkt-price-grid nero-ai-reveal">
<div class="vpkt-price-card"><div class="tier">Старт</div><div class="amount">80–120 тыс. ₽</div><div class="inc">Аудит, чек-лист, AI-скоринг текста, отчёт в Sheets, обучение. Селлер до 100 SKU, один МП.</div></div>
<div class="vpkt-price-card featured"><div class="tier">Бизнес</div><div class="amount">120–180 тыс. ₽</div><div class="inc">+ CV-проверка фото, SEO-слой, Make/n8n, пилот 50 SKU. 100–500 SKU, агентство.</div></div>
<div class="vpkt-price-card"><div class="tier">Под ключ</div><div class="amount">180–250 тыс. ₽</div><div class="inc">+ API WB/Ozon, CRM, дашборд, 2 площадки. Производитель, крупное агентство.</div></div>
</div>
<p style="margin-top:20px;text-align:center;">ROI: дни простоя SKU, часы ручной вычитки, штрафы Ozon <strong>1000 ₽/карточка</strong>, риск WB до <strong>1 млн ₽</strong>.</p>
<div class="vpkt-quote">
<p><strong>CTA:</strong> Узнать <strong>цену внедрения</strong> под ваш каталог — оставьте количество SKU и площадки.</p>
</div>
</div>

<div class="vpkt-sub" id="scenarii-biznes">
<div class="vpkt-grid-3 nero-ai-reveal">
<div class="vpkt-card"><h3>Малый бизнес</h3><p>Google Sheets + AI-отчёт, фокус на топ-20 SKU с наибольшей маржой, чек-лист как ритуал перед выгрузкой.</p></div>
<div class="vpkt-card"><h3>Агентство</h3><p>Мультиаккаунт, отдельные чек-листы под категории, дашборд ошибок копирайтеров, white-label отчёт.</p></div>
<div class="vpkt-card"><h3>Производитель</h3><p>На стороне учёта — <a href="/ai-1c-erp/">AI-агент для 1С и ERP: внедрение под ключ</a>: выгрузка номенклатуры и остатков, пакетная проверка новинок, адаптация карточек под WB/Ozon.</p></div>
</div>
</div>
</div>
</section>

<section class="vpkt-section vpkt-section-alt" id="keisy">
<div class="vpkt-cnt">
<div class="vpkt-sh">
<span class="vpkt-eyebrow">Результаты</span>
<h2>Кейсы: <span class="vpkt-gt">до и после</span> AI-модерации</h2>
</div>

<div class="vpkt-sub" id="menshe-otklonenii">
<div class="vpkt-case-grid nero-ai-reveal">
<div class="vpkt-case-card">
<h3>Референс: FOKINA.AI (FMCG)</h3>
<p><strong>1000 карточек/час</strong>, ускорение публикации <strong>×2</strong>, <strong>−73%</strong> затрат на агентства. Nero добавляет предмодерацию.</p>
</div>
<div class="vpkt-case-card">
<h3>Проектная модель Nero (пилот)</h3>
<div class="vpkt-table-wrap" style="margin-top:12px;border:none;">
<table class="vpkt-table">
<thead><tr><th>Метрика</th><th>До</th><th>После</th></tr></thead>
<tbody>
<tr><td>% проходимости с 1-й попытки</td><td>55–65%</td><td>85–92%</td></tr>
<tr><td>Циклов «отклонено → правка»</td><td>1,8</td><td>0,3–0,5</td></tr>
<tr><td>Время на карточку</td><td>45–60 мин</td><td>15–20 мин</td></tr>
</tbody>
</table>
</div>
<p style="font-size:12px;margin-top:10px;">*Ориентир пилота; зависит от категории и дисциплины approval gate.</p>
</div>
</div>
</div>

<div class="vpkt-sub" id="rost-konversii">
<div class="vpkt-card nero-ai-reveal">
<h3>Рост конверсии за счёт SEO и текстов</h3>
<p>Референс Amazon Enhance My Listing: <strong>+40%</strong> к качеству листинга, <strong>90%</strong> контента принимают без правок. Типовой эффект SEO+конверсионного слоя Nero: рост показов, CTR, единый стандарт текстов между SKU.</p>
</div>
</div>
</div>
</section>

<section class="vpkt-section" id="faq">
<div class="vpkt-cnt">
<div class="vpkt-sh">
<span class="vpkt-eyebrow">Вопрос — ответ</span>
<h2>FAQ по <span class="vpkt-gt">AI-проверке</span> карточек</h2>
</div>

<div class="vpkt-faq nero-ai-reveal">
<div class="vpkt-faq-item" id="bez-programmista">
<div class="vpkt-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли без программиста?</div>
<div class="vpkt-faq-a"><p><strong>Да</strong>, если внедрение под ключ. Интегратор Nero настраивает Make/n8n, API и CRM. Программист нужен только при нестандартной ERP — оценивается на аудите.</p></div>
</div>
<div class="vpkt-faq-item" id="integraciya-crm">
<div class="vpkt-faq-q" tabindex="0" role="button" aria-expanded="false">Как интегрировать с CRM и PIM?</div>
<div class="vpkt-faq-a"><p>Статусы «черновик → на проверке → одобрено → опубликовано» синхронизируются с amoCRM или Bitrix24. AI-отчёт прикрепляется к сделке. Публикация — по кнопке «Утвердить» через API WB/Ozon.</p></div>
</div>
<div class="vpkt-faq-item" id="otlichie-ot-saas">
<div class="vpkt-faq-q" tabindex="0" role="button" aria-expanded="false">Чем отличается от встроенных ассистентов и SaaS?</div>
<div class="vpkt-faq-a">
<div class="vpkt-table-wrap" style="margin-bottom:12px;">
<table class="vpkt-table">
<thead><tr><th>Критерий</th><th>SaaS / встроенные</th><th>Nero Network</th></tr></thead>
<tbody>
<tr><td>Момент проверки</td><td>После публикации или в SaaS</td><td><strong>До</strong> публикации, в вашем контуре</td></tr>
<tr><td>Кастомные правила</td><td>Ограничены</td><td>Полный лексикон и чек-лист</td></tr>
<tr><td>CRM/API</td><td>Нет</td><td>Make, n8n, WB/Ozon API</td></tr>
<tr><td>Метрика проходимости</td><td>Не в фокусе</td><td>Дашборд % с 1-й попытки</td></tr>
</tbody>
</table>
</div>
<p>Gartner: <strong>40%</strong> agentic AI-проектов отменят — нужен измеримый процесс, а не автономный агент.</p>
</div>
</div>
<div class="vpkt-faq-item">
<div class="vpkt-faq-q" tabindex="0" role="button" aria-expanded="false">Это заменит контент-менеджера?</div>
<div class="vpkt-faq-a"><p>Нет. AI снимает рутину по 25 пунктам; человек утверждает, задаёт стратегию, работает с документами. Как у Amazon: AI предлагает — продавец решает.</p></div>
</div>
<div class="vpkt-faq-item">
<div class="vpkt-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько стоит ai проверка карточек товаров?</div>
<div class="vpkt-faq-a"><p>Ориентир <strong>80–250 тыс. ₽</strong> в зависимости от пакета. Точная смета — после аудита и экспресс-скоринга 1–3 SKU.</p></div>
</div>
<div class="vpkt-faq-item">
<div class="vpkt-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить ai проверка карточек товаров?</div>
<div class="vpkt-faq-a"><p>Аудит → чек-лист → настройка AI → интеграция → пилот 50–100 SKU → масштабирование. Срок <strong>6–10 недель</strong>. Nero ведёт проект под ключ.</p></div>
</div>
</div>
</div>
</section>

<section class="vpkt-section" id="cta-proverit" style="background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08));">
<div class="vpkt-cnt" style="text-align:center;">
<span class="vpkt-eyebrow">Следующий шаг</span>
<h2 style="font-size:clamp(28px,4.2vw,52px);margin:14px auto 16px;max-width:720px;">Проверить карточки — <span class="vpkt-gt">бесплатный экспресс-аудит</span></h2>
<p style="max-width:600px;margin:0 auto 20px;font-size:16px;">Вы теряете выручку на отклонённой карточке и слабом тексте. Nero Network внедряет AI-модератор: правила WB/Ozon + SEO + конверсия, human-in-the-loop, интеграция с API и CRM.</p>
<p style="max-width:600px;margin:0 auto 24px;"><strong>Лид-магнит:</strong> чек-лист карточки товара — 25 пунктов предпубликационной проверки для WB и Ozon.</p>
<ul class="vpkt-cta-checklist">
<li>Экспресс-аудит 1 SKU</li>
<li>AI-скоринг по 3 слоям</li>
<li>Приоритеты правок</li>
<li>Внедрение 6–10 недель</li>
</ul>
<div class="ym-cta-block__actions">
<a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="font-size:16px;padding:16px 36px;"<?php echo $primary_cta_attrs; ?>>Проверить карточки</a>
<a href="#vnedrenie-pod-klyuch" class="nero-ai-btn nero-ai-btn-secondary ym-btn" style="font-size:15px;padding:14px 28px;">Внедрение под ключ</a>
</div>
</div>
</section>

<div class="vpkt-cnt">
<div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
<div class="ym-cta-block__body">
<p class="ym-cta-block__headline">Готовы снизить отклонения карточек?</p>
<p class="ym-cta-block__sub">Бесплатный экспресс-аудит 1 SKU — первый шаг к AI-модератору в вашем контуре.</p>
<a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Проверить карточки</a>
</div>
</div>
</div>

</div><!-- /.vpkt-content -->

<script>
(function(){
document.querySelectorAll('.vpkt-faq-q').forEach(function(btn){
btn.addEventListener('click',function(){
var item=btn.closest('.vpkt-faq-item');
var isOpen=item.classList.contains('open');
document.querySelectorAll('.vpkt-faq-item.open').forEach(function(el){
el.classList.remove('open');
var q=el.querySelector('.vpkt-faq-q');
if(q)q.setAttribute('aria-expanded','false');
});
if(!isOpen){item.classList.add('open');btn.setAttribute('aria-expanded','true');}
});
btn.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();btn.click();}});
});
})();
</script>

<!-- INTERNAL-LINKS:INSERT
  1. /vnedrenie-ai-obrabotka-email-crm/ — «AI-обработка входящей почты в CRM» (#ruchnaya-ne-masshtabiruetsya)
  2. /vnedrenie-ai-amocrm/ — «внедрение AI-агента в amoCRM под ключ» (#integracii)
  3. /ai-1c-erp/ — «AI-агент для 1С и ERP: внедрение под ключ» (#scenarii-biznes)
-->
<?php
$vpkt_page_url = trailingslashit( get_permalink() );
$vpkt_site_url = trailingslashit( home_url( '/' ) );
$vpkt_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$vpkt_h1       = 'AI проверка карточек товаров: внедрение под ключ';
$vpkt_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $vpkt_site_url . '#organization',
      'name'  => $vpkt_brand,
      'url'   => $vpkt_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $vpkt_site_url . '#website',
      'url'       => $vpkt_site_url,
      'name'      => $vpkt_brand,
      'publisher' => [ '@id' => $vpkt_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $vpkt_page_url . '#webpage',
      'url'         => $vpkt_page_url,
      'name'        => $vpkt_h1,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $vpkt_site_url . '#website' ],
      'about'       => [ '@id' => $vpkt_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $vpkt_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $vpkt_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $vpkt_h1, 'item' => $vpkt_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $vpkt_page_url . '#service',
      'name'        => $vpkt_h1,
      'description' => $page_seo_description,
      'url'         => $vpkt_page_url,
      'provider'    => [ '@id' => $vpkt_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $vpkt_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Можно ли без программиста?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да, если внедрение под ключ. Интегратор Nero настраивает Make/n8n, API и CRM. Программист нужен только при нестандартной ERP — оценивается на аудите.' ] ],
        [ '@type' => 'Question', 'name' => 'Как интегрировать с CRM и PIM?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Статусы «черновик → на проверке → одобрено → опубликовано» синхронизируются с amoCRM или Bitrix24. AI-отчёт прикрепляется к сделке. Публикация — по кнопке «Утвердить» через API WB/Ozon.' ] ],
        [ '@type' => 'Question', 'name' => 'Чем отличается от встроенных ассистентов и SaaS?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Момент проверки: SaaS / встроенные — после публикации или в SaaS; Nero Network — до публикации, в вашем контуре. Кастомные правила: SaaS — ограничены; Nero — полный лексикон и чек-лист. CRM/API: SaaS — нет; Nero — Make, n8n, WB/Ozon API. Метрика проходимости: SaaS — не в фокусе; Nero — дашборд % с 1-й попытки. Gartner: 40% agentic AI-проектов отменят — нужен измеримый процесс, а не автономный агент.' ] ],
        [ '@type' => 'Question', 'name' => 'Это заменит контент-менеджера?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет. AI снимает рутину по 25 пунктам; человек утверждает, задаёт стратегию, работает с документами. Как у Amazon: AI предлагает — продавец решает.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько стоит ai проверка карточек товаров?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Ориентир 80–250 тыс. ₽ в зависимости от пакета. Точная смета — после аудита и экспресс-скоринга 1–3 SKU.' ] ],
        [ '@type' => 'Question', 'name' => 'Как внедрить ai проверка карточек товаров?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Аудит → чек-лист → настройка AI → интеграция → пилот 50–100 SKU → масштабирование. Срок 6–10 недель. Nero ведёт проект под ключ.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $vpkt_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "
";
?>

<script>
(function(){
  var root = document.querySelector('.vpkt-content') || document.querySelector('.vpkt-page');
  if (!root) return;
  var items = root.querySelectorAll('.nero-ai-reveal');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if (entry.isIntersecting) {
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

<script>
(function () {
  var canvas = document.getElementById("vpkt-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, cx = 0, cy = 0, frame = 0, scale = 1;
  var bubbles = [];

  function resize() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 240;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 8;
    scale = Math.min(cw / 520, ch / 280, 1.15);
  }
  window.addEventListener("resize", resize);
  resize();

  var C = {
    outline: "#0f172a",
    cyan: "#79f2ff",
    violet: "#8b5cf6",
    green: "#22c55e",
    warn: "#f59e0b",
    danger: "#fb7185",
    card: "#f8fafc",
    muted: "rgba(226,232,240,0.45)",
    hub: "#1e293b",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0"
  };

  function rr(x, y, w, h, r, fill, stroke, lw) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    if (fill) { ctx.fillStyle = fill; ctx.fill(); }
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = lw || 1.5; ctx.stroke(); }
  }

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life, max: life });
  }

  /* Горизонтальные слоты SKU — вместо Conveyor */
  function ListingSlotCarousel() {
    this.slots = [
      { offset: 0, color: "#cbd5e1", label: "SKU" },
      { offset: 55, color: "#fde68a", label: "WB" },
      { offset: 110, color: "#bfdbfe", label: "OZ" }
    ];
  }
  ListingSlotCarousel.prototype.draw = function (g) {
    var prg = (frame * 0.042) % 280;
    rr(-200, 58, 400, 28, 8, "rgba(71,85,105,0.35)", "rgba(148,163,184,0.4)", 1);
    for (var i = 0; i < 5; i++) {
      var sx = -170 + i * 72 + ((frame * 0.35) % 72);
      rr(sx, 62, 48, 20, 5, "rgba(255,255,255,0.06)", "rgba(255,255,255,0.12)", 1);
    }
    this.slots.forEach(function (s) {
      var t = ((frame * 0.4 + s.offset) % 140) / 140;
      var dx = -160 + t * 320;
      var dy = 68;
      if (t < 0.88) {
        rr(dx - 14, dy - 12, 28, 34, 4, s.color, C.outline, 1.2);
        g.fillStyle = C.outline;
        g.font = "bold 7px Inter,sans-serif";
        g.textAlign = "center";
        g.fillText(s.label, dx, dy + 4);
      }
    });
    if (prg > 8 && prg < 18) createBubble(-120, 40, "Черновик в слот", 200);
  };

  /* Центральный хаб карточки — вместо WebsiteTerminal */
  function CardModerationHub() {
    this.layer = 0;
  }
  CardModerationHub.prototype.draw = function (g) {
    var prg = (frame * 0.042) % 280;
    rr(-62, -72, 124, 148, 12, C.hub, C.outline, 2);
    rr(-56, -66, 112, 22, [8, 8, 0, 0], "rgba(121,242,255,0.18)", null, 0);
    g.fillStyle = C.cyan;
    g.font = "bold 8px Inter,sans-serif";
    g.textAlign = "left";
    g.fillText("WB · Ozon", -50, -52);

    /* Мини-карточка */
    rr(-48, -38, 96, 72, 6, C.card, C.outline, 1.2);
    rr(-44, -34, 40, 40, 4, "#e2e8f0", C.outline, 1);
    /* плашка на фото */
    if (prg >= 70 && prg < 140) {
      rr(-42, -30, 28, 10, 2, C.danger, C.outline, 1);
      g.fillStyle = "#fff";
      g.font = "bold 6px Inter,sans-serif";
      g.textAlign = "center";
      g.fillText("−30%", -28, -22);
    }
    for (var r = 0; r < 3; r++) {
      g.fillStyle = "#94a3b8";
      g.fillRect(-2, -28 + r * 8, 40 + r * 6, 3);
    }

    /* Три слоя скоринга */
    var layers = [
      { label: "Мод", color: C.danger, from: 70 },
      { label: "SEO", color: C.green, from: 140 },
      { label: "CTR", color: C.warn, from: 175 }
    ];
    layers.forEach(function (ly, i) {
      var on = prg >= ly.from;
      rr(38, -58 + i * 22, 42, 16, 4, on ? ly.color + "33" : "rgba(255,255,255,0.06)", on ? ly.color : "rgba(255,255,255,0.15)", 1);
      g.fillStyle = on ? ly.color : C.muted;
      g.font = "bold 7px Inter,sans-serif";
      g.textAlign = "center";
      g.fillText(ly.label, 59, -47 + i * 22);
    });

    if (prg >= 140 && prg < 150) createBubble(20, -90, "SEO 87% — ок", 220);
    if (prg >= 75 && prg < 85) createBubble(-10, -95, "CV: плашка!", 220);
  };

  /* CV-луч по фото */
  function PhotoBadgeScanner() {
    this.beam = -40;
  }
  PhotoBadgeScanner.prototype.draw = function (g) {
    var prg = (frame * 0.042) % 280;
    if (prg < 70 || prg >= 140) return;
    var scan = (prg - 70) / 70;
    this.beam = -44 + scan * 88;
    g.save();
    g.globalAlpha = 0.35 + Math.sin(frame * 0.15) * 0.12;
    g.fillStyle = "rgba(251,113,133,0.55)";
    g.fillRect(this.beam - 2, -72, 4, 44);
    g.strokeStyle = C.danger;
    g.lineWidth = 1.5;
    g.strokeRect(this.beam - 16, -70, 32, 40);
    g.restore();
  };

  /* Кольцо SEO */
  function SeoCompletenessGauge() {
    this.pct = 0;
  }
  SeoCompletenessGauge.prototype.draw = function (g) {
    var prg = (frame * 0.042) % 280;
    if (prg < 140) return;
    this.pct = Math.min(87, ((prg - 140) / 50) * 87);
    g.strokeStyle = "rgba(255,255,255,0.12)";
    g.lineWidth = 5;
    g.beginPath();
    g.arc(92, -18, 18, 0, Math.PI * 2);
    g.stroke();
    g.strokeStyle = C.green;
    g.beginPath();
    g.arc(92, -18, 18, -Math.PI / 2, -Math.PI / 2 + (this.pct / 100) * Math.PI * 2);
    g.stroke();
    g.fillStyle = C.green;
    g.font = "bold 8px Inter,sans-serif";
    g.textAlign = "center";
    g.fillText(Math.round(this.pct) + "%", 92, -16);
  };

  /* Шлюз публикации */
  function PublishTurnstile() {
    this.angle = 0;
    this.open = 0;
  }
  PublishTurnstile.prototype.draw = function (g) {
    var prg = (frame * 0.042) % 280;
    rr(118, 18, 56, 48, 8, "rgba(34,197,94,0.12)", C.green, 1.2);
    g.fillStyle = C.green;
    g.font = "bold 7px Inter,sans-serif";
    g.textAlign = "center";
    g.fillText("API", 146, 30);
    if (prg >= 210) {
      this.open = Math.min(1, (prg - 210) / 40);
      g.save();
      g.translate(146, 48);
      g.rotate(this.open * 0.9);
      g.fillStyle = C.green;
      g.fillRect(-4, -22, 8, 44);
      g.restore();
      if (prg > 230 && prg < 245) {
        rr(128, 38, 36, 22, 4, C.card, C.outline, 1);
        g.fillStyle = C.outline;
        g.font = "bold 6px Inter,sans-serif";
        g.fillText("OK", 146, 52);
      }
      if (prg > 248 && prg < 258) createBubble(150, 10, "→ WB API", 200);
    }
  };

  /* Бункер отклонений */
  function RejectionHopper() {
    this.pulse = 0;
  }
  RejectionHopper.prototype.draw = function (g) {
    var prg = (frame * 0.042) % 280;
    rr(-168, 22, 44, 36, 6, "rgba(251,113,133,0.12)", C.danger, 1);
    g.fillStyle = C.danger;
    g.font = "bold 7px Inter,sans-serif";
    g.textAlign = "center";
    g.fillText("RED", -144, 38);
    if (prg >= 80 && prg < 100) {
      this.pulse = Math.sin(frame * 0.2) * 3;
      rr(-156 + this.pulse, 46, 20, 14, 3, C.danger, C.outline, 1);
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
  Agent.prototype.draw = function (g) {
    var prg = (frame * 0.042) % 280;
    this.timer += 0.03;
    var isMoving = false, faceDir = 1;
    var targetX = 0, targetY = -20 + this.stepTrig * 0.35;
    if (prg >= this.stepTrig && prg < this.stepTrig + 28) {
      var local = prg - this.stepTrig;
      if (local < 12) {
        isMoving = true;
        this.x = this.baseX + (targetX - this.baseX) * (local / 12);
        this.y = this.baseY + (targetY - this.baseY) * (local / 12);
      } else if (local < 18) {
        this.x = targetX; this.y = targetY;
      } else {
        isMoving = true; faceDir = -1;
        var back = (local - 18) / 10;
        this.x = targetX - (targetX - this.baseX) * back;
        this.y = targetY - (targetY - this.baseY) * back;
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
    }
    if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 240);
    }
    var bob = isMoving ? Math.abs(Math.sin(this.timer * 3)) * 2 : Math.sin(this.timer * 1.5);
    g.save();
    g.translate(this.x, this.y);
    rr(-10, -4 + bob, 8, 12, 2, C.outline, null, 0);
    rr(-12, 8 + bob, 10, 5, 2, C.outline, null, 0);
    rr(2, -4 + bob, 8, 12, 2, C.outline, null, 0);
    rr(0, 8 + bob, 10, 5, 2, C.outline, null, 0);
    rr(-14, -14 - bob, 28, 18, 5, this.color, C.outline, 1.5);
    g.fillStyle = this.color;
    g.beginPath();
    g.arc(0, -26 - bob, 10, 0, Math.PI * 2);
    g.fill();
    g.strokeStyle = C.outline;
    g.lineWidth = 1.5;
    g.stroke();
    g.restore();
  };

  var carousel = new ListingSlotCarousel();
  var hub = new CardModerationHub();
  var scanner = new PhotoBadgeScanner();
  var gauge = new SeoCompletenessGauge();
  var turnstile = new PublishTurnstile();
  var hopper = new RejectionHopper();

  var agents = [
    new Agent(-150, 95, C.agentYellow, "1_architect", 20, ["Чек-лист категории", "25 пунктов правил", "WB + Ozon слой"]),
    new Agent(-95, 100, C.agentGreen, "2_seo", 145, ["Заголовок 58 симв.", "Ключи без переспама", "SEO-полнота 87%"]),
    new Agent(-40, 95, C.agentBlue, "3_coder", 60, ["Rule-engine ON", "API WB Content", "Журнал отклонений"]),
    new Agent(50, 100, C.agentPink, "4_designer", 75, ["Плашка −30% — красный", "Водяной знак?", "CV слой активен"]),
    new Agent(110, 95, C.agentPurple, "5_deployer", 215, ["Human approved", "Шлюз → API", "Без автопоста"])
  ];

  function drawBubbles(g) {
    bubbles = bubbles.filter(function (b) {
      b.life--;
      if (b.life <= 0) return false;
      var a = b.life / b.max;
      g.globalAlpha = a;
      var tw = g.measureText(b.text).width + 14;
      rr(b.x - tw / 2, b.y - 18, tw, 16, 6, C.bubbleBg, C.cyan, 1);
      g.fillStyle = C.bubbleText;
      g.font = "bold 7px Inter,sans-serif";
      g.textAlign = "center";
      g.fillText(b.text, b.x, b.y - 6);
      g.globalAlpha = 1;
      return true;
    });
  }

  function loop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    var prg = (frame * 0.042) % 280;
    if (prg === 30) createBubble(-80, -100, "25 пунктов чек-листа", 260);
    if (prg === 160) createBubble(60, -100, "Human-in-the-loop", 260);

    carousel.draw(ctx);
    hopper.draw(ctx);
    hub.draw(ctx);
    scanner.draw(ctx);
    gauge.draw(ctx);
    turnstile.draw(ctx);
    agents.forEach(function (a) { a.draw(ctx); });
    drawBubbles(ctx);

    ctx.restore();
    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

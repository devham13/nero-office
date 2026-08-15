<?php
/**
 * Template Name: AI-рекомендательная система для допродаж в интернет-магазине
 * Description: SEO-лендинг — внедрение AI-рекомендаций товаров под ключ. Калькулятор AOV, кейсы, интеграция CRM.
 */

$page_seo_title       = 'AI-рекомендации товаров для интернет-магазина: внедрение под ключ';
$page_seo_description = 'Внедряем AI-рекомендации для допродаж: комплекты, cross-sell, персональные предложения. Калькулятор роста AOV, кейсы, интеграция с CRM. Расчёт бесплатно.';

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
	[ 'label' => 'Калькулятор', 'href' => '#kalkulyator-aov' ],
	[ 'label' => 'Как работает', 'href' => '#kak-rabotaet' ],
	[ 'label' => 'Интеграции', 'href' => '#integracii' ],
	[ 'label' => 'Этапы', 'href' => '#etapy' ],
	[ 'label' => 'Кейсы', 'href' => '#keisy' ],
	[ 'label' => 'Стоимость', 'href' => '#cena' ],
	[ 'label' => 'FAQ', 'href' => '#faq' ],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if ( ! is_readable( $nero_ai_bootstrap ) ) {
	$nero_ai_bootstrap = dirname( __DIR__ ) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv( 'PRIMARY_CTA_LABEL' ) ?: 'Увеличить допродажи';
$primary_cta_url     = nero_ai_primary_cta_url( getenv( 'PRIMARY_CTA_URL' ) ?: '' );
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs( $primary_cta_url );
$secondary_cta_label = getenv( 'SECONDARY_CTA_LABEL' ) ?: 'Обучение AI';
$secondary_cta_url   = getenv( 'SECONDARY_CTA_URL' ) ?: '#kak-rabotaet';

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

.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}

.ai-rekomendacii-tovarov-doprodazhi-page .nero-ai-btn{
  display:inline-flex;align-items:center;justify-content:center;
  min-height:48px;padding:14px 20px;border-radius:999px;
  font-size:15px;font-weight:800;line-height:1;text-decoration:none!important;
  transition:transform .22s ease,border-color .22s ease,background .22s ease;
}
.ai-rekomendacii-tovarov-doprodazhi-page .nero-ai-btn:hover{transform:translateY(-2px);}
.ai-rekomendacii-tovarov-doprodazhi-page .nero-ai-btn-primary{
  color:#031018!important;
  background:linear-gradient(135deg,#86efac,#79f2ff);
  box-shadow:0 18px 42px rgba(34,197,94,.22);
}
.ai-rekomendacii-tovarov-doprodazhi-page .nero-ai-btn-secondary{
  color:#e6edf7!important;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.14);
}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;}
.ym-btn--accent{background:linear-gradient(135deg,#2563eb,#7c3aed);color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-rekomendacii-tovarov-doprodazhi-page" role="main" tabindex="-1">

<section class="nero-ai-hero ard-hero-reco" id="hero" aria-labelledby="ard-hero-reco-title">
  <style>
  /* ── Hero AI-рекомендации: самодостаточные стили (канон meta-journal.ru) ── */
  .ard-hero-reco {
    --ard-cyan: #79f2ff;
    --ard-violet: #8b5cf6;
    --ard-green: #22c55e;
    --ard-text: #e6edf7;
    --ard-muted: #9aa8bd;
    --ard-soft: #c7d2e5;
    --ard-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
    position: relative;
    min-height: min(980px, calc(100dvh - 1px));
    display: grid;
    align-items: center;
    padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
    isolation: isolate;
  }
  .ard-hero-reco::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image:
      linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
      linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
    background-size: 64px 64px;
    mask-image: radial-gradient(circle at 45% 30%, #000 0%, transparent 72%);
    opacity: .55;
    pointer-events: none;
    z-index: -2;
  }
  .ard-hero-reco::after {
    content: "";
    position: absolute;
    left: 50%;
    top: 16%;
    width: 820px;
    height: 820px;
    transform: translateX(-50%);
    border-radius: 999px;
    background: radial-gradient(circle, rgba(34, 197, 94, .10), rgba(121, 242, 255, .08), transparent 66%);
    filter: blur(6px);
    animation: ardHeroGlow 8s ease-in-out infinite alternate;
    z-index: -1;
    pointer-events: none;
  }
  @keyframes ardHeroGlow {
    from { opacity: .45; transform: translateX(-50%) scale(.96); }
    to { opacity: .86; transform: translateX(-50%) scale(1.06); }
  }
  .ard-hero-reco .nero-ai-container {
    width: min(1220px, calc(100% - 40px));
    margin: 0 auto;
    position: relative;
    z-index: 1;
  }
  .ard-hero-reco .nero-ai-hero-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
    gap: clamp(28px, 4vw, 56px);
    align-items: center;
  }
  .ard-hero-reco .nero-ai-hero-copy h1 {
    margin: 0;
    max-width: 780px;
    font-size: clamp(36px, 5.4vw, 68px);
    line-height: .95;
    letter-spacing: -0.065em;
    color: #fff;
    font-weight: 900;
  }
  .ard-hero-reco .nero-ai-gradient-text {
    background: linear-gradient(92deg, #fff 0%, var(--ard-cyan) 38%, #86efac 72%, var(--ard-violet) 100%);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent !important;
  }
  .ard-hero-reco .nero-ai-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin: 0 0 16px;
    padding: 8px 12px;
    border: 1px solid rgba(34, 197, 94, 0.22);
    border-radius: 999px;
    background: rgba(34, 197, 94, 0.08);
    color: #86efac !important;
    font-size: 13px;
    font-weight: 750;
    line-height: 1;
    text-transform: uppercase;
    letter-spacing: 0.11em;
  }
  .ard-hero-reco .nero-ai-hero-lead {
    margin: 24px 0 0;
    max-width: 720px;
    color: var(--ard-soft) !important;
    font-size: clamp(17px, 1.9vw, 21px);
    line-height: 1.58;
  }
  .ard-hero-reco .nero-ai-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin: 26px 0 0;
    padding: 0;
    list-style: none;
  }
  .ard-hero-reco .nero-ai-badge {
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
  .ard-hero-reco .nero-ai-btn-row {
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
    align-items: center;
    margin-top: 34px;
  }
  .ard-hero-reco .nero-ai-btn {
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
  .ard-hero-reco .nero-ai-btn:hover { transform: translateY(-2px); }
  .ard-hero-reco .nero-ai-btn-primary {
    color: #031018 !important;
    background: linear-gradient(135deg, #86efac, var(--ard-cyan));
    box-shadow: 0 18px 42px rgba(34, 197, 94, 0.22);
  }
  .ard-hero-reco .nero-ai-btn-secondary {
    color: var(--ard-text) !important;
    background: rgba(255, 255, 255, 0.07);
    border-color: rgba(255, 255, 255, 0.14);
  }
  .ard-hero-reco .nero-ai-dashboard {
    position: relative;
    padding: 18px;
    border-radius: 34px;
    background: rgba(2, 6, 23, 0.42);
    box-shadow: var(--ard-shadow);
    transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
  }
  .ard-hero-reco .nero-ai-dashboard-shell {
    overflow: hidden;
    border: 1px solid rgba(255,255,255,.12);
    border-radius: 26px;
    background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
  }
  .ard-hero-reco .nero-ai-window-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    padding: 14px 16px;
    border-bottom: 1px solid rgba(255,255,255,.08);
    background: rgba(255,255,255,.045);
  }
  .ard-hero-reco .nero-ai-dots { display: flex; gap: 7px; }
  .ard-hero-reco .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
  .ard-hero-reco .nero-ai-dot:nth-child(1) { background: #fb7185; }
  .ard-hero-reco .nero-ai-dot:nth-child(2) { background: #fbbf24; }
  .ard-hero-reco .nero-ai-dot:nth-child(3) { background: #34d399; }
  .ard-hero-reco .nero-ai-window-title {
    color: #cfe3f9;
    font-size: 11px;
    font-weight: 750;
    letter-spacing: .08em;
    text-transform: uppercase;
  }
  .ard-hero-reco .nero-ai-window-body { padding: 16px; }
  .ard-hero-reco .nero-ai-dashboard-title {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 14px;
  }
  .ard-hero-reco .nero-ai-dashboard-title h3 {
    margin: 0;
    font-size: 18px;
    letter-spacing: -0.03em;
    color: #fff;
  }
  .ard-hero-reco .nero-ai-live-pill {
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
  .ard-hero-reco .nero-ai-live-pill::before {
    content: "";
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #22c55e;
    box-shadow: 0 0 0 6px rgba(34,197,94,.14);
    animation: ardPulse 1.6s infinite;
  }
  @keyframes ardPulse {
    0%, 100% { transform: scale(.86); opacity: .65; }
    50% { transform: scale(1); opacity: 1; }
  }
  .ard-hero-reco .nero-ai-metrics-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 10px;
    margin-bottom: 12px;
  }
  .ard-hero-reco .nero-ai-metric {
    padding: 12px;
    border: 1px solid rgba(255,255,255,.09);
    border-radius: 16px;
    background: rgba(255,255,255,.055);
    transition: transform .22s ease, border-color .22s ease;
  }
  .ard-hero-reco .nero-ai-metric:hover {
    transform: translateY(-2px);
    border-color: rgba(34, 197, 94, .34);
  }
  .ard-hero-reco .nero-ai-metric span {
    display: block;
    color: var(--ard-muted);
    font-size: 11px;
    font-weight: 700;
  }
  .ard-hero-reco .nero-ai-metric strong {
    display: block;
    margin-top: 6px;
    color: #fff;
    font-size: 22px;
    line-height: 1;
  }
  .ard-hero-reco .nero-ai-metric strong.ard-metric-up { color: #86efac; }
  .ard-hero-reco .nero-ai-metric small {
    display: block;
    margin-top: 5px;
    color: #9fb0c9;
    font-size: 10px;
  }
  .ard-hero-reco .ard-dash-canvas-wrap {
    position: relative;
    width: 100%;
    height: 220px;
    margin: 4px 0 12px;
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid rgba(121, 242, 255, 0.14);
    background:
      radial-gradient(circle at 50% 40%, rgba(34, 197, 94, 0.08), transparent 55%),
      rgba(0, 0, 0, 0.25);
  }
  .ard-hero-reco #ard-reco-hero-canvas {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    display: block;
  }
  .ard-hero-reco .nero-ai-task-stream { display: grid; gap: 8px; }
  .ard-hero-reco .nero-ai-task {
    display: grid;
    grid-template-columns: 28px 1fr auto;
    align-items: center;
    gap: 10px;
    padding: 10px;
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 14px;
    background: rgba(255,255,255,.04);
    animation: ardTaskFloat 5s ease-in-out infinite;
  }
  .ard-hero-reco .nero-ai-task:nth-child(2) { animation-delay: .6s; }
  .ard-hero-reco .nero-ai-task:nth-child(3) { animation-delay: 1.2s; }
  @keyframes ardTaskFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-3px); }
  }
  .ard-hero-reco .nero-ai-task-icon {
    display: grid;
    place-items: center;
    width: 28px;
    height: 28px;
    border-radius: 10px;
    background: rgba(34, 197, 94, 0.12);
    color: #86efac;
    font-size: 11px;
    font-weight: 800;
  }
  .ard-hero-reco .nero-ai-task strong {
    display: block;
    color: #f8fafc;
    font-size: 12px;
  }
  .ard-hero-reco .nero-ai-task div > span {
    color: var(--ard-muted);
    font-size: 11px;
  }
  .ard-hero-reco .nero-ai-status {
    padding: 4px 8px;
    border-radius: 999px;
    background: rgba(34,197,94,.11);
    color: #bbf7d0;
    font-size: 10px;
    font-weight: 800;
    white-space: nowrap;
  }
  .ard-hero-reco .nero-ai-status--violet {
    background: rgba(139, 92, 246, 0.15);
    color: #ddd6fe;
  }
  @media (max-width: 1100px) {
    .ard-hero-reco .nero-ai-hero-grid { grid-template-columns: 1fr; }
    .ard-hero-reco .nero-ai-dashboard { transform: none; }
  }
  @media (max-width: 600px) {
    .ard-hero-reco .nero-ai-metrics-grid { grid-template-columns: 1fr; }
    .ard-hero-reco .nero-ai-task { grid-template-columns: 28px 1fr; }
    .ard-hero-reco .nero-ai-status { grid-column: 2; width: fit-content; }
    .ard-hero-reco .ard-dash-canvas-wrap { height: 190px; }
  }
  @media (prefers-reduced-motion: reduce) {
    .ard-hero-reco::after,
    .ard-hero-reco .nero-ai-live-pill::before,
    .ard-hero-reco .nero-ai-task { animation: none !important; }
  }
  </style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · e-commerce / рекомендации</p>
      <h1 id="ard-hero-reco-title">AI-рекомендательная система для допродаж в интернет-магазине: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Нейросеть подбирает комплекты, товары-компаньоны и персональные допродажи — чтобы средний чек рос без ручного cross-sell</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Cross-sell / upsell</li>
        <li class="nero-ai-badge">Рост AOV</li>
        <li class="nero-ai-badge">CRM + каталог</li>
        <li class="nero-ai-badge">Пилот 2–4 нед.</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kalkulyator-aov">Рассчитать рост AOV</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-рекомендации и рост среднего чека">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">рекомендации · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-допродажи онлайн</h3>
            <span class="nero-ai-live-pill">live</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Средний чек</span><strong class="ard-metric-up">+12%</strong><small>vs baseline</small></div>
            <div class="nero-ai-metric"><span>Attach rate</span><strong>28%</strong><small>заказов с доп. SKU</small></div>
            <div class="nero-ai-metric"><span>Выручка</span><strong>24%</strong><small>с рекомендаций</small></div>
            <div class="nero-ai-metric"><span>Клик на блок</span><strong>×4,6</strong><small>CR vs визит</small></div>
          </div>

          <div class="ard-dash-canvas-wrap" aria-hidden="false">
            <canvas id="ard-reco-hero-canvas" role="img" aria-label="Анимация: товары по орбитам ранжируются AI, собираются в комплект корзины и поднимают средний чек"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий допродаж">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">PDP</span>
              <div><strong>Карточка товара</strong><span>AI: комплект +2 SKU</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">🛒</span>
              <div><strong>Корзина</strong><span>Cross-sell принят</span></div>
              <span class="nero-ai-status">+1 240 ₽</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Заказ оформлен</strong><span>Тег: reco_attributed</span></div>
              <span class="nero-ai-status nero-ai-status--violet">новое</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
/* === ARD CONTENT: prefix ard-, scoped внутри .ard-content === */
.ard-content{
  --ard-bg:#050711;--ard-bg2:#080b17;--ard-bg3:#0a0e1c;
  --ard-surface:rgba(255,255,255,.072);--ard-surface2:rgba(255,255,255,.108);
  --ard-text:#e6edf7;--ard-muted:#9aa8bd;--ard-soft:#c7d2e5;--ard-heading:#fff;
  --ard-border:rgba(255,255,255,.10);--ard-border-s:rgba(255,255,255,.18);
  --ard-accent:#79f2ff;--ard-violet:#8b5cf6;--ard-green:#22c55e;--ard-cyan:#79f2ff;
  --ard-btn-from:#2563eb;--ard-btn-to:#7c3aed;
  --ard-shadow:0 24px 72px rgba(0,0,0,.4);
  --ard-r:18px;--ard-r-lg:24px;--ard-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--ard-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.ard-content *,.ard-content *::before,.ard-content *::after{box-sizing:border-box;}
.ard-content a{color:inherit;text-decoration:none;}
.ard-content p{color:var(--ard-muted);line-height:1.72;margin:0 0 1em;}
.ard-content p:last-child{margin-bottom:0;}
.ard-content h2,.ard-content h3,.ard-content h4{color:var(--ard-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.ard-content strong{color:var(--ard-soft);}
.ard-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.ard-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--ard-muted);font-size:14.5px;line-height:1.65;}
.ard-content ul li::before{content:'›';position:absolute;left:0;color:var(--ard-accent);font-weight:700;}
.ard-cnt{width:min(var(--ard-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.ard-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.ard-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.ard-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.ard-sh.ard-left{margin-left:0;text-align:left;}
.ard-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.ard-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.ard-sh.ard-left p{margin-left:0;}
.ard-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--ard-accent);margin-bottom:14px;}
.ard-gt{background:linear-gradient(92deg,#fff 0%,var(--ard-accent) 44%,var(--ard-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.ard-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.ard-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.ard-intro-text{position:relative;padding-left:20px;}
.ard-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--ard-accent),var(--ard-violet));}
.ard-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--ard-muted);margin-bottom:1em;}
.ard-intro-text p:last-child{margin-bottom:0;color:var(--ard-soft);}
.ard-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.ard-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.ard-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--ard-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.ard-kpi-card .kl{font-size:11px;font-weight:600;color:var(--ard-muted);line-height:1.4;}
.ard-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.ard-intro-grid{grid-template-columns:1fr;gap:36px;}.ard-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.ard-intro-kpi{grid-template-columns:1fr 1fr;}}
.ard-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.ard-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.ard-toc a{display:inline-block;padding:9px 18px;background:var(--ard-surface);border:1px solid var(--ard-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--ard-muted);transition:border-color .2s,color .2s,background .2s;}
.ard-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--ard-accent);background:rgba(121,242,255,.08);}
.ard-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--ard-border);border-radius:var(--ard-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.ard-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.ard-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.ard-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.ard-grid-2,.ard-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.ard-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.ard-grid-3{grid-template-columns:1fr;}}
.ard-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--ard-r);padding:26px;margin-bottom:14px;transition:border-color .2s;}
.ard-scenario:last-child{margin-bottom:0;}
.ard-scenario:hover{border-color:rgba(121,242,255,.3);}
.ard-scenario h3{font-size:17px;margin-bottom:8px;}
.ard-scenario p{font-size:14.5px;margin:0 0 .6em;}
.ard-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.ard-table{width:100%;border-collapse:collapse;font-size:14px;}
.ard-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--ard-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.ard-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--ard-text);vertical-align:top;}
.ard-table tr:last-child td{border-bottom:none;}
.ard-table tr:hover td{background:rgba(255,255,255,.03);}
.ard-timeline{position:relative;padding-left:40px;}
.ard-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--ard-accent),var(--ard-violet));opacity:.35;border-radius:2px;}
.ard-tl-item{position:relative;margin-bottom:32px;}
.ard-tl-item:last-child{margin-bottom:0;}
.ard-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--ard-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.ard-tl-item h3{font-size:17px;margin-bottom:8px;}
.ard-tl-item p{font-size:14.5px;margin:0;}
.ard-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.ard-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.ard-case-grid{grid-template-columns:1fr;}}
.ard-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;}
.ard-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.ard-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--ard-green);margin-bottom:10px;}
.ard-case-card h3{font-size:16px;margin-bottom:14px;}
.ard-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.ard-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.ard-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--ard-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.ard-faq-q::after{content:'▾';font-size:13px;color:var(--ard-accent);flex-shrink:0;transition:transform .25s;}
.ard-faq-item.open .ard-faq-q::after{transform:rotate(180deg);}
.ard-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--ard-muted);line-height:1.72;}
.ard-faq-item.open .ard-faq-a{max-height:600px;padding:0 24px 20px;}
.ard-delta-pos{color:var(--ard-green);font-weight:800;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--ard-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-link--accent{color:#79f2ff;text-decoration:underline;text-underline-offset:3px;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

/* === Калькулятор AOV === */
#kalkulyator-aov .ard-calc-shell{
  display:grid;grid-template-columns:minmax(0,1fr) minmax(0,1fr);gap:28px;align-items:stretch;
}
@media(max-width:960px){#kalkulyator-aov .ard-calc-shell{grid-template-columns:1fr;}}
.ard-calc-form{
  background:linear-gradient(180deg,rgba(255,255,255,.09),rgba(255,255,255,.04));
  border:1px solid rgba(121,242,255,.22);border-radius:var(--ard-r-lg);padding:28px;
}
.ard-calc-field{margin-bottom:18px;}
.ard-calc-field label{display:block;font-size:13px;font-weight:700;color:var(--ard-soft);margin-bottom:8px;}
.ard-calc-field input[type=number]{
  width:100%;padding:12px 14px;border-radius:12px;border:1px solid rgba(255,255,255,.14);
  background:rgba(5,7,17,.6);color:var(--ard-heading);font-size:16px;font-weight:600;
}
.ard-calc-field input:focus{outline:none;border-color:rgba(121,242,255,.5);box-shadow:0 0 0 3px rgba(121,242,255,.12);}
.ard-calc-scenarios{display:flex;flex-wrap:wrap;gap:8px;margin-top:8px;}
.ard-calc-scenario{
  flex:1;min-width:100px;padding:10px 12px;border-radius:12px;border:1.5px solid rgba(255,255,255,.12);
  background:rgba(255,255,255,.04);color:var(--ard-muted);font-size:12px;font-weight:700;cursor:pointer;
  transition:border-color .2s,background .2s;text-align:center;
}
.ard-calc-scenario.is-active{border-color:rgba(34,197,94,.5);background:rgba(34,197,94,.1);color:var(--ard-green);}
.ard-calc-scenario small{display:block;font-weight:500;font-size:10px;margin-top:4px;opacity:.8;}
.ard-calc-results{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:20px;}
.ard-calc-res{
  padding:14px;border-radius:14px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);
}
.ard-calc-res span{display:block;font-size:11px;color:var(--ard-muted);margin-bottom:4px;}
.ard-calc-res strong{font-size:clamp(18px,2.5vw,22px);color:var(--ard-heading);letter-spacing:-.03em;}
.ard-calc-res.ard-calc-res--delta strong{color:var(--ard-green);}
.ard-calc-viz{
  position:relative;border-radius:var(--ard-r-lg);overflow:hidden;min-height:380px;
  background:linear-gradient(135deg,rgba(34,197,94,.06),rgba(121,242,255,.06));
  border:1px solid rgba(121,242,255,.18);
}
#ard-aov-calc-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
.ard-calc-disclaimer{font-size:12px;color:#64748b;margin-top:16px;font-style:italic;}

/* === БОРИС: prefix ard-b-, scoped #ai-rekomendacii-tovarov-doprodazhi-boris-block === */
#ai-rekomendacii-tovarov-doprodazhi-boris-block.ard-b-root{padding:56px 0 64px;background:#f0f4fb;}
#ai-rekomendacii-tovarov-doprodazhi-boris-block .ard-b-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#ai-rekomendacii-tovarov-doprodazhi-boris-block .ard-b-card{
  display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);border-radius:22px;overflow:hidden;
  background:#fff;box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);min-height:500px;
}
@media(max-width:1023px){
  #ai-rekomendacii-tovarov-doprodazhi-boris-block .ard-b-card{grid-template-columns:1fr;min-height:auto;}
}
#ai-rekomendacii-tovarov-doprodazhi-boris-block .ard-b-lft{
  padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-rekomendacii-tovarov-doprodazhi-boris-block .ard-b-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}
}
#ai-rekomendacii-tovarov-doprodazhi-boris-block .ard-b-ey{
  display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;
  text-transform:uppercase;color:#0ea5e9;margin:0 0 14px;
}
#ai-rekomendacii-tovarov-doprodazhi-boris-block .ard-b-ey::before{content:'';width:18px;height:2px;background:#0ea5e9;border-radius:1px;}
#ai-rekomendacii-tovarov-doprodazhi-boris-block .ard-b-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;}
#ai-rekomendacii-tovarov-doprodazhi-boris-block .ard-b-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#ai-rekomendacii-tovarov-doprodazhi-boris-block .ard-b-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#ai-rekomendacii-tovarov-doprodazhi-boris-block .ard-b-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(14,165,233,.1);
  display:flex;align-items:center;justify-content:center;font-size:11px;color:#0369a1;margin-top:1px;font-style:normal;
}
#ai-rekomendacii-tovarov-doprodazhi-boris-block .ard-b-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#ai-rekomendacii-tovarov-doprodazhi-boris-block .ard-b-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
#ai-rekomendacii-tovarov-doprodazhi-boris-block .ard-b-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-rekomendacii-tovarov-doprodazhi-boris-block .ard-b-pl-b{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22);}
#ai-rekomendacii-tovarov-doprodazhi-boris-block .ard-b-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);}
#ai-rekomendacii-tovarov-doprodazhi-boris-block .ard-b-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#ai-rekomendacii-tovarov-doprodazhi-boris-block .ard-b-rgt{
  position:relative;background:linear-gradient(135deg,#f0f9ff 0%,#e0f2fe 28%,#f5f3ff 72%,#f8fafc 100%);
  min-height:440px;overflow:hidden;
}
@media(max-width:1023px){#ai-rekomendacii-tovarov-doprodazhi-boris-block .ard-b-rgt{min-height:380px;}}
#ard-reco-crosssell-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>

<div class="ard-content">

  <section class="ard-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="ard-cnt">
      <div class="ard-intro-grid nero-ai-reveal">
        <div class="ard-intro-text">
          <p class="ard-eyebrow">Лонгрид · ai рекомендации товаров</p>
          <p><strong>Коротко:</strong> AI-рекомендательная система для допродаж — программный слой между каталогом, поведением покупателя и точками показа, который автоматически предлагает cross-sell, upsell и комплекты вместо статичных правил.</p>
          <p>Трафик есть, конверсия стабильна, а <strong>средний чек не растёт</strong> — покупатель уходит с одним товаром.</p>
          <!-- INTERNAL-LINKS:INSERT -->
          <p>Nero Network внедряет <strong>AI-рекомендации товаров под ключ</strong>: от аудита каталога и интеграции с WooCommerce, 1С-Битрикс, retailCRM до A/B-тестов и прозрачного расчёта роста AOV.</p>
        </div>
        <div class="ard-intro-kpi" aria-label="Ключевые метрики e-commerce">
          <div class="ard-kpi-card"><div class="kv">1 610 ₽</div><div class="kl">средний чек B2C РФ</div><div class="ks">Data Insight 2025</div></div>
          <div class="ard-kpi-card"><div class="kv">40%</div><div class="kl">enterprise apps с AI agents</div><div class="ks">Gartner 2026</div></div>
          <div class="ard-kpi-card"><div class="kv">+16%</div><div class="kl">AOV с рекомендациями</div><div class="ks">Retail Rocket кейс</div></div>
          <div class="ard-kpi-card"><div class="kv">2–4 нед.</div><div class="kl">пилот на корзине</div><div class="ks">типовой срок</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="ard-toc-outer">
    <div class="ard-cnt">
      <nav class="ard-toc" aria-label="Оглавление статьи">
        <a href="#bole-aov">Почему AOV не растёт</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#kalkulyator-aov">Калькулятор AOV</a>
        <a href="#integracii">Интеграции</a>
        <a href="#etapy">Этапы</a>
        <a href="#keisy">Кейсы</a>
        <a href="#cena">Стоимость</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="ard-section" id="bole-aov">
    <div class="ard-cnt">
      <div class="ard-sh ard-left">
        <span class="ard-eyebrow">Боль e-commerce</span>
        <h2>Почему средний чек не растёт и один товар в корзине — системная проблема</h2>
        <p>На российском B2C-рынке в 2025 году объём достиг <strong>13,4 трлн ₽</strong> при <strong>8,3 млрд заказов</strong>, но <strong>средний чек снизился до 1 610 ₽</strong> (−5% г/г). Data Insight прогнозирует снижение до <strong>1 550 ₽ в 2026</strong> — рынок растёт за счёт частоты, не чека.</p>
      </div>

      <div class="ard-grid-3 nero-ai-reveal">
        <div class="ard-card">
          <h3>Ручной cross-sell не масштабируется</h3>
          <p>Маркетолог вручную связывает десятки SKU в блоках «добавьте в комплект». При каталоге от 500 позиций правила устаревают за недели. <strong>AI допродажи</strong> масштабируют логику на весь ассортимент и каждую сессию.</p>
        </div>
        <div class="ard-card nero-ai-delay-1">
          <h3>Потери на этапах «карточка → корзина → чекаут»</h3>
          <p>По данным Salesforce (150 млн сессий), визиты с кликом на рекомендацию — <strong>7% визитов</strong>, но <strong>24% заказов</strong> и <strong>26% выручки</strong>; CR в <strong>4,6× выше</strong>, AOV при клике — <strong>+10%</strong>.</p>
        </div>
        <div class="ard-card nero-ai-delay-2">
          <h3>Что меняется с AI-рекомендациями</h3>
          <p>Система учитывает остатки, маржу, историю заказов и поведение в сессии. KPI: <strong>AOV</strong>, <strong>attach rate</strong>, <strong>revenue per session</strong>. В кейсах Retail Rocket прирост AOV до <strong>+16,3%</strong> и <strong>+8%</strong> в B2B.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="ard-section ard-section-alt" id="kak-rabotaet">
    <div class="ard-cnt">
      <div class="ard-sh">
        <span class="ard-eyebrow">Определение</span>
        <h2>Что такое AI-рекомендательная система для допродаж в e-commerce</h2>
        <p><strong>AI-рекомендательная система</strong> — связка каталога, событий на сайте, CRM/ERP, ML-ранжирования и виджетов показа для cross-sell, upsell и комплектов.</p>
      </div>

      <div class="ard-table-wrap nero-ai-reveal">
        <table class="ard-table">
          <thead><tr><th>Термин</th><th>Смысл в e-commerce</th></tr></thead>
          <tbody>
            <tr><td><strong>Cross-sell</strong></td><td>Сопутствующий товар к выбранному (чехол к телефону)</td></tr>
            <tr><td><strong>Upsell</strong></td><td>Более дорогая или расширенная версия в корзине</td></tr>
            <tr><td><strong>Bundle / комплект</strong></td><td>Набор SKU под сценарий, со скидкой или без</td></tr>
            <tr><td><strong>Персональная витрина</strong></td><td>Подборка под историю и поведение покупателя</td></tr>
          </tbody>
        </table>
      </div>

      <div class="ard-grid-2 nero-ai-reveal" style="margin-top:24px;">
        <div class="ard-scenario">
          <h3>От правил «с этим покупают» к персональным рекомендациям</h3>
          <p><strong>AI рекомендации товаров</strong> комбинируют collaborative filtering, content-based подход и бизнес-ограничения. Cold-start: popular + семантический match по описанию.</p>
        </div>
        <div class="ard-scenario">
          <h3>Task-specific AI agents в retail (Gartner 2026)</h3>
          <p>К концу <strong>2026 года 40% enterprise-приложений</strong> получат task-specific AI agents. Агент допродаж подбирает SKU в корзине, CRM и письме по единым правилам.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- БОРИС: визуальный блок после H2-2 -->
  <section id="ai-rekomendacii-tovarov-doprodazhi-boris-block" class="ard-b-root" aria-label="Анимация: AI подбирает товары-компаньоны и растит корзину">
    <div class="ard-b-cnt">
      <div class="ard-b-card">
        <div class="ard-b-lft">
          <span class="ard-b-ey">Путь покупателя</span>
          <h3 class="ard-b-h3">Карточка → AI-компаньоны → корзина с растущим AOV</h3>
          <ul class="ard-b-ul">
            <li><span class="ard-b-ic">1</span>Покупатель открывает PDP — AI анализирует SKU и сессию</li>
            <li><span class="ard-b-ic">2</span>Блок «С этим покупают» и bundle под контекст (новый vs возвратный)</li>
            <li><span class="ard-b-ic">3</span>Cross-sell в корзине: one-click добавление без возврата в каталог</li>
            <li><span class="ard-b-ic">+</span>AOV растёт на существующем трафике — без новой рекламы</li>
          </ul>
          <div class="ard-b-pills">
            <span class="ard-b-pl ard-b-pl-g">+16% AOV кейс РФ</span>
            <span class="ard-b-pl ard-b-pl-b">PDP + корзина</span>
            <span class="ard-b-pl ard-b-pl-v">attach rate ↑</span>
          </div>
          <p class="ard-b-foot">Дальше — как AI подбирает товары-компаньоны и персональные допродажи →</p>
        </div>
        <div class="ard-b-rgt">
          <canvas id="ard-reco-crosssell-canvas" role="img" aria-label="Анимация: AI добавляет товары-компаньоны в корзину и растит средний чек"></canvas>
        </div>
      </div>
    </div>
  </section>

  <section class="ard-section">
    <div class="ard-cnt">
      <div class="ard-sh ard-left">
        <span class="ard-eyebrow">Логика подбора</span>
        <h2>Как AI подбирает товары-компаньоны и персональные допродажи</h2>
      </div>
      <div class="ard-grid-3 nero-ai-reveal">
        <div class="ard-card">
          <h3>Каталог и атрибуты товаров</h3>
          <p>Структурированный фид: id, категория, цена, остаток, описание. LLM извлекает семантические связи. Shopify 2026: чистые каталоги дают вдвое выше CR от AI-рекомендаций.</p>
        </div>
        <div class="ard-card nero-ai-delay-1">
          <h3>Поведение и история заказов</h3>
          <p>События view_item, add_to_cart, purchase + CRM за 6–12 мес. Минимум несколько тысяч заказов для устойчивого ML; ниже — гибрид правил и content-based.</p>
        </div>
        <div class="ard-card nero-ai-delay-2">
          <h3>Сегменты и контекст</h3>
          <p>Новый посетитель — popular; возвратный — персональный реранкинг. Кейс АНГЕЛЬСКАЯ925: <strong>30,4% выручки</strong> через рекомендации, ROMI <strong>1 074%</strong>.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="ard-section ard-section-alt">
    <div class="ard-cnt">
      <div class="ard-sh">
        <span class="ard-eyebrow">Точки показа</span>
        <h2>Где показывать рекомендации: карточка, корзина, чекаут, email</h2>
      </div>
      <div class="nero-ai-reveal">
        <div class="ard-scenario">
          <h3>Блоки «Добавьте в комплект» и «С этим покупают»</h3>
          <p>PDP — высокий intent. Lamoda Tech: latency &lt;60 мс, cross-sell блок до <strong>+7,2%</strong> офлайн-метрик; персонализация <strong>80–85%</strong> аудитории.</p>
        </div>
        <div class="ard-scenario">
          <h3>Допродажи в корзине и one-click upsell</h3>
          <p>Корзина — главная точка для AOV. «Красный Карандаш»: CR блока сопутствующих <strong>5,5%</strong>, <strong>19,95% заказов</strong> с товарами из блоков.</p>
        </div>
        <div class="ard-scenario">
          <h3>Триггеры после покупки (CRM / email)</h3>
          <p>Связка сайт + email. «МИР ИНСТРУМЕНТА»: <strong>+52% к чеку</strong> от push с релевантными SKU. Подсказки менеджеру в retailCRM / amoCRM.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="ard-section" id="kalkulyator-aov" aria-labelledby="ard-calc-title">
    <div class="ard-cnt">
      <div class="ard-sh">
        <span class="ard-eyebrow">Лид-магнит</span>
        <h2 id="ard-calc-title">Калькулятор роста среднего чека (AOV)</h2>
        <p>Прозрачная модель на ваших цифрах. Введите трафик, конверсию и текущий AOV — получите оценку дополнительной выручки при трёх сценариях uplift.</p>
      </div>

      <div class="ard-calc-shell nero-ai-reveal">
        <div class="ard-calc-form" id="ard-aov-calc-form">
          <div class="ard-calc-field">
            <label for="ard-visits">Визиты в месяц (S)</label>
            <input type="number" id="ard-visits" min="1000" step="1000" value="50000" aria-describedby="ard-visits-hint">
            <small id="ard-visits-hint" style="color:#64748b;font-size:11px;">Трафик сайта / магазина</small>
          </div>
          <div class="ard-calc-field">
            <label for="ard-cr">Конверсия в заказ (CR, %)</label>
            <input type="number" id="ard-cr" min="0.1" max="100" step="0.1" value="2.5">
          </div>
          <div class="ard-calc-field">
            <label for="ard-aov">Текущий средний чек AOV₀ (₽)</label>
            <input type="number" id="ard-aov" min="100" step="50" value="3500">
          </div>
          <div class="ard-calc-field">
            <label>Сценарий uplift AOV <span style="font-weight:400;color:#64748b;">(оценка, не гарантия)</span></label>
            <div class="ard-calc-scenarios" role="group" aria-label="Сценарии роста AOV">
              <button type="button" class="ard-calc-scenario" data-uplift="0.065" aria-pressed="false">Консервативный<small>+6,5% · B2B кейс</small></button>
              <button type="button" class="ard-calc-scenario is-active" data-uplift="0.13" aria-pressed="true">Базовый<small>+13% · Retail Rocket</small></button>
              <button type="button" class="ard-calc-scenario" data-uplift="0.20" aria-pressed="false">Целевой<small>+20% · бенчмарк</small></button>
            </div>
          </div>
          <div class="ard-calc-results">
            <div class="ard-calc-res"><span>Выручка сейчас / мес.</span><strong id="ard-rev-now">—</strong></div>
            <div class="ard-calc-res"><span>Прогноз выручки / мес.</span><strong id="ard-rev-future">—</strong></div>
            <div class="ard-calc-res ard-calc-res--delta"><span>Доп. выручка / мес.</span><strong id="ard-rev-delta">—</strong></div>
            <div class="ard-calc-res"><span>Заказов / мес.</span><strong id="ard-orders">—</strong></div>
          </div>
          <p class="ard-calc-disclaimer">Формула: доп. выручка = S × CR × AOV₀ × u. Фактический эффект зависит от каталога, трафика и качества интеграции.</p>
        </div>
        <div class="ard-calc-viz" aria-hidden="false">
          <canvas id="ard-aov-calc-canvas" role="img" aria-label="Визуализация роста выручки при увеличении AOV"></canvas>
        </div>
      </div>
    </div>
  </section>

  <div class="ard-cnt">
    <div class="ym-cta-block ym-cta-block--dual" id="cta-aov-audit">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Получите расчёт роста AOV на ваших цифрах</p>
        <p class="ym-cta-block__sub">После калькулятора — бесплатный аудит каталога и сценариев допродаж: где теряется средний чек, какие 2 точки (карточка + корзина) дадут быстрый пилот за 2–4 недели. Без обязательств и без «гарантий» из агрегаторов.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#kalkulyator-aov" class="nero-ai-btn nero-ai-btn-secondary">Вернуться к калькулятору</a>
        </div>
      </div>
    </div>
  </div>

  <section class="ard-section ard-section-alt" id="integracii">
    <div class="ard-cnt">
      <div class="ard-sh">
        <span class="ard-eyebrow">Архитектура</span>
        <h2>Архитектура внедрения: каталог, CRM, ERP и виджеты</h2>
        <p>Гибрид ML + LLM; виджеты на PDP/корзине/checkout; интеграция CRM/ERP; A/B-тесты; атрибуция кликов.</p>
      </div>
      <div class="ard-table-wrap nero-ai-reveal">
        <table class="ard-table">
          <thead><tr><th>Платформа</th><th>Точка интеграции</th></tr></thead>
          <tbody>
            <tr><td><strong>WooCommerce</strong></td><td>Плагины + кастом API; AI Recommendations (OpenAI + MCP)</td></tr>
            <tr><td><strong>1С-Битрикс</strong></td><td>Модули каталога, intaro.retailcrm, кастомные виджеты</td></tr>
            <tr><td><strong>Shopify</strong></td><td>Smart Product Recommendations, generative recommender</td></tr>
            <tr><td><strong>retailCRM</strong></td><td>Recommendation API, карточка заказа, аналитика</td></tr>
            <tr><td><strong>InSales / OpenCart</strong></td><td>REST API + JS SDK виджетов</td></tr>
          </tbody>
        </table>
      </div>
      <div class="ard-card nero-ai-reveal" style="margin-top:24px;">
        <h3 style="font-size:17px;">Поток данных</h3>
        <p>Контекст (SKU, корзина, session_id) → candidate generation → ranking → фильтрация → виджет + лог клика → тег в CRM для ROI-отчёта.</p>
      </div>
    </div>
  </section>

  <section class="ard-section" id="etapy">
    <div class="ard-cnt">
      <div class="ard-sh">
        <span class="ard-eyebrow">Под ключ</span>
        <h2>Внедрение AI-рекомендаций под ключ: этапы и сроки</h2>
      </div>
      <div class="ard-timeline nero-ai-reveal">
        <div class="ard-tl-item">
          <div class="ard-tl-dot"></div>
          <h3>Аудит каталога и допродаж (1–2 недели)</h3>
          <p>Baseline AOV, CR, attach rate. Качество фида, события аналитики. 2 точки с максимальным влиянием — обычно <strong>корзина + карточка</strong>.</p>
        </div>
        <div class="ard-tl-item">
          <div class="ard-tl-dot"></div>
          <h3>Пилот на одном сценарии (2–4 недели)</h3>
          <p>AI-блоки на выбранных страницах, A/B «как сейчас» vs AI 4–6 недель. Метрики: AOV, attach rate, revenue per session.</p>
        </div>
        <div class="ard-tl-item">
          <div class="ard-tl-dot"></div>
          <h3>Масштабирование и A/B-тесты</h3>
          <p>Расширение на главную, категории, email, CRM-подсказки. Retrain, мониторинг drift, сезонные комплекты.</p>
        </div>
      </div>
    </div>
  </section>

  <div class="ard-cnt">
    <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
        <p class="ym-cta-block__sub">Перед внедрением рекомендательной системы полезно разобраться в event-трекинге, cold-start, A/B-тестах и интеграции с CRM — это ускоряет согласование сценариев с маркетингом и IT. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
      </div>
    </aside>
  </div>

  <section class="ard-section ard-section-alt" id="cena">
    <div class="ard-cnt">
      <div class="ard-sh">
        <span class="ard-eyebrow">Бюджет</span>
        <h2>Стоимость и факторы цены внедрения</h2>
      </div>
      <div class="ard-grid-2 nero-ai-reveal">
        <div class="ard-card">
          <h3>Ориентир чека 300 тыс.–1,5 млн ₽</h3>
          <p><strong>AI рекомендации товаров под ключ</strong> для магазина 500+ SKU, CRM, 2–3 точки показа — в диапазоне <strong>300 000–1 500 000 ₽</strong>. SaaS от 15–30 тыс. ₽/мес. дешевле на старте, но не закрывает CRM-агента и ERP-остатки.</p>
        </div>
        <div class="ard-card">
          <h3>ROI: связка с калькулятором AOV</h3>
          <p>При uplift 10% и выручке 5 млн ₽/мес. дополнительные <strong>500 000 ₽/мес.</strong> окупают проект за несколько месяцев. Точный ROI — после пилота на ваших данных.</p>
        </div>
      </div>
      <div class="ard-table-wrap nero-ai-reveal" style="margin-top:24px;">
        <table class="ard-table">
          <thead><tr><th>Путь</th><th>Плюсы</th><th>Минусы</th></tr></thead>
          <tbody>
            <tr><td><strong>SaaS (Retail Rocket)</strong></td><td>Быстрый старт, готовые алгоритмы</td><td>Ограниченная кастомизация, слабая CRM-логика</td></tr>
            <tr><td><strong>In-house ML</strong></td><td>Максимальный контроль</td><td>Команда data science, годы разработки</td></tr>
            <tr><td><strong>Интегратор (Nero Network)</strong></td><td>Кастом + CRM + пилот с A/B</td><td>Проектный бюджет 300k–1,5M ₽</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="ard-section" id="keisy">
    <div class="ard-cnt">
      <div class="ard-sh">
        <span class="ard-eyebrow">Доказательства</span>
        <h2>Кейсы и примеры внедрения AI-рекомендаций</h2>
      </div>
      <div class="ard-case-grid nero-ai-reveal">
        <div class="ard-case-card">
          <div class="ard-case-tag">Ювелирный e-commerce</div>
          <h3>АНГЕЛЬСКАЯ925</h3>
          <p>11 блоков на 5 типах страниц. <strong>30,4% выручки</strong> через рекомендации, каждый третий заказ с рекомендованным SKU, ROMI <strong>1 074%</strong>.</p>
        </div>
        <div class="ard-case-card">
          <div class="ard-case-tag">Канцтовары</div>
          <h3>Красный Карандаш</h3>
          <p><strong>+16,3% AOV</strong> в заказах с рекомендациями, <strong>21,9%</strong> выручки с персонализации, ROI <strong>1484,7%</strong>.</p>
        </div>
        <div class="ard-case-card">
          <div class="ard-case-tag">B2B e-commerce</div>
          <h3>МИР ИНСТРУМЕНТА</h3>
          <p><strong>+8%</strong> к чеку от блоков рекомендаций, <strong>+52%</strong> от web-push с релевантными SKU (Q3 2025).</p>
        </div>
      </div>
      <div class="ard-card nero-ai-reveal" style="margin-top:24px;">
        <h3>Международный ориентир: Black Diamond (Salesforce Einstein)</h3>
        <p>A/B после замены ручных рекомендаций на ML: <strong>+9,6% conversion rate</strong>, <strong>+15,5% revenue per visitor</strong>.</p>
      </div>
    </div>
  </section>

  <section class="ard-section ard-section-alt">
    <div class="ard-cnt">
      <div class="ard-sh">
        <span class="ard-eyebrow">Контекст 2026</span>
        <h2>AI-рекомендации и внедрение AI в бизнес: как это связано</h2>
        <p><strong>Внедрение AI в бизнес</strong> в 2026 — task-specific agents в рабочих приложениях. E-commerce — первый сценарий: измеримый KPI, готовые интеграции, быстрый пилот.</p>
      </div>
      <div class="ard-scenario nero-ai-reveal">
        <!-- INTERNAL-LINKS:INSERT -->
        <h3>Агент допродаж vs универсальный чат-бот</h3>
        <p>Агент решает конкретную задачу — увеличить ценность заказа. LLM становится реранкером и семантическим слоем, а не единственным «мозгом». Узкий сценарий с прямой связью на выручку, параллельно с другими AI-инициативами.</p>
      </div>
    </div>
  </section>

  <section class="ard-section" id="faq">
    <div class="ard-cnt">
      <div class="ard-sh">
        <span class="ard-eyebrow">Вопросы</span>
        <h2>FAQ</h2>
      </div>
      <div class="ard-faq nero-ai-reveal" id="ard-faq-accordion">
        <div class="ard-faq-item">
          <div class="ard-faq-q" role="button" tabindex="0">Нужны ли программисты и ML-команда?</div>
          <div class="ard-faq-a"><p><strong>AI рекомендации товаров без программиста</strong> на 100% невозможны — нужна интеграция с каталогом и аналитикой. Nero Network берёт разработку на себя.</p></div>
        </div>
        <div class="ard-faq-item">
          <div class="ard-faq-q" role="button" tabindex="0">Сколько времени до первых результатов?</div>
          <div class="ard-faq-a"><p>Пилот на корзине и карточке — <strong>2–4 недели</strong> после аудита. Первые данные A/B — через <strong>4–6 недель</strong>.</p></div>
        </div>
        <div class="ard-faq-item">
          <div class="ard-faq-q" role="button" tabindex="0">Как измерять эффект?</div>
          <div class="ard-faq-a"><p>Ключевые метрики: <strong>AOV</strong>, <strong>attach rate</strong>, <strong>revenue per session</strong>, <strong>recommendation acceptance rate</strong>. Post-click атрибуция 24 ч — стандарт в кейсах Retail Rocket.</p></div>
        </div>
        <div class="ard-faq-item">
          <div class="ard-faq-q" role="button" tabindex="0">Совместимость с CMS и CRM?</div>
          <div class="ard-faq-a"><p>1С-Битрикс, WooCommerce, InSales, OpenCart, retailCRM, amoCRM, Битрикс24. Проверяем API на этапе аудита.</p></div>
        </div>
        <div class="ard-faq-item">
          <div class="ard-faq-q" role="button" tabindex="0">Чем отличается от Retail Rocket?</div>
          <div class="ard-faq-a"><p>Retail Rocket — SaaS с готовыми алгоритмами. Nero Network — <strong>интегратор под ключ</strong>: кастомные bundle-правила, CRM-агент, ERP-остатки, единая логика на сайте и в письмах.</p></div>
        </div>
        <div class="ard-faq-item">
          <div class="ard-faq-q" role="button" tabindex="0">AI не будет рекомендовать несуществующие товары?</div>
          <div class="ard-faq-a"><p>Система работает только с <strong>whitelist SKU из каталога</strong>. LLM ранжирует существующие позиции. Спорные категории проходят ручную модерацию.</p></div>
        </div>
        <div class="ard-faq-item">
          <div class="ard-faq-q" role="button" tabindex="0">Как внедрить, если мало данных?</div>
          <div class="ard-faq-a"><p>Cold-start: popular по категории + семантика + ручные комплекты. Пилот возможен при нескольких сотнях заказов.</p></div>
        </div>
        <div class="ard-faq-item">
          <div class="ard-faq-q" role="button" tabindex="0">Сколько стоит внедрение?</div>
          <div class="ard-faq-a"><p>Ориентир <strong>300 000–1 500 000 ₽</strong> за проект под ключ. Точная смета — после аудита. Используйте <a href="#kalkulyator-aov">калькулятор AOV</a> для оценки окупаемости.</p></div>
        </div>
      </div>
    </div>
  </section>

  <section class="ard-section ard-section-alt">
    <div class="ard-cnt">
      <div class="ard-sh ard-left">
        <span class="ard-eyebrow">Следующий шаг</span>
        <h2>Увеличить допродажи с Nero Network</h2>
        <p>Средний чек на российском рынке сжимается — расти за счёт трафика дороже. <strong>AI-рекомендательная система</strong> превращает каждый визит в возможность допродажи.</p>
      </div>
      <div class="ard-card nero-ai-reveal">
        <h3>Бесплатный расчёт роста среднего чека</h3>
        <p>Прокрутите к <a href="#kalkulyator-aov">калькулятору AOV</a> — рассчитаем три сценария на ваших цифрах: консервативный, базовый и целевой. Без обязательств.</p>
        <p><strong>CTA: Увеличить допродажи</strong> — оставьте заявку, приложите ссылку на магазин и baseline AOV. Ответим с планом пилота за 1–2 рабочих дня.</p>
      </div>
    </div>
  </section>

  <div class="ard-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Готовы увеличить допродажи без ручного cross-sell?</p>
        <p class="ym-cta-block__sub">Следующий шаг — аудит каталога, baseline AOV и план пилота на карточке и в корзине. Ориентир бюджета 300 тыс.–1,5 млн ₽; точная смета после аудита. Ответим с планом за 1–2 рабочих дня.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>

</div>

<script>
(function(){
  'use strict';

  /* FAQ accordion */
  var faq = document.getElementById('ard-faq-accordion');
  if (faq) {
    faq.querySelectorAll('.ard-faq-q').forEach(function(q){
      function toggle(){
        var item = q.parentElement;
        var open = item.classList.contains('open');
        faq.querySelectorAll('.ard-faq-item').forEach(function(i){ i.classList.remove('open'); });
        if (!open) item.classList.add('open');
      }
      q.addEventListener('click', toggle);
      q.addEventListener('keydown', function(e){ if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); toggle(); }});
    });
  }

  /* AOV Calculator */
  var visitsEl = document.getElementById('ard-visits');
  var crEl = document.getElementById('ard-cr');
  var aovEl = document.getElementById('ard-aov');
  var revNowEl = document.getElementById('ard-rev-now');
  var revFutureEl = document.getElementById('ard-rev-future');
  var revDeltaEl = document.getElementById('ard-rev-delta');
  var ordersEl = document.getElementById('ard-orders');
  var scenarioBtns = document.querySelectorAll('.ard-calc-scenario');
  var calcCv = document.getElementById('ard-aov-calc-canvas');
  var uplift = 0.13;

  function fmtRub(n){
    if (!isFinite(n)) return '—';
    return new Intl.NumberFormat('ru-RU',{style:'currency',currency:'RUB',maximumFractionDigits:0}).format(n);
  }
  function fmtNum(n){
    if (!isFinite(n)) return '—';
    return new Intl.NumberFormat('ru-RU',{maximumFractionDigits:0}).format(n);
  }

  function recalc(){
    var S = parseFloat(visitsEl && visitsEl.value) || 0;
    var CR = parseFloat(crEl && crEl.value) || 0;
    var AOV0 = parseFloat(aovEl && aovEl.value) || 0;
    var crDec = CR / 100;
    var orders = S * crDec;
    var rev0 = orders * AOV0;
    var rev1 = rev0 * (1 + uplift);
    var delta = rev1 - rev0;
    if (revNowEl) revNowEl.textContent = fmtRub(rev0);
    if (revFutureEl) revFutureEl.textContent = fmtRub(rev1);
    if (revDeltaEl) revDeltaEl.textContent = '+' + fmtRub(delta);
    if (ordersEl) ordersEl.textContent = fmtNum(orders);
    drawCalcChart(rev0, rev1, uplift);
  }

  scenarioBtns.forEach(function(btn){
    btn.addEventListener('click', function(){
      scenarioBtns.forEach(function(b){
        b.classList.remove('is-active');
        b.setAttribute('aria-pressed','false');
      });
      btn.classList.add('is-active');
      btn.setAttribute('aria-pressed','true');
      uplift = parseFloat(btn.getAttribute('data-uplift')) || 0.13;
      recalc();
    });
  });
  if (visitsEl) visitsEl.addEventListener('input', recalc);
  if (crEl) crEl.addEventListener('input', recalc);
  if (aovEl) aovEl.addEventListener('input', recalc);

  var calcW = 0, calcH = 0;
  function resizeCalc(){
    if (!calcCv) return;
    var p = calcCv.parentElement;
    calcCv.width = p.clientWidth || 400;
    calcCv.height = p.clientHeight || 380;
    calcW = calcCv.width; calcH = calcCv.height;
    recalc();
  }
  window.addEventListener('resize', resizeCalc);
  if (calcCv) setTimeout(resizeCalc, 50);

  function drawCalcChart(rev0, rev1, u){
    if (!calcCv) return;
    var ctx = calcCv.getContext('2d');
    ctx.clearRect(0,0,calcW,calcH);
    var pad = 36;
    var barW = (calcW - pad * 2 - 40) / 2;
    var maxRev = Math.max(rev0, rev1, 1);
    var baseY = calcH - pad;
    var scale = (calcH - pad * 2 - 30) / maxRev;

    function bar(x, rev, label, color){
      var h = rev * scale;
      var y = baseY - h;
      ctx.fillStyle = color;
      if (ctx.roundRect) {
        ctx.beginPath();
        ctx.roundRect(x, y, barW, h, 8);
        ctx.fill();
      } else {
        ctx.fillRect(x, y, barW, h);
      }
      ctx.fillStyle = '#e6edf7';
      ctx.font = 'bold 13px Inter,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(fmtRub(rev), x + barW/2, y - 8);
      ctx.fillStyle = '#9aa8bd';
      ctx.font = '11px Inter,sans-serif';
      ctx.fillText(label, x + barW/2, baseY + 18);
    }

    bar(pad, rev0, 'Сейчас', 'rgba(121,242,255,.35)');
    bar(pad + barW + 40, rev1, 'С AI +' + Math.round(u*100) + '%', 'rgba(34,197,94,.55)');

    ctx.fillStyle = '#79f2ff';
    ctx.font = 'bold 12px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Выручка / мес.', pad, 24);
  }

  /* Boris cross-sell canvas */
  var borisCv = document.getElementById('ard-reco-crosssell-canvas');
  if (borisCv) {
    var bctx = borisCv.getContext('2d');
    var bW = 0, bH = 0, bFrame = 0;
    var C = {
      ink:'#0f172a',muted:'#64748b',card:'#ffffff',cardB:'#e2e8f0',
      cyan:'#0ea5e9',violet:'#8b5cf6',green:'#22c55e',orange:'#f59e0b',
      cart:'#f8fafc',cartB:'#cbd5e1',ai:'#8b5cf6',aiGlow:'rgba(139,92,246,.2)'
    };
    var PRODUCTS = [
      {label:'Телефон',price:24990,color:C.cyan},
      {label:'Чехол',price:1290,color:C.violet},
      {label:'Кабель',price:890,color:C.green},
      {label:'Стекло',price:590,color:C.orange}
    ];
    var LOOP = 480;

    function resizeBoris(){
      var p = borisCv.parentElement;
      borisCv.width = p.clientWidth || 640;
      borisCv.height = p.clientHeight || 440;
      bW = borisCv.width; bH = borisCv.height;
    }
    window.addEventListener('resize', resizeBoris);
    resizeBoris();

    function rr(x,y,w,h,r,fill,stroke,lw){
      bctx.beginPath();
      if(bctx.roundRect) bctx.roundRect(x,y,w,h,r);
      else bctx.rect(x,y,w,h);
      if(fill){ bctx.fillStyle=fill; bctx.fill(); }
      if(stroke){ bctx.strokeStyle=stroke; bctx.lineWidth=lw||1.5; bctx.stroke(); }
    }

    function drawProductCard(x,y,w,h,prod,alpha,scale){
      var sc = scale || 1;
      var pw = w*sc, ph = h*sc;
      var ox = x + (w-pw)/2, oy = y + (h-ph)/2;
      bctx.globalAlpha = alpha || 1;
      rr(ox,oy,pw,ph,8,C.card,C.cardB,1.5);
      rr(ox+8,oy+10,pw-16,ph*0.45,4,prod.color+'22',prod.color,1);
      bctx.fillStyle=C.ink;
      bctx.font='bold '+(10*sc)+'px Inter,sans-serif';
      bctx.textAlign='center';
      bctx.fillText(prod.label,ox+pw/2,oy+ph*0.72);
      bctx.fillStyle=prod.color;
      bctx.font='bold '+(9*sc)+'px Inter,sans-serif';
      bctx.fillText(prod.price.toLocaleString('ru-RU')+' ₽',ox+pw/2,oy+ph*0.88);
      bctx.globalAlpha=1;
    }

    function drawCart(cx,cy,w,h,aov,itemCount,pulse){
      rr(cx,cy,w,h,14,C.cart,C.cartB,2);
      bctx.fillStyle=C.muted;
      bctx.font='bold 11px Inter,sans-serif';
      bctx.textAlign='left';
      bctx.fillText('🛒 Корзина',cx+14,cy+22);
      bctx.fillStyle=C.green;
      bctx.font='bold 14px Inter,sans-serif';
      bctx.textAlign='right';
      bctx.fillText(fmtRub(aov),cx+w-14,cy+22);
      var slotY = cy + 34;
      for(var i=0;i<4;i++){
        var filled = i < itemCount;
        rr(cx+10,slotY+i*28,w-20,22,6,filled?'rgba(34,197,94,.1)':'rgba(255,255,255,.5)',filled?C.green:C.cartB,1);
        if(filled){
          bctx.fillStyle=C.ink;
          bctx.font='9px Inter,sans-serif';
          bctx.textAlign='left';
          bctx.fillText(PRODUCTS[i].label,cx+18,slotY+i*28+15);
        }
      }
      var prog = (pulse % 80) / 80;
      rr(cx+10,cy+h-18,w-20,6,3,'rgba(34,197,94,.15)',null,0);
      rr(cx+10,cy+h-18,(w-20)*prog,6,3,C.green,null,0);
    }

    function drawAiBadge(x,y,pulse){
      var r = 28 + Math.sin(pulse*0.08)*3;
      bctx.beginPath();
      bctx.arc(x,y,r,0,Math.PI*2);
      bctx.fillStyle=C.aiGlow;
      bctx.fill();
      bctx.beginPath();
      bctx.arc(x,y,22,0,Math.PI*2);
      bctx.fillStyle=C.ai;
      bctx.fill();
      bctx.fillStyle='#fff';
      bctx.font='bold 10px Inter,sans-serif';
      bctx.textAlign='center';
      bctx.fillText('AI',x,y+4);
    }

    function borisLoop(){
      bFrame++;
      var t = bFrame % LOOP;
      bctx.clearRect(0,0,bW,bH);

      var cartW = Math.min(200,bW*0.32);
      var cartH = Math.min(200,bH*0.55);
      var cartX = bW*0.58 - cartW/2;
      var cartY = bH*0.42 - cartH/2;

      var phase = Math.floor(t / 120);
      var itemCount = Math.min(phase + 1, 4);
      var aov = PRODUCTS.slice(0,itemCount).reduce(function(s,p){return s+p.price;},0);

      drawCart(cartX,cartY,cartW,cartH,aov,itemCount,t);

      var pdpX = bW*0.12;
      var pdpY = bH*0.25;
      var cardW = Math.min(90,bW*0.14);
      var cardH = cardW*1.15;
      drawProductCard(pdpX,pdpY,cardW,cardH,PRODUCTS[0],1,1);

      bctx.fillStyle=C.muted;
      bctx.font='10px Inter,sans-serif';
      bctx.textAlign='center';
      bctx.fillText('PDP',pdpX+cardW/2,pdpY-8);

      if(phase >= 1){
        var flyT = (t % 120) / 120;
        var sx = pdpX + cardW + 20;
        var sy = pdpY + cardH/2;
        var tx = cartX - 10;
        var ty = cartY + 50;
        var fx = sx + (tx-sx)*flyT;
        var fy = sy + (ty-sy)*flyT - Math.sin(flyT*Math.PI)*40;
        var prodIdx = Math.min(phase,3);
        drawProductCard(fx-30,fy-20,60,70,PRODUCTS[prodIdx],0.3+flyT*0.7,0.7+flyT*0.3);
        if(flyT < 0.95){
          bctx.strokeStyle=C.violet;
          bctx.lineWidth=1.5;
          bctx.setLineDash([4,4]);
          bctx.beginPath();
          bctx.moveTo(sx,sy);bctx.lineTo(fx,fy);
          bctx.stroke();
          bctx.setLineDash([]);
        }
      }

      drawAiBadge(bW*0.42,bH*0.35,t);

      bctx.fillStyle=C.ink;
      bctx.font='bold 12px Inter,sans-serif';
      bctx.textAlign='center';
      bctx.fillText('AOV '+fmtRub(aov),cartX+cartW/2,cartY+cartH+24);

      requestAnimationFrame(borisLoop);
    }
    borisLoop();
  }
})();
</script>


<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
/**
 * ard-reco-hero-engine — Башня персонализации AOV
 * Мир: орбитальные AffinityOrbitRails → CartNexusHub → BundleCapsule → AOV surge
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("ard-reco-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 220;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 8;
    scale = Math.min(cw / 400, ch / 220) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    orbit: "rgba(121,242,255,0.2)",
    orbitHot: "rgba(34,197,94,0.35)",
    hubBase: "#1e293b",
    hubAccent: "#79f2ff",
    hubGreen: "#22c55e",
    chipA: "#fde68a",
    chipB: "#a7f3d0",
    chipC: "#bfdbfe",
    chipD: "#fbcfe8",
    bundle: "#86efac",
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

  /* Транспорт: эллиптические рельсы affinity (не Conveyor) */
  function AffinityOrbitRails() {
    this.phase = 0;
  }
  AffinityOrbitRails.prototype.draw = function (ctx) {
    this.phase = (frame * 0.028) % (Math.PI * 2);
    var orbits = [
      { rx: 118, ry: 48, off: 0, spd: 1 },
      { rx: 92, ry: 36, off: 1.8, spd: 1.25 },
      { rx: 68, ry: 26, off: 3.6, spd: 0.9 }
    ];
    orbits.forEach(function (o, idx) {
      ctx.save();
      ctx.strokeStyle = idx === 0 ? C.orbitHot : C.orbit;
      ctx.lineWidth = idx === 0 ? 2 : 1;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.35;
      ctx.beginPath();
      ctx.ellipse(0, -12, o.rx, o.ry, 0, 0, Math.PI * 2);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.restore();
    });

    var chipColors = [C.chipA, C.chipB, C.chipC, C.chipD, C.chipA];
    for (var i = 0; i < 5; i++) {
      var o = orbits[i % 3];
      var t = (this.phase * o.spd + o.off + i * 1.1) % (Math.PI * 2);
      var px = Math.cos(t) * o.rx;
      var py = -12 + Math.sin(t) * o.ry;
      drawSKUChip(ctx, px, py, chipColors[i], "SKU" + (i + 1));
    }
  };

  function drawSKUChip(ctx, x, y, color, label) {
    ctx.save();
    ctx.translate(x, y);
    drawRR(ctx, -11, -8, 22, 16, 4, color, C.outline);
    ctx.fillStyle = "#0f172a";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(label, 0, 2);
    ctx.restore();
  }

  /* Центральный хаб корзины (не WebsiteTerminal) */
  function CartNexusHub() {
    this.bundleSeal = 0;
    this.aovPulse = 0;
  }
  CartNexusHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 220;

    drawRR(ctx, -52, -58, 104, 118, 10, C.hubBase, C.outline);

    /* Корзина */
    ctx.strokeStyle = C.hubAccent;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(-28, -38);
    ctx.lineTo(-22, 18);
    ctx.lineTo(22, 18);
    ctx.lineTo(28, -38);
    ctx.closePath();
    ctx.stroke();
    ctx.beginPath();
    ctx.arc(0, -42, 14, Math.PI, 0);
    ctx.stroke();

    /* Фаза SCAN */
    if (prg < 55) {
      var scanAlpha = prg / 55;
      ctx.strokeStyle = "rgba(121,242,255," + (scanAlpha * 0.5) + ")";
      ctx.lineWidth = 1;
      for (var s = 0; s < 4; s++) {
        var ang = (frame * 0.05 + s * 1.57) % (Math.PI * 2);
        ctx.beginPath();
        ctx.moveTo(0, -10);
        ctx.lineTo(Math.cos(ang) * 70, -10 + Math.sin(ang) * 35);
        ctx.stroke();
      }
    }

    /* Фаза RANK — подсветка кандидатов */
    if (prg >= 55 && prg < 115) {
      ctx.fillStyle = "rgba(139,92,246,0.25)";
      ctx.beginPath();
      ctx.arc(0, 0, 22 + Math.sin(frame * 0.12) * 4, 0, Math.PI * 2);
      ctx.fill();
      ctx.fillStyle = "#ddd6fe";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("RANK", 0, 4);
    }

    /* Фаза BUNDLE — капсула комплекта */
    if (prg >= 115 && prg < 175) {
      var bPrg = (prg - 115) / 60;
      var by = -20 + bPrg * 28;
      drawRR(ctx, -20, by, 40, 22, 8, "rgba(134,239,172,0.35)", C.hubGreen);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("BUNDLE", 0, by + 14);
      if (prg > 150 && prg < 155) this.bundleSeal = 1;
    }

    /* Фаза AOV_SURGE — импульс чека (не ракета) */
    if (prg >= 175) {
      var surge = Math.min(1, (prg - 175) / 20);
      this.aovPulse = surge;
      ctx.fillStyle = C.hubGreen;
      ctx.font = "900 14px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.globalAlpha = 0.85 + Math.sin(frame * 0.15) * 0.15;
      ctx.fillText("+1 240 ₽", 0, -72 - surge * 8);
      ctx.globalAlpha = 1;
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.fillStyle = "#bbf7d0";
      ctx.fillText("AOV +12%", 0, -58);

      ctx.strokeStyle = "rgba(34,197,94," + (0.7 - surge * 0.5) + ")";
      ctx.lineWidth = 2.5;
      ctx.beginPath();
      ctx.arc(0, 0, 30 + surge * 45, 0, Math.PI * 2);
      ctx.stroke();
    }

    /* Attach rate gauge */
    drawRR(ctx, 58, -50, 38, 10, 4, "rgba(255,255,255,0.08)", null);
    ctx.fillStyle = C.hubGreen;
    var attachW = 34 * (0.28 + (prg > 175 ? 0.12 : 0));
    drawRR(ctx, 60, -48, attachW, 6, 3, C.hubGreen, null);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("attach", 60, -54);
  };

  /* Cross-sell маяк — уникальный объект */
  function CrossSellBeacon() {
    this.blink = 0;
  }
  CrossSellBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 220;
    drawRR(ctx, -148, -8, 32, 32, 8, "rgba(34,197,94,0.12)", C.hubGreen);
    ctx.fillStyle = C.hubGreen;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("PDP", -132, 6);
    ctx.fillText("CART", -132, 16);

    if (prg > 110 && prg < 140) {
      this.blink = Math.sin((prg - 110) * 0.2) * 0.5 + 0.5;
      ctx.strokeStyle = "rgba(34,197,94," + (this.blink * 0.8) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(-116, 8);
      ctx.lineTo(-55, 0);
      ctx.stroke();
    }
  };

  /* Тепловая карта сессии */
  function SessionHeatmap() {
    this.dots = [];
    for (var i = 0; i < 8; i++) {
      this.dots.push({ x: -130 + Math.random() * 260, y: 42 + Math.random() * 28, a: Math.random() });
    }
  }
  SessionHeatmap.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 220;
    if (prg > 50) return;
    this.dots.forEach(function (d, i) {
      var alpha = d.a * (prg / 50) * 0.6;
      ctx.fillStyle = "rgba(121,242,255," + alpha + ")";
      ctx.beginPath();
      ctx.arc(d.x, d.y, 3 + (i % 2), 0, Math.PI * 2);
      ctx.fill();
    });
  };

  /* Agent — каркас из hero-engine-example.js */
  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
    this.hitAnimation = 0;
  }
  Agent.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 220;
    this.timer += 0.03;
    var isMoving = false;
    var carryType = null;
    var faceDir = 1;

    /* Радиальный выход к хабу с периметра (не targetX=180 конвейера) */
    var stations = [
      { tx: -95, ty: 35 },
      { tx: -55, ty: 55 },
      { tx: 0, ty: 62 },
      { tx: 55, ty: 55 },
      { tx: 95, ty: 35 }
    ];
    var st = stations[["1_architect","2_seo","3_coder","4_designer","5_deployer"].indexOf(this.role)] || stations[0];
    var targetX = st.tx;
    var targetY = st.ty;

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true; faceDir = targetX > this.baseX ? 1 : -1;
        carryType = this.color;
        this.x = this.baseX + (targetX - this.baseX) * (local / 11);
        this.y = this.baseY + (targetY - this.baseY) * (local / 11);
      } else if (local < 14) {
        this.x = targetX; this.y = targetY;
      } else {
        isMoving = true; faceDir = targetX > this.baseX ? -1 : 1;
        this.x = targetX - (targetX - this.baseX) * ((local - 14) / 8);
        this.y = targetY - (targetY - this.baseY) * ((local - 14) / 8);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 8 ? this.color : null;
    }

    if (!isMoving && frame % 180 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = isMoving ? Math.abs(Math.sin(this.timer * 3)) * 2 : Math.sin(this.timer * 1.5);
    ctx.save();
    ctx.translate(this.x, this.y);
    ctx.lineJoin = "round";

    var legL = 0, legR = 0;
    if (isMoving) {
      var wp = this.timer * 6;
      legL = Math.sin(wp) * 4; legR = Math.sin(wp + Math.PI) * 4;
    }
    drawRR(ctx, -9, -4 + Math.max(0, legL), 7, 12, 2, C.outline, null);
    drawRR(ctx, -10, 4 + Math.max(0, legL), 10, 5, 2, C.outline, null);
    drawRR(ctx, 2, -4 + Math.max(0, legR), 7, 12, 2, C.outline, null);
    drawRR(ctx, 1, 4 + Math.max(0, legR), 10, 5, 2, C.outline, null);
    drawRR(ctx, -13, -10 - bob, 26, 18, 5, this.color, C.outline);

    var hx = 0, hy = -24 - bob;
    ctx.fillStyle = this.color;
    ctx.beginPath(); ctx.arc(hx, hy, 10, 0, Math.PI * 2); ctx.fill();
    ctx.lineWidth = 1.5; ctx.strokeStyle = C.outline; ctx.stroke();

    ctx.save();
    ctx.scale(faceDir, 1);
    ctx.fillStyle = "#fff";
    ctx.beginPath(); ctx.arc(hx + 3, hy - 2, 3, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 3, hy - 2, 3, 0, Math.PI * 2); ctx.fill();
    ctx.fillStyle = C.outline;
    ctx.beginPath(); ctx.arc(hx + 4, hy - 2, 1.5, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 2, hy - 2, 1.5, 0, Math.PI * 2); ctx.fill();
    ctx.restore();

    if (carryType) {
      drawRR(ctx, -16 * faceDir, -14 - bob, 12, 12, 3, carryType, C.outline);
    }
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];

  entities.push(new SessionHeatmap());
  entities.push(new AffinityOrbitRails());
  entities.push(new CrossSellBeacon());
  entities.push(new CartNexusHub());

  entities.push(new Agent(-125, 72, C.agentYellow, "1_architect", 18, [
    "Аудит каталога…", "Атрибуты SKU ок", "Фид готов к ML"
  ]));
  entities.push(new Agent(-75, 88, C.agentGreen, "2_seo", 58, [
    "Компаньон найден", "Cross-sell пара", "Семантика match"
  ]));
  entities.push(new Agent(-15, 92, C.agentBlue, "3_coder", 98, [
    "API /recommend", "Event stream ok", "Latency 48 ms"
  ]));
  entities.push(new Agent(45, 88, C.agentPink, "4_designer", 138, [
    "Виджет PDP", "Блок корзины", "UI A/B готов"
  ]));
  entities.push(new Agent(105, 72, C.agentPurple, "5_deployer", 178, [
    "Пилот 2 нед.", "Attach +28%", "ROI в CRM"
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

    var prg = (frame * 0.038) % 220;
    if (prg >= 12 && prg < 12.08) createBubble(-90, -30, "1. Скан сессии", 200);
    if (prg >= 62 && prg < 62.08) createBubble(-40, -20, "2. Ранжируем SKU", 200);
    if (prg >= 122 && prg < 122.08) createBubble(10, -10, "3. Комплект +2", 200);
    if (prg >= 182 && prg < 182.08) createBubble(50, -40, "4. AOV +12%", 240);

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 28);
      if (b.life > b.maxLife - 8) alpha = (b.maxLife - b.life) / 8;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      var th = 18;
      var by = b.y - (b.maxLife - b.life) * 0.04;
      drawRR(ctx, b.x - tw / 2, by - th, tw, th, 5, C.bubbleBg, C.hubAccent);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(b.text, b.x, by - th / 2);
      ctx.globalAlpha = 1;
    }

    ctx.restore();
    requestAnimationFrame(engineloop);
  }

  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
    frame = 90;
    engineloop();
    return;
  }
  document.fonts.ready.then(engineloop);
});
</script>


<script>
(function(){
  'use strict';
  var root = document.querySelector('.ai-rekomendacii-tovarov-doprodazhi-page') || document.querySelector('.ard-content');
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

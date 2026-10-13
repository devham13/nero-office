<?php
/**
 * Template Name: AI-агент для первичной обработки заявок с сайта
 * Description: SEO-лендинг — AI обработка заявок с сайта, квиз, интеграция с CRM. Аудит потерь заявок.
 */

$page_seo_title       = 'AI обработка заявок с сайта: агент под ключ за 5–15 с';
$page_seo_description = 'Внедряем AI-агента для первичной обработки заявок с сайта: ответ за 5–15 секунд, уточняющие вопросы, горячий лид в CRM. Аудит потерь заявок за 30 минут. Под ключ для МСБ.';

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
    ['label' => 'Проблема', 'href' => '#pochemu-ostyvayut'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить, сколько заявок вы теряете';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Обучение по AI';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#';

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
/* ── Hero: AI заявки с сайта — самодостаточные стили ── */
.aozs-hero-site-leads {
  --aozs-cyan: #79f2ff;
  --aozs-violet: #8b5cf6;
  --aozs-green: #22c55e;
  --aozs-amber: #f59e0b;
  --aozs-text: #e6edf7;
  --aozs-muted: #9aa8bd;
  --aozs-soft: #c7d2e5;
  --aozs-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.aozs-hero-site-leads.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.aozs-hero-site-leads::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 42% 28%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.aozs-hero-site-leads::after {
  content: "";
  position: absolute;
  left: 58%;
  top: 12%;
  width: 720px;
  height: 720px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .14), transparent 66%);
  filter: blur(6px);
  animation: aozsHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes aozsHeroGlow {
  from { opacity: .4; transform: translateX(-50%) scale(.94); }
  to { opacity: .82; transform: translateX(-50%) scale(1.05); }
}
.aozs-hero-site-leads .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aozs-hero-site-leads .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aozs-hero-site-leads .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.aozs-hero-site-leads .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--aozs-cyan) 42%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aozs-hero-site-leads .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--aozs-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.aozs-hero-site-leads .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--aozs-soft) !important;
  font-size: clamp(17px, 1.85vw, 21px);
  line-height: 1.58;
}
.aozs-hero-site-leads .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.aozs-hero-site-leads .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  padding: 8px 11px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
}
.aozs-hero-site-leads .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.aozs-hero-site-leads .nero-ai-btn {
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
  transition: transform .22s ease, border-color .22s ease, background .22s ease, box-shadow .22s ease;
}
.aozs-hero-site-leads .nero-ai-btn:hover,
.aozs-hero-site-leads .nero-ai-btn:focus-visible { transform: translateY(-2px); }
.aozs-hero-site-leads .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--aozs-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.aozs-hero-site-leads .nero-ai-btn-secondary {
  color: var(--aozs-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.aozs-hero-site-leads .nero-ai-dashboard {
  position: relative;
}
.aozs-hero-site-leads .nero-ai-dashboard-shell {
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 24px;
  background: linear-gradient(180deg, rgba(255,255,255,.09), rgba(255,255,255,.04));
  box-shadow: var(--aozs-shadow);
  backdrop-filter: blur(18px);
  overflow: hidden;
}
.aozs-hero-site-leads .nero-ai-window-top {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(0,0,0,.22);
}
.aozs-hero-site-leads .nero-ai-dots { display: flex; gap: 6px; }
.aozs-hero-site-leads .nero-ai-dot {
  width: 10px; height: 10px; border-radius: 50%;
  background: rgba(255,255,255,.18);
}
.aozs-hero-site-leads .nero-ai-window-title {
  font-size: 11px;
  color: var(--aozs-muted);
  letter-spacing: .04em;
}
.aozs-hero-site-leads .nero-ai-window-body { padding: 16px 16px 14px; }
.aozs-hero-site-leads .nero-ai-dashboard-title {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  margin-bottom: 14px;
}
.aozs-hero-site-leads .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 16px;
  font-weight: 800;
  color: #fff;
  letter-spacing: -0.03em;
}
.aozs-hero-site-leads .nero-ai-live-pill {
  padding: 5px 10px;
  border-radius: 999px;
  font-size: 11px;
  font-weight: 800;
  color: var(--aozs-green);
  background: rgba(34,197,94,.12);
  border: 1px solid rgba(34,197,94,.35);
}
.aozs-hero-site-leads .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.aozs-hero-site-leads .nero-ai-metric {
  padding: 10px 12px;
  border-radius: 14px;
  border: 1px solid rgba(255,255,255,.08);
  background: rgba(0,0,0,.18);
}
.aozs-hero-site-leads .nero-ai-metric span {
  display: block;
  font-size: 11px;
  color: var(--aozs-muted);
}
.aozs-hero-site-leads .nero-ai-metric strong {
  display: block;
  margin-top: 4px;
  font-size: 20px;
  color: #fff;
  letter-spacing: -0.04em;
}
.aozs-hero-site-leads .nero-ai-metric small {
  display: block;
  margin-top: 2px;
  font-size: 10px;
  color: rgba(154,168,189,.85);
}
.aozs-hero-site-leads .aozs-dash-canvas-wrap {
  position: relative;
  height: 200px;
  margin: 4px 0 12px;
  border-radius: 16px;
  border: 1px solid rgba(121,242,255,.12);
  background: radial-gradient(circle at 30% 20%, rgba(121,242,255,.08), transparent 55%),
              rgba(6,8,18,.55);
  overflow: hidden;
}
.aozs-hero-site-leads #aozs-site-agent-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.aozs-hero-site-leads .nero-ai-task-stream {
  display: flex;
  flex-direction: column;
  gap: 8px;
  max-height: 168px;
  overflow: auto;
}
.aozs-hero-site-leads .nero-ai-task {
  display: grid;
  grid-template-columns: 32px 1fr auto;
  gap: 10px;
  align-items: center;
  padding: 10px 12px;
  border-radius: 14px;
  border: 1px solid rgba(255,255,255,.07);
  background: rgba(255,255,255,.04);
}
.aozs-hero-site-leads .nero-ai-task-icon {
  width: 32px; height: 32px;
  display: flex; align-items: center; justify-content: center;
  border-radius: 10px;
  background: rgba(121,242,255,.12);
  font-size: 12px;
  font-weight: 800;
  color: var(--aozs-cyan);
}
.aozs-hero-site-leads .nero-ai-task strong {
  display: block;
  font-size: 12px;
  color: #fff;
}
.aozs-hero-site-leads .nero-ai-task span {
  display: block;
  font-size: 11px;
  color: var(--aozs-muted);
  margin-top: 2px;
}
.aozs-hero-site-leads .nero-ai-status {
  font-size: 10px;
  font-weight: 800;
  padding: 4px 8px;
  border-radius: 999px;
  color: var(--aozs-green);
  background: rgba(34,197,94,.12);
  border: 1px solid rgba(34,197,94,.28);
  white-space: nowrap;
}
.aozs-hero-site-leads .nero-ai-status--amber {
  color: var(--aozs-amber);
  background: rgba(245,158,11,.12);
  border-color: rgba(245,158,11,.35);
}
@media (max-width: 980px) {
  .aozs-hero-site-leads .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aozs-hero-site-leads .aozs-dash-canvas-wrap { height: 220px; }
}

/* Kadence reset + breadcrumbs hide */
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-obrabotka-zayavok-s-sayta-page" role="main" tabindex="-1">

<section class="nero-ai-hero aozs-hero-site-leads" id="hero" aria-labelledby="aozs-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · AI на сайте</p>
      <h1 id="aozs-hero-title">AI-агент для первичной обработки заявок с сайта: ответ за <span class="nero-ai-gradient-text">5–15 секунд</span> и внедрение под ключ</h1>
      <p class="nero-ai-hero-lead">Отвечаем на заявки за 5–15 секунд, уточняем запрос и передаём горячий лид в CRM — пока менеджеры спят, лиды не остывают.</p>
      <ul class="nero-ai-badges" aria-label="Ключевые параметры">
        <li class="nero-ai-badge">5–15 секунд</li>
        <li class="nero-ai-badge">amoCRM / Битрикс24</li>
        <li class="nero-ai-badge">Квиз + чат</li>
        <li class="nero-ai-badge">Под ключ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как работает сценарий</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-обработки заявок с сайта">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots" aria-hidden="true"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Первичка заявок с сайта</h3>
            <span class="nero-ai-live-pill">онлайн 24/7</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Первый ответ AI</span>
              <strong>8 с</strong>
              <small>чат + форма</small>
            </div>
            <div class="nero-ai-metric">
              <span>Заявки ночью</span>
              <strong>38%</strong>
              <small>вне 10:00–19:00</small>
            </div>
            <div class="nero-ai-metric">
              <span>До карточки CRM</span>
              <strong>42 с</strong>
              <small>диалог → сделка</small>
            </div>
            <div class="nero-ai-metric">
              <span>Остывших лидов</span>
              <strong>↓</strong>
              <small>цель пилота</small>
            </div>
          </div>

          <div class="aozs-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aozs-site-agent-canvas" role="img" aria-label="Анимация: заявка с виджета сайта квалифицируется AI и уходит в CRM"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий диалога">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">22:31</span>
              <div><strong>Форма: «Нужен замер»</strong><span>Канал: лендинг · город указан</span></div>
              <span class="nero-ai-status">ответ 7 с</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Уточнение: срок и бюджет</strong><span>BANT · score warm → hot</span></div>
              <span class="nero-ai-status">квалиф.</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Карточка #2841 в amoCRM</strong><span>summary + тег hot · задача ОП</span></div>
              <span class="nero-ai-status">сделка</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">↳</span>
              <div><strong>Цена вне прайса</strong><span>risk_flag → human_review</span></div>
              <span class="nero-ai-status nero-ai-status--amber">handoff</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="aozs-content">

  <section class="aozs-intro aozs-section" id="intro" aria-label="Введение">
    <div class="aozs-cnt">
      <div class="aozs-intro-grid nero-ai-reveal">
        <div class="aozs-intro-text">
          <p class="aozs-eyebrow">Лонгрид · AI на сайте</p>
          <p><strong>Коротко:</strong> AI-обработка заявок с сайта — это не «чат-бот с FAQ», а агент, который за <strong>5–15 секунд</strong> отвечает посетителю, задаёт уточняющие вопросы, квалифицирует лид и передаёт <strong>готовую карточку в CRM</strong> (amoCRM, Битрикс24). Nero Network внедряет такой сценарий <strong>под ключ</strong>: от аудита потерь заявок до интеграции с формой, чатом или квизом на Tilda/WordPress.</p>
          <p>Если вы ищете <strong>внедрение AI обработка заявок</strong> для малого или среднего бизнеса — услуги, клиники, онлайн-школы — эта страница закрывает вопросы «как работает», «сколько стоит», «как интегрировать с CRM» и «чем агент отличается от скриптового бота».</p>
        </div>
        <div class="aozs-intro-kpi" aria-label="Ключевые метрики первички">
          <div class="aozs-kpi-card"><div class="kv">5–15 с</div><div class="kl">первый ответ AI</div><div class="ks">SLA пилота</div></div>
          <div class="aozs-kpi-card"><div class="kv">~50%</div><div class="kl">уходят при ожидании &gt;10 мин</div><div class="ks">Телфин/OkoCRM</div></div>
          <div class="aozs-kpi-card"><div class="kv">24/7</div><div class="kl">ночные заявки без паузы</div><div class="ks">виджет + квиз</div></div>
          <div class="aozs-kpi-card"><div class="kv">30 мин</div><div class="kl">аудит потерь заявок</div><div class="ks">лид-магнит</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="aozs-toc-outer">
    <div class="aozs-cnt">
      <nav class="aozs-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#pochemu-ostyvayut">Проблема</a>
        <a href="#chto-takoe-agent">Что такое агент</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#integracii">Интеграции</a>
        <a href="#etapy">Этапы</a>
        <a href="#metriki">Метрики</a>
        <a href="#ceny">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#riski">Риски</a>
        <a href="#faq">FAQ</a>
        <a href="#aud-zayavok">Квиз</a>
      </nav>
    </div>
  </div>

  <section class="aozs-section" id="pochemu-ostyvayut">
    <div class="aozs-cnt">
      <div class="aozs-sh aozs-left nero-ai-reveal">
        <span class="aozs-eyebrow">Боль бизнеса</span>
        <h2>Почему заявки с сайта «остывают» и что теряет бизнес</h2>
      </div>
      <div class="aozs-grid-2 nero-ai-reveal" style="margin-top:28px">
        <div class="aozs-card">
          <h3>Заявки ночью и в выходные без ответа менеджера</h3>
          <p>Лендинг работает круглосуточно, реклама крутится вечером, а отдел продаж — с 10:00 до 19:00. Заявка в 22:30 ждёт до утра: клиент уже сравнил вас с конкурентами или забыл о покупке. Ночная доля заявок у многих ниш — от четверти до половины трафика (точную цифру даёт <strong>аудит потерь заявок</strong> по вашей CRM).</p>
        </div>
        <div class="aozs-card">
          <h3>Скорость первого ответа и конверсия в сделку</h3>
          <p>Исследование «Телфин» и OkoCRM (CNews, ноябрь 2025, более <strong>7 500</strong> респондентов): примерно <strong>половина клиентов уходит без заказа</strong>, если ответ ждут <strong>больше 10 минут</strong> — <a href="https://www.cnews.ru/news/line/2025-11-24_issledovanie_telfin_i" target="_blank" rel="noopener noreferrer">cnews.ru</a>. Callibri по B2B: <strong>15–20%</strong> звонков и <strong>10–15%</strong> чатов без своевременного ответа; CPL квалифицированного лида <strong>10 000–15 000 ₽</strong>.</p>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px;font-size:15px"><strong>Итог:</strong> разрыв между 24/7-маркетингом и 8/5-продажами закрывает <strong>AI менеджер заявок</strong> на первой линии — менеджер получает уже квалифицированный контакт.</p>
    </div>
  </section>

  <section class="aozs-section aozs-section-alt" id="chto-takoe-agent">
    <div class="aozs-cnt">
      <div class="aozs-sh nero-ai-reveal">
        <span class="aozs-eyebrow">Определение</span>
        <h2>Что такое AI-агент для первичной обработки заявок</h2>
        <p>Программный слой между виджетом/формой/квизом и CRM: свободный текст, 3–7 вопросов квалификации, карточка лида с резюме, эскалация при рисках.</p>
      </div>
      <div class="aozs-table-wrap nero-ai-reveal">
        <table class="aozs-table" aria-label="Сравнение чат-бота, встроенного AI и агента Nero Network">
          <thead><tr><th>Критерий</th><th>Скриптовый чат-бот</th><th>AI в CRM</th><th>AI-агент Nero Network</th></tr></thead>
          <tbody>
            <tr><td>Диалог</td><td>Ветки по кнопкам</td><td>Часто только внутри CRM</td><td>Свободный текст + скрипт</td></tr>
            <tr><td>Действия</td><td>Редко пишет в CRM</td><td>Зависит от тарифа</td><td>Webhook → очередь → CRM</td></tr>
            <tr><td>Сайт 24/7</td><td>Ломается вне сценария</td><td>Не всегда виджет на лендинге</td><td><strong>AI бот для сайта</strong> + квиз</td></tr>
            <tr><td>Handoff</td><td>«Позвоните нам»</td><td>По процессу CRM</td><td>risk_flags, Telegram, human_review</td></tr>
          </tbody>
        </table>
      </div>
      <div class="aozs-card nero-ai-reveal" style="margin-top:24px">
        <h3>Агентные сценарии 2026</h3>
        <p>Вендоры смещают акцент на <strong>агентов с действиями</strong>: квалификация inbound, follow-up, CRM — см. <a href="https://openai.com/index/introducing-workspace-agents-in-chatgpt/" target="_blank" rel="noopener noreferrer">workspace agents OpenAI</a>. Для МСБ в России — цикл <strong>2 недели калибровки</strong> после запуска: разбор диалогов, правка промпта и RAG.</p>
      </div>
    </div>
  </section>

<section id="ai-obrabotka-zayavok-s-sayta-boris-block" class="baz-root" aria-label="Анимация: путь заявки с сайта через webhook и AI-квалификацию в CRM">
<style>
/* === БОРИС: prefix baz-, scoped внутри #ai-obrabotka-zayavok-s-sayta-boris-block === */
#ai-obrabotka-zayavok-s-sayta-boris-block.baz-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-obrabotka-zayavok-s-sayta-boris-block .baz-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-obrabotka-zayavok-s-sayta-boris-block .baz-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-obrabotka-zayavok-s-sayta-boris-block .baz-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-obrabotka-zayavok-s-sayta-boris-block .baz-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-obrabotka-zayavok-s-sayta-boris-block .baz-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-obrabotka-zayavok-s-sayta-boris-block .baz-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#2563eb;
  margin:0 0 14px;
}
#ai-obrabotka-zayavok-s-sayta-boris-block .baz-ey::before{
  content:'';
  width:18px;height:2px;
  background:#2563eb;
  border-radius:1px;
}
#ai-obrabotka-zayavok-s-sayta-boris-block .baz-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-obrabotka-zayavok-s-sayta-boris-block .baz-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-obrabotka-zayavok-s-sayta-boris-block .baz-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-obrabotka-zayavok-s-sayta-boris-block .baz-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(37,99,235,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#1d4ed8;
  margin-top:1px;
  font-style:normal;
}
#ai-obrabotka-zayavok-s-sayta-boris-block .baz-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-obrabotka-zayavok-s-sayta-boris-block .baz-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-obrabotka-zayavok-s-sayta-boris-block .baz-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-obrabotka-zayavok-s-sayta-boris-block .baz-pl-b{
  background:rgba(37,99,235,.08);
  color:#1d4ed8;
  border:1.5px solid rgba(37,99,235,.22);
}
#ai-obrabotka-zayavok-s-sayta-boris-block .baz-pl-a{
  background:rgba(245,158,11,.1);
  color:#b45309;
  border:1.5px solid rgba(245,158,11,.28);
}
#ai-obrabotka-zayavok-s-sayta-boris-block .baz-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-obrabotka-zayavok-s-sayta-boris-block .baz-rgt{
  position:relative;
  background:linear-gradient(135deg,#eff6ff 0%,#dbeafe 42%,#f8fafc 100%);
  min-height:420px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-obrabotka-zayavok-s-sayta-boris-block .baz-rgt{min-height:360px;}
}
#baz-lead-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="baz-cnt">
  <div class="baz-card">
    <div class="baz-lft">
      <span class="baz-ey">Под капотом агента</span>
      <h3 class="baz-h3">Заявка с сайта не «зависает» в чате — она идёт по конвейеру в CRM</h3>
      <ul class="baz-ul">
        <li><span class="baz-ic">1</span>Форма, виджет или квиз шлёт webhook за доли секунды — задача в очереди (n8n / Make / API)</li>
        <li><span class="baz-ic">2</span>AI отвечает за <strong>5–15 с</strong>, сверяет ответы с RAG и задаёт уточняющие вопросы</li>
        <li><span class="baz-ic">3</span>Structured output: имя, телефон, услуга, score <strong>hot / warm / cold</strong>, summary для менеджера</li>
        <li><span class="baz-ic">!</span>При <code>risk_flags</code> — эскалация: human_review, без автообещания цены</li>
      </ul>
      <div class="baz-pills">
        <span class="baz-pl baz-pl-b">Webhook &lt;1 с</span>
        <span class="baz-pl baz-pl-g">Ответ 5–15 с</span>
        <span class="baz-pl baz-pl-a">human_review</span>
      </div>
      <p class="baz-foot">Дальше — форма, чат и квиз на лендинге в одном сценарии →</p>
    </div>
    <div class="baz-rgt">
      <canvas
        id="baz-lead-pipeline-canvas"
        aria-label="Анимация: заявка с сайта проходит webhook, очередь, AI-квалификацию и попадает в карточку CRM"
        role="img"
      ></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('baz-lead-pipeline-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width  = p.clientWidth  || 640;
    cv.height = p.clientHeight || 480;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    ink:'#0f172a',
    muted:'#64748b',
    site:'#ffffff',
    siteBdr:'#94a3b8',
    hook:'#0ea5e9',
    queue:'#6366f1',
    ai:'#2563eb',
    aiGlow:'rgba(37,99,235,.22)',
    crm:'#059669',
    hot:'#ef4444',
    warm:'#f59e0b',
    cold:'#94a3b8',
    field:'#e0f2fe',
    fieldBdr:'#7dd3fc',
    line:'rgba(37,99,235,.28)',
    bubble:'#f8fafc'
  };

  var NODES = [
    {id:'site',  label:'Сайт', sub:'чат · форма · квиз', x:0, color:C.siteBdr},
    {id:'hook',  label:'Webhook', sub:'&lt;1 с', x:0, color:C.hook},
    {id:'queue', label:'Очередь', sub:'n8n / Redis', x:0, color:C.queue},
    {id:'ai',    label:'AI + RAG', sub:'квалификация', x:0, color:C.ai},
    {id:'crm',   label:'CRM', sub:'amo · Битрикс', x:0, color:C.crm}
  ];

  function layoutNodes(){
    var pad = W * 0.06;
    var span = W - pad * 2;
    for (var i = 0; i < NODES.length; i++) {
      NODES[i].x = pad + (span * i) / (NODES.length - 1);
      NODES[i].y = H * 0.38;
    }
  }

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if (fill){ ctx.fillStyle = fill; ctx.fill(); }
    if (stroke){ ctx.strokeStyle = stroke; ctx.lineWidth = lw || 1.5; ctx.stroke(); }
  }

  function drawNode(n, pulse){
    var w = Math.min(88, W * 0.14);
    var h = 52;
    var x = n.x - w/2, y = n.y - h/2;
    rr(x, y, w, h, 10, '#fff', n.color);
    ctx.fillStyle = C.ink;
    ctx.font = 'bold 11px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(n.label, n.x, n.y - 4);
    ctx.fillStyle = C.muted;
    ctx.font = '9px system-ui,sans-serif';
    ctx.fillText(n.sub.replace(/&lt;/g,'<'), n.x, n.y + 12);

    if (n.id === 'ai') {
      var g = ctx.createRadialGradient(n.x, n.y, 0, n.x, n.y, w);
      g.addColorStop(0, C.aiGlow);
      g.addColorStop(1, 'rgba(37,99,235,0)');
      ctx.fillStyle = g;
      ctx.beginPath();
      ctx.arc(n.x, n.y, w * 0.9 + pulse * 6, 0, Math.PI * 2);
      ctx.fill();
    }
  }

  function drawChatLead(x, y, s, tag){
    ctx.save();
    ctx.translate(x, y);
    rr(-s*0.55, -s*0.4, s*1.1, s*0.75, 8, C.bubble, C.siteBdr);
    ctx.fillStyle = C.ink;
    ctx.font = '9px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('Нужен замер', 0, -2);
    ctx.fillStyle = C.muted;
    ctx.font = '8px system-ui,sans-serif';
    ctx.fillText('22:41', 0, 10);
    if (tag) {
      ctx.fillStyle = tag === 'hot' ? C.hot : (tag === 'warm' ? C.warm : C.cold);
      ctx.beginPath();
      ctx.arc(s*0.45, -s*0.32, 5, 0, Math.PI*2);
      ctx.fill();
    }
    ctx.restore();
  }

  var leads = [];
  var jsonBits = [];
  var crmAlpha = 0;

  function spawnLead(){
    var tags = ['hot','warm','cold','warm','hot'];
    leads.push({
      phase: 0,
      x: NODES[0].x,
      y: NODES[0].y - 30,
      tag: tags[Math.floor(Math.random() * tags.length)],
      speed: 1.1 + Math.random() * 0.4
    });
  }

  function spawnJson(fromX, fromY){
    var labels = ['score: hot','summary…','тел: +7…','услуга'];
    var i = jsonBits.length % labels.length;
    jsonBits.push({
      x: fromX, y: fromY,
      tx: NODES[4].x, ty: H * 0.62 + i * 18,
      label: labels[i],
      t: 0
    });
  }

  function drawFlowLines(){
    ctx.strokeStyle = C.line;
    ctx.lineWidth = 2;
    ctx.setLineDash([5, 5]);
    for (var i = 0; i < NODES.length - 1; i++) {
      ctx.beginPath();
      ctx.moveTo(NODES[i].x + 44, NODES[i].y);
      ctx.lineTo(NODES[i+1].x - 44, NODES[i+1].y);
      ctx.stroke();
    }
    ctx.setLineDash([]);
  }

  function drawTimer(pulse){
    var tx = NODES[2].x, ty = H * 0.12;
    rr(tx - 54, ty - 14, 108, 28, 14, 'rgba(255,255,255,.92)', C.hook);
    ctx.fillStyle = C.ink;
    ctx.font = 'bold 11px system-ui,sans-serif';
    ctx.textAlign = 'center';
    var sec = 5 + Math.floor((Math.sin(frame * 0.04) + 1) * 5);
    ctx.fillText('Первый ответ: ' + sec + ' с', tx, ty + 4);
  }

  function drawCrmCard(alpha){
    if (alpha < 0.05) return;
    var x = W * 0.72, y = H * 0.58, w = Math.min(140, W * 0.22), h = 88;
    ctx.globalAlpha = alpha;
    rr(x, y, w, h, 10, '#fff', C.crm);
    ctx.fillStyle = C.crm;
    ctx.font = 'bold 10px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Лид в CRM', x + 10, y + 16);
    var rows = ['Hot · замер','+7 921 ***','Резюме диалога'];
    ctx.fillStyle = C.ink;
    ctx.font = '9px system-ui,sans-serif';
    for (var i = 0; i < rows.length; i++) {
      rr(x + 8, y + 22 + i * 20, w - 16, 16, 4, C.field, C.fieldBdr);
      ctx.fillText(rows[i], x + 12, y + 33 + i * 20);
    }
    ctx.globalAlpha = 1;
  }

  function tick(){
    frame++;
    layoutNodes();
    if (frame % 110 === 0) spawnLead();

    var pulse = 0.5 + 0.5 * Math.sin(frame * 0.07);
    ctx.clearRect(0, 0, W, H);

    ctx.fillStyle = C.muted;
    ctx.font = '10px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Конвейер заявки с сайта (демо)', W * 0.06, H * 0.08);

    drawFlowLines();
    for (var n = 0; n < NODES.length; n++) drawNode(NODES[n], pulse);
    drawTimer(pulse);

    leads = leads.filter(function(ld){
      ld.phase += ld.speed;
      var seg = Math.floor(ld.phase / 55);
      if (seg >= NODES.length) {
        crmAlpha = Math.min(1, crmAlpha + 0.02);
        return false;
      }
      var from = NODES[Math.min(seg, NODES.length - 1)];
      var to = NODES[Math.min(seg + 1, NODES.length - 1)];
      var t = (ld.phase % 55) / 55;
      var ease = t * t * (3 - 2 * t);
      ld.x = from.x + (to.x - from.x) * ease;
      ld.y = from.y + (to.y - from.y) * ease + Math.sin(frame * 0.06) * 2;
      if (seg === 3 && t > 0.85 && ld.phase % 55 < 2) spawnJson(ld.x, ld.y);
      drawChatLead(ld.x, ld.y, 28, ld.tag);
      return true;
    });

    jsonBits = jsonBits.filter(function(j){
      j.t += 0.03;
      var e = j.t * j.t * (3 - 2 * j.t);
      var cx = j.x + (j.tx - j.x) * e;
      var cy = j.y + (j.ty - j.y) * e;
      var a = Math.min(1, j.t * 2);
      ctx.globalAlpha = a;
      rr(cx - 38, cy - 8, 76, 16, 4, C.field, C.fieldBdr);
      ctx.fillStyle = C.ink;
      ctx.font = '8px system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(j.label, cx, cy + 3);
      ctx.globalAlpha = 1;
      return j.t < 1.05;
    });

    drawCrmCard(crmAlpha);
    if (frame % 600 === 0) { crmAlpha = 0; jsonBits = []; }

    requestAnimationFrame(tick);
  }
  requestAnimationFrame(tick);
})();
</script>
</section>

  <section class="aozs-section" id="kak-rabotaet">
    <div class="aozs-cnt">
      <div class="aozs-sh nero-ai-reveal">
        <span class="aozs-eyebrow">Сценарий</span>
        <h2>Как работает сценарий на сайте: форма, чат и квиз</h2>
      </div>
      <div class="aozs-flow nero-ai-reveal" aria-label="Шесть шагов обработки заявки">
        <span>Заявка</span><span class="arr">→</span>
        <span>Webhook</span><span class="arr">→</span>
        <span>Очередь</span><span class="arr">→</span>
        <span>AI 5–15 с</span><span class="arr">→</span>
        <span>Квалификация</span><span class="arr">→</span>
        <span>CRM + handoff</span>
      </div>
      <div class="aozs-grid-2 nero-ai-reveal" style="margin-top:28px">
        <div class="aozs-card">
          <h3>Мгновенный ответ и уточняющие вопросы</h3>
          <p>Посетитель пишет в чат, отправляет форму или проходит <strong>квиз</strong>. Webhook (&lt;1 с) ставит задачу в очередь (n8n, Make, FastAPI + Redis). AI приветствует за <strong>5–15 с</strong>, сверяет ответы с RAG, формирует JSON: имя, телефон, услуга, score, risk_flags, summary.</p>
          <p>Угол Nero Network: <strong>квиз + AI-агент + CRM</strong> — квиз собирает структуру, агент дожимает свободный текст и неполные формы (кейс «Беспалов Авто»).</p>
        </div>
        <div class="aozs-card">
          <h3>Квалификация лида до передачи менеджеру</h3>
          <p><strong>BANT</strong>, лид-скоринг hot/warm/cold, отсев нецелевого трафика. Кейс AX Digital: автоквалификация в amoCRM за ~30 с — <a href="https://axdigital.ru/blog/ii-kvalifikaciya-lidov-amocrm-claude/" target="_blank" rel="noopener noreferrer">axdigital.ru</a>. Velmi на Habr: +35% квалифицированных лидов — <a href="https://habr.com/ru/articles/1045026/" target="_blank" rel="noopener noreferrer">habr.com</a>.</p>
        </div>
      </div>
    </div>
  </section>

  <div class="aozs-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-kak-rabotaet">
      <div class="ym-cta-block__icon" aria-hidden="true">⚡</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Проверьте, не остывают ли заявки ночью</p>
        <p class="ym-cta-block__sub">За 30 минут разберём каналы с сайта, оценим время первого ответа и покажем, где лиды выпадают между формой и CRM. Без обязательств.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>

  <!-- INTERNAL-LINKS:INSERT -->

  <section class="aozs-section aozs-section-alt" id="integracii">
    <div class="aozs-cnt">
      <div class="aozs-sh nero-ai-reveal">
        <span class="aozs-eyebrow">Стек</span>
        <h2>Интеграция с CRM и виджетами (amoCRM, Bitrix24, Tilda, WordPress)</h2>
      </div>
      <div class="aozs-grid-2 nero-ai-reveal">
        <div class="aozs-card">
          <h3>Передача карточки лида и истории диалога</h3>
          <p>Создание лида/сделки, кастомные поля, summary в примечании, теги по score. Контуры: amoCRM v4, Битрикс24 REST; Tilda webhook, WordPress CF7/WPForms; Telegram для дожима; RAG из Notion/Google Docs; n8n/Make; OpenAI API, YandexGPT, GigaChat.</p>
        </div>
        <div class="aozs-card">
          <h3>Webhook, поля сделки, эскалация</h3>
          <p>Очередь для лимитов webhook Bitrix24. Human handoff: флаг <code>human_review</code>, Telegram дежурному, запрет автообещаний по цене и медицине при <code>risk_flags</code>.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="aozs-section" id="etapy">
    <div class="aozs-cnt">
      <div class="aozs-sh nero-ai-reveal">
        <span class="aozs-eyebrow">Под ключ</span>
        <h2>Внедрение под ключ: этапы, сроки и зона ответственности</h2>
      </div>
      <div class="aozs-timeline nero-ai-reveal">
        <div class="aozs-tl-item"><span class="aozs-tl-dot"></span><h3>Аудит каналов заявок</h3><p>Доля заявок 19:00–09:00, среднее время первого ответа, конверсия «заявка → контакт». Лид-магнит: <strong>аудит потерь заявок за 30 минут</strong>.</p></div>
        <div class="aozs-tl-item"><span class="aozs-tl-dot"></span><h3>Настройка и запуск (2–4 недели)</h3><p>Один канал пилота, база знаний + guardrails, интеграция CRM, тест на 20–50 диалогах, 2 недели калибровки.</p></div>
      </div>
      <div class="aozs-card nero-ai-reveal" style="margin-top:28px">
        <h3>Что подготовить к внедрению</h3>
        <ul>
          <li>Скрипт квалификации и критерии «горячий лид»</li>
          <li>FAQ, прайс-диапазоны, список услуг</li>
          <li>Карта полей CRM и воронка</li>
          <li>Политика ПДн и текст согласия</li>
          <li>Архив заявок для тестов</li>
        </ul>
      </div>
    </div>
  </section>

  <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
    <div class="aozs-cnt">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
        <p class="ym-cta-block__sub">Если перед внедрением агента на сайте важно разобраться в промптах, guardrails и human handoff — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>. Это ускоряет согласование сценария квалификации и полей CRM.</p>
      </div>
    </div>
  </aside>

  <section class="aozs-section aozs-section-alt" id="metriki">
    <div class="aozs-cnt">
      <div class="aozs-sh nero-ai-reveal">
        <span class="aozs-eyebrow">Пилот</span>
        <h2>Метрики эффективности: что измерять после запуска</h2>
      </div>
      <div class="aozs-table-wrap nero-ai-reveal">
        <table class="aozs-table" aria-label="Метрики пилота AI-агента">
          <thead><tr><th>Метрика</th><th>Зачем</th><th>Как считать</th></tr></thead>
          <tbody>
            <tr><td>Time-to-first-response (P50, P90)</td><td>SLA агента</td><td>Лог виджета / CRM</td></tr>
            <tr><td>Доля заявок вне рабочего времени</td><td>Обоснование 24/7</td><td>CRM по времени создания</td></tr>
            <tr><td>human_review rate</td><td>Качество и риски</td><td>Доля эскалаций</td></tr>
            <tr><td>Конверсия форма → созвон</td><td>Воронка</td><td>CRM, сквозная аналитика</td></tr>
            <tr><td>Качество лида (hot share)</td><td>Нагрузка на ОП</td><td>Теги / стадии</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="aozs-section" id="ceny">
    <div class="aozs-cnt">
      <div class="aozs-sh nero-ai-reveal">
        <span class="aozs-eyebrow">Бюджет</span>
        <h2>Стоимость, окупаемость и формат для малого бизнеса</h2>
        <p>Ориентир <strong>120–350 тыс. ₽</strong> старт + поддержка; пилот <strong>2–4 недели</strong> на один канал. Сравнение: CPL 10 000–15 000 ₽ (Callibri) + потери при ожидании &gt;10 мин (Телфин).</p>
      </div>
      <div class="aozs-card nero-ai-reveal" style="margin-top:24px">
        <h3>Когда окупается быстрее</h3>
        <ul>
          <li>&gt;30–50 заявок/мес и хаотичный первый ответ</li>
          <li>Высокая доля вечерних/ночных заявок</li>
          <li>Длинная квалификация (B2B, клиника, EdTech)</li>
          <li>CRM уже есть — нужна надстройка агента</li>
        </ul>
      </div>
    </div>
  </section>

  <section class="aozs-section aozs-section-alt" id="keisy">
    <div class="aozs-cnt">
      <div class="aozs-sh nero-ai-reveal">
        <span class="aozs-eyebrow">Кейсы РФ</span>
        <h2>Кейсы и примеры внедрения (услуги, клиники, онлайн-школы)</h2>
        <p>Цифры — из указанных источников (кейсы интеграторов), не независимый аудит Nero Network.</p>
      </div>
      <div class="aozs-case-grid">
        <div class="aozs-case-card nero-ai-reveal"><div class="aozs-case-tag">Окна</div><h3>Neuron Group</h3><p>Сайт + Telegram, квалификация 3–5 вопросов — <a href="https://neuron-group.ru/cases/ii-menedzher/" target="_blank" rel="noopener noreferrer">neuron-group.ru</a></p></div>
        <div class="aozs-case-card nero-ai-reveal"><div class="aozs-case-tag">Bitrix24</div><h3>0101 AI</h3><p>BANT, лид-скоринг, ночные обращения — <a href="https://0101ai.tech/cases/chat/" target="_blank" rel="noopener noreferrer">0101ai.tech</a></p></div>
        <div class="aozs-case-card nero-ai-reveal"><div class="aozs-case-tag">EdTech</div><h3>Ultima.school</h3><p>Сайт → WhatsApp → amoCRM — <a href="https://textback.ru/kak-ii-bot-i-amocrm-dali-rost-obrabotki-lidov-v-2-raza-kejs-ultima-school/" target="_blank" rel="noopener noreferrer">textback.ru</a></p></div>
        <div class="aozs-case-card nero-ai-reveal"><div class="aozs-case-tag">EdTech</div><h3>Skysmart</h3><p>Ответ ~1 с, круглосуточно — <a href="https://www.sostav.ru/publication/kak-ii-pomogaet-edtech-igrokam-74416.html" target="_blank" rel="noopener noreferrer">sostav.ru</a></p></div>
        <div class="aozs-case-card nero-ai-reveal"><div class="aozs-case-tag">Клиника</div><h3>Медиона Парнас</h3><p>AI-ассистент на сайте — <a href="https://bquadro.ru/portfolio/ai/ai-assistent-mediona/" target="_blank" rel="noopener noreferrer">bquadro.ru</a></p></div>
        <div class="aozs-case-card nero-ai-reveal"><div class="aozs-case-tag">Enterprise</div><h3>СберЛизинг</h3><p>36 000+ заявок ИИ за год — <a href="https://www.sberleasing.ru/about/news/2026/sberleasing-obrabotal-bolee-36-tysyach-zayavok-s-pomoshchyu-ii-modeli/" target="_blank" rel="noopener noreferrer">sberleasing.ru</a></p></div>
      </div>
    </div>
  </section>

  <section class="aozs-section" id="riski">
    <div class="aozs-cnt">
      <div class="aozs-sh nero-ai-reveal">
        <span class="aozs-eyebrow">Compliance</span>
        <h2>Риски: ПДн, галлюцинации, границы автоматизации</h2>
      </div>
      <div class="aozs-grid-3 nero-ai-reveal">
        <div class="aozs-card"><h3>ПДн и согласие</h3><p>С 01.09.2025 отдельное согласие на обработку ПДн. Минимизация полей, РФ-хостинг логов, учёт трансграничной передачи при западных LLM.</p></div>
        <div class="aozs-card"><h3>Галлюцинации</h3><p>RAG только по утверждённой базе; запрет финальных цен и медицинских выводов; handoff при низкой уверенности.</p></div>
        <div class="aozs-card"><h3>Когда нужен менеджер</h3><p>Негатив, индивидуальные скидки, медицина/юриспруденция, вопросы вне базы, запрос «хочу человека».</p></div>
      </div>
    </div>
  </section>

  <section class="aozs-section aozs-section-alt" id="faq">
    <div class="aozs-cnt">
      <div class="aozs-sh nero-ai-reveal">
        <span class="aozs-eyebrow">Вопрос — ответ</span>
        <h2>FAQ</h2>
      </div>
      <div class="aozs-faq nero-ai-reveal">
        <div class="aozs-faq-item"><div class="aozs-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить ai обработка заявок?</div><div class="aozs-faq-a"><p>Аудит каналов → один пилотный канал → база знаний и guardrails → интеграция CRM → тест → запуск и 2 недели калибровки. Nero Network ведёт цикл под ключ.</p></div></div>
        <div class="aozs-faq-item"><div class="aozs-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько времени занимает запуск?</div><div class="aozs-faq-a"><p>Ориентир <strong>2–4 недели</strong> на пилот одного канала при готовых FAQ и доступе к CRM.</p></div></div>
        <div class="aozs-faq-item"><div class="aozs-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли без CRM?</div><div class="aozs-faq-a"><p>Технически агент может писать в таблицу или Telegram, но <strong>интеграция с CRM</strong> — рекомендуемый стандарт для сквозной аналитики.</p></div></div>
        <div class="aozs-faq-item"><div class="aozs-faq-q" tabindex="0" role="button" aria-expanded="false">Заменит ли AI менеджеров?</div><div class="aozs-faq-a"><p>Нет. Агент закрывает первичку, скорость и квалификацию; люди закрывают сделку и сложные кейсы.</p></div></div>
        <div class="aozs-faq-item"><div class="aozs-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько стоит под ключ?</div><div class="aozs-faq-a"><p>Ориентир <strong>120–350 тыс. ₽</strong> старт + поддержка; точная смета — после аудита каналов.</p></div></div>
      </div>
    </div>
  </section>

  <div class="aozs-cnt">
    <div class="ym-cta-block ym-cta-block--dual" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Внедрение AI-агента для заявок с сайта под ключ</p>
        <p class="ym-cta-block__sub">Ответ за 5–15 секунд, квиз + чат + CRM, пилот 2–4 недели. Ориентир 120–350 тыс. ₽ — смета после аудита каналов.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#aud-zayavok" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Квиз на странице ↓</a>
        </div>
      </div>
    </div>
  </div>

  <section class="aozs-section" id="aud-zayavok" style="background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08));">
    <div class="aozs-cnt" style="text-align:center">
      <span class="aozs-eyebrow">Лид-магнит</span>
      <h2 style="font-size:clamp(28px,4.2vw,52px);margin:14px auto 16px;max-width:720px">Проверить, сколько заявок вы теряете</h2>
      <p style="max-width:620px;margin:0 auto 28px;font-size:16px">Аудит потерь заявок за 30 минут: доля обращений вне рабочего времени, задержка первого ответа, узкие места «форма → CRM → менеджер». AI отвечает за <strong>5–15 секунд</strong> и передаёт горячий лид в CRM.</p>
      <ul class="aozs-cta-checklist">
        <li>Каналы с сайта</li>
        <li>Время первого ответа</li>
        <li>Где лиды выпадают</li>
        <li>Без обязательств</li>
      </ul>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="font-size:16px;padding:16px 36px"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
    </div>
  </section>

</div><!-- /.aozs-content -->

<!-- SCHEMA-MARKUP:INSERT -->

</main>


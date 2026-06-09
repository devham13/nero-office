<?php
/**
 * Template Name: AI-триаж тикетов helpdesk: внедрение и настройка под ключ
 * Description: SEO-лендинг — внедрение AI-триажа тикетов helpdesk. Классификация, маршрутизация, SLA-контроль. Аудит helpdesk.
 */

$page_seo_title       = 'AI-триаж тикетов helpdesk: внедрение и настройка под ключ';
$page_seo_description = 'Внедрение AI-триажа тикетов в helpdesk: классификация темы и срочности, маршрутизация исполнителю, контроль SLA. Аудит helpdesk, интеграция с CRM. Под ключ для SaaS и IT-поддержки.';

add_filter('document_title_parts', static function (array $parts) use ($page_seo_title): array {
    $parts['title'] = $page_seo_title;
    return $parts;
}, 20);

add_action('wp_head', static function () use ($page_seo_title, $page_seo_description): void {
    echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
    echo '<meta property="og:type" content="article" />' . "\n";
}, 1);

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'SLA', 'href' => '#sla'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить helpdesk';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url = '#kak-rabotaet';

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

:root {
  --ym-primary: #8b5cf6;
  --ym-accent: #06b6d4;
  --ym-green: #22c55e;
  --ym-amber: #f59e0b;
  --ym-bg: #ffffff;
  --ym-bg-alt: #f8fafc;
  --ym-text: #0f172a;
  --ym-text-muted: #64748b;
  --ym-border: #e2e8f0;
  --ym-radius: 16px;
  --ym-shadow-sm: 0 2px 8px rgba(15,23,42,0.06);
  --ym-shadow-md: 0 8px 24px rgba(15,23,42,0.08);
  --ym-container: 1120px;
}

.ai-triage-tickets-helpdesk-page {
  font-family: Inter, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  color: var(--ym-text);
  line-height: 1.7;
  -webkit-font-smoothing: antialiased;
}

/* --- Hero (Алина) --- */
.fullscreen-white-office {
  position: relative;
  overflow: hidden;
  min-height: 100vh;
  min-height: 100dvh;
  background: #f8fafc;
  background-image:
    linear-gradient(rgba(226,232,240,0.4) 1px, transparent 1px),
    linear-gradient(90deg, rgba(226,232,240,0.4) 1px, transparent 1px);
  background-size: 60px 60px;
}
.aitt-hero-content {
  position: absolute;
  top: clamp(80px, 12vh, 140px);
  left: clamp(24px, 5vw, 80px);
  z-index: 4;
  max-width: 560px;
}
.aitt-eyebrow {
  display: inline-block;
  font-size: 13px;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  color: #8b5cf6;
  margin-bottom: 16px;
}
.giant-seo {
  font-size: clamp(32px, 4.5vw, 64px);
  font-weight: 900;
  line-height: 1.08;
  letter-spacing: -1.5px;
  color: #0f172a;
  margin: 0 0 20px 0;
}
.giant-seo span {
  display: inline;
  background: linear-gradient(90deg, #8b5cf6, #06b6d4);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.giant-seo-sub {
  font-size: clamp(15px, 1.8vw, 20px);
  line-height: 1.55;
  color: rgba(15, 23, 42, 0.72);
  margin-top: 0;
  max-width: 520px;
}
.aitt-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 20px;
}
.aitt-badge {
  padding: 6px 14px;
  background: rgba(139,92,246,0.08);
  border: 1px solid rgba(139,92,246,0.2);
  border-radius: 999px;
  font-size: 12px;
  font-weight: 600;
  color: #6d28d9;
}
.aitt-cta-row {
  display: flex;
  gap: 12px;
  margin-top: 28px;
  flex-wrap: wrap;
}
.aitt-btn-primary {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 14px 24px;
  background: #0f172a;
  color: #fff !important;
  border-radius: 999px;
  font-weight: 700;
  font-size: 14px;
  text-decoration: none;
  transition: transform 0.2s, box-shadow 0.2s;
  box-shadow: 0 4px 14px rgba(15,23,42,0.15);
}
.aitt-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(15,23,42,0.2); }
.aitt-btn-ghost {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 14px 24px;
  background: transparent;
  color: #334155 !important;
  border: 1.5px solid #e2e8f0;
  border-radius: 999px;
  font-weight: 600;
  font-size: 14px;
  text-decoration: none;
  transition: border-color 0.2s;
}
.aitt-btn-ghost:hover { border-color: #8b5cf6; }
.vl-ui-tasks {
  position: absolute;
  right: clamp(16px, 4vw, 60px);
  top: clamp(90px, 14vh, 180px);
  display: flex;
  flex-direction: column;
  gap: 10px;
  z-index: 3;
}
.vl-ui-task {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 18px;
  background: rgba(255,255,255,0.92);
  border: 1px solid #e2e8f0;
  border-radius: 14px;
  font-size: 13px;
  font-weight: 600;
  color: #334155;
  box-shadow: 0 4px 12px rgba(0,0,0,0.06);
  backdrop-filter: blur(6px);
}
.vl-ui-task span {
  width: 26px;
  height: 26px;
  background: #8b5cf6;
  color: #fff;
  border-radius: 7px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 11px;
  font-weight: 800;
  flex-shrink: 0;
}
.vl-ui-pill {
  position: absolute;
  bottom: clamp(20px, 4vh, 50px);
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  gap: 12px;
  z-index: 3;
  flex-wrap: wrap;
  justify-content: center;
}
.vl-ui-pill span {
  padding: 10px 16px;
  background: rgba(255,255,255,0.92);
  border: 1px solid #e2e8f0;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 600;
  color: #334155;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
.aitt-canvas-wrap {
  position: absolute;
  inset: 0;
  z-index: 1;
}
#aitt-triage-canvas {
  width: 100%;
  height: 100%;
  display: block;
}
@media (max-width: 900px) {
  .vl-ui-tasks { display: none; }
  .aitt-hero-content { max-width: 90%; }
}
@media (max-width: 600px) {
  .vl-ui-pill { display: none; }
  .aitt-hero-content { top: 60px; }
}

/* --- Intro after hero --- */
.aitt-intro {
  padding: 80px 0 56px;
  background: var(--ym-bg);
}
.aitt-intro-grid {
  max-width: var(--ym-container);
  margin: 0 auto;
  padding: 0 24px;
  display: grid;
  grid-template-columns: 1fr 340px;
  gap: 48px;
  align-items: start;
}
.aitt-intro-text {
  text-align: left;
  position: relative;
  padding-left: 20px;
  border-left: 3px solid var(--ym-primary);
}
.aitt-intro-text p {
  text-align: left !important;
  font-size: 17px;
  line-height: 1.75;
  color: var(--ym-text);
  margin: 0 0 18px;
}
.aitt-intro-decor {
  background: var(--ym-bg-alt);
  border: 1px solid var(--ym-border);
  border-radius: var(--ym-radius);
  padding: 28px 24px;
}
.aitt-intro-decor-title {
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--ym-primary);
  margin: 0 0 16px;
}
.aitt-intro-chips {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}
.aitt-intro-chip {
  padding: 8px 14px;
  background: rgba(139,92,246,0.06);
  border: 1px solid rgba(139,92,246,0.15);
  border-radius: 999px;
  font-size: 13px;
  font-weight: 600;
  color: var(--ym-text);
}
@media (max-width: 900px) {
  .aitt-intro-grid {
    grid-template-columns: 1fr;
    gap: 32px;
  }
}

/* --- Content sections --- */
.ym-container {
  max-width: var(--ym-container);
  margin: 0 auto;
  padding: 0 24px;
}
.ym-section {
  padding: 64px 0;
  background: var(--ym-bg);
}
.ym-section-alt {
  padding: 64px 0;
  background: var(--ym-bg-alt);
}
.ym-section h2 {
  font-size: clamp(24px, 3vw, 36px);
  font-weight: 800;
  line-height: 1.2;
  margin: 0 0 28px;
  color: var(--ym-text);
}
.ym-section h3 {
  font-size: clamp(18px, 2vw, 22px);
  font-weight: 700;
  line-height: 1.3;
  margin: 40px 0 16px;
  color: var(--ym-text);
}
.ym-section p {
  font-size: 16px;
  line-height: 1.75;
  margin: 0 0 18px;
  color: #334155;
}
.ym-section ul {
  padding-left: 0;
  margin: 0 0 20px;
  list-style: none;
}
.ym-section ul li {
  position: relative;
  padding-left: 24px;
  margin-bottom: 10px;
  font-size: 16px;
  line-height: 1.65;
  color: #334155;
}
.ym-section ul li::before {
  content: '';
  position: absolute;
  left: 0;
  top: 10px;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: var(--ym-primary);
  opacity: 0.7;
}

/* --- TOC --- */
.ym-toc {
  max-width: 680px;
  margin: 0 auto 48px;
  padding: 28px 32px;
  background: var(--ym-bg-alt);
  border: 1px solid var(--ym-border);
  border-radius: var(--ym-radius);
}
.ym-toc-title {
  font-size: 14px;
  font-weight: 700;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  color: var(--ym-primary);
  margin: 0 0 14px;
}
.ym-toc ol {
  padding-left: 20px;
  margin: 0;
}
.ym-toc ol li {
  margin-bottom: 8px;
}
.ym-toc ol li a {
  font-size: 15px;
  color: var(--ym-text);
  text-decoration: none;
  border-bottom: 1px dashed var(--ym-border);
  transition: color 0.2s, border-color 0.2s;
}
.ym-toc ol li a:hover {
  color: var(--ym-primary);
  border-color: var(--ym-primary);
}

/* --- KPI table --- */
.ym-kpi-table {
  width: 100%;
  border-collapse: collapse;
  margin: 24px 0 32px;
  font-size: 14px;
}
.ym-kpi-table th,
.ym-kpi-table td {
  padding: 12px 16px;
  border: 1px solid var(--ym-border);
  text-align: left;
}
.ym-kpi-table th {
  background: var(--ym-bg-alt);
  font-weight: 700;
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: 0.03em;
  color: var(--ym-text-muted);
}
.ym-kpi-table td {
  color: var(--ym-text);
}
.ym-kpi-table tr:nth-child(even) td {
  background: var(--ym-bg-alt);
}
.ym-kpi-green { color: var(--ym-green); font-weight: 700; }

/* --- CTA blocks --- */
.ym-cta-block {
  margin: 48px 0;
  padding: 36px 32px;
  border-radius: var(--ym-radius);
  border: 1px solid var(--ym-border);
  background: var(--ym-bg-alt);
  display: flex;
  gap: 20px;
  align-items: flex-start;
}
.ym-cta-block--primary {
  border-color: rgba(139,92,246,0.25);
  background: linear-gradient(135deg, rgba(139,92,246,0.04) 0%, rgba(6,182,212,0.04) 100%);
}
.ym-cta-block--secondary {
  border-color: var(--ym-border);
}
.ym-cta-block--dual {
  border-color: rgba(139,92,246,0.2);
  background: linear-gradient(135deg, rgba(139,92,246,0.05) 0%, #fff 100%);
}
.ym-cta-block__icon {
  font-size: 32px;
  flex-shrink: 0;
}
.ym-cta-block__body { flex: 1; }
.ym-cta-block__headline {
  font-size: 18px;
  font-weight: 800;
  color: var(--ym-text);
  margin: 0 0 10px;
}
.ym-cta-block__sub {
  font-size: 15px;
  line-height: 1.65;
  color: #475569;
  margin: 0 0 18px;
}
.ym-cta-block__actions {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
}
.nero-ai-btn-primary,
.ym-btn--accent {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 13px 28px;
  background: #0f172a;
  color: #fff !important;
  border-radius: 999px;
  font-weight: 700;
  font-size: 14px;
  text-decoration: none;
  transition: transform 0.2s, box-shadow 0.2s;
  box-shadow: 0 4px 14px rgba(15,23,42,0.12);
}
.nero-ai-btn-primary:hover,
.ym-btn--accent:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(15,23,42,0.18);
}
.ym-link--accent {
  color: var(--ym-primary);
  font-weight: 600;
  text-decoration: underline;
  text-underline-offset: 3px;
}
.ym-link--accent:hover {
  color: #6d28d9;
}

/* --- FAQ --- */
.ym-faq-item {
  border-bottom: 1px solid var(--ym-border);
  padding: 24px 0;
}
.ym-faq-item:last-child { border-bottom: none; }
.ym-faq-item h3 {
  margin: 0 0 12px;
  font-size: 18px;
}
.ym-faq-item p {
  margin: 0;
  font-size: 15px;
  color: #475569;
}

/* --- Reveal --- */
.reveal {
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}
.reveal.visible {
  opacity: 1;
  transform: translateY(0);
}
.delay-1 { transition-delay: 0.1s; }
.delay-2 { transition-delay: 0.2s; }
.delay-3 { transition-delay: 0.3s; }

@media (max-width: 600px) {
  .ym-cta-block { flex-direction: column; }
}
</style>

<!-- wp:html -->
<main id="primary" class="site-main ai-triage-tickets-helpdesk-page" role="main" tabindex="-1">

  <!-- ===== HERO (Алина) ===== -->
  <section id="factory" class="fullscreen-white-office" aria-labelledby="aitt-hero-title">
    <div class="aitt-canvas-wrap">
      <canvas id="aitt-triage-canvas"></canvas>
    </div>

    <div class="aitt-hero-content">
      <span class="aitt-eyebrow">Nero Network · AI-триаж helpdesk</span>
      <h1 id="aitt-hero-title" class="giant-seo">AI-триаж тикетов helpdesk:<br><span>внедрение и настройка под ключ</span></h1>
      <p class="giant-seo-sub">AI определяет тему, срочность и исполнителя — SLA под контролем, без ручной сортировки очереди</p>
      <div class="aitt-badges">
        <span class="aitt-badge">AI triage</span>
        <span class="aitt-badge">Маршрутизация</span>
        <span class="aitt-badge">SLA-контроль</span>
        <span class="aitt-badge">Zendesk/JSM</span>
        <span class="aitt-badge">Human-in-the-loop</span>
        <span class="aitt-badge">CRM</span>
      </div>
      <div class="aitt-cta-row">
        <a class="aitt-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>" target="_blank" rel="noopener noreferrer">Проверить helpdesk</a>
        <a class="aitt-btn-ghost" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="vl-ui-tasks">
      <div class="vl-ui-task"><span>1</span> Аудит SLA</div>
      <div class="vl-ui-task"><span>2</span> Таксономия</div>
      <div class="vl-ui-task"><span>3</span> LLM-классификатор</div>
      <div class="vl-ui-task"><span>4</span> Авто-маршрутизация</div>
      <div class="vl-ui-task"><span>5</span> SLA-контроль</div>
    </div>

    <div class="vl-ui-pill">
      <span>85–95% точность</span>
      <span>−43% нагрузка L1</span>
      <span>28 сек триаж</span>
      <span>SLA breach &lt;5%</span>
    </div>
  </section>

  <!-- ===== Введение после hero ===== -->
  <section class="ym-section aitt-intro reveal" id="chto-takoe">
    <div class="aitt-intro-grid">
      <div class="aitt-intro-text">
        <p><strong>AI-триаж тикетов helpdesk</strong> — слой автоматизации между входящим обращением клиента и очередью операторов. Система анализирует текст тикета, определяет тему (intent), срочность, язык и тональность. На основе полученных атрибутов AI назначает очередь, группу или конкретного исполнителя и проставляет SLA-таймер.</p>
        <p>Боль: тикеты попадают не к тому специалисту, время первого ответа растёт, процент переназначений увеличивается, SLA нарушается. Первая линия тратит 3–5 минут на ручную сортировку каждого обращения — рутина без экспертной ценности.</p>
      </div>
      <div class="aitt-intro-decor">
        <p class="aitt-intro-decor-title">KPI до/после AI-триажа</p>
        <div class="aitt-intro-chips">
          <span class="aitt-intro-chip">3–5 мин → 28 сек</span>
          <span class="aitt-intro-chip">SLA breach −70%</span>
          <span class="aitt-intro-chip">85–95% accuracy</span>
          <span class="aitt-intro-chip">−43% L1 load</span>
          <span class="aitt-intro-chip">Reassign &lt;10%</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== TOC ===== -->
  <div class="ym-container reveal delay-1">
    <nav class="ym-toc" aria-label="Оглавление">
      <p class="ym-toc-title">Содержание</p>
      <ol>
        <li><a href="#kak-rabotaet">Как работает AI-классификация и маршрутизация</a></li>
        <li><a href="#etapy">Внедрение AI triage tickets под ключ: этапы</a></li>
        <li><a href="#integracii">Интеграция с helpdesk и CRM</a></li>
        <li><a href="#sla">Контроль SLA и приоритетов с AI</a></li>
        <li><a href="#keisy">Кейсы и результаты внедрения</a></li>
        <li><a href="#ceny">Стоимость внедрения</a></li>
        <li><a href="#faq">FAQ</a></li>
      </ol>
    </nav>
  </div>

  <!-- ===== Секция: Как работает ===== -->
  <section class="ym-section reveal" id="kak-rabotaet">
    <div class="ym-container">
      <h2>Как работает AI-классификация и маршрутизация тикетов</h2>
      <p>Типичный стек: webhook/API helpdesk → LLM/ML-классификатор → правила маршрутизации (confidence threshold, VIP, SLA) → обновление полей тикета в целевой системе.</p>

      <h3>Определение темы и категории обращения</h3>
      <p>LLM анализирует subject и body тикета, возвращая JSON с полями: intent, priority, urgency_score, language, sentiment, suggested_queue, confidence и reasoning. Для ticket routing оптимален claude-haiku как компромисс между стоимостью и задержкой. Чётко определённый список категорий намерений — решающий фактор точной классификации; иерархическая таксономия при 20+ категориях.</p>

      <h3>Расчёт приоритета и срочности</h3>
      <p>AI учитывает не только текст, но и метаданные: тарифный план клиента, канал обращения, историю предыдущих тикетов. Zendesk Intelligent Triage: ML-модель добавляет custom fields, триггеры маршрутизируют по intent, sentiment и language. Результат — сокращение времени обработки на 30–60 секунд на каждый тикет и автоматическая приоритизация revenue-critical обращений.</p>

      <h3>Назначение исполнителя и эскалация</h3>
      <p>После определения темы и приоритета rule engine проверяет условия: VIP-клиент, ключевые слова outage/security/fraud, PII. При срабатывании — принудительная эскалация. Остальные тикеты назначаются через helpdesk API: обновление полей, assignee, tags, SLA policy.</p>
      <p>В Jira Service Management Rovo-агент анализирует summary и description, предлагает request type, priority и escalation. Встраивается в automation rules для мгновенного обновления при появлении тикета.</p>

      <h3>Human-in-the-loop для критичных тикетов</h3>
      <p>Практика НЛМК (кейс AI-ICS): при confidence ≥ порога (CT 0,8) — автомаршрутизация, при более низкой уверенности — ручная проверка оператором. AI не «промажет» по критичным обращениям (security, юридические, отмена enterprise-контракта), а скорость обработки типовых тикетов вырастет.</p>
      <p>DevRev (2026) описывает эволюцию: Era 1 — rule-based, Era 2 — ML/NLP (Zendesk, Freshdesk Freddy), Era 3 — agentic AI с knowledge graph.</p>
      <p>Когда часть обращений приходит по email и попадает в CRM раньше helpdesk, тема ближе к <a href="<?php echo esc_url(home_url('/vnedrenie-ai-obrabotka-email-crm/')); ?>" class="ym-link ym-link--accent">AI-обработке входящей почты в CRM</a>: классификация письма, извлечение сущностей и маршрутизация до очереди поддержки. AI-триаж тикетов фокусируется на support-очереди, SLA и назначении исполнителя.</p>
      <p>На корпоративном масштабе те же принципы human-in-the-loop и managed-агентов уже проверены в enterprise: в разборе <a href="<?php echo esc_url(home_url('/kpmg-claude-vnedrenie-ai-276-tysyach/')); ?>" class="ym-link ym-link--accent">KPMG и Claude — уроки AI для бизнеса</a> показаны цифровые шлюзы, которые можно адаптировать к helpdesk-маршрутизации.</p>
    </div>
  </section>

  <!-- ===== БОРИС (блок статьи) — после #kak-rabotaet ===== -->
  <section id="ai-triage-tickets-helpdesk-boris-block" class="aitt-boris-root" aria-label="Анимация: AI-триаж тикета — от входа до назначения исполнителя и SLA-таймера">
<style>
#ai-triage-tickets-helpdesk-boris-block.aitt-boris-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-triage-tickets-helpdesk-boris-block .aitt-b-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-triage-tickets-helpdesk-boris-block .aitt-b-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:480px;
}
@media(max-width:1023px){
  #ai-triage-tickets-helpdesk-boris-block .aitt-b-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-triage-tickets-helpdesk-boris-block .aitt-b-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-triage-tickets-helpdesk-boris-block .aitt-b-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-triage-tickets-helpdesk-boris-block .aitt-b-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#8b5cf6;
  margin:0 0 14px;
}
#ai-triage-tickets-helpdesk-boris-block .aitt-b-ey::before{
  content:'';
  width:18px;height:2px;
  background:#8b5cf6;
  border-radius:1px;
}
#ai-triage-tickets-helpdesk-boris-block .aitt-b-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-triage-tickets-helpdesk-boris-block .aitt-b-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-triage-tickets-helpdesk-boris-block .aitt-b-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-triage-tickets-helpdesk-boris-block .aitt-b-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  margin-top:1px;
  font-style:normal;
  font-weight:700;
}
#ai-triage-tickets-helpdesk-boris-block .aitt-b-ic-v{
  background:rgba(139,92,246,.1);
  color:#7c3aed;
}
#ai-triage-tickets-helpdesk-boris-block .aitt-b-ic-g{
  background:rgba(34,197,94,.1);
  color:#15803d;
}
#ai-triage-tickets-helpdesk-boris-block .aitt-b-ic-a{
  background:rgba(245,158,11,.1);
  color:#b45309;
}
#ai-triage-tickets-helpdesk-boris-block .aitt-b-ic-c{
  background:rgba(14,165,233,.1);
  color:#0284c7;
}
#ai-triage-tickets-helpdesk-boris-block .aitt-b-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-triage-tickets-helpdesk-boris-block .aitt-b-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-triage-tickets-helpdesk-boris-block .aitt-b-pl--green{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-triage-tickets-helpdesk-boris-block .aitt-b-pl--cyan{
  background:rgba(14,165,233,.08);
  color:#0369a1;
  border:1.5px solid rgba(14,165,233,.22);
}
#ai-triage-tickets-helpdesk-boris-block .aitt-b-pl--violet{
  background:rgba(139,92,246,.08);
  color:#6d28d9;
  border:1.5px solid rgba(139,92,246,.22);
}
#ai-triage-tickets-helpdesk-boris-block .aitt-b-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-triage-tickets-helpdesk-boris-block .aitt-b-rgt{
  position:relative;
  background:linear-gradient(135deg,#f5f3ff 0%,#ede9fe 45%,#f8fafc 100%);
  min-height:420px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-triage-tickets-helpdesk-boris-block .aitt-b-rgt{min-height:360px;}
}
#aitt-boris-triage-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="aitt-b-cnt">
  <div class="aitt-b-card">

    <div class="aitt-b-lft">
      <span class="aitt-b-ey">Маршрутизация в действии</span>
      <h3 class="aitt-b-h3">От нового тикета до нужного специалиста — за секунды, а не минуты</h3>
      <ul class="aitt-b-ul">
        <li><span class="aitt-b-ic aitt-b-ic-v">1</span>AI определяет intent: billing, bug, feature request или security</li>
        <li><span class="aitt-b-ic aitt-b-ic-a">2</span>Оценивает срочность: VIP-клиент, outage-слова, время до SLA breach</li>
        <li><span class="aitt-b-ic aitt-b-ic-g">3</span>При confidence ≥ 0,8 — автоназначение исполнителя и очереди</li>
        <li><span class="aitt-b-ic aitt-b-ic-c">?</span>Низкая уверенность — очередь «Manual triage» для оператора L1</li>
      </ul>
      <div class="aitt-b-pills">
        <span class="aitt-b-pl aitt-b-pl--green">3–5 мин → 28 сек</span>
        <span class="aitt-b-pl aitt-b-pl--cyan">85% авто-маршрутизация</span>
        <span class="aitt-b-pl aitt-b-pl--violet">confidence threshold</span>
      </div>
      <p class="aitt-b-foot">Далее — этапы внедрения AI-триажа под ключ →</p>
    </div>

    <div class="aitt-b-rgt">
      <canvas
        id="aitt-boris-triage-canvas"
        aria-label="Анимация: входящий тикет классифицируется AI, получает приоритет и назначается в правильную очередь поддержки"
        role="img"
      ></canvas>
    </div>

  </div>
</div>
</section>

  <!-- ===== Секция: Этапы ===== -->
  <section class="ym-section-alt reveal" id="etapy">
    <div class="ym-container">
      <h2>Внедрение AI triage tickets под ключ: этапы проекта</h2>

      <h3>Аудит SLA и маршрутизации</h3>
      <p>Первый шаг — выгрузка 500–2000 тикетов за 30–90 дней. Строится карта: процент переназначений, нарушения SLA, среднее время triage, топ-10 «потерянных» категорий. Аудит выявляет конкретные bottleneck и задаёт baseline KPI для оценки эффекта внедрения.</p>

      <h3>Проектирование правил триажа и таксономии тем</h3>
      <p>На основе аудита формируется intent-таксономия из 8–15 категорий. Составляется матрица «тема × приоритет × очередь × SLA». Проектируется rule engine: VIP-правила, compliance-фильтры, confidence threshold.</p>

      <h3>Обучение модели на истории тикетов</h3>
      <p>Для полноценного ML-обучения требуется минимум 500 размеченных тикетов (идеально 2000+). Freshdesk Freddy Auto Triage требует ≥2000 тикетов для предсказания Type/Group. В случае НЛМК модель обучалась на ~1 млн обращений за 2 года. Для MVP достаточно few-shot промптинга LLM с примерами из истории.</p>

      <h3>Пилот, метрики и масштабирование</h3>
      <p>Пилот запускается в режиме Assist: AI предлагает классификацию, оператор подтверждает или исправляет. Кейс «Петрович» + «Обит»: обработано 20 тыс. звонков за ~3 недели, точность 89,03%. Паттерн внедрения 2026: Assist Mode → auto-route low-risk → human-in-the-loop для критичных.</p>
      <p>Метрики перехода на автомаршрутизацию: accuracy ≥ 85%, reassign rate &lt; 10%, SLA breach снижение ≥ 30%. При достижении gate — масштабирование на весь поток.</p>
    </div>
  </section>

  <!-- ===== CTA после этапов (Артур) ===== -->
  <aside class="ym-cta-block ym-cta-block--primary" id="cta-etapy">
    <div class="ym-cta-block__icon" aria-hidden="true">🎫</div>
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Заказать аудит SLA и маршрутизации</p>
      <p class="ym-cta-block__sub">Выгрузим 500–2000 тикетов за 30–90 дней, построим карту переназначений и нарушений SLA и покажем топ «потерянных» категорий. На созвоне — baseline KPI и план пилота. Без обязательств.</p>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" target="_blank" rel="noopener noreferrer">Проверить helpdesk</a>
    </div>
  </aside>

  <!-- ===== Секция: Интеграции ===== -->
  <section class="ym-section reveal" id="integracii">
    <div class="ym-container">
      <h2>Интеграция с helpdesk и CRM</h2>

      <h3>Webhook/API: тикет → LLM-классификатор → маршрутизатор</h3>
      <p>Архитектура интеграции включает модули:</p>
      <ul>
        <li>Ingestion (webhook listener через n8n, Make или custom FastAPI)</li>
        <li>LLM Classifier (промпт + few-shot + опционально RAG по базе знаний)</li>
        <li>Rule Engine (SLA, VIP, compliance, confidence threshold)</li>
        <li>Routing Executor (helpdesk API adapter)</li>
        <li>Human Review Queue (тикеты с низкой уверенностью)</li>
        <li>Feedback &amp; Retraining Pipeline</li>
      </ul>
      <p>Поддерживаемые платформы: Zendesk, Freshdesk, Jira Service Management, ServiceNow, Битрикс24, amoCRM, OTRS, Naumen — через REST API.</p>

      <h3>Связка с CRM, уведомлениями и отчётностью</h3>
      <p>Система интегрируется с CRM (<a href="<?php echo esc_url(home_url('/vnedrenie-ai-amocrm/')); ?>" class="ym-link ym-link--accent">amoCRM</a>, Битрикс24) для обогащения контекста: история клиента, тарифный план, LTV. Уведомления исполнителю — в Telegram, Slack или внутренний мессенджер. Аналитический дашборд (Metabase, Google Sheets, BI) отслеживает KPI в реальном времени.</p>
      <p>Дополнительные интеграции: телефония (Mango, UIS, Телфин → транскрипт → triage), мессенджеры (Telegram, WhatsApp Business, VK), база знаний (Confluence, Notion).</p>

      <h3>Безопасность и PII в обращениях поддержки</h3>
      <p>Тикеты часто содержат персональные данные. При отправке в облачный LLM требуется маскирование PII до классификации. Для российского enterprise доступны on-prem варианты: GigaChat, YandexGPT, локальный Qwen — обработка в закрытом контуре без передачи данных за периметр. Соответствие 152-ФЗ обеспечивается архитектурно.</p>
      <p>Если тикет связан с заявкой, счётом или документом в учётной системе, цепочку дополняет <a href="<?php echo esc_url(home_url('/ai-1c-erp/')); ?>" class="ym-link ym-link--accent">AI-агент для 1С и ERP</a>: от триажа обращения до создания «Заказа клиента» или «Заявки на расход ДС» без двойного ввода.</p>
    </div>
  </section>

  <!-- ===== CTA после интеграций (Артур) ===== -->
  <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Хотите разобраться в AI-триаже до старта проекта?</p>
      <p class="ym-cta-block__sub">Команда быстрее согласует webhook-архитектуру, human-in-the-loop и интеграцию с helpdesk — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: $primary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по AI-автоматизации'); ?></a>.</p>
    </div>
  </aside>

  <!-- ===== Секция: SLA ===== -->
  <section class="ym-section-alt reveal" id="sla">
    <div class="ym-container">
      <h2>Контроль SLA и приоритетов с AI</h2>

      <h3>Метрики: время первого ответа, % нарушений SLA, нагрузка L1</h3>
      <table class="ym-kpi-table">
        <thead>
          <tr>
            <th>Метрика</th>
            <th>До внедрения</th>
            <th>После внедрения (ориентир)</th>
          </tr>
        </thead>
        <tbody>
          <tr><td>Routing accuracy</td><td>40–50% (rule-based)</td><td class="ym-kpi-green">85–95% (LLM)</td></tr>
          <tr><td>Auto-triage coverage</td><td>0%</td><td class="ym-kpi-green">51–80%</td></tr>
          <tr><td>Reassign rate</td><td>20–40%</td><td class="ym-kpi-green">&lt; 10%</td></tr>
          <tr><td>Manual triage time</td><td>3–5 мин/тикет</td><td class="ym-kpi-green">&lt; 30 сек</td></tr>
          <tr><td>L1 volume</td><td>baseline</td><td class="ym-kpi-green">−43% (Geodis)</td></tr>
        </tbody>
      </table>
      <p>Кейс Geodis (логистика, Франция): AI-агент auto-routes misclassified тикеты → минус 43% объёма L1, минус 60% времени назначения, экономия ~30 минут на тикет.</p>

      <h3>Дашборды и алерты для руководителя поддержки</h3>
      <p>AI-система подключается к аналитическому дашборду: точность классификации, coverage, FRT, SLA breach rate, процент авто-маршрутизации. Настраиваются алерты: рост breach rate выше порога, падение accuracy, аномальный объём тикетов. Руководитель получает проактивное управление вместо реактивного тушения пожаров.</p>
    </div>
  </section>

  <!-- ===== Секция: Кейсы ===== -->
  <section class="ym-section reveal" id="keisy">
    <div class="ym-container">
      <h2>Кейсы и результаты внедрения</h2>

      <h3>SaaS и IT-поддержка: до/после</h3>
      <p><strong>НЛМК AI-ICS</strong> (Россия, enterprise): 61% обращений автоклассифицированы при confidence threshold 0,8; из них 84% точно по всем атрибутам — общий охват корректной автомаршрутизации ~51%. Точность классификации доведена до 85%. Прогноз — до 80% email-обращений без ручной маршрутизации.</p>
      <p><strong>Helpy</strong> (Россия): автоопределение направления обращений с точностью до 88,5%. Связка: триаж + саммари диалогов + подсказки из базы знаний.</p>
      <p><strong>T1 AI Support</strong> (Россия): автоклассификация обращений в ITSM, суммаризация, умный поиск. On-premise и облако, реестр российского ПО.</p>

      <h3>Сервисные центры и омниканальная очередь</h3>
      <p><strong>СТД «Петрович» + «Обит»</strong> (ритейл): LLM-классификация по трёхуровневой таксономии категорий обращений. Обработано 20 тыс. звонков за ~3 недели, точность 89,03%.</p>
      <p><strong>Ростелеком «Омнибот»</strong> (телеком): чат-бот с автоопределением интента + RAG-база знаний. Автоматизация до 50% обращений в чатах.</p>

      <h3>Тренд contact center automation 2026</h3>
      <p>IBM (январь 2026): «Intelligent routing uses AI and machine learning to match customers with the most appropriate resources based on interaction history, agent expertise, call volume, level of customer need and issue complexity». Главный вектор — human-machine collaboration: технология обрабатывает рутину, а человек решает сложные задачи.</p>
      <p>ServiceNow Predictive Intelligence: гибрид ML + детерминированные правила. При confidence ≥ 0,7 — автомаршрутизация, ниже — rule-based fallback.</p>
    </div>
  </section>

  <!-- ===== Секция: Стоимость ===== -->
  <section class="ym-section-alt reveal" id="ceny">
    <div class="ym-container">
      <h2>Стоимость внедрения AI-триажа тикетов</h2>

      <h3>Что входит в проект под ключ</h3>
      <p>Типовой проект внедрения ai triage tickets включает:</p>
      <ul>
        <li>Аудит SLA и маршрутизации (1–2 недели)</li>
        <li>Дизайн таксономии и правил (1 неделя)</li>
        <li>Разработка MVP в режиме Assist (2–3 недели)</li>
        <li>Пилот и калибровка threshold (2–4 недели)</li>
        <li>Переход на автомаршрутизацию (1–2 недели)</li>
        <li>Настройка дашборда и feedback loop (1 неделя)</li>
        <li>Документация и обучение команды</li>
      </ul>
      <p>Ориентир сроков: от MVP до production — 6–10 недель.</p>

      <h3>От чего зависит бюджет: объём интеграций, языки, SLA-политики</h3>
      <p>Ориентир чека: 250–800 тыс. ₽ за внедрение под ключ. Стоимость зависит от количества интеграций, сложности таксономии, требований безопасности (облако vs on-prem), объёма данных и числа языков, уровня кастомизации дашборда.</p>
      <p>Для сравнения: один FTE на L1 с функцией ручной маршрутизации стоит от 80–120 тыс. ₽/мес. Кейс Geodis показывает экономию ~30 минут на каждый тикет — при потоке в сотни обращений ROI наступает в первые месяцы.</p>
    </div>
  </section>

  <!-- ===== CTA после стоимости (Артур) ===== -->
  <div class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Узнайте бюджет под ваш helpdesk</p>
      <p class="ym-cta-block__sub">Ориентир 250–800 тыс. ₽ за внедрение ai triage tickets под ключ. На аудите «Проверить helpdesk» дадим оценку интеграций, сроков пилота и ROI — бесплатно.</p>
      <div class="ym-cta-block__actions">
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" target="_blank" rel="noopener noreferrer">Проверить helpdesk</a>
      </div>
    </div>
  </div>

  <!-- ===== Секция: FAQ ===== -->
  <section class="ym-section reveal" id="faq">
    <div class="ym-container">
      <h2>FAQ: AI-триаж тикетов helpdesk</h2>

      <div class="ym-faq-item">
        <h3>Как внедрить ai triage tickets в существующий helpdesk?</h3>
        <p>Интеграция происходит через API/webhook без замены текущей платформы. Webhook нового тикета → LLM-классификатор → обновление полей через API helpdesk. Поддерживаются Zendesk, Freshdesk, JSM, Битрикс24, amoCRM и другие системы с REST API. Начинать рекомендуется с режима Assist.</p>
      </div>

      <div class="ym-faq-item">
        <h3>Подходит ли для малого бизнеса?</h3>
        <p>При потоке менее 50 тикетов в день полноценный ML-триаж может быть избыточен. Однако LLM-решение на базе few-shot промптов работает даже при небольшой истории. Для малого бизнеса оптимален режим Assist + rule-assisted: минимальные затраты, ощутимый эффект при росте потока.</p>
      </div>

      <div class="ym-faq-item">
        <h3>Нужна ли замена текущей системы тикетов?</h3>
        <p>Нет. AI-триаж — надстройка, а не замена helpdesk. Система интегрируется через API. Даже legacy-системы без нативной AI-функциональности подключаются через webhook-прослойку (n8n, Make, custom).</p>
      </div>

      <div class="ym-faq-item">
        <h3>Как измерить точность классификации?</h3>
        <p>Основная метрика — routing accuracy: процент тикетов, назначенных верно с первого раза. Измеряется по feedback операторов. Ориентир для production: ≥ 85%. Дополнительно — reassign rate (цель &lt; 10%) и confidence distribution.</p>
      </div>

      <div class="ym-faq-item">
        <h3>Чем отличается от AI-обработки email в CRM?</h3>
        <p>AI-триаж тикетов helpdesk работает с support-обращениями: техническая поддержка, сервисные запросы, инциденты. AI-обработка email в CRM ориентирована на sales-воронку. Разные таксономии, разные SLA-политики, разные очереди.</p>
      </div>
    </div>
  </section>

<?php
$aitt_page_url = trailingslashit(get_permalink());
$aitt_site_url = trailingslashit(home_url('/'));
$aitt_brand    = get_bloginfo('name') ?: 'Nero Network';
$aitt_schema   = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type' => 'Organization',
            '@id'   => $aitt_site_url . '#organization',
            'name'  => $aitt_brand,
            'url'   => $aitt_site_url,
        ],
        [
            '@type'     => 'WebSite',
            '@id'       => $aitt_site_url . '#website',
            'url'       => $aitt_site_url,
            'name'      => $aitt_brand,
            'publisher' => ['@id' => $aitt_site_url . '#organization'],
        ],
        [
            '@type'       => 'WebPage',
            '@id'         => $aitt_page_url . '#webpage',
            'url'         => $aitt_page_url,
            'name'        => $page_seo_title,
            'description' => $page_seo_description,
            'isPartOf'    => ['@id' => $aitt_site_url . '#website'],
            'about'       => ['@id' => $aitt_site_url . '#organization'],
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id'   => $aitt_page_url . '#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $aitt_site_url],
                ['@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $aitt_page_url],
            ],
        ],
        [
            '@type'       => 'Service',
            '@id'         => $aitt_page_url . '#service',
            'name'        => $page_seo_title,
            'description' => $page_seo_description,
            'url'         => $aitt_page_url,
            'provider'    => ['@id' => $aitt_site_url . '#organization'],
        ],
        [
            '@type' => 'FAQPage',
            '@id'   => $aitt_page_url . '#faq',
            'mainEntity' => [
                ['@type' => 'Question', 'name' => 'Как внедрить ai triage tickets в существующий helpdesk?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Интеграция происходит через API/webhook без замены текущей платформы. Webhook нового тикета → LLM-классификатор → обновление полей через API helpdesk. Поддерживаются Zendesk, Freshdesk, JSM, Битрикс24, amoCRM и другие системы с REST API. Начинать рекомендуется с режима Assist.']],
                ['@type' => 'Question', 'name' => 'Подходит ли для малого бизнеса?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'При потоке менее 50 тикетов в день полноценный ML-триаж может быть избыточен. Однако LLM-решение на базе few-shot промптов работает даже при небольшой истории. Для малого бизнеса оптимален режим Assist + rule-assisted: минимальные затраты, ощутимый эффект при росте потока.']],
                ['@type' => 'Question', 'name' => 'Нужна ли замена текущей системы тикетов?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Нет. AI-триаж — надстройка, а не замена helpdesk. Система интегрируется через API. Даже legacy-системы без нативной AI-функциональности подключаются через webhook-прослойку (n8n, Make, custom).']],
                ['@type' => 'Question', 'name' => 'Как измерить точность классификации?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Основная метрика — routing accuracy: процент тикетов, назначенных верно с первого раза. Измеряется по feedback операторов. Ориентир для production: ≥ 85%. Дополнительно — reassign rate (цель < 10%) и confidence distribution.']],
                ['@type' => 'Question', 'name' => 'Чем отличается от AI-обработки email в CRM?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'AI-триаж тикетов helpdesk работает с support-обращениями: техническая поддержка, сервисные запросы, инциденты. AI-обработка email в CRM ориентирована на sales-воронку. Разные таксономии, разные SLA-политики, разные очереди.']],
            ],
        ],
    ],
];
echo '<script type="application/ld+json">' . wp_json_encode($aitt_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
?>
</main>
<!-- /wp:html -->

<!-- ===== Hero Canvas Engine (Алина) ===== -->
<script>
document.addEventListener("DOMContentLoaded", () => {
  const canvas = document.getElementById("aitt-triage-canvas");
  if (!canvas) return;
  const ctx = canvas.getContext("2d");

  let cw = 0, ch = 0, scale = 1;
  let cx = 0, cy = 0;
  let frame = 0;

  function resizeCanvas() {
    if (!canvas.parentElement) return;
    canvas.width = canvas.parentElement.clientWidth || window.innerWidth;
    canvas.height = canvas.parentElement.clientHeight || window.innerHeight;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = (ch / 2) + 40;
    if (cw < 768) {
      scale = cw / 600;
    } else {
      scale = Math.min(cw / 1100, ch / 850) * 1.4;
    }
  }
  window.addEventListener('resize', resizeCanvas);
  resizeCanvas();

  const C = {
    outline: '#0f172a',
    radarBg: '#f1f5f9', radarRing: '#cbd5e1', radarSweep: 'rgba(139,92,246,0.25)',
    laneUrgent: '#fecaca', laneNormal: '#bbf7d0', laneLow: '#bfdbfe',
    queueUrgent: '#ef4444', queueNormal: '#22c55e', queueLow: '#3b82f6',
    ticketBody: '#ffffff', ticketBorder: '#e2e8f0',
    slaOk: '#22c55e', slaWarn: '#f59e0b', slaBreach: '#ef4444',
    agentYellow: '#eab308', agentGreen: '#10b981', agentBlue: '#3b82f6',
    agentPink: '#ec4899', agentPurple: '#8b5cf6',
    bubbleBg: '#ffffff', confidenceBar: '#8b5cf6',
    pulseGreen: '#22c55e'
  };

  function drawPolyRound(ctx, x, y, w, h, radius, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, radius);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) { ctx.lineWidth = 2; ctx.strokeStyle = stroke; ctx.stroke(); }
  }

  class TriageRadar {
    constructor(x, y, radius) {
      this.x = x; this.y = y; this.radius = radius;
      this.sweepAngle = 0;
      this.classifyProgress = 0;
      this.slaFlash = 0;
    }
    draw(ctx) {
      this.sweepAngle += 0.012;
      let prg = (frame * 0.04) % 240;
      this.classifyProgress = prg;

      ctx.save();
      ctx.translate(this.x, this.y);

      ctx.fillStyle = C.radarBg;
      ctx.beginPath();
      ctx.arc(0, 0, this.radius, 0, Math.PI * 2);
      ctx.fill();
      ctx.lineWidth = 2;
      ctx.strokeStyle = C.radarRing;
      ctx.stroke();

      ctx.strokeStyle = 'rgba(203,213,225,0.4)';
      ctx.lineWidth = 1;
      ctx.beginPath(); ctx.arc(0, 0, this.radius * 0.6, 0, Math.PI * 2); ctx.stroke();
      ctx.beginPath(); ctx.arc(0, 0, this.radius * 0.3, 0, Math.PI * 2); ctx.stroke();

      ctx.beginPath();
      ctx.moveTo(0, 0);
      let sx = Math.cos(this.sweepAngle) * this.radius;
      let sy = Math.sin(this.sweepAngle) * this.radius;
      ctx.lineTo(sx, sy);
      ctx.strokeStyle = C.confidenceBar;
      ctx.lineWidth = 2.5;
      ctx.stroke();

      let grad = ctx.createConicGradient(this.sweepAngle - 0.6, 0, 0);
      grad.addColorStop(0, 'rgba(139,92,246,0)');
      grad.addColorStop(0.15, C.radarSweep);
      grad.addColorStop(0.3, 'rgba(139,92,246,0)');
      ctx.fillStyle = grad;
      ctx.beginPath();
      ctx.arc(0, 0, this.radius, 0, Math.PI * 2);
      ctx.fill();

      if (prg > 200) {
        this.slaFlash = Math.min(1, (prg - 200) / 20);
        ctx.globalAlpha = this.slaFlash * (0.5 + 0.5 * Math.sin(frame * 0.15));
        ctx.fillStyle = C.slaOk;
        ctx.beginPath();
        ctx.arc(0, 0, this.radius + 8, 0, Math.PI * 2);
        ctx.fill();
        ctx.globalAlpha = this.slaFlash;
        ctx.font = 'bold 14px Inter, sans-serif';
        ctx.textAlign = 'center';
        ctx.fillStyle = C.slaOk;
        ctx.fillText('SLA OK \u2713', 0, -this.radius - 18);
        ctx.globalAlpha = 1;
      } else {
        this.slaFlash = 0;
      }

      ctx.fillStyle = C.outline;
      ctx.beginPath();
      ctx.arc(0, 0, 5, 0, Math.PI * 2);
      ctx.fill();

      ctx.restore();
    }
  }

  class RoutingLanes {
    constructor(centerX, centerY, radarRadius) {
      this.cx = centerX; this.cy = centerY;
      this.rr = radarRadius;
      this.lanes = [
        { angle: -Math.PI / 4, color: C.laneUrgent, qColor: C.queueUrgent, label: 'URGENT' },
        { angle: Math.PI / 2, color: C.laneNormal, qColor: C.queueNormal, label: 'NORMAL' },
        { angle: Math.PI + Math.PI / 4, color: C.laneLow, qColor: C.queueLow, label: 'LOW' }
      ];
    }
    draw(ctx) {
      ctx.save();
      ctx.translate(this.cx, this.cy);
      for (let lane of this.lanes) {
        let startR = this.rr + 10;
        let endR = this.rr + 120;
        let sx = Math.cos(lane.angle) * startR;
        let sy = Math.sin(lane.angle) * startR;
        let ex = Math.cos(lane.angle) * endR;
        let ey = Math.sin(lane.angle) * endR;

        ctx.strokeStyle = lane.color;
        ctx.lineWidth = 12;
        ctx.lineCap = 'round';
        ctx.beginPath();
        ctx.moveTo(sx, sy);
        ctx.lineTo(ex, ey);
        ctx.stroke();

        ctx.strokeStyle = lane.qColor;
        ctx.lineWidth = 2;
        ctx.setLineDash([4, 4]);
        ctx.beginPath();
        ctx.moveTo(sx, sy);
        ctx.lineTo(ex, ey);
        ctx.stroke();
        ctx.setLineDash([]);

        drawPolyRound(ctx, ex - 22, ey - 14, 44, 28, 8, lane.qColor, C.outline);
        ctx.fillStyle = '#fff';
        ctx.font = 'bold 9px Inter, sans-serif';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillText(lane.label, ex, ey);
      }
      ctx.restore();
    }
  }

  class IncomingTickets {
    constructor(centerX, centerY, radarRadius) {
      this.cx = centerX; this.cy = centerY;
      this.rr = radarRadius;
      this.tickets = [];
      this.spawnTimer = 0;
    }
    spawn() {
      let angle = Math.random() * Math.PI * 2;
      let dist = this.rr + 140 + Math.random() * 60;
      let priority = Math.random();
      let pType = priority < 0.3 ? 'urgent' : priority < 0.7 ? 'normal' : 'low';
      let colors = { urgent: C.queueUrgent, normal: C.queueNormal, low: C.queueLow };
      this.tickets.push({
        x: Math.cos(angle) * dist,
        y: Math.sin(angle) * dist,
        targetAngle: pType === 'urgent' ? -Math.PI / 4 : pType === 'normal' ? Math.PI / 2 : Math.PI + Math.PI / 4,
        color: colors[pType],
        phase: 'incoming',
        progress: 0,
        startX: Math.cos(angle) * dist,
        startY: Math.sin(angle) * dist
      });
    }
    draw(ctx) {
      this.spawnTimer++;
      if (this.spawnTimer % 90 === 0 && this.tickets.length < 8) {
        this.spawn();
      }
      ctx.save();
      ctx.translate(this.cx, this.cy);
      for (let i = this.tickets.length - 1; i >= 0; i--) {
        let t = this.tickets[i];
        t.progress += 0.008;
        if (t.phase === 'incoming') {
          let p = Math.min(t.progress, 1);
          t.x = t.startX * (1 - p);
          t.y = t.startY * (1 - p);
          if (p >= 1) {
            t.phase = 'routing';
            t.progress = 0;
          }
        } else if (t.phase === 'routing') {
          let p = Math.min(t.progress * 1.5, 1);
          let endR = this.rr + 100;
          t.x = Math.cos(t.targetAngle) * endR * p;
          t.y = Math.sin(t.targetAngle) * endR * p;
          if (p >= 1) {
            this.tickets.splice(i, 1);
            continue;
          }
        }

        ctx.fillStyle = C.ticketBody;
        ctx.strokeStyle = t.color;
        ctx.lineWidth = 2;
        ctx.beginPath();
        if (ctx.roundRect) ctx.roundRect(t.x - 10, t.y - 7, 20, 14, 3);
        else ctx.rect(t.x - 10, t.y - 7, 20, 14);
        ctx.fill();
        ctx.stroke();

        ctx.fillStyle = t.color;
        ctx.beginPath();
        ctx.arc(t.x + 6, t.y - 3, 3, 0, Math.PI * 2);
        ctx.fill();
      }
      ctx.restore();
    }
  }

  class SLATimer {
    constructor(x, y) {
      this.x = x; this.y = y;
      this.size = 30;
    }
    draw(ctx) {
      let prg = (frame * 0.04) % 240;
      let ratio = (prg % 80) / 80;
      let color = ratio < 0.6 ? C.slaOk : ratio < 0.85 ? C.slaWarn : C.slaBreach;

      ctx.save();
      ctx.translate(this.x, this.y);

      ctx.strokeStyle = '#e2e8f0';
      ctx.lineWidth = 4;
      ctx.beginPath();
      ctx.arc(0, 0, this.size, 0, Math.PI * 2);
      ctx.stroke();

      ctx.strokeStyle = color;
      ctx.lineWidth = 4;
      ctx.lineCap = 'round';
      ctx.beginPath();
      ctx.arc(0, 0, this.size, -Math.PI / 2, -Math.PI / 2 + ratio * Math.PI * 2);
      ctx.stroke();

      ctx.fillStyle = C.outline;
      ctx.font = 'bold 10px Inter, sans-serif';
      ctx.textAlign = 'center';
      ctx.textBaseline = 'middle';
      ctx.fillText('SLA', 0, -3);
      let mins = Math.floor((1 - ratio) * 15);
      ctx.font = '9px Inter, sans-serif';
      ctx.fillStyle = color;
      ctx.fillText(mins + ' \u043C\u0438\u043D', 0, 10);

      ctx.restore();
    }
  }

  class ConfidenceMeter {
    constructor(x, y) {
      this.x = x; this.y = y;
    }
    draw(ctx) {
      let prg = (frame * 0.04) % 240;
      let conf = 0.7 + 0.25 * Math.sin(prg * 0.05);
      let w = 80, h = 8;

      ctx.save();
      ctx.translate(this.x, this.y);

      drawPolyRound(ctx, -w / 2, -h / 2, w, h, 4, '#e2e8f0', null);
      let fillW = w * conf;
      let fillColor = conf >= 0.8 ? C.slaOk : conf >= 0.6 ? C.slaWarn : C.slaBreach;
      drawPolyRound(ctx, -w / 2, -h / 2, fillW, h, 4, fillColor, null);

      ctx.fillStyle = C.outline;
      ctx.font = '9px Inter, sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText('conf: ' + (conf * 100).toFixed(0) + '%', 0, -12);

      ctx.restore();
    }
  }

  class Agent {
    constructor(x, y, color, role, stepTrig, dialogs) {
      this.x = x; this.y = y; this.baseX = x; this.baseY = y;
      this.color = color; this.role = role;
      this.timer = Math.random() * 100;
      this.stepTrig = stepTrig;
      this.dialogs = dialogs;
      this.hitAnimation = 0;
    }
    draw(ctx) {
      this.timer += 0.03;
      let isMoving = false;
      let carryType = null;
      let faceDir = 1;

      let prg = (frame * 0.04) % 240;
      let targetX = 0;
      let targetY = -20;

      if (prg >= this.stepTrig && prg < this.stepTrig + 30) {
        let localPrg = prg - this.stepTrig;
        if (localPrg < 12) {
          isMoving = true; faceDir = 1; carryType = this.color;
          this.x = this.baseX + (targetX - this.baseX) * (localPrg / 12);
          this.y = this.baseY + (targetY - this.baseY) * (localPrg / 12);
        } else if (localPrg < 18) {
          isMoving = false; faceDir = 1; this.x = targetX; this.y = targetY;
        } else {
          isMoving = true; faceDir = -1;
          this.x = targetX - (targetX - this.baseX) * ((localPrg - 18) / 12);
          this.y = targetY - (targetY - this.baseY) * ((localPrg - 18) / 12);
        }
      } else {
        this.x = this.baseX; this.y = this.baseY; isMoving = false;
        carryType = prg >= this.stepTrig - 8 ? this.color : null;
      }

      if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
        let rnd = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
        createBubble(this.x, this.y - 20, rnd, 260);
      }

      let bob = isMoving ? Math.abs(Math.sin(this.timer * 3)) * 2 : Math.sin(this.timer * 1.5) * 1;

      ctx.save();
      ctx.translate(this.x, this.y);
      ctx.lineJoin = 'round';

      let legL = 0, legR = 0;
      if (isMoving) {
        let walkPhase = this.timer * 6;
        legL = Math.sin(walkPhase) * 5; legR = Math.sin(walkPhase + Math.PI) * 5;
      }
      drawPolyRound(ctx, -10, -5 + Math.max(0, legL), 8, 14, 2, C.outline, null);
      drawPolyRound(ctx, -12, 5 + Math.max(0, legL), 12, 6, 2, C.outline, null);
      drawPolyRound(ctx, 2, -5 + Math.max(0, legR), 8, 14, 2, C.outline, null);
      drawPolyRound(ctx, 0, 5 + Math.max(0, legR), 12, 6, 2, C.outline, null);

      drawPolyRound(ctx, -15, -12 - bob, 30, 20, 6, this.color, C.outline);

      let hx = 0, hy = -28 - bob;
      ctx.fillStyle = this.color;
      ctx.beginPath(); ctx.arc(hx, hy, 12, 0, Math.PI * 2); ctx.fill();
      ctx.lineWidth = 2; ctx.strokeStyle = C.outline; ctx.stroke();

      ctx.save();
      ctx.scale(faceDir, 1);
      ctx.fillStyle = '#fff';
      ctx.beginPath(); ctx.arc(hx + 4, hy - 2, 4, 0, Math.PI * 2); ctx.fill();
      ctx.beginPath(); ctx.arc(hx - 4, hy - 2, 4, 0, Math.PI * 2); ctx.fill();
      ctx.fillStyle = C.outline;
      ctx.beginPath(); ctx.arc(hx + 5, hy - 2, 2, 0, Math.PI * 2); ctx.fill();
      ctx.beginPath(); ctx.arc(hx - 3, hy - 2, 2, 0, Math.PI * 2); ctx.fill();

      if (this.role === '1_architect') {
        ctx.strokeStyle = C.outline; ctx.lineWidth = 1;
        ctx.strokeRect(hx + 1, hy - 5, 6, 6); ctx.strokeRect(hx - 7, hy - 5, 6, 6);
      } else if (this.role === '2_seo') {
        drawPolyRound(ctx, hx - 12, hy - 14, 24, 8, [6, 6, 0, 0], C.outline, null);
        drawPolyRound(ctx, hx, hy - 8, 15, 3, 1, C.outline, null);
      } else if (this.role === '3_coder') {
        ctx.fillStyle = C.outline;
        ctx.beginPath(); ctx.moveTo(hx - 10, hy - 8); ctx.lineTo(hx - 14, hy - 18); ctx.lineTo(hx - 4, hy - 12);
        ctx.lineTo(hx, hy - 20); ctx.lineTo(hx + 4, hy - 12); ctx.lineTo(hx + 12, hy - 16); ctx.lineTo(hx + 10, hy - 8); ctx.fill();
      } else if (this.role === '4_designer') {
        drawPolyRound(ctx, hx - 14, hy - 12, 28, 6, 3, '#f43f5e', C.outline);
        drawPolyRound(ctx, hx - 2, hy - 15, 4, 4, 2, C.outline, null);
      } else if (this.role === '5_deployer') {
        ctx.strokeStyle = C.outline; ctx.lineWidth = 2;
        ctx.beginPath(); ctx.arc(hx, hy, 14, Math.PI, Math.PI * 2); ctx.stroke();
        drawPolyRound(ctx, hx - 16, hy - 2, 4, 8, 2, C.outline, null);
        drawPolyRound(ctx, hx + 12, hy - 2, 4, 8, 2, C.outline, null);
      }
      ctx.restore();

      if (carryType) {
        drawPolyRound(ctx, -20 * faceDir, -18 - bob, 16, 16, 2, carryType, C.outline);
      }
      ctx.restore();
    }
  }

  const entities = [];
  const bubbles = [];

  let radar = new TriageRadar(0, 0, 70);
  let lanes = new RoutingLanes(0, 0, 70);
  let tickets = new IncomingTickets(0, 0, 70);
  let slaTimer = new SLATimer(140, -110);
  let confMeter = new ConfidenceMeter(-130, -120);

  entities.push(lanes);
  entities.push(radar);
  entities.push(tickets);
  entities.push(slaTimer);
  entities.push(confMeter);

  entities.push(new Agent(-200, 100, C.agentYellow, '1_architect', 10, ["\u0422\u0430\u043A\u0441\u043E\u043D\u043E\u043C\u0438\u044F...", "8 \u043A\u0430\u0442\u0435\u0433\u043E\u0440\u0438\u0439", "\u041C\u0430\u0442\u0440\u0438\u0446\u0430 \u0433\u043E\u0442\u043E\u0432\u0430"]));
  entities.push(new Agent(-120, 150, C.agentGreen, '2_seo', 50, ["CT = 0.8", "\u041F\u043E\u0440\u043E\u0433 \u041E\u041A", "\u041A\u0430\u043B\u0438\u0431\u0440\u0443\u044E..."]));
  entities.push(new Agent(130, 140, C.agentBlue, '3_coder', 90, ["Webhook OK", "API \u043F\u043E\u0434\u043A\u043B\u044E\u0447\u0451\u043D", "\u041A\u043E\u043D\u043D\u0435\u043A\u0442\u043E\u0440!"]));
  entities.push(new Agent(200, 80, C.agentPink, '4_designer', 130, ["\u0414\u0430\u0448\u0431\u043E\u0440\u0434 UX", "\u0410\u043B\u0435\u0440\u0442 SLA!", "KPI-\u043A\u0430\u0440\u0442\u0430"]));
  entities.push(new Agent(160, -60, C.agentPurple, '5_deployer', 170, ["Auto-route!", "\u0417\u0430\u043F\u0443\u0441\u043A prod", "SLA-\u043F\u0443\u043B\u044C\u0441 \u2713"]));

  function createBubble(x, y, text, customLife) {
    customLife = customLife || 280;
    bubbles.push({ x: x, y: y, text: text, life: customLife, maxLife: customLife });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort((a, b) => (a.y || 0) - (b.y || 0));
    entities.forEach(ent => ent.draw(ctx));

    let prg = (frame * 0.04) % 240;
    if (prg >= 9 && prg < 9.04) createBubble(-200, 50, "1. \u0422\u0430\u043A\u0441\u043E\u043D\u043E\u043C\u0438\u044F");
    if (prg >= 49 && prg < 49.04) createBubble(-120, 100, "2. Threshold");
    if (prg >= 89 && prg < 89.04) createBubble(130, 90, "3. Webhook");
    if (prg >= 129 && prg < 129.04) createBubble(200, 30, "4. \u0414\u0430\u0448\u0431\u043E\u0440\u0434");
    if (prg >= 169 && prg < 169.04) createBubble(160, -110, "5. Auto-route!");

    ctx.font = 'bold 11px Inter, sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.lineJoin = 'round';

    for (let i = bubbles.length - 1; i >= 0; i--) {
      let bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      let alpha = Math.min(1, bub.life / 30);
      if (bub.life > bub.maxLife - 10) alpha = (bub.maxLife - bub.life) / 10;
      ctx.globalAlpha = alpha;
      let tw = ctx.measureText(bub.text).width + 16;
      let th = 20;
      let bx = bub.x;
      let by = bub.y - (bub.maxLife - bub.life) * 0.04;
      ctx.lineWidth = 2; ctx.strokeStyle = C.outline;
      drawPolyRound(ctx, bx - tw / 2, by - th, tw, th, 6, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleBg;
      ctx.beginPath(); ctx.moveTo(bx - 4, by); ctx.lineTo(bx + 4, by); ctx.lineTo(bx, by + 5); ctx.fill(); ctx.stroke();
      ctx.fillRect(bx - 3, by - 2, 6, 4);
      ctx.fillStyle = C.outline;
      ctx.fillText(bub.text, bx, by - th / 2);
      ctx.globalAlpha = 1.0;
    }

    ctx.restore();
    requestAnimationFrame(engineloop);
  }

  document.fonts ? document.fonts.ready.then(() => engineloop()) : engineloop();
});
</script>

<!-- ===== Boris Canvas Engine ===== -->
<script>
(function(){
  'use strict';
  var cv = document.getElementById('aitt-boris-triage-canvas');
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
    ink:'#1e293b',
    ticketBg:'#ffffff',
    ticketBdr:'#cbd5e1',
    ai:'#8b5cf6',
    aiGlow:'rgba(139,92,246,.22)',
    qBilling:'#22c55e',
    qBug:'#ef4444',
    qFeature:'#3b82f6',
    qSecurity:'#f59e0b',
    slaOk:'#22c55e',
    slaWarn:'#f59e0b',
    slaCrit:'#ef4444',
    line:'rgba(139,92,246,.3)',
    muted:'#64748b',
    text:'#1e293b',
    cardBg:'#f8fafc',
    cardBdr:'#e2e8f0'
  };

  var QUEUES = [
    {key:'billing', label:'Billing', color:C.qBilling},
    {key:'bug',     label:'Bug',     color:C.qBug},
    {key:'feature', label:'Feature', color:C.qFeature},
    {key:'security',label:'Security',color:C.qSecurity}
  ];

  var TICKET_SUBJECTS = [
    '\u041D\u0435 \u043C\u043E\u0433\u0443 \u043E\u043F\u043B\u0430\u0442\u0438\u0442\u044C \u043F\u043E\u0434\u043F\u0438\u0441\u043A\u0443',
    '\u041E\u0448\u0438\u0431\u043A\u0430 500 \u043F\u0440\u0438 \u044D\u043A\u0441\u043F\u043E\u0440\u0442\u0435',
    '\u0414\u043E\u0431\u0430\u0432\u044C\u0442\u0435 SSO \u0434\u043B\u044F \u043A\u043E\u043C\u0430\u043D\u0434\u044B',
    '\u041F\u043E\u0434\u043E\u0437\u0440\u0438\u0442\u0435\u043B\u044C\u043D\u044B\u0439 \u0432\u0445\u043E\u0434 \u0432 \u0430\u043A\u043A\u0430\u0443\u043D\u0442',
    '\u0414\u0443\u0431\u043B\u0438 \u0432 \u043E\u0442\u0447\u0451\u0442\u0435 \u043F\u043E SLA',
    'API \u0432\u043E\u0437\u0432\u0440\u0430\u0449\u0430\u0435\u0442 \u0442\u0430\u0439\u043C\u0430\u0443\u0442',
    '\u0425\u043E\u0442\u0438\u043C \u0438\u043D\u0442\u0435\u0433\u0440\u0430\u0446\u0438\u044E \u0441 JSM',
    '\u0421\u0431\u0440\u043E\u0441 \u043F\u0430\u0440\u043E\u043B\u044F \u043D\u0435 \u0440\u0430\u0431\u043E\u0442\u0430\u0435\u0442'
  ];

  function rr(ctx,x,y,w,h,r,fill,stroke){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=1.5; ctx.stroke(); }
  }

  function drawTicket(ctx, x, y, w, h, subject, phase){
    ctx.save();
    ctx.shadowColor = 'rgba(15,23,42,.08)';
    ctx.shadowBlur = 8;
    ctx.shadowOffsetY = 3;
    rr(ctx, x, y, w, h, 8, C.ticketBg, C.ticketBdr);
    ctx.shadowColor = 'transparent';

    ctx.fillStyle = C.muted;
    ctx.font = '600 10px system-ui, sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('\uD83C\uDFAB \u0422\u0438\u043A\u0435\u0442 #' + (4800 + Math.floor(frame / 200) % 50), x + 10, y + 16);

    ctx.fillStyle = C.text;
    ctx.font = '500 11px system-ui, sans-serif';
    var txt = subject.length > 22 ? subject.slice(0, 21) + '\u2026' : subject;
    ctx.fillText(txt, x + 10, y + 32);

    if(phase > 0){
      var pw = (w - 20) * Math.min(phase, 1);
      rr(ctx, x + 10, y + h - 8, w - 20, 4, 2, C.cardBdr, null);
      rr(ctx, x + 10, y + h - 8, pw, 4, 2, C.ai, null);
    }
    ctx.restore();
  }

  function drawAINode(ctx, cx, cy, r, pulse){
    ctx.save();
    var glow = 0.3 + 0.15 * Math.sin(pulse * 0.04);
    ctx.shadowColor = C.aiGlow;
    ctx.shadowBlur = 16 + 6 * Math.sin(pulse * 0.03);
    ctx.beginPath();
    ctx.arc(cx, cy, r, 0, Math.PI * 2);
    ctx.fillStyle = C.ai;
    ctx.globalAlpha = glow + 0.5;
    ctx.fill();
    ctx.globalAlpha = 1;

    ctx.fillStyle = '#fff';
    ctx.font = 'bold ' + Math.round(r * 0.7) + 'px system-ui, sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText('AI', cx, cy + 1);
    ctx.restore();
  }

  function drawQueue(ctx, x, y, w, h, queue, count){
    rr(ctx, x, y, w, h, 10, C.cardBg, queue.color);
    ctx.fillStyle = queue.color;
    ctx.font = 'bold 11px system-ui, sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(queue.label, x + w/2, y + 16);

    ctx.fillStyle = C.text;
    ctx.font = '600 18px system-ui, sans-serif';
    ctx.fillText(count, x + w/2, y + h/2 + 6);

    ctx.fillStyle = C.muted;
    ctx.font = '500 9px system-ui, sans-serif';
    ctx.fillText('\u0442\u0438\u043A\u0435\u0442\u043E\u0432', x + w/2, y + h - 10);
  }

  function drawSLATimer(ctx, x, y, pct, label){
    var r = 18;
    ctx.save();
    ctx.beginPath();
    ctx.arc(x, y, r, 0, Math.PI * 2);
    ctx.fillStyle = '#fff';
    ctx.fill();
    ctx.strokeStyle = C.cardBdr;
    ctx.lineWidth = 2;
    ctx.stroke();

    ctx.beginPath();
    ctx.arc(x, y, r - 3, -Math.PI/2, -Math.PI/2 + Math.PI * 2 * pct);
    ctx.strokeStyle = pct < 0.5 ? C.slaOk : (pct < 0.8 ? C.slaWarn : C.slaCrit);
    ctx.lineWidth = 3;
    ctx.lineCap = 'round';
    ctx.stroke();

    ctx.fillStyle = C.text;
    ctx.font = 'bold 9px system-ui, sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText(label, x, y);
    ctx.restore();
  }

  function drawArrow(ctx, x1, y1, x2, y2, color, progress){
    if(progress <= 0) return;
    var dx = x2 - x1, dy = y2 - y1;
    var ex = x1 + dx * Math.min(progress, 1);
    var ey = y1 + dy * Math.min(progress, 1);
    ctx.save();
    ctx.strokeStyle = color;
    ctx.lineWidth = 1.5;
    ctx.setLineDash([4, 3]);
    ctx.globalAlpha = 0.7;
    ctx.beginPath();
    ctx.moveTo(x1, y1);
    ctx.lineTo(ex, ey);
    ctx.stroke();
    ctx.setLineDash([]);

    if(progress >= 1){
      var angle = Math.atan2(dy, dx);
      ctx.beginPath();
      ctx.moveTo(ex, ey);
      ctx.lineTo(ex - 7 * Math.cos(angle - 0.4), ey - 7 * Math.sin(angle - 0.4));
      ctx.lineTo(ex - 7 * Math.cos(angle + 0.4), ey - 7 * Math.sin(angle + 0.4));
      ctx.closePath();
      ctx.fillStyle = color;
      ctx.globalAlpha = 0.9;
      ctx.fill();
    }
    ctx.restore();
  }

  var CYCLE_LEN = 300;

  function draw(){
    ctx.clearRect(0, 0, W, H);
    if(W < 100 || H < 100) return;

    var cycle = frame % CYCLE_LEN;
    var phase = cycle / CYCLE_LEN;
    var ticketIdx = Math.floor(frame / CYCLE_LEN) % TICKET_SUBJECTS.length;
    var queueIdx = Math.floor(frame / CYCLE_LEN) % QUEUES.length;

    var scale = Math.min(W / 560, H / 420);
    ctx.save();
    ctx.translate(W/2, H/2);
    ctx.scale(scale, scale);

    var ticketX = -240, ticketY = -20;
    var aiX = -40, aiY = 0;
    var qStartX = 80, qStartY = -110;

    var ticketAlpha = phase < 0.1 ? phase / 0.1 : 1;
    ctx.globalAlpha = ticketAlpha;
    var tW = 160, tH = 44;
    var tMoveProgress = Math.max(0, Math.min(1, (phase - 0.1) / 0.25));
    var tCurX = ticketX + (aiX - 70 - ticketX) * tMoveProgress;
    var tCurY = ticketY + (aiY - tH/2 - ticketY) * tMoveProgress;
    drawTicket(ctx, tCurX, tCurY, tW, tH, TICKET_SUBJECTS[ticketIdx], phase < 0.35 ? 0 : Math.min(1, (phase - 0.35) / 0.2));
    ctx.globalAlpha = 1;

    var arr1Progress = Math.max(0, Math.min(1, (phase - 0.3) / 0.12));
    drawArrow(ctx, tCurX + tW, tCurY + tH/2, aiX - 24, aiY, C.line, arr1Progress);

    if(phase > 0.35){
      drawAINode(ctx, aiX, aiY, 22, frame);

      if(phase > 0.55){
        var labelAlpha = Math.min(1, (phase - 0.55) / 0.08);
        ctx.globalAlpha = labelAlpha;
        ctx.font = '600 10px system-ui, sans-serif';
        ctx.textAlign = 'left';
        ctx.fillStyle = QUEUES[queueIdx].color;
        ctx.fillText('\u2192 ' + QUEUES[queueIdx].label, aiX + 28, aiY - 8);
        var conf = (0.78 + queueIdx * 0.05).toFixed(2);
        ctx.fillStyle = C.muted;
        ctx.fillText('conf: ' + conf, aiX + 28, aiY + 8);
        ctx.globalAlpha = 1;
      }
    }

    var qW = 72, qH = 60, qGap = 16;
    for(var i = 0; i < QUEUES.length; i++){
      var qx = qStartX;
      var qy = qStartY + i * (qH + qGap);
      var isTarget = (i === queueIdx);

      if(phase > 0.6 && isTarget){
        var arr2Progress = Math.min(1, (phase - 0.6) / 0.12);
        drawArrow(ctx, aiX + 24, aiY, qx, qy + qH/2, QUEUES[i].color, arr2Progress);
      }

      var baseCount = 3 + i * 2;
      var count = isTarget && phase > 0.72 ? baseCount + 1 : baseCount;
      ctx.globalAlpha = isTarget && phase > 0.72 ? 1 : 0.55;
      drawQueue(ctx, qx, qy, qW, qH, QUEUES[i], count);
      ctx.globalAlpha = 1;
    }

    if(phase > 0.75){
      var slaAlpha = Math.min(1, (phase - 0.75) / 0.1);
      ctx.globalAlpha = slaAlpha;
      var slaPct = 0.1 + (phase - 0.75) * 1.2;
      var slaLabel = Math.max(1, Math.round(15 - (phase - 0.75) * 20)) + '\u043C';
      drawSLATimer(ctx, qStartX + qW + 40, qStartY + queueIdx * (qH + qGap) + qH/2, Math.min(slaPct, 0.35), slaLabel);
      ctx.fillStyle = C.slaOk;
      ctx.font = '600 9px system-ui, sans-serif';
      ctx.textAlign = 'left';
      ctx.fillText('SLA OK', qStartX + qW + 62, qStartY + queueIdx * (qH + qGap) + qH/2 + 4);
      ctx.globalAlpha = 1;
    }

    if(phase > 0.85){
      var doneAlpha = Math.min(1, (phase - 0.85) / 0.08);
      ctx.globalAlpha = doneAlpha;
      rr(ctx, -100, 80, 200, 28, 14, 'rgba(34,197,94,.1)', C.slaOk);
      ctx.fillStyle = C.qBilling;
      ctx.font = '600 11px system-ui, sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText('\u2713 \u041D\u0430\u0437\u043D\u0430\u0447\u0435\u043D\u043E \u0437\u0430 28 \u0441\u0435\u043A', 0, 98);
      ctx.globalAlpha = 1;
    }

    ctx.restore();
    frame++;
    requestAnimationFrame(draw);
  }
  requestAnimationFrame(draw);
})();
</script>

<!-- ===== Reveal IntersectionObserver ===== -->
<script>
(function(){
  var els = document.querySelectorAll('.reveal');
  if (!els.length) return;
  var io = new IntersectionObserver(function(entries){
    entries.forEach(function(e){
      if (e.isIntersecting) {
        e.target.classList.add('visible');
        io.unobserve(e.target);
      }
    });
  }, { threshold: 0.12 });
  els.forEach(function(el){ io.observe(el); });
})();
</script>

<!-- SCHEMA-MARKUP:INSERT — JSON-LD вставит schema-markup → Юра -->

<?php get_footer(); ?>

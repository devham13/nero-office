<?php
/**
 * Template Name: Внедрение AI — обработка заявок с сайта
 * Description: Лонгрид Nero Network — AI-агент для первичной обработки заявок (slug: vnedrenie-ai-obrabotka-zayavok-s-sayta)
 */

$page_seo_title = 'Внедрение AI-агента: обработка заявок с сайта под ключ';
$page_seo_description = 'Внедряем AI-агента для первичной обработки заявок с сайта: ответ за 5–15 сек, квалификация лида и передача в CRM. Аудит потерь заявок за 30 минут.';

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

$brand = get_bloginfo('name') ?: 'AI-автоматизация';
$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Аудит потерь за 30 минут';
$primary_cta_url = getenv('PRIMARY_CTA_URL') ?: '#audit-30-min';
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Внедрение под ключ';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#vnedrenie-pod-kluch';

$nero_ai_header_links = [
    ['label' => 'Потери заявок', 'href' => '#pochemu-teryaet-zayavki'],
    ['label' => 'AI-агент', 'href' => '#chto-takoe-ai-agent'],
    ['label' => 'Сайт → CRM', 'href' => '#svyazka-sayt-ai-crm'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie-pod-kluch'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

get_header();

$theme_dir = get_stylesheet_directory();
require $theme_dir . '/nero-ai-floating-header.inc.php';

?>

<style>
<?php nero_ai_echo_theme_styles(); ?>
</style>

<main id="primary" class="site-main nero-ai-home-page" role="main" tabindex="-1">

  <section class="nero-ai-hero" id="lead-dispatch-hero" aria-labelledby="hero-zayavki-title">
    <div class="nero-ai-container nero-ai-hero-grid">
      <div class="nero-ai-hero-copy nero-ai-reveal">
        <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai обработка заявок</p>
        <h1 id="hero-zayavki-title">Внедрение AI-агента <span class="nero-ai-gradient-text">для обработки заявок с сайта</span></h1>
        <p class="nero-ai-hero-lead">Отвечаем на заявки за 5–15 секунд, квалифицируем клиента и передаём горячий лид в CRM — без потерь ночью и в выходные.</p>
        <ul class="nero-ai-badges" aria-label="Ключевые параметры">
          <li class="nero-ai-badge">Ответ 5–15 сек</li>
          <li class="nero-ai-badge">24/7 без выходных</li>
          <li class="nero-ai-badge">amoCRM · Битрикс24</li>
          <li class="nero-ai-badge">Квалификация лида</li>
        </ul>
        <div class="nero-ai-btn-row">
          <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url(getenv('PRIMARY_CTA_URL') ?: '#audit-30-min'); ?>"><?php echo esc_html(getenv('PRIMARY_CTA_LABEL') ?: 'Аудит потерь за 30 минут'); ?></a>
          <a class="nero-ai-btn nero-ai-btn-secondary" href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: '#vnedrenie-pod-kluch'); ?>"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'Внедрение под ключ'); ?></a>
        </div>
      </div>

      <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: обработка заявок и CRM">
        <div class="nero-ai-dashboard-shell">
          <div class="nero-ai-window-top">
            <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
            <span class="nero-ai-window-title">пульт заявок · демо SLA</span>
          </div>
          <div class="nero-ai-window-body">
            <div class="nero-ai-dashboard-title">
              <h3>AI-приём заявок с сайта</h3>
              <span class="nero-ai-live-pill">live</span>
            </div>
            <div class="nero-ai-metrics-grid">
              <div class="nero-ai-metric" data-nero-tooltip="Первичный ответ AI на заявку с формы или чата — целевой SLA 5–15 секунд.">
                <span>First response</span><strong>5–15 с</strong><small>SLA пилота</small>
              </div>
              <div class="nero-ai-metric" data-nero-tooltip="Агент работает ночью и в выходные — менеджер подключается на эскалации.">
                <span>Доступность</span><strong>24/7</strong><small>без выходных</small>
              </div>
              <div class="nero-ai-metric" data-nero-tooltip="Карточка лида, теги и поля создаются в amoCRM или Битрикс24 автоматически.">
                <span>Лиды в CRM</span><strong data-nero-count="12" data-nero-suffix="">0</strong><small>за сегодня (демо)</small>
              </div>
              <div class="nero-ai-metric" data-nero-tooltip="Горячий / тёплый / холодный — маршрутизация без ручного копирования.">
                <span>Scoring</span><strong>hot</strong><small>квалификация</small>
              </div>
            </div>
            <div class="nero-ai-task-stream" aria-label="Этапы внедрения">
              <div class="nero-ai-task"><span class="nero-ai-task-icon">1</span><div><strong>Аудит каналов заявок</strong><span>форма, чат, мессенджеры</span></div><span class="nero-ai-status">этап</span></div>
              <div class="nero-ai-task"><span class="nero-ai-task-icon">2</span><div><strong>AI-агент + база знаний</strong><span>RAG по FAQ и прайсу</span></div><span class="nero-ai-status">этап</span></div>
              <div class="nero-ai-task"><span class="nero-ai-task-icon">3</span><div><strong>Интеграция с CRM</strong><span>amoCRM / Битрикс24</span></div><span class="nero-ai-status">этап</span></div>
              <div class="nero-ai-task"><span class="nero-ai-task-icon">4</span><div><strong>Пилот SLA 5–15 сек</strong><span>метрики и эскалация</span></div><span class="nero-ai-status">запуск</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<section class="nero-ai-section nero-ai-section-tight nero-ai-prose" aria-label="Введение">
  <div class="nero-ai-container">
    <div class="nero-ai-intro-grid nero-ai-reveal">
      <div class="nero-ai-intro-text">
        <p><strong>Коротко:</strong> AI-агент для первичной обработки заявок — связка «канал входа → LLM-агент → CRM», которая за секунды подтверждает обращение, задаёт уточняющие вопросы, оценивает «горячесть» лида и передаёт карточку в amoCRM или Битрикс24. Менеджер подключается на эскалации и закрытии сделки.</p>
        <p>Малый и средний бизнес — услуги, онлайн-школы, клиники — получает заявки круглосуточно, а отдел продаж часто отвечает только в рабочие часы. Запросы «<strong>ai обработка заявок</strong>» и «<strong>внедрение ai в бизнес</strong>» в 2026 году смещаются от FAQ-ботов к <strong>агентным</strong> сценариям: система создаёт сделку, заполняет поля и маршрутизирует лид.</p>
      </div>
      <div class="nero-ai-intro-deco" aria-hidden="true">
        <div class="line">&gt; webhook: form_submit</div>
        <div class="line">&gt; SLA target: <span style="color:#79f2ff">5–15s</span></div>
        <div class="line">&gt; route: amoCRM | B24</div>
        <div class="line">&gt; score: hot | warm | cold</div>
        <div class="nero-ai-intro-chips">
          <span>24/7</span><span>RAG</span><span>Make</span><span>152-ФЗ</span>
        </div>
      </div>
    </div>
  </div>
</section>

<nav class="nero-ai-toc-nav" aria-label="Оглавление">
  <div class="nero-ai-container">
    <ul class="nero-ai-toc">
      <li><a href="#pochemu-teryaet-zayavki">Потеря заявок</a></li>
      <li><a href="#chto-takoe-ai-agent">Что такое AI-агент</a></li>
      <li><a href="#svyazka-sayt-ai-crm">Сайт → AI → CRM</a></li>
      <li><a href="#vnedrenie-pod-kluch">Внедрение</a></li>
      <li><a href="#sla-metriki">SLA и метрики</a></li>
      <li><a href="#stoimost">Стоимость</a></li>
      <li><a href="#riski-compliance">Риски</a></li>
      <li><a href="#keisy">Кейсы</a></li>
      <li><a href="#faq">FAQ</a></li>
      <li><a href="#audit-30-min">Аудит 30 мин</a></li>
    </ul>
  </div>
</nav>

<section id="pochemu-teryaet-zayavki" class="nero-ai-section nero-ai-section-alt nero-ai-prose nero-ai-reveal">
  <div class="nero-ai-container">
    <h2>Почему бизнес теряет заявки с сайта (ночь, выходные, медленный первый ответ)</h2>
    <p class="nero-ai-lead"><strong>Определение:</strong> «Потерянная заявка» — обращение без быстрого осмысленного ответа; клиент уходит к конкуренту или откладывает решение.</p>
    <p>Заявки приходят вечером и в выходные — менеджеры офлайн, лид «остывает». Коммерческий ответ услуги — <strong>ответ за 5–15 секунд</strong>, квалификация и передача горячего лида в CRM.</p>

    <h3 id="skolko-ostyvaet">Сколько лидов «остывает» без ответа за 5–15 минут</h3>
    <p>Исследование MIT / InsideSales (цит. <a href="https://textback.ru/kak_ne_teryat_goryachie_lidy/" rel="noopener noreferrer" target="_blank">textback.ru</a>): ответ <strong>за 5 минут</strong> vs <strong>за 30 минут</strong> — разница в квалификации <strong>в 21 раз</strong>.</p>
    <p>Обзоры 2025–2026: среднее время ответа на лиды у многих компаний — <strong>часы</strong>; малый % отвечает быстрее 5 минут (<a href="https://greetnow.com/blog/speed-to-lead-statistics" rel="noopener noreferrer" target="_blank">greetnow.com</a>, <a href="https://www.agoralia.app/nl/blog/speed-to-lead-2026" rel="noopener noreferrer" target="_blank">agoralia.app</a>).</p>
    <p>Jivo (цит. <a href="https://vc.ru/guryev_pro_ai/2327951-skorost-otveta-na-zaprosy-klientov-v-b2b-i-b2c" rel="noopener noreferrer" target="_blank">vc.ru</a>): ответ ~за <strong>10 секунд</strong> — ~<strong>70%</strong> вероятности продолжения диалога.</p>
    <div class="nero-ai-callout"><p><strong>Итог:</strong> медленный первый ответ — утечка выручки. <strong>Автоматизация через ai обработка заявок</strong> закрывает окно между формой и контактом.</p></div>

    <div class="nero-ai-table-wrap">
      <table class="nero-ai-table">
        <thead><tr><th>Роль</th><th>Скорость</th><th>Доступность</th><th>CRM</th><th>Переговоры</th></tr></thead>
        <tbody>
          <tr><td>Менеджер</td><td>Минуты–часы</td><td>Рабочие часы</td><td>Зависит от дисциплины</td><td>Да</td></tr>
          <tr><td>Кнопочный бот</td><td>Минуты</td><td>24/7</td><td>По сценарию</td><td>Нет</td></tr>
          <tr><td>AI-агент + CRM</td><td><strong>5–15 с</strong> first response</td><td>24/7</td><td>Автозаполнение, scoring</td><td>Эскалация</td></tr>
        </tbody>
      </table>
    </div>

    <h3 id="forma-i-messendzhery">Разница между формой на сайте и мессенджерами</h3>
    <div class="nero-ai-table-wrap">
      <table class="nero-ai-table">
        <thead><tr><th>Канал</th><th>Плюс</th><th>Риск без автоматизации</th></tr></thead>
        <tbody>
          <tr><td>Форма (WP, Tilda)</td><td>Высокий интент</td><td>Нет «живого» ответа — уход</td></tr>
          <tr><td>Виджет чата</td><td>Диалог в реальном времени</td><td>Ночью пусто или шаблон без CRM</td></tr>
          <tr><td>Telegram / MAX</td><td>Follow-up в РФ</td><td>Диалоги без CRM</td></tr>
          <tr><td>WhatsApp*</td><td>Популярен</td><td>152-ФЗ, юридические ограничения в РФ</td></tr>
        </tbody>
      </table>
    </div>
    <p><small>* Meta (WhatsApp) — экстремистская организация в РФ.</small></p>
    <p>Стек интеграторов РФ: форма/виджет, Telegram/MAX → Make/n8n → OpenAI / YandexGPT / GigaChat → RAG → CRM.</p>
  </div>
</section>

<div class="nero-ai-container"><aside class="nero-ai-card nero-ai-final-cta nero-ai-reveal" aria-labelledby="nero-cta-audit-mid">
  <h2 id="nero-cta-audit-mid">Проверить, сколько заявок вы теряете</h2>
  <p>Лид-магнит Nero Network: <strong>аудит потерь заявок за 30 минут</strong> — каналы, время первого ответа, ночные обращения и пустые поля в CRM до внедрения AI.</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url(getenv('PRIMARY_CTA_URL') ?: '#audit-30-min'); ?>"><?php echo esc_html(getenv('PRIMARY_CTA_LABEL') ?: 'Аудит за 30 минут'); ?></a>
  </div>
</aside></div>

<section id="chto-takoe-ai-agent" class="nero-ai-section nero-ai-prose nero-ai-reveal">
  <div class="nero-ai-container">
    <h2>Что такое AI-агент для первичной обработки заявок с сайта</h2>
    <p class="nero-ai-lead"><strong>Определение:</strong> связка «канал → LLM → CRM», которая подтверждает заявку, задаёт вопросы (бюджет, срок, потребность), извлекает поля, оценивает «горячесть» и создаёт сделку в amoCRM/Битрикс24.</p>
    <p>Тренд 2026 — <strong>агентные</strong> сценарии, как у <a href="https://openai.com/business/" rel="noopener noreferrer" target="_blank">OpenAI Business</a>.</p>

    <h3 id="otlichie-ot-bota">Отличие от простого чат-бота и от «только GPT в виджете»</h3>
    <div class="nero-ai-table-wrap">
      <table class="nero-ai-table">
        <thead><tr><th>Критерий</th><th>Кнопочный бот</th><th>GPT без CRM</th><th>AI-агент + CRM</th></tr></thead>
        <tbody>
          <tr><td>Диалог</td><td>Кнопки</td><td>Свободный текст</td><td>Текст + квалификация</td></tr>
          <tr><td>CRM</td><td>По сценарию</td><td>Часто нет</td><td>Автозаполнение, scoring</td></tr>
          <tr><td>База</td><td>Ветки</td><td>Промпт</td><td>RAG по FAQ/прайсу</td></tr>
          <tr><td>Скорость</td><td>Минуты</td><td>Секунды без процесса</td><td><strong>5–15 с</strong> + процесс</td></tr>
        </tbody>
      </table>
    </div>
    <p>SalesBot amoCRM, недвижимость (<a href="https://biznesenok.ru/nastrojka-salesbot-v-amocrm-kak-sozdat-chat-bota-dlja-avtomaticheskih-otvetov-i-kvalifikacii-lidov/" rel="noopener noreferrer" target="_blank">biznesenok.ru</a>): конверсия в показ <strong>в 2,3 раза</strong>; первый контакт <strong>22→4 мин</strong> — эталон кнопочного бота.</p>

    <h3 id="kvalifikaciya">Квалификация, сценарии вопросов, передача горячего лида</h3>
    <p>Типовые вопросы: услуга, срок, бюджет, город, контакт и согласие ПДн. Статусы <strong>горячий / тёплый / холодный</strong>; при низкой уверенности — эскалация с транскриптом.</p>
    <p>Обзор ТЕРМОС (<a href="https://www.sostav.ru/blogs/285440/77127" rel="noopener noreferrer" target="_blank">sostav.ru</a>): триггер → LLM → CRM → scoring; RAG и эскалация.</p>
  </div>
</section>

<section
  id="vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block" class="nero-ai-boris-block"
  class="nero-ai-section nero-ai-section-alt"
  aria-labelledby="boris-intake-kicker"
>
  <div class="nero-ai-container">
    <div class="nero-ai-card nero-ai-boris-card">
      <div class="nero-ai-boris-grid">
        <div class="boris-copy">
          <span class="boris-eyebrow">Схема в движении</span>
          <h3 class="boris-kicker" id="boris-intake-kicker">Ночная заявка не ждёт утра: сайт → AI → CRM</h3>
          <p class="boris-lead">
            Пока отдел продаж офлайн, AI-агент подтверждает обращение за <strong>5–15 секунд</strong>,
            задаёт вопросы квалификации и заполняет карточку в amoCRM или Битрикс24 — менеджер получает уже «горячий» лид с контекстом.
          </p>
          <ul class="boris-points">
            <li>Каналы: форма сайта, виджет, Telegram / MAX — единый webhook.</li>
            <li>Scoring: горячий / тёплый / холодный — без ручного копирования в CRM.</li>
            <li>Эскалация: низкая уверенность → человек с полным транскриптом.</li>
          </ul>
          <div class="boris-pills" aria-hidden="true">
            <span class="boris-pill">SLA <strong>5–15 с</strong></span>
            <span class="boris-pill">24/7 <strong>первичка</strong></span>
            <span class="boris-pill">CRM <strong>авто</strong></span>
          </div>
          <p class="boris-bridge">Дальше разберём, как собрать связку «сайт → AI → CRM» на Make и amoCRM / Битрикс24.</p>
        </div>
        <div class="boris-canvas-wrap" role="img" aria-label="Анимация: заявки с сайта проходят AI-квалификацию и попадают в колонки CRM">
          <canvas id="lead-intake-pipeline-canvas" width="640" height="420"></canvas>
          <p class="boris-canvas-caption">Демо-поток: не обещание ROI, а логика first response и маршрутизации лида</p>
        </div>
      </div>
    </div>
  </div>

<script id="lead-intake-pipeline-engine">
(function () {
  "use strict";
  var canvas = document.getElementById("lead-intake-pipeline-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var wrap = canvas.parentElement;
  var cw = 640, ch = 420, frame = 0;
  var reduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  function resize() {
    if (!wrap) return;
    var w = wrap.clientWidth || 640;
    var h = Math.max(360, Math.min(520, Math.round(w * 0.72)));
    canvas.width = w;
    canvas.height = h;
    cw = w;
    ch = h;
  }
  window.addEventListener("resize", resize);
  resize();

  var PAL = {
    ink: "#e6edf7",
    muted: "#9aa8bd",
    panel: "rgba(17, 24, 39, 0.92)",
    line: "rgba(255, 255, 255, 0.14)",
    ai: "#79f2ff",
    aiGlow: "rgba(121, 242, 255, 0.28)",
    hot: "#fb7185",
    warm: "#fbbf24",
    cold: "#64748b",
    ok: "#22c55e",
    night: "#312e81"
  };

  function rr(ctx, x, y, w, h, r, fill, stroke) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    if (fill) { ctx.fillStyle = fill; ctx.fill(); }
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = 1.5; ctx.stroke(); }
  }

  function drawClock() {
    var t = new Date();
    var h = t.getHours();
    var m = t.getMinutes();
    var label = (h < 10 ? "0" : "") + h + ":" + (m < 10 ? "0" : "") + m;
    var night = h < 8 || h >= 20;
    ctx.fillStyle = night ? PAL.night : PAL.muted;
    rr(ctx, 14, 12, 72, 26, 8, PAL.panel, PAL.line);
    ctx.fillStyle = night ? "#93c5fd" : PAL.ink;
    ctx.font = "600 12px Inter, system-ui, sans-serif";
    ctx.fillText(night ? "🌙 " + label : "☀ " + label, 24, 29);
  }

  var tickets = [];
  var pulses = [];
  var bubbles = [];

  function spawnTicket() {
    var channels = ["Форма", "Чат", "TG"];
    var ch = channels[Math.floor(Math.random() * channels.length)];
    var colors = { "Форма": "#dbeafe", "Чат": "#dcfce7", "TG": "#e0e7ff" };
    var idx = channels.indexOf(ch);
    tickets.push({
      x: -40,
      y: chY(idx),
      label: ch,
      color: colors[ch],
      phase: 0,
      score: Math.random() < 0.35 ? "hot" : Math.random() < 0.55 ? "warm" : "cold"
    });
  }

  function chY(i) {
    var base = ch * 0.38;
    return base + i * (ch * 0.14);
  }

  var lastSpawn = 0;

  function drawPipelineLabels() {
    ctx.font = "600 11px Inter, system-ui, sans-serif";
    ctx.fillStyle = PAL.muted;
    ctx.fillText("Вход", cw * 0.06, ch * 0.2);
    ctx.fillText("AI-квалификация", cw * 0.38, ch * 0.2);
    ctx.fillText("CRM", cw * 0.72, ch * 0.2);
    var lanes = [
      { t: "Горячий", c: PAL.hot, y: 0.32 },
      { t: "Тёплый", c: PAL.warm, y: 0.52 },
      { t: "Холодный", c: PAL.cold, y: 0.72 }
    ];
    lanes.forEach(function (lane) {
      rr(ctx, cw * 0.68, ch * lane.y, cw * 0.26, ch * 0.14, 10, "#fff", PAL.line);
      ctx.fillStyle = lane.c;
      ctx.beginPath();
      ctx.arc(cw * 0.7 + 8, ch * lane.y + 14, 4, 0, Math.PI * 2);
      ctx.fill();
      ctx.fillStyle = PAL.ink;
      ctx.fillText(lane.t, cw * 0.7 + 18, ch * lane.y + 18);
    });
  }

  function drawQualifier(cx, cy, active) {
    var r = Math.min(cw, ch) * 0.09;
    var pulse = 0.5 + 0.5 * Math.sin(frame * 0.06);
    if (active) {
      ctx.strokeStyle = PAL.aiGlow;
      ctx.lineWidth = 10 + pulse * 6;
      ctx.beginPath();
      ctx.arc(cx, cy, r + 12, 0, Math.PI * 2);
      ctx.stroke();
    }
    var grad = ctx.createRadialGradient(cx, cy, 2, cx, cy, r);
    grad.addColorStop(0, "#60a5fa");
    grad.addColorStop(1, PAL.ai);
    ctx.fillStyle = grad;
    ctx.beginPath();
    ctx.arc(cx, cy, r, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = PAL.ink;
    ctx.lineWidth = 2;
    ctx.stroke();
    ctx.fillStyle = "#fff";
    ctx.font = "700 11px Inter, system-ui, sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("AI", cx, cy + 4);
    ctx.textAlign = "left";
    if (active) {
      var sec = 5 + Math.floor((frame % 120) / 8);
      if (sec > 15) sec = 8;
      ctx.fillStyle = PAL.ink;
      ctx.font = "600 10px Inter, system-ui, sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(sec + " с", cx, cy + r + 16);
      ctx.textAlign = "left";
    }
  }

  function drawTicket(t) {
    var w = cw * 0.14;
    var h = ch * 0.08;
    rr(ctx, t.x, t.y, w, h, 8, t.color, PAL.ink);
    ctx.fillStyle = PAL.ink;
    ctx.font = "600 10px Inter, system-ui, sans-serif";
    ctx.fillText(t.label, t.x + 10, t.y + h * 0.62);
  }

  function routeColor(score) {
    if (score === "hot") return PAL.hot;
    if (score === "warm") return PAL.warm;
    return PAL.cold;
  }

  function targetY(score) {
    if (score === "hot") return ch * 0.36;
    if (score === "warm") return ch * 0.56;
    return ch * 0.76;
  }

  function tick() {
    if (!reduced) frame++;
    else frame += 0.25;

    ctx.clearRect(0, 0, cw, ch);
    drawClock();
    drawPipelineLabels();

    var qx = cw * 0.48;
    var qy = ch * 0.55;
    var anyActive = false;

    if (!reduced && frame - lastSpawn > 70 + Math.random() * 40) {
      spawnTicket();
      lastSpawn = frame;
    }

    for (var i = tickets.length - 1; i >= 0; i--) {
      var t = tickets[i];
      t.phase += reduced ? 0.008 : 0.018;
      if (t.phase < 0.45) {
        t.x += (qx - 80 - t.x) * 0.04;
        t.y += (qy - t.y) * 0.03;
        anyActive = true;
      } else if (t.phase < 0.55) {
        t.x = qx - cw * 0.07;
        t.y = qy - ch * 0.04;
        anyActive = true;
      } else {
        var tx = cw * 0.78;
        var ty = targetY(t.score);
        t.x += (tx - t.x) * 0.05;
        t.y += (ty - t.y) * 0.05;
        if (t.phase > 0.95 && Math.abs(t.x - tx) < 4) {
          pulses.push({ x: tx, y: ty, c: routeColor(t.score), life: 40 });
          if (t.score === "hot" && Math.random() < 0.4) {
            bubbles.push({ x: tx - 20, y: ty - 30, text: "→ менеджеру", life: 90 });
          }
          tickets.splice(i, 1);
        }
      }
      drawTicket(t);
    }

    drawQualifier(qx, qy, anyActive);

    for (var p = pulses.length - 1; p >= 0; p--) {
      var pu = pulses[p];
      pu.life--;
      ctx.strokeStyle = pu.c;
      ctx.globalAlpha = pu.life / 40;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(pu.x, pu.y, 18 + (40 - pu.life), 0, Math.PI * 2);
      ctx.stroke();
      ctx.globalAlpha = 1;
      if (pu.life <= 0) pulses.splice(p, 1);
    }

    for (var b = bubbles.length - 1; b >= 0; b--) {
      var bub = bubbles[b];
      bub.life--;
      bub.y -= 0.3;
      ctx.fillStyle = PAL.panel;
      rr(ctx, bub.x, bub.y, 88, 22, 6, PAL.panel, PAL.ok);
      ctx.fillStyle = PAL.ink;
      ctx.font = "600 9px Inter, system-ui, sans-serif";
      ctx.fillText(bub.text, bub.x + 8, bub.y + 14);
      if (bub.life <= 0) bubbles.splice(b, 1);
    }

    // connector lines
    ctx.strokeStyle = PAL.line;
    ctx.setLineDash([6, 6]);
    ctx.beginPath();
    ctx.moveTo(cw * 0.22, ch * 0.55);
    ctx.lineTo(cw * 0.38, ch * 0.55);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(cw * 0.58, ch * 0.55);
    ctx.lineTo(cw * 0.66, ch * 0.55);
    ctx.stroke();
    ctx.setLineDash([]);

    requestAnimationFrame(tick);
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", tick);
  } else {
    tick();
  }
})();
</script>
</section>

<section id="svyazka-sayt-ai-crm" class="nero-ai-section nero-ai-section-alt nero-ai-prose nero-ai-reveal">
  <div class="nero-ai-container">
    <h2>Как работает связка «сайт → AI → CRM»</h2>
    <p class="nero-ai-lead"><strong>Коротко:</strong> заявка → webhook → AI за секунды → квалификация → CRM → менеджер с контекстом.</p>
    <div class="nero-ai-grid-3">
      <article class="nero-ai-card nero-ai-bento-card"><h4>Вход</h4><p>WP, Tilda, Jivo → webhook (&lt;1 с)</p></article>
      <article class="nero-ai-card nero-ai-bento-card"><h4>AI</h4><p>Подтверждение за 5–15 с, 3–5 вопросов</p></article>
      <article class="nero-ai-card nero-ai-bento-card"><h4>CRM</h4><p>Лид, тег «AI-квалифицирован», поля</p></article>
    </div>

    <h3 id="kanaly">Форма, виджет, WhatsApp, Telegram</h3>
    <ol class="nero-ai-ol-steps">
      <li>Вход: WP, Tilda, Jivo/Carrot → webhook.</li>
      <li>Подтверждение за <strong>5–15 с</strong>.</li>
      <li>3–5 вопросов на естественном языке.</li>
      <li>CRM: лид, тег, поля, маршрутизация.</li>
      <li>Логи, LRT, % эскалаций.</li>
    </ol>
    <p>Оркестрация: <strong>Make</strong> или <strong>n8n</strong>. Сценарий <a href="https://vc.ru/ai/2846645-n8n-i-gigachat-avtomatizatsiya-prodazh-dlya-malogo-biznesa" rel="noopener noreferrer" target="_blank">vc.ru</a>: Telegram → GigaChat → amoCRM.</p>

    <h3 id="amocrm-bitrix">amoCRM и Битрикс24: поля, статусы, ответственный менеджер</h3>
    <p>B2B + Amo (<a href="https://www.sostav.ru/blogs/281569/88011" rel="noopener noreferrer" target="_blank">sostav.ru</a>): заполнение CRM <strong>40%→100%</strong>; <strong>~30%</strong> лидов зависли на «КП отправлено» &gt; недели.</p>
  </div>
</section>

<section id="vnedrenie-pod-kluch" class="nero-ai-section nero-ai-prose nero-ai-reveal">
  <div class="nero-ai-container">
    <h2>Внедрение под ключ: этапы, сроки, что входит</h2>
    <p><strong>Проектная модель Nero Network</strong> (не публичный кейс). Прямых РФ-кейсов «форма → 5–15 с → CRM под ключ» в открытом доступе <strong>мало</strong>.</p>

    <h3 id="audit-voronki">Аудит текущей воронки и точек потерь</h3>
    <p><strong>2–3 дня:</strong> каналы, CRM, LRT, 5–7 вопросов квалификации, «красные линии». CTA: <strong>аудит потерь за 30 минут</strong>.</p>

    <h3 id="obuchenie-rag">Обучение на FAQ, прайсе, регламентах</h3>
    <p>RAG + тест <strong>20–30</strong> диалогов. Без данных в базе — эскалация, не выдуманный ответ.</p>
    <p class="nero-ai-card" style="padding: 20px 22px; margin: 24px 0; line-height: 1.65;">
  Перед заказом внедрения полезно понять, какие процессы уже можно автоматизировать без «чёрного ящика»:
  <a class="nero-ai-btn nero-ai-btn-secondary" style="display: inline-flex; margin-top: 12px;" href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: '#vnedrenie-pod-kluch'); ?>"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'Что можно автоматизировать'); ?></a>
</p>

    <h3 id="pilot">Пилот и масштабирование</h3>
    <p><strong>1–2 недели</strong> на одном канале. AI: first response, scoring, CRM, RAG, follow-up. Человек: переговоры, скидки, юридические обещания, закрытие.</p>
    <ol class="nero-ai-ol-steps">
      <li>Форма/виджет → webhook.</li>
      <li>Авто-подтверждение за <strong>5–15 с</strong>.</li>
      <li>AI: 3–5 вопросов (услуга, срок, бюджет, город).</li>
      <li>Сущности → CRM + hot/warm/cold.</li>
      <li>Горячий: Telegram менеджеру + задача «перезвонить».</li>
      <li>Низкая уверенность → человек с транскриптом.</li>
    </ol>
  </div>
</section>

<section id="sla-metriki" class="nero-ai-section nero-ai-section-alt nero-ai-prose nero-ai-reveal">
  <div class="nero-ai-container">
    <h2>SLA 5–15 секунд и метрики эффективности</h2>
    <p><strong>SLA:</strong> первый ответ AI — <strong>5–15 с</strong>; менеджер на горячий лид — отдельный KPI (минуты).</p>
    <h3 id="metriki-crm">Время первого ответа, конверсия в CRM, % потерянных лидов</h3>
    <div class="nero-ai-table-wrap">
      <table class="nero-ai-table">
        <thead><tr><th>Метрика</th><th>Зачем</th></tr></thead>
        <tbody>
          <tr><td>LRT</td><td>До/после</td></tr>
          <tr><td>% ночных заявок</td><td>24/7</td></tr>
          <tr><td>% эскалаций</td><td>Качество</td></tr>
          <tr><td>Конверсия в «горячий»</td><td>Скрипт</td></tr>
          <tr><td>Заполненность CRM</td><td>Воронка</td></tr>
        </tbody>
      </table>
    </div>
    <h3 id="pervyj-mesyac">Что измерять в первый месяц</h3>
    <p>LRT по каналам; доля без эскалации; конверсия в звонок/встречу; QA ошибок; базовая линия «до пилота».</p>
  </div>
</section>

<section id="stoimost" class="nero-ai-section nero-ai-prose nero-ai-reveal">
  <div class="nero-ai-container">
    <h2>Стоимость и ориентиры чека (ai обработка заявок цена)</h2>
    <p>Тема Nero (Google Таблица): <strong>120–350 тыс. ₽</strong> старт + поддержка.</p>
    <h3 id="start-podderzhka">Старт 120–350 тыс. ₽ и поддержка</h3>
    <p>Аудит, пилот, RAG, CRM, ночной режим, дашборд месяца. Рынок (не Nero): SaaS <strong>15–40 тыс. ₽/мес</strong> (<a href="https://swiftagents.ru/blog/skolko-stoit-vnedrit-ii-v-malyy-biznes" rel="noopener noreferrer" target="_blank">swiftagents.ru</a>).</p>
    <h3 id="okupaemost">Когда окупается для услуг, школ, клиник</h3>
    <p>ЦА: МСБ, услуги, школы, клиники; много заявок вне 9–18.</p>
  </div>
</section>

<section id="riski-compliance" class="nero-ai-section nero-ai-section-alt nero-ai-prose nero-ai-reveal">
  <div class="nero-ai-container">
    <h2>Риски и комплаенс: 152-ФЗ, галлюцинации, эскалация на человека</h2>
    <h3 id="pd-hranenie">Хранение переписки и согласия</h3>
    <p>Локализация ПДн с <strong>01.07.2025</strong> (<a href="https://b1.ru/insights/law-messenger/localization-of-personal-data-of-russian-citizens-6-march-2025/" rel="noopener noreferrer" target="_blank">b1.ru</a>).</p>
    <h3 id="eskalaciya">Когда AI обязан передать диалог менеджеру</h3>
    <p>Низкая уверенность; негатив; скидки/договор; медицина/право вне регламента; просьба «человека».</p>
    <p>OpenAI inbound: точность <strong>~60%→&gt;98%</strong> с human-in-the-loop (<a href="https://openai.com/index/openai-inbound-sales-assistant/" rel="noopener noreferrer" target="_blank">openai.com</a>). Для МСБ — не обещать 98% без пилота.</p>
  </div>
</section>

<section id="keisy" class="nero-ai-section nero-ai-prose nero-ai-reveal">
  <div class="nero-ai-container">
    <h2>Кейсы и примеры внедрения (ai обработка заявок кейсы)</h2>
    <p>Именованных РФ-кейсов «только сайт → 5–15 с → CRM» <strong>мало</strong>. Цифры — только со ссылкой.</p>
    <h3 id="msb-vs-korp">МСБ и услуги vs корпоративный масштаб</h3>
    <div class="nero-ai-table-wrap">
      <table class="nero-ai-table">
        <thead><tr><th>Пример</th><th>Суть</th></tr></thead>
        <tbody>
          <tr><td>ТЕРМОС / Sostav</td><td>Make, scoring, RAG</td></tr>
          <tr><td>Botseller</td><td>9 сайтов, Amo — <a href="https://botseller.ai/blog/ii-bot-dlya-strojmaterialov-kejs" rel="noopener noreferrer" target="_blank">вендор</a></td></tr>
          <tr><td>SalesBot amo</td><td><strong>2,3×</strong> показ, <strong>22→4 мин</strong></td></tr>
          <tr><td>B2B + Amo</td><td>CRM <strong>40%→100%</strong></td></tr>
        </tbody>
      </table>
    </div>
    <h3 id="openai-trend">Агентные сценарии first response (тренд OpenAI Business)</h3>
    <p><a href="https://openai.com/index/openai-inbound-sales-assistant/" rel="noopener noreferrer" target="_blank">OpenAI Inbound Sales Assistant</a> — inbound-формы, RAG, handoff с контекстом.</p>
    <p><a href="https://www.intercom.com/blog/announcing-fin-for-sales/" rel="noopener noreferrer" target="_blank">Intercom Fin for Sales</a> — playbook, CRM; <strong>$9.99/Qualification</strong>.</p>
  </div>
</section>

<section id="faq" class="nero-ai-section nero-ai-section-alt nero-ai-prose nero-ai-reveal">
  <div class="nero-ai-container">
    <h2>FAQ по AI-обработке заявок для малого бизнеса</h2>
    <div class="nero-ai-faq">
      <details class="nero-ai-reveal"><summary>Чем ai агент для сайта отличается от чат-бота?</summary><p>Свободный текст, CRM, scoring vs кнопки.</p></details>
      <details class="nero-ai-reveal"><summary>Заменит отдел продаж?</summary><p>Нет; первичка у AI, закрытие у человека.</p></details>
      <details class="nero-ai-reveal"><summary>Срок внедрения?</summary><p>Аудит 2–3 дня, пилот 1–2 недели, месяц метрик.</p></details>
      <details class="nero-ai-reveal"><summary>Стоимость?</summary><p>Nero: <strong>120–350 тыс. ₽</strong> старт; рынок от <strong>15 000 ₽/мес</strong>.</p></details>
      <details class="nero-ai-reveal"><summary>Нужна amoCRM/Битрикс24?</summary><p>Да для «горячего» лида с полями.</p></details>
      <details class="nero-ai-reveal"><summary>Ошибки AI?</summary><p>RAG, эскалация, human-in-the-loop.</p></details>
      <details class="nero-ai-reveal"><summary>Мало заявок?</summary><p>Сначала аудит окупаемости.</p></details>
      <details class="nero-ai-reveal"><summary>152-ФЗ?</summary><p>Согласие, локализация, каналы.</p></details>
      <details class="nero-ai-reveal"><summary>Есть SalesBot?</summary><p>LLM даёт секунды и свободный текст.</p></details>
      <details class="nero-ai-reveal"><summary>Только OpenAI?</summary><p>Зависит от данных; возможны YandexGPT/GigaChat.</p></details>
      <details class="nero-ai-reveal"><summary>Как узнать потери?</summary><p><strong>Аудит за 30 минут</strong> (CTA темы).</p></details>
    </div>
  </div>
</section>

<div class="nero-ai-container"><aside class="nero-ai-card nero-ai-final-cta nero-ai-reveal" aria-labelledby="nero-cta-audit-final">
  <h2 id="nero-cta-audit-final">Аудит потерь заявок за 30 минут — бесплатно</h2>
  <p>Зафиксируем базовую линию: LRT, долю ночных заявок без ответа и качество карточек в CRM. После аудита — понятный план: пилот «сайт → AI (5–15 с) → amoCRM/Битрикс24» или доработка процесса без AI.</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url(getenv('PRIMARY_CTA_URL') ?: '#audit-30-min'); ?>"><?php echo esc_html(getenv('PRIMARY_CTA_LABEL') ?: 'Проверить потери заявок'); ?></a>
  </div>
</aside></div>

<section id="audit-30-min" class="nero-ai-section nero-ai-prose nero-ai-reveal">
  <div class="nero-ai-container">
    <h2>Проверить, сколько заявок вы теряете — аудит за 30 минут</h2>
    <p class="nero-ai-lead"><strong>Коротко:</strong> до <strong>ai обработка заявок под ключ</strong> — базовая линия: ночные заявки, LRT, пустые поля CRM.</p>
    <ol class="nero-ai-ol-steps">
      <li>Каналы (форма, чат, мессенджеры).</li>
      <li>10–20 заявок: время обращения vs ответа.</li>
      <li>Поля CRM до звонка.</li>
      <li>Ночные/выходные без ответа.</li>
      <li>Рекомендация: пилот или процесс без AI.</li>
    </ol>
    <p>Дальше: <strong>сайт → AI (5–15 с) → amoCRM/Битрикс24 → менеджер</strong>. Nero Network: ответ 24/7, квалификация, горячий лид в CRM.</p>
    <div class="nero-ai-callout"><p><strong>Итог:</strong> <strong>ai консультант на сайт</strong> с CRM — ответ на боль МСБ. Выигрывает связка скорости, RAG, комплаенса и метрик.</p></div>
  </div>
</section>



</main>

<script>
(function () {
  'use strict';

  var root = document.querySelector('.nero-ai-home-page');
  if (!root) return;

  var revealItems = root.querySelectorAll('.nero-ai-reveal');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('nero-ai-active');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });

    revealItems.forEach(function (item) { observer.observe(item); });
  } else {
    revealItems.forEach(function (item) { item.classList.add('nero-ai-active'); });
  }

  var tooltipItems = root.querySelectorAll('[data-nero-tooltip]');
  tooltipItems.forEach(function (item) {
    if (!item.hasAttribute('tabindex')) item.setAttribute('tabindex', '0');

    item.addEventListener('click', function (event) {
      var isActive = item.classList.contains('nero-ai-tooltip-active');
      tooltipItems.forEach(function (other) { other.classList.remove('nero-ai-tooltip-active'); });
      if (!isActive) item.classList.add('nero-ai-tooltip-active');
      event.stopPropagation();
    });
  });

  document.addEventListener('click', function () {
    tooltipItems.forEach(function (item) { item.classList.remove('nero-ai-tooltip-active'); });
  });

  var counters = root.querySelectorAll('[data-nero-count]');
  function animateCounter(el) {
    var target = parseFloat(el.getAttribute('data-nero-count') || '0');
    var suffix = el.getAttribute('data-nero-suffix') || '';
    var prefix = el.getAttribute('data-nero-prefix') || '';
    var duration = 850;
    var start = performance.now();

    function frame(now) {
      var progress = Math.min((now - start) / duration, 1);
      var eased = 1 - Math.pow(1 - progress, 3);
      var value = Math.round(target * eased);
      el.textContent = prefix + value + suffix;
      if (progress < 1) requestAnimationFrame(frame);
    }
    requestAnimationFrame(frame);
  }

  if ('IntersectionObserver' in window) {
    var counterObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting && !entry.target.dataset.neroDone) {
          entry.target.dataset.neroDone = '1';
          animateCounter(entry.target);
          counterObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.35 });
    counters.forEach(function (counter) { counterObserver.observe(counter); });
  } else {
    counters.forEach(animateCounter);
  }
})();

</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Article",
      "headline": "Внедрение AI-агента для обработки заявок с сайта под ключ",
      "description": "Внедряем AI-агента для первичной обработки заявок с сайта: ответ за 5–15 сек, квалификация лида и передача в CRM.",
      "author": {"@type": "Organization", "name": "Nero Network"},
      "inLanguage": "ru-RU"
    },
    {
      "@type": "FAQPage",
      "mainEntity": [
        {"@type": "Question", "name": "Чем ai агент для сайта отличается от чат-бота?", "acceptedAnswer": {"@type": "Answer", "text": "Свободный текст, CRM, scoring vs кнопки."}},
        {"@type": "Question", "name": "Заменит отдел продаж?", "acceptedAnswer": {"@type": "Answer", "text": "Нет; первичка у AI, закрытие у человека."}},
        {"@type": "Question", "name": "Срок внедрения?", "acceptedAnswer": {"@type": "Answer", "text": "Аудит 2–3 дня, пилот 1–2 недели, месяц метрик."}},
        {"@type": "Question", "name": "Стоимость?", "acceptedAnswer": {"@type": "Answer", "text": "Nero: 120–350 тыс. ₽ старт; рынок от 15 000 ₽/мес."}}
      ]
    },
    {
      "@type": "SoftwareApplication",
      "name": "AI-агент для обработки заявок с сайта",
      "applicationCategory": "BusinessApplication",
      "operatingSystem": "Web"
    }
  ]
}
</script>

<?php nero_ai_echo_theme_scripts(); ?>

<?php
get_footer();

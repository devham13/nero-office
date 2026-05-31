<?php
/**
 * Template Name: AI follow-up менеджер — повторные касания
 * Description: Лонгрид Nero Network — AI follow-up менеджер для повторных касаний и дожима в CRM (slug: ai-follow-up-menedzher-povtornye-kasaniya)
 */

$page_seo_title = 'AI follow-up менеджер: повторные касания и дожим в CRM';
$page_seo_description = 'Внедрение AI follow-up под ключ: персональные повторные касания, дожим зависших сделок, интеграция с CRM. Сценарии, кейсы, цена и первый шаг для B2B.';

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
$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Разобрать зависшие сделки';
$primary_cta_url = getenv('PRIMARY_CTA_URL') ?: '#razobrat-zavishshie-sdelki';
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Смотреть сценарии касаний';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#10-scenariev-follow-up';

$nero_ai_header_links = [
    ['label' => 'Follow-up', 'href' => '#chto-takoe-ai-follow-up-menedzher'],
    ['label' => 'CRM', 'href' => '#integraciya-ai-follow-up-s-crm'],
    ['label' => 'Стоимость', 'href' => '#stoimost-ai-follow-up'],
    ['label' => 'FAQ', 'href' => '#faq-ai-follow-up'],
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
  <section class="nero-ai-hero" id="follow-up-hero" aria-labelledby="nero-ai-hero-title">
    <div class="nero-ai-container nero-ai-hero-grid">
      <div class="nero-ai-hero-copy nero-ai-reveal">
        <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · AI follow-up и CRM</p>
        <h1 id="nero-ai-hero-title">AI follow-up менеджер для повторных касаний <span class="nero-ai-gradient-text">без потери сделок</span></h1>
        <p class="nero-ai-hero-lead">Внедряем AI-агента, который ведёт повторные касания после заявки, звонка или встречи: напоминает менеджеру, пишет клиенту в мессенджер и почту, фиксирует ответы и статусы в CRM — чтобы «хвост» сделки не зависел от памяти команды.</p>
        <ul class="nero-ai-badges" aria-label="Возможности follow-up">
          <li class="nero-ai-badge">Повторные касания</li>
          <li class="nero-ai-badge">Follow-up 24/7</li>
          <li class="nero-ai-badge">amoCRM / Bitrix24</li>
          <li class="nero-ai-badge">WhatsApp · Telegram</li>
          <li class="nero-ai-badge">Email-цепочки</li>
          <li class="nero-ai-badge">SLA и напоминания</li>
          <li class="nero-ai-badge">Ответы клиентов</li>
          <li class="nero-ai-badge">Воронка без провалов</li>
        </ul>
        <div class="nero-ai-btn-row">
          <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a>
          <a class="nero-ai-btn nero-ai-btn-secondary" href="<?php echo esc_url($secondary_cta_url); ?>"><?php echo esc_html($secondary_cta_label); ?></a>
        </div>
      </div>
      <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демонстрация AI follow-up центра">
        <div class="nero-ai-dashboard-shell">
          <div class="nero-ai-window-top">
            <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
            <span class="nero-ai-window-title">follow-up менеджер · демо-панель</span>
          </div>
          <div class="nero-ai-window-body">
            <div class="nero-ai-dashboard-title"><h3>AI follow-up центр онлайн</h3><span class="nero-ai-live-pill">live</span></div>
            <div class="nero-ai-metrics-grid">
              <div class="nero-ai-metric" data-nero-tooltip="AI ставит касания по правилам: день 1, 3, 7 после заявки или молчания клиента — без ручных списков."><span>Касания сегодня</span><strong data-nero-count="47" data-nero-suffix="">0</strong><small>запланировано</small></div>
              <div class="nero-ai-metric" data-nero-tooltip="Считает ответы в мессенджерах, почте и CRM; подсвечивает «тёплых», кому пора звонить."><span>Ответы клиентов</span><strong>31%</strong><small>доля ответов</small></div>
              <div class="nero-ai-metric" data-nero-tooltip="Показывает сделки, где SLA касания нарушен: менеджеру или AI уходит задача «дожать» сейчас."><span>Просроченные follow-up</span><strong>6</strong><small>требуют действия</small></div>
              <div class="nero-ai-metric" data-nero-tooltip="Синхронизация этапов, тегов и истории касаний — один поток вместо заметок в чатах."><span>Сделки в CRM</span><strong data-nero-count="128" data-nero-suffix="">0</strong><small>в активной воронке</small></div>
            </div>
            <div class="nero-ai-task-stream" aria-label="Поток follow-up задач">
              <div class="nero-ai-task"><span class="nero-ai-task-icon">↳</span><div><strong>День 3: мягкое напоминание</strong><span>WhatsApp, шаблон под нишу</span></div><span class="nero-ai-status">отправлено</span></div>
              <div class="nero-ai-task"><span class="nero-ai-task-icon">CRM</span><div><strong>Этап сделки обновлён</strong><span>«Ожидает ответа», задача менеджеру</span></div><span class="nero-ai-status">готово</span></div>
              <div class="nero-ai-task"><span class="nero-ai-task-icon">✉</span><div><strong>Клиент ответил в Telegram</strong><span>AI зафиксировал текст в карточке</span></div><span class="nero-ai-status">новое</span></div>
              <div class="nero-ai-task"><span class="nero-ai-task-icon">AI</span><div><strong>Рекомендация: звонок до 18:00</strong><span>приоритет по сумме и SLA</span></div><span class="nero-ai-status">в работе</span></div>
            </div>
            <div class="nero-ai-automation-map">
              <p class="nero-ai-map-title">Как AI держит повторные касания</p>
              <div class="nero-ai-map-row"><span class="nero-ai-map-chip">Менеджер</span><span class="nero-ai-map-chip">Оператор</span><span class="nero-ai-map-chip">Руководитель</span></div>
              <div class="nero-ai-map-core">AI · follow-up</div>
              <div class="nero-ai-map-row"><span class="nero-ai-map-chip">Касания</span><span class="nero-ai-map-chip">CRM</span><span class="nero-ai-map-chip">Ответы</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<section class="nero-ai-section nero-ai-section-tight" aria-label="Введение">
  <div class="nero-ai-container">
    <div class="nero-ai-intro-grid nero-ai-reveal">
      <div class="nero-ai-intro-text">
        <p class="nero-ai-eyebrow">Лонгрид · AI follow-up</p>
        <p><strong>Коротко:</strong> AI follow-up менеджер — это слой над CRM и каналами связи, который находит «зависшие» сделки, запускает персональные повторные касания и возвращает результат в воронку. Сделки чаще гибнут не из‑за жёсткого «нет», а из‑за забытого follow-up.</p>
<hr>
        <p>Ниже — триггеры «зависших» сделок, интеграция amoCRM и Битрикс24, чек-лист из 10 сценариев и FAQ по внедрению.</p>
      </div>
      <aside class="nero-ai-intro-deco nero-ai-card" aria-label="Схема follow-up">
        <div class="nero-ai-terminal-top"><span></span><span></span><span></span> follow-up@nero</div>
        <ul class="nero-ai-terminal-lines">
          <li><code>TRIGGER</code> молчание <strong>N дней</strong></li>
          <li><code>CADENCE</code> 1→3→7→14</li>
          <li><code>CHANNEL</code> TG · email · CRM</li>
          <li><code>LOG</code> ответы → <strong>amo / Б24</strong></li>
        </ul>
        <div class="nero-ai-intro-chips"><span>SLA</span><span>RAG</span><span>approve</span><span>152-ФЗ</span></div>
      </aside>
    </div>
    <nav class="nero-ai-toc-wrap nero-ai-reveal" aria-label="Оглавление">
      <div class="nero-ai-toc"><a href="#chto-takoe-ai-follow-up-menedzher">Что такое AI follow-up менеджер и чем он отличается от напоминаний в CRM</a><a href="#pochemu-liidy-ostyvayut-bez-sistemnyh-kasaniy">Почему сделки зависают: боль РОПа и потери без follow-up</a><a href="#kak-ai-otslezhivaet-zavishshie-sdelki">Как AI отслеживает зависшие сделки: триггеры и статусы воронки</a><a href="#ai-scenarii-kasaniy">AI сценарии касаний: email, мессенджеры, задачи менеджеру и звонок</a><a href="#ai-dozhim-zayavok-i-progrev">AI дожим заявок и прогрев лидов в длинном цикле B2B</a><a href="#integraciya-ai-follow-up-s-crm">Интеграция AI follow-up с CRM: amoCRM, Bitrix24, Make, n8n</a><a href="#vnedrenie-ai-follow-up-pod-klyuch">Внедрение AI follow-up под ключ: этапы от аудита до запуска</a><a href="#stoimost-ai-follow-up">Сколько стоит AI follow-up: цена, сроки и окупаемость</a><a href="#kejsy-ai-follow-up">Кейсы и пример внедрения AI follow-up для бизнеса</a><a href="#10-scenariev-follow-up">10 сценариев follow-up для вашей воронки (чек-лист)</a><a href="#faq-ai-follow-up">FAQ: как внедрить AI follow-up, безопасность и мифы</a></div>
    </nav>
  </div>
</section>
<section class="nero-ai-section nero-ai-reveal" id="chto-takoe-ai-follow-up-menedzher" aria-labelledby="chto-takoe-ai-follow-up-menedzher-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="chto-takoe-ai-follow-up-menedzher-title">Что такое AI follow-up менеджер и чем он отличается от напоминаний в CRM</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Определение.</strong> AI follow-up менеджер — система (агент + правила + интеграции), которая отслеживает сделки и диалоги без следующего шага, планирует контекстные касания, пишет в CRM открытия и ответы и эскалирует к человеку при готовности к встрече или сложном возражении.</p>
<p>Это не то же самое, что:</p>
<ul class="nero-ai-prose-list">
<li><strong>напоминание в CRM</strong> («позвонить через 3 дня») — задача не равна исполнению;</li>
<li><strong>email-цепочка</strong> — один шаблон для всех без контекста карточки;</li>
<li><strong>чат-бот на сайте</strong> — он не дожимает молчание после КП в amoCRM или Битрикс24.</li>
</ul>
<p><strong>Итог:</strong> follow-up как инфраструктура — аудит воронки, SLA касаний, триггеры, потом ИИ.</p>
<h3 id="rol-ai-v-povtornyh-kasaniyah-i-dozhime-zayavok">Роль AI в повторных касаниях и дожиме заявок</h3>
<p>ИИ берёт на себя рутину: классификация намерения, черновик письма или сообщения в мессенджере, выбор канала по правилам, резюме диалога и next step в CRM. По данным <a href="https://www.salesforce.com/en-us/wp-content/uploads/sites/4/documents/reports/sales/salesforce-state-of-sales-report-2026.pdf" target="_blank" rel="noopener noreferrer">Salesforce State of Sales, 7th ed., 2026</a>, <strong>94%</strong> руководителей продаж с агентами называют их критичными для бизнес-задач; <strong>9 из 10</strong> команд используют или планируют агентов в ближайшие два года.</p>
<p>Продавцы с AI-инструментами в среднем экономят <strong>~12 часов в неделю</strong>; ожидаемое сокращение времени на research — <strong>34%</strong>, на черновики писем — <strong>36%</strong> (<a href="https://salesprep.ai/blog/ai-agents-state-of-sales-2026" target="_blank" rel="noopener noreferrer">разбор отчёта</a>). Репы с AI <strong>в 3,7 раза</strong> чаще выполняют квоту (<a href="https://www.salesforce.com/ap/sales/state-of-sales/sales-statistics/" target="_blank" rel="noopener noreferrer">подборка Salesforce</a>).</p>
<h3 id="komu-podhodit-b2b-nedvizhimost-konsalting-s-dlinnym-ciklom">Кому подходит: B2B, недвижимость, консалтинг с длинным циклом</h3>
<p>Целевая аудитория — B2B с длинным циклом, недвижимость, консалтинг: много этапов, «подумаю», комитет закупки. Средний B2B-покупатель даёт <strong>27 взаимодействий</strong> с вендором (Forrester, <a href="https://www.swordandthescript.com/2022/05/b2b-sales-interactions/" target="_blank" rel="noopener noreferrer">сводка</a>). Без системного дожима часть касаний просто не доходит до нужного числа.</p>
<hr>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-section-alt nero-ai-reveal" id="pochemu-liidy-ostyvayut-bez-sistemnyh-kasaniy" aria-labelledby="pochemu-liidy-ostyvayut-bez-sistemnyh-kasaniy-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="pochemu-liidy-ostyvayut-bez-sistemnyh-kasaniy-title">Почему сделки зависают: боль РОПа и потери без follow-up</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Коротко:</strong> менеджеры перегружены «горящими» лидами; РОП не видит, кого забыли; в CRM висят задачи, но касания не уходят.</p>
<p>По <a href="https://www.cnews.ru/news/line/2026-03-06_ii_v_rossii_nachal_zabirat" target="_blank" rel="noopener noreferrer">материалу CNews от 06.03.2026</a> (цитата данных Salesforce): на «саму продажу» уходит <strong>28%</strong> рабочего времени менеджера; на живое общение с клиентами — <strong>2 ч 23 мин из 8-часового дня</strong>. Секретарская работа съедает follow-up — отсюда боль «зависшие сделки CRM».</p>
<div class="nero-ai-callout"><p><strong>&gt;70%</strong> российских компаний встроили gen AI хотя бы в один процесс (Яков и Партнёры / Яндекс, цит. в том же материале CNews).</p></div>
<h3 id="tipovye-prichiny-zabytyh-povtornyh-kasaniy">Типовые причины «забытых» повторных касаний</h3>
<ul class="nero-ai-prose-list">
<li>приоритет только на новых заявках;</li>
<li>нет регламента «сколько касаний до отказа»;</li>
<li>молчание после КП не считается триггером;</li>
<li>ночные и выходные заявки без SLA;</li>
<li>менеджер ушёл в отпуск — сделка без владельца касания.</li>
</ul>
<p>Маркетинговые тезисы вроде «80% сделок теряются из‑за follow-up» лучше подтверждать <strong>аудитом вашей CRM</strong>, а не выдавать за универсальный закон (<a href="https://s-rocket.com/ru/articles/avtomatizatsiya-follow-up-kak-ai-agenty" target="_blank" rel="noopener noreferrer">обзор agentic follow-up</a>, февраль 2026).</p>
<h3 id="metriki-sdelki-bez-kasaniya-vremya-do-sleduyuschego-shaga">Метрики: сделки без касания, время до следующего шага</h3>
<p>Что считать до внедрения:</p>
<div class="nero-ai-table-wrap"><table class="nero-ai-table"><thead><tr>
<th>Метрика</th>
<th>Зачем</th>
</tr></thead><tbody>
<tr><td>Доля сделок без задачи follow-up</td><td>Видимость «дыр»</td></tr>
<tr><td>Медиана задержки 2-го касания</td><td>Бенчмарк «как у вас»</td></tr>
<tr><td>Time-to-follow-up после события</td><td>SLA для ИИ и людей</td></tr>
<tr><td>% сделок с ≥N касаниями</td><td>Полнота цепочки</td></tr>
<tr><td>Конверсия «молчание → ответ → встреча»</td><td>Эффект дожима</td></tr>
</tbody></table></div>
<p>На <a href="https://textback.ru/textback-ai-agent/" target="_blank" rel="noopener noreferrer">лендинге TextBack AI Agent</a> как ориентир поставщика фигурируют медиана ответа <strong>45 мин</strong> vs норма <strong>&lt;5 мин</strong> и доля диалогов без follow-up — для своей воронки снимайте факты из CRM, не копируйте чужие цифры.</p>
<hr>
    </div>
  </div>
</section>

<section id="nero-ai-boris-block" class="nero-ai-boris-block nero-ai-section nero-ai-section-alt nero-ai-reveal" aria-labelledby="nero-ai-boris-title">
  <div class="nero-ai-container">
    <div class="nero-ai-boris-card nero-ai-reveal">
      <div class="nero-ai-boris-split">
        <div class="nero-ai-boris-copy">
          <p class="nero-ai-boris-eyebrow">Схема касаний · CRM</p>
          <h3 id="nero-ai-boris-title">Follow-up не «напоминание», а цепочка 1→2→3→N в CRM</h3>
          <p class="nero-ai-boris-lead">
            Пока менеджер занят сделкой, AI держит ритм: каждое касание — сценарий, канал, статус и следующий шаг в amoCRM или Битрикс24. Лид не «зависает» между звонками.
          </p>
          <ul class="nero-ai-boris-points">
            <li><strong>Касание 1</strong> — подтверждение интереса и уточнение (чат, мессенджер, email).</li>
            <li><strong>Касание 2</strong> — ценность: кейс, FAQ, слот созвона — по scoring из CRM.</li>
            <li><strong>Касание 3</strong> — дедлайн / оффер пилота; эскалация, если нет ответа.</li>
            <li><strong>Касания N</strong> — ветки «тихий» / «горячий» / «отказ» без ручного копирования полей.</li>
          </ul>
          <div class="nero-ai-boris-pills" role="list" aria-label="Параметры цепочки">
            <span class="nero-ai-boris-pill" role="listitem">Интервал по SLA</span>
            <span class="nero-ai-boris-pill" role="listitem">Канал из CRM</span>
            <span class="nero-ai-boris-pill" role="listitem">Human-in-the-loop</span>
          </div>
          <p class="nero-ai-boris-bridge">Дальше разберём, как собрать сценарии и не сломать 152-ФЗ при хранении переписки.</p>
        </div>

        <div class="nero-ai-boris-viz" aria-hidden="false">
          <p class="nero-ai-boris-viz-label">Демо-поток · не обещание ROI</p>
          <div class="nero-ai-boris-grid" role="img" aria-label="Схема касаний от первого сообщения до CRM и повторных шагов">
            <div class="nero-ai-boris-node nero-ai-boris-node--touch" data-step="1">
              <span class="nero-ai-boris-node-num">1</span>
              <span class="nero-ai-boris-node-title">Первый ответ</span>
              <span class="nero-ai-boris-node-meta">5–15 с · квалификация</span>
            </div>
            <div class="nero-ai-boris-node nero-ai-boris-node--touch" data-step="2">
              <span class="nero-ai-boris-node-num">2</span>
              <span class="nero-ai-boris-node-title">Ценность</span>
              <span class="nero-ai-boris-node-meta">FAQ · кейс · слот</span>
            </div>
            <div class="nero-ai-boris-node nero-ai-boris-node--touch" data-step="3">
              <span class="nero-ai-boris-node-num">3</span>
              <span class="nero-ai-boris-node-title">Дожим</span>
              <span class="nero-ai-boris-node-meta">дедлайн · пилот</span>
            </div>
            <div class="nero-ai-boris-node nero-ai-boris-node--crm">
              <span class="nero-ai-boris-node-num">CRM</span>
              <span class="nero-ai-boris-node-title">amo / Б24</span>
              <span class="nero-ai-boris-node-meta">статусы · задачи</span>
            </div>
            <div class="nero-ai-boris-node nero-ai-boris-node--touch nero-ai-boris-node--n" data-step="N">
              <span class="nero-ai-boris-node-num">N</span>
              <span class="nero-ai-boris-node-title">Ветки</span>
              <span class="nero-ai-boris-node-meta">hot · warm · stop</span>
            </div>
          </div>
          <div class="nero-ai-boris-canvas-wrap">
            <canvas id="follow-up-sequence-canvas" width="640" height="360" aria-label="Анимация прохождения импульса по цепочке касаний к CRM"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <style>
    #nero-ai-boris-block.nero-ai-boris-block {
      padding: clamp(32px, 5vw, 56px) 0;
    }

    #nero-ai-boris-block .nero-ai-boris-card {
      padding: clamp(24px, 4vw, 40px);
      border-radius: 24px;
      border: 1px solid rgba(255, 255, 255, 0.12);
      background: linear-gradient(145deg, rgba(255, 255, 255, 0.06) 0%, rgba(8, 11, 23, 0.92) 100%);
      box-shadow: 0 24px 64px rgba(0, 0, 0, 0.35);
    }

    #nero-ai-boris-block .nero-ai-boris-split {
      display: grid;
      gap: clamp(24px, 4vw, 40px);
      align-items: center;
    }

    @media (min-width: 1024px) {
      #nero-ai-boris-block .nero-ai-boris-split {
        grid-template-columns: minmax(0, 1.1fr) minmax(0, 0.9fr);
      }
    }

    #nero-ai-boris-block .nero-ai-boris-eyebrow {
      margin: 0 0 10px;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      color: #79f2ff;
    }

    #nero-ai-boris-block .nero-ai-boris-copy h3 {
      margin: 0 0 14px;
      font-size: clamp(22px, 2.4vw, 28px);
      line-height: 1.2;
      letter-spacing: -0.03em;
      color: #f8fafc;
    }

    #nero-ai-boris-block .nero-ai-boris-lead,
    #nero-ai-boris-block .nero-ai-boris-bridge {
      margin: 0 0 16px;
      color: rgba(248, 250, 252, 0.78);
      font-size: 15px;
      line-height: 1.55;
    }

    #nero-ai-boris-block .nero-ai-boris-bridge {
      margin-top: 18px;
      margin-bottom: 0;
      font-size: 14px;
      color: rgba(121, 242, 255, 0.85);
    }

    #nero-ai-boris-block .nero-ai-boris-points {
      margin: 0;
      padding: 0;
      list-style: none;
      display: grid;
      gap: 10px;
    }

    #nero-ai-boris-block .nero-ai-boris-points li {
      position: relative;
      padding-left: 18px;
      font-size: 14px;
      line-height: 1.45;
      color: rgba(248, 250, 252, 0.88);
    }

    #nero-ai-boris-block .nero-ai-boris-points li::before {
      content: "";
      position: absolute;
      left: 0;
      top: 0.55em;
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: #22c55e;
      box-shadow: 0 0 10px rgba(34, 197, 94, 0.6);
    }

    #nero-ai-boris-block .nero-ai-boris-pills {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-top: 16px;
    }

    #nero-ai-boris-block .nero-ai-boris-pill {
      padding: 6px 12px;
      border-radius: 999px;
      font-size: 12px;
      font-weight: 600;
      color: #e2e8f0;
      border: 1px solid rgba(255, 255, 255, 0.14);
      background: rgba(15, 23, 42, 0.55);
    }

    #nero-ai-boris-block .nero-ai-boris-viz-label {
      margin: 0 0 12px;
      font-size: 11px;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: rgba(248, 250, 252, 0.45);
    }

    #nero-ai-boris-block .nero-ai-boris-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 10px;
      margin-bottom: 14px;
    }

    #nero-ai-boris-block .nero-ai-boris-node {
      padding: 12px 10px;
      border-radius: 14px;
      border: 1px solid rgba(255, 255, 255, 0.1);
      background: rgba(15, 23, 42, 0.65);
      text-align: center;
      transition: border-color 0.25s ease, box-shadow 0.25s ease;
    }

    #nero-ai-boris-block .nero-ai-boris-node.is-active {
      border-color: rgba(121, 242, 255, 0.55);
      box-shadow: 0 0 0 1px rgba(121, 242, 255, 0.2), 0 8px 24px rgba(59, 130, 246, 0.15);
    }

    #nero-ai-boris-block .nero-ai-boris-node--crm {
      grid-column: 2;
      grid-row: 2;
      border-color: rgba(139, 92, 246, 0.45);
      background: rgba(49, 46, 129, 0.35);
    }

    #nero-ai-boris-block .nero-ai-boris-node--n {
      grid-column: 3;
      grid-row: 2;
    }

    #nero-ai-boris-block .nero-ai-boris-node-num {
      display: block;
      font-size: 18px;
      font-weight: 800;
      color: #79f2ff;
      line-height: 1.1;
    }

    #nero-ai-boris-block .nero-ai-boris-node--crm .nero-ai-boris-node-num {
      color: #c4b5fd;
    }

    #nero-ai-boris-block .nero-ai-boris-node-title {
      display: block;
      margin-top: 4px;
      font-size: 12px;
      font-weight: 700;
      color: #f8fafc;
    }

    #nero-ai-boris-block .nero-ai-boris-node-meta {
      display: block;
      margin-top: 2px;
      font-size: 10px;
      color: rgba(248, 250, 252, 0.55);
      line-height: 1.3;
    }

    #nero-ai-boris-block .nero-ai-boris-canvas-wrap {
      position: relative;
      min-height: 200px;
      border-radius: 16px;
      overflow: hidden;
      border: 1px solid rgba(255, 255, 255, 0.08);
      background: radial-gradient(circle at 30% 20%, rgba(121, 242, 255, 0.08), transparent 45%),
        rgba(5, 7, 17, 0.9);
    }

    #nero-ai-boris-block #follow-up-sequence-canvas {
      display: block;
      width: 100%;
      height: auto;
      min-height: 200px;
      max-height: 360px;
    }

    @media (max-width: 767px) {
      #nero-ai-boris-block .nero-ai-boris-grid {
        grid-template-columns: 1fr 1fr;
      }

      #nero-ai-boris-block .nero-ai-boris-node--crm {
        grid-column: 1 / -1;
        grid-row: auto;
      }

      #nero-ai-boris-block .nero-ai-boris-node--n {
        grid-column: 1 / -1;
      }
    }
  </style>

  <script>
    (function () {
      var block = document.getElementById("nero-ai-boris-block");
      var canvas = document.getElementById("follow-up-sequence-canvas");
      if (!block || !canvas) return;

      var ctx = canvas.getContext("2d");
      var nodes = block.querySelectorAll(".nero-ai-boris-node--touch, .nero-ai-boris-node--crm");
      var dpr = Math.min(window.devicePixelRatio || 1, 2);
      var frame = 0;
      var activeIndex = 0;
      var steps = ["1", "2", "3", "CRM", "N"];

      function resize() {
        var wrap = canvas.parentElement;
        var w = wrap ? wrap.clientWidth : 640;
        var h = Math.max(200, Math.min(360, Math.round(w * 0.52)));
        canvas.width = Math.floor(w * dpr);
        canvas.height = Math.floor(h * dpr);
        canvas.style.height = h + "px";
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
      }

      function setActiveStep(i) {
        activeIndex = i;
        nodes.forEach(function (el, idx) {
          el.classList.toggle("is-active", idx === i);
        });
      }

      function drawScene(w, h) {
        ctx.clearRect(0, 0, w, h);
        var pts = [
          { x: w * 0.12, y: h * 0.28, label: "1" },
          { x: w * 0.38, y: h * 0.22, label: "2" },
          { x: w * 0.64, y: h * 0.28, label: "3" },
          { x: w * 0.5, y: h * 0.58, label: "CRM", hub: true },
          { x: w * 0.86, y: h * 0.52, label: "N" }
        ];

        ctx.lineWidth = 2;
        ctx.strokeStyle = "rgba(121, 242, 255, 0.25)";
        for (var e = 0; e < pts.length - 1; e++) {
          if (e === 2) continue;
          ctx.beginPath();
          ctx.moveTo(pts[e].x, pts[e].y);
          ctx.lineTo(pts[e + 1].x, pts[e + 1].y);
          ctx.stroke();
        }
        [0, 1, 2, 4].forEach(function (idx) {
          ctx.beginPath();
          ctx.moveTo(pts[idx].x, pts[idx].y);
          ctx.lineTo(pts[3].x, pts[3].y);
          ctx.stroke();
        });

        var pulseT = (frame % 180) / 180;
        var pathIdx = Math.floor((frame % 900) / 180) % 4;
        var pathPairs = [[0, 3], [1, 3], [2, 3], [3, 4]];
        var pair = pathPairs[pathIdx];
        var a = pts[pair[0]];
        var b = pts[pair[1]];
        var px = a.x + (b.x - a.x) * pulseT;
        var py = a.y + (b.y - a.y) * pulseT;

        ctx.fillStyle = "#79f2ff";
        ctx.beginPath();
        ctx.arc(px, py, 6, 0, Math.PI * 2);
        ctx.fill();

        pts.forEach(function (p, i) {
          var r = p.hub ? 22 : 16;
          ctx.fillStyle = p.hub ? "rgba(139, 92, 246, 0.35)" : "rgba(15, 23, 42, 0.9)";
          ctx.strokeStyle = i === activeIndex ? "#79f2ff" : "rgba(255,255,255,0.2)";
          ctx.lineWidth = i === activeIndex ? 2.5 : 1.5;
          ctx.beginPath();
          ctx.arc(p.x, p.y, r, 0, Math.PI * 2);
          ctx.fill();
          ctx.stroke();
          ctx.fillStyle = "#f8fafc";
          ctx.font = "bold 11px system-ui, sans-serif";
          ctx.textAlign = "center";
          ctx.textBaseline = "middle";
          ctx.fillText(p.label, p.x, p.y);
        });
      }

      function loop() {
        frame++;
        if (frame % 45 === 0) {
          setActiveStep(Math.floor((frame / 45) % nodes.length));
        }
        var w = canvas.width / dpr;
        var h = canvas.height / dpr;
        drawScene(w, h);
        requestAnimationFrame(loop);
      }

      resize();
      window.addEventListener("resize", resize);
      setActiveStep(0);
      requestAnimationFrame(loop);
    })();
  </script>
</section>

<section class="nero-ai-section nero-ai-reveal" id="kak-ai-otslezhivaet-zavishshie-sdelki" aria-labelledby="kak-ai-otslezhivaet-zavishshie-sdelki-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="kak-ai-otslezhivaet-zavishshie-sdelki-title">Как AI отслеживает зависшие сделки: триггеры и статусы воронки</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Определение «зависшей» сделки:</strong> нет активности N дней, просроченная задача, этап «думает», открытие КП без ответа, срыв встречи.</p>
<h3 id="net-aktivnosti-n-dney-etap-otkaz-ot-kp">Нет активности N дней, этап, отказ от КП</h3>
<p>Типовые триггеры:</p>
<ol class="nero-ai-prose-list">
<li>молчание в мессенджере/email после исходящего;</li>
<li>стадия воронки без движения &gt; N дней;</li>
<li>клиент написал «подумаю» — запуск cadence 1–3–7–14;</li>
<li>отказ от КП формальный — мягкая реактивация с новым углом.</li>
</ol>
<p>Продукт <a href="https://textback.ru/textback-ai-agent/" target="_blank" rel="noopener noreferrer">TextBack</a> сканирует диалоги без follow-up и строит цепочки <strong>день 1 / 3 / 7</strong> в WhatsApp, Telegram, MAX, VK с каскадом каналов.</p>
<h3 id="pravila-zapuska-personalnyh-kasaniy">Правила запуска персональных касаний</h3>
<ul class="nero-ai-prose-list">
<li>последний активный канал → затем каскад;</li>
<li>лимиты частоты и стоп-листы;</li>
<li>сегменты: новый лид / после квалификации / реактивация базы;</li>
<li>эскалация: позитив, негатив, юридический риск → задача человеку (<a href="https://www.simular.ai/alternatives/crm-automation-tools" target="_blank" rel="noopener noreferrer">модель Simular</a>: черновик → approve → отправка → лог в CRM).</li>
</ul>
<hr>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-section-alt nero-ai-reveal" id="shema-povtornyh-kasaniy-v-crm" aria-labelledby="ai-scenarii-kasaniy-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="ai-scenarii-kasaniy-title">AI сценарии касаний: email, мессенджеры, задачи менеджеру и звонок</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Коротко:</strong> один канал редко закрывает B2B; нужны email, мессенджеры, задача на звонок, при необходимости голос.</p>
<h3 id="ai-napominaniya-klientam-i-avtopisma">AI напоминания клиентам и автописьма</h3>
<p><a href="https://cmdf5.ru/ai-manager" target="_blank" rel="noopener noreferrer">ChatAI / CMD F5</a> для amoCRM: квалификация, автозаполнение полей, инициация диалогов, <strong>дожим молчаливых лидов</strong>, webhooks, в т.ч. YandexGPT.</p>
<p><a href="https://www.bitrix24.ru/journal/avtomatizaciya-s-ii-v-biznese/" target="_blank" rel="noopener noreferrer">Битрикс24</a>: Follow-Up / CoPilot — расшифровка встреч, сводка, рекомендации; ИИ заполняет CRM после звонка. Для мессенджерного дожима часто достраивают агентный слой поверх встроенного CoPilot.</p>
<p><a href="https://ai-mop.ru/" target="_blank" rel="noopener noreferrer">AI МОП</a>: голос и текст в CRM, реактивация базы, интеграция amoCRM, Битрикс24, Salesforce (по заявлению вендора — 1–3 дня).</p>
<h3 id="ton-i-personalizaciya-bez-robotnogo-spama">Тон и персонализация без «роботного» спама</h3>
<ul class="nero-ai-prose-list">
<li>RAG: продукт, цены, <strong>5–10 эталонных переписок</strong> лучших менеджеров;</li>
<li>guardrails: запретные формулировки, лимит касаний;</li>
<li>human-in-the-loop на старте: approve в Telegram РОПу (<a href="https://ajjo.ru/" target="_blank" rel="noopener noreferrer">AJJO</a> — контроль тишины и забытых обещаний в интерфейсе CRM).</li>
</ul>
<hr>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="ai-dozhim-zayavok-i-progrev" aria-labelledby="ai-dozhim-zayavok-i-progrev-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="ai-dozhim-zayavok-i-progrev-title">AI дожим заявок и прогрев лидов в длинном цикле B2B</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Итог:</strong> после первичной обработки и квалификации follow-up удерживает темп; без него воронка «дырявая» посередине.</p>
<h3 id="cepochki-kasaniy-posle-zayavki-i-kvalifikacii">Цепочки касаний после заявки и квалификации</h3>
<p>Сценарии: напоминание о встрече → follow-up после демо → дожим после КП → реактивация «спящей» базы. <a href="https://leadgenbot.ru/blog/tpost/0tsyny7h81-skolko-kasanii-nuzhno-do-prodazhi-kak-op" target="_blank" rel="noopener noreferrer">leadgenbot: касания до продажи</a> — системный follow-up важнее разового «дожать».</p>
<p>По <a href="https://instantly.ai/blog/how-many-touchpoints-before-a-sale/" target="_blank" rel="noopener noreferrer">сводке touchpoints</a> в B2B SaaS при широком определении встречаются <strong>сотни</strong> touchpoints; для холодного аутрича часто указывают <strong>20–50</strong> касаний — зависит от ACV. <strong>Не обещайте «7 касаний до сделки»</strong> — считайте медиану по 50–100 закрытым сделкам в своей CRM.</p>
<h3 id="svyazka-s-pervichnoy-obrabotkoy-i-kvalifikaciey-lidov">Связка с первичной обработкой и квалификацией лидов</h3>
<p>Логичное продолжение воронки Nero Network: заявка с сайта → квалификация → <strong>AI follow-up</strong> на зависших. Один стек CRM + Make/n8n + LLM снижает разрывы между этапами.</p>
<hr>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-section-alt nero-ai-reveal" id="integraciya-ai-follow-up-s-crm" aria-labelledby="integraciya-ai-follow-up-s-crm-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="integraciya-ai-follow-up-s-crm-title">Интеграция AI follow-up с CRM: amoCRM, Bitrix24, Make, n8n</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Архитектура (типовая):</strong> CRM webhook → оркестратор (n8n / Make) → LLM (YandexGPT / GigaChat при ПДн) → черновик → (опционально) approve → канал → лог в CRM. Обзор: <a href="https://gptmag.ru/integratsiya-ai-s-1c-amocrm/" target="_blank" rel="noopener noreferrer">gptmag: n8n + CRM</a>, <a href="https://metasapiens.ru/blog/ai-agenty-v-crm-kak-cifrovoj-sotrudnik-zakryvaet-sdelki" target="_blank" rel="noopener noreferrer">metasapiens: AI в CRM</a>.</p>
<h3 id="ai-follow-up-s-crm-dannye-polya-webhooks">ai follow up с crm: данные, поля, webhooks</h3>
<p>Нужны: стадии, ответственный, история переписки, теги, UTM, дедлайн клиента, последний канал. <a href="https://cmdf5.ru/ai-manager" target="_blank" rel="noopener noreferrer">ChatAI</a> опирается на события CRM + базу знаний → ветки сценария → задача менеджеру на тёплого.</p>
<h3 id="ogranicheniya-i-tipovye-oshibki-integracii">Ограничения и типовые ошибки интеграции</h3>
<ul class="nero-ai-prose-list">
<li>грязная CRM → <strong>50–70%</strong> годового оттока на AI SDR-инструментах при плохой гигиене (<a href="https://r-sun.ai/insights/ai-driven-b2b-sales-2026" target="_blank" rel="noopener noreferrer">обзор 2026</a>);</li>
<li>ПДн (152-ФЗ): российские LLM, self-hosted n8n, маскирование;</li>
<li>галлюцинации в ценах и сроках — жёсткий RAG и запрет автосогласования скидок;</li>
<li>дубли каналов: клиент получает и WhatsApp, и email без правил каскада.</li>
</ul>
<hr>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="vnedrenie-ai-follow-up-pod-klyuch" aria-labelledby="vnedrenie-ai-follow-up-pod-klyuch-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="vnedrenie-ai-follow-up-pod-klyuch-title">Внедрение AI follow-up под ключ: этапы от аудита до запуска</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Проектная модель Nero Network</strong> (не публичный кейс, а типовой план):</p>
<ol class="nero-ai-prose-list">
<li>Аудит: доля сделок без follow-up, медиана 2-го касания, отвал по каналам.</li>
<li>Триггеры и регламент «молчания».</li>
<li>RAG и tone-of-voice.</li>
<li>Оркестрация n8n/Make + approve.</li>
<li>Эскалации и стоп-листы.</li>
<li>Дашборд метрик.</li>
</ol>
<h3 id="nastroyka-i-razrabotka-scenariev">Настройка и разработка сценариев</h3>
<p>Cadence <strong>1–3–7–14</strong> или кастом по нише; A/B текстов; детектор «замолчавших» и SLA. Рынок смещается к <strong>agentic</strong> follow-up (контекст + триггеры), а не к «пяти одинаковым письмам» (<a href="https://s-rocket.com/ru/articles/avtomatizatsiya-follow-up-kak-ai-agenty" target="_blank" rel="noopener noreferrer">s-rocket</a>).</p>
<p class="nero-ai-inline-cta nero-ai-reveal" style="margin: 2rem 0; padding: 18px 20px; border-left: 3px solid var(--nero-ai-primary, #79f2ff); background: rgba(255,255,255,0.04); border-radius: 12px;"><strong>Обучение команды:</strong> регламенты approve, разбор цепочек и контроль качества касаний — <a href="<?php echo esc_url($secondary_cta_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
<h3 id="obuchenie-otdela-prodazh-i-kontrol-kachestva">Обучение отдела продаж и контроль качества</h3>
<ul class="nero-ai-prose-list">
<li>кто утверждает чувствительные сообщения;</li>
<li>когда ИИ <strong>не должен</strong> писать (крупные сделки, конфликт, юридические темы);</li>
<li>еженедельный разбор: time-to-follow-up, % молчунов с 2+ касаниями.</li>
</ul>
<hr>
    </div>
  </div>
</section>


<section class="nero-ai-section nero-ai-section-alt nero-ai-reveal" id="stoimost-ai-follow-up" aria-labelledby="stoimost-ai-follow-up-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="stoimost-ai-follow-up-title">Сколько стоит AI follow-up: цена, сроки и окупаемость</h2>
    </header>
    <div class="nero-ai-prose">
<h3 id="orientir-cheka-120-300-tys-i-sostav-rabot">Ориентир чека 120–300 тыс. ₽ и состав работ</h3>
<p>По ТЗ из Google Таблицы (тема Кирилла): ориентир <strong>120–300 тыс. ₽</strong>, сложность <strong>6/10</strong>, приоритет <strong>9/10</strong>. В чек входят: аудит, сценарии, интеграции CRM и мессенджеров, RAG, обучение, пилот 2–8 недель (зависит от стека).</p>
<p>Сравнение с наймом: <strong>0,3–0,5 FTE</strong> менеджера на постоянном дожиме vs проектное внедрение.</p>
<h3 id="roi-konversiya-posle-follow-up-i-vozvrat-zavisshih">ROI: конверсия после follow-up и возврат «зависших»</h3>
<p>Международный ориентир: Salesforce за 4 месяца связались с <strong>130 000</strong> «неприкосновёнными» лидами агентами и создали <strong>3 200</strong> opportunities (<a href="https://www.salesforce.com/en-us/wp-content/uploads/sites/4/documents/reports/sales/salesforce-state-of-sales-report-2026.pdf" target="_blank" rel="noopener noreferrer">отчёт 2026</a>) — метрика «лиды, которые раньше падали на пол».</p>
<p>Гибрид <strong>1 human + 2 AI</strong> (hybrid pod) в B2B-обзорах 2026 даёт больше qualified opportunities и ниже cost per qualified opportunity vs чистый AI (<a href="https://www.digitalapplied.com/blog/ai-sdr-statistics-2026-outbound-sales-data-points" target="_blank" rel="noopener noreferrer">Digital Applied</a>) — оффер «AI follow-up + живой closer», не замена отдела.</p>
<hr>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" aria-label="Призыв к действию">
  <div class="nero-ai-container">
    <aside class="nero-ai-card nero-ai-final-cta nero-ai-reveal" aria-labelledby="afm-cta-mid-title">
      <p class="nero-ai-eyebrow">AI follow-up под ключ</p>
      <h2 id="afm-cta-mid-title">Разберём зависшие сделки в вашей CRM</h2>
      <p>15–30 минут: доля сделок без касания, медиана 2-го касания и три сценария дожима под вашу воронку — без обязательств на внедрение.</p>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </aside>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="kejsy-ai-follow-up" aria-labelledby="kejsy-ai-follow-up-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="kejsy-ai-follow-up-title">Кейсы и пример внедрения AI follow-up для бизнеса</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Честно:</strong> в РФ мало именованных корпоративных кейсов «+X% выручки» в открытом доступе; ниже — продукты и позиционирование, не выдаём витрину вендора за ваш проект.</p>
<div class="nero-ai-table-wrap"><table class="nero-ai-table"><thead><tr>
<th>Источник</th>
<th>Что показывает</th>
</tr></thead><tbody>
<tr><td><a href="https://textback.ru/textback-ai-agent/" target="_blank" rel="noopener noreferrer">TextBack AI Agent</a></td><td>amoCRM/Битрикс24, цепочки 1/3/7, мессенджеры</td></tr>
<tr><td><a href="https://cmdf5.ru/ai-manager" target="_blank" rel="noopener noreferrer">ChatAI CMD F5</a></td><td>Дожим в amoCRM, YandexGPT</td></tr>
<tr><td><a href="https://ai-mop.ru/" target="_blank" rel="noopener noreferrer">AI МОП</a></td><td>Голос + реактивация базы</td></tr>
<tr><td><a href="https://ajjo.ru/" target="_blank" rel="noopener noreferrer">AJJO</a></td><td>Контроль тишины в CRM</td></tr>
<tr><td><a href="https://www.cnews.ru/news/line/2026-03-06_ii_v_rossii_nachal_zabirat" target="_blank" rel="noopener noreferrer">CNews + Comindware</a></td><td>ИИ: резюме звонка, follow-up письмо</td></tr>
</tbody></table></div>
<h3 id="malyy-i-sredniy-b2b">Малый и средний B2B</h3>
<p>Старт: один сегмент воронки (например «думает» после КП), один канал, approve РОПа, 50 сделок пилота.</p>
<h3 id="chto-izmeryat-posle-zapuska">Что измерять после запуска</h3>
<p>До/после: time-to-follow-up, % сделок с полной цепочкой, встречи из «молчунов», нагрузка на менеджера (цель — <strong>5–12+ ч/нед</strong> высвобождения, в русле глобальных опросов Salesforce 2026).</p>
<hr>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-section-alt nero-ai-reveal" id="10-scenariev-follow-up" aria-labelledby="10-scenariev-follow-up-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="10-scenariev-follow-up-title">10 сценариев follow-up для вашей воронки (чек-лист)</h2>
    </header>
    <div class="nero-ai-prose">
<p>Лид-магнит из ТЗ: <strong>«10 сценариев follow-up для вашей воронки»</strong>.</p>
<ol class="nero-ai-prose-list">
<li>Нет ответа на заявку <strong>2 ч</strong> — мессенджер + email.</li>
<li>После квалификации — подтверждение боли и слот встречи.</li>
<li>No-show на встречу — перенос + ценность повестки.</li>
<li>После демо — резюме и один CTA.</li>
<li>«Подумаю» — cadence 1–3–7 с разными углами.</li>
<li>КП отправлено, нет открытия — короткий пинг.</li>
<li>КП открыто, нет ответа — уточнение срока решения.</li>
<li>Тишина <strong>14+ дней</strong> — реактивация с новым кейсом.</li>
<li>Летняя «заморозка» — мягкий check-in без давления.</li>
<li>Победа конкурента формальная — nurture на <strong>6–12 мес</strong>.</li>
</ol>
<h3 id="shablony-pod-etapy-voronki">Шаблоны под этапы воронки</h3>
<p>Для каждого сценария: триггер CRM, канал, лимит касаний, текст-скелет, эскалация.</p>
<h3 id="lid-magnit-i-adaptaciya-pod-nishu">Лид-магнит и адаптация под нишу</h3>
<p>Чек-лист «10 признаков, что вы теряете сделки на follow-up» + скрин цепочки день 1/3/7 — как у <a href="https://textback.ru/textback-ai-agent/" target="_blank" rel="noopener noreferrer">TextBack</a>, адаптированный под вашу воронку.</p>
<hr>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="faq-ai-follow-up" aria-labelledby="faq-ai-follow-up-title">
  <div class="nero-ai-container">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="faq-ai-follow-up-title">FAQ: как внедрить AI follow-up, безопасность и мифы</h2>
    </header>
    <div class="nero-ai-faq nero-ai-reveal">


      <details class="nero-ai-reveal"><summary>Заменит ли AI менеджеров?</summary><p>Нет. ИИ ведёт касания 1–N и реактивацию; человек — переговоры, скидки, мультистейкхолдер. Цитата <strong>Игоря Простоквашина</strong> (Comindware) в <a href="https://www.cnews.ru/news/line/2026-03-06_ii_v_rossii_nachal_zabirat" target="_blank" rel="noopener noreferrer">CNews 06.03.2026</a>: менеджер перестаёт быть секретарём и возвращается к переговорам.</p></details>

      <details class="nero-ai-reveal"><summary>Клиенты поймут, что это робот?</summary><p>Контекст из CRM, tone-of-voice, лимиты, handoff при сложном ответе.</p></details>

      <details class="nero-ai-reveal"><summary>WhatsApp / Telegram?</summary><p>Да, через официальные API и интеграторов (TextBack и аналоги); соблюдайте правила платформ и 152-ФЗ.</p></details>

      <details class="nero-ai-reveal"><summary>Срок запуска?</summary><p>От пилота на одном сегменте (<strong>2–4 недели</strong>) до полной воронки (<strong>6–8 недель</strong>) при чистой CRM.</p></details>
      <details class="nero-ai-reveal"><summary>AI follow-up для малого бизнеса?</summary><p>Достаточно одного CRM, одного канала и 3–5 сценариев; approve на старте обязателен.</p></details>
      <details class="nero-ai-reveal"><summary>Автоматизация без потери контроля?</summary><p>Дашборд для РОП: кого дожимает ИИ, кто в зоне риска, стоп-листы, журнал сообщений в карточке.</p></details>
    </div>
    <div class="nero-ai-prose nero-ai-reveal" style="margin-top:2rem">
      <div class="nero-ai-table-wrap"><table class="nero-ai-table"><thead><tr><th>Возражение</th><th>Ответ</th></tr></thead><tbody>
        <tr><td>«Дорого»</td><td>Сравнение с FTE на дожиме</td></tr>
        <tr><td>«Нельзя с ПДн»</td><td>YandexGPT, GigaChat, self-hosted</td></tr>
        <tr><td>«Перегреем базу»</td><td>Лимиты, сегменты, стоп-листы</td></tr>
      </tbody></table></div>
    </div>
  </div>
</section>


<section class="nero-ai-section nero-ai-reveal" id="razobrat-zavishshie-sdelki" aria-labelledby="razobrat-zavishshie-sdelki-title">
  <div class="nero-ai-container">
    <div class="nero-ai-final-cta nero-ai-card nero-ai-reveal" role="region" aria-labelledby="afm-final-cta-title">
      <h2 id="afm-final-cta-title">Разобрать зависшие сделки</h2>
      <p>Аудит воронки: доля сделок без касания, медиана 2-го касания, три сценария дожима и оценка стека amoCRM / Битрикс24 + Make/n8n + LLM.</p>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#10-scenariev-follow-up"><?php echo esc_html($secondary_cta_label); ?></a>
      </div>
    </div>
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
      "headline": "AI follow-up менеджер: повторные касания и дожим в CRM",
      "description": "Внедрение AI follow-up под ключ: персональные повторные касания, дожим зависших сделок, интеграция с CRM.",
      "author": {"@type": "Organization", "name": "Nero Network"},
      "inLanguage": "ru-RU"
    },
    {
      "@type": "FAQPage",
      "mainEntity": [
        {"@type": "Question", "name": "Заменит ли AI менеджеров?", "acceptedAnswer": {"@type": "Answer", "text": "Нет. ИИ ведёт касания 1–N и реактивацию; человек — переговоры, скидки, мультистейкхолдер."}},
        {"@type": "Question", "name": "Клиенты поймут, что это робот?", "acceptedAnswer": {"@type": "Answer", "text": "Контекст из CRM, tone-of-voice, лимиты, handoff при сложном ответе."}},
        {"@type": "Question", "name": "WhatsApp / Telegram?", "acceptedAnswer": {"@type": "Answer", "text": "Да, через официальные API и интеграторов; соблюдайте правила платформ и 152-ФЗ."}},
        {"@type": "Question", "name": "Срок запуска?", "acceptedAnswer": {"@type": "Answer", "text": "Пилот на одном сегменте 2–4 недели; полная воронка 6–8 недель при чистой CRM."}},
        {"@type": "Question", "name": "AI follow-up для малого бизнеса?", "acceptedAnswer": {"@type": "Answer", "text": "Один CRM, один канал, 3–5 сценариев; approve на старте обязателен."}}
      ]
    },
    {
      "@type": "SoftwareApplication",
      "name": "AI follow-up менеджер",
      "applicationCategory": "BusinessApplication",
      "operatingSystem": "Web"
    }
  ]
}
</script>

<?php nero_ai_echo_theme_scripts(); ?>

<?php
get_footer();

<?php
/**
 * Template Name: AI-квалификация лидов
 * Description: AI-квалификация лидов перед передачей менеджеру — Neurinix longread.
 */

$page_seo_title = 'AI-квалификация лидов: скоринг и статусы до передачи в CRM';
$page_seo_description = 'AI-квалификация лидов: скоринг, статусы MQL/SQL и передача в CRM. Внедрение под ключ для отдела продаж.';

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
$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Аудит воронки лидов';
$primary_cta_url = getenv('PRIMARY_CTA_URL') ?: '#audit';
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Внедрение под ключ';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#vnedrenie';

$nero_ai_header_links = [
    ['label' => 'Что такое', 'href' => '#akl-chto-takoe'],
    ['label' => 'Скоринг', 'href' => '#akl-ai-lid-skoring'],
    ['label' => 'CRM', 'href' => '#akl-integraciya-crm'],
    ['label' => 'Внедрение', 'href' => '#akl-vnedrenie-pod-klyuch'],
    ['label' => 'Стоимость', 'href' => '#akl-stoimost'],
    ['label' => 'FAQ', 'href' => '#akl-faq'],
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

  <section class="nero-ai-hero" id="lead-qualify-hero" aria-labelledby="hero-kval-title">
    <div class="nero-ai-container nero-ai-hero-grid">
      <div class="nero-ai-hero-copy nero-ai-reveal">
        <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai квалификация лидов</p>
        <h1 id="hero-kval-title">AI-квалификация лидов <span class="nero-ai-gradient-text">без ручного разбора входящих</span></h1>
        <p class="nero-ai-hero-lead">Скоринг, статусы hot/warm/cold и передача в CRM только подготовленного лида — менеджер подключается к сделке, а не к сортировке мусора.</p>
        <ul class="nero-ai-badges" aria-label="Ключевые параметры">
          <li class="nero-ai-badge">MQL / SQL</li>
          <li class="nero-ai-badge">amoCRM · Битрикс24</li>
          <li class="nero-ai-badge">BANT / MEDDIC</li>
          <li class="nero-ai-badge">Human-in-the-loop</li>
        </ul>
        <div class="nero-ai-btn-row">
          <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a>
          <a class="nero-ai-btn nero-ai-btn-secondary" href="<?php echo esc_url($secondary_cta_url); ?>"><?php echo esc_html($secondary_cta_label); ?></a>
        </div>
      </div>
      <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: скоринг и CRM">
        <div class="nero-ai-dashboard-shell">
          <div class="nero-ai-window-top">
            <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
            <span class="nero-ai-window-title">скоринг · демо</span>
          </div>
          <div class="nero-ai-window-body">
            <div class="nero-ai-dashboard-title"><h3>Квалификация лида</h3><span class="nero-ai-live-pill">live</span></div>
            <div class="nero-ai-metrics-grid">
              <div class="nero-ai-metric"><span>Score</span><strong data-nero-count="72" data-nero-suffix="">0</strong><small>HOT порог</small></div>
              <div class="nero-ai-metric"><span>Шум</span><strong>−40%</strong><small>нецелевые</small></div>
              <div class="nero-ai-metric"><span>CRM</span><strong>auto</strong><small>поля + теги</small></div>
              <div class="nero-ai-metric"><span>Handoff</span><strong>4 мин</strong><small>vs 22 мин</small></div>
            </div>
            <div class="nero-ai-task-stream">
              <div class="nero-ai-task"><span class="nero-ai-task-icon">IN</span><div><strong>Заявка</strong><span>сигналы</span></div><span class="nero-ai-status">готово</span></div>
              <div class="nero-ai-task"><span class="nero-ai-task-icon">AI</span><div><strong>Скоринг</strong><span>hot/warm/cold</span></div><span class="nero-ai-status">готово</span></div>
              <div class="nero-ai-task"><span class="nero-ai-task-icon">CRM</span><div><strong>Карточка</strong><span>summary</span></div><span class="nero-ai-status">новое</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<section class="nero-ai-section nero-ai-section-tight nero-ai-section-tight" aria-label="Введение">
  <div class="nero-ai-container">
    <div class="nero-ai-intro-grid nero-ai-reveal">
      <div class="nero-ai-intro-text">
        <p class="nero-ai-eyebrow">Лонгрид · квалификация лидов</p>
        <p class="nero-ai-lead"><strong>Коротко:</strong> AI-квалификация лидов — автоматизированный слой между заявкой и менеджером: диалог, скоринг, статусы «горячий / тёплый / холодный / нецелевой» и передача в CRM только подготовленного контакта с контекстом.</p>
        <p class="">Ниже — матрицы BANT/MEDDIC, интеграция amoCRM и Битрикс24, кейсы B2B и чеклист внедрения без «замены отдела продаж».</p>
      </div>
      <aside class="nero-ai-intro-deco nero-ai-card" aria-label="Схема квалификации лида">
        <div class="nero-ai-terminal-top"><span></span><span></span><span></span> qualify@nero</div>
        <ul class="nero-ai-terminal-lines">
          <li><code>IN</code> заявка → <strong>сигналы</strong></li>
          <li><code>SCORE</code> веса → <strong>72+ HOT</strong></li>
          <li><code>TAG</code> hot/warm/cold → <strong>CRM</strong></li>
          <li><code>HANDOFF</code> summary + цитаты → <strong>ОП</strong></li>
        </ul>
        <div class="nero-ai-intro-chips">
          <span>MQL</span><span>SQL</span><span>HOT</span><span>−40% шум</span>
        </div>
      </aside>
    </div>
    <nav class="nero-ai-toc-wrap nero-ai-reveal" aria-label="Оглавление">
      <div class="nero-ai-toc">
        <a href="#akl-chto-takoe">Что такое AI-квалификация лидов и чем она отличается от ручной обработки заявок</a><a href="#akl-pochemu-netselevye">Почему менеджеры тратят время на нецелевых клиентов: типичные ошибки без скоринга</a><a href="#akl-statusy-lida">Статусы лида: горячий, тёплый, холодный и нецелевой — единые правила для CRM</a><a href="#akl-ai-lid-skoring">AI-скоринг лидов: как работает модель, правила и пороги передачи</a><a href="#akl-matrica-kvalifikacii">Матрица квалификации лидов: BANT, CHAMP, MEDDIC в правилах AI-агента</a><a href="#akl-ai-voronka">AI-воронка продаж: этапы от заявки до передачи менеджеру</a><a href="#akl-integraciya-crm">Интеграция AI-квалификации лидов с CRM: amoCRM, Bitrix24 и поля статуса</a><a href="#akl-vnedrenie-pod-klyuch">Внедрение AI-квалификации лидов под ключ: этапы, сроки и роли команды</a><a href="#akl-stoimost">Стоимость, срок окупаемости и чек 150–450 тыс. ₽: когда внедрение оправдано</a><a href="#akl-kejsy">Кейсы: B2B-услуги, агентства, девелоперы — примеры внедрения</a><a href="#akl-faq">FAQ по AI-квалификации лидов</a>
      </div>
    </nav>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="akl-chto-takoe" aria-labelledby="akl-chto-takoe-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="akl-chto-takoe-title">Что такое AI-квалификация лидов и чем она отличается от ручной обработки заявок</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Определение.</strong> AI-квалификация лидов — автоматизированная проверка входящего обращения (сайт, мессенджеры, реклама, формы) до передачи в отдел продаж: conversational AI или LLM-агент ведёт диалог, собирает поля по матрице (BANT, CHAMP, MEDDIC), отвечает на FAQ из базы знаний, присваивает приоритет и формирует <strong>пакет handoff</strong> — карточку CRM, транскрипт, цитаты клиента, рекомендуемый первый вопрос менеджеру.</p>
<p>В 2026 году индустрия смещается от MQL «по форме» к <strong>Conversationally Qualified Lead (CQL)</strong> — квалификации по транскрипту диалога, а не по чекбоксам (<a href="https://getperspective.ai/blog/mqls-are-dead-conversational-qualified-leads-2026" target="_blank" rel="noopener noreferrer">>Perspective AI, 2026</a>). По аудиту <strong>412</strong> B2B SaaS-воронок (Q4 2025 – Q1 2026) у <strong>78%</strong> уже есть conversational qualification layer (было <strong>22%</strong> в 2024); при том же трафике qualified pipeline растёт в <strong>3,4×</strong>, visitor→opportunity — <strong>+241%</strong>, show rate — <strong>+41%</strong> (<a href="https://getperspective.ai/blog/ai-sales-discovery-2026-pipeline-report-conversational-qualification" target="_blank" rel="noopener noreferrer">>Perspective AI Pipeline Report 2026</a>).</p>
<h3>Зачем бизнесу квалификация лидов до отдела продаж</h3>
<p>Квалификация лидов в продажах — это ответ на вопрос: <strong>стоит ли тратить время живого менеджера на этот контакт сейчас</strong>. Без формализованных критериев «квалификация» превращается в субъективное «похоже на клиента». AI фиксирует правила: бюджет, срок, полномочия, соответствие ICP — и не пропускает в воронку то, что вы заранее назвали нецелевым.</p>
<p>Для B2B-услуг, агентств и девелоперов типичная боль из практики: <strong>не нехватка лидов, а перегруз нецелевым потоком</strong>. В одном публичном кейсе агентства недвижимости в Москве (~400 заявок/мес, 3 менеджера) около <strong>55%</strong> трафика изначально нецелевой; после ИИ-фильтрации по четырём критериям нагрузка на менеджеров снизилась на <strong>40%</strong>, а сделки выросли за счёт фокуса на горячих (<a href="https://www.sostav.ru/blogs/281569/87715" target="_blank" rel="noopener noreferrer">>Sostav.ru / SaleAgent, 23.05.2026</a>).</p>
<h3>AI-бот vs менеджер на первом касании (квалификация лидов ai ботом)</h3>
<div class="nero-ai-table-wrap"><table class="nero-ai-table">
<thead>
<tr>
<th>Роль</th>
<th>Менеджер на первом касании</th>
<th>AI-квалификация</th>
</tr>
</thead>
<tbody>
<tr>
<td>Скорость ответа</td>
<td>Зависит от смены, очереди</td>
<td>24/7, цель — ответ <strong>&lt; 1 мин</strong></td>
</tr>
<tr>
<td>Одинаковость вопросов</td>
<td>Разный опыт, усталость</td>
<td>Один скрипт + RAG по FAQ</td>
</tr>
<tr>
<td>Стоимость контакта</td>
<td>Высокая ставка ОП</td>
<td>Масштабируется на сотни диалогов</td>
</tr>
<tr>
<td>Эмпатия, цена, исключения</td>
<td>Сильная сторона</td>
<td>Эскалация на человека</td>
</tr>
</tbody>
</table></div>
<p><strong>Квалификация лидов ai ботом</strong> — не синоним «замены продаж». По формулировке экспертов гибридной воронки: ИИ убирает рутину первых касаний, человек подключается, когда клиент «дозрел» или ситуация требует эмпатии (<a href="https://companies.rbc.ru/news/vb6i8T44zD/avtomatizatsiya-prodazh-voronki-ne-rabotayut-bez-cheloveka/" target="_blank" rel="noopener noreferrer">>РБК Компании / INFULL, 26.05.2026</a>). Perspective AI в 2026 резюмирует тренд иначе: <em>«Humans still close — but they no longer qualify in the first five touches»</em> (<a href="https://getperspective.ai/blog/ai-sales-discovery-2026-pipeline-report-conversational-qualification" target="_blank" rel="noopener noreferrer">>отчёт 2026</a>).</p>
<p><strong>Итог:</strong> AI-квалификация лидов — это не «ещё один чат на сайте», а <strong>слой скоринга и статусов до CRM</strong>, с измеримым handoff.</p>
<hr>

    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="akl-pochemu-netselevye" aria-labelledby="akl-pochemu-netselevye-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="akl-pochemu-netselevye-title">Почему менеджеры тратят время на нецелевых клиентов: типичные ошибки без скоринга</h2>
    </header>
    <div class="nero-ai-prose">
<p>Без <strong>ai лид скоринга</strong> и единых статусов отдел продаж становится дорогим фильтром: каждый менеджер вручную отсекает спам, студентов, «просто спросить цену» и конкурентов.</p>
<h3>Симптомы «грязной» воронки в CRM</h3>
<ul class="nero-ai-prose-list">
<li>Все новые заявки падают на одну стадию «Новый лид» без приоритета.</li>
<li>В карточке пусто: нет бюджета, срока, ЛПР — менеджер выясняет с нуля.</li>
<li><strong>Speed-to-lead</strong> плавает: в кейсе Екатеринбурга (Salesbot amoCRM + VK) время первого контакта менеджера было <strong>22 минуты</strong>; после квалификации в диалоге — <strong>4 минуты</strong> (<a href="https://biznesenok.ru/nastrojka-salesbot-v-amocrm-kak-sozdat-chat-bota-dlja-avtomaticheskih-otvetov-i-kvalifikacii-lidov/" target="_blank" rel="noopener noreferrer">>Бизнесёнок</a>).</li>
<li>Горячие лиды остывают в общей очереди. В материалах 2026 часто цитируют классический бенчмарк HBR: ответ <strong>≤5 мин</strong> vs <strong>30 мин</strong> — квалификация <strong>в ~100×</strong> вероятнее (повторяется в RU-обзорах; помечайте как широко цитируемый бенчмарк, не как свежий отчёт 2026) — <a href="https://www.sostav.ru/blogs/281569/87715" target="_blank" rel="noopener noreferrer">>Sostav.ru</a>. INFULL на РБК даёт связанную оценку: <strong>5-минутная</strong> задержка снижает вероятность квалификации <strong>в 4 раза</strong> (<a href="https://companies.rbc.ru/news/vb6i8T44zD/avtomatizatsiya-prodazh-voronki-ne-rabotayut-bez-cheloveka/" target="_blank" rel="noopener noreferrer">>РБК Компании</a>).</li>
</ul>
<h3>Скрытая стоимость нецелевых лидов для B2B</h3>
<p>Российские обзоры 2026 ссылаются на HubSpot Sales Trends: ИИ-скоринг отсекает <strong>40–60%</strong> нецелевых заявок; у команд с AI-скорингом конверсия выше на <strong>~27%</strong> (<a href="https://www.sostav.ru/blogs/281569/87715" target="_blank" rel="noopener noreferrer">>Sostav.ru</a>). Даже без точного ROI на старте понятна логика: менеджер × N часов на «мусор» = прямые затраты + упущенные горячие.</p>
<p><strong>AI для отдела продаж</strong> на этапе квалификации — это перераспределение: <strong>до 80%</strong> рутины первого касания на автоматизацию, не увольнение команды (<a href="https://metasapiens.ru/blog/ai-agenty-v-crm-kak-cifrovoj-sotrudnik-zakryvaet-sdelki" target="_blank" rel="noopener noreferrer">>позиционирование интеграторов 2026</a>).</p>
<hr>

    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="akl-statusy-lida" aria-labelledby="akl-statusy-lida-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="akl-statusy-lida-title">Статусы лида: горячий, тёплый, холодный и нецелевой — единые правила для CRM</h2>
    </header>
    <div class="nero-ai-prose">
<p>Коммерческий оффер AI-квалификации — <strong>присвоить лиду понятный статус до handoff</strong>:</p>
<div class="nero-ai-table-wrap"><table class="nero-ai-table">
<thead>
<tr>
<th>Статус</th>
<th>Смысл</th>
<th>Типичное действие</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>Горячий</strong></td>
<td>ICP совпал, бюджет/срок подтверждены, готов к встрече</td>
<td>Задача менеджеру + слот в календаре, SLA минуты</td>
</tr>
<tr>
<td><strong>Тёплый</strong></td>
<td>Интерес есть, не все поля закрыты</td>
<td>Nurture, повторный контакт, дозревание</td>
</tr>
<tr>
<td><strong>Холодный</strong></td>
<td>Долгий горизонт, низкий приоритет</td>
<td>Цепочка писем/контента, не занимать старшего ОП</td>
</tr>
<tr>
<td><strong>Нецелевой</strong></td>
<td>Вне ICP, спам, не тот продукт</td>
<td>Вежливый отказ, тег, без передачи в активную воронку</td>
</tr>
</tbody>
</table></div>
<h3>Критерии присвоения статуса AI-агентом</h3>
<p>Критерии должны быть <strong>описаны математически</strong> — иначе автоматизация «плывёт». На практике: веса по полям матрицы (см. раздел BANT/MEDDIC), пороги score, жёсткие disqualified-правила («бюджет &lt; X», «регион не обслуживаем»). LLM дополняет правила: тон, возражения, нестандартные формулировки — но <strong>финальный маршрут</strong> задаётся вашей политикой, не «настроением модели».</p>
<p>Шаблон n8n (<a href="https://n8n.io/workflows/9310-automate-lead-qualification-and-routing-with-gpt-4o-mini-google-sheets-and-highlevel-crm/" target="_blank" rel="noopener noreferrer">>workflow 9310</a>): форма → AI scoring → Hot/Warm/Cold → CRM + уведомление — тот же паттерн переносится на amoCRM/Битрикс24 + YandexGPT/OpenRouter.</p>
<h3>Что передаётся менеджеру в карточке лида</h3>
<p>Уникальный угол Nero Network — <strong>handoff как продукт</strong>, не «бот ответил»:</p>
<ol class="nero-ai-prose-list">
<li>Статус hot/warm/cold/disqualified + числовой score  </li>
<li>Заполненные поля CRM (бюджет, срок, тип запроса)  </li>
<li><strong>Summary</strong> диалога (3–5 предложений)  </li>
<li><strong>2–3 прямые цитаты</strong> клиента  </li>
<li>Рекомендуемый <strong>первый вопрос</strong> менеджеру  </li>
<li>Теги возражений («дорого», «сравниваю с …») для подготовки</li>
</ol>
<p>Менеджер не начинает с «чем могу помочь?», а с «вижу, вам нужен объект в районе X к сроку Y — верно?».</p>
<hr>

    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="akl-ai-lid-skoring" aria-labelledby="akl-ai-lid-skoring-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="akl-ai-lid-skoring-title">AI-скоринг лидов: как работает модель, правила и пороги передачи</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Скоринг лидов</strong> — присвоение числового или категориального приоритета на основе сигналов. <strong>AI лид скоринг</strong> добавляет NLP: смысл ответов в чате, а не только «галочка в форме».</p>
<h3>Сигналы скоринга (форма, чат, звонок, поведение на сайте)</h3>
<ul class="nero-ai-prose-list">
<li><strong>Явные:</strong> бюджет, срок, роль (ЛПР / не ЛПР), тип услуги, гео.  </li>
<li><strong>Поведенческие:</strong> страницы прайса, повторные визиты, UTM high-intent.  </li>
<li><strong>Диалоговые:</strong> длина ответов, вопросы про внедрение vs «сколько стоит сайт».  </li>
<li><strong>Телефония:</strong> расшифровка → поля сделки (тренд BitrixGPT / обзоры <a href="https://metasapiens.ru/blog/ai-agenty-v-crm-kak-cifrovoj-sotrudnik-zakryvaet-sdelki" target="_blank" rel="noopener noreferrer">>METASAPIENS</a>).</li>
</ul>
<h3>Скоринг лидов ai vs классические балльные системы</h3>
<div class="nero-ai-table-wrap"><table class="nero-ai-table">
<thead>
<tr>
<th>Подход</th>
<th>Плюсы</th>
<th>Минусы</th>
</tr>
</thead>
<tbody>
<tr>
<td>Rule-based (баллы за поля)</td>
<td>Прозрачность, предсказуемость</td>
<td>Ломается на свободном тексте</td>
</tr>
<tr>
<td><strong>Скоринг лидов ai</strong> (LLM + правила)</td>
<td>Понимает формулировки, FAQ, отток</td>
<td>Нужны guardrails и shadow mode</td>
</tr>
<tr>
<td>Чистый ML на истории CRM</td>
<td>Точность при больших данных</td>
<td>Долгий старт, «чёрный ящик»</td>
</tr>
</tbody>
</table></div>
<p>Агрегаторы 2026 указывают: AI lead scoring даёт <strong>+40%</strong> точности vs rule-based в сравнениях вендоров; <strong>67%</strong> B2B-маркетологов уже используют AI в lead gen (<a href="https://adai.news/resources/statistics/ai-lead-generation-statistics-2026/" target="_blank" rel="noopener noreferrer">>AdAI statistics 2026</a>). CQL по диалогу конвертируется в SQL <strong>в 2–4×</strong> чаще, чем MQL по форме на ранних внедрениях (<a href="https://getperspective.ai/blog/mqls-are-dead-conversational-qualified-leads-2026" target="_blank" rel="noopener noreferrer">>Perspective AI, CQL</a>).</p>
<p><strong>Что такое скоринг лидов</strong> в одном предложении: ранжирование контактов по вероятности сделки и срочности. <strong>Чем отличается от квалификации:</strong> скоринг — приоритет; квалификация — бинарное/многоуровневое «пускаем в активную работу ОП или нет».</p>
<hr>

    </div>
  </div>
</section>

<section id="ai-kvalifikaciya-lidov-boris-block" class="boris-article-viz" aria-labelledby="boris-scoring-kicker">
<div class="boris-scoring-wrap ym-container">
  <div class="boris-scoring-card">
    <div class="boris-scoring-grid">
      <div class="boris-scoring-copy">
        <p class="boris-eyebrow">Схема скоринга</p>
        <h3 id="boris-scoring-kicker" class="boris-kicker">Как заявка получает балл и статус до CRM</h3>
        <p class="boris-lead">Сигналы с формы, чата и поведения на сайте проходят через веса правил — на выходе один из четырёх статусов и порог передачи менеджеру.</p>
        <ul class="boris-points">
          <li><strong>Слой 1 — сигналы:</strong> бюджет, срок, роль, источник, повторные касания.</li>
          <li><strong>Слой 2 — скоринг:</strong> сумма весов и пороги «горячий / тёплый / холодный».</li>
          <li><strong>Слой 3 — маршрут:</strong> задача в CRM, эскалация или отсев нецелевого.</li>
        </ul>
        <div class="boris-pills" aria-hidden="true">
          <span class="boris-pill boris-pill--hot"><span class="boris-pill-dot"></span>Горячий ≥ 72</span>
          <span class="boris-pill boris-pill--warm"><span class="boris-pill-dot"></span>Тёплый 48–71</span>
          <span class="boris-pill boris-pill--cool"><span class="boris-pill-dot"></span>Холодный 25–47</span>
          <span class="boris-pill boris-pill--junk"><span class="boris-pill-dot"></span>Нецелевой &lt; 25</span>
        </div>
        <p class="boris-bridge">Дальше разберём, как задать пороги под вашу матрицу BANT / MEDDIC.</p>
      </div>
      <div class="boris-canvas-shell" role="img" aria-label="Анимированная схема: сигналы лида проходят скоринг и распределяются по статусам">
        <canvas id="lead-scoring-matrix-canvas" width="640" height="480"></canvas>
      </div>
    </div>
  </div>
</div>
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

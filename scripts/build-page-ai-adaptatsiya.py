#!/usr/bin/env python3
"""Build page-ai-adaptatsiya-sotrudnikov.php from handoff fragments."""
from __future__ import annotations

import re
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
ALINA = (ROOT / ".cursor/nero-network-fragments/alina.md").read_text(encoding="utf-8")
BORIS = (ROOT / ".cursor/nero-network-fragments/boris.md").read_text(encoding="utf-8")
AMOCRM = (ROOT / "wordpress/page-vnedrenie-ai-amocrm.php").read_text(encoding="utf-8")

OUT = ROOT / "wordpress/page-ai-adaptatsiya-sotrudnikov.php"
OUT_THEME = ROOT / "wordpress-theme/page-ai-adaptatsiya-sotrudnikov.php"


def extract_html_block(text: str, label: str) -> str:
    m = re.search(rf"## {label}\s+```html\n(.*?)```", text, re.DOTALL)
    if not m:
        raise SystemExit(f"Missing block: {label}")
    return m.group(1).strip()


def extract_css_from_amocrm() -> str:
    m = re.search(r"<style>\n(.*?)</style>", AMOCRM, re.DOTALL)
    if not m:
        raise SystemExit("Cannot extract CSS from amoCRM page")
    css = m.group(1)
    # drop hero-specific if any in amo - keep vna styles
    return css


hero_html = extract_html_block(ALINA, "HTML-фрагмент hero")
hero_js = extract_html_block(ALINA, "JavaScript \\(Canvas engine\\)")
boris_html = extract_html_block(BORIS, "HTML \\+ inline style \\+ script")

# Hero PHP substitutions
hero_html = hero_html.replace(
    "Nero Network · ai onboarding",
    "<?php echo esc_html($brand); ?> · ai onboarding",
)
hero_html = hero_html.replace(
    'href="${TELEGRAM_CHANNEL_URL}"',
    'href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>',
)
hero_html = hero_html.replace('href="#kak-rabotaet"', 'href="<?php echo esc_url($secondary_cta_url); ?>"')

page_css = extract_css_from_amocrm()

# Extra styles for Boris light block inside dark page + steps
extra_css = """
/* Boris light block inside dark longread */
.vna-content #ai-adaptatsiya-sotrudnikov-boris-block.bas-root{color:#0f172a;}
.vna-steps{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-top:28px;}
@media(max-width:900px){.vna-steps{grid-template-columns:1fr 1fr;}}
@media(max-width:560px){.vna-steps{grid-template-columns:1fr;}}
.vna-step-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:20px;}
.vna-step-num{font-size:11px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:var(--vna-accent);margin-bottom:8px;}
.vna-step-card h3{font-size:15px;margin-bottom:8px;}
.vna-step-card p{font-size:13.5px;margin:0;}
.vna-callout{border-left:3px solid var(--vna-green);padding:16px 20px;background:rgba(34,197,94,.08);border-radius:0 12px 12px 0;margin:24px 0;}
.vna-callout p{margin:0;font-size:14.5px;}
.vna-arch-flow{display:flex;flex-wrap:wrap;align-items:center;gap:8px;justify-content:center;margin:24px 0;}
.vna-arch-flow span{padding:8px 14px;border-radius:999px;background:rgba(121,242,255,.1);border:1px solid rgba(121,242,255,.25);font-size:13px;font-weight:600;color:var(--vna-soft);}
.vna-arch-flow .arr{color:var(--vna-muted);font-size:18px;}
.vna-flags{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;margin-top:20px;}
@media(max-width:600px){.vna-flags{grid-template-columns:1fr;}}
.vna-flag{padding:14px 16px;border-radius:12px;background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.22);font-size:13.5px;color:#fecaca;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-link--accent{color:var(--vna-accent)!important;text-decoration:underline!important;}
.vna-price-band{display:inline-block;padding:6px 16px;border-radius:999px;background:rgba(121,242,255,.12);border:1px solid rgba(121,242,255,.3);font-size:14px;font-weight:800;color:var(--vna-accent);margin-bottom:16px;}
"""

php_header = '''<?php
/**
 * Template Name: AI адаптация сотрудников: внедрение AI-агента под ключ
 * Description: SEO-лендинг — AI-агент адаптации сотрудников: onboarding, RAG, дашборд рисков. Кейсы, интеграции, цены.
 */

$page_seo_title       = 'AI адаптация сотрудников: внедрение AI-агента под ключ';
$page_seo_description = 'Внедряем AI-агент адаптации сотрудников: ведёт новичка по чек-листу onboarding, отвечает на вопросы по регламентам и показывает HR статус адаптации и риски. Кейсы, интеграции, цены. Проверить onboarding.';

add_filter('document_title_parts', static function (array $parts) use ($page_seo_title): array {
    $parts['title'] = $page_seo_title;
    return $parts;
}, 20);

add_action('wp_head', static function () use ($page_seo_title, $page_seo_description): void {
    echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\\n";
    echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\\n";
    echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\\n";
    echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\\n";
    echo '<meta property="og:type" content="article" />' . "\\n";
}, 1);

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Для кого',     'href' => '#dlya-kogo'],
    ['label' => 'Интеграции',   'href' => '#integracii'],
    ['label' => 'Кейсы',        'href' => '#keisy'],
    ['label' => 'Стоимость',    'href' => '#ceny'],
    ['label' => 'FAQ',          'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = 'Проверить onboarding';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = '#kak-rabotaet';
$secondary_cta_link  = getenv('SECONDARY_CTA_URL') ?: '';
$secondary_cta_attrs = $secondary_cta_link ? nero_ai_external_link_attrs($secondary_cta_link) : '';

$ad_banner_url   = getenv('AD_BANNER_URL') ?: '';
$ad_banner_image = getenv('AD_BANNER_IMAGE_URL') ?: '';
$ad_banner_alt   = getenv('AD_BANNER_ALT') ?: 'Партнёрское предложение';

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
'''

php_footer = '''
</main>

<script>
(function(){
  document.querySelectorAll('.vna-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.vna-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.vna-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.vna-faq-q');
        if(q) q.setAttribute('aria-expanded','false');
      });
      if(!isOpen){
        item.classList.add('open');
        btn.setAttribute('aria-expanded','true');
      }
    });
    btn.addEventListener('keydown', function(e){
      if(e.key==='Enter'||e.key===' '){e.preventDefault();btn.click();}
    });
  });
})();
</script>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.ai-adaptatsiya-sotrudnikov-page');
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

''' + hero_js + '''

<!-- SCHEMA-MARKUP:INSERT -->
<!-- INTERNAL-LINKS:INSERT -->

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
'''

content = f'''{php_header}{page_css}{extra_css}</style>

<main id="primary" class="site-main nero-ai-home-page ai-adaptatsiya-sotrudnikov-page" role="main" tabindex="-1">

{hero_html}

<div class="vna-content">

  <section class="vna-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="vna-cnt nero-ai-container">
      <div class="vna-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="vna-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai onboarding</p>
          <p><strong>Коротко:</strong> AI-агент адаптации сотрудников ведёт новичка по чек-листу onboarding, отвечает на вопросы по регламентам 24/7 и показывает HR и руководителю статус адаптации с ранними сигналами риска — до того, как сотрудник «потеряется» между welcome-тренингом и первой самостоятельной задачей.</p>
          <p><?php echo esc_html($brand); ?> внедряет такие агенты под ключ: от аудита процесса до пилота на реальных новичках. Ориентир чека — <strong>120–350 тыс. ₽</strong> за фокусный MVP (1–2 роли, Telegram или Bitrix24, RAG-база знаний, чек-лист, дашборд статуса). Следующий шаг — <strong>проверить onboarding</strong> и получить «Карту адаптации сотрудника».</p>
        </div>
        <div class="vna-intro-kpi" aria-label="Ключевые метрики onboarding">
          <div class="vna-kpi-card"><div class="kv">33%</div><div class="kl">ищут работу в первые 6 мес.</div><div class="ks">FirstHR</div></div>
          <div class="vna-kpi-card"><div class="kv">3,4%</div><div class="kl">90-day turnover (медиана)</div><div class="ks">HRBench</div></div>
          <div class="vna-kpi-card"><div class="kv">82%</div><div class="kl">удержание при структурном onboarding</div><div class="ks">Brandon Hall</div></div>
          <div class="vna-kpi-card"><div class="kv">−40%</div><div class="kl">нагрузка HR (кейс)</div><div class="ks">Открытая Линия</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc" aria-label="Оглавление статьи">
        <a href="#bolez">Проблема</a>
        <a href="#chto-takoe">Что это</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#dlya-kogo">Для кого</a>
        <a href="#integracii">Интеграции</a>
        <a href="#arhitektura">Архитектура</a>
        <a href="#kpi">KPI</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Цены</a>
        <a href="#etapy">Этапы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="vna-section" id="bolez">
    <div class="vna-cnt">
      <div class="vna-sh vna-left nero-ai-reveal">
        <span class="vna-eyebrow">Проблема</span>
        <h2>Почему новички «теряются» и руководитель не видит статус адаптации</h2>
        <p><strong>Определение боли:</strong> между официальным welcome и первой продуктивной задачей новичок остаётся без системного сопровождения — регламенты разбросаны, наставник перегружен, руководитель узнаёт о проблеме post factum.</p>
      </div>
      <div class="vna-grid-3 nero-ai-reveal" style="margin-bottom:32px;">
        <div class="vna-kpi-card"><div class="kv">33%</div><div class="kl">новых сотрудников ищут работу в первые 6 месяцев</div></div>
        <div class="vna-kpi-card"><div class="kv">3,4%</div><div class="kl">медиана 90-day new hire turnover</div></div>
        <div class="vna-kpi-card"><div class="kv">82%</div><div class="kl">удержание при структурированном onboarding</div></div>
      </div>
      <div class="vna-card nero-ai-reveal">
        <h3>Типовые провалы onboarding в сетях и франшизах</h3>
        <ul>
          <li><strong>Разрозненные источники знаний</strong> — FAQ в чате, wiki, PDF, LMS. Новичок не знает, где искать ответ.</li>
          <li><strong>Нестандартизированный путь</strong> — в одном филиале адаптация за 5 дней, в другом за 3 недели.</li>
          <li><strong>Ручная координация</strong> — HR напоминает о документах, IT о доступах; один пропущенный шаг тормозит цепочку.</li>
          <li><strong>Нет «пульта» для руководителя</strong> — статус в Excel или «на словах». Риски видны, когда новичок уже отстаёт.</li>
        </ul>
        <div class="vna-timeline" style="margin-top:28px;">
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>День 1–7</h3><p>Эмоциональный пик, но информационный шок. Новичок получает десятки ссылок и не понимает приоритеты.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>День 8–30</h3><p>«Пустота» между тренингом и реальной работой. Вопросы к HR повторяются.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>День 31–90</h3><p>Критический период удержания. Без структурированного сопровождения компании теряют недавно нанятых людей.</p></div>
        </div>
        <p style="margin-top:20px;"><strong>Итог:</strong> руководитель не видит статус адаптации в реальном времени; HR тратит время на рутину; новички теряются — измеримая бизнес-проблема.</p>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="chto-takoe">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Определение</span>
        <h2>Что такое AI-агент адаптации сотрудников</h2>
        <p><strong>Определение:</strong> AI-агент адаптации сотрудников — оркестратор процесса onboarding. Он ведёт новичка по ролевому чек-листу, отвечает на вопросы по регламентам через RAG, фиксирует прогресс и эскалирует риски HR и руководителю.</p>
      </div>
      <div class="vna-table-wrap nero-ai-reveal" style="margin-bottom:24px;">
        <table class="vna-table">
          <thead><tr><th>Критерий</th><th>Классический наставник</th><th>AI-наставник сотрудника</th></tr></thead>
          <tbody>
            <tr><td>Доступность</td><td>Рабочие часы, очно</td><td>24/7 в Telegram / корпоративном чате</td></tr>
            <tr><td>Одинаковые вопросы</td><td>Наставник отвечает снова</td><td>RAG отвечает по документам с ссылкой на источник</td></tr>
            <tr><td>Масштаб</td><td>1 наставник = N новичков</td><td>Один агент — сотни параллельных адаптаций</td></tr>
            <tr><td>Статус для руководителя</td><td>Субъективно, «на словах»</td><td>Дашборд: % чек-листа, просрочки, красные флаги</td></tr>
            <tr><td>Эскалация</td><td>Наставник сам решает</td><td>Правила: 2+ просрочки → уведомление HR</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vna-callout nero-ai-reveal">
        <p><strong>Кейс «Открытая Линия»</strong> (400+ сотрудников): нейроассистент Oline Наставник ускорил адаптацию <strong>в 2 раза</strong> и освободил HR <strong>~40%</strong> рабочего времени. AI не заменяет живое наставничество — снимает рутину и даёт единый стандарт.</p>
      </div>
      <div class="vna-card nero-ai-reveal">
        <h3>AI-наставник: чек-лист, Q&A по регламентам, сигналы риска</h3>
        <ol style="padding-left:20px;color:var(--vna-muted);line-height:1.7;font-size:14.5px;">
          <li>Персональный план адаптации по должности и филиалу (30/60/90 дней).</li>
          <li>Ответы 24/7 со ссылками на первоисточник в базе знаний регламентов.</li>
          <li>Напоминания о дедлайнах и невыполненных шагах.</li>
          <li>Мини-тесты и проверка усвоения регламентов.</li>
          <li>Сигналы риска для HR/руководителя: просрочки, повторяющиеся вопросы, негатив в опросе.</li>
          <li>Аналитика: time-to-productivity, % прохождения чек-листа, топ-5 вопросов новичков.</li>
        </ol>
      </div>
    </div>
  </section>

  {boris_html}

  <section class="vna-section" id="kak-rabotaet">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Процесс</span>
        <h2>Как работает AI-агент onboarding по шагам</h2>
        <p><strong>Коротко:</strong> событие «новый сотрудник» в HRIS → персональный чек-лист → RAG-ответы и напоминания → эскалация рисков → отчёт на 30/60/90 день.</p>
      </div>
      <div class="vna-steps nero-ai-reveal">
        <div class="vna-step-card"><div class="vna-step-num">Шаг 1</div><h3>Чек-лист по роли</h3><p>Документы, доступы IT, обучение, встречи с buddy, первая смена — новичок видит «следующий шаг».</p></div>
        <div class="vna-step-card"><div class="vna-step-num">Шаг 2</div><h3>RAG по регламентам</h3><p>Ответ только по вашим документам — со ссылкой и датой. При уверенности &lt;85% — эскалация HR.</p></div>
        <div class="vna-step-card"><div class="vna-step-num">Шаг 3</div><h3>Эскалация рисков</h3><p>2+ просрочки, 3+ одинаковых вопроса, негатив NPS — уведомление HR и руководителю с контекстом.</p></div>
        <div class="vna-step-card"><div class="vna-step-num">Шаг 4</div><h3>Дашборд статуса</h3><p>% чек-листа, красные флаги, топ-5 вопросов — руководитель видит статус без Excel.</p></div>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Дашборд статуса адаптации для руководителя и HR</h3>
        <p>Главный дифференциатор против «просто чат-бота». На одном экране: статус каждого новичка, просроченные шаги, топ вопросов, сравнение филиалов и ролей.</p>
      </div>
    </div>
  </section>

  <aside class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-onboarding-check">
    <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Проверьте onboarding до того, как новичок «потеряется»</p>
      <p class="ym-cta-block__sub">Разберём ваш процесс по 1–2 ролям, покажем демо дашборда статуса адаптации и оценим, что закроет AI-агент в первом пилоте. Ориентир — 120–350 тыс. ₽ за MVP. Без обязательств.</p>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Проверить onboarding</a>
    </div>
  </aside>

  <section class="vna-section vna-section-alt" id="dlya-kogo">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Аудитория</span>
        <h2>Для кого: HR, франшизы, розница и сервисные сети</h2>
        <p>HR-департаменты, франшизы, розница, контакт-центры, медицина — везде, где нанимают линейный персонал массово и onboarding повторяемый.</p>
      </div>
      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card"><h3>Масштаб без роста штата наставников</h3><p>Формула: <strong>больше найма × тот же штат наставников = провал без автоматизации</strong>. AI-агент даёт единый стандарт и снимает 40–60% типовых обращений к HR. MVP на 1 роли и Telegram — без корпоративного портала.</p></div>
        <div class="vna-card"><h3>Единый стандарт адаптации в филиалах</h3><p>Для франшиз критичен единый стандарт в 10, 50, 200 точках. RBAC: новичок в Москве видит московские регламенты; в Казани — казанские. AI-слой ставится поверх Bitrix24/Huntflow — не с нуля.</p></div>
      </div>
    </div>
  </section>

  <section class="vna-section" id="integracii">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Стек</span>
        <h2>Интеграция AI-адаптации с CRM и HRIS</h2>
        <p>Агент должен знать, кто пришёл, на какую роль и в какой филиал — webhook из HRIS запускает агента; статус возвращается в CRM.</p>
      </div>
      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table">
          <thead><tr><th>Система</th><th>Роль в onboarding</th></tr></thead>
          <tbody>
            <tr><td><strong>Huntflow</strong></td><td>Воронка найма → событие «принят на работу»</td></tr>
            <tr><td><strong>Bitrix24 HRM</strong></td><td>Карточка сотрудника, задачи, смарт-процессы, Open Lines</td></tr>
            <tr><td><strong>amoCRM</strong></td><td>CRM для сетей с amo-стеком, webhook при найме</td></tr>
            <tr><td><strong>iSpring / Bitrix24 «Курсы»</strong></td><td>LMS-модули в чек-листе</td></tr>
            <tr><td><strong>Telegram / VK</strong></td><td>Канал для полевых сотрудников</td></tr>
            <tr><td><strong>1С:ЗУП</strong></td><td>Учёт персонала через API/коннектор</td></tr>
            <tr><td><strong>Confluence / Google Drive</strong></td><td>Источники для RAG-базы знаний</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="arhitektura">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Архитектура</span>
        <h2>Архитектура решения: от базы знаний до дашборда</h2>
      </div>
      <div class="vna-arch-flow nero-ai-reveal" aria-label="Схема архитектуры">
        <span>HRIS webhook</span><span class="arr">→</span>
        <span>Оркестратор</span><span class="arr">→</span>
        <span>RAG</span><span class="arr">→</span>
        <span>Канал общения</span><span class="arr">→</span>
        <span>Дашборд HR</span>
      </div>
      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card"><h3>152-ФЗ и ПДн сотрудников</h3><ul>
          <li>YandexGPT / GigaChat — данные в контуре РФ</li>
          <li>On-prem для строгих политик</li>
          <li>Маскирование ФИО при облачных API</li>
          <li>RBAC в RAG: новичок видит только документы своей роли</li>
        </ul></div>
        <div class="vna-card"><h3>Модули решения <?php echo esc_html($brand); ?></h3><ul>
          <li>Онбординг-оркестратор (state machine)</li>
          <li>RAG с цитированием источника</li>
          <li>Эскалация и human-in-the-loop</li>
          <li>Дашборд HR/руководителя + NPS 7/30/90</li>
          <li>Админка для HR без программиста</li>
        </ul></div>
      </div>
    </div>
  </section>

  <section class="vna-section" id="kpi">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Метрики</span>
        <h2>KPI onboarding: time-to-productivity, текучесть и NPS новичка</h2>
        <p>Измеряйте до и после внедрения — без KPI ai адаптация сотрудников остаётся «ещё одним пилотом».</p>
      </div>
      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table">
          <thead><tr><th>KPI</th><th>Что показывает</th><th>Ориентир</th></tr></thead>
          <tbody>
            <tr><td>Time-to-productivity</td><td>Дней до первой продуктивной задачи</td><td>Кейс Открытой Линии: ×2 быстрее</td></tr>
            <tr><td>90-day turnover</td><td>% ухода в первые 90 дней</td><td>Медиана 3,4%; CC до 14%</td></tr>
            <tr><td>NPS новичка</td><td>Удовлетворённость onboarding</td><td>Опросы на 7/30/90 день</td></tr>
            <tr><td>% чек-листа</td><td>Полнота прохождения шагов</td><td>Цель: 95%+ без просрочек</td></tr>
            <tr><td>Обращения к HR</td><td>Снижение рутины</td><td>−40% в кейсе Открытой Линии</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vna-flags nero-ai-reveal">
        <div class="vna-flag">2+ просроченных шага в чек-листе</div>
        <div class="vna-flag">3+ одинаковых вопроса — пробел в регламенте</div>
        <div class="vna-flag">Негатив в опросе NPS на 7/30/90 день</div>
        <div class="vna-flag">Молчание: не открывает материалы, не проходит квизы</div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="keisy">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Кейсы</span>
        <h2>Кейсы и примеры внедрения AI-адаптации</h2>
      </div>
      <div class="vna-case-grid nero-ai-reveal">
        <div class="vna-case-card"><div class="vna-case-tag">Якорный кейс</div><h3>«Открытая Линия»</h3><p>Oline Наставник на GPT + ML: адаптация <strong>×2</strong>, HR <strong>−40%</strong> нагрузки.</p></div>
        <div class="vna-case-card"><div class="vna-case-tag">RAG</div><h3>Ресторанный холдинг</h3><p>HR-бот на RAG с ролевой изоляцией — ответы со ссылкой на документ, аналитика запросов.</p></div>
        <div class="vna-case-card"><div class="vna-case-tag">Обучение</div><h3>«Купер» + Cleverbots</h3><p>Голосовые AI-тренажёры в треках обучения для линейного персонала в доставке.</p></div>
      </div>
      <div class="vna-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="vna-table">
          <thead><tr><th>Решение</th><th>Что делает</th><th>Чего не делает</th></tr></thead>
          <tbody>
            <tr><td>LMS (Поток, iSpring)</td><td>Курсы, треки, геймификация</td><td>Q&A по регламентам, дашборд рисков</td></tr>
            <tr><td>Чат-бот FAQ</td><td>Ответы на типовые вопросы</td><td>Чек-лист, эскалация, KPI</td></tr>
            <tr><td>HRIS (Bitrix24 HRM)</td><td>Карточка, задачи, процессы</td><td>Интеллектуальные ответы 24/7</td></tr>
            <tr><td><strong>AI-агент адаптации</strong></td><td>Оркестрация + RAG + контроль</td><td>Замена HR и наставников</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="vna-section" id="ceny">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Стоимость</span>
        <h2>Стоимость внедрения AI-агента адаптации</h2>
      </div>
      <div class="vna-card nero-ai-reveal" style="text-align:center;max-width:720px;margin:0 auto;">
        <span class="vna-price-band">120–350 тыс. ₽</span>
        <h3>Фокусный MVP</h3>
        <p>1–2 роли · Telegram или Bitrix24 · RAG на регламентах · чек-лист 30/60/90 · дашборд рисков · пилот на 10–20 новичках.</p>
        <p style="margin-top:16px;font-size:14px;">ROI: −40% нагрузки HR, ×2 time-to-productivity, снижение 90-day turnover. Ниже turnkey-рынка 1,5–4 млн ₽ у крупных интеграторов.</p>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="etapy">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Внедрение</span>
        <h2>Этапы внедрения под ключ</h2>
        <p><strong>Срок:</strong> 4–8 недель. <strong>Сложность:</strong> 6/10.</p>
      </div>
      <div class="vna-timeline nero-ai-reveal">
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Дни 1–5: Аудит</h3><p>Карта адаптации по 2–3 ролям; список систем; KPI «как сейчас».</p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Дни 6–20: Настройка</h3><p>RAG, ролевые чек-листы, правила эскалации; HR редактирует БЗ без программиста.</p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Дни 21–35: Пилот</h3><p>10–20 новичков; калибровка промптов; human-in-the-loop.</p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Дни 36–56: Передача</h3><p>Runbook, обучение HR-админа, <strong>30 дней warranty</strong>.</p></div>
      </div>
    </div>
  </section>

  <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie-hr">
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">HR-админу проще сопровождать агента, если команда понимает основы</p>
      <p class="ym-cta-block__sub">Перед пилотом полезно разобраться в RAG, чек-листах и human-in-the-loop — посмотрите <?php if ($secondary_cta_link) : ?><a href="<?php echo esc_url($secondary_cta_link); ?>" class="ym-link ym-link--accent"<?php echo $secondary_cta_attrs; ?>>обучение по внедрению AI в бизнес-процессы</a><?php else : ?>обучение по внедрению AI в бизнес-процессы<?php endif; ?>. Это ускоряет приёмку на этапе «без программиста на стороне клиента».</p>
    </div>
  </aside>

  <section class="vna-section" id="karta-adaptacii">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Лид-магнит</span>
        <h2>Карта адаптации сотрудника — лид-магнит</h2>
        <p>Шаблон 30/60/90 по ролям: что должен знать и уметь новичок в каждый период.</p>
      </div>
      <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-karta-adaptacii">
        <div class="ym-cta-block__icon" aria-hidden="true">🗺️</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Скачайте «Карту адаптации сотрудника»</p>
          <p class="ym-cta-block__sub">Шаблон 30/60/90 по ролям: чек-лист, контрольные точки руководителя, KPI успешной адаптации. Заполните до аудита — мы покажем, как AI-агент «оживляет» карту в дашборде.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Получить карту адаптации</a>
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost"<?php echo $primary_cta_attrs; ?>>Проверить onboarding</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">FAQ</span>
        <h2>FAQ по AI-адаптации сотрудников</h2>
      </div>
      <div class="vna-faq nero-ai-reveal">
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить ai адаптацию сотрудников?</div><div class="vna-faq-a"><p>Аудит onboarding → оцифровка регламентов в RAG → чек-листы по ролям → интеграция с HRIS → пилот на 10–20 новичках → масштабирование. <?php echo esc_html($brand); ?> ведёт все этапы под ключ.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит ai адаптация сотрудников?</div><div class="vna-faq-a"><p>Ориентир <strong>120–350 тыс. ₽</strong> за MVP (1–2 роли, Telegram/Bitrix24, RAG, чек-лист, дашборд). Расширенные проекты — по смете после аудита.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Подходит ли для малого бизнеса?</div><div class="vna-faq-a"><p>Да. MVP на одной роли и Telegram — без корпоративного портала. Критично: повторяемый onboarding и хотя бы 5–10 новичков в квартал.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Нужен ли программист для интеграции?</div><div class="vna-faq-a"><p>На этапе сопровождения — нет: HR редактирует чек-листы и БЗ в админке. Первичная интеграция (webhook, CRM) — на стороне <?php echo esc_html($brand); ?>.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Как защищаются персональные данные сотрудников?</div><div class="vna-faq-a"><p>152-ФЗ: YandexGPT/GigaChat в контуре РФ, on-prem, маскирование ПДн, RBAC в RAG, политика логов. Согласие на обработку ПДн — в пакете документов при внедрении.</p></div></div>
      </div>
    </div>
  </section>

  <section class="vna-section" id="cta-final">
    <div class="vna-cnt">
      <div class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal" id="cta-final-block">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Проверить onboarding — следующий шаг</p>
          <p class="ym-cta-block__sub">Аудит процесса, демо дашборда рисков, расчёт ROI. Внедрение под ключ от 120 тыс. ₽, 4–8 недель, warranty 30 дней. <strong>62%</strong> компаний экспериментируют с AI-агентами; HR onboarding — окно раннего входа.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Проверить onboarding</a>
        </div>
      </div>
    </div>
  </section>

<?php if ($ad_banner_url && $ad_banner_image) : ?>
  <div class="vna-cnt" style="padding-bottom:48px;text-align:center;">
    <a href="<?php echo esc_url($ad_banner_url); ?>" target="_blank" rel="noopener noreferrer">
      <img src="<?php echo esc_url($ad_banner_image); ?>" width="970" height="90" alt="<?php echo esc_attr($ad_banner_alt); ?>" loading="lazy" decoding="async" style="max-width:100%;height:auto;border-radius:12px;">
    </a>
  </div>
<?php endif; ?>

</div><!-- /.vna-content -->

{php_footer}'''

OUT.parent.mkdir(parents=True, exist_ok=True)
OUT.write_text(content, encoding="utf-8")
OUT_THEME.parent.mkdir(parents=True, exist_ok=True)
OUT_THEME.write_text(content, encoding="utf-8")

size = OUT.stat().st_size
print(f"Written: {OUT} ({size} bytes)")
print(f"Written: {OUT_THEME} ({size} bytes)")

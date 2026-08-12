#!/usr/bin/env python3
"""Generate wordpress-theme/page-ai-kontrol-skriptov.php from handoff fragments."""
import re
from pathlib import Path

ROOT = Path('/workspace')
HANDOFF = ROOT / '.cursor/nero-network-handoff.md'
OUT = ROOT / 'wordpress-theme/page-ai-kontrol-skriptov.php'
AMOCRM = ROOT / 'wordpress/page-vnedrenie-ai-amocrm.php'

handoff = HANDOFF.read_text(encoding='utf-8')
amocrm = AMOCRM.read_text(encoding='utf-8')

def extract_block(marker_start, marker_end=None):
    if marker_end:
        pat = rf'=== {marker_start} ===(.*?)(?:=== {marker_end} ===)'
    else:
        pat = rf'=== {marker_start} ===(.*)'
    m = re.search(pat, handoff, re.DOTALL)
    return m.group(1) if m else ''

alina = extract_block('АЛИНА \\(HERO\\)', 'БОРИС \\(БЛОК СТАТЬИ, НЕ HERO\\)')
hero_m = re.search(r'## HTML hero.*?```html\n(.*?)```\n\n## Чеклист', alina, re.DOTALL)
hero_html = hero_m.group(1).strip() if hero_m else ''

boris_block = extract_block('БОРИС \\(БЛОК СТАТЬИ, НЕ HERO\\)')
boris_m = re.search(
    r'```html\n(<section id="ai-kontrol-skriptov-boris-block.*?</section>)\n```',
    boris_block,
    re.DOTALL,
)
boris_html = boris_m.group(1).strip() if boris_m else ''

# CSS: copy vna content styles from amocrm, rename to aks
css_start = amocrm.index('.vna-content{')
css_end = amocrm.index('</style>', css_start)
css_block = amocrm[css_start:css_end]
css_block = css_block.replace('vna-', 'aks-').replace('--vna-', '--aks-')
css_block = css_block.replace('.vna-content', '.aks-content')

# Add hero-specific page resets before aks-content
page_css_prefix = """
/* Скрыть шапку Kadence */
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

/* Status badges for report table */
.aks-status{display:inline-flex;align-items:center;padding:3px 10px;border-radius:999px;font-size:12px;font-weight:700;}
.aks-status--ok{background:rgba(34,197,94,.15);color:#22c55e;}
.aks-status--warn{background:rgba(245,158,11,.15);color:#f59e0b;}
.aks-status--fail{background:rgba(239,68,68,.15);color:#ef4444;}

.aks-pipeline{display:grid;grid-template-columns:repeat(5,1fr);gap:12px;margin:28px 0;}
.aks-pipeline-step{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px;text-align:center;}
.aks-pipeline-step .num{font-size:11px;font-weight:800;color:var(--aks-accent);letter-spacing:.08em;}
.aks-pipeline-step p{font-size:13px;margin:8px 0 0;color:var(--aks-muted);line-height:1.5;}
@media(max-width:900px){.aks-pipeline{grid-template-columns:1fr 1fr;}}
@media(max-width:500px){.aks-pipeline{grid-template-columns:1fr;}}

.aks-scale-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin:28px 0;}
.aks-scale-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:20px;text-align:center;}
.aks-scale-card strong{display:block;font-size:clamp(22px,3vw,32px);color:var(--aks-heading);font-weight:900;margin-bottom:6px;}
.aks-scale-card span{font-size:13px;color:var(--aks-muted);}
@media(max-width:700px){.aks-scale-grid{grid-template-columns:1fr;}}

.aks-ascii{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.09);border-radius:14px;padding:20px;font-family:ui-monospace,monospace;font-size:13px;line-height:1.6;color:var(--aks-soft);white-space:pre-wrap;margin:24px 0;}

.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-link--accent{color:var(--aks-accent)!important;text-decoration:underline!important;}

.aks-checklist{columns:2;gap:32px;margin:24px 0;}
.aks-checklist h4{font-size:15px;margin:0 0 10px;color:var(--aks-heading);}
.aks-checklist ol{margin:0;padding-left:20px;color:var(--aks-muted);font-size:14px;line-height:1.65;}
.aks-checklist ol li{margin-bottom:4px;}
@media(max-width:768px){.aks-checklist{columns:1;}}

.aks-ad-banner-wrap{max-width:970px;margin:48px auto;padding:0 20px;text-align:center;}
"""

# Add secondary CTA block style if missing
if 'ym-cta-block--secondary' not in css_block:
    pass  # added above

php_header = '''<?php
/**
 * Template Name: AI-контроль скриптов в продажах: внедрение под ключ
 * Description: SEO-лендинг — AI проверяет чаты и звонки по чек-листу, рейтинг нарушений для РОПа. Внедрение под ключ.
 */

$page_seo_title       = 'AI-контроль скриптов продаж: внедрение под ключ';
$page_seo_description = 'AI проверяет чаты и звонки менеджеров по чек-листу, формирует рейтинг нарушений и отчёты для РОПа. Внедрение под ключ, интеграция с CRM. Проверьте 20 диалогов бесплатно.';

add_filter( 'document_title_parts', static function ( array $parts ) use ( $page_seo_title ): array {
	$parts['title'] = $page_seo_title;
	return $parts;
}, 20 );

add_action( 'wp_head', static function () use ( $page_seo_title, $page_seo_description ): void {
	echo '<meta name="description" content="' . esc_attr( $page_seo_description ) . '" />' . "\\n";
	echo '<meta property="og:title" content="' . esc_attr( $page_seo_title ) . '" />' . "\\n";
	echo '<meta property="og:description" content="' . esc_attr( $page_seo_description ) . '" />' . "\\n";
	echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '" />' . "\\n";
	echo '<meta property="og:type" content="article" />' . "\\n";
}, 1 );

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Проблема',     'href' => '#bole'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Этапы',        'href' => '#etapy'],
    ['label' => 'Интеграции',   'href' => '#integracii'],
    ['label' => 'Стоимость',    'href' => '#ceny'],
    ['label' => 'FAQ',          'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить 20 диалогов';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#kak-rabotaet';
$ad_banner_url       = getenv('AD_BANNER_URL') ?: '';
$ad_banner_image     = getenv('AD_BANNER_IMAGE_URL') ?: '';
$ad_banner_alt       = getenv('AD_BANNER_ALT') ?: 'Партнёр';

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

php_mid = '''
</style>

<main id="primary" class="site-main nero-ai-home-page ai-kontrol-skriptov-page" role="main" tabindex="-1">

'''

content_sections = '''
<div class="aks-content">

  <section class="aks-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="aks-cnt nero-ai-container">
      <div class="aks-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="aks-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai контроль скриптов</p>
          <p><strong>Коротко:</strong> AI-контроль скриптов — автоматическая проверка 100% звонков и переписок менеджеров по вашему чек-листу с рейтингом нарушений, цитатами-доказательствами и отчётами для РОПа. Nero Network внедряет решение под ключ: от аудита скрипта до интеграции с CRM и телефонией. <strong>Проверьте 20 диалогов бесплатно</strong> — получите пример отчёта с рейтингом нарушений.</p>
          <p>Менеджеры не соблюдают скрипт, а РОП не может слушать все звонки — это не лень руководителя, а математика масштаба. AI переводит контроль качества из режима «2–5% на глаз» в режим 100% диалогов с объективным рейтингом нарушений.</p>
        </div>
        <div class="aks-intro-kpi" aria-label="Ключевые показатели рынка">
          <div class="aks-kpi-card"><div class="kv">46%</div><div class="kl">продавцов редко получают feedback</div><div class="ks">Salesforce 2026</div></div>
          <div class="aks-kpi-card"><div class="kv">2–5%</div><div class="kl">ручной QA покрывает диалоги</div><div class="ks">Rechka.ai</div></div>
          <div class="aks-kpi-card"><div class="kv">87%</div><div class="kl">организаций уже используют AI</div><div class="ks">Salesforce 2026</div></div>
          <div class="aks-kpi-card"><div class="kv">100%</div><div class="kl">охват при AI-контроле</div><div class="ks">цель внедрения</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="aks-toc-outer">
    <div class="aks-cnt">
      <nav class="aks-toc" aria-label="Оглавление статьи">
        <a href="#bole">Проблема</a>
        <a href="#chto-eto">Что такое</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#dlya-kogo">Для кого</a>
        <a href="#etapy">Этапы</a>
        <a href="#integracii">Интеграции</a>
        <a href="#ceny">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#cheklist">Чек-лист</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="aks-section" id="bole">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">Боль РОПа</span>
        <h2>Менеджеры не соблюдают скрипт — а РОП не успевает слушать все звонки</h2>
        <p>Скрипт продаж лежит в Google Docs, проходит на планёрке — и растворяется в реальности. Руководитель знает, что стандарты «плывут», но физически не может прослушать каждый диалог.</p>
      </div>

      <div class="aks-scale-grid nero-ai-reveal" aria-label="Масштаб проблемы">
        <div class="aks-scale-card"><strong>10 000</strong><span>звонков в день при 50 операторов × 200 звонков</span></div>
        <div class="aks-scale-card"><strong>500</strong><span>записей при выборочной проверке 5%</span></div>
        <div class="aks-scale-card"><strong>1 день</strong><span>супервайзера на прослушивание выборки</span></div>
      </div>

      <div class="aks-card nero-ai-reveal">
        <h3 style="font-size:18px;margin-bottom:14px;">Сколько диалогов реально проверяет РОП</h3>
        <p>Ручной QA в отрасли покрывает <strong>2–5% коммуникаций</strong>. Остальные 95–98% диалогов остаются без контроля. По данным <strong>Salesforce State of Sales 2026</strong>, <strong>46% продавцов редко получают обратную связь</strong> по разговорам с клиентами.</p>
        <p>Когда скрипт не соблюдается, падают конверсия этапов воронки, compliance (152-ФЗ), единый стандарт бренда и скорость обучения. Кейс <strong>SalesAI</strong> в нефтегазовом B2B: после автоматического анализа 100% звонков заявлен <strong>рост конверсии на 15%</strong>.</p>
      </div>

      <div class="aks-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="aks-table" aria-label="Сравнение ручного и AI-контроля">
          <thead><tr><th>Критерий</th><th>Ручной контроль</th><th>AI-контроль скриптов</th></tr></thead>
          <tbody>
            <tr><td>Охват диалогов</td><td>2–5%</td><td>До 100%</td></tr>
            <tr><td>Скорость отчёта</td><td>Дни–недели</td><td>Часы, алерты в реальном времени</td></tr>
            <tr><td>Субъективность</td><td>Высокая</td><td>Единые критерии + цитаты</td></tr>
            <tr><td>Масштабирование</td><td>+1 супервайзер на N операторов</td><td>Один контур на весь отдел</td></tr>
            <tr><td>Доказательная база</td><td>Заметки супервайзера</td><td>Цитата из диалога с таймкодом</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="aks-section aks-section-alt" id="chto-eto">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">Определение</span>
        <h2>Что такое AI-контроль скриптов в переписке и звонках</h2>
        <p>Автоматизированная система оценки качества коммуникаций: звонков, чатов, email и других каналов — по вашему чек-листу, не по абстрактному «качеству разговора».</p>
      </div>

      <div class="aks-pipeline nero-ai-reveal" aria-label="5 шагов AI-контроля">
        <div class="aks-pipeline-step"><div class="num">01</div><p>Забирает записи из телефонии, CRM, мессенджеров</p></div>
        <div class="aks-pipeline-step"><div class="num">02</div><p>Транскрибирует аудио (STT) или анализирует текст</p></div>
        <div class="aks-pipeline-step"><div class="num">03</div><p>Сверяет диалог с чек-листом / скриптом</p></div>
        <div class="aks-pipeline-step"><div class="num">04</div><p>Выставляет score и рейтинг нарушений</p></div>
        <div class="aks-pipeline-step"><div class="num">05</div><p>Формирует отчёты для РОПа и задачи в CRM</p></div>
      </div>

      <div class="aks-grid-3 nero-ai-reveal">
        <div class="aks-card"><h3>Звонки</h3><p>Mango Office, UIS, Sipuni, Zadarma, Calltouch — записи через API/webhook.</p></div>
        <div class="aks-card"><h3>Мессенджеры</h3><p>Telegram, WhatsApp Business API, VK, открытые линии Bitrix24.</p></div>
        <div class="aks-card"><h3>CRM</h3><p>amoCRM, Bitrix24 — чаты и email в карточке сделки в едином контуре.</p></div>
      </div>
    </div>
  </section>

'''

kak_rabotaet = '''
  <section class="aks-section" id="kak-rabotaet">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">Проверка по чек-листу</span>
        <h2>Как AI проверяет диалоги по чек-листу</h2>
        <p>Pipeline: звонок → STT + diarization → LLM-сверка с чек-листом → score 0–100, рейтинг нарушений, алерты в CRM.</p>
      </div>

      <div class="aks-card nero-ai-reveal">
        <h3 style="font-size:18px;margin-bottom:12px;">Типовой чек-лист контроля скрипта</h3>
        <p>Открытие (представление, цель, уведомление о записи) · Discovery (открытые вопросы, квалификация) · Презентация (ценность к потребности) · Возражения · Закрытие (next step с датой) · Compliance · Документация в CRM.</p>
        <p>Система различает <strong>fatal errors</strong> (нет уведомления о записи, грубость, запретные обещания) и <strong>взвешенные навыки</strong> (глубина discovery, качество открытых вопросов).</p>
      </div>

      <div class="aks-sh aks-left" style="margin-top:40px;margin-bottom:24px;">
        <span class="aks-eyebrow">Демо-отчёт</span>
        <h2>Пример фрагмента отчёта</h2>
        <p>Звонок менеджера Ивановой, 12.08.2026, 4:32 — формат с цитатами и статусами.</p>
      </div>

      <div class="aks-table-wrap nero-ai-reveal">
        <table class="aks-table" aria-label="Пример отчёта AI-контроля скриптов">
          <thead>
            <tr><th>Пункт чек-листа</th><th>Статус</th><th>Цитата-доказательство</th></tr>
          </thead>
          <tbody>
            <tr><td>Представление</td><td><span class="aks-status aks-status--ok">✅ Выполнен</span></td><td>«Добрый день, меня зовут Анна, компания Nero Network»</td></tr>
            <tr><td>Уведомление о записи</td><td><span class="aks-status aks-status--fail">❌ Не выполнен</span></td><td>—</td></tr>
            <tr><td>Открытые вопросы (≥2)</td><td><span class="aks-status aks-status--warn">⚠️ Частично</span></td><td>«Расскажите, чем сейчас занимаетесь?» — 1 вопрос</td></tr>
            <tr><td>Next step с датой</td><td><span class="aks-status aks-status--fail">❌ Не выполнен</span></td><td>«Я вам перезвоню» — без даты</td></tr>
            <tr><td>CRM обновлена</td><td><span class="aks-status aks-status--ok">✅ Выполнен</span></td><td>Задача создана в amoCRM</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:16px;text-align:center;color:var(--aks-soft);"><strong>Итоговый score:</strong> 62/100. <strong>Приоритет для РОПа:</strong> уведомление о записи (compliance), фиксация next step.</p>

      <div class="ym-cta-block ym-cta-block--primary" id="cta-demo">
        <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Проверить 20 диалогов — получить такой отчёт</p>
          <p class="ym-cta-block__sub">Подключим выборку ваших звонков и переписок, прогоним через AI-чек-лист и вернём рейтинг нарушений с цитатами из диалогов. Бесплатно, без обязательств по внедрению.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="aks-section aks-section-alt" id="dlya-kogo">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">Сегменты</span>
        <h2>Для кого подходит: отдел продаж, колл-центр, франшиза</h2>
        <p>Критерий не размер, а наличие скрипта, CRM и регулярных диалогов с клиентами.</p>
      </div>
      <div class="aks-grid-3">
        <div class="aks-card nero-ai-reveal">
          <div class="aks-eyebrow">B2B</div>
          <h3>Длинный цикл сделки</h3>
          <p>Соблюдение квалификации на каждом касании, фиксация next step, единый стандарт презентации ценности. Process Mining тысяч диалогов → корректировка скрипта на данных.</p>
        </div>
        <div class="aks-card nero-ai-reveal nero-ai-delay-1">
          <div class="aks-eyebrow">Колл-центр</div>
          <h3>Высокий поток обращений</h3>
          <p>100% охват при 200+ звонках в день. LLM-подход понимает смысл, а не только ключевые слова — фильтр «только значимые диалоги».</p>
        </div>
        <div class="aks-card nero-ai-reveal nero-ai-delay-2">
          <div class="aks-eyebrow">Франшиза</div>
          <h3>Единый стандарт скрипта</h3>
          <p>Единый рейтинг нарушений по всем филиалам. Пилот на 20 диалогах показывает картину без найма супервайзера — даже для команд 3–5 менеджеров.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="aks-section" id="etapy">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">Внедрение под ключ</span>
        <h2>Внедрение AI-контроля скриптов: этапы и сроки</h2>
        <p>Полное внедрение — 2–4 недели от аудита до production. На стороне клиента программист не нужен.</p>
      </div>
      <div class="aks-timeline nero-ai-reveal">
        <div class="aks-tl-item">
          <div class="aks-tl-dot"></div>
          <h3>Аудит скриптов и чек-листа <span style="color:var(--aks-muted);font-weight:600;">(1–2 дня)</span></h3>
          <p>Анализ скриптов, карта каналов, юридическая база (152-ФЗ), сбор 20–50 записей для калибровки.</p>
        </div>
        <div class="aks-tl-item">
          <div class="aks-tl-dot"></div>
          <h3>Подключение CRM и телефонии <span style="color:var(--aks-muted);font-weight:600;">(3–7 дней)</span></h3>
          <p>Webhook/API → STT → LLM-анализ → CRM. amoCRM, Bitrix24, Mango Office, UIS, Sipuni, Calltouch.</p>
        </div>
        <div class="aks-tl-item">
          <div class="aks-tl-dot"></div>
          <h3>Обучение РОПа и пилот на 20 диалогах <span style="color:var(--aks-muted);font-weight:600;">(3–7 дней)</span></h3>
          <p>Калибровка промптов, замер false positive rate, ручная валидация выборки РОПом, корректировка fatal errors.</p>
        </div>
        <div class="aks-tl-item">
          <div class="aks-tl-dot"></div>
          <h3>Запуск отчётов и корректировка скрипта <span style="color:var(--aks-muted);font-weight:600;">(1–2 недели)</span></h3>
          <p>Дашборд РОПа, еженедельный разбор диалогов, Process Mining для обновления скрипта по конверсии.</p>
        </div>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">РОП хочет понимать AI до старта пилота?</p>
          <p class="ym-cta-block__sub">Перед внедрением AI-контроля скриптов полезно разобраться в промптах, human-in-the-loop и настройке чек-листов под воронку — это ускоряет калибровку на 20 диалогах. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <section class="aks-section aks-section-alt" id="integracii">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">Интеграции</span>
        <h2>Интеграция с CRM и телефонией</h2>
        <p>Без связки с CRM оценка диалога остаётся «красивым PDF», а не рабочим инструментом.</p>
      </div>
      <div class="aks-grid-2 nero-ai-reveal">
        <div class="aks-card">
          <h3>amoCRM и Bitrix24</h3>
          <p>Звонки и переписка в карточке → AI-оценка → поле score, комментарий, задача. Локальные LLM (GigaChat, YandexGPT) для 152-ФЗ.</p>
        </div>
        <div class="aks-card">
          <h3>Телефония</h3>
          <p>Mango Office, UIS, Sipuni, Calltouch — записи через API. STT → LLM → результат в CRM без программиста на стороне клиента.</p>
        </div>
      </div>
      <div class="aks-ascii nero-ai-reveal" aria-label="Схема интеграции">Телефония / мессенджеры / CRM
        ↓
   Модуль приёма данных
        ↓
   STT + diarization
        ↓
   LLM-оценка по чек-листу (JSON schema)
        ↓
   CRM (поля, задачи, комментарии)
        ↓
   Дашборд РОПа + алерты</div>
      <!-- INTERNAL-LINKS:INSERT -->
    </div>
  </section>

  <section class="aks-section" id="ceny">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">Цена и ROI</span>
        <h2>Сколько стоит и какой ROI от контроля скриптов</h2>
        <p>Ориентир чека Nero Network: <strong>200–650 тыс. ₽</strong> — зависит от каналов, объёма диалогов и глубины интеграции.</p>
      </div>
      <div class="aks-table-wrap nero-ai-reveal">
        <table class="aks-table" aria-label="Компоненты стоимости внедрения">
          <thead><tr><th>Компонент</th><th>Что входит</th></tr></thead>
          <tbody>
            <tr><td>Аудит и чек-лист</td><td>15–25 критериев, fatal errors, веса</td></tr>
            <tr><td>Интеграции</td><td>CRM + телефония + мессенджеры</td></tr>
            <tr><td>STT + LLM</td><td>YandexGPT/GigaChat (152-ФЗ) или согласованный контур</td></tr>
            <tr><td>Дашборд и алерты</td><td>Рейтинг, отчёты, утренний брифинг</td></tr>
            <tr><td>Пилот и калибровка</td><td>20+ диалогов, снижение false positives</td></tr>
            <tr><td>Обучение РОПа</td><td>1–2 сессии + документация</td></tr>
          </tbody>
        </table>
      </div>
      <div class="aks-table-wrap nero-ai-reveal" style="margin-top:24px;">
        <table class="aks-table" aria-label="KPI после внедрения">
          <thead><tr><th>KPI</th><th>До внедрения</th><th>Цель после</th></tr></thead>
          <tbody>
            <tr><td>Охват проверенных диалогов</td><td>2–5%</td><td>100%</td></tr>
            <tr><td>% соблюдения чек-листа</td><td>Неизвестен</td><td>+20–30% за 2–3 мес.</td></tr>
            <tr><td>Время реакции на нарушение</td><td>Дни</td><td>Часы</td></tr>
            <tr><td>False positive rate AI</td><td>—</td><td>&lt;10% после калибровки</td></tr>
          </tbody>
        </table>
      </div>
      <div class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Узнайте стоимость для вашего отдела</p>
          <p class="ym-cta-block__sub">Ориентир 200–650 тыс. ₽ за внедрение под ключ. На бесплатной проверке 20 диалогов дадим оценку каналов, CRM-совместимости и ROI — без обязательств.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Узнать стоимость для вашего отдела</a>
            <a href="#cheklist" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Скачать чек-лист качества</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="aks-section aks-section-alt" id="keisy">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">Кейсы</span>
        <h2>Кейсы и примеры внедрения</h2>
      </div>
      <div class="aks-table-wrap nero-ai-reveal">
        <table class="aks-table" aria-label="Кейсы до и после">
          <thead><tr><th>Кейс</th><th>Что сделали</th><th>Результат</th></tr></thead>
          <tbody>
            <tr><td>SalesAI, нефтегаз B2B</td><td>100% звонков, Process Mining</td><td>+15% конверсии</td></tr>
            <tr><td>NeuralOps, Bitrix24</td><td>AI-РОП, 1000+ лидов</td><td>~3000 звонков, ~600 задач</td></tr>
            <tr><td>EdUnit ScriptCheck</td><td>13 пунктов, 7+ филиалов</td><td>Контроль каждого звонка</td></tr>
            <tr><td>Яндекс YaCalls</td><td>LLM вместо 5% выборки</td><td>Точность &gt;90%, 100% охват</td></tr>
          </tbody>
        </table>
      </div>
      <div class="aks-card nero-ai-reveal" style="margin-top:28px;">
        <h3 style="font-size:18px;margin-bottom:12px;">Типовые ошибки, которые выявляет AI</h3>
        <ul>
          <li>Нет уведомления о записи — compliance, штрафы по 152-ФЗ</li>
          <li>«Я вам перезвоню» без даты — потеря сделки</li>
          <li>Монолог вместо discovery — менеджер говорит 80% времени</li>
          <li>Игнорирование возражения «дорого»</li>
          <li>Незаполненная CRM — сделка без следующего шага</li>
          <li>Запретные обещания и презентация каталога вместо боли клиента</li>
        </ul>
      </div>
    </div>
  </section>

  <section class="aks-section" id="cheklist">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">Лид-магнит</span>
        <h2>Чек-лист качества продаж — 18 пунктов</h2>
        <p>Сверьте свой отдел с контрольным списком скрипта продаж.</p>
      </div>
      <div class="aks-checklist nero-ai-reveal">
        <div><h4>Открытие (4)</h4><ol><li>Представление: имя + компания</li><li>Цель звонка</li><li>Уведомление о записи</li><li>Позитивный тон, удобство времени</li></ol></div>
        <div><h4>Discovery (4)</h4><ol><li>≥2 открытых вопросов</li><li>Выявлена боль</li><li>Квалификация (бюджет, сроки, ЛПР)</li><li>Резюме услышанного</li></ol></div>
        <div><h4>Презентация и возражения (4)</h4><ol><li>Ценность к потребности</li><li>Возражение отработано</li><li>Нет запретных формулировок</li><li>Не перебивает клиента</li></ol></div>
        <div><h4>Закрытие и CRM (6)</h4><ol><li>Next step с датой</li><li>Контакты подтверждены</li><li>Клиент понял шаг</li><li>CRM обновлена в день контакта</li><li>Задача follow-up</li><li>Итог в карточке сделки</li></ol></div>
      </div>
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Проверьте 20 диалогов бесплатно</p>
          <p class="ym-cta-block__sub">Получите пример отчёта с рейтингом нарушений, цитатами из ваших звонков и чатов — и поймёте, где отдел теряет конверсию. Пилот 3–7 дней, без подписания договора.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Проверить 20 диалогов бесплатно</a>
        </div>
      </div>
    </div>
  </section>

  <section class="aks-section aks-section-alt" id="faq">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">FAQ</span>
        <h2>FAQ по AI-контролю скриптов</h2>
      </div>
      <div class="aks-faq nero-ai-reveal">
        <div class="aks-faq-item"><div class="aks-faq-q" tabindex="0" role="button" aria-expanded="false">Нужно ли согласие клиента на запись и анализ?</div><div class="aks-faq-a"><p>Да. Запись — обработка ПДн по 152-ФЗ. Обязательно уведомление в начале звонка. С 01.09.2025 согласие на ПДн — отдельный документ. Nero Network закладывает compliance с первого дня.</p></div></div>
        <div class="aks-faq-item"><div class="aks-faq-q" tabindex="0" role="button" aria-expanded="false">Заменяет ли AI живого РОПа?</div><div class="aks-faq-a"><p>Нет. AI сигнализирует — РОП принимает решения. 87% продавцов отмечают снижение стресса при прозрачных критериях оценки (Salesforce 2026).</p></div></div>
        <div class="aks-faq-item"><div class="aks-faq-q" tabindex="0" role="button" aria-expanded="false">Как быстро виден результат?</div><div class="aks-faq-a"><p>Пилот 20 диалогов — 3–7 дней. Полное внедрение — 2–4 недели. Рост % соблюдения скрипта — 2–3 месяца (+20–30%). Влияние на конверсию — 1–2 квартала после Process Mining.</p></div></div>
        <div class="aks-faq-item"><div class="aks-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли настроить разные скрипты для отделов?</div><div class="aks-faq-a"><p>Да: inbound/outbound, B2B/B2C, новые/опытные менеджеры, филиалы — отдельные чек-листы с fatal errors и весами.</p></div></div>
        <div class="aks-faq-item"><div class="aks-faq-q" tabindex="0" role="button" aria-expanded="false">Чем Nero Network отличается от Bitrix24 CoPilot?</div><div class="aks-faq-a"><p>CoPilot — ограниченные квоты и слабая кастомизация. Nero Network: кастомный чек-лист, омниканал, автозадачи в CRM, калибровка false positives, 152-ФЗ.</p></div></div>
        <div class="aks-faq-item"><div class="aks-faq-q" tabindex="0" role="button" aria-expanded="false">Чем отличается от Oki-Toki и Rechka.ai?</div><div class="aks-faq-a"><p>Oki-Toki — keyword-based без глубокого LLM. Rechka.ai — фокус на звонки. Nero Network — омниканал + CRM + compliance под ключ.</p></div></div>
        <div class="aks-faq-item"><div class="aks-faq-q" tabindex="0" role="button" aria-expanded="false">Работает ли без программиста на стороне клиента?</div><div class="aks-faq-a"><p>Да. Интеграцию выполняет Nero Network. Клиент предоставляет доступ к API, скрипты и 20–50 записей для калибровки.</p></div></div>
        <div class="aks-faq-item"><div class="aks-faq-q" tabindex="0" role="button" aria-expanded="false">Что такое ai контроль скриптов простыми словами?</div><div class="aks-faq-a"><p>Автоматическая проверка каждого звонка и чата по вашему списку правил — с оценкой, цитатами и отчётом для руководителя вместо ручного прослушивания 5% звонков.</p></div></div>
      </div>
    </div>
  </section>

  <section class="aks-section" id="sravnenie">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">Сравнение</span>
        <h2>Сравнение решений: что выбрать</h2>
      </div>
      <div class="aks-compare-wrap nero-ai-reveal">
        <table class="aks-compare" aria-label="Сравнение решений контроля скриптов">
          <thead><tr><th>Критерий</th><th>Ручной QA</th><th>Oki-Toki</th><th>Rechka.ai</th><th>Bitrix CoPilot</th><th>Gong</th><th>Nero Network</th></tr></thead>
          <tbody>
            <tr><td>Охват</td><td>2–5%</td><td>Высокий</td><td>Высокий</td><td>Средний</td><td>Высокий</td><td class="aks-good">До 100%</td></tr>
            <tr><td>LLM-смысл</td><td>Человек</td><td>Нет</td><td>Да</td><td>Частично</td><td>Да</td><td class="aks-good">Да</td></tr>
            <tr><td>Омниканал</td><td>Да</td><td>Звонки</td><td>Звонки</td><td>B24</td><td>Звонки</td><td class="aks-good">Звонки+чаты</td></tr>
            <tr><td>Под ключ</td><td>—</td><td>Нет</td><td>Частично</td><td>Встроен</td><td>Нет</td><td class="aks-good">Да</td></tr>
            <tr><td>152-ФЗ</td><td>—</td><td>РФ</td><td>РФ</td><td>РФ</td><td>Зарубеж</td><td class="aks-good">РФ</td></tr>
            <tr><td>Цена (ориентир)</td><td>FTE 80–120к/мес</td><td>Телефония+QA</td><td>от 60к</td><td>В B24</td><td>$20k+/год</td><td class="aks-good">200–650к ₽</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="aks-section aks-section-alt" id="itog">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">Итог</span>
        <h2>100% диалогов с объективным рейтингом нарушений</h2>
      </div>
      <div class="aks-card nero-ai-reveal">
        <p><strong>Ai контроль скриптов</strong> переводит контроль качества из режима «2–5% на глаз» в режим 100% диалогов. Nero Network внедряет под ключ: аудит → чек-лист → интеграция → пилот на 20 диалогах → дашборд РОПа → Process Mining.</p>
        <p>Омниканал, 152-ФЗ, калибровка AI, цитаты-доказательства — без «магического 100%» и без армии супервайзеров. <strong>Проверьте 20 диалогов бесплатно</strong> — получите пример отчёта и поймёте, где отдел теряет конверсию.</p>
      </div>
    </div>
  </section>

<?php if ($ad_banner_url && $ad_banner_image) : ?>
  <div class="aks-ad-banner-wrap">
    <a href="<?php echo esc_url($ad_banner_url); ?>" target="_blank" rel="noopener noreferrer">
      <img src="<?php echo esc_url($ad_banner_image); ?>" width="970" height="90" alt="<?php echo esc_attr($ad_banner_alt); ?>" loading="lazy" decoding="async" style="max-width:100%;height:auto;border-radius:12px;">
    </a>
  </div>
<?php endif; ?>

</div><!-- /.aks-content -->

<!-- SCHEMA-MARKUP:INSERT -->

<script>
(function(){
  document.querySelectorAll('.aks-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.aks-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.aks-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.aks-faq-q');
        if (q) q.setAttribute('aria-expanded','false');
      });
      if (!isOpen) {
        item.classList.add('open');
        btn.setAttribute('aria-expanded','true');
      }
    });
    btn.addEventListener('keydown', function(e){
      if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); btn.click(); }
    });
  });
})();
</script>

'''

php_footer = '''
</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
'''

full = php_header + page_css_prefix + css_block + php_mid + hero_html + content_sections + boris_html + kak_rabotaet + php_footer

OUT.write_text(full, encoding='utf-8')
print(f'Written {OUT} ({len(full)} bytes)')

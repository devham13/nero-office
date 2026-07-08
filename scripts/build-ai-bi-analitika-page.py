#!/usr/bin/env python3
"""Build page-ai-bi-analitika.php from handoff fragments."""
from __future__ import annotations

import re
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
HANDOFF = (ROOT / ".cursor/nero-network-handoff.md").read_text(encoding="utf-8")
OUT = ROOT / "wordpress-theme/page-ai-bi-analitika.php"

alina = re.search(
    r"=== АЛИНА \(HERO\) ===.*?```html\n(.*?)```\n\n## Проверка новизны",
    HANDOFF,
    re.DOTALL,
).group(1).strip()

boris = re.search(
    r"=== БОРИС \(БЛОК СТАТЬИ, НЕ HERO\) ===.*?```html\n(.*?)```\n\n## Чеклист отличий",
    HANDOFF,
    re.DOTALL,
).group(1).strip()

hero = alina.replace("{brand}", "<?php echo esc_html($brand); ?>")
hero = hero.replace(
    'href="${PRIMARY_CTA_URL}">${PRIMARY_CTA_LABEL}',
    'href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?>',
)

# Boris CTA secondary placeholders for etapy block (Artur)
cta_obuchenie = """<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать AI в BI до старта проекта?</p>
    <p class="ym-cta-block__sub">На этапе масштабирования важно, чтобы аналитики и руководители говорили на одном языке с ассистентом. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a> — это ускоряет пилот и снижает сопротивление при внедрении.</p>
  </div>
</aside>"""

cta_stoimost = """<div class="ym-cta-block ym-cta-block--primary" id="cta-stoimost">
  <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Узнайте стоимость AI BI-аналитики для вашей компании</p>
    <p class="ym-cta-block__sub">Разберём источники данных, ad-hoc очередь и подберём формат пилота или внедрения под ключ в вилке 300 тыс.–2 млн ₽.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Оценить BI с AI</a>
  </div>
</div>"""

CONTENT = r'''
<div class="abi-content">

  <section class="abi-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="abi-cnt">
      <div class="abi-intro-grid nero-ai-reveal">
        <div class="abi-intro-text">
          <p class="abi-eyebrow">Лонгрид · ai bi аналитика</p>
          <p>Руководитель задаёт вопрос на человеческом языке — «почему упала маржа в регионе X за квартал?» — и получает цифру, график и вывод за минуты, а не через очередь к аналитику. <strong>AI BI-аналитика</strong> — диалоговый слой поверх хранилища данных, семантического слоя и BI-платформы.</p>
          <p><strong>Коротко:</strong> AI BI-аналитика под ключ — внедрение governed-ассистента, который понимает бизнес-метрики, работает через семантический слой и снимает ad-hoc нагрузку с аналитиков. Ориентир проекта для среднего бизнеса: 300 тыс.–2 млн ₽.</p>
        </div>
        <div class="abi-intro-kpi" aria-label="Ключевые метрики AI BI">
          <div class="abi-kpi-card"><div class="kv">80%+</div><div class="kl">BI с элементами ИИ в 2026</div><div class="ks">прогноз Навикон</div></div>
          <div class="abi-kpi-card"><div class="kv">30–40%</div><div class="kl">ad-hoc без аналитика</div><div class="ks">ориентир MWS</div></div>
          <div class="abi-kpi-card"><div class="kv">300k–2M ₽</div><div class="kl">вилка внедрения</div><div class="ks">mid-market</div></div>
          <div class="abi-kpi-card"><div class="kv">минуты</div><div class="kl">вместо 1–2 дней</div><div class="ks">время ответа</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="abi-toc-outer">
    <div class="abi-cnt">
      <nav class="abi-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#chto-takoe">Что это</a>
        <a href="#zadachi">Задачи</a>
        <a href="#etapy">Внедрение</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#integracii">Интеграции</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
        <a href="#ocenit-bi">Оценить BI</a>
      </nav>
    </div>
  </div>

  <section class="abi-section" id="chto-takoe">
    <div class="abi-cnt">
      <div class="abi-sh">
        <span class="abi-eyebrow">Определение</span>
        <h2>Что такое AI BI-аналитика и чем отличается от обычного BI</h2>
        <p>AI BI-аналитика — сочетание классической бизнес-аналитики (DWH, витрины, дашборды) и LLM-ассистента, который переводит вопросы руководителей в запросы к данным, визуализации и текстовые инсайты.</p>
      </div>
      <div class="abi-table-wrap nero-ai-reveal">
        <table class="abi-table">
          <thead><tr><th>Подход</th><th>Что даёт</th><th>Ограничение</th></tr></thead>
          <tbody>
            <tr><td>Классический BI</td><td>Дашборды, KPI, drill-down</td><td>Нешаблонный вопрос = мини-проект у аналитика</td></tr>
            <tr><td>Голый ChatGPT / text-to-SQL</td><td>Быстрый прототип</td><td>Галлюцинации, нет RLS, нет единых определений метрик</td></tr>
            <tr><td><strong>AI BI-аналитика</strong></td><td>Вопрос на языке бизнеса → governed-ответ</td><td>Требует витрин, глоссария и настройки доступов</td></tr>
          </tbody>
        </table>
      </div>
      <div class="abi-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="abi-card">
          <h3>Как AI-помощник отвечает на вопросы по данным без очереди к аналитику</h3>
          <p>CFO формулирует ad-hoc запрос. Система классифицирует intent, обращается к <strong>семантическому API</strong> (не raw SQL), формирует визуализацию и текстовый вывод с отсылкой к срезам данных, логирует запрос для аудита.</p>
        </div>
        <div class="abi-card abi-delay-1">
          <h3>Natural language query и управленческие отчёты в 2026</h3>
          <p>DataLens «Нейроаналитик», Power BI Copilot, PIX BI AI-Ассистент — NLQ встроен в привычные интерфейсы. Enterprise AI смещается от поиска к анализу и принятию решений.</p>
        </div>
      </div>
      <!-- INTERNAL-LINKS:INSERT -->
    </div>
  </section>

  <section class="abi-section abi-section-alt" id="zadachi">
    <div class="abi-cnt">
      <div class="abi-sh abi-left">
        <span class="abi-eyebrow">Оффер</span>
        <h2>Какие задачи решает AI-помощник для BI и управленческих отчётов</h2>
        <p>Главная боль: руководители ждут ответы днями, аналитики тонут в повторяющихся ad-hoc запросах. AI-ассистент превращает управленческую отчётность в <strong>единую точку входа</strong>.</p>
      </div>
      <div class="abi-grid-2 nero-ai-reveal">
        <div class="abi-card">
          <h3>Что делает AI</h3>
          <ul>
            <li>Понимает бизнес-формулировки: маржа, план-факт, DSO</li>
            <li>Подбирает метрики через семантический слой</li>
            <li>Объясняет отклонения план-факт</li>
            <li>Находит аномалии во временных рядах</li>
            <li>Отвечает на follow-up в контексте диалога</li>
          </ul>
        </div>
        <div class="abi-card abi-delay-1">
          <h3>Что остаётся за человеком</h3>
          <ul>
            <li>Утверждение определений метрик и формул</li>
            <li>Сертификация отчётов для совета директоров</li>
            <li>Разбор спорных ответов и дообучение глоссария</li>
            <li>Юридически значимая отчётность</li>
          </ul>
        </div>
      </div>
      <div class="abi-chips nero-ai-reveal" aria-label="Типовые CFO-вопросы">
        <span class="abi-chip">Маржа Сибирь Q1</span>
        <span class="abi-chip">План-факт выручки</span>
        <span class="abi-chip">DSO топ-10</span>
        <span class="abi-chip">Конверсия воронки</span>
        <span class="abi-chip">EBITDA сводка</span>
      </div>
      <div class="abi-card abi-card--pulse nero-ai-reveal" style="margin-top:24px;">
        <h3>Поиск аномалий и автоматические выводы</h3>
        <p>Insight-agent интерпретирует метрики: отклонение от плана, выброс в CPC, падение конверсии. Система подсвечивает, где копнуть глубже, и формулирует гипотезы строго на основе цифр — без «додумывания» фактов.</p>
      </div>
    </div>
  </section>

''' + boris + r'''

  <section class="abi-section" id="etapy">
    <div class="abi-cnt">
      <div class="abi-sh abi-left">
        <span class="abi-eyebrow">Под ключ</span>
        <h2>Внедрение AI BI-аналитики под ключ: этапы и сроки</h2>
        <p>Проектная работа от аудита данных до обученного ассистента с RLS и интеграцией в ваш BI-стек.</p>
      </div>
      <div class="abi-table-wrap nero-ai-reveal">
        <table class="abi-table">
          <thead><tr><th>Фаза</th><th>Срок</th><th>Содержание</th><th>Бюджет</th></tr></thead>
          <tbody>
            <tr><td><strong>0. Аудит</strong></td><td>1–2 нед.</td><td>Карта ad-hoc, источники, качество данных</td><td>80–150 тыс. ₽</td></tr>
            <tr><td><strong>1. Пилот</strong></td><td>3–5 нед.</td><td>Витрина, 10–20 метрик, AI на 1 датасете</td><td>300–600 тыс. ₽</td></tr>
            <tr><td><strong>2. Масштаб</strong></td><td>4–8 нед.</td><td>RLS, Telegram, мультиагенты, board-ready метрики</td><td>800 тыс.–2 млн ₽</td></tr>
          </tbody>
        </table>
      </div>
      <div class="abi-timeline nero-ai-reveal" style="margin-top:32px;">
        <div class="abi-tl-item"><div class="abi-tl-dot"></div><h3>Аудит данных и источников (DWH, CRM, ERP)</h3><p>Справочники, фактовые таблицы, плановые показатели, матрица ролей, топ-20 ad-hoc запросов — будущий сценарный каталог ассистента.</p></div>
        <div class="abi-tl-item"><div class="abi-tl-dot"></div><h3>Пилот на одном дашборде или отделе</h3><p>10–15 сертифицированных метрик. Стек: DWH → семантика → BI → LLM-оркестрация → чат-UI. Измеримый ROI — время ответа и доля запросов без аналитика.</p></div>
        <div class="abi-tl-item"><div class="abi-tl-dot"></div><h3>Масштабирование и обучение команды</h3><p>Мультиагентная архитектура, интеграции CRM/ERP, Telegram, MCP-коннекторы. Аналитики переходят от SQL к архитекторам метрик и governance.</p></div>
      </div>
''' + cta_obuchenie + r'''
    </div>
  </section>

  <section class="abi-section abi-section-alt" id="stoimost">
    <div class="abi-cnt">
      <div class="abi-sh">
        <span class="abi-eyebrow">Цена</span>
        <h2>Стоимость и сроки внедрения AI BI-аналитики</h2>
        <p>Честный ответ на запросы «ai bi аналитика цена» и «сколько стоит»: вилка <strong>300 тыс.–2 млн ₽</strong> зависит от зрелости данных и глубины мультиагентной логики.</p>
      </div>
      <div class="abi-table-wrap nero-ai-reveal">
        <table class="abi-table">
          <thead><tr><th>Статья</th><th>Влияние на бюджет</th></tr></thead>
          <tbody>
            <tr><td>Аудит и проектирование семантического слоя</td><td>15–25%</td></tr>
            <tr><td>ETL/ELT, витрины DWH</td><td>25–35%</td></tr>
            <tr><td>BI-витрина и дашборды</td><td>15–20%</td></tr>
            <tr><td>LLM-оркестрация, чат-UI, интеграции</td><td>20–30%</td></tr>
            <tr><td>RLS, аудит, обучение, документация</td><td>10–15%</td></tr>
          </tbody>
        </table>
      </div>
      <div class="abi-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="abi-card">
          <h3>Под ключ или поэтапно — что выгоднее</h3>
          <p><strong>Под ключ</strong> (фазы 0→1→2) — при бюджете и сжатых сроках: единая точка входа за 2–3 месяца.</p>
          <p><strong>Поэтапно</strong> — при незрелых данных: пилот от ~300 тыс. ₽ даёт измеримый результат до крупных инвестиций.</p>
        </div>
        <div class="abi-card abi-delay-1">
          <h3>ROI</h3>
          <p>Считается в часах аналитиков и скорости управленческих решений. Ориентир рынка: 30–40% типовых ad-hoc без аналитиков; сокращение времени ответа с дней до минут.</p>
        </div>
      </div>
''' + cta_stoimost + r'''
    </div>
  </section>

  <section class="abi-section" id="integracii">
    <div class="abi-cnt">
      <div class="abi-sh">
        <span class="abi-eyebrow">Стек</span>
        <h2>Интеграция с Power BI, Tableau, Yandex DataLens и вашими источниками</h2>
        <p>Ассистентский слой поверх уже вложенных платформ — <strong>дополняет BI, не заменяет стек</strong>.</p>
      </div>
      <div class="abi-stack-logos nero-ai-reveal" aria-hidden="true">
        <span>1С</span><span>CRM</span><span>ClickHouse</span><span>PostgreSQL</span><span>DataLens</span><span>Power BI</span>
      </div>
      <div class="abi-table-wrap nero-ai-reveal" style="margin-top:24px;">
        <table class="abi-table">
          <thead><tr><th>Решение</th><th>Сильные стороны</th><th>Ограничения</th></tr></thead>
          <tbody>
            <tr><td>DataLens Нейроаналитик</td><td>RLS, контур Yandex Cloud</td><td>Привязка к экосистеме Yandex</td></tr>
            <tr><td>PIX BI AI-Ассистент</td><td>On-prem, NLQ, drill-down</td><td>Нужна зрелая модель в PIX Meta</td></tr>
            <tr><td>Power BI Copilot</td><td>Semantic models, enterprise-стек</td><td>Требуется paid Fabric/Premium</td></tr>
            <tr><td>ThoughtSpot Spotter</td><td>Governed semantic layer</td><td>Западный вендор, лицензии</td></tr>
            <tr><td>Metabase Metabot + MCP</td><td>Self-host, BYOK</td><td>Меньше enterprise-governance</td></tr>
            <tr><td><strong>Кастом Nero Network</strong></td><td>Ваш DWH, глоссарий, Telegram, on-prem LLM</td><td>Проект 300k–2M ₽</td></tr>
          </tbody>
        </table>
      </div>
      <div class="abi-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="abi-card"><h3>DWH: ClickHouse, BigQuery, PostgreSQL</h3><p>Источники (1С, CRM, реклама) → ETL → DWH → семантика → BI + AI. ClickHouse и PostgreSQL — стандарт для чека 300–800 тыс. ₽.</p></div>
        <div class="abi-card abi-delay-1"><h3>Ограничения Copilot и альтернативы</h3><p>Если вендорский ассистент не покрывает ad-hoc вне дашбордов или требует облачных LLM там, где данные нельзя выносить — кастомный слой оправдан.</p></div>
      </div>
    </div>
  </section>

  <section class="abi-section abi-section-alt" id="keisy">
    <div class="abi-cnt">
      <div class="abi-sh">
        <span class="abi-eyebrow">Доверие</span>
        <h2>Кейсы и сценарии: AI BI-аналитика для CFO, COO и собственника</h2>
      </div>
      <div class="abi-case-grid nero-ai-reveal">
        <div class="abi-case-card">
          <div class="abi-case-tag">CFO</div>
          <h3>Финансовый директор: отчёт без ожидания аналитика</h3>
          <p>Еженедельный план-факт по EBITDA: CFO спрашивает «разложи отклонение на цену, объём и микс» — получает waterfall и текстовый вывод из сертифицированной витрины.</p>
        </div>
        <div class="abi-case-card">
          <div class="abi-case-tag">COO</div>
          <h3>Операционный директор: контроль отклонений</h3>
          <p>COO задаёт вопрос в Telegram-боте: срез по региону, сравнение с планом, подсветка аномалии за 14 дней — без поиска «того самого» дашборда.</p>
        </div>
        <div class="abi-case-card">
          <div class="abi-case-tag">Собственник</div>
          <h3>Единая точка входа вместо 40 дашбордов</h3>
          <p>«Как дела с cash flow и дебиторкой относительно плана на месяц» — ответ с контекстом, а не голая цифра.</p>
        </div>
      </div>
      <aside class="abi-callout nero-ai-reveal">
        <strong>Лид-магнит:</strong> пример AI-дашборда с 10 вопросами, которые ассистент закрывает за 30 секунд — маржа по региону, план-факт, DSO, отклонение воронки.
      </aside>
    </div>
  </section>

  <section class="abi-section" id="segmenty">
    <div class="abi-cnt">
      <div class="abi-sh">
        <span class="abi-eyebrow">Сегменты</span>
        <h2>AI BI-аналитика для малого и среднего бизнеса</h2>
      </div>
      <div class="abi-grid-2 nero-ai-reveal">
        <div class="abi-card">
          <h3>Малый бизнес</h3>
          <p>Узкий фокус пилота: один юнит экономики, 10–15 метрик, Metabase + ClickHouse + LLM. Чек входа — от ~300 тыс. ₽.</p>
        </div>
        <div class="abi-card abi-delay-1">
          <h3>Средний бизнес (50–500 сотрудников)</h3>
          <p>Основной сегмент 300 тыс.–2 млн ₽: 1С + CRM + реклама, RLS по ролям, Telegram для руководителей.</p>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px;max-width:820px;"><strong>Без программиста</strong> — руководитель не пишет SQL, но витрины и глоссарий проектируются один раз. После запуска бизнес-пользователи работают в чате.</p>
    </div>
  </section>

  <section class="abi-section abi-section-alt" id="bezopasnost">
    <div class="abi-cnt">
      <div class="abi-sh">
        <span class="abi-eyebrow">E-E-A-T</span>
        <h2>Безопасность данных, доступы и риски галлюцинаций в BI-ассистенте</h2>
        <p>Главные риски — галлюцинации, утечка данных через LLM, ответы «от себя». «Подключить ChatGPT к базе» без governance недопустимо для финансовых данных.</p>
      </div>
      <div class="abi-checklist nero-ai-reveal">
        <div class="abi-check-item"><span>1</span><div><strong>Семантический слой</strong> — единые определения метрик; запросы через API.</div></div>
        <div class="abi-check-item"><span>2</span><div><strong>RLS</strong> — права на уровне строк и столбцов.</div></div>
        <div class="abi-check-item"><span>3</span><div><strong>Показ запроса</strong> — пользователь видит источник цифры.</div></div>
        <div class="abi-check-item"><span>4</span><div><strong>Аудит</strong> — лог каждого ответа; human-in-the-loop для board-ready метрик.</div></div>
        <div class="abi-check-item"><span>5</span><div><strong>Закрытый контур</strong> — on-prem, Yandex Cloud, GigaChat при необходимости.</div></div>
      </div>
      <div class="abi-warn nero-ai-reveal">
        <p><strong>Как проверять выводы:</strong> разделение метрик на exploratory и certified; A/B-тест сценариев на пилоте; регулярный разбор «плохих ответов»; запрет narrative вне полученных данных.</p>
      </div>
    </div>
  </section>

  <section class="abi-section" id="faq">
    <div class="abi-cnt">
      <div class="abi-sh">
        <span class="abi-eyebrow">FAQ</span>
        <h2>FAQ по внедрению AI BI-аналитики</h2>
      </div>
      <div class="abi-faq nero-ai-reveal">
        <div class="abi-faq-item"><div class="abi-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить ai bi аналитика в компании с нуля?</div><div class="abi-faq-a">Зафиксируйте топ-20 ad-hoc запросов → аудит источников → витрина с 10–15 метриками → пилот с чат-интерфейсом → измерьте время ответа → масштабируйте RLS и интеграции. Срок до пилота: 3–5 недель при готовых данных.</div></div>
        <div class="abi-faq-item"><div class="abi-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит ai bi аналитика под ключ?</div><div class="abi-faq-a">Вилка 300 тыс.–2 млн ₽: пилот от ~300 тыс. ₽, полноценное внедрение с мультиагентами — до 2 млн ₽. Точная смета — после аудита.</div></div>
        <div class="abi-faq-item"><div class="abi-faq-q" role="button" tabindex="0" aria-expanded="false">Нужны ли программисты для запуска?</div><div class="abi-faq-a">Для ежедневной работы руководителей — нет. Для ETL, семантики и RLS — да, либо команда интегратора.</div></div>
        <div class="abi-faq-item"><div class="abi-faq-q" role="button" tabindex="0" aria-expanded="false">Ai bi аналитика под ключ или самостоятельно?</div><div class="abi-faq-a">Вендорский ассистент — быстрый старт в экосистеме. Под ключ с интегратором — ваш DWH, 1С, CRM, on-prem LLM, сертификация метрик под совет директоров.</div></div>
        <div class="abi-faq-item"><div class="abi-faq-q" role="button" tabindex="0" aria-expanded="false">Какие задачи решает ai bi аналитика?</div><div class="abi-faq-a">Ad-hoc без очереди, план-факт, аномалии, сводки для совета, self-service для руководителей, разгрузка аналитиков (до 30–40% ad-hoc).</div></div>
        <div class="abi-faq-item"><div class="abi-faq-q" role="button" tabindex="0" aria-expanded="false">Чем отличается от Нейроаналитика DataLens?</div><div class="abi-faq-a">Нейроаналитик — внутри DataLens в контуре Yandex Cloud. Кастомная ai bi аналитика — гибридные контуры: 1С on-prem + ClickHouse + Telegram + локальная LLM.</div></div>
        <div class="abi-faq-item"><div class="abi-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли без облачных LLM?</div><div class="abi-faq-a">Да: YandexGPT, GigaChat, локальные Qwen/Llama on-prem — типовые опции для финансовых данных.</div></div>
      </div>
    </div>
  </section>

  <section class="abi-section abi-section-alt" id="ocenit-bi">
    <div class="abi-cnt">
      <div class="ym-cta-block ym-cta-block--dual" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Оценить BI с AI — следующий шаг</p>
          <p class="ym-cta-block__sub">Запросите оценку BI с AI — разберём источники, ad-hoc очередь и подберём формат пилота. Получите пример AI-дашборда — демо вопросов CFO и формат ответа ассистента.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Оценить BI с AI</a>
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="ym-btn ym-btn--ghost"<?php echo $primary_cta_attrs; ?>>Пример AI-дашборда</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
'''

STYLES = r'''
<style>
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,
.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}
.abi-hero-bi{min-height:100vh;min-height:100dvh;position:relative}
.abi-content{
  --abi-bg:#050711;--abi-bg2:#080b17;--abi-bg3:#0a0e1c;
  --abi-surface:rgba(255,255,255,.072);--abi-text:#e6edf7;--abi-muted:#9aa8bd;--abi-soft:#c7d2e5;--abi-heading:#fff;
  --abi-border:rgba(255,255,255,.10);--abi-cyan:#79f2ff;--abi-violet:#8b5cf6;--abi-green:#22c55e;--abi-amber:#f59e0b;
  --abi-btn-from:#06b6d4;--abi-btn-to:#8b5cf6;--abi-r:18px;--abi-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--abi-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.abi-content *,.abi-content *::before,.abi-content *::after{box-sizing:border-box}
.abi-content a{color:inherit}
.abi-content p{color:var(--abi-muted);line-height:1.72;margin:0 0 1em}
.abi-content p:last-child{margin-bottom:0}
.abi-content h2,.abi-content h3,.abi-content h4{color:var(--abi-heading);letter-spacing:-.045em;margin:0 0 .7em}
.abi-content strong{color:var(--abi-soft)}
.abi-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.abi-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--abi-muted);font-size:14.5px;line-height:1.65}
.abi-content ul li::before{content:'›';position:absolute;left:0;color:var(--abi-cyan);font-weight:700}
.abi-cnt{width:min(var(--abi-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.abi-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.abi-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.abi-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.abi-sh.abi-left{margin-left:0;text-align:left}
.abi-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.abi-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.abi-sh.abi-left p{margin-left:0}
.abi-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--abi-cyan);margin-bottom:14px}
.abi-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.abi-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.abi-intro-text{position:relative;padding-left:20px;text-align:left!important}
.abi-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--abi-cyan),var(--abi-violet))}
.abi-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--abi-muted);margin-bottom:1em}
.abi-intro-text p:last-child{margin-bottom:0;color:var(--abi-soft)}
.abi-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.abi-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px)}
.abi-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--abi-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.abi-kpi-card .kl{font-size:11px;font-weight:600;color:var(--abi-muted);line-height:1.4}
.abi-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.abi-intro-grid{grid-template-columns:1fr;gap:36px}.abi-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.abi-intro-kpi{grid-template-columns:1fr 1fr}}
.abi-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.abi-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.abi-toc a{display:inline-block;padding:9px 18px;background:var(--abi-surface);border:1px solid var(--abi-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--abi-muted);transition:border-color .2s,color .2s,background .2s}
.abi-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--abi-cyan);background:rgba(121,242,255,.08)}
.abi-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--abi-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);transition:border-color .22s,transform .22s}
.abi-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px)}
.abi-card--pulse{border-color:rgba(34,197,94,.25);box-shadow:0 0 0 1px rgba(34,197,94,.12)}
.abi-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.abi-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.abi-grid-2,.abi-grid-3{grid-template-columns:1fr}}
.abi-chips{display:flex;flex-wrap:wrap;gap:8px;margin-top:20px}
.abi-chip{padding:7px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);color:var(--abi-cyan)}
.abi-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0}
.abi-table{width:100%;border-collapse:collapse;font-size:14px}
.abi-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--abi-cyan);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap}
.abi-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--abi-text);vertical-align:top}
.abi-table tr:last-child td{border-bottom:none}
.abi-timeline{position:relative;padding-left:40px}
.abi-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--abi-cyan),var(--abi-violet));opacity:.35;border-radius:2px}
.abi-tl-item{position:relative;margin-bottom:32px}
.abi-tl-item:last-child{margin-bottom:0}
.abi-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--abi-cyan);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.abi-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.abi-case-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.abi-case-grid{grid-template-columns:1fr}}
.abi-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s}
.abi-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px)}
.abi-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--abi-green);margin-bottom:10px}
.abi-callout{margin-top:28px;padding:22px 26px;border-radius:16px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);color:var(--abi-soft);font-size:15px;line-height:1.7}
.abi-stack-logos{display:flex;flex-wrap:wrap;gap:10px;justify-content:center}
.abi-stack-logos span{padding:8px 16px;border-radius:10px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);font-size:12px;font-weight:700;color:var(--abi-muted)}
.abi-checklist{display:grid;gap:12px;max-width:820px;margin:0 auto}
.abi-check-item{display:grid;grid-template-columns:36px 1fr;gap:14px;align-items:start;padding:16px 18px;border-radius:14px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08)}
.abi-check-item span{width:36px;height:36px;border-radius:50%;display:grid;place-items:center;background:rgba(121,242,255,.12);color:var(--abi-cyan);font-weight:800;font-size:14px}
.abi-warn{margin-top:24px;padding:20px 24px;border-radius:14px;border:1px solid rgba(245,158,11,.35);background:rgba(245,158,11,.08)}
.abi-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.abi-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.abi-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--abi-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.abi-faq-q::after{content:'▾';font-size:13px;color:var(--abi-cyan);flex-shrink:0;transition:transform .25s}
.abi-faq-item.open .abi-faq-q::after{transform:rotate(180deg)}
.abi-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--abi-muted);line-height:1.72}
.abi-faq-item.open .abi-faq-a{max-height:600px;padding:0 24px 20px}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--abi-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.ym-btn:hover{transform:translateY(-2px)}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--abi-btn-from),var(--abi-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(6,182,212,.35)}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--abi-text)!important;border:1.5px solid rgba(255,255,255,.18)}
.ym-link--accent{color:var(--abi-cyan)!important;text-decoration:underline!important}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active,.nero-ai-reveal.nero-ai-delay-1.nero-ai-active,.nero-ai-reveal.nero-ai-delay-2.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}
.nero-ai-delay-2{transition-delay:.24s}
.abi-delay-1{transition-delay:.12s}
@media(max-width:600px){.ym-cta-block{padding:28px 20px}}
</style>
'''

PHP_HEAD = r'''<?php
/**
 * Template Name: AI BI-аналитика: внедрение помощника для управленческих отчётов под ключ
 * Description: SEO-лендинг — внедрение AI BI-аналитики. NLQ, семантический слой, Power BI, DataLens.
 */

declare(strict_types=1);

$page_seo_title       = 'AI BI-аналитика под ключ — внедрение для управленческих отчётов';
$page_seo_description = 'Внедрение AI BI-аналитики: нейросеть отвечает на вопросы по данным, находит отклонения и снимает ad-hoc нагрузку с аналитиков. Стоимость, этапы, кейсы, интеграция с Power BI и DataLens.';

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

$brand               = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret
$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Оценить BI с AI';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#zadachi';

$nero_ai_header_links = [
    ['label' => 'Что это',    'href' => '#chto-takoe'],
    ['label' => 'Задачи',     'href' => '#zadachi'],
    ['label' => 'Внедрение',  'href' => '#etapy'],
    ['label' => 'Стоимость',  'href' => '#stoimost'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Кейсы',      'href' => '#keisy'],
    ['label' => 'FAQ',        'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if (!is_readable($nero_ai_floating)) {
    require dirname(__DIR__) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
    require $nero_ai_floating;
}
?>

<?php nero_ai_echo_theme_styles(['nero-ai-longread-ui-compat.css']); ?>

'''

TAIL = r'''
<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
(function(){
  document.querySelectorAll('.abi-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.abi-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.abi-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.abi-faq-q');
        if(q) q.setAttribute('aria-expanded','false');
      });
      if(!isOpen){ item.classList.add('open'); btn.setAttribute('aria-expanded','true'); }
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
  var root = document.querySelector('.ai-bi-analitika-page') || document.querySelector('.abi-content');
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
'''

full = (
    PHP_HEAD
    + STYLES
    + '\n<main id="primary" class="site-main nero-ai-home-page ai-bi-analitika-page" role="main" tabindex="-1">\n\n'
    + hero
    + '\n\n'
    + CONTENT
    + TAIL
)

OUT.parent.mkdir(parents=True, exist_ok=True)
OUT.write_text(full, encoding="utf-8")
print(f"Written {OUT} ({OUT.stat().st_size} bytes)")

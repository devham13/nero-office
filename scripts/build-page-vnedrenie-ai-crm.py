#!/usr/bin/env python3
"""Assemble wordpress/page-vnedrenie-ai-crm.php from handoff fragments."""
import re
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
handoff = (ROOT / '.cursor/nero-network-handoff.md').read_text(encoding='utf-8')
amocrm = (ROOT / 'wordpress/page-vnedrenie-ai-amocrm.php').read_text(encoding='utf-8')

css = '\n'.join(amocrm.splitlines()[58:509])

alina_section = handoff.split('=== АЛИНА (HERO) ===')[1].split('=== БОРИС')[0]
alina_hero = re.search(r'```html\n(<style>.*?</section>)\n```', alina_section, re.DOTALL).group(1)
alina_script = re.search(r'## JavaScript.*?\n```html\n(<script>.*?</script>)\n```', alina_section, re.DOTALL).group(1)

boris_section = handoff.split('=== БОРИС (БЛОК СТАТЬИ, НЕ HERO) ===')[1]
boris_block = re.search(
    r'```html\n(<section id="vnedrenie-ai-crm-boris-block".*?</section>)\n```',
    boris_section,
    re.DOTALL,
).group(1)

secondary_cta_label = "обучение по внедрению AI в бизнес-процессы"

content = f'''
<div class="vna-content">

  <section class="vna-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="vna-cnt nero-ai-container">
      <div class="vna-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="vna-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai crm</p>
          <p><strong>Коротко:</strong> AI-интеграция с CRM — связка вашей CRM (amoCRM, Битрикс24, RetailCRM или собственной системы) с LLM-агентом и автоматизацией через API/webhook. Система анализирует сделки, подсказывает менеджеру следующий шаг и контролирует качество заполнения карточек.</p>
          <p>CRM покупают ради воронки, прогноза и дисциплины отдела продаж. На практике карточки заполняются наполовину, задачи не ставятся, а РОП узнаёт о проблеме, когда сделка уже «умерла». Внедрение AI в CRM закрывает этот разрыв: не чат-бот на сайте, а <strong>второй пилот менеджера</strong> внутри вашей воронки.</p>
        </div>
        <div class="vna-intro-kpi" aria-label="5 признаков, что CRM врёт">
          <div class="vna-kpi-card"><div class="kv">1</div><div class="kl">Пустые обязательные поля</div><div class="ks">бюджет, ЛПР, сроки</div></div>
          <div class="vna-kpi-card"><div class="kv">2</div><div class="kl">Нет задач после контакта</div><div class="ks">тишина в timeline</div></div>
          <div class="vna-kpi-card"><div class="kv">3</div><div class="kl">Этап не менялся N дней</div><div class="ks">сделка «висит»</div></div>
          <div class="vna-kpi-card"><div class="kv">4</div><div class="kl">Источник и UTM потеряны</div><div class="ks">ROI канала не считается</div></div>
        </div>
      </div>
      <p class="vna-intro-foot nero-ai-reveal" style="margin-top:20px;font-size:14px;color:var(--vna-muted);text-align:left;padding-left:20px;border-left:3px solid var(--vna-accent);">Пятый признак: прогноз скачет — РОП закрывает квартал «на глаз», потому что воронка не отражает реальность.</p>
    </div>
  </section>

  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#zachem-ai-crm">Зачем AI в CRM</a>
        <a href="#zadachi">Задачи</a>
        <a href="#etapy">Этапы</a>
        <a href="#integraciya">Интеграции</a>
        <a href="#kontrol">Контроль полей</a>
        <a href="#ceny">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
        <a href="#podklyuchit">Подключить</a>
      </nav>
    </div>
  </div>

  <!-- INTERNAL-LINKS:INSERT -->

  <section class="vna-section" id="zachem-ai-crm">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Контекст 2026</span>
        <h2>Зачем бизнесу AI в CRM в 2026 году</h2>
        <p><strong>AI CRM</strong> — проектная интеграция искусственного интеллекта с системой управления сделками: чтение коммуникаций, автозаполнение полей, next-best-action и контроль дисциплины.</p>
      </div>

      <div class="vna-card nero-ai-reveal">
        <h3 style="font-size:19px;margin-bottom:12px;">Почему CRM без AI теряет сделки и искажает аналитику</h3>
        <p>По данным аудита B2B-компаний в России, <strong>30–50% полей</strong> в CRM не заполняются или заполнены «мусором» — в <strong>15 из 18</strong> проверенных компаний (b2bprofit.ru, 2026). Международные исследования подтверждают масштаб: <strong>80%</strong> компаний признают неточность данных в CRM, <strong>40%</strong> записей устаревает ежегодно (Landbase / WinPure, 2026).</p>
        <p>Рынок CRM в России превысил <strong>32 млрд ₽</strong> в 2024 году с ростом <strong>20–25% в год</strong> (METASAPIENS). Но только <strong>~27 из 100</strong> компаний активно пользуются купленной CRM уже через месяц после внедрения.</p>
        <p><strong>Искусственный интеллект для CRM</strong> не заменяет процессы. AI ускоряет дисциплину, когда регламент уже понятен: «Если 40% полей не заполняются — на новой CRM будет та же история» (b2bprofit.ru).</p>
      </div>

      <div class="vna-grid-2 nero-ai-reveal" style="margin-top:24px;">
        <div class="vna-card">
          <h3 style="font-size:17px;margin-bottom:10px;">AI-агенты в enterprise-приложениях</h3>
          <p>Gartner прогнозирует: к концу <strong>2026 года 40% корпоративных приложений</strong> получат task-specific <strong>ai агентов</strong> — против менее <strong>5%</strong> в 2025-м. CRM — одно из первых полей боя: Salesforce Agentforce, HubSpot Breeze Agents, Microsoft Dynamics 365 Sales с MCP, Битрикс24 «Космос», amoCRM 2026 с Аммой.</p>
        </div>
        <div class="vna-card">
          <h3 style="font-size:17px;margin-bottom:10px;">Оговорка аналитиков</h3>
          <p><strong>Более 40% agentic AI-проектов</strong> могут быть отменены к концу <strong>2027</strong> из-за стоимости inference, неясного ROI и рисков (Gartner, 25.06.2025). Выигрывают проекты с <strong>узким пилотом</strong>, измеримыми метриками и human-in-the-loop.</p>
        </div>
      </div>

      <p class="nero-ai-reveal" style="margin-top:28px;font-size:15px;color:var(--vna-soft);text-align:center;max-width:760px;margin-left:auto;margin-right:auto;"><strong>Итог:</strong> <strong>ai для бизнеса</strong> в CRM в 2026 — не хайп, а ответ на грязные данные и перегруженных менеджеров. Вопрос — <strong>как внедрить ai crm</strong> так, чтобы он работал с вашей воронкой, а не параллельно с ней.</p>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="zadachi">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Функционал</span>
        <h2>Какие задачи решает AI-интеграция с CRM</h2>
        <p><strong>Ai решения для crm</strong> закрывают три слоя: <strong>анализ</strong>, <strong>действие</strong> и <strong>контроль</strong>. Ниже — сценарии, которые мы внедряем в Nero Network.</p>
      </div>

      <div class="vna-scenario nero-ai-reveal">
        <div class="vna-sc-icon" aria-hidden="true">📊</div>
        <div>
          <h3>Анализ сделок и next-best-action для менеджера</h3>
          <p>После звонка, чата или встречи AI расшифровывает коммуникацию, извлекает бюджет, сроки, ЛПР, возражения (BANT/MEDDIC), сравнивает с регламентом полей и предлагает <strong>next-best-action</strong>: «позвонить завтра», «отправить КП», «эскалировать РОПу».</p>
          <p>Кейс SalesAI: <strong>−60%</strong> времени на ручной ввод, <strong>−25%</strong> отклонение прогноза. Trigly + RetailCRM — подсказка по скидке при смене стадии сделки в Telegram.</p>
        </div>
      </div>

      <div class="vna-scenario nero-ai-reveal nero-ai-delay-1">
        <div class="vna-sc-icon" aria-hidden="true">✏️</div>
        <div>
          <h3>Автозаполнение полей и контроль дисциплины</h3>
          <p><strong>Нейросети для crm</strong> пишут в кастомные поля и notes, ставят задачи с дедлайном, тегируют сделки и проверяют чек-лист качества. Встроенный AI (CoPilot, RetailCRM AI) <strong>не знает ваш регламент</strong> — кастомная <strong>интеграция ai crm</strong> добавляет Rules Engine по этапам воронки.</p>
        </div>
      </div>

      <div class="vna-compare-wrap nero-ai-reveal" style="margin-top:32px;">
        <table class="vna-compare">
          <thead>
            <tr><th>Критерий</th><th>Чат-бот в мессенджере</th><th>AI-интеграция с CRM</th></tr>
          </thead>
          <tbody>
            <tr><td>Где работает</td><td class="vna-neutral">Канал общения с клиентом</td><td class="vna-good">Внутри воронки: карточка, задачи, этапы</td></tr>
            <tr><td>Главная цель</td><td class="vna-neutral">Ответить / квалифицировать лид</td><td class="vna-good">Качество данных + next-best-action</td></tr>
            <tr><td>Кто пользователь</td><td class="vna-neutral">Клиент</td><td class="vna-good">Менеджер, РОП, аналитик</td></tr>
            <tr><td>Контроль дисциплины</td><td class="vna-neutral">Нет</td><td class="vna-good">Пустые поля, просрочки, расхождение этапа</td></tr>
            <tr><td>Запись в CRM</td><td class="vna-neutral">Частичная</td><td class="vna-good">Поля, задачи, timeline, аудит-лог</td></tr>
          </tbody>
        </table>
      </div>

      <p class="nero-ai-reveal" style="margin-top:24px;font-size:15px;color:var(--vna-soft);"><strong>Итог:</strong> <strong>какие задачи решает ai crm</strong> — это не «ai менеджер 24/7 в чате», а <strong>прозрачная воронка</strong>, где каждый контакт превращается в структурированные данные и понятный следующий шаг. Для обработки входящей почты — отдельный кластер (email + CRM).</p>
    </div>
  </section>

{boris_block}

  <section class="vna-section" id="etapy">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Методология</span>
        <h2>Внедрение AI в CRM под ключ: этапы, сроки, роли</h2>
        <p><strong>Внедрение ai crm под ключ</strong> — проект от CRM-аудита до пилота с метриками. Типовой срок: <strong>2–6 недель</strong>. Ориентир чека: <strong>200 тыс.–1,5 млн ₽</strong>.</p>
      </div>

      <div class="vna-card nero-ai-reveal">
        <h3 style="font-size:18px;margin-bottom:12px;">CRM-аудит под AI (лид-магнит)</h3>
        <ul>
          <li>Выгрузка <strong>50–100 сделок</strong> из вашей CRM</li>
          <li>Отчёт: % пустых полей, просроченные задачи, сделки без следующего шага</li>
          <li>Карта: какие поля AI заполняет автоматически, какие — только предлагает менеджеру</li>
        </ul>
        <p>Бесплатный вход в проект — без аудита любая цифра по <strong>сколько стоит ai crm</strong> будет гаданием.</p>
      </div>

      <div class="vna-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="vna-table">
          <thead><tr><th>Этап</th><th>Срок</th><th>Что делаем</th></tr></thead>
          <tbody>
            <tr><td>Аудит и карта полей</td><td>3–5 дней</td><td>Регламент, эталонные карточки, схема воронки</td></tr>
            <tr><td>Интеграционный слой</td><td>5–10 дней</td><td>Webhooks, n8n/Make, LLM-сервис, CRM Writer</td></tr>
            <tr><td>Пилот на 1 отделе / 1 воронке</td><td>2–4 недели</td><td>1–2 сценария: пост-звонок, квалификация лида</td></tr>
            <tr><td>Обучение и донастройка</td><td>3–5 дней</td><td>Менеджеры, РОП, правки промптов</td></tr>
            <tr><td>Масштабирование</td><td>по плану</td><td>Новые воронки, CRM, каналы</td></tr>
          </tbody>
        </table>
      </div>

      <div class="vna-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="vna-card">
          <h3 style="font-size:17px;margin-bottom:10px;">Human-in-the-loop</h3>
          <p><strong>Сразу (низкий риск):</strong> теги, черновики комментариев, задачи с дедлайном, напоминания о пустых полях.</p>
          <p><strong>С подтверждением:</strong> смена этапа, запись бюджета, отправка писем клиенту. Каждое действие AI — в <strong>аудит-логе</strong>.</p>
        </div>
        <div class="vna-card">
          <h3 style="font-size:17px;margin-bottom:10px;">152-ФЗ и роли</h3>
          <p>Контур в РФ: <strong>n8n self-hosted</strong>, YandexGPT или GigaChat. <strong>Менеджер</strong> подтверждает автозаполнение, <strong>РОП</strong> видит дашборд дисциплины, <strong>IT</strong> — API и мониторинг, <strong>собственник</strong> — прогноз из чистых данных.</p>
        </div>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите разобраться в AI-автоматизации до старта пилота?</p>
          <p class="ym-cta-block__sub">Если команда хочет понимать n8n, промпты и human-in-the-loop до CRM-аудита — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>. Это ускоряет согласование сценариев с РОПом и IT.</p>
        </div>
      </aside>
    </div>
  </section>

  <div class="vna-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-audit">
      <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Получить CRM-аудит под AI — бесплатно</p>
        <p class="ym-cta-block__sub">Выгрузим 50–100 сделок, покажем % пустых полей, сделки без следующего шага и карту полей для автоматизации. Без обязательств — первый шаг к внедрению под ключ.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Подключить AI к CRM'); ?></a>
      </div>
    </div>
  </div>

  <section class="vna-section vna-section-alt" id="integraciya">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Стек</span>
        <h2>Интеграция AI с amoCRM, Битрикс24, RetailCRM и собственной CRM</h2>
        <p><strong>Интеграция ai crm</strong> строится на единой логике: событие в CRM → normalize-слой → LLM → обратная запись.</p>
      </div>

      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card">
          <h3 style="font-size:17px;margin-bottom:10px;">amoCRM</h3>
          <p>OAuth2, REST API v4, webhooks. В 2026 — встроенные <strong>AI-агенты</strong> и ассистент <strong>Амма</strong>, интеграция с MAX.</p>
        </div>
        <div class="vna-card">
          <h3 style="font-size:17px;margin-bottom:10px;">Битрикс24</h3>
          <p>REST API, <code>event.bind</code>, <strong>CoPilot/BitrixGPT</strong>, конструктор AI-агентов, <strong>MCP Hub</strong> для управления CRM из Cursor, ChatGPT, n8n.</p>
        </div>
        <div class="vna-card">
          <h3 style="font-size:17px;margin-bottom:10px;">RetailCRM</h3>
          <p>API-ключ, webhooks, модуль «AI-инструменты и боты» — транскрипция, автотеги, оценка менеджеров.</p>
        </div>
        <div class="vna-card">
          <h3 style="font-size:17px;margin-bottom:10px;">Кастомная CRM</h3>
          <p>REST + webhooks; normalize-слой приводит все системы к единому JSON (телефон E.164, UTM, id сделки).</p>
        </div>
      </div>

      <div class="vna-card nero-ai-reveal" style="margin-top:28px;">
        <h3 style="font-size:17px;margin-bottom:12px;">Типовой pipeline Nero Network</h3>
        <pre style="background:rgba(0,0,0,.35);border:1px solid rgba(121,242,255,.2);border-radius:14px;padding:18px 20px;font-size:13px;line-height:1.6;color:var(--vna-accent);overflow-x:auto;margin:0;">Событие CRM → webhook → n8n/Make → LLM (классификация + извлечение) → Rules Engine → CRM Writer → Dashboard</pre>
        <p style="margin-top:14px;">Кейс Wildbots: единый pipeline для <strong>Bitrix24 и amoCRM</strong> через n8n — до внедрения менеджеры тратили до <strong>30% времени</strong> на переключение между CRM. <strong>MCP</strong> становится стандартом: «USB-C для AI».</p>
      </div>

      <div class="vna-compare-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="vna-compare">
          <thead>
            <tr><th>Параметр</th><th>Встроенный AI</th><th>Кастомная интеграция Nero Network</th></tr>
          </thead>
          <tbody>
            <tr><td>Срок запуска</td><td>Часы–дни</td><td class="vna-good">2–6 недель</td></tr>
            <tr><td>Регламент ваших полей</td><td>Общий</td><td class="vna-good">Под вашу воронку</td></tr>
            <tr><td>Multi-CRM</td><td>Нет</td><td class="vna-good">Да (normalize-слой)</td></tr>
            <tr><td>Аудит-лог решений AI</td><td>Ограничен</td><td class="vna-good">Полный</td></tr>
            <tr><td>152-ФЗ / контур РФ</td><td>Зависит от тарифа</td><td class="vna-good">n8n on-prem, YandexGPT/GigaChat</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px;font-size:14px;color:var(--vna-muted);">Узкая посадочная <strong>только под amoCRM</strong> — в отдельном материале. <strong>Эта страница</strong> — кластер «любая CRM» с единой методологией.</p>
    </div>
  </section>

  <section class="vna-section" id="kontrol">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Дисциплина данных</span>
        <h2>Контроль качества заполнения CRM</h2>
        <p><strong>Контроль заполнения crm</strong> — система правил и метрик: AI снимает рутину и показывает РОПу реальную картину, а не «наказывает» менеджера.</p>
      </div>

      <div class="vna-card nero-ai-reveal">
        <h3 style="font-size:18px;margin-bottom:12px;">Правила заполнения карточек и напоминания</h3>
        <p>На этапе внедрения фиксируем карту полей: что обязательно на каждом этапе, что AI заполняет автоматически, что — только на подтверждение, что запрещено менять без РОПа.</p>
        <p>AI при каждом событии сверяет карточку с регламентом: дописывает сущности из коммуникации, создаёт задачу «Заполнить бюджет», уведомляет РОПа при N дней без активности.</p>
      </div>

      <div class="vna-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="vna-table">
          <thead><tr><th>Метрика</th><th>До AI</th><th>Цель после пилота</th></tr></thead>
          <tbody>
            <tr><td>% пустых обязательных полей</td><td>30–50% (типично B2B)</td><td><strong>−40%</strong> и ниже</td></tr>
            <tr><td>Сделки без задачи после контакта</td><td>фиксируем базу</td><td><strong>−60%</strong></td></tr>
            <tr><td>Время менеджера на ввод после звонка</td><td>5–15 мин</td><td><strong>−50%</strong></td></tr>
            <tr><td>Отклонение прогноза от факта</td><td>фиксируем</td><td><strong>−25%</strong></td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:16px;font-size:14px;color:var(--vna-muted);">Точные проценты зависят от ниши — <strong>не обещаем фиксированный ROI без аудита</strong>.</p>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="ceny">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Бюджет</span>
        <h2>Стоимость внедрения AI в CRM</h2>
        <p><strong>Ai crm цена</strong> зависит от числа CRM, сценариев, каналов и требований к контуру (облако РФ / on-prem).</p>
      </div>

      <div class="vna-pricing-grid nero-ai-reveal">
        <div class="vna-price-card">
          <div class="tier">Малый бизнес</div>
          <div class="amount">от 200–350 тыс. ₽</div>
          <div class="inc">1 CRM, 1–2 сценария: аудит, пилот пост-звонок, обучение</div>
        </div>
        <div class="vna-price-card vna-featured">
          <div class="tier">Средний бизнес</div>
          <div class="amount">400–800 тыс. ₽</div>
          <div class="inc">1–2 CRM, 3–5 сценариев: normalize-слой, дашборд, интеграции</div>
        </div>
        <div class="vna-price-card">
          <div class="tier">Multi-CRM + RAG</div>
          <div class="amount">800 тыс.–1,5 млн ₽</div>
          <div class="inc">Несколько отделов, полный контур, масштабирование</div>
        </div>
        <div class="vna-price-card">
          <div class="tier">Рынок РФ</div>
          <div class="amount">от 80 000 ₽</div>
          <div class="inc">Минимальный сценарий до 900 000+ ₽ за комплекс (ориентиры рынка)</div>
        </div>
      </div>

      <div class="vna-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="vna-card">
          <h3 style="font-size:17px;margin-bottom:10px;">Под ключ</h3>
          <p>Аудит, интеграция, пилот, обучение, документация в одном проекте — предсказуемый срок <strong>2–6 недель</strong>.</p>
        </div>
        <div class="vna-card">
          <h3 style="font-size:17px;margin-bottom:10px;">Поэтапно</h3>
          <p>Сначала CRM-аудит и один сценарий, затем дополнительные воронки по метрикам. Чтобы <strong>заказать ai crm</strong> — достаточно заявки на аудит.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section" id="keisy">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Доказательства</span>
        <h2>Кейсы и примеры внедрения AI CRM</h2>
      </div>

      <div class="vna-case-grid nero-ai-reveal">
        <div class="vna-case-card">
          <div class="vna-case-tag">SalesAI · Россия</div>
          <h3>Малый и средний бизнес</h3>
          <p>Нейросеть слушает звонки, заполняет amoCRM/Битрикс24/RetailCRM, создаёт задачи.</p>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">−60%</span><span class="lbl">время на ввод</span></div>
            <div class="vna-metric"><span class="num">−25%</span><span class="lbl">отклонение прогноза</span></div>
          </div>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">Wildbots · n8n</div>
          <h3>Bitrix24 + amoCRM</h3>
          <p>GPT-агент: классификация лидов, черновик ответа, запись в обе CRM. Self-hosted в РФ, human-in-the-loop.</p>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">Enterprise</div>
          <h3>Несколько CRM в контуре</h3>
          <p>Salesforce Agentforce, HubSpot Breeze — паттерн один: <strong>агент действует в CRM</strong>, а не только советует в чате.</p>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px;text-align:center;color:var(--vna-muted);font-size:14px;"><strong>Ai crm кейсы</strong> в вашей нише — часть CRM-аудита: подбираем сценарий, ближайший к вашей воронке.</p>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Вопросы</span>
        <h2>FAQ: как внедрить AI в CRM без хаоса</h2>
      </div>

      <div class="vna-faq nero-ai-reveal">
        <div class="vna-faq-item">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить ai crm, если нет программиста в штате?</div>
          <div class="vna-faq-a">
            <p><strong>Ai crm без программиста</strong> — реальность при <strong>внедрении под ключ</strong>: интегратор настраивает n8n/Make, webhooks и промпты. В Битрикс24 — конструктор AI-агентов без кода. Ваше участие: регламент полей и обратная связь на пилоте.</p>
          </div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Ai crm под ключ или самостоятельно?</div>
          <div class="vna-faq-a">
            <p>Самостоятельно — дешевле на старте, но риск галлюцинаций и «сломанной» воронки. Под ключ — предсказуемый срок 2–6 недель, human-in-the-loop, CRM-аудит → метрики до/после.</p>
          </div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько времени занимает интеграция?</div>
          <div class="vna-faq-a">
            <p>Типовой пилот: <strong>2–4 недели</strong> на одну воронку. Полный контур multi-CRM: <strong>4–6 недель</strong>. Первые результаты по заполняемости — часто на <strong>2-й неделе</strong> пилота.</p>
          </div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Что если уже есть CoPilot / Амма / RetailCRM AI?</div>
          <div class="vna-faq-a">
            <p>Встроенный AI не знает <strong>ваш регламент</strong> и не связывает <strong>несколько CRM</strong>. Мы настраиваем слой поверх API: ваши поля, этапы, аудит-лог. CoPilot остаётся для расшифровки — кастомный агент для дисциплины и next-best-action.</p>
          </div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Риски: галлюцинации, ПДн, качество исходных данных</div>
          <div class="vna-faq-a">
            <p><strong>Галлюцинации:</strong> strict JSON schema, human-in-the-loop. <strong>ПДн:</strong> контур в РФ, YandexGPT/GigaChat, n8n on-prem. <strong>Garbage in — garbage out:</strong> аудит показывает это до старта. Gartner: &gt;40% отмен agentic AI к 2027 — лечится узким пилотом.</p>
          </div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Ai crm для малого бизнеса vs среднего бизнеса</div>
          <div class="vna-faq-a">
            <p><strong>Малый (3–7 менеджеров):</strong> один сценарий пост-звонок, одна CRM, от 200 тыс. ₽. <strong>Средний (10–50):</strong> несколько воронок, дашборд РОПа, 400–800 тыс. ₽. В обоих случаях стартуем с <strong>CRM-аудита</strong>.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section ym-cta-block ym-cta-block--footer-final" id="podklyuchit">
    <div class="vna-cnt" style="text-align:center;">
      <span class="vna-eyebrow">Коммерческий оффер</span>
      <h2 style="font-size:clamp(28px,4.2vw,48px);margin:14px auto 16px;max-width:760px;">Подключить AI к CRM</h2>
      <p style="max-width:620px;margin:0 auto 24px;font-size:16px;">AI анализирует сделки, подсказывает следующий шаг менеджеру и контролирует заполнение CRM — в amoCRM, Битрикс24, RetailCRM или вашей системе.</p>
      <ul class="vna-cta-checklist">
        <li>CRM-аудит под AI — бесплатно</li>
        <li>Пилот на одной воронке — 2–4 недели</li>
        <li>Интеграция под ключ — webhooks, n8n, human-in-the-loop</li>
        <li>Масштабирование по метрикам</li>
      </ul>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="font-size:16px;padding:16px 36px;"<?php echo $primary_cta_attrs; ?>>Подключить AI к CRM</a>
      <p style="margin-top:20px;font-size:14px;color:var(--vna-muted);max-width:680px;margin-left:auto;margin-right:auto;">Мы не продаём «чат-бота» — внедряем <strong>ai crm для бизнеса</strong>, где данные в воронке совпадают с реальностью.</p>
    </div>
  </section>

</div><!-- /.vna-content -->
'''

php_header = '''<?php
/**
 * Template Name: Внедрение AI в CRM под ключ
 * Description: SEO-лендинг — интеграция AI с amoCRM, Битрикс24, RetailCRM. Анализ сделок, контроль заполнения, кейсы.
 */

$page_seo_title       = 'Внедрение AI в CRM под ключ — интеграция и контроль сделок';
$page_seo_description = 'Внедряем AI в CRM под ключ: анализ сделок, подсказки менеджеру и контроль заполнения в amoCRM, Битрикс24, RetailCRM. Кейсы, цены, бесплатный CRM-аудит.';

add_filter( 'document_title_parts', static function ( array $parts ) use ( $page_seo_title ): array {
\t$parts['title'] = $page_seo_title;
\treturn $parts;
}, 20 );

add_action( 'wp_head', static function () use ( $page_seo_title, $page_seo_description ): void {
\techo '<meta name="description" content="' . esc_attr( $page_seo_description ) . '" />' . "\\n";
\techo '<meta property="og:title" content="' . esc_attr( $page_seo_title ) . '" />' . "\\n";
\techo '<meta property="og:description" content="' . esc_attr( $page_seo_description ) . '" />' . "\\n";
\techo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '" />' . "\\n";
\techo '<meta property="og:type" content="article" />' . "\\n";
}, 1 );

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Задачи', 'href' => '#zadachi'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Интеграции', 'href' => '#integraciya'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Подключить AI к CRM';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: ''' + repr(secondary_cta_label) + ''';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '';

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
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-crm-page" role="main" tabindex="-1">

''' + alina_hero + '\n\n' + content + '\n\n' + alina_script + '''

<!-- FAQ ACCORDION -->
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

<!-- REVEAL -->
<script>
(function(){
  'use strict';
  var root = document.querySelector('.vna-content');
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

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
'''

full = php_header + css + php_footer
out = ROOT / 'wordpress/page-vnedrenie-ai-crm.php'
out.write_text(full, encoding='utf-8')
print(f'Written {out} ({len(full)} bytes)')

# Verify critical ids
for needle in ['vnaic-crm-discipline-canvas', 'vac-crm-morning-canvas', 'vnedrenie-ai-crm-boris-block', 'SCHEMA-MARKUP:INSERT', 'INTERNAL-LINKS:INSERT']:
    assert needle in full, f'Missing: {needle}'
print('All critical markers present')
python3 /workspace/scripts/build-page-vnedrenie-ai-crm.py
#!/usr/bin/env python3
"""Assemble page-vnedrenie-ai-obrabotka-zayavok-sajta.php from handoff fragments."""
from pathlib import Path

ROOT = Path('/workspace')
hero = Path('/tmp/vzaz-hero.html').read_text(encoding='utf-8')
boris = Path('/tmp/bzas-boris.html').read_text(encoding='utf-8')

# Content CSS (vzaz-*), adapted from email-CRM longread patterns
CONTENT_CSS = r"""
/* Kadence reset + breadcrumbs hide */
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}

.vzaz-content{
  --vzaz-bg:#050711;--vzaz-bg2:#080b17;--vzaz-surface:rgba(255,255,255,.072);
  --vzaz-text:#e6edf7;--vzaz-muted:#9aa8bd;--vzaz-soft:#c7d2e5;--vzaz-heading:#fff;
  --vzaz-border:rgba(255,255,255,.10);--vzaz-accent:#fbbf24;--vzaz-violet:#a78bfa;--vzaz-green:#4ade80;
  --vzaz-btn-from:#f97316;--vzaz-btn-to:#8b5cf6;--vzaz-r:18px;--vzaz-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vzaz-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.vzaz-content *,.vzaz-content *::before,.vzaz-content *::after{box-sizing:border-box}
.vzaz-content a{color:inherit}
.vzaz-content p{color:var(--vzaz-muted);line-height:1.72;margin:0 0 1em;text-align:left}
.vzaz-content p:last-child{margin-bottom:0}
.vzaz-content h2,.vzaz-content h3,.vzaz-content h4{color:var(--vzaz-heading);letter-spacing:-.045em;margin:0 0 .7em;text-align:left}
.vzaz-content strong{color:var(--vzaz-soft)}
.vzaz-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.vzaz-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vzaz-muted);font-size:14.5px;line-height:1.65;text-align:left}
.vzaz-content ul li::before{content:'›';position:absolute;left:0;color:var(--vzaz-accent);font-weight:700}
.vzaz-cnt{width:min(var(--vzaz-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.vzaz-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.vzaz-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.vzaz-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.vzaz-sh.vzaz-left{margin-left:0;text-align:left}
.vzaz-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;text-align:left}
.vzaz-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;text-align:left}
.vzaz-sh.vzaz-left p{margin-left:0}
.vzaz-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(251,191,36,.08);border:1px solid rgba(251,191,36,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vzaz-accent);margin-bottom:14px}
.vzaz-gt{background:linear-gradient(92deg,#fff 0%,var(--vzaz-accent) 44%,var(--vzaz-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.vzaz-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.vzaz-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.vzaz-intro-text{position:relative;padding-left:20px;text-align:left}
.vzaz-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vzaz-accent),var(--vzaz-violet))}
.vzaz-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--vzaz-muted);margin-bottom:1em}
.vzaz-intro-text p:last-child{margin-bottom:0;color:var(--vzaz-soft)}
.vzaz-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.vzaz-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px)}
.vzaz-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--vzaz-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.vzaz-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vzaz-muted);line-height:1.4}
.vzaz-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.vzaz-intro-grid{grid-template-columns:1fr;gap:36px}.vzaz-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.vzaz-intro-kpi{grid-template-columns:1fr 1fr}}
.vzaz-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.vzaz-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.vzaz-toc a{display:inline-block;padding:9px 18px;background:var(--vzaz-surface);border:1px solid var(--vzaz-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vzaz-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important}
.vzaz-toc a:hover{border-color:rgba(251,191,36,.42);color:var(--vzaz-accent);background:rgba(251,191,36,.08)}
.vzaz-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vzaz-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s}
.vzaz-card:hover{border-color:rgba(251,191,36,.28);transform:translateY(-2px)}
.vzaz-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
@media(max-width:768px){.vzaz-grid-2{grid-template-columns:1fr}}
.vzaz-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.vzaz-table{width:100%;border-collapse:collapse;font-size:14px}
.vzaz-table th{padding:13px 16px;text-align:left;background:rgba(251,191,36,.1);color:var(--vzaz-accent);font-weight:700;border-bottom:1px solid rgba(251,191,36,.25);white-space:nowrap}
.vzaz-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vzaz-text);vertical-align:top;text-align:left}
.vzaz-table tr:last-child td{border-bottom:none}
.vzaz-table tr:hover td{background:rgba(255,255,255,.03)}
.vzaz-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.vzaz-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(251,191,36,.1);color:var(--vzaz-accent);border:1px solid rgba(251,191,36,.2)}
.vzaz-flow .arr{color:var(--vzaz-muted);font-size:16px;padding:0 4px;background:none;border:none}
.vzaz-timeline{position:relative;padding-left:40px}
.vzaz-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vzaz-accent),var(--vzaz-violet));opacity:.35;border-radius:2px}
.vzaz-tl-item{position:relative;margin-bottom:32px}
.vzaz-tl-item:last-child{margin-bottom:0}
.vzaz-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vzaz-accent);box-shadow:0 0 0 4px rgba(251,191,36,.2)}
.vzaz-tl-item h3{font-size:17px;margin-bottom:8px;text-align:left}
.vzaz-tl-item p{font-size:14.5px;margin:0;text-align:left}
.vzaz-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.vzaz-case-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.vzaz-case-grid{grid-template-columns:1fr}}
.vzaz-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s}
.vzaz-case-card:hover{border-color:rgba(74,222,128,.35);transform:translateY(-2px)}
.vzaz-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vzaz-green);margin-bottom:10px}
.vzaz-case-card h3{font-size:16px;margin-bottom:14px;text-align:left}
.vzaz-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.vzaz-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.vzaz-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vzaz-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;text-align:left}
.vzaz-faq-q::after{content:'▾';font-size:13px;color:var(--vzaz-accent);flex-shrink:0;transition:transform .25s}
.vzaz-faq-item.open .vzaz-faq-q::after{transform:rotate(180deg)}
.vzaz-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--vzaz-muted);line-height:1.72;text-align:left}
.vzaz-faq-item.open .vzaz-faq-a{max-height:800px;padding:0 24px 20px}
.vzaz-cta-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;list-style:none;padding:0}
.vzaz-cta-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--vzaz-muted)}
.vzaz-cta-checklist li::before{content:'✓';color:var(--vzaz-green);font-weight:800}
.vzaz-content .ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(251,191,36,.12),rgba(139,92,246,.1));border:1px solid rgba(251,191,36,.3);text-align:center}
.vzaz-content .ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.vzaz-content .ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.vzaz-content .ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;text-align:inherit}
.vzaz-content .ym-cta-block__sub{color:var(--vzaz-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;text-align:inherit}
.vzaz-content .ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.vzaz-content .ym-link--accent{color:var(--vzaz-accent)!important;text-decoration:underline!important}
.vzaz-content .ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.vzaz-content .ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--vzaz-btn-from),var(--vzaz-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(249,115,22,.35)}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}.nero-ai-delay-2{transition-delay:.24s}
"""

CTA_PRIMARY = r"""
<div class="ym-cta-block ym-cta-block--primary vzas-cta-audit" id="cta-audit-scenario">
  <div class="ym-cta-block__icon" aria-hidden="true">⚡</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Проверить, сколько заявок вы теряете</p>
    <p class="ym-cta-block__sub">За 30 минут разберём формы, ночной трафик и SLA первого ответа — сопоставим с порогом 10 минут из исследования Телфин/OkoCRM и покажем, где AI-агент на сайте даст максимальный эффект.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</div>
"""

CTA_SECONDARY = r"""
<aside class="ym-cta-block ym-cta-block--secondary vzas-cta-obuchenie" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать логику до старта проекта?</p>
    <p class="ym-cta-block__sub">На этапе проектирования сценария и приёмки пилота полезно разобрать webhook, human-in-the-loop и промпты — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI'); ?></a>. Это ускоряет согласование регламентов с отделом продаж.</p>
  </div>
</aside>
"""

CONTENT_HTML = f"""
<div class="vzaz-content">

  <section class="vzaz-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="vzaz-cnt">
      <div class="vzaz-intro-grid nero-ai-reveal">
        <div class="vzaz-intro-text">
          <p class="vzaz-eyebrow">Лонгрид · AI заявки с сайта</p>
          <p><strong>Коротко:</strong> Nero Network внедряет <strong>AI-агента</strong> на сайт вместо «мёртвой формы»: первый ответ за <strong>5–15 секунд</strong>, <strong>2–4 уточняющих вопроса</strong>, квалификация лида и <strong>создание сделки в CRM</strong> (amoCRM, Битрикс24 и др.). Услуга <strong>под ключ</strong> для услуг, онлайн-школ и клиник. Стартовый чек по проекту — <strong>120–350 тыс. ₽</strong>.</p>
          <p>Заявка с лендинга — это момент максимального интереса. Пока менеджер в дороге, на совещании или спит, клиент уже сравнивает вас с конкурентами. <strong>AI обработка заявок</strong> на первом касании закрывает разрыв между «отправил форму» и «получил живой ответ» — без найма ночной смены.</p>
        </div>
        <div class="vzaz-intro-kpi" aria-label="Ключевые метрики speed-to-lead">
          <div class="vzaz-kpi-card"><div class="kv">~50%</div><div class="kl">уходят без заказа при ответе &gt;10 мин</div><div class="ks">Телфин / OkoCRM</div></div>
          <div class="vzaz-kpi-card"><div class="kv">5–15 с</div><div class="kl">целевой SLA первого ответа</div><div class="ks">виджет на сайте</div></div>
          <div class="vzaz-kpi-card"><div class="kv">2–4</div><div class="kl">уточняющих вопроса</div><div class="ks">по регламенту продаж</div></div>
          <div class="vzaz-kpi-card"><div class="kv">24/7</div><div class="kl">ночные и выходные лиды</div><div class="ks">без смены менеджеров</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vzaz-toc-outer">
    <div class="vzaz-cnt">
      <nav class="vzaz-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#poteri-zayavok">Потери заявок</a>
        <a href="#chto-takoe-agent">Что такое агент</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#integracii-crm">Интеграции</a>
        <a href="#etapy">Этапы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
        <a href="#kviz">Аудит</a>
      </nav>
    </div>
  </div>

  <!-- INTERNAL-LINKS:INSERT -->

  <section class="vzaz-section" id="poteri-zayavok">
    <div class="vzaz-cnt">
      <div class="vzaz-sh vzaz-left nero-ai-reveal">
        <span class="vzaz-eyebrow">Боль</span>
        <h2>Сколько заявок с сайта вы теряете до первого ответа менеджера</h2>
        <p><strong>Определение:</strong> <em>потеря заявок с сайта</em> — лид оставил контакт, но не дождался контакта с компанией в комфортное время и ушёл к конкуренту или отложил решение.</p>
      </div>
      <p class="nero-ai-reveal">По исследованию <strong>Телфин и OkoCRM</strong> (более 7 500 представителей бизнеса, сентябрь 2025) <strong>около половины</strong> клиентов уходят без заказа, если ответ занимает <strong>больше 10 минут</strong>. Для услуг, школ и клиник задержка в часы — не редкость.</p>
      <p class="nero-ai-reveal"><strong>Итог:</strong> узкое место — не реклама, а <strong>скорость первого контакта</strong> (speed-to-lead).</p>
      <div class="vzaz-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="vzaz-card">
          <h3>Почему форма на сайте не заменяет живой диалог</h3>
          <p>Классическая форма собирает поля, но не уточняет бюджет, срок, город и не пишет в CRM. Скриптовый бот ломается на свободном тексте — менеджер переносит данные вручную.</p>
        </div>
        <div class="vzaz-card">
          <h3>Ночные и выходные заявки</h3>
          <p>Трафик не выключается в 19:00. Без <strong>ai менеджера заявок</strong> первый человеческий ответ появляется в понедельник — часть лидов уже у конкурентов. Среди внедривших AI для inbound <strong>22,7%</strong> отмечают лучшее покрытие вне рабочего времени (Salesforce, 2026).</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vzaz-section vzaz-section-alt" id="chto-takoe-agent">
    <div class="vzaz-cnt">
      <div class="vzaz-sh nero-ai-reveal">
        <span class="vzaz-eyebrow">Продукт</span>
        <h2>Что такое AI-агент для обработки заявок с сайта (не просто чат)</h2>
        <p><strong>AI-агент для сайта</strong> — слой между формой/виджетом и CRM: отвечает и <strong>выполняет действия</strong> — создаёт сделку, ставит теги, назначает задачу.</p>
      </div>
      <div class="vzaz-table-wrap nero-ai-reveal">
        <table class="vzaz-table" aria-label="Сравнение формы, бота и AI-агента">
          <thead><tr><th>Критерий</th><th>Форма + email</th><th>Скриптовый бот</th><th>AI-агент с CRM</th></tr></thead>
          <tbody>
            <tr><td>Скорость ответа</td><td>Часы</td><td>Секунды</td><td><strong>5–15 с</strong></td></tr>
            <tr><td>Уточняющие вопросы</td><td>Нет</td><td>Кнопки</td><td><strong>2–4</strong> по тексту</td></tr>
            <tr><td>Запись в CRM</td><td>Вручную</td><td>Редко</td><td><strong>Автоматически</strong></td></tr>
            <tr><td>Ночь / выходные</td><td>Потери</td><td>Частично</td><td><strong>24/7</strong></td></tr>
          </tbody>
        </table>
      </div>
      <div class="vzaz-grid-2 nero-ai-reveal" style="margin-top:28px">
        <div class="vzaz-card">
          <h3>От FAQ-бота к агенту с действиями в CRM</h3>
          <p>Тренд 2025–2026 — agentic automation: AI проходит первый этап воронки. Агент видит диалог и данные CRM (кейс Velmi + Bitrix24 на Хабре).</p>
        </div>
        <div class="vzaz-card">
          <h3>Задачи ai менеджера заявок</h3>
          <ul>
            <li>Фиксация UTM и источника</li>
            <li>2–4 вопроса по матрице продаж</li>
            <li>Скоринг: горячий / тёплый / отказ</li>
            <li>Сделка, задача, резюме диалога в CRM</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

{boris}

  <section class="vzaz-section" id="kak-rabotaet">
    <div class="vzaz-cnt">
      <div class="vzaz-sh nero-ai-reveal">
        <span class="vzaz-eyebrow">Сценарий</span>
        <h2>Как работает сценарий: от клика по форме до горячего лида в CRM</h2>
        <p><strong>Коротко:</strong> форма → webhook → агент за секунды → квалификация → CRM → бриф менеджеру.</p>
      </div>
      <div class="vzaz-flow nero-ai-reveal" aria-label="Шаги обработки заявки">
        <span>Форма / виджет</span><span class="arr">→</span>
        <span>Webhook &lt;1 с</span><span class="arr">→</span>
        <span>AI 5–15 с</span><span class="arr">→</span>
        <span>2–4 вопроса</span><span class="arr">→</span>
        <span>Скоринг</span><span class="arr">→</span>
        <span>Сделка в CRM</span>
      </div>
      <div class="vzaz-timeline nero-ai-reveal">
        <div class="vzaz-tl-item"><div class="vzaz-tl-dot"></div><h3>Ответ за 5–15 секунд</h3><p>SLA виджета: пользователь не уходит со страницы в «тишину» после формы.</p></div>
        <div class="vzaz-tl-item"><div class="vzaz-tl-dot"></div><h3>Скоринг и передача менеджеру</h3><p>Спорные кейсы — в очередь модерации с уведомлением в Telegram.</p></div>
        <div class="vzaz-tl-item"><div class="vzaz-tl-dot"></div><h3>Логи и согласие на ПДн</h3><p>152-ФЗ: явное согласие; guardrails и RAG — без выдуманных цен (RevSure/Ascend2: privacy 54%, accuracy 47% барьеров).</p></div>
      </div>
      {CTA_PRIMARY}
    </div>
  </section>

  <section class="vzaz-section vzaz-section-alt" id="integracii-crm">
    <div class="vzaz-cnt">
      <div class="vzaz-sh nero-ai-reveal">
        <span class="vzaz-eyebrow">CRM</span>
        <h2>Интеграция AI обработки заявок с CRM</h2>
        <p><strong>Интеграция ai обработка заявок с crm</strong> — ядро услуги: без записи в систему агент остаётся чатом, который игнорируют.</p>
      </div>
      <div class="vzaz-grid-2 nero-ai-reveal">
        <div class="vzaz-card">
          <h3>amoCRM, Битрикс24 и другие</h3>
          <p>Сделка из диалога, дедупликация по телефону. Кейс MrBoroAI: запуск 2–8 недель. Velmi: ответ 2–3 ч → 30–40 с, квалифицированные лиды +35% (Хабр).</p>
        </div>
        <div class="vzaz-card">
          <h3>Webhook, Make/n8n</h3>
          <p>Виджет на Tilda, WordPress, Bitrix → Make/n8n/FastAPI → LLM structured output → CRM. G2: 9 из 10 считают критичным единый customer data перед автономией агента.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vzaz-section" id="etapy">
    <div class="vzaz-cnt">
      <div class="vzaz-sh nero-ai-reveal">
        <span class="vzaz-eyebrow">Под ключ</span>
        <h2>Внедрение AI в бизнес-процессы продаж: этапы под ключ</h2>
      </div>
      <div class="vzaz-timeline nero-ai-reveal">
        <div class="vzaz-tl-item"><div class="vzaz-tl-dot"></div><h3>Аудит потерь заявок (30 минут)</h3><p>Формы, SLA, ночные пики, дубли в CRM — карта узких мест.</p></div>
        <div class="vzaz-tl-item"><div class="vzaz-tl-dot"></div><h3>Проектирование сценария</h3><p>Скрипт продаж, критерии «горячего», RAG по FAQ; тест на 50–100 диалогах.</p></div>
        <div class="vzaz-tl-item"><div class="vzaz-tl-dot"></div><h3>Запуск на сайте и сопровождение</h3><p>Пилот 2–3 недели: time-to-first-response, доля автоквалификации, конверсия в созвон.</p></div>
      </div>
      {CTA_SECONDARY}
    </div>
  </section>

  <section class="vzaz-section vzaz-section-alt" id="ceny">
    <div class="vzaz-cnt">
      <div class="vzaz-sh nero-ai-reveal">
        <span class="vzaz-eyebrow">Бюджет</span>
        <h2>Стоимость и сроки: ai обработка заявок для бизнеса</h2>
        <p>Ориентир Nero Network: <strong>120–350 тыс. ₽</strong> за стартовый проект + поддержка.</p>
      </div>
      <div class="vzaz-table-wrap nero-ai-reveal">
        <table class="vzaz-table" aria-label="Из чего складывается чек">
          <thead><tr><th>Компонент</th><th>Содержание</th></tr></thead>
          <tbody>
            <tr><td>Аудит и сценарий</td><td>Воронка, критерии горячего лида</td></tr>
            <tr><td>Backend</td><td>Webhook, очередь, guardrails</td></tr>
            <tr><td>CRM</td><td>Маппинг полей, дедупликация</td></tr>
            <tr><td>RAG и пилот</td><td>Обучение менеджеров, аналитика</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px">Кейс Савви: cost per lead снизился с 116 ₽ до 54 ₽ при +35% заявок (данные заказчика) — не гарантия для каждого проекта.</p>
    </div>
  </section>

  <section class="vzaz-section" id="keisy">
    <div class="vzaz-cnt">
      <div class="vzaz-sh nero-ai-reveal">
        <span class="vzaz-eyebrow">Доверие</span>
        <h2>Примеры внедрения AI и кейсы (услуги, EdTech, клиники)</h2>
      </div>
      <div class="vzaz-case-grid">
        <div class="vzaz-case-card nero-ai-reveal"><div class="vzaz-case-tag">Velmi</div><h3>Bitrix24</h3><p>Ответ 2–3 ч → 30–40 с, квалифицированные лиды +35%.</p></div>
        <div class="vzaz-case-card nero-ai-reveal nero-ai-delay-1"><div class="vzaz-case-tag">BESTERS</div><h3>Авито + Bitrix24</h3><p>95% первички без менеджера, 6500+ сообщений (workspace.ru).</p></div>
        <div class="vzaz-case-card nero-ai-reveal nero-ai-delay-2"><div class="vzaz-case-tag">MrBoroAI</div><h3>amoCRM</h3><p>Сделка из диалога, запуск 2–8 недель.</p></div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px"><strong>Когда агент не нужен:</strong> мало заявок, менеджер отвечает за минуты, нет ночного трафика — честный отказ повышает доверие.</p>
    </div>
  </section>

  <section class="vzaz-section vzaz-section-alt" id="faq">
    <div class="vzaz-cnt">
      <div class="vzaz-sh nero-ai-reveal">
        <span class="vzaz-eyebrow">FAQ</span>
        <h2>FAQ: как внедрить AI обработку заявок на сайт</h2>
      </div>
      <div class="vzaz-faq nero-ai-reveal">
        <div class="vzaz-faq-item"><div class="vzaz-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить ai обработка заявок без хаоса в CRM?</div><div class="vzaz-faq-a"><p>Одна точка входа, маппинг полей, дедупликация, пилот 2–3 недели. Nero Network ведёт внедрение под ключ.</p></div></div>
        <div class="vzaz-faq-item"><div class="vzaz-faq-q" tabindex="0" role="button" aria-expanded="false">Чем ai консультант на сайт отличается от колл-центра?</div><div class="vzaz-faq-a"><p>24/7 в момент интереса, стандартизированные вопросы, запись в CRM. Колл-центр — для сложных переговоров.</p></div></div>
        <div class="vzaz-faq-item"><div class="vzaz-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли без программиста?</div><div class="vzaz-faq-a"><p>Да: подрядчик настраивает виджет и интеграции; с вашей стороны — скрипт продаж и доступ к CRM.</p></div></div>
        <div class="vzaz-faq-item"><div class="vzaz-faq-q" tabindex="0" role="button" aria-expanded="false">AI соврёт клиенту?</div><div class="vzaz-faq-a"><p>Guardrails, RAG по утверждённым документам, запрет автообещаний, эскалация спорных диалогов.</p></div></div>
        <div class="vzaz-faq-item"><div class="vzaz-faq-q" tabindex="0" role="button" aria-expanded="false">Подойдёт ли для малого бизнеса?</div><div class="vzaz-faq-a"><p>Да, при потоке заявок с сайта и заметной задержке ответа. Типовой вход — одна форма.</p></div></div>
        <div class="vzaz-faq-item"><div class="vzaz-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько длится внедрение?</div><div class="vzaz-faq-a"><p>От 7–21 дня за простой сценарий до 2–8 недель при сложной CRM.</p></div></div>
      </div>
    </div>
  </section>

  <section class="vzaz-section" id="kviz" style="background:linear-gradient(135deg,rgba(251,191,36,.08),rgba(139,92,246,.08));">
    <div class="vzaz-cnt" style="text-align:center">
      <span class="vzaz-eyebrow">Квиз</span>
      <h2 style="font-size:clamp(28px,4.2vw,52px);margin:14px auto 16px;max-width:720px;text-align:center">Проверить, сколько заявок вы теряете</h2>
      <p style="max-width:580px;margin:0 auto 28px;font-size:16px;text-align:center">Аудит потерь заявок за 30 минут: SLA, ночной трафик, симуляция обработки заявки — webhook → очередь → AI → CRM.</p>
      <ul class="vzaz-cta-checklist">
        <li>Сопоставление с порогом 10 минут</li>
        <li>Карта форм и дублей в CRM</li>
        <li>Схема под ваш сайт</li>
        <li>Без обязательств</li>
      </ul>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="font-size:16px;padding:16px 36px"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
    </div>
  </section>

</div><!-- /.vzaz-content -->
"""

PHP_HEADER = r"""<?php
/**
 * Template Name: AI обработка заявок с сайта — внедрение агента под ключ
 * Description: Внедрение AI-агента для первичной обработки заявок с сайта: ответ 5–15 секунд, CRM, под ключ.
 */

declare(strict_types=1);

$page_seo_title       = 'AI обработка заявок с сайта — внедрение агента под ключ';
$page_seo_description = 'Внедрение AI-агента для первичной обработки заявок с сайта: ответ за 5–15 секунд, уточняющие вопросы и передача горячего лида в CRM. Под ключ для услуг, школ и клиник. Аудит потерь заявок.';

add_filter(
    'document_title_parts',
    static function (array $parts) use ($page_seo_title): array {
        $parts['title'] = $page_seo_title;
        return $parts;
    },
    20
);

add_action(
    'wp_head',
    static function () use ($page_seo_title, $page_seo_description): void {
        echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
        echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
        echo '<meta property="og:type" content="article" />' . "\n";
    },
    1
);

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Потери заявок', 'href' => '#poteri-zayavok'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Интеграции', 'href' => '#integracii-crm'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить, сколько заявок вы теряете';
$primary_cta_url   = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);

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
"""

PHP_FOOT = r"""
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-obrabotka-zayavok-sajta-page" role="main" tabindex="-1">

"""

PHP_CLOSE = r"""
  <!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
(function(){
  document.querySelectorAll('.vzaz-faq-q').forEach(function(btn){
    btn.addEventListener('click',function(){
      var item=btn.closest('.vzaz-faq-item');
      var isOpen=item.classList.contains('open');
      document.querySelectorAll('.vzaz-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q=el.querySelector('.vzaz-faq-q');if(q)q.setAttribute('aria-expanded','false');
      });
      if(!isOpen){item.classList.add('open');btn.setAttribute('aria-expanded','true');}
    });
    btn.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();btn.click();}});
  });
})();
</script>

<script>
(function(){
  'use strict';
  var root=document.querySelector('.vzaz-content');
  if(!root)return;
  var items=root.querySelectorAll('.nero-ai-reveal');
  if('IntersectionObserver' in window){
    var observer=new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){entry.target.classList.add('nero-ai-active');observer.unobserve(entry.target);}
      });
    },{threshold:0.1,rootMargin:'0px 0px -6% 0px'});
    items.forEach(function(item){observer.observe(item);});
  }else{items.forEach(function(item){item.classList.add('nero-ai-active');});}
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
"""

out_path = ROOT / 'wordpress-theme' / 'page-vnedrenie-ai-obrabotka-zayavok-sajta.php'
out_path.parent.mkdir(parents=True, exist_ok=True)

full = PHP_HEADER + CONTENT_CSS + PHP_FOOT + hero + "\n\n" + CONTENT_HTML + PHP_CLOSE
out_path.write_text(full, encoding='utf-8')
print('written', out_path, 'bytes', out_path.stat().st_size)

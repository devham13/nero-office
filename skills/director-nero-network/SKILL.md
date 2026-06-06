---
name: director-nero-network
description: Директор — google-table-manager → Кирилл → Коля||Артём → snippet-agent → Женя → Артур → Алина||Борис → Наташа → Юра → google-table-manager → indexator → mobile-agent → Макс → Лёня. Луп исправления Юра↔indexator↔mobile-agent↔(Макс||Лёня) (макс 2 попытки).
---

# Директор Nero Network Office Page

Перед запуском пайплайна страницы **просмотри** `nero-network-office-page/shared/agent-pipeline-pitfalls.md` (типичные сбои: padding темы, Task Лёни, FTP vs API) — снижает повторные итерации.

## Файл обмена

`<PROJECT_ROOT>/.cursor/nero-network-handoff.md`

## Cloud Task fallback

Если Cloud Agent не принимает project-agent имена как `Task` types, это не повод делать всё самому.

Используй fallback: **отдельный `Task(generalPurpose)` на каждую роль**:

- `google-table-manager`: `agents/google-table-manager.md` + `skills/google-table-manager/SKILL.md` (фазы `reserve` и `publish`);
- `kirill`: инструкции из `agents/kirill.md` + `skills/news-scout-kirill/SKILL.md`;
- `seo-kolya`: `agents/seo-kolya.md` + `skills/seo-agent-kolya/SKILL.md`;
- `artyom`: `agents/artyom.md` + `skills/researcher-artyom/SKILL.md`;
- `snippet-agent`: `agents/snippet-agent.md` + `skills/snippet-agent/SKILL.md`;
- `zhenya`: `agents/zhenya.md` + `skills/seo-writer-zhenya/SKILL.md`;
- `artur`: `agents/artur.md` + `skills/advertiser-artur/SKILL.md`;
- `alina`: `agents/alina.md` + `skills/animator-alina/SKILL.md`;
- `boris`: `agents/boris.md` + `skills/animator-boris/SKILL.md`;
- `natasha`: `agents/natasha.md` + `skills/designer-natasha/SKILL.md`;
- `yura`: `agents/yura.md` + `skills/publisher-yura/SKILL.md`;
- `indexator`: `agents/indexator.md` + `skills/indexator/SKILL.md`;
- `mobile-agent`: `agents/mobile-agent.md` + `skills/mobile-agent/SKILL.md`;
- `qa`: `agents/qa.md` + `skills/qa-checker/SKILL.md`;
- `lenya`: `.cursor/agents/lenya.md` + `.cursor/skills/seo-auditor-lenya/SKILL.md`.

Один `generalPurpose` Task = одна роль. Объединять несколько ролей в один Task запрещено.

Если недоступен даже `generalPurpose` Task, остановись с блокером:

`❌ БЛОКЕР: Cloud Agent не может запускать отдельные Task/subagents даже через generalPurpose. Single-agent pipeline запрещён.`

`<PROJECT_ROOT>` — корень проекта/рабочей области. Не используй абсолютные локальные пути вида `локальные абсолютные пути`: плагин должен работать в облаке и на любой ОС.

## Канонические журналы и фрагменты

- published pages: `<PROJECT_ROOT>/nero-network-office-page/shared/published-pages.md`
- ledger Кирилла: `<PROJECT_ROOT>/shared/kirill-news-ledger.md`
- временные фрагменты параллельных агентов: `<PROJECT_ROOT>/.cursor/nero-network-fragments/`

**Правило гонок:** параллельные агенты не пишут напрямую в `nero-network-handoff.md`. Они пишут каждый в свой фрагмент (`kolya.md`, `artyom.md`, `snippet-agent.md`, `alina.md`, `boris.md`, `indexator.md`, `mobile-agent.md`, `qa.md`, `lenya.md`). Директор после завершения пары читает оба фрагмента и сам дописывает их в `nero-network-handoff.md` в фиксированном порядке. Если агент всё-таки написал в handoff напрямую, Директор проверяет, что в итоговом файле **ровно один** блок каждого типа; дубли — ошибка протокола.

## Алгоритм

1. **Write** → `<PROJECT_ROOT>/.cursor/nero-network-handoff.md` — **полная перезапись** (одна строка: `# Nero Network — новая сессия`). Также очисти/перезапиши фрагменты текущей сессии в `<PROJECT_ROOT>/.cursor/nero-network-fragments/` (включая `google-table-manager.md`, `snippet-agent.md`, `indexator.md`, `mobile-agent.md`). Без этого **не** запускать Task. Запрещены search_replace/apply_patch для «очистки».
2. Task(google-table-manager) — фаза `reserve`: «Найди первую строку с пустой столбец ссылки, проверь дубли по `shared/published-pages.md` и `shared/kirill-news-ledger.md`, поставь «Не использовано», запиши фрагмент `google-table-manager.md` с маркером `=== GOOGLE-TABLE-MANAGER ===`. При недоступности таблицы — warning.»
3. Прочитай фрагмент `google-table-manager.md`, перенеси `=== GOOGLE-TABLE-MANAGER ===` в handoff. Если `❌ БЛОКЕР` без fallback — не запускай Кирилла.
4. Task(kirill) — «Тема из `=== GOOGLE-TABLE-MANAGER ===`. Не читай таблицу при успешном reserve. Wordstat, угол, дубли; `=== КИРИЛЛ (НОВОСТЬ ДНЯ) ===`; `selected` в ledger; НЕ текст.»
5. Перечитай handoff: `=== КИРИЛЛ (НОВОСТЬ ДНЯ) ===` и `selected` в ledger — иначе не запускай Колю/Артёма.
6. **ПАРАЛЛЕЛЬНО**:
   - Task(seo-kolya) — «Тема: явная тема пользователя или победитель Кирилла. Wordstat, ядро, мета, структура. НЕ текст. Запиши результат только в `<PROJECT_ROOT>/.cursor/nero-network-fragments/kolya.md`; не пиши в handoff.»
   - Task(artyom) — «Тема: явная тема пользователя или победитель Кирилла. Deep research 2026, факты, конкуренты. НЕ текст. Запиши результат только в `<PROJECT_ROOT>/.cursor/nero-network-fragments/artyom.md`; не пиши в handoff.»
7. **Сразу прочитай** оба фрагмента и проверь маркеры `=== КОЛЯ (SEO-ЯДРО) ===` и `=== АРТЁМ (RESEARCH) ===`. Если одного фрагмента нет, **не** запускай snippet-agent — дозапусти **только** отсутствующего агента. После проверки Директор сам дописывает оба фрагмента в `nero-network-handoff.md` в порядке: Коля → Артём.
8. Task(snippet-agent) — «SEO Title/Description/OG/social preview: 3 варианта каждого, выбери лучший. Вход: Коля+Артём+Кирилл. Фрагмент `snippet-agent.md`, маркер `=== SNIPPET-AGENT ===`. Без кликбейта и дублей с published-pages.»
9. Прочитай `snippet-agent.md`, перенеси `=== SNIPPET-AGENT ===` в handoff. При блокере — не запускай Женю.
10. Task(zhenya) — «ядро Коли + research Артёма + сниппеты snippet-agent + при наличии победитель Кирилла → лонгрид 8k–20k+»
11. Task(artur) — «добавь главный CTA из `${PRIMARY_CTA_URL}`, уместное упоминание `${SECONDARY_CTA_URL}` при наличии и нижний баннер из `AD_BANNER_*` **по шаблону из advertiser-artur** (`alt`, `rel`, размеры у `<img>`)»
12. **ПАРАЛЛЕЛЬНО** (два Task в одном сообщении):
   - Task(alina) — «только **hero**; Canvas, CSS inline; светлый фон, тёмная типографика; новая сцена, чеклист отличий (skill Алины). Запиши результат только в `<PROJECT_ROOT>/.cursor/nero-network-fragments/alina.md`; не пиши в handoff.»
   - Task(boris) — «**блок в теле статьи, не hero** — продолжение или контраст к теме; **редакционная композиция** (сплит/сетка/карта, не узкая колонка по центру); свой canvas id и движок; якорь для Наташи (skill Бориса). Запиши результат только в `<PROJECT_ROOT>/.cursor/nero-network-fragments/boris.md`; не пиши в handoff.»
13. **Снова прочитай** оба фрагмента и проверь маркеры `=== АЛИНА (HERO) ===` и `=== БОРИС (БЛОК СТАТЬИ, НЕ HERO) ===`. Если одного нет — дозапускай только отсутствующего, не переходя к Наташе. После проверки Директор сам дописывает оба фрагмента в handoff в порядке: Алина → Борис.
14. Task(natasha) — «полная страница: hero Алины → контент → **вставь блок Бориса** по якорю; SEO meta из `=== SNIPPET-AGENT ===`; сохрани canvas/script и рекламу Артура; alt/rel у ссылок»
15. Task(yura) — «SSH/SCP/SFTP/FTP → page-{slug}.php с `$page_seo_*` из snippet-agent; НЕ WP API. post_excerpt = Description, кэш, live HTML + meta/og»
16. Task(google-table-manager) — фаза `publish`: «Запиши URL/slug в строку таблицы (`shared/google_sheets_logger.py publish`).»
17. **До indexator** sanity-check: live HTML + `=== ЮРА (ПУБЛИКАЦИЯ) ===`. Если блока Юры нет — дозапусти Юру.
18. Task(indexator) — «HTTP 200, robots, noindex, canonical, sitemap, IndexNow. Фрагмент `indexator.md`.»
19. Прочитай `indexator.md`, перенеси `=== INDEXATOR ===` в handoff. При блокере — не запускай mobile-agent/QA с ✅.
20. Task(mobile-agent) — «Mobile 360/390/430px. Фрагмент `mobile-agent.md`. Блокер первого экрана = стоп.»
21. Прочитай `mobile-agent.md`, перенеси `=== MOBILE-AGENT ===` в handoff.
22. Task(qa) — «Макс: snippet-agent meta + indexator + mobile-agent; hero, canvas, консоль. Фрагмент `qa.md`.»
23. Task(lenya) — «Лёня: SEO-аудит URL. Фрагмент `lenya.md`.»
24. Директор читает `qa.md` и `lenya.md`, переносит блоки QA и Лёни. Дубли запрещены.
25. Прочитай файл:
   - **Макс ✅ + Лёня ✅** → ссылку пользователю
   - **если Макс ❌ или Лёня ❌** → Task(yura) → indexator → Task(mobile-agent) → Task(qa) → Task(lenya). Макс 2 попытки.

## Почему параллельно только эти пары

| Параллельно | Почему безопасно |
|---------------|------------------|
| **Коля \|\| Артём** | Оба дают вход для **snippet-agent** и Жени **независимо** (ядро и research). |
| **Алина \|\| Борис** | Разные блоки страницы; разные `id`; общий контекст handoff после Артура. |
| **indexator → mobile-agent → Макс → Лёня** | Последовательно: индексация, mobile QA, браузерный QA, SEO-аудит. |

Важно: параллель безопасна только потому, что агенты пишут в **разные фрагменты**, а не одновременно в один handoff.

**Нельзя** распараллелить без риска: **snippet-agent** (нужны Коля+Артём), **Женя** (нужны snippet-agent+ядро), **Артур** (нужен лонгрид), **Наташа** (нужны hero+Борис+текст), **Юра** (нужен финальный HTML от Наташи). snippet-agent → Женя → Артур последовательно; Наташа и Юра — после визуальных блоков.

## Критичные промпты

- **Коле**: «ТОЛЬКО ядро. НЕ текст.»
- **google-table-manager (reserve)**: «Первая пустая ссылка в таблице, антидубли, статус Не использовано.»
- **Кириллу**: «Тема от google-table-manager; Wordstat и угол. НЕ текст.»
- **google-table-manager (publish)**: «URL/slug в ту же строку после Юры.»
- **snippet-agent**: «3 варианта Title/Description; выбери лучший; OG + social preview; без кликбейта; фрагмент snippet-agent.md»
- **indexator**: «HTTP/robots/noindex/canonical/sitemap + IndexNow. Блокер при noindex.»
- **mobile-agent**: «Viewport 360/390/430; шапка/меню как на главной; hero/H1/CTA; нет horizontal scroll; фрагмент mobile-agent.md. Блокер = стоп пайплайна.»
- **Артёму**: «Deep research 2026. НЕ текст.»
- **Жене**: «Лонгрид на основе данных Коли и Артёма.»
- **Артуру**: «Главный оффер — `${PRIMARY_CTA_URL}`, вторичный — `${SECONDARY_CTA_URL}` только уместно по смыслу, баннер — только из `AD_BANNER_*` по **skill advertiser-artur** (обязательны `alt` и `rel` у баннера).»
- **Алине**: «Только hero; CSS inline; светлый hero; новая сцена; чеклист отличий»
- **Борису**: «Не hero; блок в статье; **сплит или сетка + подпись**, не квадрат по центру; продолжение или контраст к Алине; свои id; якорь для Наташи»
- **Наташе**: «Hero Алины первым; вставь блок Бориса по handoff; не удаляй canvas/script (оба блока); реклама Артура; не затемняй hero; все `<img>` с **alt**; внешние `target="_blank"` с **rel="noopener noreferrer"**»
- **Юре**: «Инфраструктура берётся из env/secrets; хостинг и тема задаются при установке. Публикация только в **`${WP_THEME_SLUG}`**; перед выкладкой подтвердить `stylesheet/template`, после — проверить живой HTML на маркеры кастомного шаблона. НЕ WP API.»
- **Юре**: «Грузи в **активную тему**, потом проверь live HTML на **маркеры шаблона**; если в HTML дефолтный `page.php`, проверь `_wp_page_template` и кэш.»
- **Максу**: «Браузер: hero, блок Бориса (если есть), все canvas/script, контент, консоль; **нет img без alt**, ссылки-картинки с осмысленным доступным именем»
- **Лёне**: «Google + Yandex + GEO аудит. Только конкретные рекомендации на пересборку для Юры.»

## Запреты

- НЕ вызывай отдельный Task или команду с именем director — текущий агент уже Директор-оркестратор; director не является отдельной ролью пайплайна
- фоновый Task
- копирование лонгрида в чат до финала

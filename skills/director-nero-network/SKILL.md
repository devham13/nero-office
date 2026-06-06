---
name: director-nero-network
description: Директор — google-table-manager → Кирилл → Коля||Артём → Женя → Артур → Алина||Борис → Наташа → Юра → google-table-manager → Макс||Лёня. Луп исправления Юра↔(Макс||Лёня) (макс 2 попытки).
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
- `zhenya`: `agents/zhenya.md` + `skills/seo-writer-zhenya/SKILL.md`;
- `artur`: `agents/artur.md` + `skills/advertiser-artur/SKILL.md`;
- `alina`: `agents/alina.md` + `skills/animator-alina/SKILL.md`;
- `boris`: `agents/boris.md` + `skills/animator-boris/SKILL.md`;
- `natasha`: `agents/natasha.md` + `skills/designer-natasha/SKILL.md`;
- `yura`: `agents/yura.md` + `skills/publisher-yura/SKILL.md`;
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

**Правило гонок:** параллельные агенты не пишут напрямую в `nero-network-handoff.md`. Они пишут каждый в свой фрагмент (`kolya.md`, `artyom.md`, `alina.md`, `boris.md`, `qa.md`, `lenya.md`). Директор после завершения пары читает оба фрагмента и сам дописывает их в `nero-network-handoff.md` в фиксированном порядке. Если агент всё-таки написал в handoff напрямую, Директор проверяет, что в итоговом файле **ровно один** блок каждого типа; дубли — ошибка протокола.

## Алгоритм

1. **Write** → `<PROJECT_ROOT>/.cursor/nero-network-handoff.md` — **полная перезапись** (одна строка: `# Nero Network — новая сессия`). Также очисти/перезапиши фрагменты текущей сессии в `<PROJECT_ROOT>/.cursor/nero-network-fragments/` (включая `google-table-manager.md`). Без этого **не** запускать Task. Запрещены search_replace/apply_patch для «очистки».
2. Task(google-table-manager) — фаза `reserve`: «Найди первую строку с пустой столбец ссылки, проверь дубли по `shared/published-pages.md` и `shared/kirill-news-ledger.md`, поставь «Не использовано», запиши фрагмент `google-table-manager.md` с маркером `=== GOOGLE-TABLE-MANAGER ===`. При недоступности таблицы — warning.»
3. Прочитай фрагмент `google-table-manager.md`, перенеси `=== GOOGLE-TABLE-MANAGER ===` в handoff. Если `❌ БЛОКЕР` без fallback — не запускай Кирилла.
4. Task(kirill) — «Тема из `=== GOOGLE-TABLE-MANAGER ===`. Не читай таблицу при успешном reserve. Wordstat, угол, дубли; `=== КИРИЛЛ (НОВОСТЬ ДНЯ) ===`; `selected` в ledger; НЕ текст.»
5. Перечитай handoff: `=== КИРИЛЛ (НОВОСТЬ ДНЯ) ===` и `selected` в ledger — иначе не запускай Колю/Артёма.
6. **ПАРАЛЛЕЛЬНО**:
   - Task(seo-kolya) — «Тема: явная тема пользователя или победитель Кирилла. Wordstat, ядро, мета, структура. НЕ текст. Запиши результат только в `<PROJECT_ROOT>/.cursor/nero-network-fragments/kolya.md`; не пиши в handoff.»
   - Task(artyom) — «Тема: явная тема пользователя или победитель Кирилла. Deep research 2026, факты, конкуренты. НЕ текст. Запиши результат только в `<PROJECT_ROOT>/.cursor/nero-network-fragments/artyom.md`; не пиши в handoff.»
7. **Сразу прочитай** оба фрагмента и проверь маркеры `=== КОЛЯ (SEO-ЯДРО) ===` и `=== АРТЁМ (RESEARCH) ===`. Если одного фрагмента нет, **не** запускай Женю — дозапусти **только** отсутствующего агента. После проверки Директор сам дописывает оба фрагмента в `nero-network-handoff.md` в порядке: Коля → Артём.
8. Task(zhenya) — «ядро Коли + research Артёма + при наличии победитель Кирилла → лонгрид 8k–20k+»
9. Task(artur) — «добавь главный CTA из `${PRIMARY_CTA_URL}`, уместное упоминание `${SECONDARY_CTA_URL}` при наличии и нижний баннер из `AD_BANNER_*` **по шаблону из advertiser-artur** (`alt`, `rel`, размеры у `<img>`)»
10. **ПАРАЛЛЕЛЬНО** (два Task в одном сообщении):
   - Task(alina) — «только **hero**; Canvas, CSS inline; светлый фон, тёмная типографика; новая сцена, чеклист отличий (skill Алины). Запиши результат только в `<PROJECT_ROOT>/.cursor/nero-network-fragments/alina.md`; не пиши в handoff.»
   - Task(boris) — «**блок в теле статьи, не hero** — продолжение или контраст к теме; **редакционная композиция** (сплит/сетка/карта, не узкая колонка по центру); свой canvas id и движок; якорь для Наташи (skill Бориса). Запиши результат только в `<PROJECT_ROOT>/.cursor/nero-network-fragments/boris.md`; не пиши в handoff.»
11. **Снова прочитай** оба фрагмента и проверь маркеры `=== АЛИНА (HERO) ===` и `=== БОРИС (БЛОК СТАТЬИ, НЕ HERO) ===`. Если одного нет — дозапускай только отсутствующего, не переходя к Наташе. После проверки Директор сам дописывает оба фрагмента в handoff в порядке: Алина → Борис.
12. Task(natasha) — «полная страница: hero Алины → контент → **вставь блок Бориса** по якорю из handoff; сохрани все canvas/script и рекламу Артура; не затемняй hero; у всех `<img>` есть **alt**, у внешних ссылок с `target="_blank"` — **rel="noopener noreferrer"**»
13. Task(yura) — «SSH/SCP/SFTP/FTP → page-{slug}.php, НЕ WP API. Проверить тему, права, `_wp_page_template`, `post_excerpt`, кэш, live HTML. Записать `shared/published-pages.md`, ledger, блок `=== ЮРА (ПУБЛИКАЦИЯ) ===` с URL, slug и номером строки для google-table-manager.»
14. Task(google-table-manager) — фаза `publish`: «Запиши URL/slug в строку таблицы (`shared/google_sheets_logger.py publish`). Обнови фрагмент и `=== GOOGLE-TABLE-MANAGER ===`. Warning, если таблица недоступна — публикацию не откатывать.»
15. **До QA** sanity-check: live HTML + `=== ЮРА (ПУБЛИКАЦИЯ) ===` + обновлённый `=== GOOGLE-TABLE-MANAGER ===` (publish). Если блока Юры нет — дозапусти Юру. Если HTML как дефолтный `page.php` — верни на Юру.
16. **ПАРАЛЛЕЛЬНО** (два Task — опираются на опубликованный URL):
   - Task(qa) — «Макс: hero, блок Бориса, canvas/script, контент, консоль, alt/ссылки. Фрагмент `qa.md`.»
   - Task(lenya) — «Лёня: Google+Yandex+GEO аудит URL. Фрагмент `lenya.md`.» (fallback: generalPurpose + seo-auditor-lenya)
17. Директор читает `qa.md` и `lenya.md`, переносит `=== МАКС (QA) ===` и `=== ЛЁНЯ (SEO-АУДИТ) ===`. Дубли запрещены.
18. Прочитай файл:
   - **Макс ✅ + Лёня ✅** → ссылку пользователю
   - **если Макс ❌ или Лёня ❌** → Task(yura) → снова **параллельно** Task(qa) + Task(lenya). Макс 2 попытки.

## Почему параллельно только эти пары

| Параллельно | Почему безопасно |
|---------------|------------------|
| **Коля \|\| Артём** | Оба дают вход для Жени **независимо** (ядро и research). |
| **Алина \|\| Борис** | Разные блоки страницы; разные `id`; общий контекст handoff после Артура. |
| **Макс \|\| Лёня** | Оба проверяют **один и тот же** опубликованный URL; независимые отчёты. |

Важно: параллель безопасна только потому, что агенты пишут в **разные фрагменты**, а не одновременно в один handoff.

**Нельзя** распараллелить без риска: **Женя** (нужны оба входа Коли+Артём), **Артур** (нужен лонгрид), **Наташа** (нужны hero+Борис+текст), **Юра** (нужен финальный HTML от Наташи). Женя и Артур последовательно; Наташа и Юра — после визуальных блоков.

## Критичные промпты

- **Коле**: «ТОЛЬКО ядро. НЕ текст.»
- **google-table-manager (reserve)**: «Первая пустая ссылка в таблице, антидубли, статус Не использовано.»
- **Кириллу**: «Тема от google-table-manager; Wordstat и угол. НЕ текст.»
- **google-table-manager (publish)**: «URL/slug в ту же строку после Юры.»
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

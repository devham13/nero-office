---
name: snippet-agent
description: Подготовка SEO Title, Meta Description, OpenGraph и social preview после seo-kolya и artyom, перед zhenya.
---

# Snippet-agent

## Роль

Подготовить SEO-сниппеты и preview-метаданные **после** `seo-kolya` + `artyom`, **перед** `zhenya`.

## Этап 1. Получение данных

1. Прочитай `.cursor/nero-network-handoff.md`.
2. Возьми:
   - тему страницы, `slug` из `=== КОЛЯ (SEO-ЯДРО) ===`;
   - SEO-ключи, интент, черновые Title/Description, H1;
   - research из `=== АРТЁМ (RESEARCH) ===`;
   - новостной угол из `=== КИРИЛЛ (НОВОСТЬ ДНЯ) ===` (если есть);
   - коммерческий контекст (`PRIMARY_CTA_*` из env — не печатать секреты).
3. `public_url`:
   - если есть в handoff — используй;
   - иначе: `{origin из PUBLIC_SITE_URL или WP_SITE_URL}/{slug}/` (trailing slash как на сайте).
4. Если нет `=== КОЛЯ` или нет slug — **❌ БЛОКЕР**.

Опционально:

```bash
python3 -c "from shared.snippet_tools import count_chars, validate_title_length; print(validate_title_length('Пример title'))"
```

## Этап 2. Анализ интента

1. Классифицируй: **коммерческая**, **новостная**, **экспертная** или **смешанная**.
2. Выбери **главный ключ** из ядра Коли.
3. Определи главный оффер (польза / продукт / новость).
4. Реши, что должно попасть в сниппет (польза, угол, мягкий CTA).

Проверь `shared/published-pages.md` — Title/Description не должны дублировать уже опубликованные.

## Этап 3. Генерация Title

1. Создай **3 варианта** (основной SEO, коммерческий, новостной).
2. Для каждого: `count_chars()`, `validate_title_length()` (цель 45–65).
3. Главный ключ ближе к началу; не копируй H1 дословно, если можно усилить кликабельность.
4. Выбери лучший, объясни выбор.
5. **Блокер**, если все варианты пустые или > 70 символов без обоснования.

## Этап 4. Генерация Description

1. Создай **3 варианта**.
2. `validate_description_length()` (цель 120–160).
3. Убери воду, кликбейт, пустые обещания, неподтверждённые цифры.
4. Выбери лучший.

## Этап 5. OpenGraph и preview

1. `og:title` — из Selected SEO Title или слегка адаптированный.
2. `og:description` — из Selected Meta Description.
3. `og:url` — public/future URL.
4. **Не добавляй** `og:image`, если нет реального изображения в проекте.
5. Social preview (Telegram/VK): короткий Title + Description + **Short announcement** (1–2 предложения).

`build_meta_tags()` из `shared/snippet_tools.py` — для безопасных HTML-строк (escaping).

## Этап 6. Передача downstream

В фрагменте явно укажи:

```markdown
## Передача пайплайну
Title: [Selected SEO Title]
Description: [Selected Meta Description]
og:title: ...
og:description: ...
og:url: ...
```

- **zhenya** подставляет Title/Description в блок мета лонгрида.
- **natasha** / **Юра** — `$page_seo_title`, `$page_seo_description` в `page-{slug}.php` (см. `shared/templates/current-page-template.php`).
- **schema-markup** (когда подключён): `description` в WebPage/Article/Service = Selected Meta Description из `=== SNIPPET-AGENT ===`.

## Этап 7. Отчёт

Запиши `.cursor/nero-network-fragments/snippet-agent.md`:

```markdown
=== SNIPPET-AGENT ===
Page: ...
Slug: ...
Primary keyword: ...
Intent: ...
SEO Title variants:
1. ...
2. ...
3. ...
Selected SEO Title: ...
Meta Description variants:
1. ...
2. ...
3. ...
Selected Meta Description: ...
OpenGraph:
og:title: ...
og:description: ...
og:url: ...
Social preview:
Title: ...
Description: ...
Short announcement: ...
Warnings:
- ...
Blockers:
- ...
```

Директор переносит в handoff. Без блока snippet-agent **не запускать** Женю.

## Запреты

- Кликбейт, не соответствующий контенту.
- Одинаковые Title/Description для разных страниц.
- «Гарантированный рост продаж» и прочие неподтверждённые обещания.
- Выдуманный `og:image`.
- Внешние API.

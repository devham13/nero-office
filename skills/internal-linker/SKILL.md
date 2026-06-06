---
name: internal-linker
description: Внутренняя перелинковка новых лонгридов с опубликованными страницами сайта.
---

# Internal Linker

## Роль

После **schema-markup**, до **Юры**: подобрать внутренние ссылки и передать готовые HTML-вставки для `page-{slug}.php`.

## Этап 1. Получение данных

1. Handoff: Наташа, Коля, Кирилл, Женя (если есть).
2. `topic`, `slug`, SEO-ключи, структура, текст лонгрида.
3. Будущий URL: `{PUBLIC_SITE_URL}/{slug}/` (trailing slash).

## Этап 2. Поиск опубликованных страниц

```python
from shared.internal_linking import parse_published_pages, validate_internal_url

pages = parse_published_pages()
```

Дополнительно:

- `shared/published-pages.md`
- `shared/kirill-news-ledger.md` (`published`)
- Google Таблица — строки со столбцом ссылки (env `GOOGLE_SHEET_ID`, webhook)
- `wordpress/page-*.php`

Исключить текущий slug, дубли, нерелевантное.

## Этап 3. Оценка релевантности

```python
from shared.internal_linking import score_relevance, suggest_internal_links

outgoing = suggest_internal_links(topic, slug, keywords)
```

Учитывать: тему, ключи Коли, коммерческий интент, отрасль, технологию, боль клиента.

## Этап 4. Исходящие ссылки (3–7)

Для каждой ссылки:

- URL (только published)
- естественный анкор
- место вставки (секция H2 / абзац)
- причина

Правила:

- не ставить ссылки подряд;
- не дублировать URL;
- разные анкоры.

Пример вставки для Юры:

```html
<a href="https://{host}/{old-slug}/">естественный анкор</a>
```

## Этап 5. Обратная перелинковка (1–5)

```python
from shared.internal_linking import suggest_incoming_links

incoming = suggest_incoming_links(topic, new_url, slug, keywords)
```

**Только рекомендации** в handoff. Авто-правка старых `page-*.php` — только если Директор явно разрешил безопасный патч.

## Этап 6. Передача Юре

1. Фрагмент `internal-linker.md` с готовыми HTML-фрагментами.
2. Юра вставляет ссылки в тело лонгрида **до** публикации.
3. Наташа/Борис при пересборке — сохраняют естественность текста и не ломают PHP.

## Этап 7. Отчёт

`.cursor/nero-network-fragments/internal-linker.md` → `=== INTERNAL-LINKER ===`.

## Валидация

```python
ok, reason = validate_internal_url(url, pages)
```

Запрещено: `/wp-admin`, `wp-login.php`, search, внешние домены, URL не из журнала.

## Безопасность

- Не выводить секреты.
- Не коммитить `.env`.

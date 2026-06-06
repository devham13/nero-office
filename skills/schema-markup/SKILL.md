---
name: schema-markup
description: Генерация и проверка Schema.org JSON-LD для лонгридов Nero Network после Наташи.
---

# Schema Markup

## Роль

После **Наташи**, до **Юры**: собрать валидный JSON-LD и передать готовый `<script type="application/ld+json">` для вставки в `page-{slug}.php`.

## Этап 1. Получение данных

1. Прочитай handoff:
   - `=== НАТАША (HTML СТРАНИЦЫ) ===` — HTML/структура, FAQ, H1;
   - `=== КОЛЯ (SEO-ЯДРО) ===` — Title, Description;
   - `=== КИРИЛЛ (НОВОСТЬ ДНЯ) ===` — тема, коммерческий угол;
   - slug из handoff (`SLUG_КАНДИДАТ` или блок Наташи).
2. `title` ← SEO Title; `description` ← SEO Description; `h1` ← H1 страницы.
3. `public_url`: если известен из Юры — используй; иначе `{PUBLIC_SITE_URL}/{slug}/` (trailing slash).
4. Извлеки FAQ только из **видимого** FAQ-блока страницы (секция `#faq` или аналог).

## Этап 2. Выбор типов Schema.org

Всегда: **WebPage**, **Organization**, **WebSite**, **BreadcrumbList**.

Дополнительно:

- Коммерческая посадочная → **Service** (`page_type=service`);
- Новостная/аналитическая → **Article** (`page_type=article`);
- Есть FAQ на странице → **FAQPage**;
- Product / LocalBusiness — только при явных данных в handoff.

## Этап 3. Генерация JSON-LD

1. Вызови `shared/schema_markup.py`:

```python
from shared.schema_markup import build_schema_graph, wrap_ld_json_script, validate_json_ld

json_ld = build_schema_graph(
    title="...",
    description="...",
    url="https://{host}/{slug}/",
    slug="...",
    page_type="service",
    faq_items=[{"question": "...", "answer": "..."}],
    h1="...",
)
ok, msg = validate_json_ld(json_ld)
block = wrap_ld_json_script(json_ld)
```

2. `@graph` с `@id` для сущностей.
3. BreadcrumbList: Главная → текущая страница.
4. Organization.name — из `SITE_BRAND` или get_bloginfo (без выдуманного бренда).

## Этап 4. Проверка

- `json.loads()` проходит;
- нет пустых обязательных полей (title, description, url);
- FAQPage только при непустом FAQ из HTML;
- нет `aggregateRating`, `review`, `price`, `address`, `telephone`, `email` без данных;
- `url` соответствует slug.

При невалидном JSON — **❌ БЛОКЕР**.

## Этап 5. Передача Юре

1. В фрагменте `schema-markup.md` — полный блок `<script type="application/ld+json">...</script>`.
2. Укажи позицию: **перед `</main>`** (предпочтительно) или перед `<?php get_footer(); ?>`.
3. Юра вставляет блок в `page-{slug}.php` без нарушения PHP-синтаксиса.
4. Наташа при пересборке сохраняет placeholder-комментарий `<!-- SCHEMA-MARKUP:INSERT -->` опционально; Юра заменяет на готовый блок.

## Этап 6. Отчёт

Запиши `.cursor/nero-network-fragments/schema-markup.md`:

```markdown
=== SCHEMA-MARKUP ===
Types:
- Organization
- WebSite
- WebPage
- BreadcrumbList
- Service

JSON-LD status: valid
Validation: ok

Warnings:
- ...

Blockers:
- ...
```

Директор переносит в handoff.

## Безопасность

- Не коммитить ключи и `.env`.
- Не придумывать факты для Schema.org.

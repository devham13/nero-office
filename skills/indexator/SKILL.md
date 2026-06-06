---
name: indexator
description: Проверка индексационной готовности страницы и уведомление IndexNow после публикации Юры.
---

# Indexator

## Роль

Проверить, что опубликованная страница готова к индексации, и отправить URL в IndexNow. Запускается **после Юры**, **перед mobile-agent**.

## Env (не печатать значения)

| Переменная | Назначение |
|------------|------------|
| `INDEXNOW_KEY` | Ключ IndexNow |
| `INDEXNOW_HOST` | Хост сайта (если пуст — из URL страницы) |
| `PUBLIC_SITE_URL` / `WP_SITE_URL` | Базовый URL для sitemap/robots |

## Этап 1. Получение URL

1. Прочитай handoff: `=== ЮРА (ПУБЛИКАЦИЯ) ===`.
2. Возьми `public_url` (строка `URL:`).
3. Если URL отсутствует — статус `❌ БЛОКЕР`, фрагмент с причиной, стоп.

## Этап 2. HTTP-проверка

1. `curl -sI -L` или эквивалент: финальный статус **200**.
2. Отклони 403, 404, 500.
3. Зафиксируй редиректы: допустим trailing slash / http→https; недопустим редирект на 404/главную без причины.

## Этап 3. robots / noindex

1. Загрузи `{origin}/robots.txt` (origin из `PUBLIC_SITE_URL` или URL страницы).
2. Проверь, что путь страницы не попадает под `Disallow`.
3. Загрузи HTML страницы:
   - `<meta name="robots" content="...">` — не должно быть `noindex`.
4. Проверь заголовок `X-Robots-Tag` — не должно быть `noindex`.
5. **noindex найден → ❌ БЛОКЕР.**

## Этап 4. canonical

1. Найди `<link rel="canonical" href="...">`.
2. Сравни с `public_url` (нормализуй trailing slash).
3. Совпадает или эквивалентен — OK.
4. Canonical на другую страницу — **warning**; если явный чужой URL (другой slug) — **блокер**.

## Этап 5. sitemap

1. Проверь `{origin}/wp-sitemap.xml` — HTTP 200, валидный XML.
2. Поиск URL в sitemap (прямо или через вложенные sitemap WP).
3. URL ещё не в sitemap — **warning** («ожидается автообновление WP sitemap»), не блокер.

## Этап 6. IndexNow

1. Проверь `shared/indexnow_notifier.py`.
2. Вызов:
   ```bash
   python3 -c "from shared.indexnow_notifier import notify_indexnow; import sys; sys.exit(0 if notify_indexnow('PUBLIC_URL') else 1)"
   ```
   (подставь реальный URL из handoff)
3. Или импорт `notify_indexnow(public_url)` в скрипте агента.
4. Успех: HTTP 200/202. Ошибка или нет ключа — **warning**, не блокер публикации.
5. **Не** использовать Google Indexing API.

### Формат POST IndexNow

- Endpoint: `https://api.indexnow.org/indexnow`
- JSON: `host`, `key`, `keyLocation`, `urlList`
- `keyLocation`: `https://{host}/{INDEXNOW_KEY}.txt`

## Этап 7. Отчёт

Запиши `.cursor/nero-network-fragments/indexator.md`:

```markdown
=== INDEXATOR ===
URL: ...
HTTP: ...
Robots: ...
Meta robots: ...
X-Robots-Tag: ...
Canonical: ...
Sitemap: ...
IndexNow: ...

Warnings:
- ...

Blockers:
- ...
```

Директор переносит блок в handoff. При блокере QA **не** должен пропускать страницу.

## Безопасность

- Не выводить `INDEXNOW_KEY` целиком.
- Не коммитить ключи и `.env`.

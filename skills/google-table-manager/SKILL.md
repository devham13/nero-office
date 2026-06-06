---
name: google-table-manager
description: Менеджер Google Таблицы тем Nero Network — резерв темы, статус «Не использовано», запись URL после публикации.
---

# Google Table Manager

## Роль

Ты управляешь **только** Google Таблицей тем. Две фазы: **reserve** (до Кирилла) и **publish** (после Юры).

## Env (без печати значений)

| Переменная | Назначение |
|------------|------------|
| `GOOGLE_SHEET_ID` | ID таблицы |
| `GOOGLE_SHEETS_TAB` / `GOOGLE_SHEET_NAME` | Имя листа (например `Темы`) |
| `GOOGLE_SHEETS_LINK_COLUMN` | Имя столбца ссылки (env `GOOGLE_SHEETS_LINK_COLUMN`) |
| `GOOGLE_SHEETS_WEBHOOK_URL` | Webhook Apps Script (приоритет для записи) |
| `GOOGLE_SHEETS_WEBHOOK_TOKEN` | Токен webhook |
| `GOOGLE_SERVICE_ACCOUNT_BASE64` | JSON service account (fallback чтение/запись) |

Legacy (не удалять из env, если уже настроены): `GOOGLE_SHEETS_DEFAULT_SHEET` — синоним листа.

## Фаза reserve — алгоритм

1. Прочитай `shared/published-pages.md` и `shared/kirill-news-ledger.md`.
2. Запусти или вызови логику `shared/google_sheets_logger.py reserve`:
   - перебери строки сверху вниз;
   - пропусти строки, где столбец ссылки не пустая;
   - пропусти темы-дубли по журналам и ledger;
   - выбери **первую** подходящую строку.
3. Запиши в «Статус» этой строки: `Не использовано`.
4. Сохрани в фрагмент `.cursor/nero-network-fragments/google-table-manager.md`:
   - тему, ключи, боль, оффер, CTA из строки;
   - номер строки и лист;
   - результат записи статуса.
5. Директор переносит фрагмент в handoff → **Кирилл** читает тему отсюда.

### Если таблица недоступна (reserve)

- Статус фрагмента: `⚠️ WARNING`.
- Зафиксируй причину без секретов.
- Директор может остановить пайплайн или передать Кириллу fallback с явным warning.

## Фаза publish — алгоритм

1. Прочитай handoff:
   - `=== GOOGLE-TABLE-MANAGER ===` → номер строки, лист;
   - `=== ЮРА (ПУБЛИКАЦИЯ) ===` → URL, slug.
2. Запусти:
   ```bash
   python3 shared/google_sheets_logger.py publish --row ROW --url "https://..." --slug "slug"
   ```
3. Запиши в ту же строку:
   - столбец ссылки = URL;
   - «Slug» — если столбец есть;
   - «Дата публикации» — текущие дата/время UTC или локаль сайта;
   - «Комментарий» = `Опубликовано через Nero Network pipeline`.
4. Обнови фрагмент `google-table-manager.md` (фаза publish).

### Если таблица недоступна (publish)

- **Не откатывай** публикацию на сайте.
- Статус: `⚠️ WARNING` в фрагменте и handoff.
- QA фиксирует warning; страница остаётся опубликованной.

## Webhook-подход

Если задан `GOOGLE_SHEETS_WEBHOOK_URL`, `google_sheets_logger.py` отправляет JSON:

- `reserve`: `{"action":"reserve","sheet":"...","link_column":"..."}`
- `publish`: `{"action":"publish","row":16,"url":"...","slug":"...","comment":"..."}`

Токен — в заголовке `X-Webhook-Token` или поле `token` (без логирования).

## Антидубли

Отклоняй строку, если:

- в столбец ссылки уже есть URL;
- тема/slug есть в `published-pages.md` или `kirill-news-ledger.md`;
- та же тема уже зарезервирована в текущей сессии.

## Передача Кириллу

После reserve в фрагменте должны быть все поля строки таблицы, нужные Кириллу: направление, тема, ключи, боль, оффер, CTA, приоритет, сложность, чек.

Кирилл **не** читает таблицу сам, если фаза reserve успешна.

## Безопасность

- Не выводить `GOOGLE_SERVICE_ACCOUNT_BASE64`, `GOOGLE_SHEETS_WEBHOOK_TOKEN`, пароли.
- Не коммитить ключи и `.env`.
- В логах — только `set` / `empty` для секретов.

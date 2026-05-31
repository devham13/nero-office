---
description: Создание страницы — Кирилл → … → Наташа (стоп). Публикация отдельно.
---

Пайплайн **создания**: **Кирилл → Коля||Артём → Женя → Артур → Алина||Борис → Наташа** → **остановка**, коммит `wordpress/page-{slug}.php`.

Публикация: **`nero-publish-page`** или «опубликуй».

В Cursor Cloud текущий агент — Директор. Роли через `Task(<role>)` или `Task(generalPurpose)` с `agents/<role>.md`. Самому писать результат роли запрещено.

**Перед стартом:** сброс handoff и фрагментов.

1. **Task(`kirill`)** — тема из Google Таблицы / новость дня; ledger `selected`
2. **Task(`seo-kolya`) + Task(`artyom`)** — фрагменты → handoff
3. **Task(`zhenya`)** — лонгрид
4. **Task(`artur`)** — CTA
5. **Task(`alina`) + Task(`boris`)** — фрагменты → handoff
6. **Task(`natasha`)** — `wordpress/page-{slug}.php`
7. **Стоп.** Коммит. **Юру / QA / SEO не вызывать.**

**Передай:** тему; «только SEO», «только ядро».

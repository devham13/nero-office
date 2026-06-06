---
name: mobile-agent
description: Проверка и исправление мобильной версии опубликованной страницы после indexator, перед QA.
---

# Mobile-agent

## Роль

Проверить мобильную версию опубликованной страницы (особенно первый экран) и при необходимости исправить CSS/PHP. Запускается **после indexator**, **перед QA**.

Эталон визуала: главная `${WP_SITE_URL}` — pill-шапка темы, `.nero-ai-hero`, **не** legacy sticky-nav.

## Этап 1. Получение данных

1. Прочитай `.cursor/nero-network-handoff.md`.
2. Из `=== ЮРА (ПУБЛИКАЦИЯ) ===` возьми:
   - `public_url` (строка `URL:`);
   - `slug`;
   - путь к `page-{slug}.php` (runtime-путь темы).
3. Прочитай `=== INDEXATOR ===` — зафиксируй warnings/blockers (не подменяй mobile-проверку).
4. Если `public_url` отсутствует — статус `❌ БЛОКЕР`, фрагмент с причиной, стоп.

Опционально: `python3 -c "from shared.mobile_checklist import MOBILE_VIEWPORTS; print(MOBILE_VIEWPORTS)"`.

## Этап 2. Проверка мобильного первого экрана

1. Открой `public_url` в **мобильном viewport** (браузер DevTools или browser automation).
2. Проверь ширины: **360px**, **390px**, **430px**.
3. Сравни логику шапки/hero с главной `${WP_SITE_URL}`.
4. Убедись, что страница **не** выглядит как старый шаблон из репозитория (`amo-sticky-nav`, `ym-sticky-nav`, светлый legacy-hero без `.nero-ai-home-page`).

На каждой ширине проверь:

| Элемент | Критерий |
|---------|----------|
| Шапка | Видна, pill-header темы, не сломана |
| Меню | Иконка/кнопка на месте, не перекрывает hero |
| Hero | `.nero-ai-hero` виден, не пустой экран |
| H1 | Читаем, переносится, не обрезан |
| Подзаголовок | Читаем |
| CTA | Видна, кликабельна на 360px |
| Наложения | Нет перекрытия tasks/pills/H1 |
| Обрезка | Нет обрезанных блоков |
| Пустота | Нет огромной полосы под шапкой (см. `shared/agent-pipeline-pitfalls.md` §1) |
| Horizontal scroll | Нет |
| Отступы | Первый экран не уходит слишком низко |

**Блокер:** горизонтальный скролл, нечитаемый H1, невидимый CTA, сломанный hero на 360px.

## Этап 3. Проверка мобильного меню

1. Открой мобильное меню (бургер / pill-nav).
2. Пункты кликабельны.
3. Если есть якоря — проверь, что `id` секций существуют в DOM.
4. Клик по якорю скроллит к правильному блоку.
5. Меню не остаётся поверх CTA после закрытия.
6. Меню закрывается (повторный клик, overlay, Esc — по логике темы).

## Этап 4. Проверка адаптива всей страницы

Проскролль основные секции на 360px (при необходимости — 390/430):

- карточки, bento-grid, FAQ;
- формы и кнопки;
- изображения/иконки в пределах viewport;
- таблицы и длинные списки — без horizontal overflow;
- внутренние ссылки из `=== INTERNAL-LINKER ===` — не ломают строки;
- footer целый;
- JSON-LD / FAQ schema не создают видимых поломок layout.

## Этап 5. Поиск технических проблем

Проверь HTML/CSS шаблона `page-{slug}.php` (локально в репозитории или через view-source):

Проблемные паттерны (см. `shared/mobile_checklist.py` → `FORBIDDEN_CSS_PATTERNS`):

- `width: 100vw` (часто даёт overflow);
- жёсткие `width` / `min-width` больше viewport;
- `overflow-x: visible` на широких контейнерах;
- большие `padding`/`margin` на mobile без media query;
- `grid` без адаптива;
- `flex` без `flex-wrap`;
- отсутствие `@media (max-width: …)` для hero/H1/CTA.

Legacy-маркеры HTML (`LEGACY_DESIGN_MARKERS` в `mobile_checklist.py`):

- `amo-sticky-nav`, `ym-sticky-nav`, кастомный `<header class="sticky">` вместо темы.

Проверь `body`/`html` — не создают ли horizontal scroll.

## Этап 6. Исправления

При ошибках:

1. Сформулируй правки для **Бориса** (inline CSS секций), **Наташи** (разметка), **Юры** (деплой PHP).
2. Безопасные правки mobile-agent может внести сам в `wordpress-theme/page-{slug}.php` или inline `<style>`:

**Разрешено:** media queries, H1 font-size на mobile, gap/padding, flex-wrap, `max-width: 100%`, `overflow-wrap`, `overflow-x: hidden` на контейнерах, full-width кнопки на 360px.

**Запрещено:** удаление блоков, отключение меню, `display:none` на важном контенте, поломка desktop, смена глобального дизайна главной.

После правок — **Юра** перепубликует → **indexator** (при необходимости) → повтор mobile-agent.

## Этап 7. Повторная проверка

После исправлений:

1. Снова открой live URL.
2. Повтори viewport 360, 390, 430.
3. Убедись, что blockers сняты.
4. Только тогда статус `✅ ГОТОВО` и передача в QA.

## Этап 8. Отчёт

Запиши `.cursor/nero-network-fragments/mobile-agent.md`:

```markdown
=== MOBILE-AGENT ===
Статус: ✅ ГОТОВО | ⚠️ WARNING | ❌ БЛОКЕР

URL: ...
Viewport checks:
* 360px: ...
* 390px: ...
* 430px: ...
Header: ...
Menu: ...
Hero: ...
H1: ...
CTA: ...
Horizontal scroll: ...
Sections: ...
FAQ: ...
Internal links: ...
Fixes applied: ...
Warnings: ...
Blockers: ...
```

Директор переносит блок в handoff. При `❌ БЛОКЕР` QA **не** ставит ✅.

## Утилиты

```bash
python3 -c "
from shared.mobile_checklist import scan_html_for_legacy_markers, format_mobile_report
# scan_html_for_legacy_markers(open('path').read())
"
```

Не использовать внешние API. Не делать screenshot, если нет готовой инфраструктуры — достаточно браузера/curl + CSS-анализа.

## Запреты

- Не завершать с ✅ при сломанном первом экране.
- Не скрывать horizontal scroll.
- Не пропускать этап перед QA.
- Не печатать секреты в отчёте.

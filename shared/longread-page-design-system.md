# Дизайн-система AI-лендингов Meta Journal

Цель: коммерческие страницы и главная в **одном визуальном языке** — тёмный премиальный AI/B2B интерфейс, glass-карточки, неоновые акценты, dashboard в hero, pill-шапка, лёгкая анимация.

## Файлы (источник правды)

| Файл | Назначение |
| --- | --- |
| `shared/longread-page-design-reference.css` | Токены, `.nero-ai-home-page`, hero, секции, проза, TOC, блок Бориса |
| `shared/longread-page-kadence-layout.css` | Сброс Kadence: padding, **один скролл**, скрытие `#masthead` |
| `shared/nero-ai-floating-header.css` + `.js` + `.inc.php` | Pill-шапка как на главной сайта |
| `shared/longread-page-reveal.js` | Reveal, tooltips, KPI-счётчики |
| `shared/longread-page-wordpress-bootstrap.inc.php` | `body.nero-ai-landing`, `nero_ai_echo_theme_styles()` |
| `wordpress-theme/page-{slug}.php` | Готовый шаблон страницы |
| `wordpress-theme/README.md` | Список файлов для деплоя в тему |

При публикации копировать `shared/*` → активная тема Kadence (см. `wordpress-theme/README.md`).

## Корневая обёртка

```html
<main id="primary" class="site-main nero-ai-home-page" role="main" tabindex="-1">
```

- Класс **`nero-ai-home-page`** обязателен (не `metrika-skill-page`, не светлый `ym-*`).
- На `<body>` через bootstrap: **`nero-ai-landing`**.

## Шапка (pill)

1. Подключить `longread-page-kadence-layout.css` — скрывает Kadence `#masthead`.
2. После `get_header()` — `require .../nero-ai-floating-header.inc.php`.
3. Задать **`$nero_ai_header_links`** — якоря **этой** страницы (не копировать меню главной).
4. CTA: `$primary_cta_label` / `$primary_cta_url`, опционально `$secondary_*` (ghost-кнопка).
5. Hero: отступ сверху **`clamp(108px, 14vh, 148px)`** под фиксированную шапку (уже в reference CSS).

## Hero

- **Не** светлый fullscreen-white-office / canvas hero по умолчанию.
- Паттерн: **`nero-ai-hero`** + **`nero-ai-hero-grid`**: слева оффер и CTA, справа **`nero-ai-dashboard`** (метрики, live-поток задач).
- Canvas от Алины — только если явно в handoff; иначе dashboard как на главной.

## Лонгрид (тело)

- Секции: **`nero-ai-section`**, чередование **`nero-ai-section-alt`**.
- Текст: **`nero-ai-prose`** на `<section>` (таблицы, callout, steps — классы из reference CSS).
- Введение после hero: **`nero-ai-intro-grid`** (лид слева + терминал/чипы справа).
- Оглавление: **`nero-ai-toc`** (pill-ссылки по центру под вводным блоком).
- Блок Бориса: обёртка **`nero-ai-boris-block`**, внутри HTML от Бориса без правки canvas/script.

## Скролл (критично)

- **Не** задавать `#primary.nero-ai-home-page { overflow-x: hidden; min-height: 100vh }` — даёт **двойной скролл**.
- Использовать `longread-page-kadence-layout.css`: `overflow: visible` на main, `overflow-x: clip` на `html`/`body`.

## CTA на странице

- В контенте: **`nero-ai-btn-primary`** / **`nero-ai-btn-secondary`**.
- Fallback якоря: `#audit-30-min`, `#vnedrenie-pod-kluch` (если env `PRIMARY_CTA_URL` пуст).

## PHP-шаблон (скелет)

```php
require .../longread-page-wordpress-bootstrap.inc.php';
get_header();
require get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
?>
<style><?php nero_ai_echo_theme_styles(); ?></style>
<main id="primary" class="site-main nero-ai-home-page" ...>
  <!-- hero, секции, boris, faq -->
</main>
<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
```

## Запреты

- Светлый «метрика»/ym-лонгрид для новых AI-страниц.
- Kadence `#masthead` вместе с pill-шапкой (две шапки).
- Двойной вертикальный скролл.
- Удалять `main#primary`, ломать `<canvas>`/`<script>` hero и Бориса.
- Tailwind-only классы без своего CSS в теме.

## Эталон в проде

- Главная: pill-шапка + тёмный hero-dashboard.
- Лонгрид: `page-vnedrenie-ai-obrabotka-zayavok-s-sayta.php` (после синхронизации с `shared/`).

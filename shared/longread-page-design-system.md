# Новая дизайн-система Meta Journal / Neurinix для AI-страниц

Цель: все новые коммерческие страницы и главная страница должны собираться в визуальном стиле текущего `https://meta-journal.ru/`: тёмный премиальный AI/B2B интерфейс, стеклянные карточки, мягкие неоновые акценты, dashboard-блоки, hover-подсказки, схемы автоматизации, KPI и лёгкая анимация без визуального мусора.

## Главные файлы

- `shared/longread-page-design-reference.css` — новый эталон CSS.
- `shared/longread-page-reveal.js` — reveal, hover/tap tooltip, счётчики KPI.
- `wordpress/front-page-neurinix-ai-home.php` — готовый шаблон главной страницы WordPress.

## Корневая обёртка

Каждая новая страница должна иметь:

```html
<main id="primary" class="site-main nero-ai-home-page" role="main" tabindex="-1">
  ...
</main>
```

Не использовать старый класс `metrika-skill-page` для новых коммерческих страниц. Новый базовый класс: `.nero-ai-home-page`. Все новые компоненты — с префиксом `.nero-ai-*`.

## Визуальный стиль

- Фон: тёмный `#050711` / `#080b17`, radial glow, тонкая grid-сетка.
- Типографика: крупные H1/H2, tight letter-spacing, Inter/system fonts.
- Карточки: glassmorphism, blur, border `rgba(255,255,255,.10)`, radius 18–34px.
- Акценты: cyan `#79f2ff`, violet `#8b5cf6`, green `#22c55e`.
- Анимация: только лёгкая — reveal, pulse live-pill, slow glow, flow-line, без перегруза.
- CTA: `nero-ai-btn-primary` и `nero-ai-btn-secondary`.

## Обязательная структура главной/коммерческой страницы

1. Hero: оффер + CTA + справа dashboard/схема автоматизации.
2. Боли бизнеса: заявки, CRM, звонки, ручной труд, скорость ответа.
3. Услуги/что внедряем: AI-агенты, CRM, телефония, Make/n8n, RAG, аналитика.
4. AI-операционный центр: путь заявки от входа до отчёта руководителю.
5. Тренды 2026: agentic automation, AI в CRM, voice AI, RAG, human-in-the-loop, no-code/API.
6. Процесс внедрения: аудит → сценарии → интеграции → тест → запуск.
7. Ниши: онлайн-школы, медицина, недвижимость, e-commerce, B2B, сервисные компании.
8. Результаты/KPI: без завышенных обещаний; использовать формулировки «потенциал», «пилот», «зависит от процесса».
9. SEO-блок: естественные ключи по AI-автоматизации бизнеса.
10. FAQ.
11. Финальный CTA.

## Интерактивность

Для подсказок на hover/tap:

```html
<div class="nero-ai-card" data-nero-tooltip="Текст подсказки">...</div>
```

Для появления при скролле:

```html
<div class="nero-ai-reveal nero-ai-delay-1">...</div>
```

Для счётчиков:

```html
<strong data-nero-count="38" data-nero-prefix="−" data-nero-suffix="%">−0%</strong>
```

JS из `shared/longread-page-reveal.js` должен быть вставлен внизу страницы или подключён в теме.

## Главное требование к агентам

Новые страницы должны быть коммерческими: если новость про внедрение AI в бизнес, страница должна показывать, какую похожую услугу можно предложить клиенту: что автоматизировать, кому подходит, какую боль закрывает, как внедряется, какие интеграции нужны, какой CTA.

## Hero на лонгридах (`.nero-ai-home-page`)

- **Единый эталон — live главная** (PUBLIC_SITE_HOST): обёртка `.nero-ai-home`, CSS `shared/nero-ai-home-shell.css`, hero-partial `wordpress/partials/nero-ai-longread-hero-shell.php`.
- Hero **не** использует старый cyan-стиль (`--nero-ai-primary`, canvas в macOS-window, H1 94px, pill-eyebrow).
- Разметка hero: `.nero-ai-h1`, `.nero-ai-lead`, `.nero-ai-badges`, `.nero-ai-btn--primary` / `--ghost`, dashboard `.nero-ai-dash-*` с пульсирующим «онлайн» (CSS `nero-ai-pulse`).
- Тексты и метрики dashboard — **под тему страницы**, структура и анимации — **как на главной**.
- Подключение: bootstrap грузит `nero-ai-home-shell.css` + `nero-ai-longread-ui-compat.css`; в `page-{slug}.php` — переменные hero + `require` partial.
- **Шапка:** `.nero-ai-header` + partials (см. `nero-ai-site-header.*`); Kadence `#masthead` скрыт через `nero-ai-landing-shell`.
- **Меню лонгрида:** перед `require` шапки задай **`$nero_header_nav_links`** — якоря **этой страницы** (5–6 пунктов из оглавления Коли, короткие подписи). **`$nero_header_cta_label` / `$nero_header_cta_url`** — CTA страницы (часто `#demo-*` или `#final-cta-*`). Не используй пункты главной (`/#services`) на лонгридах.
- **Запрещено** для новых AI-лонгридов: светлый `fullscreen-white-office`, `.giant-seo` на белом фоне — это старый эталон вайбкодинга, не текущий бренд Meta Journal / Nero.

## Запреты

- Не делать светлый «метрика»-дизайн для новых AI-страниц.
- Не перегружать hero десятками объектов.
- Не обещать точный ROI без расчёта.
- Не удалять `main#primary`.
- Не вставлять длинную простыню текста сразу после hero.
- Не использовать классы Tailwind без собственного CSS.

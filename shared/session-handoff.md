# Session Handoff

## 2026-09-07 — ai-proizvodstvo-kontrol-prostoev

- Юра: ❌ БЛОКЕР — SSH AuthenticationException, FTP 530 Login incorrect; live URL отдаёт BeGet cookie-stub (274 байта), не WordPress.
- Шаблон готов локально: `wordpress-theme/page-ai-proizvodstvo-kontrol-prostoev.php`
- Google Таблица: reserve ok (строка 143), publish не выполнен
- Следующий шаг: обновить креды хостинга в Cloud Secrets, восстановить сайт, повторить deploy.py → google-table-manager (publish) → indexator → QA → Лёня → vk-publisher

## 2026-06-07 — ai-1c-erp

- Юра: опубликовано `[REDACTED]ai-1c-erp/` (HTTP 200, custom template page-ai-1c-erp.php, WP post ID 115).
- Следующий шаг: google-table-manager (publish, строка 20), indexator, QA (Макс), SEO-аудит (Лёня).

## 2026-05-28 — kpmg-claude-vnedrenie-ai-276-tysyach

- Юра: ❌ БЛОКЕР — SSH/FTP timeout из Cloud Agent; шаблон готов локально, live URL 404.
- Следующий шаг: повторить публикацию с self-hosted worker или локальной машины с доступом к 185.224.139.10:21/22.

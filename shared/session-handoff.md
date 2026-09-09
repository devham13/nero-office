# Session Handoff

## 2026-09-09 — ai-proizvodstvo-kontrol-prostoi

- Юра: ❌ БЛОКЕР — SSH AuthenticationException, FTP 530 Login incorrect; сайт meta-journal.ru отдаёт «Сайт заблокирован хостинг-провайдером» на всех slug.
- Шаблон готов: `wordpress-theme/page-ai-proizvodstvo-kontrol-prostoi.php`; Google Таблица строка 143 (reserve OK).
- Следующий шаг: обновить креды BeGet в Cloud Secrets + снять блокировку хостинга → повторить deploy.py → google-table-manager (publish) → indexator → QA → Лёня → vk-publisher.

## 2026-06-07 — ai-1c-erp

- Юра: опубликовано `[REDACTED]ai-1c-erp/` (HTTP 200, custom template page-ai-1c-erp.php, WP post ID 115).
- Следующий шаг: google-table-manager (publish, строка 20), indexator, QA (Макс), SEO-аудит (Лёня).

## 2026-05-28 — kpmg-claude-vnedrenie-ai-276-tysyach

- Юра: ❌ БЛОКЕР — SSH/FTP timeout из Cloud Agent; шаблон готов локально, live URL 404.
- Следующий шаг: повторить публикацию с self-hosted worker или локальной машины с доступом к 185.224.139.10:21/22.

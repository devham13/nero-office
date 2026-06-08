# Session Handoff

## 2026-06-08 — ai-triazh-tiketov-helpdesk

- Юра: ❌ БЛОКЕР — SSH auth failed + FTP `425 Security: Bad IP connecting` (Cloud Agent IP `54.201.15.58` не в whitelist). Шаблон готов: `wordpress-theme/page-ai-triazh-tiketov-helpdesk.php`. Live URL 404.
- Следующий шаг: whitelist IP или деплой с локальной машины → повторить Юру → google-table-manager (publish, строка 24) → indexator → QA → Лёня → vk-publisher.

## 2026-06-07 — ai-1c-erp

- Юра: опубликовано `[REDACTED]ai-1c-erp/` (HTTP 200, custom template page-ai-1c-erp.php, WP post ID 115).
- Следующий шаг: google-table-manager (publish, строка 20), indexator, QA (Макс), SEO-аудит (Лёня).

## 2026-05-28 — kpmg-claude-vnedrenie-ai-276-tysyach

- Юра: ❌ БЛОКЕР — SSH/FTP timeout из Cloud Agent; шаблон готов локально, live URL 404.
- Следующий шаг: повторить публикацию с self-hosted worker или локальной машины с доступом к 185.224.139.10:21/22.

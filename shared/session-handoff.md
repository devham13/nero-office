# Session Handoff

## 2026-09-09 — ai-proizvodstvo-kontrol

- Юра: ❌ БЛОКЕР — SSH AuthenticationException (SSH_USER, SFTP_USER), FTP 530 Login incorrect; `deploy.py` не смог подключиться.
- Шаблон готов локально: `wordpress-theme/page-ai-proizvodstvo-kontrol.php` (~77 KB).
- Google Таблица строка 143 (reserve OK, publish не выполнен).
- Следующий шаг: обновить Cloud Secrets (SSH/SFTP/FTP passwords) → повторить deploy.py → google-table-manager (publish) → indexator → QA → Лёня → vk-publisher.

## 2026-06-07 — ai-1c-erp

- Юра: опубликовано `[REDACTED]ai-1c-erp/` (HTTP 200, custom template page-ai-1c-erp.php, WP post ID 115).
- Следующий шаг: google-table-manager (publish, строка 20), indexator, QA (Макс), SEO-аудит (Лёня).

## 2026-05-28 — kpmg-claude-vnedrenie-ai-276-tysyach

- Юра: ❌ БЛОКЕР — SSH/FTP timeout из Cloud Agent; шаблон готов локально, live URL 404.
- Следующий шаг: повторить публикацию с self-hosted worker или локальной машины с доступом к 185.224.139.10:21/22.

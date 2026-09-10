# Session Handoff

## 2026-09-10 — ai-agent-smennye-zadaniya-kontrol-prostoiev

- Юра: ❌ БЛОКЕР — SSH AuthenticationException, FTP 530 Login incorrect; шаблон `wordpress-theme/page-ai-agent-smennye-zadaniya-kontrol-prostoiev.php` готов локально; live URL не выдан; Google Таблица строка 143 publish не выполнен.
- Следующий шаг: обновить BeGet-креды в Cloud Secrets, снять блокировку сайта, повторить `shared/deploy.py`, затем google-table-manager (publish) → indexator → QA → Лёня → vk-publisher.

## 2026-06-07 — ai-1c-erp

- Юра: опубликовано `[REDACTED]ai-1c-erp/` (HTTP 200, custom template page-ai-1c-erp.php, WP post ID 115).
- Следующий шаг: google-table-manager (publish, строка 20), indexator, QA (Макс), SEO-аудит (Лёня).

## 2026-05-28 — kpmg-claude-vnedrenie-ai-276-tysyach

- Юра: ❌ БЛОКЕР — SSH/FTP timeout из Cloud Agent; шаблон готов локально, live URL 404.
- Следующий шаг: повторить публикацию с self-hosted worker или локальной машины с доступом к 185.224.139.10:21/22.

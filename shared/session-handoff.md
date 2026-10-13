# Session Handoff

## 2026-10-13 — ai-obrabotka-zayavok-s-sayta

- Юра: ❌ БЛОКЕР — SSH auth failed, FTP 530; live с `beget=begetok`: HTTP 200, но «Сайт заблокирован хостинг-провайдером», кастомный шаблон не выгружен.
- Шаблон локально: `wordpress/page-ai-obrabotka-zayavok-s-sayta.php`. Google Таблица строка 2 — publish не выполнялся.
- Следующий шаг: починить доступы/блокировку хостинга → повторить Юру → google-table-manager publish → indexator → QA → Лёня → vk-publisher.

## 2026-06-07 — ai-1c-erp

- Юра: опубликовано `[REDACTED]ai-1c-erp/` (HTTP 200, custom template page-ai-1c-erp.php, WP post ID 115).
- Следующий шаг: google-table-manager (publish, строка 20), indexator, QA (Макс), SEO-аудит (Лёня).

## 2026-05-28 — kpmg-claude-vnedrenie-ai-276-tysyach

- Юра: ❌ БЛОКЕР — SSH/FTP timeout из Cloud Agent; шаблон готов локально, live URL 404.
- Следующий шаг: повторить публикацию с self-hosted worker или локальной машины с доступом к 185.224.139.10:21/22.

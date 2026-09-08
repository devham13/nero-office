# Session Handoff

## 2026-09-08 — ai-proizvodstvo-kontrol-prostoev

- Юра: ❌ БЛОКЕР — SSH Authentication failed, FTP 530 Login incorrect; шаблон `page-ai-proizvodstvo-kontrol-prostoev.php` готов в репо (commit e55037f).
- Live: целевой slug-path → HTTP 404 на apex; www → Beget «Сайт заблокирован хостинг-провайдером».
- Google Таблица строка 143 — publish не выполнен.
- Следующий шаг: обновить SSH/FTP secrets, снять блокировку Beget, повторить `shared/deploy.py`, затем google-table-manager (publish) → indexator → QA → Лёня → vk-publisher.

## 2026-06-07 — ai-1c-erp

- Юра: опубликовано `[REDACTED]ai-1c-erp/` (HTTP 200, custom template page-ai-1c-erp.php, WP post ID 115).
- Следующий шаг: google-table-manager (publish, строка 20), indexator, QA (Макс), SEO-аудит (Лёня).

## 2026-05-28 — kpmg-claude-vnedrenie-ai-276-tysyach

- Юра: ❌ БЛОКЕР — SSH/FTP timeout из Cloud Agent; шаблон готов локально, live URL 404.
- Следующий шаг: повторить публикацию с self-hosted worker или локальной машины с доступом к 185.224.139.10:21/22.

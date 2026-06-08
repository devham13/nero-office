# Отчёт об исправлениях безопасности и антифрод-факторов

**Дата первичного аудита:** 8 июня 2026  
**Дата деплоя исправлений:** 8 июня 2026, ~18:17 MSK  
**Сайт:** см. переменную `WP_SITE_URL` в secrets  
**IP:** 45.130.41.132 (Beget)  
**Сервер:** nginx-reuseport/1.21.1, PHP 8.3.20, WordPress 7.0

---

## 1. Краткий вывод

| Вопрос | Ответ |
|--------|--------|
| Реальный взлом обнаружен? | **Нет** — `wp core verify-checksums` успешен, малварь в теме/uploads не найдена |
| Вредоносные файлы найдены? | **Нет** — PHP в uploads не обнаружен; карантин не требовался |
| Основная причина предупреждения | **Репутационно-контентная:** домен с «meta», брендовые лонгриды, CTA в Telegram, молодой домен, отсутствие юр.страниц |
| Что исправлено на live-сайте | **Да** — MU-plugin, страницы доверия, 301 дублей, security headers, `DISALLOW_FILE_EDIT` |
| Backup на сервере | **Да** — `security-backups/2026-06-08-15-17/` (дамп БД, wp-config, .htaccess, списки плагинов/админов) |
| Можно ли подавать на перепроверку? | **Да**, после заполнения email/ИНН на страницах доверия и проверки GSC/Яндекс |

---

## 2. Что было исправлено

| Исправление | Где | Что сделано | Статус |
|-------------|-----|-------------|--------|
| Дисклеймеры на брендовых страницах | `wp-content/mu-plugins/nero-security-trust.php` | Автовставка по slug/title + замена фишинговых формулировок | **Задеплоено** |
| Дубли Meta Business Agent | MU-plugin `template_redirect` | 301 → `/meta-business-agent-whatsapp-ai-agent/` | **Задеплоено** |
| Дубли Alice AI / Яндекс | MU-plugin | 301 → `/yandex-alice-ai-llm-flash-vnedrenie-biznes/` | **Задеплоено** |
| Политика конфиденциальности | WP page ID 122 | `/politika-konfidentsialnosti/` | **HTTP 200** |
| Контакты | WP page ID 123 | `/kontakty/` | **HTTP 200** |
| О проекте | WP page ID 124 | `/o-kompanii/` | **HTTP 200** |
| Условия использования | WP page ID 125 | `/usloviya-ispolzovaniya/` | **HTTP 200** |
| CTA / Telegram-паттерн | MU-plugin footer | Текст безопасности + ссылки на юр.страницы | **Задеплоено** |
| Yoast SEO | WP plugins | Yoast **неактивен** (был неактивен до деплоя) | **OK** |
| Rank Math + AIOSEO | WP plugins | Оба **активны** — рекомендуется оставить один | **Требует решения** |
| readme/license | nginx | Правила в `security/instructions-nginx-security.txt` | **Не применено** — readme.html и license.txt всё ещё HTTP 200 |
| Security headers | MU-plugin `send_headers` | HSTS, X-Frame-Options, nosniff, Referrer-Policy, Permissions-Policy | **Задеплоено** |
| wp-config hardening | `wp-config.php` | `define('DISALLOW_FILE_EDIT', true);` | **Задеплоено** |
| uploads PHP block | nginx (Beget) | PHP в uploads отдаёт 405 снаружи | **OK на уровне nginx** |
| Backup | `security-backups/2026-06-08-15-17/` | DB export + критичные файлы | **Создан** (tar без robots.txt — файла не было) |

---

## 3. Что не удалось / осталось сделать

| Что не удалось | Почему | Как исправить вручную |
|----------------|--------|------------------------|
| Закрыть readme.html / license.txt | Нет доступа к nginx-конфигу | Применить `security/instructions-nginx-security.txt` в панели Beget |
| Деактивировать Rank Math | Не входило в скрипт; Yoast уже был off | WP Admin → оставить AIOSEO **или** Rank Math, второй деактивировать |
| Юридические реквизиты | Неизвестны агенту | Владелец: email, ИНН/ООО на `/kontakty/` и `/politika-konfidentsialnosti/` |
| FTP с IP Cloud Agent | `425 Bad IP connecting` | Не критично — SSH работает после whitelist |
| Google Search Console review | Нет доступа к аккаунту владельца | Владелец — раздел 10 |
| Яндекс.Вебмастер review | Нет доступа | Владелец — раздел 11 |
| VK appeal | Нет доступа | Владелец — раздел 9 |
| Проверка access/error логов | Не выполнялась | Beget → Логи |

---

## 4. Изменённые файлы на сервере

| Файл | Изменение | Backup |
|------|-----------|--------|
| `wp-content/mu-plugins/nero-security-trust.php` | Создан | `security-backups/2026-06-08-15-17/files-lite.tar.gz` |
| `wp-config.php` | Добавлен `DISALLOW_FILE_EDIT` | тот же backup |
| `.htaccess` | Скопирован в backup (не менялся скриптом) | тот же backup |
| База данных | 4 новые страницы (ID 122–125) | `database.sql` в backup |

**Репозиторий:** исходники в `wordpress/mu-plugins/`, `security/pages/`, `scripts/security-fix-meta-journal.py`.

---

## 5. Изменённые страницы WordPress

### Канонические

| URL | Действие | Статус |
|-----|----------|--------|
| `/meta-business-agent-whatsapp-ai-agent/` | Каноническая Meta BA + дисклеймер | **Активна** |
| `/yandex-alice-ai-llm-flash-vnedrenie-biznes/` | Каноническая Alice + дисклеймер | **Активна** |

### 301 редирект (проверено)

| URL | Действие | Статус |
|-----|----------|--------|
| `/meta-business-agent-whatsapp-ii-agent-prodazhi/` | 301 → каноническая Meta | **OK** |
| `/meta-business-agent-ai-whatsapp-instagram/` | 301 → каноническая Meta | **OK** |
| `/yandex-alice-ai-llm-flash-biznes-avtomatizaciya/` | 301 → каноническая Alice | **OK** |
| `/alice-ai-llm-flash-yandex-dlya-biznesa/` | 301 → каноническая Alice | **OK** |
| `/alice-ai-llm-flash-vnedrenie-biznes/` | 301 → каноническая Alice | **OK** |
| `/yandex-alice-ai-llm-flash-avtomatizaciya-biznesa/` | 301 → каноническая Alice | **OK** |

### Новые страницы доверия

| URL | WP ID | Статус |
|-----|-------|--------|
| `/politika-konfidentsialnosti/` | 122 | **publish, HTTP 200** |
| `/kontakty/` | 123 | **publish, HTTP 200** |
| `/o-kompanii/` | 124 | **publish, HTTP 200** |
| `/usloviya-ispolzovaniya/` | 125 | **publish, HTTP 200** |

### Дисклеймеры

Автоматически на ~25 брендовых страницах через MU-plugin (Meta, KPMG, Яндекс/Alice, Microsoft, Сбер, OpenAI/Claude и др.).

---

## 6. Карантин

Подозрительных файлов **не обнаружено**. Карантин **не применялся**.

Серверная проверка:
- `find wp-content/uploads -name '*.php'` — пусто
- `grep eval/base64_decode` в теме kadence — пусто
- `wp core verify-checksums` — Success

---

## 7. Проверки после деплоя

| Проверка | Результат |
|----------|-----------|
| HTTPS главная | **200** |
| HTTP → HTTPS | **301 → 200** |
| www → non-www | **301 → 200** |
| Googlebot / YandexBot / Mobile | **200**, без cloaking |
| Open redirect | **Не обнаружен** |
| Mixed content | **Не обнаружен** |
| Security headers | **Есть** (HSTS, X-Frame-Options, nosniff, Referrer-Policy, Permissions-Policy) |
| Дисклеймер на Meta-странице | **Есть** (`nero-brand-disclaimer`) |
| Дубль Meta → 301 | **OK** |
| Дубль Alice → 301 | **OK** |
| Trust footer | **Есть** (`nero-trust-footer`) |
| readme.html / license.txt | **200** — закрыть через nginx |
| WP core checksum | **Success** |
| PHP в uploads | **Не найдено** |
| Админы WP | **1** (`devham`, administrator) |
| Активные плагины | AIOSEO, Rank Math, MonsterInsights, OptinMonster, wp-yandex-metrika, BLC SEO, WPCode |

---

## 8. Что владелец должен сделать вручную

1. **Заполнить реквизиты** на `/kontakty/` и `/politika-konfidentsialnosti/` (email, ИНН/ООО).
2. **Применить nginx-правила** из `security/instructions-nginx-security.txt` (readme/license).
3. **Решить дубль SEO-плагинов:** деактивировать Rank Math или AIOSEO (оставить один).
4. **Google Search Console** → Проблемы безопасности → Запросить проверку (текст — раздел 10).
5. **Яндекс.Вебмастер** → Безопасность → «Я всё исправил» (текст — раздел 11).
6. **Проверить:** Transparency Report, VirusTotal, Sucuri, Kaspersky OpenTIP, Dr.Web.
7. **VK** — если предупреждение в ленте (текст — раздел 9).
8. До снятия предупреждения **не массово публиковать** ссылки в VK/Telegram.

---

## 9. Текст для обращения в VK / соцсеть

```
Здравствуйте.

Просим перепроверить наш сайт (URL в WP_SITE_URL). При переходе по ссылке появлялось предупреждение о возможном вредоносном или фишинговом сайте.

Мы провели аудит и исправили факторы ложного срабатывания антифрод-систем:
- добавлены дисклеймеры о неаффилированности с брендами Meta, WhatsApp, Instagram, KPMG, Яндекс, Microsoft, Сбер и др.;
- опубликованы страницы «Политика конфиденциальности», «Контакты», «О проекте», «Условия использования»;
- дублирующие SEO-страницы закрыты 301-редиректами на канонические URL;
- проверены редиректы и cloaking — расхождений нет;
- WordPress core checksums валидны, PHP в uploads не найден;
- сайт не запрашивает пароли, банковские карты, SMS-коды и доступы к аккаунтам;
- сайт — независимый B2B-блог об AI-автоматизации бизнеса.

Просим снять предупреждение или сообщить конкретный URL/причину блокировки.
```

---

## 10. Текст для Google Search Console review

```
Здравствуйте.

На нашем сайте исправлены факторы, которые могли восприниматься как social engineering / phishing-by-brand.

Что сделано:
- проверены редиректы и поведение для Googlebot/YandexBot/Mobile — cloaking не обнаружен;
- добавлены видимые дисклеймеры на страницы с упоминанием брендов;
- добавлены страницы политики конфиденциальности, контактов, условий использования и описания проекта;
- дублирующиеся SEO-страницы закрыты 301 на канонические URL;
- WordPress core verify-checksums — успешно; вредоносный код в теме/uploads не найден;
- сайт не содержит форм для паролей, банковских карт, SMS-кодов;
- сайт не является официальным сайтом упоминаемых брендов и явно сообщает об этом.

Просим повторно проверить сайт.
```

---

## 11. Текст для Яндекс.Вебмастер

```
Здравствуйте.

Исправлены факторы, которые могли вызвать предупреждение о небезопасном сайте:
- дисклеймеры о неаффилированности с брендами;
- политика конфиденциальности, контакты, условия использования, о проекте;
- проверка на скрытые редиректы и cloaking;
- WordPress core, плагины, uploads — без признаков взлома;
- дубли SEO-страниц закрыты редиректами;
- сайт не запрашивает пароли, карты, SMS-коды и доступы к аккаунтам.

Просим выполнить повторную проверку.
```

---

## 12. Финальный чек-лист

- [x] Внешний аудит выполнен
- [x] Backup на сервере (`security-backups/2026-06-08-15-17/`)
- [x] Серверный scan (grep/find, WP checksums)
- [x] WordPress core checksum — Success
- [x] Плагины проверены
- [x] Админы проверены (1 administrator)
- [x] PHP в uploads — не найдено
- [x] `DISALLOW_FILE_EDIT` в wp-config.php
- [x] Дисклеймеры на live
- [x] Дубли Meta — 301
- [x] Дубли Alice — 301
- [x] Страницы доверия — HTTP 200
- [x] CTA/footer безопасности
- [x] Yoast неактивен
- [ ] Rank Math vs AIOSEO — выбрать один
- [ ] nginx readme/license — не применено
- [x] Security headers на live
- [ ] Email/ИНН на страницах доверия
- [ ] GSC / Яндекс review поданы
- [ ] VK appeal (если нужно)

---

## ФИНАЛЬНЫЙ ВЫВОД

1. **Сайт заражён?** **Нет** — checksums OK, малварь не найдена.
2. **Причина предупреждения?** Контент/репутация (бренды, дубли, Telegram-CTA, нет юр.прозрачности).
3. **Исправлено на live?** **Да** — 8 июня 2026 через SSH после whitelist Beget.
4. **Осталось владельцу?** Реквизиты, nginx для readme, один SEO-плагин, review в GSC/Яндекс/VK.
5. **Перепроверка?** **Можно подавать** после заполнения контактов.
6. **Отчёт:** `security-fix-report.md`

---

## Команды для повторной проверки

```bash
# Снаружи
curl -sI -L "$(wp option get siteurl 2>/dev/null || echo $WP_SITE_URL)"
curl -sI "$(wp option get siteurl)/politika-konfidentsialnosti/"
curl -sI "$(wp option get siteurl)/meta-business-agent-whatsapp-ii-agent-prodazhi/" | grep -i location

# На сервере (SSH)
cd "$REMOTE_SITE_ROOT"
wp core verify-checksums
wp plugin list
find wp-content/uploads -name '*.php'
grep DISALLOW_FILE_EDIT wp-config.php
```

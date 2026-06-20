# Целевой сайт публикации

Пайплайн публикует на домен из env/secrets. Не используй устаревшие домены, если они не заданы в secrets.

Подробная инструкция по переключению — в Cloud Secrets. В git не хранить реальные URL и пароли.

## Что обновить в Cursor Cloud Secrets

Полный список имён — в `.env.example` и `shared/hosting-credentials.env.example`.

Минимум для смены домена:

| Назначение | Где задать |
|------------|------------|
| Базовый URL сайта | env: базовый URL с https |
| Публичный URL | env: публичный URL для ответов агентов |
| Хост без схемы | env: хост для canonical и IndexNow |
| URL админки | env: URL админки WordPress |
| Хост SSH/SFTP/FTP | env: домен сайта, не IP панели |
| Доступ к хостингу | env: логин и пароль SSH/SFTP |
| Путь public_html | env: REMOTE_SITE_ROOT |
| Активная тема | env: WP_THEME_SLUG |
| Бренд и ниша | env: SITE_BRAND, SITE_NICHE |
| Главный CTA | env: PRIMARY_CTA_URL |

## Что обновить в Automation prompt

- Эталон первого экрана: главная текущего домена из env
- Финальный URL: публичный URL + slug
- Sitemap: публичный домен + /wp-sitemap.xml
- Убрать все жёсткие ссылки на старые домены

## Проверка

```bash
python3 scripts/check-config.py --local --network
```

## Локально

`shared/hosting-credentials.local` (не коммитить) — те же имена переменных, что в `.env.example`.

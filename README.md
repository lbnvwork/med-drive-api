# MedDrive API (каркас)

Symfony 7 + PostgreSQL. Репозиторий — **инфраструктурный каркас**: домен, сущности и интеграции появятся в задачах спринтов.

## Что уже есть

| Что | Где |
|---|---|
| Docker-стек (php-fpm + postgres 15 + nginx) | `docker-compose.yml`, `docker/php/Dockerfile`, `nginx/default.conf` |
| Переменные окружения | `.env.dist` (в git), `.env` (локально, из `.env.dist`) |
| Symfony-приложение | `api/` (`App\` → `api/src`), Doctrine ORM + миграции, API Platform |
| Smoke-эндпоинт | `GET /health` → `{"status":"ok","version":"…"}` (`api/src/Controller/HealthController.php`) |
| CI | `.github/workflows/ci.yml` — composer validate/install, миграции + schema:validate, test DB, PHPUnit, PHPStan (level max), PHP CS Fixer, composer-unused |
| Линтеры | `api/phpstan.dist.neon`, `api/phpstan.strict.neon`, `api/.php-cs-fixer.dist.php`, `api/phpunit.dist.xml` |

## Запуск

```bash
cp .env.dist .env          # один раз: локальные значения
cp api/.env.dist api/.env 2>/dev/null || cp .env.dist api/.env
docker compose -p med_drive_api up -d --build
# http://localhost:8108/health
```

Первый запуск требует сети: `docker build` (образ php) и `composer install` в контейнере.

## Проверки (локально)

```bash
cd api
vendor/bin/phpunit                       # тесты
vendor/bin/phpstan analyse --no-progress # статика (level max + strict)
vendor/bin/php-cs-fixer fix --dry-run --diff
```

## Что дальше (решения команды)

- Аутентификация (JWT/сессии) и первый доменный контекст — постановки спринта 1.
- `deptrac` (границы контекстов) — включить, когда появятся контексты.
- `make ci` / метрики покрытия — задача инфраструктуры спринта.

#!/usr/bin/env sh
# Последовательный прогон бэкенд-линтеров (задача 5.31) — задел для 5.33 (`make ci`).
#
# Жёсткий режим: любое замечание = ненулевой код возврата. Прогоняются ВСЕ шаги
# (чтобы в выводе было видно всё, что упало), итог — в конце.
#
# Использование (в контейнере php):
#   docker compose -p <проект> exec -T php sh bin/lint.sh
set -u

cd "$(dirname "$0")/.." || exit 2

failed=0

step() {
    name="$1"
    shift
    echo ""
    echo "=== ${name} ==="
    if ! "$@"; then
        failed=1
        echo "--- ${name}: ЗАМЕЧАНИЯ ---"
    fi
}

step "cs-fixer (dry-run, @PSR12+@Symfony)" vendor/bin/php-cs-fixer fix --dry-run --diff
step "phpstan (strict-профиль: level max + расширения)" vendor/bin/phpstan analyse -c phpstan.strict.neon --no-progress --memory-limit=1G
step "composer-unused (неиспользуемые пакеты)" vendor/bin/composer-unused
step "deptrac (границы контекстов, ADR-004)" vendor/bin/deptrac analyse --no-progress

echo ""
if [ "$failed" -ne 0 ]; then
    echo "=== ИТОГ: есть замечания (код 1) ==="
    exit 1
fi

echo "=== ИТОГ: чисто ==="

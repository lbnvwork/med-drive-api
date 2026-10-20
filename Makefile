# Единый прогон проверок трека api: make ci
# composer-unused пока не в ci: в пустом каркасе большинство пакетов ещё не используется
# (включаем, когда появится доменный код): make unused
.PHONY: install test coverage static style arch unused ci

install:
	composer install --no-interaction --prefer-dist

test:
	vendor/bin/phpunit

coverage:
	vendor/bin/phpunit --coverage-text

static:
	vendor/bin/phpstan analyse --no-progress

style:
	vendor/bin/php-cs-fixer fix --dry-run --diff

arch:
	vendor/bin/deptrac analyse --no-progress

unused:
	vendor/bin/composer-unused

ci: test static style arch

.PHONY: all

setup-env:
	./docker/local/setup_envs.bash

build:
	make setup-env
	COMPOSE_BAKE=true docker compose build

up:
	make setup-env
	docker compose up --detach --wait --wait-timeout 60 --force-recreate --remove-orphans
	make migrate
	make seeds

down:
	make setup-env
	docker compose down --remove-orphans

migrate:
	docker compose run --rm backend php artisan migrate

seeds:
	make setup-env
	docker compose run --rm backend php artisan db:seed --class=App\\Task\\Database\\Seeders\\TaskSeeder

test:
	make setup-env
	docker compose run --rm backend php artisan test --configuration=app-dev/phpunit.xml

check-code:
	make php-cs-fixer-check
	make rector-check

fix-code:
	make php-cs-fixer-fix
	make rector-fix

php-cs-fixer-check:
	docker compose run --rm backend bash -c 'PHP_CS_FIXER_IGNORE_ENV=1 vendor/bin/php-cs-fixer --config=app-dev/php-cs-fixer-config.php fix --dry-run --diff --ansi -v'

php-cs-fixer-fix:
	docker compose run --rm backend bash -c 'PHP_CS_FIXER_IGNORE_ENV=1 vendor/bin/php-cs-fixer --config=app-dev/php-cs-fixer-config.php fix -v'

rector-check:
	docker compose run --rm backend vendor/bin/rector process --config=app-dev/rector.config.php --dry-run --ansi

rector-fix:
	docker compose run --rm backend vendor/bin/rector process --config=app-dev/rector.config.php --clear-cache

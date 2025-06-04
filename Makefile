.PHONY: all

setup-env:
	./docker/local/setup_envs.bash

build:
	make setup-env
	COMPOSE_BAKE=true docker compose build

up:
	make setup-env
	docker compose up --detach --wait --wait-timeout 60 --force-recreate --remove-orphans
	docker compose run --rm backend php artisan migrate
	make seeds

down:
	make setup-env
	docker compose down --remove-orphans

seeds:
	make setup-env
	docker compose run --rm backend php artisan db:seed --class=App\\Task\\Database\\Seeders\\TaskSeeder

test:
	make setup-env
	docker compose run --rm backend php artisan test
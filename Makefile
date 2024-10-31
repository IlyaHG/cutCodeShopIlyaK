# Makefile для Laravel

.PHONY: up
all: up


start:
	@echo "Поднимаю контейнеры.."
	-docker compose up -d

	@echo "Создаю ключ приложения..."
	-docker exec  php_ilya php artisan key:generate

	-docker exec  php_ilya composer install
	-docker exec  php_ilya npm install

	-docker exec  php_ilya php artisan storage:link

	- docker exec -it php_ilya npm run build

	-docker exec  php_ilya php artisan migrate
	-docker exec  php_ilya php artisan db:seed

	@echo "Включаю NPM dev"
	- docker exec -it php_ilya npm run dev
npm_run_dev:
	docker exec -it php_ilya npm run dev

stop:
	@echo "Удаляю контейнеры..."
	-docker compose down

down:
	docker compose down
up:
	docker compose up -d

dfresh:
	-docker exec  php_ilya php artisan shop:dbrefresh

test:
	-php artisan test

ser:
	-php artisan serve

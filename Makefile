# Makefile для Laravel

start:
	@echo "Поднимаю контейнеры.."
	-docker compose up -d

	@echo "Создаю ключ приложения..."
	-docker compose run artisan key:generate

	@echo "Запуск сервера, миграция и заполнение базы данных..."
	-docker compose run artisan migrate
	-docker compose run artisan db:seed
	
	@echo "Включаю NPM dev"
	-docker exec -it cutcodeshopilyak-php-1 npm run dev    

stop: 
	@echo "Удаляю контейнеры..."
	-docker compose down

dfresh: 
	-php artisan migrate:rollback
	-php artisan migrate
	-php artisan db:seed

test:
	-php artisan test

ser: 
	-php artisan serve

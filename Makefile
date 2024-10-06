# Makefile для Laravel

start:
	@echo "Запуск сервера, миграция и заполнение базы данных..."
	-php artisan migrate
	-php artisan db:seed
	php artisan serve

dfresh: 
	-php artisan migrate:rollback
	-php artisan migrate
	-php artisan db:seed

test:
	-php artisan test

ser: 
	-php artisan serve
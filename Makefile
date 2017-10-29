install:
	composer install

lint:
	composer run-script phpcs -- --standard=PSR2 routes

test:
	phpunit

run:
	php artisan serve

migrate:
	heroku run php artisan migrate
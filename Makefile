install:
	composer install

lint:
	composer run-script phpcs -- --standard=PSR2 routes app/Http tests

test:
	phpunit

run:
	php artisan serve

migrate:
	heroku run php artisan migrate
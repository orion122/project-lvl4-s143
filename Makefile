install:
	composer install

lint:
	composer run-script phpcs -- --standard=PSR2 routes app/Http tests

test:
	vendor/bin/phpunit

run:
	php artisan serve

migrate:
	heroku run php artisan migrate
install:
	composer install

lint:
	composer run-script phpcs -- --standard=PSR2 routes app/Http/Controllers tests

test:
	phpunit

run:
	php artisan serve

migrate_heroku:
	heroku run php artisan migrate

migrate_local:
	php artisan migrate
start:
	php artisan serve --host 0.0.0.0

setup:
	composer install
	cp -n .env.example .env || true
	php artisan key:gen --ansi
	touch database/database.sqlite
	php artisan migrate
	php artisan db:seed
	npm ci

update db:
	rm database/database.sqlite
	touch database/database.sqlite
	php artisan migrate
	php artisan db:seed

heroku:
	git push heroku main

test:
	php artisan test

test-coverage:
	XDEBUG_MODE=coverage php artisan test --coverage-clover build/logs/clover.xml

migrate:
	php artisan migrate

console:
	php artisan tinker

log:
	tail -f storage/logs/laravel.log

deploy:
	git push heroku

#компиляции ресурсов
watch:
	npm run watch

dev:
	npm run dev

lint:
	composer phpcs -- --standard=PSR12 app/Http/Controllers routes tests

lint-fix:
	composer phpcbf app routes tests database

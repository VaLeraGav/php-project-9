start:
	php artisan serve

setup:
	composer install
	cp -n .env.example .env || true
	php artisan key:gen --ansi
	touch database/database.sqlite
	php artisan migrate
	php artisan db:seed

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

#не работают
lint:
	composer phpcs

lint-fix:
	composer exec phpcs

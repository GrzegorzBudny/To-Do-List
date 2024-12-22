## Stack
PHP 8.3
MySQL
PHPmyadmin
Laravel 11

## How to run project

1. docker-compose build
2. docker-compose up
3. make file .env
4. copy .env.example to .env
3. go to To-Do-List\laravel-app
4. npm install
5. npm run build
6. docker exec laravel-docker bash -c "composer update"
7. docker exec laravel-docker bash -c "php artisan key:generate"
8. docker exec laravel-docker bash -c "php artisan migrate"

9. go to localhost:8000
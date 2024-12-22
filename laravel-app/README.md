## Stack
PHP 8.3
MySQL
PHPmyadmin
Laravel 11

## How to run project

1. docker-compose build
2. docker-compose up
3. npm install
3. npm run build
3. docker exec laravel-docker bash -c "composer update"
4. docker exec laravel-docker bash -c "php artisan key:generate"
5. docker exec laravel-docker bash -c "php artisan migrate"

7. Change in file .env
    DB_CONNECTION=mysql
    DB_HOST=mysql_db
    DB_PORT=3306
    DB_DATABASE=todoslist
    DB_USERNAME=root
    DB_PASSWORD=root

8. go to localhost:8000
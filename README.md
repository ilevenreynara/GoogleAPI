TA_LMS
------------
Initial commit was made using :
 - PHP >= 7.4.11
 - Laravel >= 8.13.0

## Installation
1. Install the package dependencies by running the following command in your __terminal__
```
composer install
```
2. Install npm dependencies using the following command.
```
npm install
```
3. Create a copy of your `.env` file Or simply copy the `.env.example` and rename it to `.env`
```
cp .env.example .env
```
4. Edit your `.env` file configuration
```
DB_CONNECTION=Your-database-connection (pgsql, mysql)
DB_HOST=127.0.0.1
DB_PORT=Your-database-port
DB_DATABASE=Your-database-name
DB_USERNAME=Your-database-username
DB_PASSWORD=Your-database-password
```
5. Generate the app encryption key
```php
php artisan key:generate
```
6. Create an empty database that match your the name of your database in your `.env` configuration
```
DB_DATABASE=Your-database-name
```
7. Run the migration command
```php
php artisan migrate
```
8. [Optional] Seed the database
```php
php artisan db:seed --class=DummyAnnouncement
```
9. Try running the app using the following command
```php
php artisan serve
```
## Essentials

* [Laravel](https://laravel.com) ([Documentation](https://laravel.com/docs))

## Packages

* [Fullcalendar.io](https://fullcalendar.io/) ([Documentation](https://fullcalendar.io/docs))

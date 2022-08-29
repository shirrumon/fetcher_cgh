# Docker Symfony Nginx PHP MySql

It is a simple template of SNPM

Which versions is used:
- PHP 8.1
- Latest version of Nginx from Docker_Hub repository
- Latest version of MySql from Docker_Hub repository
- Symfony 6.1

How to use it:
- Clone this repository
- From app start `composer install`
- From repository start a command `docker-compose up -d --build`
- Open `localhost:8080`

Tools of this repository:
Check for code for issues:
- run from root of catalog `app/vendor/bin/phpstan analyse app/src --autoload-file=app/vendor/autoload.php`

Check for PSR-2 code standart:
- run from root of catalog `app/vendor/bin/phpcs app/src --standard=PSR2 --ignore=app/src/DataFixtures/*,app/src/Migrations/*`
- for automatic fix run `app/vendor/bin/phpcbf app/src --standard=PSR2 --ignore=app/src/DataFixtures/*,app/src/Migrations/*`

Run PHPUnit:
- run from root `app/vendor/bin/phpunit --coverage-text --colors=never app/tests`

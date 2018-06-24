# Laconia

A PHP Application.

## Instructions

- Install Apache, MySQL and PHP
 - If using MAMP: add `export PATH=/Applications/MAMP/bin/php/php7.2.1/bin:$PATH` to `.bash_profile` to run PHP from the command line.
- Install composer:

```
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

- Point `laconia.server` to `/public`.
- Run `php install.php` in the root directory to initialize the database.
- Run `composer install`.
- Explore.
- `npm run sass` to use Sass.

## Features

- Register
- Login
- Logout
- Reset password
- Create list
- View public profiles

## Learning

- MVC
- OOP
- Routing

## Testing

How to run a test:

`./vendor/bin/phpunit ./tests/HelloWorldTest`
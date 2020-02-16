# 🏺 Laconia 

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)

An MVC framework from scratch in PHP.

### [View the demo](https://laconia.dev)

## Installation

Install a local copy with the instructions below, or follow the [Docker instructions](#docker-instructions).

### Install Apache, MySQL, and PHP

It is assumed you already know how to install a LAMP stack. For macOS and Windows local development, I would recommend downloading [MAMP](https://www.mamp.info/en/) for a sandboxed environment. You can [set up virtual hosts](https://www.taniarascia.com/setting-up-virtual-hosts/) as well.

If using MAMP, add MAMP to the PHP command line by adding this line to `.bash_profile`.

```bash
export PATH=/Applications/MAMP/bin/php/php7.2.1/bin:$PATH
```

### Install Composer

[Composer](https://getcomposer.org/) is the standard in PHP for dependency management, class autoloading, and much more.

```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### Set up server

Create a virtual host called `laconia.server`. The server should point to the `/public` directory. Your `httpd-vhosts.conf` will look like this:

```apacheconf
<VirtualHost *:80>
    DocumentRoot "/Users/tania/hosts/laconia/public"
    ServerName laconia.server
</VirtualHost>
```

### Run install script

- Run `php bin/install.php` in the root directory to initialize the database.
- Run `composer install` to autoload classes and configuration.
- Run `npm i` to install depencencies to use Sass.
- Run `npm run sass` to run sass.

Copy credentials example file to credentials.

```bash
cp credentials.example.php credentials.php
```

Laconia is all set up and ready to use!

### Docker Instructions

- Requires [docker-compose](https://docs.docker.com/compose/install/).
- Run `make init` to build all containers.
- Run `make install` to init app.
Go to [laconia](127.0.0.1:8080 )

`npm` and `sass` are not integrated in docker at the moment.

- Run `npm i` to install depencencies to use Sass.
- Run `npm run sass` to run sass.

#### Autoload classes

If you change or add a class at anytime, you'll need to re-run the autoload script to re-load the new classes.

```bash
composer dump-autoload
```

## Project Structure

The entire program flows through `/public/index.php`, and the rest of the project is a directory above public.

```bash
laconia/
  .git               # Git source directory
  assets/            # Uncompiled raw SCSS
  bin/               # Command line scripts
      install.php    # Database installation script
  config/            # Database credentials, utility helpers, and other configuration
  data/              # SQL database files
  node_modules/      # Node.js front end dependencies
  docker/            # Contains Docker environment variables
  public/            # Publicly accessible files
      css/           # Compiled, ready-to-use styles
      js/            # Compiled, ready-to-use scripts
      index.php      # Main entry point for the entire application
  src/               # PHP source code
      app            # Router code
      controllers/   # Controller classes
      models/        # Model classes
      views/         # Views
  tests/             # Unit tests
  vendor/            # Composer files and 3rd party packages
  .gitignore         # Files to be ignored in the repository
  composer.json      # Composer dependency file
  composer.lock      # Composer lockfile
  docker-compose.yml # Docker configuration
  Dockerfile         # Docker configuration
  LICENSE            # MIT License file
  Makefile           # Docker instructions
  package.json       # npm dependency file
  package-lock.json  # Dependency lockfile
  README.md          # Brief documentation
```

## Usage

Laconia is a simple list-making website. You can register an account, log in, log out, reset your password, create and edit lists, and view public profiles.

- `/` - Landing page
- `/register` - Register a new user
- `/login` - Log in to user account
- `/dashboard` - Logged in dashboard screen
- `/logout` - Log out of user session
- `/forgot-password` - Get a password reset link
- `/create-password` - Create a new password
- `/users` - View all users
- `/settings` - Edit user settings
- `/lists` - View lists
- `/create` - Create a new list
- `/edit/:list_id` - Edit an existing list
- `/:username` - View public profile
- `/404` - Any not found redirects to 404.

## Testing

Laconia uses PHPUnit for unit testing. Tests will go in the `/tests` directory. For now, here is how to run a Hello, World! script.

```bash
./vendor/bin/phpunit ./tests/HelloWorldTest
```

## Motivation

Laconia is a personal project created by Tania Rascia to learn the fundamentals of programming and modern web development from scratch. The main goals of the project are to learn MVC (Model View Controller) architecture, the OOP (Object-Oriented Programming) paradigm, routing, authentication, security, modern development practices, and how to tie it all together to make a functional web app.

Laconia runs on PHP 7.2 and MySQL. It uses Composer to autoload classes, configuration and utility files, as well as future tests through PHPUnit. Node.js is used to compile Sass to CSS via npm scripts. The CSS framework [Primitive](https://taniarascia.github.io/primitive) was used for the design.

Here are some of the concepts I learned while writing this program:

- **Authentication** – logging in, logging out, resetting a password, having private content/dashboard hidden from anonymous users
- **Security and validation** – encrypted passwords and hashing, parameter binding with SQL, making sure users cannot be overridden, making sure no spam or empty content can go through, making sure passwords and usernames have the proper characters
- **Routing** – Redirecting to URLs based on incoming request method and URI path, creating public user profiles in the root directory, creating dynamic pages based on GET requests
- **Object-oriented programming** – I had never used a class in a working application before writing this app, so I learned a lot about constructors, inheritance, and abstract classes
- **Composer** – I had no prior experience using Composer, so I wanted to find out why it was the standard in modern PHP development. I used it for autoloading classes and configuration.
- **Database schema** – how to structure a database to relate information easily between the tables, i.e. linking lists and list items, users and user comments, etc.
  Sessions and Users – how to easily deal with sessions, users, and authentication.

## Acknowledgements

I've used a combination of many tutorials and StackOverflow posts to create this project. These have been the most important.

- [How to reset user password](http://thisinterestsme.com/php-reset-password-form/)
- [How to create a user login](http://thisinterestsme.com/php-user-registration-form/)
- [How to make a PDO class](https://www.culttt.com/2012/10/01/roll-your-own-pdo-php-class/)
- [How to validate passwords](https://stackoverflow.com/questions/22544250/php-password-validation/22544286)
- [General structure of a PHP application](https://ilovephp.jondh.me.uk/en/tutorial/make-your-own-blog)
- [Directory structure example](https://php.earth/docs/faq/misc/structure)
- [Promisify XHR](https://stackoverflow.com/questions/30008114/how-do-i-promisify-native-xhr)
- [MVC concepts and routing class](https://github.com/laracasts/The-PHP-Practitioner-Full-Source-Code/)

## Contributing

Please feel free to fork, comment, critique, or submit a pull request.

## Author

- [Tania Rascia](https://www.taniarascia.com)

## License

This project is open source and available under the [MIT License](LICENSE).

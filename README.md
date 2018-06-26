# Laconia

### An MVC application written in plain PHP without libraries or frameworks

 [![Maintenance](https://img.shields.io/badge/Maintained%3F-yes-green.svg)](https://GitHub.com/Naereen/StrapDown.js/graphs/commit-activity) [![GitHub license](https://img.shields.io/github/license/Naereen/StrapDown.js.svg)](https://GitHub.com/Naereen/StrapDown.js/releases/) [![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?)](http://gitub.com/taniarascia/laconia/compare) [![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.1-8892BF.svg?style=flat-square)](https://php.net/)

Laconia is a personal project created by Tania Rascia to learn the fundamentals of programming and modern web development from scratch. The main goals of the project are to learn MVC (Model View Controller) architecture, the OOP (Object-Oriented Programming) paradigm, routing, modern development practices, and how to tie it all together to make a functional web app. 

Laconia runs on PHP 7.2 and MySQL. It uses composer to autoload classes and  configuration and utility files, as well as future tests through PHPUnit. Node is used to compile Sass to CSS via npm scripts.

Please feel free to fork, use, comment, critique, suggest, improve or help in any way.

## Installation

Laconia is not currently available online anywhere, but here is how you can download it, install it, and play around to your heart's content.

### Install Apache, MySQL, and PHP

It is assumed you know how to install a LAMP stack. For macOS and Windows local development, I would recommend downloading [MAMP](https://www.mamp.info/en/) for a sandboxed environment. You can [set up virtual hosts](https://www.taniarascia.com/setting-up-virtual-hosts/).

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

Create a virtual host called `laconia.server`. The server should point to the `/public` directory. For me, `httpd-vhosts.conf` looks like this.

```apacheconf
<VirtualHost *:80>
    DocumentRoot "/Users/tania/hosts/laconia/public"
    ServerName laconia.server
</VirtualHost>
```

### Run install script

- Run `php install.php` in the root directory to initialize the database.
- Run `composer install` to autoload classes and configuration.
- Run `npm install` to allow use of Sass
- In order to run Sass, use `npm run sass`.

Laconia is all set up and ready to use!

## Project Structure

The entire program flows through `/public/index.php`, and the rest of the project is a directory above public.

```bash
laconia/        
  .git             # Git source directory
  assets/          # Uncompiled raw SCSS, JavaScript
  config/          # Database credentials, utility helpers, and other configuration
  data/            # SQL database files
  node_modules/    # Node.js front end dependencies
  public/          # Publicly accessible files
      css/         # Compiled, ready-to-use styles
      js/          # Compiled, ready-to-use scripts
      index.php    # Main entry point for the entire application
  src/             # PHP source code
      controllers/ # Controller classes
      models/      # Model classes
      views/       # Views
  tests/           # Unit tests
  vendor/          # Composer files and 3rd party packages
  .gitignore       # Files to be ignored in the repository
  composer.json    # Composer dependency file
  install.php      # Database installation script
  LICENSE          # MIT License file
  package.json     # npm dependency file
  README.md        # Brief documentation
```

## Usage

In Laconia, you can register an account, log in, log out, reset your password, create and edit lists, and view public profiles.

- `/` - Index
- `/register` - Register a new user
- `/login` - Login to user account
- `/home` - Logged in home screen
- `/logout` - Logout of user session
- `/reset-password` - Reset password and create a new password
- `/create` - Create a new list
- `/edit/:list_id` - Edit an existing list
- `/:username` - View public profile
- `/404` - Any not found redirects to 404.

## Testing

Laconia uses PHPUnit for unit testing. Tests will go in the `/tests` directory. For now, here is how to run a Hello, World! script.

```bash
./vendor/bin/phpunit ./tests/HelloWorldTest
```

## Todos

- [x] Disallow spaces in usernames
- [ ] Comment all code
- [ ] Create a user settings page
- [x] Make view for public user lists
- [ ] Add JavaScript to XHR validation and form submission
- [ ] Allow users to add or delete list items in edit mode
- [ ] Allow users to delete list items in add mode
- [x] Prevent adding new list items if post is empty
- [x] Email empty password forgot
- [ ] Fix issue with trailing slash in URL
- [x] Allow users to edit their own lists
- [x] Create a top navigation bar when logged in
- [x] Add CSS styles
- [x] Disallow multiple same usernames with different casing
- [x] Make Sass watch
- [x] Clean up password validation code
- [x] Allow user to create a list with list items - laconia.test/create
- [x] Create public facing user profile - laconia.test/$username - will require Apache redirects? or PHP redirects?

## Sources

I've used a combination of many tutorials and StackOverflow posts to create this project. These have been the most important.

- [How to reset user password](http://thisinterestsme.com/php-reset-password-form/) 
- [How to create a user login](http://thisinterestsme.com/php-user-registration-form/)
- [How to make a PDO class](https://www.culttt.com/2012/10/01/roll-your-own-pdo-php-class/)
- [How to validate passwords](https://stackoverflow.com/questions/22544250/php-password-validation/22544286)
- [General structure of a PHP application](https://ilovephp.jondh.me.uk/en/tutorial/make-your-own-blog)
- [Directory structure example](https://php.earth/docs/faq/misc/structure)

## License

The code is open source and available under the [MIT License](LICENSE).

Written and maintained by [Tania Rascia](https://www.taniarascia.com).
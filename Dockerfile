FROM php:7.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    default-mysql-client

COPY docker/laconia.serve /etc/apache2/sites-available/000-default.conf

# Install extensions
RUN docker-php-ext-install pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite
FROM php:7.2-fpm

# Changing Workdir
WORKDIR /app

# Init docker credential for database connection
COPY docker/credentials.php /app/config/

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    default-mysql-client 

# Install extensions
RUN docker-php-ext-install pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Allow container to write on host
RUN usermod -u 1000 www-data

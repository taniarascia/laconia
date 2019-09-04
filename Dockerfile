FROM php:7.2-fpm

# Change workdir
WORKDIR /app

# Init docker credentials for database connection
COPY docker/credentials.php /app/config/

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    default-mysql-client 

# Install extensions
RUN docker-php-ext-install pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
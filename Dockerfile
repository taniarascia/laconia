FROM php:7.2-fpm

# Changing Workdir
WORKDIR /app

# init docker credential for database connection
COPY docker/credentials.php /app/config/

# Installing dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    default-mysql-client 

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Installing extensions
RUN docker-php-ext-install pdo_mysql

# Installing composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Allow container to write on host
RUN usermod -u 1000 www-data

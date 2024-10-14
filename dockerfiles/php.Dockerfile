FROM php:8.2-fpm-alpine

WORKDIR /var/www/app_cut

# Установка необходимых расширений и пакетов
RUN apk add --no-cache \
    curl \
    git \
    unzip \
	nodejs \
    npm

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Установка расширений PDO и pdo_mysql
RUN docker-php-ext-install pdo pdo_mysql

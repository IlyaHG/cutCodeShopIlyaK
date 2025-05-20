FROM php:8.2-fpm

WORKDIR /var/www/app_cut

RUN apt-get update \
    && apt-get install -y \
         ca-certificates apt-transport-https gnupg2 curl \
         libfontconfig1 \
         libxrender1 \
         nodejs \
         npm \
         yarn \
    && curl -fsSL https://packages.sury.org/php/apt.gpg \
         | gpg --dearmor -o /usr/share/keyrings/php-sury.gpg \
    && echo "deb [signed-by=/usr/share/keyrings/php-sury.gpg] \
             https://packages.sury.org/php/ bookworm main" \
         > /etc/apt/sources.list.d/php-sury.list \
    && rm -rf /var/lib/apt/lists/*

RUN pecl install redis \
    && docker-php-ext-enable redis

RUN docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-enable pdo_mysql

# (Опционально) Xdebug
# RUN pecl install xdebug \
#     && docker-php-ext-enable xdebug

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY docker/php/conf.d/* $PHP_INI_DIR/conf.d/

CMD ["php-fpm"]

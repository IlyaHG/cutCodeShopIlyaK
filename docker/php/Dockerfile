FROM php:8.2-fpm

WORKDIR /var/www/app_cut

RUN apt-get update \
    && apt-get install -y libfontconfig1 \
    && apt-get install -y libxrender1 \
    && apt-get install -y nodejs \
    && apt-get install -y npm \
    && apt-get install -y yarn \
    && apt-get clean \
    && apt-get upgrade -y

RUN npm install -g npm

RUN docker-php-ext-install pdo pdo_mysql && docker-php-ext-enable pdo_mysql

RUN pecl install xdebug-3.2.0 && docker-php-ext-enable xdebug

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY docker/php/conf.d/* $PHP_INI_DIR/conf.d/

CMD ["php-fpm"]

FROM php:8.1-fpm

ENV PHP_EXTRA_CONFIGURE_ARGS \
  --enable-fpm \
  --with-fpm-user=www-data \
  --with-fpm-group=www-data \
  --enable-intl \
  --enable-opcache \
  --enable-zip \
  --enable-calendar
ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && \
     apt-get install -y \
                   libicu-dev \
                   curl  \
                   wget  \
                   gnupg2  \
                   ca-certificates  \
                   lsb-release  \
                   apt-transport-https \
                   zlib1g-dev \
                   libpng-dev \
                   libjpeg-dev \
                   libfreetype6-dev \
                   zip \
                   vim \
                   unzip \
                   libmagickwand-dev \
                   libzip-dev \
         && docker-php-ext-install pdo pdo_mysql opcache intl zip

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install -j "$(nproc)" gd \
    pdo_mysql \
    mysqli

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

# install xdebug
RUN pecl install --nocompress xdebug-3.1.3

# install redis
RUN pecl install --nocompress redis

# Install mailhog
RUN curl -L https://github.com/mailhog/mhsendmail/releases/download/v0.2.0/mhsendmail_linux_amd64 --output /usr/local/bin/mhsendmail \
&& chmod +x /usr/local/bin/mhsendmail

RUN usermod -u 1000 www-data \
    && usermod -G www-data www-data

WORKDIR /var/www/html/api


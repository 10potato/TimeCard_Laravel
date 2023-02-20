# FROM php:7.3.9-apache
FROM php:7.4.15-apache

COPY ./conf/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY ./conf/default-ssl.conf /etc/apache2/sites-available/default-ssl.conf

RUN apt-get update \
  && apt-get install -y \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql \
    #composer
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && cd /etc/apache2/mods-enabled \
    && ln -s ../mods-available/rewrite.load

RUN apt-get install -y libpng-dev
RUN docker-php-ext-install gd

FROM php:7.3-fpm
MAINTAINER Adil YASSINE <adilyassine.info>

RUN apt-get update && apt-get install -y  zlib1g-dev libzip-dev libicu-dev libpq-dev imagemagick git mariadb-client zip unzip \
	&& docker-php-ext-install opcache \
	&& docker-php-ext-install intl \
	&& docker-php-ext-install mbstring \
	&& docker-php-ext-install pdo_mysql \
	&& docker-php-ext-install zip \
	&& php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/local/bin --filename=composer \
	&& chmod +sx /usr/local/bin/composer

RUN curl -sL https://deb.nodesource.com/setup_10.x | bash
RUN apt-get update && apt-get install -y nodejs && apt-get clean

EXPOSE 9000
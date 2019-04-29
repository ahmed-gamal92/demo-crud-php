FROM php:7.1-fpm

RUN printf "deb http://archive.debian.org/debian/ jessie main\ndeb-src http://archive.debian.org/debian/ jessie main\ndeb http://security.debian.org jessie/updates main\ndeb-src http://security.debian.org jessie/updates main" > /etc/apt/sources.list

RUN apt-get update && \
apt-get install -y --no-install-recommends \
curl \
libz-dev \
libpq-dev \
libjpeg-dev \
libpng12-dev \
libfreetype6-dev \
libssl-dev \
libmcrypt-dev \
pkg-config \
libmagickwand-dev \
build-essential \
wget && \
curl -sS https://getcomposer.org/installer | php -d detect_unicode=Off -- --install-dir=/usr/local/bin --filename=composer  && \
docker-php-ext-install mcrypt && \
docker-php-ext-install pdo_mysql && \
docker-php-ext-install zip  && \
apt-get -y install rsync

# Install GD
RUN apt-get install -y \
libfreetype6-dev \
libjpeg62-turbo-dev \
libmcrypt-dev \
libpng12-dev \
&& docker-php-ext-install -j$(nproc) iconv \
&& docker-php-ext-configure gd --with-freetype-dir=/usr/lib/x86_64-linux-gnu/ --with-jpeg-dir=/usr/lib/x86_64-linux-gnu/ \
&& docker-php-ext-install -j$(nproc) gd

# Install MongoDB extension
RUN pecl install mongodb \
&& echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/ext-mongodb.ini

#######################################################
# COPY The source code and docker settings
#######################################################
COPY ./ /var/www_original
COPY ./docker/php /var/www_original/docker/php

#######################################################
# PHP settings & composer Install
#######################################################
RUN cp /var/www_original/docker/php/php/php.ini /usr/local/etc/php/  && \
cp  /var/www_original/docker/php/fpm/www.conf /usr/local/etc/php-fpm.d/ && \
cp /var/www_original/docker/php/docker-entrypoint.sh /docker-entrypoint.sh && \
chmod +x /docker-entrypoint.sh && \
cd /var/www_original && \
composer install

WORKDIR /var/www
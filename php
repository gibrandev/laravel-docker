FROM php:8.1.10-fpm-buster

RUN apt-get update
RUN apt-get install -y autoconf pkg-config curl
RUN apt-get update
RUN apt-get install -y openssl vim libssl-dev p7zip-full zip unzip

RUN pecl install mongodb
RUN docker-php-ext-install pdo_mysql bcmath
RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini

RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini 

# Install Laravel dependencies
RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev
EXPOSE 9000
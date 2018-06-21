FROM php:7.1-apache

MAINTAINER DangMinhTruong

WORKDIR /app
ADD . /app 

RUN apt-get update -y && apt-get -y install git

RUN apt-get update -y && apt-get install -y curl
RUN curl -s http://getcomposer.org/installer | php 
RUN mv composer.phar /usr/local/bin/composer 

RUN chown -R www-data:www-data /app && chmod -R 755 /app/storage
CMD ["php", "artisan", "serve"]

EXPOSE 5000

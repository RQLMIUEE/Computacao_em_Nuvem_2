

FROM php:8.2-apache


COPY ./var/www/html


RUM docker-php-est-install mysqli pdo pdo_mysqli



EXPOSE 80

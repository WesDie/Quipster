FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN a2enmod rewrite

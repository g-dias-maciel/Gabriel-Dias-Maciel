FROM php:7.3-apache

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apt-get update -y && apt-get install -y \
    libmariadb-dev \
    git \
    zip \
    unzip


RUN apt-get clean & rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install mysqli

#set php container memory limit to -1 avoiding the "Allowed memory exhausted" problem
RUN cd /usr/local/etc/php/conf.d/ && \
  echo 'memory_limit = -1' >> /usr/local/etc/php/conf.d/docker-php-ram-limit.ini

WORKDIR /var/www/html

#PHPUNIT
RUN composer global require "phpunit/phpunit"

ENV PATH /root/.composer/vendor/bin:$PATH

RUN ln -s /root/.composer/vendor/bin/phpunit /usr/bin/phpunit

EXPOSE 80

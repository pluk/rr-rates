FROM phpdockerio/php:8.3-fpm

WORKDIR "/application"

RUN apt-get update \
    && apt-get -y --no-install-recommends install php8.3-memcached php8.3-pgsql php8.3-xdebug php8.3-intl php8.3-gd php8.3-redis php8.3-amqp php8.3-bcmath \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN touch /run/php-fpm.pid \
    && groupadd -g 1000 www \
    && useradd -u 1000 -ms /bin/bash -g www www \
    && chown www:www /run/php-fpm.pid

USER www

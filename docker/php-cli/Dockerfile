FROM phpdockerio/php:8.3-cli

WORKDIR "/application"

RUN apt-get update \
    && apt-get -y --no-install-recommends install php8.3-memcached php8.3-pgsql php8.3-xdebug php8.3-intl php8.3-gd php8.3-redis php8.3-amqp php8.3-bcmath \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN groupadd -g 1000 cli \
    && useradd -u 1000 -ms /bin/bash -g cli cli

USER cli

ENTRYPOINT ["bin/console", "messenger:consume", "async", "-vv", "--time-limit=3600", "--memory-limit=128M"]
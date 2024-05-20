FROM ghcr.io/roadrunner-server/roadrunner:2024.1.1 AS roadrunner
FROM phpdockerio/php:8.3-cli

RUN apt-get update \
    && apt-get -y --no-install-recommends install php8.3-memcached php8.3-pgsql php8.3-xdebug php8.3-intl php8.3-gd php8.3-redis php8.3-amqp php8.3-bcmath \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

COPY --from=roadrunner /usr/bin/rr /usr/local/bin/rr

CMD rr serve -c .rr.yaml

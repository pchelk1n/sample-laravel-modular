FROM php:8.4.7-fpm

RUN apt-get update; \
    apt-get install -y --no-install-recommends unzip git;

COPY --from=composer:2.8.8 /usr/bin/composer /usr/bin/composer

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo_pgsql intl sysvsem bcmath

RUN ln -sf /usr/share/zoneinfo/UTC /etc/localtime

ARG USER_ID
RUN groupadd --gid "$USER_ID" dev \
    && useradd --uid "$USER_ID" --gid dev --shell /bin/bash --create-home dev

COPY www.conf /usr/local/etc/php-fpm.d/www.conf

COPY php-cli-override.ini php-fpm-fcgi-override.ini /tmp/

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php-cli.ini \
    && cat /tmp/php-cli-override.ini >> /usr/local/etc/php/php-cli.ini \
    && cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php-fpm-fcgi.ini \
    && cat /tmp/php-fpm-fcgi-override.ini >> /usr/local/etc/php/php-fpm-fcgi.ini \
    && rm -f \
        /usr/local/etc/php/php.ini-development  \
        /usr/local/etc/php/php.ini-production \
        /tmp/php-*

USER dev
WORKDIR /app/

RUN mkdir -p /home/dev/.composer/

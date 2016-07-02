FROM php:7.0-fpm-alpine

COPY bin/docker-php-pecl-install /usr/local/bin/docker-php-pecl-install
RUN chmod +x /usr/local/bin/docker-php-pecl-install

COPY php.ini /usr/local/etc/php/php.ini

RUN apk --no-cache add icu-dev autoconf build-base acl git\
    && docker-php-pecl-install -o -f apcu uuid xdebug \
    && docker-php-ext-install bcmath intl mbstring opcache pdo_mysql sockets \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer global require hirak/prestissimo

ADD bin /tmp/bin
RUN mkdir -p /usr/local/bin \
    && mv /tmp/bin/* /usr/local/bin  \
    && chmod +x /usr/local/bin/* \
    && rm -rf /tmp/bin

WORKDIR /source

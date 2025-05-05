FROM richarvey/nginx-php-fpm:3.1.6

#Install necessary packages
RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        libzip-dev\
        git \
        wget \
        unzip \
        php8.3-gd \
        php8.3-imagick \
        php8.3-mysql \
        php8.3-phpdbg \
        php8.3-xdebug \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

COPY . .

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV local
ENV APP_DEBUG true
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]

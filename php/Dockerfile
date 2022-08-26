FROM php:8.1-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        zlib1g-dev \
        libxml2-dev \
        wget \
        libpng-dev \
        libjpeg-dev \
        libwebp-dev \
        libbz2-dev \
        libzip-dev \
        librabbitmq-dev \
        libssh-dev \
        curl \
    && docker-php-ext-install \
        pdo_mysql \
        zip \
        gd \
        bz2 \
        bcmath \
        sockets \
        intl \
        exif \
    && docker-php-ext-enable intl \
    && wget https://phar.phpunit.de/phpunit-7.4.phar \
    && chmod +x phpunit-7.4.phar \
    && mv phpunit-7.4.phar /usr/local/bin/phpunit

#install gd
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
    && docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

#php config
RUN echo 'memory_limit = 2G' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini;
RUN echo 'upload_max_filesize = 4G' >> /usr/local/etc/php/conf.d/docker-php-upload_max_filesize.ini;

#install xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=develop,coverage,debug,profile" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey=docker" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.log=/dev/stdout" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.log_level=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

#composer
RUN curl -sS https://getcomposer.org/installer | php -- --install=/usr/local/bin --filename=composer

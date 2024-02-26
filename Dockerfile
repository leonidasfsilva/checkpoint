FROM php:8.1-fpm

# set your user name, ex: user=bernardo
ARG user=leonidas
ARG uid=1000

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    jpegoptim optipng pngquant gifsicle \
    vim \
    libzip-dev \
    apt-utils \
    libonig-dev \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Configure the INTL extension
RUN docker-php-ext-configure intl

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo_mysql mbstring exif pcntl bcmath gd sockets intl

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Install redis
#RUN pecl install -o -f redis \
#    &&  rm -rf /tmp/pear \
#    &&  docker-php-ext-enable redis

# Set working directory
WORKDIR /var/www

# Copy custom configurations PHP
COPY docker/php/php.ini /usr/local/etc/php/

# Install Xdebug on Docker container
#RUN pecl install -o -f xdebug \
#    && docker-php-ext-enable xdebug

USER $user
FROM php:8.1-apache

RUN apt-get update && apt-get upgrade -y

# Install GD lib
RUN apt-get install --yes --force-yes libgd-dev bzip2 libzip4 libzip-dev g++ gettext libicu-dev libtidy-dev libmemcached-dev libxslt-dev git-core libpq-dev

# Install required PHP Extensions.
RUN docker-php-ext-install mysqli pdo pdo_mysql gd zip exif gettext iconv intl soap tidy xsl

# Install linux utilities.
RUN apt-get install -y vim nano iputils-ping git libzip-dev zip unzip npm

# Enable mod_rewrite and SSL.
RUN a2enmod rewrite
RUN a2enmod ssl

# Enable xdebug.
#RUN pecl install xdebug && docker-php-ext-enable xdebug
#RUN echo "xdebug.mode=off" | tee -a /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini > /dev/null && \
#    echo "xdebug.start_with_request=yes" | tee -a /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini > /dev/null && \
#    echo "xdebug.client_host=host.docker.internal" | tee -a /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini > /dev/null

# Symfony config.
# RUN rm -rf /var/www/html ; cd /var/www ; ln -s symfony/public html

# Some more ls aliases
RUN echo "alias ll='ls -alF'" >> ~/.bashrc
RUN echo "alias la='ls -A'" >> ~/.bashrc
RUN echo "alias l='ls -CF'" >> ~/.bashrc

#RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
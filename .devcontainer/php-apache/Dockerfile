FROM php:8.1-apache

# Instalar dependencias PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libxml2-dev \
    libonig-dev \
    curl \
    libpq-dev \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install \
    mysqli \
    gd \
    zip \
    mbstring \
    xml \
    pdo_mysql \
    pdo_pgsql \
 && rm -rf /var/lib/apt/lists/* \
 && a2enmod rewrite

# Evitar warning de Apache
RUN echo "ServerName proyecto-inter" > /etc/apache2/conf-available/servername.conf \
 && a2enconf servername

 
RUN printf "<Directory /var/www/html>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>\n" > /etc/apache2/conf-available/custom.conf \
 && a2enconf custom

EXPOSE 80
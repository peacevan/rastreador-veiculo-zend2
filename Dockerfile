# Imagem base
FROM php:7.1-fpm-alpine

# Configurações do PHP
RUN apt-get update && apt-get install -y \
        libicu-dev \
        libzip-dev \
        zip \
        unzip \
        && docker-php-ext-configure intl \
        && docker-php-ext-install intl \
        && docker-php-ext-install pdo_mysql \
        && docker-php-ext-install zip \
        && pecl install xdebug \
        && docker-php-ext-enable xdebug

# Configurações do Apache
RUN a2enmod rewrite

# Diretório de trabalho
WORKDIR /var/www/html

# Instalação do Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia os arquivos do projeto
COPY . .

# Instalação das dependências do Laravel
#RUN composer install --no-dev

# Configuração do banco de dados
#ENV DB_HOST=mysql \
#    DB_PORT=3306 \
#    DB_DATABASE=laravel \
#    DB_USERNAME=root \
#    DB_PASSWORD=secret

# Configuração do Apache
#COPY docker/apache/site.conf /etc/apache2/sites-available/000-default.conf

# Exposição da porta do Apache
EXPOSE 80

# Inicialização do servidor Apache
CMD ["apache2-foreground"]

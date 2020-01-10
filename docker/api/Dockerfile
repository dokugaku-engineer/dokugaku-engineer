FROM amazonlinux:2.0.20190823.1

WORKDIR /var/www

# install package
RUN yum update -y
RUN amazon-linux-extras install -y php7.3
RUN yum install -y git vim sudo procps
RUN curl -sL https://rpm.nodesource.com/setup_10.x | bash -
## for php and laravel
RUN yum install -y php-mbstring php-xml php-zip php-fpm nodejs
## for xdebug
RUN yum install -y php-pear php-devel pcre-devel gcc make

# install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'baf1608c33254d00611ac1705c1d9958c817a1a33bce370c0595974b342601bd80b92a3f46067da89e3b06bff421f182') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

# install laravel
RUN composer global require laravel/installer
ENV PATH $PATH:/root/.composer/vendor/bin

# set xdebug
RUN pecl install xdebug

ARG env=development

# set php-fpm.conf
COPY docker/api/php-fpm/php-fpm.conf /etc/php-fpm.conf
COPY docker/api/php-fpm/www.${env}.conf /etc/php-fpm.d/www.conf

# set php.ini
COPY docker/api/php.${env}.ini  /etc/php.d/php.ini

COPY api/ /var/www/

RUN composer install

RUN chmod -R 777 /var/www/storage/ /var/www/bootstrap/cache/
RUN php artisan config:clear && \
    php artisan cache:clear

# expose 9000 port
EXPOSE 9000

# PHP-FPM on foreground
ENTRYPOINT ["/usr/sbin/php-fpm", "-F"]

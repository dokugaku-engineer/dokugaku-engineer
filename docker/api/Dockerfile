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
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'a5c698ffe4b8e849a443b120cd5ba38043260d5c4023dbf93e1558871f1f07f58274fc6f4c93bcfd858c6bd0775cd8d1') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

# install laravel
RUN composer global require laravel/installer
ENV PATH $PATH:/root/.composer/vendor/bin

# set php-fpm/www.conf
RUN rm /etc/php-fpm.d/www.conf
COPY docker/api/php-fpm/www.conf /etc/php-fpm.d/www.conf

# set xdebug
RUN pecl install xdebug

# set php.ini
COPY docker/api/php.ini  /etc/php.d/php.ini

ARG env=development

COPY api/ /var/www/
COPY api/.env.${env} /var/www/.env

RUN composer install

# expose 9000 port
EXPOSE 9000

# PHP-FPM on foreground
ENTRYPOINT /usr/sbin/php-fpm -F

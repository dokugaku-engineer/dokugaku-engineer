FROM amazonlinux:2.0.20190823.1

WORKDIR /var/www

# install package
RUN yum update -y
RUN amazon-linux-extras install -y php7.3
RUN yum install -y git vim sudo procps
## PHPとLaravelを動かせるように
RUN yum install -y php-mbstring php-xml php-zip php-fpm

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
COPY php-fpm/www.conf /etc/php-fpm.d/www.conf

# 9000番ポートを開放
EXPOSE 9000

# PHP-FPMをフォアグラウンドで実行
ENTRYPOINT /usr/sbin/php-fpm -F

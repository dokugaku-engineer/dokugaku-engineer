FROM amazonlinux:2.0.20190823.1

WORKDIR /var/www

# install package
RUN amazon-linux-extras install -y php7.3
RUN yum install -y git vim sudo procps openssh-server
RUN curl -sL https://rpm.nodesource.com/setup_10.x | bash -
## for php and laravel
RUN yum install -y php-mbstring php-xml php-zip php-fpm php-soap nodejs
## for xdebug
RUN yum install -y php-pear php-devel pcre-devel gcc make


# install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'c5b9b6d368201a9db6f74e2611495f369991b72d9c8cbd3ffbc63edff210eb73d46ffbfce88669ad33695ef77dc76976') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
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

RUN chmod -R a+w /var/www/storage/ /var/www/bootstrap/cache/ /var/www/vendor/

RUN sed -i 's/PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN sed -i s/PasswordAuthentication.*/PasswordAuthentication\ yes/ /etc/ssh/sshd_config
RUN sed -i s/#PermitUserEnvironment.*/PermitUserEnvironment\ yes/ /etc/ssh/sshd_config

# expose 9000 port

EXPOSE 9000
EXPOSE 22
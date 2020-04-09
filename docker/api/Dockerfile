FROM amazonlinux:2.0.20190823.1

WORKDIR /var/www

# install package
RUN amazon-linux-extras install -y php7.3
RUN yum install -y git vim sudo procps
RUN curl -sL https://rpm.nodesource.com/setup_10.x | bash -
## for php and laravel
RUN yum install -y php-mbstring php-xml php-zip php-fpm php-soap php-bcmath nodejs
## for xdebug
RUN yum install -y php-pear php-devel pcre-devel gcc make

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

# install laravel
RUN composer global require laravel/installer
ENV PATH $PATH:/root/.composer/vendor/bin

# set xdebug
RUN pecl install xdebug

## for New Relic
RUN sudo rpm -Uvh http://yum.newrelic.com/pub/newrelic/el5/x86_64/newrelic-repo-5-3.noarch.rpm
RUN sudo yum install -y newrelic-php5
RUN sudo newrelic-install install

# set php-fpm.conf
ARG env=development
COPY docker/api/php-fpm/php-fpm.conf /etc/php-fpm.conf
COPY docker/api/php-fpm/www.${env}.conf /etc/php-fpm.d/www.conf

# set php.ini
COPY docker/api/php.${env}.ini  /etc/php.d/php.ini

COPY api/ /var/www/

RUN composer install

RUN chmod -R a+w /var/www/storage/ /var/www/bootstrap/cache/ /var/www/vendor/

# SSHしたいときはコメントアウトする
# RUN yum install -y openssh-server
# RUN sed -i 's/PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config
# RUN sed -i s/PasswordAuthentication.*/PasswordAuthentication\ yes/ /etc/ssh/sshd_config
# RUN sed -i s/#PermitUserEnvironment.*/PermitUserEnvironment\ yes/ /etc/ssh/sshd_config
# EXPOSE 22

EXPOSE 9000

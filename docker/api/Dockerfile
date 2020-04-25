FROM amazonlinux:2.0.20200406.0

WORKDIR /var/www

# パッケージのインストール
RUN amazon-linux-extras enable epel \
  && yum clean metadata \
  && yum install -y epel-release \
  && yum install -y https://rpms.remirepo.net/enterprise/remi-release-7.rpm \
  && sed -i 's/priority=10/priority=99/' /etc/yum.repos.d/amzn2-core.repo \
  && yum install -y --enablerepo=remi-php74 php php-mbstring php-xml php-pecl-zip php-fpm php-soap php-bcmath php-opcache php-pecl-apcu php-pear php-devel php-pdo php-mysqlnd
RUN yum install -y git vim sudo procps pcre-devel gcc make nodejs unzip
RUN curl -sL https://rpm.nodesource.com/setup_10.x | bash -

# composerのインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

# Laravelのインストール
RUN composer global require laravel/installer
ENV PATH $PATH:/root/.composer/vendor/bin

# xdebugのインストール
RUN pecl install xdebug

## New Relicの設定
RUN sudo rpm -Uvh http://yum.newrelic.com/pub/newrelic/el5/x86_64/newrelic-repo-5-3.noarch.rpm \
  && sudo yum install -y newrelic-php5

# php-fpm.confの設定
RUN adduser --home-dir /var/lib/nginx --shell /sbin/nologin --comment 'Nginx web server' nginx
ARG env=development
COPY docker/api/php-fpm/php-fpm.conf /etc/php-fpm.conf
COPY docker/api/php-fpm/www.${env}.conf /etc/php-fpm.d/www.conf

COPY docker/api/php-ini/php.${env}.ini  /etc/php.d/php.ini
COPY api/ /var/www/
RUN composer install
RUN chmod -R a+w /var/www/storage/ /var/www/bootstrap/cache/ /var/www/vendor/

# opcacheの設定。preloadする際に vendor/autoload.php がいるので composer install したあとに設定する
COPY docker/api/php-ini/opcache.${env}.ini /etc/php.d/opcache.ini

# SSHしたいときはコメントアウトを解除する
RUN yum install -y openssh-server
RUN sed -i 's/PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN sed -i s/PasswordAuthentication.*/PasswordAuthentication\ yes/ /etc/ssh/sshd_config
RUN sed -i s/#PermitUserEnvironment.*/PermitUserEnvironment\ yes/ /etc/ssh/sshd_config
EXPOSE 22

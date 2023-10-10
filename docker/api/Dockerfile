FROM amazonlinux:2023

WORKDIR /var/www

# パッケージのインストール
RUN dnf clean metadata \
  && dnf install -y php8.2 php-mbstring php-xml php-fpm php-soap php-bcmath php-opcache php-pear php-devel php-pdo php-mysqlnd php-zip
RUN dnf install -y git vim sudo procps pcre-devel gcc make unzip
RUN dnf install https://rpm.nodesource.com/pub_18.x/nodistro/repo/nodesource-release-nodistro-1.noarch.rpm -y \
  && dnf install nodejs -y --setopt=nodesource-nodejs.module_hotfixes=1
RUN yes "" | pecl install pecl/APCu

# composerのインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

# Laravelのインストール
RUN composer global require laravel/installer
ENV PATH $PATH:/root/.composer/vendor/bin

# php-fpm.confの設定
RUN adduser --home-dir /var/lib/nginx --shell /sbin/nologin --comment 'Nginx web server' nginx || true
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
# RUN dnf install -y openssh-server
# RUN sed -i 's/PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config
# RUN sed -i s/PasswordAuthentication.*/PasswordAuthentication\ yes/ /etc/ssh/sshd_config
# RUN sed -i s/#PermitUserEnvironment.*/PermitUserEnvironment\ yes/ /etc/ssh/sshd_config
# EXPOSE 22

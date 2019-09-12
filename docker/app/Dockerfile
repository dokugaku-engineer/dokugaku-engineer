FROM amazonlinux:2.0.20190823.1

WORKDIR "/var/dokugaku-engineer-blog"

# install package
RUN yum update -y
RUN amazon-linux-extras install -y php7.3
RUN yum install -y git vim sudo php-mbstring php-xml php-zip

# install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'a5c698ffe4b8e849a443b120cd5ba38043260d5c4023dbf93e1558871f1f07f58274fc6f4c93bcfd858c6bd0775cd8d1') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

# install laravel
RUN composer global require laravel/installer
ENV PATH $PATH:/root/.composer/vendor/bin

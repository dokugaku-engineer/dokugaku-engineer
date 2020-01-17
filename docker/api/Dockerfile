FROM amazonlinux:2.0.20190823.1 as a2-systemd

ENV container docker
RUN yum update -y
RUN yum -y install sudo systemd && yum clean all
RUN (cd /lib/systemd/system/sysinit.target.wants/; for i in *; do [ $i == \
systemd-tmpfiles-setup.service ] || rm -f $i; done); \
    rm -f /lib/systemd/system/multi-user.target.wants/*;\
    rm -f /etc/systemd/system/*.wants/*;\
    rm -f /lib/systemd/system/local-fs.target.wants/*; \
    rm -f /lib/systemd/system/sockets.target.wants/*udev*; \
    rm -f /lib/systemd/system/sockets.target.wants/*initctl*; \
    rm -f /lib/systemd/system/basic.target.wants/*;\
    rm -f /lib/systemd/system/anaconda.target.wants/*;
VOLUME [ "/sys/fs/cgroup" ]
CMD ["/usr/sbin/init"]

FROM a2-systemd

WORKDIR /var/www

# install package
RUN amazon-linux-extras install -y php7.3
RUN yum install -y git vim sudo procps
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

RUN chmod -R 777 /var/www/storage/ /var/www/bootstrap/cache/
RUN chmod -R 777 /var/www/vendor/
# RUN php artisan config:cache

# SSMエージェントの起動
RUN echo "hello"
RUN echo ${SSM_AGENT_CODE}
RUN echo "${SSM_AGENT_ID}"
RUN mkdir /tmp/ssm
RUN curl https://s3.amazonaws.com/ec2-downloads-windows/SSMAgent/latest/linux_amd64/amazon-ssm-agent.rpm -o /tmp/ssm/amazon-ssm-agent.rpm
RUN yum install -y /tmp/ssm/amazon-ssm-agent.rpm
RUN systemctl stop amazon-ssm-agent
RUN amazon-ssm-agent -register -code "${SSM_AGENT_CODE}" -id "${SSM_AGENT_ID}" -region "ap-northeast-1"
RUN sudo systemctl start amazon-ssm-agent &

# expose 9000 port
EXPOSE 9000

# PHP-FPM on foreground
ENTRYPOINT ["/usr/sbin/php-fpm", "-F"]

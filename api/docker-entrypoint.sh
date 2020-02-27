#!/bin/sh

set -e

# SSHしたいときはコメントアウトする
# root_pw=${ROOT_PW:-rooot}
# ssh-keygen -A
# echo "root:$root_pw" | chpasswd
# /usr/sbin/sshd

if [ ${APP_ENV} = "production" ]; then
  php artisan config:cache
  php artisan migrate
fi

/usr/sbin/php-fpm -F

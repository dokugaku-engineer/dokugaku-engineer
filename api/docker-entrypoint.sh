#!/bin/sh

set -e

# SSHしたいときはコメントアウトする
# root_pw=${ROOT_PW:-rooot}
# ssh-keygen -A
# echo "root:$root_pw" | chpasswd
# /usr/sbin/sshd

echo 0
if [ ${APP_ENV} = "production" ]; then
  echo 1
  php artisan config:cache
  echo 2
  php artisan migrate --force
  echo 3
fi

/usr/sbin/php-fpm -F

#!/bin/sh

set -e

# SSHしたいときはコメントアウトする
# root_pw=${ROOT_PW:-rooot}
# ssh-keygen -A
# echo "root:$root_pw" | chpasswd
# /usr/sbin/sshd

php artisan config:cache

/usr/sbin/php-fpm -F

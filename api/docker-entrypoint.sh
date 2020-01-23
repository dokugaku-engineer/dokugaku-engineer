#!/bin/sh

set -e

root_pw=${ROOT_PW:-rooot}
ssh-keygen -A
echo "root:$root_pw" | chpasswd
/usr/sbin/sshd

echo "test"
echo ${DB_CONNECTION}
echo ${DB_READ_HOST}
echo ${DB_WRITE_HOST}
echo ${DB_DATABASE}
echo ${DB_USERNAME}
echo ${DB_PASSWORD}
echo ${DB_PORT}

# if [ "$SSM_ACTIVATE" = "true" ]; then
#   amazon-ssm-agent -register -code "${ACTIVATE_CODE}" -id "${ACTIVATE_ID}" -region "ap-northeast-1" -y
#   amazon-ssm-agent &
# fi

/usr/sbin/php-fpm -F

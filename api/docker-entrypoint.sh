#!/bin/sh

set -e

root_pw=${ROOT_PW:-rooot}
ssh-keygen -A
echo "root:$root_pw" | chpasswd
/usr/sbin/sshd

# if [ "$SSM_ACTIVATE" = "true" ]; then
#   amazon-ssm-agent -register -code "${ACTIVATE_CODE}" -id "${ACTIVATE_ID}" -region "ap-northeast-1" -y
#   amazon-ssm-agent &
# fi

/usr/sbin/php-fpm -F

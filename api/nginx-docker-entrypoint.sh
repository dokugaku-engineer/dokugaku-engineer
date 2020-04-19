#!/bin/sh

# SSHしたいときにだけエントリーポイントに指定する

set -e

mkdir -p /run/sshd # Debianのバグでsshdを起動するのに必要
root_pw=${ROOT_PW:-rooot}
ssh-keygen -A
echo "root:$root_pw" | chpasswd
/usr/sbin/sshd

nginx

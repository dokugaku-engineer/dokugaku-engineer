#!/bin/sh

set -e

if [ ${APP_ENV} = "production" ]; then
  echo "Create autoload_classmap"
  composer dump-autoload --optimize
  echo "Cache config"
  php artisan config:cache
  echo "Cache routing"
  php artisan route:cache
  echo "Migrate"
  php artisan migrate --force

  echo "Enabling APM metrics"
  export NR_INSTALL_USE_CP_NOT_LN=1
  export NR_INSTALL_SILENT=1
  newrelic-install install
  sed -i \
    -e "s/\"REPLACE_WITH_REAL_KEY\"/\"${NEWRELIC_LICENSE_KEY}\"/" \
    -e 's/newrelic.appname = "PHP Application"/newrelic.appname = "Dokugaku Engineer"/' \
    -e 's/;newrelic.daemon.app_connect_timeout =.*/newrelic.daemon.app_connect_timeout=15s/' \
    -e 's/;newrelic.daemon.start_timeout =.*/newrelic.daemon.start_timeout=5s/' \
    /etc/php.d/newrelic.ini
fi

# SSHしたいときはコメントアウトを解除する
# root_pw=${ROOT_PW:-rooot}
# ssh-keygen -A
# echo "root:$root_pw" | chpasswd
# /usr/sbin/sshd

/usr/sbin/php-fpm -F

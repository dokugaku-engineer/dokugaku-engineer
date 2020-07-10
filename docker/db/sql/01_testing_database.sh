#!/bin/sh

echo "CREATE DATABASE IF NOT EXISTS \`dokugaku_engineer_testing\` ;" | "${mysql[@]}"
echo "GRANT ALL ON \`dokugaku_engineer_testing\`.* TO '"$MYSQL_USER"'@'%' ;" | "${mysql[@]}"
echo 'FLUSH PRIVILEGES ;' | "${mysql[@]}"

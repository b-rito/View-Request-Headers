#!/usr/bin/env bash

TEMP_DIR=`mktemp -d DELETEME.XXX`

move_files () {
  ARR=('index.html' 'index.php' 'styles.css' 'curl.php' 'html.php')
  for file in ${ARR[@]}; do
    cp $TEMP_DIR/webpages/$file /var/www/html/$file
  done

  PHP_VERSION=$(find /run/php/ -name "php[0-9]*.sock")
  sed -i -e "s#/run/php/php8\.1-fpm\.sock#$PHP_VERSION#g" configs/default

  cp /etc/nginx/sites-available/default /etc/nginx/sites-available/default.backup
  cp $TEMP_DIR/configs/default /etc/nginx/sites-available/default
}

apt update -y

command -v git || apt install git -y

apt install nginx php-fpm -y

git clone https://github.com/b-rito/View-Request-Headers.git $TEMP_DIR

sleep 2

move_files

sleep 2

systemctl enable nginx
systemctl start nginx

sleep 5

systemctl restart nginx

rm -R $TEMP_DIR
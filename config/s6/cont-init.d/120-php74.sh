#!/usr/bin/with-contenv bash

phpenmod -v 7.4 gd zip

# Create conf.d dir for fpm
if [[ ! -d /etc/php/7.4/fpm/conf.d ]]; then
  mkdir -p /etc/php/7.4/fpm/conf.d
fi

# Enable modules
phpenmod -v 7.4 curl dom intl  mbstring simplexml tokenizer yaml xml

# Disable modules
phpdismod -v 7.4 calendar exif ftp gettext posix readline
phpdismod -v 7.4 mysqli pdo_mysql
phpdismod -v 7.4 shmop sysvmsg sysvsem sysvshm

# Install MySQL
if [[ ($MYSQL_ENABLE = 1 || $MYSQL_ENABLE  = '1' || $MYSQL_ENABLE  = 'true' || $MYSQL_ENABLE  = 'on') ]]; then
  phpenmod -v 7.4 pdo_mysql mysqli
fi;

# Enable php ini overrides
ln -sf /etc/php/8.1/conf-available/app.ini /etc/php/7.4/fpm/conf.d/90-app.ini
ln -sf /etc/php/8.1/conf-available/app.ini /etc/php/7.4/cli/conf.d/90-app.ini

# Enable environment specific configs
ln -sf /etc/php/8.1/conf-available/app-${APP_ENV:production}.ini /etc/php/7.4/fpm/conf.d/91-app-${APP_ENV:production}.ini
ln -sf /etc/php/8.1/conf-available/app-${APP_ENV:production}.ini /etc/php/7.4/cli/conf.d/91-app-${APP_ENV:production}.ini

# Enable user specific configs
if [[ -f /etc/php/8.1/php.ini ]]; then
  ln -sf /etc/php/8.1/php.ini /etc/php/7.4/fpm/conf.d/92-php.ini
fi

if [[ -f /etc/php/8.1/php-fpm.ini ]]; then
  ln -sf /etc/php/8.1/php-fpm.ini /etc/php/7.4/fpm/conf.d/93-php-fpm.ini
fi
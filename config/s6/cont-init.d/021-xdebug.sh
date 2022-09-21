#!/usr/bin/with-contenv bash

file="${0##*/}"

PHP_FPM=${PHP_FPM:=8.1}

# Xdebug is not compatible with Swoole and JIT
# https://www.swoole.co.uk/docs/get-started/common-install-errors#trying-to-use-xdebug-and-swoole
phpdismod -v 8.1 -s cli xdebug

if [[ ($APP_DEBUG = 1 || $APP_DEBUG = '1' || $APP_DEBUG = 'true' || $APP_DEBUG = 'on') && ($XDEBUG_ENABLE = 1 || $XDEBUG_ENABLE = '1' || $XDEBUG_ENABLE = 'true' || $XDEBUG_ENABLE = 'on') ]]
then
  echo "[cont-init.d] ${file}: Enabling XDebug extension for PHP-FPM only"
  if [ -x "$(command -v phpenmod)" ]; then
    phpenmod -v $PHP_FPM -s fpm xdebug
  fi
else
  echo "[cont-init.d] ${file}: Disabling XDebug extension"
  if [ -x "$(command -v phpdismod)" ]; then
    phpdismod -v $PHP_FPM -s fpm xdebug
  fi
fi
#!/usr/bin/with-contenv bash

# Override the default environment
APP_NAME=${APP_NAME:=joomlatools-server}
printf "%s" $APP_NAME > /var/run/s6/container_environment/APP_NAME

APP_ENV=${APP_ENV:=development}
printf "%s" $APP_ENV > /var/run/s6/container_environment/APP_ENV

APP_DEBUG=${APP_DEBUG:=on}
printf "%s" $APP_DEBUG > /var/run/s6/container_environment/APP_DEBUG

APP_CACHE=${APP_CACHE:=off}
printf "%s" $APP_CACHE > /var/run/s6/container_environment/APP_CACHE

APP_PRELOAD=${APP_PRELOAD:=off}
printf "%s" $APP_PRELOAD > /var/run/s6/container_environment/APP_PRELOAD

MYSQL_ENABLE=${MYSQL_ENABLE:=1}
printf "%s" $MYSQL_ENABLE > /var/run/s6/container_environment/MYSQL_ENABLE

MYSQL_USER=${MYSQL_USER:=root}
printf "%s" $MYSQL_USER > /var/run/s6/container_environment/MYSQL_USER

MYSQL_VOLUME=${MYSQL_VOLUME:=/mnt/www/mysql}
printf "%s" $MYSQL_VOLUME > /var/run/s6/container_environment/MYSQL_VOLUME

JOOMLA_SITE=${JOOMLA_SITE:=default}
printf "%s" $JOOMLA_SITE > /var/run/s6/container_environment/JOOMLA_SITE

JOOMLA_VERSION=${JOOMLA_VERSION:=latest}
printf "%s" $JOOMLA_VERSION > /var/run/s6/container_environment/JOOMLA_VERSION
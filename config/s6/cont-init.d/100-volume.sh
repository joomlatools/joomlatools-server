#!/usr/bin/with-contenv bash

if [[ ! -d ${APP_VOLUME:=/mnt/www}/sites ]]; then
  mkdir -p ${APP_VOLUME:=/mnt/www}/sites
  chown  ${APP_USER:=www-data}:${APP_USER:=www-data} ${APP_VOLUME:=/mnt/www}/sites
fi
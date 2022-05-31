#!/bin/bash

DIR=${APP_ROOT:=/var/www}/sites/${WORDPRESS_SITE}
if [[ ! -d $DIR ]] && [[ ! -z "${WORDPRESS_SITE}" ]];
then
  echo "Installing Wordpress..."

  folioshell site:create ${WORDPRESS_SITE} --release=${WORDPRESS_VERSION}
  chown -R ${APP_USER}:${APP_USER} $DIR

else
  echo "Installing Wordpress... skipped"
fi
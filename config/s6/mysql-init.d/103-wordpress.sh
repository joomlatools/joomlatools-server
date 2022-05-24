#!/bin/bash

DIR=${APP_ROOT:=/var/www}/sites/${WORDPRESS_SITE}
if [[ ! -d $DIR ]];
then
  echo "Installing Wordpress..."

  folioshell site:create ${WORDPRESS_SITE} --wordpress=${WORDPRESS_VERSION}

else
  echo "Installing Wordpress... skipped"
fi
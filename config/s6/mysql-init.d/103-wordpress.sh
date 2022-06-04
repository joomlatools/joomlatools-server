#!/bin/bash

DIR=${APP_ROOT:=/var/www}/sites/${WORDPRESS_SITE}
if [[ ! -d $DIR ]] && [[ ! -z "${WORDPRESS_SITE}" ]];
then
  echo "Installing Wordpress..."

  folioshell site:create ${WORDPRESS_SITE} --release=${WORDPRESS_VERSION}

   if [[ ! -z "${GITPOD_WORKSPACE_URL}" ]]; then
      gp preview $(gp url 80)/${WORDPRESS_SITE}/
   fi

else
  echo "Installing Wordpress... skipped"
fi
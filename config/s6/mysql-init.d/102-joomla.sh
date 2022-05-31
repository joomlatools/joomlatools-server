#!/bin/bash

DIR=${APP_ROOT:=/var/www}/sites/${JOOMLA_SITE}
if [[ ! -d $DIR ]] && [[ ! -z "${JOOMLA_SITE}" ]];
then
  echo "Installing Joomla..."

  joomla site:create ${JOOMLA_SITE} --release=${JOOMLA_VERSION}
  #chown -R ${APP_USER}:${APP_USER} $DIR

else
  echo "Installing Joomla... skipped"
fi
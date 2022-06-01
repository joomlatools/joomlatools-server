#!/bin/bash

DIR=${APP_ROOT:=/var/www}/sites/${JOOMLA_SITE}
if [[ ! -d $DIR ]] && [[ ! -z "${JOOMLA_SITE}" ]];
then
  echo "Installing Joomla..."

  joomla site:create ${JOOMLA_SITE} --release=${JOOMLA_VERSION}

  if [[ ! -z "${GITPOD_WORKSPACE_URL}" ]]; then
    gp preview $(gp url 80)/${JOOMLA_SITE}/
  fi

else
  echo "Installing Joomla... skipped"
fi
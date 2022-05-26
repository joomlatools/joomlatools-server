#!/bin/bash

DIR=${APP_ROOT:=/var/www}/sites/${JOOMLA_SITE}
if [[ ! -d $DIR ]];
then
  echo "Installing Joomla..."

  echo "* Downloading Joomla"
  joomla site:download ${JOOMLA_SITE} --release=${JOOMLA_VERSION}

  echo "* Creating the Joomla database"
  joomla database:install ${JOOMLA_SITE} --drop

  echo "* Configuring Joomla"
  joomla site:configure ${JOOMLA_SITE} --overwrite

  echo "* Creating vhost"
  joomla vhost:create ${JOOMLA_SITE} 
else
  echo "Installing Joomla... skipped"
fi
#!/bin/bash

DIR=${APP_ROOT:=/var/www}/sites/${JOOMLA_SITE}
if [[ ! -d $DIR ]];
then
  echo "Installing Joomla..."
  chmod u+x /var/scripts/joomla_install.sh
  /var/scripts/joomla_install.sh
else
  echo "Installing Joomla... skipped"
fi
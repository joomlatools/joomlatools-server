#!/usr/bin/with-contenv bash

FILE=${APP_ROOT:=/var/www}/sites/${JOOMLA_NAME:=joomla}
if [[ -f $FILE ]];
then
  echo "Installing Joomla..."
  chmod u+x /var/scripts/joomla_install.sh
  /var/scripts/joomla_install.sh
else
  echo "Installing Joomla... skipped"
fi
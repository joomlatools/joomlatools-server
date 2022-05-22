#!/bin/bash

set -e

if [ -d "$APP_ROOT/sites/${JOOMLA_NAME}" ]; then
    exit 0
fi;

echo "* Downloading Joomla"
joomla site:download ${JOOMLA_NAME} --www=$APP_ROOT/sites --release=${JOOMLA_VERSION}

echo "* Creating the Joomla database"
joomla database:install ${JOOMLA_NAME} --www=$APP_ROOT/sites --drop --mysql-login=root:

echo "* Configuring Joomla"
joomla site:configure ${JOOMLA_NAME} --www=$APP_ROOT/sites --overwrite --mysql-login=root:

# Override opcode cache settings for mount
USER_FILE=${APP_ROOT:=/var/www}/sites/${JOOMLA_NAME}/php.ini
if [[ ! -f $USER_FILE ]]; then
  echo 'error_reporting=E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED' >> $USER_FILE
  echo 'display_errors = on' >> $USER_FILE
  echo 'display_startup_errors = on' >> $USER_FILE
  echo 'html_errors = on' >> $USER_FILE
fi

# Override opcode cache settings for mount
USER_FILE=${APP_ROOT:=/var/www}/sites/${JOOMLA_NAME}/administrator/php.ini
if [[ ! -f $USER_FILE ]]; then
echo 'error_reporting=E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED' >> $USER_FILE
  echo 'display_errors = on' >> $USER_FILE
  echo 'display_startup_errors = on' >> $USER_FILE
  echo 'html_errors = on' >> $USER_FILE
fi
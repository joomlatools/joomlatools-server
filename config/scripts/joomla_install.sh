#!/bin/bash

set -e

if [ -d "$APP_ROOT/sites/joomla" ]; then
    exit 0
fi;

echo "* Downloading Joomla"
joomla site:download ${JOOMLA_NAME} --www=$APP_ROOT/sites --release=${JOOMLA_VERSION}

echo "* Creating the Joomla database"

joomla database:install ${JOOMLA_NAME} --www=$APP_ROOT/sites --drop --mysql-login=root:

echo "* Configuring Joomla"
joomla site:configure ${JOOMLA_NAME} --www=$APP_ROOT/sites --overwrite --mysql-login=root:
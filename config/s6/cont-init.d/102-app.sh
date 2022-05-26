#!/usr/bin/with-contenv bash

echo "MySQL Configuration"
echo "> MYSQL_ENABLE = "${MYSQL_ENABLE:-undefined}
echo "> MYSQL_USER   = "${MYSQL_USER:-undefined}

if [[ $APP_ENV = "development" ]]
then
echo "> MYSQL_PASS   = "${MYSQL_PASS:-undefined}
else
echo "> MYSQL_PASS   = ****"
fi 
echo "> MYSQL_VOLUME = "${MYSQL_VOLUME:-undefined}

echo "Joomla Configuration"
echo "> JOOMLA_SITE    = "${JOOMLA_SITE:-undefined}
echo "> JOOMLA_VERSION = "${JOOMLA_VERSION:-undefined}

echo "Wordpress Configuration"
echo "> WORDPRESS_SITE    = "${WORDPRESS_SITE:-undefined}
echo "> WORDPRESS_VERSION = "${WORDPRESS_VERSION:-undefined}
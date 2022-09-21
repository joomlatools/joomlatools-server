#!/usr/bin/with-contenv bash

JOOMLA_SITE=${JOOMLA_SITE:=}
printf "%s" $JOOMLA_SITE > /var/run/s6/container_environment/JOOMLA_SITE

JOOMLA_VERSION=${JOOMLA_VERSION:=latest}
printf "%s" $JOOMLA_VERSION > /var/run/s6/container_environment/JOOMLA_VERSION

WORDPRESS_SITE=${WORDPRESS_SITE:=}
printf "%s" $WORDPRESS_SITE > /var/run/s6/container_environment/WORDPRESS_SITE

WORDPRESS_VERSION=${WORDPRESS_VERSION:=latest}
printf "%s" $WORDPRESS_VERSION > /var/run/s6/container_environment/WORDPRESS_VERSION

PHP_FPM=${PHP_FPM:=8.1}
printf "%s" $PHP_FPM > /var/run/s6/container_environment/PHP_FPM

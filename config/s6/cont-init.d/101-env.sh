#!/usr/bin/with-contenv bash

# Set default environment variables
MYSQL_ENABLE=${MYSQL_ENABLE:=1}
printf "%s" $MYSQL_ENABLE > /var/run/s6/container_environment/MYSQL_ENABLE

MYSQL_USER=${MYSQL_USER:=root}
printf "%s" $MYSQL_USER > /var/run/s6/container_environment/MYSQL_USER

MYSQL_VOLUME=${MYSQL_VOLUME:=/mnt/www/mysql}
printf "%s" $MYSQL_VOLUME > /var/run/s6/container_environment/MYSQL_VOLUME

JOOMLA_SITE=${JOOMLA_SITE:=joomla}
printf "%s" $JOOMLA_SITE > /var/run/s6/container_environment/JOOMLA_SITE

JOOMLA_VERSION=${JOOMLA_VERSION:=latest}
printf "%s" $JOOMLA_VERSION > /var/run/s6/container_environment/JOOMLA_VERSION
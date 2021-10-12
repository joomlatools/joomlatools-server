#!/usr/bin/with-contenv bash

# Set environment defaults
MYSQL_ENABLE=${MYSQL_ENABLE:=0}
printf "%s" $MYSQL_ENABLE > /var/run/s6/container_environment/MYSQL_ENABLE

MYSQL_USER=${MYSQL_USER:=root}
printf "%s" $MYSQL_USER > /var/run/s6/container_environment/MYSQL_USER

MYSQL_VOLUME=${MYSQL_VOLUME:=/var/lib/mysql}
printf "%s" $MYSQL_VOLUME > /var/run/s6/container_environment/MYSQL_VOLUME
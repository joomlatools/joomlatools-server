#!/usr/bin/with-contenv bash

# Set environment defaults
JOOMLA_SITE=${JOOMLA_SITE:=joomla}
printf "%s" $JOOMLA_SITE > /var/run/s6/container_environment/JOOMLA_SITE

JOOMLA_VERSION=${JOOMLA_VERSION:=latest}
printf "%s" $JOOMLA_VERSION > /var/run/s6/container_environment/JOOMLA_VERSION
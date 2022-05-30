#!/usr/bin/with-contenv bash

# Setup modules
a2enmod vhost_alias -q | sed "s/^/[cont-init.d] ${file}: /"

#!/usr/bin/with-contenv bash

file="${0##*/}"

# Enable default vhost
a2ensite 000-default -q | sed "s/^/[cont-init.d] ${file}: /"
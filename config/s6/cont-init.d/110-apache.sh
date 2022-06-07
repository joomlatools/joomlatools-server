#!/usr/bin/with-contenv bash

# Setup modules
a2enmod vhost_alias -q | sed "s/^/[cont-init.d] ${file}: /"

# Setup default sites
a2ensite 100-cloudflare -q | sed "s/^/[cont-init.d] ${file}: /"
a2ensite 101-gitpod -q | sed "s/^/[cont-init.d] ${file}: /"

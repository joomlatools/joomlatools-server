##
# Stage: base
#
# Build base server from scratch (used by GitHub Action)
##
#FROM jt-base AS base
FROM ghcr.io/joomlatools/jt-base:latest AS base

# Set arg defaults
ARG DEBIAN_FRONTEND=noninteractive

# HTTP Apache
EXPOSE 8080
# HTTPS Apache
EXPOSE 8443
# HTTP Swoole - FastCGI
EXPOSE 8081
# HTTP Swoole - Webhooks
EXPOSE 8082

##
# Stage: build
##
FROM scratch AS build

ENV APP_DATA=/srv/www \
    APP_ROOT=/var/www

# Copy all from build
COPY --from=base / .

##
# Onbuild
##

# S6
ONBUILD COPY ./config/*s6/*cont-init.d/ /etc/cont-init.d/
ONBUILD COPY ./config/*s6/*services.d/ /etc/services.d/

# PHP
ONBUILD COPY ./config/*php/  /etc/php/7.4/

# Apache
ONBUILD COPY ./config/*apache/  /etc/apache2/

# App
#ONBUILD COPY --chown=www-data:www-data ./ $APP_ROOT

# Git
ONBUILD ARG GIT_DEPLOY_URL
ONBUILD ARG GIT_DEPLOY_BRANCH=master
ONBUILD RUN if [ ! -z ${GIT_DEPLOY_URL} ]; then \
  rm -rf $APP_ROOT/*; \
  git clone ${GIT_DEPLOY_URL} $APP_ROOT \
        --branch ${GIT_DEPLOY_BRANCH} \
        --single-branch \
        --depth=1 \
        --separate-git-dir=/srv/git; \
fi;

# Composer
ONBUILD COPY --chown=www-data:www-data ./config/*composer.lock $APP_DATA

ONBUILD ENV COMPOSER_ALLOW_SUPERUSER=1
ONBUILD ENV COMPOSER_HOME=/tmp
ONBUILD RUN /bin/bash -e /var/scripts/composer_install.sh;

ONBUILD WORKDIR $APP_ROOT

# Run S6 overlay
ENTRYPOINT ["/init"]

##
# Stage: development
##
FROM build

# Clean up apt cache and temp files to save disk space
RUN /bin/bash -e /var/scripts/apt_clean.sh;
RUN /bin/bash -e /var/scripts/apt_purge.sh;
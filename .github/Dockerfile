# --- DO NOT MODIFY ---------------------------------------------------------------------------------------------------

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
EXPOSE 8080 8443 80 443

# MySQL
EXPOSE 3306 33060

# Install sudo (required for Gitpod)
RUN apt-get install -y --no-install-recommends sudo

# Install MySQL
COPY ./config/s6/mysql-init.d /etc/mysql-init.d/
COPY ./config/mysql /etc/mysql/
RUN apt-get install -y --no-install-recommends mysql-server php8.1-mysql php8.1-mysqli

# Install Console
COPY ./config/console /root/.joomlatools/console/

# Install Folishell
COPY ./config/folioshell /root/.foliolabs/folioshell/

##
# Stage: build
##
FROM scratch AS build

ENV APP_DATA=/srv/www \
    APP_ROOT=/var/www \
    APP_VOLUME=/mnt/www \
    APP_USER=www-data

# Copy all from build
COPY --from=base / .

# Remove copied files
RUN rm -rf $APP_ROOT/*

# Remove services
RUN rm -rf /usr/bin/apache_exporter
RUN rm -rf /usr/bin/php-fpm_exporter

RUN rm -rf /etc/services.d/apache-exporter
RUN rm -rf /etc/services.d/apache-phpfpm-exporter
#RUN rm -rf /etc/services.d/fastcgi
#RUN rm -rf /etc/services.d/file
#RUN rm -rf /etc/services.d/api

#RUN rm -rf /srv/www/services/fastcgi
#RUN rm -rf /srv/www/services/file
#RUN rm -rf /srv/www/services/api

#RUN rm /etc/cont-init.d/030-fastcgi.sh
#RUN rm /etc/cont-init.d/050-file.sh
#RUN rm /etc/cont-init.d/040-api.sh

# Enable services
RUN rm /etc/services.d/fastcgi/down
RUN rm /etc/services.d/file/down
RUN rm /etc/services.d/phpfpm/down

# Remove MySQL default databas
RUN rm -rf /var/lib/mysql

# Clean up apt cache and temp files to save disk space
RUN /bin/bash -e /var/scripts/apt_clean.sh;
RUN /bin/bash -e /var/scripts/apt_purge.sh;

# Run S6 overlay
ENTRYPOINT ["/init"]

##
# Stage: development
##
FROM build

ENV APP_DATA=/srv/www \
    APP_ROOT=/var/www \
    APP_USER=www-data

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/tmp \
    COMPOSER_NO_DEV=1

# App
COPY --chown=$APP_USER:$APP_USER ./ $APP_ROOT
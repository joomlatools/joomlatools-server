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
# HTTP Swoole - FastCGI
EXPOSE 8081
# HTTP Swoole - API
EXPOSE 8082
# HTTP Swoole - File
EXPOSE 8083
# MySQL
EXPOSE 3306 33060

# Install MySQL
COPY ./config/mysql /etc/mysql/
RUN apt-get install -y --no-install-recommends mysql-server php8.1-mysql

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

# Run S6 overlay
ENTRYPOINT ["/init"]

##
# Stage: development
##
FROM build

# Enable services
RUN rm /etc/services.d/fastcgi/down
RUN rm /etc/services.d/file/down
RUN rm /etc/services.d/phpfpm/down
RUN rm /etc/services.d/apache-exporter/down
RUN rm /etc/services.d/phpfpm-exporter/down

# Clean up apt cache and temp files to save disk space
RUN /bin/bash -e /var/scripts/apt_clean.sh;
RUN /bin/bash -e /var/scripts/apt_purge.sh;
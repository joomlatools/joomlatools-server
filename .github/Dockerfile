# --- DO NOT MODIFY ---------------------------------------------------------------------------------------------------

##
# Stage: mhsendmail builder
#
# Build mhsendmail in Go again as the releases don't include arm64 binaries. 
# See: https://github.com/mailhog/mhsendmail/issues/28#issuecomment-1001176278
##

ARG IMAGE_TAG=master

FROM golang:1.15 AS builder
ARG TARGETARCH
RUN go get -d -v github.com/mailhog/mhsendmail \
  && cd /go/src/github.com/mailhog/mhsendmail/ \
  && GOOS=linux GOARCH=$TARGETARCH go build -o mhsendmail .

##
# Stage: base
#
# Build base server from scratch (used by GitHub Action)
##

#FROM jt-base AS base
FROM ghcr.io/joomlatools/jt-mysql:${IMAGE_TAG} as build

# Set arg defaults
ARG DEBIAN_FRONTEND=noninteractive

ENV APP_DATA=/srv/www \
    APP_ROOT=/var/www \
    APP_USER=www-data \
    MYSQL_ENABLE=1

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/tmp \
    COMPOSER_NO_DEV=1 \
    COMPOSER_IGNORE_PLATFORM_REQS=1

# HTTP Apache
EXPOSE 8080 8443 80 443

# MySQL
EXPOSE 3306 33060

RUN /bin/bash -e /var/scripts/apt_config.sh;  \
    /bin/bash -e /var/scripts/apt_upgrade.sh; \
    apt-get update; \
    # Install sudo (required for Gitpod)
    apt-get install -y --no-install-recommends sudo; \
    # PHP extensions
    apt-get install -y --no-install-recommends php8.1-gd php8.1-zip;

RUN apt-get install --no-install-recommends -y \
            php7.4-fpm \
            php7.4-igbinary \
            php7.4-yaml \
            php7.4-apcu \
            php7.4-xml \
            php7.4-mbstring \
            php7.4-curl \
            php7.4-intl \
            php7.4-xdebug \
            php7.4-mysql \
            php7.4-mysqli \
            php7.4-gd \
            php7.4-zip;

COPY ./config/*php7.4/  /etc/php/7.4/
COPY ./config/*s6/*services.d/ /etc/services.d/

# Install Console
COPY ./config/console /root/.joomlatools/console/

# Install Folishell
COPY ./config/folioshell /root/.foliolabs/folioshell/

# Install jtctl
COPY ./bin/jtctl /usr//bin/jtctl

# Copy mhsendmail from the builder
COPY --from=builder /go/src/github.com/mailhog/mhsendmail/mhsendmail /usr/bin/mhsendmail
RUN chmod +x /usr/bin/mhsendmail

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

# Clean up apt cache and temp files to save disk space
RUN /bin/bash -e /var/scripts/apt_clean.sh;
RUN /bin/bash -e /var/scripts/apt_purge.sh;

# Run S6 overlay
ENTRYPOINT ["/init"]
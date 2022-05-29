##
# Stage: base
#
# Build gitpod server
# Version: 1.0.0-dev build 34

ARG IMAGE_TAG=latest
FROM ghcr.io/joomlatools/joomlatools-server:${IMAGE_TAG} as base

ENV APP_DATA=/srv/www \
    APP_ROOT=/workspace/joomlatools-server \
    APP_VOLUME=/mnt/www \
    APP_USER=gitpod \
    APP_HTTP=80 \
    APP_HTTPS=443

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/tmp

ENV APP_ENV=development \
    APP_PRELOAD=off \
    APP_CACHE=off \
    APP_DEBUG=on

# Mason
ADD https://files.joomlatools.com/mason/mason-linux.tar.gz /tmp/
RUN tar xvzf /tmp/mason-linux.tar.gz -C /tmp; \
    cp /tmp/bin/mason /usr/bin/mason; \
    chmod 755 /usr/bin/mason

# User
RUN useradd -l -u 33333 -G sudo -md /home/gitpod -s /bin/bash -p gitpod gitpod; \
    usermod -a -G www-data gitpod; \
    usermod -a -G mysql gitpod; \
    sed -i.bkp -e 's/%sudo\s\+ALL=(ALL\(:ALL\)\?)\s\+ALL/%sudo ALL=NOPASSWD:ALL/g' /etc/sudoers

# Permissions
RUN mkdir -p $APP_VOLUME; \
    chown -R $APP_USER:$APP_USER $APP_VOLUME; \
    chown -R $APP_USER:$APP_USER $APP_DATA

# Composer
RUN rm -f $APP_DATA/composer.lock
COPY --chown=$APP_USER:$APP_USER ./config/composer.stub ./config/*composer.lock $APP_DATA/

USER gitpod
WORKDIR $APP_ROOT
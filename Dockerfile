ARG IMAGE_TAG=master
FROM ghcr.io/joomlatools/joomlatools-server:${IMAGE_TAG} as base

ENV APP_DATA=/srv/www \
    APP_ROOT=/var/www \
    APP_USER=www-data \
    MYSQL_ENABLE=1

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/tmp \
    COMPOSER_NO_DEV=1

# App
WORKDIR $APP_ROOT
COPY --chown=$APP_USER:$APP_USER ./ $APP_ROOT
ARG IMAGE_TAG=latest
FROM ghcr.io/joomlatools/joomlatools-server:${IMAGE_TAG} as base

ENV APP_DATA=/srv/www \
    APP_ROOT=/var/www \
    APP_USER=www-data

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/tmp \
    COMPOSER_NO_DEV=1

# App
COPY --chown=$APP_USER:$APP_USER ./ $APP_ROOT
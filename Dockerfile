##
# Stage: base
#
# Build app server
##
FROM ghcr.io/joomlatools/joomlatools-server:latest as base

ENV APP_DATA=/srv/www \
    APP_ROOT=/var/www \
    APP_VOLUME=/mnt/www \
    APP_USER=www-data

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/tmp

# --- DO NOT MODIFY ABOVE ----------------------------------------------------------------------------------------------

##
# START: custom Docker instructions
##


##
# END:  custom Docker instructions
##

# --- DO NOT MODIFY BELOW ----------------------------------------------------------------------------------------------

# App
COPY --chown=$APP_USER:$APP_USER ./ $APP_ROOT

# Git
ARG GIT_DEPLOY_URL
ARG GIT_DEPLOY_BRANCH=master
RUN if [ ! -z ${GIT_DEPLOY_URL} ]; then \
  rm -rf $APP_ROOT/*; \
  git clone ${GIT_DEPLOY_URL} $APP_ROOT \
        --branch ${GIT_DEPLOY_BRANCH} \
        --single-branch \
        --depth=1 \
        --separate-git-dir=/srv/git; \
fi;

# Composer
RUN rm -f $APP_DATA/composer.lock
COPY --chown=$APP_USER:$APP_USER ./config/composer.stub ./config/*composer.lock $APP_DATA/
RUN /bin/bash -e /var/scripts/composer_install.sh;

##
# Stage: build
##

FROM scratch as build

ENV APP_DATA=/srv/www \
    APP_ROOT=/var/www \
    APP_VOLUME=/mnt/www \
    APP_USER=www-data

# Copy all from base
COPY --from=base / .

# Clean up apt cache and temp files to save disk space
RUN /bin/bash -e /var/scripts/apt_clean.sh;
RUN /bin/bash -e /var/scripts/apt_purge.sh;

WORKDIR $APP_ROOT

# Run S6 overlay
ENTRYPOINT ["/init"]
##
# Stage: base
#
# Build app server
##
FROM ghcr.io/joomlatools/pages-server:latest as base

ENV APP_DATA=/srv/www \
    APP_ROOT=/var/www \
    APP_USER=www-data

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
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_HOME=/tmp

COPY --chown=$APP_USER:$APP_USER ./config/*composer.lock $APP_DATA
RUN /bin/bash -e /var/scripts/composer_install.sh;

##
# Stage: build
##

FROM scratch as build

ENV APP_ROOT=/var/www

# Copy all from base
COPY --from=base / .

# Clean up apt cache and temp files to save disk space
RUN /bin/bash -e /var/scripts/apt_clean.sh;
RUN /bin/bash -e /var/scripts/apt_purge.sh;

WORKDIR $APP_ROOT

# Run S6 overlay
ENTRYPOINT ["/init"]
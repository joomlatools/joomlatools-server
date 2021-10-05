##
# Stage: base
#
# Build gitpod server
##

FROM ghcr.io/joomlatools/pages-server:latest as base

ENV APP_ROOT=/var/www \
    APP_DISK=/mnt/www

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/tmp

# --- DO NOT MODIFY ABOVE ----------------------------------------------------------------------------------------------

##
# START: custom Gitpod instructions
##


##
# END:  custom Gitpod instructions
##

# --- DO NOT MODIFY BELOW ----------------------------------------------------------------------------------------------

# App
COPY --chown=$APP_USER:$APP_USER ./ $APP_ROOT

# Composer
COPY --chown=$APP_USER:$APP_USER ./config/*composer.lock $APP_DATA
RUN /bin/bash -e /var/scripts/composer_install.sh;

# User
RUN apt-get install -y --no-install-recommends sudo; \
    useradd -l -u 33333 -G sudo -md /home/gitpod -s /bin/bash -p gitpod gitpod; \
    usermod -a -G www-data gitpod; \
    sed -i.bkp -e 's/%sudo\s\+ALL=(ALL\(:ALL\)\?)\s\+ALL/%sudo ALL=NOPASSWD:ALL/g' /etc/sudoers

RUN mkdir $APP_DISK
RUN chown -R gitpod:gitpod $APP_DISK

USER gitpod
WORKDIR $APP_ROOT
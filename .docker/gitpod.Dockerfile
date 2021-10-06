##
# Stage: base
#
# Build gitpod server
##

FROM ghcr.io/joomlatools/pages-server:latest as base

ENV APP_DATA=/srv/www \
    APP_ROOT=/workspace/pages-server \
    APP_DISK=/mnt/www \
    APP_USER=gitpod

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/tmp

# --- DO NOT MODIFY ABOVE ----------------------------------------------------------------------------------------------

ENV APP_ENV=development \
    APP_PRELOAD=off \
    APP_CACHE=off \
    APP_DEBUG=on

##
# START: custom Gitpod instructions
##


##
# END:  custom Gitpod instructions
##

# --- DO NOT MODIFY BELOW ----------------------------------------------------------------------------------------------

# User
RUN apt-get install -y --no-install-recommends sudo; \
    useradd -l -u 33333 -G sudo -md /home/gitpod -s /bin/bash -p gitpod gitpod; \
    usermod -a -G www-data gitpod; \
    sed -i.bkp -e 's/%sudo\s\+ALL=(ALL\(:ALL\)\?)\s\+ALL/%sudo ALL=NOPASSWD:ALL/g' /etc/sudoers

RUN mkdir $APP_DISK
RUN chown -R $APP_USER:$APP_USER $APP_DISK

# Composer
COPY --chown=$APP_USER:$APP_USER ./config/*composer.lock $APP_DATA
RUN /bin/bash -e /var/scripts/composer_install.sh

USER gitpod
WORKDIR $APP_ROOT

# Node.js
ENV NODE_VERSION=14.18.0
RUN curl -fsSL https://raw.githubusercontent.com/nvm-sh/nvm/v0.38.0/install.sh | PROFILE=/dev/null bash \
    && bash -c ". .nvm/nvm.sh \
        && nvm install $NODE_VERSION \
        && nvm alias default $NODE_VERSION \
        && npm install -g typescript yarn node-gyp" \
    && echo ". ~/.nvm/nvm-lazy.sh"  >> /home/gitpod/.bashrc.d/50-node
# above, we are adding the lazy nvm init to .bashrc, because one is executed on interactive shells, the other for non-interactive shells (e.g. plugin-host)
COPY --chown=gitpod:gitpod nvm-lazy.sh /home/gitpod/.nvm/nvm-lazy.sh
ENV PATH=$PATH:/home/gitpod/.nvm/versions/node/v${NODE_VERSION}/bin
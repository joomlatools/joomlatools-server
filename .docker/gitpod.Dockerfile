##
# Stage: base
#
# Build gitpod server
##

FROM ghcr.io/joomlatools/pages-server:latest as base

ENV APP_DATA=/srv/www \
    APP_ROOT=/var/www \
    APP_USER=gitpod \
    APP_ENV=development \
    APP_DEBUG=1 \
    APP_NONCE=cDWPradF2E

##
# START: custom Gitpod instructions
##


##
# END:  custom Gitpod instructions
##

# --- DO NOT MODIFY BELOW ----------------------------------------------------------------------------------------------

RUN chown -R gitpod:gitpod ${APP_DISK:=/mnt/www}

RUN apt-get install -y --no-install-recommends sudo
RUN useradd -l -u 33333 -G sudo -md /home/gitpod -s /bin/bash -p gitpod gitpod; \
    sed -i.bkp -e 's/%sudo\s\+ALL=(ALL\(:ALL\)\?)\s\+ALL/%sudo ALL=NOPASSWD:ALL/g' /etc/sudoers

USER gitpod

WORKDIR $APP_ROOT
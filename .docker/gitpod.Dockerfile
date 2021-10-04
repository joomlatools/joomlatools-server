FROM ghcr.io/joomlatools/pages-server:latest as base

##
# START: custom Gitpod instructions
##

RUN apt-get install -y --no-install-recommends rolldice

##
# END:  custom Gitpod instructions
##

# --- DO NOT MODIFY BELOW ----------------------------------------------------------------------------------------------

ENV APP_USER=gitpod
ENV APP_ENV=development
ENV APP_DEBUG=1
ENV APP_NONCE=cDWPradF2E

RUN apt-get install -y --no-install-recommends sudo
RUN useradd -l -u 33333 -G sudo -md /home/gitpod -s /bin/bash -p gitpod gitpod; \
    sed -i.bkp -e 's/%sudo\s\+ALL=(ALL\(:ALL\)\?)\s\+ALL/%sudo ALL=NOPASSWD:ALL/g' /etc/sudoers

USER gitpod
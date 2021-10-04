##
# Stage: base
#
# Build app server
##
FROM ghcr.io/joomlatools/pages-server:latest as base

##
# START: custom Docker instructions
##

RUN apt-get install -y --no-install-recommends sudo
RUN apt-get install -y --no-install-recommends rolldice

### Gitpod user ###
# '-l': see https://docs.docker.com/develop/develop-images/dockerfile_best-practices/#user
RUN useradd -l -u 33333 -G sudo -md /home/gitpod -s /bin/bash -p gitpod gitpod \
    # passwordless sudo for users in the 'sudo' group
    && sed -i.bkp -e 's/%sudo\s\+ALL=(ALL\(:ALL\)\?)\s\+ALL/%sudo ALL=NOPASSWD:ALL/g' /etc/sudoers
ENV HOME=/home/gitpod
WORKDIR $HOME
# custom Bash prompt
RUN { echo && echo "PS1='\[\033[01;32m\]\u\[\033[00m\] \[\033[01;34m\]\w\[\033[00m\]\$(__git_ps1 \" (%s)\") $ '" ; } >> .bashrc

### Gitpod user (2) ###
#USER gitpod

# use sudo so that user does not get sudo usage info on (the first) login
RUN sudo echo "Running 'sudo' for Gitpod: success" && \
    # create .bashrc.d folder and source it in the bashrc
    mkdir -p /home/gitpod/.bashrc.d && \
    (echo; echo "for i in \$(ls -A \$HOME/.bashrc.d/); do source \$HOME/.bashrc.d/\$i; done"; echo) >> /home/gitpod/.bashrc

##
# END:  custom Docker instructions
##

# --- DO NOT MODIFY BELOW ----------------------------------------------------------------------------------------------

##
# Stage: build
#
# Note: Using a scratch image doesn't work with Gitpod
##

#FROM scratch as build

# Copy all from base
#COPY --from=base / .

# Clean up apt cache and temp files to save disk space
#RUN /bin/bash -e /var/scripts/apt_clean.sh;
#RUN /bin/bash -e /var/scripts/apt_purge.sh;

# Run S6 overlay
ENTRYPOINT ["/init"]
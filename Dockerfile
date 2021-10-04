##
# Stage: base
#
# Build app server
##
FROM ghcr.io/joomlatools/pages-server:latest as base

##
# START: custom Docker instructions
##

COPY ./config/*s6/*cont-init.d/ /etc/cont-init.d/

##
# END:  custom Docker instructions
##

# --- DO NOT MODIFY BELOW ----------------------------------------------------------------------------------------------

##
# Stage: build
##
#FROM scratch as build

# Copy all from base
#COPY --from=base / .

# Clean up apt cache and temp files to save disk space
RUN /bin/bash -e /var/scripts/apt_clean.sh;
RUN /bin/bash -e /var/scripts/apt_purge.sh;

# Run S6 overlay
ENTRYPOINT ["/init"]
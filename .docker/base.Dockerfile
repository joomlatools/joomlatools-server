##
# Stage: base
#
# Build base server from scratch (used by GitHub Action)
##

#FROM jt-base AS base
FROM ghcr.io/joomlatools/jt-base:latest AS base

# Set arg defaults
ARG DEBIAN_FRONTEND=noninteractive

# HTTP Apache
EXPOSE 8080
# HTTPS Apache
EXPOSE 8443
# HTTP Swoole - FastCGI
EXPOSE 8081
# HTTP Swoole - Webhooks
EXPOSE 8082

##
# Stage: build
##
FROM scratch AS build

# Copy all from build
COPY --from=base / .

# Run S6 overlay
ENTRYPOINT ["/init"]

##
# Stage: development
##
FROM build

# Clean up apt cache and temp files to save disk space
RUN /bin/bash -e /var/scripts/apt_clean.sh;
RUN /bin/bash -e /var/scripts/apt_purge.sh;
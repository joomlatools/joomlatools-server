#!/usr/bin/with-contenv bash

# https://github.com/docker-library/mysql/issues/275#issuecomment-292208567
# > mysqld --verbose --help | grep bind-address

file="${0##*/}"

if [[ $MYSQL_ENABLE -eq 0 ]] ; then
  mkdir -p /var/run/s6/services/mysql
  printf "1" > /var/run/s6/services/mysql/down
  exit
fi

MYSQL_PID_FILE=/var/run/mysqld/mysqld.pid
MYSQL_RUN_DIR=/var/run/mysqld

# Make sure run dir exists
if [[ ! -d $MYSQL_RUN_DIR ]]; then
	mkdir -p $MYSQL_RUN_DIR
fi

# Remove stale MySQL PID file left behind when docker stops container
if [[ -f $MYSQL_PID_FILE ]]; then
	rm -f $MYSQL_PID_FILE
fi

# Ensure that $MYSQL_RUN_DIR (used for socket and lock files) is writable
chown -R mysql:mysql $MYSQL_RUN_DIR
chmod 1777 $MYSQL_RUN_DIR

# Make check command executable (called in /etc/services.d/mysql/run)
chmod u+x /etc/services.d/mysql/data/check

# Initialize MySQL data directory (if needed)
# See https://dev.mysql.com/doc/refman/8.0/en/data-directory-initialization.html
if [[ ! -f $MYSQL_VOLUME/mysql.ibd ]]; then

  echo "[cont-init.d] ${file}: Installing MySQL in ${MYSQL_VOLUME} ..."

  if [[ ! -d $MYSQL_VOLUME ]]; then
  	 mkdir -p $MYSQL_VOLUME
  fi

  # Ensure that $MYSQL_VOLUME (used data storage) is writable
  chown -R mysql:mysql $MYSQL_VOLUME
  chmod 1777 $MYSQL_VOLUME

  /usr/sbin/mysqld --initialize-insecure --datadir=${MYSQL_VOLUME}
fi

# Create option file to allow passwordless login for clients
# https://dev.mysql.com/doc/refman/8.0/en/option-files.html
USER_FILE=~/.my.cnf
echo '[client]' >> $USER_FILE
echo "user=${MYSQL_USER}" >> $USER_FILE
echo "password=${MYSQL_PASS}" >> $USER_FILE
chmod 0400 ~/.my.cnf
#!/bin/bash -e

#-------------------------------------------------------------------
# Initialize mysql (if there is no datadir present).
#-------------------------------------------------------------------

MYSQL_DATA_DIR=${APP_VOLUME:=/mnt/www}/mysql
MYSQL_RUN_DIR=/var/run/mysqld

# Make sure lib dir exists
if [[ ! -d $MYSQL_DATA_DIR ]]; then
	mkdir -p $MYSQL_DATA_DIR
fi

# Make sure run dir exists
if [[ ! -d $MYSQL_RUN_DIR ]]; then
	mkdir -p $MYSQL_RUN_DIR
fi

# Ensure that /var/run/mysqld (used for socket and lock files) is writable
chown -R mysql:mysql $MYSQL_RUN_DIR $MYSQL_DATA_DIR
chmod 1777 $MYSQL_RUN_DIR $MYSQL_DATA_DIR

# Initialize MySQL data directory (if needed)
# See https://dev.mysql.com/doc/refman/8.0/en/data-directory-initialization.html
/usr/bin/mysqld_safe --initialize-insecure --datadir=${MYSQL_DATA_DIR}
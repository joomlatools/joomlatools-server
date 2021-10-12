#!/usr/bin/with-contenv bash

# https://github.com/docker-library/mysql/issues/275#issuecomment-292208567
# > mysqld --verbose --help | grep bind-address

file="${0##*/}"

if [[ $MYSQL_ENABLE -eq 1 ]] ; then
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

# Ensure that /var/run/mysqld (used for socket and lock files) is writable
chown -R mysql:mysql $MYSQL_RUN_DIR
chmod 1777 $MYSQL_RUN_DIR

# Initialize MySQL data directory (if needed)
# See https://dev.mysql.com/doc/refman/8.0/en/data-directory-initialization.html
if [[ ! -d $MYSQL_VOLUME ]]; then

  echo "[cont-init.d] ${file}: Installing MySQL in ${MYSQL_VOLUME} ..."

  mkdir -p $MYSQL_VOLUME
  /usr/bin/mysqld_safe --initialize-insecure --datadir=${MYSQL_VOLUME}

fi

# Grant or revoke passwordless remote access
/usr/bin/mysqld_safe --datadir=${MYSQL_VOLUME} -D

echo "[cont-init.d] ${file}: Granting local access of MySQL database from localhost for ${MYSQL_USER}"
/usr/bin/mysql -e "
  CREATE USER IF NOT EXISTS '${MYSQL_USER}'@'%';
 "

if [[ $APP_ENV = "development" ]]
then
  echo "[cont-init.d] ${file}: Granting remote access of MySQL database from any IP address for ${MYSQL_USER}"
  /usr/bin/mysql -e "
    CREATE USER IF NOT EXISTS '${MYSQL_USER}'@'%';
    GRANT ALL ON *.* TO '${MYSQL_USER}'@'%';
    FLUSH PRIVILEGES;
    "
else
  echo "[cont-init.d] ${file}: Revoking remote access of MySQL database from any IP address for ${MYSQL_USER}"
   /usr/bin/mysql -e -f "
      REVOKE ALL PRIVILEGES, GRANT OPTION FROM '${MYSQL_USER}'@'%';
      DROP USER IF EXISTS '${MYSQL_USER}'@'%';
      "
fi

/usr/bin/mysqladmin shutdown
#!/usr/bin/with-contenv bash

# https://github.com/docker-library/mysql/issues/275#issuecomment-292208567
# > mysqld --verbose --help | grep bind-address

file="${0##*/}"

MYSQL_DATA_DIR=$APP_VOLUME/mysql
MYSQL_PID_FILE=/var/run/mysqld/mysqld.pid

# Remove stale MySQL PID file left behind when docker stops container
if [[ -f $MYSQL_PID_FILE ]]; then
	rm -f $MYSQL_PID_FILE
fi

# Initialize MySQL data directory (if needed)
# See https://dev.mysql.com/doc/refman/8.0/en/data-directory-initialization.html
if [[ ! -d $MYSQL_DATA_DIR ]]; then

  echo "[cont-init.d] ${file}: An empty or uninitialized MySQL volume is detected in ${MYSQL_DATA_DIR}"
  echo "[cont-init.d] ${file}: Installing MySQL in ${MYSQL_DATA_DIR} ..."
  mkdir $MYSQL_DATA_DIR
  chown --reference=/var/lib/mysql $MYSQL_DATA_DIR
  chmod --reference=/var/lib/mysql $MYSQL_DATA_DIR
  cp -R -p /var/lib/mysql/* $MYSQL_DATA_DIR

fi

# Grant or revoke passwordless remote access
/usr/bin/mysqld_safe --datadir=$MYSQL_DATA_DIR --user=mysql -D
if [[ $APP_ENV = "development" ]]
then
  echo "[cont-init.d] ${file}: Granting remote access of MySQL database from any IP address"
  /usr/bin/mysql -u root -e "
    CREATE USER IF NOT EXISTS 'root'@'%';
    GRANT ALL ON *.* TO 'root'@'%';
    FLUSH PRIVILEGES;
    "
else
  echo "[cont-init.d] ${file}: Revoking remote access of MySQL database from any IP address"
   /usr/bin/mysql -u root -e -f "
      REVOKE ALL PRIVILEGES, GRANT OPTION FROM 'root'@'%';
      DROP USER IF EXISTS 'root'@'%';
      "
fi

/usr/bin/mysqladmin -u root shutdown
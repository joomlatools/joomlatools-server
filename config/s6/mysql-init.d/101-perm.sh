#!/usr/bin/with-contenv bash

echo "[myql-init.d] ${file}: Granting local access of MySQL database from localhost for ${MYSQL_USER}"

if [[ $APP_ENV = "development" ]]
then
  echo "[mysql-init.d] ${file}: Granting remote access of MySQL database from any IP address for ${MYSQL_USER}"
  /usr/bin/mysql -e "
    CREATE USER IF NOT EXISTS '${MYSQL_USER}'@'%';
    ALTER USER '${MYSQL_USER}'@'%' IDENTIFIED WITH mysql_native_password BY '${MYSQL_PASS}';
    ALTER USER '${MYSQL_USER}'@'localhost' IDENTIFIED WITH mysql_native_password BY '${MYSQL_PASS}';
    GRANT ALL ON *.* TO '${MYSQL_USER}'@'%';
    FLUSH PRIVILEGES;
    "
else
  echo "[mysql-init.d] ${file}: Revoking remote access of MySQL database from any IP address for ${MYSQL_USER}"
   /usr/bin/mysql -e -f "
      REVOKE ALL PRIVILEGES, GRANT OPTION FROM '${MYSQL_USER}'@'%';
      DROP USER IF EXISTS '${MYSQL_USER}'@'%';
      "
fi
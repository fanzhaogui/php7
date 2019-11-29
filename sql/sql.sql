# noinspection SqlNoDataSourceInspectionForFile

# user, uer_password 和 dbname 可根据需求更改

CREATE DATABASE IF NOT EXISTS dbname DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE USER 'uesr'@'%' IDENTIFIED WITH mysql_native_password;

SET PASSWORD FOR 'user'@'%' = PASSWORD('user_password');

GRANT ALL PRIVILEGES ON dbname.* to 'user'@'%';

GRANT ALL PRIVILEGES ON dbname.* to 'user'@'localhost';

FlUSH PRIVILEGES;
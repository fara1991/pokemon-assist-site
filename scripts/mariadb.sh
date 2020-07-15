#!/bin/sh

cd `dirname $0`
. ../.env

docker-compose exec mariadb mysql -u${DB_USERNAME} -p${DB_PASSWORD} ${DB_DATABASE}

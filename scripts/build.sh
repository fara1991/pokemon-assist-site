#!/bin/sh

cd `dirname $0`
. ../.env

docker-compose exec -T workspace bash -c '
    composer install &&
    npm install &&
    php artisan migrate:rollback &&
    php artisan migrate &&
    php artisan db:seed &&
    npm run prod
'

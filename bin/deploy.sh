#!/bin/bash

cd /var/www/package-maker || return
docker-compose down
docker-compose up -d
docker-compose exec -T web composer install
docker-compose exec -T web chown -R 1000:www-data .
docker-compose exec -T web chmod -R 775 .
echo "The deploy script ran"
echo "done"




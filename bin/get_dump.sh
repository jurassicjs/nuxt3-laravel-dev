##!/bin/bash
##
DUMP_ZIPPED="data/database.sql.gz"

export DOCKER_HOST=ssh://package-maker_prod_server
echo " set docker host"
echo " $DOCKER_HOST"

echo "downloading dump from $DOCKER_HOST to $DUMP_ZIPPED"
docker exec -it package-maker_mysql sh -c "export MYSQL_PWD=384jjd243j44329 && mysqldump -uroot package-maker" | gzip > $DUMP_ZIPPED || exit 1;

unset " $DOCKER_HOST"
echo " unset docker host "

if test -f "$DUMP_ZIPPED"; then
    echo "$DUMP_ZIPPED has been downloaded . . . "
fi

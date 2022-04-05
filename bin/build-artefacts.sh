#!/bin/bash
set -e

USAGE="Usage: build-artefacts.sh <environment>"

export LC_ALL="en_US.UTF-8"

ENVIRONMENT=$1
if [[ -z $ENVIRONMENT ]]
then
    echo "No environment specified" 1>&2;
    echo $USAGE 1>&2;
    exit 1
fi

docker-compose run builder build /build $ENVIRONMENT
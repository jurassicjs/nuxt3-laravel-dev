#!/bin/bash
#
# Deploy artefacts to production

USAGE="Usage: deploy-artefacts <BUILD_VERSION> <TARGET_SERVER>"

set -e

export LC_ALL="en_US.UTF-8"

BUILD_VERSION=$1
if [[ -z $BUILD_VERSION ]]
then
    echo "No build version specified" 1>&2;
    echo $USAGE 1>&2;
    exit 1
fi

TARGET_SERVER=$2
if [[ -z $TARGET_SERVER ]]
then
    echo "No target server specified" 1>&2;
    echo $USAGE 1>&2;
    exit 1
fi

function getTimestamp() {
    echo "[`date '+%Y-%m-%d %H:%M:%S'`]"
}


echo "`getTimestamp` Deploying build \"$BUILD_VERSION\" on server \"$TARGET_SERVER\""

read -r -p "Are you sure you want to continue? [y/N] " response
case "$response" in
    [yY][eE][sS]|[yY])
        ;;
    *)
        exit 1
        ;;
esac

PROJECT_NAME=package-maker
TARGET_DIRECTORY=/var/www
TARGET_DATA_DIRECTORY=$TARGET_DIRECTORY/data
TARGET_ARTEFACTS_DIRECTORY=$TARGET_DATA_DIRECTORY/artefacts
TARGET_BUILD_SOURCE_DIRECTORY=$TARGET_ARTEFACTS_DIRECTORY/$BUILD_VERSION
TARGET_VERSION_DIRECTORY=$TARGET_DIRECTORY/versions/$BUILD_VERSION


echo ""
echo "$(getTimestamp) Creating version directory $TARGET_VERSION_DIRECTORY on $TARGET_SERVER"
createVersionDirectoryCommand="ssh $TARGET_SERVER mkdir -p $TARGET_VERSION_DIRECTORY"
echo "  $createVersionDirectoryCommand"
$createVersionDirectoryCommand

echo ""
echo "$(getTimestamp) Copy artefacts from $TARGET_ARTEFACTS_DIRECTORY to $TARGET_VERSION_DIRECTORY on $TARGET_SERVER"
copyCommand="ssh $TARGET_SERVER cp -r $TARGET_BUILD_SOURCE_DIRECTORY/* $TARGET_VERSION_DIRECTORY"
echo "  $copyCommand"
$copyCommand

echo ""
echo "$(getTimestamp) Extracting artefacts in $TARGET_VERSION_DIRECTORY on $TARGET_SERVER"
extractCommand="ssh $TARGET_SERVER cd $TARGET_VERSION_DIRECTORY && find . -name '*.tar.gz' -exec tar xzvf {} \;"
echo "  $extractCommand"
$extractCommand


echo ""
echo "$(getTimestamp) set permissions for $TARGET_VERSION_DIRECTORY on $TARGET_SERVER"
permissionCommand="ssh $TARGET_SERVER cd $TARGET_VERSION_DIRECTORY/$PROJECT_NAME && chown -R 1000:www-data ."
echo "  $permissionCommand"
$permissionCommand

echo ""
echo "$(getTimestamp) stop $PROJECT_NAME docker project on $TARGET_SERVER"
systemctlStopCommand="ssh $TARGET_SERVER systemctl stop $PROJECT_NAME"
echo "  $systemctlStopCommand"
$systemctlStopCommand

echo ""
echo "$(getTimestamp) link new version on $TARGET_SERVER"
createNewHtmlSymlink="ssh $TARGET_SERVER ln -sfT $TARGET_VERSION_DIRECTORY/$PROJECT_NAME /var/www/html"
echo "  $createNewHtmlSymlink"
$createNewHtmlSymlink

echo ""
echo "$(getTimestamp) start $PROJECT_NAME docker project on $TARGET_SERVER"
systemctlStartCommand="ssh $TARGET_SERVER systemctl start $PROJECT_NAME"
echo "  $systemctlStartCommand"
$systemctlStartCommand



sleep 30

         echo ""
         echo "$(getTimestamp) make storage symlink"
         makeStorageSymlink="ssh $TARGET_SERVER cd $TARGET_VERSION_DIRECTORY/$PROJECT_NAME && docker-compose exec -T php_fpm php artisan storage:link"
         echo "  $makeStorageSymlink"
         $makeStorageSymlink

echo ""
echo "$(getTimestamp) Remove artefacts from version directory $TARGET_VERSION_DIRECTORY on $TARGET_SERVER"
cleanupArtefactsCommand="ssh $TARGET_SERVER find $TARGET_VERSION_DIRECTORY -name '*.tar.gz' -delete"
echo "  $cleanupArtefactsCommand"
$cleanupArtefactsCommand

echo ""
echo "$(getTimestamp) Deployment of build \"$BUILD_VERSION\" is complete on $TARGET_SERVER 🎉"



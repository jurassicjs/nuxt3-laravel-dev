#!/bin/bash
#
# Upload artefacts to production

USAGE="Usage: upload-artefacts <BUILD_VERSION> <TARGET_SERVER>"

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

ARTEFACTS_SOURCE_DIRECTORY=data/build/artefacts
SOURCE_DIRECTORY=$ARTEFACTS_SOURCE_DIRECTORY/$BUILD_VERSION

if [[ ! -d "$SOURCE_DIRECTORY" ]]
then
    echo "$SOURCE_DIRECTORY was not found" 1>&2;
    exit 1
fi

TARGET_DIRECTORY=/var/www
TARGET_DATA_DIRECTORY=$TARGET_DIRECTORY/data
TARGET_ARTEFACTS_DIRECTORY=$TARGET_DATA_DIRECTORY/artefacts
TARGET_ARTEFACTS_VERSION_DIRECTORY=$TARGET_ARTEFACTS_DIRECTORY/$BUILD_VERSION

function getTimestamp() {
    echo "[`date '+%Y-%m-%d %H:%M:%S'`]"
}

echo ""
echo "`getTimestamp` Uploading the artefacts of build \"$BUILD_VERSION\" to $TARGET_SERVER"

echo ""
echo "`getTimestamp` Creating directory $TARGET_ARTEFACTS_VERSION_DIRECTORY on $TARGET_SERVER"
createArtefactDirectoryCommand="ssh $TARGET_SERVER mkdir -v -p $TARGET_ARTEFACTS_VERSION_DIRECTORY"
echo "  $createArtefactDirectoryCommand";
$createArtefactDirectoryCommand

echo ""
echo "`getTimestamp` Uploading artefacts from $SOURCE_DIRECTORY to $TARGET_ARTEFACTS_DIRECTORY on $TARGET_SERVER"
uploadCommand="scp -r $ARTEFACTS_SOURCE_DIRECTORY/$BUILD_VERSION $TARGET_SERVER:$TARGET_ARTEFACTS_DIRECTORY"
echo "  $uploadCommand"
$uploadCommand

echo ""
echo "`getTimestamp` Upload of $BUILD_VERSION is complete 🎉"
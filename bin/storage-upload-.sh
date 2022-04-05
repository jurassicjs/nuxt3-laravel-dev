#!/bin/bash
#
# Upload artefacts to production

TARGET_SERVER=$1
TARGET_DIRECTORY=/var/www/html/storage
STORAGE="storage/app"

echo $STORAGE


#echo ""
#echo "$(getTimestamp) Creating directory $TARGET_DIRECTORY on $TARGET_SERVER"
#createArtefactDirectoryCommand="ssh $TARGET_SERVER mkdir $TARGET_DATA_DIRECTORY"
#echo "  $createArtefactDirectoryCommand";
#$createArtefactDirectoryCommand

echo ""
echo "$(getTimestamp) Uploading dump from DATABASE_DUMP to $TARGET_DATA_DIRECTORY on $TARGET_SERVER"
uploadCommand="scp -r $(pwd)/$STORAGE $TARGET_SERVER:$TARGET_DIRECTORY"
echo "$uploadCommand"


if [ -d "$(pwd)/$STORAGE" ]
then
  echo ""
  echo "uploading dump"
  echo ""
  echo "$uploadCommand"
  echo ""

  $uploadCommand
else
  echo "**************************************************************************************************************************************************************************"
  echo "**************************************************************************************************************************************************************************"
  echo ""
  echo ""
  echo "****     $(pwd)/$STORAGE File does not exist"
  echo "****      please check sure you are in the project root directory and that the file exists"
  echo ""
  echo "**************************************************************************************************************************************************************************"
  echo "**************************************************************************************************************************************************************************"
  echo "**************************************************************************************************************************************************************************"
exit 1
fi

echo ""
echo "$(getTimestamp) Upload is complete 🎉"

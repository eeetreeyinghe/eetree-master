#!/bin/bash

#wikiPath="/opt/vhosts/www.eetree.io/release/doc/data/pages/"
#storageFile="/opt/vhosts/www.eelib.io/eetree/storage/app/cusconfig/wikikeys"
wikiPath="/Users/hypnos/Work/git/eetree/storage/app/public/"
storageFile="/Users/hypnos/Work/git/eetree/storage/app/cusconfig/wikikeys"

rm -f $storageFile

cd $wikiPath
for keyword in `ls`;
do
    echo $keyword >> $storageFile
done

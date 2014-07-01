#!/bin/bash
start=`date +%s`
echo "Getting images..."
num=1

cat imageUrls | while read LINE
do
    wget $LINE -O ~/Pictures/lofter/$num.jpg
    let "num+=1"
done

let "time=`date +%s`-start"
echo "Total time: $time s"

rm imageUrls 

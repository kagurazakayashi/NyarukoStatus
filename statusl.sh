#!/bin/sh
#NyarukoStatus/神楽坂雅诗
echo -e "`date +%Y.%m.%d_%H:%M:%S`|"$2"|\c" >> $1
curl -o data.tmp -s -w %{time_starttransfer} "$3" >> $1
data=`cat data.tmp`
rm -f data.tmp
if [ "$data" == "$4" ];then
echo "|OK" >> $1
else
echo "|NO" >> $1
# echo "$data"
# echo "$3"
fi
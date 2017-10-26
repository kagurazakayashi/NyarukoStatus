#!/bin/sh
#NyarukoStatus/神楽坂雅诗
logf=$1.info.log
errf=$1.error.log
echo -e "`date +%Y.%m.%d_%H:%M:%S`|"$2"|\c" >> $logf
curl -o data.tmp -s -w %{time_starttransfer} "$3" >> $logf
data=`cat data.tmp`
rm -f data.tmp
if [ "$data" == "$4" ];then
echo "|OK" >> $logf
else
echo "|NO" >> $logf
echo -e "`date +%Y.%m.%d_%H:%M:%S`|"$2"|\c" >> $errf
echo "$data" >> $errf
fi
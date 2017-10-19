#!/bin/sh
#NyarukoStatus/神楽坂雅诗
logfile="wstat`date +%Y%m%d%H%M%S`.log"
infofile="/mnt/www/yashisitestatus.txt"
#检查网络
sh statusl.sh "$logfile" "yoooooooooo|www.yoooooooooo.com" "http://www.yoooooooooo.com/checkpoint.php?yashiserverstatus" "{\"status\":0,\"msg\":\"OK\",\"server\":\"YashiBJ1\",\"host\":\"www.yoooooooooo.com\"}"
sh statusl.sh "$logfile" "yoooooooooossl|www.yoooooooooo.com (SSL)" "https://www.yoooooooooo.com/checkpoint.php?yashiserverstatus" "{\"status\":0,\"msg\":\"OK\",\"server\":\"YashiBJ1\",\"host\":\"www.yoooooooooo.com\"}"
#
sh statusl.sh "$logfile" "uuumoe|uuu.moe" "http://uuu.moe/checkpoint.php?yashiserverstatus" "{\"status\":0,\"msg\":\"OK\",\"server\":\"YashiHK1\",\"host\":\"uuu.moe\"}"
#
sh statusl.sh "$logfile" "yashimoe|yashi.moe" "http://yashi.moe/checkpoint.php?yashiserverstatus" "{\"status\":0,\"msg\":\"OK\",\"server\":\"YashiHK1\",\"host\":\"yashi.moe\"}"
#
find ./ -mtime +3 -name "wstat*.log" -exec rm -rf {} \;
echo -e "\c" > $infofile
for nowfile in ./wstat*.log
do
cat $nowfile >> $infofile
done
chown -R www:www $infofile
chmod -R 777 $infofile
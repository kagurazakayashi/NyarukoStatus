#!/bin/sh
#NyarukoStatus/神楽坂雅诗
cd "/mnt/www/yashisitestatus" #脚本所在的文件夹
infofile="/mnt/www/yashisitestatus.txt" #index.php 所在的文件夹
logfile="wstat`date +%Y%m%d%H%M%S`.log"
#检查网络，和PHP显示顺序相反 // sh statusl.sh "$logfile" "英文代码|显示名子" "访问网址" "预期得到的内容"
sh statusl.sh "$logfile" "yoooooooooo|www.yoooooooooo.com" "http://www.yoooooooooo.com/checkpoint.php?source=yashiserverstatus" "{\"status\":0,\"msg\":\"OK\",\"server\":\"YashiBJ1\",\"host\":\"www.yoooooooooo.com\",\"source\":\"yashiserverstatus\"}"
#
sh statusl.sh "$logfile" "yoooooooooossl|www.yoooooooooo.com (SSL)" "https://www.yoooooooooo.com/checkpoint.php?source=yashiserverstatus" "{\"status\":0,\"msg\":\"OK\",\"server\":\"YashiBJ1\",\"host\":\"www.yoooooooooo.com\",\"source\":\"yashiserverstatus\"}"
#
sh statusl.sh "$logfile" "uuumoe|uuu.moe" "http://uuu.moe/checkpoint.php?source=yashiserverstatus" "{\"status\":0,\"msg\":\"OK\",\"server\":\"YashiHK1\",\"host\":\"uuu.moe\",\"source\":\"yashiserverstatus\"}"
#
sh statusl.sh "$logfile" "yashimoe|yashi.moe" "http://yashi.moe/checkpoint.php?source=yashiserverstatus" "{\"status\":0,\"msg\":\"OK\",\"server\":\"YashiHK1\",\"host\":\"yashi.moe\",\"source\":\"yashiserverstatus\"}"
#日志整理 // +7:日志保留天数
find ./ -mtime +7 -name "wstat*.log" -exec rm -rf {} \;
echo -e "\c" > $infofile
for nowfile in ./wstat*.log
do
cat $nowfile >> $infofile
done
chown -R www:www $infofile
chmod -R 777 $infofile
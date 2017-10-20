#!/bin/sh
#NyarukoStatus/神楽坂雅诗
cd "/mnt/data/yashisitestatus" #脚本所在的文件夹
infofile="/mnt/www/yashisitestatus.txt" #index.php 所在的文件夹
#
echo > $infofile
rm -f wstat*.log
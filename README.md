# WebsiteStatusDisplay
一个Java做的简易可访问状况网页生成器，提供一个供用户访问的网站可访问状况的显示页，可以设置多个网站。

1. 修改 src/jiankong/startpgm.java 中的 String rundir = " "; 在里面填写txt配置文件和index.html所在文件夹。
2. 修改 src/jiankong/startpgm.java 中的 int sl= ，在里面填写多长时间扫描一次（整数,毫秒），请勿填写过短的时间。
3. 编译为.jar文件。
4. 修改 index.html ，可以改变标题文本，底部文本（建议保留“神楽坂雅詩”字样）以及自定义等等，若带有作者的备案号等请删除它。
5. 修改option.txt，[url]中为要监控的网址，[name]为网站名称，[info]为说明文本。必须保证三项中数据量同样多并且无空行。
6. 找一张你喜欢的背景图片，重命名为bg.jpg。
7. 将刚编译的jar文件、index.html、option.txt、bg.jpg 这四个文件复制到网站需要的目录中。
8. 使用 java -jar "<此jar文件路径>" 来启动它。没有显示错误信息的话，status.html 和 time.html 将被创建。
9. 现在可以输入网址在浏览器中访问了。可以将上一步的命令写到bat或sh里面开机运行。

循环代码已经注释掉。
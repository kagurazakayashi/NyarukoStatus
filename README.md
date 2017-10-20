# NyarukoStatus
- 和我的 Github 中其他各种 Nyaruko 开头的项目一样，该项目用于我的个人网站，自用不提供支持和兼容。
- 这个 sh 脚本可以让服务器自动监视几个页面，检测响应时间和返回信息，并在本地记录一段时间，以便检查问题。
- 附带的 php 脚本可以将服务器近期的运行情况可视化返回。

## 演示
- [https://www.yoooooooooo.com/yashi/?page_id=5408](https://www.yoooooooooo.com/yashi/?page_id=5408)
- [https://www.yoooooooooo.com/status](https://www.yoooooooooo.com/status)

## 与上一版本的区别
- 上一版本使用 Java 制作，本版本仅仅是个 sh 脚本，通过调用 curl 等常用命令完成，不用任何多余的东西，节约资源。
- 功能精简很多，修改设置由配置文件改为直接修改脚本即可。
- 上一版本已移动到“v1java”分支。

# 安装
- 运行 sh 需要确保有 find, cat, curl, crontab 命令，访问 PHP 需要网页服务器和 HTML5 浏览器。
- 将本脚本所有相关文件放在一个单独的、有执行权限的文件夹中。
- 编辑 `status.sh` ：
  - 将 `infofile` 路径设置在你的网页访问文件夹中，不要修改文件名。
  - 将 php 文件复制到这个文件夹中。
  - 在 #检查网络 行的下面，修改和增加你要监视的页面，每行一个：
    - `sh statusl.sh "$logfile" "英文代码|显示名子" "访问网址" "预期得到的内容"`
    - 例如： `sh statusl.sh "$logfile" "web1|我的网站" "http://yashi.moe/test.txt" "ok."`
    - 请删除原来脚本中 `sh statusl.sh` 开头的行。
- 运行 `crontab -e` ，将 `status.sh` 加入。
  - 脚本不会常驻后台，在 `crontab` 中设定计划任务，指定多久运行一次即可。
  - 下面的例子是每半个小时运行一次，请将后面的路径改为自己的：
  - `*/30 * * * * /bin/bash /mnt/d/yashisitestatus/status.sh`

# 使用
- 在工作一段时间后，可以打开 `yashisitestatus.txt` 文件查看日志。
- 挂在网页服务上，访问和它在一起的 php 文件，可以呈现运行状态图表。
  - PHP 可用参数 (GET方式提交，例如 `/index.php?zoom-h=100&zoom-w=10` )：
    - `inpage` ：不插入html开始结束标记，用于其他网页嵌入。
    - `zoom-h=500` ：图表单位柱形的高度容量，默认值 500，可以改为 10000 - 1 之间。
    - `zoom-w=10` ：图标单位柱形的宽度像素，默认值 10，可以改为 1 - 1024 之间。

# 协议
MIT.
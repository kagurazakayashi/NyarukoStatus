# NyarukoStatus
- 和我的 Github 中其他各种 Nyaruko 开头的项目一样，该项目用于我的个人网站，自用不提供支持和兼容。
- 这个 sh 脚本可以让服务器自动监视几个页面，检测响应时间和返回信息，并在本地记录一段时间，以便检查问题。
- 附带的 php 脚本可以将服务器近期的运行情况可视化返回。

## 演示 Demo
- [https://www.yoooooooooo.com/yashi/?page_id=5408](https://www.yoooooooooo.com/yashi/?page_id=5408)
- [https://www.yoooooooooo.com/status](https://www.yoooooooooo.com/status)
- 该程序在下面的环境中测试通过：
  - Linux 3.10.0-693.2.2.el7.x86_64 (CentOS 7), bash 4.2.46, Nginx 1.12.1

## 与上一版本的区别
- 上一版本使用 Java 制作，本版本仅仅是个 sh 脚本，通过调用 curl 等常用命令完成，不用任何多余的东西，节约资源。
- 功能精简很多，修改设置由配置文件改为直接修改脚本即可。
- 上一版本已移动到“v1java”分支。

# 安装 Install
- 安装前要求：
  - 确保有 find, cat, curl 命令。
  - crontab 服务正常运行。
  - 如需使用PHP图标页，要有网页服务。
  - 如需使用PHP图标页，要有 HTML5 浏览器。
- 将本脚本所有相关文件放在一个单独的、有执行权限的文件夹中。
- 编辑 `clearlog.sh` ,以后运行它可以清空日志：
  - 将第一条 `cd` 命令后面的地址改为 `status.sh` 所在的文件夹。
  - 将 `infofile` 路径设置在你的网页访问文件夹中，不要修改文件名。
- 将 `index.php` 文件复制到 `infofile` 同一个文件夹中。
- 编辑 `status.sh` ,以后定时运行它可以生成新日志：
  - 将第一条 `cd` 命令后面的地址改为 `status.sh` 所在的文件夹。
  - 将 `infofile` 路径设置在你的网页访问文件夹中，不要修改文件名。
  - 在 #检查网络 行的下面，修改和增加你要监视的页面，每行一个：
    - `sh statusl.sh "$logfile" "英文代码|显示名子" "访问网址" "预期得到的内容"`
    - 例如： `sh statusl.sh "$logfile" "web1|我的网站" "http://yashi.moe/test.txt" "ok."`
    - 请删除原来脚本中 `sh statusl.sh` 开头的行。
    - 此处写的测试顺序应与 `index.php` 访问时想要呈现的图标顺序相反。
- 准备好要各测试目标的返回值，确保可以 GET 请求网页。这里有两个演示：
  - `checkpoint.php`
    - 拷贝到要测试目标的网页服务器中，访问时提供source。
    - 设置里面的返回信息。
  - `checkpointsql.php`
    - 拷贝到要测试目标的网页服务器中，访问时提供source。
    - 设置里面的返回信息。
    - 设置里面的数据库信息。
- 运行 `status.sh` ，访问 `yashisitestatus.txt` 或 `index.php` 查看输出，检查是否有问题。
- 运行 `crontab -e` ，将 `status.sh` 加入。
  - 脚本不会常驻后台，在 `crontab` 中设定计划任务，指定多久运行一次即可。
  - 下面的例子是每半个小时运行一次，请将后面的路径改为自己的：
  - `*/30 * * * * /bin/bash /mnt/d/yashisitestatus/status.sh`
- 运行 `sh clearlog.sh` 进行一下初始清空。

# 使用 Use
- 在工作一段时间后，可以打开 `yashisitestatus.txt` 文件查看日志。
- 挂在网页服务上，访问和它在一起的 php 文件，可以呈现运行状态图表。
  - PHP 可用参数 (GET方式提交，例如 `/index.php?h=100&w=10` )：
    - `inpage` ：不插入html开始结束标记，用于其他网页嵌入。
    - `h=500` ：图表单位柱形的高度容量，默认值 500，可以改为 10000 - 1 之间。
    - `w=10` ：图标单位柱形的宽度像素，默认值 10，可以改为 1 - 1024 之间。
- 查看每次的检查结果信息，以及错误详细信息：
  - 在工作一段时间后，打开 sh 脚本所在文件夹：
  - `.log` 文件是每次检查记录，它会定期进行删除，默认是7天后删除（可以在 `status.sh` 中 `find` 行修改）。
    - `.info.log` 文件是每次检查的结果记录，只保存常规信息和结果，没有记录返回数据，用于生成 `yashisitestatus.txt` 文件。
    - `.error.log` 文件是每次检查的错误记录，文件中最后的字段为当时返回的预期外结果数据，如果本次检查没有发生错误，则不生成此文件。错误记录不会在 PHP 前台显示。

# 协议 License
MIT.
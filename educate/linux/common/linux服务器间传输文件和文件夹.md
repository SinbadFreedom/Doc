在工作过程中经常会遇到部署多台服务器环境的情况。这个时候我们需要将一个linux服务器中的文件传输到另一台服务器上。如果文件太大或者本地网速较慢时会浪费很多时间。解决方案：可以通过scp命令，在linux服务间传输文件。

1 通过ssh连接文件源服务器
===

推荐采用Xshell，一个很方便的SSH工具。功能很强大，界面也比较美观。

2 通过pwd查看需要传输文件的路径
==

可以通过cd命令进入需要传输的文件目录，然后通过pwd命令查看当前目录的完整路径。

3 通过scp命令传输文件或者文件夹
===

3.1 scp命令格式传输文件夹(包括文件夹本身)
---

scp命令格式:

```
scp -r LOCAL_FOLDER NAME@IP:TARGET_FOLDER
```

参数说明:

- LOCAL_FOLDER 本机文件目录
- NAME 登陆目标服务器的用户名
- TARGET_FOLDER 目标服务器的目录名
- `-r` 表示传输目录

示例:

```
scp -r /home/dashidan.com/1.png root@1.2.3.4:/home/test
```

3.2 传输文件夹下所有文件(不包括文件夹本身)
---

命令格式:

```
scp LOCAL_FOLDER NAME@IP:TARGET_FOLDER
```

比传输目录少了-r. 

示例:

```
scp /home/dashidan.com/* root@1.2.3.4:/home/test
```

3.3 传输文件并重命名
---

命令格式:

```
scp LOCAL_FOLDER NAME@IP/FILE_NAME:TARGET_FOLDER/NEW_FILE_NAME
```

- LOCAL_FOLDER 本机文件目录
- NAME 登陆目标服务器的用户名
- FILE_NAME 本机文件名
- TARGET_FOLDER 目标服务器的目录名
- NEW_FILE_NAME 修改后的文件名

示例:

```
scp /home/dashidan.com/1.txt root@1.2.3.4:/home/test/2.txt
```

4 确认开始传输
===

输入scp命令，按回车后，会提示"Are you sure you want to continue connecting (yes/no)? ".

输入yes开始传输。

5 输入目标服务器密码
===

接上一步，会提示输入目标服务器密码。

6 传输完成
===

控制台会输出传输状态。传输完成会返回命令行。
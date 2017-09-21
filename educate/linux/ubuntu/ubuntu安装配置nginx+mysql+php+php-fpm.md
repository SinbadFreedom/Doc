ubuntu安装配置nginx+mysql+php+php-fpm
===

1 安装nginx, php, mysql, php-fpm服务
---

输入以下命令:

    apt-get update
    apt-get install nginx
    apt-get install php5-cli php5-cgi mysql-server php5-mysql
    apt-get install php5-fpm

2 创建web目录
---

输入以下命令:

	mkdir -p /workplace/plateform/web

3 修改nginx root路径
---

输入以下命令:

	vim /etc/nginx/sites-enabled/default
	
`index` 字段后边加入`index.php`, 开启默认支持查找`index.php`入口.

4 nginx开启php解析功能
---

打开注释掉php解析的部分.   
查找`php-fpm.sock`文件的路径:

	find / -name php5-fpm.sock

不同版本的linux操作系统和php的版本不一样, 有的有该文件, 有的没有.   
如果有`php5-fpm.sock`文件, 将这个路径设置到php-fpm区域.   

如果没有`php5-fpm.sock`文件, 采用`php-cgi`的9000端口配置.	

5 重启nginx,php-fpm
---

	service nginx restart
	service php5-fpm restart

6 测试nginx, php-fpm是否配置成功
---

通过`phpinfo()`查看php是否配置成功.
将以下代码复制, 保存为`index.php`, 放入web根目录.
使用浏览器打开ip地址, 查看是否有php配置信息, 有的话说明成功.

```php
<?php
	phpinfo();
?>
```

注:
`phpinfo()`显示了php支持的所有木块, 如果其中有`Mysql`标签信息, 说明`php-mysql`扩展安装成功, 如果没有, 需要重新安装`php-mysql`模块.

7 测试php, mysql连接
---
注:
这里的用户名和密码改为安装`mysql`时自己设定的密码.

```php
<?php
	$link=mysql_connect("localhost","root","123");
	if(!$link) echo "FAILD!连接错误, 请检查php用户名密码不对";
	else echo "OK!可以连接";
?>
```
ubuntu nginx+mysql+php+php-fpm配置成功.

7 相关文章
---

[ubuntu安装配置nginx+mysql+php+php-fpm](http://localhost/article/linux/ubuntu/ubuntu安装配置nginx+mysql+php+php-fpm.html)    
[ubuntu安装配置mongodb及常用命令](http://localhost/article/linux/ubuntu/ubuntu安装配置mongodb及常用命令.html)   
[ubuntu安装配置redis及常用命令](http://localhost/article/linux/ubuntu/ubuntu安装配置redis及常用命令.html)    
[ubuntu安装配置svn及常用命令](http://localhost/article/linux/ubuntu/ubuntu安装配置svn及常用命令.html)    
[ubuntu安装配置redis及常用命令](http://localhost/article/linux/ubuntu/ubuntu安装配置tmux及常用命令.html)    
[ubuntu安装配置zookeeper及常用命令](http://localhost/article/linux/ubuntu/ubuntu安装配置redis及常用命令.html)    
[ubuntu安装配置apollo及常用命令](http://localhost/article/linux/ubuntu/ubuntu安装配置apollo及常用命令.html)   

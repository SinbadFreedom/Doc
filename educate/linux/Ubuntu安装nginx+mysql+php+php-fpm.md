Ubuntu安装NGINX+MYSQL+PHP+PHP-FPM+REDIS+SVN
----

#### 执行脚本步骤:

    apt-get update
    apt-get install nginx
    apt-get install php5-cli php5-cgi mysql-server php5-mysql
    apt-get install php5-fpm
	apt-get install redis-server
	apt-get install php5-redis
	

###### WEB:
	mkdir -p /workplace/plateform/web

#### 配置NGINX

	vim /etc/nginx/sites-enabled/default
	修改root路径
	index 加入inde.php
	开启注释掉php解析的部分
	find / -name php5-fpm.sock
	有php5-fpm的时候，采用这个配置，没有的时候采用php-cgi的9000端口配置.
	重启nginx,php
	service nginx restart
	service php5-fpm restart


#### 测试：
	
	通过phpinfo查看，php, mysql, redis的配置是否成功.
	PHP连接MYSQL测试:
	<?php 
	$link=mysql_connect("localhost","root","123"); 
	if(!$link) echo "FAILD!连接错误，用户名密码不对"; 
	else echo "OK!可以连接"; 
	?> 

   
SVN安装配置
----

#### 执行脚本步骤:
	apt-get install subversion
#### 创建SVN仓储
	mkdir -p /svn/plateform
	svnadmin create /svn/plateform
	修改svn 下的conf/svnserve.conf文件
	去掉#[general]前面的#号
	[general]
	#匿名访问的权限，可以是read,write,none,默认为read
	anon-access = none
	#认证用户的权限，可以是read,write,none,默认为write
	auth-access = write
	#密码数据库的路径，去掉前面的#
	password-db = passwd
	修改配置文件passwd
	[users]
	name = password
	启动svn服务
	svnserve -d -r /svn/plateform
	



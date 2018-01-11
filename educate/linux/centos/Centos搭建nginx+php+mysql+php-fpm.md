1 Centos安装nginx
===

```
yum install nginx
```

2 Centos安装mysql
===

```
yum install mysql mysql-server
```

3 Centos安装php
===

```
yum install php php-devel
yum install php-fpm
```


4 Centos安装php-msyql的扩展
===

```
yum install php-mysql
```

5 配置nginx支持php
===

修改`etc/nginx.conf`文件,去掉php相关的注释.
```
location ~ \.php$ {
	root           html;
	fastcgi_pass   127.0.0.1:9000;
	fastcgi_index  index.php;
	fastcgi_param  SCRIPT_FILENAME  /scripts$fastcgi_script_name;
	include        fastcgi_params;
}
```

6 测试
===

6.1 测试php是否安装成功
---
新建info.php文件, 将以下代码粘贴到文件中.将改文件放在web目录中用浏览器打开.能正常显示php信息说明安装成功.
```
<?php phpinfo(); ?>
```

6.2 测试mysql是否安装成功
---

```
<?php
$con = mysql_connect("10.0.@.@@","@@","@@");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
 
mysql_select_db("mydb", $con);
 
$result = mysql_query("SELECT * FROM sys_user");
 
while($row = mysql_fetch_array($result))
  {
  echo $row['UserName'] . " " . $row['PassWord'] . " " . $row['id'];
  echo "<br />";
  }
 
mysql_close($con);
?>
```
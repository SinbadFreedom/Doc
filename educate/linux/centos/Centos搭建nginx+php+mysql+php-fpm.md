1 Centos��װnginx
===

```
yum install nginx
```

2 Centos��װmysql
===

```
yum install mysql mysql-server
```

3 Centos��װphp
===

```
yum install php php-devel
yum install php-fpm
```


4 Centos��װphp-msyql����չ
===

```
yum install php-mysql
```

5 ����nginx֧��php
===

�޸�`etc/nginx.conf`�ļ�,ȥ��php��ص�ע��.
```
location ~ \.php$ {
	root           html;
	fastcgi_pass   127.0.0.1:9000;
	fastcgi_index  index.php;
	fastcgi_param  SCRIPT_FILENAME  /scripts$fastcgi_script_name;
	include        fastcgi_params;
}
```

6 ����
===

6.1 ����php�Ƿ�װ�ɹ�
---
�½�info.php�ļ�, �����´���ճ�����ļ���.�����ļ�����webĿ¼�����������.��������ʾphp��Ϣ˵����װ�ɹ�.
```
<?php phpinfo(); ?>
```

6.2 ����mysql�Ƿ�װ�ɹ�
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
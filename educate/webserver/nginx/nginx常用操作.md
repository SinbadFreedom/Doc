windows系统nginx常用操作

##启动：

	d:\dashidan.com\nginx-1.0.2>start nginx
	
或
	d:\dashidan.com\nginx-1.0.2>nginx.exe
	
	
注:
	d:\dashidan.com 换成自己的nginx安装路径
	
注：
	建议使用第一种，第二种会使你的cmd窗口一直处于执行中，不能进行其他命令操作。

##停止：

	d:\dashidan.com\nginx-1.0.2>nginx.exe -s stop
	
或

	d:\dashidan.com\nginx-1.0.2>nginx.exe -s quit
	
注：
stop是快速停止nginx，可能并不保存相关信息；quit是完整有序的停止nginx，并保存相关信息。

##重新载入Nginx：

	d:\dashidan.com\nginx-1.0.2>nginx.exe -s reload
	
当配置信息修改，需要重新载入这些配置时使用此命令。
##重新打开日志文件：

	d:\dashidan.com\nginx-1.0.2>nginx.exe -s reopen
	
##查看Nginx版本：

	d:\dashidan.com\nginx-1.0.2>nginx -v


	
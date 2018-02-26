ngin配置二级域名非常简单只需要增加一个server区域,修改server_name和域名根目录.

1 二级域名的应用场景
===

在做网站开发的时候,当网页超过一定数量我们可以同二级域名来更好的管理网站文件目录.或者通过二级域名来区分不同的网站功能.比如img.dashidan.com来存放网站的全部图片.这样在后续的CDN加速会很好处理.或者针对手机用户增加二级域名m.dashidan.com.等.

二级域名的数量建议尽量不要超过20个.因为二级域名的生效需要修改dns配置.而这个是需要花费时间的,这个代价比增加网站子目录要大.

2 dns配置二级域名解析
===

二级域名需要在提供域名解析服务商网站上修改.比如如果是在万网注释的域名,可以登陆阿里云控制台找到域名项.来修改二级域名.

参考[dns解析记录类型](http://dashidan.com/article/webserver/dns/1.html)


3 nginx配置一级域名示例
===
以大屎蛋教程 http://dashidan.com为例.
```
server {
	listen       80;
	server_name  dashidan.com;
	
	location / {
		root D:/workplace/dashidan.com;
		index  index.html index.htm index.php;
	}

	error_page   500 502 503 504  /50x.html;
	location = /50x.html {
		root   html;
	}
}
```

3 nginx配置二级域名示例
===

- erver_name 为新增的二级域名.
- root 为二级域名对应的文件目录.

```
server {
	listen       80;
	server_name  best.dashidan.com;

	location / {
		root D:/workplace/best.dashidan.com;
		index  index.html index.htm index.php;
	}
}
```
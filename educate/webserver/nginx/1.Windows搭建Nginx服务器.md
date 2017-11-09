nginx是俄罗斯访问量第二的网站(Rambler.ru),解决高并发问题,开发的.现在已经开源.
非常棒.
nginx主要是面向Linux系统开发的,也哟windows版.建议生产服务器采用Linux,开发调试可以在windows中.

##下载nginx的windwos最新版
[nginx下载链接](http://nginx.org/download/nginx-1.13.5.zip)

##解压
解压后双击`nginx.exe`即可运行.

##测试
打开浏览器输入
	http://localhost

显示
	Welcome to nginx!

说明运行成功

##修改网站根目录
默认配置是nginx文件中的`html`目录,这样开发起来不方便.
修改默认目录为开放代码目录,这样调试方便.
修改文件:
`nginx`目录中的`conf`目录->`nginx.conf`

	location / {
		root   html;
		index  index.html index.htm;
	}

改为:

	location / {
		root   D:/dashidan.com;
		index  index.html index.htm;
	}
	
注:
	root 后边的路径改为自己的本地路径
	文件目录的盘符采用反斜杠`/`,这个反斜杠linux和windows通用,`\`是windows的盘符,linux不支持.养成好习惯.

##重启nginx
打开任务管理器,找到`nginx`进程,`结束进程`
然后再双击`nginx.exe`,启动nginx服务.

##测试
自己设定的目录中如果没有`index.html`文件,需要新建一个测试用.   
新建index.html,并粘贴贴以下代码.
```html
<html>
<body>
dashidan.com测试文本.
</body>
</html>
```

输入
	http://localhost
显示
	dashidan.com测试文本.

成功.
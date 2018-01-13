<div class="jumbotron">
<p>如果希望域名后边跟随的路径指向本地磁盘的其他目录,而不是默认的web目录时,需要设置nginx目录访问重定向.
应用场景:`dashidan.com/image`自动跳转到`dashidan.com/folderName/image`.</p>  
</div>

1 修改root映射
===
这种最简单, 推荐采用这一种.

```
location  /image {
	root   /folderName;
}
```

2 通过Nginx rewrite内部跳转实现
===

```
location /image {
	rewrite ^/image/(.*)$     /folderName/image/$1 last;
}
```

3 设置别名alias映射
===

```
location  /image  {
	alias  /folderName/image;  #这里写绝对路径
}
```

4 通过nginx的permanent 301绝对跳转实现
===

```
location /image {
	rewrite ^/image/(.*)$   http://dashidan.com/folderName/image/$1;
}
```

5 通过判断uri实现
===

```
if ( $request_uri ~* ^(/image)){
	rewrite ^/image/(.*)$ /folderName/image/$1 last; 
}
```
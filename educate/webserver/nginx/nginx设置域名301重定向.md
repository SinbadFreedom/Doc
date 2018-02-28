301重定向将一个URL地址按照一定规则永久重定向为另一个URL. 比如访问apetools.cn,自动跳到dashidan.com.也可以用在已经删除的或者修改地址的链接指向另一个页面.来避免出现404错误.

1 Nginx配置301重定向
===

打开nginx.conf文件,找到server字段对应的区块.加入301重定向代码:

```
server {
    listen    80;
    server_name apetools.cn dashidan.com;
    if ($host != 'dashidan.com' ) { 
        rewrite ^/(.*)$ http://dashidan.com/$1 permanent;
    }
}
```

其中一下这一行代码是301重定向的网址.其中: $1表示url后边的参数, permanent表示永久重定向.
```
rewrite ^/(.*)$ http://dashidan.com/$1 permanent;
```
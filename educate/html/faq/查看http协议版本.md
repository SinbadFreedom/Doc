使用chrome浏览器自带的开发者工具查看http头的方法
1.在网页任意地方右击选择审查元素或者按下 shift+ctrl+c, 打开chrome自带的调试工具;
2.选择network标签, 刷新网页(在打开调试工具的情况下刷新);
3.刷新后在左边找到该网页url,点击 后右边选择headers,就可以看到当前网页的http头了;

请求Header(HTTP request header )
Host 请求的域名
User-Agent 浏览器端浏览器型号和版本
Accept 可接受的内容类型
Accept-Language 语言
Accept-Encoding 可接受的压缩类型 gzip,deflate
Accept-Charset 可接受的内容编码 UTF-8,*

服务器端的响应Header(response header)
Date 服务器端时间
Server 服务器端的服务器软件 Apache/2.2.6
Etag 文件标识符
Content-Encoding传送启用了GZIP压缩 gzip
Content-Length 内容长度
Content-Type 内容类型


查看网页头信息

修复自己网站中的工具.
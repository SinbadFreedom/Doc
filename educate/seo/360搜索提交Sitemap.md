1 sitemap.xml文件格式
===

```
<?xml version="1.0" encoding="utf-8"?>
<!-- XML文件需以utf-8编码-->
<urlset>
  <!--必填-->
   <url>
	   <!--必填,定义某一个链接的入口,每一条数据必须要用<url>和</url>来标示 -->
	   <loc>http://www.xxxxxx.html/000000.html</loc>
	   <!--必填,URL长度限制在256字节内-->
	   <lastmod>2012-12-01</lastmod>
	   <!--更新时间标签,非必填,用来表示最后更新时间-->
	   <changefreq>daily</changefreq>
	   <!--更新频率标签,非必填,用来告知引擎页面的更新频率 -->
	   <priority>0.8</priority>
	   <!--优先权标签,优先权值0.0-1.0,用来告知引擎该条url的优先级-->
   </url>
   <url>
	   <loc>http://www.xxxxxx.html/000001.html</loc>
	   <lastmod>2012-12-01</lastmod>
	   <changefreq>daily</changefreq>
	   <priority>0.8</priority>
   </url>
</urlset>
```

2 360搜索Sitemap文件索引
===

文件编码可以是UTF-8或GBK.请控制单个Sitemap文件大小不超过10MB,且包含不超过50000个网址.如果网站所包含的网址超过50,000个,则可将列表分割成多个Sitemap文件.

索引Sitemap举例:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex>
 <sitemap>
   <loc>http://www.example.com/1.xml</loc>
   <lastmod>2012-12-01</lastmod>
 </sitemap>
 <sitemap>
   <loc>http://www.example.com/2.xml</loc>
   <lastmod>2012-12-01</lastmod>
 </sitemap>
</sitemapindex>
```

3 提交入口
===

[360搜索Sitemap提交入口](http://zhanzhang.so.com/?m=Sitemap)
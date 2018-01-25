1 什么是Sitemap
===

Sitemaps是站长告诉搜索引擎关于他们的网站可被抓取页面的一个简单的方法.网站地图是一个XML文件,列出随着每个URL的附加元数据的网站网址（网页url,上次更新时间,变化频率,重要程度）使搜索引擎能够更智能地抓取网站.

网络爬虫通常通过网站页面中的链接发现其他其他页面.Sitemaps补充这个数据让爬虫支持Sitemaps拿起所有的URL的网站,了解这些网址的使用相关的元数据.使用Sitemap协议并不能保证网页被搜索引擎收录,但为网络爬虫爬行你的网站提供了更好的指示.

网站提供的0.90冰的术语“属性-创意共用许可和授权协议已经广泛采用,包括支持从Google,Yahoo！和微软等主流搜索引擎.




2 Sitemaps XML 格式
===
Sitemap协议是XML格式.文件必须是UTF-8编码.
Sitemap必须包含:
- 由<urlset>标签开头,并且由</urlset>标签关闭.
- 在<urlset>标签中指定命名空间（协议标准）.
- <URL>标签, 作为每个URL的父标签.
- 每个<URL>父标签中包含 <loc> 子标签.

其他标记都是可选的.对这些可选标记的支持可能因搜索引擎而异.详情请参考每个搜索引擎的文档.

同时,在一个网站地图中的所有URL必须在单一主机中,如img.dashidan.com或www.dashidan.com.详情参考站点地图文件的位置.


3 Sitemap文件示例
===

3.1 基本示例
---


下面的示例显示了一个网站,只包含一个网址和使用所有可选的标签.

```xml
<?xml version="1.0" encoding="UTF-8"?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
   <url>
      <loc>http://dashidan.com/</loc>
      <lastmod>2018-01-18</lastmod>
      <changefreq>daily</changefreq>
      <priority>0.8</priority>
   </url>   
</urlset>
```

3.2 多网址Sitemap文件示例
---
```
<?xml version="1.0" encoding="utf-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9>
    <url>
        <loc>http://dashidan.com/article/java/index.html</loc>
        <lastmod>2018-01-18</lastmod>
        <changefreq>daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>http://dashidan.com/article/java/basic/2.html</loc>
        <lastmod>2018-01-18</lastmod>
        <changefreq>daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>http://dashidan.com/article/java/basic/3.html</loc>
        <lastmod>2018-01-18</lastmod>
        <changefreq>daily</changefreq>
        <priority>1</priority>
    </url>
</urlset>

```

3.3 Sitemap索引文件
---
你可以提供多个站点地图文件,但是每个站点地图文件,你提供的必须有不超过50000的URL,必须不超过50MB（52428800字节）.如果你愿意,你可以把你的站点文件使用gzip压缩来减少你的带宽需求;如果你想列出超过50000的URL,必须创建多个站点地图文件.

如果有多个站点地图,你应该在站点地图索引文件中一一列出.你可以有多个站点地图索引文件.压缩后需要小于50M.

站点地图索引文件的XML格式的站点地图文件的XML格式非常相似.

站点地图索引文件必须包含:
- 由<sitemapindex>标签开头,并且由</sitemapindex>标签关闭.
- <sitemap>标签, 作为每个Sitmap的父标签.
- 每个<sitemap>父标签中包含<loc>子标签.

可选标签<lastmod>同样适用于Sitemap索引文件.

注：站点地图索引文件只能指定同一个网站的网站地图文件.

例如：
http://dashidan.com/sitemap_index.xml能够包含http://dashidan.com网站中的sitemap文件,但不能包含http://www.dashidan.com 或者 http://yourhost.dashidan.com. 站点地图索引文件必须是UTF-8格式的.

3.4 Sitemap索引文件示例
---

```
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex>
    <sitemap>
        <loc>http://dashidan.com/sitemap/java.xml</loc>
        <lastmod>2018-01-18</lastmod>
    </sitemap>
    <sitemap>
        <loc>http://dashidan.com/sitemap/mongodb.xml</loc>
        <lastmod>2018-01-18</lastmod>
    </sitemap>
</sitemapindex>
```

4 Sitemap中XML标签定义
===

<table class="table table-bordered table-responsive text-center">
	<thead>
		<tr class="info">
			<td>标签</td>
			<td>是否必须</td>
			<td>备注</td>
		</tr>
	</thead>
	<tbody>
	<tr>
		<td><urlset></td>
		<td>是</td>
		<td>文件最外层标签,并注明当前协议标准.</td>
	</tr>
	<tr>
		<td><url></td>
		<td>是</td>
		<td>每个URL项的父标记.其余标记是此标记的子元素.</td>
	</tr>
	<tr>
		<td><url></td>
		<td>是</td>		<td>页面的URL.此URL必须以协议（如HTTP）开始,如果您的Web服务器需要它,则以一个斜杠结尾.此值必须小于2048个字符.</td>
	</tr>
	<tr>
		<td><lastmod></td>
		<td>否</td>
		<td>最后修改日期的文件.这个日期必须是W3C的DateTime格式.这种格式允许省略时间部分,例如: YYYY-MM-DD.		注意,这个标签是独立于`If-Modified-Since(304)`-从服务器返回的header信息,搜索引擎可以从不同的来源使用不同的信息.</td>		
	</tr>
	<tr>
		<td><changefreq></td>
		<td>否</td>		<td>页面有多频繁会发生变化.这个值提供给搜索引擎的一般信息,可能与他们爬行页面的频率不完全相关.有效值是：always, hourly, daily, weekly, monthly, yearly, never.
		always用来表示每次访问改变的文件,never用来表示归档的文件.
		请注意,此标记的值被视为提示而不是命令.尽管搜索引擎爬虫可以考虑这些信息做决定时,他们可以抓取标明“hour”少于标注“yearly”的页面.爬虫会定期抓取页面标记为“never”的网页来应对突然变化.
		</td>
	</tr>
	<tr>
		<td><priority></td>
		<td>否</td>		<td>此URL相对于站点上其他URL的优先级.有效值范围从0到1.此值不影响您的页面相比其他网站只有让搜索引擎知道哪个网页页面的抓取你认为最重要的.</td>
		页面的默认优先级为0.5.
		请注意,您分配给页面的优先级不太可能影响URL在搜索引擎结果页面中的位置.搜索引擎在同一站点的URL之间选择时可以使用此信息,因此您可以使用此标记来增加搜索索引中最重要页面的可能性.
		另外,请注意,给网站上的所有URL分配一个高优先级不太可能对您有帮助.因为优先级是相对的,所以它只用于在站点上的URL之间进行选择.
	</tr>
	</tbody>
</table>


5 实体转义
===
你的站点地图文件必须使用UTF-8编码（通常可以这样做,当你保存文件）.与所有XML文件一样,任何数据值（包括URL）都必须使用下面表中列出的字符的实体转义代码.

<table class="table table-bordered table-responsive text-center">
	<thead>
		<tr class="info">
			<td>符号</td>
			<td>转义</td>
		</tr>
	</thead>
	<tbody>
	<tr>
		<td>&</td>
		<td>&amp;</td>
	</tr>
	<tr>
		<td>'</td>
		<td>&apos;</td>
	</tr>
	<tr>
		<td>"</td>
		<td>&quot;</td>
	</tr>
	<tr>
		<td>></td>
		<td>&gt;</td>
	</tr>
	<tr>
		<td><</td>
		<td>&lt;</td>
	</tr>
	</tbody>
</table>

所有的URL（包括您的网站的URL）必须是它们所在Web服务器进行URL编码.如果使用脚本、工具或日志文件来生成URL（除了手工输入URL之外）,通常已经为您完成了这个转码.请检查以确保您的网址按照URI的rfc-3986标准,IRIs的rfc-3987标准和XML标准.

下面是一个网址,使用非ASCII字符的一个例子（ü）,以及一个字符需要实体转义（&）：

```
http://www.dashidan.com/ümlat.php&q=name
```

下面是相同的URL,ISO-8859-1编码和URL转义：
```
http://www.dashidan.com/%FCmlat.php&q=name
```

下面是相同的URL,使用UTF-8编码和URL转义：
```
http://www.dashidan.com/%C3%BCmlat.php&q=name
```

下面是相同的URL,采用实体转义：
```
http://www.dashidan.com/%C3%BCmlat.php&amp;q=name
```

6 其他格式的Sitemap
===

鼓励使用Sitemap协议,对搜索引擎来说xml格式的sitemap文件可以提供关于页面更多的细节,不仅仅是网站页面的URL.

除了XML协议之外,我们还支持RSS提要和text文件,这些文件提供了更有限的信息.
这里不再复述,可以访问官网网站查看详细信息.

这里举一个简单的文本格式的示例:
```
http://dashidan.com/article/java/index.html
http://dashidan.com/article/git/index.html
```

7 Sitemap位置
===

一个站点地图文件的位置决定了可以包含的URL的位置.
例如: 站点地图文件位于http://dashidan.com/article/java/sitemap.xml可以包括http://dashidan.com/article/java/对应的URL, 但不包括http://dashidan.com/article/git/中对应的URL.

例：
- http://dashidan.com/article/java/sitemap.xml中有效的链接

```
http://dashidan.com/article/java/basic/3.html
http://dashidan.com/article/java/faq/1.html
```

- http://dashidan.com/article/java/sitemap.xml中无效的链接

```
http://dashidan.com/article/html/faq/1.html 
http://dashidan.com/article/git/faq/1.html
```

注意,这意味着在站点地图中列出的所有URL必须使用相同的协议（在这个例子中HTTP）和驻留在同一台主机上的网站.例如,如果站点是位于http://dashidan.com/sitemap.xml,它不能包括http://subdomain.dashidan.com的网址.

强烈建议将你的网站在Web服务器的根目录.
例如,如果Web服务器在dashidan.com,那么站点地图索引文件放在http://dashidan.com/sitemap.xml.
在某些情况下,您可能需要设置不同的路径不同的网站（例如,不同的目录访问权限不同）.

如果你提交网站地图使用路径与端口号,必须包括端口号作为路径的一部分,列出的每个URL的站点地图文件.
例如,如果你的站点是位于http://dashidan.com:100/sitemap.xml,然后在站点地图中列出的每个URL必须是http://dashidan.com:100/.

8 通知搜索引擎爬虫
===
一旦你创建站点地图文件放在你的服务器,你需要告诉搜索引擎,这个文件的位置.你可以这样做：

- 通过搜索引擎的提交界面提交你的网站
- 在你的robots.txt文件中指定的站点位置,也可以同时指定多个
```
Sitemap: http://dashidan.com/sitemap-host1.xml
Sitemap: http://dashidan.com/sitemap-host2.xml
```
- 通过Http请求提交
使用一个HTTP请求提交你的网站,发到以下网址：

通过搜索引擎提供的URL替换<searchengine_url>
```
<searchengine_URL>/ping?sitemap=sitemap_url
```

例如,如果你的站点地图是位于http://dashidan.com/sitemap.xml,URL为：
```
bing.com/ping?sitemap=http://dashidan.com/sitemap.xml
```

`/ping?sitemap=:`后边的需要进行URL转码

```
<searchengine_URL>/ping?sitemap=http%3A%2F%2Fwww.yoursite.com%2Fsitemap.gz

```

你可以发布使用wget,curl, 或者自定义方式发送HTTP请求.
一个成功的请求会返回一个HTTP 200响应代码;如果你收到不同的反应,你应该重新提交你的请求.
HTTP 200响应代码只显示搜索引擎已经收到了你的网站,不代表网站地图中的URL是有效的.
一个简单的办法是建立一个自动任务定期生成和提交的Sitemaps.

如果你提供一个网站地图索引文件,只需要发出一个HTTP请求,包括站点地图索引文件的位置;不需要再分别提交每个站点地图数据.

9 排除内容
===
Sitemaps协议使您能够让搜索引擎知道你希望什么的内容被索引.告诉搜索引擎你不想要的内容索引,使用robots.txt文件或robots meta标签.访问robotstxt.org查看更多关于如何从搜索引擎排除内容.

10 参考文章
===
https://www.sitemaps.org/protocol.html

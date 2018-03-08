百度mip官网
https://www.mipengine.org/

https://www.mipengine.org/doc/00-mip-101.html

百度mip页面代码检查:
https://www.mipengine.org/validator/validate?url=http%3A%2F%2Fmip.dashidan.com

mip效果预览工具与url地址在线检测
https://www.mipengine.org/validator/preview


mip页面布局
https://www.mipengine.org/doc/3-widget/11-widget-layout.html


mip官方博客
http://www.cnblogs.com/mipengine/

MIP 问题解决方案大全（2017-11更新）
http://www.cnblogs.com/mipengine/p/mip-faqs.html


4.2 MIP 化后对其他搜索引擎抓取收录以及 SEO 的影响如何？
在原页面 MIP 化，不会影响其它搜索引擎的抓取收录，也不会影响页面权重。新增 MIP 页可通过 robots.txt 文件禁用其它搜索引擎的抓取，从而保证原页面的权重。MIP 相关的内容可以这么写 (假设您的目录是 /mip/):

User-agent: Baiduspider
（这里不用写关于 mip 的内容）

User-agent: Googlebot
Disallow: /mip/


https://ziyuan.baidu.com/mip/index

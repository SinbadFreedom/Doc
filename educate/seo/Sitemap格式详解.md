1 ʲô��Sitemap
===

Sitemaps��վ��������������������ǵ���վ�ɱ�ץȡҳ���һ���򵥵ķ���.��վ��ͼ��һ��XML�ļ�,�г�����ÿ��URL�ĸ���Ԫ���ݵ���վ��ַ����ҳurl,�ϴθ���ʱ��,�仯Ƶ��,��Ҫ�̶ȣ�ʹ���������ܹ������ܵ�ץȡ��վ.

��������ͨ��ͨ����վҳ���е����ӷ�����������ҳ��.Sitemaps�����������������֧��Sitemaps�������е�URL����վ,�˽���Щ��ַ��ʹ����ص�Ԫ����.ʹ��SitemapЭ�鲢���ܱ�֤��ҳ������������¼,��Ϊ�����������������վ�ṩ�˸��õ�ָʾ.

��վ�ṩ��0.90�����������-���⹲����ɺ���ȨЭ���Ѿ��㷺����,����֧�ִ�Google,Yahoo����΢���������������.




2 Sitemaps XML ��ʽ
===
SitemapЭ����XML��ʽ.�ļ�������UTF-8����.
Sitemap�������:
- ��<urlset>��ǩ��ͷ,������</urlset>��ǩ�ر�.
- ��<urlset>��ǩ��ָ�������ռ䣨Э���׼��.
- <URL>��ǩ, ��Ϊÿ��URL�ĸ���ǩ.
- ÿ��<URL>����ǩ�а��� <loc> �ӱ�ǩ.

������Ƕ��ǿ�ѡ��.����Щ��ѡ��ǵ�֧�ֿ����������������.������ο�ÿ������������ĵ�.

ͬʱ,��һ����վ��ͼ�е�����URL�����ڵ�һ������,��img.dashidan.com��www.dashidan.com.����ο�վ���ͼ�ļ���λ��.


3 Sitemap�ļ�ʾ��
===

3.1 ����ʾ��
---


�����ʾ����ʾ��һ����վ,ֻ����һ����ַ��ʹ�����п�ѡ�ı�ǩ.

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

3.2 ����ַSitemap�ļ�ʾ��
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

3.3 Sitemap�����ļ�
---
������ṩ���վ���ͼ�ļ�,����ÿ��վ���ͼ�ļ�,���ṩ�ı����в�����50000��URL,���벻����50MB��52428800�ֽڣ�.�����Ը��,����԰����վ���ļ�ʹ��gzipѹ����������Ĵ�������;��������г�����50000��URL,���봴�����վ���ͼ�ļ�.

����ж��վ���ͼ,��Ӧ����վ���ͼ�����ļ���һһ�г�.������ж��վ���ͼ�����ļ�.ѹ������ҪС��50M.

վ���ͼ�����ļ���XML��ʽ��վ���ͼ�ļ���XML��ʽ�ǳ�����.

վ���ͼ�����ļ��������:
- ��<sitemapindex>��ǩ��ͷ,������</sitemapindex>��ǩ�ر�.
- <sitemap>��ǩ, ��Ϊÿ��Sitmap�ĸ���ǩ.
- ÿ��<sitemap>����ǩ�а���<loc>�ӱ�ǩ.

��ѡ��ǩ<lastmod>ͬ��������Sitemap�����ļ�.

ע��վ���ͼ�����ļ�ֻ��ָ��ͬһ����վ����վ��ͼ�ļ�.

���磺
http://dashidan.com/sitemap_index.xml�ܹ�����http://dashidan.com��վ�е�sitemap�ļ�,�����ܰ���http://www.dashidan.com ���� http://yourhost.dashidan.com. վ���ͼ�����ļ�������UTF-8��ʽ��.

3.4 Sitemap�����ļ�ʾ��
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

4 Sitemap��XML��ǩ����
===

<table class="table table-bordered table-responsive text-center">
	<thead>
		<tr class="info">
			<td>��ǩ</td>
			<td>�Ƿ����</td>
			<td>��ע</td>
		</tr>
	</thead>
	<tbody>
	<tr>
		<td><urlset></td>
		<td>��</td>
		<td>�ļ�������ǩ,��ע����ǰЭ���׼.</td>
	</tr>
	<tr>
		<td><url></td>
		<td>��</td>
		<td>ÿ��URL��ĸ����.�������Ǵ˱�ǵ���Ԫ��.</td>
	</tr>
	<tr>
		<td><url></td>
		<td>��</td>		<td>ҳ���URL.��URL������Э�飨��HTTP����ʼ,�������Web��������Ҫ��,����һ��б�ܽ�β.��ֵ����С��2048���ַ�.</td>
	</tr>
	<tr>
		<td><lastmod></td>
		<td>��</td>
		<td>����޸����ڵ��ļ�.������ڱ�����W3C��DateTime��ʽ.���ָ�ʽ����ʡ��ʱ�䲿��,����: YYYY-MM-DD.		ע��,�����ǩ�Ƕ�����`If-Modified-Since(304)`-�ӷ��������ص�header��Ϣ,����������ԴӲ�ͬ����Դʹ�ò�ͬ����Ϣ.</td>		
	</tr>
	<tr>
		<td><changefreq></td>
		<td>��</td>		<td>ҳ���ж�Ƶ���ᷢ���仯.���ֵ�ṩ�����������һ����Ϣ,��������������ҳ���Ƶ�ʲ���ȫ���.��Чֵ�ǣ�always, hourly, daily, weekly, monthly, yearly, never.
		always������ʾÿ�η��ʸı���ļ�,never������ʾ�鵵���ļ�.
		��ע��,�˱�ǵ�ֵ����Ϊ��ʾ����������.������������������Կ�����Щ��Ϣ������ʱ,���ǿ���ץȡ������hour�����ڱ�ע��yearly����ҳ��.����ᶨ��ץȡҳ����Ϊ��never������ҳ��Ӧ��ͻȻ�仯.
		</td>
	</tr>
	<tr>
		<td><priority></td>
		<td>��</td>		<td>��URL�����վ��������URL�����ȼ�.��Чֵ��Χ��0��1.��ֵ��Ӱ������ҳ�����������վֻ������������֪���ĸ���ҳҳ���ץȡ����Ϊ����Ҫ��.</td>
		ҳ���Ĭ�����ȼ�Ϊ0.5.
		��ע��,�������ҳ������ȼ���̫����Ӱ��URL������������ҳ���е�λ��.����������ͬһվ���URL֮��ѡ��ʱ����ʹ�ô���Ϣ,���������ʹ�ô˱����������������������Ҫҳ��Ŀ�����.
		����,��ע��,����վ�ϵ�����URL����һ�������ȼ���̫���ܶ����а���.��Ϊ���ȼ�����Ե�,������ֻ������վ���ϵ�URL֮�����ѡ��.
	</tr>
	</tbody>
</table>


5 ʵ��ת��
===
���վ���ͼ�ļ�����ʹ��UTF-8���루ͨ������������,���㱣���ļ���.������XML�ļ�һ��,�κ�����ֵ������URL��������ʹ����������г����ַ���ʵ��ת�����.

<table class="table table-bordered table-responsive text-center">
	<thead>
		<tr class="info">
			<td>����</td>
			<td>ת��</td>
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

���е�URL������������վ��URL����������������Web����������URL����.���ʹ�ýű������߻���־�ļ�������URL�������ֹ�����URL֮�⣩,ͨ���Ѿ�Ϊ����������ת��.������ȷ��������ַ����URI��rfc-3986��׼,IRIs��rfc-3987��׼��XML��׼.

������һ����ַ,ʹ�÷�ASCII�ַ���һ�����ӣ�����,�Լ�һ���ַ���Ҫʵ��ת�壨&����

```
http://www.dashidan.com/��mlat.php&q=name
```

��������ͬ��URL,ISO-8859-1�����URLת�壺
```
http://www.dashidan.com/%FCmlat.php&q=name
```

��������ͬ��URL,ʹ��UTF-8�����URLת�壺
```
http://www.dashidan.com/%C3%BCmlat.php&q=name
```

��������ͬ��URL,����ʵ��ת�壺
```
http://www.dashidan.com/%C3%BCmlat.php&amp;q=name
```

6 ������ʽ��Sitemap
===

����ʹ��SitemapЭ��,������������˵xml��ʽ��sitemap�ļ������ṩ����ҳ������ϸ��,����������վҳ���URL.

����XMLЭ��֮��,���ǻ�֧��RSS��Ҫ��text�ļ�,��Щ�ļ��ṩ�˸����޵���Ϣ.
���ﲻ�ٸ���,���Է��ʹ�����վ�鿴��ϸ��Ϣ.

�����һ���򵥵��ı���ʽ��ʾ��:
```
http://dashidan.com/article/java/index.html
http://dashidan.com/article/git/index.html
```

7 Sitemapλ��
===

һ��վ���ͼ�ļ���λ�þ����˿��԰�����URL��λ��.
����: վ���ͼ�ļ�λ��http://dashidan.com/article/java/sitemap.xml���԰���http://dashidan.com/article/java/��Ӧ��URL, ��������http://dashidan.com/article/git/�ж�Ӧ��URL.

����
- http://dashidan.com/article/java/sitemap.xml����Ч������

```
http://dashidan.com/article/java/basic/3.html
http://dashidan.com/article/java/faq/1.html
```

- http://dashidan.com/article/java/sitemap.xml����Ч������

```
http://dashidan.com/article/html/faq/1.html 
http://dashidan.com/article/git/faq/1.html
```

ע��,����ζ����վ���ͼ���г�������URL����ʹ����ͬ��Э�飨�����������HTTP����פ����ͬһ̨�����ϵ���վ.����,���վ����λ��http://dashidan.com/sitemap.xml,�����ܰ���http://subdomain.dashidan.com����ַ.

ǿ�ҽ��齫�����վ��Web�������ĸ�Ŀ¼.
����,���Web��������dashidan.com,��ôվ���ͼ�����ļ�����http://dashidan.com/sitemap.xml.
��ĳЩ�����,��������Ҫ���ò�ͬ��·����ͬ����վ������,��ͬ��Ŀ¼����Ȩ�޲�ͬ��.

������ύ��վ��ͼʹ��·����˿ں�,��������˿ں���Ϊ·����һ����,�г���ÿ��URL��վ���ͼ�ļ�.
����,������վ����λ��http://dashidan.com:100/sitemap.xml,Ȼ����վ���ͼ���г���ÿ��URL������http://dashidan.com:100/.

8 ֪ͨ������������
===
һ���㴴��վ���ͼ�ļ�������ķ�����,����Ҫ������������,����ļ���λ��.�������������

- ͨ������������ύ�����ύ�����վ
- �����robots.txt�ļ���ָ����վ��λ��,Ҳ����ͬʱָ�����
```
Sitemap: http://dashidan.com/sitemap-host1.xml
Sitemap: http://dashidan.com/sitemap-host2.xml
```
- ͨ��Http�����ύ
ʹ��һ��HTTP�����ύ�����վ,����������ַ��

ͨ�����������ṩ��URL�滻<searchengine_url>
```
<searchengine_URL>/ping?sitemap=sitemap_url
```

����,������վ���ͼ��λ��http://dashidan.com/sitemap.xml,URLΪ��
```
bing.com/ping?sitemap=http://dashidan.com/sitemap.xml
```

`/ping?sitemap=:`��ߵ���Ҫ����URLת��

```
<searchengine_URL>/ping?sitemap=http%3A%2F%2Fwww.yoursite.com%2Fsitemap.gz

```

����Է���ʹ��wget,curl, �����Զ��巽ʽ����HTTP����.
һ���ɹ�������᷵��һ��HTTP 200��Ӧ����;������յ���ͬ�ķ�Ӧ,��Ӧ�������ύ�������.
HTTP 200��Ӧ����ֻ��ʾ���������Ѿ��յ��������վ,��������վ��ͼ�е�URL����Ч��.
һ���򵥵İ취�ǽ���һ���Զ����������ɺ��ύ��Sitemaps.

������ṩһ����վ��ͼ�����ļ�,ֻ��Ҫ����һ��HTTP����,����վ���ͼ�����ļ���λ��;����Ҫ�ٷֱ��ύÿ��վ���ͼ����.

9 �ų�����
===
SitemapsЭ��ʹ���ܹ�����������֪����ϣ��ʲô�����ݱ�����.�������������㲻��Ҫ����������,ʹ��robots.txt�ļ���robots meta��ǩ.����robotstxt.org�鿴���������δ����������ų�����.

10 �ο�����
===
https://www.sitemaps.org/protocol.html

ngin���ö��������ǳ���ֻ��Ҫ����һ��server����,�޸�server_name��������Ŀ¼.

1 ����������Ӧ�ó���
===

������վ������ʱ��,����ҳ����һ���������ǿ���ͬ�������������õĹ�����վ�ļ�Ŀ¼.����ͨ���������������ֲ�ͬ����վ����.����img.dashidan.com�������վ��ȫ��ͼƬ.�����ں�����CDN���ٻ�ܺô���.��������ֻ��û����Ӷ�������m.dashidan.com.��.

�����������������龡����Ҫ����20��.��Ϊ������������Ч��Ҫ�޸�dns����.���������Ҫ����ʱ���,������۱�������վ��Ŀ¼Ҫ��.

2 dns���ö�����������
===

����������Ҫ���ṩ����������������վ���޸�.���������������ע�͵�����,���Ե�½�����ƿ���̨�ҵ�������.���޸Ķ�������.

�ο�[dns������¼����](http://dashidan.com/article/webserver/dns/1.html)


3 nginx����һ������ʾ��
===
�Դ�ʺ���̳� http://dashidan.comΪ��.
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

3 nginx���ö�������ʾ��
===

- erver_name Ϊ�����Ķ�������.
- root Ϊ����������Ӧ���ļ�Ŀ¼.

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
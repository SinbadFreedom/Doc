301�ض���һ��URL��ַ����һ�����������ض���Ϊ��һ��URL. �������apetools.cn,�Զ�����dashidan.com.Ҳ���������Ѿ�ɾ���Ļ����޸ĵ�ַ������ָ����һ��ҳ��.���������404����.

1 Nginx����301�ض���
===

��nginx.conf�ļ�,�ҵ�server�ֶζ�Ӧ������.����301�ض������:

```
server {
    listen    80;
    server_name apetools.cn dashidan.com;
    if ($host != 'dashidan.com' ) { 
        rewrite ^/(.*)$ http://dashidan.com/$1 permanent;
    }
}
```

����һ����һ�д�����301�ض������ַ.����: $1��ʾurl��ߵĲ���, permanent��ʾ�����ض���.
```
rewrite ^/(.*)$ http://dashidan.com/$1 permanent;
```
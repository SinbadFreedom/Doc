java��������redis,mongdbʱip����Ϊ127.0.0.1ʱ�޷����ӡ���ʾUnknownHostException.

��������ԭ����/etc/hosts�ļ���127.0.0.1��һ����û������������������ǽ�����������127.0.0.1���.

1 hostname�鿴������
===

hostname

��ʾʾ����

```
Ubuntu
```

��ͬ�ĵ�����ʾ���ܲ�ͬ.������Ǳ�����hostname.�������õ�.


�鿴����������IP����:

hostname -I

��������ߵ�I�Ǵ�д��.


2 /etc/hosts�ļ�����hostname
===

�鿴����hosts�ļ�����
```
cat /etc/hosts
```
��ʾʾ��:

```
127.0.0.1 localhost
```

�����ʾ��û�е�һ��hostname��ʾ������.���Ǹ����ּ������.

```
vim /etc/hosts
�޸�
127.0.0.1 localhost Ubuntu
``` 
�����Ubuntu��Ϊ���һ��hostname��ʾ���ַ�.

ע������ļ���/etc/hosts����/etc/host���޸�����Ч������������������
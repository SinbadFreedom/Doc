ubuntu��װmongodb-enterprese�汾��ʱ����ʾ"Unable to locate package mongodb-enterprise".��ubuntu 16.04Ϊ��.������������Ҫ����һ�²��������װ.

1 ִ��һ�½ű�����mongodb-enterprise��Ϣ
===

```
sudo apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 0C49F3730359A14518585931BC711F9BA15703C6
echo "deb [ arch=amd64 ] http://repo.mongodb.com/apt/ubuntu precise/mongodb-enterprise/3.4 multiverse" | sudo tee /etc/apt/sources.list.d/mongodb-enterprise.list
echo "deb [ arch=amd64 ] http://repo.mongodb.com/apt/ubuntu trusty/mongodb-enterprise/3.4 multiverse" | sudo tee /etc/apt/sources.list.d/mongodb-enterprise.list
echo "deb [ arch=amd64,arm64,ppc64el,s390x ] http://repo.mongodb.com/apt/ubuntu xenial/mongodb-enterprise/3.4 multiverse" | sudo tee /etc/apt/sources.list.d/mongodb-enterprise.list
```

2 ����ϵͳ���汾
===
```
apt-get update
```
ִ�����һ������һ������ִ�С����������ҵ�mongodb-enterprese.


3 ��װmongodb-enterprese
===

```
apt-get install -y mongodb-enterprise
```

��װmongodb ��һ����Ҫʱ��ϳ�,���20��������.
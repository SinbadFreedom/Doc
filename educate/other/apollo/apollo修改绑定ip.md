apolloĬ�ϰ󶨱���ip127.0.0.1, �е�ʱ����Ҫ���ǽ�apollo��Ϊ������ip��������ip, ��ʹ�����������ܹ�����.�޸İ�ip��Ҫ�޸���������.

1 ����host_name
===

Ĭ��ֻ��ǰmybroker, localhost, 127.0.0.1������, ��Ҫ����һ���󶨵�IP.��������������µ�IP�Ļ�,�޷�ͨ����������61613�˿�.
```
<host_name>mybroker</host_name>
<host_name>localhost</host_name>
<host_name>127.0.0.1</host_name>
<host_name>NEW_IP</host_name>
```

2 �޸�TCP���ӵ�IP��ַ
===

tcp://127.0.0.1:61613 ��Ϊtcp://NEW_IP:61613

```
<connector id="tcp" bind="tcp://NEW_IP:61613" connection_limit="2000"/>
<connector id="tls" bind="tls://0.0.0.0:61614" connection_limit="2000"/>
<connector id="ws"  bind="ws://0.0.0.0:61623"  connection_limit="2000"/>
<connector id="wss" bind="wss://0.0.0.0:61624" connection_limit="2000"/>
```
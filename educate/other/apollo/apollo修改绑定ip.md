apollo默认绑定本地ip127.0.0.1, 有的时候需要我们将apollo绑定为局域网ip或者外网ip, 来使其他服务器能够访问.修改绑定ip需要修改两个定法.

1 增加host_name
===

默认只有前mybroker, localhost, 127.0.0.1这三个, 需要增加一个绑定的IP.这里如果不增加新的IP的话,无法通过程序连接61613端口.
```
<host_name>mybroker</host_name>
<host_name>localhost</host_name>
<host_name>127.0.0.1</host_name>
<host_name>NEW_IP</host_name>
```

2 修改TCP连接的IP地址
===

tcp://127.0.0.1:61613 改为tcp://NEW_IP:61613

```
<connector id="tcp" bind="tcp://NEW_IP:61613" connection_limit="2000"/>
<connector id="tls" bind="tls://0.0.0.0:61614" connection_limit="2000"/>
<connector id="ws"  bind="ws://0.0.0.0:61623"  connection_limit="2000"/>
<connector id="wss" bind="wss://0.0.0.0:61624" connection_limit="2000"/>
```
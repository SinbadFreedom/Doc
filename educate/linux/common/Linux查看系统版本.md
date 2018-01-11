1 cat /etc/issue
===
这种方式可以显示linux操作系统信息. 可以用来区分是Red Hat还是Ubuntu,Centos等.
显示示例:
```
CentOS release 6.5 (Final)
```

2 cat /proc/version
===
可以显示linux系统CPU位数.`x86_64`表示64位.

显示示例:
```
Linux version 2.6.32-431.23.3.el6.x86_64 (mockbuild@c6b8.bsys.dev.centos.org) (gcc version 4.4.7 20120313 (Red Hat 4.4.7-4) (GCC) ) #1 SMP Thu Jul 31 17:20:51 UTC 2014
```

3 uname -a
===
显示示例
```
Linux iZwz9cgkp2jyuq6auk9u94Z 2.6.32-431.23.3.el6.x86_64 #1 SMP Thu Jul 31 17:20:51 UTC 2014 x86_64 x86_64 x86_64 GNU/Linux
```
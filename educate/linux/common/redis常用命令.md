redis常用命令
===

Redis只用内存存储，不采用文件存储的方式

1. 命令行连接Redis
---
	
	redis-cli

2. 查看所有的key
---

	keys *

	注意后边没有分好，中间有空格

3. 查看key的类型
---

	type BO:Server

4. 获取一个key
---
	get key

5. 删除一个key
---

6. 返回满足给定patterm的所有key
---
	keys    #(*)取出所有的key      (my*)取出和关键字相关的
7. 确认一个key是否存在
---
	exists
8. 设置一个key的过期时间
---
	expire
9. 获取hash类型的全部数据
---
	hgetall key
9. 获取hash类型的一个数据
---
	hget key key1

9. 将当前数据库中的key转移到其他数据库中
---
	move            #0-15数据库
10. 移除给定key的过期时间
---
	persist                    #取消定时
11. 实时传储收到的请求
---
	config get dir/* 

6. 选择一个数据库
---

	select 0

	0 为数据库ID

6. 测试是否联通
---

	ping

7. 退出连接
---

	quit

8. 返回当前数据库中key的数量
---

	dbsize

9. 获取服务器信息
---
	info

10. 删除当前选择的数据库中的key
---
	flushdb
11. 删除所有数据库中的所有key
---
	flushall

12. 设置密码
---
	vi /etc/redis.conf
	requirepass pp123456
	pkill redis     #杀死进程
	service  redis start 
	auth        pp123456


	

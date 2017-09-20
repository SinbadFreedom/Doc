mongodb配置及常用命令
===

1. 修改mongodb的绑定IP和端口
---

	net:
  	port: 37017
  	bindIp: 127.0.0.1  # Listen to local interface only, comment to listen on all interfaces.

2. 修改启动报错
---

	** WARNING: /sys/kernel/mm/transparent_hugepage/enabled is 'always'.
	**        We suggest setting it to 'never'
	** WARNING: /sys/kernel/mm/transparent_hugepage/defrag is 'always'.
	**        We suggest setting it to 'never'

	sudo echo "never" > /sys/kernel/mm/transparent_hugepage/enabled
	sudo echo "never" >  /sys/kernel/mm/transparent_hugepage/defrag

3. 连接mongodb
---

	mongo 127.0.0.1:37017

4. 常用命令
---

　　show dbs: 查看所有数据库
　　show collections: 查看当前数据库下所有集合
　　help: 查看帮助文档
　　db.help(): 在数据库级别查看帮助信息
　　db.users.help(): 在集合级别查看帮助信息
　　db.users.drop(): 删除集合
　　db.dropDatabase(): 删除数据库

5. 数据库备份
---
命令:

	mongodump -h dbhost -d dbname -o dbdirectory
	
参数说明:

	-h:MongDB所在服务器地址,例如:127.0.0.1,当然也可以指定端口号:127.0.0.1:27017
	-d:需要备份的数据库实例,例如:test	-o:备份的数据存放位置,例如:c:\data\dump,当然该目录需要提前建立,在备份完成后,统自动在dump目录下建立一个test目录,这个目录里面存放该数据库实例的备份数据


6. 整库恢复
---
命令:

	mongorestore -h dbhost -d dbname –directoryperdb dbdirectory
	
参数说明:

	-h:MongoDB所在服务器地址
	-d:需要恢复的数据库实例,例如:test,当然这个名称也可以和备份时候的不一样,比如test2
	–directoryperdb:备份数据所在位置,例如:c:\data\dump\test,这里为什么要多加一个test,而不是备份时候的dump
	–drop:恢复的时候,先删除当前数据,然后恢复备份的数据。就是说,恢复后,备份后添加修改的数据都会被删除,慎用哦！

7. 单个collection备份:
---
命令:

	mongoexport -h dbhost -d dbname -c collectionname -f collectionKey -o dbdirectory
	
参数说明:

	-h: MongoDB所在服务器地址
	-d: 需要恢复的数据库实例
	-c: 需要恢复的集合
	-f: 需要导出的字段(省略为所有字段)
	-o: 表示导出的文件名

8. 单个collection恢复:
---
命令:

	mongoimport -d dbhost -c collectionname –type csv –headerline –file
	
参数说明:
	
	-type: 指明要导入的文件格式
	-headerline: 批明不导入第一行,因为第一行是列名
	-file: 指明要导入的文件路径


9. 其他导入与导出操作
---
1.
	mongoimport -d my_mongodb -c user user.dat
	
参数说明:

	-d 指明使用的库, 本例中为”my_mongodb”
	-c 指明要导出的表, 本例中为”user”
	可以看到导入数据的时候会隐式创建表结构
	
2.

	mongoexport -d my_mongodb -c user -o user.dat	
	
参数说明:	

	-d 指明使用的库, 本例中为”my_mongodb”	
	-c 指明要导出的表, 本例中为”user”	
	-o 指明要导出的文件名, 本例中为”user.dat”
	
10. 相关文章
---

[mongodb配置及常用命令](http://localhost/article/linux/common/mongodb配置及常用命令.html)   
[mongodb的导入导出及备份恢复](http://localhost/article/linux/common/mongodb的导入导出及备份恢复.html)   
[ubuntu安装配置mongodb及常用命令](http://localhost/article/linux/ubuntu/ubuntu安装配置mongodb及常用命令.html)
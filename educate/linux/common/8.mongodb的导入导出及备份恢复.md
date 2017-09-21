mongodb的导入导出及备份恢复
===

<div class="jumbotron">
<p>mongodb是高效的NoSQL类型数据库.</p>  
</div>

1. mongodb导出
---

`mongoDB`中的`mongoexport`工具可以把一个`collection`导出成`JSON`格式或`CSV`格式的文件.可以通过参数指定导出的数据项,也可以根据指定的条件导出数据.  

mongodb导出命令:

	mongoexport -d dbname -c collectionname -o file --type json/csv -f field
	
参数说明:   

	-d :数据库名
	-c :collection名
	-o :输出的文件名
	--type : 输出的格式,默认为json
	-f :输出的字段,如果-type为csv,则需要加上-f "字段名"
	-q : 导出条件限制 导出用户名为test的 "{'username' : 'test'}"
		
示例:   

	sudo mongoexport -d mongotest -c users -q "{'username' : 'test'}" -o /home/python/Desktop/mongoDB/users.json --type json -f  "_id,user_id,user_name,age,status" 
 
2. mongodb数据导入
---

mongodb数据导入命令:

	mongoimport -d dbname -c collectionname --file filename --headerline --type json/csv -f field
		
参数说明:

	-d :数据库名
	-c :collection名
	--type :导入的格式默认json
	-f :导入的字段名
	--headerline :如果导入的格式是csv,则可以使用第一行的标题作为导入的字段
	--file :要导入的文件
 
示例:   
	
	sudo mongoimport -d mongotest -c users --file /home/mongodump/articles.json --type json
 

3. MongoDB数据库备份
---
MongoDB数据库备份命令:

    mongodump -h dbhost -d dbname -o dbdirectory
	
参数说明:

	-h: MongDB所在服务器地址,例如:127.0.0.1,当然也可以指定端口号:127.0.0.1:27017
	-d: 需要备份的数据库实例,例如:test
	-o: 备份的数据存放位置, :/home/mongodump/, 当然该目录需要提前建立, 这个目录里面存放该数据库实例的备份数据.
 
例:   	

	sudo rm -rf /home/momgodump/
	sudo mkdir -p /home/momgodump
	sudo mongodump -h 127.0.0.1:27017 -d dbdata -o /home/mongodump/
        
4. MongoDB数据库恢复
---
MongoDB数据库恢复命令:

	mongorestore -h dbhost -d dbname --dir dbdirectory
 
参数说明:

	-h: MongoDB所在服务器地址
	-d: 需要恢复的数据库实例,例如:test,当然这个名称也可以和备份时候的不一样,比如test2
	--dir: 备份数据所在位置,例如:/home/mongodump/dbdata/
	--drop: 恢复的时候,先删除当前数据,然后恢复备份的数据.就是说,恢复后,备份后添加修改的数据都会被删除,慎用！
	
例:   

	mongorestore -h 127.0.0.1:27017 -d dbdata_restore --dir /home/mongodump/dbdata/
	
5. 相关文章
---

[mongodb配置及常用命令](http://localhost/article/linux/common/mongodb配置及常用命令.html)   
[mongodb的导入导出及备份恢复](http://localhost/article/linux/common/mongodb的导入导出及备份恢复.html)   
[ubuntu安装配置mongodb及常用命令](http://localhost/article/linux/ubuntu/ubuntu安装配置mongodb及常用命令.html)   
[linux通用命令及配置](http://localhost/article/linux/common/index.html)    
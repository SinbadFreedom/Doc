linux常用命令
===

1. linux常用命令
---

###查看目录占用空间
   
     du -h --max-depth=1

###查看磁盘信息

     fdisk -l

###查看挂载的磁盘信息
 
    mount -l

###查看磁盘使用情况    

    df -Th

###递归复制  

	cp -r bbs ../backup/bbs 

###查看指定文件大小

	 du -hs /data 

###挂载磁盘

	mount  /dev/xvdb1 /data

###日志搜索

在名为"1.log"的文件中搜索包含"ERROR"的上下5行日志并将结果输出到名为"2.log"的文件

	cat 1.log | grep "ERROR" -a5 > 2.log

###修改服务器时间

设置时间为2008年8月8号12:00

	date -s "2008-08-08 12:00:00"

2. 相关文章
---

[linux通用命令及配置](http://localhost/article/linux/common/index.html)  

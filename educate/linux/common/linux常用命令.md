linux常用命令
===

1 查看目录占用空间
---   
     du -h --max-depth=1

2 查看磁盘信息
---
     fdisk -l

3 查看挂载的磁盘信息
--- 
    mount -l

4 查看磁盘使用情况    
---
    df -Th

5 递归复制  
---
	cp -r bbs ../backup/bbs 

6 查看指定文件大小
---
	 du -hs /data 

7 挂载磁盘
---
	mount  /dev/xvdb1 /data

8 日志搜索
---
在名为"1.log"的文件中搜索包含"ERROR"的上下5行日志并将结果输出到名为"2.log"的文件

	cat 1.log | grep "ERROR" -a5 > 2.log

9 修改服务器时间
---
设置时间为2008年8月8号12:00

	date -s "2008-08-08 12:00:00"
	

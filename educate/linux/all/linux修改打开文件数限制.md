linux修改打开文件数限制
===

1 修改文件数限制
---
输入命令:

	ulimit -f unlimited  
	ulimit -t unlimited  
	ulimit -v unlimited  
	ulimit -n 64000  
	ulimit -m unlimited  
	ulimit -u 64000  
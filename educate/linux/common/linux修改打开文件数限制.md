linux修改打开文件数限制
===

<div class="jumbotron">
<p>linux默认打开的文件/socket连接数量上限是1024, 高并发的时候如果超过这个数量限制会报错`open too many files`.</p>  
</div>

1 linux修改打开文件数上限
---
输入命令:

	ulimit -f unlimited  
	ulimit -t unlimited  
	ulimit -v unlimited  
	ulimit -n 64000  
	ulimit -m unlimited  
	ulimit -u 64000
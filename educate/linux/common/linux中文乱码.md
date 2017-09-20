linux中文乱码
===

1 查看系统编码   
---
	echo $LANG

2 修改编码
---
	export LANG=zh_CN.UTF-8

3 修改/etc/environment
---
	vim /etc/environment
	
文件末尾加入:

	LANG="zh_CN:zh:en_US:en"
	LANGUAGE="zh_CN:zh:en_US:en"

4 linux运行java程序,控制台显示乱码
---
启动时加入参数:

	java -Dfile.encoding="UTF-8" -jar xxx.jar

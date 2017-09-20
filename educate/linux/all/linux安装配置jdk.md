linux安装配置jdk
===

1 将jdk压缩文件上传到指定目录下
---

	rz
2 解压jdk安装包
---
	tar -zxvf 压缩文件 (将安装包解压到本目录下)
	tar -zxvf 压缩文件 -C 指定目录路径 （将安装包解压到指定目录）

3 安装
---
  apt-get install 解压后文件

4 编辑环境变量配置文件
---
	vi /etc/profile

5 在文件末尾添加三个环境变量
---
	export JAVA_HOME=/bo/jdk1.8.0_111（jdk解压后文件所在目录）
	export PATH=$JAVA_HOME/bin:$PATH
	export CLASSPATH=.:$JAVA_HOME/lib/dt.jar:$JAVA_HOME/lib/tools.jar

6 使环境变量生效
---
	source /etc/profile

7 查看jdk是否安装成功
---
	java -version
	javac
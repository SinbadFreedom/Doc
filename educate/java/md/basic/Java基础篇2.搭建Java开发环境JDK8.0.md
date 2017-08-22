Java基础篇2.搭建Java开发环境JDK8.0
---
###简介:SDK是什么
SDK全称(Standard Development Kit),标准开放工具包.   
java和JDK的关系,就像鱼和水的关系.  

###下载Java SDK

1.<a href="http://www.oracle.com/technetwork/java/javase/downloads/jdk8-downloads-2133151.html". target="_blank">JDK官网下载链接</a>  
2.选中`Java SE Development Kit 8u144`中的`Accept License Agreement`.   
3.选择适合自己操作系统的版本点击链接下载.`windows x86`是32位版本,`windows x64`是64位版本.  

注意:   
[如何分辨windows系统是32位还是64位](http://dashidan.com/os/如何分辨windows系统是32位还是64位.html).   

如图2-1所示:   
![图2-1](../../img/java/basic/2-1.png)   
[图2-1]

###安装  
点击下一步直到完成,采用默认安装配置.

###配置Java环境变量

####windows7配置Java环境变量

1.计算机->点右键->属性->高级系统设置   

如图2-2所示:   
![图2-2](../../img/java/basic/2-2.png)   
[图2-2]   

2.弹出窗口中点击->环境变量   

<span id="hjbl">Java环境变量配置如图2-3所示:</span>   

![图2-3](../../img/java/basic/2-3.png)  
[图2-3]   

3.配置`用户变量`classpath   
在`用户变量`栏中点击->`新建按钮`   
<span id="yhbl">Java用户变量classpath配置如图2-3所示:</span>   

`变量名`输入:
	
	classpath
		
`变量值`输入:
	
	.;C:\Program Files\Java\jdk1.8.0_144\lib
		
<span class="text-warning">注意:</span>   
`变量值`由`.;`加`JDK安装目录`加`lib`组成.
如图2-4所示:   
![图2-4](../../img/java/basic/2-4.png)   
[图2-4]   
	
4.配置`系统变量`Path   
在系统变量栏中找到Path->点击编辑按钮增加

	;C:\Program Files\Java\jdk1.8.0_144\bin
	
<span class="text-warning">注意:</span>   
添加字符串由`;`加上`JDK安装目录`加`bin`目录组成.

如图2-5所示:   
![图2-5](../../img/java/basic/2-5.png)   
[图2-5]   
	
####配置完成重启电脑,使环境变量生效
		
####windows8配置Java环境变量   
参考以上配置步骤.

####windows10配置Java环境变量
参考以上配置步骤.
	
注意:
Java默认安装目录`C:\Program Files\Java\jdk1.8.0_144`.   
在`jdk1.8.0_144`的同级目录有个文件夹`jre1.8.0_144`,是Java运行环境(Java Runtime Environment),系统运行Java程序使用.
	
###测试
1.打开命令提示符  

	鼠标点击桌面左下角windows图标->所有程序->附件->命令提示符
	
2.测试环境变量   
输入命令:
	
	java -version
	
<p class="bg-success">	
输出java版本号信息说明配置正确.如图2-6所示:
</p>  
![图2-6](../../img/java/basic/2-6.png)   
[图2-6]

3.测试用户变量   
输入命令:
	
	javac

<p class="bg-success">	
输出javac命令行信息说明配置正确.如图2-7所示:   
</p>
![图2-7](../../img/java/basic/2-7.png)   
[图2-7]

注意:
<p class="bg-warning">
如果执行java命令时在命令行窗口提示错误,表示环境变量配置有问题,需要从新配置.
</p>
<p class="bg-danger">
运行java命令提示'java'不是内部或外部命令,也不是可运行的程序或批处理文件
</p>
[检查环境变量配置](#hjbl)
<p class="bg-danger">
运行java命令提示'javac'不是内部或外部命令,也不是可运行的程序或批处理文件
</p>
[检查用户变量配置](#yhbl)	
###本节完
<p class="bg-success">	
恭喜你!你的渔已经准备好,我们要开始捕鱼了！
</p>
<img src="还有点小期待呢">
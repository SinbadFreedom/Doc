ubuntu安装配置zookeeper及常用命令
===

1. 下载
---   

     wget http://mirror.bit.edu.cn/apache/zookeeper/zookeeper-3.5.2-alpha/zookeeper-3.5.2-alpha.tar.gz

2. 解压缩
---
    
     tar -zxvf zookeeper-3.5.2-xxxx.tar.gz

3. 打开conf目录
--- 
    cd /zookeeper-3.5.2-alpha/conf

4. 拷贝zoo_samle.cfg 为zoo.cfg    
---
    cp zoo_samle.cfg zoo.cfg

5. 设置环境变量   
---

    vim /etc/profile
	export PATH=/download/zookeeper-3.5.2-alpha:$PATH
	source /etc/profile

6. 启动zookeeper
---

	 ./zkServer.sh start

7. 测试    
---

	telnet 203.195.161.167 2181

8. 相关文章
---

[ubuntu安装配置nginx+mysql+php+php-fpm](http://localhost/article/linux/ubuntu/ubuntu安装配置nginx+mysql+php+php-fpm.html)    
[ubuntu安装配置mongodb及常用命令](http://localhost/article/linux/ubuntu/ubuntu安装配置mongodb及常用命令.html)   
[ubuntu安装配置redis及常用命令](http://localhost/article/linux/ubuntu/ubuntu安装配置redis及常用命令.html)    
[ubuntu安装配置svn及常用命令](http://localhost/article/linux/ubuntu/ubuntu安装配置svn及常用命令.html)    
[ubuntu安装配置redis及常用命令](http://localhost/article/linux/ubuntu/ubuntu安装配置tmux及常用命令.html)    
[ubuntu安装配置zookeeper及常用命令](http://localhost/article/linux/ubuntu/ubuntu安装配置redis及常用命令.html)    
[ubuntu安装配置apollo及常用命令](http://localhost/article/linux/ubuntu/ubuntu安装配置apollo及常用命令.html)   




 
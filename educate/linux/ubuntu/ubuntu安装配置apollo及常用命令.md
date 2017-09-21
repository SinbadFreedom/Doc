ubuntu安装配置apollo及常用命令
===

1. 下载
---   

     wget http://mirrors.tuna.tsinghua.edu.cn/apache/activemq/activemq-apollo/1.7.1/apache-apollo-1.7.1-unix-distro.tar.gz

2. 解压缩
---
    
    tar -zxvf apache-apollo-1.7.1-unix-distro.tar.gz

3. 创建Broker 
--- 
   
    ${APOLLO_HOME}/bin/apollo create mybroker 

4. 启动Apollo
---
    /var/lib/mybroker/bin/apollo-broker run

5. web控制台  
---

    http://127.0.0.1:61680

6. 默认用户名和密码    
---

	默认用户名: admin
	默认密码:	password	

7. 相关文章
---

[ubuntu安装配置nginx+mysql+php+php-fpm](http://localhost/article/linux/ubuntu/ubuntu安装配置nginx+mysql+php+php-fpm.html)    
[ubuntu安装配置mongodb及常用命令](http://localhost/article/linux/ubuntu/ubuntu安装配置mongodb及常用命令.html)   
[ubuntu安装配置redis及常用命令](http://localhost/article/linux/ubuntu/ubuntu安装配置redis及常用命令.html)    
[ubuntu安装配置svn及常用命令](http://localhost/article/linux/ubuntu/ubuntu安装配置svn及常用命令.html)    
[ubuntu安装配置redis及常用命令](http://localhost/article/linux/ubuntu/ubuntu安装配置tmux及常用命令.html)    
[ubuntu安装配置zookeeper及常用命令](http://localhost/article/linux/ubuntu/ubuntu安装配置redis及常用命令.html)    
[ubuntu安装配置apollo及常用命令](http://localhost/article/linux/ubuntu/ubuntu安装配置apollo及常用命令.html)   

 
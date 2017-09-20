ubuntu安装配置apollo及常用命令
=============

***author 李建华 LiJianHua	***   
***date	2017.4.8		  	***   
***version	1.0  			***   

--------------------------------------------------------------------------------------
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


6. 启动zookeeper
---

	 ./zkServer.sh start

7. 默认用户名和密码    
---

	The default login id and password is admin and password.





 
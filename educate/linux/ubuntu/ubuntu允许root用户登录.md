ubuntu允许root用户登录
===

<div class="jumbotron">
<p>部分ubuntu系统默认不允许root用户登录, 这样做的目的是提高安全性, 这样很多操作都需要sodu来执行. 
比较麻烦. 在安全性要求不要的环境中, 直接使用root登陆会很方便.
</p>  
</div>

1 ubuntu允许root用户登录修改方法
---
修改ssh配置

	sudo vim /etc/ssh/sshd_config
	
2 找到`PermitRootLogin`将其改为`yes`
---

	PermitRootLogin yes

3 保存退出
---

输入:

	:wq

4 重启ssh服务
---

	sudo service ssh  restart

现在你的ubuntu允许root用户登录了.
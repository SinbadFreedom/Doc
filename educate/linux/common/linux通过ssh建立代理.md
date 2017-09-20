linux通过ssh建立代理
===

<div class="jumbotron">
<p>通过ssh连接linux服务器建立socket5代理管道, 侦听本地端口.</p>  
</div>

1 linux建立ssh代理命令
---
	ssh -qTfnN -D 1080 -p 22 root@66.88.66.88
	
2 说明
---
	-D 1080 本地侦听端口
	-p 22	远程主机端口
	root@66.88.66.88 远程主机登陆用户名和ip地址
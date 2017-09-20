linux定时任务crontab
===

<div class="jumbotron">
<p>linux的crontab命令是定时任务, 用来让使用者在固定时间或固定间隔执行程序.</p>  
</div>

1 基本格式
---

	分　 时	  日   月　 周　 命令 
	*　　*　　*　　*　　*　　command 
	
第1列表示分钟1～59 每分钟用*或者 */1表示 
第2列表示小时1～23(0表示0点) 
第3列表示日期1～31 
第4列表示月份1～12 
第5列标识号星期0～6(0表示星期天) 
第6列要运行的命令 

* 参数为`*`时表示每对应的位置的单位都要执行对应命令
* 参数为`a-b`时表示从第`a`分钟到第`b`个时间间隔这段时间内要执行
* 参数为`*/n`时表示每`n`个时间间隔执行一次
* 参数为`a, b, c,...`时, 表示第 a, b, c,... 个时间间隔要执行

2 使用方式
---
 
crontab file [-u user]-用指定的文件替代目前的crontab. 
crontab-[-u user]-用标准输入替代目前的crontab. 
crontab-1[user]-列出用户目前的crontab. 
crontab-e[user]-编辑用户目前的crontab. 
crontab-d[user]-删除用户目前的crontab. 
crontab-c dir- 指定crontab的目录. 
crontab文件的格式：M H D m d cmd. 
M: 分钟(0-59). 
H：小时(0-23). 
D：天(1-31). 
m: 月(1-12). 
d: 一星期内的天(0~6,0为星期天). 
cmd要运行的程序,程序被送入sh执行,这个shell只有USER,HOME,SHELL这三个环境变量 

<div class="bs-callout bs-callout-info">
    <h4>crontab -u user</h4>
	<p>crontab -u user是指设定指定user 的定时任务,这个前提是你必须要有其权限(比如说是root)才能够指定他人的定时任务. 如果不使用`-u user` 的话, 表示设定自己的定时任务.</p>
</div>

3 定时任务的格式
---

	f1 f2 f3 f4 f5 program
	


4 crontab配置示例 
---

###每晚的21:30重启nginx

	30 21 * * * service nginx restart 

###每月1、10、22日的4 : 45重启nginx

	45 4 1,10,22 * * service nginx restart 
	
###周六、周日的1 : 10重启nginx

	10 1 * * 6,0 service nginx restart 
	
###每天18 : 00至23 : 00之间每隔30分钟重启nginx

	0,30 18-23 * * * service nginx restart 
	
###每星期六的11 : 00 pm重启nginx. 

	0 23 * * 6 service nginx restart 
	
###每一小时重启nginx

	0 */1 * * * service nginx restart 


###晚上11点到早上7点之间,每隔一小时重启nginx 

	0 11 4 * mon-wed service nginx restart 
	
###每月的4号与每周一到周三的11点重启nginx 

	0 4 1 jan * service nginx restart 

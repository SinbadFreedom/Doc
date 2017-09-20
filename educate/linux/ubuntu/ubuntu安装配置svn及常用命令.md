ubuntu安装配置svn及常用命令
===

1 ubuntu安装svn服务
---

输入命令:

	apt-get install subversion
	
2 创建svn仓储
---

输入命令:

	mkdir -p /svn/plateform
	svnadmin create /svn/plateform
	
3 修改svn设置
---

###修改svn目录下的conf/svnserve.conf文件
去掉#[general]前面的#号

	[general]
	
###匿名访问的权限，可以是read,write,none,默认为read

	anon-access = none
	
###认证用户的权限，可以是read,write,none,默认为write

	auth-access = write
	
###密码数据库的路径，去掉前面的#

	password-db = passwd
	
4 修改svn用户名和密码
---

修改配置文件`passwd`

	[users]
	name = password
	
5 启动svn服务
---

输入命令:

	svnserve -d -r /svn/plateform

完成, 现在可以使用svn工具比如`TutorialSVN`连接svn服务器了.
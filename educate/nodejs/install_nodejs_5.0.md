Linux 安装Nodejs5.0

尝试了使用源码编译,加入ppa镜像，这两种安装方式分别遇到了不同的问题。
源码编译时升级gcc, g++到4.8以后，找不到cc命令.
ppa里面的nodejs版本比较晚

今天找到了一种很方便的安装方式,即通过nvm命令安装和切换nodejs脚本.

nvm是的github中的一个开源项目:   
   
    https://github.com/creationix/nvm

安装步骤:
1.安装nrm切换npm镜像   

    npm install -g nrm
    nrm ls
    nrm use taobao


2.下载安装nvm脚本   
       
    curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.31.0/install.sh | bash
    或      
    wget -qO- https://raw.githubusercontent.com/creationix/nvm/v0.31.0/install.sh | bash
       
3.执行脚本   
   
    source ~/.nvm/nvm.sh   
    
4.查看nodejs版本   
    
本地已安装nodejs版本      

    nvm ls
    
远端版本   

    nvm ls-remote   

5.安装nodejs版本   
To download, compile, and install the latest v5.0.x release of node, do this:
   
    nvm install 5.0
     
And then in any new shell just use the installed version:

    nvm use 5.0
       
Or you can just run it:

    nvm run 5.0 --version
       
Or, you can run any arbitrary command in a subshell with the desired version of node:

    nvm exec 4.2 node --version
       
You can also get the path to the executable to where it was installed:

    nvm which 5.04.4


经过了几番折腾，发现source每次关闭控制台就不管用了
解决办法:    
    
    vim /etc/profile    
写入:    

    source ~/.bashrc       
    source ~/.nvm/nvm.sh       
centos安装tmux及常用命令
===

1 centos安装tmux服务必需组件
---

输入命令:

    yum install libevent-devel ncurses-devel

2 下载tmux源码安装
---

输入命令:

    wget http://downloads.sourceforge.net/tmux/tmux-1.6.tar.gz
    tar zxvf tmux-1.6.tar.gz
    cd tmux-1.6
    ./configure
    make
    make install

3 相关文章
---

[tmux常用命令](http://localhost/article/linux/common/tmux常用命令及快捷键.html)   
[ubuntu安装tmux及常用命令](http://localhost/article/linux/ubuntu/ubuntu安装配置tmux及常用命令.html)    
CentOS的软件安装工具不是apt-get  是yum   

安装tmux之前需要先安装一些支持的组件:   

    yum install libevent-devel ncurses-devel   

接下来就是下载源码包进行安装了，这里要说明一点：到目前为止，tmux的最新版本是1.8，但进过我测试1.8在编译的时候会出现小小的问题，所以建议选择低一点的版本，1.6/1.7均可。   

    wget http://downloads.sourceforge.net/tmux/tmux-1.6.tar.gz
    tar zxvf tmux-1.6.tar.gz
    cd tmux-1.6
    ./configure
    make
    make install


-- 基本使用   

    tmux   # 运行 tmux -2 以256终端运行
    C-b d  # 返回主 shell ， tmux 依旧在后台运行，里面的命令也保持运行状态
    tmux ls # 显示已有tmux会话（C-b s）
    tmux attach-session -t 数字 # 选择tmux
    tmux new-session -s session-name
    tmux kill-session -t session-name
    
-- 快捷键

    tmux 的使用主要就是依靠快捷键，通过 C-b 来调用。
    C-b ?  // 显示快捷键帮助
    C-b C-o  //调换窗口位置
    C-b 空格键  //采用下一个内置布局
    C-b ! // 把当前窗口变为新窗口
    C-b  "  // 模向分隔窗口
    C-b % // 纵向分隔窗口
    C-b q // 显示分隔窗口的编号
    C-b o // 跳到下一个分隔窗口
    C-b 上下键 // 上一个及下一个分隔窗口
    C-b C-方向键 //调整分隔窗口大小
    C-b & // 确认后退出 tmux
    C-b c // 创建新窗口
    C-b 0~9 //选择几号窗口
    C-b c // 创建新窗口
    C-b n // 选择下一个窗口
    C-b l // 最后使用的窗口
    C-b p // 选择前一个窗口
    C-b w // 以菜单方式显示及选择窗口
    C-b s // 以菜单方式显示和选择会话
    C-b t //显示时钟
    C-b [ 复制(空格开始)
    C-b ] 粘贴（回车结束）
    C-b ,　给当前窗口改名
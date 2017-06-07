
下面的错误常量由 `os.constants.errno` 给出:



<table>
  <tr>
    <th>常量</th>
    <th>描述</th>
  </tr>
  <tr>
    <td><code>UV_UDP_REUSEADDR</code></td>
    <td></td>
  </tr>
</table>

[`process.arch`]: process.html#process_process_arch
[`process.platform`]: process.html#process_process_platform
[OS Constants]: #os_os_constants


> 稳定性: 2 - 稳定的

`os` 模块提供了一些操作系统相关的实用方法。可以这么引用它:

	
    const os = require('os');
	


<!-- YAML
added: v0.5.0
-->

* 返回: {String}

`os.arch()`方法返回一个字符串, 表明*Node.js 二进制编译* 所用的
操作系统CPU架构.

现在可能的值有: `'arm'`, `'arm64'`, `'ia32'`, `'mips'`,
`'mipsel'`, `'ppc'`, `'ppc64'`, `'s390'`, `'s390x'`, `'x32'`, `'x64'`,  和
`'x86'`.

等价于 [`process.arch`][].


<!-- YAML
added: v6.3.0
-->

* {Object}

返回一个包含错误码,处理信号等通用的操作系统特定常量的对象.
现在, 这些特定的常量的定义被描述在[OS Constants][].



下面的常量被`os.constants` 所输出. **注意:** 
并不是所有的常量在每一个操作系统上都是可用的.


<!-- YAML
added: v0.3.3
-->

* Returns: {Array}

`os.cpus()` 方法返回一个对象数组, 包含安装的每个CPU/CPU核的信息. 

下面的属性包含在每个对象中:

* `model` {String}
* `speed` {number} (兆赫兹为单位)
* `times` {Object}
  * `user` {number} CPU花费在用户模式下的毫秒时间数.
  * `nice` {number} CPU花费在良好模式下的毫秒时间数.
  * `sys` {number} CPU花费在系统模式下的毫秒时间数.
  * `idle` {number} CPU花费在空闲模式下的毫秒时间数.
  * `irq` {number} CPU花费在中断请求模式下的毫秒时间数.

For example:

	
    [
      {
        model: 'Intel(R) Core(TM) i7 CPU         860  @ 2.80GHz',
        speed: 2926,
        times: {
          user: 252020,
          nice: 0,
          sys: 30340,
          idle: 1070356870,
          irq: 0
        }
      },
      {
        model: 'Intel(R) Core(TM) i7 CPU         860  @ 2.80GHz',
        speed: 2926,
        times: {
          user: 306960,
          nice: 0,
          sys: 26980,
          idle: 1071569080,
          irq: 0
        }
      },
      {
        model: 'Intel(R) Core(TM) i7 CPU         860  @ 2.80GHz',
        speed: 2926,
        times: {
          user: 248450,
          nice: 0,
          sys: 21750,
          idle: 1070919370,
          irq: 0
        }
      },
      {
        model: 'Intel(R) Core(TM) i7 CPU         860  @ 2.80GHz',
        speed: 2926,
        times: {
          user: 256880,
          nice: 0,
          sys: 19430,
          idle: 1070905480,
          irq: 20
        }
      },
      {
        model: 'Intel(R) Core(TM) i7 CPU         860  @ 2.80GHz',
        speed: 2926,
        times: {
          user: 511580,
          nice: 20,
          sys: 40900,
          idle: 1070842510,
          irq: 0
        }
      },
      {
        model: 'Intel(R) Core(TM) i7 CPU         860  @ 2.80GHz',
        speed: 2926,
        times: {
          user: 291660,
          nice: 0,
          sys: 34360,
          idle: 1070888000,
          irq: 10
        }
      },
      {
        model: 'Intel(R) Core(TM) i7 CPU         860  @ 2.80GHz',
        speed: 2926,
        times: {
          user: 308260,
          nice: 0,
          sys: 55410,
          idle: 1071129970,
          irq: 880
        }
      },
      {
        model: 'Intel(R) Core(TM) i7 CPU         860  @ 2.80GHz',
        speed: 2926,
        times: {
          user: 266450,
          nice: 1480,
          sys: 34920,
          idle: 1072572010,
          irq: 30
        }
      }
    ]
	

*注意*: 因为`nice`的值是UNIX相关的, 在Windows系统上,
所有处理器的 `nice` 值总是0.


<!-- YAML
added: v0.9.4
-->

* Returns: {String}

`os.endianness()`方法返回一个字符串,表明*Node.js二进制编译环境的*字节顺序.

可能的值:

* `'BE'` 大端模式
* `'LE'` 小端模式


<!-- YAML
added: v0.7.8
-->

* {String}

一个字符串常量,定义操作系统相关的行末标志:

* `\n` 在 POSIX 系统上
* `\r\n` 在 Windows系统上


<!-- YAML
added: v0.3.3
-->

* Returns: {Integer}

`os.freemem()` 方法以整数的形式回空闲系统内存
的字节数.


<!-- YAML
added: v2.3.0
-->

* Returns: {String}

`os.homedir()` 方法以字符串的形式返回当前用户的home目录.


<!-- YAML
added: v0.3.3
-->

* Returns: {String}

`os.hostname()`方法以字符串的形式返回操作系统的主机名.


<!-- YAML
added: v0.3.3
-->

* Returns: {Array}

`os.loadavg()`方法返回一个数组,包含1, 5, 15分钟平均负载.

平均负载是系统活动的测量,由操作系统计算得出,表达为一个分数.
一般来说,平均负载应该理想地比系统的逻辑CPU的数目要少.
平均负载是UNIX相关的概念,在Windows平台上没有对应的概念.
在Windows上,其返回值总是`[0, 0, 0]`.


<!-- YAML
added: v0.6.0
-->

* Returns: {Object}

`os.networkInterfaces()`方法返回一个对象,包含只有被赋予网络地址的网络接口. 

在返回对象的每个关键词都指明了一个网络接口.

返回的值是一个对象数组, 每个都描述了赋予的网络地址.

被赋予网络地址的对象包含的属性:

* `address` {String} 被赋予的 IPv4 或 IPv6 地址
* `netmask` {String}  IPv4 或 IPv6 子网掩码
* `family` {String}  `IPv4` 或 `IPv6`
* `mac` {String} 网络接口的MAC地址
* `internal` {boolean} 如果 网络接口是loopback或相似的远程不能用的接口时,
值为`true`,否则为`false`
* `scopeid` {number} IPv6 数字领域识别码 (只有当 `family`
是`IPv6`时可用)

	
    {
      lo: [
        {
          address: '127.0.0.1',
          netmask: '255.0.0.0',
          family: 'IPv4',
          mac: '00:00:00:00:00:00',
          internal: true
        },
        {
          address: '::1',
          netmask: 'ffff:ffff:ffff:ffff:ffff:ffff:ffff:ffff',
          family: 'IPv6',
          mac: '00:00:00:00:00:00',
          internal: true
        }
      ],
      eth0: [
        {
          address: '192.168.1.108',
          netmask: '255.255.255.0',
          family: 'IPv4',
          mac: '01:02:03:0a:0b:0c',
          internal: false
        },
        {
          address: 'fe80::a00:27ff:fe4e:66a1',
          netmask: 'ffff:ffff:ffff:ffff::',
          family: 'IPv6',
          mac: '01:02:03:0a:0b:0c',
          internal: false
        }
      ]
    }
	


<!-- YAML
added: v0.5.0
-->

* Returns: {String}

`os.platform()` 方法返回一个字符串, 指定Node.js编译时的操作系统平台

当前可能的值有:

* `'aix'`
* `'darwin'`
* `'freebsd'`
* `'linux'`
* `'openbsd'`
* `'sunos'`
* `'win32'`

等价于 [`process.platform`][].

*注意*: 如果Node.js 在Android操作系统上构建, `'android'`值
可能被返回. 然而, Android支持Node.js在当前被认为是实验期.


<!-- YAML
added: v0.3.3
-->

* Returns: {String}

`os.release()`方法返回一个字符串, 指定操作系统的发行版.

*注意*: 在POSIX系统上, 操作系统发行版是通过
调用uname(3)得到的. 在 Windows系统上, 用`GetVersionExW()` . 请查看
https://en.wikipedia.org/wiki/Uname#Examples 获取更多信息.


<!-- YAML
added: v0.9.9
-->

* Returns: {String}

`os.tmpdir()`方法返回一个字符串, 表明操作系统的
默认临时文件目录.


<!-- YAML
added: v0.3.3
-->

* Returns: {Integer}

`os.totalmem()`方法以整数的形式返回所有系统内存的字节数.


<!-- YAML
added: v0.3.3
-->

* Returns: {String}

`os.type()`方法返回一个字符串,表明操作系统的名字,
由uname(3)返回.举个例子, `'Linux'` 在 Linux系统上, `'Darwin'` 在 OS X 系统上,`'Windows_NT'` 在 Windows系统上.

请查看https://en.wikipedia.org/wiki/Uname#Examples 获取其他关于在不同
操作系统上执行uname(3),得到输出的信息.


<!-- YAML
added: v0.3.3
-->

* Returns: {Integer}

`os.uptime()` 方法在几秒内返回操作系统的上线时间.

*注意*: 在 Node.js' 内部, 这个数值是用 `double` 来表示的.
然而, 小数秒数不会被返回, 因此其值通常被认为是整数.

<!-- YAML
added: v6.0.0
-->

* `options` {Object}
  * `encoding` {String} 用于解释结果字符串的字符编码.
    如果`encoding` 被设置为`'buffer'`, `username`, `shell`, 和 `homedir`
    的值将成为 `Buffer`的实例. (默认是: 'utf8')
* Returns: {Object}

`os.userInfo()`方法当前有效用户的信息 -- 在 POSIX平台上, 这通常是password 文件的子集. 返回的对象包括 `username`, `uid`, `gid`, `shell`, 和 `homedir`.
在Windows系统上, `uid` 和 `gid` 域是 `-1`, and `shell`是 `null`.

`homedir`的值由`os.userInfo()`返回, 由操作系统提供.
这区别了`os.homedir()`的结果, 它在求助操作系统响应之前,
为home目录请求几个环境变量.



<table>
  <tr>
    <th>常量</th>
    <th>描述</th>
  </tr>
  <tr>
    <td><code>E2BIG</code></td>
    <td>表明参数列表比期望的要长.</td>
  </tr>
  <tr>
    <td><code>EACCES</code></td>
    <td>表明操作没有足够的权限.</td>
  </tr>
  <tr>
    <td><code>EADDRINUSE</code></td>
    <td>表明该网络地址已经在使用.</td>
  </tr>
  <tr>
    <td><code>EADDRNOTAVAIL</code></td>
    <td>表明该网络地址当前不能使用.</td>
  </tr>
  <tr>
    <td><code>EAFNOSUPPORT</code></td>
    <td>表明该网络地址簇不被支持.</td>
  </tr>
  <tr>
    <td><code>EAGAIN</code></td>
    <td>表明当前没有可用数据,稍后再次尝试操作.</td>
  </tr>
  <tr>
    <td><code>EALREADY</code></td>
    <td>表明socket有一个即将发生的连接在进行中.</td>
  </tr>
  <tr>
    <td><code>EBADF</code></td>
    <td>表明一个文件描述符不可用.</td>
  </tr>
  <tr>
    <td><code>EBADMSG</code></td>
    <td>表明一个无效的数据信息.</td>
  </tr>
  <tr>
    <td><code>EBUSY</code></td>
    <td>表明一个设备或资源处于忙碌中.</td>
  </tr>
  <tr>
    <td><code>ECANCELED</code></td>
    <td>表明一个操作被取消.</td>
  </tr>
  <tr>
    <td><code>ECHILD</code></td>
    <td>表明没有子进程.</td>
  </tr>
  <tr>
    <td><code>ECONNABORTED</code></td>
    <td>表明网络连接已经被终止.</td>
  </tr>
  <tr>
    <td><code>ECONNREFUSED</code></td>
    <td>表明网络连接被拒绝.</td>
  </tr>
  <tr>
    <td><code>ECONNRESET</code></td>
    <td>表明网络连接被重置 .</td>
  </tr>
  <tr>
    <td><code>EDEADLK</code></td>
    <td>表明一个资源死锁已经被避免 .</td>
  </tr>
  <tr>
    <td><code>EDESTADDRREQ</code></td>
    <td>表明需要目的地址 .</td>
  </tr>
  <tr>
    <td><code>EDOM</code></td>
    <td>表明参数超过了函数的作用域 .</td>
  </tr>
  <tr>
    <td><code>EDQUOT</code></td>
    <td>表明已经超过磁盘指标 .</td>
  </tr>
  <tr>
    <td><code>EEXIST</code></td>
    <td>表明文件已经存在 .</td>
  </tr>
  <tr>
    <td><code>EFAULT</code></td>
    <td>表明一个无效的指针地址 .</td>
  </tr>
  <tr>
    <td><code>EFBIG</code></td>
    <td>表明文件太大 .</td>
  </tr>
  <tr>
    <td><code>EHOSTUNREACH</code></td>
    <td>表明主机不可达 .</td>
  </tr>
  <tr>
    <td><code>EIDRM</code></td>
    <td>表明识别码已经被移除 .</td>
  </tr>
  <tr>
    <td><code>EILSEQ</code></td>
    <td>表明一个非法的字节序 .</td>
  </tr>
  <tr>
    <td><code>EINPROGRESS</code></td>
    <td>表明一个操作已经在进行中 .</td>
  </tr>
  <tr>
    <td><code>EINTR</code></td>
    <td>表明一个函数调用被中断 .</td>
  </tr>
  <tr>
    <td><code>EINVAL</code></td>
    <td>表明提供了一个无效的参数 .</td>
  </tr>
  <tr>
    <td><code>EIO</code></td>
    <td>表明一个其他的不确定的 I/O 错误.</td>
  </tr>
  <tr>
    <td><code>EISCONN</code></td>
    <td>表明socket已经连接 .</td>
  </tr>
  <tr>
    <td><code>EISDIR</code></td>
    <td>表明路径是目录 .</td>
  </tr>
  <tr>
    <td><code>ELOOP</code></td>
    <td>表明路径上有太多层次的符号连接 .</td>
  </tr>
  <tr>
    <td><code>EMFILE</code></td>
    <td>表明有太多打开的文件 .</td>
  </tr>
  <tr>
    <td><code>EMLINK</code></td>
    <td>表明文件上有太多的硬连接 .</td>
  </tr>
  <tr>
    <td><code>EMSGSIZE</code></td>
    <td>表明提供的信息太长 .</td>
  </tr>
  <tr>
    <td><code>EMULTIHOP</code></td>
    <td>表明多跳被尝试 .</td>
  </tr>
  <tr>
    <td><code>ENAMETOOLONG</code></td>
    <td>表明文件名太长 .</td>
  </tr>
  <tr>
    <td><code>ENETDOWN</code></td>
    <td>表明网络关闭 .</td>
  </tr>
  <tr>
    <td><code>ENETRESET</code></td>
    <td>表明连接被网络终止 .</td>
  </tr>
  <tr>
    <td><code>ENETUNREACH</code></td>
    <td>表明网络不可达 .</td>
  </tr>
  <tr>
    <td><code>ENFILE</code></td>
    <td>表明系统中打开了太多的文件 .</td>
  </tr>
  <tr>
    <td><code>ENOBUFS</code></td>
    <td>表明没有有效的缓存空间 .</td>
  </tr>
  <tr>
    <td><code>ENODATA</code></td>
    <td>表明在流头读取队列上没有可用的信息 .</td>
  </tr>
  <tr>
    <td><code>ENODEV</code></td>
    <td>表明没有这样的设备 .</td>
  </tr>
  <tr>
    <td><code>ENOENT</code></td>
    <td>表明没有这样的文件或目录 .</td>
  </tr>
  <tr>
    <td><code>ENOEXEC</code></td>
    <td>表明一个执行格式错误 .</td>
  </tr>
  <tr>
    <td><code>ENOLCK</code></td>
    <td>表明没有可用的锁 .</td>
  </tr>
  <tr>
    <td><code>ENOLINK</code></td>
    <td>表明链接在服务 .</td>
  </tr>
  <tr>
    <td><code>ENOMEM</code></td>
    <td>表明没有足够的空间 .</td>
  </tr>
  <tr>
    <td><code>ENOMSG</code></td>
    <td>表明想要的数据类型没有信息 .</td>
  </tr>
  <tr>
    <td><code>ENOPROTOOPT</code></td>
    <td>表明给定的协议不可用 .</td>
  </tr>
  <tr>
    <td><code>ENOSPC</code></td>
    <td>表明该设备上没有可用的空间 .</td>
  </tr>
  <tr>
    <td><code>ENOSR</code></td>
    <td>表明没有可用的流资源 .</td>
  </tr>
  <tr>
    <td><code>ENOSTR</code></td>
    <td>表明给定的资源不是流 .</td>
  </tr>
  <tr>
    <td><code>ENOSYS</code></td>
    <td>表明功能没有被实现 .</td>
  </tr>
  <tr>
    <td><code>ENOTCONN</code></td>
    <td>表明socket没有连接 .</td>
  </tr>
  <tr>
    <td><code>ENOTDIR</code></td>
    <td>表明路径不是目录 .</td>
  </tr>
  <tr>
    <td><code>ENOTEMPTY</code></td>
    <td>表明目录是非空的 .</td>
  </tr>
  <tr>
    <td><code>ENOTSOCK</code></td>
    <td>表明给定的项目不是socket .</td>
  </tr>
  <tr>
    <td><code>ENOTSUP</code></td>
    <td>表明给定的操作不受支持 .</td>
  </tr>
  <tr>
    <td><code>ENOTTY</code></td>
    <td>表明一个不适当的 I/O 控制操作.</td>
  </tr>
  <tr>
    <td><code>ENXIO</code></td>
    <td>表明没有该设备或地址 .</td>
  </tr>
  <tr>
    <td><code>EOPNOTSUPP</code></td>
    <td>表明一个操作不被socket所支持.
    注意尽管`ENOTSUP` 和 `EOPNOTSUPP` 在Linux上有相同的值时,
    根据 POSIX.1 规范,这些错误值应该不同.)</td>
  </tr>
  <tr>
    <td><code>EOVERFLOW</code></td>
    <td>表明一个值太大以至于难以用给定的数据类型存储.</td>
  </tr>
  <tr>
    <td><code>EPERM</code></td>
    <td>表明操作没有被许可.</td>
  </tr>
  <tr>
    <td><code>EPIPE</code></td>
    <td>表明破裂的管道 .</td>
  </tr>
  <tr>
    <td><code>EPROTO</code></td>
    <td>表明协议错误 .</td>
  </tr>
  <tr>
    <td><code>EPROTONOSUPPORT</code></td>
    <td>表明一个协议不被支持 .</td>
  </tr>
  <tr>
    <td><code>EPROTOTYPE</code></td>
    <td>表明socket错误的协议类型 .</td>
  </tr>
  <tr>
    <td><code>ERANGE</code></td>
    <td>表明结果太大了 .</td>
  </tr>
  <tr>
    <td><code>EROFS</code></td>
    <td>表明该文件系统是只读的 .</td>
  </tr>
  <tr>
    <td><code>ESPIPE</code></td>
    <td>表明无效的查询操作 .</td>
  </tr>
  <tr>
    <td><code>ESRCH</code></td>
    <td>表明没有这样的进程.</td>
  </tr>
  <tr>
    <td><code>ESTALE</code></td>
    <td>表明该文件处理是稳定的 .</td>
  </tr>
  <tr>
    <td><code>ETIME</code></td>
    <td>表明一个过期的时钟 .</td>
  </tr>
  <tr>
    <td><code>ETIMEDOUT</code></td>
    <td>表明该连接超时 .</td>
  </tr>
  <tr>
    <td><code>ETXTBSY</code></td>
    <td>表明一个文本文件处于忙碌 .</td>
  </tr>
  <tr>
    <td><code>EWOULDBLOCK</code></td>
    <td>表明该操作被屏蔽 .</td>
  </tr>
  <tr>
    <td><code>EXDEV</code></td>
    <td>表明一个不合适的连接 .
  </tr>
</table>



下面的信号常量由 `os.constants.signals` 给出:

<table>
  <tr>
    <th>常量</th>
    <th>描述</th>
  </tr>
  <tr>
    <td><code>SIGHUP</code></td>
    <td>发送来表明当一个控制终端关闭或者是父进程退出.</td>
  </tr>
  <tr>
    <td><code>SIGINT</code></td>
    <td>发送来表明当一个用户期望中断一个进程时.
    (`(Ctrl+C)`).</td>
  </tr>
  <tr>
    <td><code>SIGQUIT</code></td>
    <td>发送来表明当一个用户希望终止一个进程并且执行核心转储.</td>
  </tr>
  <tr>
    <td><code>SIGILL</code></td>
    <td>发送给一个进程来通知它已经试图执行一个非法的,畸形的,未知的或特权的指令.</td>
  </tr>
  <tr>
    <td><code>SIGTRAP</code></td>
    <td>发送给一个进程当异常已经发生了.</td>
  </tr>
  <tr>
    <td><code>SIGABRT</code></td>
    <td>发送给一个进程来请求终止</td>
  </tr>
  <tr>
    <td><code>SIGIOT</code></td>
    <td><code>SIGABRT</code>的同义词</td>
  </tr>
  <tr>
    <td><code>SIGBUS</code></td>
    <td>发送给一个进程来通知它已经造成了总线错误.</td>
  </tr>
  <tr>
    <td><code>SIGFPE</code></td>
    <td>发送给一个进程来通知它已经执行了一个非法的算术操作.</td>
  </tr>
  <tr>
    <td><code>SIGKILL</code></td>
    <td>发送给一个进程来立即终止它.</td>
  </tr>
  <tr>
    <td><code>SIGUSR1</code> <code>SIGUSR2</code></td>
    <td>发送给一个进程来确定它的用户定义情况.</td>
  </tr>
  <tr>
    <td><code>SIGSEGV</code></td>
    <td>发送给一个进程来通知段错误.</td>
  </tr>
  <tr>
    <td><code>SIGPIPE</code></td>
    <td>发送给一个进程当它试图写入一个非连接的管道时.</td>
  </tr>
  <tr>
    <td><code>SIGALRM</code></td>
    <td>发送给一个进程当系统时钟消逝时.</td>
  </tr>
  <tr>
    <td><code>SIGTERM</code></td>
    <td>发送给一个进程来请求终止.</td>
  </tr>
  <tr>
    <td><code>SIGCHLD</code></td>
    <td>发送给一个进程当一个子进程终止时.</td>
  </tr>
  <tr>
    <td><code>SIGSTKFLT</code></td>
    <td>发送给一个进程来表明一个协处理器的栈错误.</td>
  </tr>
  <tr>
    <td><code>SIGCONT</code></td>
    <td>发送来通知操作系统继续一个暂停的进程.</td>
  </tr>
  <tr>
    <td><code>SIGSTOP</code></td>
    <td>发送来通知操作系统暂停一个进程.</td>
  </tr>
  <tr>
    <td><code>SIGTSTP</code></td>
    <td>发送给一个进程来请求它停止.</td>
  </tr>
  <tr>
    <td><code>SIGBREAK</code></td>
    <td>发送来表明当一个用户希望终止一个进程.</td>
  </tr>
  <tr>
    <td><code>SIGTTIN</code></td>
    <td>发送给一个进程当它在后台读取TTY时.</td>
  </tr>
  <tr>
    <td><code>SIGTTOU</code></td>
    <td>发送给一个进程当它在后台写入TTY时.</td>
  </tr>
  <tr>
    <td><code>SIGURG</code></td>
    <td>发送给一个进程当socket由紧急的数据需要读取时.</td>
  </tr>
  <tr>
    <td><code>SIGXCPU</code></td>
    <td>发送给一个进程当它超过他在CPU使用上的限制时.</td>
  </tr>
  <tr>
    <td><code>SIGXFSZ</code></td>
    <td>发送给一个进程当它文件成长的比最大允许的值还大时.</td>
  </tr>
  <tr>
    <td><code>SIGVTALRM</code></td>
    <td>发送给一个进程当一个虚拟时钟消逝时.</td>
  </tr>
  <tr>
    <td><code>SIGPROF</code></td>
    <td>发送给一个进程当一个系统时钟消逝时.</td>
  </tr>
  <tr>
    <td><code>SIGWINCH</code></td>
    <td>发送给一个进程当控制终端改变它的大小.</td>
  </tr>
  <tr>
    <td><code>SIGIO</code></td>
    <td>发送给一个进程当I/O可用时.</td>
  </tr>
  <tr>
    <td><code>SIGPOLL</code></td>
    <td><code>SIGIO</code>同义词</td>
  </tr>
  <tr>
    <td><code>SIGLOST</code></td>
    <td>发送给一个进程当文件锁丢失时.</td>
  </tr>
  <tr>
    <td><code>SIGPWR</code></td>
    <td>发送给一个进程来通知功率错误.</td>
  </tr>
  <tr>
    <td><code>SIGINFO</code></td>
    <td><code>SIGPWR</code>同义词</td>
  </tr>
  <tr>
    <td><code>SIGSYS</code></td>
    <td>发送给一个进程来通知有错误的参数.</td>
  </tr>
  <tr>
    <td><code>SIGUNUSED</code></td>
    <td><code>SIGSYS</code>的同义词</td>
  </tr>
</table>


下面的错误码与Windows系统相关:

<table>
  <tr>
    <th>常量</th>
    <th>描述</th>
  </tr>
  <tr>
    <td><code>WSAEINTR</code></td>
    <td>表明中断的函数调用 .</td>
  </tr>
  <tr>
    <td><code>WSAEBADF</code></td>
    <td>表明一个无效的文件句柄 .</td>
  </tr>
  <tr>
    <td><code>WSAEACCES</code></td>
    <td>表明权限不够完成操作 .</td>
  </tr>
  <tr>
    <td><code>WSAEFAULT</code></td>
    <td>表明无效的指针地址 .</td>
  </tr>
  <tr>
    <td><code>WSAEINVAL</code></td>
    <td>表明无效的参数被传递 .</td>
  </tr>
  <tr>
    <td><code>WSAEMFILE</code></td>
    <td>表明有太多打开的文件 .</td>
  </tr>
  <tr>
    <td><code>WSAEWOULDBLOCK</code></td>
    <td>表明资源暂时不可用 .</td>
  </tr>
  <tr>
    <td><code>WSAEINPROGRESS</code></td>
    <td>表明操作当前正在进行中 .</td>
  </tr>
  <tr>
    <td><code>WSAEALREADY</code></td>
    <td>表明操作已经在进行中 .</td>
  </tr>
  <tr>
    <td><code>WSAENOTSOCK</code></td>
    <td>表明资源不是 socket.</td>
  </tr>
  <tr>
    <td><code>WSAEDESTADDRREQ</code></td>
    <td>表明需要目的地址 .</td>
  </tr>
  <tr>
    <td><code>WSAEMSGSIZE</code></td>
    <td>表明消息太长 .</td>
  </tr>
  <tr>
    <td><code>WSAEPROTOTYPE</code></td>
    <td>表明socket协议类型错误 .</td>
  </tr>
  <tr>
    <td><code>WSAENOPROTOOPT</code></td>
    <td>表明错误的协议选项 .</td>
  </tr>
  <tr>
    <td><code>WSAEPROTONOSUPPORT</code></td>
    <td>表明协议不被支持 .</td>
  </tr>
  <tr>
    <td><code>WSAESOCKTNOSUPPORT</code></td>
    <td>表明socket类型不被支持 .</td>
  </tr>
  <tr>
    <td><code>WSAEOPNOTSUPP</code></td>
    <td>表明操作不被支持 .</td>
  </tr>
  <tr>
    <td><code>WSAEPFNOSUPPORT</code></td>
    <td>表明协议簇不被支持 .</td>
  </tr>
  <tr>
    <td><code>WSAEAFNOSUPPORT</code></td>
    <td>表明地址簇不被支持 .</td>
  </tr>
  <tr>
    <td><code>WSAEADDRINUSE</code></td>
    <td>表明网络地址已经在使用 .</td>
  </tr>
  <tr>
    <td><code>WSAEADDRNOTAVAIL</code></td>
    <td>表明网络地址不可用.</td>
  </tr>
  <tr>
    <td><code>WSAENETDOWN</code></td>
    <td>表明网络关闭 .</td>
  </tr>
  <tr>
    <td><code>WSAENETUNREACH</code></td>
    <td>表明网络不可达 .</td>
  </tr>
  <tr>
    <td><code>WSAENETRESET</code></td>
    <td>表明网络连接被重置 .</td>
  </tr>
  <tr>
    <td><code>WSAECONNABORTED</code></td>
    <td>表明连接被终止 .</td>
  </tr>
  <tr>
    <td><code>WSAECONNRESET</code></td>
    <td>表明连接被同伴重置 .</td>
  </tr>
  <tr>
    <td><code>WSAENOBUFS</code></td>
    <td>表明没有可用的缓存空间 .</td>
  </tr>
  <tr>
    <td><code>WSAEISCONN</code></td>
    <td>表明socket已经连接 .</td>
  </tr>
  <tr>
    <td><code>WSAENOTCONN</code></td>
    <td>表明socket没有连接 .</td>
  </tr>
  <tr>
    <td><code>WSAESHUTDOWN</code></td>
    <td>表明数据在socket关闭之后,不能被发送 .</td>
  </tr>
  <tr>
    <td><code>WSAETOOMANYREFS</code></td>
    <td>表明有太多的引用 .</td>
  </tr>
  <tr>
    <td><code>WSAETIMEDOUT</code></td>
    <td>表明连接超时 .</td>
  </tr>
  <tr>
    <td><code>WSAECONNREFUSED</code></td>
    <td>表明连接被拒绝 .</td>
  </tr>
  <tr>
    <td><code>WSAELOOP</code></td>
    <td>表明名字不能被翻译 .</td>
  </tr>
  <tr>
    <td><code>WSAENAMETOOLONG</code></td>
    <td>表明名字太长 .</td>
  </tr>
  <tr>
    <td><code>WSAEHOSTDOWN</code></td>
    <td>表明网络主机关闭 .</td>
  </tr>
  <tr>
    <td><code>WSAEHOSTUNREACH</code></td>
    <td>表明没有到网络主机的路由 .</td>
  </tr>
  <tr>
    <td><code>WSAENOTEMPTY</code></td>
    <td>表明目录非空 .</td>
  </tr>
  <tr>
    <td><code>WSAEPROCLIM</code></td>
    <td>表明有太多的进程 .</td>
  </tr>
  <tr>
    <td><code>WSAEUSERS</code></td>
    <td>表明已经超过用户指标 .</td>
  </tr>
  <tr>
    <td><code>WSAEDQUOT</code></td>
    <td>表明已经超过磁盘指标 .</td>
  </tr>
  <tr>
    <td><code>WSAESTALE</code></td>
    <td>表明一个稳定的文件句柄引用 .</td>
  </tr>
  <tr>
    <td><code>WSAEREMOTE</code></td>
    <td>表明项目是远程的 .</td>
  </tr>
  <tr>
    <td><code>WSASYSNOTREADY</code></td>
    <td>表明网络子系统尚未准备好 .</td>
  </tr>
  <tr>
    <td><code>WSAVERNOTSUPPORTED</code></td>
    <td>表明 winsock.dll 版本在范围之外.</td>
  </tr>
  <tr>
    <td><code>WSANOTINITIALISED</code></td>
    <td>表明成功的 WSAStartup(Windows异步socket)还没有被执行 .</td>
  </tr>
  <tr>
    <td><code>WSAEDISCON</code></td>
    <td>表明一个优雅的关机正在进行 .</td>
  </tr>
  <tr>
    <td><code>WSAENOMORE</code></td>
    <td>表明没有更多的结果 .</td>
  </tr>
  <tr>
    <td><code>WSAECANCELLED</code></td>
    <td>表明一个操作已经被取消 .</td>
  </tr>
  <tr>
    <td><code>WSAEINVALIDPROCTABLE</code></td>
    <td>表明过程调用表是无效的 .</td>
  </tr>
  <tr>
    <td><code>WSAEINVALIDPROVIDER</code></td>
    <td>表明无效的服务提供者 .</td>
  </tr>
  <tr>
    <td><code>WSAEPROVIDERFAILEDINIT</code></td>
    <td>表明服务提供者初始化失败 .</td>
  </tr>
  <tr>
    <td><code>WSASYSCALLFAILURE</code></td>
    <td>表明系统调用失败 .</td>
  </tr>
  <tr>
    <td><code>WSASERVICE_NOT_FOUND</code></td>
    <td>表明服务没有被找到 .</td>
  </tr>
  <tr>
    <td><code>WSATYPE_NOT_FOUND</code></td>
    <td>表明类类型没有被找到 .</td>
  </tr>
  <tr>
    <td><code>WSA_E_NO_MORE</code></td>
    <td>表明没有更多的结果 .</td>
  </tr>
  <tr>
    <td><code>WSA_E_CANCELLED</code></td>
    <td>表明调用被取消 .</td>
  </tr>
  <tr>
    <td><code>WSAEREFUSED</code></td>
    <td>表明数据库请求被拒绝 .</td>
  </tr>
</table>



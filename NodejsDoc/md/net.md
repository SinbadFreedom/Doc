<!-- YAML
added: v0.1.90
-->

本类用于创建TCP或本地服务器.

`net.Server` 是一个有着以下事件的[`EventEmitter`][] :

<!-- YAML
added: v0.3.4
-->

这个对象是TCP或者本地socket的一个抽象。`net.Socket`实例实现了
一个双工流接口。它们可以由用户创建用于客户端（和[`connect()`][]），
或者是由Node.js创建，用于通过一个服务器的`'connection'`事件传参给用户。



<!-- YAML
added: v0.5.0
-->

当服务器关闭时被触发。注意：如果还有连接存在的话，直到所有的连接都关闭时，这个事件才被触发。


<!-- YAML
added: v0.1.90
-->

* `had_error` {Boolean} `true` 如果socket有传输错误的话。

一旦socket完全关闭时被触发。参数`had_error`是一个布尔值，代表socket关闭是否是由于传输错误。

<!-- YAML
added: v0.1.90
-->

当socket连接完全建立时，被触发。
详细请看[`connect()`][].
<!-- YAML
added: v0.1.90
-->

* {net.Socket} 连接对象

当一个新连接建立的时候被触发。`socket`是`net.Socket`的一个实例.


<!-- YAML
added: v0.1.90
-->

* {Buffer}

当接收到数据时被触发。 参数 `data` 是 `Buffer` 或者 `String` 类型。
数据的编码由`socket.setEncoding()`设定。（查看 [Readable Stream][]一节获取更多信息）

注意：如果当`Socket`触发`'data'`事件时，没有监听器在监听，这导致 **数据可能会丢失**。


<!-- YAML
added: v0.1.90
-->

当写入缓存为空时被触发。可以被用于降速上传。

查看：`socket.write()`的返回值。



<!-- YAML
added: v0.1.90
-->

当socket连接的另一端发出FIN包时被触发。

默认情况下(`allowHalfOpen == false`)，socket连接一旦将要写完写队列，就会破坏
它的文件描述器。然而，通过设置`allowHalfOpen == true`，socket将不会自动的结束它
这一端，并且允许用户写入任意大小的数据，并且附加说明用户需要手动的调用`end()`在他们那一端。



<!-- YAML
added: v0.1.90
-->

* {Error}

当错误发生时触发。
不像 [`net.Socket`]，[`'close'`] 事件不会紧接该事件触发，除非 [`server.close()`] 被手动调用。
可在 [`server.listen()`] 的讨论中查看相关例子。


<!-- YAML
added: v0.1.90
-->

* {Error}

当错误发生时被触发。`'close'`事件将在之后被直接触发。


<!-- YAML
added: v0.1.90
-->

当调用`server.listen`后，服务器被绑定时触发.


<!-- YAML
added: v0.11.3
-->

在解析域名之后，进行连接之前被触发。 
不能用于UNIX sockets. 

* `err` {Error|Null} 错误对象.  查看 [`dns.lookup()`][].
* `address` {String} IP地址.
* `family` {String|Null} IP地址类型.  See [`dns.lookup()`][].
* `host` {String} 域名.


<!-- YAML
added: v0.1.90
-->

当socket在不活动中超时时被触发。这仅仅表明socket已经处于关闭中，用户需要手动关闭连接。 

查看更多: [`socket.setTimeout()`][]



> 稳定性: 2 - 稳定的

`net` 模块给你提供了一个异步的网络封装. 它包含创建服务器和客户端（称为流）的功能。你可以这样使用这个模块 `require('net');`.


<!-- YAML
added: v0.7.0
-->

一个生产器函数，将返回一个新的 [`net.Socket`][] 并且自动的根据所提供的`options` 参数进行连接。

options参数将被传递到[`net.Socket`][]构造函数和[`socket.connect`][]方法两个地方。

`connectListener`参数将一次被用作监听器来监听[`'connect'`][]事件。

下面有一个例子来阐述之前描述过的响应服务器的客户端的用法

	
    const net = require('net');
    const client = net.connect({port: 8124}, () => {
      // 'connect' listener
      console.log('connected to server!');
      client.write('world!\r\n');
    });
    client.on('data', (data) => {
      console.log(data.toString());
      client.end();
    });
    client.on('end', () => {
      console.log('disconnected from server');
    });
	

为了连接`/tmp/echo.sock`的socket，第二行应改为

	
    const client = net.connect({path: '/tmp/echo.sock'});
	


<!-- YAML
added: v0.1.90
-->

一个生成器函数，返回一个新的 Unix [`net.Socket`][] 并且自动的
连接到所提供的`path`参数.

`connectListener`参数将一次被用作监听器来监听[`'connect'`][]事件。



<!-- YAML
added: v0.1.90
-->

一个生成器函数，返回一个新的 Unix [`net.Socket`][] 并且自动的
连接到所提供的 `port`和`host`参数.

如果`host`被省略，`'localhost'` 将被默认使用。

`connectListener`参数将一次被用作监听器来监听[`'connect'`][]事件。



<!-- YAML
added: v0.1.90
-->

一个生产器函数，将返回一个新的 [`net.Socket`][] 并且自动的根据所提供的`options` 参数进行连接。

options参数将被传递到[`net.Socket`][]构造函数和[`socket.connect`][]方法两个地方。

在socket创建之后，连接建立之前，传递`timeout`作为参数将调用[`socket.setTimeout()`][]。

`connectListener`参数将一次被用作监听器来监听[`'connect'`][]事件。

Following is an example of a client of the echo server described
in the [`net.createServer()`][] section:

	
    const net = require('net');
    const client = net.createConnection({port: 8124}, () => {
      //'connect' listener
      console.log('connected to server!');
      client.write('world!\r\n');
    });
    client.on('data', (data) => {
      console.log(data.toString());
      client.end();
    });
    client.on('end', () => {
      console.log('disconnected from server');
    });
	

为了连接`/tmp/echo.sock`的socket，第二行应改为

	
    const client = net.connect({path: '/tmp/echo.sock'});
	


<!-- YAML
added: v0.1.90
-->

一个生成器函数，返回一个新的 Unix [`net.Socket`][] 并且自动的
连接到所提供的`path`参数.

`connectListener`参数将一次被用作监听器来监听[`'connect'`][]事件。


<!-- YAML
added: v0.1.90
-->

一个生成器函数，返回一个新的 Unix [`net.Socket`][] 并且自动的
连接到所提供的 `port`和`host`参数.

如果`host`被省略，`'localhost'` 将被默认使用。

`connectListener`参数将一次被用作监听器来监听[`'connect'`][]事件。

<!-- YAML
added: v0.5.0
-->

创建一个新的服务器。`connectionListener` 参数将一次被用作监听器来监听[`'connection'`][]事件。

`options` 是一个对象，有以下默认属性:

	
    {
      allowHalfOpen: false,
      pauseOnConnect: false
    }
	

如果 `allowHalfOpen` 是 `true`, 那么socket不会自动的发送一个FIN包，即使socket的另一端
发送了FIN包。socket变成不可读但是可写的。你应该显式地调用 [`end()`][] 方法。
查看 [`'end'`][]事件获取更多信息。

如果 `pauseOnConnect` 是 `true`, 那么与每个连入的连接的socket将会暂停，
并且不能从其中读取任何数据。这允许将在进程中传递的连接不会被原始进程读取数据。 
为了从暂停的socket中开始读取数据，调用[`resume()`][].

下面有关于响应服务器的一个例子，监听连接的8124端口。

	
    const net = require('net');
    const server = net.createServer((c) => {
      // 'connection' listener
      console.log('client connected');
      c.on('end', () => {
        console.log('client disconnected');
      });
      c.write('hello\r\n');
      c.pipe(c);
    });
    server.on('error', (err) => {
      throw err;
    });
    server.listen(8124, () => {
      console.log('server bound');
    });
	

通过`telnet`来进行测试:

	
    $ telnet localhost 8124
	

为了监听 `/tmp/echo.sock`socket，从倒数第三行起，应改为

	
    server.listen('/tmp/echo.sock', () => {
      console.log('server bound');
    });
	

用`nc` 来连接UNIX域socket服务器:

	
    $ nc -U /tmp/echo.sock
	


<!-- YAML
added: v0.3.0
-->

如果输入是IPv4地址的话，返回true, 否则返回false。



<!-- YAML
added: v0.3.0
-->
如果输入是IPv6地址的话，返回true, 否则返回false。


<!-- YAML
added: v0.3.0
-->

测试输入是否是IP地址。如果是非法字符串，返回0；
如果是IPv4地址，返回4，如果是IPv6地址，返回6.



<!-- YAML
added: v0.3.4
-->

构造一个新的socket对象。

`options` 是一个对象，有着以下默认值:

	
    {
      fd: null,
      allowHalfOpen: false,
      readable: false,
      writable: false
    }
	

`fd` 允许你指定socket的存在的文件描述器。
设定 `readable` 和/或 `writable` 为 `true` 来允许在这个socket上进行读和/或写。
(注意: 只有当 `fd` 被传参时，才工作).
关于 `allowHalfOpen`, 请参照 [`net.createServer()`] 和 [`'end'`] 事件.

`net.Socket` 是 [`EventEmitter`][] 实例，有以下事件:


<!-- YAML
added: v0.1.90
-->

操作系统返回绑定的服务器的IP地址， IP地址协议簇，端口号 .
当查看一个系统赋予的IP地址时，有利于发现被分配给了哪个端口号。
返回对象的以下属性`port`, `family`, and `address` :
`{ port: 12346, family: 'IPv4', address: '127.0.0.1' }`

例子:

	
    const server = net.createServer((socket) => {
      socket.end('goodbye\n');
    }).on('error', (err) => {
      // handle errors here
      throw err;
    });
    
    // grab a random port.
    server.listen(() => {
      console.log('opened server on', server.address());
    });
	

直到`'listening'` 事件被触发后，才可以调用`server.address()` .


<!-- YAML
added: v0.1.90
-->

使服务器停止接受新连接，只保持现存的连接。这个函数是异步的，当所有连接
断开时，服务器关闭并且发出[`'close'`][]事件。一旦`'close'`事件发生，可选的
`callback`参数将被调用。不像`'close'`事件一样，它将在错误之后被调用，因为
它唯一的缘由是服务器还没打开呢，就被关闭。

<!-- YAML
added: v0.2.0
deprecated: v0.9.7
-->

> 稳定性: 0 - 废弃的: 使用 [`server.getConnections()`] 代替。

服务器上现在同时存在的连接的数目.

当用[`child_process.fork()`][]向一个子进程发出socket连接时，这将变成`null`。
当poll新进程和获取活着的连接的数目时，可以用异步的`server.getConnections` 代替.


<!-- YAML
added: v0.9.7
-->

异步的获取服务器当前共同存在的连接的数目。
当sockets被发送forks时工作。

Callback参数可以是`err` 或者 `count`。


<!-- YAML
added: v5.7.0
-->

一个布尔值，代表服务器是否在监听连接。


<!-- YAML
added: v0.5.10
-->

* `handle` {Object}
* `backlog` {Number}
* `callback` {Function}

`handle` 对象可以被设置为服务器或者是socket（任何有着下标`_handle`属性的对象）, 或者一个 `{fd: <n>}` 对象.

这可能会导致服务器在特定的handle上接受连接，
但是它被认为文件描述器或者处理器已经被绑定到一个端口或者socket域上。

Windows系统不支持监听文件描述器。

这个函数是异步的。当服务器已经被绑定时，
[`'listening'`][] 事件将被触发.
最后一个参数`callback`将被添加为 [`'listening'`][]事件的一个监听器 .

`backlog` 参数表现的同
[`server.listen([port][, hostname][, backlog][, callback])`][`server.listen(port, host, backlog, callback)`]一样.


<!-- YAML
added: v0.11.14
-->

* `options` {Object} - 必须. 支持以下参数：
  * `port` {Number} - 可选.
  * `host` {String} - 可选.
  * `backlog` {Number} - 可选.
  * `path` {String} - 可选.
  * `exclusive` {Boolean} - 可选.
* `callback` {Function} - 可选.

`port`, `host`, 和 `backlog` 是 `options` 的参数,
可选的 callback 函数, 表现的好像它们在调用
[`server.listen([port][, hostname][, backlog][, callback])`][`server.listen(port, host, backlog, callback)`].
另外,  `path` 参数可以用于确定UNIX套接字。

如果 `exclusive` 是 `false` (默认), 那么cluster的worker对象将利用相同的基础处理方法，
允许共享连接处理机制。当`exclusive` 是 `true`, 处理方法不被共享，企图共享端口将导致错误。
下面是一个监听专用端口的例子：

	
    server.listen({
      host: 'localhost',
      port: 80,
      exclusive: true
    });
	

*注意*: `server.listen()` 方法可能被多次调用. 每个随后的
调用将利用提供的参数 *重新打开* 服务器。


<!-- YAML
added: v0.1.90
-->

* `path` {String}
* `backlog` {Number}
* `callback` {Function}

在给定的`path`路径上，开启一个监听连接的本地socket服务器。


这个函数是异步的. 当服务器被已经绑定时[`'listening'`][] 事件将被触发。最后一个参数
`callback` 将被添加为[`'listening'`][]事件的监听器.

在UNIX上, 本地域通常被称为UNIX域. 路径是文件系统路径名。
它被截断至`sizeof(sockaddr_un.sun_path)`个字节，减去一。
它根据操作系统的不同，在91和107个字节之间变动。典型的值为在Linux上
为107，在OS X上为103.路径遵循相同的命名规则和权限检查，这会在文件生成的时候进行，
可以在文件系统中可视，并且*直到不连接的时候才被允许*。

在Windows系统上，本地域用具名管道实现。路径*必须*是`\\?\pipe\`或`\\.\pipe\`的入口。
任何字符都是允许的，但是有一些处理可能会影响管道的名字，例如解析`..`序列。
无论表现如何，管道命名空间是平的。管道*不允许*被移除，当他们的最后一个引用被关闭的时候。
不要忘记JavaScript字符串转义需要路径用双斜线，例如

	
    net.createServer().listen(
        path.join('\\\\?\\pipe', process.cwd(), 'myctl'));
	

`backlog`参数表现地跟
[`server.listen([port][, hostname][, backlog][, callback])`][`server.listen(port, host, backlog, callback)`]一样。

*注意*: `server.listen()`方法可以被多次调用。每个随后的调用将
用提供的参数*重新打开*服务器.


<!-- YAML
added: v0.1.90
-->

在特定的`port`和`hostname`开始接受连接. 如果`hostname`被省略，当IPv6可用的时候，服务器将
接受所有的IPv6地址(`::`)或者所有的 IPv4 地址 (`0.0.0.0`)。省略端口参数，或者用的端口值为`0`，
将被操作系统赋予一个任意的端口，这可以在`'listening'`事件被触发后，用`server.address().port`
来获取。

Backlog 是等待连接的队列长度的最大值。实际的长度在Linux上将由操作系统通过系统设置如
`tcp_max_syn_backlog` 和 `somaxconn` 来确定。默认值为511（而不是512）。

这个函数是异步的。网服务器被绑定时，[`'listening'`][]事件被触发。最后一个参数，
`callback`将被加做[`'listening'`][]事件的监听器。

一些用户运行的一个问题是得到`EADDRINUSE`错误。这意味这另一个服务器已经运行在请求的端口。
处理这个问题的一个方式是等待一秒再次尝试运行：

	
    server.on('error', (e) => {
      if (e.code == 'EADDRINUSE') {
        console.log('Address in use, retrying...');
        setTimeout(() => {
          server.close();
          server.listen(PORT, HOST);
        }, 1000);
      }
    });
	

(注意: Node.js中所有的socket都被设置为`SO_REUSEADDR`.)

*注意*: `server.listen()`方法可以被多次调用。每个随后的调用将
用提供的参数*重新打开*服务器.


<!-- YAML
added: v0.2.0
-->

设定这个属性，当服务器的连接超过此值时，新的连接将被拒绝。

一旦连接已经用[`child_process.fork()`][]被发送到子进程时，它不被推荐使用。


<!-- YAML
added: v0.9.1
-->

与`unref`相反, 在一个原先是`unref`的服务器上调用 `ref` 将*不会*允许程序退出 
即使它是唯一剩下的服务器（默认行为）。如果服务器已经是`ref`的了，再次调用`ref`将
不会产生效果。

返回`server`.


<!-- YAML
added: v0.9.1
-->

在服务器上调用 `unref`将允许程序当这是事件系统中唯一存活的服务器时退出。
如果服务器已经是`unref`，再次调用`unref`没有任何效应.

返回`server`.


<!-- YAML
added: v0.1.90
-->

返回操作系统报告的绑定的socket的IP地址，IP地址族和端口。
返回有着以下三个属性的对象，例如
`{ port: 12346, family: 'IPv4', address: '127.0.0.1' }`


<!-- YAML
added: v0.3.8
-->

`net.Socket` 有这样的一个性质，即 `socket.write()` 总是在运行。这是为了帮助用户运行地更快。
计算机不能总是保持一定量的数据写入socket--网络连接肯能会变慢。Node.js将内部的把要写入socket的
数据排队，然后在可能的时候将之通过网络发出。(在内部，它在socket文件描述器上轮询，等待可写）

这样内部缓存的结果是使用的内存将增长。这个性质表明了当前缓存的等待被发送的字符的数量。
（字符的数量近似与等待被写的字节的数目，但是缓存中可能包含字符串，字符串是懒散编码的，
因此字节的确切的数目是未知的）

体验过大的或增长的`bufferSize`的用户应该在他们的程序中试图用[`pause()`][]和[`resume()`][]
"限制" 数据的增长。


<!-- YAML
added: v0.5.3
-->

收到的字节的数量.


<!-- YAML
added: v0.5.3
-->

发送的字节的数量.


<!-- YAML
added: v6.1.0
-->

如果是 `true` - [`socket.connect(options[, connectListener])`][`socket.connect(options, connectListener)`] 被调用，
并且还没有完成。 在触发`connect`事件和/或调用[`socket.connect(options[, connectListener])`][`socket.connect(options, connectListener)`]
的回调函数之前，将被设置为`false` 。
<!-- YAML
added: v0.1.90
-->

根据给定的socket参数，打开连接.

对于TCP socket, `options`参数应该是一个对象，它确定了:

  - `port`: 客户端应该连接的端口(必须).

  - `host`: 客户端应该连接的host主机. 默认为`'localhost'`.

  - `localAddress`: 为了网络连接应该绑定的本地接口。

  - `localPort`: 为了网络连接应该绑定的本地端口.

  - `family` : IP地址族的.默认为 `4`.

  - `hints`: [`dns.lookup()` hints][]. 默认为 `0`.

  - `lookup` : 可定制查询函数. 默认为 `dns.lookup`.

对于本地域socket, `options` 参数 应当是一个参数，它确定了:

  - `path`: 客户端应该连接的路径 (必须).

正常地，这个方法不是必要的，因为`net.createConnection`打开了socket。 
如果你要实现自己定制的socket才用这个方法。

这个函数是异步的。当[`'connect'`][]事件被触发时，socket已经建立。
如果有一个问题连接，`'connect'`事件将不会被触发，有异常的[`'error'`][]事件
将被触发。

`connectListener`参数将被添加为[`'connect'`][]事件的监听器。



<!-- YAML
added: v0.1.90
-->

作为[`socket.connect(options[, connectListener])`][`socket.connect(options, connectListener)`],
options参数有`{port: port, host: host}` 或者 `{path: path}`.



一个布尔值，表明连接是否被破坏。一旦连接被破坏，
就没有数据可以用它来传输。
<!-- YAML
added: v0.1.90
-->

确保没有更多的I/O操作在这个socket上。只有必要的以防出错（解析错误等等）。

如果`exception`被指定，[`'error'`][]将被触发并且，任何监听此事件的监听器都会收到
`exception`为参数。

<!-- YAML
added: v0.1.90
-->

半关闭socket. 即它将发送一个FIN包. 服务器仍然可能发送一些数据。

如果`data`是指定的，它等价于调用`socket.write(data, encoding)`，
之后在调用`socket.end()`.

<!-- YAML
added: v0.9.6
-->

远程客户端连接的本地IP地址的字符串表示。 例如, 如果你监听`'0.0.0.0'` 而客户端连接的是
`'192.168.1.1'`, 最后的值是 `'192.168.1.1'`.


<!-- YAML
added: v0.9.6
-->

本地端口的数字表示. 例如,
`80` 或者 `21`.



暂停读取数据。意味着, [`'data'`][] 事件将不会被触发.
对上传进行限制时有用.


<!-- YAML
added: v0.9.1
-->

与`unref`相反, 在一个原先是`unref`的socket上调用 `ref` 将*不会*允许程序退出 
即使它是唯一剩下的socket（默认行为）。如果socket已经是`ref`的了，再次调用`ref`将
不会产生效果。

返回`socket`.

 
<!-- YAML
added: v0.5.10
-->

远程IP地址的字符串表示. 例如,
`'74.125.127.100'` 或者 `'2001:4860:a005::68'`. 如果socket
被破坏掉的话（比如，客户端失去连接），值可能是`undefined`.


<!-- YAML
added: v0.11.14
-->

远程IP地址簇的字符串表示. `'IPv4'` 或 `'IPv6'`.


<!-- YAML
added: v0.5.10
-->

远程端口的数字表示.例如,
`80` or `21`.



在调用[`pause()`][]之后恢复读取.


<!-- YAML
added: v0.1.90
-->

把socket的编码设置为[Readable Stream][]. 查看
[`stream.setEncoding()`][] 获取更多信息.


<!-- YAML
added: v0.1.92
-->

允许/禁止keep-alive功能, 并且可选地在第一个keep-alive探针发送到空闲的socket上
之前，设置初始时延。
`enable`默认是`false`.

设置 `initialDelay`(毫秒)来设置在最后一个包收到之后和第一个keep-alive探针之前
的时延。设置初始时延为0将不改变默认设置的值。值默认为0.

返回 `socket`.


<!-- YAML
added: v0.1.90
-->

禁止Nagele算法。默认TCP连接使用Nagle算法，它们在发送数据之前先缓存。
设置`noDelay`为`true`将在`socket.write()`每次被调用时，立即发送数据。
`noDelay` 默认为 `true`.

返回 `socket`.


<!-- YAML
added: v0.1.90
-->

在不活动的socket`timeout`几毫秒之后，设置socket为超时。
默认，`net.Socket`没有超时。

当一个空闲的超时被触发时，socket将收到[`'timeout'`][]事件，但是连接并不会停止。
用户必须手动的[`end()`][]或者[`destroy()`][]这个socket。

如果`timeout`的值为0，那么存在的空闲的超时将被禁止。


可选的`callback`参数将被添加为[`'timeout'`][]事件的一次行监听器。

返回`socket`.


<!-- YAML
added: v0.9.1
-->

在socket上调用 `unref`将允许程序当这是事件系统中唯一存活的socket时退出。
如果socket已经是`unref`，再次调用`unref`没有任何效应.

返回 `socket`.


<!-- YAML
added: v0.1.90
-->

在socket上发送数据。第二个参数制定字符串的编码格式--默认是UTF8编码。

如果全部数据被成功地清空到内核缓存，返回`true`。如果全部或部分数据在用户内存中形成队列，将
返回`false`。
当buffer再次空白时，[`'drain'`][] 事件将被触发。

当数据最终被写出时（这可能不是立即发生的），可选的`callback`参数将被执行。



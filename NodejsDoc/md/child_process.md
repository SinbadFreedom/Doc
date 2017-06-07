##创建异步进程
[`child_process.spawn()`]、[`child_process.fork()`]、[`child_process.exec()`] 和 [`child_process.execFile()`] 方法都遵循与其他 Node.js API 一样的惯用的异步编程模式。

每个方法都返回一个 [`ChildProcess`] 实例。
这些对象实现了 Node.js [`EventEmitter`] 的 API，允许父进程注册监听器函数，在子进程生命周期期间，当特定的事件发生时会调用这些函数。

[`child_process.exec()`] 和 [`child_process.execFile()`] 返回可以额外指定一个可选的 `callback` 函数，当子进程结束时会被调用。


###child.connected

* {Boolean} 调用 `child.disconnect()` 后会被设为 `false`

`child.connected` 属性表明是否仍可以从一个子进程发送和接收消息。
当 `child.connected` 为 `false` 时，则不能再发送或接收的消息。


###child.disconnect()

关闭父进程与子进程之间的 IPC 通道，一旦没有其他的连接使其保持活跃，则允许子进程正常退出。
调用该方法后，父进程和子进程上各自的 `child.connected` 和 `process.connected` 属性都会被设为 `false`，且进程之间不能再传递消息。

当正在接收的进程中没有消息时，就会触发 `'disconnect'` 事件。
这经常在调用 `child.disconnect()` 后立即被触发。

注意，当子进程是一个 Node.js 实例时（例如通过 [`child_process.fork()`] 衍生的），可以在子进程内调用 `process.disconnect()` 方法来关闭 IPC 通道。


###child.kill([signal])

* `signal` {String}

`child.kill()` 方法向子进程发送一个信号。
如果没有给定参数，则进程会发送 `'SIGTERM'` 信号。
查看 signal(7) 了解可用的信号列表。

	
    const spawn = require('child_process').spawn;
    const grep = spawn('grep', ['ssh']);
    
    grep.on('close', (code, signal) => {
      console.log(`子进程收到信号 ${signal} 而终止`);
    });
    
    // 发送 SIGHUP 到进程
    grep.kill('SIGHUP');
	

如果信号没有被送达，[`ChildProcess`] 对象可能会触发一个 [`'error'`] 事件。
向一个已经退出的子进程发送信号不是一个错误，但可能有无法预知的后果。
特别是，如果进程的 PID 已经重新分配给其他进程，则信号会被发送到该进程，从而可能有意想不到的结果。

注意，当函数被调用 `kill` 时，已发送到子进程的信号可能没有实际终止该进程。

详见 kill(2)。

注意：在 Linux 上，当试图杀死父进程时，子进程的子进程不会被终止。
这有可能发生在当在一个 shell 中运行一个新进程时，或使用 `ChildProcess` 中的 `shell` 选项时，例如：

	
    'use strict';
    const spawn = require('child_process').spawn;
    
    const child = spawn('sh', ['-c',
      `node -e "setInterval(() => {
          console.log(process.pid, 'is alive')
        }, 500);"`
      ], {
        stdio: ['inherit', 'inherit', 'inherit']
      });
    
    setTimeout(() => {
      child.kill(); // 不会终止 shell 中的 node 进程
    }, 2000);
	


###child.pid

* {Number} 整数

返回子进程的进程标识（PID）。

例子：

	
    const spawn = require('child_process').spawn;
    const grep = spawn('grep', ['ssh']);
    
    console.log(`衍生的子进程的 pid：${grep.pid}`);
    grep.stdin.end();
	


#child_process (子进程)
> 稳定性: 2 - 稳定的

`child_process` 模块提供了衍生子进程的能力，它与 popen(3) 类似，但不完全相同。
这个能力主要由 [`child_process.spawn()`] 函数提供：

	
    const spawn = require('child_process').spawn;
    const ls = spawn('ls', ['-lh', '/usr']);
    
    ls.stdout.on('data', (data) => {
      console.log(`stdout: ${data}`);
    });
    
    ls.stderr.on('data', (data) => {
      console.log(`stderr: ${data}`);
    });
    
    ls.on('close', (code) => {
      console.log(`子进程退出码：${code}`);
    });
	

默认情况下，在 Node.js 的父进程和衍生的子进程之间会建立 `stdin`、`stdout` 和 `stderr` 的管道。
这使得数据可以以非阻塞的方式在这些管道流通。
注意，有些程序会在内部使用行缓冲 I/O。
虽然这并不影响 Node.js，但这意味着发送到子过程的数据可能无法被立即消费。

[`child_process.spawn()`] 方法会异步地衍生子进程，且不会阻塞 Node.js 的事件循环。
[`child_process.spawnSync()`] 函数则以同步的方式提供了同样的功能，但会阻塞事件循环，直到衍生的子进程退出或终止。

为了方便起见，`child_process` 模块提供了一些同步和异步的替代方法用于  [`child_process.spawn()`] 和 [`child_process.spawnSync()`]。
注意，每个替代方法都是在 [`child_process.spawn()`] 或 [`child_process.spawnSync()`] 的基础上实现的。


  * [`child_process.exec()`]: 衍生一个 shell 并在 shell 上运行一个命令，当完成时会传入 `stdout` 和 `stderr` 到一个回调。
  * [`child_process.execFile()`]: 和  [`child_process.exec()`] 类似，除了它直接衍生命令，且不用先衍生一个 shell。
  * [`child_process.fork()`]: 衍生一个新的 Node.js 进程，并通过建立一个允许父进程和子进程之间相互发送信息的 IPC 通讯通道来调用一个指定的模块。
  * [`child_process.execSync()`]: [`child_process.exec()`] 的一个同步版本，它会阻塞 Node.js 的事件循环。
  * [`child_process.execFileSync()`]: [`child_process.execFile()`] 的一个同步版本，它会阻塞 Node.js 的事件循环。

对于某些用例，如自动化的 shell 脚本，[同步的版本]可能更方便。
大多数情况下，同步的方法会显著地影响性能，因为它拖延了事件循环直到衍生进程完成。


####hild_process.execFileSync(file[, args][, options])

* `file` {String} 要运行的可执行文件的名称或路径
* `args` {Array} 字符串参数列表
* `options` {Object}
  * `cwd` {String} 子进程的当前工作目录
  * `input` {String|Buffer} 要作为 stdin 传给衍生进程的值
    - 提供该值会覆盖 `stdio[0]`
  * `stdio` {String | Array} 子进程的 stdio 配置。（默认: `'pipe'`）
    - `stderr` 默认会输出到父进程中的 stderr，除非指定了 `stdio`
  * `env` {Object} 环境变量键值对
  * `uid` {Number} 设置该进程的用户标识。（详见 setuid(2)）
  * `gid` {Number} 设置该进程的组标识。（详见 setgid(2)）
  * `timeout` {Number} 进程允许运行的最大时间数，以毫秒为单位。（默认: `undefined`）
  * `killSignal` {String|Integer} 当衍生进程将被杀死时要使用的信号值。（默认: `'SIGTERM'`）
  * [`maxBuffer`] {Number} stdout 或 stderr 允许的最大数据量（以字节为单位）。
    如果超过限制，则子进程会被终止
  * `encoding` {String} 用于所有 stdio 输入和输出的编码。（默认: `'buffer'`）
* 返回: {Buffer|String} 该命令的 stdout

`child_process.execFileSync()` 方法与 [`child_process.execFile()`] 基本相同，除了该方法直到子进程完全关闭后才返回。
当遇到超时且发送了 `killSignal` 时，则该方法直到进程完全退出后才返回结果。
注意，如果子进程拦截并处理了 `SIGTERM` 信号且没有退出，则父进程会一直等待直到子进程退出。

如果进程超时，或有一个非零的退出码，则该方法会抛出错误。
[`Error`] 对象会包含从 [`child_process.spawnSync()`] 返回的整个结果。


###child_process.execFile(file[, args][, options][, callback])

* `file` {String} 要运行的可执行文件的名称或路径
* `args` {Array} 字符串参数列表
* `options` {Object}
  * `cwd` {String} 子进程的当前工作目录
  * `env` {Object} 环境变量键值对
  * `encoding` {String} （默认: `'utf8'`）
  * `timeout` {Number} （默认: `0`）
  * [`maxBuffer`] {Number} stdout 或 stderr 允许的最大数据量（以字节为单位）。
    如果超过限制，则子进程会被终止。（默认：`200*1024`）
  * `killSignal` {String|Integer} （默认: `'SIGTERM'`）
  * `uid` {Number} 设置该进程的用户标识。（详见 setuid(2)）
  * `gid` {Number} 设置该进程的组标识。（详见 setgid(2)）
* `callback` {Function} 当进程终止时调用，并带上输出。
  * `error` {Error}
  * `stdout` {String|Buffer}
  * `stderr` {String|Buffer}
* 返回: {ChildProcess}

`child_process.execFile()` 函数类似 [`child_process.exec()`]，除了不衍生一个 shell。
而是，指定的可执行的 `file` 被直接衍生为一个新进程，这使得它比 [`child_process.exec()`] 更高效。

它支持和 [`child_process.exec()`] 一样的选项。
由于没有衍生 shell，因此不支持像 I/O 重定向和文件查找这样的行为。

	
    const execFile = require('child_process').execFile;
    const child = execFile('node', ['--version'], (error, stdout, stderr) => {
      if (error) {
        throw error;
      }
      console.log(stdout);
    });
	

传给回调的 `stdout` 和 `stderr` 参数会包含子进程的 stdout 和 stderr 的输出。
默认情况下，Node.js 会解码输出为 UTF-8，并将字符串传给回调。
`encoding` 选项可用于指定用于解码 stdout 和 stderr 输出的字符编码。
如果 `encoding` 是 `'buffer'`、或一个无法识别的字符编码，则传入 `Buffer` 对象到回调函数。


####hild_process.execSync(command[, options])

* `command` {String} 要运行的命令
* `options` {Object}
  * `cwd` {String} 子进程的当前工作目录
  * `input` {String|Buffer} 要作为 stdin 传给衍生进程的值
    - 提供该值会覆盖 `stdio[0]`
  * `stdio` {String | Array} 子进程的 stdio 配置。（默认: `'pipe'`）
    - `stderr` 默认会输出到父进程中的 stderr，除非指定了 `stdio`
  * `env` {Object} 环境变量键值对
  * `shell` {String} 用于执行命令的 shell
    （默认：在 UNIX 上为 `'/bin/sh'`，在 Windows 上为 `'cmd.exe'`。
    该 shell 应该能够理解 UNIX 的 `-c` 开关或 Windows 的 `/s /c` 开关。
    在 Windows 中，命令行的解析应与 `cmd.exe` 兼容。）
  * `uid` {Number} 设置该进程的用户标识。（详见 setuid(2)）
  * `gid` {Number} 设置该进程的组标识。（详见 setgid(2)）
  * `timeout` {Number} 进程允许运行的最大时间数，以毫秒为单位。（默认: `undefined`）
  * `killSignal` {String|Integer} 当衍生进程将被杀死时要使用的信号值。（默认: `'SIGTERM'`）
  * [`maxBuffer`][] {Number} stdout 或 stderr 允许的最大数据量（以字节为单位）。
    如果超过限制，则子进程会被终止
  * `encoding` {String} 用于所有 stdio 输入和输出的编码。（默认: `'buffer'`）
* 返回: {Buffer|String} 该命令的 stdout

`child_process.execSync()` 方法与 [`child_process.exec()`] 基本相同，除了该方法直到子进程完全关闭后才返回。
当遇到超时且发送了 `killSignal` 时，则该方法直到进程完全退出后才返回结果。
注意，如果子进程拦截并处理了 `SIGTERM` 信号且没有退出，则父进程会一直等待直到子进程退出。

如果进程超时，或有一个非零的退出码，则该方法会抛出错误。
[`Error`] 对象会包含从 [`child_process.spawnSync()`] 返回的整个结果。

注意：不要把未经检查的用户输入传入到该函数。
任何包括 shell 元字符的输入都可被用于触发任何命令的执行。


###child_process.exec(command[, options][, callback])

* `command` {String} 要运行的命令，用空格分隔参数
* `options` {Object}
  * `cwd` {String} 子进程的当前工作目录
  * `env` {Object} 环境变量键值对
  * `encoding` {String} （默认: `'utf8'`）
  * `shell` {String} 用于执行命令的 shell
    （默认：在 UNIX 上为 `'/bin/sh'`，在 Windows 上为 `'cmd.exe'`。
    该 shell 应该能够理解 UNIX 的 `-c` 开关或 Windows 的 `/s /c` 开关。
    在 Windows 中，命令行的解析应与 `cmd.exe` 兼容。）
  * `timeout` {Number} （默认: `0`）
  * [`maxBuffer`] {Number} stdout 或 stderr 允许的最大数据量（以字节为单位）。
    如果超过限制，则子进程会被终止。（默认：`200*1024`）
  * `killSignal` {String|Integer} （默认: `'SIGTERM'`）
  * `uid` {Number} 设置该进程的用户标识。（详见 setuid(2)）
  * `gid` {Number} 设置该进程的组标识。（详见 setgid(2)）
* `callback` {Function} 当进程终止时调用，并带上输出。
  * `error` {Error}
  * `stdout` {String|Buffer}
  * `stderr` {String|Buffer}
* 返回: {ChildProcess}

衍生一个 shell，然后在 shell 中执行 `command`，且缓冲任何产生的输出。

注意：不要把未经检查的用户输入传入到该函数。
任何包括 shell 元字符的输入都可被用于触发任何命令的执行。

	
    const exec = require('child_process').exec;
    exec('cat *.js bad_file | wc -l', (error, stdout, stderr) => {
      if (error) {
        console.error(`exec error: ${error}`);
        return;
      }
      console.log(`stdout: ${stdout}`);
      console.log(`stderr: ${stderr}`);
    });
	

如果提供了一个 `callback` 函数，则它被调用时会带上参数 `(error, stdout, stderr)`。
当成功时，`error` 会是 `null`。
当失败时，`error` 会是一个 [`Error`] 实例。
`error.code` 属性会是子进程的退出码，`error.signal` 会被设为终止进程的信号。
除 `0` 以外的任何退出码都被认为是一个错误。

传给回调的 `stdout` 和 `stderr` 参数会包含子进程的 stdout 和 stderr 的输出。
默认情况下，Node.js 会解码输出为 UTF-8，并将字符串传给回调。
`encoding` 选项可用于指定用于解码 stdout 和 stderr 输出的字符编码。
如果 `encoding` 是 `'buffer'`、或一个无法识别的字符编码，则传入 `Buffer` 对象到回调函数。

`options` 参数可以作为第二个参数传入，用于自定义如何衍生进程。
默认的选项是：

	
    {
      encoding: 'utf8',
      timeout: 0,
      maxBuffer: 200*1024,
      killSignal: 'SIGTERM',
      cwd: null,
      env: null
    }
	

如果 `timeout` 大于 `0`，当子进程运行超过 `timeout` 毫秒时，父进程就会发送由 `killSignal` 属性标识的信号（默认为 `'SIGTERM'`）。

注意：不像 POSIX 系统调用中的 exec(3)，`child_process.exec()` 不会替换现有的进程，且使用一个 shell 来执行命令。


###child_process.fork(modulePath[, args][, options])

* `modulePath` {String} 要在子进程中运行的模块
* `args` {Array} 字符串参数列表
* `options` {Object}
  * `cwd` {String} 子进程的当前工作目录
  * `env` {Object} 环境变量键值对
  * `execPath` {String} 用来创建子进程的执行路径
  * `execArgv` {Array} 要传给执行路径的字符串参数列表
    （默认: `process.execArgv`）
  * `silent` {Boolean} 如果为 `true`，则子进程中的 stdin、 stdout 和 stderr 会被导流到父进程中，否则它们会继承自父进程，详见 [`child_process.spawn()`] 的 [`stdio`] 中的 `'pipe'` 和 `'inherit'` 选项。
    （默认: `false`）
  * `stdio` {Array} 支持 [`child_process.spawn()`] 的 [`stdio`] 选项的数组版本。
    当提供了该选项，则它会覆盖 `silent`。
    该数组必须包含一个值为 `'ipc'` 的子项，否则会抛出错误。
    例如 `[0, 1, 2, 'ipc']`。
  * `uid` {Number} 设置该进程的用户标识。（详见 setuid(2)）
  * `gid` {Number} 设置该进程的组标识。（详见 setgid(2)）
* 返回: {ChildProcess}

`child_process.fork()` 方法是 [`child_process.spawn()`] 的一个特殊情况，专门用于衍生新的 Node.js 进程。
跟 [`child_process.spawn()`] 一样返回一个 [`ChildProcess`] 对象。
返回的 [`ChildProcess`] 会有一个额外的内置的通信通道，它允许消息在父进程和子进程之间来回传递。
详见 [`child.send()`]。

衍生的 Node.js 子进程与两者之间建立的 IPC 通信信道的异常是独立于父进程的。
每个进程都有自己的内存，使用自己的 V8 实例。
由于需要额外的资源分配，因此不推荐衍生大量的 Node.js 进程。

默认情况下，`child_process.fork()` 会使用父进程中的 [`process.execPath`] 衍生新的 Node.js 实例。
`options` 对象中的 `execPath` 属性可以替换要使用的执行路径。

使用自定义的 `execPath` 启动的 Node.js 进程，会使用子进程的环境变量 `NODE_CHANNEL_FD` 中指定的文件描述符（fd）与父进程通信。
fd 上的输入和输出期望被分割成一行一行的 JSON 对象。

注意，不像 POSIX 系统回调中的 fork(2)，`child_process.fork()` 不会克隆当前进程。


####child_process.spawnSync(command[, args][, options])

* `command` {String} 要运行的命令
* `args` {Array} 字符串参数列表
* `options` {Object}
  * `cwd` {String} 子进程的当前工作目录
  * `input` {String|Buffer} 要作为 stdin 传给衍生进程的值
    - 提供该值会覆盖 `stdio[0]`
  * `stdio` {String | Array} 子进程的 stdio 配置
  * `env` {Object} 环境变量键值对
  * `uid` {Number} 设置该进程的用户标识。（详见 setuid(2)）
  * `gid` {Number} 设置该进程的组标识。（详见 setgid(2)）
  * `timeout` {Number} 进程允许运行的最大时间数，以毫秒为单位。（默认: `undefined`）
  * `killSignal` {String|Integer} 当衍生进程将被杀死时要使用的信号值。（默认: `'SIGTERM'`）
  * [`maxBuffer`][] {Number} stdout 或 stderr 允许的最大数据量（以字节为单位）。
    如果超过限制，则子进程会被终止
  * `encoding` {String} 用于所有 stdio 输入和输出的编码。（默认: `'buffer'`）
  * `shell` {Boolean|String} 如果为 `true`，则在一个 shell 中运行 `command`。
    在 UNIX 上使用 `'/bin/sh'`，在 Windows 上使用 `'cmd.exe'`。
    一个不同的 shell 可以被指定为字符串。
    该 shell 应该理解 UNIX 上的 `-c` 开关、或 Windows 的 `/s /c`。
    默认为 `false`（没有 shell）。
* 返回: {Object}
  * `pid` {Number} 子进程的 pid
  * `output` {Array} stdio 输出返回的结果数组
  * `stdout` {Buffer|String} `output[1]` 的内容 
  * `stderr` {Buffer|String} `output[2]` 的内容
  * `status` {Number} 子进程的退出码
  * `signal` {String} 用于杀死子进程的信号
  * `error` {Error} 如果子进程失败或超时产生的错误对象

`child_process.spawnSync()` 方法与 [`child_process.spawn()`] 基本相同，除了该方法直到子进程完全关闭后才返回。
当遇到超时且发送了 `killSignal` 时，则该方法直到进程完全退出后才返回结果。
注意，如果子进程拦截并处理了 `SIGTERM` 信号且没有退出，则父进程会一直等待直到子进程退出。

注意：不要把未经检查的用户输入传入到该函数。
任何包括 shell 元字符的输入都可被用于触发任何命令的执行。


###child_process.spawn(command[, args][, options])

* `command` {String} 要运行的命令
* `args` {Array} 字符串参数列表
* `options` {Object}
  * `cwd` {String} 子进程的当前工作目录
  * `env` {Object} 环境变量键值对
  * `argv0` {String} 显式地设置要发给子进程的 `argv[0]` 的值。
    如果未指定，则设为 `command`。
  * `stdio` {Array|String} 子进程的 stdio 配置。
    （详见 [`options.stdio`]）
  * `detached` {Boolean} 准备将子进程独立于父进程运行。
    具体行为取决于平台。（详见 [`options.detached`]）
  * `uid` {Number} 设置该进程的用户标识。（详见 setuid(2)）
  * `gid` {Number} 设置该进程的组标识。（详见 setgid(2)）
  * `shell` {Boolean|String} 如果为 `true`，则在一个 shell 中运行 `command`。
    在 UNIX 上使用 `'/bin/sh'`，在 Windows 上使用 `'cmd.exe'`。
    一个不同的 shell 可以被指定为字符串。
    该 shell 应该理解 UNIX 上的 `-c` 开关、或 Windows 的 `/s /c`。
    默认为 `false`（没有 shell）。
* 返回: {ChildProcess}

`child_process.spawn()` 方法使用给定的 `command` 和 `args` 中的命令行参数来衍生一个新进程。
如果省略 `args`，则默认为一个空数组。

注意：不要把未经检查的用户输入传入到该函数。
任何包括 shell 元字符的输入都可被用于触发任何命令的执行。

第三个参数可以用来指定额外的选项，默认如下：

	
    {
      cwd: undefined,
      env: process.env
    }
	

使用 `cwd` 来指定衍生的进程的工作目录。
如果没有给出，则默认继承当前的工作目录。

使用 `env` 来指定环境变量，这会在新进程中可见，默认为 [`process.env`]。

例子，运行 `ls -lh /usr`，捕获 `stdout`、`stderr`、以及退出码：

	
    const spawn = require('child_process').spawn;
    const ls = spawn('ls', ['-lh', '/usr']);
    
    ls.stdout.on('data', (data) => {
      console.log(`stdout: ${data}`);
    });
    
    ls.stderr.on('data', (data) => {
      console.log(`stderr: ${data}`);
    });
    
    ls.on('close', (code) => {
      console.log(`子进程退出码：${code}`);
    });
	

例子，一种执行 `'ps ax | grep ssh'` 的方法：

	
    const spawn = require('child_process').spawn;
    const ps = spawn('ps', ['ax']);
    const grep = spawn('grep', ['ssh']);
    
    ps.stdout.on('data', (data) => {
      grep.stdin.write(data);
    });
    
    ps.stderr.on('data', (data) => {
      console.log(`ps stderr: ${data}`);
    });
    
    ps.on('close', (code) => {
      if (code !== 0) {
        console.log(`ps 进程退出码：${code}`);
      }
      grep.stdin.end();
    });
    
    grep.stdout.on('data', (data) => {
      console.log(data.toString());
    });
    
    grep.stderr.on('data', (data) => {
      console.log(`grep stderr: ${data}`);
    });
    
    grep.on('close', (code) => {
      if (code !== 0) {
        console.log(`grep 进程退出码：${code}`);
      }
    });
	

例子，检测失败的执行：

	
    const spawn = require('child_process').spawn;
    const child = spawn('bad_command');
    
    child.on('error', (err) => {
      console.log('启动子进程失败。');
    });
	

注意：某些平台（OS X, Linux）会使用 `argv[0]` 的值作为进程的标题，而其他平台（Windows, SunOS）则使用 `command`。

注意，Node.js 一般会在启动时用 `process.execPath` 重写 `argv[0]`，所以 Node.js 子进程中的 `process.argv[0]` 不会匹配从父进程传给 `spawn` 的 `argv0` 参数，可以使用 `process.argv0` 属性获取它。


###child.send(message[, sendHandle[, options]][, callback])

* `message` {Object}
* `sendHandle` {Handle}
* `options` {Object}
* `callback` {Function}
* 返回: {Boolean}

当父进程和子进程之间建立了一个 IPC 通道时（例如，使用 [`child_process.fork()`]），`child.send()` 方法可用于发送消息到子进程。
当子进程是一个 Node.js 实例时，消息可以通过 [`process.on('message')`] 事件接收。

例子，父进程脚本如下：

	
    const cp = require('child_process');
    const n = cp.fork(`${__dirname}/sub.js`);
    
    n.on('message', (m) => {
      console.log('父进程收到消息：', m);
    });
    
    n.send({ hello: 'world' });
	

然后是子进程脚本，`'sub.js'` 可能看上去像这样：

	
    process.on('message', (m) => {
      console.log('子进程收到消息：', m);
    });
    
    process.send({ foo: 'bar' });
	

Node.js 中的子进程有一个自己的 [`process.send()`] 方法，允许子进程发送消息回父进程。

当发送一个 `{cmd: 'NODE_foo'}` 消息时，是一个特例。
所有在 `cmd` 属性里包含一个 `NODE_` 前缀的都会被认为是预留给 Node.js 核心代码内部使用的，且不会触发子进程的 [`process.on('message')`] 事件。
而是，这种消息可使用 `process.on('internalMessage')` 事件触发，且被 Node.js 内部消费。
应用程序应避免使用这种消息或监听 `'internalMessage'` 事件。

可选的 `sendHandle` 参数可能被传给 `child.send()`，它用于传入一个 TCP 服务器或 socket 对象给子进程。
子进程会接收对象作为第二个参数，并传给注册在 [`process.on('message')`] 事件上的回调函数。
socket 上接收或缓冲的任何数据不会被发送给子进程。

`options` 参数，如果存在的话，是一个用于处理发送数据参数对象。`options` 支持以下属性：

  * `keepOpen` - 一个 Boolean 值，当传入 `net.Socket` 实例时可用。
    当为 `true` 时，socket 在发送进程中保持打开。
    默认为 `false`。

可选的 `callback` 是一个函数，它在消息发送之后、子进程收到消息之前被调用。
该函数被调用时只有一个参数：成功时是 `null`，失败时是一个 [`Error`] 对象。

如果没有提供 `callback` 函数，且消息没被发送，则一个 `'error'` 事件将被 [`ChildProcess`] 对象触发。
这是有可能发生的，例如当子进程已经退出时。

如果通道已关闭，或当未发送的消息的积压超过阈值使其无法发送更多时，`child.send()` 会返回 `false`。
除此以外，该方法返回 `true`。
`callback` 函数可用于实现流量控制。


###child.stderr

* {stream.Readable}

一个代表子进程的 `stderr` 的可读流。

如果子进程被衍生时 `stdio[2]` 被设为任何不是 `'pipe'` 的值，则这会是 `null`。

`child.stderr` 是 `child.stdio[2]` 的一个别名。
这两个属性指向相同的值。


###child.stdin
* {stream.Writable}

一个代表子进程的 `stdin` 的可写流。

注意，如果一个子进程正在等待读取所有的输入，则子进程不会继续直到流已通过 `end()` 关闭。

如果子进程被衍生时 `stdio[0]` 被设为任何不是 `'pipe'` 的值，则这会是 `null`。

`child.stdin` 是 `child.stdio[0]` 的一个别名。
这两个属性指向相同的值。


####child.stdio

* {Array}

一个到子进程的管道的稀疏数组，对应着传给 [`child_process.spawn()`] 的选项中值被设为 `'pipe'` 的 [`stdio`]。
注意，`child.stdio[0]`、`child.stdio[1]` 和 `child.stdio[2]` 分别可用作 `child.stdin`、 `child.stdout` 和 `child.stderr`。

在下面的例子中，只有子进程的 fd `1`（stdout）被配置为一个管道，所以只有父进程的 `child.stdio[1]` 是一个流，数组中的其他值都是 `null`。

	
    const assert = require('assert');
    const fs = require('fs');
    const child_process = require('child_process');
    
    const child = child_process.spawn('ls', {
      stdio: [
        0, // 使用父进程的 stdin 用于子进程
        'pipe', // 把子进程的 stdout 通过管道传到父进程 
        fs.openSync('err.out', 'w') // 把子进程的 stderr 指向一个文件
      ]
    });
    
    assert.strictEqual(child.stdio[0], null);
    assert.strictEqual(child.stdio[0], child.stdin);
    
    assert(child.stdout);
    assert.strictEqual(child.stdio[1], child.stdout);
    
    assert.strictEqual(child.stdio[2], null);
    assert.strictEqual(child.stdio[2], child.stderr);
	


####child.stdout

* {stream.Readable}

一个代表子进程的 `stdout` 的可读流。

如果子进程被衍生时 `stdio[1]` 被设为任何不是 `'pipe'` 的值，则这会是 `null`。

`child.stdout` 是 `child.stdio[1]` 的一个别名。
这两个属性指向相同的值。


##ChildProcess 类

`ChildProcess` 类的实例是 [`EventEmitter`]，代表衍生的子进程。

`ChildProcess` 的实例不被直接创建。
而是，使用 [`child_process.spawn()`]、[`child_process.exec()`]、[`child_process.execFile()`] 或 [`child_process.fork()`] 方法创建 `ChildProcess` 实例。


###'close' 事件

* `code` {Number} 如果子进程退出自身，则该值是退出码。
* `signal` {String} 子进程被终止时的信号。

当子进程的 stdio 流被关闭时会触发 `'close'` 事件。
这与 [`'exit'`] 事件不同，因为多个进程可能共享同一 stdio 流。


###'disconnect' 事件
在父进程中调用 [`child.disconnect()`] 或在子进程中调用 [`process.disconnect()`] 后会触发 `'disconnect'` 事件。
断开后就不能再发送或接收信息，且 [`child.connected`] 属性会被设为 `false`。


###'error' 事件
* `err` {Error} 错误对象。

每当出现以下情况时触发 `'error'` 事件：

1. 进程无法被衍生；

2. 进程无法被杀死；

3. 向子进程发送信息失败。

注意，在错误发生后，`'exit'` 事件可能会也可能不会触发。
如果你同时监听了 `'exit'` 和 `'error'` 事件，谨防处理函数被多次调用。

详见 [`child.kill()`] 和 [`child.send()`]。


###'exit' 事件

* `code` {Number} 如果子进程退出自身，则该值是退出码。
* `signal` {String} 子进程被终止时的信号。

子进程结束后会触发 `'exit'` 事件。
如果进程退出了，则 `code` 是进程的最终退出码，否则为 `null`。
如果进程是收到的信号而终止的，则 `signal` 是信号的字符串名称，否则为 `null`。
这两个总有一个是非空的。

注意，当 `'exit'` 事件被触发时，子进程的 stdio 流可能依然是打开的。

另外，还要注意，Node.js 建立了 `SIGINT` 和 `SIGTERM` 的信号处理程序，且 Node.js 进程收到这些信号也不会立即终止。
相反，Node.js 会执行一系列的清理操作后重新引发处理信号。

详见 waitpid(2)。


###'message' 事件

* `message` {Object} 一个已解析的 JSON 对象或原始值。
* `sendHandle` {Handle} 一个 [`net.Socket`] 或 [`net.Server`] 对象 或 `undefined`。

当一个子进程使用 [`process.send()`] 发送消息时会触发 `'message'` 事件。


####例子：发送一个 server 对象
`sendHandle` 参数可用于将一个 TCP server 对象句柄传给子进程，如下所示：

	
    const child = require('child_process').fork('child.js');
    
    // 开启 server 对象，并发送该句柄。
    const server = require('net').createServer();
    server.on('connection', (socket) => {
      socket.end('被父进程处理');
    });
    server.listen(1337, () => {
      child.send('server', server);
    });
	

子进程接收 server 对象如下：

	
    process.on('message', (m, server) => {
      if (m === 'server') {
        server.on('connection', (socket) => {
          socket.end('被子进程处理');
        });
      }
    });
	

当服务器在父进程和子进程之间是共享的，则一些连接可被父进程处理，另一些可被子进程处理。

上面的例子使用了一个 `net` 模块创建的服务器，而 `dgram` 模块的服务器使用完全相同的工作流程，但它监听一个 `'message'` 事件而不是 `'connection'` 事件，且使用 `server.bind` 而不是 `server.listen()`。
目前仅 UNIX 平台支持这一点。


####例子：发送一个 socket 对象
同样，`sendHandle` 参数可用于将一个 socket 句柄传给子进程。
以下例子衍生了两个子进程，分别用于处理 "normal" 连接或优先处理 "special" 连接：

	
    const normal = require('child_process').fork('child.js', ['normal']);
    const special = require('child_process').fork('child.js', ['special']);
    
    // 开启 server，并发送 socket 给子进程
    const server = require('net').createServer();
    server.on('connection', (socket) => {
    
      // 特殊优先级
      if (socket.remoteAddress === '74.125.127.100') {
        special.send('socket', socket);
        return;
      }
      // 普通优先级
      normal.send('socket', socket);
    });
    server.listen(1337);
	

`child.js` 会接收到一个 socket 句柄，并作为第二个参数传给事件回调函数：

	
    process.on('message', (m, socket) => {
      if (m === 'socket') {
        socket.end(`请求被 ${process.argv[2]} 优先级处理`);
      }
    });
	

一旦一个 socket 已被传给了子进程，则父进程不再能够跟踪 socket 何时被销毁。
为了表明这个，`.connections` 属性会变成 `null`。
当发生这种情况时，建议不要使用 `.maxConnections`。

注意，该函数内部使用 [`JSON.stringify()`] 序列化 `message`。



`maxBuffer` 选项指定了 `stdout` 或 `stderr` 上允许的字节数的最大值。
如果超过这个值，则子进程会被终止。
这会影响包含多字节字符编码的输出，如 UTF-8 或 UTF-16。
例如，`console.log('中文测试')` 会发送 13 个 UTF-8 编码的字节到 `stdout`，尽管只有 4 个字符。


####options.detached

在 Windows 上，设置 `options.detached` 为 `true` 可以使子进程在父进程退出后继续运行。
子进程有自己的控制台窗口。
一旦启用一个子进程，它将不能被禁用。

在非 Windows 平台上，如果将 `options.detached` 设为 `true`，则子进程会成为新的进程组和会话的领导者。
注意，子进程在父进程退出后可以继续运行，不管它们是否被分离。
详见 setsid(2)。

默认情况下，父进程会等待被分离的子进程退出。
为了防止父进程等待给定的 `child`，可以使用 `child.unref()` 方法。
这样做会导致父进程的事件循环不包含子进程的引用计数，使得父进程独立于子进程退出，除非子进程和父进程之间建立了一个 IPC 信道。

当使用 `detached` 选项来启动一个长期运行的进程时，该进程不会在父进程退出后保持在后台运行，除非提供了一个不连接到父进程的 `stdio` 配置。
如果父进程的 `stdio` 是继承的，则子进程会保持连接到控制终端。

例子，一个长期运行的进程，为了忽视父进程的终止，通过分离且忽视其父进程的 `stdio` 文件描述符来实现：

	
    const spawn = require('child_process').spawn;
    
    const child = spawn(process.argv[0], ['child_program.js'], {
      detached: true,
      stdio: 'ignore'
    });
    
    child.unref();
	

也可以将子进程的输出重定向到文件：

	
    const fs = require('fs');
    const spawn = require('child_process').spawn;
    const out = fs.openSync('./out.log', 'a');
    const err = fs.openSync('./out.log', 'a');
    
    const child = spawn('prg', [], {
      detached: true,
      stdio: [ 'ignore', out, err ]
    });
    
    child.unref();
	


####options.stdio

`options.stdio` 选项用于配置子进程与父进程之间建立的管道。
默认情况下，子进程的 stdin、 stdout 和 stderr 会重定向到 [`ChildProcess`] 对象上相应的 [`child.stdin`]、 [`child.stdout`] 和 [`child.stderr`] 流。
这等同于将 `options.stdio` 设为 `['pipe', 'pipe', 'pipe']`。

为了方便起见，`options.stdio` 可以是以下字符串之一：

* `'pipe'` - 等同于 `['pipe', 'pipe', 'pipe']` （默认）
* `'ignore'` - 等同于 `['ignore', 'ignore', 'ignore']`
* `'inherit'` - 等同于 `[process.stdin, process.stdout, process.stderr]` 或 `[0,1,2]`

另外，`option.stdio` 的值是一个每个索引都对应一个子进程 fd 的数组。
fd 的 0、1 和 2 分别对应 stdin、stdout 和 stderr。
额外的 fd 可以被指定来创建父进程和子进程之间的额外管道。
该值是以下之一：

1. `'pipe'` - 创建一个子进程和父进程之间的管道。
    在管道的父端以 [`child.stdio[fd]`][`stdio`] 的形式作为 `child_process` 对象的一个属性暴露给父进程。
    为 fd 创建的管道 0 - 2 也可分别作为 [`child.stdin`]、[`child.stdout`] 和 [`child.stderr`]。
2. `'ipc'` - 创建一个用于父进程和子进程之间传递消息或文件描述符的 IPC 通道符。
    一个 [`ChildProcess`] 最多只能有一个 IPC stdio 文件描述符。
    设置该选项可启用 [`child.send()`] 方法。
    如果子进程把 JSON 消息写入到该文件描述符，则 [`child.on('message')`] 事件句柄会被父进程触发。
    如果子进程是一个 Node.js 进程，则一个已存在的 IPC 通道会在子进程中启用 [`process.send()`]、[`process.disconnect()`]、[`process.on('disconnect')`] 和 [`process.on('message')`]。
3. `'ignore'` - 指示 Node.js 在子进程中忽略 fd。
    由于 Node.js 总是会为它衍生的进程打开 fd 0 - 2，所以设置 fd 为 `'ignore'` 可以使 Node.js 打开 `/dev/null` 并将它附加到子进程的 fd 上。
4. {Stream} 对象 - 共享一个指向子进程的 tty、文件、socket 或管道的可读或可写流。
    流的底层文件描述符在子进程中是重复对应该 `stdio` 数组的索引的 fd。
    注意，该流必须有一个底层描述符（文件流直到 `'open'` 事件发生才需要）。
5. 正整数 - 整数值被解析为一个正在父进程中打开的文件描述符。
    它和子进程共享，类似于 {Stream} 是如何被共享的。
6. `null`, `undefined` - 使用默认值。
    对于 stdio fd 0、1 和 2（换言之，stdin、stdout 和 stderr）而言是创建了一个管道。
    对于 fd 3 及以上而言，默认值为 `'ignore'`。

例子：

	
    const spawn = require('child_process').spawn;
    
    // 子进程使用父进程的 stdios
    spawn('prg', [], { stdio: 'inherit' });
    
    // 衍生的子进程只共享 stderr
    spawn('prg', [], { stdio: ['pipe', 'pipe', process.stderr] });
    
    // 打开一个额外的 fd=4，用于与程序交互
    spawn('prg', [], { stdio: ['pipe', null, null, null, 'pipe'] });
	

当在父进程和子进程之间建立了一个 IPC 通道，且子进程是一个 Node.js 进程，则子进程会带着未引用的 IPC 通道（使用 `unref()`）启动，直到子进程为 [`process.on('disconnect')`] 事件或 [`process.on('message')`] 事件注册了一个事件句柄。
这使得子进程可以在进程没有通过打开的 IPC 通道保持打开的情况下正常退出。

详见 [`child_process.exec()`] 和 [`child_process.fork()`]。


###在 Windows 上衍生 .bat 和 .cmd 文件
[`child_process.exec()`] 和 [`child_process.execFile()`] 之间的重大区别会根据平台的不同而不同。
在类 Unix 操作系统上（Unix、 Linux、 OSX），[`child_process.execFile()`] 效率更高，因为它不需要衍生一个 shell。
但是在 Windows 上，`.bat` 和 `.cmd` 文件在没有终端的情况下是不可执行的，因此不能使用 [`child_process.execFile()`] 启动。
当在 Windows 下运行时，要调用 `.bat` 和 `.cmd` 文件，可以通过使用设置了 `shell` 选项的 [`child_process.spawn()`]、或使用 [`child_process.exec()`]、或衍生 `cmd.exe` 并将 `.bat` 或 `.cmd` 文件作为一个参数传入（也就是 `shell` 选项和 [`child_process.exec()`] 所做的工作）。
在任何情况下，如果脚本文件名包含了空格，则需要用加上引号。

	
    // 仅限 Windows 系统
    const spawn = require('child_process').spawn;
    const bat = spawn('cmd.exe', ['/c', 'my.bat']);
    
    bat.stdout.on('data', (data) => {
      console.log(data.toString());
    });
    
    bat.stderr.on('data', (data) => {
      console.log(data.toString());
    });
    
    bat.on('exit', (code) => {
      console.log(`子进程退出码：${code}`);
    });
    
    // 或
    const exec = require('child_process').exec;
    exec('my.bat', (err, stdout, stderr) => {
      if (err) {
        console.error(err);
        return;
      }
      console.log(stdout);
    });
    
    // 文件名带有空格的脚本：
    const bat = spawn('"my script.cmd"', ['a', 'b'], { shell: true });
    // 或：
    exec('"my script.cmd" a b', (err, stdout, stderr) => {
      // ...
    });
	


##创建同步进程
[`child_process.spawnSync()`]、[`child_process.execSync()`] 和 [`child_process.execFileSync()`] 方法是**同步的**且**会**阻塞 Node.js 的事件循环，暂停任何额外代码的执行直到衍生的进程退出。

像这样的阻塞调用有利于简化普通用途的脚本任务，且启动时有利于简化应用配置的加载/处理。



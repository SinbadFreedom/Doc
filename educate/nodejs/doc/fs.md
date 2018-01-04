
<!--type=misc-->

该特性依赖于底层操作系统提供的一种方法来通知文件系统的变化。

* 在 Linux 系统中，使用 [`inotify`]。
* 在 BSD 系统中，使用 [`kqueue`]。
* 在 OS X 系统中，对文件使用 [`kqueue`]，对目录使用 [`FSEvents`]。
* 在 SunOS 系统（包括 Solaris 和 SmartOS）中，使用 [`event ports`]。
* 在 Windows 系统中，该特性依赖 [`ReadDirectoryChangesW`]。
* 在 Aix 系统中，该特性依赖 [`AHAFS`] 必须是启动的。

如果底层功能因某些原因不可用，则 `fs.watch` 也无法正常工作。
例如，当使用虚拟化软件如 Vagrant、Docker 等时，在网络文件系统（NFS、SMB 等）或主文件系统中监视文件或目录可能是不可靠的。

你仍然可以使用 `fs.watchFile`，它使用状态查询，但它较慢且更不可靠。


<!-- YAML
added: v6.0.0
-->

`fs` 函数支持传递和接收字符串路径与 Buffer 路径。
后者的目的是使其可以在允许非 UTF-8 文件名的文件系统中工作。
对于大多数普通用途，使用 Buffer 路径是不必要的，因为字符串 API 会自动与 UTF-8 相互转换。

**注意**，在某些文件系统（如 NTFS 和 HFS+），文件名总是被编码为 UTF-8。
在这些文件系统中，传入非 UTF-8 编码的 Buffer 到 `fs` 函数将无法像预期那样工作。



<!--type=misc-->

`fs.watch` API 不是 100％ 跨平台一致的，且在某些情况下不可用。

递归选项只支持 OS X 和 Windows。


<!-- YAML
added: v0.5.8
-->

从 [`fs.watch()`] 返回的对象是该类型。

提供给 `fs.watch()` 的 `listener` 回调会接收返回的 FSWatcher 的 `change` 事件。

该对象本身可触发以下事件：


<!-- YAML
added: v0.1.93
-->

`ReadStream` 是一个[可读流]。


<!-- YAML
added: v0.1.21
-->

从 [`fs.stat()`]、[`fs.lstat()`] 和 [`fs.fstat()`] 及其同步版本返回的对象都是该类型。

 - `stats.isFile()`
 - `stats.isDirectory()`
 - `stats.isBlockDevice()`
 - `stats.isCharacterDevice()`
 - `stats.isSymbolicLink()` (仅对 [`fs.lstat()`] 有效)
 - `stats.isFIFO()`
 - `stats.isSocket()`

对于一个普通文件，[`util.inspect(stats)`] 会返回一个类似如下的字符串：

```js
Stats {
  dev: 2114,
  ino: 48064969,
  mode: 33188,
  nlink: 1,
  uid: 85,
  gid: 100,
  rdev: 0,
  size: 527,
  blksize: 4096,
  blocks: 8,
  atime: Mon, 10 Oct 2011 23:24:11 GMT,
  mtime: Mon, 10 Oct 2011 23:24:11 GMT,
  ctime: Mon, 10 Oct 2011 23:24:11 GMT,
  birthtime: Mon, 10 Oct 2011 23:24:11 GMT }
  
```

注意，`atime`、`mtime`、`birthtime` 和 `ctime` 是 [`Date`] 对象的实例，比较这些对象的值需要使用适当的方法。
对于大多数一般用途，[`getTime()`] 会返回 **1970年1月1日 00:00:00 UTC** 至今已过的毫秒数，且该整数应该满足任何对比，当然也有可用于显示模糊信息的其他方法。
详见 [MDN JavaScript 手册]。


<!-- YAML
added: v0.1.93
-->

`WriteStream` 一个[可写流]。


<!-- YAML
added: v0.5.8
-->

* `eventType` {String} fs 变化的类型
* `filename` {String | Buffer} 变化的文件名（如果是相关的/可用的）

当一个被监视的目录或文件有变化时触发。
详见 [`fs.watch()`]。

`filename` 参数可能不会被提供，这依赖于操作系统支持。
如果提供了 `filename`，则若 `fs.watch()` 被调用时 `encoding` 选项被设置为 `'buffer'` 则它会是一个 `Buffer`，否则 `filename` 是一个字符串。

```js
// 例子，处理 fs.watch 监听器
fs.watch('./tmp', {encoding: 'buffer'}, (eventType, filename) => {
  if (filename)
    console.log(filename);
    // 输出: <Buffer ...>
});
```


<!-- YAML
added: v0.1.93
-->

当 `ReadStream` 底层的文件描述符已被使用 `fs.close()` 方法关闭时触发。


<!-- YAML
added: v0.1.93
-->

当 `WriteStream` 底层的文件描述符已被使用 `fs.close()` 方法关闭时触发。


<!-- YAML
added: v0.5.8
-->

* `error` {Error}

当发生错误时触发。


<!-- YAML
added: v0.1.93
-->

* `fd` {Integer} 被 ReadStream 使用的整数文件描述符。

当 ReadStream 文件被打开时触发。


<!-- YAML
added: v0.1.93
-->

* `fd` {Integer} 被 WriteStream 使用的整数文件描述符。

当 WriteStream 文件被打开时触发。



<!--type=misc-->

回调中提供的 `filename` 参数仅在 Linux 和 Windows 系统上支持。
即使在支持的平台中，`filename` 也不能保证提供。
因此，不要以为 `filename` 参数总是在回调中提供，如果它是空的，需要有一定的后备逻辑。

```js
fs.watch('somedir', (eventType, filename) => {
  console.log(`事件类型是: ${eventType}`);
  if (filename) {
    console.log(`提供的文件名: ${filename}`);
  } else {
    console.log('未提供文件名');
  }
});
```



以下常量用于 [`fs.access()`]。

<table>
  <tr>
    <th>常量</th>
    <th>描述</th>
  </tr>
  <tr>
    <td><code>F_OK</code></td>
    <td>该标志表明文件对于调用进程是可见的。</td>
  </tr>
  <tr>
    <td><code>R_OK</code></td>
    <td>该标志表明文件可被调用进程读取。</td>
  </tr>
  <tr>
    <td><code>W_OK</code></td>
    <td>该标志表明文件可被调用进程写入。</td>
  </tr>
  <tr>
    <td><code>X_OK</code></td>
    <td>该标志表明文件可被调用进程执行。</td>
  </tr>
</table>



以下常量用于 [`fs.Stats`] 对象中用于决定一个文件访问权限的 `mode` 属性。

<table>
  <tr>
    <th>常量</th>
    <th>描述</th>
  </tr>
  <tr>
    <td><code>S_IRWXU</code></td>
    <td>该文件模式表明可被所有者读取、写入、执行。</td>
  </tr>
  <tr>
    <td><code>S_IRUSR</code></td>
    <td>该文件模式表明可被所有者读取。</td>
  </tr>
  <tr>
    <td><code>S_IWUSR</code></td>
    <td>该文件模式表明可被所有者写入。</td>
  </tr>
  <tr>
    <td><code>S_IXUSR</code></td>
    <td>该文件模式表明可被所有者执行。</td>
  </tr>
  <tr>
    <td><code>S_IRWXG</code></td>
    <td>该文件模式表明可被群组读取、写入、执行。</td>
  </tr>
  <tr>
    <td><code>S_IRGRP</code></td>
    <td>该文件模式表明可被群组读取。</td>
  </tr>
  <tr>
    <td><code>S_IWGRP</code></td>
    <td>该文件模式表明可被群组写入。</td>
  </tr>
  <tr>
    <td><code>S_IXGRP</code></td>
    <td>该文件模式表明可被群组执行。</td>
  </tr>
  <tr>
    <td><code>S_IRWXO</code></td>
    <td>该文件模式表明可被其他人读取、写入、执行。</td>
  </tr>
  <tr>
    <td><code>S_IROTH</code></td>
    <td>该文件模式表明可被其他人读取。</td>
  </tr>
  <tr>
    <td><code>S_IWOTH</code></td>
    <td>该文件模式表明可被其他人写入。</td>
  </tr>
  <tr>
    <td><code>S_IXOTH</code></td>
    <td>该文件模式表明可被其他人执行。</td>
  </tr>
</table>



以下常量用于 `fs.open()`。

<table>
  <tr>
    <th>常量</th>
    <th>描述</th>
  </tr>
  <tr>
    <td><code>O_RDONLY</code></td>
    <td>该标志表明打开一个文件用于只读访问。</td>
  </tr>
  <tr>
    <td><code>O_WRONLY</code></td>
    <td>该标志表明打开一个文件用于只写访问。</td>
  </tr>
  <tr>
    <td><code>O_RDWR</code></td>
    <td>该标志表明打开一个文件用于读写访问。</td>
  </tr>
  <tr>
    <td><code>O_CREAT</code></td>
    <td>该标志表明如果文件不存在则创建一个文件。</td>
  </tr>
  <tr>
    <td><code>O_EXCL</code></td>
    <td>该标志表明如果设置了 <code>O_CREAT</code> 标志且文件已经存在，则打开一个文件应该失败。</td>
  </tr>
  <tr>
    <td><code>O_NOCTTY</code></td>
    <td>该标志表明如果路径是一个终端设备，则打开该路径不应该造成该终端变成进程的控制终端（如果进程还没有终端）。</td>
  </tr>
  <tr>
    <td><code>O_TRUNC</code></td>
    <td>该标志表明如果文件存在且为一个常规文件、且文件被成功打开为写入访问，则它的长度应该被截断至零。</td>
  </tr>
  <tr>
    <td><code>O_APPEND</code></td>
    <td>该标志表明数据会被追加到文件的末尾。</td>
  </tr>
  <tr>
    <td><code>O_DIRECTORY</code></td>
    <td>该标志表明如果路径不是一个目录，则打开应该失败。</td>
  </tr>
  <tr>
  <td><code>O_NOATIME</code></td>
    <td>该标志表明文件系统的读取访问权不再引起相关文件 `atime` 信息的更新。该标志只在 Linux 操作系统有效。</td>
  </tr>
  <tr>
    <td><code>O_NOFOLLOW</code></td>
    <td>该标志表明如果路径是一个符号链接，则打开应该失败。</td>
  </tr>
  <tr>
    <td><code>O_SYNC</code></td>
    <td>该标志表明文件打开用于同步 I/O。</td>
  </tr>
  <tr>
    <td><code>O_SYMLINK</code></td>
    <td>该标志表明打开符号链接自身，而不是它指向的资源。</td>
  </tr>
  <tr>
    <td><code>O_DIRECT</code></td>
    <td>当设置它时，会尝试最小化文件 I/O 的缓存效果。</td>
  </tr>
  <tr>
    <td><code>O_NONBLOCK</code></td>
    <td>该标志表明当可能时以非阻塞模式打开文件。</td>
  </tr>
</table>



> 稳定性: 2 - 稳定的

<!--name=fs-->

文件 I/O 是由简单封装的标准 POSIX 函数提供的。
通过 `require('fs')` 使用该模块。
所有的方法都有异步和同步的形式。

异步形式始终以完成回调作为它最后一个参数。
传给完成回调的参数取决于具体方法，但第一个参数总是留给异常。
如果操作成功完成，则第一个参数会是 `null` 或 `undefined`。

当使用同步形式时，任何异常都会被立即抛出。
可以使用 try/catch 来处理异常，或让它们往上冒泡。

这是异步版本的例子：

```js
const fs = require('fs');

fs.unlink('/tmp/hello', (err) => {
  if (err) throw err;
  console.log('successfully deleted /tmp/hello');
});
```

这是同步版本的例子：

```js
const fs = require('fs');

fs.unlinkSync('/tmp/hello');
console.log('successfully deleted /tmp/hello');
```

异步方法不保证执行顺序。
所以下面的例子容易出错：

```js
fs.rename('/tmp/hello', '/tmp/world', (err) => {
  if (err) throw err;
  console.log('renamed complete');
});
fs.stat('/tmp/world', (err, stats) => {
  if (err) throw err;
  console.log(`stats: ${JSON.stringify(stats)}`);
});
```

`fs.stat` 可能在 `fs.rename` 之前执行。正确的方法是把回调链起来。

```js
fs.rename('/tmp/hello', '/tmp/world', (err) => {
  if (err) throw err;
  fs.stat('/tmp/world', (err, stats) => {
    if (err) throw err;
    console.log(`stats: ${JSON.stringify(stats)}`);
  });
});
```

在繁忙的进程中，**强烈推荐**开发者使用这些函数的异步版本。
同步版本会阻塞整个进程，直到它们完成（停止所有连接）。

可使用文件名的相对路径。
但该路径是相对 `process.cwd()` 的。

大部分 fs 函数会让你忽略回调参数。
如果你这么做，一个默认的回调将用于抛出错误。
为了追踪原始的调用点，可设置 `NODE_DEBUG` 环境变量：

```txt
$ cat script.js
function bad() {
  require('fs').readFile('/');
}
bad();

$ env NODE_DEBUG=fs node script.js
fs.js:88
        throw backtrace;
        ^
Error: EISDIR: illegal operation on a directory, read
    <stack trace.>
```



以下常量用于 [`fs.Stats`] 对象中用于决定一个文件的类型的 `mode` 属性。

<table>
  <tr>
    <th>常量</th>
    <th>描述</th>
  </tr>
  <tr>
    <td><code>S_IFMT</code></td>
    <td>用于提取文件类型码的位掩码。</td>
  </tr>
  <tr>
    <td><code>S_IFREG</code></td>
    <td>表示一个常规文件的文件类型常量。</td>
  </tr>
  <tr>
    <td><code>S_IFDIR</code></td>
    <td>表示一个目录的文件类型常量。</td>
  </tr>
  <tr>
    <td><code>S_IFCHR</code></td>
    <td>表示一个面向字符的设备文件的文件类型常量。</td>
  </tr>
  <tr>
    <td><code>S_IFBLK</code></td>
    <td>表示一个面向块的设备文件的文件类型常量。</td>
  </tr>
  <tr>
    <td><code>S_IFIFO</code></td>
    <td>表示一个 FIFO/pipe 的文件类型常量。</td>
  </tr>
  <tr>
    <td><code>S_IFLNK</code></td>
    <td>表示一个符号链接的文件类型常量。</td>
  </tr>
  <tr>
    <td><code>S_IFSOCK</code></td>
    <td>表示一个 socket 的文件类型常量。</td>
  </tr>
</table>


<!-- YAML
added: v0.11.15
-->

* `path` {String | Buffer}
* `mode` {Integer}

[`fs.access()`] 的同步版本。
如果有任何可访问性检查失败则抛出错误，否则什么也不做。


<!-- YAML
added: v0.11.15
-->

* `path` {String | Buffer}
* `mode` {Integer}
* `callback` {Function}

测试 `path` 指定的文件或目录的用户权限。
`mode` 是一个可选的整数，指定要执行的可访问性检查。
以下常量定义了 `mode` 的可能值。
可以创建由两个或更多个值的位或组成的掩码。

- `fs.constants.F_OK` - `path` 文件对调用进程可见。
这在确定文件是否存在时很有用，但不涉及 `rwx` 权限。
如果没指定 `mode`，则默认为该值。
- `fs.constants.R_OK` - `path` 文件可被调用进程读取。
- `fs.constants.W_OK` - `path` 文件可被调用进程写入。
- `fs.constants.X_OK` - `path` 文件可被调用进程执行。
对 Windows 系统没作用（相当于 `fs.constants.F_OK`）。

最后一个参数 `callback` 是一个回调函数，会带有一个可能的错误参数被调用。
如果可访问性检查有任何的失败，则错误参数会被传入。
下面的例子会检查 `/etc/passwd` 文件是否可以被当前进程读取和写入。

```js
fs.access('/etc/passwd', fs.constants.R_OK | fs.constants.W_OK, (err) => {
  console.log(err ? 'no access!' : 'can read/write');
});
```

不建议在调用 `fs.open()` 、 `fs.readFile()` 或 `fs.writeFile()` 之前使用 `fs.access()` 检查一个文件的可访问性。
如此处理会造成紊乱情况，因为其他进程可能在两个调用之间改变该文件的状态。
作为替代，用户代码应该直接打开/读取/写入文件，当文件无法访问时再处理错误。

例子：


**写入（不推荐）**

```js
fs.access('myfile', (err) => {
  if (!err) {
    console.error('myfile already exists');
    return;
  }

  fs.open('myfile', 'wx', (err, fd) => {
    if (err) throw err;
    writeMyData(fd);
  });
});
```

**写入（推荐）**

```js
fs.open('myfile', 'wx', (err, fd) => {
  if (err) {
    if (err.code === 'EEXIST') {
      console.error('myfile already exists');
      return;
    }

    throw err;
  }

  writeMyData(fd);
});
```

**读取（不推荐）**

```js
fs.access('myfile', (err) => {
  if (err) {
    if (err.code === 'ENOENT') {
      console.error('myfile does not exist');
      return;
    }

    throw err;
  }

  fs.open('myfile', 'r', (err, fd) => {
    if (err) throw err;
    readMyData(fd);
  });
});
```

**读取（推荐）**

```js
fs.open('myfile', 'r', (err, fd) => {
  if (err) {
    if (err.code === 'ENOENT') {
      console.error('myfile does not exist');
      return;
    }

    throw err;
  }

  readMyData(fd);
});
```

以上**不推荐**的例子检查可访问性之后再使用文件；
**推荐**的例子更好，因为它们直接使用文件并处理任何错误。

通常，仅在文件不会被直接使用时才检查一个文件的可访问性，例如当它的可访问性是来自另一个进程的信号。


<!-- YAML
added: v0.6.7
-->

* `file` {String | Buffer | Number} 文件名或文件描述符
* `data` {String | Buffer}
* `options` {Object | String}
  * `encoding` {String | Null} 默认 = `'utf8'`
  * `mode` {Integer} 默认 = `0o666`
  * `flag` {String} 默认 = `'a'`

[`fs.appendFile()`] 的同步版本。
返回 `undefined`。


<!-- YAML
added: v0.6.7
-->

* `file` {String | Buffer | Number} 文件名或文件描述符
* `data` {String | Buffer}
* `options` {Object | String}
  * `encoding` {String | Null} 默认 = `'utf8'`
  * `mode` {Integer} 默认 = `0o666`
  * `flag` {String} 默认 = `'a'`
* `callback` {Function}

异步地追加数据到一个文件，如果文件不存在则创建文件。
`data` 可以是一个字符串或 buffer。

例子：

```js
fs.appendFile('message.txt', 'data to append', (err) => {
  if (err) throw err;
  console.log('The "data to append" was appended to file!');
});
```

如果 `options` 是一个字符串，则它指定了字符编码。例如：

```js
fs.appendFile('message.txt', 'data to append', 'utf8', callback);
```

任何指定的文件描述符必须为了追加而被打开。

注意：如果文件描述符被指定为 `file`，则不会被自动关闭。


<!-- YAML
added: v0.6.7
-->

* `path` {String | Buffer}
* `mode` {Integer}

同步的 chmod(2)。返回 `undefined`。


<!-- YAML
added: v0.1.30
-->

* `path` {String | Buffer}
* `mode` {Integer}
* `callback` {Function}

异步的 chmod(2)。
完成回调只有一个可能的异常参数。


<!-- YAML
added: v0.1.97
-->

* `path` {String | Buffer}
* `uid` {Integer}
* `gid` {Integer}

同步的 chown(2)。返回 `undefined`。


<!-- YAML
added: v0.1.97
-->

* `path` {String | Buffer}
* `uid` {Integer}
* `gid` {Integer}
* `callback` {Function}

异步的 chown(2)。
完成回调只有一个可能的异常参数。


<!-- YAML
added: v0.1.21
-->

* `fd` {Integer}

同步的 close(2)。返回 `undefined`。


<!-- YAML
added: v0.0.2
-->

* `fd` {Integer}
* `callback` {Function}

异步的 close(2)。
完成回调只有一个可能的异常参数。



返回一个包含常用文件系统操作的常量的对象。
具体的常量定义在 [FS Constants] 中描述。



以下常量由 `fs.constants` 输出。
**注意：**不是所有的常量在每一个操作系统上都是可用的。


<!-- YAML
added: v0.1.31
-->

* `path` {String | Buffer}
* `options` {String | Object}
  * `flags` {String}
  * `encoding` {String}
  * `fd` {Integer}
  * `mode` {Integer}
  * `autoClose` {Boolean}
  * `start` {Integer}
  * `end` {Integer}

返回一个新建的 [`ReadStream`] 对象（详见[可读流]）。

不同于在一个可读流上设置的 `highWaterMark` 默认值（16 kb），该方法在相同参数下返回的流具有 64 kb 的默认值。

`options` 是一个带有以下默认值的对象或字符串：

```js
{
  flags: 'r',
  encoding: null,
  fd: null,
  mode: 0o666,
  autoClose: true
}
```

`options` 可以包括 `start` 和 `end` 值，使其可以从文件读取一定范围的字节而不是整个文件。
`start` 和 `end` 都是包括在内的，并且起始值是 0。
如果指定了 `fd` 且 `start` 不传或为 `undefined`，则 `fs.createReadStream()` 从当前文件位置按顺序地读取。
`encoding` 可以是任何可以被 [`Buffer`] 接受的值。

如果指定了 `fd`，则 `ReadStream` 会忽略 `path` 参数并且会使用指定的文件描述符。
这意味着不会触发 `'open'` 事件。
注意，`fd` 应该是阻塞的；非阻塞的 `fd` 们应该传给 [`net.Socket`]。

如果 `autoClose` 为 `false`，则文件描述符不会被关闭，即使有错误。
你需要负责关闭它，并且确保没有文件描述符泄漏。
如果 `autoClose` 被设置为 `true`（默认），则在 `error` 或 `end` 时，文件描述符会被自动关闭。

`mode` 用于设置文件模式（权限和粘结位），但仅限创建文件时。

例子，从一个 100 字节长的文件中读取最后 10 个字节：

```js
fs.createReadStream('sample.txt', {start: 90, end: 99});
```

如果 `options` 是一个字符串，则它指定了字符编码。


<!-- YAML
added: v0.1.31
-->

* `path` {String | Buffer}
* `options` {String | Object}
  * `flags` {String}
  * `defaultEncoding` {String}
  * `fd` {Integer}
  * `mode` {Integer}
  * `autoClose` {Boolean}
  * `start` {Integer}

返回一个新建的 [`WriteStream`] 对象（详见[可写流]）。

`options` 是一个带有以下默认值的对象或字符串：

```js
{
  flags: 'w',
  defaultEncoding: 'utf8',
  fd: null,
  mode: 0o666,
  autoClose: true
}
```

`options` 也可以包括一个 `start` 选项，使其可以写入数据到文件某个位置。
如果是修改一个文件而不是覆盖它，则需要`flags` 模式为 `r+` 而不是默认的 `w` 模式。
`defaultEncoding` 可以是任何可以被 [`Buffer`] 接受的值。

如果 `autoClose` 被设置为 `true`（默认），则在 `error` 或 `end` 时，文件描述符会被自动关闭。
如果 `autoClose` 为 `false`，则文件描述符不会被关闭，即使有错误。
你需要负责关闭它，并且确保没有文件描述符泄漏。

类似 [`ReadStream`]，如果指定了 `fd`，则 `WriteStream` 会忽略 `path` 参数并且会使用指定的文件描述符。
这意味着不会触发 `'open'` 事件。
注意，`fd` 应该是阻塞的；非阻塞的 `fd` 们应该传给 [`net.Socket`]。

如果 `options` 是一个字符串，则它指定了字符编码。


<!-- YAML
added: v0.1.21
-->

* `path` {String | Buffer}

[`fs.exists()`] 的同步版本。
如果文件存在，则返回 `true`，否则返回 `false`。

注意，虽然 `fs.exists()` 是废弃的，但 `fs.existsSync()` 不是。
（`fs.exists()` 的回调接收的参数与其他 Node.js 回调不一致，`fs.existsSync()` 不使用回调。）


<!-- YAML
added: v0.0.2
deprecated: v1.0.0
-->

> 稳定性: 0 - 废弃的: 使用 [`fs.stat()`] 或 [`fs.access()`] 代替。

* `path` {String | Buffer}
* `callback` {Function}

Test whether or not the given path exists by checking with the file system.
Then call the `callback` argument with either true or false.  Example:

```js
fs.exists('/etc/passwd', (exists) => {
  console.log(exists ? 'it\'s there' : 'no passwd!');
});
```

**Note that the parameter to this callback is not consistent with other
Node.js callbacks.** Normally, the first parameter to a Node.js callback is
an `err` parameter, optionally followed by other parameters. The
`fs.exists()` callback has only one boolean parameter. This is one reason
`fs.access()` is recommended instead of `fs.exists()`.

Using `fs.exists()` to check for the existence of a file before calling
`fs.open()`, `fs.readFile()` or `fs.writeFile()` is not recommended. Doing
so introduces a race condition, since other processes may change the file's
state between the two calls. Instead, user code should open/read/write the
file directly and handle the error raised if the file does not exist.

For example:

**write (NOT RECOMMENDED)**

```js
fs.exists('myfile', (exists) => {
  if (exists) {
    console.error('myfile already exists');
  } else {
    fs.open('myfile', 'wx', (err, fd) => {
      if (err) throw err;
      writeMyData(fd);
    });
  }
});
```

**write (RECOMMENDED)**

```js
fs.open('myfile', 'wx', (err, fd) => {
  if (err) {
    if (err.code === 'EEXIST') {
      console.error('myfile already exists');
      return;
    }

    throw err;
  }

  writeMyData(fd);
});
```

**read (NOT RECOMMENDED)**

```js
fs.exists('myfile', (exists) => {
  if (exists) {
    fs.open('myfile', 'r', (err, fd) => {
      readMyData(fd);
    });
  } else {
    console.error('myfile does not exist');
  }
});
```

**read (RECOMMENDED)**

```js
fs.open('myfile', 'r', (err, fd) => {
  if (err) {
    if (err.code === 'ENOENT') {
      console.error('myfile does not exist');
      return;
    }

    throw err;
  }

  readMyData(fd);
});
```

The "not recommended" examples above check for existence and then use the
file; the "recommended" examples are better because they use the file directly
and handle the error, if any.

In general, check for the existence of a file only if the file won’t be
used directly, for example when its existence is a signal from another
process.


<!-- YAML
added: v0.4.7
-->

* `fd` {Integer}
* `mode` {Integer}

同步的 fchmod(2)。返回 `undefined`。


<!-- YAML
added: v0.4.7
-->

* `fd` {Integer}
* `mode` {Integer}
* `callback` {Function}

异步的 fchmod(2)。
完成回调只有一个可能的异常参数。


<!-- YAML
added: v0.4.7
-->

* `fd` {Integer}
* `uid` {Integer}
* `gid` {Integer}

同步的 fchown(2)。返回 `undefined`。


<!-- YAML
added: v0.4.7
-->

* `fd` {Integer}
* `uid` {Integer}
* `gid` {Integer}
* `callback` {Function}

异步的 fchown(2)。
完成回调只有一个可能的异常参数。


<!-- YAML
added: v0.1.96
-->

* `fd` {Integer}

同步的 fdatasync(2)。返回 `undefined`。


<!-- YAML
added: v0.1.96
-->

* `fd` {Integer}
* `callback` {Function}

异步的 fdatasync(2)。
完成回调只有一个可能的异常参数。


<!-- YAML
added: v0.1.95
-->

* `fd` {Integer}

同步的 fstat(2)。返回一个 [`fs.Stats`] 实例。


<!-- YAML
added: v0.1.95
-->

* `fd` {Integer}
* `callback` {Function}

异步的 fstat(2)。
回调获得两个参数 `(err, stats)`，其中 `stats` 是一个 [`fs.Stats`] 对象。
`fstat()` 与 [`stat()`] 类似，除了文件是通过文件描述符 `fd` 指定的。


<!-- YAML
added: v0.1.96
-->

* `fd` {Integer}

同步的 fsync(2)。返回 `undefined`。


<!-- YAML
added: v0.1.96
-->

* `fd` {Integer}
* `callback` {Function}

异步的 fsync(2)。
完成回调只有一个可能的异常参数。


<!-- YAML
added: v0.8.6
-->

* `fd` {Integer}
* `len` {Integer} 默认 = `0`

同步的 ftruncate(2)。返回 `undefined`。


<!-- YAML
added: v0.8.6
-->

* `fd` {Integer}
* `len` {Integer} 默认 = `0`
* `callback` {Function}

异步的 ftruncate(2)。
完成回调只有一个可能的异常参数。

如果文件描述符指向的文件大于 `len` 个字节，则只有前面 `len` 个字节会保留在文件中。

例子，下面的程序会只保留文件前4个字节。

```js
console.log(fs.readFileSync('temp.txt', 'utf8'));
// 输出: Node.js

// 获取要截断的文件的文件描述符
const fd = fs.openSync('temp.txt', 'r+');

// 截断文件至前4个字节
fs.ftruncate(fd, 4, (err) => {
  assert.ifError(err);
  console.log(fs.readFileSync('temp.txt', 'utf8'));
});
// 输出: Node
```

如果前面的文件小于 `len` 个字节，则扩展文件，且扩展的部分用空字节（'\0'）填充。例子：

```js
console.log(fs.readFileSync('temp.txt', 'utf-8'));
// 输出: Node.js

// 获取要截断的文件的文件描述符
const fd = fs.openSync('temp.txt', 'r+');

// 截断文件至前10个字节，但实际大小是7个字节
fs.ftruncate(fd, 10, (err) => {
  assert.ifError(err);
  console.log(fs.readFileSync('temp.txt'));
});
// 输出: <Buffer 4e 6f 64 65 2e 6a 73 00 00 00>
// ('Node.js\0\0\0' in UTF8)
```

最后3个字节是空字节（'\0'），用于补充超出的截断。


<!-- YAML
added: v0.4.2
-->

* `fd` {Integer}
* `atime` {Integer}
* `mtime` {Integer}

[`fs.futimes()`] 的同步版本。返回 `undefined`。


<!-- YAML
added: v0.4.2
-->

* `fd` {Integer}
* `atime` {Integer}
* `mtime` {Integer}
* `callback` {Function}

改变由所提供的文件描述符所指向的文件的文件时间戳。


<!-- YAML
deprecated: v0.4.7
-->

* `path` {String | Buffer}
* `mode` {Integer}

同步的 lchmod(2)。返回 `undefined`。


<!-- YAML
deprecated: v0.4.7
-->

* `path` {String | Buffer}
* `mode` {Integer}
* `callback` {Function}

异步的 lchmod(2)。
完成回调只有一个可能的异常参数。

只在 Mac OS X 有效。


<!-- YAML
deprecated: v0.4.7
-->

* `path` {String | Buffer}
* `uid` {Integer}
* `gid` {Integer}

同步的 lchown(2)。返回 `undefined`。


<!-- YAML
deprecated: v0.4.7
-->

* `path` {String | Buffer}
* `uid` {Integer}
* `gid` {Integer}
* `callback` {Function}

异步的 lchown(2)。
完成回调只有一个可能的异常参数。


<!-- YAML
added: v0.1.31
-->

* `existingPath` {String | Buffer}
* `newPath` {String | Buffer}

同步的 link(2)。返回 `undefined`。


<!-- YAML
added: v0.1.31
-->

* `existingPath` {String | Buffer}
* `newPath` {String | Buffer}
* `callback` {Function}

异步的 link(2)。
完成回调只有一个可能的异常参数。


<!-- YAML
added: v0.1.30
-->

* `path` {String | Buffer}

同步的 lstat(2)。返回一个 [`fs.Stats`] 实例。


<!-- YAML
added: v0.1.30
-->

* `path` {String | Buffer}
* `callback` {Function}

异步的 lstat(2)。
回调获得两个参数 `(err, stats)`，其中 `stats` 是一个 [`fs.Stats`] 对象。
`lstat()` 与 [`stat()`] 类似，除非 `path` 是一个符号链接，则自身就是该链接，它指向的并不是文件。


<!-- YAML
added: v0.1.21
-->

* `path` {String | Buffer}
* `mode` {Integer}

同步的 mkdir(2)。返回 `undefined`。


<!-- YAML
added: v0.1.8
-->

* `path` {String | Buffer}
* `mode` {Integer}
* `callback` {Function}

异步的 mkdir(2)。
完成回调只有一个可能的异常参数。
`mode` 默认为 `0o777`。


<!-- YAML
added: v5.10.0
-->

* `prefix` {String}
* `options` {String | Object}
  * `encoding` {String} 默认 = `'utf8'`

[`fs.mkdtemp()`] 的同步版本。
返回创建的目录的路径。

可选的 `options` 参数可以是一个字符串并指定一个字符编码，或是一个对象且由一个 `encoding` 属性指定使用的字符编码。


<!-- YAML
added: v5.10.0
-->

* `prefix` {String}
* `options` {String | Object}
  * `encoding` {String} 默认 = `'utf8'`
* `callback` {Function}

创建一个唯一的临时目录。

生成六位随机字符附加到一个要求的 `prefix` 后面，然后创建一个唯一的临时目录。

创建的目录路径会作为字符串传给回调的第二个参数。

可选的 `options` 参数可以是一个字符串并指定一个字符编码，或是一个对象且由一个 `encoding` 属性指定使用的字符编码。

例子：

```js
fs.mkdtemp('/tmp/foo-', (err, folder) => {
  if (err) throw err;
  console.log(folder);
  // 输出: /tmp/foo-itXde2
});
```

**注意**：`fs.mkdtemp()` 方法会直接附加六位随机选择的字符串到 `prefix` 字符串。
例如，指定一个目录 `/tmp`，如果目的是要在 `/tmp` 里创建一个临时目录，则 `prefix` **必须** 以一个指定平台的路径分隔符（`require('path').sep`）结尾。

```js
// 新建的临时目录的父目录
const tmpDir = '/tmp';

// 该方法是 *错误的*：
fs.mkdtemp(tmpDir, (err, folder) => {
  if (err) throw err;
  console.log(folder);
  // 会输出类似于 `/tmpabc123`。
  // 注意，一个新的临时目录会被创建在文件系统的根目录，而不是在 /tmp 目录里。
});

// 该方法是 *正确的*：
const { sep } = require('path');
fs.mkdtemp(`${tmpDir}${sep}`, (err, folder) => {
  if (err) throw err;
  console.log(folder);
  // 会输出类似于 `/tmp/abc123`。
  // 一个新的临时目录会被创建在 /tmp 目录里。
});
```


<!-- YAML
added: v0.1.21
-->

* `path` {String | Buffer}
* `flags` {String | Number}
* `mode` {Integer}

[`fs.open()`] 的同步版本。
返回一个表示文件描述符的整数。


<!-- YAML
added: v0.0.2
-->

* `path` {String | Buffer}
* `flags` {String | Number}
* `mode` {Integer}
* `callback` {Function}

异步地打开文件。详见 open(2)。
`flags` 可以是：

* `'r'` - 以读取模式打开文件。如果文件不存在则发生异常。

* `'r+'` - 以读写模式打开文件。如果文件不存在则发生异常。

* `'rs+'` - 以同步读写模式打开文件。命令操作系统绕过本地文件系统缓存。

  这对 NFS 挂载模式下打开文件很有用，因为它可以让你跳过潜在的旧本地缓存。
  它对 I/O 的性能有明显的影响，所以除非需要，否则不要使用此标志。

  注意，这不会使 `fs.open()` 进入同步阻塞调用。
  如果那是你想要的，则应该使用 `fs.openSync()`。

* `'w'` - 以写入模式打开文件。文件会被创建（如果文件不存在）或截断（如果文件存在）。

* `'wx'` - 类似 `'w'`，但如果 `path` 存在，则失败。

* `'w+'` - 以读写模式打开文件。文件会被创建（如果文件不存在）或截断（如果文件存在）。

* `'wx+'` - 类似 `'w+'`，但如果 `path` 存在，则失败。

* `'a'` - 以追加模式打开文件。如果文件不存在，则会被创建。

* `'ax'` - 类似于 `'a'`，但如果 `path` 存在，则失败。

* `'a+'` - 以读取和追加模式打开文件。如果文件不存在，则会被创建。

* `'ax+'` - 类似于 `'a+'`，但如果 `path` 存在，则失败。

`mode` 可设置文件模式（权限和 sticky 位），但只有当文件被创建时才有效。默认为 `0666`，可读写。

该回调有两个参数 `(err, fd)`。

特有的标志 `'x'`（在 open(2) 中的 `O_EXCL` 标志）确保 `path` 是新创建的。
在 POSIX 操作系统中，`path` 会被视为存在，即使是一个链接到一个不存在的文件的符号。
该特有的标志有可能在网络文件系统中无法使用。

`flags` 也可以是一个数字，[open(2)] 文档中有描述；
常用的常量可从 `fs.constants` 获取。
在 Windows 系统中，标志会被转换为与它等同的替代者，例如，`O_WRONLY` 转换为 `FILE_GENERIC_WRITE`、或 `O_EXCL|O_CREAT` 转换为 `CREATE_NEW`，通过 CreateFileW 接受。

在 Linux 中，当文件以追加模式打开时，定位的写入不起作用。
内核会忽略位置参数，并总是附加数据到文件的末尾。

注意：`fs.open()` 某些标志的行为是与平台相关的。
因此，在 OS X 和 Linux 下用 `'a+'` 标志打开一个目录（见下面的例子），会返回一个错误。
与此相反，在 Windows 和 FreeBSD，则会返回一个文件描述符。

```js
// OS X 与 Linux
fs.open('<directory>', 'a+', (err, fd) => {
  // => [Error: EISDIR: illegal operation on a directory, open <directory>]
});

// Windows 与 FreeBSD
fs.open('<directory>', 'a+', (err, fd) => {
  // => null, <fd>
});
```


<!-- YAML
added: v0.1.21
-->

* `path` {String | Buffer}
* `options` {String | Object}
  * `encoding` {String} 默认 = `'utf8'`

同步的 readdir(3). 
返回一个不包括 `'.'` 和 `'..'` 的文件名的数组。

可选的 `options` 参数用于传入回调的文件名，它可以是一个字符串并指定一个字符编码，或是一个对象且由一个 `encoding` 属性指定使用的字符编码。
如果 `encoding` 设为 `'buffer'`，则返回的文件名会被作为 `Buffer` 对象传入。


<!-- YAML
added: v0.1.8
-->

* `path` {String | Buffer}
* `options` {String | Object}
  * `encoding` {String} 默认 = `'utf8'`
* `callback` {Function}

异步的 readdir(3)。
读取一个目录的内容。
回调有两个参数 `(err, files)`，其中 `files` 是目录中不包括 `'.'` 和 `'..'` 的文件名的数组。

可选的 `options` 参数用于传入回调的文件名，它可以是一个字符串并指定一个字符编码，或是一个对象且由一个 `encoding` 属性指定使用的字符编码。
如果 `encoding` 设为 `'buffer'`，则返回的文件名会被作为 `Buffer` 对象传入。


<!-- YAML
added: v0.1.8
-->

* `file` {String | Buffer | Integer} 文件名或文件描述符
* `options` {Object | String}
  * `encoding` {String | Null} 默认 = `null`
  * `flag` {String} 默认 = `'r'`

[`fs.readFile`] 的同步版本。
返回 `file` 的内容。

如果指定了 `encoding` 选项，则该函数返回一个字符串，否则返回一个 buffer。


<!-- YAML
added: v0.1.29
-->

* `file` {String | Buffer | Integer} 文件名或文件描述符
* `options` {Object | String}
  * `encoding` {String | Null} 默认 = `null`
  * `flag` {String} 默认 = `'r'`
* `callback` {Function}

异步的读取一个文件的全部内容。
例子：

```js
fs.readFile('/etc/passwd', (err, data) => {
  if (err) throw err;
  console.log(data);
});
```

回调有两个参数 `(err, data)`，其中 `data` 是文件的内容。

如果字符编码未指定，则返回原始的 buffer。

如果 `options` 是一个字符串，则它指定了字符编码。
例子：

```js
fs.readFile('/etc/passwd', 'utf8', callback);
```

任何指定的文件描述符必须支持读取。

注意，如果一个文件描述符被指定为 `file`，则它不会被自动关闭。


<!-- YAML
added: v0.1.31
-->

* `path` {String | Buffer}
* `options` {String | Object}
  * `encoding` {String} 默认 = `'utf8'`

同步的 readlink(2)。
返回符号链接的字符串值。

可选的 `options` 参数用于传入回调的链接路径，它可以是一个字符串并指定一个字符编码，或是一个对象且由一个 `encoding` 属性指定使用的字符编码。
如果 `encoding` 设为 `'buffer'`，则返回的链接路径会被作为 `Buffer` 对象传入。


<!-- YAML
added: v0.1.31
-->

* `path` {String | Buffer}
* `options` {String | Object}
  * `encoding` {String} 默认 = `'utf8'`
* `callback` {Function}

异步的 readlink(2)。
回调有两个参数  `(err, linkString)`。

可选的 `options` 参数用于传入回调的链接路径，它可以是一个字符串并指定一个字符编码，或是一个对象且由一个 `encoding` 属性指定使用的字符编码。
如果 `encoding` 设为 `'buffer'`，则返回的链接路径会被作为 `Buffer` 对象传入。


<!-- YAML
added: v0.1.21
-->

* `fd` {Integer}
* `buffer` {String | Buffer}
* `offset` {Integer}
* `length` {Integer}
* `position` {Integer}

[`fs.read()`] 的同步版本。
返回 `bytesRead` 的数量。


<!-- YAML
added: v0.0.2
-->

* `fd` {Integer}
* `buffer` {String | Buffer}
* `offset` {Integer}
* `length` {Integer}
* `position` {Integer}
* `callback` {Function}

从 `fd` 指定的文件中读取数据。

`buffer` 是数据将被写入到的 buffer。

`offset` 是 buffer 中开始写入的偏移量。

`length` 是一个整数，指定要读取的字节数。

`position` 是一个整数，指定从文件中开始读取的位置。
如果 `position` 为 `null`，则数据从当前文件位置开始读取。

回调有三个参数 `(err, bytesRead, buffer)`。


<!-- YAML
added: v0.1.31
-->

* `path` {String | Buffer};
* `options` {String | Object}
  * `encoding` {String} 默认 = `'utf8'`

同步的 realpath(3)。
返回解析的路径。

只支持可转换成 UTF8 字符串的路径。

可选的 `options` 参数用于传入回调的路径，它可以是一个字符串并指定一个字符编码，或是一个对象且由一个 `encoding` 属性指定使用的字符编码。
如果 `encoding` 设为 `'buffer'`，则返回的路径会被作为 `Buffer` 对象传入。


<!-- YAML
added: v0.1.31
-->

* `path` {String | Buffer}
* `options` {String | Object}
  * `encoding` {String} 默认 = `'utf8'`
* `callback` {Function}

异步的 realpath(3)。
`callback` 有两个参数 `(err, resolvedPath)`。
可以使用 `process.cwd` 解析相对路径。

只支持可转换成 UTF8 字符串的路径。

可选的 `options` 参数用于传入回调的路径，它可以是一个字符串并指定一个字符编码，或是一个对象且由一个 `encoding` 属性指定使用的字符编码。
如果 `encoding` 设为 `'buffer'`，则返回的路径会被作为 `Buffer` 对象传入。


<!-- YAML
added: v0.1.21
-->

* `oldPath` {String | Buffer}
* `newPath` {String | Buffer}

同步的 rename(2)。返回 `undefined`。


<!-- YAML
added: v0.0.2
-->

* `oldPath` {String | Buffer}
* `newPath` {String | Buffer}
* `callback` {Function}

异步的 rename(2)。
完成回调只有一个可能的异常参数。


<!-- YAML
added: v0.1.21
-->

* `path` {String | Buffer}

同步的 rmdir(2)。返回 `undefined`。


<!-- YAML
added: v0.0.2
-->

* `path` {String | Buffer}
* `callback` {Function}

异步的 rmdir(2)。
完成回调只有一个可能的异常参数。


<!-- YAML
added: v0.1.21
-->

* `path` {String | Buffer}

同步的 stat(2)。
返回一个 [`fs.Stats`] 实例。


<!-- YAML
added: v0.0.2
-->

* `path` {String | Buffer}
* `callback` {Function}

异步的 stat(2)。
回调有两个参数 `(err, stats)` 其中 `stats` 是一个 [`fs.Stats`] 对象。

如果发生错误，则 `err.code` 会是[常见系统错误]之一。

不建议在调用 `fs.open()` 、`fs.readFile()` 或 `fs.writeFile()` 之前使用 `fs.stat()` 检查一个文件是否存在。
作为替代，用户代码应该直接打开/读取/写入文件，当文件无效时再处理错误。

如果要检查一个文件是否存在且不操作它，推荐使用 [`fs.access()`]。


<!-- YAML
added: v0.1.31
-->

* `target` {String | Buffer}
* `path` {String | Buffer}
* `type` {String}

同步的 symlink(2)。返回 `undefined`。


<!-- YAML
added: v0.1.31
-->

* `target` {String | Buffer}
* `path` {String | Buffer}
* `type` {String}
* `callback` {Function}

异步的 symlink(2)。
完成回调只有一个可能的异常参数。
`type` 参数可以设为 `'dir'`、`'file'` 或 `'junction'`（默认为 `'file'`），且仅在 Windows 上有效（在其他平台上忽略）。
注意，Windows 结点要求目标路径是绝对的。
当使用 `'junction'` 时，`target` 参数会被自动标准化为绝对路径。

例子：

```js
fs.symlink('./foo', './new-port', callback);
```

它创建了一个名为 "new-port" 且指向 "foo" 的符号链接。


<!-- YAML
added: v0.8.6
-->

* `path` {String | Buffer}
* `len` {Integer} 默认 = `0`

同步的 truncate(2)。
返回 `undefined`。
文件描述符也可以作为第一个参数传入，在这种情况下，`fs.ftruncateSync()` 会被调用。


<!-- YAML
added: v0.8.6
-->

* `path` {String | Buffer}
* `len` {Integer} 默认 = `0`
* `callback` {Function}

异步的 truncate(2)。
完成回调只有一个可能的异常参数。
文件描述符也可以作为第一个参数传入，在这种情况下，`fs.ftruncate()` 会被调用。


<!-- YAML
added: v0.1.21
-->

* `path` {String | Buffer}

同步的 unlink(2)。返回 `undefined`。


<!-- YAML
added: v0.0.2
-->

* `path` {String | Buffer}
* `callback` {Function}

异步的 unlink(2)。
完成回调只有一个可能的异常参数。


<!-- YAML
added: v0.1.31
-->

* `filename` {String | Buffer}
* `listener` {Function}

停止监视 `filename` 文件的变化。
如果指定了 `listener`，则只移除特定的监听器。
否则，**所有**的监听器都会被移除，且已经有效地停止监视 `filename`。

调用 `fs.unwatchFile()` 且带上一个未被监视的文件名，将会是一个空操作，而不是一个错误。

注意：[`fs.watch()`] 比 `fs.watchFile()` 和 `fs.unwatchFile()` 更高效。
可能的话，应该使用 `fs.watch()` 而不是 `fs.watchFile()` 和 `fs.unwatchFile()`。


<!-- YAML
added: v0.4.2
-->

* `path` {String | Buffer}
* `atime` {Integer}
* `mtime` {Integer}

[`fs.utimes()`] 的同步版本。返回 `undefined`。


<!-- YAML
added: v0.4.2
-->

* `path` {String | Buffer}
* `atime` {Integer}
* `mtime` {Integer}
* `callback` {Function}

改变指定的路径所指向的文件的文件时间戳。

注意：`atime` 和 `mtime` 参数遵循以下规则：

- 值应该是一个以秒为单位的 Unix 时间戳。
  例如，`Date.now()` 返回毫秒，所以在传入前应该除以1000。
- 如果值是一个数值字符串，如 `'123456789'`，则该值会被转换为对应的数值。
- 如果值是 `NaN` 或 `Infinity`，则该值会被转换为 `Date.now() / 1000`。


<!-- YAML
added: v0.1.31
-->

* `filename` {String | Buffer}
* `options` {Object}
  * `persistent` {Boolean}
  * `interval` {Integer}
* `listener` {Function}

监视 `filename` 的变化。
回调 `listener` 会在每次访问文件时被调用。

`options` 参数可被省略。
如果提供的话，它应该是一个对象。
`options` 对象可能包含一个名为 `persistent` 的布尔值，表明当文件正在被监视时，进程是否应该继续运行。
`options` 对象可以指定一个 `interval` 属性，表示目标应该每隔多少毫秒被轮询。
默认值为 `{ persistent: true, interval: 5007 }`。

`listener` 有两个参数，当前的状态对象和以前的状态对象：

```js
fs.watchFile('message.text', (curr, prev) => {
  console.log(`the current mtime is: ${curr.mtime}`);
  console.log(`the previous mtime was: ${prev.mtime}`);
});
```

These stat objects are instances of `fs.Stat`.
这里的状态对象是 `fs.Stat` 实例。

如果你想在文件被修改而不只是访问时得到通知，则需要比较 `curr.mtime` 和 `prev.mtime`。

注意：当一个 `fs.watchFile` 的运行结果是一个 `ENOENT` 错误时，它会调用监听器一次，且将所有字段置零（或将日期设为 Unix 纪元）。
在 Windows 中，`blksize` 和 `blocks` 字段会是 `undefined` 而不是零。
如果文件是在那之后创建的，则监听器会被再次调用，且带上最新的状态对象。
这是在 v0.10 版之后在功能上的变化。

注意：[`fs.watch()`] 比 `fs.watchFile` 和 `fs.unwatchFile` 更高效。
可能的话，应该使用 `fs.watch` 而不是 `fs.watchFile` 和 `fs.unwatchFile`。


<!-- YAML
added: v0.5.10
-->

* `filename` {String | Buffer}
* `options` {String | Object}
  * `persistent` {Boolean} 指明如果文件正在被监视，进程是否应该继续运行。默认 = `true`
  * `recursive` {Boolean} 指明是否全部子目录应该被监视，或只是当前目录。
    适用于当一个目录被指定时，且只在支持的平台（详见 [Caveats]）。默认 = `false`
  * `encoding` {String} 指定用于传给监听器的文件名的字符编码。默认 = `'utf8'`
* `listener` {Function}

监视 `filename` 的变化，`filename` 可以是一个文件或一个目录。
返回的对象是一个 [`fs.FSWatcher`]。

第二个参数是可选的。
如果提供的 `options` 是一个字符串，则它指定了 `encoding`。
否则 `options` 应该以一个对象传入。

监听器回调有两个参数 `(eventType, filename)`。
`eventType` 可以是 `'rename'` 或 `'change'`，`filename` 是触发事件的文件的名称。

注意，在大多数平台，当一个文件出现或消失在一个目录里时，`'rename'` 会被触发。

还需要注意，监听器回调是绑定在由 [`fs.FSWatcher`] 触发的 `'change'` 事件上，但它跟 `eventType` 的 `'change'` 值不是同一个东西。


<!-- YAML
added: v0.1.29
-->

* `file` {String | Buffer | Integer} 文件名或文件描述符
* `data` {String | Buffer}
* `options` {Object | String}
  * `encoding` {String | Null} 默认 = `'utf8'`
  * `mode` {Integer} 默认 = `0o666`
  * `flag` {String} 默认 = `'w'`

[`fs.writeFile()`] 的同步版本。返回 `undefined`。


<!-- YAML
added: v0.1.29
-->

* `file` {String | Buffer | Integer} 文件名或文件描述符
* `data` {String | Buffer}
* `options` {Object | String}
  * `encoding` {String | Null} 默认 = `'utf8'`
  * `mode` {Integer} 默认 = `0o666`
  * `flag` {String} 默认 = `'w'`
* `callback` {Function}

异步地写入数据到文件，如果文件已经存在，则替代文件。
`data` 可以是一个字符串或一个 buffer。

如果 `data` 是一个 buffer，则忽略 `encoding` 选项。它默认为 `'utf8'`。

例子：

```js
fs.writeFile('message.txt', 'Hello Node.js', (err) => {
  if (err) throw err;
  console.log('The file has been saved!');
});
```

如果 `options` 是一个字符串，则它指定了字符编码。例如：

```js
fs.writeFile('message.txt', 'Hello Node.js', 'utf8', callback);
```

任何指定的文件描述符必须支持写入。

注意，多次对同一文件使用 `fs.writeFile` 且不等待回调，是不安全的。
对于这种情况，强烈推荐使用 `fs.createWriteStream`。

**注意：如果 `file` 指定为一个文件描述符，则它不会被自动关闭。**


<!-- YAML
added: v0.1.21
-->

* `fd` {Integer}
* `buffer` {String | Buffer}
* `offset` {Integer}
* `length` {Integer}
* `position` {Integer}


<!-- YAML
added: v0.11.5
-->

* `fd` {Integer}
* `data` {String | Buffer}
* `position` {Integer}
* `encoding` {String}

[`fs.write()`] 的同步版本。返回写入的字节数。


<!-- YAML
added: v0.0.2
-->

* `fd` {Integer}
* `buffer` {String | Buffer}
* `offset` {Integer}
* `length` {Integer}
* `position` {Integer}
* `callback` {Function}

写入 `buffer` 到 `fd` 指定的文件。

`offset` 决定 buffer 中被写入的部分，`length` 是一个整数，指定要写入的字节数。

`position` 指向从文件开始写入数据的位置的偏移量。
如果 `typeof position !== 'number'`，则数据从当前位置写入。详见 pwrite(2)。

回调有三个参数 `(err, written, buffer)`，其中 `written` 指定从 `buffer` 写入了多少**字节**。

注意，多次对同一文件使用 `fs.write` 且不等待回调，是不安全的。
对于这种情况，强烈推荐使用 `fs.createWriteStream`。

在 Linux 上，当文件以追加模式打开时，指定位置的写入是不起作用的。
内核会忽略位置参数，并总是将数据追加到文件的末尾。


<!-- YAML
added: v0.11.5
-->

* `fd` {Integer}
* `data` {String | Buffer}
* `position` {Integer}
* `encoding` {String}
* `callback` {Function}

写入 `data` 到 `fd` 指定的文件。
如果 `data` 不是一个 Buffer 实例，则该值将被强制转换为一个字符串。

`position` 指向从文件开始写入数据的位置的偏移量。
如果 `typeof position !== 'number'`，则数据从当前位置写入。详见 pwrite(2)。

`encoding` 是期望的字符串编码。

回调有三个参数 `(err, written, string)`，其中 `written` 指定传入的字符串被写入多少字节。
注意，写入的字节与字符串的字符是不同的。详见 [`Buffer.byteLength`]。

不同于写入 `buffer`，该方法整个字符串必须被写入。
不能指定子字符串。
这是因为结果数据的字节偏移量可能与字符串的偏移量不同。

注意，多次对同一文件使用 `fs.write` 且不等待回调，是不安全的。
对于这种情况，强烈推荐使用 `fs.createWriteStream`。

在 Linux 上，当文件以追加模式打开时，指定位置的写入是不起作用的。
内核会忽略位置参数，并总是将数据追加到文件的末尾。



<!--type=misc-->

在 Linux 或 OS X 系统中，`fs.watch()` 解析路径到一个[索引节点]，并监视该索引节点。
如果监视的路径被删除或重建，则它会被分配一个新的索引节点。
监视器会发出一个删除事件，但会继续监视**原始的**索引节点。
新建的索引节点的事件不会被触发。
这是正常的行为。


<!-- YAML
added: 6.4.0
-->

已读取的字节数。


<!-- YAML
added: v0.1.93
-->

流正在读取的文件的路径，指定在 `fs.createReadStream()` 的第一个参数。
如果 `path` 传入的是一个字符串，则 `readStream.path` 是一个字符串。
如果 `path` 传入的是一个 `Buffer`，则 `readStream.path` 是一个 `Buffer`。



stat 对象中的时间有以下语义：

* `atime` "访问时间" - 文件数据最近被访问的时间。
  会被 mknod(2)、 utimes(2) 和 read(2) 系统调用改变。
* `mtime` "修改时间" - 文件数据最近被修改的时间。
  会被 mknod(2)、 utimes(2) 和 write(2) 系统调用改变。
* `ctime` "变化时间" - 文件状态最近更改的时间（修改索引节点数据）
  会被 chmod(2)、 chown(2)、 link(2)、 mknod(2)、 rename(2)、 unlink(2)、 utimes(2)、 read(2) 和 write(2) 系统调用改变。
* `birthtime` "创建时间" -  文件创建的时间。
  当文件被创建时设定一次。
  在创建时间不可用的文件系统中，该字段可能被替代为 `ctime` 或 `1970-01-01T00:00Z`（如 Unix 的纪元时间戳 `0`）。
  注意，该值在此情况下可能会大于 `atime` 或 `mtime`。
  在 Darwin 和其它的 FreeBSD 衍生系统中，如果 `atime` 被使用 utimes(2) 系统调用显式地设置为一个比当前 `birthtime` 更早的值，也会有这种情况。

在 Node.js v0.12 之前的版本中，`ctime` 在 Windows 系统中保存 `birthtime`。
注意，在 v0.12 中，`ctime` 不是“创建时间”，并且在 Unix 系统中，它从来都不是。


<!-- YAML
added: v0.5.8
-->

停止监视给定的 `fs.FSWatcher` 的变化。


<!-- YAML
added: v0.4.7
-->

已写入的字节数。
不包括仍在排队等待写入的数据。


<!-- YAML
added: v0.1.93
-->

流正在写入的文件的路径，指定在 `fs.createWriteStream()` 的第一个参数。
如果 `path` 传入的是一个字符串，则 `writeStream.path` 是一个字符串。
如果 `path` 传入的是一个 `Buffer`，则 `writeStream.path` 是一个 `Buffer`。



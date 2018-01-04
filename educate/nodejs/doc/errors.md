
<!--type=class-->

一个通用的 JavaScript `Error` 对象，它不表示错误发生的具体情况。
`Error` 对象会捕捉一个“堆栈跟踪”，详细说明被实例化的 `Error` 对象在代码中的位置，并可能提供错误的文字描述。

所有由 Node.js 产生的错误，包括所有系统的和 JavaScript 的错误都实例化自或继承自 `Error` 类。



`Error` 的一个子类，表明一个函数的一个给定的参数的值不在可接受的集合或范围内；
无论是一个数字范围还是给定函数参数的选项的集合。

例子：

```js
require('net').connect(-1);
  // 抛出 "RangeError: "port" option should be >= 0 and < 65536: -1"
```

Node.js 会生成并以参数校验的形式立即抛出 `RangeError` 实例。



`Error` 的一个子类，表明试图访问一个未定义的变量。
这些错误通常表明代码有拼写错误或程序已损坏。

虽然客户端代码可能产生和传播这些错误，但在实践中，只有 V8 引擎会这么做。

```js
doesNotExist;
  // 抛出 ReferenceError，在这个程序中 doesNotExist 不是一个变量。
```

除非应用程序是动态生成并运行的代码，否则 `ReferenceError` 实例应该始终被视为代码中或其依赖中的错误。



`Error` 的一个子类，表明程序不是有效的 JavaScript 代码。
这些错误是代码执行的结果产生和传播的。
代码执行可能产生自 `eval`、`Function`、`require` 或 [vm]。
这些错误几乎都表明程序已损坏。


```js
try {
  require('vm').runInThisContext('binary ! isNotOk');
} catch (err) {
  // err 是一个 SyntaxError
}
```

`SyntaxError` 实例在创建它们的上下文中是不可恢复的。
它们只可被其他上下文捕获。





`Error` 的一个子类，表明提供的参数不是一个被允许的类型。
例如，将一个函数传给一个期望字符串的参数会被视为一个 `TypeError`。

```js
require('url').parse(() => { });
  // 抛出 TypeError，因为它期望的是一个字符串
```

Node.js 会生成并以参数校验的形式立即抛出 `TypeError` 实例。



以下列表是不完整的，但列举了编写 Node.js 程序时会遇到的一些常见的系统错误。
详细的列表可从 [ERRNO 文档]找到。

- `EACCES` (拒绝访问): 试图以被一个文件的访问权限禁止的方式访问一个文件。

- `EADDRINUSE` (地址已被使用):  试图绑定一个服务器（[`net`]、[`http`] 或 [`https`]）到本地地址，但因另一个本地系统的服务器已占用了该地址而导致失败。

- `ECONNREFUSED` (连接被拒绝): 无法连接，因为目标机器积极拒绝。
  这通常是因为试图连接到外部主机上的废弃的服务。

- `ECONNRESET` (连接被重置): 一个连接被强行关闭。
  这通常是因为连接到远程 socket 超时或重启。
  常发生于 [`http`] 和 [`net`] 模块。

- `EEXIST` (文件已存在): 一个操作的目标文件已存在，而要求目标不存在。

- `EISDIR` (是一个目录): 一个操作要求一个文件，但给定的路径是一个目录。

- `EMFILE` (系统打开了太多文件): 已达到系统[文件描述符]允许的最大数量，且描述符的请求不能被满足直到至少关闭其中一个。
  当一次并行打开多个文件时会发生这个错误，尤其是在进程的文件描述限制数量较低的操作系统（如 OS X）。
  要解决这个限制，可在运行 Node.js 进程的同一 shell 中运行 `ulimit -n 2048`。

- `ENOENT` (无此文件或目录): 通常是由 [`fs`] 操作引起的，表明指定的路径不存在，即给定的路径找不到文件或目录。

- `ENOTDIR` (不是一个目录): 给定的路径虽然存在，但不是一个目录。
  通常是由 [`fs.readdir`] 引起的。

- `ENOTEMPTY` (目录非空): 一个操作的目标是一个非空的目录，而要求的是一个空目录。
  通常是由 [`fs.unlink`] 引起的。

- `EPERM` (操作不被允许): 试图执行一个需要更高权限的操作。

- `EPIPE` (管道损坏): 写入一个管道、socket 或 FIFO 时没有进程读取数据。
  常见于 [`net`] 和 [`http`] 层，表明远端要写入的流已被关闭。

- `ETIMEDOUT` (操作超时): 一个连接或发送的请求失败，因为连接方在一段时间后没有做出合适的响应。
  常见于 [`http`] 或 [`net`]。
  往往标志着 `socket.end()` 没有被正确地调用。



<!--type=misc-->

Node.js 中运行的应用程序一般会遇到以下四类错误：

- 标准的 JavaScript 错误：
  - {EvalError} : 当调用 `eval()` 失败时抛出。
  - {SyntaxError} : 当 JavaScript 语法错误时抛出。
  - {RangeError} : 当一个值不在预期范围内时抛出。
  - {ReferenceError} : 当使用未定义的变量时抛出。
  - {TypeError} : 当传入错误类型的参数时抛出。
  - {URIError} : 当一个全局的 URI 处理函数被误用时抛出。
- 由底层操作系的触发的系统错误，例如试图打开一个不存在的文件、试图向一个已关闭的 socket 发送数据等。
- 由应用程序代码触发的用户自定义的错误。
- 断言错误是错误的一个特殊的类，每当 Node.js 检测到一个不应该发生的异常逻辑时会触发。
  这类错误通常由 `assert` 模块触发。

所有 Node.js 引起的 JavaScript 和系统错误都是继承自或实例化自标准的 JavaScript 的 {Error} 类，且保证至少提供类中的可用的属性。



* {String}

When present (e.g. in `net` or `dgram`), the `error.address` property is a string
describing the address to which the connection failed.



* `targetObject` {Object}
* `constructorOpt` {Function}

在 `targetObject` 上创建一个 `.stack` 属性，当访问时返回一个表示代码中调用 `Error.captureStackTrace()` 的位置的字符串。

```js
const myObject = {};
Error.captureStackTrace(myObject);
myObject.stack;  // 类似 `new Error().stack`
```

跟踪的第一行，不是前缀为 `ErrorType: message`，而是调用 `targetObject.toString()` 的结果。

可选的 `constructorOpt` 参数接受一个函数。
如果提供了，则 `constructorOpt` 之上包括自身在内的全部栈帧都会被生成的堆栈跟踪省略。

`constructorOpt` 参数用在向最终用户隐藏错误生成的具体细节时非常有用。例如：


```js
function MyError() {
  Error.captureStackTrace(this, MyError);
}

// 没传入 MyError 到 captureStackTrace，MyError 帧会显示在 .stack 属性。
// 通过传入构造函数，可以省略该帧及其之上的所有帧。
new MyError().stack;
```



* {String}

`error.code` 属性是一个表示错误码的字符串，总是 `E` 带上一串大写字母。



* {String | Number}

`error.errno` 属性是一个数值或字符串。
如果返回一个数值，则数值是一个负数，对应 [`libuv 错误处理`] 中定义的错误码。
详见 uv-errno.h 头文件（Node.js 源代码中的 `deps/uv/include/uv-errno.h`）。
如果返回一个字符串，则同 `error.code`。



* {String}

`error.message` 属性是错误的字符串描述，通过调用 `new Error(message)` 设置。
传给构造函数的 `message` 也会出现在 `Error` 的堆栈跟踪的第一行。
但是，`Error` 对象创建后改变这个属性可能不会改变堆栈跟踪的第一行（比如当 `error.stack` 在该属性被改变之前被读取）。

```js
const err = new Error('错误信息');
console.error(err.message);
// 打印: 错误信息
```



* {String}

When present (e.g. in `fs` or `child_process`), the `error.path` property is a string
containing a relevant invalid pathname.



* {Number}

When present (e.g. in `net` or `dgram`), the `error.port` property is a number representing
the connection's port that is not available.



<!--type=misc-->

Node.js 支持几种当应用程序运行时发生的错误的冒泡和处理的机制。
如何报告和处理这些错误完全取决于错误的类型和被调用的 API 的风格。

所有 JavaScript 错误都会被作为异常处理，异常会立即产生并使用标准的 JavaScript `throw` 机制抛出一个错误。
这些都是使用 JavaScript 语言提供的 [`try / catch` 语句]处理的。


```js
// 抛出一个 ReferenceError，因为 z 为 undefined
try {
  const m = 1;
  const n = m + z;
} catch (err) {
  // 在这里处理错误。
}
```

JavaScript 的 `throw` 机制的任何使用都会引起异常，异常必须使用 `try / catch` 处理，否则 Node.js 进程会立即退出。

除了少数例外，同步的 API（任何不接受 `callback` 函数的阻塞方法，例如 [`fs.readFileSync`]）会使用 `throw` 报告错误。

异步的 API 中发生的错误可能会以多种方式进行报告：

- 大多数的异步方法都接受一个 `callback` 函数，该函数会接受一个 `Error` 对象传入作为第一个参数。
  如果第一个参数不是 `null` 而是一个 `Error` 实例，则说明发生了错误，应该进行处理。

  ```js
  const fs = require('fs');
  fs.readFile('一个不存在的文件', (err, data) => {
    if (err) {
      console.error('读取文件出错！', err);
      return;
    }
    // 否则处理数据
  });
  ```
- 当一个异步方法被一个 `EventEmitter` 对象调用时，错误会被分发到对象的 `'error'` 事件上。

  ```js
  const net = require('net');
  const connection = net.connect('localhost');

  // 添加一个 'error' 事件句柄到一个流：
  connection.on('error', (err) => {
    // 如果连接被服务器重置，或无法连接，或发生任何错误，则错误会被发送到这里。 
    console.error(err);
  });

  connection.pipe(process.stdout);
  ```

- Node.js API 中有一小部分普通的异步方法仍可能使用 `throw` 机制抛出异常，且必须使用 `try / catch` 处理。
  这些方法并没有一个完整的列表；请参阅各个方法的文档以确定所需的合适的错误处理机制。

`'error'` 事件机制的使用常见于[基于流]和[基于事件触发器]的 API，它们本身就代表了一系列的异步操作（相对于要么成功要么失败的单一操作）。

对于所有的 `EventEmitter` 对象，如果没有提供一个 `'error'` 事件句柄，则错误会被抛出，并造成 Node.js 进程报告一个未处理的异常且随即崩溃，除非：
适当地使用 [`domain`] 模块或已经注册了一个 [`process.on('uncaughtException')`] 事件的句柄。

```js
const EventEmitter = require('events');
const ee = new EventEmitter();

setImmediate(() => {
  // 这会使进程崩溃，因为还为添加 'error' 事件句柄。
  ee.emit('error', new Error('这会崩溃'));
});
```

这种方式产生的错误无法使用 `try / catch` 截获，因为它们是在调用的代码已经退出后抛出的。

开发者必须查阅各个方法的文档以明确在错误发生时这些方法是如何冒泡的。



* {String}

`error.stack` 属性是一个字符串，描述代码中 `Error` 被实例化的位置。

例子：

```txt
Error: Things keep happening!
   at /home/gbusey/file.js:525:2
   at Frobnicator.refrobulate (/home/gbusey/business-logic.js:424:21)
   at Actor.<anonymous> (/home/gbusey/actors.js:400:8)
   at increaseSynergy (/home/gbusey/actors.js:701:6)
```

第一行会被格式化为 `<error class name>: <error message>`，且带上一系列栈帧（每一行都以 "at " 开头）。
每一帧描述了一个代码中导致错误生成的调用点。
V8 引擎会试图显示每个函数的名称（变量名、函数名、或对象的方法名），但偶尔也可能找不到一个合适的名称。
如果 V8 引擎没法确定一个函数的名称，则只显示帧的位置信息。
否则，在位置信息的旁边会显示明确的函数名。

注意，帧只由 JavaScript 函数产生。
例如，同步地执行一个名为 `cheetahify` 的 C++ 插件，且插件自身调用一个 JavaScript 函数，代表 `cheetahify` 回调的栈帧不会出现在堆栈跟踪里：


```js
const cheetahify = require('./native-binding.node');

function makeFaster() {
  // cheetahify 同步地调用 speedy.
  cheetahify(function speedy() {
    throw new Error('oh no!');
  });
}

makeFaster(); // 会抛出：
  // /home/gbusey/file.js:6
  //     throw new Error('oh no!');
  //           ^
  // Error: oh no!
  //     at speedy (/home/gbusey/file.js:6:11)
  //     at makeFaster (/home/gbusey/file.js:5:3)
  //     at Object.<anonymous> (/home/gbusey/file.js:10:1)
  //     at Module._compile (module.js:456:26)
  //     at Object.Module._extensions..js (module.js:474:10)
  //     at Module.load (module.js:356:32)
  //     at Function.Module._load (module.js:312:12)
  //     at Function.Module.runMain (module.js:497:10)
  //     at startup (node.js:119:16)
  //     at node.js:906:3
```

位置信息会是其中之一：

* `native`，帧表示一个 V8 引擎内部的调用（比如，`[].forEach`）。
* `plain-filename.js:line:column`，帧表示一个 Node.js 内部的调用。
* `/absolute/path/to/file.js:line:column`，帧表示一个用户程序或其依赖的调用。

代表堆栈跟踪的字符串是在 `error.stack` 属性被访问时才生成的。

堆栈跟踪捕获的帧的数量是由 `Error.stackTraceLimit` 或当前事件循环中可用的帧数量的最小值界定的。

系统级的错误是由扩展的 `Error` 实例产生的，详见[系统错误]。



* {Number}

`Error.stackTraceLimit` 属性指定了堆栈跟踪收集的栈帧数量（无论是 `new Error().stack` 或 `Error.captureStackTrace(obj)` 产生的）。

默认值为 `10` ，但可设为任何有效的 JavaScript 数值。
值改变后的变化会影响所有捕获到的堆栈跟踪。

如果设为一个非数值或负数，则堆栈跟踪不会捕捉任何栈帧。



* {String}

`error.syscall` 属性是一个字符串，描述失败的 [系统调用]。



<!--type=misc-->

JavaScript 异常是一个作为一个无效操作的结果或作为一个 `throw` 声明的目标所抛出的值。
虽然它不要求这些值是 `Error` 的实例或继承自 `Error` 的类的实例，但所有通过 Node.js 或 JavaScript 运行时抛出的异常都是 `Error` 实例。

有些异常在 JavaScript 层是无法恢复的。
这些异常总会引起 Node.js 进程的崩溃。
例如 `assert()` 检测或在 C++ 层调用的 `abort()`。



* `message` {String}

新建一个 `Error` 实例，并设置 `error.message` 属性以提供文本信息。
如果 `message` 传的是一个对象，则会调用 `message.toString()` 生成文本信息。
`error.stack` 属性表示被调用的 `new Error()` 在代码中的位置。
堆栈跟踪是基于 [V8 的堆栈跟踪 API] 的。
堆栈跟踪只会取（a）异步代码执行的开头或（b）`Error.stackTraceLimit` 属性给出的栈帧中的最小项。



<!--type=misc-->

大多数由 Node.js 核心 API 暴露出来的异步方法都遵循一个被称为“Node.js 风格的回调”的惯用模式。
使用这种模式，一个回调函数是作为一个参数传给方法的。
当操作完成或发生错误时，回调函数会被调用，并带上错误对象（如果有）作为第一个参数。
如果没有发生错误，则第一个参数为 `null`。


```js
const fs = require('fs');

function nodeStyleCallback(err, data) {
  if (err) {
    console.error('There was an error', err);
    return;
  }
  console.log(data);
}

fs.readFile('/some/file/that/does-not-exist', nodeStyleCallback);
fs.readFile('/some/file/that/does-exist', nodeStyleCallback);
```

JavaScript 的 `try / catch` 机制无法用于捕获由异步 API 引起的错误。
尝试使用 `throw` 而不是一个 Node.js 风格的回调，是初学者常犯的错误：


```js
// 这无法使用：
const fs = require('fs');

try {
  fs.readFile('/some/file/that/does-not-exist', (err, data) => {
    // 假设的错误：在这里抛出
    if (err) {
      throw err;
    }
  });
} catch (err) {
  // 这不会捕获到抛出！
  console.error(err);
}
```

这无法使用，因为传给 `fs.readFile()` 的回调函数是被异步地调用。
当回调被调用时，周围的代码（包括 `try { } catch (err) { }` 区域）已经退出。
大多数情况下，在回调内抛出一个错误会使 Node.js 进程崩溃。
如果[域]已启用，或已在 `process.on('uncaughtException')` 注册了一个句柄，则这些错误可被捕获。



系统错误是当程序运行环境中发生异常时产生的。
特别是，当应用程序违反了操作系统的限制时发生的操作错误，例如试图读取一个不存在的文件或用户没有足够的权限。

系统错误通常产生于系统调用层级。
在大多数 Unix 系统上，可通过运行 `man 2 intro`、`man 3 errno`、或[在线文档]获取错误代码的详细清单和含义。

系统错误是由扩展的 `Error` 对象加上附加属性表现的。



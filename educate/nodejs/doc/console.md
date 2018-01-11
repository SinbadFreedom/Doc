
`console` 函数通常是异步的，除非目标是一个文件。
带有高速磁盘的操作系统通常采用回写缓存；写入阻塞是一个非常罕见的情况，但存在可能性。

此外，当输出到 OS X 的 TTY（终端）时，因操作系统较小的 1kb 的缓存大小，`console` 函数会遭到阻塞。
这是为了防止 `stdout` 和 `stderr` 的交叉存取。


##Console 类

`Console` 类可用于创建一个具有可配置的输出流的简单记录器，可以通过 `require('console').Console` 或 `console.Console` 使用：

```js
const Console = require('console').Console;
const Console = console.Console;
```


#console (控制台)
> 稳定性: 2 - 稳定的

`console` 模块提供了一个简单的调试控制台，它与 Web 浏览器提供的 JavaScript 控制台的机制类似。

该模块导出两个特定组件：

* 一个 `Console` 类，包含 `console.log()` 、 `console.error()` 和 `console.warn()` 等方法，可以用于写入到任何 Node.js 流。
* 一个全局的 `console` 实例，用于写入 [`process.stdout`] 和 [`process.stderr`]。
  全局的 `console` 使用时无需调用 `require('console')`。

注意：全局的 console 对象的方法既不总是同步的（如浏览器中类似的 API），也不总是异步的（如其他 Node.js 流）。
详见 [关于 process I/O]。

例子：使用全局的 `console`：

```js
console.log('hello world');
// 打印: hello world 到 stdout
console.log('hello %s', 'world');
// 打印: hello world 到 stdout
console.error(new Error('错误信息'));
// 打印: [Error: 错误信息] 到 stderr

const name = 'Will Robinson';
console.warn(`Danger ${name}! Danger!`);
// 打印: Danger Will Robinson! Danger! 到 stderr
```

例子：使用 `Console` 类：

```js
const out = getStreamSomehow();
const err = getStreamSomehow();
const myConsole = new console.Console(out, err);

myConsole.log('hello world');
// 打印: hello world 到 out
myConsole.log('hello %s', 'world');
// 打印: hello world 到 out
myConsole.error(new Error('错误信息'));
// 打印: [Error: 错误信息] 到 err

const name = 'Will Robinson';
myConsole.warn(`Danger ${name}! Danger!`);
// 打印: Danger Will Robinson! Danger! 到 err
```


###console.assert(value[, message][, ...args])

一个简单的断言测试，验证 `value` 是否为真。
如果不为真，则抛出 `AssertionError`。
如果提供了 `message`，则使用 [`util.format()`] 格式化并作为错误信息使用。

```js
console.assert(true, 'does nothing');
// 通过
console.assert(false, 'Whoops %s', 'didn\'t work');
// AssertionError: Whoops didn't work
```

注意：Node.js 中的 `console.assert()` 方法与[在浏览器中]的 `console.assert()` 方法的实现是不一样的。

具体地说，在浏览器中，用非真的断言调用 `console.assert()` 会导致 `message` 被打印到控制台但不会中断后续代码的执行。
而在 Node.js 中，非真的断言会导致抛出 `AssertionError`。

可以通过扩展 Node.js 的 `console` 并重写 `console.assert()` 方法来实现与浏览器中类似的功能。

例子，创建一个简单的模块，并扩展与重写了 Node.js 中 `console` 的默认行为。

```js
'use strict';

// 用一个新的不带补丁的 assert 实现来创建一个简单的 console 扩展。
const myConsole = Object.create(console, {
  assert: {
    value: function assert(assertion, message, ...args) {
      try {
        console.assert(assertion, message, ...args);
      } catch (err) {
        console.error(err.stack);
      }
    },
    configurable: true,
    enumerable: true,
    writable: true,
  },
});

module.exports = myConsole;
```

然后可以用来直接替换内置的 console：

```js
const console = require('./myConsole');
console.assert(false, '会打印这个消息，但不会抛出错误');
console.log('这个也会打印');
```


###console.dir(obj[, options])

在 `obj` 上使用 [`util.inspect()`] 并打印结果字符串到 `stdout`。
该函数会绕过任何定义在 `obj` 上的自定义的 `inspect()` 函数。
可选的 `options` 对象可以传入用于改变被格式化的字符串：

- `showHidden` - 如果为 `true`，则该对象中的不可枚举属性和 symbol 属性也会显示。默认为 `false`。

- `depth` - 告诉 [`util.inspect()`] 函数当格式化对象时要递归多少次。
这对于检查较大的复杂对象很有用。
默认为 `2`。
设为 `null` 可无限递归。

- `colors` - 如果为 `true`，则输出会带有 ANSI 颜色代码。
默认为 `false`。
颜色是可定制的，详见[定制 `util.inspect()` 颜色]。


###console.error([data][, ...args])

打印到 `stderr`，并带上换行符。
可以传入多个参数，第一个参数作为主要信息，其他参数作为类似于 printf(3) 中的代替值（参数都会传给 [`util.format()`]）。

```js
const code = 5;
console.error('error #%d', code);
// 打印: error #5 到 stderr
console.error('error', code);
// 打印: error 5 到 stderr
```

如果在第一个字符串中没有找到格式化元素（如 `%d`），则在每个参数上调用 [`util.inspect()`] 并将结果字符串值拼在一起。
详见 [`util.format()`]。


###console.info([data][, ...args])

`console.info()` 函数是 [`console.log()`] 的一个别名。


###console.log([data][, ...args])

打印到 `stdout`，并带上换行符。
可以传入多个参数，第一个参数作为主要信息，其他参数作为类似于 printf(3) 中的代替值（参数都会传给 [`util.format()`]）。

```js
const count = 5;
console.log('count: %d', count);
// 打印: count: 5 到 stdout
console.log('count:', count);
// 打印: count: 5 到 stdout
```

如果在第一个字符串中没有找到格式化元素（如 `%d`），则在每个参数上调用 [`util.inspect()`] 并将结果字符串值拼在一起。
详见 [`util.format()`]。


###console.timeEnd(label)

停止之前通过调用 [`console.time()`] 启动的定时器，并打印结果到 `stdout`：

```js
console.time('100-elements');
for (let i = 0; i < 100; i++) {
  ;
}
console.timeEnd('100-elements');
// 打印 100-elements: 225.438ms
```

注意：从 Node.js v6.0.0 开始，`console.timeEnd()` 删除了计时器以避免泄漏。
在旧版本上，计时器依然保留。
它允许 `console.timeEnd()` 可以多次调用同一标签。
此功能是非计划中的，不再被支持。


###console.time(label)

启动一个定时器，用以计算一个操作的持续时间。
定时器由一个唯一的 `label` 标识。
当调用 [`console.timeEnd()`] 时，可以使用相同的 `label` 来停止定时器，并以毫秒为单位将持续时间输出到 `stdout`。
定时器持续时间精确到亚毫秒。


###console.trace([message][, ...args])

打印字符串 `'Trace :'` 到 `stderr` ，并通过 [`util.format()`] 格式化消息与堆栈跟踪在代码中的当前位置。

```js
console.trace('Show me');
// 打印: (堆栈跟踪会根据被调用的跟踪的位置而变化)
//  Trace: Show me
//    at repl:2:9
//    at REPLServer.defaultEval (repl.js:248:27)
//    at bound (domain.js:287:14)
//    at REPLServer.runBound [as eval] (domain.js:300:12)
//    at REPLServer.<anonymous> (repl.js:412:12)
//    at emitOne (events.js:82:20)
//    at REPLServer.emit (events.js:169:7)
//    at REPLServer.Interface._onLine (readline.js:210:10)
//    at REPLServer.Interface._line (readline.js:549:8)
//    at REPLServer.Interface._ttyWrite (readline.js:826:14)
```


###console.warn([data][, ...args])

`console.warn()` 函数是 [`console.error()`] 的一个别名。


###new Console(stdout[, stderr])
通过传入一个或两个可写流实例，创建一个新的 `Console` 对象。
`stdout` 是一个可写流，用于打印日志或输出信息。
`stderr` 用于输出警告或错误。
如果没有传入 `stderr` ，则警告或错误输出会被发送到 `stdout` 。


```js
const output = fs.createWriteStream('./stdout.log');
const errorOutput = fs.createWriteStream('./stderr.log');
// 自定义的简单记录器
const logger = new Console(output, errorOutput);
// 像 console 一样使用
const count = 5;
logger.log('count: %d', count);
// stdout.log 中打印: count 5
```

全局的 `console` 是一个特殊的 `Console` 实例，它的输出会发送到 [`process.stdout`] 和 [`process.stderr`]。
相当于调用：

```js
new Console(process.stdout, process.stderr);
```



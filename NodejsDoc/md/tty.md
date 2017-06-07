<!-- YAML
added: v0.5.8
-->

`tty.ReadStream` 类是 `net.Socket` 的一个子类，表示一个 TTY 的可读部分。
正常情况下，`process.stdin` 是一个 Node.js 进程中唯一的 `tty.ReadStream` 实例，没有理由创建更多的实例。


<!-- YAML
added: v0.5.8
-->

`tty.WriteStream` 类是 `net.Socket` 的一个子类，表示一个 TTY 的可写部分。
正常情况下，`process.stdout` 和 `process.stderr` 是一个 Node.js 进程中唯一的 `tty.WriteStream` 实例，没有理由创建更多的实例。


<!-- YAML
added: v0.7.7
-->

当 `writeStream.columns` 属性或 `writeStream.rows` 属性发生变化时触发 `'resize'` 事件。
监听器回调没有参数传入。

	
    process.stdout.on('resize', () => {
      console.log('屏幕大小已改变！');
      console.log(`${process.stdout.columns}x${process.stdout.rows}`);
    });
	


<!-- YAML
added: v0.7.7
-->

一个 `boolean` 值，如果 TTY 当前被配置成作为一个原始设备来操作，则返回 `true`。
默认为 `false`。


<!-- YAML
added: v0.7.7
-->

允许配置 `tty.ReadStream` 作为一个原始设备来操作。

当在原始模式中，输入总是按字符生效，但不包括修饰符。
此外，终端对字符的所有特殊处理会被禁用，包括应答输入的字符。
注意，该模式中 `CTRL`+`C` 不再产生一个 `SIGINT`。

* `mode` {boolean} 如果为 `true`，则配置 `tty.ReadStream` 作为一个原始设备来操作。
  如果为 `false`，则配置 `tty.ReadStream` 以默认模式来操作。
  `readStream.isRaw` 属性会被设为对应的值。



> 稳定性: 2 - 稳定的

`tty` 模块提供了 `tty.ReadStream` 类和 `tty.WriteStream` 类。
大多数情况下无需直接使用此模块。
它可以通过以下方式使用：

	
    const tty = require('tty');
	

当 Node.js 检测到它正被运行在一个文本终端（TTY）的上下文中时，则 `process.stdin` 默认会被初始化为一个 `tty.ReadStream` 实例，`process.stdout` 和 `process.stderr` 默认会被初始化为一个 `tty.WriteStream` 实例。
判断 Node.js 是否正被运行在一个 TTY 上下文中的首选方法是去检查 `process.stdout.isTTY` 属性的值是否为 `true`：


	
    $ node -p -e "Boolean(process.stdout.isTTY)"
    true
    $ node -p -e "Boolean(process.stdout.isTTY)" | cat
    false
	

大多数情况下，应用程序几乎没有理由创建 `tty.ReadStream` 类和 `tty.WriteStream` 类的实例。


<!-- YAML
added: v0.5.8
-->

* `fd` {number} 一个数值型的文件描述符。

如果给定的 `fd` 与一个 TTY 相关联，则 `tty.isatty()` 方法返回 `true`，否则返回 `false`。


<!-- YAML
added: v0.7.7
-->

一个 `number`，指明 TTY 当前具有的列数。
当 `'resize'` 事件被触发时，该属性会被更新。


<!-- YAML
added: v0.7.7
-->

一个 `number`，指明 TTY 当前具有的行数。
当 `'resize'` 事件被触发时，该属性会被更新。



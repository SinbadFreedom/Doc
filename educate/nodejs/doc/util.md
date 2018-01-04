
<!-- type=misc -->

可以通过 `util.inspect.styles` 和 `util.inspect.colors` 属性全局地自定义 `util.inspect` 的颜色输出（如果已启用）。

`util.inspect.styles` 是一个映射，关联一个样式名到一个 `util.inspect.colors` 颜色。

默认的样式与关联的颜色有：

 * `number` - `yellow`
 * `boolean` - `yellow`
 * `string` - `green`
 * `date` - `magenta`
 * `regexp` - `red`
 * `null` - `bold`
 * `undefined` - `grey`
 * `special` - `cyan` （暂时只用于函数）
 * `name` - （无样式）

预定义的颜色代码有：`white`、`grey`、`black`、`blue`、`cyan`、`green`、`magenta``red` 和 `yellow`。
还有 `bold`、`italic`、`underline` 和 `inverse` 代码。

颜色样式使用 ANSI 控制码，可能不是所有终端都支持。



<!-- type=misc -->

对象可以定义自己的 `[util.inspect.custom](depth, opts)`（或 `inspect(depth, opts)`） 函数，`util.inspect()` 会调用并使用查看对象时的结果：

```js
const util = require('util');

class Box {
  constructor(value) {
    this.value = value;
  }

  inspect(depth, options) {
    if (depth < 0) {
      return options.stylize('[Box]', 'special');
    }

    const newOptions = Object.assign({}, options, {
      depth: options.depth === null ? null : options.depth - 1
    });

    // 五个空格的填充，因为那是 "Box< " 的大小。
    const padding = ' '.repeat(5);
    const inner = util.inspect(this.value, newOptions).replace(/\n/g, '\n' + padding);
    return options.stylize('Box', 'special') + '< ' + inner + ' >';
  }
}

const box = new Box(true);

util.inspect(box);
// 返回: "Box< true >"
```

自定义的 `[util.inspect.custom](depth, opts)` 函数通常返回一个字符串，但也可以返回一个任何类型的值，它会相应地被 `util.inspect()` 格式化。

```js
const util = require('util');

const obj = { foo: '这个不会出现在 inspect() 的输出中' };
obj[util.inspect.custom] = function(depth) {
  return { bar: 'baz' };
};

util.inspect(obj);
// 返回: "{ bar: 'baz' }"
```

一个自定义的查看方法可以通过在一个对象上开放一个 `inspect(depth, opts)` 方法来提供：

```js
const util = require('util');

const obj = { foo: '这个不会出现在 inspect() 的输出中' };
obj.inspect = function(depth) {
  return { bar: 'baz' };
};

util.inspect(obj);
// 返回: "{ bar: 'baz' }"
```



以下 API 已被废弃，不应该再被使用。
现存的应用和模块应该使用替代方法更新。



> 稳定性: 2 - 稳定的

`util` 模块主要用于支持 Node.js 内部 API 的需求。
大部分实用工具也可用于应用程序与模块开发者。
它可以通过以下方式使用：

```js
const util = require('util');
```


<!-- YAML
added: v0.11.3
-->

* `section` {String} 一个字符串，指定要为应用的哪些部分创建 `debuglog` 函数。
  `debuglog` 函数要为哪些应用创建。
* 返回: {Function} 日志函数

`util.debuglog()` 方法用于创建一个函数，基于 `NODE_DEBUG` 环境变量的存在与否有条件地写入调试信息到 `stderr`。
如果 `section` 名称在环境变量的值中，则返回的函数类似于 [`console.error()`]。
否则，返回的函数是一个空操作。

例子：

```js
const util = require('util');
const debuglog = util.debuglog('foo');

debuglog('hello from foo [%d]', 123);
```

如果程序在环境中运行时带上 `NODE_DEBUG=foo`，则输出类似如下： 

```txt
FOO 3245: hello from foo [123]
```

其中 `3245` 是进程 id。
如果运行时没带上环境变量集合，则不会打印任何东西。

`NODE_DEBUG` 环境变量中可指定多个由逗号分隔的 `section` 名称。
例如：`NODE_DEBUG=fs,net,tls`。


<!-- YAML
added: v0.3.0
deprecated: v0.11.3
-->

> 稳定性: 0 - 废弃的: 使用 [`console.error()`] 代替。

* `string` {String} The message to print to `stderr`

Deprecated predecessor of `console.error`.


<!-- YAML
added: v0.8.0
-->

`util.deprecate()` 方法会包装给定的 `function` 或类，并标记为废弃的。

```js
const util = require('util');

exports.puts = util.deprecate(function() {
  for (var i = 0, len = arguments.length; i < len; ++i) {
    process.stdout.write(arguments[i] + '\n');
  }
}, 'util.puts: 使用 console.log 代替');
```

当被调用时，`util.deprecate()` 会返回一个函数，这个函数会使用 `process.on('warning')` 事件触发一个 `DeprecationWarning`。
默认情况下，警告只在首次被调用时才会被触发并打印到 `stderr`。
警告被触发之后，被包装的 `function` 会被调用。

如果使用了 `--no-deprecation` 或 `--no-warnings` 命令行标记，或 `process.noDeprecation` 属性在首次废弃警告之前被设为 `true`，则 `util.deprecate()` 方法什么也不做。

如果设置了 `--trace-deprecation` 或 `--trace-warnings` 命令行标记，或 `process.traceDeprecation` 属性被设为 `true`，则废弃的函数首次被调用时会把警告与堆栈追踪打印到 `stderr`。

如果设置了 `--throw-deprecation` 命令行标记，或 `process.throwDeprecation` 属性被设为 `true`，则当废弃的函数被调用时会抛出一个异常。

`--throw-deprecation` 命令行标记和 `process.throwDeprecation` 属性优先于 `--trace-deprecation` 和 `process.traceDeprecation`。


<!-- YAML
added: v0.3.0
deprecated: v0.11.3
-->

> 稳定性: 0 - 废弃的: 使用 [`console.error()`] 代替。

* `...strings` {String} The message to print to `stderr`

Deprecated predecessor of `console.error`.


<!-- YAML
added: v0.7.5
deprecated: v6.0.0
-->

> 稳定性: 0 - 废弃的: 使用 [`Object.assign()`] 代替。

The `util._extend()` method was never intended to be used outside of internal
Node.js modules. The community found and used it anyway.

It is deprecated and should not be used in new code. JavaScript comes with very
similar built-in functionality through [`Object.assign()`].


<!-- YAML
added: v0.5.3
-->

* `format` {String} 一个类似 `printf` 的格式字符串。

`util.format()` 方法返回一个格式化后的字符串，使用第一个参数作为一个类似 `printf` 的格式。

第一个参数是一个字符串，包含零个或多个占位符。
每个占位符会被对应参数转换后的值所替换。
支持的占位符有：

* `%s` - 字符串。
* `%d` - 数值（包括整数和浮点数）。
* `%j` - JSON。如果参数包含循环引用，则用字符串 `'[Circular]'` 替换。
* `%%` - 单个百分号（`'%'`）。不消耗参数。

如果占位符没有对应的参数，则占位符不被替换。

```js
util.format('%s:%s', 'foo');
// 返回: 'foo:%s'
```

如果传入 `util.format()` 方法的参数比占位符的数量多，则多出的参数会被强制转换为字符串（对于对象和符号，使用 `util.inspect()`），然后拼接到返回的字符串，参数之间用一个空格分隔。

```js
util.format('%s:%s', 'foo', 'bar', 'baz'); // 'foo:bar baz'
```

如果第一个参数不是一个格式字符串，则 `util.format()` 返回一个所有参数用空格分隔并连在一起的字符串。
每个参数都使用 `util.inspect()` 转换为一个字符串。

```js
util.format(1, 2, 3); // '1 2 3'
```


<!-- YAML
added: v0.3.0
-->

注意，不建议使用 `util.inherits()`。
请使用 ES6 的 `class` 和 `extends` 关键词获得语言层面的继承支持。
注意，这两种方式是[语义上不兼容的]。

* `constructor` {Function}
* `superConstructor` {Function}

从一个[构造函数]中继承原型方法到另一个。
`constructor` 的原型会被设置到一个从 `superConstructor` 创建的新对象上。

`superConstructor` 可通过 `constructor.super_` 属性访问。

```js
const util = require('util');
const EventEmitter = require('events');

function MyStream() {
  EventEmitter.call(this);
}

util.inherits(MyStream, EventEmitter);

MyStream.prototype.write = function(data) {
  this.emit('data', data);
};

const stream = new MyStream();

console.log(stream instanceof EventEmitter); // true
console.log(MyStream.super_ === EventEmitter); // true

stream.on('data', (data) => {
  console.log(`接收的数据："${data}"`);
});
stream.write('运作良好！'); // 接收的数据："运作良好！"
```

例子：使用 ES6 的 `class` 和 `extends`：

```js
const EventEmitter = require('events');

class MyStream extends EventEmitter {
  constructor() {
    super();
  }
  write(data) {
    this.emit('data', data);
  }
}

const stream = new MyStream();

stream.on('data', (data) => {
  console.log(`接收的数据："${data}"`);
});
stream.write('使用 ES6');

```


<!-- YAML
added: v6.6.0
-->

一个符号，可被用于声明自定义的查看函数，详见[自定义对象的查看函数]。


<!-- YAML
added: v6.4.0
-->

`defaultOptions` 值允许对被 `util.inspect` 使用的默认选项进行自定义。
这对 `console.log` 或 `util.format` 等显式调用 `util.inspect` 的函数很有用。
它需被设为一个对象，包含一个或多个有效的 [`util.inspect()`] 选项。
也支持直接设置选项的属性。

```js
const util = require('util');
const arr = Array(101);

console.log(arr); // 打印截断的数组
util.inspect.defaultOptions.maxArrayLength = null;
console.log(arr); // 打印完整的数组
```


<!-- YAML
added: v0.3.0
-->

* `object` {any} 任何 JavaScript 原始值或对象。
* `options` {Object}
  * `showHidden` {boolean} 如果为 `true`，则 `object` 的不可枚举的符号与属性也会被包括在格式化后的结果中。
    默认为 `false`。
  * `depth` {number} 指定格式化 `object` 时递归的次数。
    这对查看大型复杂对象很有用。
    默认为 `2`。
    若要无限地递归则传入 `null`。
  * `colors` {boolean} 如果为 `true`，则输出样式使用 ANSI 颜色代码。
    默认为 `false`。
    颜色可自定义，详见[自定义 `util.inspect` 颜色]。
  * `customInspect` {boolean} 如果为 `false`，则 `object` 上自定义的 `inspect(depth, opts)` 函数不会被调用。
    默认为 `true`。
  * `showProxy` {boolean} 如果为 `true`，则 `Proxy` 对象的对象和函数会展示它们的 `target` 和 `handler` 对象。
    默认为 `false`。
  * `maxArrayLength` {number} 指定格式化时数组和 `TypedArray` 元素能包含的最大数量。
    默认为 `100`。
    设为 `null` 则显式全部数组元素。
    设为 `0` 或负数则不显式数组元素。
  * `breakLength` {number} 一个对象的键被拆分成多行的长度。
    设为 `Infinity` 则格式化一个对象为单行。
    默认为 `60`。

`util.inspect()` 方法返回 `object` 的字符串表示，主要用于调试。
附加的 `options` 可用于改变格式化字符串的某些方面。

例子，查看 `util` 对象的所有属性：

```js
const util = require('util');

console.log(util.inspect(util, { showHidden: true, depth: null }));
```

当调用到达递归查看的当前 `depth` 时，值支持自定义的 `inspect(depth, opts)` 函数，传入 `util.inspect()` 的选项对象也一样。


<!-- YAML
added: v0.6.0
deprecated: v4.0.0
-->

> 稳定性: 0 - 废弃的

* `object` {any}

Internal alias for [`Array.isArray`][].

Returns `true` if the given `object` is an `Array`. Otherwise, returns `false`.

```js
const util = require('util');

util.isArray([]);
// Returns: true
util.isArray(new Array);
// Returns: true
util.isArray({});
// Returns: false
```


<!-- YAML
added: v0.11.5
deprecated: v4.0.0
-->

> 稳定性: 0 - 废弃的

* `object` {any}

Returns `true` if the given `object` is a `Boolean`. Otherwise, returns `false`.

```js
const util = require('util');

util.isBoolean(1);
// Returns: false
util.isBoolean(0);
// Returns: false
util.isBoolean(false);
// Returns: true
```


<!-- YAML
added: v0.11.5
deprecated: v4.0.0
-->

> 稳定性: 0 - 废弃的: 使用 [`Buffer.isBuffer()`] 代替。

* `object` {any}

Returns `true` if the given `object` is a `Buffer`. Otherwise, returns `false`.

```js
const util = require('util');

util.isBuffer({ length: 0 });
// Returns: false
util.isBuffer([]);
// Returns: false
util.isBuffer(Buffer.from('hello world'));
// Returns: true
```


<!-- YAML
added: v0.6.0
deprecated: v4.0.0
-->

> 稳定性: 0 - 废弃的

* `object` {any}

Returns `true` if the given `object` is a `Date`. Otherwise, returns `false`.

```js
const util = require('util');

util.isDate(new Date());
// Returns: true
util.isDate(Date());
// false (without 'new' returns a String)
util.isDate({});
// Returns: false
```


<!-- YAML
added: v0.6.0
deprecated: v4.0.0
-->

> 稳定性: 0 - 废弃的

* `object` {any}

Returns `true` if the given `object` is an [`Error`][]. Otherwise, returns
`false`.

```js
const util = require('util');

util.isError(new Error());
// Returns: true
util.isError(new TypeError());
// Returns: true
util.isError({ name: 'Error', message: 'an error occurred' });
// Returns: false
```

Note that this method relies on `Object.prototype.toString()` behavior. It is
possible to obtain an incorrect result when the `object` argument manipulates
`@@toStringTag`.

```js
const util = require('util');
const obj = { name: 'Error', message: 'an error occurred' };

util.isError(obj);
// Returns: false
obj[Symbol.toStringTag] = 'Error';
util.isError(obj);
// Returns: true
```


<!-- YAML
added: v0.11.5
deprecated: v4.0.0
-->

> 稳定性: 0 - 废弃的

* `object` {any}

Returns `true` if the given `object` is a `Function`. Otherwise, returns
`false`.

```js
const util = require('util');

function Foo() {}
const Bar = function() {};

util.isFunction({});
// Returns: false
util.isFunction(Foo);
// Returns: true
util.isFunction(Bar);
// Returns: true
```


<!-- YAML
added: v0.11.5
deprecated: v4.0.0
-->

> 稳定性: 0 - 废弃的

* `object` {any}

Returns `true` if the given `object` is `null` or `undefined`. Otherwise,
returns `false`.

```js
const util = require('util');

util.isNullOrUndefined(0);
// Returns: false
util.isNullOrUndefined(undefined);
// Returns: true
util.isNullOrUndefined(null);
// Returns: true
```


<!-- YAML
added: v0.11.5
deprecated: v4.0.0
-->

> 稳定性: 0 - 废弃的

* `object` {any}

Returns `true` if the given `object` is strictly `null`. Otherwise, returns
`false`.

```js
const util = require('util');

util.isNull(0);
// Returns: false
util.isNull(undefined);
// Returns: false
util.isNull(null);
// Returns: true
```


<!-- YAML
added: v0.11.5
deprecated: v4.0.0
-->

> 稳定性: 0 - 废弃的

* `object` {any}

Returns `true` if the given `object` is a `Number`. Otherwise, returns `false`.

```js
const util = require('util');

util.isNumber(false);
// Returns: false
util.isNumber(Infinity);
// Returns: true
util.isNumber(0);
// Returns: true
util.isNumber(NaN);
// Returns: true
```


<!-- YAML
added: v0.11.5
deprecated: v4.0.0
-->

> 稳定性: 0 - 废弃的

* `object` {any}

Returns `true` if the given `object` is strictly an `Object` **and** not a
`Function`. Otherwise, returns `false`.

```js
const util = require('util');

util.isObject(5);
// Returns: false
util.isObject(null);
// Returns: false
util.isObject({});
// Returns: true
util.isObject(function(){});
// Returns: false
```


<!-- YAML
added: v0.11.5
deprecated: v4.0.0
-->

> 稳定性: 0 - 废弃的

* `object` {any}

Returns `true` if the given `object` is a primitive type. Otherwise, returns
`false`.

```js
const util = require('util');

util.isPrimitive(5);
// Returns: true
util.isPrimitive('foo');
// Returns: true
util.isPrimitive(false);
// Returns: true
util.isPrimitive(null);
// Returns: true
util.isPrimitive(undefined);
// Returns: true
util.isPrimitive({});
// Returns: false
util.isPrimitive(function() {});
// Returns: false
util.isPrimitive(/^$/);
// Returns: false
util.isPrimitive(new Date());
// Returns: false
```


<!-- YAML
added: v0.6.0
deprecated: v4.0.0
-->

> 稳定性: 0 - 废弃的

* `object` {any}

Returns `true` if the given `object` is a `RegExp`. Otherwise, returns `false`.

```js
const util = require('util');

util.isRegExp(/some regexp/);
// Returns: true
util.isRegExp(new RegExp('another regexp'));
// Returns: true
util.isRegExp({});
// Returns: false
```


<!-- YAML
added: v0.11.5
deprecated: v4.0.0
-->

> 稳定性: 0 - 废弃的

* `object` {any}

Returns `true` if the given `object` is a `string`. Otherwise, returns `false`.

```js
const util = require('util');

util.isString('');
// Returns: true
util.isString('foo');
// Returns: true
util.isString(String('foo'));
// Returns: true
util.isString(5);
// Returns: false
```


<!-- YAML
added: v0.11.5
deprecated: v4.0.0
-->

> 稳定性: 0 - 废弃的

* `object` {any}

Returns `true` if the given `object` is a `Symbol`. Otherwise, returns `false`.

```js
const util = require('util');

util.isSymbol(5);
// Returns: false
util.isSymbol('foo');
// Returns: false
util.isSymbol(Symbol('foo'));
// Returns: true
```


<!-- YAML
added: v0.11.5
deprecated: v4.0.0
-->

> 稳定性: 0 - 废弃的

* `object` {any}

Returns `true` if the given `object` is `undefined`. Otherwise, returns `false`.

```js
const util = require('util');

const foo = undefined;
util.isUndefined(5);
// Returns: false
util.isUndefined(foo);
// Returns: true
util.isUndefined(null);
// Returns: false
```


<!-- YAML
added: v0.3.0
deprecated: v6.0.0
-->

> 稳定性: 0 - 废弃的: 使用第三方模块代替。

* `string` {String}

The `util.log()` method prints the given `string` to `stdout` with an included
timestamp.

```js
const util = require('util');

util.log('Timestamped message.');
```


<!-- YAML
added: v0.3.0
deprecated: v0.11.3
-->

> 稳定性: 0 - 废弃的: 使用 [`console.log()`] 代替。

Deprecated predecessor of `console.log`.


<!-- YAML
added: v0.3.0
deprecated: v0.11.3
-->

> 稳定性: 0 - 废弃的: 使用 [`console.log()`] 代替。

Deprecated predecessor of `console.log`.



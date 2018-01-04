
URL 只被允许包含一个特定范围的字符串。
URL 对象的属性中的空格（`' '`）和以下字符会被自动转义。

```txt
< > " ` \r \n \t { } | \ ^ '
```

例如，ASCII 空格字符（`' '`）被编码成 `%20`。
ASCII 斜杠字符（`/`）被编码成 `%3C`。


> 稳定性: 2 - 稳定的

`url` 模块提供了一些实用函数，用于 URL 处理与解析。
可以通过以下方式使用：

```js
const url = require('url');
```



`auth` 属性是 URL 的用户名与密码部分。
该字符串跟在 `protocol` 和双斜杠（如果有）的后面，排在 `host` 部分的前面且被一个 ASCII 的 at 符号（`@`）分隔。
该字符的格式为 `{username}[:{password}]`，`[:{password}]` 部分是可选的。

例如：`'user:pass'`



`hash` 属性包含 URL 的碎片部分，包括开头的 ASCII 哈希字符（`#`）。

例如：`'#hash'`



`host` 属性是 URL 的完整的小写的主机部分，包括 `port`（如果有）。

例如：`'host.com:8080'`



`hostname` 属性是 `host` 组成部分排除 `port` 之后的小写的主机名部分。

例如：`'host.com'`



`href` 属性是解析后的完整的 URL 字符串，`protocol` 和 `host` 都会被转换为小写的。

例如：`'http://user:pass@host.com:8080/p/a/t/h?query=string#hash'`



`path` 属性是一个 `pathname` 与 `search` 组成部分的串接。

例如：`'/p/a/t/h?query=string'`

不会对 `path` 执行解码。



`pathname` 属性包含 URL 的整个路径部分。
它跟在 `host` （包括 `port`）后面，排在 `query` 或 `hash` 组成部分的前面且被 ASCII 问号（`?`）或哈希字符（`#`）分隔。

例如：`'/p/a/t/h'`

不会对路径字符串执行解码。



`port` 属性是 `host` 组成部分中的数值型的端口部分。

例如：`'8080'`



`protocol` 属性表明 URL 的小写的协议体制。

例如：`'http:'`



`query` 属性是不含开头 ASCII 问号（`?`）的查询字符串，或一个被 [`querystring`] 模块的 `parse()` 方法返回的对象。
`query` 属性是一个字符串还是一个对象是由传入 `url.parse()` 的 `parseQueryString` 参数决定的。

例如：`'query=string'` or `{'query': 'string'}`

如果返回一个字符串，则不会对查询字符串执行解码。
如果返回一个对象，则键和值都会被解码。



`search` 属性包含 URL 的整个查询字符串部分，包括开头的 ASCII 问号字符（`?`）。

例如：`'?query=string'`

不会对查询字符串执行解码。



`slashes` 属性是一个 `boolean`，如果 `protocol` 中的冒号后面跟着两个 ASCII 斜杠字符（`/`），则值为 `true`。


<!-- YAML
added: v0.1.25
-->

* `urlObject` {Object | String} 一个 URL 对象（就像 `url.parse()` 返回的）。
  如果是一个字符串，则通过 `url.parse()` 转换为一个对象。

`url.format()` 方法返回一个从 `urlObject` 格式化后的 URL 字符串。

如果 `urlObject` 不是一个对象或字符串，则 `url.parse()` 抛出 [`TypeError`]。

格式化过程如下：

* 创建一个新的空字符串 `result`。
* 如果 `urlObject.protocol` 是一个字符串，则它会被原样添加到 `result`。
* 否则，如果 `urlObject.protocol` 不是 `undefined` 也不是一个字符串，则抛出 [`Error`]。
* 对于不是以 `:` 结束的 `urlObject.protocol`，`:` 会被添加到 `result`。
* 如果以下条件之一为真，则 `//` 会被添加到 `result`：
    * `urlObject.slashes` 属性为真；
    * `urlObject.protocol` 以 `http`、`https`、`ftp`、`gopher` 或 `file` 开头；
* 如果 `urlObject.auth` 属性的值为真，且 `urlObject.host` 或 `urlObject.hostname` 不为 `undefined`，则 `urlObject.auth` 会被添加到 `result`，且后面带上 `@`。
* 如果 `urlObject.host` 属性为 `undefined`，则：
  * 如果 `urlObject.hostname` 是一个字符串，则它会被添加到 `result`。
  * 否则，如果 `urlObject.hostname` 不是 `undefined` 也不是一个字符串，则抛出 [`Error`]。
  * 如果 `urlObject.port` 属性的值为真，且 `urlObject.hostname` 不为 `undefined`：
    * `:` 会被添加到 `result`。
    * `urlObject.port` 的值会被添加到 `result`。
* 否则，如果 `urlObject.host` 属性的值为真，则 `urlObject.host` 的值会被添加到 `result`。
* 如果 `urlObject.pathname` 属性是一个字符串且不是一个空字符串：
  * 如果 `urlObject.pathname` 不是以 `/` 开头，则 `/` 会被添加到 `result`。
  * `urlObject.pathname` 的值会被添加到 `result`。
* 否则，如果 `urlObject.pathname` 不是 `undefined` 也不是一个字符串，则抛出 [`Error`]。
* 如果 `urlObject.search` 属性为 `undefined` 且 `urlObject.query` 属性是一个 `Object`，则 `?` 会被添加到 `result`，后面跟上把 `urlObject.query` 的值传入 [`querystring`] 模块的 `stringify()` 方法的调用结果。
* 否则，如果 `urlObject.search` 是一个字符串：
  * 如果 `urlObject.search` 的值不是以 `?` 开头，则 `?` 会被添加到 `result`。
  * `urlObject.search` 的值会被添加到 `result`。
* 否则，如果 `urlObject.search` 不是 `undefined` 也不是一个字符串，则抛出 [`Error`]。
* 如果 `urlObject.hash` 属性是一个字符串：
  * 如果 `urlObject.hash` 的值不是以 `#` 开头，则 `#` 会被添加到 `result`。
  * `urlObject.hash` 的值会被添加到 `result`。
* 否则，如果 `urlObject.hash` 属性不是 `undefined` 也不是一个字符串，则抛出 [`Error`]。
* 返回 `result`。



<!-- YAML
added: v0.1.25
-->

* `urlString` {String} 要解析的 URL 字符串。
* `parseQueryString` {Boolean} 如果为 `true`，则 `query` 属性总会通过 [`querystring`] 模块的 `parse()` 方法生成一个对象。
  如果为 `false`，则返回的 URL 对象上的 `query` 属性会是一个未解析、未解码的字符串。
  默认为 `false`。
* `slashesDenoteHost` {Boolean} 如果为 `true`，则 `//` 之后至下一个 `/` 之前的字符串会被解析作为 `host`。
  例如，`//foo/bar` 会被解析为 `{host: 'foo', pathname: '/bar'}` 而不是 `{pathname: '//foo/bar'}`。
  默认为 `false`。

`url.parse()` 方法会解析一个 URL 字符串并返回一个 URL 对象。


<!-- YAML
added: v0.1.25
-->

* `from` {String} 解析时相对的基本 URL。
* `to` {String} 要解析的超链接 URL。

`url.resolve()` 方法会以一种 Web 浏览器解析超链接的方式把一个目标 URL 解析成相对于一个基础 URL。

例子：

```js
url.resolve('/one/two/three', 'four')         // '/one/two/four'
url.resolve('http://example.com/', '/one')    // 'http://example.com/one'
url.resolve('http://example.com/one', '/two') // 'http://example.com/two'
```



一个 URL 字符串是一个结构化的字符串，它包含多个有意义的组成部分。
当被解析时，会返回一个 URL 对象，它包含每个组成部分作为属性。

以下详情描述了一个解析后的 URL 的每个组成部分。
例子，`'http://user:pass@host.com:8080/p/a/t/h?query=string#hash'`：

```txt
┌─────────────────────────────────────────────────────────────────────────────┐
│                                    href                                     │
├──────────┬┬───────────┬─────────────────┬───────────────────────────┬───────┤
│ protocol ││   auth    │      host       │           path            │ hash  │
│          ││           ├──────────┬──────┼──────────┬────────────────┤       │
│          ││           │ hostname │ port │ pathname │     search     │       │
│          ││           │          │      │          ├─┬──────────────┤       │
│          ││           │          │      │          │ │    query     │       │
"  http:   // user:pass @ host.com : 8080   /p/a/t/h  ?  query=string   #hash "
│          ││           │          │      │          │ │              │       │
└──────────┴┴───────────┴──────────┴──────┴──────────┴─┴──────────────┴───────┘
(请忽略字符串中的空格，它们只是为了格式化)
```



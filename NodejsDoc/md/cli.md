#命令行选项

Node.js 自带了各种命令行选项。
这些选项对外暴露了内置调试、多种执行脚本的方式、以及其他有用的运行时选项。

要在终端中查看本文档作为操作手册，运行 `man node`。


###-c, --check

在不执行的情况下，对脚本进行语法检查。


###--enable-fips

启动时启用符合 FIPS 标准的加密。
（需要 Node.js 使用 `./configure --openssl-fips` 构建）


##环境变量
###-e, --eval "script"

把跟随的参数作为 JavaScript 来执行。
在 REPL 中预定义的模块也可以在 `script` 中使用。


###--force-fips

启动时强制使用符合 FIPS 标准的加密。
（无法通过脚本代码禁用。）
（要求同 `--enable-fips`）


###-h, --help

打印 node 的命令行选项。
此选项的输出不如本文档详细。


###--icu-data-dir=file

指定 ICU 数据的加载路径。
（覆盖 `NODE_ICU_DATA`）


###-i, --interactive

打开 REPL，即使 stdin 看起来不像终端。


###NODE_DEBUG=module[,…]

以 `','` 分隔的应该打印调试信息的核心模块列表。


###NODE_DISABLE_COLORS=1

当设为 `1` 时，不会在 REPL 中使用颜色。


###NODE_EXTRA_CA_CERTS=file
当设置了此选项时，根 CA 证书（如 VeriSign）会被 `file` 指定的证书扩展。
文件应该包括一个或多个可信的 PEM 格式的证书。
如果文件丢失或有缺陷，则 [`process.emitWarning()`] 会触发一个消息。

注意，当一个 TLS 或 HTTPS 的客户端或服务器的 `ca` 选项的属性被显式地指定时，则指定的证书不会被使用。


<!-- YAML
added: v0.11.15
-->

ICU（Intl 对象）数据的数据路径。
当使用 `small-icu` 编译时，扩展链接的数据。


###NODE_PATH=path[:…]

以 `':'` 分隔的有模块搜索路径作前缀的目录列表。

注意，在 Windows 中，列表是用 `';'` 分隔的。


<!-- YAML
added: v3.0.0
-->

用于存储持久性的 REPL 历史记录的文件的路径。
默认路径是 `~/.node_repl_history`，可被该变量覆盖。
将值设为空字符串（`""` 或 `" "`）会禁用持久性的 REPL 历史记录。


<!-- YAML
added: 6.4.0
-->

当设为 `1` 时，当输出到一个支持异步输入输出的平台的 TTY 时，写入到 `stdout` 和 `stderr` 会是非阻塞与异步的。
设置该值会使标准输入输出在程序退出时不会被交叉存取或丢弃。
**不建议使用这个模式。**


###--no-deprecation

静默废弃的警告。


###--no-warnings

静默一切进程警告（包括废弃警告）。


###--openssl-config=file

启动时加载 OpenSSL 配置文件。
在其他用途中，如果 Node.js 使用 `./configure --openssl-fips` 构建，它可以用于启用符合 FIPS 标准的加密。


##选项

###--preserve-symlinks

当解析和缓存模块时，命令模块加载器保持符号连接。

默认情况下，当 Node.js 从一个被符号连接到另一块磁盘位置的路径加载一个模块时，Node.js 会解引用该连接，并使用模块的真实磁盘的实际路径，作为定位其他依赖模块的标识符和根路径。
大多数情况下，默认行为是可接受的。
但是，当使用符号连接的同行依赖，如下例子所描述的，如果 `moduleA` 试图引入 `moduleB` 作为一个同行依赖，默认行为就会抛出异常：

	
    {appDir}
     ├── app
     │   ├── index.js
     │   └── node_modules
     │       ├── moduleA -> {appDir}/moduleA
     │       └── moduleB
     │           ├── index.js
     │           └── package.json
     └── moduleA
         ├── index.js
         └── package.json
	

`--preserve-symlinks` 命令行标志命令 Node.js 使用模块的符号路径而不是真实路径，是符号连接的同行依赖能被找到。

注意，使用 `--preserve-symlinks` 会有其他方面的影响。
比如，如果符号连接的原生模块在依赖树里来自超过一个位置，它们会加载失败。
（Node.js 会将它们视为两个独立的模块，且会试图多次加载模块，造成抛出异常。）

###--prof-process

处理 v8 分析器的输出，通过使用 v8 选项 `--prof` 生成。


###-p, --print "script"

与 `-e` 相同，但会打印结果。


###-r, --require module

在启动时预加载指定的模块。

遵循 `require()` 的模块解析规则。
`module` 可以是一个文件的路径，或一个 node 模块名称。


##概要
`node [options] [v8 options] [script.js | -e "script"] [arguments]`

`node debug [script.js | -e "script" | <host>:<port>] …`

`node --v8-options`

执行时不带参数，会启动 [REPL]。

关于 `node debug` 的更多信息，详见[调试器]文档。


###--throw-deprecation

抛出废弃的错误。


###--tls-cipher-list=list

指定备用的默认 TLS 加密列表。
（需要 Node.js 被构建为支持加密。（默认））


###--trace-deprecation

打印废弃的堆栈跟踪。


###--trace-sync-io

每当事件循环的第一帧之后检测到同步 I/O 时，打印堆栈跟踪。


###--trace-warnings

打印进程警告的堆栈跟踪（包括废弃警告）。


###--track-heap-objects

为堆快照追踪堆栈对象的分配。


###--v8-options

打印 v8 命令行选项。

注意，v8 选项允许单词使用破折号（`-`）或下划线（`_`）分隔。

例如，`--stack-trace-limit` 等同于 `--stack_trace_limit`。


###-v, --version

打印 node 的版本号。


###--zero-fill-buffers

自动用 0 填充所有新分配的 [Buffer] 和 [SlowBuffer] 实例。



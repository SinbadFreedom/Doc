<!-- YAML
added: v0.1.99
-->

* `encoding` {string} `StringDecoder` 使用的字符编码。默认为 `'utf8'`。

创建一个新的 `StringDecoder` 实例。



> 稳定性: 2 - 稳定的

`string_decoder` 模块提供了一个 API，用于解码 `Buffer` 对象成字符串。它可以通过以下方式被使用：

	
    const StringDecoder = require('string_decoder').StringDecoder;
	

以下例子展示了 `StringDecoder` 类的基本用法。

	
    const StringDecoder = require('string_decoder').StringDecoder;
    const decoder = new StringDecoder('utf8');
    
    const cent = Buffer.from([0xC2, 0xA2]);
    console.log(decoder.write(cent));
    
    const euro = Buffer.from([0xE2, 0x82, 0xAC]);
    console.log(decoder.write(euro));
	

当一个 `Buffer` 实例被写入 `StringDecoder` 实例时，一个内部的 buffer 会被用于确保解码后的字符串不包含任何不完整的多字节字符。
不完整的多字节字符被保存在 buffer 中，直到下次调用 `stringDecoder.write()` 或直到 `stringDecoder.end()` 被调用。

以下例子中，欧元符号（`€`）的三个 UTF-8 编码的字节被分成三次操作写入：

	
    const StringDecoder = require('string_decoder').StringDecoder;
    const decoder = new StringDecoder('utf8');
    
    decoder.write(Buffer.from([0xE2]));
    decoder.write(Buffer.from([0x82]));
    console.log(decoder.end(Buffer.from([0xAC])));
	


<!-- YAML
added: v0.9.3
-->

* `buffer` {Buffer} 一个包含了要解码的字节的 `Buffer`。

以字符串的形式返回任何剩下的被保存在内部 buffer 中的字节。
不完整的 UTF-8 与 UTF-16 字符的字节会被替换成符合字符编码的替代字符。

如果提供了 `buffer` 参数，则在返回剩余字节之前会再执行一次 `stringDecoder.write()`。


<!-- YAML
added: v0.1.99
-->

* `buffer` {Buffer} 一个包含了要解码的字节的 `Buffer`。

返回一个解码后的字符串，并确保 `Buffer` 末尾的任何不完整的多字节字符从返回的字符串中被过滤并保存在一个内部的 buffer 中用于下次调用 `stringDecoder.write()` 或 `stringDecoder.end()`。



> 稳定性: 2 - 稳定的

`string_decoder` 模块提供了一个 API，用于解码 `Buffer` 对象成字符串。它可以通过以下方式被使用：

	
    const StringDecoder = require('string_decoder').StringDecoder;
	

以下例子展示了 `StringDecoder` 类的基本用法。

	
    const StringDecoder = require('string_decoder').StringDecoder;
    const decoder = new StringDecoder('utf8');
    
    const cent = Buffer.from([0xC2, 0xA2]);
    console.log(decoder.write(cent));
    
    const euro = Buffer.from([0xE2, 0x82, 0xAC]);
    console.log(decoder.write(euro));
	

当一个 `Buffer` 实例被写入 `StringDecoder` 实例时，一个内部的 buffer 会被用于确保解码后的字符串不包含任何不完整的多字节字符。
不完整的多字节字符被保存在 buffer 中，直到下次调用 `stringDecoder.write()` 或直到 `stringDecoder.end()` 被调用。

以下例子中，欧元符号（`€`）的三个 UTF-8 编码的字节被分成三次操作写入：

	
    const StringDecoder = require('string_decoder').StringDecoder;
    const decoder = new StringDecoder('utf8');
    
    decoder.write(Buffer.from([0xE2]));
    decoder.write(Buffer.from([0x82]));
    console.log(decoder.end(Buffer.from([0xAC])));
	



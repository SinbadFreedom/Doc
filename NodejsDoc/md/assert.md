#assert (断言)
> 稳定性: 2 - 稳定的

`assert` 模块提供了一组简单的断言测试集合，可被用于测试不变量。


##assert.deepEqual(actual, expected[, message])

* `actual` {any}   
* `expected` {any}   
* `message` {any}   

测试 `actual` 参数与 `expected` 参数是否深度相等。
原始值使用相等运算符（`==`）比较。

只比较可枚举的自身属性。
`deepEqual()` 不比较对象的原型、连接符、或不可枚举的属性。
这可能会导致一些意料之外的结果。
例如，下面的例子不会抛出 `AssertionError`，因为 [Error](errors.html#errors_class_error) 对象的属性是不可枚举的：

	
    // 注意：这不会抛出 AssertionError！
    assert.deepEqual(Error('a'), Error('b'));
	

深度相等意味着子对象的可枚举的自身属性也会被比较：

	
    const assert = require('assert');
    
    const obj1 = {
      a : {
        b : 1
      }
    };
    const obj2 = {
      a : {
        b : 2
      }
    };
    const obj3 = {
      a : {
        b : 1
      }
    };
    const obj4 = Object.create(obj1);
    
    assert.deepEqual(obj1, obj1);
    // 通过，对象与自身相等
    
    assert.deepEqual(obj1, obj2);
    // 抛出 AssertionError: { a: { b: 1 } } deepEqual { a: { b: 2 } }
    // b 的值不同
    
    assert.deepEqual(obj1, obj3);
    // 通过，两个对象相等
    
    assert.deepEqual(obj1, obj4);
    // 抛出 AssertionError: { a: { b: 1 } } deepEqual {}
    // 原型会被忽略
	

如果两个值不相等，则抛出一个带有 `message` 属性的 `AssertionError`，其中 `message` 属性的值等于传入的 `message` 参数的值。
如果 `message` 参数为 `undefined`，则赋予默认的错误信息。


## assert.deepStrictEqual(actual, expected[, message])
* `actual` {any}   
* `expected` {any}   
* `message` {any}  

大多数情况下与 `assert.deepEqual()` 一样，但有两个例外。
首先，原始值使用全等运算符（`===`）比较。
其次，对象的比较包括检查它们的原型是否全等。

	
    const assert = require('assert');
    
    assert.deepEqual({a:1}, {a:'1'});
    // 通过，因为 1 == '1'
    
    assert.deepStrictEqual({a:1}, {a:'1'});
    // 抛出 AssertionError: { a: 1 } deepStrictEqual { a: '1' }
    // 因为 1 !== '1' 使用全等运算符
	

如果两个值不相等，则抛出一个带有 `message` 属性的 `AssertionError`，其中 `message` 属性的值等于传入的 `message` 参数的值。
如果 `message` 参数为 `undefined`，则赋予默认的错误信息。


##assert.doesNotThrow(block[, error][, message])
* `block` {Function}   
* `error` {RegExp|Function}   
* `message` {any}   

断言 `block` 函数不会抛出错误。
查看 [assert.throws()](#assert_assert_throws_block_error_message) 了解更多。

当 `assert.doesNotThrow()` 被调用时，它会立即调用 `block` 函数。

如果抛出错误且错误类型与 `error` 参数指定的相同，则抛出 `AssertionError`。
如果错误类型不相同，或 `error` 参数是 `undefined`，则错误会被抛回给调用者。

以下例子会抛出 [TypeError](errors.html#errors_class_typeerror)，因为在断言中没有匹配的错误类型：

	
    assert.doesNotThrow(
      () => {
        throw new TypeError('错误');
      },
      SyntaxError
    );
	

以下例子会抛出一个带有 `Got unwanted exception (TypeError)..` 信息的 `AssertionError`：

	
    assert.doesNotThrow(
      () => {
        throw new TypeError('错误');
      },
      TypeError
    );
	

如果抛出了 `AssertionError` 且有给 `message` 参数传值，则 `message` 的值会被附加到 `AssertionError` 的信息中：

	
    assert.doesNotThrow(
      () => {
        throw new TypeError('错误');
      },
      TypeError,
      '抛出错误'
    );
    // 抛出 AssertionError: Got unwanted exception (TypeError). 抛出错误
	


##assert.equal(actual, expected[, message])
* `actual` {any}   
* `expected` {any}   
* `message` {any}   

使用相等运算符（`==`）测试 `actual` 参数与 `expected` 参数是否相等。

	
    const assert = require('assert');
    
    assert.equal(1, 1);
    // 通过，1 == 1
    assert.equal(1, '1');
    // 通过，1 == '1'
    
    assert.equal(1, 2);
    // 抛出 AssertionError: 1 == 2
    assert.equal({a: {b: 1}}, {a: {b: 1}});
    // 抛出 AssertionError: { a: { b: 1 } } == { a: { b: 1 } }
	

如果两个值不相等，则抛出一个带有 `message` 属性的 `AssertionError`，其中 `message` 属性的值等于传入的 `message` 参数的值。
如果 `message` 参数为 `undefined`，则赋予默认的错误信息。


##assert.fail(actual, expected, message, operator)
* `actual` {any}   
* `expected` {any}   
* `message` {any}   
* `operator` {String}   

抛出 `AssertionError`。
如果 `message` 不存在，则错误信息会被设为 `actual` 的值加分隔符 `operator` 再加 `expected` 的值。
否则，错误信息为 `message` 的值。

	
    const assert = require('assert');
    
    assert.fail(1, 2, undefined, '>');
    // 抛出 AssertionError: 1 > 2
    
    assert.fail(1, 2, '错误信息', '>');
    // 抛出 AssertionError: 错误信息
	


##assert.ifError(value)
* `value` {any}   

如果 `value` 为真，则抛出 `value`。
可用于测试回调函数的 `error` 参数。

	
    const assert = require('assert');
    
    assert.ifError(0);
    // 通过
    assert.ifError(1);
    // 抛出 1
    assert.ifError('error');
    // 抛出 'error'
    assert.ifError(new Error());
    // 抛出 Error
	


##assert.notDeepEqual(actual, expected[, message])
* `actual` {any}   
* `expected` {any}   
* `message` {any}   

测试是否不深度相等。
与 [`assert.deepEqual()`] 相反。

	
    const assert = require('assert');
    
    const obj1 = {
      a : {
        b : 1
      }
    };
    const obj2 = {
      a : {
        b : 2
      }
    };
    const obj3 = {
      a : {
        b : 1
      }
    };
    const obj4 = Object.create(obj1);
    
    assert.notDeepEqual(obj1, obj1);
    // 抛出 AssertionError: { a: { b: 1 } } notDeepEqual { a: { b: 1 } }
    
    assert.notDeepEqual(obj1, obj2);
    // 通过，obj1 与 obj2 不深度相等
    
    assert.notDeepEqual(obj1, obj3);
    // 抛出 AssertionError: { a: { b: 1 } } notDeepEqual { a: { b: 1 } }
    
    assert.notDeepEqual(obj1, obj4);
    // 通过，obj1 与 obj4 不深度相等
	

如果两个值深度相等，则抛出一个带有 `message` 属性的 `AssertionError`，其中 `message` 属性的值等于传入的 `message` 参数的值。
如果 `message` 参数为 `undefined`，则赋予默认的错误信息。


##assert.notDeepStrictEqual(actual, expected[, message])
* `actual` {any}   
* `expected` {any}   
* `message` {any}   

测试是否不深度全等。
与 [`assert.deepStrictEqual()`] 相反。

	
    const assert = require('assert');
    
    assert.notDeepEqual({a:1}, {a:'1'});
    // 抛出 AssertionError: { a: 1 } notDeepEqual { a: '1' }
    
    assert.notDeepStrictEqual({a:1}, {a:'1'});
    // 通过
	

如果两个值深度全等，则抛出一个带有 `message` 属性的 `AssertionError`，其中 `message` 属性的值等于传入的 `message` 参数的值。
如果 `message` 参数为 `undefined`，则赋予默认的错误信息。


##assert.notEqual(actual, expected[, message])
* `actual` {any}   
* `expected` {any}   
* `message` {any}   

使用不等运算符（`!=`）测试是否不相等。

	
    const assert = require('assert');
    
    assert.notEqual(1, 2);
    // 通过
    
    assert.notEqual(1, 1);
    // 抛出 AssertionError: 1 != 1
    
    assert.notEqual(1, '1');
    // 抛出 AssertionError: 1 != '1'
	

如果两个值相等，则抛出一个带有 `message` 属性的 `AssertionError`，其中 `message` 属性的值等于传入的 `message` 参数的值。
如果 `message` 参数为 `undefined`，则赋予默认的错误信息。


##assert.notStrictEqual(actual, expected[, message])
* `actual` {any}   
* `expected` {any}   
* `message` {any}   

使用不全等运算符（`!==`）测试是否不全等。

	
    const assert = require('assert');
    
    assert.notStrictEqual(1, 2);
    // 通过
    
    assert.notStrictEqual(1, 1);
    // 抛出 AssertionError: 1 !== 1
    
    assert.notStrictEqual(1, '1');
    // 通过
	

如果两个值全等，则抛出一个带有 `message` 属性的 `AssertionError`，其中 `message` 属性的值等于传入的 `message` 参数的值。
如果 `message` 参数为 `undefined`，则赋予默认的错误信息。


##assert.ok(value[, message])
* `value` {any}   
* `message` {any}   

测试 `value` 是否为真值。
相当于 `assert.equal(!!value, true, message)`。

如果 `value` 不为真值，则抛出一个带有 `message` 属性的 `AssertionError`，其中 `message` 属性的值等于传入的 `message` 参数的值。
如果 `message` 参数为 `undefined`，则赋予默认的错误信息。

	
    const assert = require('assert');
    
    assert.ok(true);
    // 通过
    assert.ok(1);
    // 通过
    assert.ok(false);
    // 抛出 "AssertionError: false == true"
    assert.ok(0);
    // 抛出 "AssertionError: 0 == true"
    assert.ok(false, '不是真值');
    // 抛出 "AssertionError: 不是真值"
	


##assert.strictEqual(actual, expected[, message])
* `actual` {any}   
* `expected` {any}   
* `message` {any}   

使用全等运算符（`===`）测试是否全等。

	
    const assert = require('assert');
    
    assert.strictEqual(1, 2);
    // 抛出 AssertionError: 1 === 2
    
    assert.strictEqual(1, 1);
    // 通过
    
    assert.strictEqual(1, '1');
    // 抛出 AssertionError: 1 === '1'
	

如果两个值不全等，则抛出一个带有 `message` 属性的 `AssertionError`，其中 `message` 属性的值等于传入的 `message` 参数的值。
如果 `message` 参数为 `undefined`，则赋予默认的错误信息。


##assert.throws(block[, error][, message])
* `block` {Function}   
* `error` {RegExp|Function}   
* `message` {any}   

期望 `block` 函数抛出错误。

如果指定了 `error`，`error` 可以是构造函数、[正则表达式]、或自定义的验证函数。

如果指定了 `message`，则当 `block` 不抛出错误时，`message` 会作为 `AssertionError` 的错误信息。

例子，使用构造函数验证实例：

	
    assert.throws(
      () => {
        throw new Error('错误信息');
      },
      Error
    );
	

例子，使用 [正则表达式] 验证错误信息：

	
    assert.throws(
      () => {
        throw new Error('错误信息');
      },
      /错误/
    );
	

例子，自定义的错误验证函数：

	
    assert.throws(
      () => {
        throw new Error('错误信息');
      },
      function(err) {
        if ( (err instanceof Error) && /错误/.test(err) ) {
          return true;
        }
      },
      '不是期望的错误'
    );
	

注意，`error` 不能是一个字符串。
如果第二个参数是一个字符串，则视为省略 `error` 参数，传入的字符串会被用于 `message`。
这点比较容易搞错：

	
    // 这是错误的！不要这么做！
    assert.throws(myFunction, '错误', '没有抛出期望的信息');
    
    // 应该这么做。
    assert.throws(myFunction, /错误/, '没有抛出期望的信息');
	


##assert(value[, message])
* `value` {any}   
* `message` {any}   

[`assert.ok()`] 的别名。



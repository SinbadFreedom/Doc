1 页面的标头说明
===

来源:bing
级别:高

搜索引擎可能使用搜索引擎结果页 (SERP) 中 <description> 标记内提供的说明。一条好的说明能够描述页面内容，也能够与搜索者的意图相符，这样便可以提高您的页面的搜索点击率，从而增加页面的访问量。

建议操作:
在页面源代码的 <head> 部分添加一条说明: <meta name="description" content="此处是与页面内容相关且关键字丰富的描述性文本。">。

示例:
```
<head>
	<meta name="description" content="此处是与页面内容相关且关键字丰富的描述性文本。">
</head>
```



2 加入meta language信息
===

来源:bing
级别:中

Meta Language 信息可作为帮助我们了解页面内容适用的目标语言和国家/地区的提示。如果您的网站不位于该国家/地区，则此信息便能起作用。使用 "content-language" 元标记将区域性代码嵌入页面的 <head> 部分。

例如:
```
<meta http-equiv="content-language" content="en-gb">
```

表示页面的语言是英文，适用国家为英国。另外，您也可以使用 
```
<html lang="en-gb"> 或 <title lang="en-gb">
````





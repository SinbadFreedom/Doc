1 css选择器
===

css中的选择器是配置css样式的基础。除了常用的根据类型选择，根据id选择之外，还有一些很好用的方式。


1.1 通配符*
---

css里面的"*"表示通配符，匹配所有对象。可以省略。在通常情况下直接用id或者类型来写css样式，省略通配符全局匹配。

- *[lang=fr] 和 [lang=fr] 作用相同.
- *.warning 和 .warning 作用相同.
- *#myid 和 #myid 作用相同. 

1.2 E F与E > F的区别
---

E F 匹配的是 E对象的派生对象F.

示例:
```
h1 { color: red }
em { color: red }
h1 em { color: blue }

<H1>本文出自<SPAN class="myclass">大屎蛋教程网<EM>http://dashidan.com</EM></SPAN></H1>
```

第三条规则匹配的是H1标签中的em标签对应的内容.


E > F 匹配的是 E对象的子对象F

示例:

```
body > P { line-height: 1.3 }

<body>
	<p>大屎蛋教程网-http://dashidan.com</p>
</body>
```

匹配的是body标签中的p标签对应的内容.

1.3 E:first-child 匹配第一个子对象
---

示例:

```
div > p:first-child { text-indent: 0 }

<P> 这里是第一个P标签.
<DIV class="note">
   <P> 大屎蛋教程网.
</DIV>
```

以上只会匹配的一个p标签，不会匹配第二个p标签。

1.4 first-letter 匹配第一个字符
---

first-letter匹配第一个字符。布局需要首字母样式变化时, 可以通过这种方式来设定首字母的样式.

```
p { line-height: 1.1 }
p:first-letter { font-size: 3em; font-weight: normal }
span { font-weight: bold }
...
<p><span>Het hemelsche</span> gerecht heeft zich ten lange lesten<br>
Erbarremt over my en mijn benaeuwde vesten<br>
En arme burgery, en op mijn volcx gebed<br>
En dagelix geschrey de bange stad ontzet.
```

上述示例的中的首字母H会变大。


1.5 E1 + E2匹配相邻标签
---

```
h1 + h2 { margin-top: -5mm }  
```

匹配h1标签后边紧跟h2标签时，h2标签的内容.


1.6 E [FOO]匹配html标签中的特定属性
---

```
h1[title] { color: blue; }
```

匹配h1标签中添加了title属性的内容.

```
a[href="http://dashidan.com"]
```

匹配a标签中href的地址为http://dashidan.com的内容.

```
*[lang|="en"] { color : red }
```

匹配lang设置为en的内容.

1.7 E[foo="warning"]精确匹配特定属性
---

匹配属性为等号右边的值，不能有其他的属性。示例:

```
span[class=example] { color: blue; }
```

以上示例匹配span标签中class设置为example的内容。设置多个class，包含example时无效。

1.8 E[foo~="warning"]匹配包含特定属性
---

```
span[class~=example] { color: blue; }
```

以上示例匹配span标签中class包含example的内容。设置多个class，包含example时有效。

1.9 DIV.warning匹配特定标签中的类型
---

示例1：

```
.pastoral { color: green }  /* all elements with class~=pastoral */
```

以上示例匹配所有class设置为pastoral的内容.


示例2：

```
H1.pastoral { color: green }  /* H1 elements with class~=pastoral */
```

以上示例匹配所有h1标签中class设置为pastoral的内容.

1.10 E#myid匹配特定标签中的ID
---

示例1：

```
#chapter1 { color: green }  /* all elements with class~=pastoral */
```

以上示例匹配所有i设置为chapter1的内容.

示例2：

```
h1#chapter1 { text-align: center }
```
以上示例匹配所有h1标签中id设置为chapter1的内容.


1.11 E:link和E:visited 
---

css样式中的冒号":"表示匹配的是伪类型(pseudo-class)。根绝规则动态匹配对应内容。

:link和:visited匹配链接未访问和已访问的样式。

- E:link 匹配没有访问过的链接
- E:visited 匹配访问过的链接

```
a:link { color: red }
:link  { color: red }

<A href="http://dashidan.com/">大屎蛋教程网</A>
```

1.12 E:active E:hover和E:focus
---

':before'和':after'伪元素可用用来在元素的前后插入生成的内容. 

在第一行上设置的属性由第一个字母继承，但如果在第一个字母上设置相同的属性，则会覆盖它。

示例:

```
h1:before {content: counter(chapno, upper-roman) ". "}
```

当第一个字母和第一行伪元素应用于使用before和after之后生成内容的元素时，它们将应用于元素的第一个字母或行，包括生成的内容。

示例:
```
p.special:before {content: "Special! "}
p.special:first-letter {color: #ffd800}
```

[有关自动生成内容,数字序号和列表参考文章](https://www.w3.org/TR/CSS2/generate.html)


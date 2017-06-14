Handlebars 路径
---

Handlebars 支持简单的路径，就像Mustache那样。   

	<p>{{name}}</p>
	
Handlebars 同样也支持嵌套的路径，这样的话就可以在当前的上下文中查找内部嵌套的属性了。   

	<div class="entry">
	  <h1>{{title}}</h1>
	  <h2>By {{author.name}}</h2>

	  <div class="body">
		{{body}}
	  </div>
	</div>
	
上面的模板使用下面这段上下文：   

	var context = {
	  title: "My First Blog Post!",
	  author: {
		id: 47,
		name: "Yehuda Katz"
	  },
	  body: "My first post. Wheeeee!"
	};
	
这样一来 Handlebars 就可以直接把JSON数据拿来用了。
巢状嵌套的 handlebars 路径也可以使用 ../， 这样会把路径指向父级（上层）上下文。   

	<h1>Comments</h1>

	<div id="comments">
	  {{#each comments}}
	  <h2><a href="/posts/{{../permalink}}#{{id}}">{{title}}</a></h2>
	  <div>{{body}}</div>
	  {{/each}}
	</div>
	
尽管 a 链接在输出时是以 comment 评论为上下文的， 但它仍然可以退回上一层的上下文（post上下文）并取出permalink（固定链接）值。
../ 标识符表示对模板的父级作用域的引用，并不表示在上下文数据中的上一层。 这是因为块级 helpers 可以以任何上下文来调用一个块级表达式， 所以这个【上一层】的概念用来指模板作用域的父级更有意义些。   

	{{permalink}}
	{{#each comments}}
	  {{../permalink}}

	  {{#if title}}
		{{../permalink}}
	  {{/if}}
	{{/each}}
	
在这个例子中所有上述基准相同的 permalink 即使它们位于不同的块内的值。 此行为是新的 Handlebars 4， release notes 讨论以前的行为，以及迁移计划。
Handlebars也允许通过一个 this 的引用来解决 helpers 和 数据字段间的名字冲突：   

	<p>{{./name}} or {{this/name}} or {{this.name}}</p>
	
上面的这一种方式都会将 name 字段引用到当前上下文上， 而不是 helper 上的同名属性。
块表达式
---

块级表达式允许你定义一个helpers， 并使用一个不同于当前的上下文（context）来调用你模板的一部分。 现在考虑下这种情况，你需要一个helper来生成一段 HTML 列表：
并使用下面的上下文（数据）：   

	{{#list people}}{{firstName}} {{lastName}}{{/list}}
	
并使用下面的上下文（数据）：   

	{
	  people: [
		{firstName: "Yehuda", lastName: "Katz"},
		{firstName: "Carl", lastName: "Lerche"},
		{firstName: "Alan", lastName: "Johnson"}
	  ]
	}
	
此时需要创建一个 名为 list 的 helper 来生成这段 HTML 列表。 这个 helper 使用 people 作为第一个参数， 还有一个 options 对象（hash哈希）作为第二个参数。 这个 options 对象有一个叫 fn 的属性，你可以传递一个上下文给它（fn）， 就跟执行一个普通的 Handlebars 模板一样：    

	Handlebars.registerHelper('list', function(items, options) {
	  var out = "<ul>";

	  for(var i=0, l=items.length; i<l; i++) {
		out = out + "<li>" + options.fn(items[i]) + "</li>";
	  }

	  return out + "</ul>";
	});
	
执行之后，这个模板就会渲染出：   

	<ul>
	  <li>Yehuda Katz</li>
	  <li>Carl Lerche</li>
	  <li>Alan Johnson</li>
	</ul>
块级的 helpers 还有很多其他的特性，比如可以创建一个 else 区块（例如，内置的 if helper 就是用 else）。
注意，因为在你执行 options.fn(context) 的时候，这个 helper 已经把内容编码一次了， 所以 Handlebars 不会再对这个 helper 输出的值进行编码了。 如果编码了，这些内容就会被编码两次！
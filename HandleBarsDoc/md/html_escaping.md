HTML转义

Handlebars的 `{{expression}}`表达式会返回一个 HTML编码 HTML-escape 过的值。如果不希望Handlebars来编码这些值，使用三个大括号即可：`{{{`。   

	<div class="entry">
	  <h1>{{title}}</h1>
	  <div class="body">
		{{{body}}}
	  </div>
	</div>
	
使用这段上下文（数据）：   

	{
	  title: "All about <p> Tags",
	  body: "<p>This is a post about &lt;p&gt; tags</p>"
	}
	
会得到如下结果：   

	<div class="entry">
	  <h1>All About &lt;p&gt; Tags</h1>
	  <div class="body">
		<p>This is a post about &lt;p&gt; tags</p>
	  </div>
	</div>
	
Handlebars 不会再对 Handlebars.SafeString 安全字符串进行编码。如果你写的 helper 用来生成 HTML， 就经常需要返回一个 new Handlebars.SafeString(result)。 在这种情况下，你就需要手动的来编码参数了。   

	Handlebars.registerHelper('link', function(text, url) {
	  text = Handlebars.Utils.escapeExpression(text);
	  url  = Handlebars.Utils.escapeExpression(url);

	  var result = '<a href="' + url + '">' + text + '</a>';

	  return new Handlebars.SafeString(result);
	});
	
这样来编码传递进来的参数，并把返回的值标记为 安全，这样的话， 即便不是哟给你“三个大括号”，Handlebars 就不会再次编码它了。
快速开始
---

Handlebars模板看起来就像是正常的Html，并使用了嵌入的 handlebars 表达式。

	<div class="entry">
	  <h1>{{title}}</h1>
	  <div class="body">
		{{body}}
	  </div>
	</div>
	
handlebars表达式，是以 `{{` 开始，跟一些内容，然后以 `}}` 结束。   
你可以通过`<script>`标签把一段模板加载到浏览器中。   

	<script id="entry-template" type="text/x-handlebars-template">
	  <div class="entry">
		<h1>{{title}}</h1>
		<div class="body">
		  {{body}}
		</div>
	  </div>
	</script>
	
	
在 `JavaScript` 中使用 `Handlebars.compile` 来编译模板。   

	var source   = $("#entry-template").html();
	var template = Handlebars.compile(source);
	
还可以预编译模板。这样的话，就只需要一个更小的运行时库文件，并且对性能来说是一个极大的节约，因为这样就不必在浏览器中编译模板了。这点在移动版的开发中就更显的非常重要了。


只需传递一个上下文context执行模板，即可得到返回的 HTML 的值。   

	var context = {title: "My New Post", body: "This is my first post!"};
	var html    = template(context);
	得到下面的HTML
	<div class="entry">
	  <h1>My New Post</h1>
	  <div class="body">
		This is my first post!
	  </div>
	</div>
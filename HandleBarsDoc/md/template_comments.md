模板注释：{{!-- --}} 或 {{! }}
---

你可以在 handlebars 代码中加注释，就跟在代码中写注释一样。 对于有一定程度的逻辑的部分来说，这倒是一个很好的实践。   

	<div class="entry">
	  {{!-- only output author name if an author exists --}}
	  {{#if author}}
		<h1>{{firstName}} {{lastName}}</h1>
	  {{/if}}
	</div>
	
注释是不会最终输出到返回结果中的。如果你希望把注释展示出来，就使用 HTML 的注释就行了。   

	<div class="entry">
	  {{! This comment will not be in the output }}
	  <!-- This comment will be in the output -->
	</div>
	
所有注释都必须有 }}，一些多行注释可以使用 {{!-- --}} 语法。
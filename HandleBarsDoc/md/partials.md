Partials
---

Handlebars partials allow for code reuse by creating shared templates. Rendering this template   

	<div class="post">
	  {{> userMessage tagName="h1" }}

	  <h1>Comments</h1>

	  {{#each comments}}
		{{> userMessage tagName="h2" }}
	  {{/each}}
	</div>
	
when using this partial and context:   

	Handlebars.registerPartial('userMessage',
		'<{{tagName}}>By {{author.firstName}} {{author.lastName}}</{{tagName}}>'
		+ '<div class="body">{{body}}</div>');
	var context = {
	  author: {firstName: "Alan", lastName: "Johnson"},
	  body: "I Love Handlebars",
	  comments: [{
		author: {firstName: "Yehuda", lastName: "Katz"},
		body: "Me too!"
	  }]
	};
	
results in:   

	<div class="post">
	  <h1>By Alan Johnson</h1>
	  <div class="body">I Love Handlebars</div>

	  <h1>Comments</h1>

	  <h2>By Yehuda Katz</h2>
	  <div class="body">Me Too!</div>
	</div>
Helpers
---

Handlebars 的 helpers 在模板中可以访问任何的上下文。 可以通过 Handlebars.registerHelper 方法注册一个 helper。   

	<div class="post">
	  <h1>By {{fullName author}}</h1>
	  <div class="body">{{body}}</div>

	  <h1>Comments</h1>

	  {{#each comments}}
	  <h2>By {{fullName author}}</h2>
	  <div class="body">{{body}}</div>
	  {{/each}}
	</div>
	
当时用下面的上下文数据和 helpers：   

	var context = {
	  author: {firstName: "Alan", lastName: "Johnson"},
	  body: "I Love Handlebars",
	  comments: [{
		author: {firstName: "Yehuda", lastName: "Katz"},
		body: "Me too!"
	  }]
	};

	Handlebars.registerHelper('fullName', function(person) {
	  return person.firstName + " " + person.lastName;
	});
	
会得到如下结果：   

	<div class="post">
	  <h1>By Alan Johnson</h1>
	  <div class="body">I Love Handlebars</div>

	  <h1>Comments</h1>

	  <h2>By Yehuda Katz</h2>
	  <div class="body">Me Too!</div>
	</div>
	
Helpers 会把当前的上下文作为函数中的 this 上下文。   

	<ul>
	  {{#each items}}
	  <li>{{agree_button}}</li>
	  {{/each}}
	</ul>
	
当使用下面的 this上下文 和 helpers：   

	var context = {
	  items: [
		{name: "Handlebars", emotion: "love"},
		{name: "Mustache", emotion: "enjoy"},
		{name: "Ember", emotion: "want to learn"}
	  ]
	};

	Handlebars.registerHelper('agree_button', function() {
	  var emotion = Handlebars.escapeExpression(this.emotion),
		  name = Handlebars.escapeExpression(this.name);

	  return new Handlebars.SafeString(
		"<button>I agree. I " + emotion + " " + name + "</button>"
	  );
	});
	
会得到如下结果：   

	<ul>
	  <li><button>I agree. I love Handlebars</button></li>
	  <li><button>I agree. I enjoy Mustache</button></li>
	  <li><button>I agree. I want to learn Ember</button></li>
	</ul>
	
如果你不希望你的 helper 返回的 HTML 值被编码，就请务必返回一个 Handlebars.SafeStrin
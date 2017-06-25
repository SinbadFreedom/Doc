#### ``flatten()``
The flatten method flattens a multi-dimensional collection into a single dimension:
	
	const collection = collect({
	  club: 'Liverpool',
	  players: ['Sturridge', 'Firmino', 'Coutinho']
	});
	
	const flattened = collection.flatten();
	
	flattened.all();
	
	//=> ['Liverpool', 'Sturridge', 'Firmino', 'Coutinho'];
	
You may optionally pass the function a "depth" argument:
	
	const collection = collect({
	  Apple: [{
	    name: 'iPhone 6S',
	    brand: 'Apple'
	  }],
	  Samsung: [{
	    name: 'Galaxy S7',
	    brand: 'Samsung'
	  }]
	});
	
	const flattened = collection.flatten(1);
	
	flattened.all();
	
	//=> [
	//=>   {name: 'iPhone 6S', brand: 'Apple'},
	//=>   {name: 'Galaxy S7', brand: 'Samsung'}
	//=> ]
	

In this example, calling flatten without providing the depth would have also flattened the nested arrays, resulting in ``['iPhone 6S', 'Apple', 'Galaxy S7', 'Samsung']``. Providing a depth allows you to restrict the levels of nested arrays that will be flattened.
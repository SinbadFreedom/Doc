#### ``only()``
The only method returns the items in the collection with the specified keys:
	
	const collection = collect({
	  id: 12,
	  name: 'John Doe',
	  email: 'john@doe.com'
	  active: true
	});
	
	const filtered = collection.only(['name', 'email']);
	
	//=> {name: 'John Doe', email: 'john@doe.com'}
	
> For the inverse of ``only``, see the ``except`` method.
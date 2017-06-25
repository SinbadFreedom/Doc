#### ``get()``
The get method returns the item at a given key. If the key does not exist, ``null`` is returned:
	
	const collection = collect({
	  firstname: 'Chuck',
	  lastname: 'Norris'
	});
	
	collection.get('lastname');
	
	//=> Norris
	
	collection.get('middlename');
	//=> null
	

You may optionally pass a default value as the second argument:
	
	const collection = collect({
	  firstname: 'Chuck',
	  lastname: 'Norris'
	});
	
	collection.get('middlename', 'default-value');
	//=> default-value
	
You may even pass a callback as the default value. The result of the callback will be returned if the specified key does not exist:


	const collection = collect({
	  firstname: 'Chuck',
	  lastname: 'Norris'
	});
	
	collection.get('middlename', function () {
	  return 'default-value';
	});
	
	//=> default-value

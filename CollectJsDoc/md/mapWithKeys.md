#### ``mapWithKeys()``
The mapWithKeys method iterates through the collection and passes each value to the given callback. The callback should return an array where the first element represents the key and the second element represents the value pair:
	
	const collection = collect([{
	    'name': 'John',
	    'department': 'Sales',
	    'email': 'john@example.com'
	  }, {
	    'name': 'Jane',
	    'department': 'Marketing',
	    'email': 'jane@example.com'
	  }]);
	
	const keyed = collection.mapWithKeys(function (item) {
	  return [item.email, item.name];
	});
	
	keyed.all();
	
	//=> {
	//=>   'john@example.com': 'John',
	//=>   'jane@example.com': 'Jane',
	//=> }
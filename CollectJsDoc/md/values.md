#### ``values()``
The values method returns a new collection with the keys reset to consecutive integers:
	
	const collection = collect({a: 'xoxo', b: 'abab', 'c': '1337', 1337: 12});
	
	const values = collection.values();
	
	values.all();
	
	//=> [12, 'xoxo', 'abab', '1337']
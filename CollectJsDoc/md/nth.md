#### ``nth()``
The nth method creates a new collection consisting of every n-th element:
	
	const collection = collect(['a', 'b', 'c', 'd', 'e', 'f']);
	
	const nth = collection.nth(4);
	
	nth.all();
	
	//=> ['a', 'e']
	
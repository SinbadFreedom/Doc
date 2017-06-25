#### ``random()``
The random method returns a random item from the collection:
	
	const collection = collect([1, 2, 3, 4, 5]);
	
	collection.random();
	
	//=> 4 (retrieved randomly)
	

You may optionally pass an integer to random to specify how many items you would like to randomly retrieve. If that integer is more than 1, a collection of items is returned:
	
	const random = collection.random(3);
	
	//=> [5, 3, 4] (retrieved randomly)
	
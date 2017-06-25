#### ``splice()``
The splice method removes and returns a slice of items starting at the specified index:
	
	const collection = collect([1, 2, 3, 4, 5]);
	
	const chunk = collection.splice(2);
	
	chunk.all();
	
	//=> [3, 4, 5]
	
	collection.all();
	
	//=> [1, 2]
	
You may pass a second argument to limit the size of the resulting chunk:
	
	const collection = collect([1, 2, 3, 4, 5]);
	
	const chunk = collection.splice(2, 1);
	
	chunk.all();
	
	//=> [3]
	
	collection.all();
	
	//=> [1, 2, 4, 5]
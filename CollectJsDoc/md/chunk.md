#### ``chunk()``
The chunk method breaks the collection into multiple, smaller collections of a given size:
	
	const collection = collect([1, 2, 3, 4, 5, 6, 7]);
	
	const chunks = collection.chunk(4);
	
	chunks.all();
	
	//=> [[1, 2, 3, 4], [5, 6, 7]]
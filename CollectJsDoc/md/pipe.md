#### ``pipe()``
The pipe method passes the collection to the given callback and returns the result:
	
	const collection = collect([1, 2, 3]);
	
	const piped = collection.pipe(function (collection) {
	  return collection.sum();
	});
	
	//=> 6
	
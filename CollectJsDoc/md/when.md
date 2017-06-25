#### ``when()``
The when method will execute the given callback when the first argument given to the method evaluates to true:
	
	const collection = collect([1, 2, 3]);
	
	collection.when(true, function (collection) {
	  return collection.push(4);
	});
	
	collection.all();
	
	// [1, 2, 3, 4]
	
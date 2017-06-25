
#### ``last()``
The last method returns the last element in the collection that passes a given truth test:
	
	const collection = collect([1, 2, 3]);
	
	const last = collection.last(function (item) {
	  return item > 1;
	});
	
	//=> 3
	
You may also call the last method with no arguments to get the last element in the collection. If the collection is empty, null is returned:
	
	collect([1, 2, 3, 4]).last();
	
	//=> 4
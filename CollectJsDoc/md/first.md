#### ``first()``
The first method returns the first element in the collection that passes a given truth test:
	
	collect([1, 2, 3, 4]).first(function (item) {
	  return item > 1;
	});
	
	//=> 2
	
You may also call the first method with no arguments to get the first element in the collection. If the collection is empty, null is returned:
	
	collect([1, 2, 3, 4]).first();
	
	//=> 1
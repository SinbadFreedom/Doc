#### ``times()``
The times method creates a new collection by invoking the callback a given amount of times:
	
	const collection = collect().times(10, function (number) {
	  return number * 9;
	});
	
	collection.all();
	
	//=> [9, 18, 27, 36, 45, 54, 63, 72, 81, 90]
	
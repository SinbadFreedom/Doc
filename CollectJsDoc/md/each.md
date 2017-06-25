each#### ``each()``
The each method iterates over the items in the collection and passes each item to a callback:
	
	let sum = 0;
	
	const collection = collect([1, 3, 3, 7]);
	
	collection.each(function (item) {
	  sum += item;
	});
	
	//=> console.log(sum);
	//=> 14
	

If you would like to stop iterating through the items, you may return false from your callback:
	
	let sum = 0;
	
	const collection = collect([1, 3, 3, 7]);
	
	collection.each(function (item) {
	  if (item > 3) {
	    return false;
	  }
	
	  sum += item;
	});
	
	//=> console.log(sum);
	//=> 7
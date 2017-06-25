#### ``sort()``
The sort method sorts the collection:
	
	const collection = collect([5, 3, 1, 2, 4]);
	
	const sorted = collection.sort();
	
	sorted.all();
	
	//=> [1, 2, 3, 4, 5]
	
	
	> If your sorting needs are more advanced, you may pass a callback to sort with your own algorithm.
	
	
	const collection = collect([5, 3, 1, 2, 4]);
	
	const sorted = collection.sort(function (a, b) {
	  return b - a;
	});
	
	sorted.all();
	
	//=> [5, 4, 3, 2, 1]
	

> If you need to sort a collection of nested arrays or objects, see the ``sortBy`` and ``sortByDesc`` methods.
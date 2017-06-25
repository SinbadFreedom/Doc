#### ``partition()``
The partition method may be combined with destructuring to separate elements that pass a given truth test from those that do not:
	
	const collection = collect([1, 2, 3, 4, 5, 6]);
	
	const [underThree, underThree] = collection.partition(function (i) {
	  return i < 3;
	});
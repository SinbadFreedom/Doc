#### ``contains()``
The contains method determines whether the collection contains a given item:
	
	const collection = collect({
	  name: 'Steven Gerrard',
	  number: 8
	});
	
	collection.contains('name');
	//=> true
	
	collection.contains('age');
	//=> false
	
You may also work with arrays
	
	const collection = collect([1, 2, 3]);
	
	collection.contains(3);
	//=> true
	
	You may also pass a key / value pair to the contains method, which will determine if the given pair exists in the collection:
	
	const collection = collect({
	  name: 'Steven Gerrard',
	  number: 8
	});
	
	collection.contains('name', 'Steve Jobs');
	//=> false
	

Finally, you may also pass a callback to the contains method to perform your own truth test:
	
	const collection = collect([1, 2, 3, 4, 5]);
	
	collection.contains(function (value, key) {
	  return value > 5;
	});
	
	//=> false
	
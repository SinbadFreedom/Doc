#### ``toArray()``
The toArray method converts the collection into a plain array.
If the collection is an object, an array containing the values will be returned.
	
	const collection = collect([1, 2, 3, 'b', 'c']);
	
	collection.toArray();
	
	//=> [1, 2, 3, 'b', 'c']
	

	
	const collection = collect({
	  name: 'Elon Musk',
	  companies: [
	    'Tesla',
	    'Space X',
	    'SolarCity'
	  ]
	});
	
	collection.toArray();
	
	//=> ['Elon Musk', ['Tesla', 'Space X', 'SolarCity']]
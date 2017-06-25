#### ``avg()``
The avg method returns the average of all items in the collection:
	
	collect([1, 3, 3, 7]).avg();
	
	//=> 3.5
	

If the collection contains nested arrays or objects, you should pass a key to use for determining which values to calculate the average:
	
	const collection = collect([{
	  name: 'JavaScript: The Good Parts', pages: 176
	}, {
	  name: 'JavaScript: The Definitive Guide', pages: 1096
	}]);
	
	collection.avg('pages');
	
	//=> 636
	
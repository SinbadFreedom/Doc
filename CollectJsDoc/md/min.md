
#### ``min()``
The min method returns the minimum value of a given key:
	
	const collection = collect[{
	  worth: 100
	}, {
	  worth: 900
	}, {
	  worth: 79
	}]);
	
	collection.min('worth');
	
	//=> 79
	
	
	collect([1, 2, 3, 4, 5]).min();
	
	//=> 1
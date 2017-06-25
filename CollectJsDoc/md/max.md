#### ``max()``
The max method returns the maximum value of a given key:
	
	const collection = collect([{
	  value: 10
	}, {
	  value: -13
	}, {
	  value: 12
	}, {
	  unicorn: false
	}]);
	
	const max = collection.max('value');
	
	//=> 12
	
	
	collect([-1, -2345, 12, 11, 3]).max();
	
	//=> 12
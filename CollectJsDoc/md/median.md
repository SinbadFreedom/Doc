#### ``median()``
The median method returns the median value of a given key:
	
	collect([1, 3, 3, 6, 7, 8, 9]).median();
	
	//=> 6
	
	
	
	collect([{
	  foo: 1
	}, {
	  foo: 1
	}, {
	  foo: 2
	}, {
	  foo: 4
	}]).median('foo');
	
	//=> 1.5
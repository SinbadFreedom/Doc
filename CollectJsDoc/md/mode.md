#### ``mode()``
The mode method returns the mode value of a given key:
	
	collect([1, 3, 3, 6, 7, 8, 9]).mode();
	
	//=> [3]
	
	
	
	collect([{
	  foo: 1
	}, {
	  foo: 1
	}, {
	  foo: 2
	}, {
	  foo: 4
	}]).mode('foo');
	
	//=> [1]
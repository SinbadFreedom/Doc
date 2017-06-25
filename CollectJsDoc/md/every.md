every#### ``every()``
The every method may be used to verify that all elements of a collection pass a given truth test:
	
	collect([1, 2, 3, 4]).every(function (value, key) {
	  return value > 2;
	});
	
	//=> false
	

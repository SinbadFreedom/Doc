#### ``zip()``
The zip method merges together the values of the given array with the values of the original collection at the corresponding index:
	
	const collection = collect(['Chair', 'Desk']);
	
	const zipped = collection.zip([100, 200]);
	
	zipped.all();
	
	//=> [['Chair', 100], ['Desk', 200]]
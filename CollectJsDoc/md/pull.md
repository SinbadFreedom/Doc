#### ``pull()``
The pull method removes and returns an item from the collection by its key:
	
	const collection = collect({
	  firstname: 'Michael',
	  lastname: 'Cera'
	});
	
	collection.pull('lastname');
	
	//=> Cera
	
	collection.all();
	
	//=> {firstname: 'Michael'}
	
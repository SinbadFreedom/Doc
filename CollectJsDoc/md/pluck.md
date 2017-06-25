#### ``pluck()``
The pluck method retrieves all of the values for a given key:
	
	const collection = collect([{
	  id: 78,
	  name: 'Aeron'
	}, {
	  id: 79,
	  name: 'Embody'
	}]);
	
	const plucked = collection.pluck('name');
	
	plucked.all();
	
	//=> ['Aeron', 'Embody']
	

You may also specify how you wish the resulting collection to be keyed:
	
	const collection = collect([{
	  id: 78,
	  name: 'Aeron'
	}, {
	  id: 79,
	  name: 'Embody'
	}]);
	
	const plucked = collection.pluck('name', 'id');
	
	plucked.all();
	
	//=> {
	//=>   78: 'Aeron',
	//=>   79: 'Embody'
	//=> }
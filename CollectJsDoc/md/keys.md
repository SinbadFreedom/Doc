#### ``keys()``
The keys method returns all of the collection's keys:
	
	const collection = collect([{
	  name: 'Steven Gerrard',
	  number: 8
	}, {
	  club: 'Liverpool',
	  nickname: 'The Reds'
	}]);
	
	keys = collection.keys();
	
	//=> ['name', 'number', 'club', 'nickname']
	
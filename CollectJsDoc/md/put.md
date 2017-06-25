#### ``put()``
The put method sets the given key and value in the collection:
	
	const collection = collect(['JavaScript', 'Python']);
	
	collection.put('Ruby');
	
	collection.all();
	
	//=> ['JavaScript', 'Python', 'Ruby']
	
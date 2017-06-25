#### ``macro()``
The macro method lets you register custom methods
	
	collect().macro('uppercase', function () {
	  return this.map(function (item) {
	    return item.toUpperCase();
	  });
	});
	
	const collection = collect(['a', 'b', 'c']);
	
	collection.uppercase();
	
	collection.all();
	
	//=> ['A', 'B', 'C']
	
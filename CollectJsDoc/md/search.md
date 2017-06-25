#### ``search()``
The search method searches the collection for the given value and returns its key if found. If the item is not found, false is returned.
	
	const collection = collect([2, 4, 6, 8]);
	
	collection.search(4);
	
	//=> 1
	

The search is done using a "loose" comparison, meaning a string with an integer value will be considered equal to an integer of the same value. To use strict comparison, pass true as the second argument to the method:
	
	collection.search('4', true);
	
	//=> false
	

Alternatively, you may pass in your own callback to search for the first item that passes your truth test:
	
	collection.search(function (item, key) {
	  return item > 5;
	});
	
	//=> 2
	
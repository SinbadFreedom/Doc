#### ``shuffle()``
The shuffle method randomly shuffles the items in the collection:
	
	const collection = collect([1, 2, 3, 4, 5]);
	
	const shuffled = collection.shuffle();
	
	shuffled.all();
	
	//=> [3, 5, 1, 2, 4] (generated randomly)
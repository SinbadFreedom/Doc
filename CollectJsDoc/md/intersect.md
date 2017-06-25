#### ``intersect()``
The intersect method removes any values from the original collection that are not present in the given ``array`` or ``collection``. The resulting collection will preserve the original collection's keys:
	
	const collection = collect([1, 2, 3, 4, 5]);
	
	intersect = collection.intersect([1, 2, 3, 9]);
	
	intersect.all();
	
	//=> [1, 2, 3]
	

	
	const firstCollection = collect([1, 2, 3, 4, 5]);
	const secondCollection = collect([1, 2, 3, 9]);
	
	intersect = firstCollection.intersect(secondCollection);
	
	intersect.all();
	
	//=> [1, 2, 3]
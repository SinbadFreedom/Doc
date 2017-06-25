#### ``split()``
The split method breaks a collection into the given number of groups:
	
	const collection = collect([1, 2, 3, 4, 5]);
	
	const groups = collection.split(3);
	
	//=> [[1, 2], [3, 4], [5]]
	

In addition, you can pass a third argument containing the new items to replace the items removed from the collection:
	
	const collection = collect([1, 2, 3, 4, 5]);
	
	const chunk = collection.splice(2, 1, [10, 11]);
	
	chunk.all()
	
	//=> [3]
	
	collection.all();
	
	//=> [1, 2, 10, 11, 4, 5]
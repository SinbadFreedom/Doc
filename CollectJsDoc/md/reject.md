#### ``reject()``
The reject method filters the collection using the given callback. The callback should return true if the item should be removed from the resulting collection:
	
	const collection = collect([1, 2, 3, 4]);
	
	const filtered = collection.reject(function (value) {
	  return value > 2;
	});
	
	//=> [1, 2]
	

> For the inverse of the ``reject`` method, see the ``filter`` method.
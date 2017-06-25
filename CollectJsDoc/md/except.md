#### ``except()``
The except method returns all items in the collection except for those with the specified keys:
	
	const collection = collect({
	  product_id: 1,
	  price: 100,
	  discount: false
	});
	
	const filtered = collection.except(['price', 'discount']);
	
	filtered.all();
	
	//=> {product_id: 1}
	

> For the inverse of ``except``, see the ``only`` method.
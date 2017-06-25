#### ``whereIn()``
The whereIn method filters the collection by a given key / value contained within the given array.
	
	const collection = collect([
	  {product: 'Desk', price: 200},
	  {product: 'Chair', price: 100},
	  {product: 'Bookcase', price: 150},
	  {product: 'Door', price: 100},
	]);
	
	const filtered = collection.whereIn('price', [100, 150]);
	
	filtered.all();
	
	//=> [
	//=>   {product: 'Chair', price: 100},
	//=>   {product: 'Bookcase', price: 150},
	//=>   {product: 'Door', price: 100},
	//=> ]
	
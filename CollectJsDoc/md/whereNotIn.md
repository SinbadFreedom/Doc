#### ``whereNotIn()``
The whereNotIn method filters the collection by a given key / value not contained within the given array:
	
	const collection = collect([
	  { product: 'Desk', price: 200 },
	  { product: 'Chair', price: 100 },
	  { product: 'Bookcase', price: 150 },
	  { product: 'Door', price: 100 }
	]);
	
	const filtered = collection.whereNotIn('price', [150, 200]);
	
	filtered.all();
	
	//=> [
	//=>   { product: 'Chair', price: 100 },
	//=>   { product: 'Door', price: 100 }
	//=> ]
	
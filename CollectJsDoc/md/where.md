
#### ``where()``
The where method filters the collection by a given key / value pair:
	
	const collection = collect([
	  {product: 'Desk', price: 200},
	  {product: 'Chair', price: 100},
	  {product: 'Bookcase', price: 150},
	  {product: 'Door', price: 100},
	]);
	
	const filtered = collection.where('price', 100);
	
	filtered.all();
	
	//=> [
	//=>   {product: 'Chair', price: 100},
	//=>   {product: 'Door', price: 100}
	//=> ]
	

The where method also allows for custom comparisons:
**Non-identity / strict inequality ``(!==)``**
	
	const filtered = collection.where('price', '!==', 100);
	
	filtered.all();
	
	//=> [
	//=>   {product: 'Desk', price: 200},
	//=>   {product: 'Bookcase', price: 150}
	//=> ]
	
**Less than operator ``(<)``**
	
	const filtered = collection.where('price', '<', 100);
	
	filtered.all();
	
	//=> []
	
**Less than or equal operator ``(<=)``**
	
	const filtered = collection.where('price', '<=', 100);
	
	filtered.all();
	
	//=> [
	//=>   {product: 'Chair', price: 100},
	//=>   {product: 'Door', price: 100}
	//=> ]
	

**Greater than operator ``(>)``**
	
	const filtered = collection.where('price', '>', 100);
	
	filtered.all();
	
	//=> [
	//=>   {product: 'Desk', price: 200},
	//=>   {product: 'Bookcase', price: 150}
	//=> ]
	
**Greater than or equal operator ``(>=)``**
	
	const filtered = collection.where('price', '>=', 150);
	
	filtered.all();
	
	//=> [
	//=>   {product: 'Desk', price: 200},
	//=>   {product: 'Bookcase', price: 150}
	//=> ]
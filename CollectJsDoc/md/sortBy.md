#### ``sortBy()``
The sortBy method sorts the collection by the given key. The sorted collection keeps the original array keys, so in this example we'll use the values method to reset the keys to consecutively numbered indexes:
	
	const collection = collect([
	  {name: 'Desk', price: 200},
	  {name: 'Chair', price: 100},
	  {name: 'Bookcase', price: 150},
	]);
	
	const sorted = collection.sortBy('price');
	
	sorted.all();
	
	//=> [
	//=>   {name: 'Chair', price: 100},
	//=>   {name: 'Bookcase', price: 150},
	//=>   {name: 'Desk', price: 200},
	//=> ]
	

You can also pass your own callback to determine how to sort the collection values:
	
	const collection = collect([
	  {name: 'Desk', colors: ['Black', 'Mahogany']},
	  {name: 'Chair', colors: ['Black']},
	  {name: 'Bookcase', colors: ['Red', 'Beige', 'Brown']},
	]);
	
	const sorted = collection.sortBy(function (product, key) {
	  return product['colors'].length;
	});
	
	sorted.all();
	
	//=> [
	//=>   {name: 'Chair', colors: ['Black']},
	//=>   {name: 'Desk', colors: ['Black', 'Mahogany']},
	//=>   {name: 'Bookcase', colors: ['Red', 'Beige', 'Brown']},
	//=> ]
	

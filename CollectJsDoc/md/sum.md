#### ``sum()``
The sum method returns the sum of all items in the collection:
	
	collect([1, 2, 3]).sum();
	
	//=> 6
	

If the collection contains nested arrays or objects, you should pass a key to use for determining which values to sum:
	
	const collection = collect([
	  {name: 'JavaScript: The Good Parts', pages: 176},
	  {name: 'JavaScript: The Definitive Guide', pages: 1096},
	]);
	
	collection.sum('pages');
	
	//=> 1272
	

In addition, you may pass your own callback to determine which values of the collection to sum:
	
	const collection = collect([
	  {name: 'Desk', colors: ['Black', 'Mahogany']},
	  {name: 'Chair', colors: ['Black']},
	  {name: 'Bookcase', colors: ['Red', 'Beige', 'Brown']},
	]);
	
	const total = collection.sum(function (product) {
	  return product.colors.length;
	});
	
	//=> 6
#### ``unique()``
The unique method returns all of the unique items in the collection:
	
	const collection = collect([1, 1, 1, 2, 3, 3]);
	
	const unique = collection.unique();
	
	unique.all();
	
	//=> [1, 2, 3]
	

When dealing with an array of objects, you may specify the key used to determine uniqueness:
	
	const collection = collect([
	  {name: 'iPhone 6', brand: 'Apple', type: 'phone'},
	  {name: 'iPhone 5', brand: 'Apple', type: 'phone'},
	  {name: 'Apple Watch', brand: 'Apple', type: 'watch'},
	  {name: 'Galaxy S6', brand: 'Samsung', type: 'phone'},
	  {name: 'Galaxy Gear', brand: 'Samsung', type: 'watch'}
	]);
	
	const unique = collection.unique('brand');
	
	unique.all();
	
	//=> [
	//=>   {name: 'iPhone 6', brand: 'Apple', type: 'phone'},
	//=>   {name: 'Galaxy S6', brand: 'Samsung', type: 'phone'},
	//=> ]
	

You may also pass your own callback to determine item uniqueness:
	
	const collection = collect([
	  {name: 'iPhone 6', brand: 'Apple', type: 'phone'},
	  {name: 'iPhone 5', brand: 'Apple', type: 'phone'},
	  {name: 'Apple Watch', brand: 'Apple', type: 'watch'},
	  {name: 'Galaxy S6', brand: 'Samsung', type: 'phone'},
	  {name: 'Galaxy Gear', brand: 'Samsung', type: 'watch'}
	]);
	
	const unique = collection.unique(function (item) {
	  return item.brand + item.type;
	});
	
	unique.all();
	
	//=> [
	//=>   {name: 'iPhone 6', brand: 'Apple', type: 'phone'},
	//=>   {name: 'Apple Watch', brand: 'Apple', type: 'watch'},
	//=>   {name: 'Galaxy S6', brand: 'Samsung', type: 'phone'},
	//=>   {name: 'Galaxy Gear', brand: 'Samsung', type: 'watch'},
	//=> ]
	
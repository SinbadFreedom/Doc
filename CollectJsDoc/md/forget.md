#### ``forget()``
The forget method removes an item from the collection by its key:
	
	const collection = collect({
	  name: 'Steven Gerrard',
	  number: 8
	});
	
	collection.forget('number');
	
	collection.all();
	
	//=> {
	//=>   name: 'Steven Gerrard'
	//=> }
	
> Unlike most other collection methods, forget does not return a new modified collection; it modifies the collection it is called on.
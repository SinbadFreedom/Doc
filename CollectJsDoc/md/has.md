#### ``has()``
The has method determines if a given key exists in the collection:
	
	const collection = collect({
	  animal: 'unicorn',
	  ability: 'magical'
	});
	
	collection.has('ability');
	
	//=> true
	
An array of objects also works:
	
	const collection = collect([{
	  animal: 'unicorn',
	  ability: 'magical'
	}, {
	  anmial: 'pig',
	  ability: 'filthy'
	}]);
	
	collection.has('ability');
	
	//=> true
	
#### ``flatMap()``
The flatMap method iterates through the collection and passes each value to the given callback. The callback is free to modify the item and return it, thus forming a new collection of modified items. Then, the array is flattened by a level:
	
	const collection = collect({
	  name: 'Robbie Fowler',
	  nickname: 'The God',
	  position: 'Striker'
	});
	
	const flatMapped = collection.flatMap(function (values) {
	  return values.map(function (value) {
	    return value.toUpperCase();
	  });
	});
	
	flatMapped.all();
	
	//=> {
	//=>   name: 'ROBBIE FOWLER',
	//=>   nickname: 'THE GOD',
	//=>   position: 'STRIKER'
	//=> }
	
#### ``groupBy()``
The groupBy method groups the collection's items by a given key:
	
	const collection = collect([
	  {
	    product: 'Chair',
	    manufacturer: 'IKEA'
	  },
	  {
	    product: 'Desk',
	    manufacturer: 'IKEA'
	  },
	  {
	    product: 'Chair',
	    manufacturer: 'Herman Miller'
	  }
	]);
	
	const grouped = collection.groupBy('manufacturer');
	
	grouped.all();
	
	//=> {
	//=>   IKEA: [
	//=>     {
	//=>       id: 100,
	//=>       product: 'Chair',
	//=>       manufacturer: 'IKEA',
	//=>       price: '1490 NOK'
	//=>     },
	//=>     {
	//=>       id: 150,
	//=>       product: 'Desk',
	//=>       manufacturer: 'IKEA',
	//=>       price: '900 NOK'
	//=>     }
	//=>   ],
	//=>   'Herman Miller': [
	//=>     {
	//=>       id: 200,
	//=>       product: 'Chair',
	//=>       manufacturer: 'Herman Miller',
	//=>       price: '9990 NOK'
	//=>     }
	//=>   ]
	//=> }
	

In addition to passing a string key, you may also pass a callback. The callback should return the value you wish to key the group by:

	
	const collection = collect([
	  {
	    product: 'Chair',
	    manufacturer: 'IKEA'
	  },
	  {
	    product: 'Desk',
	    manufacturer: 'IKEA'
	  },
	  {
	    product: 'Chair',
	    manufacturer: 'Herman Miller'
	  }
	]);
	
	const grouped = collection.groupBy(function (item, key) {
	  return item.manufacturer.substring(0, 3);
	});
	
	grouped.all();
	
	//=> {
	//=>   IKE: [
	//=>     {
	//=>       id: 100,
	//=>       product: 'Chair',
	//=>       manufacturer: 'IKEA',
	//=>       price: '1490 NOK'
	//=>     },
	//=>     {
	//=>       id: 150,
	//=>       product: 'Desk',
	//=>       manufacturer: 'IKEA',
	//=>       price: '900 NOK'
	//=>     }
	//=>   ],
	//=>   Her: [
	//=>     {
	//=>       id: 200,
	//=>       product: 'Chair',
	//=>       manufacturer: 'Herman Miller',
	//=>       price: '9990 NOK'
	//=>     }
	//=>   ]
	//=> }
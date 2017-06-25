#### ``toJson()``
The toJson method converts the collection into JSON string:
	
	const collection = collect({
	  id: 384,
	  name: 'Rayquaza',
	  gender: 'NA'
	});
	
	const json = collection.toJson();
	
	//=> {"id": 384, "name": "Rayquaza", "gender": "NA"}
	

> Convenient and dependency free wrapper for working with arrays and objects

### Installation

	npm install collect.js --save
	

### Tip
Using Laravel as your backend? Collect.js offers an (almost) identical api to [Laravel Collections](https://laravel.com/docs/5.4/collections) 5.4. [See differences](#strictness-and-comparisons).

### Usage
All available methods   
- [all](#all)   
- [average](#average)   
- [chunk](#chunk)   
- [collapse](#collapse)   
- [combine](#combine)   
- [contains](#contains)   
- [count](#count)
- [diff](#diff)   
- [diffKeys](#diffkeys)   
- [each](#each)   
- [every](#every)   
- [except](#except)   
- [filter](#filter)   
- [first](#first)   
- [flatMap](#flatmap)   
- [flatten](#flatten)   
- [flip](#flip)   
- [forget](#forget)   
- [forPage](#forpage)   
- [get](#get)   
- [groupBy](#groupby)   
- [has](#has)   
- [implode](#implode)   
- [intersect](#intersect)   
- [isEmpty](#isempty)   
- [isNotEmpty](#isnotempty)   
- [keyBy](#keyby)   
- [keys](#keys)   
- [last](#last)   
- [macro](#macro)   
- [map](#map)   
- [mapWithKeys](#mapwithkeys)   
- [max](#max)   
- [median](#median)   
- [merge](#merge)   
- [min](#min)   
- [mode](#mode)   
- [nth](#nth)   
- [only](#only)   
- [partition](#partition)   
- [pipe](#pipe)   
- [pluck](#pluck)   
- [pop](#pop)   
- [prepend](#prepend)   
- [pull](#pull)   
- [push](#push)   
- [put](#put)   
- [random](#random)   
- [reduce](#reduce)   
- [reject](#reject)   
- [reverse](#reverse)   
- [search](#search)   
- [shift](#shift)   
- [shuffle](#shuffle)   
- [slice](#slice)   
- [sort](#sort)   
- [sortBy](#sortby)   
- [sortByDesc](#sortbydesc)   
- [splice](#splice)   
- [split](#split)   
- [sum](#sum)      
- [take](#take)   
- [tap](#tap)   
- [times](#times)   
- [toArray](#toarray)   
- [toJson](#tojson)   
- [transform](#transform)   
- [union](#union)   
- [unique](#unique)   
- [values](#values)   
- [when](#when)   
- [where](#where)   
- [whereIn](#wherein)   
- [whereNotIn](#whereNotIn)   
- [zip](#zip)   


### Strictness and comparisons
All comparisons in ``collect.js`` are done using strict equality. Using loose equality comparisons are generally frowned upon in JavaScript. Laravel only performs "loose" comparisons by default and offer several "strict" comparison methods. These methods have not been implemented in ``collect.js`` because all methods are strict by default. 

#####  Methods that have not been implemented:
- ~~``containsStrict``~~ use ``contains()``
- ~~``uniqueStrict``~~ use ``unique()``
- ~~``whereStrict``~~ use ``where()``
- ~~``whereInStrict``~~ use ``whereIn()``
- ~~``whereNotInStrict``~~ use ``whereNotIn()``

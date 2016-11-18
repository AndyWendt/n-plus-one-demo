# Laravel N+1 Demo

Most ORM's lazy load relations by default.  That means that when you call `$publisher->authors()->get()` 
it issues a new request each time.

For example, if you call `foreach` over `publishers` to get the `authors` you will be creating a new sql query 
each time: 

```
$publishers = \App\Publishers\Publisher::all();
$authors = [];

foreach($publishers as $publisher) {
    $authors[] = $publishers->authors()->get();
}
```
The number of queries for the above will be: `number-of-publishers + initial query`.  If there were ten publishers then 
it would result in 11 queries.   

If you refactored this to utilize Laravel's eager loading, then it will result in only a couple of queries: 

```
$publishers = \App\Publishers\Publisher::with('authors)->get();
$authors = [];

foreach($publishers as $publisher) {
    $authors[] = $publishers->authors;
}
```

## Resources

* https://laravel.com/docs/5.3/eloquent-relationships#querying-relations
* https://laravel.com/docs/5.3/eloquent-relationships#eager-loading
* https://laravel.com/docs/5.3/database
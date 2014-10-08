# Laravel Pagination

Create beautiful and SEO friendly links for pagination.

---

## Installation and Requirements

First, you'll need to add the package to the require attribute of your composer.json file:

```json
{
    "require": {
        "mayoz/pagination": "dev-master"
    },
}
```

Afterwards, run `composer update` from your command line.

And finaly, open  `config/app.php`. Find `'Illuminate\Pagination\PaginationServiceProvider'` replace with `'Mayoz\Pagination\PaginationServiceProvider'` in providers array.


## Using

This is very easy.

### Route
Define your own route in `app\Http\routes`;

```php
<?php
$router->get('articles/{page?}', [
    'as'   => 'articles',
    'uses' => 'HomeController@articles'
]);
```

### Controller

```php
<?php namespace App\Http\Controllers;

use App\Article;

class HomeController {

    public function articles()
	{
        $articles = Article::paginate(5);

        return view('articles', compact('articles'));
    }
}
```

### View
Core pagination class not changed. Can use all the features offered by Laravel.
```blade
<ul>
    @foreach ($articles as $article)
        <li>{{ $article->title }}<li>
    @endforeach
</ul>

{!! $articles->links() !!}
```

You also use;
 - `{!! $articles->appends([ 'sort' => 'vote ])->links() !!}`
 - `{!! $articles->links('pagination.special') !!}`
 - or future methods...
 -

## Output examples
```php
<?php
$router->get('articles/{page?}', [
    'as'   => 'articles',
    'uses' => 'HomeController@articles'
]);
```
Use such as {page?}, if page pattern at the end of the route. Outputs:
- /articles
- /articles/2
- /articles/3

```php
<?php
$router->get('module/{page}/articles', [
    'as'   => 'module.articles',
    'uses' => 'HomeController@articles'
]);
```
If {page} pattern in the middle of the route, no need to question mark. Outputs:
- /module/1/articles
- /module/2/articles
- /module/3/articles

## Helper methods
If you need to use another route instead of the current route, use the `route()` method. This method accepts the route name and route parameters.

### Routes
Routes is different but used same controller and view.
```php
<?php
$router->get('/articles', [
    'as'   => 'articles',
    'uses' => 'HomeController@articles'
]);

$router->get('articles/{module}/{page?}', [
    'as'   => 'articles.paginate',
    'uses' => 'HomeController@articles'
]);
```

### Controller
The same as the previous definition. Added special route (its name article.paginate) for pagination url builder. This route required one parameter (module) except {page}.

Set automatically route parameters if on current route.
```php
<?php namespace App\Http\Controllers;

use App\Article;

class HomeController {

    public function articles()
	{
        $articles = Article::paginate(5);
        $articles->route('articles.paginate', [ 'module' => 'photo' ]);

        return view('articles', compact('articles'));
    }
}
```

Outputs:
- /articles/photo
- /articles/photo/2
- /articles/photo/3

> **NOTE**: Second parameter is optional for route method.

## Contribute
Install and use this package. If find bug, fix and send a pull request on the develop branch.

## Copyright and License

This package was written by Sercan Çakır. It released under the MIT License. See the LICENSE file for details.

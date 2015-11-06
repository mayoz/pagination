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
And finaly, open  `config/app.php`. Find `'Illuminate\Pagination\PaginationServiceProvider'` and replace with `'Mayoz\Pagination\PaginationServiceProvider'` in providers array.

## Using
This is very easy. Consider the following examples. I accept to have your model. Create route, controller and view.

### Route
Define route in `app\Http\routes`;

```php
<?php
$router->get('articles/{page?}', [
    'as'   => 'articles',
    'uses' => 'HomeController@articles'
]);
```

### Controller
Cool. Don't write extra code!

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
 - `{!! $articles->appends([ 'sort' => 'vote' ])->links() !!}`
 - `{!! $articles->links('pagination.special') !!}`
 - or future methods...

## Output examples
The following outputs are generated. I think that's enough examples. As possible, SEO friendly. Nevertheless, please check your url. Use `canonical` metadata if necessary.

Use such as {page?}, if page pattern at the end of the route.

```php
<?php
$router->get('articles/{page?}', [
    'as'   => 'articles',
    'uses' => 'HomeController@articles'
]);
```

Outputs:
- /articles
- /articles/2
- /articles/3

If {page} pattern in the middle of the route, no need to question mark.

```php
<?php
$router->get('module/{page}/articles', [
    'as'   => 'module.articles',
    'uses' => 'HomeController@articles'
]);
```

Outputs:
- /module/1/articles
- /module/2/articles
- /module/3/articles

## Using special route
If you need to use another route instead of the current route, use the `route()` method. This method accepts the route name and route arguments.
> **NOTE**: Second arg is optional. This arg for special routes parameters.

### Routes
Routes is different but used same controller and view.

```php
<?php
$router->get('articles', [
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

> **NOTE:** Set automatically route parameters on current route.

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

## Contribute
Install and use this package. If find bug, fix and send a pull request on the develop branch.

## Copyright and License

This package was written by Sercan Çakır. It released under the MIT License. See the LICENSE file for details.

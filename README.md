[![Latest Stable Version](https://poser.pugx.org/milito/query-filter/version)](https://packagist.org/packages/milito/query-filter)
[![Total Downloads](https://poser.pugx.org/milito/query-filter/downloads)](https://packagist.org/packages/milito/query-filter)
[![Latest Unstable Version](https://poser.pugx.org/milito/query-filter/v/unstable)](https://packagist.org/packages/milito/query-filter)
[![License](https://poser.pugx.org/milito/query-filter/license)](https://packagist.org/packages/milito/query-filter)
# Laravel Query filter package
A simple package for adding your query filter files to project.

## Introduction
Require the package with composer using the following command:
`composer require milito/query-filter`

## Usage
`php artisan make:query-filter your-query-filter-name`

Example:
```
php artisan make:query-filter ProductsFilter
```
You can add namespace to your file:
```
php artisan make:query-filter Products/ProductsFilter
```

The above will create a Filters directory inside the app directory.

After file generated you should add your functions.\
Example:
```
<?php
namespace App\Filters;

use Milito\QueryFilter;

class ProductsFilter extends QueryFilter
{
   public function name($name = null)
   {
      if (!$name)
        return $this->builder;
      return $this->builder->where('name' , 'LIKE' , $name);
   }
}

```

If your function parameters don't have default values, you need to fill with value every time you want to use it.

Then you need to add `QueryFilterScope` to your model.\
Example :
```
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Milito\QueryFilterScope;

class Product extends Model{
    use QueryFilterScope;
}
```

Now you can use in your controller :
```
<?php
namespace App\Controllers;

use App\Filters\ProductsFilter;
use App\Models\Product;
class ProductsController extends Controller
{
    public function index(ProductsFilter $filter)
    {
       $products = Product::filter($filter)->paginate(20);

       return $products;
    }
}
```
or :
```
<?php
namespace App\Controllers;

use App\Filters\ProductsFilter;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
       $filter = new ProductsFilter($request);

       $products = Product::filter($filter)->paginate(20);

       return $products;
    }
}
```

You can use `request()` function to get request from filter if you need request.\
Example:
```
...

  public function index(ProductsFilter $filter)
  {
     $request = $filter->request();

     $products = Product::filter($filter)->paginate($request->per_page??20);

     return $products;
  }

...

```

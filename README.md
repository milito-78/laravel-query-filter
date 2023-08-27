[![Latest Stable Version](https://poser.pugx.org/milito/query-filter/version)](https://packagist.org/packages/milito/query-filter)
[![Total Downloads](https://poser.pugx.org/milito/query-filter/downloads)](https://packagist.org/packages/milito/query-filter)
[![Latest Unstable Version](https://poser.pugx.org/milito/query-filter/v/unstable)](https://packagist.org/packages/milito/query-filter)
[![License](https://poser.pugx.org/milito/query-filter/license)](https://packagist.org/packages/milito/query-filter)
# Laravel Query filter package
A simple package for adding your query filter files to project.

## Introduction
Install the package with composer using the following command:
```
composer require milito/query-filter
```

## Usage
For create new query filter you can run this command in your terminal:
```
php artisan make:query-filter {your-query-filter-name}
```

Example:
```
php artisan make:query-filter ProductsFilter
```
This command will create a `ProductsFilter.php` file in `app/Filters/` path.

This ProductsFilter class, is extended from `QueryFilter` class, and it used for controller functions.
And because of that, constructor of this class requires a `request` object.

But if you want to create a filter class with a simple `array` input, you need to 
use `-a|--array` option after your class name.
```
php artisan make:query-filter ProductsFilter -a
```
This ProductsFilter class, is extended from `ArrayQueryFilter`.

## Namespace
You can add namespace to your file:
```
php artisan make:query-filter Products/ProductsFilter
```

The above will create a `Products` directory inside the `app/Filters` directory.

## How to use!
After file generated you should add your functions.\
Example:
```php
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

<i><b>HINT</b>: If your function parameters don't have default values, you need to fill with value every time you want to use it.</i>

Then you need to add `QueryFilterScope` to your model.\
Example :
```php
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Milito\QueryFilterScope;

class Product extends Model{
    use QueryFilterScope;
}
```

Now you can use in your controller :
```php
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
```php
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
```php
//...

  public function index(ProductsFilter $filter)
  {
     $request = $filter->request();

     $products = Product::filter($filter)->paginate($request->per_page??20);

     return $products;
  }

//...

```

To use a class that inherits from `ArrayQueryFilter`:
```php
//...

  public function index(Request $request)
  {
     $filter = new ProductsFilter(["name" => $request->query("your_name_field")]);

     $products = Product::filter($filter)->paginate(20);

     return $products;
  }

//...

```

## License

The Milito Query Filter package is open-sourced package licensed under the [MIT license](https://opensource.org/licenses/MIT).

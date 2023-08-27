<?php
namespace Milito\QueryFilter;

use Illuminate\Database\Eloquent\Builder;
use Milito\QueryFilter\Contracts\QueryFilterContract;

trait QueryFilterScope
{
    public function scopeFilter(Builder $query ,QueryFilterContract $filters): Builder
    {
        return $filters->apply($query);
    }
}

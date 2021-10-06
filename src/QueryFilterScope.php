<?php
namespace Milito\QueryFilter;

use Illuminate\Database\Eloquent\Builder;

trait QueryFilterScope
{
    public function scopeFilter(Builder $query ,QueryFilter $filters): Builder
    {
        return $filters->apply($query);
    }
}

<?php
namespace Milito\QueryFilter\Contracts;


use Illuminate\Database\Eloquent\Builder;

interface QueryFilterContract
{
    public function apply(Builder $builder): Builder;

    public function filters();

    public function request();
}

<?php
namespace Milito\QueryFilter\Contracts;


use Illuminate\Database\Eloquent\Builder;

interface QueryFilterContract
{

    /**
     * Apply filter on Builder
     *
     * Applying array filter on your model query filter.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder): Builder;

    /**
     * Return array of filters
     *
     * @return array
     */
    public function filters():array;

}

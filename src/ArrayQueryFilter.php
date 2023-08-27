<?php

namespace Milito\QueryFilter;

abstract class ArrayQueryFilter implements Contracts\QueryFilterContract
{
    use FilterTrait;

    public function __construct(
        protected array $filters
    )
    {
    }

    /**
     * @inheritdoc
     */
    public function filters():array
    {
        return $this->filters;
    }

}

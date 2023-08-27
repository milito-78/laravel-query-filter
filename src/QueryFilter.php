<?php

namespace Milito\QueryFilter;
use Illuminate\Http\Request;
use Milito\QueryFilter\Contracts\QueryFilterContract;

abstract class QueryFilter implements QueryFilterContract
{
    use FilterTrait;

    public function __construct(
        protected Request $request
    )
    {
    }

    /**
     * @inheritdoc
     */
    public function filters(): array
    {
        return $this->request->all();
    }


    /**
     * Get request object
     *
     * @return Request
     */
    public function request(): Request
    {
        return $this->request;
    }

}

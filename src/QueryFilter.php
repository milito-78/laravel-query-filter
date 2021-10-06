<?php

namespace Milito\QueryFilter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Milito\QueryFilter\Contracts\QueryFilterContract;

abstract class QueryFilter implements QueryFilterContract
{
    protected $request;
    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $filter)
        {
            if (method_exists($this, $name))
            {
                $this->callMethod($name,$filter);
            }
        }
        return $this->builder;
    }

    public function filters(): array
    {
        return $this->request->all();
    }

    public function request(): Request
    {
        return $this->request;
    }

    protected function callMethod($name, $filter)
    {
        $temp = array_filter([$filter]);
        if (!is_array($filter) && !is_null($filter))
        {
            $temp = [$filter];
        }
        call_user_func_array([$this, $name], $temp);
    }

}

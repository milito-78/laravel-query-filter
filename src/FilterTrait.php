<?php

namespace Milito\QueryFilter;

use Illuminate\Database\Eloquent\Builder;

trait FilterTrait
{
    protected Builder $builder;

    /**
     * @inheritdoc
     */
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

    /**
     * Call functions for each field
     *
     * @param string $name
     * @param mixed $filter
     * @return void
     */
    protected function callMethod(string $name, mixed $filter): void
    {
        $temp = array_filter([$filter]);
        if (!is_array($filter) && !is_null($filter))
        {
            $temp = [$filter];
        }
        call_user_func_array([$this, $name], $temp);
    }
}

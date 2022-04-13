<?php

namespace App\Filters;

use Pricecurrent\LaravelEloquentFilters\AbstractEloquentFilter;
use Illuminate\Database\Eloquent\Builder;

class PositionFilter extends AbstractEloquentFilter
{
    protected $name;
    protected $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function apply(Builder $query): Builder
    {
        if ($this->type) {
            $query->where('position_type', $this->type);
        }

        return $query;
    }
}

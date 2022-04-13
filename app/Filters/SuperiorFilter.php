<?php

namespace App\Filters;

use Pricecurrent\LaravelEloquentFilters\AbstractEloquentFilter;
use Illuminate\Database\Eloquent\Builder;

class SuperiorFilter extends AbstractEloquentFilter
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function apply(Builder $query): Builder
    {
       return $query->where('superior_id', $this->id);
    }
}

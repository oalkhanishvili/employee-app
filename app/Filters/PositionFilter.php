<?php

namespace App\Filters;

use Pricecurrent\LaravelEloquentFilters\AbstractEloquentFilter;
use Illuminate\Database\Eloquent\Builder;

class PositionFilter extends AbstractEloquentFilter
{
    protected $name;
    protected $id;

    public function __construct($name, $id)
    {
        $this->name = $name;
        $this->id = $id;
    }

    public function apply(Builder $query): Builder
    {
        if ($this->id) {
            return $query->whereHas('position', function ($query) {
                $query->where('id', $this->id);
            });
        }

        if ($this->name) {
            return $query->whereHas('position', function ($query) {
                $query->where('name', 'like', "%{$this->name}%");
            });
        }

        return $query;
    }
}

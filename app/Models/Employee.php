<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Pricecurrent\LaravelEloquentFilters\Filterable;

class Employee extends Model
{
    use Filterable;

    public function superior(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'superior_id');
    }
    public function subordinates(): HasMany
    {
        return $this->hasMany(Employee::class, 'superior_id');
    }
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }
}

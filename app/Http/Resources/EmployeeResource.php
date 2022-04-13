<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'position' => new PositionResource($this->position),
            'startDate' => $this->start_date,
            'endDate' => $this->when($this->end_date, $this->end_date),
        ];
    }
}

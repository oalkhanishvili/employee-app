<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;

class EmployeeService
{
    /**
     * @var Model
     */
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function updateOrCreate($request)
    {

        $this->model->name = $request->name;
        $this->model->superior_id = $request->superior_id;
        $this->model->position_type = $request->position_type;
        $this->model->start_date = $request->start_date;
        $this->model->end_date = $request->end_date;

        if ($this->model->save() === false) {
            abort(401);
        }

        return $this->model;
    }
}

<?php

namespace App\Http\Controllers;

use App\Filters\SuperiorFilter;
use App\Filters\PositionFilter;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;
use Pricecurrent\LaravelEloquentFilters\EloquentFilters;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $filters = EloquentFilters::make([
            new PositionFilter($request->position_name, $request->position_id)
        ]);

        $employees = Employee::filter($filters)->paginate();
        return new EmployeeCollection($employees);
    }
    public function show($id)
    {
        $employee = Employee::find($id);

        // Employee not found
        if (!$employee) {
            abort(404);
        }

        return new EmployeeResource($employee);
    }
    public function create()
    {

    }
    public function update()
    {

    }
    public function delete()
    {

    }
    public function subordinates($id)
    {
        $employee = Employee::find($id);

        // Employee not found
        if (!$employee) {
            abort(404);
        }
        // Check if is manager
        if (!$employee->position->is_manager) {
            abort(403, 'Unauthorized action.');
        }

        $filters = EloquentFilters::make([
            new SuperiorFilter($id)
        ]);

        $employees = Employee::filter($filters)->paginate();
        return new EmployeeCollection($employees);
    }
}

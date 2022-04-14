<?php

namespace App\Http\Controllers;

use App\Enums\EmployeeType;
use App\Filters\SuperiorFilter;
use App\Filters\PositionFilter;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Pricecurrent\LaravelEloquentFilters\EloquentFilters;

class EmployeeController extends Controller
{
    private $validationRules;

    public function __construct()
    {
        $this->middleware('auth:api');

        $this->validationRules = [
            'name'          => 'required',
            'start_date'    => 'required|date_format:Y-m-d H:i',
            'end_date'      => 'date_format:Y-m-d H:i',
            'superior_id'   => 'exists:employees,id',
            'position_type' => Rule::in([EmployeeType::MANAGER, EmployeeType::WORKER]),
        ];
    }

    public function index(Request $request): EmployeeCollection
    {
        $filters = EloquentFilters::make([
            new PositionFilter($request->position_type)
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
    public function create(Request $request): EmployeeResource
    {
        $this->validate($request, $this->validationRules);

        $employee = (new EmployeeService(new Employee()))->updateOrCreate($request);

        return new EmployeeResource($employee);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->validationRules);

        $employee = Employee::find($id);

        // Check for not assign self superior
        if ($employee->id == $request->superior_id) {
            abort(422, 'Unable to assign superior');
        }

        $employee = (new EmployeeService($employee))->updateOrCreate($request);

        return new EmployeeResource($employee);
    }
    public function delete($id): JsonResponse
    {
        Employee::destroy($id);

        return response()->json();
    }
    public function subordinates($id): EmployeeCollection
    {
        $employee = Employee::find($id);

        // Employee not found
        if (!$employee) {
            abort(404);
        }
        // Check if is manager
        if ($employee->position_id != EmployeeType::MANAGER) {
            abort(403);
        }

        $filters = EloquentFilters::make([
            new SuperiorFilter($id)
        ]);

        $employees = Employee::filter($filters)->paginate();
        return new EmployeeCollection($employees);
    }
}

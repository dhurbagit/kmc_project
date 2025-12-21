<?php

namespace App\Domains\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domains\Core\Models\Department;
use App\Domains\Core\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{
     protected string $model = Department::class;
      protected string $viewPath = 'core.department';

   public function index()
    {
        $departments_collection = Department::all();
        return view($this->viewPath . '.index', compact('departments_collection'));
    }    
     
    public function create()
    {
       $departments_collection = Department::all();
        return view($this->viewPath . '.index', compact('departments_collection'));
    }

    public function edit(Department $department)
    {
        $departments_collection = Department::all();
        $editDepartment = Department::find($department->id);
        return view($this->viewPath . '.index', compact('editDepartment', 'departments_collection'));
    }

    public function store(DepartmentRequest $request)
    {
        try {
            $data = $request->all();
            Department::create($data);

            return redirect()
                ->route('indicators.index')
                ->with('message', class_basename($this->model) . ' created successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', class_basename($this->model) . ' already exits.' . $e->getMessage());
        }
    }
}

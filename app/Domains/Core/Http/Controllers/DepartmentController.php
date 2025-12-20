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
        return view($this->viewPath . '.index');
    }    
     
    public function create()
    {
        return view($this->viewPath . '.index');
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

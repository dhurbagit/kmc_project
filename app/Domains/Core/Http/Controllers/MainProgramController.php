<?php

namespace App\Domains\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domains\Core\Models\MainProgram;
use App\Domains\Core\Http\Requests\MainProgramRequest;

class MainProgramController extends Controller
{
    protected string $model = MainProgram::class;
    protected string $viewPath = 'core.main_programs';
    // protected ?string $formRequest = ProgramRequest::class;
    // protected array $with = ['department'];
    // protected ?string $permissionPrefix = 'programs';  // Spatie


    public function index()
    {
        $departments = \App\Domains\Core\Models\Department::all();
        $sectors = \App\Domains\Core\Models\Sector::all();
        $sub_sectors = \App\Domains\Core\Models\SubSector::all();
 
        return view($this->viewPath . '.index', compact('departments', 'sectors', 'sub_sectors'));
        
        
    }

    public function create()
    {
        $departments = \App\Domains\Core\Models\Department::all();
        $sectors = \App\Domains\Core\Models\Sector::all();
        $sub_sectors = \App\Domains\Core\Models\SubSector::all();
 
        return view($this->viewPath . '.index', compact('departments', 'sectors', 'sub_sectors'));
        
    }

    public function store(MainProgramRequest $request)
    {
        try {
            $data = $request->all();
            MainProgram::create($data);

            return redirect()
                ->route('main-programs.index')
                ->with('message', class_basename($this->model) . ' created successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', class_basename($this->model) . ' already exits.' . $e->getMessage());
        }
    }
}

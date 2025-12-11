<?php

namespace App\Domains\Core\Http\Controllers;

 
 
use App\Domains\Core\Models\Program;
use App\Http\Controllers\Controller;
use App\Domains\Core\Models\Department;
use App\Domains\Core\Http\Requests\ProgramRequest;

class DepartmentController extends Controller
{
   
    protected string $model = Department::class;
    protected string $viewPath = 'core.department';
    // protected ?string $formRequest = ProgramRequest::class;
    // protected array $with = ['department'];
    // protected ?string $permissionPrefix = 'programs';  // Spatie

    public function index()
    {
        $programs = Program::with('department')->get();
        return view($this->viewPath . '.index', compact('programs'));
    }

    public function create()
    {
        return view($this->viewPath . '.index');
    }
}

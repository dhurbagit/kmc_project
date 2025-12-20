<?php

namespace App\Domains\Core\Http\Controllers;

use App\Domains\Core\Models\Program;
use App\Http\Controllers\Controller;
use App\Domains\Core\Models\ProgramBudget;
use App\Domains\Core\Http\Requests\ProgramBudgetsRequest;

class ProgramBudgetsController extends Controller
{
    protected string $model = ProgramBudget::class;
    protected string $viewPath = 'core.program_budget';
    // protected ?string $formRequest = ProgramRequest::class;
    // protected array $with = ['department'];
    // protected ?string $permissionPrefix = 'programs';  // Spatie

    public function index()
    {
        
        $programs = Program::all();
        return view($this->viewPath . '.index', compact('programs'));
    
    }

    public function create()
    {
        $programs = Program::all();
        return view($this->viewPath . '.index', compact('programs'));
    }

    public function store(ProgramBudgetsRequest $request)
    {
        try {
            $data = $request->all();
            ProgramBudget::create($data);

            return redirect()
                ->route('program-budgets.index')
                ->with('message', class_basename($this->model) . ' created successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', class_basename($this->model) . ' already exits.' . $e->getMessage());
        }
    }

    
}

<?php

namespace App\Domains\Core\Http\Controllers;

use App\Domains\Core\Http\Requests\EvaluationRequest;
use App\Domains\Core\Models\Evaluation;
use App\Http\Controllers\Controller;

class EvaluationController extends Controller
{
    protected string $model = Evaluation::class;
    protected string $viewPath = 'core.evaluation';
    // protected ?string $formRequest = ProgramRequest::class;
    // protected array $with = ['department'];
    // protected ?string $permissionPrefix = 'programs';  // Spatie

    public function index()
    {
        $programs = \App\Domains\Core\Models\Program::all();
        $indicators = \App\Domains\Core\Models\Indicator::all();
        return view($this->viewPath . '.index', compact('programs', 'indicators'));
       
    }

    public function create()
    {

        $programs = \App\Domains\Core\Models\Program::all();
        $indicators = \App\Domains\Core\Models\Indicator::all();
        return view($this->viewPath . '.index', compact('programs', 'indicators'));
         
    }

    public function store(EvaluationRequest $request)
    {
        try {
            $data = $request->all();
            Evaluation::create($data);

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

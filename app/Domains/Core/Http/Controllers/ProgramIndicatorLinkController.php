<?php

namespace App\Domains\Core\Http\Controllers;

use App\Domains\Core\Models\Program;
use App\Http\Controllers\Controller;
use App\Domains\Core\Models\Indicator;
use App\Domains\Core\Models\ProgramIndicatorLink;
use App\Domains\Core\Http\Requests\ProgramIndicatorLinkRequest;

class ProgramIndicatorLinkController extends Controller
{
    protected string $model = ProgramIndicatorLink::class;
    protected string $viewPath = 'core.program_indicator_link';
    // protected ?string $formRequest = ProgramRequest::class;
    // protected array $with = ['department'];
    // protected ?string $permissionPrefix = 'programs';  // Spatie

    public function index()
    {
        
        $programs = Program::all();
        $indicators = Indicator::all();
        return view($this->viewPath . '.index', compact('programs', 'indicators'));
    
    }

    public function create()
    {
        $programs = Program::all();
        $indicators = Indicator::all();
        return view($this->viewPath . '.index', compact('programs', 'indicators'));
    }

    public function store(ProgramIndicatorLinkRequest $request)
    {
        try {
            $data = $request->all();
            ProgramIndicatorLink::create($data);

            return redirect()
                ->route('program-indicator-links.index')
                ->with('message', class_basename($this->model) . ' created successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', class_basename($this->model) . ' already exits.' . $e->getMessage());
        }
    }

    
}

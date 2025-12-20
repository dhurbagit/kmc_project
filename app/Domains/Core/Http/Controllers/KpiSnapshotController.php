<?php

namespace App\Domains\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domains\Core\Models\KpiSnapshot;
use App\Domains\Core\Http\Requests\KpiSnapshotRequest;
 

class KpiSnapshotController extends Controller
{
    protected string $model = KpiSnapshot::class;
    protected string $viewPath = 'core.kpiSnapshot';
    // protected ?string $formRequest = ProgramRequest::class;
    // protected array $with = ['department'];
    // protected ?string $permissionPrefix = 'programs';  // Spatie

    public function index()
    {
        $departments = \App\Domains\Core\Models\Department::all();
        $programs = \App\Domains\Core\Models\Program::all();
        $indicators = \App\Domains\Core\Models\Indicator::all();

        return view($this->viewPath . '.index', compact('departments', 'programs', 'indicators'));
    }

    public function create()
    {
        $departments = \App\Domains\Core\Models\Department::all();
        $programs = \App\Domains\Core\Models\Program::all();
        $indicators = \App\Domains\Core\Models\Indicator::all();

        return view($this->viewPath . '.index', compact('departments', 'programs', 'indicators'));
    }

    public function store(KpiSnapshotRequest $request)
    {
        try {
            
            $data = $request->all();
           
            KpiSnapshot::create($data);

            return redirect()
                ->route('kpi-snapshots.index')
                ->with('message', class_basename($this->model) . ' created successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', class_basename($this->model) . ' already exits.' . $e->getMessage());
        }
    }

  
}

<?php

namespace App\Domains\Core\Http\Controllers;

use App\Domains\Core\Http\Requests\ProgramRequest;
use App\Domains\Core\Models\MainProgram;
use App\Domains\Core\Models\Program;
use App\Http\Controllers\Controller;

class ProgramController extends Controller
{
    protected string $model = Program::class;
    protected string $viewPath = 'core.program';
    // protected ?string $formRequest = ProgramRequest::class;
    // protected array $with = ['department'];
    // protected ?string $permissionPrefix = 'programs';  // Spatie

    public function index()
    {
        // $programs = Program::with('department')->get();

          $departments = \App\Domains\Core\Models\Department::all();
        $sectors = \App\Domains\Core\Models\Sector::all();
        $sub_sectors = \App\Domains\Core\Models\SubSector::all();
        $main_programs = \App\Domains\Core\Models\MainProgram::all();
        return view($this->viewPath . '.index', compact('departments', 'sectors', 'sub_sectors', 'main_programs'));
    
    }

    public function create()
    {
        $departments = \App\Domains\Core\Models\Department::all();
        $sectors = \App\Domains\Core\Models\Sector::all();
        $sub_sectors = \App\Domains\Core\Models\SubSector::all();
        $main_programs = \App\Domains\Core\Models\MainProgram::all();
        return view($this->viewPath . '.index', compact('departments', 'sectors', 'sub_sectors', 'main_programs'));
    }

    public function store(ProgramRequest $request)
    {
        try {
            $data = $request->all();
            if (empty($data['code'])) {
                $data['code'] = $this->generateSubSectorCode($request->main_program_id);
            }
            Program::create($data);

            return redirect()
                ->route('programs.index')
                ->with('message', class_basename($this->model) . ' created successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', class_basename($this->model) . ' already exits.' . $e->getMessage());
        }
    }

    protected function generateSubSectorCode($sectorId)
    {
        $count = MainProgram::where('sub_sector_id', $sectorId)->count() + 1;

        return 'MAIN-' . $sectorId . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
    }
}

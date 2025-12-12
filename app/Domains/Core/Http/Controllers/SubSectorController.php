<?php

namespace App\Domains\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domains\Core\Models\SubSector;
use App\Domains\Core\Http\Requests\SubSectorRequest;
use App\Domains\Core\Models\Sector;

class SubSectorController extends Controller
{
   
    protected string $model = SubSector::class;
    protected string $viewPath = 'core.sub_sector';
    // protected ?string $formRequest = ProgramRequest::class;
    // protected array $with = ['department'];
    // protected ?string $permissionPrefix = 'programs';  // Spatie

    public function index()
    {
        // $programs = Program::with('department')->get();

        $sectors = Sector::all();
        return view($this->viewPath . '.index', compact('sectors'));
      
    }

    public function create()
    {
           $sectors = Sector::all();
        return view($this->viewPath . '.index', compact('sectors'));
    }

    public function store(SubSectorRequest $request)
    {
        try {
            $data = $request->all();
            SubSector::create($data);

            return redirect()
                ->route('sub-sectors.index')
                ->with('message', class_basename($this->model) . ' created successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', class_basename($this->model) . ' already exits.' . $e->getMessage());
        }
    }
}

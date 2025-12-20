<?php

namespace App\Domains\Core\Http\Controllers;

use App\Domains\Core\Models\Sector;
use App\Domains\Core\Models\Program;   // <- ADD THIS
use App\Http\Controllers\Controller;
use App\Domains\Core\Http\Requests\SectorRequest;

class SectorController extends Controller
{
   
    protected string $model = Sector::class;
    protected string $viewPath = 'core.sector';
    // protected ?string $formRequest = ProgramRequest::class;
    // protected array $with = ['department'];
    // protected ?string $permissionPrefix = 'programs';  // Spatie

    public function index()
    {
        $sectors= Sector::get();
        // $programs = Program::with('department')->get();
        // $programs = Program::get();
        return view($this->viewPath . '.index', compact(  'sectors'));

 
        // return view($this->viewPath . '.index');
    }

    public function create()
    {   
        $programs = Program::get();
        $sectors = Sector::get();
        return view($this->viewPath . '.index', compact('sectors', 'programs'));
    
        // return view($this->viewPath . '.index');
    }

    public function store(SectorRequest $request)
    {

       
        try {
            $data = $request->all();
            Sector::create($data);

            return redirect()
                ->route('sectors.index')
                ->with('message', class_basename($this->model) . ' created successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', class_basename($this->model) . ' already exits.' . $e->getMessage());
        }
    }
}

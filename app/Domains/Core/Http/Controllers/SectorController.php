<?php

namespace App\Domains\Core\Http\Controllers;

 
 
use App\Domains\Core\Models\Sector;        4
use App\Http\Controllers\Controller;
 
use App\Domains\Core\Models\Department;
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
        // $programs = Program::with('department')->get();

 
        return view($this->viewPath . '.index');
    }

    public function create()
    {
        return view($this->viewPath . '.index');
    }

    public function store(SectorRequest $request)
    {

        dd($request->all());
        try {
            $data = $request->all();
            Department::create($data);

            return redirect()
                ->route('departments.index')
                ->with('message', class_basename($this->model) . ' created successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', class_basename($this->model) . ' already exits.' . $e->getMessage());
        }
    }
}

<?php

namespace App\Domains\Core\Http\Controllers;

 
use App\Http\Controllers\Controller;
use App\Domains\Core\Models\Indicator;
use App\Domains\Core\Http\Requests\IndicatorRequest;
 

class IndicatorController extends Controller
{
    protected string $model = Indicator::class;
    protected string $viewPath = 'core.indicator';
    // protected ?string $formRequest = ProgramRequest::class;
    // protected array $with = ['department'];
    // protected ?string $permissionPrefix = 'programs';  // Spatie

    public function index()
    {
        
       return view($this->viewPath . '.index');
    
    }

    public function create()
    {
          return view($this->viewPath . '.index');
    }

    public function store(IndicatorRequest $request)
    {
        try {
            $data = $request->all();
            Indicator::create($data);

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

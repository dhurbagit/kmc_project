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

    public function index()
    {
        $subSectors = SubSector::get();
        $sectors = Sector::all(); // for dropdown
        $subSectors = SubSector::with('sector')->get(); // for table

        return view($this->viewPath . '.index', compact('sectors', 'subSectors' , 'subSectors'));
    }

     public function create()
    {
           $subSectors = SubSector::get();
        $sectors = Sector::all(); // for dropdown
        $subSectors = SubSector::with('sector')->get(); // for table

        return view($this->viewPath . '.index', compact('sectors', 'subSectors' , 'subSectors'));
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
                ->with('error', class_basename($this->model) . ' already exists. ' . $e->getMessage());
        }
    }
}
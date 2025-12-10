<?php

namespace App\Domains\Core\Http\Controllers;

 
use App\Domains\Core\Models\Program;
use App\Http\Controllers\BaseCrudController;
use App\Domains\Core\Http\Requests\ProgramRequest;

class ProgramController extends BaseCrudController
{
   

    protected string $model = Program::class;
    protected string $viewPath = 'admin.programs';
    // protected ?string $formRequest = ProgramRequest::class;
    protected array $with = ['department'];
    protected ?string $permissionPrefix = 'programs';  // Spatie
}

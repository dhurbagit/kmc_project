<?php

namespace App\Domains\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domains\Core\Models\MainProgram;
use App\Domains\Core\Http\Requests\ProgramRequest;

class MainProgramController extends Controller
{
    protected string $model = MainProgram::class;
    protected string $viewPath = 'core.main_programs';
    // protected ?string $formRequest = ProgramRequest::class;
    // protected array $with = ['department'];
    // protected ?string $permissionPrefix = 'programs';  // Spatie
}

<?php

namespace App\Domains\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domains\Core\Models\Department;
use App\Domains\Core\Models\Program;
 

class DashboardController extends Controller
{
    public function index()
    {
        // Example: average program progress per department
        $departmentKpis = Department::with('programs')
            ->get()
            ->map(function (Department $dept) {
                $avgProgress = $dept->programs()->avg('progress_percent') ?? 0;
                return [
                    'name'    => $dept->name_en,
                    'progress'=> round($avgProgress, 1),
                ];
            });

        // Example: number of programs contributing directly to SDG 11
        $sdg11Count = Program::whereHas('indicators', function ($q) {
                $q->where('source_type', 'SDG')
                  ->where('goal_code', '11');
            })->count();

        return view('core.dashboard', [
            'departmentKpis' => $departmentKpis,
            'sdg11Count'     => $sdg11Count,
        ]);
    }
}

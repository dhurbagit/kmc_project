<?php

namespace App\Domains\Core\Http\Controllers;

use App\Domains\Core\Models\Department;
use App\Domains\Core\Models\Program;
use App\Domains\Core\Models\ProgramBudget;
use App\Domains\Core\Models\Sector;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::orderBy('name_ne')->get(['id', 'name_ne', 'code']);

        $fiscalCode = $request->string('fiscal_code');

        $departmentId = $request->integer('department_id') ?: null;

        // 1) Dropdown data

        $fiscalCodes = ProgramBudget::query()
            ->whereNotNull('fiscal_code')
            ->distinct()
            ->orderBy('fiscal_code', 'desc')
            ->pluck('fiscal_code');

        // Department-wise summary (program count + budget sums)
        $departmentSummary = DB::table('programs')
            // parents
            ->join('departments', 'departments.id', '=', 'programs.department_id')
            ->leftJoin('sectors', 'sectors.id', '=', 'programs.sector_id')
            ->leftJoin('sub_sectors', 'sub_sectors.id', '=', 'programs.sub_sector_id')
            ->leftJoin('main_programs', 'main_programs.id', '=', 'programs.main_program_id')
            // budgets (only selected fiscal code)
            ->leftJoin('program_budgets', function ($join) use ($fiscalCode) {
                $join
                    ->on('program_budgets.program_id', '=', 'programs.id')
                    ->where('program_budgets.fiscal_code', '=', $fiscalCode);
            })
            ->select([
                'departments.id as department_id',
                'departments.name_ne as department_name',
                'sectors.id as sector_id',
                'sectors.name_ne as sector_name',
                'sub_sectors.id as sub_sector_id',
                'sub_sectors.name_ne as sub_sector_name',
                'main_programs.id as main_program_id',
                'main_programs.name_ne as main_program_name',
                'programs.id as program_id',
                'programs.code as program_code',
                'programs.name_ne as program_name',
                DB::raw('COALESCE(SUM(program_budgets.allocated_budget),0) as allocated'),
                DB::raw('COALESCE(SUM(program_budgets.revised_budget),0) as revised'),
                DB::raw('COALESCE(SUM(program_budgets.expenditure),0) as expenditure'),
            ])
            // IMPORTANT: group by all non-aggregate columns
            ->groupBy(
                'departments.id', 'departments.name_ne',
                'sectors.id', 'sectors.name_ne',
                'sub_sectors.id', 'sub_sectors.name_ne',
                'main_programs.id', 'main_programs.name_ne',
                'programs.id', 'programs.code', 'programs.name_ne'
            )
            // optional: ordering
            ->orderBy('departments.name_ne')
            ->orderBy('sectors.name_ne')
            ->orderBy('sub_sectors.name_ne')
            ->orderBy('main_programs.name_ne')
            ->orderByDesc('allocated')
            ->get();

        // 2) Base query (ProgramBudget is the truth for money)
        $budgetBase = ProgramBudget::query()
            ->where('fiscal_code', $fiscalCode)
            ->when($departmentId, function ($q) use ($departmentId) {
                $q->whereHas('program', fn($p) => $p->where('department_id', $departmentId));
            });

        // 3) KPIs
        $kpi = (clone $budgetBase)
            ->selectRaw('
                COALESCE(SUM(allocated_budget),0) as allocated,
                COALESCE(SUM(revised_budget),0) as revised,
                COALESCE(SUM(expenditure),0) as expenditure
            ')
            ->first();

        $totalDepartments = Department::count();

        $totalPrograms = Program::query()
            ->when($departmentId, fn($q) => $q->where('department_id', $departmentId))
            ->count();

        // ========== ) When department is selected: Sector summary ==========
        $departments = Department::orderBy('name_ne')->get(['id', 'name_en', 'name_ne', 'code']);
        $departmentId = $request->input('department_id');  // "" means All
        $fiscalCode = $request->input('fiscal_code', '2082/83');

        $isAllDepartments = !$request->filled('department_id');

        // ✅ Build many pies only when "All Departments"
        $deptSectorPies = [];

        if ($isAllDepartments) {
            // One query: group by department + sector
            $rows = DB::table('departments')
                ->leftJoin('programs', 'programs.department_id', '=', 'departments.id')
                ->leftJoin('sectors', 'sectors.id', '=', 'programs.sector_id')
                ->leftJoin('program_budgets', function ($join) use ($fiscalCode) {
                    $join
                        ->on('program_budgets.program_id', '=', 'programs.id')
                        ->where('program_budgets.fiscal_code', '=', $fiscalCode);
                })
                ->select([
                    'departments.id as department_id',
                    'departments.name_en as dept_name_en',
                    'departments.name_ne as dept_name_ne',
                    'sectors.id as sector_id',
                    'sectors.name_en as sector_name_en',
                    'sectors.name_ne as sector_name_ne',
                    DB::raw('COALESCE(SUM(program_budgets.allocated_budget),0) as allocated'),
                    DB::raw('COALESCE(SUM(program_budgets.expenditure),0) as used'),
                ])
                ->groupBy(
                    'departments.id', 'departments.name_en', 'departments.name_ne',
                    'sectors.id', 'sectors.name_en', 'sectors.name_ne'
                )
                ->orderBy('departments.id')
                ->get();

            // Group into pies: department_id => sectors
            $grouped = collect($rows)->groupBy('department_id');

            foreach ($grouped as $deptId => $deptRows) {
                // remove null sector rows + remove all-zero rows
                $deptRows = $deptRows
                    ->filter(fn($r) => !is_null($r->sector_id))
                    ->map(function ($r) {
                        $r->allocated = (float) $r->allocated;
                        $r->used = (float) $r->used;
                        return $r;
                    })
                    ->filter(fn($r) => $r->allocated > 0 || $r->used > 0)
                    ->values();

                // if no data, skip this department pie
                if ($deptRows->isEmpty())
                    continue;

                $deptName = $deptRows[0]->dept_name_ne ?: $deptRows[0]->dept_name_en;

                $deptSectorPies[] = [
                    'department_id' => (int) $deptId,
                    'department_name' => $deptName,
                    'labels' => $deptRows->map(fn($r) => $r->sector_name_ne ?: $r->sector_name_en)->values()->all(),
                    'used' => $deptRows->pluck('used')->values()->all(),
                    'alloc' => $deptRows->pluck('allocated')->values()->all(),
                ];
            }
        }
        // ***************************************************************************************************************************
        // 1) Dropdown list
        $departments = Department::orderBy('name_ne')->get(['id', 'name_en', 'name_ne', 'code']);

        // 2) Inputs
        $departmentId = $request->input('department_id');  // "" means All
       

        $isAllDepartments = !$request->filled('department_id');  // true for "" or null
        $selectedDepartment = null;

        // 3) Outputs (defaults)
        $deptSectorPies = [];  // for ALL departments mode (many pies)

        $sectorSummary = collect();  // for SINGLE department mode (one pie)
        $sectorPieLabels = [];
        $sectorPieUsed = [];
        $sectorAllocated = [];
        $deptAllocatedTotal = 0;
        $deptUsedTotal = 0;

        // =========================
        // A) ALL DEPARTMENTS => MANY PIES (dept-wise)
        // =========================
        if ($isAllDepartments) {
            $rows = DB::table('departments')
                ->leftJoin('programs', 'programs.department_id', '=', 'departments.id')
                ->leftJoin('sectors', 'sectors.id', '=', 'programs.sector_id')
                ->leftJoin('program_budgets', function ($join) use ($fiscalCode) {
                    $join
                        ->on('program_budgets.program_id', '=', 'programs.id')
                        ->where('program_budgets.fiscal_code', '=', $fiscalCode);
                })
                ->select([
                    'departments.id as department_id',
                    'departments.name_en as dept_name_en',
                    'departments.name_ne as dept_name_ne',
                    'sectors.id as sector_id',
                    'sectors.name_en as sector_name_en',
                    'sectors.name_ne as sector_name_ne',
                    DB::raw('COALESCE(SUM(program_budgets.allocated_budget),0) as allocated'),
                    DB::raw('COALESCE(SUM(program_budgets.expenditure),0) as used'),
                ])
                ->groupBy(
                    'departments.id', 'departments.name_en', 'departments.name_ne',
                    'sectors.id', 'sectors.name_en', 'sectors.name_ne'
                )
                ->orderBy('departments.id')
                ->get();

            $grouped = collect($rows)->groupBy('department_id');

            foreach ($grouped as $deptId => $deptRows) {
                $deptRows = $deptRows
                    ->filter(fn($r) => !is_null($r->sector_id))  // remove null sector
                    ->map(function ($r) {
                        $r->allocated = (float) $r->allocated;
                        $r->used = (float) $r->used;
                        return $r;
                    })
                    ->filter(fn($r) => $r->allocated > 0 || $r->used > 0)
                    ->values();

                if ($deptRows->isEmpty())
                    continue;

                $deptName = $deptRows[0]->dept_name_ne ?: $deptRows[0]->dept_name_en;

                $deptSectorPies[] = [
                    'department_id' => (int) $deptId,
                    'department_name' => $deptName,
                    'sector_ids' => $deptRows->pluck('sector_id')->values()->all(),
                    'labels' => $deptRows->map(fn($r) => $r->sector_name_ne ?: $r->sector_name_en)->values()->all(),
                    'used' => $deptRows->pluck('used')->values()->all(),
                    'alloc' => $deptRows->pluck('allocated')->values()->all(),
                ];
            }
        }
        // =========================
        // B) SINGLE DEPARTMENT => ONE PIE (your existing sectorSummary)
        // =========================
        else {
            $selectedDepartment = Department::find($departmentId);

            $sectorSummary = DB::table('sectors')
                ->leftJoin('programs', function ($join) use ($departmentId) {
                    $join
                        ->on('programs.sector_id', '=', 'sectors.id')
                        ->where('programs.department_id', '=', $departmentId);
                })
                ->leftJoin('program_budgets', function ($join) use ($fiscalCode) {
                    $join
                        ->on('program_budgets.program_id', '=', 'programs.id')
                        ->where('program_budgets.fiscal_code', '=', $fiscalCode);
                })
                ->select([
                    'sectors.id',
                    'sectors.name_en',
                    'sectors.name_ne',
                    DB::raw('COUNT(DISTINCT programs.id) as programs_count'),
                    DB::raw('COALESCE(SUM(program_budgets.allocated_budget),0) as allocated'),
                    DB::raw('COALESCE(SUM(program_budgets.expenditure),0) as used'),
                ])
                ->groupBy('sectors.id', 'sectors.name_en', 'sectors.name_ne')
                ->orderByDesc('allocated')
                ->get();

            $sectorSummary = collect($sectorSummary)
                ->map(function ($r) {
                    $r->allocated = (float) $r->allocated;
                    $r->used = (float) $r->used;
                    return $r;
                })
                ->filter(fn($r) => $r->allocated > 0 || $r->used > 0)
                ->values();

            $deptAllocatedTotal = $sectorSummary->sum('allocated');
            $deptUsedTotal = $sectorSummary->sum('used');

            $sectorPieLabels = $sectorSummary->map(fn($r) => $r->name_ne ?: $r->name_en)->values()->all();
            $sectorPieUsed = $sectorSummary->pluck('used')->values()->all();
            $sectorAllocated = $sectorSummary->pluck('allocated')->values()->all();
        }
        // ***************************************************************************************************************************
        $sectorId = $request->input('sector_id');  // NEW

        $mainProgramRows = collect();
        $programRows = collect();

        if ($departmentId && $sectorId) {
            // A) Main Program summary (for clicked sector)
            $mainProgramRows = DB::table('main_programs')
                ->leftJoin('programs', function ($join) use ($departmentId, $sectorId) {
                    $join
                        ->on('programs.main_program_id', '=', 'main_programs.id')
                        ->where('programs.department_id', '=', $departmentId)
                        ->where('programs.sector_id', '=', $sectorId);
                })
                ->leftJoin('sectors', 'sectors.id', '=', 'programs.sector_id')
                ->leftJoin('program_budgets', function ($join) use ($fiscalCode) {
                    $join
                        ->on('program_budgets.program_id', '=', 'programs.id')
                        ->where('program_budgets.fiscal_code', '=', $fiscalCode);
                })
                ->select([
                    'sectors.id as sector_id',  // ✅ add these 3
                    'sectors.name_en as sector_name_en',
                    'sectors.name_ne as sector_name_ne',
                    'main_programs.id',
                    'main_programs.name_en',
                    'main_programs.name_ne',
                    DB::raw('COUNT(DISTINCT programs.id) as programs_count'),
                    DB::raw('COALESCE(SUM(program_budgets.allocated_budget),0) as allocated'),
                    DB::raw('COALESCE(SUM(program_budgets.expenditure),0) as used'),
                    DB::raw('COALESCE(SUM(program_budgets.allocated_budget),0) - COALESCE(SUM(program_budgets.expenditure),0) as gap_amount'),
                ])
                ->groupBy(
                    'sectors.id', 'sectors.name_en', 'sectors.name_ne',  // ✅ add these
                    'main_programs.id', 'main_programs.name_en', 'main_programs.name_ne'
                )
                ->orderByDesc('allocated')
                ->get();

            // B) Program list under those main programs (detailed table)
            $programRows = DB::table('programs')
                ->leftJoin('main_programs', 'main_programs.id', '=', 'programs.main_program_id')
                ->leftJoin('program_budgets', function ($join) use ($fiscalCode) {
                    $join
                        ->on('program_budgets.program_id', '=', 'programs.id')
                        ->where('program_budgets.fiscal_code', '=', $fiscalCode);
                })
                ->where('programs.department_id', $departmentId)
                ->where('programs.sector_id', $sectorId)
                ->select([
                    'main_programs.name_ne as main_program_name_ne',
                    'main_programs.name_en as main_program_name_en',
                    'programs.id',
                    'programs.code',
                    'programs.name_ne',
                    'programs.name_en',
                    DB::raw('COALESCE(SUM(program_budgets.allocated_budget),0) as allocated'),
                    DB::raw('COALESCE(SUM(program_budgets.expenditure),0) as used'),
                    DB::raw('COALESCE(SUM(program_budgets.allocated_budget),0) - COALESCE(SUM(program_budgets.expenditure),0) as gap_amount'),
                ])
                ->groupBy(
                    'main_programs.name_ne', 'main_programs.name_en',
                    'programs.id', 'programs.code', 'programs.name_ne', 'programs.name_en'
                )
                ->orderByDesc('allocated')
                ->get();
        }
        $selectedSector = null;
        if ($sectorId) {
            $selectedSector = Sector::select('id', 'name_en', 'name_ne')->find($sectorId);
        }

        // 5) Programs table (with relations + budget for selected fiscal_code)
        $programs = Program::query()
            ->with(['department:id,name_ne', 'sector:id,name_ne', 'subSector:id,name_ne', 'mainProgram:id,name_ne'])
            ->when($departmentId, fn($q) => $q->where('department_id', $departmentId))
            ->whereHas('budgets', fn($b) => $b->where('fiscal_code', $fiscalCode))
            ->withSum(['budgets as allocated_sum' => fn($b) => $b->where('fiscal_code', $fiscalCode)], 'allocated_budget')
            ->withSum(['budgets as revised_sum' => fn($b) => $b->where('fiscal_code', $fiscalCode)], 'revised_budget')
            ->withSum(['budgets as exp_sum' => fn($b) => $b->where('fiscal_code', $fiscalCode)], 'expenditure')
            ->orderByDesc('allocated_sum')
            ->paginate(25)
            ->withQueryString();

        return view('core.dashboard', compact(
            'fiscalCode',
            'departmentId',
            'isAllDepartments',
            'departments',
            'fiscalCodes',
            'kpi',
            'totalDepartments',
            'totalPrograms',
            'sectorSummary',
            'sectorPieUsed',
            'departmentSummary',
            'programs',
            'selectedDepartment',
            'sectorPieLabels',
            'sectorAllocated',
            'deptAllocatedTotal',
            'deptUsedTotal',
            'sectorId',
            'mainProgramRows',
            'selectedSector',
            'programRows',
            'deptSectorPies'
        ));
    }
}

// budgetGapIndex

// 4) One real example (how it calculates)

// If:

// allocated_budget = 5000000.00

// revised_budget = 5500000.00

// expenditure = 4725000.00

// Then:

// effective_budget = 5500000.00

// budget_gap = 5500000 - 4725000 = 775000.00

// utilization = 4725000 / 5500000 * 100 = 85.91%

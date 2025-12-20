<?php

namespace App\Domains\Core\Models;

use App\Domains\Core\Models\Sector;

use App\Domains\Core\Models\Indicator;
use App\Domains\Core\Models\SubSector;
use App\Domains\Core\Models\Department;
use App\Domains\Core\Models\Evaluation;
use Illuminate\Database\Eloquent\Model;
use App\Domains\Core\Models\KpiSnapshot;
use App\Domains\Core\Models\MainProgram;
use App\Domains\Core\Models\ProgramBudget;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Domains\Core\Models\ProgramIndicatorLink;

class Program extends Model
{
    // use SoftDeletes;

    protected $fillable = [
        'department_id','sector_id','sub_sector_id','main_program_id',
        'code','kharcha_sanket',
        'name_en','name_ne','objective',
        'fiscal_year','lifecycle_status','progress_percent',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function subSector()
    {
        return $this->belongsTo(SubSector::class);
    }

    public function mainProgram()
    {
        return $this->belongsTo(MainProgram::class);
    }

    public function indicatorLinks()
    {
        return $this->hasMany(ProgramIndicatorLink::class);
    }

    public function indicators()
    {
        return $this->belongsToMany(Indicator::class, 'program_indicator_links')
                    ->withPivot(['link_type','extent_score','evidence_level','weight'])
                    ->withTimestamps();
    }

    public function budgets()
    {
        return $this->hasMany(ProgramBudget::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function kpiSnapshots()
    {
        return $this->hasMany(KpiSnapshot::class);
    }
}

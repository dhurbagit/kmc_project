<?php

namespace App\Domains\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'department_id','code','name_en','name_ne',
        'objective','fiscal_year',
        'lifecycle_status','progress_percent',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
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

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}

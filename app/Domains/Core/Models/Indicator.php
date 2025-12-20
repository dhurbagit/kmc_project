<?php

namespace App\Domains\Core\Models;

use App\Domains\Core\Models\Program;
use App\Domains\Core\Models\Evaluation;
use Illuminate\Database\Eloquent\Model;
use App\Domains\Core\Models\ProgramIndicatorLink;

class Indicator extends Model
{
    protected $fillable = [
        'source_type','code','short_name','description',
        'goal_code','target_code','unit','higher_is_better',
    ];

    public function programLinks()
    {
        return $this->hasMany(ProgramIndicatorLink::class);
    }

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'program_indicator_links')
                    ->withPivot(['link_type','extent_score','evidence_level','weight'])
                    ->withTimestamps();
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}

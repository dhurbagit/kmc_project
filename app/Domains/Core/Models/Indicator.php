<?php

namespace App\Domains\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    protected $fillable = [
        'source_type','code','short_name','description',
        'goal_code','target_code','unit','higher_is_better',
    ];

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'program_indicator_links')
                    ->withPivot(['link_type','extent_score','evidence_level','weight'])
                    ->withTimestamps();
    }
}

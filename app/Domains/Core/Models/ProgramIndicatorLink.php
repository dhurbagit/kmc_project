<?php

namespace App\Domains\Core\Models;

use App\Domains\Core\Models\Program;
use App\Domains\Core\Models\Indicator;
use Illuminate\Database\Eloquent\Model;

 class ProgramIndicatorLink extends Model
{
    protected $fillable = [
        'program_id','indicator_id',
        'link_type','extent_score','evidence_level','weight',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function indicator()
    {
        return $this->belongsTo(Indicator::class);
    }
}


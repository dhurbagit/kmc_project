<?php

namespace App\Domains\Core\Models;

use App\Domains\Core\Models\Program;
use App\Domains\Core\Models\Indicator;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [
        'program_id','indicator_id',
        'period','year','value','progress_percent','notes',
    ];

    protected $casts = [
        'year' => 'integer',
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

<?php

namespace App\Domains\Core\Models;

use App\Domains\Core\Models\Program;
use App\Domains\Core\Models\Indicator;
use App\Domains\Core\Models\Department;
use Illuminate\Database\Eloquent\Model;

class KpiSnapshot extends Model
{
    protected $fillable = [
        'department_id','program_id','indicator_id',
        'snapshot_date','value','progress_percent',
    ];

    protected $casts = [
        'snapshot_date' => 'date',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function indicator()
    {
        return $this->belongsTo(Indicator::class);
    }
}

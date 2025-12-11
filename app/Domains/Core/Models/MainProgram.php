<?php

namespace App\Domains\Core\Models;

use App\Domains\Core\Models\Sector;
use App\Domains\Core\Models\Program;
use App\Domains\Core\Models\SubSector;
use App\Domains\Core\Models\Department;
use Illuminate\Database\Eloquent\Model;


class MainProgram extends Model
{
    protected $fillable = [
        'sector_id','sub_sector_id','department_id',
        'code','name_en','name_ne','objective',
    ];

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function subSector()
    {
        return $this->belongsTo(SubSector::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}

<?php

namespace App\Domains\Core\Models;

use App\Domains\Core\Models\Program;
use App\Domains\Core\Models\SubSector;
use Illuminate\Database\Eloquent\Model;
use App\Domains\Core\Models\MainProgram;


class Sector extends Model
{
    protected $fillable = ['code','name_en','name_ne','description'];

    public function subSectors()
    {
        return $this->hasMany(SubSector::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    public function mainPrograms()
    {
        return $this->hasMany(MainProgram::class);
    }
}

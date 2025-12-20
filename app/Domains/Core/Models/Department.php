<?php

namespace App\Domains\Core\Models;

use App\Domains\Core\Models\Program;
use Illuminate\Database\Eloquent\Model;
use App\Domains\Core\Models\MainProgram;

class Department extends Model
{
    protected $fillable = ['code','name_en','name_ne','description'];

    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    public function mainPrograms()
    {
        return $this->hasMany(MainProgram::class);
    }
}


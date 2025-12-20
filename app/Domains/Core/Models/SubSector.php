<?php


namespace App\Domains\Core\Models;

use App\Domains\Core\Models\Sector;
use App\Domains\Core\Models\Program;
use Illuminate\Database\Eloquent\Model;
use App\Domains\Core\Models\MainProgram;

class SubSector extends Model
{
    protected $fillable = ['sector_id','code','name_en','name_ne','description'];

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function mainPrograms()
    {
        return $this->hasMany(MainProgram::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}


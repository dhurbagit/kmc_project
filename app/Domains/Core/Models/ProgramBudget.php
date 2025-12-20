<?php
namespace App\Domains\Core\Models;

use App\Domains\Core\Models\Program;
use Illuminate\Database\Eloquent\Model;


class ProgramBudget extends Model
{
    protected $fillable = [
        'program_id','fiscal_year', 'fiscal_code',
        'allocated_budget','expenditure',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

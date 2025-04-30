<?php

namespace App\Models;

use App\Models\Admin\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    use HasFactory;

    protected $table = 'hr_bonuses';
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class,'emp_id','id');
    }
}

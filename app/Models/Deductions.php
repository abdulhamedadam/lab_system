<?php

namespace App\Models;

use App\Models\Admin\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deductions extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='hr_deductions';


    public function employee()
    {
        return $this->belongsTo(Employee::class,'emp_id','id');
    }
}

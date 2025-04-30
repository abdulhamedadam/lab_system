<?php

namespace App\Models;

use App\Models\Admin\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollDetails extends Model
{
    use HasFactory;
    protected $table='hr_payroll_details';
    protected $guarded=[];


    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
}

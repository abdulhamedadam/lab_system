<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $table='hr_payroll';
    protected $guarded=[];



    public function payroll_details()
    {
        return $this->hasMany(PayrollDetails::class,'salary_report_id','id');
    }
}

<?php

namespace App\Models;

use App\Models\Admin\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
    use HasFactory;
    protected $table='hr_loans';
    protected $guarded=[];


    public function employee()
    {
        return $this->belongsTo(Employee::class,'emp_id','id');
    }

    /*******************************************/
    public function loan_installment()
    {
        return $this->hasMany(LaonsInstallments::class,'loan_id','id');
    }

}

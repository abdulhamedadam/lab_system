<?php

namespace App\Models\Admin;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    protected $fillable = [
        'employee_id',
        'basic_salary',
        'housing_allowance',
        'transportation_allowance',
        'other_allowances',
        'total_salary',
        'effective_date',
        'created_by',
        'notes'
    ];

    protected $casts = [
        'effective_date' => 'date'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
}

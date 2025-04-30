<?php

namespace App\Models\Admin;


use App\Models\Bonus;
use App\Models\Deductions;

use App\Models\Loans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'tbl_employees';

    protected $guarded = [];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function area()
    {
        return $this->belongsTo(AreaSetting::class, 'area_id');
    }

    public function governate()
    {
        return $this->belongsTo(AreaSetting::class, 'governate_id');
    }
    /********************************************************/
    public function all_loan()
    {
        return $this->hasMany(Loans::class, 'emp_id');
    }
    /********************************************************/
    public function all_deductions()
    {
        return $this->hasMany(Deductions::class, 'emp_id');
    }
    /********************************************************/
    public function all_bonus()
    {
        return $this->hasMany(Bonus::class, 'emp_id');
    }
    /********************************************************/
    public function employee_salary()
    {
        return $this->hasOne(EmployeeSalary::class,'employee_id','id');
    }

    public function data_to_insert($request)
{
    $insert_data['emp_code'] = $request->emp_code;
    $insert_data['first_name'] = $request->first_name;
    $insert_data['last_name'] = $request->last_name;
    $insert_data['email'] = $request->email;
    $insert_data['national_id'] = $request->national_id;
    $insert_data['religion'] = $request->religion;
    $insert_data['phone'] = $request->phone;
    $insert_data['whatsapp_num'] = $request->whatsapp_num;
    $insert_data['address'] = $request->address;
    $insert_data['date_of_birth'] = $request->date_of_birth;
    $insert_data['governate_id'] = $request->governate_id;
    $insert_data['area_id'] = $request->area_id;
    $insert_data['gender'] = $request->gender;
    $insert_data['material_status'] = $request->material_status;
    $insert_data['position'] = $request->position;
    $insert_data['salary'] = $request->salary;
    $insert_data['branch_id'] = $request->branch_id;

    return $insert_data;
}
}

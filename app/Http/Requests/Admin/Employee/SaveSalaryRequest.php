<?php

namespace App\Http\Requests\Admin\Employee;

use Illuminate\Foundation\Http\FormRequest;

class SaveSalaryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'basic_salary' => 'required|numeric|min:0',
            'housing_allowance' => 'nullable|numeric|min:0',
            'transportation_allowance' => 'nullable|numeric|min:0',
            'other_allowances' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'basic_salary.required' => trans('employee.basic_salary_required'),
            'basic_salary.numeric' => trans('employee.basic_salary_numeric'),
            'basic_salary.min' => trans('employee.basic_salary_min'),
            'effective_date.required' => trans('employee.effective_date_required'),
            'effective_date.date' => trans('employee.effective_date_invalid'),
        ];
    }
}

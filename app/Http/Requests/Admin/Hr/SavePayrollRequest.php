<?php

namespace App\Http\Requests\Admin\Hr;

use Illuminate\Foundation\Http\FormRequest;

class SavePayrollRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'report_date' => 'required|date',
            'total_main_salary' => 'required|numeric',
            'total_bonus' => 'required|numeric',
            'total_deductions' => 'required|numeric',
            'total_loans' => 'required|numeric',
            'grand_total' => 'required|numeric',
            'employees' => 'required|array',
            'to_date' => 'required|date',
            'from_date' => 'required|date',
        ];
    }
}

<?php

namespace App\Http\Requests\Admin\external_test;

use Illuminate\Foundation\Http\FormRequest;

class SaveRequest extends FormRequest
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
            'test_code' => 'required|string|max:255',
            'client_id' => 'required',
            'company_id' => 'required',
            'project_id' => 'required',
            'test_type' => 'required',
            'sample_num' => 'required|integer|min:1',
            'sample_cost' => 'required|numeric|min:0',
            'discount_type' => 'nullable|in:p,v',
            'discount' => 'nullable|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'report_num' => 'required|integer|min:1',
            'report_date' => 'required|date',
            'notes' => 'nullable|string',
            'kt_docs_repeater_basic.*.invoice_num' => 'required|integer|min:1',
            'kt_docs_repeater_basic.*.invoice_date' => 'required|date',
            'kt_docs_repeater_basic.*.value' => 'required|numeric|min:0',
        ];
    }
}

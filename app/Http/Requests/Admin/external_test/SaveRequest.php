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
            'test_code_st' => 'required|string',
            'client_id' => 'required',
            'company_id' => 'required',
            'project_id' => 'required',
            'wared_number' => 'required',
            'wared_date' => 'required',
            'talab_number' => 'required',
            'talab_title' => 'required',
            'talab_image' => 'nullable',
            'talab_date' => 'required',
            'talab_end_date' => 'nullable',

            'test_category' => 'required',
            'test_sub_category' => 'required',
            'test' => 'required',
            'sample_num' => 'required|integer|min:1',
            'sample_cost' => 'required|numeric|min:0',
            'discount_type' => 'nullable|in:p,v',
            'discount' => 'nullable|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'sader_num' => 'required',
            'sader_date' => 'required',
            'notes' => 'nullable|string',


        ];
    }
}

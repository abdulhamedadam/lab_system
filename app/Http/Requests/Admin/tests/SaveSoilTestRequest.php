<?php

namespace App\Http\Requests\Admin\tests;

use Illuminate\Foundation\Http\FormRequest;

class SaveSoilTestRequest extends FormRequest
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
            'client_id' => 'required|exists:tbl_clients,id',
            'wared_date' => 'required',
            'book_number' => 'required',
            'wared_number' => 'required',
            'monamzig_id' => 'required',
            'authorized_name' => 'required',
        //    'test_type' => 'required',
            'company_id' => 'required|exists:tbl_clients_companies,id',
            'project_id' => 'required|exists:tbl_clients_projects,id',
            'test_code' => 'required|string|max:255',
            'talab_number' => 'required|string|max:255',
            'talab_title' => 'required|string|max:255',
            // 'talab_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'talab_date' => 'required|date',
            'talab_end_date' => 'required|date|after:talab_date',
            'sample_number' => 'required',
            'cost' => 'required',
        ];
    }
}

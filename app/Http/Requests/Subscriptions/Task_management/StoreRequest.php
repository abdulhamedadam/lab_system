<?php

namespace App\Http\Requests\Subscriptions\Task_management;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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

            'title_ar' => 'required',
            'title_en' => 'required',
            'type' => 'required',
            'emp_id' => 'required',
            'status' => 'required',
            'details_en' => 'required',
            'details_ar' => 'required',
            'date' => 'required',
        ];
    }
}

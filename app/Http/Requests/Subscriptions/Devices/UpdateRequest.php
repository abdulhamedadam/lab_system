<?php

namespace App\Http\Requests\Subscriptions\Devices;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name_ar' => 'required',
            'name_en' => 'required',
            'code' => 'required|unique:sub_devices', 
            'exercise_type' => 'required', 
            'description_ar' => 'required',
            'description_en' => 'required',              
            'image' => 'sometimes',
             
        ];
    }
}

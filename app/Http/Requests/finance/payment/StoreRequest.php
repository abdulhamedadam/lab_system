<?php

namespace App\Http\Requests\finance\payment;

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
           // 'name.ar' => 'required|unique:payments,name->ar',
           // 'name.en' => 'required|unique:payments,name->en',
      'name.ar' => 'required',
      'name.en'=>'required'
        ];
    }
}

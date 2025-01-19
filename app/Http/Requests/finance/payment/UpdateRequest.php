<?php

namespace App\Http\Requests\finance\payment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
       /* $id = $this->id;

        return [
            'name.ar' => [
                'required',
                Rule::unique('payments', 'name->ar')->ignore($id),
            ],
            'name.en' => [
                'required',
                Rule::unique('payments', 'name->en')->ignore($id),
            ],
      
        ];
*/
return [
      'name.ar' => 'required',
      'name.en'=>'required'
];
    }
}

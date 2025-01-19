<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Accounts_typeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

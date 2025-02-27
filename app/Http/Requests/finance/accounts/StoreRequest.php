<?php

namespace App\Http\Requests\finance\accounts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

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
            'name.ar' => 'required|unique:fr_accounts,name->ar',
            'name.en' => 'required|unique:fr_accounts,name->en',
            'code' => 'required|numeric|min:0|unique:fr_accounts,code',
            'parent_id' => [
                'nullable',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) {
                    if ($value != 0 && !DB::table('fr_accounts')->where('id', $value)->exists()) {
                        $fail(trans('forms.account_not_exite'));
                    }
                },
            ],
        ];
    }
}

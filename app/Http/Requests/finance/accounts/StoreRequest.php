<?php

namespace App\Http\Requests\finance\accounts;

use DB;
use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name.ar' => 'required|unique:fr_accounts,name->ar',
            'name.en' => 'required|unique:fr_accounts,name->en',
//            'account_num' => 'required|numeric|min:0|unique:fr_accounts,account_num',
            'code' => 'required|numeric|min:0|unique:fr_accounts,code',
            'account_type' => ['required', 'exists:fr_accounts_type,id'],
            'parent_id' => [
                'nullable',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) {
                    // إذا كانت قيمة `parent_id` ليست صفرًا، تحقق من وجودها في جدول `fr_accounts`
                    if ($value != 0 && !DB::table('fr_accounts')->where('id', $value)->exists()) {
                        $fail(trans('forms.account_not_exite'));
                    }
                },
            ],
        ];
    }

    /*  public function rules(): array
    {
        return [
            'name.ar' => 'required|unique:fr_accounts,name->ar',
            'name.en' => 'required|unique:fr_accounts,name->en',
            'account_num' => 'required|numeric|min:0|unique:fr_accounts,account_num',
            'code' => 'required|numeric|min:0|unique:fr_accounts,code',
            'parent_id' => 'nullable|exists:fr_accounts,id',

        ];
    }*/
}

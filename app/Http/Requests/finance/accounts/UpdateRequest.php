<?php

namespace App\Http\Requests\finance\accounts;

use DB;
use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->id;

        return [
            'name.ar' => [
                'required',
                Rule::unique('fr_accounts', 'name->ar')->ignore($id),
            ],
            'name.en' => [
                'required',
                Rule::unique('fr_accounts', 'name->en')->ignore($id),
            ],
            /* 'account_num' => [
                 'required',
                 'numeric',
                 'min:0',
                 Rule::unique('fr_accounts')->ignore($id),
             ],*/
            'code' => [
                'required',
                'numeric',
                'min:0',
                Rule::unique('fr_accounts')->ignore($id),
            ],
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
}

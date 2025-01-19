<?php

namespace App\Http\Requests\Admin\subscription\freezing_day;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFreezingDayRequests extends FormRequest
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
            'member_id' => 'required',
            'freezing_day' => [
                'required',
                Rule::unique('tbl_member_subscriptions_freezing_days')->where(function ($query) {
                    return $query
                        ->where('member_id', request()->input('member_id'))
                        ->where('member_subscription_id', request()->input('member_subscription_id'));
                }),
            ],

        ];
    }


}

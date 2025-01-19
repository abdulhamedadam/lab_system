<?php

namespace App\Http\Requests\finance\Exchange;

use Illuminate\Foundation\Http\FormRequest;

class ExchangeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [

//            'Receipt_Voucher.accounts_id' => ['required', 'integer', 'exists:fr_accounts,id'],
        /*   'Receipt_Voucher.payment_id' => ['required', 'integer', 'exists:fr_payments,id'],
            'Exchange.member_id' => ['required', 'integer', 'exists:tbl_members,id'],
            'Exchange.amount' => 'required|numeric|min:0.01',
            'exchange.date_at' => 'required', */
        ];
    }




}

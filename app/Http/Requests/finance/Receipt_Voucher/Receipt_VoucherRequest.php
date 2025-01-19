<?php

namespace App\Http\Requests\finance\Receipt_Voucher;

use Illuminate\Foundation\Http\FormRequest;

class Receipt_VoucherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [

//            'Receipt_Voucher.accounts_id' => ['required', 'integer', 'exists:fr_accounts,id'],
        //    'Receipt_Voucher.payment_id' => ['required', 'integer', 'exists:fr_payments,id'],
            'Receipt_Voucher.member_id' => ['required', 'integer', 'exists:tbl_members,id'],
            'Receipt_Voucher.amount' => 'required|numeric|min:0.01',
            'Receipt_Voucher.date_at' => 'required',
        ];
    }




}

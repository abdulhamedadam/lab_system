<?php

namespace App\Http\Requests\Admin\payment;

use Illuminate\Foundation\Http\FormRequest;

class SaveDuesPaymentRequest extends FormRequest
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
            'value'=>'required',
            'paid_date'=>'required',
            'num'=>'required',
            'payment_type'=>'required',
            'received_by'=>'required',
            'notes'=>'required',
        ];
    }
}

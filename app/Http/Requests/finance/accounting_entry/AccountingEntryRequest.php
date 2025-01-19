<?php

namespace App\Http\Requests\finance\accounting_entry;

use Illuminate\Foundation\Http\FormRequest;

class AccountingEntryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'lines' => 'required|array|min:2', // Need at least one Debtor and one Creditor
            'total' => 'required|numeric|in:0',
            'lines.*.account_id' => 'required',
            'lines.*.amount' => 'required|numeric|min:0.01',
            'lines.*.type' => 'required|in:debtor,creditor',
        ];
    }

    /*   public function withValidator($validator)
       {
           $validator->after(function ($validator) {
               $total = $this->calculateTotal();
               if ($total !== 0) {
                   $validator->errors()->add('total', 'The total difference between Debtor and Creditor amounts must be zero.');
               }
           });
       }

       protected function calculateTotal()
       {
           $debtorsTotal = 0;
           $creditorsTotal = 0;

           foreach ($this->input('lines', []) as $line) {
               $amount = (float)$line['amount'];
               if (isset($line['type'])) {

                   if ($line['type'] === 'debtor') {
                       $debtorsTotal += $amount;
                   } elseif ($line['type'] === 'creditor') {
                       $creditorsTotal += $amount;
                   }
               }
           }

           return $debtorsTotal - $creditorsTotal;
       }*/
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $lines = $this->input('lines', []);

            // Separate the debtor and creditor amounts
            $debtorSum = 0;
            $creditorSum = 0;
            $hasDebtor = false;
            $hasCreditor = false;

            foreach ($lines as $line) {
                if (isset($line['type'])) {
                    if ($line['type'] === 'debtor') {
                        $debtorSum += $line['amount'];
                        $hasDebtor = true;
                    } elseif ($line['type'] === 'creditor') {
                        $creditorSum += $line['amount'];
                        $hasCreditor = true;
                    }
                }
            }

            // Check that both debtor and creditor lines exist
            if (!$hasDebtor || !$hasCreditor) {
                $validator->errors()->add('total', trans('accounting_entry.one_line'));
            }

            // Check if sum of debtor and creditor amounts are equal
            if ($debtorSum !== $creditorSum) {
                $validator->errors()->add('total', trans('accounting_entry.total_value'));
            }
        });
    }


}

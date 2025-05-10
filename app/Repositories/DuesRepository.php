<?php


namespace App\Repositories;


use App\Interfaces\DuesInterface;
use App\Models\Admin\Masrofat;
use App\Models\Admin\Test;
use App\Models\ClientTestPayment;
use App\Models\ClientTests;
use Illuminate\Support\Facades\DB;

class DuesRepository implements DuesInterface
{

    public function get_all_dues($filters = [])
    {
        $query = ClientTests::with(['client', 'client_test_payment'])
                    ->orderBy('id', 'desc');

        if (!empty($filters)) {
            if (isset($filters['client_id']) && $filters['client_id']) {
                $query->where('client_id', $filters['client_id']);
            }

            if (isset($filters['month']) && $filters['month']) {
                $query->where('month', $filters['month']);
            }

            if (isset($filters['year']) && $filters['year']) {
                $query->where('year', $filters['year']);
            }

            if (isset($filters['test_type']) && $filters['test_type']) {
                $query->where('test_type', $filters['test_type']);
            }
<<<<<<< HEAD

=======
>>>>>>> cf63cffe12ddc1065e8d6c062fa3a04c32ca2d7c
        }

        $clientTests = $query->get();

        if (!empty($filters) && isset($filters['test_code']) && $filters['test_code']) {
            $clientTests = $clientTests->filter(function($test) use ($filters) {
                $testData = $test->belongsToDynamic();
                // return $testData && $testData->test_code_st == $filters['test_code'];
                return $testData && stripos($testData->test_code_st, $filters['test_code']) !== false;
            });
        }

        foreach ($clientTests as $test) {
            $test->test_data = $test->belongsToDynamic();
        }

        return $clientTests;
    }

    /***************************************************/
    public function find($id)
    {
        $clientTests = ClientTests::where('id', $id)->with(['client', 'client_test_payment'])->get();

        foreach ($clientTests as $test) {
            $test->test_data = $test->belongsToDynamic();
        }

        return $clientTests[0];
    }

    /***************************************************/
    public function get_data_by_soil_test_id($id)
    {
        $clientTests = ClientTests::where('test_id',$id)->where('test_table','tbl_tests')->get();

        foreach ($clientTests as $test) {
            $test->test_data = $test->belongsToDynamic();
        }

        return  $clientTests[0];
    }
    /***************************************************/
    public function client_test_payment($id)
    {
        return ClientTestPayment::with(['client_test','client_test.test','client_test.external_test'])->find($id);
    }
    /****************************************************/
    public function get_test_account_statement($id)
    {
        return ClientTests::where('test_id', $id)->with(['client', 'client_test_payment', 'test'])->first();
    }
    /****************************************************/
    public function get_company_dues($id)
    {
        $clientTests = ClientTests::where('client_id', $id)->with(['client', 'client_test_payment', 'test'])->get();

        foreach ($clientTests as $test) {
            $test->test_data = $test->belongsToDynamic();
        }

        return $clientTests;
    }
    /****************************************************/
    public function get_unfinished_dues($id)
    {
        return ClientTests::where('client_id', $id)
            ->with(['client', 'client_test_payment', 'test'])
            ->get()
            ->filter(function ($test) {
                $totalPaid = $test->client_test_payment->sum('value');
                return $totalPaid < $test->test_value;
            })
            ->values();
    }

    /******************************************************/
    public function get_received_payments($type = null, $filters = [])
    {
        $query = ClientTestPayment::with([
            'client_test',
            'client_test.test',
            'client_test.external_test',
            'client_test.client'
        ]);

        if ($type) {
            switch ($type) {
                case 'daily':
                    $query->whereDate('paid_date', today());
                    break;
                case 'weekly':
                    $query->whereBetween('paid_date', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'monthly':
                    $query->whereBetween('paid_date', [now()->startOfMonth(), now()->endOfMonth()]);
                    break;
                case 'yearly':
                    $query->whereBetween('paid_date', [now()->startOfYear(), now()->endOfYear()]);
                    break;
            }
        }

        if (!empty($filters)) {
            if (!empty($filters['client_id'])) {
                $query->whereHas('client_test', function($q) use ($filters) {
                    $q->where('client_id', $filters['client_id']);
                });
            }

            if (!empty($filters['month'])) {
                $query->whereMonth('paid_date', $filters['month']);
            }
        }

        $payments = $query->orderBy('paid_date', 'desc')->get();

        if (!empty($filters['test_code'])) {
            $payments = $payments->filter(function($payment) use ($filters) {
                if ($payment->client_test) {
                    $testData = $payment->client_test->belongsToDynamic();
                    return $testData && stripos($testData->test_code_st, $filters['test_code']) !== false;
                }
                return false;
            });
        }

        return $payments;
    }
    /********************************************************/
    public function get_dues($client_id, $from_date = null, $to_date = null)
    {
        $query = ClientTests::where('client_id', $client_id)
            ->with(['client', 'client_test_payment', 'test']);
        if ($from_date && $to_date) {
            $query->whereBetween('created_at', [$from_date, $to_date]);
        }
        $clientTests = $query->get();
        foreach ($clientTests as $test) {
            $test->test_data = $test->belongsToDynamic();
        }

        return $clientTests;
    }
    /********************************************************/
    public function get_financial($from_date = false, $to_date = false)
    {
        //dd($from_date,$to_date);
        if (!$from_date || !$to_date) {
            $from_date = now()->subMonth()->format('Y-m-d');
            $to_date = now()->format('Y-m-d');
        }

        $revenues = ClientTestPayment::whereBetween('created_at', [$from_date, $to_date])
            ->select('id', 'created_at as date', 'notes as description', 'value', DB::raw('"income" as type'));

        $expenses = Masrofat::whereBetween('created_at', [$from_date, $to_date])
            ->select('id', 'created_at as date', 'notes as description', 'value', DB::raw('"expense" as type'));

        $transactions = $revenues->unionAll($expenses)
            ->orderBy('date', 'asc')
            ->get();

        $balance = 0;
        foreach ($transactions as $transaction) {
            if ($transaction->type == 'income') {
                $balance += $transaction->value;
            } else {
                $balance -= $transaction->value;
            }
            $transaction->balance = $balance;
        }

        return $transactions;
    }
    /********************************************************/
    public function get_revenue_report($from_date = null, $to_date = null,$client_id)
    {
        $query = ClientTestPayment::with('client_test');
        if ($client_id)
        {
            $query->where('client_id', $client_id);
        }
        if ($from_date && $to_date) {
            $query->whereBetween('created_at', [$from_date, $to_date]);
        }

        $revenue=$query->get();

        foreach ($revenue as $test) {
           // dd($test->client_test->belongsToDynamic());
            $test->test_data = $test->client_test->belongsToDynamic();
        }
        return $revenue;
    }
    /*****************************************************/
    public function get_expense_report($from_date = null, $to_date = null, $band_id = null)
    {
        $query = Masrofat::with('sarf_band');

        if ($band_id) {
            $query->where('band_id', $band_id);
        }

        if ($from_date && $to_date) {
            $query->whereBetween('sarf_date', [$from_date, $to_date]);
        }

        $expense = $query->get();

        return $expense;
    }

}

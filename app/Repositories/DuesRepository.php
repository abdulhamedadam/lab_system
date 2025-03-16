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

    public function get_all_dues()
    {
        $clientTests = ClientTests::with(['client','client_test_payment'])->OrderBy('id','desc')->get();

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
    public function get_received_payments($type = null)
    {
        $query = ClientTestPayment::with(['client_test', 'client_test.test', 'client_test.external_test']);

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
                default:
                    return response()->json(['error' => 'Invalid type'], 400);
            }
        }
      //  dd();
        return $query->get();
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
    public function get_financial($from_date = null, $to_date = null)
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


}

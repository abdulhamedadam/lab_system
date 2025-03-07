<?php


namespace App\Repositories;


use App\Interfaces\DuesInterface;
use App\Models\Admin\Test;
use App\Models\ClientTestPayment;
use App\Models\ClientTests;

class DuesRepository implements DuesInterface
{

    public function get_all_dues()
    {
        $clientTests = ClientTests::with(['client','client_test_payment'])->get();

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
        return ClientTestPayment::find($id);
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
}

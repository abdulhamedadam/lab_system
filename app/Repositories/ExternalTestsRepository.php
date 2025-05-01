<?php


namespace App\Repositories;


use App\Interfaces\ExternalTestsInterface;
use App\Models\Admin\Test;
use App\Models\ClientTestPayment;
use App\Models\ClientTests;
use App\Models\ExternalTests;
use Illuminate\Support\Facades\DB;

class ExternalTestsRepository implements ExternalTestsInterface
{


    public function save($data)
    {
        return ExternalTests::create($data);
    }

    /**************************************************/
    public function get_company_test($company_id)
    {
        return ExternalTests::where('company_id', $company_id)->get();
    }

    /*************************************************/
    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $test = Test::find($id);
            if (!$test) {
                throw new \Exception("Test not found.");
            }

            $client_test = ClientTests::where('test_id', $id)->first();
            if ($client_test) {
                ClientTestPayment::where('client_test_id', $client_test->id)->delete();
                $client_test->delete();
            }

            return $test->delete();
        });
    }
}

<?php


namespace App\Repositories;


use App\Interfaces\ClientTestsInterface;
use App\Models\ClientTests;

class ClientTestsRepository implements ClientTestsInterface
{

    public function get_all_test()
    {

    }

    public function create($data)
    {
        return ClientTests::create($data);
    }

    public function get_client_test($client_id)
    {

    }

    /***************************************/
    public function update($test_id, $data)
    {
        $client_test = ClientTests::where('test_id', $test_id)->where('test_model', $data['test_model'])->first();
        return $client_test->update($data);
    }
}

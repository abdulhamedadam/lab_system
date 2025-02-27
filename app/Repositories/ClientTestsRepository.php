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
}

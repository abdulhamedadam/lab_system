<?php


namespace App\Repositories;


use App\Interfaces\ExternalTestsInterface;
use App\Models\ExternalTests;

class ExternalTestsRepository implements ExternalTestsInterface
{


    public function save($data)
    {
        return ExternalTests::create($data);
    }
    /**************************************************/
    public function get_company_test($company_id)
    {
        return ExternalTests::where('company_id',$company_id)->get();
    }
}

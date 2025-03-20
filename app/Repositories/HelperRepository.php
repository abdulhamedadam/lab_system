<?php


namespace App\Repositories;


use App\Interfaces\HelperInterface;
use App\Models\Admin\SarfBand;
use App\Models\Admin\Test;
use App\Models\Clients;
use App\Models\ClientsCompanies;
use App\Models\ClientsProjects;

class HelperRepository implements HelperInterface
{

    public function save_client($data)
    {
        return Clients::create($data);
    }

    /**********************************/
    public function save_company($data)
    {
        return ClientsCompanies::create($data);
    }

    /**********************************/
    public function save_project($data)
    {
        return ClientsProjects::create($data);
    }
    /************************************/
    public function get_companies()
    {
        return ClientsCompanies::all();
    }
    /************************************/
    public function get_bnod_sarf()
    {
        return SarfBand::all();
    }
    /*************************************/
    public function get_all_tests()
    {
       return Test::where('sader_number',null)->get();
    }
}

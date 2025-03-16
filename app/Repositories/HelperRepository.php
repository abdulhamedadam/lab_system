<?php


namespace App\Repositories;


use App\Interfaces\HelperInterface;
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
}

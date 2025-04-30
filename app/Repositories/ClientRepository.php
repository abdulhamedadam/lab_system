<?php


namespace App\Repositories;


use App\Interfaces\ClientInterface;
use App\Models\ClientsCompanies;
use App\Models\ClientsProjects;

class ClientRepository implements ClientInterface
{

    public function get_client_company_data($client_id)
    {
      //  dd($client_id);
        return ClientsCompanies::with(['company'])->where('client_id',$client_id)->get();
    }

    public function get_project($client_id, $company_id)
    {
        return ClientsProjects::where('client_id',$client_id)->where('company_id',$company_id)->get();
    }
}

<?php


namespace App\Repositories;


use App\Interfaces\CompanyInterface;
use App\Models\Companies;

class CompanyRepository implements CompanyInterface
{


    public function get_company_data($id)
    {
        return Companies::with(['client_company' => function($query) {
            $query->select('id', 'client_id', 'company_id');
        }])->find($id);

    }
}

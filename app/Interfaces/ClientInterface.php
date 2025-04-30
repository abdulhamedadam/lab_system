<?php


namespace App\Interfaces;


interface ClientInterface
{
    public function get_client_company_data($client_id);
    public function get_project($client_id,$company_id);
}

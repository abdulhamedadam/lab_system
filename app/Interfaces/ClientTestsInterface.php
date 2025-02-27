<?php


namespace App\Interfaces;


interface ClientTestsInterface
{
    public function get_all_test();
    public function create($data);
    public function get_client_test($client_id);

}

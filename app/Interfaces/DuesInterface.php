<?php


namespace App\Interfaces;


interface DuesInterface
{


    public function get_all_dues();
    public function find($id);
    public function client_test_payment($id);

}

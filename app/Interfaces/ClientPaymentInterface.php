<?php


namespace App\Interfaces;


interface ClientPaymentInterface
{
    public function get_last_num();
    public function create($data);
    public function find($id);
}

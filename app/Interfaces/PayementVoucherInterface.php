<?php


namespace App\Interfaces;


interface PayementVoucherInterface
{
    public function get_all();
    public function get_payment($id);
    public function create($data);
    public function update($id,$data);
    public function delete($id);
}

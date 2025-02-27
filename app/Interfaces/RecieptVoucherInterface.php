<?php


namespace App\Interfaces;


interface RecieptVoucherInterface
{

    public function get_all();
    public function get_receipt($id);
    public function create($data);
    public function update($id,$data);
    public function delete($id);

}

<?php


namespace App\Interfaces;


interface AccountInterface
{

    public function get_accounts();
    public function find($id);
    public function create(array $data);
    public function update($id,array $data);
    public function delete($id);
    public function get_accounts_select();

}

<?php


namespace App\Repositories;


use App\Interfaces\ClientPaymentInterface;
use App\Models\ClientTestPayment;

class ClientPaymentRepository implements ClientPaymentInterface
{

    public function get_last_num()
    {
        $lastNum = ClientTestPayment::max('num');

        return $lastNum ? $lastNum +1 : 1;
    }
    /************************************************/
    public function create($data)
    {
        return ClientTestPayment::create($data);
    }
    /*************************************************/
    public function find($id)
    {
        return ClientTestPayment::find($id);
    }
}

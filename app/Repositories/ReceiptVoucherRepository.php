<?php


namespace App\Repositories;


use App\Interfaces\RecieptVoucherInterface;
use App\Models\Admin\Finance\ReceiptVoucher;

class ReceiptVoucherRepository implements RecieptVoucherInterface
{

    public function get_all()
    {
        return ReceiptVoucher::select('*')->orderBy('id','desc')->get();
    }

    public function get_receipt($id)
    {
        return ReceiptVoucher::find($id);
    }

    public function create($data)
    {
        return ReceiptVoucher::create($data);
    }

    public function update($id, $data)
    {
        $receipt = $this->find($id);
        return $receipt->update($data);
    }

    public function delete($id)
    {
        $receipt = $this->find($id);
        return $receipt->delete();
    }
}

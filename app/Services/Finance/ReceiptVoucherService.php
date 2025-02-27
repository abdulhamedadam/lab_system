<?php


namespace App\Services\Finance;


use App\Repositories\AccountRepository;
use App\Repositories\ReceiptVoucherRepository;
use App\Traits\ImageProcessing;

class ReceiptVoucherService
{
    use ImageProcessing;
    /*****************************************************/
    public function __construct(ReceiptVoucherRepository $receiptVoucherRepository)
    {
        $this->receiptVoucherRepository=$receiptVoucherRepository;
    }
    /*****************************************************/
    public function get_data_table()
    {
        return $this->receiptVoucherRepository->get_all();
    }
    /*****************************************************/

}

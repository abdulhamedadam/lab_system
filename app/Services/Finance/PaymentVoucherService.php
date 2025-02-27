<?php


namespace App\Services\Finance;


use App\Traits\ImageProcessing;

class PaymentVoucherService
{
    use ImageProcessing;
    /*****************************************************/
    public function __construct(PaymentVoucherService $paymentVoucherService)
    {
        $this->paymentVoucherService=$paymentVoucherService;
    }
}

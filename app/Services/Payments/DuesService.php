<?php

namespace App\Services\Payments;
use App\Repositories\AccountRepository;
use App\Repositories\ClientPaymentRepository;
use App\Repositories\DuesRepository;
use App\Traits\ImageProcessing;

class DuesService
{

    use ImageProcessing;
    /*****************************************************/
    public function __construct(DuesRepository $duesRepository,ClientPaymentRepository $clientPaymentRepository)
    {
        $this->duesRepository=$duesRepository;
        $this->clientPaymentRepository=$clientPaymentRepository;
    }

    /*****************************************************/
    public function get_all_dues()
    {
        return $this->duesRepository->get_all_dues();
    }
    /******************************************************/
    public function find($id)
    {
        return $this->duesRepository->find($id);
    }
    /*******************************************************/
    public function get_last_num()
    {
        return $this->clientPaymentRepository->get_last_num();
    }
    /*******************************************************/
    public function get_data_by_soil_test_id($test_id)
    {
        return $this->duesRepository->get_data_by_soil_test_id($test_id);
    }
    /*******************************************************/
    public function client_test_payment($id)
    {
        return $this->duesRepository->client_test_payment($id);
    }

}

<?php

namespace App\Services\Payments;
use App\Repositories\AccountRepository;
use App\Repositories\ClientPaymentRepository;
use App\Repositories\DuesRepository;
use App\Traits\ImageProcessing;

class DuesService
{

    use ImageProcessing;
    protected $clientPaymentRepository;
    protected $duesRepository;

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
    /********************************************************/
    public function get_company_dues($id)
    {
        return $this->duesRepository->get_company_dues($id);
    }
    /********************************************************/
    public function get_unfinished_dues($id)
    {
        return $this->duesRepository->get_unfinished_dues($id);
    }

    /********************************************************/
    public function get_received_payments($type)
    {
        return $this->duesRepository->get_received_payments($type);
    }
    /*********************************************************/
    public function get_dues($client_id,$from_date,$to_date)
    {
        return $this->duesRepository->get_dues($client_id,$from_date,$to_date);
    }
    /*********************************************************/
    public function get_financial($from_date,$to_date)
    {
        return $this->duesRepository->get_financial($from_date,$to_date);
    }
    /**********************************************************/
    public function get_revenue_report($from_date,$to_date,$client_id)
    {
        return $this->duesRepository->get_revenue_report($from_date,$to_date,$client_id);
    }
    /***********************************************************/
    public function get_expense_report($from_date,$to_date,$band_id)
    {
        return $this->duesRepository->get_expense_report($from_date,$to_date,$band_id);
    }

}

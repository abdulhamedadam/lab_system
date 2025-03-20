<?php


namespace App\Services;


use App\Repositories\HelperRepository;

class HelperService
{

    public function __construct(HelperRepository $helperRepository)
    {
        $this->helperRepository=$helperRepository;
    }
    /*************************************************/
    public function save_client($data)
    {
        return $this->helperRepository->save_client($data);
    }
    /*************************************************/
    public function save_company($data)
    {
        return $this->helperRepository->save_company($data);
    }
    /*************************************************/
    public function save_project($data)
    {
        return $this->helperRepository->save_project($data);
    }
    /*************************************************/
    public function get_companies()
    {
        return $this->helperRepository->get_companies();
    }
    /**************************************************/
    public function get_bnod_sarf()
    {
        return $this->helperRepository->get_bnod_sarf();
    }
    /**************************************************/
    public function get_all_tests()
    {
        return $this->helperRepository->get_all_tests();
    }
}
